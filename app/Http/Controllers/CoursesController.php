<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Log;
use App\Models\Section;
use App\Models\User;

class CoursesController extends Controller
{
    public function index(){

        $courses=Course::with(['section','user', 'prerequisite'])->get();
        return view('courses.index',['courses'=>$courses]);

    }

    public function create()
    {
        $sections = Section::all();
        $users=User::all();
        $courses=Course::all();

        return view('courses.create', compact('sections', 'users', 'courses'));
    }

    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'title' => 'required|max:100',
            'description' => 'nullable',
            'section_id' => 'nullable|exists:sections,id',
            'user_id' => 'nullable|exists:users,id',
            'prerequisite_id' => 'nullable|exists:courses,course_id',
        ]);

        try
        {
            $course=new Course();
            $course->title=$validatedData['title'];
            $course->description=$validatedData['description']?? null;
            $course->section_id=$validatedData['section_id']?? null;
            $course->user_id=$validatedData['user_id']?? null;
            $course->prerequisite_id=$validatedData['prerequisite_id']?? null;

            $course->save();

            return redirect()->route('courses.index')->with('succes', 'Course create successfully.');

        }catch(\Exception $ex){
            Log::error($ex);
        }
            return redirect()->route('courses.index')->with('error', 'Error creating the course.');

    }

    public function show(Course $course)
    {
        return view('courses.show', ['course' => $course]);
    }

    public function edit(Course $course)
    {
        $sections = Section::all();
        $users=User::all();
        $courses=Course::all();
        return view('courses.edit', ['course' => $course]);
    }

    public function update(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'description' => 'nullable',
            'section_id' => 'nullable|exists:sections,id',
            'user_id' => 'nullable|exists:users,id',
            'prerequisite_id' => 'nullable|exists:courses,course_id',
        ]);

        try {
            $course->title = $validatedData['title'];
            $course->description = $validatedData['description'] ?? null;
            $course->section_id = $validatedData['section_id'] ?? null;
            $course->user_id = $validatedData['user_id'] ?? null;
            $course->prerequisite_id = $validatedData['prerequisite_id'] ?? null;
            $course->save();

            return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
        } catch (\Exception $ex) {
            Log::error($ex);
        }

        return redirect()->route('courses.index')->with('error', 'Error updating the course.');
    }

    public function destroy(Course $course)
    {
        try {
            $course->delete();
            return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
        } catch (\Exception $ex) {
            Log::error($ex);
        }

        return redirect()->route('courses.index')->with('error', 'Error deleting the course.');
    }
}
