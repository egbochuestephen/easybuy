<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }
public function register(Request $request)
    {
        // 1. Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // 2. Create the user and hash the password securely
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Return a success response
        Auth::login($user);
return redirect('/dashboard');
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle the login attempt
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Protects against session fixation attacks
            return redirect()->intended('/dashboard');
        }

        // If login fails, send them back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }

    // Show the forgot password form
    public function showForgotForm()
    {
        return view('forgot-password');
    }

    // Generate and send the 6-digit OTP
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        // Generate a random 6-digit number
        $otp = rand(100000, 999999);
        
        // Find user and save OTP with a 10-minute expiration
        $user = User::where('email', $request->email)->first();
        $user->otp = (string) $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        // Send the OTP via email (Mailtrap)
        Mail::raw("Your EasyBuy password reset code is: $otp. It is valid for 10 minutes.", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('EasyBuy Password Reset OTP');
        });

        // Redirect to reset page and pass the email along in the session
        return redirect('/reset-password')->with('email', $user->email);
    }

    // Show the reset password form (where they enter the OTP and new password)
    public function showResetForm()
    {
        // Retrieve the email passed from the previous step, if available
        $email = session('email') ?? '';
        return view('reset-password', ['email' => $email]);
    }

    // Verify the OTP and update the password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string|size:6',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::where('email', $request->email)->first();

        // Check if OTP matches and hasn't expired
        if ($user->otp !== $request->otp || now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // Update password and clear OTP fields
        $user->password = Hash::make($request->password);
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect('/login')->with('success', 'Password reset successfully. You can now log in.');
    }
}