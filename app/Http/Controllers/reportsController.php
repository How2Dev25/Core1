<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\DeptAccount; // Add this

class reportsController extends Controller
{
    /**
     * Send OTP for booking report access
     */
    public function sendBookingReportOTP(Request $request)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated.'
                ], 401);
            }
            
            $email = $user->email;
            
            if (!$email) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email address is required.'
                ], 400);
            }

            // Get the actual DeptAccount model instance
            $deptAccount = DeptAccount::where('email', $email)->first();
            
            // Check if account is locked
            if ($deptAccount && $deptAccount->isLocked()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your account is locked. Please contact administrator.'
                ], 403);
            }

            // Generate 6-digit OTP
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            // Store OTP in cache
            Cache::put('booking_report_otp_' . $email, [
                'code' => $otp,
                'created_at' => now(),
                'attempts' => 0
            ], now()->addMinutes(10));
            
            Cache::put('booking_report_attempts_' . $email, 0, now()->addMinutes(30));

            // Send OTP email
            $emailSent = $this->sendBookingReportOTPEmail($email, $otp);

            if (!$emailSent) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send OTP email. Please try again.'
                ], 500);
            }

            Log::info('Booking Report OTP Generated', [
                'email' => $email,
                'otp' => $otp
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Verification code sent successfully to your email.',
                'email' => $this->maskEmail($email),
                'expires_in' => 600
            ]);

        } catch (\Exception $e) {
            Log::error('Booking Report OTP Send Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while sending verification code.'
            ], 500);
        }
    }

    /**
     * Verify OTP for booking report access
     */
    public function verifyBookingReportOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
            'email' => 'required|email'
        ]);

        try {
            $email = $request->email;
            
            // Get the actual DeptAccount model instance
            $deptAccount = DeptAccount::where('email', $email)->first();
            
            $cachedData = Cache::get('booking_report_otp_' . $email);
            $attempts = Cache::get('booking_report_attempts_' . $email, 0);

            if ($attempts >= 5) {
                // Lock account if deptAccount exists
                if ($deptAccount) {
                    $deptAccount->lockAccount(); // Use lockAccount() method
                }
                
                return response()->json([
                    'success' => false,
                    'message' => 'Too many failed attempts. Your account has been locked.',
                    'code' => 'MAX_ATTEMPTS_EXCEEDED'
                ], 429);
            }

            if (!$cachedData) {
                return response()->json([
                    'success' => false,
                    'message' => 'Verification code has expired. Please request a new one.',
                    'code' => 'OTP_EXPIRED'
                ], 400);
            }

            if ($cachedData['code'] === $request->otp) {
                $createdAt = Carbon::parse($cachedData['created_at']);
                if ($createdAt->diffInMinutes(now()) > 10) {
                    Cache::forget('booking_report_otp_' . $email);
                    return response()->json([
                        'success' => false,
                        'message' => 'Verification code has expired. Please request a new one.',
                        'code' => 'OTP_EXPIRED'
                    ], 400);
                }

                // Clear OTP and reset attempts
                Cache::forget('booking_report_otp_' . $email);
                Cache::forget('booking_report_attempts_' . $email);
                
                // Reset failed attempts for user
                if ($deptAccount) {
                    $deptAccount->resetOtpFailedAttempts(); // This now exists
                }
                
                // Store verification in session
                session(['booking_report_verified_' . $email => true]);

                Log::info('Booking Report OTP Verified Successfully', [
                    'email' => $email,
                    'ip' => $request->ip()
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Verification successful!',
                    'verified' => true
                ]);
            } else {
                // Increment attempts
                $newAttempts = $attempts + 1;
                Cache::put('booking_report_attempts_' . $email, $newAttempts, now()->addMinutes(30));
                
                // Update attempts in OTP data
                if ($cachedData) {
                    $cachedData['attempts'] = $newAttempts;
                    Cache::put('booking_report_otp_' . $email, $cachedData, now()->addMinutes(10));
                }
                
                // Increment user failed attempts
                if ($deptAccount) {
                    $deptAccount->incrementOtpFailedAttempts(); // This now exists
                }

                $remainingAttempts = 5 - $newAttempts;
                
                return response()->json([
                    'success' => false,
                    'message' => "Invalid verification code. {$remainingAttempts} attempts remaining.",
                    'remaining_attempts' => $remainingAttempts,
                    'code' => 'INVALID_OTP'
                ], 400);
            }

        } catch (\Exception $e) {
            Log::error('Booking Report OTP Verify Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while verifying the code.'
            ], 500);
        }
    }

    /**
     * Resend OTP for booking report
     */
    public function resendBookingReportOTP(Request $request)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated.'
                ], 401);
            }
            
            $email = $user->email;
            
            if (!$email) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email address is required.'
                ], 400);
            }

            // Rate limiting
            $lastSent = Cache::get('booking_report_last_sent_' . $email);
            if ($lastSent && Carbon::parse($lastSent)->diffInSeconds(now()) < 30) {
                $waitTime = 30 - Carbon::parse($lastSent)->diffInSeconds(now());
                return response()->json([
                    'success' => false,
                    'message' => "Please wait {$waitTime} seconds before requesting a new code.",
                    'wait_time' => $waitTime
                ], 429);
            }

            // Generate new OTP
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            Cache::put('booking_report_otp_' . $email, [
                'code' => $otp,
                'created_at' => now(),
                'attempts' => 0
            ], now()->addMinutes(10));
            
            Cache::put('booking_report_attempts_' . $email, 0, now()->addMinutes(30));
            Cache::put('booking_report_last_sent_' . $email, now(), now()->addSeconds(30));

            $emailSent = $this->sendBookingReportOTPEmail($email, $otp, true);

            if (!$emailSent) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to resend verification code.'
                ], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'New verification code sent successfully.',
                'email' => $this->maskEmail($email),
                'expires_in' => 600
            ]);

        } catch (\Exception $e) {
            Log::error('Booking Report OTP Resend Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while resending the code.'
            ], 500);
        }
    }

    /**
     * Send OTP email
     */
    private function sendBookingReportOTPEmail($email, $otp, $isResend = false)
    {
        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail->Host       = env('MAIL_HOST');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->Port       = env('MAIL_PORT');
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($email);
            
            $logoPath = public_path('images/logo/sonly.png');
            if (file_exists($logoPath)) {
                $mail->addEmbeddedImage($logoPath, 'hotelLogo');
            }

            $mail->isHTML(true);
            $mail->Subject = $isResend ? 
                'New Verification Code - Booking Report Access - Soliera Hotel' : 
                'Booking Report Access - Verification Code - Soliera Hotel';
            
            $mail->Body = $this->generateOTPEmailBody($otp, $email, $isResend);
            $mail->AltBody = "Your verification code is: {$otp}. Valid for 10 minutes.";

            $mail->send();
            return true;

        } catch (Exception $e) {
            Log::error("Booking Report OTP Email Error: " . $mail->ErrorInfo);
            return false;
        }
    }

    /**
     * Generate OTP email body
     */
    private function generateOTPEmailBody($otp, $email, $isResend = false)
    {
        $action = $isResend ? 'New Verification Code' : 'Verify Your Access';
        $message = $isResend ? 
            'You requested a new verification code for the booking report.' : 
            'Use the verification code below to access the booking report.';

        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Report Verification - Soliera Hotel</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f7fc;">
    <div style="max-width:600px; margin:20px auto; background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 5px 15px rgba(0,31,84,0.15);">
        <div style="background:#001f54; padding:30px; text-align:center;">
            <img src="cid:hotelLogo" alt="Soliera Hotel" style="width:80px; height:80px; border-radius:50%; border:3px solid #F7B32B; margin-bottom:10px;">
            <h1 style="color:#F7B32B; margin:0; font-size:28px;">SOLIERA HOTEL</h1>
            <p style="color:#ffffff; margin:5px 0 0 0;">Booking Report Access</p>
        </div>
        <div style="padding:30px;">
            <div style="text-align:center; margin-bottom:25px;">
                <span style="background:#F7B32B; color:#001f54; padding:8px 20px; border-radius:20px; font-weight:bold;">🔐 {$action}</span>
            </div>
            <p style="color:#666; font-size:16px; text-align:center;">{$message}</p>
            <div style="background:#f8fafd; border:2px dashed #001f54; border-radius:10px; padding:20px; margin:25px 0; text-align:center;">
                <div style="font-size:14px; color:#001f54; margin-bottom:10px;">VERIFICATION CODE</div>
                <div style="font-family:'Courier New', monospace; font-size:48px; font-weight:bold; color:#001f54; letter-spacing:10px;">{$otp}</div>
                <div style="margin-top:15px; color:#666; font-size:14px;">Valid for 10 minutes</div>
            </div>
            <div style="background:#fff5e0; border-left:4px solid #F7B32B; padding:15px; margin:20px 0;">
                <p style="margin:0; color:#856404; font-size:13px;">
                    <strong>⚠️ Security Notice:</strong> Never share this code. Soliera Hotel staff will never ask for it.
                </p>
            </div>
            <div style="text-align:center; color:#666; font-size:12px; margin-top:20px;">
                <p>Requested for: {$this->maskEmail($email)}</p>
            </div>
        </div>
        <div style="background:#001f54; padding:20px; text-align:center;">
            <p style="color:#F7B32B; margin:0; font-size:14px;">© 2026 Soliera Hotel & Restaurant</p>
            <p style="color:#ffffff; margin:5px 0 0 0; font-size:11px;">This is an automated message.</p>
        </div>
    </div>
</body>
</html>
HTML;
    }

    /**
     * Mask email for privacy
     */
    private function maskEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        }
        $parts = explode('@', $email);
        $name = $parts[0];
        $domain = $parts[1];
        $maskedName = substr($name, 0, 2) . str_repeat('*', max(0, strlen($name) - 2));
        return $maskedName . '@' . $domain;
    }


    // events

    /**
 * Send OTP for event report access
 */
