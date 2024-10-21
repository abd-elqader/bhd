@extends('Mix.layouts.app')
@section('pagetitle', __('messages.clients'))
@section('content')

<table class="table table-bordered data-table text-center" id="DataTable">
    <thead>
        <tr>
            <th>#</th>
            <th>@lang('messages.Name')</th>
            <th>@lang('messages.Email')</th>
            <th>@lang('messages.Phone')</th>
            <th>@lang('dashboard.tenant')</th>
            <th>@lang('dashboard.approve')</th>
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
                ajax: "{{ route('admin.clients.index',['requests'=>request()->requests ?? 0]) }}",
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'domain_name',
                        name: 'domain_name'
                    },
                    {
                        data: 'approve',
                        name: 'approve'
                    },
                ]
            });

        });

        function acceptTenant(user_id,db_name,SubDomain) {
            event.preventDefault();
            swal({title: "Please Check that database ("+db_name+") & SubDomain ("+SubDomain+") Exists",text:'DB_USERNAME={{ env("DB_USERNAME") }},DB_PASSWORD={{ env("DB_PASSWORD") }}', icon: "warning", buttons: true, dangerMode: true})
            .then((willchagestatus) => {
                if (willchagestatus) {
                    $.ajax({
                        type: "POST"
                        , url: "{{ route('admin.clients.acceptTenant') }}"
                        , data: {
                            _token: "{{ csrf_token() }}"
                            , user_id: user_id
                        , }
                        , dataType: 'text'
                        , cache: false
                        , success: function(alertTitle) {
                            alertTitle = JSON.parse(alertTitle);
                            swal({title: "😀❤️ "+alertTitle, icon: "success", buttons: true, dangerMode: true});
                            $('#checkbox'+ user_id).parent().parent().html("{{ __('messages.Approved') }}");
                        }
                        , error: function(xhr, status, errorThrown) {
                            swal({title: "{{ __('messages.sorry_there_was_an_error') }}", icon: "warning", buttons: true, dangerMode: true});
                        }
                    });
                }
            });
        }
    </script>
@endsection
