<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserResult;
use App\Models\QuestionAnswer;
use App\Jobs\SendEmailJob;

class UserController extends Controller{

    # Get Questions
    public function questions(Request $request) {        
        try{
            $questions = QuestionAnswer::all();                       
            return Helper::success($questions);
        }catch(\Exception $e){                  
            return  Helper::fail([], $e->getMessage());
        }
    }
    
    # Save Result
    public function saveResult(Request $request) {         
        try{
            $rules = array(
                'question_answer' => 'required',
                'total_time' => 'required'           
            );
    
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return Helper::fail([], Helper::error_parse($validator->errors()));
            }

            if(Auth::user()->is_test_attended == config('const.testAttended')){
                return Helper::fail([],'Test is already completed.');
            }

            $saveResult = UserResult::saveResult($request);                       
            return Helper::success($saveResult, 'Test has been completed successfully');
        }catch(\Exception $e){                  
            return  Helper::fail([], $e->getMessage());
        }
    }

    # Send Result
    public function sendResult(Request $request) {        
        try{
            $rules = array(
                'email' => 'required|max:30|email:rfc,dns'        
            );
    
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return Helper::fail([], Helper::error_parse($validator->errors()));
            }            

                dispatch(new SendEmailJob([
                    '_blade' => 'emailresult',
                    'subject' => 'Test Result',
                    'email' => $request->email,
                    'name' => Auth::user()->name,
                    'total_question' => Auth::user()->total_question,
                    'total_score' => Auth::user()->total_score,
                    'total_time' => Auth::user()->total_time
                ]));
                      
            return Helper::success('Email sent successfully');
        }catch(\Exception $e){                  
            return  Helper::fail([], $e->getMessage());
        }
    }
    
}
