<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\PasswordResetRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function handleForgotPasswordForm(ForgotPasswordRequest $request)
    {
        $status = Password::sendResetLink($request->safe()->only('email'));

        return $status === Password::RESET_LINK_SENT ? back()->with('success', __($status))
                                                     : back()->withInput($request->safe()->only('email'))->with('error', __($status));
    }

    public function showPasswordResetForm(Request $request, $token)
    {
        $email = $request->input('email');
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    public function handlePasswordResetForm(PasswordResetRequest $request)
    {
        $credentials = $request->only(['email', 'password', 'token']);

        $status = Password::reset($credentials,
            function(User $user, string $password) {
                $user->forceFill(['password' => $password])
                     ->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET ? redirect()->route('login')->with('success', __($status))
                                                    : back()->with('error', __($status));
    }
}
