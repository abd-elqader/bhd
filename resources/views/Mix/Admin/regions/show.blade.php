@extends('Mix.layouts.app')
@section('pagetitle', $Region->title() )
@section('content')


<div class="row">
    <div class="my-2 col-6 text-sm-start">
        <a href="{{ route('admin.country.region.cities.create',['country' => request('country'),'region'=>request('region')]) }}" class="btn btn-dark">@lang('messages.add_new')</a>
    </div>
</div>
<table class="table"  id="cities_DataTable">
    <thead>
        <tr>
            <th>#</th>
            <th style="text-align:center;">@lang('dashboard.title_ar')</th>
            <th style="text-align:center;">@lang('dashboard.title_en')</th>
            <th style="text-align:center;">@lang('dashboard.visibility')</th>
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

            var table = $('#cities_DataTable').DataTable({
                processing: true,
                serverSide: true,
                oLanguage: {
                    sUrl: '{{ DT_Lang() }}'
                },
                ajax: "{{ route('admin.country.region.cities.index',['country' => request('country'),'region'=>request('region')]) }}",
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
                            stripHtml : false,
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
                    },
                    {
                        data: 'title_en',
                    },
                    {
                        data: 'status',
                    },
                    {
                        data: 'action',
                    },
                ]
            });

        });
    </script>
@endsection