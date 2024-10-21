@extends('Mix.layouts.app')

@section('pagetitle', __('messages.FAQ'))
@section('content')

<div class="row">
    <div class="my-2 col-6 text-sm-start">
        <a href="{{ route('admin.faq.create') }}" class="btn btn-primary" disabled>@lang('dashboard.add_new')</a>
    </div>
    <div class="my-2 col-6 text-sm-end">
        <button type="button" id="DeleteSelected" onclick="DeleteSelected('f_a_q_s')" class="btn btn-danger" disabled>@lang('dashboard.Delete_Selected')</button>
    </div>
</div>
<table class="table table-bordered data-table" id="DataTable">
    <thead>
        <tr>
            <th><input type="checkbox" id="ToggleSelectAll" class="btn btn-primary"></th>
            <th>#</th>
            <th style="text-align:center;">@lang('dashboard.question_ar')</th>
            <th style="text-align:center;">@lang('dashboard.question_en')</th>
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

            var table = $('#DataTable').DataTable({
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
                , ajax: "{{ route('admin.faq.index') }}"
                , engthMenu: [
                    [10, 25, 50, -1]
                    , [10, 25, 50, "All"]
                ]
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
                        data: 'checkbox'
                        , orderable: false
                    },
                    {
                        data: 'DT_RowIndex'
                        , orderable: false
                    },
                    {
                        data: 'question_ar'
                        , name: 'question_ar'
                    },
                    {
                        data: 'question_en'
                        , name: 'question_en'
                    },
                    {
                        name: 'status'
                        , data: 'status'
                    },
                    {
                        data: 'action'
                    }
                 ]
            });

        });






    </script>
@endsection
