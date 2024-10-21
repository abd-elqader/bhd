
<li class="nav-item @if(str_contains(Route::currentRouteName(), 'tenants')) active @endif">
    <a class="collapsed" href="{{ route('admin.websites.index') }}">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-globe mx-2"></i>
        </span>
        <span class="text">{{ __('messages.tenants') }}</span>
    </a>
</li>