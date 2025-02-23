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
              <div class="col-sm-6"><h3 class="mb-0">Student Details</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{route('admin.students')}}">Students</a></li>
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
                <h3 class="card-title">{{$student->name}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Roll Number</label>
                    <input type="text" class="form-control" value="{{$student->student->roll_number}}" readonly disabled>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Class</label>
                    <input type="text" class="form-control" value="{{$student->student->class}}" readonly disabled>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" value="{{$student->name}}" readonly disabled>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="text" class="form-control" value="{{$student->phone}}" readonly disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Date Of Birth</label>
                    <input type="text" class="form-control" value="{{$student->student->dob}}" readonly disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" value="{{$student->email}}" readonly disabled>
                  </div>
                </div>
            </div>
          </div>
            </div>
          </div>
        </div>
      </main>
@endsection