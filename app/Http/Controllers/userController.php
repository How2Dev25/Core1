<?php

namespace App\Http\Controllers;

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

class userController extends Controller
{

     const MAX_OTP_ATTEMPTS = 3;         
    const MAX_LOGIN_ATTEMPTS = 5;        
    const COOLDOWN_SECONDS = 300;        

    
 public function login(Request $request)
{
    $form = $request->validate([
        'employee_id' => 'required',
        'password' => 'required',
    ]);

    $user = DeptAccount::where('employee_id', $form['employee_id'])->first();

    // --- Login attempt cooldown ---
    $loginAttemptsKey = "login_attempts_{$form['employee_id']}";
    $attemptData = Session::get($loginAttemptsKey);

    if ($attemptData && $attemptData['count'] >= self::MAX_LOGIN_ATTEMPTS) {
        $lastAttempt = $attemptData['last'];
        $remaining = self::COOLDOWN_SECONDS - (time() - $lastAttempt);

        if ($remaining > 0) {
            $minutes = ceil($remaining / 60);
            return back()->with('loginError', "Your account is temporarily banned. Try again in $minutes minute(s).");
        } else {
            Session::forget($loginAttemptsKey);
        }
    }

    // --- Validate password (securely) ---
    if ($user && $user->password === $form['password']) {
        // Generate OTP
        $otp = rand(100000, 999999);

        Session::put('otp', $otp);
        Session::put('otp_expiry', Carbon::now()->addMinutes(5)->timestamp);
        Session::put('pending_employee_id', $user->employee_id);
        Session::put('pending_email', $user->email);

        // Send OTP Email
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
        $otpInput = implode('', $request->only(['otp1','otp2','otp3','otp4','otp5','otp6']));

        if (!Session::has('otp') || !Session::has('otp_expiry') || !Session::has('pending_employee_id')) {
            return redirect('/employeelogin')->with('loginError', 'No pending OTP found. Please login again.');
        }

        // OTP expired
        if (time() > Session::get('otp_expiry')) {
            Session::forget(['otp','otp_expiry','pending_employee_id','pending_role','pending_Dept_id','pending_email','otp_attempts']);
            return redirect('/employeelogin')->with('loginError', 'OTP expired. Please login again.');
        }

        $storedOtp = (string) Session::get('otp');
        $employeeId = Session::get('pending_employee_id');

        if ($otpInput === $storedOtp && $otpInput !== '') {
            // ✅ Success
            $user = DeptAccount::where('employee_id', $employeeId)->first();
            Session::forget(['otp','otp_expiry','otp_attempts','pending_employee_id','pending_role','pending_Dept_id','pending_email']);

            if ($user) {
                Auth::login($user);
                $request->session()->regenerate();
                return redirect('/employeedashboard')->with('success', 'OTP Verified!');
            }

            return redirect('/employeelogin')->with('loginError', 'User not found.');
        }

        // ❌ Wrong OTP
        $attempts = Session::get('otp_attempts', 0) + 1;
        Session::put('otp_attempts', $attempts);

        if ($attempts >= self::MAX_OTP_ATTEMPTS) {
            Session::forget(['pending_employee_id','pending_role','pending_Dept_id','pending_email','otp','otp_expiry']);
            return redirect('/employeelogin')->with('loginError', 'Too many incorrect OTP attempts. Please try again later.');
        }

       return back()->with('loginError', "Incorrect OTP. Attempt {$attempts} of " . self::MAX_OTP_ATTEMPTS . ".");
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

        // Embedded Logo
        $logoPath = public_path('images/logo/sonly.png');
        if (file_exists($logoPath)) {
            $mail->addEmbeddedImage($logoPath, 'hotelLogo');
        }

        $mail->isHTML(true);
        $mail->Subject = "Your One-Time Password (OTP)";

        // Email Body
        $mailBody = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>OTP Verification</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f4f4;">
    <div style="max-width:600px; margin:0 auto; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">

        <!-- Header -->
        <div style="background-color:#001f54; padding:20px; text-align:center;">
            <img src="cid:hotelLogo" alt="Hotel Logo" style="width:70px; height:70px; border-radius:50%; margin-bottom:10px;">
            <h2 style="color:#F7B32B; margin:0;">SOLIERA HOTEL</h2>
        </div>

        <!-- OTP Content -->
        <div style="padding:30px; text-align:center;">
            <h3 style="color:#001f54; margin-bottom:15px;">Your OTP Code</h3>
            <p style="font-size:18px; color:#333;">Please use the following code to verify your login:</p>
            <div style="font-size:28px; font-weight:bold; color:#F7B32B; margin:20px 0;">$otp</div>
            <p style="color:#555; font-size:14px;">This code will expire in 5 minutes. Do not share it with anyone.</p>
        </div>

        <!-- Footer -->
        <div style="background-color:#001f54; padding:15px; text-align:center;">
            <p style="color:#F7B32B; margin:0; font-size:13px;">© 2025 Soliera Hotel. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
HTML;

        $mail->Body = $mailBody;

        $mail->send();
        return true;
    } catch (Exception $e) {
        Log::error("OTP Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}



public function logout(Request $request)
{
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
    ]);

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
        } else {
            // Optional: update avatar/name if changed
            $guest->update([
                'guest_name' => $googleUser->getName(),
                'guest_photo' => $googleUser->getAvatar(),
            ]);
        }

        Auth::guard('guest')->login($guest);

        session()->flash('showwelcome');

        return redirect('/guestdashboard');
    }

}


