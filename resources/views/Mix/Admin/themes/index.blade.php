@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.themes'))

@section('content')

<h2>@lang('dashboard.defaultThemes')</h2>
<table class="table" id="CentralDataTable">
    <thead>
        <tr>
            <th style="text-align:center;">#</th>
            <th style="text-align:center;">@lang('dashboard.name')</th>
            <th style="text-align:center;">@lang('dashboard.image')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<h2>@lang('messages.my_themes')</h2>
<table class="table" id="TenantDataTable">
    <thead>
        <tr>
            <th style="text-align:center;">#</th>
            <th style="text-align:center;">@lang('dashboard.name')</th>
            <th style="text-align:center;">@lang('dashboard.image')</th>
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
            , ajax: "{{ route('admin.defaultIndex.theme') }}"
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
                    data: 'image'
                    , orderable: false
                    , searchable: true
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
            , ajax: "{{ route('admin.themes.index') }}"
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
                    data: 'image'
                    , orderable: false
                    , searchable: true
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
