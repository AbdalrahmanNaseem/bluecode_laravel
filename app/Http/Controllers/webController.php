<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\lesson;
use App\Models\Level;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'user_id'     => 'required|integer|exists:users,id',
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


        Course::create($data);

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
        ]);

        $topic->name = $request->name;
        $topic->lesson_id = $request->lesson_id;

        if ($request->hasFile('image')) {
            if ($topic->image && Storage::disk('public')->exists($topic->image)) {
                Storage::disk('public')->delete($topic->image);
            }

            $path = $request->file('image')->store('topics', 'public');
            $topic->image = $path;
        }

        $topic->save();

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
}
