<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;
use URL;

class QuestionAnswer extends Model {

    use HasFactory;

    protected $table = 'question_answer';   

    # Create Question
    public static function createQuestion($request) {
        $data = new QuestionAnswer();
        $data->question = isset($request->question) ? $request->question : null;
        $data->option_a = isset($request->option_a) ? $request->option_a : null;
        $data->option_b = isset($request->option_b) ? $request->option_b : null;
        $data->option_c = isset($request->option_c) ? $request->option_c : null;
        $data->option_d = isset($request->option_d) ? $request->option_d : null;
        $data->answer = isset($request->answer) ? $request->answer : null;
        $data->save();
        return $data;
    }

    # Get Question Answer List
    public static function postQuestionAnswerList($request) {
        $query = QuestionAnswer::select("*");        
        return Datatables::of($query)                                                                                                                      
                ->rawColumns([])
                ->make(true);
    }

}
