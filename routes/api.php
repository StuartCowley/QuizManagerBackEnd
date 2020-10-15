<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('quizzes/get-all', 'ApiController@getAllQuizzes');
Route::get('quizzes/get-quiz/{id}', 'ApiController@getQuiz');
Route::post('quizzes/add-quiz', 'ApiController@createQuiz');
Route::put('quizzes/update-quiz/{id}', 'ApiController@updateQuiz');
Route::delete('quizzes/delete-quiz/{id}','ApiController@deleteQuiz');

// Questions logic
Route::get('questions/get-all', 'ApiController@getAllQuestions');
Route::put('questions/{id}/update', 'ApiController@updateQuestion');
Route::put('questions/{id}/update-question', 'ApiController@updateQuestionText');
Route::delete('questions/{id}/delete', 'ApiController@deleteQuestion');
Route::post('questions/add-question', 'ApiController@addQuestion');

// Users logic
Route::get('/users/user={name}&pass={password}', 'ApiController@authUser');
