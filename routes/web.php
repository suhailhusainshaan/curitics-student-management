<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\student\StudentController;
use App\Http\Controllers\admin\StudentController as AdminStudent;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\EnrollmentController;
use App\Http\Controllers\student\CourseController as StudentCourse;
use App\Http\Controllers\student\EnrollmentController as StudentEnrollment;

Route::get('/', function () {
    return Redirect::route('login');
})->name('/');

Route::get('/dashboard', [StudentController::class, 'index'])->middleware(['auth', 'student'])->name('dashboard');

//Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    //Students Route
    Route::get('/admin/dashboard', [AdminStudent::class, 'home'])->name('admin.dashboard');
    Route::get('/admin/students', [AdminStudent::class, 'index'])->name('admin.students');
    Route::get('/admin/students/view/{id}', [AdminStudent::class, 'show'])->name('admin.students.view');
    Route::get('/admin/students/edit/{id}', [AdminStudent::class, 'edit'])->name('admin.students.edit');
    Route::post('/admin/students/update/{id}', [AdminStudent::class, 'update'])->name('admin.students.update');
    Route::get('/admin/students/delete/{id}', [AdminStudent::class, 'destroy'])->name('admin.students.delete');
    Route::get('/admin/students/add', [AdminStudent::class, 'create'])->name('admin.students.add');
    Route::post('/admin-students-add', [AdminStudent::class, 'store'])->name('admin.students.add');

    //Courses Routes
    Route::get('/admin/courses', [CourseController::class, 'index'])->name('admin.courses');
    Route::get('/admin/courses/add', [CourseController::class, 'create'])->name('admin.course.add');
    Route::post('/admin/courses/add', [CourseController::class, 'store'])->name('admin.course.add');
    Route::get('/admin/course/view/{id}', [CourseController::class, 'show'])->name('admin.course.show');
    Route::get('/admin/course/edit/{id}', [CourseController::class, 'edit'])->name('admin.course.edit');
    Route::post('/admin/course/update/{id}', [CourseController::class, 'update'])->name('admin.course.update');
    Route::get('/admin/course/delete/{id}', [CourseController::class, 'destroy'])->name('admin.course.delete');

    //Enrollment Routes
    Route::get('/admin/enrollments', [EnrollmentController::class, 'index'])->name('admin.enrollments');
    Route::get('/admin/enrollment/add', [EnrollmentController::class, 'create'])->name('admin.enrollment.add');
    Route::post('/admin/enrollment/add', [EnrollmentController::class, 'store'])->name('admin.enrollment.add');
    Route::get('/admin/enrollment/view/{id}', [EnrollmentController::class, 'show'])->name('admin.enrollment.show');
    Route::post('/admin/enrollment/edit/{id}', [EnrollmentController::class, 'update'])->name('admin.enrollment.update');
    Route::get('/admin/enrollment/delete/{id}', [EnrollmentController::class, 'destroy'])->name('admin.enrollment.delete');
});

//Student Routes
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/student', [StudentController::class, 'index'])->name('student.dashboard');

    //Course Routes
    Route::get('/student/course', [StudentCourse::class, 'index'])->name('student.courses');
    Route::get('/student/course/show/{id}', [StudentCourse::class, 'show'])->name('student.courses.show');

    //Enrollment Routes
    Route::get('/student/enrollment', [StudentEnrollment::class, 'index'])->name('student.enrollment');
    Route::get('/student/enrollment/view/{id}', [StudentEnrollment::class, 'show'])->name('student.enrollment.show');
    Route::get('/student/enrollment/cancel/{id}', [StudentEnrollment::class, 'destroy'])->name('student.enrollment.cancel');
    Route::get('/student/course/enrol/{id}', [StudentEnrollment::class, 'store'])->name('student.enrollment.update');
    
});

require __DIR__.'/auth.php';
