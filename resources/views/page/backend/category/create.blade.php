@extends('layouts.backend.main')

@section('title')
       Create Category
@endsection

@section('breadcrumb')
@parent
<li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <form action="{{ route('category.store') }}" method="post">
            @csrf
            <x-card >
                  <div class="">
                        <label for="">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                  </div>
                  <x-slot name="footer"  class="card">
                       <div class="d-flex justify-content-between">
                             <div>
                                    <button type="button" class="btn btn-warning mr-2">Reset</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                             </div>
                             <a href="{{ route('category.index') }}" class="btn btn-primary">Kembali</a>
                       </div>
                  </x-slot>
            </x-card>
            </form>
            
    </div>
</div>
@endsection
