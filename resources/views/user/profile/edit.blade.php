@extends('user.dashboard.app')

@section('title', 'Profile')

@section('content')

<div class="container">
    <br><br>
    <div class="row justify-content-center align-items-center">
        <form action="{{ route('profile.update',auth()->id()) }}" method="POST" class="col-md-4" >
           @csrf @method('PUT')
            @if(auth()->user()->avatar)
            <img src="{{ auth()->user()->avatar_url }}" class="img-fluid rounded-circle d-block mx-auto" width='250' alt="">
            @else
            <img src="{{ asset('images/noimg.png') }}" class="img-fluid rounded-circle d-block mx-auto" width='250' alt="">
            @endif
            <br>
            @if (session('message'))
                <div class="alert alert-success  alert-dismissible fade show">
                    {{session('message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" value="{{ auth()->user()->name }}"  readonly>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" value="{{ auth()->user()->email }}"  readonly>
            </div>
            <div class="form-group">
                <label>Change Password</label>
                <input type="password" class="form-control"" name="password" placeholder="•••••••••" >
            </div>
            <input type="file" name="avatar" id="user_image" >
            <button class="btn btn-dark form-control">Submit <i class="fas fa-paper-plane ml-1"></i> </button>
    </div>
</div>

@endsection