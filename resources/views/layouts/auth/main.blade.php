
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ env('APP_NAME') }} | @yield('title')</title>

  @include('layouts.auth.parts.style')
</head>
<body class="hold-transition login-page">
@yield('content')

@include('layouts.auth.parts.script')
</body>
</html>
