<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    # Admin Dashboard
    public function indexAdmin(){
        return view('dashboard.index');
    }

    # User Dashboard
    public function indexUser(){
        return view('dashboard.index-user');
    }
    
}
