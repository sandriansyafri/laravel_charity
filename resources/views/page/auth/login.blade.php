@extends('layouts.auth.main')

@section('title')
    Log in
@endsection

@section('content')
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline @if($errors->any() || session('login_status')) card-danger @else card-primary @endif">
        <div class="card-header text-center">
            <a href="{{ asset('/') }}index2.html" class="h1"><b>{{ env('APP_NAME') }}</b></a>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger p-2">
                  <ul class="list-group ">
                        @foreach ($errors->all() as $error)
                        <li class="list-group-item bg-transparent border-0 p-1">{{ $error }}</li>
                        @endforeach
                  </ul>
            </div>
            @elseif(session('register_status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{ session('register_status') }}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            @elseif(session('login_status'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>{{ session('login_status') }}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            @else
            <p class="login-box-msg">Log in to start your session</p>
            @endif

            <form action="{{ route('login') }}" method="post">
                  @csrf
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
                <div class="row align-items-center">
                    <div class="col-8">
                        <div>
                            <a href="{{ route('register') }}">Register a new membership</a>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Log in</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
@endsection