public function sendEventReportOTP(Request $request)
{
    try {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated.'
            ], 401);
        }
        
        $email = $user->email;
        
        if (!$email) {
            return response()->json([
                'success' => false,
                'message' => 'Email address is required.'
            ], 400);
        }

        // Get the actual DeptAccount model instance
        $deptAccount = DeptAccount::where('email', $email)->first();
        
        // Check if account is locked
        if ($deptAccount && $deptAccount->isLocked()) {
            return response()->json([
                'success' => false,
                'message' => 'Your account is locked. Please contact administrator.'
            ], 403);
        }

        // Generate 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Store OTP in cache with event prefix
        Cache::put('event_report_otp_' . $email, [
            'code' => $otp,
            'created_at' => now(),
            'attempts' => 0
        ], now()->addMinutes(10));
        
        Cache::put('event_report_attempts_' . $email, 0, now()->addMinutes(30));

        // Send OTP email
        $emailSent = $this->sendEventReportOTPEmail($email, $otp);

        if (!$emailSent) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP email. Please try again.'
            ], 500);
        }

        Log::info('Event Report OTP Generated', [
            'email' => $email,
            'otp' => $otp
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Verification code sent successfully to your email.',
            'email' => $this->maskEmail($email),
            'expires_in' => 600
        ]);

    } catch (\Exception $e) {
        Log::error('Event Report OTP Send Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while sending verification code.'
        ], 500);
    }
}

