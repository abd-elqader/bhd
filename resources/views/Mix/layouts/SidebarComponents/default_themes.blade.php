<li class="nav-item @if(str_contains(Route::currentRouteName(), 'default_themes')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#themes" aria-controls="themes" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-layer-group mx-2"></i>
        </span>
        <span class="text">{{ __('dashboard.themes') }}</span>
    </a>
    <ul id="themes" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.default_themes.index') }}">{{ __('messages.viewAll') }}</a></li>
        <li><a href="{{ route('admin.default_themes.create') }}">{{ __('messages.add') }}</a></li>
        <li class="nav-item @if(str_contains(Route::currentRouteName(), 'default_theme_pages')) active @endif">
            <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#default_theme_pages" aria-controls="default_theme_pages" aria-expanded="true" aria-label="Toggle navigation">
                <span class="icon text-center">
                    <i style="width: 20px;" class="fa-solid fa-layer-group mx-2"></i>
                </span>
                <span class="text">{{ __('dashboard.theme_pages') }}</span>
            </a>
            <ul id="default_theme_pages" class="dropdown-nav mx-4 collapse" style="">
                <li><a href="{{ route('admin.default_theme_pages.index') }}">{{ __('messages.viewAll') }}</a></li>
                <li><a href="{{ route('admin.default_theme_pages.create') }}">{{ __('messages.add') }}</a></li>
            </ul>
        </li>
        <li class="nav-item @if(str_contains(Route::currentRouteName(), 'components')) active @endif">
            <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#components" aria-controls="components" aria-expanded="true" aria-label="Toggle navigation">
                <span class="icon text-center">
                    <i style="width: 20px;" class="fa-solid fa-cubes mx-2"></i>
                </span>
                <span class="text">{{ __('dashboard.components') }}</span>
            </a>
            <ul id="components" class="dropdown-nav mx-4 collapse" style="">
                <li><a href="{{ route('admin.components.index') }}">{{ __('messages.viewAll') }}</a></li>
            </ul>
        </li>

    </ul>
</li>
