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
                                <li class="active">@lang('dashboard.most_selling')</li>
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
                            @if (count($MostSelling) > 0)
                                <form class="row" action="{{ route('admin.exportData') }}" method="GET">
                                    @csrf
                                    <div class="col-md-3 form-group" style="padding-top: 26px">
                                        <button class="btn btn-danger">@lang('dashboard.exportExcel')</button>
                                    </div>
                                </form>
                            @endif
                            <h3 class="m-b-10 m-t-40">@lang('dashboard.most_selling')</h3>
                            <div class="table-responsive">
                                <table class="table table-striped" id="custom_tbl_dt">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">@lang('dashboard.product')</th>
                                            <th style="text-align:center;">@lang('dashboard.count')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($MostSelling) > 0)
                                        @foreach($MostSelling as $key => $item)
                                            <tr class="gradeX {{ $item['id'] }}">
                                                <td style="text-align:center;"><a href="{{ route('admin.products.edit',$item->product['id']) }}">{{ $item->product['title_'.app()->getlocale()] }}</a></td>
                                                <td style="text-align:center;">{{ $item['count'] }}</td>
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
