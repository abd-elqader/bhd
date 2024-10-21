<li class="nav-item @if(str_contains(Route::currentRouteName(), 'contact')) active @endif">
    <a class="collapsed" href="{{ route('admin.contact.index') }}">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-file-signature mx-2"></i>
        </span>
        <span class="text">{{ __('messages.contact') }}</span>
    </a>
</li>