/**
 * Verify OTP for event report access
 */
public function verifyEventReportOTP(Request $request)
{
    $request->validate([
        'otp' => 'required|string|size:6',
        'email' => 'required|email'
    ]);

    try {
        $email = $request->email;
        
        // Get the actual DeptAccount model instance
        $deptAccount = DeptAccount::where('email', $email)->first();
        
        $cachedData = Cache::get('event_report_otp_' . $email);
        $attempts = Cache::get('event_report_attempts_' . $email, 0);

        if ($attempts >= 5) {
            // Lock account if deptAccount exists
            if ($deptAccount) {
                $deptAccount->lockAccount();
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Too many failed attempts. Your account has been locked.',
                'code' => 'MAX_ATTEMPTS_EXCEEDED'
            ], 429);
        }

        if (!$cachedData) {
            return response()->json([
                'success' => false,
                'message' => 'Verification code has expired. Please request a new one.',
                'code' => 'OTP_EXPIRED'
            ], 400);
        }

        if ($cachedData['code'] === $request->otp) {
            $createdAt = Carbon::parse($cachedData['created_at']);
            if ($createdAt->diffInMinutes(now()) > 10) {
                Cache::forget('event_report_otp_' . $email);
                return response()->json([
                    'success' => false,
                    'message' => 'Verification code has expired. Please request a new one.',
                    'code' => 'OTP_EXPIRED'
                ], 400);
            }

            // Clear OTP and reset attempts
            Cache::forget('event_report_otp_' . $email);
            Cache::forget('event_report_attempts_' . $email);
            
            // Reset failed attempts for user
            if ($deptAccount) {
                $deptAccount->resetOtpFailedAttempts();
            }
            
            // Store verification in session
            session(['event_report_verified_' . $email => true]);

            Log::info('Event Report OTP Verified Successfully', [
                'email' => $email,
                'ip' => $request->ip()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Verification successful!',
                'verified' => true
            ]);
        } else {
            // Increment attempts
            $newAttempts = $attempts + 1;
            Cache::put('event_report_attempts_' . $email, $newAttempts, now()->addMinutes(30));
            
            // Update attempts in OTP data
            if ($cachedData) {
                $cachedData['attempts'] = $newAttempts;
                Cache::put('event_report_otp_' . $email, $cachedData, now()->addMinutes(10));
            }
            
            // Increment user failed attempts
            if ($deptAccount) {
                $deptAccount->incrementOtpFailedAttempts();
            }

            $remainingAttempts = 5 - $newAttempts;
            
            return response()->json([
                'success' => false,
                'message' => "Invalid verification code. {$remainingAttempts} attempts remaining.",
                'remaining_attempts' => $remainingAttempts,
                'code' => 'INVALID_OTP'
            ], 400);
        }

    } catch (\Exception $e) {
        Log::error('Event Report OTP Verify Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while verifying the code.'
        ], 500);
    }
}

