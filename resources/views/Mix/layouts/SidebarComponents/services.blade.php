<li class="nav-item @if(str_contains(Route::currentRouteName(), 'services')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#services" aria-controls="services" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-shop mx-2"></i>
        </span>
        <span class="text">{{ __('dashboard.services') }}</span>
    </a>
    <ul id="services" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.services.index') }}">{{ __('messages.viewAll') }}</a></li>
        <li><a href="{{ route('admin.services.create') }}">{{ __('messages.add') }}</a></li>
    </ul>
</li>

