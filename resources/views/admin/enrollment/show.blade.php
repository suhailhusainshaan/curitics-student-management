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
              <div class="col-sm-6"><h3 class="mb-0">Enrollment Details</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{route('admin.enrollments')}}">Enrollment</a></li>
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
                <h3 class="card-title">{{$enrollment->id}}</h3>
              </div>
              <form method="POST" action="{{route('admin.course.add')}}">
                <div class="card-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Student Name</label>
                      <input type="text" class="form-control" value="{{$enrollment->student->user->name}}" readonly disabled>
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Student Email</label>
                      <input type="text" class="form-control" value="{{$enrollment->student->user->email}}" readonly disabled>
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Course Identifier</label>
                      <input type="text" class="form-control" value="{{$enrollment->course->course_identifier}}" readonly disabled>
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Course Name</label>
                      <input type="text" class="form-control" value="{{$enrollment->course->course_name}}" readonly disabled>
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Enrollment Date</label>
                      <input type="text" class="form-control" value="{{$enrollment->created_at->format('Y-m-d')}}" readonly disabled>
                    </div>
              </form>
              </div>

          </div>
            </div>
          </div>
        </div>
      </main>
@endsection