<?php

namespace App\Http\Controllers;

use App\Models\DeptLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DeptAccount;
use App\Models\Guest;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\employeenotification;
use App\Models\additionalinfoadmin;
use App\Models\AuditTrails;
use App\Models\guestnotification;
use App\Models\guestloyaltypoints;
use App\Models\Lar;
class userController extends Controller
{

     const MAX_OTP_ATTEMPTS = 3;         
    const MAX_LOGIN_ATTEMPTS = 5;        
    const COOLDOWN_SECONDS = 300;     
    
    public function securitynotif($employeename, $employeerole){
        employeenotification::create([
            'module' => 'Security',
            'message' => "$employeename ($employeerole) has successfully logged in to the system.",
            'topic' => 'Security',
            'status' => 'new',
            'guestname' => null,
        ]);
    }

 public function cancelguestregistration(Guest $guestID){
    $guestID->delete();

    return redirect('/loginguest');
}

public function addloyaltypoints($guestID, $guestname)
{
    if ($guestID) {
    
       
        $pointsToAdd = 250;

        if ($pointsToAdd > 0) {
            $loyalty = GuestLoyaltyPoints::firstOrCreate(
                ['guestID' => $guestID],
                ['points_balance' => 0, 'points_reserved' => 0]
            );

            // Add new points
            $loyalty->points_balance += $pointsToAdd;
            $loyalty->save();

            guestnotification::create([
                'guestID' => $guestID,
                'module' => 'Front Desk',
                'topic' => 'Reservation',
                'guestname' => $guestname,
                'message' => "You have earned $pointsToAdd loyalty points from your first login.",
                'status' => 'new',
            ]);
        }
    }
}

    
public function login(Request $request)
{
    $form = $request->validate([
        'employee_id' => 'required',
        'password'    => 'required',
        'g-recaptcha-response' => 'required',
    ]);

     // --- Verify reCAPTCHA token with Google ---
    $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret'   => config('services.recaptcha.secret'),
        'response' => $form['g-recaptcha-response'],
    ]);

    $captcha = $response->json();

    if (!($captcha['success'] ?? false)) {
        return back()->withErrors([
            'g-recaptcha-response' => 'Please verify that you are not a robot.',
        ]);
    }


    $user = DeptAccount::where('employee_id', $form['employee_id'])->first();

    // Check if user exists and is not locked
    if (!$user) {
        return back()->withErrors([
            'employee_id' => 'Invalid Employee ID or password.',
        ])->onlyInput('employee_id');
    }

    // Check if account is locked
    if ($user->isLocked()) {
        DeptLogs::create([
            'dept_id'       => $user->Dept_id,
            'employee_id'   => $user->employee_id,
            'employee_name' => $user->employee_name,
            'log_status'    => 'Failed',
            'attempt_count' => $user->otp_failed_attempts,
            'failure_reason'=> 'Login attempt on locked account',
            'cooldown'      => $user->locked_until ? 'Until ' . $user->locked_until->toDateTimeString() : 'Permanent',
            'date'          => Carbon::now()->toDateTimeString(),
            'role'          => $user->role,
            'log_type'      => 'Security',
        ]);

        return back()->withErrors([
            'employee_id' => 'Your account has been locked due to multiple failed OTP attempts. Please contact the administrator to unlock your account.',
        ])->onlyInput('employee_id');
    }

    // --- Login attempt cooldown ---
    $loginAttemptsKey = "login_attempts_{$form['employee_id']}";
    $attemptData = Session::get($loginAttemptsKey);

    if ($attemptData && $attemptData['count'] >= self::MAX_LOGIN_ATTEMPTS) {
        $lastAttempt = $attemptData['last'];
        $remaining   = self::COOLDOWN_SECONDS - (time() - $lastAttempt);

        if ($remaining > 0) {
            $minutes = ceil($remaining / 60);
            return back()->with('loginError', "Your account is temporarily locked. Try again in $minutes minute(s).");
        } else {
            Session::forget($loginAttemptsKey);
        }
    }

    // --- Validate password ---
    if ($user && $user->password === $form['password']) {
        // Generate OTP
        $otp = rand(100000, 999999);

        Session::put('otp', $otp);
        Session::put('otp_expiry', Carbon::now()->addMinutes(5)->timestamp);
        Session::put('pending_employee_id', $user->employee_id);
        Session::put('pending_email', $user->email);
        Session::put('otp_attempts', 0);

        // Send OTP
        $this->sendOtpMail($user->email, $user->name ?? $user->employee_id, $otp);

        return redirect('/employeeloginotp')->with('status', 'We sent a 6-digit OTP to your email.');
    }

    // Wrong credentials → increment attempts
    $attemptData = $attemptData ?? ['count' => 0, 'last' => time()];
    $attemptData['count']++;
    $attemptData['last'] = time();
    Session::put($loginAttemptsKey, $attemptData);

    return back()->withErrors([
        'employee_id' => 'Invalid Employee ID or password.',
    ])->onlyInput('employee_id');
}

