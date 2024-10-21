@extends('Mix.layouts.app')
@section('pagetitle', __('messages.feature_headers'))
@section('content')

<table class="table">
    <tbody class="text-center">
        <tr>
            <td>{{ __('messages.title_ar') . ':' }}</td>
            <td>{{ $FeatureHeader['title_ar'] }}</td>
        </tr>

        <tr>
            <td>{{ __('messages.title_en') . ':' }}</td>
            <td>{{ $FeatureHeader['title_en'] }}</td>
        </tr>
    </tbody>
</table>

<h2>{{ trans('messages.features') }}</h2>

<table class="table" id="DataTable">
    <thead>
        <tr>
            <th><input type="checkbox" id="ToggleSelectAll" class="btn btn-primary"></th>
            <th>#</th>
            <th style="text-align:center;">@lang('dashboard.title_ar')</th>
            <th style="text-align:center;">@lang('dashboard.title_en')</th>
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
                , columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: true
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
                        data: 'type'
                        , name: 'type'
                    }
                    , {
                        data: 'action'
                        , name: 'action'
                    }]
            });

        });
    </script>
@endsection
