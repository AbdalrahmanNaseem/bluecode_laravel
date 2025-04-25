<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\adminDashboard;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\UserController;

Route::get('admin-dashboard',        [adminDashboard::class, 'index']);
Route::post('admin-dashboard',        [adminDashboard::class, 'store']);
Route::get('admin-dashboard/{id}',   [adminDashboard::class, 'show']);
Route::put('admin-dashboard/{id}',   [adminDashboard::class, 'update']);
Route::delete('admin-dashboard/{id}',   [adminDashboard::class, 'destroy']);

Route::post('/login', [UserController::class, "login"]);
Route::post('/register', [UserController::class, "register"]);

Route::get('/courses', [CourseController::class, "index"]);
Route::get('/lesson', [CourseController::class, "lesson_index"]);
Route::post('/courses', [CourseController::class, "CreateCourse"]);

Route::get('/topic', [CourseController::class, "topics_index"]);

Route::get('/question', [CourseController::class, "question_index"]);

Route::get('/answer', [CourseController::class, "answer_index"]);
