@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.weights'))
@section('content')

<div class="row">
    <div class="my-2 col-6 text-sm-start">
        <a href="{{ route('admin.weights.create') }}" class="btn btn-primary" disabled>@lang('dashboard.add_new')</a>
    </div>
    <div class="my-2 col-6 text-sm-end">
        <button type="button" id="DeleteSelected" onclick="DeleteSelected('weights')" class="btn btn-danger" disabled>@lang('dashboard.Delete_Selected')</button>
    </div>
</div>
<table class="table table-bordered data-table" id="DataTable">
    <thead>
        <tr>
            <th><input type="checkbox" id="ToggleSelectAll" class="btn btn-primary"></th>
            <th>#</th>
            <th>@lang('dashboard.weight')</th>
            <th>@lang('messages.price')</th>
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
                processing: true,
                serverSide: true,
                oLanguage: {
                    sUrl: '{{ DT_Lang() }}'
                },
                ajax: "{{ route('admin.weights.index') }}",
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
                        data: 'weight',
                        name: 'weight'
                    },
                    {
                        data: 'price',
                        name: 'price'
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
