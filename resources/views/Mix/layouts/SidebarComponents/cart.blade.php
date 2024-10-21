<li class="nav-item @if(str_contains(Route::currentRouteName(), 'carts')) active @endif">
    <a class="collapsed" href="{{ route('admin.carts.index') }}">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-cart-plus mx-2"></i>
        </span>
        <span class="text">{{ __('website.cart') }}</span>
    </a>
</li>
