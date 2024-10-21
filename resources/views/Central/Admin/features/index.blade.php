@extends('Mix.layouts.app')
@section('pagetitle', __('messages.features'))
@section('content')

<div class="row">
    <div class="my-2 col-6 text-sm-start">
        <a href="{{ route('admin.features.create') }}" class="btn btn-primary" disabled>@lang('dashboard.add_new')</a>
    </div>
    <div class="my-2 col-6 text-sm-end">
        <button type="button" id="DeleteSelected" onclick="DeleteSelected('features')" class="btn btn-danger" disabled>@lang('dashboard.Delete_Selected')</button>
    </div>
</div>

<table class="table" id="DataTable">
    <thead>
        <tr>
            <th><input type="checkbox" id="ToggleSelectAll" class="btn btn-primary"></th>
            <th style="text-align:center;">@lang('dashboard.title_ar')</th>
            <th style="text-align:center;">@lang('dashboard.title_en')</th>
            <th style="text-align:center;">@lang('dashboard.image')</th>
            <th style="text-align:center;">@lang('dashboard.head')</th>
            <th style="text-align:center;">@lang('dashboard.type')</th>
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
                processing: true
                , serverSide: true
                , oLanguage: {
                    sUrl: '{{ DT_Lang() }}'
                }
                , ajax: "{{ route('admin.features.index') }}"
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
                            data: 'checkbox',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'title_ar'
                        },
                        {
                            data: 'title_en'
                        },
                        {
                            data: 'image'
                        },
                        {
                            data: 'header_id'
                        },
                        {
                            data: 'type'
                        },
                        {
                            data: 'action'
                        }
                    ]
            });
        });

    </script>
@endsection
