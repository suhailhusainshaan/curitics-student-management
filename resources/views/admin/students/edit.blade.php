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
              <form method="POST" action="{{route('admin.students.update', ['id' => $student->id])}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Roll Number</label>
                      <input type="text" class="form-control" value="{{$student->student->roll_number}}" disabled readonly>
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Class</label>
                      <input type="text" class="form-control" name="class" value="{{$student->student->class}}">
                      <x-input-error :messages="$errors->get('class')" style="color:red" class="mt-2" />
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" name="name" value="{{$student->name}}">
                      <x-input-error :messages="$errors->get('name')" style="color:red" class="mt-2" />
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Phone</label>
                      <input type="text" name="phone" class="form-control" value="{{$student->phone}}">
                      <x-input-error :messages="$errors->get('phone')" style="color:red" class="mt-2" />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Date Of Birth</label>
                    <input type="text" name="dob" class="form-control" value="{{$student->student->dob}}">
                    <x-input-error :messages="$errors->get('dob')" style="color:red" class="mt-2" />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" value="{{$student->email}}">
                    <x-input-error :messages="$errors->get('email')" style="color:red" class="mt-2" />
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" onClick="updated()">Submit</button>
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