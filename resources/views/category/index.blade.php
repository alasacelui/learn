@extends('layouts.admin.app')

@section('title', 'Admin | Category')

@section('content')


@include('layouts.admin.modal')

<div class="container-fluid px-5">
        <div class="py-3  text-center">
            <button class="btn btn-primary ml-auto" onclick="toggle_modal('#m_category', '.category_form', ['#m_category_title','Add Category'], ['.btn_add_category','.btn_update_category'])">
                Create Category <i class="fas fa-plus-circle ml-1" ></i>
              </button>
        </div>
      <table class="table table-bordered table-hover mt-4 category_dt" >
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Category</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody class="category_dtbody">
                {{--Display Categories--}}
          </tbody>
      </table>
</div>
@endsection

