@extends('layouts.app')

@section('content')

  <div class="main" id="top">
    <div class="jumbotron jumbotron-fluid text-white m-0 text-sm-center text-lg-left default_bg" >
        <div class="container ">
            <div class="row">
                <div class="d-flex">
                    <div class="section-1-text py-5 p-2">
                        <br>
                        <h1 class="display-4">Download Courses for <span class='text-primary font-weight-bold'>Cheap Price ! </span> </h1>
                        <p class="lead">Get your desired online courses here for a cheaper cost.</p>
                            <a class="btn btn-primary" href="#">Learn More</a>
                    </div>
                   
                    <img class="img-fluid d-none d-lg-block" src="{{ asset('images/progrmamer2.gif') }}" width="600" alt="">
                </div>
            </div>
        </div>
    </div>
  </div>

  <section id="transform" data-aos="zoom-in-up" data-aos-duration="1000">
    <div class="jumbotron jumbotron-fluid bg-light" >
        <div class="container text-center">
            <h2 class="mb-5 text-primary font-weight-bold">Transform your life through education</h2>
            <p>Learners around the world are launching new careers, advancing in their fields, and enriching their lives.</p>
            <br><br>
            <div class="row">
               <div class="col-md-4">
                   <div class="card">
                <div class="card-body">
                        <img class="img-fluid" src="{{ asset('images/sec1/img.svg') }}" alt="">
                       </div>
                   </div>
               </div>
               <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <img class="img-fluid" src="{{ asset('images/sec1/img2.svg') }}" alt="">
                    </div>
                </div>
                <a class="btn btn-lg btn-primary d-none d-sm-block" href="/register">JOIN NOW <i class="fas fa-paper-plane ml-1"></i></a>
               </div>
               <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <img class="img-fluid" src="{{ asset('images/sec1/img3.svg') }}" alt="">
                        
                    </div>
                </div>
               </div>
            </div>
        </div>
    </div>
  </section>

  <section id="services" data-aos="zoom-in-up" data-aos-duration="1000">
    <div class="jumbotron jumbotron-fluid bg-white" >
        <div class="container text-center">
            <h2 class="mb-5 text-primary font-weight-bold">Latest Courses</h2>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nisi veritatis molestias, architecto accusantium illum voluptatem? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Suscipit, nobis praesentium? Sunt minus itaque provident! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Omnis, libero!</p>
            <br><br>
            <div class="row">
                <div class="card-deck">
                    @foreach ($courses as $course )
                        <div class="card pt-3 shadow p-3 mb-5 bg-white rounded">
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
  </section>


  <section id="contact" data-aos="zoom-in-up" data-aos-duration="1000">
    <div class="jumbotron jumbotron-fluid bg-white m-0" >
        <div class="container">
           <div class="row justify-content-center">
               <div class="col-md-6">
                   <img src="{{ asset('images/contact/1.svg') }}" class="img-fluid" alt="contact.jpg">
               </div>
               <div class="col-md-6">
                <form action="{{ route('store') }}" method="POST" class=" p-5" autocomplete="off">
                    @csrf
                   <h2 class="text-primary font-weight-normal">Connect with Us</h2><br>
                    @if (session('message'))
                        <div class="alert alert-success  alert-dismissible fade show">
                            {{session('message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger  alert-dismissible fade show">
                       <ul>
                           @foreach ($errors->all() as $error )
                           <li>{{ $error }}</li>
                           @endforeach
                       </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="name" required>
                    </div>
    
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" required>
                    </div>
    
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" rows="8" name="message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" type="button">Send <i class="fas fa-paper-plane ml-1"></i> </button><br>
                   </form>
               </div>
              
           </div>
        </div>
    </div>
  </section>
  <a class="btn-fab animate__animated animate__bounceIn" data-scroll-to="#top" href="javascript:void(0)" id="scroll_to_top" onclick="scrollToTop()">
  <i
    class="fas fa-chevron-up"
    style="padding: 20px; font-size: 1.5rem; text-align: center; text-decoration: none;"
  ></i>
</a>
  <footer class="bg-dark py-5">
    <div class="container ">
        <div class="row justify-content-center">
            <h1 class="lead text-white">All rights reserved <span class="text-primary">Learn &copy; 2021</span></h1>
        </div>
    </div>

  </footer>
 

@endsection

@section('scripts')
  <script src="{{ asset('js/scroll.js') }}"></script>
@endsection
