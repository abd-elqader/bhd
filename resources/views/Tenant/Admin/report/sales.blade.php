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
                                <li class="active">@lang('dashboard.salesReport')</li>
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
                            @php($net_total = 0)
                            @php($sub_total = 0)
                            @php($charge_cost = 0)
                            <div class="table-responsive">
                                <table class="table table-striped text-center" id="ConsutaBPM">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('dashboard.orderNo')</th>
                                        <th style="text-align:center;">@lang('dashboard.paymentMethod')</th>
                                        <th style="text-align:center;">@lang('dashboard.subTotal')</th>
                                        <th style="text-align:center;">@lang('dashboard.charge_cost')</th>
                                        <th style="text-align:center;">@lang('dashboard.netTotal')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($orders) > 0)
                                        @foreach($orders as $key => $order)
                                            <tr class="gradeX {{ $order['id'] }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="text-align:center;">{{ $order['id'] }}</td>
                                                <td>{{ $order->PaymentMethod['title_' . app()->getLocale()] }}</td>
                                                <td>{{ $order->sub_total }} {{  DefaultCurrancy()->currancy_code }}</td>
                                                @php($sub_total += $order['sub_total'])
                                                <td style="text-align:center;">{{ $order->charge_cost }}</td>
                                                @php($charge_cost += $order['charge_cost'])
                                                <td>{{ $order['net_total'] }} {{  DefaultCurrancy()->currancy_code }}</td>
                                                @php($net_total += $order['net_total'])
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                @lang('dashboard.subTotal'): {{ $sub_total }} {{  DefaultCurrancy()->currancy_code }}
                                            </td>
                                            <td>
                                                @lang('dashboard.charge_cost'): {{ $charge_cost }} {{  DefaultCurrancy()->currancy_code }}
                                            </td>
                                            <td>
                                                @lang('dashboard.netTotal'): {{ $net_total }} {{  DefaultCurrancy()->currancy_code }}
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="6" style="text-align: center!important;">@lang('dashboard.noElements')</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                @if (count($orders) > 0)
                                    <div class="col-md-3 form-group" style="padding-top: 26px">
                                        <form class="row" action="{{ route('admin.exportData', ['data' => $orders]) }}" method="GET" style="display:contents">
                                            @csrf
                                            <button class="btn btn-danger">@lang('dashboard.exportExcel')</button>
                                        </form>
                                    </div>
                                    <div class="col-md-3 form-group" style="padding-top: 26px">
                                        <button onclick="imprimir()" class="btn btn-info ">@lang('dashboard.exportPDF')</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">   
        function imprimir() {

            newWin = window.open("");
            newWin.document.write('<html>');
            newWin.document.write('<head>');
            newWin.document.write('<title>' + document.title  + '</title>');
            @if(lang('ar'))
            newWin.document.write('<style>body{direction: rtl;} table{width: 100%;text-align: center;}</style>');
            @endif
            newWin.document.write('</head>');
            newWin.document.write('<body >');
            newWin.document.write(document.getElementById("ConsutaBPM").outerHTML);
            newWin.document.write('</body>');
            newWin.document.write('</html>');
            newWin.print();
            newWin.close();
            
        }
    </script>
@endsection
