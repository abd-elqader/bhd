<li class="nav-item @if(str_contains(Route::currentRouteName(), 'offers')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#offers" aria-controls="offers" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-percent   mx-2"></i>
        </span>
        <span class="text">{{ __('messages.offers') }}</span>
    </a>
    <ul id="offers" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.offers.index') }}">{{ __('messages.viewAll') }}</a></li>
        <li><a href="{{ route('admin.offers.create') }}">{{ __('messages.add') }}</a></li>
        <li class="nav-item @if(str_contains(Route::currentRouteName(), 'offertypes')) active @endif">
            <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#offertypes" aria-controls="offertypes" aria-expanded="true" aria-label="Toggle navigation">
                <span class="icon text-center">
                    <i style="width: 20px;" class="fa-solid fa-quote-left mx-2"></i>
                </span>
                <span class="text">{{ __('dashboard.offertypes') }}</span>
            </a>
            <ul id="offertypes" class="dropdown-nav mx-4 collapse" style="">
                <li><a href="{{ route('admin.offertypes.index') }}">{{ __('messages.viewAll') }}</a></li>
            </ul>
        </li>

    </ul>
</li>
