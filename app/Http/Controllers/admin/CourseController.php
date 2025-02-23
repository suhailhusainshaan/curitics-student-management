<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::paginate(10);
        return view('admin.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_name' => ['required', 'string', 'max:255'],
            'course_identifier' => ['required', 'string', 'max:255', Rule::unique('courses')],
            'description' => ['required', 'string', 'min:10'],
        ]);

        $course = new Course();
        $course->course_name = $request->course_name;
        $course->description = $request->description;
        $course->course_identifier = $request->course_identifier;
        $course->active = true;
        $course->save();
        return redirect()->route('admin.courses')->with('success','Course created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::where('id', $id)->first();
        if(is_null($course))
            return view('admin.no_data');
        return view('admin.course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::where('id', $id)->first();
        if(is_null($course))
            return view('admin.no_data');
        return view('admin.course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'course_name' => ['required', 'string', 'max:255'],
            'course_identifier' => ['required', 'string', 'max:255', Rule::unique('courses')->ignore($id)],
            'description' => ['required', 'string', 'min:10'],
        ]);

        $course = Course::find($id);
        $course->course_name = $request->course_name;
        $course->description = $request->description;
        $course->course_identifier = $request->course_identifier;
        $course->active = true;
        $course->save();
        return redirect()->route('admin.courses')->with('success','Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);
        $course->delete();
        $success = true;
        $message = "Course deleted successfully";

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
