<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\webController;
use App\Models\Answer;
use App\Models\Challenge;
use App\Models\ChallengeSubission;
use App\Models\Course;
use App\Models\lesson;
use App\Models\Question;
use App\Models\Topic;
use App\Models\User;
use App\Models\UserAnswer;
use Database\Seeders\QuestionSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
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


    public function challeng_index()
    {

        $challengs = Challenge::all();
        return response($challengs);
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
    public function add_score_to_the_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'question_id' => 'required|exists:questions,id',
            'answer_id' => 'required|exists:answers,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        $user = User::find($request->user_id);
        $question = Question::find($request->question_id);

        // $query = UserAnswer::query();
        // $query->where('user_id', $user->id);
        // $query->where('question_id', $question->id);

        $query = UserAnswer::where('user_id', $user->id)->where('question_id', $question->id);

        if ($query->exists()) {
            return response()->json([
                'message'     => 'This question was solved ^_^',
                'user_points' => $user->points,
            ], 200);
        }

        if (!$user || !$question) {
            return response()->json([
                'message' => 'User or Question not found'
            ], 404);
        }

        // $points = $question->point;
        // $points += $question->point;

        // $user->update([
        //     "points" => $points
        // ]);
        $user->points += $question->point;
        $user->save();
        UserAnswer::create([
            'user_id' => $user->id,
            'question_id' => $question->id,
            'answer_id' => $request->answer_id,
        ]);


        return response()->json([
            'message' => 'Score updated successfully',
            'user' => $user
        ], 200);
    }
    public function get_user_answers($id)
    {
        $user = User::find($id);
        if (! $user) {
            return response()->json([
                'message' => 'User not found broo ^_^',
            ], 404);
        }
        $answers = UserAnswer::where('user_id', $user->id)->get();
        return response()->json([
            'user' => $user,
            'answers' => $answers,
        ], 200);
    }
    public function getUserProgress(Request $request)
    {
        $userId = $request->input('user_id');


        $lessonsProgress = [];

        $userAnswers = UserAnswer::where('user_id', $userId)
            ->with('questio.topic.lesson')
            ->get();

        $groupedByLesson = $userAnswers->groupBy(function ($answer) {
            return $answer->questio->topic->lesson->id ?? null;
        });

        foreach ($groupedByLesson as $lessonId => $answers) {
            if ($lessonId === null) continue;

            $lessonName = $answers->first()->questio->topic->lesson->name ?? 'Unknown Lesson';

            $questionsInLesson = Question::whereHas('topic', function ($query) use ($lessonId) {
                $query->where('lesson_id', $lessonId);
            })->count();

            $solvedQuestions = $answers->count();

            $percentage = $questionsInLesson > 0 ? ($solvedQuestions / $questionsInLesson) * 100 : 0;

            $lessonsProgress[] = [
                'lesson_id' => $lessonId,
                'lesson_name' => $lessonName,
                'solved_questions' => $solvedQuestions,
                'total_questions' => $questionsInLesson,
                'progress_percentage' => round($percentage, 2),
            ];
        }

        $challenges = ChallengeSubission::where('user_id', $userId)
            ->with('challenge')
            ->get()
            ->map(function ($submission) {
                return [
                    'challenge_id' => $submission->challenge_id,
                    'challenge_name' => $submission->challenge->name ?? '',
                    'difficulty' => $submission->challenge->difficulty ?? '',
                    'points' => $submission->challenge->points ?? 0,
                    'status' => $submission->status,
                    'admin_feedback' => $submission->admin_feedback,
                    'submitted_at' => $submission->submitted_at,
                ];
            });


        return response()->json([
            'lessons_progress' => $lessonsProgress,
            'challenges' => $challenges,
        ]);
    }

    public function challenge_submission_store(Request $request)
    {

        $request->validate([
            'challenge_id' => 'required|exists:challenges,id',
            'report_file' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg',
        ]);


        $filePath = $request->file('report_file')->store('challenge_reports', 'public');


        $submission = ChallengeSubission::create([
            'user_id' => $request->user_id,
            'challenge_id' => $request->challenge_id,
            'report_file_path' => $filePath,
            'status' => 'pending',
            'admin_feedback' => 'under reviewing',
            'submitted_at' => now(),
        ]);

        return response()->json([
            'message' => 'Challenge submission created successfully!',
            'submission' => $submission,
        ], 201);
    }
}
