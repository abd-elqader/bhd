@extends('Mix.layouts.app')
@section('pagetitle', __('messages.tenants') . ' - ' . $Tenant->id)
@section('content')
@if($Tenant->paid == 0)
<style>
    .rubber_stamp {
      padding: 10px 20px !important;
      font-family: 'Vollkorn', serif;
      font-size: 39px;
      line-height: 45px;
      text-transform: uppercase;
      font-weight: bold;
      color: red;
      border: 7px solid red;
      float: left;
      padding: 10px 7px;
      border-radius: 10px;
      
      opacity: 0.8;
      -webkit-transform: rotate(-10deg);
      -o-transform: rotate(-10deg);
      -moz-transform: rotate(-10deg);
      -ms-transform: rotate(-10deg);
      top:32%;
    }
    .rubber_stamp::after {
      position: absolute;
      content: " ";
      width: 100%;
      height: auto;
      min-height: 100%;
      top: -10px;
      left: -10px;
      padding: 10px;
      background: url(https://raw.github.com/domenicosolazzo/css3/master/img/noise.png) repeat;
    }
</style>
<div class="rubber_stamp">@lang('dashboard.expired')</div>
@endif


<div class="container">
      <table class="table">
        <thead>
            <tr>
                <th scope="col">@lang('dashboard.name')</th>
                <th scope="col">@lang('dashboard.email')</th>
                <th scope="col">@lang('dashboard.phone')</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $Tenant->Client['name'] }}</td>
                <td>{{ $Tenant->Client['email'] }}</td>
                <td>{{ $Tenant->Client['phone_code'] }}{{ $Tenant->Client['phone'] }}</td>
            </tr>
        </tbody>
    </table>
    @if($Tenant->Client->packages->count())

    <h2>{{ __('dashboard.packages') }}</h2>
     <table class="table">
        <thead>
            <tr>
                <th scope="col">@lang('dashboard.name')</th>
                <th scope="col">@lang('dashboard.start_date')</th>
                <th scope="col">@lang('dashboard.end_date')</th>
                <th scope="col">@lang('messages.paid')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Tenant->Client->packages as $Package)
                <tr>
                    <td>{{ $Package->title() }}</td>
                    <td>{{ $Package->pivot->start_date }}</td>
                    <td>{{ $Package->pivot->end_date }}</td>
                    <td>{{ $Package->pivot->paid ? __('dashboard.yes') : __('dashboard.no') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection