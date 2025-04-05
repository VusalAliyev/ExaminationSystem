<?php

use App\Http\Controllers\AnswerImageController;
use App\Http\Controllers\ExamAnswerController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamGroupController;
use App\Http\Controllers\ExamOrganizerController;
use App\Http\Controllers\ExamQuestionController;
use App\Http\Controllers\ExamSubjectController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\ExamYearController;
use App\Http\Controllers\QuestionImageController;
use Illuminate\Support\Facades\Route;

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
Route::resource('exam-types', ExamTypeController::class);
Route::resource('exam-years', ExamYearController::class);
Route::resource('exam-groups', ExamGroupController::class);
Route::resource('exam-subjects', ExamSubjectController::class);
Route::resource('exam-organizers', ExamOrganizerController::class);
Route::resource('exams', ExamController::class);
Route::resource('exam-questions', ExamQuestionController::class);
Route::resource('exam-answers', ExamAnswerController::class);
Route::resource('answer-images', AnswerImageController::class);
Route::resource('question-images', QuestionImageController::class);
Route::get('/', function () {
    return view('welcome');
});
