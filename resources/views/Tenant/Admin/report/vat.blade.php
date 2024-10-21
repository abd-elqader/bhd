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
                                <li class="active">@lang('dashboard.VAT')</li>
                            </ol>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-body">
                            <form class="row" action="{{ route('admin.reports.vat') }}">
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
                            <div class="table-responsive">
                                <table class="table table-striped" id="custom_tbl_dt">
                                    <thead>
                                    <tr>
                                        <th style="text-align:center;">@lang('dashboard.amount')</th>
                                        <th style="text-align:center;">@lang('dashboard.VatAmount')</th>
                                        <th style="text-align:center;">@lang('dashboard.VatAmountPercentage')</th>
                                        <th style="text-align:center;">@lang('dashboard.NoVatAmount')</th>
                                        <th style="text-align:center;">@lang('dashboard.NoVatAmountPercentage')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($vat) > 0)
                                        <tr>
                                            <td style="text-align:center;">{{ $vat['amount'] }}</td>
                                            <td style="text-align:center;">{{ $vat['VatAmount'] }}</td>
                                            <td style="text-align:center;">{{ $vat['VatAmountPercentage'] }}</td>
                                            <td style="text-align:center;">{{ $vat['NoVatAmount'] }}</td>
                                            <td style="text-align:center;">{{ $vat['NoVatAmountPercentage'] }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="10" style="text-align: center!important;">@lang('dashboard.noElements')</td>
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
