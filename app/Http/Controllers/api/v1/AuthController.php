<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AuthController extends Controller{

    # Login
    public function login(Request $request) {
        $rules = array(
            'name' => 'required',
            'password' => 'required'            
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Helper::fail([], Helper::error_parse($validator->errors()));
        }
        try{
            $user = [];
            
            if(Auth::attempt(['name' =>$request->name, 'password' => $request->password, 'role_id' => config('const.roleUser')])){ 
                $user = Auth::user();   
            } 

            if (!$user) {
                return Helper::fail([], 'Authentication failed, Invalid login details', 203);
            }                            
    
            $tokenobj = Auth::user()->createToken('eros');           
            $user->token = $tokenobj->accessToken;            
            $token_id = $tokenobj->token->id;
           
            DB::table('oauth_access_tokens')->where('id','!=', $token_id)->where('user_id', Auth::user()->id)->update([
                'revoked' => true
            ]);                    
                       
            return Helper::success($user,'You are logged In successfully.');

        }catch(\Exception $e){                  
            return  Helper::fail([], $e->getMessage());
        }
    }   
    
    # Logout
    public function logout(Request $request){
        try{                       
            $user = Auth::user()->token(); 
            $user->revoke();
            return Helper::success([], 'You are logged out successfully');
        }catch(\Exception $e){                  
            return  Helper::success([], $e->getMessage());
        }
    }
    
}
