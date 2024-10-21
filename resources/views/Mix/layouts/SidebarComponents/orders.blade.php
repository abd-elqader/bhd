<li class="nav-item @if(str_contains(Route::currentRouteName(), 'orders')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#orders" aria-controls="orders" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-bars-staggered mx-2"></i>
        </span>
        <span class="text">{{ __('dashboard.orders') }}</span>
    </a>
    <ul id="orders" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.orders', ['method' => 'new']) }}">@lang('dashboard.newOrders')</a></li>
        <li><a href="{{ route('admin.orders', ['method' => 'current']) }}">@lang('dashboard.currentOrders')</a></li>
        <li><a href="{{ route('admin.orders', ['method' => 'previous']) }}">@lang('dashboard.previousOrders')</a></li>
        <li><a href="{{ route('admin.orders', ['method' => 'declined']) }}">@lang('dashboard.declinedOrders')</a></li>
    </ul>
</li>