/**
 * Resend OTP for event report
 */
public function resendEventReportOTP(Request $request)
{
    try {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated.'
            ], 401);
        }
        
        $email = $user->email;
        
        if (!$email) {
            return response()->json([
                'success' => false,
                'message' => 'Email address is required.'
            ], 400);
        }

        // Rate limiting
        $lastSent = Cache::get('event_report_last_sent_' . $email);
        if ($lastSent && Carbon::parse($lastSent)->diffInSeconds(now()) < 30) {
            $waitTime = 30 - Carbon::parse($lastSent)->diffInSeconds(now());
            return response()->json([
                'success' => false,
                'message' => "Please wait {$waitTime} seconds before requesting a new code.",
                'wait_time' => $waitTime
            ], 429);
        }

        // Generate new OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        Cache::put('event_report_otp_' . $email, [
            'code' => $otp,
            'created_at' => now(),
            'attempts' => 0
        ], now()->addMinutes(10));
        
        Cache::put('event_report_attempts_' . $email, 0, now()->addMinutes(30));
        Cache::put('event_report_last_sent_' . $email, now(), now()->addSeconds(30));

        $emailSent = $this->sendEventReportOTPEmail($email, $otp, true);

        if (!$emailSent) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to resend verification code.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'New verification code sent successfully.',
            'email' => $this->maskEmail($email),
            'expires_in' => 600
        ]);

    } catch (\Exception $e) {
        Log::error('Event Report OTP Resend Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while resending the code.'
        ], 500);
    }
}

/**
 * Send Event Report OTP email
 */
private function sendEventReportOTPEmail($email, $otp, $isResend = false)
{
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host       = env('MAIL_HOST');
        $mail->SMTPAuth   = true;
        $mail->Username   = env('MAIL_USERNAME');
        $mail->Password   = env('MAIL_PASSWORD');
        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
        $mail->Port       = env('MAIL_PORT');
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $mail->addAddress($email);
        
        $logoPath = public_path('images/logo/sonly.png');
        if (file_exists($logoPath)) {
            $mail->addEmbeddedImage($logoPath, 'hotelLogo');
        }

        $mail->isHTML(true);
        $mail->Subject = $isResend ? 
            'New Verification Code - Event Report Access - Soliera Hotel' : 
            'Event Report Access - Verification Code - Soliera Hotel';
        
        $mail->Body = $this->generateEventOTPEmailBody($otp, $email, $isResend);
        $mail->AltBody = "Your verification code is: {$otp}. Valid for 10 minutes.";

        $mail->send();
        return true;

    } catch (Exception $e) {
        Log::error("Event Report OTP Email Error: " . $mail->ErrorInfo);
        return false;
    }
}

