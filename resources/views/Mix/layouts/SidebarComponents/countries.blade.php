<li class="nav-item @if(str_contains(Route::currentRouteName(), 'countries')) active @endif">
    <a href="{{ route('admin.countries.index') }}">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-earth-asia mx-2"></i>
        </span>
        <span class="text">{{ __('messages.Countries') }}</span>
    </a>
</li>