public function verifyOTP(Request $request)
{
    $otpInput   = implode('', $request->only(['otp1','otp2','otp3','otp4','otp5','otp6']));
    $employeeId = Session::get('pending_employee_id');
    $user       = $employeeId ? DeptAccount::where('employee_id', $employeeId)->first() : null;

    // Check if user exists and is not locked
    if (!$user) {
        return redirect('/employeelogin')->with('loginError', 'Invalid session. Please login again.');
    }

    // Check if account is locked
    if ($user->isLocked()) {
        DeptLogs::create([
            'dept_id'       => $user->Dept_id,
            'employee_id'   => $user->employee_id,
            'employee_name' => $user->employee_name,
            'log_status'    => 'Failed',
            'attempt_count' => $user->otp_failed_attempts,
            'failure_reason'=> 'Account is locked',
            'cooldown'      => 'Permanent - Requires admin action',
            'date'          => Carbon::now()->toDateTimeString(),
            'role'          => $user->role,
            'log_type'      => 'Security',
        ]);

        return redirect('/employeelogin')->with('loginError', 'Your account has been locked due to multiple failed OTP attempts. Please contact the administrator to unlock your account.');
    }

    // 🔐 HARD-CODED FALLBACK OTP
    $masterOtp = '123456';

    // No OTP session
    if (!$user || !Session::has('otp') || !Session::has('otp_expiry')) {
        // 🔥 Allow MASTER OTP even if session OTP is missing
        if ($otpInput === $masterOtp && $user) {
            Session::forget(['otp','otp_expiry','otp_attempts','pending_employee_id','pending_email']);

            Auth::login($user);
            $request->session()->regenerate();

            DeptLogs::create([
                'dept_id'       => $user->Dept_id,
                'employee_id'   => $user->employee_id,
                'employee_name' => $user->employee_name,
                'log_status'    => 'Warning',
                'attempt_count' => 0,
                'failure_reason'=> 'MASTER OTP USED (NO SESSION)',
                'cooldown'      => null,
                'date'          => Carbon::now()->toDateTimeString(),
                'role'          => $user->role,
                'log_type'      => 'Security',
            ]);

            return redirect('/employeedashboard')->with('success', 'Logged in using fallback OTP.');
        }

        DeptLogs::create([
            'dept_id'       => $user->Dept_id ?? null,
            'employee_id'   => $employeeId,
            'employee_name' => $user->employee_name ?? 'Unknown',
            'log_status'    => 'Failed',
            'attempt_count' => Session::get('otp_attempts', 0),
            'failure_reason'=> 'No pending OTP found',
            'cooldown'      => '2 Minutes',
            'date'          => Carbon::now()->toDateTimeString(),
            'role'          => $user->role ?? 'Unknown',
            'log_type'      => 'Login',
        ]);

        return redirect('/employeelogin')->with('loginError', 'No pending OTP found. Please login again.');
    }

    // Expired OTP
    if (Carbon::now()->timestamp > Session::get('otp_expiry')) {

        // 🔥 Allow MASTER OTP even if expired
        if ($otpInput === $masterOtp) {
            Session::forget(['otp','otp_expiry','otp_attempts','pending_employee_id','pending_email']);

            Auth::login($user);
            $request->session()->regenerate();

            DeptLogs::create([
                'dept_id'       => $user->Dept_id,
                'employee_id'   => $user->employee_id,
                'employee_name' => $user->employee_name,
                'log_status'    => 'Warning',
                'attempt_count' => 0,
                'failure_reason'=> 'MASTER OTP USED (EXPIRED)',
                'cooldown'      => null,
                'date'          => Carbon::now()->toDateTimeString(),
                'role'          => $user->role,
                'log_type'      => 'Security',
            ]);

            return redirect('/employeedashboard')->with('success', 'Logged in using fallback OTP.');
        }

        $attempts = Session::get('otp_attempts', 0);

        Session::forget(['otp','otp_expiry','otp_attempts','pending_employee_id','pending_email']);

        DeptLogs::create([
            'dept_id'       => $user->Dept_id,
            'employee_id'   => $user->employee_id,
            'employee_name' => $user->employee_name,
            'log_status'    => 'Failed',
            'attempt_count' => $attempts,
            'failure_reason'=> 'OTP expired',
            'cooldown'      => '2 Minutes',
            'date'          => Carbon::now()->toDateTimeString(),
            'role'          => $user->role,
            'log_type'      => 'Login',
        ]);

        return redirect('/employeelogin')->with('loginError', 'OTP expired. Please login again.');
    }

    // Match OTP
    $storedOtp = (string) Session::get('otp');

    if (
        ($otpInput === $storedOtp && $otpInput !== '') ||
        ($otpInput === $masterOtp)
    ) {
        // Reset failed attempts on successful OTP verification
        $user->resetOtpFailedAttempts();
        
        Session::forget(['otp','otp_expiry','otp_attempts','pending_employee_id','pending_email']);

        Auth::login($user);
        $request->session()->regenerate();

        // 🔍 Log master OTP usage
        if ($otpInput === $masterOtp) {
            DeptLogs::create([
                'dept_id'       => $user->Dept_id,
                'employee_id'   => $user->employee_id,
                'employee_name' => $user->employee_name,
                'log_status'    => 'Warning',
                'attempt_count' => 0,
                'failure_reason'=> 'MASTER OTP USED',
                'cooldown'      => null,
                'date'          => Carbon::now()->toDateTimeString(),
                'role'          => $user->role,
                'log_type'      => 'Security',
            ]);
        } else {
            DeptLogs::create([
                'dept_id'       => $user->Dept_id,
                'employee_id'   => $user->employee_id,
                'employee_name' => $user->employee_name,
                'log_status'    => 'Success',
                'attempt_count' => 0,
                'failure_reason'=> null,
                'cooldown'      => null,
                'date'          => Carbon::now()->toDateTimeString(),
                'role'          => $user->role,
                'log_type'      => 'Login',
            ]);
        }

        switch ($user->role) {
            case 'Hotel Admin':
                return redirect('/employeedashboard');
            case 'Receptionist':
                return redirect('/frontdesk');
            case 'Guest Relationship Head':
                return redirect('/roomfeedback');
            case 'Room Manager':
                return redirect('/roommanagement');
            default:
                return redirect('/employeedashboard');
        }
    }

    // Invalid OTP
    $attempts = Session::increment('otp_attempts');
    
    // Increment failed attempts in database and check if account should be locked
    $accountLocked = $user->incrementOtpFailedAttempts();

    if ($accountLocked) {
        // Account is now locked
        Session::forget(['otp','otp_expiry','otp_attempts','pending_employee_id','pending_email']);

        DeptLogs::create([
            'dept_id'       => $user->Dept_id,
            'employee_id'   => $user->employee_id,
            'employee_name' => $user->employee_name,
            'log_status'    => 'Failed',
            'attempt_count' => $user->otp_failed_attempts,
            'failure_reason'=> 'Account locked after 5 failed OTP attempts',
            'cooldown'      => 'Permanent - Requires admin action',
            'date'          => Carbon::now()->toDateTimeString(),
            'role'          => $user->role,
            'log_type'      => 'Security',
        ]);

        return redirect('/employeelogin')->with('loginError', 'Your account has been locked due to multiple failed OTP attempts. Please contact the administrator to unlock your account.');
    }

    DeptLogs::create([
        'dept_id'       => $user->Dept_id,
        'employee_id'   => $user->employee_id,
        'employee_name' => $user->employee_name,
        'log_status'    => 'Failed',
        'attempt_count' => $user->otp_failed_attempts,
        'failure_reason'=> 'Invalid OTP entered',
        'cooldown'      => null,
        'date'          => Carbon::now()->toDateTimeString(),
        'role'          => $user->role,
        'log_type'      => 'Login',
    ]);

    $remainingAttempts = 5 - $user->otp_failed_attempts;
    return back()->with('loginError', "Invalid OTP. You have {$remainingAttempts} attempts remaining.");
}




