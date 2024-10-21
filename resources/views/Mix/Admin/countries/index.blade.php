@extends('Mix.layouts.app')
@section('pagetitle', __('messages.Countries'))
@section('content')


<table class="table"  id="DataTable">
    <thead>
        <tr>
            <th>#</th>
            <th style="text-align:center;">@lang('dashboard.image')</th>
            <th style="text-align:center;">@lang('dashboard.title_ar')</th>
            <th style="text-align:center;">@lang('dashboard.title_en')</th>
            <th style="text-align:center;">@lang('dashboard.country_code')</th>
            <th style="text-align:center;">@lang('dashboard.phone_code')</th>
            <th style="text-align:center;">@lang('dashboard.currancy_code')</th>
            <th style="text-align:center;">@lang('dashboard.currancy_value')</th>
            <th style="text-align:center;">@lang('dashboard.visibility')</th>
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
                ajax: "{{ route('admin.countries.index') }}",
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
                            stripHtml : false,
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
                        data: 'title_ar',
                        name: 'title_ar'
                    },
                    {
                        data: 'title_en',
                        name: 'title_en'
                    },
                    {
                        data: 'country_code',
                        name: 'country_code'
                    },
                    {
                        data: 'phone_code',
                        name: 'phone_code'
                    },
                    {
                        data: 'currancy_code',
                        name: 'currancy_code'
                    },
                    {
                        data: 'currancy_value',
                        name: 'currancy_value'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                ]
            });

        });


    </script>
@endsection
