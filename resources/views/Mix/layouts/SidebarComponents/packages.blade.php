<li class="nav-item @if(str_contains(Route::currentRouteName(), 'packages')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#packages" aria-controls="packages" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-cubes mx-2"></i>
        </span>
        <span class="text">{{ __('messages.Packages') }}</span>
    </a>
    <ul id="packages" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.packages.index') }}">{{ __('messages.viewAll') }}</a></li>
        <li><a href="{{ route('admin.packages.create') }}">{{ __('messages.add') }}</a></li>
         <li class="nav-item @if(str_contains(Route::currentRouteName(), 'package_descs')) active @endif">
            <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#package_descs" aria-controls="package_descs" aria-expanded="true" aria-label="Toggle navigation">
                <span class="icon text-center">
                    <i style="width: 20px;" class="fa-solid fa-compass-drafting mx-2"></i>
                </span>
                <span class="text">{{ __('messages.package_descs') }}</span>
            </a>
            <ul id="package_descs" class="dropdown-nav mx-4 collapse" style="">
                <li><a href="{{ route('admin.package_descs.index') }}">{{ __('messages.viewAll') }}</a></li>
                <li><a href="{{ route('admin.package_descs.create') }}">{{ __('messages.add') }}</a></li>
            </ul>
        </li>
        <li class="nav-item @if(str_contains(Route::currentRouteName(), 'features')) active @endif">
            <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#features" aria-controls="features" aria-expanded="true" aria-label="Toggle navigation">
                <span class="icon text-center">
                    <i style="width: 20px;" class="fa-solid fa-compass-drafting mx-2"></i>
                </span>
                <span class="text">{{ __('messages.features') }}</span>
            </a>
            <ul id="features" class="dropdown-nav mx-4 collapse" style="">
                <li><a href="{{ route('admin.features.index') }}">{{ __('messages.viewAll') }}</a></li>
                <li><a href="{{ route('admin.features.create') }}">{{ __('messages.add') }}</a></li>
                <li class="nav-item @if(str_contains(Route::currentRouteName(), 'feature_headers')) active @endif">
                    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#feature_headers" aria-controls="feature_headers" aria-expanded="true" aria-label="Toggle navigation">
                        <span class="text">{{ __('messages.feature_headers') }}</span>
                    </a>
                    <ul id="feature_headers" class="dropdown-nav mx-3 collapse" style="">
                        <li><a href="{{ route('admin.feature_headers.index') }}">{{ __('messages.viewAll') }}</a></li>
                        <li><a href="{{ route('admin.feature_headers.create') }}">{{ __('messages.add') }}</a></li>
                    </ul>
                </li>
            </ul>
        </li>

    </ul>
</li>