/**
 * Generate Event OTP email body
 */
private function generateEventOTPEmailBody($otp, $email, $isResend = false)
{
    $action = $isResend ? 'New Verification Code' : 'Verify Your Access';
    $message = $isResend ? 
        'You requested a new verification code for the event report.' : 
        'Use the verification code below to access the event booking report.';

    return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Report Verification - Soliera Hotel</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f7fc;">
    <div style="max-width:600px; margin:20px auto; background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 5px 15px rgba(0,31,84,0.15);">
        <div style="background:#001f54; padding:30px; text-align:center;">
            <img src="cid:hotelLogo" alt="Soliera Hotel" style="width:80px; height:80px; border-radius:50%; border:3px solid #F7B32B; margin-bottom:10px;">
            <h1 style="color:#F7B32B; margin:0; font-size:28px;">SOLIERA HOTEL</h1>
            <p style="color:#ffffff; margin:5px 0 0 0;">Event Report Access</p>
        </div>
        <div style="padding:30px;">
            <div style="text-align:center; margin-bottom:25px;">
                <span style="background:#F7B32B; color:#001f54; padding:8px 20px; border-radius:20px; font-weight:bold;">🔐 {$action}</span>
            </div>
            <p style="color:#666; font-size:16px; text-align:center;">{$message}</p>
            <div style="background:#f8fafd; border:2px dashed #001f54; border-radius:10px; padding:20px; margin:25px 0; text-align:center;">
                <div style="font-size:14px; color:#001f54; margin-bottom:10px;">VERIFICATION CODE</div>
                <div style="font-family:'Courier New', monospace; font-size:48px; font-weight:bold; color:#001f54; letter-spacing:10px;">{$otp}</div>
                <div style="margin-top:15px; color:#666; font-size:14px;">Valid for 10 minutes</div>
            </div>
            <div style="background:#fff5e0; border-left:4px solid #F7B32B; padding:15px; margin:20px 0;">
                <p style="margin:0; color:#856404; font-size:13px;">
                    <strong>⚠️ Security Notice:</strong> Never share this code. Soliera Hotel staff will never ask for it.
                </p>
            </div>
            <div style="text-align:center; color:#666; font-size:12px; margin-top:20px;">
                <p>Requested for: {$this->maskEmail($email)}</p>
            </div>
        </div>
        <div style="background:#001f54; padding:20px; text-align:center;">
            <p style="color:#F7B32B; margin:0; font-size:14px;">© 2026 Soliera Hotel & Restaurant</p>
            <p style="color:#ffffff; margin:5px 0 0 0; font-size:11px;">This is an automated message.</p>
        </div>
    </div>
</body>
</html>
HTML;
}


/**
 * Send OTP for additional items report access
 */
public function sendAdditionalReportOTP(Request $request)
{
    try {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated.'
            ], 401);
        }
        
        $email = $user->email;
        
        if (!$email) {
            return response()->json([
                'success' => false,
                'message' => 'Email address is required.'
            ], 400);
        }

        $deptAccount = DeptAccount::where('email', $email)->first();
        
        if ($deptAccount && $deptAccount->isLocked()) {
            return response()->json([
                'success' => false,
                'message' => 'Your account is locked. Please contact administrator.'
            ], 403);
        }

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        Cache::put('additional_report_otp_' . $email, [
            'code' => $otp,
            'created_at' => now(),
            'attempts' => 0
        ], now()->addMinutes(10));
        
        Cache::put('additional_report_attempts_' . $email, 0, now()->addMinutes(30));

        $emailSent = $this->sendAdditionalReportOTPEmail($email, $otp);

        if (!$emailSent) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP email. Please try again.'
            ], 500);
        }

        Log::info('Additional Report OTP Generated', [
            'email' => $email,
            'otp' => $otp
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Verification code sent successfully to your email.',
            'email' => $this->maskEmail($email),
            'expires_in' => 600
        ]);

    } catch (\Exception $e) {
        Log::error('Additional Report OTP Send Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while sending verification code.'
        ], 500);
    }
}

