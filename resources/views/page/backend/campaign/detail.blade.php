@extends('layouts.backend.main')

@section('title')
Detail Campaign
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <x-card>
            <x-slot name="header">
                <h1 class=" mb-0 font-weight-light">
                    {{ $campaign->title }}
                </h1>
                <div class="mb-3">
                    <strong>Di posting oleh :
                        <span class="text-primary ">
                            <a href="">
                                {{ $campaign->author->name }}
                            </a>
                        </span>
                    </strong>
                </div>
                <small class="text-sm badge badge-pill font-weight-normal badge-light rounded-sm">
                    {{ $campaign->updated_at->diffForHumans() }}
                </small>
            </x-slot>
            {!! $campaign->body !!}
        </x-card>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-12">
                <x-card>
                    <x-slot name="header">
                        Category
                    </x-slot>
                    <ul>
                        @forelse ($campaign->campaign_category as $campaign_category)
                        <li>
                            {{ $campaign_category->name }}
                        </li>
                        @empty
                        <p class="lead">(empty)</p>
                        @endforelse
                    </ul>
                </x-card>
            </div>
            <div class="col-12">
                <x-card>
                    <x-slot name="header">
                        Image
                    </x-slot>
                    <img src="{{ asset('images/campaign/') .'/' . $campaign->path_image }}" alt="..." class="card-img-top img-fluid">
                </x-card>
            </div>
            <div class="col-12">
                <x-card>
                    <h3>Rp.1000</h3>
                    <p style="font-size: 16px" class="lead">Terkumpul dari Rp. 900</p>
                    <div class="progress mb-3">
                        <div class="progress-bar" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">90%</div>
                    </div>
                    <div class="d-flex align-item-center justify-content-between mb-3">
                        <div class="text-sm">Tercapai Rp.10000</div>
                        <div class="text-sm">3 bulan lagi</div>
                    </div>
                    <div>
                          <h5 class="mb-3">Donatur ({{ count_donatur_campaign() }})</h5>
                          <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                              </li>
                              <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                              </li>
                              <li class="nav-item" role="presentation">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                              </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
                              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                            </div>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
</div>
@endsection