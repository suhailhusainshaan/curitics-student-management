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
              <div class="col-sm-3"><h3 class="mb-0">Student Management</h3></div>
              <div class="col-sm-7">
              
              </div>
              <div class="col-sm-2">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Students</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <div class="row">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible">
                <h5> Success!</h5>
                {{ $message }}
            </div>
            @endif
            <div class="col-md-12">
            <div class="card">
              <div class="card-header">
              <div class="d-flex align-items-center">
                <h3 class="card-title col-md-2">Students</h3>
                <div class="col-md-8">
                    <form action="{{ route('admin.students') }}" method="GET" class="search-form d-flex">
                        <div class="form-group me-2"> <!-- Use margin-end for spacing -->
                            <input type="text" value="{{ $phone }}" class="form-control responsive-input search-field" id="phone" name="phone" placeholder="Phone">
                        </div>

                        <div class="form-group me-2"> <!-- Use margin-end for spacing -->
                            <input type="text" value="{{ $student_name }}" class="form-control search-field" id="student_name" name="student_name" placeholder="Student Name">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" value="Submit">Search</button>
                            <a class="btn btn-warning" href="{{ route('admin.students') }}">Reset</a>
                        </div>
                    </form>
                </div>
                <a href="{{ route('admin.students.add') }}" class="btn btn-success bi-plus-circle ms-2">Add Student</a> <!-- Use margin-start for spacing -->
            </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                  @if(count($students))
                    <tr>
                      <th>Roll Number</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Class</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($students as $student)
                    <tr>
                      <td>{{$student->student->roll_number}}</td>
                      <td>{{$student->name}}</td>
                      <td>{{$student->phone}}</td>
                      <td>{{$student->student->class}}</td>
                      <td>
                        <a href="{{route('admin.students.view', ['id' => $student->id])}}"  class="btn btn-success bi bi-eye"></a>
                        <a href="{{route('admin.students.edit', ['id' => $student->id])}}"  class="btn btn-primary bi bi-pencil"></a>
                        <button class="btn btn-danger bi bi-trash3" onClick="remove({{$student->id}})"></button>
                      </td>
                    </tr>
                    @endforeach
                    @else
                    <thead><tr>No Data Found</tr></thead>
                    @endif
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                {{ $students->links('pagination::bootstrap-4') }}
              </div>
            </div>
          </div>
            </div>
          </div>
        </div>
      </main>
@endsection
@section('customScript')
<script>

    function remove(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(function (e) {

            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'GET',
                    url: "{{url('/admin-students-delete')}}/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {
                      console.log("Hello")
                        if (results.success === true) {
                          Swal.fire({
                            icon: "success",
                            title: "Student deleted successfully",
                            showConfirmButton: false,
                            timer: 1500
                          });
                            location.reload();
                        } else {
                          Swal.fire({
                            icon: "error",
                            title: "Something went wrong",
                            showConfirmButton: false,
                            timer: 1500
                          });
                        }
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }

</script>
@endsection