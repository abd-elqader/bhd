<li class="nav-item @if(str_contains(Route::currentRouteName(), 'agents')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#agents" aria-controls="agents" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-user-gear mx-2"></i>
        </span>
        <span class="text">{{ __('dashboard.agents') }}</span>
    </a>
    <ul id="agents" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.agents.index') }}">{{ __('messages.viewAll') }}</a></li>
        <li><a href="{{ route('admin.agents.create') }}">{{ __('messages.add') }}</a></li>
    </ul>
</li>
