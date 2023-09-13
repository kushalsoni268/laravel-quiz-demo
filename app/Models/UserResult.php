<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\QuestionAnswer;
use App\Models\User;

class UserResult extends Model {

    use HasFactory;

    protected $table = 'user_result'; 
    
    # Question Relationship
    public function question() {
        return $this->hasOne(QuestionAnswer::class, 'id', 'question_id');
    }

    # Admin Save Result
    public static function createUserResult($request) {
        $questions = QuestionAnswer::all();
        $totalQuestions = 0;
        $totalScore = 0;
        foreach($questions as $key => $value){
            $data = new UserResult();
            $data->user_id = Auth::user()->id;
            $data->question_id = $value->id;
            $answer = "question_" . ($key + 1);
            $data->answer = $request->$answer;
            $data->is_correct = isset($request->$answer) && $request->$answer == $value->answer ? config('const.answerCorrect') : config('const.answerIncorrect');
            $data->save();
            
            $totalQuestions++;
            if(isset($request->$answer) && $request->$answer == $value->answer){
                $totalScore++;
            }
        }

        $userUpdate = User::find(Auth::user()->id);
        $userUpdate->is_test_attended = config('const.testAttended');
        $userUpdate->total_question = $totalQuestions;
        $userUpdate->total_score = $totalScore;
        $userUpdate->total_time = $request->hours . ":" . $request->minutes . ":" . $request->seconds;
        $save = $userUpdate->save();
        return $save;   
    }

    # API Save Result
    public static function saveResult($request) {  
        $totalQuestions = 0;
        $totalScore = 0;
        $question_answer = json_decode($request->question_answer);
        foreach($question_answer as $key => $value){
            $questionData = QuestionAnswer::find($value->question_id);
            $data = new UserResult();
            $data->user_id = Auth::user()->id;
            $data->question_id = $value->question_id;
            $data->answer = $value->answer;
            $data->is_correct = isset($value->answer) && $questionData->answer == $value->answer ? config('const.answerCorrect') : config('const.answerIncorrect');
            $data->save();
            
            $totalQuestions++;
            if(isset($value->answer) && $questionData->answer == $value->answer){
                $totalScore++;
            }
        }
        
        $userUpdate = User::find(Auth::user()->id);
        $userUpdate->is_test_attended = config('const.testAttended');
        $userUpdate->total_question = $totalQuestions;
        $userUpdate->total_score = $totalScore;
        $userUpdate->total_time = $request->total_time;
        $save = $userUpdate->save();
        return $userUpdate;   
    }

}
