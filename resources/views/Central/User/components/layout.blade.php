<!DOCTYPE html>
<html lang="en">
@include('Central.User.components.header')
<body>
    @php($show_nav_and_footer = !in_array(Route::currentRouteName(), ['client.login','client.register','client.forgetpassword']))

    @if ($show_nav_and_footer)
        @include('Central.User.components.navbar')
    @endif
    @yield('content')
    @if ($show_nav_and_footer)
        @include('Central.User.components.footer')
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    @include('sweetalert::alert', ['cdn' => "https://unpkg.com/sweetalert2@9"])
    @yield('js')
</body>
</html>
