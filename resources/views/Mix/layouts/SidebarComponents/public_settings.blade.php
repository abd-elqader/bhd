
<li class="nav-item @if(str_contains(Route::currentRouteName(), 'setting')) active @endif">
    @foreach (Settings()->whereIn('type',['public','publicSettings','payments_integration'])->unique('type') as $item)
        <a href="{{ route('admin.settings',['type'=>$item->type]) }}">
            <span class="icon text-center">
                <i style="width: 20px;" class="fa-solid fa-gears mx-2"></i>
            </span>
            <span class="text">{{ __('dashboard.'.$item->type.'') }}</span>
        </a>
    @endforeach
</li>