<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>

    @include('layouts.backend.parts.style')
    @stack('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

     @include('layouts.backend.parts.navbar')

    @include('layouts.backend.parts.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div>
                    <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                             @section('breadcrumb')
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                              @show
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

    {{-- @include('layouts.backend.parts.footer') --}}

    </div>

    @include('layouts.backend.parts.script')
    @stack('js')
</body>

</html>
