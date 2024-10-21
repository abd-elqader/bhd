<li class="nav-item @if(str_contains(Route::currentRouteName(), 'navbar')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa fa-bars mx-2"></i>
        </span>
        <span class="text">{{ __('messages.NavbarItems') }}</span>
    </a>
    <ul id="navbar" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.navbar.index') }}">{{ __('messages.viewAll') }}</a></li>
    </ul>
</li>
