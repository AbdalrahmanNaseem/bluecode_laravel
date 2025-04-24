<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\webController;
use App\Models\Course;
use App\Models\lesson;
use App\Models\Question;
use App\Models\Topic;
use Database\Seeders\QuestionSeeder;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return response($courses);
    }
    public function lesson_index()
    {

        $lessons = lesson::all();
        return response($lessons);
    }

    public function topics_index()
    {
        $topics = Topic::all();
        return response($topics);
    }

    public function question_index()
    {
        $question = Question::all();
        return response($question);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function CreateCourse(Request $request)
    {

        $webCont = new WebController();
        $course  = $webCont->Course_store($request);

        if ($course instanceof Course) {
            return response()->json([
                'message' => 'Course created successfully! 🎉',
                'course'  => $course,
            ], 201);
        }

        return response()->json([
            'message' => 'Failed to create course.',

        ], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
