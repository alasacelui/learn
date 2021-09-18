@extends('layouts.app')

@section('content')

  <div class="container">
      <div class="row py-5">
          <div class="col-md-6 pb-5">
            <h4>{{ $course->title }}</h4>
            <small>By - Learn on {{ $course->created_at }}</small>
           <img src="{{ $course->imageUrl }}" alt="course.jpg" class="img-thumbnail mt-2 mb-1">
           <h3 class="font-weight-normal">{{ $course->subtitle }}</h3>
           <br>
           <div class="px-2">
            <p class="lead font-weight-bold">What you'll learn</p>
            <div>
                @php
                    $courses = explode(';', $course->description)
                @endphp
                <ul>
                   @foreach ($courses as $c )
                       <li>{{ $c }}</li>
                   @endforeach
                </ul>
            </div>
           </div>
            <h5 class="font-weight-normal">Instructor: {{ $course->instructor }}</h5>
            <br>
           @if(auth()->user())
            <button class="btn btn-dark form-control"> Buy me <i class="fas fa-code ml-1 text-danger"></i> </button>
           @else
            <button class="btn btn-dark form-control">You are not logged in<i class="fas fa-exclamation ml-1 text-info"></i>  </button>
           @endif

          </div>
          <div class="col-md-6 text-center ">
              <div class="row">
                  <div class="col-md-12">
                    <h5 class="text-uppercase font-weight-normal mb-4">Search your favorite course <i class="fas fa-search ml-1"></i>  </h5>
                    <form class="row">
                        <div class="input-group col-md-8 mx-auto">
                            <input type="text" class="form-control" placeholder="Write something here..." required>
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button">Search</button>
                             </div>
                        </div>
                    </form>
                  </div>
              </div>
             <br>
              <div class="row">
                  <div class="col-md-12">
                    <h5 class="text-uppercase font-weight-normal mt-5">Subscribe to Blog via email <i class="fas fa-envelope ml-1"></i>  </h5>
                    <p>Join 4,998 other subscribers</p>
                    <form class="row">
                        <div class="input-group col-md-8 mx-auto">
                            <input type="email" class="form-control" placeholder="john@email.com" required>
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button">Subscribe</button>
                             </div>
                        </div>
                    </form>
                  </div>
              </div>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="font-weight-normal"> Popular Tags</h4>
                    <hr>
                    <div class="card bg-transparent">
                        <div class="card-body">
                            @foreach ($categories as $category )
                                <span class="badge badge-primary p-2 ">{{ $category->category }}</span>
                            @endforeach
                        </div>
                    </div>
                  </div>
            </div>
            <br>
            <br>
            <div class="row">
                <h6 class="ml-2">You might also Like</h6>
                <div class="card-deck">
                    @foreach ($other_courses as $course )
                        <div class="card pt-3 p-3">
                            <img src="{{$course->imageUrl}}" class="card-img-top" alt="course.jpg">
                            <br>
                            <a href="{{ route('course.show', $course->id) }}" class="text-decoration-none">
                                <q class="card-title text-secondary course_desc">{{ $course->title }}</q>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
      </div>
  </div>

@endsection