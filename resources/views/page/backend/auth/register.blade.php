@extends('layouts.auth.main')

@section('title')
    Register
@endsection

@section('content')
<div class="register-box">
      <div class="card card-outline @if($errors->any()) card-danger @else card-primary @endif">
        <div class="card-header text-center">
          <a style="cursor: pointer;" class="h1"><b>{{ env('APP_NAME') }}</b></a>
        </div>
        <div class="card-body">
            


            @if ($errors->any())
            <div class="alert alert-danger p-2">
                  <ul class="list-group p-0">
                        @foreach ($errors->all() as $error)
                        <li class="list-group-item bg-transparent border-0 p-1">{{ $error }}</li>
                        @endforeach
                  </ul>
            </div>
            @else 
            <p class="login-box-msg">Register to start your session</p>
            @endif
    
          <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fa fa-id-card"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" name="password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block d-inline-block w-100 mb-2">Register</button>
              </div>
            </div>
          </form>
    
          <a href="{{ route('login') }}" class="text-center w-100 d-inline-block">I already have a membership</a>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>
@endsection