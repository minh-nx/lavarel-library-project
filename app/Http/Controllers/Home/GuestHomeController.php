<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuestHomeController extends Controller
{
    /**
     * Display about guest home page
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.guest-home');
    }
}
