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
                                <li class="active">@lang('dashboard.financialReport')</li>
                            </ol>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-body">
                            <form class="row">
                                <div class="col-md-3 form-group">
                                    <label for="from">@lang('dashboard.from')</label>
                                    <input type="date" id="from" name="from" class="form-control" value="{{ request('from') }}">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="to">@lang('dashboard.to')</label>
                                    <input type="date" id="to" name="to" class="form-control" value="{{ request('to') }}">
                                </div>
                                <div class="col-md-3 form-group" style="padding-top: 26px">
                                    <button class="btn btn-primary">@lang('dashboard.search')</button>
                                </div>
                            </form>
                            @if (count($orders) > 0)
                                <form class="row" action="{{ route('admin.exportData', ['data' => $orders]) }}" method="GET">
                                    @csrf
                                    <div class="col-md-3 form-group" style="padding-top: 26px">
                                        <button class="btn btn-danger">@lang('dashboard.exportExcel')</button>
                                    </div>
                                </form>
                            @endif
                            @php($total = 0)
                            <h3 class="m-b-10 m-t-40">@lang('dashboard.orders')</h3>
                            <div class="table-responsive">
                                <table class="table table-striped" id="custom_tbl_dt">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('dashboard.orderNo')</th>
                                        <th style="text-align:center;">@lang('dashboard.client')</th>
                                        <th style="text-align:center;">@lang('dashboard.phone')</th>
                                        <th style="text-align:center;">@lang('dashboard.netTotal')</th>
                                        <th style="text-align:center;">@lang('dashboard.paymentMethod')</th>
                                        <th style="text-align:center;">@lang('dashboard.time')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($orders) > 0)
                                        @foreach($orders as $key => $order)
                                            <tr class="gradeX {{ $order['id'] }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="text-align:center;">{{ $order['id'] }}</td>
                                                <td style="text-align:center;">{{ $order->client?->name }}</td>
                                                <td style="text-align:center;">{{ $order->client['phone'] }}</td>
                                                <td>{{ $order['net_total'] }} BHD</td>
                                                @php($total += $order['net_total'])
                                                <td>{{ $order->PaymentMethod['title_' . app()->getLocale()] }}</td>
                                                <td>{{ $order['created_at'] }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" style="text-align: center!important;">@lang('dashboard.noElements')</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="9" style="text-align: center!important;">
                                            @lang('dashboard.netTotal'): {{ $total }} BHD
                                        </td>
                                    </tr>
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
