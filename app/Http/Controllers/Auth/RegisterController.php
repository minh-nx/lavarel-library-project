<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return Renderable
     */
    public function index() 
    {
        return view('auth.register');
    }

    /**
     * Handle register request
     * 
     * @param App\Http\Requests\RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request) 
    {
        $user = User::create($request->safe()->except(['password_confirmation']));

        event(new Registered($user));

        $user->assignRole('client');
        Auth::login($user);
        
        return redirect()->route('home');
    }
}
