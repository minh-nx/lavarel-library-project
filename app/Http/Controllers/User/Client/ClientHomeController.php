<?php

namespace App\Http\Controllers\User\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientHomeController extends Controller
{
    /**
     * Display home page
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('users.show', ['user' => auth()->user()]);
    }
}