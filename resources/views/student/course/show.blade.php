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
              <div class="col-sm-6"><h3 class="mb-0">Course Details</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{route('student.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{route('student.courses')}}">Course</a></li>
                  <li class="breadcrumb-item active" aria-current="page">View</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        
        <div class="app-content">
          <div class="container-fluid">

            <div class="row">
            <div class="col-md-8 offset-md-2">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{$course->course_name}}</h3>
              </div>
              <form method="POST" action="{{route('admin.course.add')}}">
                <div class="card-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Course Identifier</label>
                      <input type="text" class="form-control" value="{{$course->course_identifier}}" readonly disabled>
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Course Name</label>
                      <input type="text" class="form-control" value="{{$course->course_name}}" readonly disabled>
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Course Description</label>
                      <textarea class="form-control" rows="7" readonly disabled>{{$course->description}}</textarea>
                    </div>
              </form>
              </div>

          </div>
            </div>
          </div>
        </div>
      </main>
@endsection