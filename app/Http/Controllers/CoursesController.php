<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Section;
use App\Models\User;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CoursesController extends Controller
{
    /** @return View */
    public function index(): View
    {
        $courses = Course::with(['section', 'professor', 'prerequisite'])
                         ->orderByDesc('course_id')
                         ->paginate(10);

        return view('courses.index', compact('courses'));
    }

    /** @return View */
    public function create(): View
    {
        $sections  = Section::select('section_id','name')->orderBy('name')->get();
        $professors= User::select('user_id','name')->orderBy('name')->get();
        $courses   = Course::select('course_id','title')->get();

        return view('courses.create', compact('sections','professors','courses'));
    }

    /** @return RedirectResponse */
    public function store(StoreCourseRequest $request): RedirectResponse
    {
        Course::create($request->validated());
        return redirect()->route('courses.index')->with('success','Course created successfully.');
    }

    /** @return View */
    public function show(Course $course): View
    {
        $course->load(['section','professor','prerequisite','dependentCourses']);
        return view('courses.show', compact('course'));
    }

    /** @return View */
    public function edit(Course $course): View
    {
        $sections  = Section::select('section_id','name')->orderBy('name')->get();
        $professors= User::select('user_id','name')->orderBy('name')->get();
        $courses   = Course::select('course_id','title')
                           ->where('course_id','!=',$course->course_id)
                           ->get();

        return view('courses.edit', compact('course','sections','professors','courses'));
    }

    /** @return RedirectResponse */
    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        $course->update($request->validated());
        return redirect()->route('courses.index')->with('success','Course updated successfully.');
    }

    /** @return RedirectResponse */
    public function destroy(Course $course): RedirectResponse
    {
        if ($course->dependentCourses()->exists()) {
            return back()->with('error','Cannot delete: this course is a prerequisite for others.');
        }

        $course->delete();
        return redirect()->route('courses.index')->with('success','Course deleted successfully.');
    }
}
