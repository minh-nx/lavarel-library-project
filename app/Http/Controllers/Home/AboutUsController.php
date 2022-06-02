<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display about us page
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.about-us');
    }
}
