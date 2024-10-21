<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @hasSection ('pagetitle')
        <title>{{ ucfirst(tenant() ? tenant()->id : env('APP_NAME')) }} @yield('pagetitle')</title>
    @else
        <title>{{ ucfirst(tenant() ? tenant()->id : config('app.name', 'Laravel')) }}</title>
    @endif
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf_token" value="{{ csrf_token() }}" content="{{ csrf_token() }}"/>
    <meta name="csrf-token" value="{{ csrf_token() }}" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ public_asset(setting('logo')) }}" type="image/x-icon">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="{{strip_tags(setting('desc'))}}">
    <meta name="keywords" content="{!! strip_tags(setting('keywords'))!!}">
    <meta name="author" content="{{ strip_tags(setting('author')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        @font-face {
          font-family: "LineIcons";
          src: url("/fonts/LineIcons.eot");
          src: url("/fonts/LineIcons.eot") format("embedded-opentype"),
            url("/fonts/LineIcons.woff2") format("woff2"),
            url("/fonts/LineIcons.woff") format("woff"),
            url("/fonts/LineIcons.ttf") format("truetype"),
            url("/fonts/LineIcons.svg") format("svg");
          font-weight: normal;
          font-style: normal;
        }
    </style>
    
    <link rel="stylesheet" href="{{ public_asset(env('APP_URL') .'/css/lineicons.css') }}" />
    <link href='https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap' rel="stylesheet">

    <link href="{{ public_asset(env('APP_URL') .'/css/dashboard.css') }}" rel="stylesheet">

    @yield('css')
    @if (lang('ar'))
    <link href="{{ public_asset(env('APP_URL') .'/css/ar.css') }}" rel="stylesheet">
    @else
    <link href="{{ public_asset(env('APP_URL') .'/css/en.css') }}" rel="stylesheet">
    @endif


</head>
<body>

        
    <table class="table table-striped table-hover text-center">
        <tbody>
            <tr>
                <td colspan="6">
                    <h4>{{ __("dashboard.client") }}</h4>
                </td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("dashboard.name") }}</th>
                <td style="width:50%">{{ $Order->Client->name }}</td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("dashboard.email") }}</th>
                <td style="width:50%">{{ $Order->Client->email }}</td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("dashboard.phone") }}</th>
                <td style="width:50%">{{ $Order->Client->phone_code . $Order->Client->phone }}</td>
            </tr>
            <tr>
                <td colspan="6">
                    <h4>{{ __("dashboard.Payment") }}</h4>
                </td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("dashboard.sub_total") }}</th>
                <td style="width:50%">{{ $Order->sub_total }} BD</td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("dashboard.charge_cost") }}</th>
                <td style="width:50%">{{ $Order->charge_cost }} BD</td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("dashboard.discount") }}</th>
                <td style="width:50%">{{ $Order->discount }} BD</td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("dashboard.vat") }}</th>
                <td style="width:50%">{{ $Order->vat }} BD</td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("dashboard.coupon") }}</th>
                <td style="width:50%">{{ $Order->coupon }} BD</td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("dashboard.OnlineVat") }}</th>
                <td style="width:50%">{{ $Order->OnlineVat }} BD</td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("dashboard.net_total") }}</th>
                <td style="width:50%">{{ $Order->net_total }} BD</td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("dashboard.mobile_type") }}</th>
                <td style="width:50%">{{ $Order->mobile_type }}</td>
            </tr>
            @php ($Order->address = $Order->address ? $Order->address : $Order->address()->first())
            @if ($Order->address)
            <tr>
                <td colspan="6">
                    <h4>{{ __("dashboard.address") }}</h4>
                </td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("dashboard.country") }}</th>
                <td style="width:50%">{{ $Order->address->region->Country->title() }}</td>
            </tr>
            <tr>
                @if($Order->address->region->country_id == 2)
                    <th style="width:50%">{{ __("dashboard.region") }}</th>
                @else
                    <th style="width:50%">{{ __("dashboard.city") }}</th>
                @endif
                <td style="width:50%">{{ $Order->address->region->title() }}</td>
            </tr>
            <tr>
                @if($Order->address->region->country_id == 2)
                    <th style="width:50%">{{ __("dashboard.block") }}</th>
                @else
                    <th style="width:50%">{{ __("dashboard.district") }}</th>
                @endif
                <td style="width:50%">{{ $Order->address->block }}</td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("website.building_no") }}</th>
                <td style="width:50%">{{ $Order->address->building_no }}</td>
            </tr>
            <tr>
                @if($Order->address->region->country_id == 2)
                <th style="width:50%">{{ __("website.street") }}</th>
                @else
                    <th style="width:50%">{{ __("website.road") }}</th>
                @endif
                <td style="width:50%">{{ $Order->address->road }}</td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("dashboard.floor_no") }}</th>
                <td style="width:50%">{{ $Order->address->floor_no }}</td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("dashboard.apartment") }}</th>
                <td style="width:50%">{{ $Order->address->apartment }}</td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("dashboard.type") }}</th>
                <td style="width:50%">{{ $Order->address->type }}</td>
            </tr>
            <tr>
                <th style="width:50%">{{ __("dashboard.additional_directions") }}</th>
                <td style="width:50%">{{ $Order->address->additional_directions }}</td>
            </tr>
            @endif
            @if($Order->store_tracking_link)
             <tr>
                <td colspan="6">{{ $Order->store_tracking_link }}</td>
            </tr>
            @endif
            @if($Order->store_tracking_link)
             <tr>
                <th style="width:50%">{{ "Tracking Link" }}</th>
                <td style="width:50%"><a href="{{ $Order->store_tracking_link }}" target="_blank">{{ $Order->store_tracking_link }}</a></td>
            </tr>
            @endif
            @if($Order->client_tracking_link)
             <tr>
                <th style="width:50%">{{ "Client Tracking Link" }}</th>
                <td style="width:50%"><a href="{{ $Order->client_tracking_link }}"  target="_blank">{{ $Order->client_tracking_link }}</a></td>
            </tr>
            @endif
            @if($Order->deliveryId)
             <tr>
                <th style="width:50%">{{ "Delivery Id" }}</th>
                <td style="width:50%">{{ $Order->deliveryId }}</td>
            </tr>
            @endif
            @if($Order->note)
             <tr>
                <th style="width:50%">{{ __("website.note") }}</th>
                <td style="width:50%">{{ $Order->note }}</td>
            </tr>
            @endif
        </tbody>
    </table>
    
    <h4 class="text-center">{{ __("dashboard.products") }}</h4>
    <table class="table table-striped table-hover text-center">
        <tbody>
            @foreach($Order->OrderProducts as $item )
                <tr>
                    <th style="width:50%">
                        <p>{{ $item->product->title() }}</p>
                    </th>
                    <td style="width:50%">
                        <p>{{ $item->Size->title() }}</p>
                        <p>{{ $item->Color?->title() }}</p>
                        <p>{{ $item->quantity }} * {{ $item->price }} BD</p>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>