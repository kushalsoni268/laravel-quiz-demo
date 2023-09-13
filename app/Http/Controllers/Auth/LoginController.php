<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    # Admin Login Page
    public function indexAdmin(){
        if (Auth::user() && Auth::user()->role_id == config('const.roleAdmin')) {
            return redirect()->route('dashboard');
        } else {
            return view('auth.login');
        }
    }

    # Admin Login
    public function loginAdmin(Request $request){        
        $rules = array(
            'name' => 'required',
            'password' => 'required'
        );

        $messsages = array(
            'name.required' => 'The username field is required.',
        );

        $validator = Validator::make($request->all(), $rules, $messsages);            
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }        
        
        if (Auth::attempt(['name' => $request->name, 'password' => request('password'), 'role_id' => config('const.roleAdmin')])) {
            $user = Auth::user();            
            session()->flash('success', 'You have logged In successfully');
            return redirect()->route('admin.dashboard');
        } else {
            session()->flash('error', 'Invalid Credentials');
            return redirect()->route('admin.login');
        }
    }

    # Admin Logout
    public function logoutAdmin(){
        Auth::logout();
        return redirect()->route('admin.login');
    }

    # User Login Page
    public function indexUser(){
        if (Auth::user() && Auth::user()->role_id == config('const.roleUser')) {
            return redirect()->route('dashboard');
        } else {
            return view('auth.login-user');
        }
    }

    # User Login
    public function loginUser(Request $request){
        $rules = array(
            'name' => 'required',
            'password' => 'required'
        );

        $messsages = array(
            'name.required' => 'The username field is required.',
        );

        $validator = Validator::make($request->all(), $rules, $messsages);            
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        } 
        
        if (Auth::attempt(['name' => $request->name, 'password' => request('password'), 'role_id' => config('const.roleUser')])) {
            $user = Auth::user();            
            session()->flash('success', 'You have logged In successfully');
            return redirect()->route('dashboard');
        } else {
            session()->flash('error', 'Invalid Credentials');
            return redirect()->route('login');
        }
    }

    # User Logout
    public function logoutUser(){
        Auth::logout();
        return redirect()->route('login');
    }
}
