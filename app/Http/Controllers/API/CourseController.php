<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\webController;
use App\Models\Answer;
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
        $questionsTopics = Question::all();
        foreach ($topics as $topic) {
            $topic->questions = $questionsTopics->where('topic_id', $topic->id);
        }
        foreach ($topics as $topic) {
            $topic->lessons = lesson::where('topic_id', $topic->id)->get();
        }
        return response($topics);
    }

    public function question_index()
    {
        $question = Question::all();
        return response(content: $question);
    }
    public function get_questions_and_topic_by_lessenId($id)
    {
        $topics = Topic::where('lesson_id', $id)->get();

        if ($topics->isEmpty()) {
            return response()->json([
                'message' => 'No topics found for this lesson'
            ], 404);
        }

        $topicIds = $topics->pluck('id');

        $questions = Question::whereIn('topic_id', $topicIds)->get();

        if ($questions->isEmpty()) {
            return response()->json([
                'message' => 'No questions found for these topics'
            ], 404);
        }

        $questionIds = $questions->pluck('id');

        $answers = Answer::whereIn('question_id', $questionIds)->get();

        $questionsWithAnswers = $questions->map(function ($question) use ($answers) {
            $question->answers = $answers->where('question_id', $question->id)->values();
            return $question;
        });
        $questionsWithAnswers = $questions->map(function ($question) use ($answers) {
            $question->answers = $answers->where('question_id', $question->id)->values();
            return $question;
        });

        $unansweredQuestions = $questionsWithAnswers->filter(function ($question) {
            return $question->answers->isEmpty();
        });

        if ($unansweredQuestions->isNotEmpty()) {
            $unansweredNames = $unansweredQuestions->pluck('question');

            return response()->json([
                'message' => 'Some questions have no answers ',
                'unanswered_questions' => $unansweredNames
            ], 400);
        }

        $topicsWithQuestions = $topics->map(function ($topic) use ($questionsWithAnswers) {
            $topic->questions = $questionsWithAnswers->where('topic_id', $topic->id)->values();
            return $topic;
        });

        return response()->json([
            'topics' => $topicsWithQuestions
        ], 200);
    }

    public function answer_index()
    {
        $answer = Answer::all();
        return response($answer);
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
                'message' => 'Course created successfully',
                'course'  => $course,
            ], 201);
        }

        return response()->json([
            'message' => 'Failed to create course.',

        ], 500);
    }
    public function get_lessen_by_courseId($id)
    {

        $course = Course::find($id);
        if (!$course) {
            return response()->json([
                'message' => 'Course not found'
            ], 404);
        }
        $lessons = Lesson::where('course_id', $id)->get();
        return response()->json([
            'course' => $course,
            'lessons' => $lessons
        ], 200);
    }
    public function get_topic_by_lessonId($id)
    {
        $lesson = lesson::find($id);
        if (!$lesson) {
            return response()->json([
                'message' => 'lesson not found'
            ], 404);
        }
        $topics = Topic::where('lesson_id', $id)->get();
        return response()->json([
            'lesson' => $lesson,
            'topics' => $topics
        ], 200);
    }
}
