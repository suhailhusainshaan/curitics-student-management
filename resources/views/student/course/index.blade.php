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
              <div class="col-sm-6"><h3 class="mb-0">Course Management</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{route('student.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Course</li>
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
                <h3 class="card-title col-md-10">Courses</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                  @if(count($courses))
                    <tr>
                      <th>Unique ID</th>
                      <th>Name</th>
                      <th>Added Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($courses as $course)
                    <tr>
                      <td>{{$course->course_identifier}}</td>
                      <td>{{$course->course_name}}</td>
                      <td>{{$course->created_at->format('Y-m-d')}}</td>
                      <td>{{$course->active ? "Active" : "Deactivated"}}</td>
                      <td>
                        <a href="{{route('student.courses.show', ['id' => $course->id])}}"  class="btn btn-success bi bi-eye"></a>
                        <button class="btn btn-warning bi-cart-plus" onClick="enrol({{$course->id}})">Enrol</button>
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
                {{ $courses->links('pagination::bootstrap-4') }}
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

    function enrol(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Enrol it!"
      }).then(function (e) {

            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'GET',
                    url: "{{url('/student/course/enrol')}}/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {
                        if (results.success === true) {
                          Swal.fire({
                            icon: "success",
                            title: "Enrolled successfully",
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