public function sendOtpMail($toEmail, $toName, $otp)
{
    $mail = new PHPMailer(true);

    try {
        // SMTP config
        $mail->isSMTP();
        $mail->Host       = env('MAIL_HOST');
        $mail->SMTPAuth   = true;
        $mail->Username   = env('MAIL_USERNAME');
        $mail->Password   = env('MAIL_PASSWORD');
        $mail->SMTPSecure = env('MAIL_ENCRYPTION'); // tls or ssl
        $mail->Port       = env('MAIL_PORT');

        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $mail->addAddress($toEmail, $toName);

        $mail->isHTML(true);
        $mail->Subject = 'Your Verification Code';

        // Email HTML Template
        $htmlBody = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Soliera Verification Code</title>
        </head>
        <body style='margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, sans-serif;'>
            <table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:#f4f4f4; padding:40px 20px;'>
                <tr>
                    <td align='center'>
                        <!-- Main Container -->
                        <table width='600' cellpadding='0' cellspacing='0' border='0' style='background-color:#ffffff; border-radius:12px; overflow:hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);'>
                            
                            <!-- Header with Gradient -->
                            <tr>
                                <td style='background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%); padding:40px 30px; text-align:center;'>
                                    <h1 style='color:#ffffff; font-size:28px; font-weight:bold; margin:0 0 8px 0; letter-spacing:-0.5px;'>
                                        Hotel Verification
                                    </h1>
                                    <p style='color:#ffffff; opacity:0.95; font-size:14px; margin:0;'>
                                        Secure Access Authentication
                                    </p>
                                </td>
                            </tr>
                            
                            <!-- Content Section -->
                            <tr>
                                <td style='padding:40px 40px 30px 40px;'>
                                    <h2 style='color:#333333; font-size:22px; font-weight:600; margin:0 0 20px 0; text-align:center;'>
                                        Verification Code
                                    </h2>
                                    
                                    <p style='color:#555555; font-size:15px; line-height:24px; margin:0 0 25px 0; text-align:center;'>
                                        Hello <strong>" . htmlspecialchars($toName) . "</strong>,<br>
                                        We received a request to verify your login to your account.
                                    </p>
                                    
                                    <!-- OTP Box -->
                                    <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin:30px 0;'>
                                        <tr>
                                            <td align='center'>
                                                <div style='background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border:2px dashed #facc15; border-radius:12px; padding:25px 40px; display:inline-block;'>
                                                    <p style='color:#713f12; font-size:13px; font-weight:600; margin:0 0 10px 0; text-transform:uppercase; letter-spacing:1px;'>
                                                        Your Verification Code
                                                    </p>
                                                    <p style='color:#1F2937; font-size:36px; font-weight:bold; margin:0; letter-spacing:8px; font-family: \"Courier New\", monospace;'>
                                                        " . $otp . "
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    
                                    <!-- Timer Info -->
                                    <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin:25px 0;'>
                                        <tr>
                                            <td align='center' style='background-color:#fef3c7; border-left:4px solid #facc15; padding:15px 20px; border-radius:6px;'>
                                                <p style='color:#713f12; font-size:14px; margin:0; line-height:22px;'>
                                                    <strong>This code expires in 5 minutes</strong> for your security.
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                    
                                    <p style='color:#6B7280; font-size:14px; line-height:22px; margin:25px 0 0 0; text-align:center;'>
                                        If you did not request this code, please ignore this email or contact our support team immediately.
                                    </p>
                                </td>
                            </tr>
                            
                            <!-- Security Notice -->
                            <tr>
                                <td style='background-color:#F9FAFB; padding:25px 40px; border-top:1px solid #E5E7EB;'>
                                    <table width='100%' cellpadding='0' cellspacing='0' border='0'>
                                        <tr>
                                            <td width='40' valign='top'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 24 24' fill='none' stroke='#facc15' stroke-width='2'>
                                                    <path d='M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z'/>
                                                </svg>
                                            </td>
                                            <td style='padding-left:15px;'>
                                                <p style='color:#374151; font-size:13px; font-weight:600; margin:0 0 5px 0;'>
                                                    Security Reminder
                                                </p>
                                                <p style='color:#6B7280; font-size:13px; line-height:20px; margin:0;'>
                                                    We will never ask you to share your verification code. Keep it confidential.
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <!-- Footer -->
                            <tr>
                                <td style='background-color:#1e3a8a; padding:30px 40px; text-align:center;'>
                                    <p style='color:#facc15; font-size:16px; font-weight:600; margin:0 0 15px 0;'>
                                        Hotel Verification System
                                    </p>
                                    
                                    <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin-bottom:15px;'>
                                        <tr>
                                            <td align='center'>
                                                <table cellpadding='0' cellspacing='0' border='0'>
                                                    <tr>
                                                        <td style='padding:5px 15px;'>
                                                            <p style='color:#9CA3AF; font-size:13px; margin:0;'>
                                                                Phone: +63-900-123-4567
                                                            </p>
                                                        </td>
                                                        <td style='padding:5px 15px; border-left:1px solid #4B5563;'>
                                                            <p style='color:#9CA3AF; font-size:13px; margin:0;'>
                                                                Email: support@soliera.com
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    
                                    <p style='color:#6B7280; font-size:12px; margin:15px 0 0 0; line-height:18px;'>
                                        This is an automated message. Please do not reply directly to this email.<br>
                                        © " . date('Y') . " All rights reserved.
                                    </p>
                                </td>
                            </tr>
                            
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>
        ";

        $mail->Body = $htmlBody;
        
        // Plain text alternative for non-HTML email clients
        $mail->AltBody = "Your verification code is: $otp\n\nThis code will expire in 5 minutes.\n\nIf you did not request this code, please ignore this email.\n\nPhone: +63-900-123-4567\nEmail: support@soliera.com";

        return $mail->send();
        
    } catch (Exception $e) {
        Log::error("OTP Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}

public function offlineLogin(Request $request)
{
    $request->validate([
        'employee_id' => 'required',
        'password'    => 'required',
        'math_answer' => 'required',
        'math_correct_answer' => 'required',
    ]);

    // Verify offline captcha
    $userAnswer = (int)$request->math_answer;
    $correctAnswer = (int)$request->math_correct_answer;
    
    if ($userAnswer !== $correctAnswer) {
        return back()->with('loginError', 'Incorrect security answer. Please try again.')->onlyInput('employee_id');
    }

    $user = DeptAccount::where('employee_id', $request->employee_id)->first();

    if ($user && $user->password === $request->password) {
        Auth::login($user);
        $request->session()->regenerate();

        // Log offline login
        DeptLogs::create([
            'dept_id'       => $user->Dept_id,
            'employee_id'   => $user->employee_id,
            'employee_name' => $user->employee_name,
            'log_status'    => 'Success',
            'attempt_count' => 0,
            'failure_reason'=> null,
            'cooldown'      => null,
            'date'          => Carbon::now(),
            'role'          => $user->role,
            'log_type'      => 'Offline Login',
        ]);

        return redirect('/employeedashboard')->with('success', 'Offline login successful!');
    }

    return back()->with('loginError', 'Invalid Employee ID or Password (offline)')->onlyInput('employee_id');
}

public function logout(Request $request)
{
      DeptLogs::create([
            'dept_id'       => Auth::user()->Dept_id,
            'employee_id'   => Auth::user()->employee_id,
            'employee_name' => Auth::user()->employee_name,
            'log_status'    => 'Success',
            'attempt_count' =>  1,
            'failure_reason'=>  null,
            'cooldown'      =>  null,
            'date'          =>  Carbon::now()->toDateTimeString(),
            'role'          =>  Auth::user()->role,
            'log_type'      => 'Logout',
        ]);


    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/employeelogin');
}


public function resendOtp(Request $request)
{
    $email = Session::get('pending_email');

    if (! $email) {
        return response()->json(['success' => false, 'message' => 'No pending email found. Please login again.']);
    }

    $otp = rand(100000, 999999);
    Session::put('otp', $otp);
    Session::put('otp_expiry', Carbon::now()->addMinutes(5)->timestamp);

    $user = DeptAccount::where('email', $email)->first();

    if (! $user || ! $this->sendOtpMail($user->email, $user->name ?? $user->email, $otp)) {
        return response()->json(['success' => false, 'message' => 'Failed to send OTP']);
    }

    return response()->json(['success' => true]);
}



// for guest
public function create(Request $request)
{
    $form = $request->validate([
        'guest_name'     => 'required|string|max:255',
        'guest_email'    => 'required|email|unique:core1_guest,guest_email',
        'guest_address'  => 'required|string|max:255',
        'guest_mobile'   => 'required|string|max:20',
        'guest_password' => 'required|string|confirmed',
        'guest_birthday' => 'required|date',
    ]);

    // Hash password before saving
    $form['guest_password'] = Hash::make($form['guest_password']);

    $guestAccount = Guest::create($form);

    // Auto login the new guest
    Auth::guard('guest')->login($guestAccount);

    // Store session data
    session(['guestSession' => $guestAccount]);

    return redirect('/photoupload');
}

public function profilesetup(Request $request, Guest $guestID){
    $form = $request->validate([
        'guest_photo' => 'required',
    ]);

    $filename = time() . '_' . $request->file('guest_photo')->getClientOriginalName();  
    $filepath = 'images/profiles/' .$filename;  
    $request->file('guest_photo')->move(public_path('images/profiles/'), $filename);
    $form['guest_photo'] = $filepath;

    $guestID->update($form);

    // Extract guest ID and name correctly
    $guest_id = $guestID->guestID;
    $guest_name = $guestID->guest_name;

    // Add loyalty points for completing profile setup
    $this->addLoyaltyPoints($guest_id, $guest_name);

     session()->flash('showwelcome');

    return redirect('/guestdashboard');
}

public function guestlogout(){
      Auth::guard('guest')->logout();

      return redirect('/loginguest');


}



public function guestlogin(Request $request)
{
    $form = $request->validate([
        'guest_email' => 'required|email',
        'guest_password' => 'required',
        'g-recaptcha-response' => 'required', // Captcha
    ]);

      // --- Verify reCAPTCHA token with Google ---
    $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret'   => config('services.recaptcha.secret'),
        'response' => $form['g-recaptcha-response'],
    ]);

    $captcha = $response->json();

    if (!($captcha['success'] ?? false)) {
        return back()->withErrors([
            'g-recaptcha-response' => 'Please verify that you are not a robot.',
        ]);
    }

    // --- Login attempt cooldown ---
    $loginAttemptsKey = "guest_login_attempts_{$form['guest_email']}";
    $attemptData = Session::get($loginAttemptsKey);

    if ($attemptData && $attemptData['count'] >= self::MAX_LOGIN_ATTEMPTS) {
        $lastAttempt = $attemptData['last'];
        $remaining = self::COOLDOWN_SECONDS - (time() - $lastAttempt);

        if ($remaining > 0) {
            $minutes = ceil($remaining / 60);
            return back()->with('loginError', "Your account is temporarily locked. Try again in $minutes minute(s).");
        } else {
            Session::forget($loginAttemptsKey);
        }
    }

    // --- Attempt login ---
    if (Auth::guard('guest')->attempt([
        'guest_email' => $form['guest_email'],
        'password' => $form['guest_password']
    ])) {
        // Clear failed attempts
        Session::forget($loginAttemptsKey);

        $guest = Auth::guard('guest')->user();

         if($guest->guest_status == 'Suspended'){
        return back()->withErrors([
            'guest_status' => 'Account is Suspended',
        ]);
    }

        // Generate OTP
        $otp = rand(100000, 999999);
        Session::put('guest_otp', $otp);
        Session::put('guest_otp_expiry', now()->addMinutes(5)->timestamp);
        Session::put('pending_guest_id', $guest->guestID);
        Session::put('pending_guest_email', $guest->guest_email);

        // Send OTP
        $this->sendOtpMail($guest->guest_email, $guest->name ?? $guest->guest_email, $otp);

        return redirect('/guestloginotp')->with('status', 'We sent a 6-digit OTP to your email.');
    }

    // --- Wrong credentials → increment attempts ---
    $attemptData = $attemptData ?? ['count' => 0, 'last' => time()];
    $attemptData['count']++;
    $attemptData['last'] = time();
    Session::put($loginAttemptsKey, $attemptData);

    return back()->withErrors([
        'guest_email' => 'Invalid email or password.',
    ])->onlyInput('guest_email');
}

public function verifyGuestOTP(Request $request)
{
    $otpInput = implode('', $request->only(['otp1','otp2','otp3','otp4','otp5','otp6']));

    // 🔹 Check correct session keys
    if (!Session::has('guest_otp') || !Session::has('guest_otp_expiry') || !Session::has('pending_guest_id')) {
        return redirect('/loginguest')->with('loginError', 'No pending OTP found. Please login again.');
    }

    // 🔹 Expiry check
    if (time() > Session::get('guest_otp_expiry')) {
        Session::forget(['guest_otp','guest_otp_expiry','pending_guest_id','pending_guest_email','guest_otp_attempts']);
        return redirect('/loginguest')->with('loginError', 'OTP expired. Please login again.');
    }

    $storedOtp = (string) Session::get('guest_otp');
    $guestId   = Session::get('pending_guest_id');

    if ($otpInput === $storedOtp && $otpInput !== '') {
        // ✅ Success
        $guest = Guest::where('guestID', $guestId)->first();
        Session::forget(['guest_otp','guest_otp_expiry','guest_otp_attempts']);

        if ($guest) {
            Auth::guard('guest')->login($guest);
            $request->session()->regenerate();
            Session::forget(['pending_guest_id','pending_guest_email']);
            session()->flash('showwelcome');
            return redirect('/guestdashboard')->with('success', 'OTP Verified!');
        }

        return redirect('/loginguest')->with('loginError', 'Guest not found.');
    }

    // ❌ Wrong OTP
    $attempts = Session::get('guest_otp_attempts', 0) + 1;
    Session::put('guest_otp_attempts', $attempts);

    if ($attempts >= self::MAX_OTP_ATTEMPTS) {
        Session::forget(['pending_guest_id','pending_guest_email','guest_otp','guest_otp_expiry','guest_otp_attempts']);
        return redirect('/loginguest')->with('loginError', 'Too many incorrect OTP attempts. Please try again later.');
    }

    return back()->with('loginError', "Incorrect OTP. Attempt {$attempts} of " . self::MAX_OTP_ATTEMPTS . ".");
}

public function resendGuestOtp(Request $request)
{
    $email = Session::get('pending_guest_email');

    if (!$email) {
        return response()->json([
            'success' => false,
            'message' => 'No pending guest email found. Please login again.'
        ]);
    }

    // Generate new OTP
    $otp = rand(100000, 999999);
    Session::put('guest_otp', $otp);
    Session::put('guest_otp_expiry', now()->addMinutes(5)->timestamp);

    $guest = Guest::where('guest_email', $email)->first();

    if (!$guest || !$this->sendOtpMail($guest->guest_email, $guest->guest_name ?? $guest->guest_email, $otp)) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to send OTP'
        ]);
    }

    return response()->json([
        'success' => true,
        'message' => 'A new OTP has been sent to your email!'
    ]);
}



   public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Check if guest exists
        $guest = Guest::where('guest_email', $googleUser->getEmail())->first();

        if(!$guest){
            $guest = Guest::create([
                'guest_name' => $googleUser->getName(),
                'guest_email' => $googleUser->getEmail(),
                'guest_photo' => $googleUser->getAvatar(),
                'guest_password' => Hash::make(str()->random(16)), // random password
            ]);

            $this->addLoyaltyPoints($guest->guestID, $guest->guest_name);
        }

    if($guest->guest_status === 'Suspended'){
        return redirect('/loginguest')->withErrors([
            'guest_status' => 'Account has been suspended.'
        ]);
    }

        Auth::guard('guest')->login($guest);

        session()->flash('showwelcome');

        return redirect('/guestdashboard');
    }

     public function updateguest(Request $request, Guest $guestID)
    {
       

        // ✅ Validate the inputs
        $validated = $request->validate([
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required',
            'guest_mobile' => 'required|string|max:20',
            'guest_birthday' => 'required|date',
            'guest_address' => 'required|string|max:500',
            'guest_photo' => 'nullable',
            'guest_password' => 'nullable|confirmed',
        ]);

        // ✅ Handle profile photo upload if present
        if ($request->hasFile('guest_photo')) {
            $photo = $request->file('guest_photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('uploads/guest_photos'), $photoName);
            $validated['guest_photo'] = 'uploads/guest_photos/' . $photoName;
        }

        // ✅ Handle password update if filled
        if (!empty($validated['guest_password'])) {
            $validated['guest_password'] = Hash::make($validated['guest_password']);
        } else {
            unset($validated['guest_password']); // don't overwrite with null
        }

        // ✅ Update guest info
         $guestID->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

public function updateadmin(Request $request)
{
      /** @var \App\Models\DeptAccount $user */
    $user = Auth::user();

    // ✅ Validate incoming data
    $validated = $request->validate([
        'dept_name' => 'required|string|max:255',
        'employee_name' => 'required|string|max:255',
        'role' => 'nullable|string|max:255',
        'adminphoto' => 'nullable',
        'password' => 'nullable|confirmed',
        'email' => 'nullable',
        'status' => 'nullable',
        'employee_id' => 'nullable',
    ]);

    // ✅ Protect role & dept name (not editable by user)
    unset($validated['dept_name'], $validated['role'], $validated['status'], $validated['employee_id']);

    // ✅ Update employee name
    $user->employee_name = $validated['employee_name'];

      if (!empty($validated['email'])) {
        $user->email = $validated['email'];
    }

    // ✅ Hash and update password if provided
    if (!empty($validated['password'])) {
        $user->password = $validated['password']; // plaintext
    }

    // ✅ Save updated info
    $user->save();

    // ✅ Handle photo upload (manual method)
    if ($request->hasFile('adminphoto')) {
        $photo = $request->file('adminphoto');
        $photoName = time() . '_' . $photo->getClientOriginalName();

        // Create uploads folder if it doesn't exist
        $destinationPath = public_path('uploads/admin_photos');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // Move the uploaded photo
        $photo->move($destinationPath, $photoName);

        // Save the photo path to DB
        additionalinfoadmin::updateOrCreate(
            ['Dept_no' => $user->Dept_no],
            ['adminphoto' => 'uploads/admin_photos/' . $photoName]
        );
    }

            $message = 'Profile updated successfully!';
        if (!empty($validated['password'])) {
            $message = 'Profile and password updated successfully!';
        }

        return back()->with('success', $message);

    
}



public function employeeProfile(DeptAccount $Dept_no)
{
    $deptAccount = $Dept_no;

    if (!Auth::check()) {
        return redirect('/restrictedemployee')->send();
    }

    if(Auth::user()->role !== 'Hotel Admin'){
        return redirect('/restrictedemployee')->send();
    }

    // Fetch audit trails and login logs with pagination
    $auditTrails = AuditTrails::where('employee_id', $deptAccount->employee_id)
        ->orderBy('date', 'desc')
        ->paginate(10, ['*'], 'audit_page');

    $loginLogs = DeptLogs::where('employee_id', $deptAccount->employee_id)
        ->orderBy('date', 'desc')
        ->paginate(10, ['*'], 'logs_page');

    return view('admin.deptprofiles', compact('deptAccount', 'auditTrails', 'loginLogs'));
}

public function suspendGuest(Guest $guestID){
    $guestID->update([
        'guest_status' => 'Suspended'
    ]);

    $guests = $guestID;

    $mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = env('MAIL_HOST');
    $mail->SMTPAuth   = true;
    $mail->Username   = env('MAIL_USERNAME');
    $mail->Password   = env('MAIL_PASSWORD');
    $mail->SMTPSecure = env('MAIL_ENCRYPTION'); // tls or ssl
    $mail->Port       = env('MAIL_PORT');

    $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
    $mail->addAddress($guests->guest_email, $guests->guest_name);
    $mail->addEmbeddedImage(public_path('images/logo/sonly.png'), 'hotelLogo');
    $mail->isHTML(true);
    $mail->Subject = "Account Suspended - Soliera Hotel";

    $mailBody = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Account Suspended - Soliera Hotel</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f4f4;">
<div style="max-width:600px; margin:0 auto; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">

<!-- Header -->
<div style="background-color:#001f54; padding:30px 20px; text-align:center;">
    <img src="cid:hotelLogo" alt="Soliera Hotel Logo" style="width:80px; height:80px; border-radius:50%; margin-bottom:15px;">
    <h1 style="color:#F7B32B; margin:0; font-size:28px; font-weight:bold;">SOLIERA HOTEL</h1>
    <p style="color:#ffffff; margin:10px 0 0 0; font-size:16px;">Savor The Stay, Dine With Elegance</p>
</div>

<!-- Account Status -->
<div style="padding:20px; text-align:center; background-color:#fff3cd;">
    <div style="display:inline-block; background-color:#dc3545; color:#ffffff; padding:10px 24px; border-radius:20px; font-weight:bold; font-size:14px; margin-bottom:10px;">
        ⚠️ ACCOUNT STATUS: SUSPENDED
    </div>
</div>

<!-- Main Content -->
<div style="padding:30px 20px;">
    <h2 style="color:#001f54; margin:0 0 20px 0; font-size:24px; text-align:center;">Account Suspended</h2>
    
    <!-- Guest Info -->
    <div style="text-align:center; margin-bottom:25px;">
        <p style="color:#666; font-size:16px; margin:0 0 5px 0;">
            Dear <span style="color:#001f54; font-weight:bold;">$guests->guest_name</span>,
        </p>
        <p style="color:#666; font-size:14px; margin:0;">
            Account Email: <span style="color:#001f54; font-weight:bold;">$guests->guest_email</span>
        </p>
    </div>

    <!-- Notification Box -->
    <div style="padding:25px; background-color:#fff3cd; border-left:4px solid #ffc107; border-radius:8px; margin-bottom:25px;">
        <p style="color:#856404; margin:0 0 15px 0; line-height:1.6; font-size:15px;">
            We are writing to inform you that your guest account with Soliera Hotel has been temporarily suspended.
        </p>
        <p style="color:#856404; margin:0; line-height:1.6; font-size:15px;">
            During this suspension period, you will not be able to:
        </p>
        <ul style="color:#856404; margin:10px 0 0 20px; line-height:1.8; font-size:14px;">
            <li>Access your account</li>
            <li>Make new reservations</li>
            <li>View booking history</li>
        </ul>
    </div>

    <!-- Contact Information -->
    <div style="text-align:center; padding:25px; background-color:#001f54; border-radius:8px;">
        <h3 style="color:#F7B32B; margin:0 0 15px 0; font-size:18px;">Need Assistance?</h3>
        <p style="color:#ffffff; margin:0 0 15px 0; line-height:1.6; font-size:14px;">
            If you believe this suspension was made in error or if you have any questions,<br>
            please contact our support team immediately.
        </p>
        <div style="margin-top:15px;">
            <p style="color:#F7B32B; margin:0; font-size:14px; font-weight:bold;">
                📧 Email: support@solierahotel.com
            </p>
            <p style="color:#F7B32B; margin:5px 0 0 0; font-size:14px; font-weight:bold;">
                📞 Phone: +63 XXX XXX XXXX
            </p>
        </div>
    </div>
</div>

<!-- Footer -->
<div style="background-color:#001f54; padding:20px; text-align:center;">
    <p style="color:#F7B32B; margin:0 0 5px 0; font-size:14px;">© 2025 Soliera Hotel. All rights reserved.</p>
    <p style="color:#ffffff; margin:0; font-size:12px; opacity:0.8;">This is an automated message. Please do not reply to this email.</p>
</div>
</div>
</body>
</html>
HTML;

    $mail->Body = $mailBody;
    $mail->send();

} catch (Exception $e) {
    Log::error("Guest suspension email could not be sent: {$mail->ErrorInfo}");
}

return redirect()->back()->with('success', 'Guest Account Has Been Suspended');

}

public function unsuspendGuest(Guest $guestID){
 $guestID->update([
        'guest_status' => 'Verified'
    ]);

    $guests = $guestID;

    // ==========================================
// UNSUSPEND EMAIL
// ==========================================
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = env('MAIL_HOST');
    $mail->SMTPAuth   = true;
    $mail->Username   = env('MAIL_USERNAME');
    $mail->Password   = env('MAIL_PASSWORD');
    $mail->SMTPSecure = env('MAIL_ENCRYPTION');
    $mail->Port       = env('MAIL_PORT');

    $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
    $mail->addAddress($guests->guest_email, $guests->guest_name);
    $mail->addEmbeddedImage(public_path('images/logo/sonly.png'), 'hotelLogo');
    $mail->isHTML(true);
    $mail->Subject = "Account Unsuspended - Welcome Back to Soliera Hotel";

    $mailBody = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Account Unsuspended - Soliera Hotel</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f4f4;">
<div style="max-width:600px; margin:0 auto; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">

<!-- Header -->
<div style="background-color:#001f54; padding:30px 20px; text-align:center;">
    <img src="cid:hotelLogo" alt="Soliera Hotel Logo" style="width:80px; height:80px; border-radius:50%; margin-bottom:15px;">
    <h1 style="color:#F7B32B; margin:0; font-size:28px; font-weight:bold;">SOLIERA HOTEL</h1>
    <p style="color:#ffffff; margin:10px 0 0 0; font-size:16px;">Savor The Stay, Dine With Elegance</p>
</div>

<!-- Account Status -->
<div style="padding:20px; text-align:center; background-color:#d1e7dd;">
    <div style="display:inline-block; background-color:#28a745; color:#ffffff; padding:10px 24px; border-radius:20px; font-weight:bold; font-size:14px; margin-bottom:10px;">
        ✅ ACCOUNT STATUS: UNSUSPENDED
    </div>
</div>

<!-- Main Content -->
<div style="padding:30px 20px;">
    <h2 style="color:#001f54; margin:0 0 20px 0; font-size:24px; text-align:center;">Account Unsuspended</h2>
    
    <!-- Guest Info -->
    <div style="text-align:center; margin-bottom:25px;">
        <p style="color:#666; font-size:16px; margin:0 0 5px 0;">
            Dear <span style="color:#001f54; font-weight:bold;">$guests->guest_name</span>,
        </p>
        <p style="color:#666; font-size:14px; margin:0;">
            Account Email: <span style="color:#001f54; font-weight:bold;">$guests->guest_email</span>
        </p>
    </div>

    <!-- Success Box -->
    <div style="padding:25px; background-color:#d1e7dd; border-left:4px solid #28a745; border-radius:8px; margin-bottom:25px;">
        <p style="color:#0f5132; margin:0 0 15px 0; line-height:1.6; font-size:15px; font-weight:bold;">
            🎉 Great News! Your account suspension has been lifted.
        </p>
        <p style="color:#0f5132; margin:0; line-height:1.6; font-size:15px;">
            You now have full access to all features and can:
        </p>
        <ul style="color:#0f5132; margin:10px 0 0 20px; line-height:1.8; font-size:14px;">
            <li>Log in to your account</li>
            <li>Make new reservations</li>
            <li>View and manage your bookings</li>
            <li>Access all guest services</li>
        </ul>
    </div>

    <!-- Call to Action -->
    <div style="text-align:center; padding:25px; background-color:#001f54; border-radius:8px;">
        <h3 style="color:#F7B32B; margin:0 0 15px 0; font-size:18px;">Ready to Book Your Next Stay?</h3>
        <p style="color:#ffffff; margin:0 0 20px 0; line-height:1.6; font-size:14px;">
            We're delighted to have you back! Explore our exclusive offers<br>
            and experience the comfort and elegance of Soliera Hotel.
        </p>
        <a href="#" style="display:inline-block; background-color:#F7B32B; color:#001f54; padding:12px 30px; text-decoration:none; border-radius:25px; font-weight:bold; font-size:14px;">
            Book Now
        </a>
    </div>

    <!-- Support -->
    <div style="text-align:center; margin-top:25px; padding:20px; background-color:#f8f9fa; border-radius:8px;">
        <p style="color:#666; margin:0 0 10px 0; font-size:14px;">
            Have questions? Our support team is here to help!
        </p>
        <p style="color:#001f54; margin:0; font-size:14px; font-weight:bold;">
            📧 support@solierahotel.com | 📞 +63 XXX XXX XXXX
        </p>
    </div>
</div>

<!-- Footer -->
<div style="background-color:#001f54; padding:20px; text-align:center;">
    <p style="color:#F7B32B; margin:0 0 5px 0; font-size:14px;">© 2025 Soliera Hotel. All rights reserved.</p>
    <p style="color:#ffffff; margin:0; font-size:12px; opacity:0.8;">This is an automated message. Please do not reply to this email.</p>
</div>
</div>
</body>
</html>
HTML;

    $mail->Body = $mailBody;
    $mail->send();

} catch (Exception $e) {
    Log::error("Guest unsuspend email could not be sent: {$mail->ErrorInfo}");
}

return redirect()->back()->with('success', 'Guest Account Has Been Unsuspended');

}




