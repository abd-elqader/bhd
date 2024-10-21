@extends('Mix.layouts.app')
@section('pagetitle', __('messages.categories'))
@section('content')

<table class="table">
    <tbody class="text-center">
        <tr>
            <div class="text-center">
                <img width="200px" src="{{ public_asset($Category['image']) }}" alt="item" class="changeimage">
            </div>
        </tr>
        <tr>
            <td>{{ __('messages.title_ar') . ':' }}</td>
            <td>{{ $Category['title_ar'] }}</td>
        </tr>

        <tr>
            <td>{{ __('messages.title_en') . ':' }}</td>
            <td>{{ $Category['title_en'] }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.status') . ':' }}</td>
            <td>{{ $Category['status'] ? __('messages.visible') : __('messages.hidden') }}</td>
        </tr>
    </tbody>
</table>



<h2>{{ trans('messages.Products') }}</h2>

<table class="table table-bordered data-table w-100" id="DataTable">
    <thead>
        <tr>
            <th><input type="checkbox" id="ToggleSelectAll" class="btn btn-primary"></th>
            <th>#</th>
            <th>@lang('messages.title_ar')</th>
            <th>@lang('messages.title_en')</th>
            <th>@lang('messages.price')</th>
            <th>@lang('dashboard.quantity')</th>
            <th>@lang('messages.image')</th>
            <th>@lang('messages.display')</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="row_position" data-table="products">

    </tbody>
</table>
@endsection


@section('js')
    <script type="text/javascript">
        $("#itemproducts").addClass('cyan');
        $(function() {

            var table = $('#DataTable').DataTable({
                processing: true
                , searching: false
                , serverSide: true
                , oLanguage: {
                    sUrl: '{{ DT_Lang() }}'
                }
                , createdRow: function( row, data, dataIndex ) {
                    $( row ).attr('data-position', data.arrangement);
                    $( row ).attr('data-id', data.id);
                    $( row ).attr('id', data.id);
                }
                , ajax: {
                    url: "{{ route('admin.products.index') }}"
                    , data: function(d) {
                        d.title_ar = $('#title_ar').val();
                        d.title_en = $('#title_en').val();
                        d.discount = $('#discount').val();
                        d.category = {{ $Category->id ?? 0 }};
                        d.branch = $('#branch').val();

                        d.price_from = $('#price_from').val();
                        d.price_to = $('#price_to').val();

                        d.time_from = $('#time_from').val();
                        d.time_to = $('#time_to').val();
                        d.sort = $('#sort').val();
                        d.sort_key = $('#sort').children("option:selected").attr('data-key');
                    }
                }
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
                , lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
                , columns: [
                    {
                        data: 'checkbox',
                        sortable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        sortable: false
                    },
                    {
                        data: 'title_ar',
                        name: 'title_ar',
                    },
                    {
                        data: 'title_en',
                        name: 'title_en',
                    },
                    {
                        data: 'price',
                        name: 'price',
                        sortable: false
                    },
                    {
                        data: 'quantity',
                        name: 'quantity',
                        sortable: false
                    },
                    {
                        data: 'image',
                        sortable: false
                    },
                    {
                        data: 'status',
                        sortable: false
                    },
                    {
                        data: 'action',
                        sortable: false
                    }
                ]
            });
            $('#search').click(function() {
                table.draw();
            });
        });





        $(document).on('click', '.status_toggleswitch', function() {
            toggleswitch($(this).attr('data-id'),'products','status','status_checkbox');
        });
        $(document).on('click', '.popular_toggleswitch', function() {
            toggleswitch($(this).attr('data-id'),'products','popular','popular_checkbox');
        });
        $(document).on('click', '.most_selling_toggleswitch', function() {
            toggleswitch($(this).attr('data-id'),'products','most_selling','most_selling_checkbox');
        });

    </script>
@endsection