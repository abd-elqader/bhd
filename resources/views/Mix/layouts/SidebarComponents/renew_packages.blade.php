<li class="nav-item @if(str_contains(Route::currentRouteName(), 'packages')) active @endif">
    <a class="collapsed" href="{{  route('admin.packages.index')  }}">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-cubes mx-2"></i>
        </span>
        <span class="text">{{ __('website.renew') . '  ' . __('messages.Packages') }}</span>
    </a>
</li>
