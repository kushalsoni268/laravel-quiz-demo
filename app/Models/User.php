<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Helpers\Helper;
use App\Models\UserResult;
use URL;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    # Create User
    public static function createUser($request) {
        $data = new User();
        $data->name = $request->name;        
        $data->password = bcrypt($request->password);
        $data->role_id = config('const.roleUser');       
        $data->save();
        return $data;      
    }

    # Get User List
    public static function postUsersList($request) {
        $query = User::where('role_id',config('const.roleUser'))->get();        
        return Datatables::of($query)      
                ->addColumn('is_test_attended', function ($data) {                   
                    if (isset($data->is_test_attended) && $data->is_test_attended == config('const.testAttended')) {
                        return config('const.testAttendedText');
                    } else {
                        return config('const.testPendingText');
                    }
                })
                ->addColumn('action', function ($data) {
                    if (isset($data->is_test_attended) && $data->is_test_attended == config('const.testAttended')) {
                        $viewLink = URL::to('/') . '/admin/users/' . $data->id;            
                        $action = '<a  href="' . $viewLink . '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>';                        
                        return $action;
                    }else{
                        return '';
                    }                                                           
                })                                                                                    
                ->rawColumns(['action', 'is_test_attended'])
                ->make(true);
    }

    # Get User Result List
    public static function postUserResultList($request) {
        $query = UserResult::with(['question'])->where('user_id',$request->user_id);  
        return Datatables::of($query)      
                ->addColumn('answer', function ($data) {                   
                    if (isset($data->answer) && $data->answer != '') {
                        return $data->answer;
                    } else {
                        return '<div class="badge badge-light-warning">Not Attempted</div>';
                    }
                })
                ->addColumn('is_correct', function ($data) {                   
                    if (isset($data->is_correct) && $data->is_correct == config('const.answerCorrect')) {
                        return '<div class="badge badge-success">' . config('const.answerCorrectText') . '</div>';
                    } else {
                        return '<div class="badge badge-danger">' . config('const.answerIncorrectText') . '</div>';
                    }
                })                                                                                                    
                ->rawColumns(['answer', 'is_correct'])
                ->make(true);
    }
    
}
