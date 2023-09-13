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
use App\Helpers\Helper;

class QuestionAnswerController extends Controller {

    # Question Answer Page
    public function index() {
        return view('question-answer.index');
    }

    # Create Question Page
    public function create() {
        try {            
            return view('question-answer.create');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    # Store Question
    public function store(Request $request) {    
        try {
            $rules = array(
                'question' => 'required',
                'option_a' => 'required',
                'option_b' => 'required',
                'option_c' => 'required',   
                'option_d' => 'required',
                'answer' => 'required',                
            );
           
            $validator = Validator::make($request->all(), $rules);            
            if ($validator->fails()) {
                return Helper::fail([], Helper::error_parse($validator->errors()));
            }
            
            DB::beginTransaction();            
            $questionCreated = QuestionAnswer::createQuestion($request);
            DB::commit();

            if ($questionCreated) {
                return Helper::success([], "Question has been created successfully");               
            } else {
                return Helper::fail([], "Oops, something went wrong.");
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return Helper::fail([], $e->getMessage());
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
