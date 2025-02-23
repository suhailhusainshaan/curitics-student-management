@extends('layouts.default')
@section('customStyle')
<style>
.stylepadding{padding:10px !important;}
.padding-container{padding-bottom: 15px ; padding-top:25px;}

</style>
@endsection
@section('content')
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Add Course</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{route('admin.courses')}}">Enrollment</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        
        <div class="app-content">
          <div class="container-fluid">

            <div class="row">
            @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5> Error!</h5>
                        @foreach($errors->all() as $error)
                        {{ $error }}<br/>
                        @endforeach
                    </div>
                    @endif
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5> Success!</h5>
                        {{ $message }}
                    </div>
                    @endif
            <div class="col-md-8 offset-md-2">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">New Enrollment</h3>
              </div>
              <form method="POST" action="{{route('admin.enrollment.add')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Course Identifier</label>
                      <select class="form-control" name="student_id">
                        <option value="">Select Student</option>
                        @foreach($students as $student)
                        <option value="{{$student->id}}">{{$student->user->name}}</option>
                        @endforeach
                      </select>
                      <x-input-error :messages="$errors->get('course_identifier')" style="color:red" class="mt-2" />
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Course Name</label>
                      <select class="form-control" name="course_id">
                        <option value="">Select Course</option>
                        @foreach($courses as $course)
                        <option value="{{$course->id}}">{{$course->course_name}}</option>
                        @endforeach
                      </select>
                      <x-input-error :messages="$errors->get('course_name')" style="color:red" class="mt-2" />
                    </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
              </div>

          </div>
            </div>
          </div>
        </div>
      </main>
@endsection
@section('customScript')
<script>
  function updated(){
    Swal.fire({
      title: "Good job!",
      text: "You clicked the button!",
      icon: "success",
      showConfirmButton: false,
      timer: 1500
    });
      }
</script>
@endsection