/**
 * Verify OTP for additional items report access
 */
public function verifyAdditionalReportOTP(Request $request)
{
    $request->validate([
        'otp' => 'required|string|size:6',
        'email' => 'required|email'
    ]);

    try {
        $email = $request->email;
        $deptAccount = DeptAccount::where('email', $email)->first();
        
        $cachedData = Cache::get('additional_report_otp_' . $email);
        $attempts = Cache::get('additional_report_attempts_' . $email, 0);

        if ($attempts >= 5) {
            if ($deptAccount) {
                $deptAccount->lockAccount();
            }
            return response()->json([
                'success' => false,
                'message' => 'Too many failed attempts. Your account has been locked.',
                'code' => 'MAX_ATTEMPTS_EXCEEDED'
            ], 429);
        }

        if (!$cachedData) {
            return response()->json([
                'success' => false,
                'message' => 'Verification code has expired. Please request a new one.',
                'code' => 'OTP_EXPIRED'
            ], 400);
        }

        if ($cachedData['code'] === $request->otp) {
            $createdAt = Carbon::parse($cachedData['created_at']);
            if ($createdAt->diffInMinutes(now()) > 10) {
                Cache::forget('additional_report_otp_' . $email);
                return response()->json([
                    'success' => false,
                    'message' => 'Verification code has expired. Please request a new one.',
                    'code' => 'OTP_EXPIRED'
                ], 400);
            }

            Cache::forget('additional_report_otp_' . $email);
            Cache::forget('additional_report_attempts_' . $email);
            
            if ($deptAccount) {
                $deptAccount->resetOtpFailedAttempts();
            }
            
            session(['additional_report_verified_' . $email => true]);

            Log::info('Additional Report OTP Verified Successfully', [
                'email' => $email,
                'ip' => $request->ip()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Verification successful!',
                'verified' => true
            ]);
        } else {
            $newAttempts = $attempts + 1;
            Cache::put('additional_report_attempts_' . $email, $newAttempts, now()->addMinutes(30));
            
            if ($cachedData) {
                $cachedData['attempts'] = $newAttempts;
                Cache::put('additional_report_otp_' . $email, $cachedData, now()->addMinutes(10));
            }
            
            if ($deptAccount) {
                $deptAccount->incrementOtpFailedAttempts();
            }

            $remainingAttempts = 5 - $newAttempts;
            
            return response()->json([
                'success' => false,
                'message' => "Invalid verification code. {$remainingAttempts} attempts remaining.",
                'remaining_attempts' => $remainingAttempts,
                'code' => 'INVALID_OTP'
            ], 400);
        }

    } catch (\Exception $e) {
        Log::error('Additional Report OTP Verify Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while verifying the code.'
        ], 500);
    }
}

/**
 * Resend OTP for additional items report
 */
public function resendAdditionalReportOTP(Request $request)
{
    try {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated.'
            ], 401);
        }
        
        $email = $user->email;

        $lastSent = Cache::get('additional_report_last_sent_' . $email);
        if ($lastSent && Carbon::parse($lastSent)->diffInSeconds(now()) < 30) {
            $waitTime = 30 - Carbon::parse($lastSent)->diffInSeconds(now());
            return response()->json([
                'success' => false,
                'message' => "Please wait {$waitTime} seconds before requesting a new code.",
                'wait_time' => $waitTime
            ], 429);
        }

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        Cache::put('additional_report_otp_' . $email, [
            'code' => $otp,
            'created_at' => now(),
            'attempts' => 0
        ], now()->addMinutes(10));
        
        Cache::put('additional_report_attempts_' . $email, 0, now()->addMinutes(30));
        Cache::put('additional_report_last_sent_' . $email, now(), now()->addSeconds(30));

        $emailSent = $this->sendAdditionalReportOTPEmail($email, $otp, true);

        if (!$emailSent) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to resend verification code.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'New verification code sent successfully.',
            'email' => $this->maskEmail($email),
            'expires_in' => 600
        ]);

    } catch (\Exception $e) {
        Log::error('Additional Report OTP Resend Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while resending the code.'
        ], 500);
    }
}

