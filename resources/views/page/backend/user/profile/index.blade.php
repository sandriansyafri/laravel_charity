@extends('layouts.backend.main')

@section('title')
Profile
@endsection

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <x-card>
            <x-slot name="header">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings Password</a></li>
                </ul>
            </x-slot>
            <div class="tab-content">
                <div class="tab-pane active" id="profile">
                    @include('page.backend.user.profile.update-profile')
                </div>
                <div class="tab-pane " id="settings">
                    @include('page.backend.user.profile.update-password')
                </div>
            </div>

        </x-card>
    </div>
</div>
@endsection