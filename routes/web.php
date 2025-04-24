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
