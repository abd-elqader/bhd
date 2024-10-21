@extends('Mix.layouts.app')
@section('pagetitle', __('messages.NavbarItems'))
@section('content')

<table class="table" id="DataTable">
    <thead>
        <tr>
            <th>#</th>
            <th style="text-align:center;">@lang('dashboard.title_ar')</th>
            <th style="text-align:center;">@lang('dashboard.title_en')</th>
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
                processing: true
                , serverSide: true
                , oLanguage: {
                    sUrl: '{{ DT_Lang() }}'
                }
                , ajax: "{{ route('admin.navbar.index') }}"

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
                        data: 'status'
                        , name: 'status'
                    }]
            });

        });


    </script>
@endsection
