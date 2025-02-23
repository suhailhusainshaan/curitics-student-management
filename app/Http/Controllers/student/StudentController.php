<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Course;
use App\Models\Enrollment;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student_id = Auth::user()->student->id;
        $courses = Course::count();
        $enrollments = Enrollment::where('student_id', $student_id)->count();
        return view('student.index', compact('courses', 'enrollments'));
    }
}
