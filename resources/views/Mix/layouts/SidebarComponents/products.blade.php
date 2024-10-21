<li class="nav-item @if(str_contains(Route::currentRouteName(), 'products')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#products" aria-controls="products" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-brands fa-palfed mx-2"></i>
        </span>
        <span class="text">{{ __('messages.Products') }}</span>
    </a>
    <ul id="products" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.products.index') }}">{{ __('messages.viewAll') }}</a></li>
        <li><a href="{{ route('admin.products.create') }}">{{ __('messages.add') }}</a></li>
        <li class="nav-item @if(str_contains(Route::currentRouteName(), 'colors')) active @endif">
            <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#colors" aria-controls="colors" aria-expanded="true" aria-label="Toggle navigation">
                <span class="icon text-center">
                    <i style="width: 20px;" class="fa-solid fa-palette mx-2"></i>
                </span>
                <span class="text">{{ __('dashboard.colors') }}</span>
            </a>
            <ul id="colors" class="dropdown-nav mx-4 collapse" style="">
                <li><a href="{{ route('admin.colors.index') }}">{{ __('messages.viewAll') }}</a></li>
                <li><a href="{{ route('admin.colors.create') }}">{{ __('messages.add') }}</a></li>
            </ul>
        </li>
        <li class="nav-item @if(str_contains(Route::currentRouteName(), 'sizes')) active @endif">
            <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#sizes" aria-controls="sizes" aria-expanded="true" aria-label="Toggle navigation">
                <span class="icon text-center">
                    <i style="width: 20px;" class="fa-solid fa-ruler-vertical mx-2"></i>
                </span>
                <span class="text">{{ __('messages.size') }}</span>
            </a>
            <ul id="sizes" class="dropdown-nav mx-4 collapse" style="">
                <li><a href="{{ route('admin.sizes.index') }}">{{ __('messages.viewAll') }}</a></li>
                <li><a href="{{ route('admin.sizes.create') }}">{{ __('messages.add') }}</a></li>
            </ul>
        </li>
        <li class="nav-item @if(str_contains(Route::currentRouteName(), 'coupons')) active @endif">
            <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#coupons" aria-controls="coupons" aria-expanded="true" aria-label="Toggle navigation">
                <span class="icon text-center">
                    <i style="width: 20px;" class="fa-solid fa-tags mx-2"></i>
                </span>
                <span class="text">{{ __('dashboard.coupons') }}</span>
            </a>
            <ul id="coupons" class="dropdown-nav mx-4 collapse" style="">
                <li><a href="{{ route('admin.coupons.index') }}">{{ __('messages.viewAll') }}</a></li>
                <li><a href="{{ route('admin.coupons.create') }}">{{ __('messages.add') }}</a></li>
            </ul>
        </li>
        <li class="nav-item @if(str_contains(Route::currentRouteName(), 'additions')) active @endif">
            <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#additions" aria-controls="additions" aria-expanded="true" aria-label="Toggle navigation">
                <span class="icon text-center">
                    <i style="width: 20px;" class="fa-solid fa-plus mx-2"></i>
                </span>
                <span class="text">{{ __('messages.Additions') }}</span>
            </a>
            <ul id="additions" class="dropdown-nav mx-4 collapse" style="">
                <li><a href="{{ route('admin.additions.index') }}">{{ __('messages.viewAll') }}</a></li>
                <li><a href="{{ route('admin.additions.create') }}">{{ __('messages.add') }}</a></li>
            </ul>
        </li>
        <li class="nav-item @if(str_contains(Route::currentRouteName(), 'removes')) active @endif">
            <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#removes" aria-controls="removes" aria-expanded="true" aria-label="Toggle navigation">
                <span class="icon text-center">
                    <i style="width: 20px;" class="fa-solid fa-minus mx-2"></i>
                </span>
                <span class="text">{{ __('messages.removes') }}</span>
            </a>
            <ul id="removes" class="dropdown-nav mx-4 collapse" style="">
                <li><a href="{{ route('admin.removes.index') }}">{{ __('messages.viewAll') }}</a></li>
                <li><a href="{{ route('admin.removes.create') }}">{{ __('messages.add') }}</a></li>
            </ul>
        </li>
    </ul>
</li>
