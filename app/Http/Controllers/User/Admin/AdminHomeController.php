<?php

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    /**
     * Display home page
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin-home');
    }
}