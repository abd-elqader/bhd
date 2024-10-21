<li class="nav-item @if(str_contains(Route::currentRouteName(), 'blog')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#blog" aria-controls="blog" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa fa-blog mx-2"></i>
        </span>
        <span class="text">{{ __('dashboard.blog') }}</span>
    </a>
    <ul id="blog" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.blogs.index') }}">{{ __('messages.viewAll') }}</a></li>
        <li><a href="{{ route('admin.blogs.create') }}">{{ __('messages.add') }}</a></li>
    </ul>
</li>