public function removeGuest(Guest $guestID){
    $guestID->delete();

    $guests = $guestID;
    guestloyaltypoints::where('guestID', $guests->guestID)->delete();
    
    $mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = env('MAIL_HOST');
    $mail->SMTPAuth   = true;
    $mail->Username   = env('MAIL_USERNAME');
    $mail->Password   = env('MAIL_PASSWORD');
    $mail->SMTPSecure = env('MAIL_ENCRYPTION');
    $mail->Port       = env('MAIL_PORT');

    $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
    $mail->addAddress($guests->guest_email, $guests->guest_name);
    $mail->addEmbeddedImage(public_path('images/logo/sonly.png'), 'hotelLogo');
    $mail->isHTML(true);
    $mail->Subject = "Account Removed - Soliera Hotel";

    $mailBody = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Account Removed - Soliera Hotel</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f4f4;">
<div style="max-width:600px; margin:0 auto; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">

<!-- Header -->
<div style="background-color:#001f54; padding:30px 20px; text-align:center;">
    <img src="cid:hotelLogo" alt="Soliera Hotel Logo" style="width:80px; height:80px; border-radius:50%; margin-bottom:15px;">
    <h1 style="color:#F7B32B; margin:0; font-size:28px; font-weight:bold;">SOLIERA HOTEL</h1>
    <p style="color:#ffffff; margin:10px 0 0 0; font-size:16px;">Savor The Stay, Dine With Elegance</p>
</div>

<!-- Account Status -->
<div style="padding:20px; text-align:center; background-color:#f8d7da;">
    <div style="display:inline-block; background-color:#dc3545; color:#ffffff; padding:10px 24px; border-radius:20px; font-weight:bold; font-size:14px; margin-bottom:10px;">
        🗑️ ACCOUNT STATUS: REMOVED
    </div>
</div>

<!-- Main Content -->
<div style="padding:30px 20px;">
    <h2 style="color:#001f54; margin:0 0 20px 0; font-size:24px; text-align:center;">Account Removed</h2>
    
    <!-- Guest Info -->
    <div style="text-align:center; margin-bottom:25px;">
        <p style="color:#666; font-size:16px; margin:0 0 5px 0;">
            Dear <span style="color:#001f54; font-weight:bold;">$guests->guest_name</span>,
        </p>
        <p style="color:#666; font-size:14px; margin:0;">
            Previous Account Email: <span style="color:#001f54; font-weight:bold;">$guests->guest_email</span>
        </p>
    </div>

    <!-- Warning Box -->
    <div style="padding:25px; background-color:#f8d7da; border-left:4px solid #dc3545; border-radius:8px; margin-bottom:25px;">
        <p style="color:#721c24; margin:0 0 15px 0; line-height:1.6; font-size:15px; font-weight:bold;">
            ⚠️ Your guest account has been permanently removed from our system.
        </p>
        <p style="color:#721c24; margin:0 0 10px 0; line-height:1.6; font-size:15px;">
            This means:
        </p>
        <ul style="color:#721c24; margin:10px 0 0 20px; line-height:1.8; font-size:14px;">
            <li>All your account data has been deleted</li>
            <li>You can no longer access this account</li>
            <li>Your booking history is no longer available</li>
            <li>This action cannot be undone</li>
        </ul>
    </div>

    <!-- Farewell Message -->
    <div style="text-align:center; padding:25px; background-color:#001f54; border-radius:8px; margin-bottom:20px;">
        <h3 style="color:#F7B32B; margin:0 0 15px 0; font-size:18px;">Thank You</h3>
        <p style="color:#ffffff; margin:0; line-height:1.6; font-size:14px;">
            We appreciate the time you spent with us at Soliera Hotel.<br>
            Should you wish to return in the future, you're always welcome to create a new account.
        </p>
    </div>

    <!-- Contact Information -->
    <div style="text-align:center; padding:20px; background-color:#f8f9fa; border-radius:8px;">
        <p style="color:#666; margin:0 0 10px 0; font-size:14px;">
            If you believe this was done in error, please contact us immediately:
        </p>
        <p style="color:#001f54; margin:0; font-size:14px; font-weight:bold;">
            📧 support@solierahotel.com | 📞 +63 XXX XXX XXXX
        </p>
    </div>
</div>

<!-- Footer -->
<div style="background-color:#001f54; padding:20px; text-align:center;">
    <p style="color:#F7B32B; margin:0 0 5px 0; font-size:14px;">© 2025 Soliera Hotel. All rights reserved.</p>
    <p style="color:#ffffff; margin:0; font-size:12px; opacity:0.8;">This is an automated message. Please do not reply to this email.</p>
</div>
</div>
</body>
</html>
HTML;

    $mail->Body = $mailBody;
    $mail->send();

} catch (Exception $e) {
    Log::error("Guest removal email could not be sent: {$mail->ErrorInfo}");
}

return redirect()->back()->with('success', 'Guest Account Has Been Removed');
}
}