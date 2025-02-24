<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Enrollment::with('student.user')->paginate(10);
        
        return view('admin.enrollment.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        $students = Student::with('user')->get();
        return view('admin.enrollment.add', compact('courses', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = Student::where('id',$request->student_id)->first();
        $course = Course::where('id',$request->course_id)->first();
        if($student == null){
            return redirect()->back()->with('error','Student not found');
        }
        if($course == null){
            return redirect()->back()->with('error','Course not found');
        }
        $enrollment = Enrollment::where('student_id', $request->student_id)->where('course_id', $request->course_id)->first();
        if($enrollment){
            return redirect()->route('admin.enrollments')->with('error','Student is already enrolled in this course');
        }
        $enrollment = new Enrollment();
        $enrollment->student_id = $request->student_id;
        $enrollment->course_id = $request->course_id;
        $enrollment->save();
        return redirect()->route('admin.enrollments')->with('success','Enrollment created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $enrollment = Enrollment::with('student.user')->where('id', $id)->first();
        
        return view('admin.enrollment.show', compact('enrollment'));
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
        $enrollment = Enrollment::find($id);
        $enrollment->delete();
        $success = true;
        $message = "Course deleted successfully";

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
