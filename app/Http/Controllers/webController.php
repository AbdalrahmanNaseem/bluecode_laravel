<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Challenge;
use App\Models\Course;
use App\Models\lesson;
use App\Models\Level;
use App\Models\Question;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class webController extends Controller
{
    public function index()
    {
        return view('layout.layout');
    }
    public function allUser()
    {
        $allUsers = User::all();
        return view('user-index', compact('allUsers'));
    }

    public function Level_index()
    {
        $levels = Level::all();
        return view('web.level.index', compact('levels'));
    }
    public function Level_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        Level::create([
            'name' => $request->name,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return redirect()->route('level.index')->with('success', 'Level created successfully.');
    }

    public function Level_update(Request $request, $id)
    {
        $level = Level::findOrFail($id);
        $level->update([
            'name' => $request->name,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return redirect()->route('level.index')->with('success', 'Level updated successfully!');
    }

    public function Level_destroy($id)
    {
        $level = Level::findOrFail($id);
        $level->delete();

        return redirect()->route('level.index')->with('success', 'Level deleted successfully!');
    }

    public function Course_index()
    {
        $courses = Course::with('user')->get();
        return view('web.Course.index', compact('courses'));
    }

    public function Course_store(Request $request)
    {
        $request->merge([
            'user_id' => (int) $request->input('user_id'),
        ]);
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255|unique:courses,name',
            'description' => 'required|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type'        => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data   = $validator->validated();

        $user = Auth::user();




        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $destinationPath = 'images/courses';
            $request->image->move(public_path($destinationPath), $imageName);
            $imagePath = $destinationPath . '/' . $imageName;
        }
        Course::create([
            'name'        => $data['name'],
            'description' => $data['description'],
            'image'       => $imagePath,
            'type'        => $data['type'],
            'user_id'     => $user->id,
        ]);


        return redirect()->route('Course.index')->with('success', 'Course created successfully');
    }


    public function Course_update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        // dd($request->type);


        $oldImage = $course->image;

        if ($request->hasFile('image')) {
            if ($oldImage && file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }

            $imageName = 'images/courses/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/courses'), basename($imageName));
            $course->image = $imageName;
        }

        $course->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $course->image,
            'type' => $request->type,

        ]);

        return redirect()->route('Course.index')->with('success', 'Course updated successfully');
    }



    public function Course_destroy($id)
    {
        $course = Course::findOrFail($id);

        if ($course->image && file_exists(public_path('images/courses/' . $course->image))) {
            unlink(public_path('images/courses/' . $course->image));
        }

        $course->delete();

        return redirect()->route('Course.index')->with('success', 'Course deleted successfully');
    }



    public function Courselessons_store(Request $request, $id)
    {
        $user = Auth::user();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $destinationPath = 'images/courses';
            $request->image->move(public_path($destinationPath), $imageName);
            $imagePath = $destinationPath . '/' . $imageName;
        }
        $lesson = lesson::create([
            'name' => $request->name,
            'image' => $imagePath,
            'course_id' => $id,
            'user_id' => $user->id,
        ]);
        return redirect()->route('Course.index')->with('success', 'Lesson created successfully');
    }

    public function lesson_index()
    {
        $courses = Course::all();
        $lessons = lesson::all();
        return view('web.lessons.index', compact("lessons", "courses"));
    }
    public function lesson_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $lesson = Lesson::findOrFail($id);

        $lesson->name = $request->name;
        $lesson->course_id = $request->course_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/lessons'), $imageName);
            $lesson->image = 'uploads/lessons/' . $imageName;
        }

        $lesson->save();

        return back()->with('success', 'Lesson updated successfully!');
    }

    public function lesson_store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/lessons'), $imageName);
            $imagePath = 'uploads/lessons/' . $imageName;
        }
        $user = Auth::user();


        lesson::create([
            'name' => $request->name,
            'course_id' => $request->course_id,
            'image' => $imagePath,
            'user_id' => $user->id
        ]);


        return back()->with('success', 'Lesson created successfully!');
    }

    public function lesson_destroy($id)
    {
        $lesson = lesson::findOrFail($id);

        if ($lesson->image && file_exists(public_path($lesson->image))) {
            unlink(public_path($lesson->image));
        }

        $lesson->delete();

        return redirect()->route('lesson.index')->with('success', 'Lesson deleted successfully');
    }

    public function topic_index()
    {
        $topics = Topic::all();
        $lessons = lesson::all();

        return view('web.Topic.index', compact('topics', 'lessons'));
    }


    public function topic_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'lesson_id' => 'required|exists:lessons,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $imagePath = $request->file('image')->store('topics', 'public');

        $user = Auth::user();

        Topic::create([
            'name' => $request->name,
            'image' => $imagePath,
            'lesson_id' => $request->lesson_id,
            'supject' => $request->supject,
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Topic created successfully.');
    }
    public function topic_update(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'lesson_id' => 'required|exists:lessons,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'supject' => 'nullable|string|max:255',
        ]);


        $imagePath = $topic->image;
        if ($request->hasFile('image')) {
            if ($topic->image && Storage::disk('public')->exists($topic->image)) {
                Storage::disk('public')->delete($topic->image);
            }

            $imagePath = $request->file('image')->store('topics', 'public');
        }
        $user = Auth::user();
        Topic::where('id', $id)->update([
            'name' => $request->name,
            'lesson_id' => $request->lesson_id,
            'supject' => $request->supject,
            'image' => $imagePath,
            'user_id' => $user->id,
        ]);

        return back()->with('success', 'Topic updated successfully.');
    }

    public function topic_destroy($id)
    {
        $topic = Topic::findOrFail($id);

        if ($topic->image && Storage::disk('public')->exists($topic->image)) {
            Storage::disk('public')->delete($topic->image);
        }

        $topic->delete();

        return redirect()->back()->with('success', 'Topic deleted successfully.');
    }
    public function lessonsTopic_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lesson_id' => 'required|exists:lessons,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('topics', 'public');
        }
        $user = Auth::user();


        Topic::create([
            'name' => $request->name,
            'lesson_id' => $request->lesson_id,
            'image' => $imagePath,
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Topic added successfully.');
    }


    public function question_index()
    {
        $questions = Question::all();
        $topics = Topic::all();
        return view('web.Question.index', compact('questions', 'topics'));
    }

    public function question_store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'point' => 'required|numeric|min:0',
            'topic_id' => 'required|exists:topics,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('questions', 'public');
        }

        Question::create([
            'question' => $request->question,
            'subject' => $request->subject,
            'point' => $request->point,
            'image' => $imagePath,
            'topic_id' => $request->topic_id,
        ]);

        return redirect()->back()->with('success', 'Question added successfully.');
    }


    public function question_update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $request->validate([
            'question' => 'required|string|max:255',
            'point' => 'required|numeric|min:0',
            'topic_id' => 'required|exists:topics,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($question->image && Storage::disk('public')->exists($question->image)) {
                Storage::disk('public')->delete($question->image);
            }

            $imagePath = $request->file('image')->store('questions', 'public');
            $question->image = $imagePath;
        }

        $question->question = $request->question;
        $question->point = $request->point;
        $question->topic_id = $request->topic_id;
        $question->save();

        return redirect()->back()->with('success', 'Question updated successfully.');
    }

    public function question_destroy($id)
    {
        $question = Question::findOrFail($id);

        if ($question->image && Storage::disk('public')->exists($question->image)) {
            Storage::disk('public')->delete($question->image);
        }

        $question->delete();

        return redirect()->back()->with('success', 'Question deleted successfully.');
    }

    public function answer_index()
    {
        $answers = Answer::with('question')->get();
        $questions = Question::all();
        return view('web.Answer.index', compact('answers', 'questions'));
    }


    public function answer_store(Request $request)
    {
        $request->validate([
            'option' => 'required|string|max:255',
            'is_correct' => 'required|boolean',
            'question_id' => 'required|exists:questions,id',
        ]);

        Answer::create($request->all());

        return redirect()->route('answer.index')->with('success', 'Answer added successfully!');
    }

    public function answer_update(Request $request, $id)
    {
        $request->validate([
            'option' => 'required|string|max:255',
            'is_correct' => 'required|boolean',
            'question_id' => 'required|exists:questions,id',
        ]);

        $answer = Answer::findOrFail($id);
        $answer->update($request->all());

        return redirect()->route('answer.index')->with('success', 'Answer updated successfully!');
    }

    public function answer_destroy($id)
    {
        $answer = Answer::findOrFail($id);
        $answer->delete();

        return redirect()->route('answer.index')->with('success', 'Answer deleted successfully!');
    }



    public function challenge_index()
    {
        $challenges = Challenge::all();
        return view('web.Challenge.index', compact('challenges'));
    }

    public function challenge_store(Request $request)
    {


        $user = Auth::user();
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/lessons'), $imageName);
            $imagePath = 'uploads/lessons/' . $imageName;
        }

        // dd($user);

        Challenge::create([
            'name' => $request->name,
            'vm_download_link' => $request->vm_download_link,
            'points' => $request->points,
            'description' => $request->description,
            'image' => $imagePath,
            'difficulty' => $request->difficulty,
            'user_id' => $user->id,

        ]);

        return redirect()->back()->with('success', 'Challenge created successfully!');
    }


    public function challenge_update(Request $request, $id)
    {
        $challenge = Challenge::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/lessons'), $imageName);
            $imagePath = 'uploads/lessons/' . $imageName;

            if ($challenge->image && file_exists(public_path($challenge->image))) {
                unlink(public_path($challenge->image));
            }

            $challenge->image = $imagePath;
        }

        $challenge->name = $request->name;
        $challenge->description = $request->description;

        if ($request->has('vm_download_link')) {
            $challenge->vm_download_link = $request->vm_download_link;
        }

        if ($request->has('difficulty')) {
            $challenge->difficulty = $request->difficulty;
        }

        if ($request->has('points')) {
            $challenge->points = $request->points;
        }

        $challenge->save();

        return redirect()->back()->with('success', 'Challenge updated successfully!');
    }
}
