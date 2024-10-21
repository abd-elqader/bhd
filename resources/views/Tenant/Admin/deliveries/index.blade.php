@extends('Mix.layouts.app')
@section('pagetitle', __('messages.deliveries'))
@section('content')

<table class="table table-bordered data-table" id="DataTable">
    <thead>
        <tr>
            <th>#</th>
            <th>@lang('messages.title_ar')</th>
            <th>@lang('messages.title_en')</th>
            <th>@lang('messages.status')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
@endsection

@section('css')
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {

            var table = $('#DataTable').DataTable({
                processing: true
                , serverSide: true
                , oLanguage: {
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
                }
                , ajax: "{{ route('admin.deliveries.index') }}"
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
                    }
                    , {
                        data: 'title_ar'
                        , name: 'title_ar'
                    }
                    , {
                        data: 'title_en'
                        , name: 'title_en'
                    }
                    , {
                        name: 'status'
                        , data: 'status'
                    }
                    , {
                        data: 'action'
                        , name: 'action',

                        orderable: false
                    }]
            });

        });
    </script>
@endsection
