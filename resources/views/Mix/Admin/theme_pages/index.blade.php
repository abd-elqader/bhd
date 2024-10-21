@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.themes'))

@section('content')

<h2>@lang('dashboard.default_theme_pages')</h2>
<table class="table" id="CentralDataTable">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">@lang('dashboard.name')</th>
            <th class="text-center">@lang('dashboard.type')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>


<h2>@lang('messages.my_pages')</h2>
<table class="table" id="TenantDataTable">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">@lang('dashboard.name')</th>
            <th class="text-center">@lang('dashboard.type')</th>
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

        var table = $('#CentralDataTable').DataTable({
            processing: true
            , serverSide: true
            , ajax: {
                type: 'GET',
                url: '{{ route("admin.defaultIndex.theme_page") }}',
                data: {
                theme_id: {{ request()->get('theme_id') ?? 0 }},
                type: "{{ request()->get('type') }}",
                },
            }
            , columns: [{
                    data: 'DT_RowIndex'
                    ,name: 'DT_RowIndex',
                    orderable: false
                    , searchable: false
                }
                , {
                    data: 'name'
                    , orderable: false
                    , searchable: true
                }
                , {
                    data: 'type'
                    , orderable: false
                    , searchable: false
                }
                , {
                    data: 'action'
                    , orderable: false
                    , searchable: false
                }
            , ]
        });



        var table = $('#TenantDataTable').DataTable({
            processing: true
            , serverSide: true
            , ajax: {
                type: 'GET',
                url: '{{ route("admin.theme_pages.index") }}',
                data: {
                    theme_id: {{ request()->get('theme_id') ?? 0 }},
                    type: "{{ request()->get('type') }}",
                },
            }
            , columns: [{
                    data: 'DT_RowIndex'
                    ,name: 'DT_RowIndex',
                    orderable: false
                    , searchable: false
                }
                , {
                    data: 'name'
                    , orderable: false
                    , searchable: true
                }
                , {
                    data: 'type'
                    , orderable: false
                    , searchable: false
                }
                , {
                    data: 'action'
                    , orderable: false
                    , searchable: false
                }
            , ]
        });

    });

</script>


@endsection