/**
 * Send Additional Report OTP email
 */
private function sendAdditionalReportOTPEmail($email, $otp, $isResend = false)
{
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host       = env('MAIL_HOST');
        $mail->SMTPAuth   = true;
        $mail->Username   = env('MAIL_USERNAME');
        $mail->Password   = env('MAIL_PASSWORD');
        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
        $mail->Port       = env('MAIL_PORT');
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $mail->addAddress($email);
        
        $logoPath = public_path('images/logo/sonly.png');
        if (file_exists($logoPath)) {
            $mail->addEmbeddedImage($logoPath, 'hotelLogo');
        }

        $mail->isHTML(true);
        $mail->Subject = $isResend ? 
            'New Verification Code - Additional Items Report - Soliera Hotel' : 
            'Additional Items Report - Verification Code - Soliera Hotel';
        
        $mail->Body = $this->generateAdditionalOTPEmailBody($otp, $email, $isResend);
        $mail->AltBody = "Your verification code is: {$otp}. Valid for 10 minutes.";

        $mail->send();
        return true;

    } catch (Exception $e) {
        Log::error("Additional Report OTP Email Error: " . $mail->ErrorInfo);
        return false;
    }
}

/**
 * Generate Additional OTP email body
 */
private function generateAdditionalOTPEmailBody($otp, $email, $isResend = false)
{
    $action = $isResend ? 'New Verification Code' : 'Verify Your Access';
    $message = $isResend ? 
        'You requested a new verification code for the additional items report.' : 
        'Use the verification code below to access the additional items report.';

    return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Additional Items Report Verification - Soliera Hotel</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f7fc;">
    <div style="max-width:600px; margin:20px auto; background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 5px 15px rgba(0,31,84,0.15);">
        <div style="background:#001f54; padding:30px; text-align:center;">
            <img src="cid:hotelLogo" alt="Soliera Hotel" style="width:80px; height:80px; border-radius:50%; border:3px solid #F7B32B; margin-bottom:10px;">
            <h1 style="color:#F7B32B; margin:0; font-size:28px;">SOLIERA HOTEL</h1>
            <p style="color:#ffffff; margin:5px 0 0 0;">Additional Items Report</p>
        </div>
        <div style="padding:30px;">
            <div style="text-align:center; margin-bottom:25px;">
                <span style="background:#F7B32B; color:#001f54; padding:8px 20px; border-radius:20px; font-weight:bold;">🔐 {$action}</span>
            </div>
            <p style="color:#666; font-size:16px; text-align:center;">{$message}</p>
            <div style="background:#f8fafd; border:2px dashed #001f54; border-radius:10px; padding:20px; margin:25px 0; text-align:center;">
                <div style="font-size:14px; color:#001f54; margin-bottom:10px;">VERIFICATION CODE</div>
                <div style="font-family:'Courier New', monospace; font-size:48px; font-weight:bold; color:#001f54; letter-spacing:10px;">{$otp}</div>
                <div style="margin-top:15px; color:#666; font-size:14px;">Valid for 10 minutes</div>
            </div>
            <div style="background:#fff5e0; border-left:4px solid #F7B32B; padding:15px; margin:20px 0;">
                <p style="margin:0; color:#856404; font-size:13px;">
                    <strong>⚠️ Security Notice:</strong> Never share this code. Soliera Hotel staff will never ask for it.
                </p>
            </div>
            <div style="text-align:center; color:#666; font-size:12px; margin-top:20px;">
                <p>Requested for: {$this->maskEmail($email)}</p>
            </div>
        </div>
        <div style="background:#001f54; padding:20px; text-align:center;">
            <p style="color:#F7B32B; margin:0; font-size:14px;">© 2026 Soliera Hotel & Restaurant</p>
            <p style="color:#ffffff; margin:5px 0 0 0; font-size:11px;">This is an automated message.</p>
        </div>
    </div>
</body>
</html>
HTML;
}



}