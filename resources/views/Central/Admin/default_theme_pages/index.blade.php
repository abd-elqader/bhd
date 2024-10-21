@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.theme_pages'))

@section('content')

<table class="table" id="DataTable">
    <thead>
        <tr>
            <th style="text-align:center;">#</th>
            <th style="text-align:center;">@lang('dashboard.name')</th>
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
            , ajax: "{{ route('admin.default_theme_pages.index',['theme_id'=>request()->get('theme_id') ?? 0]) }}"
            ,lengthMenu: [[25, 50, -1], [25, 50, "All"]]
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
