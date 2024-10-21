<!DOCTYPE html>
<html lang="en">
@include('Central.User.components.header')
@livewireStyles
<body>

    @yield('content')

    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    @include('sweetalert::alert', ['cdn' => "https://unpkg.com/sweetalert2@9"])
    @yield('js')
</body>
</html>
