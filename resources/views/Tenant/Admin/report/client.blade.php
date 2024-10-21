@extends('Mix.layouts.app')
@section('content')

    <div class="wrapper">
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="page-title">@lang('dashboard.reports')</h4>
                            <ol class="breadcrumb">
                                <li><a href="">@lang('dashboard.reports')</a></li>
                                <li class="active">@lang('dashboard.clientReport')</li>
                            </ol>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-body">
                            <form class="row">
                                <div class="col-md-3 form-group">
                                    <label for="client_id">@lang('dashboard.client')</label>
                                    <select id="client_id" name="client_id" class="form-control select2">
                                        <option value="">---</option>
                                        @foreach($clients->sortBy('name') as $client2)
                                            <option {{ $client2['id'] == request('client_id') ? 'selected' : '' }} value="{{ $client2['id'] }}">{{ $client2['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 form-group" style="padding-top: 26px">
                                    <button class="btn btn-primary">@lang('dashboard.search')</button>
                                </div>
                            </form>
                            @if ($client && count($client->orders) > 0)
                                <form class="row" action="{{ route('admin.exportData') }}"
                                    method="GET">
                                    @csrf
                                    <div class="col-md-3 form-group" style="padding-top: 26px">
                                        <button class="btn btn-danger">@lang('dashboard.exportExcel')</button>
                                    </div>
                                </form>
                            @endif
                            @if($client)
                            <div class="col-md-3 form-group" style="padding-top: 26px">
                                <button class="btn btn-info">@lang('dashboard.orders_number'): {{ $client->orders->count() }} </button>
                            </div>
                            @endif
                            <h3 class="m-b-10 m-t-40">@lang('dashboard.orders')</h3>
                            <div class="table-responsive">
                                <table class="table table-striped" id="custom_tbl_dt">
                                    <thead>
                                    <tr>
                                        <th>@lang('dashboard.orderNo')</th>
                                        <th style="text-align:center;">@lang('dashboard.phone')</th>
                                        <th style="text-align:center;">@lang('dashboard.netTotal')</th>
                                        <th style="text-align:center;">@lang('dashboard.paymentMethod')</th>
                                        <th style="text-align:center;">@lang('dashboard.time')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($client && count($client->orders) > 0)
                                        @foreach($client->orders as $key => $order)
                                            <tr class="gradeX {{ $order['id'] }}">
                                                <td style="text-align:center;">{{ $order['id'] }}</td>
                                                <td style="text-align:center;">{{ $order->client['phone'] }}</td>
                                                <td>{{ $order['net_total'] }} BHD</td>
                                                <td>{{ $order->PaymentMethod['title_' . app()->getLocale()] }}</td>
                                                <td>{{ $order['created_at'] }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" style="text-align: center!important;">@lang('dashboard.noElements')</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
@endsection

