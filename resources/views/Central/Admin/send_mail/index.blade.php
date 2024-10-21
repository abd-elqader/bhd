@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.emails'))
@section('content')



<div class="row">
    <div class="my-2 col-6 text-sm-start">
        <a href="{{ route('admin.send_mail.create') }}" class="btn btn-primary" disabled>@lang('dashboard.add_new')</a>
    </div>
</div>
<table class="table"  id="DataTable">
    <thead>
        <tr>
            <th>#</th>
            <th style="text-align:center;">@lang('dashboard.title')</th>
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

            var table = $('#DataTable').DataTable({
                processing: true,
                serverSide: true,
                oLanguage: {
                    sUrl: '{{ DT_Lang() }}'
                },
                ajax: "{{ route('admin.send_mail.index') }}",
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
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'action',
                    },
                ]
            });

        });




    </script>
@endsection
