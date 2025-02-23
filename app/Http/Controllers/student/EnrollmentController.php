<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
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
        $enrollments = Enrollment::with('student.user')->where('student_id', $student_id)->paginate(10);
        
        return view('student.enrollment.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $enrollment = new Enrollment();
        $enrollment->student_id = $student_id;
        $enrollment->course_id = $id;
        $enrollment->save();
        $success = true;
        $message = "Enrollment deleted successfully";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
        
        //return redirect()->route('student.enrollment')->with('success','Enrollment created successfully');
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
