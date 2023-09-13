<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\QuestionAnswerController;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

# User Routes
Route::get('/', [LoginController::class, 'indexUser']);
Route::get('login', [LoginController::class, 'indexUser'])->name('login');
Route::post('post-login', [LoginController::class, 'loginUser'])->name('post.login');

Route::middleware(['isUser'])->group(function (){
    Route::get('dashboard', [HomeController::class, 'indexUser'])->name('dashboard');  
    Route::get('logout', [LoginController::class, 'logoutUser'])->name('logout');

    Route::get('test', [TestController::class, 'index'])->name('test');
    Route::post('test', [TestController::class, 'store'])->name('post.test');
    Route::get('test-completed', [TestController::class, 'testCompleted'])->name('test.completed');
    Route::post('send-score', [TestController::class, 'sendScore'])->name('send.score');
});

# Admin Routes
Route::group(['prefix' => 'admin'], function () {

    Route::get('/', [LoginController::class, 'indexAdmin']);
    Route::get('login', [LoginController::class, 'indexAdmin'])->name('admin.login');
    Route::post('post-login', [LoginController::class, 'loginAdmin'])->name('admin.post.login');

    Route::middleware(['isAdmin'])->group(function (){
        Route::get('dashboard', [HomeController::class, 'indexAdmin'])->name('admin.dashboard');
        Route::get('logout', [LoginController::class, 'logoutAdmin'])->name('admin.logout');   
        
        Route::resource('users', UsersController::class);
        Route::post('getusers', [UsersController::class, 'postUsersList'])->name('getusers');
        Route::post('getuserresult', [UsersController::class, 'postUserResultList'])->name('getuserresult');

        Route::resource('question-answer', QuestionAnswerController::class);
        Route::post('getquestionanswer', [QuestionAnswerController::class, 'postQuestionAnswerList'])->name('getquestionanswer');
    });

});
