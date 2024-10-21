@if (lang('en'))
<li class="nav-item">
    <a href="{{ route('lang', 'ar') }}">
        <span class="icon text-center">
            <img src="{{ public_asset(MainCurrancy() ? MainCurrancy()->image : DefaultCurrancy()->image) }}" style="width: 20px;" class="mx-2">
        </span>
        <span class="text">Arabic</span>
    </a>
</li>
@else
<li class="nav-item">
    <a href="{{ route('lang', 'en') }}">
        <span class="icon text-center">
            <img src="{{ public_asset('/language/en.png') }}" style="width: 20px;" class="mx-2">
        </span>
        <span class="text">English</span>
    </a>
</li>
@endif
<li class="nav-item"><a></a></li>
<li class="nav-item"><a></a></li>
<li class="nav-item"><a></a></li>