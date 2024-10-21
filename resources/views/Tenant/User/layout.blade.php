<!DOCTYPE html>
<html lang="en">
    @include('Tenant.User.head')
    @livewireStyles
    <body class="p-0" style="direction:{{ lang('en') ? 'ltr' : 'rtl' }};text-align: {{ lang('en') ? 'left' : 'right' }};">
        @foreach ($components as $key => $item) 
            @include('Tenant.User.components.'. $key .'.'.$item)
        @endforeach
        @include('Tenant.User.components.BackToTop')
        @yield('js')
        @stack('scripts')
        @include('sweetalert::alert', ['cdn' => "https://unpkg.com/sweetalert2@9"])
        @livewireScripts
    </body>
</html>
