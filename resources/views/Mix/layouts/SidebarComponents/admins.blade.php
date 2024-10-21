<li class="nav-item @if(str_contains(Route::currentRouteName(), 'admins')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#admins" aria-controls="admins" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-users-between-lines mx-2"></i>
        </span>
        <span class="text">{{ __('messages.admins') }}</span>
    </a>
    <ul id="admins" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.admins.index') }}">{{ __('messages.viewAll') }}</a></li>
        <li><a href="{{ route('admin.admins.create') }}">{{ __('messages.add') }}</a></li>
    </ul>
</li>
