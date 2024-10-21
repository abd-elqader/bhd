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
                                    <label for="to">@lang('dashboard.shop_name')</label>
                                    <select class="form-select"  name="tenant">
                                        <option selected value="">@lang('dashboard.all')</option>
                                        @foreach($AllTenants as $Tenant)
                                            <option @selected(request('tenant') == $Tenant->id) value="{{ $Tenant->id }}">{{ $Tenant->id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="to">@lang('dashboard.DeliveryCompany')</label>
                                    <select class="form-select"  name="delivery_company_id">
                                        <option selected value="">@lang('dashboard.all')</option>
                                        @foreach($Deliveries as $Delivery)
                                            <option @selected(request('delivery_company_id') == $Delivery->id) value="{{ $Delivery->id }}">{{ $Delivery->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
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
                                <table class="table table-striped text-center" id="ConsutaBPM">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th ></th>
                                        <th>@lang('dashboard.orders')</th>
                                        <th >@lang('dashboard.subTotal')</th>
                                        <th >@lang('dashboard.coupon')</th>
                                        <th >@lang('dashboard.discount')</th>
                                        <th >@lang('dashboard.vat')</th>
                                        <th style="width: 100px;">@lang('dashboard.OnlineVat')</th>
                                        <th >@lang('dashboard.charge_cost')</th>
                                        <th >@lang('dashboard.netTotal')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($Tenants) > 0)
                                        @foreach($Tenants as $key => $Tenant)
                                            <tr class="gradeX {{ $Tenant['id'] }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="{{ route("admin.reports.sales",['shop'=>$Tenant->id,'from'=>request('from'),'to'=>request('to')]) }}">{{ $Tenant->id }}</a></td>
                                                <td>{{ $Tenant->Orders->count() }}</td>
                                                <td>{{ $Tenant->Orders->sum('sub_total') }} {{  DefaultCurrancy()->currancy_code }}</td>
                                                <td>{{ $Tenant->Orders->sum('coupon') }} {{  DefaultCurrancy()->currancy_code }}</td>
                                                <td>{{ $Tenant->Orders->sum('discount') }} {{  DefaultCurrancy()->currancy_code }}</td>
                                                <td>{{ $Tenant->Orders->sum('vat') }} {{  DefaultCurrancy()->currancy_code }}</td>
                                                <td>{{ $Tenant->Orders->sum('OnlineVat') }} {{  DefaultCurrancy()->currancy_code }}</td>
                                                <td>{{ $Tenant->Orders->sum('charge_cost') }} {{  DefaultCurrancy()->currancy_code }}</td>
                                                <td>{{ $Tenant->Orders->sum('net_total') }} {{  DefaultCurrancy()->currancy_code }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" style="text-align: center!important;">@lang('dashboard.noElements')</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                @if (count($Tenants) > 0)
                        
                                    <div class="col-md-3 form-group" style="padding-top: 26px">
                                        <button onclick="Excel()" class="btn btn-danger ">@lang('dashboard.exportExcel')</button>
                                    </div>
                                    <div class="col-md-3 form-group" style="padding-top: 26px">
                                        <button onclick="PDF()" class="btn btn-info ">@lang('dashboard.exportPDF')</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>

    <script type="text/javascript">   
        function PDF() {

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
        function Excel() {
        let table = document.getElementsByTagName("table");
            TableToExcel.convert(table[0], {name: new Date().toLocaleString()+`.xlsx`,sheet: {name: 'Sheet 1'}});
            
        }

    </script>
@endsection