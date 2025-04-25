<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectorsController;
use App\Http\Controllers\ContactController;
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
use App\Http\Controllers\ForeignLanguagesController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/test-email', [ContactController::class, 'testEmail'])->name('test.email');

Route::middleware('auth')->group(function () {
    Route::get('/exam/{id}', [ExamController::class, 'show'])->name('exam');
    Route::post('/exam/{id}/finish', [ExamController::class, 'finish'])->name('exam.finish');
    Route::get('/exam/{examId}/subject/{subjectId}/questions', [ExamQuestionController::class, 'getQuestionsBySubject'])->name('exam.subject.questions');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware('isAdmin')->group(function () {
    Route::resource('exam-types', ExamTypeController::class);
    Route::resource('exam-years', ExamYearController::class);
    Route::resource('exam-groups', ExamGroupController::class);
    Route::resource('exam-subjects', ExamSubjectController::class);
    Route::resource('exam-organizers', ExamOrganizerController::class);
    Route::resource('sectors', SectorsController::class);
    Route::resource('foreign-languages', ForeignLanguagesController::class);
    Route::resource('exams', ExamsController::class);

    Route::resource('exam-questions', ExamQuestionController::class)->except(['create']);
    Route::get('exam-questions/create/{examId}', [ExamQuestionController::class, 'create'])->name('exam-questions.create');
    Route::resource('exam-answers', ExamAnswerController::class);
    Route::resource('answer-images', AnswerImageController::class);
    Route::resource('question-images', QuestionImageController::class);

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
