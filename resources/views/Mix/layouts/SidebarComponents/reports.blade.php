<li class="nav-item @if(str_contains(Route::currentRouteName(), 'reports')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#reports" aria-controls="reports" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-square-poll-vertical mx-2"></i>
        </span>
        <span class="text">{{ __('messages.reports') }}</span>
    </a>
    <ul id="reports" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.reports.sales') }}">@lang('dashboard.salesReport')</a></li>
        <li><a href="{{ route('admin.reports.financial') }}">@lang('dashboard.financialReport')</a></li>
        <li><a href="{{ route('admin.reports.client') }}">@lang('dashboard.clientReport')</a></li>
        <li><a href="{{ route('admin.reports.payment') }}">@lang('dashboard.paymentReport')</a></li>
        <li><a href="{{ route('admin.reports.mostselling') }}">@lang('dashboard.most_selling')</a></li>
        <li><a href="{{ route('admin.reports.abandoned_carts') }}">@lang('dashboard.abandoned_carts')</a></li>
        <li><a href="{{ route('admin.reports.vat') }}">@lang('dashboard.VAT')</a></li>
    </ul>
</li>
