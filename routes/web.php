<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnswerImageController;
use App\Http\Controllers\ExamAnswerController;
use App\Http\Controllers\ExamsController;
use App\Http\Controllers\ExamGroupController;
use App\Http\Controllers\ExamOrganizerController;
use App\Http\Controllers\ExamQuestionController;
use App\Http\Controllers\ExamSubjectController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\ExamYearController;
use App\Http\Controllers\QuestionImageController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/exam/{id}', function ($id) {
    // Bu, imtahan səhifəsinə yönləndirmə üçün placeholder-dir
    // Növbəti addımda ExamsController yazacağıq
    return "İmtahan ID: " . $id;
})->name('exam');

Route::get('/exam/{id}', [ExamController::class, 'show'])->name('exam');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');


    Route::prefix('admin')->middleware('isAdmin')->group(function () {
        Route::resource('exam-types', ExamTypeController::class);
        Route::resource('exam-years', ExamYearController::class);
        Route::resource('exam-groups', ExamGroupController::class);
        Route::resource('exam-subjects', ExamSubjectController::class);
        Route::resource('exam-organizers', ExamOrganizerController::class);
        Route::resource('exams', ExamsController::class);
        Route::resource('exam-questions', ExamQuestionController::class);
        Route::resource('exam-answers', ExamAnswerController::class);
        Route::resource('answer-images', AnswerImageController::class);
        Route::resource('question-images', QuestionImageController::class);
        Route::middleware('auth')->group(function () {
        });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
