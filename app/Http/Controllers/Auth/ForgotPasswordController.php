<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;

class ForgotPasswordController extends Controller
{
    public function linkRequestForm()
    {
        return view('auth.password.linkRequestForm');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        $this->sendResetEmail($request->email, $token);
        return redirect('/')->with('status', 'We have emailed your password reset link!');
    }


    protected function sendResetEmail($email, $token)
    {
        $link = url('/reset-password-form?token=' . $token . '&email=' . urlencode($email));

        if (!$link) {
            throw new \Exception("Link generation failed.");
        }
        Mail::to($email)->send(new ResetPasswordMail($link));
    }

    public function resetPasswordForm(Request $request)
    {
        return view('auth.password.resetPasswordForm', ['token' => $request->token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required',
        ]);

        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$passwordReset) {
            return back()->withErrors(['email' => 'This password reset token is invalid.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('loginForm')->with('status', 'Password has been reset, please login again!');

    }

}
