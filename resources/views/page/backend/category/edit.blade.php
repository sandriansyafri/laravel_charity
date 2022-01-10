@extends('layouts.backend.main')

@section('title')
Edit Category
@endsection

@section('breadcrumb')
@parent
<li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <form action="{{ route('category.update',$category->slug) }}" method="post">
            @csrf
            @method('put')
            <x-card>
                <div class="mb-0">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name',$category->name) }}">
                </div>

                <x-slot name="footer">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="button" class="btn btn-warning mr-2">Reset</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        <a href="{{ route('category.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </x-slot>
            </x-card>
        </form>

    </div>
</div>
@endsection