<li class="nav-item @if(str_contains(Route::currentRouteName(), 'stores')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#stores" aria-controls="stores" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-shop mx-2"></i>
        </span>
        <span class="text">{{ __('dashboard.online_stores') }}</span>
    </a>
    <ul id="stores" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.stores.index') }}">{{ __('messages.viewAll') }}</a></li>
        <li><a href="{{ route('admin.stores.create') }}">{{ __('messages.add') }}</a></li>
    </ul>
</li>

