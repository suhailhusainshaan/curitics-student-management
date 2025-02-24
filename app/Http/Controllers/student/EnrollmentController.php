<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Auth;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student_id = Auth::user()->student->id;
        $enrollments = Student::with('enrollment')->where('id', $student_id)->first();
        //HasMany Relationship
        $enrollments = $enrollments->enrollment;
        
        return view('student.enrollment.index', compact('enrollments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $id)
    {
        $student_id = Auth::user()->student->id;
        $course = Course::where('id',$id)->first();
        if($course == null){
            return redirect()->back()->with('error','Course not found');
        }
        $enrollment = Enrollment::where('student_id', $student_id)->where('course_id', $id)->first();
        if($enrollment){
            $success = false;
            $message = "Student is already enrolled in this course";
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
            //return redirect()->route('student.enrollments')->with('error','Student is already enrolled in this course');
        }
        $enrollment = new Enrollment();
        $enrollment->student_id = $student_id;
        $enrollment->course_id = $id;
        $enrollment->save();
        $success = true;
        $message = "Enrollment created successfully";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student_id = Auth::user()->student->id;
        $enrollment = Enrollment::with('student.user')->where('id', $id)->where('student_id', $student_id)->first();
        
        return view('student.enrollment.show', compact('enrollment'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student_id = Auth::user()->student->id;
        $enrollment = Enrollment::where('id', $id)->where('student_id', $student_id)->first();
        $enrollment->delete();
        $success = true;
        $message = "Enrollment deleted successfully";

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
