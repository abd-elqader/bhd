@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.coupons'))
@section('content')

<div class="row">
    <div class="my-2 col-6 text-sm-start">
        <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary" disabled>@lang('dashboard.add_new')</a>
    </div>
    <div class="my-2 col-6 text-sm-end">
        <button type="button" id="DeleteSelected" onclick="DeleteSelected('coupons')" class="btn btn-danger" disabled>@lang('dashboard.Delete_Selected')</button>
    </div>
</div>
<table class="table"  id="DataTable">
    <thead>
        <tr>
            <th><input type="checkbox" id="ToggleSelectAll" class="btn btn-primary"></th>
            <th>#</th>
            <th>@lang('messages.code')</th>
            <th>@lang('messages.type')</th>
            <th>@lang('messages.fixedprice')</th>
            <th>@lang('messages.Discount Percentage')</th>
            <th>@lang('messages.from')</th>
            <th>@lang('messages.to')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
@endsection



@section('js')
    <script type="text/javascript">
        $(function() {

            var table = $('#DataTable').DataTable({
                processing: true,
                serverSide: true,
                oLanguage: {
                    sUrl: '{{ DT_Lang() }}'
                }
                , initComplete: function ( data ) {
                    $('table').each(
                      function() {
                        var titles;
                        titles = [];
                        $('thead th', this).each(function() {
                          titles.push($(this).text());
                        });
                        $('tbody tr', this).each(function() {
                          $('td', this).each(function(index) {
                            $(this).attr('data-label', titles[index]);
                          });
                        });
                    });
                },
                ajax: "{{ route('admin.coupons.index') }}",
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
                , dom: 'Blfrtip'
                , buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'
                ]
                , columns: [
                    {
                        data: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'discount',
                        name: 'discount'
                    },
                    {
                        data: 'percent_off',
                        name: 'percent_off'
                    },
                    {
                        name: 'from',
                        data: 'from'
                    },
                    {
                        name: 'to',
                        data: 'to'
                    },
                    {
                        data: 'action',
                    },
                ]
            });

        });



    </script>
@endsection
