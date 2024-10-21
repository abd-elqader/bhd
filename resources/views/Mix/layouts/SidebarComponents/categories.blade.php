<li class="nav-item @if(str_contains(Route::currentRouteName(), 'categories')) active @endif">
    <a href="{{ route('admin.categories.index') }}">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-clone mx-2"></i>
        </span>
        <span class="text">{{ __('dashboard.categories') }}</span>
    </a>
</li>