@extends('Mix.layouts.app')
@section('pagetitle', __('website.contact'))
@section('content')

<div class="my-2 text-sm-end">
    <button type="button" id="DeleteSelected" onclick="DeleteSelected('contacts')" class="btn btn-danger" disabled>@lang('dashboard.Delete_Selected')</button>
</div>
<table class="table table-bordered data-table" id="DataTable">
    <thead>
        <tr>
            <th><input type="checkbox" id="ToggleSelectAll" class="btn btn-primary"></th>
            <th>#</th>
            <th>@lang('messages.name')</th>
            <th>@lang('messages.phone')</th>
            <th>@lang('messages.email')</th>
            <th>@lang('messages.subject')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

@endsection



@section('js')


    <script type="text/javascript">

        $(document).ready(function () {
            var table = $('#DataTable').dataTable({
                processing: true
                , serverSide: true
                , oLanguage: {
                    sUrl: '{{ DT_Lang() }}'
                }
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
                , ajax: "{{ route('admin.contact.index') }}"
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
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'

                    },
                    {
                        data: 'phone',
                        name: 'phone'

                    },
                    {
                        name: 'email',
                        data: 'email'

                    },
                    {
                        data: 'subject',
                        name: 'subject'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                 ],
             });
        });
    </script>

@endsection
