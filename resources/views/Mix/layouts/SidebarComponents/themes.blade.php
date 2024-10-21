<li class="nav-item @if(str_contains(Route::currentRouteName(), 'theme')) active @endif">
    <a href="{{ route('admin.settings',['type'=>'theme']) }}">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-layer-group mx-2"></i>
        </span>
        <span class="text">{{ __('dashboard.Store_Theme') }}</span>
    </a>
    <a href="{{ route('admin.mobile-app.index') }}">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-layer-group mx-2"></i>
        </span>
        <span class="text">{{ __('dashboard.Mobile_Theme') }}</span>
    </a>
</li>