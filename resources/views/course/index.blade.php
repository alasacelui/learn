@extends('layouts.admin.app')

@section('styles')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')


@include('layouts.admin.modal')

<div class="container-fluid px-5">
        <div class="py-3  text-center">
            <button class="btn btn-primary ml-auto" onclick="toggle_modal('#m_course', '.c_form', ['#m_course_title','Add Course'], ['.btn_add_course', '.btn_update_course'], {rname:'course.create', target:'#course_category'})">
                Create Course <i class="fas fa-plus-circle ml-1" ></i>
              </button>
        </div>
      <table class="table table-bordered table-hover mt-4 course_dt" >
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Subtitle</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Instructor</th>
                  <th>Photo</th>
                  <th>Category</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody class="course_dtbody">
                {{--Display Courses--}}
          </tbody>
      </table>
</div>
@endsection

@section('scripts')
    {{--DT--}}
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap4.min.js"></script>
    {{--FP--}}
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    {{--Script--}}
    <script  src="{{ asset('js/admin/script.js') }}" ></script>

@endsection