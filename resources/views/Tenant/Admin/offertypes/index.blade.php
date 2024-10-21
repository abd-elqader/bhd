@extends('Mix.layouts.app')

@section('pagetitle', __('dashboard.offertypes'))
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



@section('js')
    <script type="text/javascript">
        $(function() {

            var table = $('#DataTable').DataTable({
                processing: true,
                serverSide: true,
                oLanguage: {
                    sUrl: '{{ DT_Lang() }}'
                },
                ajax: "{{ route('admin.offertypes.index',['id'=> request()->get('id') ?? 0]) }}",
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
                        data: 'title_ar',
                        name: 'title_ar'
                    },
                    {
                        data: 'title_en',
                        name: 'title_en'
                    },
                    {
                        name: 'status',
                        data: 'status'
                    },
                    {
                        data: 'action',
                    },
                ]
            });

        });



    </script>
@endsection
