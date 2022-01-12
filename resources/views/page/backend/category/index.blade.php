@extends('layouts.backend.main')

@section('title')
Category
@endsection

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Category</li>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <x-card>
            <x-slot name="header">
                <a href="{{ route('category.create') }}" class="btn btn-primary">Add Category</a>
            </x-slot>

            <form action="{{ route('category.index') }}" method="get" class="d-flex justify-content-between mb-3">
                <x-table-rows-data></x-table-rows-data>
                <x-table-find-data></x-table-find-data>
            </form>
            <x-table>
                <x-slot name="thead">
                    <tr>
                        <th class="text-center" style="width: 10px">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                </x-slot>
                <tbody>
                    @forelse ($categories as $category)
                    <tr>
                        <td class="text-center">{{ $loop->iteration + (($categories->perPage() * $categories->currentPage()) - $categories->perPage()) }}</td>
                        <td class="text-center">{{ $category->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('category.edit',$category->slug) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('category.destroy',$category->slug) }}" method="post" class="d-inline-block">
                                @csrf
                                @method('delete')
                                <button onclick="return confirm('delete?')" type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <td colspan="3" class="text-center"><small style="font-style: italic">(empty)</small></td>
                    @endforelse
                </tbody>
                <x-slot name="tfoot">
                    <tr>
                        <td colspan="3">
                            <x-pagination-table :model="$categories"/>
                        </td>
                    </tr>
                </x-slot>
            </x-table>
        </x-card>
    </div>
</div>

@endsection

<x-toast />