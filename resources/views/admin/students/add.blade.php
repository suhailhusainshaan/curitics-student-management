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
              <div class="col-sm-6"><h3 class="mb-0">Add Student</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{route('admin.students')}}">Students</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add</li>
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
                <h3 class="card-title">New Student</h3>
              </div>
              <form method="POST" action="{{route('admin.students.add')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" name="name" value="" required>
                      <x-input-error :messages="$errors->get('name')" style="color:red" class="mt-2" />
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Class</label>
                      <input type="text" class="form-control" name="class" value="" required>
                      <x-input-error :messages="$errors->get('class')" style="color:red" class="mt-2" />
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Phone</label>
                      <input type="text" name="phone" class="form-control" value="" required>
                      <x-input-error :messages="$errors->get('phone')" style="color:red" class="mt-2" />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Date Of Birth</label>
                    <input type="text" name="dob" class="form-control" value="" required>
                    <x-input-error :messages="$errors->get('dob')" style="color:red" class="mt-2" />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" value="" required  autocomplete="off">
                    <x-input-error :messages="$errors->get('email')" style="color:red" class="mt-2" />
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" class="form-control" value="" required>
                    <x-input-error :messages="$errors->get('password')" style="color:red" class="mt-2" />
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" value="" required>
                    <x-input-error :messages="$errors->get('password_confirmation')" style="color:red" class="mt-2" />
                  </div>
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