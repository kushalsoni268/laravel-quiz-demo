<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use App\Helpers\Helper;

class UsersController extends Controller {

    # Users Page
    public function index() {
        return view('users.index');
    }

    # Create User Page
    public function create() {
        try {            
            return view('users.create');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    # Store User
    public function store(Request $request) {    
        try {
            $rules = array(
                'name' => 'required|max:100',                
                'password' => [
                    'required',
                    'string',
                    'min:8',                // must be at least 8 characters in length
                    'regex:/[a-z]/',        // must contain at least one lowercase letter
                    'regex:/[A-Z]/',        // must contain at least one uppercase letter
                    'regex:/[0-9]/',        // must contain at least one digit
                    'regex:/[@$!%*#?&]/',   // must contain a special character
                ], 'password_confirmation' => ['same:password']
            );

            $messsages = array(
                'password.regex' => 'Your password must contains one Uppercase, Lowercase, Digit and Special Character',
            );                      

            $validator = Validator::make($request->all(), $rules, $messsages);            
            if ($validator->fails()) {
                return Helper::fail([], Helper::error_parse($validator->errors()));
            }

            if ($request->name && $request->name != '') {
                $emailexist = User::where(['name' => $request->name])->first();
                if ($emailexist) {
                    return Helper::fail([], "Username already exists");
                }
            }

            DB::beginTransaction();            
            $userCreated = User::createUser($request);
            DB::commit();

            if ($userCreated) {
                return Helper::success([], "User has been created successfully");               
            } else {
                return Helper::fail([], "Oops, something went wrong.");               
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return Helper::fail([], $e->getMessage());           
        }
    }

    # View User Details Page
    public function show($id) {
        try {
            $userData = User::find($id);
            return view('users.show', compact('userData'));
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('users.index');
        }        
    }

    # Get Users List
    public static function postUsersList(Request $request) {
        try {
            return User::postUsersList($request);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('users.index');
        }
    }

    # Get User Result
    public static function postUserResultList(Request $request) {
        try {
            return User::postUserResultList($request);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('users.index');
        }
    }

}
