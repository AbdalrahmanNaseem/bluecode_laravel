<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\webController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('main');




Route::get('layout', [webController::class, 'index'])->name('layout.index');
Route::get('user', [webController::class, 'alluser'])->name('test.blade');









Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');









Route::get('level', [webController::class, 'Level_index'])->name('level.index');
Route::post('level', [webController::class, 'Level_store'])->name('level.store');
Route::put('level/{id}', [webController::class, 'Level_update'])->name('level.update');
Route::delete('level/{id}', [webController::class, 'Level_destroy'])->name('level.destroy');






Route::get('Course', [webController::class, 'Course_index'])->name('Course.index');
Route::post('Course', [webController::class, 'Course_store'])->name('Course.store');
Route::put('Course/{id}', [webController::class, 'Course_update'])->name('Course.update');
Route::delete('Course/{id}', [webController::class, 'Course_destroy'])->name('Course.destroy');


Route::post('lessons/{id}', [webController::class, 'Courselessons_store'])->name('Courselesson.store');


Route::get('lesson', [webController::class, 'lesson_index'])->name('lesson.index');
Route::post('lesson', [webController::class, 'lesson_store'])->name('lesson.store');
Route::put('lesson/{id}', [webController::class, 'lesson_update'])->name('lesson.update');
Route::delete('lesson/{id}', [webController::class, 'lesson_destroy'])->name('lesson.destroy');


Route::post('/topic/store', [webController::class, 'lessonsTopic_store'])->name('lessonsTopic.store');

Route::get('topic', [webController::class, 'topic_index'])->name('topic.index');
Route::post('topic', [webController::class, 'topic_store'])->name('topic.store');
Route::put('topic/{id}', [webController::class, 'topic_update'])->name('topic.update');
Route::delete('topic/{id}', [webController::class, 'topic_destroy'])->name('topic.destroy');




Route::get('question', [webController::class, 'question_index'])->name('question.index');
Route::post('question', [webController::class, 'question_store'])->name('question.store');
Route::put('question/{id}', [webController::class, 'question_update'])->name('question.update');
Route::delete('question/{id}', [webController::class, 'question_destroy'])->name('question.destroy');


Route::get('answer', [webController::class, 'answer_index'])->name('answer.index');
Route::post('answer', [webController::class, 'answer_store'])->name('answer.store');
Route::put('answer/{id}', [webController::class, 'answer_update'])->name('answer.update');
Route::delete('answer/{id}', [webController::class, 'answer_destroy'])->name('answer.destroy');



Route::get('challenge', [webController::class, 'challenge_index'])->name('challenge.index');
Route::post('challenge', [webController::class, 'challenge_store'])->name('challenge.store');
Route::put('challenge/{id}', [webController::class, 'challenge_update'])->name('challenges.update');
Route::delete('challenge/{id}', [webController::class, 'challenge_destroy'])->name('challenge.destroy');

Route::get('challenge/{id}', [webController::class, 'challenge_reports'])->name('challenge.reports');
