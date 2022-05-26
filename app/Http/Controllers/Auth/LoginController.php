<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     * 
     * @param App\Http\Requests\LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request) 
    {
        $credentials = $request->getCredentials();
        
        if(Auth::attempt($credentials, $request->boolean('remember-me'))) {

            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }
        else {
            return redirect()->route('login')->withInput($request->only('username'))
                             ->with('error', 'You have entered your account name or password incorrectly');
        }
    }

    /**
     * Handle account logout request
     * 
     * @param App\Http\Requests\LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) 
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('guest.home');
    }
}
