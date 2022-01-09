@extends('layouts.auth.main')

@section('title')
    Register
@endsection

@section('content')
    <div class="row mb-3">
          <div class="col text-center">
                <h1>Register</h1>
          </div>
    </div>

    <div class="row justify-content-center">
          <div class="col-md-6">
               <div class="card shadow-sm bg-body">
                     <div class="card-body p-5">
                        <form action="{{ route('register') }}" method="post">
                              @csrf
                              <div class="mb-3">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control rounded-0"  name="name" value="{{ old('name') }}">
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                              </div>
                              <div class="mb-3">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control rounded-0"  name="username" value="{{ old('username') }}">
                                    @error('username') <small class="text-danger">{{ $message }}</small> @enderror
                              </div>
                              <div class="mb-3">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control rounded-0"  name="email" value="{{ old('email') }}">
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                              </div>
                              <div class="mb-3">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control rounded-0"  name="password">
                                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                              </div>
                              <div class="mb-3">
                                    <label for="">Password Confirm</label>
                                    <input type="password" class="form-control rounded-0"  name="password_confirmation">
                                    @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
                              </div>
                              <div class="row justify-content-between align-items-center">
                                    <div class="col-12 mb-2">
                                          <button type="submit" class="btn btn-primary d-inline-block w-100">Submit</button>
                                    </div>
                                    <div class="col-12 text-center">
                                          <div>Have account ? <a href="{{ route('login') }}" class="text-decoration-none">Login</a></div>
                                    </div>
                              </div>
                        </form>
                     </div>
               </div>
          </div>
    </div>

@endsection