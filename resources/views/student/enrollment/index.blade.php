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
              <div class="col-sm-6"><h3 class="mb-0">Enrollment Management</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{route('student.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Enrollment</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <div class="row">
            @if ($error = Session::get('error'))
            <div class="alert alert-danger alert-dismissible">
                <h5> Error!</h5>
                {{ $error }}<br/>
            </div>
            @endif
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible">
                <h5> Success!</h5>
                {{ $message }}
            </div>
            @endif
            <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title col-md-10">Enrollment</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                  @if(count($enrollments))
                    <tr>
                      <th>Unique ID</th>
                      <th>Course Name</th>
                      <th>Student Name</th>
                      <th>Added Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($enrollments as $enrollment)
                    <tr>
                      <td>{{$enrollment->id}}</td>
                      <td>{{$enrollment->course->course_name}}</td>
                      <td>{{$enrollment->student->user->name}}</td>
                      
                      <td>{{$enrollment->created_at->format('Y-m-d')}}</td>
                      <td>{{$enrollment->active ? "Active" : "Deactivated"}}</td>
                      <td>
                        <a href="{{route('student.enrollment.show', ['id' => $enrollment->id])}}"  class="btn btn-success bi bi-eye"></a>
                        <button class="btn btn-danger bi bi-trash3" onClick="remove({{$enrollment->id}})"></button>
                      </td>
                    </tr>
                    @endforeach
                    @else
                    No Data Found
                    @endif
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
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
                    url: "{{url('/student/enrollment/cancel')}}/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {
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