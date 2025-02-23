<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class StudentController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $students = User::where('role_id', config('constants.STUDENT_ROLE_ID'))->count();
        $courses = Course::count();
        $enrollments = Enrollment::count();
        return view('admin.index', compact('students', 'courses', 'enrollments'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $phone = $request->phone;
        $student_name = $request->student_name;

        $students = User::with('student')->where('role_id', config('constants.STUDENT_ROLE_ID'));
        if(!is_null($phone)) {
            $students = $students->where('phone',$phone);
        }
        if(!is_null($student_name)) {
            $students = $students->where("name",'like',"%$student_name%");
        }
        $students = $students->OrderBy('id','desc')
                    ->paginate(10);
        return view('admin.students.index', compact('students', 'phone', 'student_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roll_number = Student::max('roll_number');
        is_null($roll_number) ? $roll_number = 1 : $roll_number = ($roll_number + 1);
        return view('admin.students.add', compact('roll_number'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')],
            'phone' => ['required', 'string', 'max:10', 'min:10', Rule::unique('users')],
            'dob' => ['required', 'date'],
            'class' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        $roll_number = Student::max('roll_number');
        is_null($roll_number) ? $roll_number = 1 : $roll_number = ($roll_number + 1);

        $user = new User();
        $student = new Student();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role_id = config('constants.STUDENT_ROLE_ID');
        $user->password = Hash::make($request->password);
        $user->save();
        $student->user_id = $user->id;
        $student->dob = $request->dob;
        $student->class = $request->class;
        $student->roll_number = $roll_number;
        $user->save();
        $student->save();
        return redirect()->route('admin.students')->with('success','Student created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = User::with('student')->where('id', $id)->where('role_id', config('constants.STUDENT_ROLE_ID'))->first();
        if(is_null($student))
            return view('admin.no_data');
        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = User::with('student')->where('id', $id)->where('role_id', config('constants.STUDENT_ROLE_ID'))->first();
        if(is_null($student))
            return view('admin.no_data');
        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'phone' => ['required', 'string', 'max:10', 'min:10', Rule::unique('users')->ignore($id)],
            'dob' => ['required', 'date'],
            'class' => ['required']
        ]);

        $user = User::find($id);
        if(is_null($user)){
            return view('admin.no_data');
        } else {
            $student = Student::where('user_id', $user->id)->first();
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $student->dob = $request->dob;
        $student->class = $request->class;
        $user->save();
        $student->save();
        return redirect()->route('admin.students')->with('success','Student created successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $student = Student::find($id);
        $user = User::find($student->user_id);
        $student->delete();
        $user->delete();
        $success = true;
        $message = "Course deleted successfully";

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
