<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\adminDashboard;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\CourseController as ControllersCourseController;

Route::post('/login', [UserController::class, "login"]);
Route::post('/register', [UserController::class, "register"]);

Route::get('/courses', [CourseController::class, "index"]);
Route::get('/lesson', [CourseController::class, "lesson_index"]);
Route::get('/lesson/{id}',[CourseController::class,"get_lessen_by_courseId"]);

Route::post('/courses', [CourseController::class, "CreateCourse"]);
Route::get('/lessonsCourse/{id}',[CourseController::class,"get_lessen_by_courseId"]);


Route::get('/topic', [CourseController::class, "topics_index"]);

Route::get('/question', [CourseController::class, "question_index"]);
