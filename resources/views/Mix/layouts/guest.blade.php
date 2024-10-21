<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ public_asset('/css/dashboard.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body  style="direction:{{ lang('en') ? 'ltr' : 'rtl' }}" class=" d-flex align-items-center  min-vh-100 w-100">
    <div class="row g-0 auth-row h-100 w-100">
        @yield('content')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
        @stack('js')
    </div>
</body>
</html>
