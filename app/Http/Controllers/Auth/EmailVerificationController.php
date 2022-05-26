<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function index(Request $request) 
    {
        if(!url()->previous() == route('verification.notice')) {
            $request->user()->sendEmailVerificationNotification();
        }

        if(session()->missing('warning')) {
            session()->flash('warning', 'A link has been sent to the email. Please confirm your email to activate the account');
        }
        
        return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        
        return redirect()->route('home')->with('success', "Email verified successfully");
    }

    public function resend(Request $request)
    {
        if($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('home'));
        }
        
        $request->user()->sendEmailVerificationNotification();
        return back()->with('warning', 'A link has been resent to your email');
    }
}
