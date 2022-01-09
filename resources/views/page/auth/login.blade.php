@extends('layouts.auth.main')

@section('title')
Login
@endsection

@section('content')
<div class="row mb-3">
      <div class="col text-center">
            <h1>Login</h1>
      </div>
</div>

@if (session('login_status'))
<div class="row justify-content-center">
      <div class="col-md-6">
            <div class="alert alert-danger">
                  {{ session('login_status') }}
            </div>
      </div>
</div>
@endif

<div class="row justify-content-center">
      <div class="col-md-6">
            <div class="card shadow-sm bg-body">
                  <div class="card-body p-3">
                        <form action="{{ route('login') }}" method="post">
                              @csrf
                              <div class="mb-3">
                                    <label for="">E - mail</label>
                                    <input type="text" class="form-control" name="email">
                              </div>
                              <div class="mb-3">
                                    <label for="">Password</label>
                                    <input type="text" class="form-control" name="password">
                              </div>
                              <div class="row justify-content-between align-items-center">
                                    <div class="col-12 mb-2">
                                          <button type="submit" class="btn btn-primary d-inline-block w-100">Submit</button>
                                    </div>
                                    <div class="col-12 text-center">
                                          <div>Don't have account <a href="{{ route('register') }}" class="text-decoration-none">Register</a></div>
                                    </div>
                              </div>
                        </form>
                  </div>
            </div>
      </div>
</div>

@endsection