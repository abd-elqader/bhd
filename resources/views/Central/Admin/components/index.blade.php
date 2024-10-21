@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.components'))

@section('content')
<table class="table" id="DataTable">
    <thead>
        <tr>
            <th>#</th>
            <th style="text-align:center;">@lang('messages.title_ar')</th>
            <th style="text-align:center;">@lang('messages.title_en')</th>
            <th style="text-align:center;">@lang('dashboard.preview')</th>
            <th style="text-align:center;">@lang('dashboard.type')</th>
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
                processing: true
                , serverSide: true
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
                }
                , oLanguage: {
                    sUrl: '{{ DT_Lang() }}'
                }
                , ajax: "{{ route('admin.components.index') }}"
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
                , lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
                , columns: [
                    {
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title_ar'
                        , name: 'title_ar'
                        , orderable: true
                        , searchable: true
                    },
                    {
                        data: 'title_en'
                        , name: 'title_en'
                        , orderable: true
                        , searchable: true
                    },
                    {
                        data: 'preview'
                        , name: 'preview'
                        , orderable: false
                    },
                    {
                        data: 'type'
                        , name: 'type'
                        , orderable: true
                        , searchable: true
                    }
                , ]
            });

        });

    </script>


@endsection
