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
              <div class="col-sm-6"><h3 class="mb-0">Edit Course</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{route('admin.courses')}}">Course</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
              <form method="POST" action="{{route('admin.course.update', ['id' => $course->id])}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Course Identifier</label>
                      <input type="text" class="form-control" name="course_identifier" value="{{$course->course_identifier}}" required>
                      <x-input-error :messages="$errors->get('course_identifier')" style="color:red" class="mt-2" />
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Course Name</label>
                      <input type="text" class="form-control" name="course_name" value="{{$course->course_name}}" required>
                      <x-input-error :messages="$errors->get('course_name')" style="color:red" class="mt-2" />
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Course Description</label>
                      <textarea name="description" class="form-control" rows="7">{{$course->description}}</textarea>
                      <x-input-error :messages="$errors->get('description')" style="color:red" class="mt-2" />
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