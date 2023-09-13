<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\QuestionAnswer;
use App\Models\UserResult;
use App\Jobs\SendEmailJob;

class TestController extends Controller {

    # Test Page
    public function index() {
        try {
            if(Auth::user()->is_test_attended == config('const.testAttended')){
                return redirect()->route('test.completed');
            }else{
                $questions = QuestionAnswer::all();
                return view('test.index', compact('questions'));
            }            
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return view('dashboard');
        }        
    }
    
    # Test Completed Page
    public function testCompleted() {
        $totalQuestion = UserResult::where('user_id',Auth::user()->id)->count();
        $totalScore = UserResult::where(['user_id' => Auth::user()->id, 'is_correct' => config('const.answerCorrect')])->count();
        $totalTime = Auth::user()->total_time;        
        return view('test.test-completed', compact('totalQuestion', 'totalScore', 'totalTime'));
    }

    # Send Score Email
    public function sendScore(Request $request) {         
        try {                    
            $rules = array(
                'email' => 'required|max:30|email:rfc,dns'
            );            
    
            $validator = Validator::make($request->all(), $rules);            
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
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

            session()->flash('success', 'Email sent successfully');
            return redirect()->route('test.completed');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    # Store Test Result
    public function store(Request $request) {          
        try {                    
            DB::beginTransaction();            
            $testCompleted = UserResult::createUserResult($request);
            DB::commit();

            if ($testCompleted) {
                session()->flash('success', 'Test has been completed successfully');
                return redirect()->route('test.completed');
            } else {
                session()->flash('error', 'Oops, something went wrong.');
                return back()->withInput();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    # Get Question Answer List
    public static function postQuestionAnswerList(Request $request) {
        try {
            return QuestionAnswer::postQuestionAnswerList($request);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('question-answerindex');
        }
    }

}
