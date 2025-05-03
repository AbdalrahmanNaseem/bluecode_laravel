<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\adminDashboard;
use App\Http\Controllers\API\CourseController;
// use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\CourseController as ControllersCourseController;

Route::post('/login', [UserController::class, "login"]);
Route::post('/register', [UserController::class, "register"]);
Route::get("/users", [UserController::class, "all_users"]);
Route::get("/user/{id}", [UserController::class, "get_user_by_id"]);
Route::post("/user", [UserController::class, "update_user_info"]);

Route::get('/courses', [CourseController::class, "index"]);
Route::get('/lesson', [CourseController::class, "lesson_index"]);

Route::get('/challeng', [CourseController::class, "challeng_index"]);

Route::post('/courses', [CourseController::class, "CreateCourse"]);
Route::get('/lessonsCourse/{id}', [CourseController::class, "get_lessen_by_courseId"]);


Route::get('/topic', [CourseController::class, "topics_index"]);
Route::get('/topic/{id}', [CourseController::class, "get_topic_by_lessonId"]);

Route::get('/question', [CourseController::class, "question_index"]);



Route::get('/lessenQuestions/{id}', [CourseController::class, "get_questions_and_topic_by_lessenId"]);

Route::post('/submitAnswer', [CourseController::class, "add_score_to_the_user"]);


Route::get('/userAnswers/{id}', [CourseController::class, "get_user_answers"]);


Route::post('/user-progress', [CourseController::class, 'getUserProgress']);


Route::post('/challenge-submission', [CourseController::class, 'challenge_submission_store']);


// شتنىيلاشلاسيت
