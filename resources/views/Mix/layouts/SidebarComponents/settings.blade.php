

<li class="nav-item @if(str_contains(Route::currentRouteName(), 'setting')) active @endif">
    <p class="text mx-3 h3">{{ __('dashboard.side_pages') }}</p>
    @foreach (Settings()->whereNotIn('type',['public','publicSettings','payments_integration','theme'])->unique('type') as $item)
        <a href="{{ route('admin.settings',['type'=>$item->type]) }}">
            <span class="icon text-center">
                <i style="width: 20px;" class="fa-solid fa-layer-group mx-2"></i>
            </span>
            <span class="text">{{ __('dashboard.'.$item->type.'') }}</span>
        </a>
    @endforeach
</li>
@if(tenant())
    @include('Mix.layouts.SidebarComponents.contact')
@else

    <li class="nav-item @if(str_contains(Route::currentRouteName(), 'setting')) active @endif">
        <p class="text mx-3 h3">{{ __('messages.settings') }}</p>
        @foreach (Settings()->whereIn('type',['public','publicSettings','payments_integration'])->unique('type') as $item)
            <a href="{{ route('admin.settings',['type'=>$item->type]) }}">
                <span class="icon text-center">
                    <i style="width: 20px;" class="fa-solid fa-layer-group mx-2"></i>
                </span>
                <span class="text">{{ __('dashboard.'.$item->type.'') }}</span>
            </a>
        @endforeach
    </li>

@endif