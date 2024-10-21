@extends('Mix.layouts.app')
@section('pagetitle', __('messages.Packages'))
@section('content')

<table class="table">
    <tbody class="text-center">
        <tr>
            <td>{{ __('messages.title_ar') . ':' }}</td>
            <td>{{ $Package['title_ar'] }}</td>
        </tr>

        <tr>
            <td>{{ __('messages.title_en') . ':' }}</td>
            <td>{{ $Package['title_en'] }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.price_ar') . ':' }}</td>
            <td>{{ $Package['price_ar'] }}</td>
        </tr>

        <tr>
            <td>{{ __('messages.price_en') . ':' }}</td>
            <td>{{ $Package['price_en'] }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.status') . ':' }}</td>
            <td>{{ $Package['status'] ? __('messages.visible') : __('messages.hidden') }}</td>
        </tr>
    </tbody>
</table>

@if($Package->descriptions->count())
<h2>{{ trans('messages.description') }}</h2>
<table class="table">
    <thead>
        <tr>
            <th style="text-align:center;">@lang('dashboard.title_ar')</th>
            <th style="text-align:center;">@lang('dashboard.title_en')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Package->descriptions as $desc)
        <tr>
            <th style="text-align:center;">{{ $desc['title_ar'] }}</th>
            <th style="text-align:center;">{{ $desc['title_en'] }}</th>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

<h2>{{ trans('messages.features') }}</h2>
<table class="table" id="DataTable">
    <thead>
        <tr>
            <th><input type="checkbox" id="ToggleSelectAll" class="btn btn-primary"></th>
            <th>#</th>
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
            , ajax: "{{ route('admin.features.index',['package_id'=> $Package->id ]) }}"
            , columns: [
                {
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
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
