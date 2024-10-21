@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.deliveries'))
@section('content')

<table class="table"  id="DataTable">
    <thead>
        <tr>
            <th>#</th>
            <th style="text-align:center;">@lang('dashboard.image')</th>
            <th style="text-align:center;">@lang('dashboard.title')</th>
            <th style="text-align:center;">@lang('dashboard.same_day_price')</th>
            <th style="text-align:center;">@lang('dashboard.next_day_price')</th>
            <th style="text-align:center;">@lang('dashboard.visibility')</th>
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
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                  }],
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
                ajax: "{{ route('admin.deliveries.index') }}",
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
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'same_day_price',
                        name: 'same_day_price'
                    },
                    {
                        data: 'next_day_price',
                        name: 'next_day_price'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                    },
                ]
            });

        });




    </script>
@endsection
