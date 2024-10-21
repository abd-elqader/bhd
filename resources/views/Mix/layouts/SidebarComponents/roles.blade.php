<li class="nav-item @if(str_contains(Route::currentRouteName(), 'roles')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#Roles" aria-controls="Roles" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-brands fa-critical-role mx-2"></i>
        </span>
        <span class="text">{{ __('messages.Roles') }}</span>
    </a>
    <ul id="Roles" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.roles.index') }}">{{ __('messages.viewAll') }}</a></li>
        <li><a href="{{ route('admin.roles.create') }}">{{ __('messages.add') }}</a></li>
        <li class="nav-item @if(str_contains(Route::currentRouteName(), 'permissions')) active @endif">
            <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#permissions" aria-controls="permissions" aria-expanded="true" aria-label="Toggle navigation">
                <span class="icon text-center">
                    <i style="width: 20px;" class="fa-brands fa-pinterest-p mx-2"></i>
                </span>
                <span class="text">{{ __('messages.permissions') }}</span>
            </a>
            <ul id="permissions" class="dropdown-nav mx-4 collapse" style="">
                <li><a href="{{ route('admin.permissions.index') }}">{{ __('messages.viewAll') }}</a></li>
            </ul>
        </li>

    </ul>
</li>
