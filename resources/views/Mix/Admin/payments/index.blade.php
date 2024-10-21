@extends('Mix.layouts.app')

@section('pagetitle', __('dashboard.paymentMethods'))
@section('content')

@if(lang('en'))
<p class="my-4 text-danger font-weight-bold">
    Dear store owner, we would like to inform you that the electronic payment for our services is due 14 days after the invoice date. Thank you for your cooperation.
</p>
@else
<p class="my-4 text-danger font-weight-bold">
    عزيزي صاحب المتجر، نود إعلامك بأن استحقاق الدفع الإلكتروني لخدماتنا سيكون بعد 14 يومًا من تاريخ إصدار الفاتورة. شكراً لتعاونكم.
</p>
@endif

<table class="table table-bordered data-table" id="DataTable">
    <thead>
        <tr>
            <th><input type="checkbox" id="ToggleSelectAll" class="btn btn-primary"></th>
            <th>#</th>
            <th>@lang('messages.title_ar')</th>
            <th>@lang('messages.title_en')</th>
            <th>@lang('messages.image')</th>
            <th>@lang('messages.status')</th>
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
                },
                ajax: "{{ route('admin.payments.index') }}",
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
                        data: 'title_ar',
                        name: 'title_ar'
                    },
                    {
                        data: 'title_en',
                        name: 'title_en'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        name: 'status',
                        data: 'status'
                    },
                    {
                        data: 'action',
                    },
                ]
            });

        });



    </script>
@endsection
