@extends('Mix.layouts.app')

@section('pagetitle', __('messages.Products'))
@section('content')
<div class="row">
    <div class="form-group p-1 col-md-6">
        <label>@lang('website.price')</label>
        <input type="number" name="price_from" id="price_from" class="form-control m-b-10" placeholder="@lang('messages.from')">
        <input type="number" name="price_to" id="price_to" class="form-control" placeholder="@lang('messages.to')">
    </div>
    <div class="form-group p-1 col-md-6">
        <label>@lang('messages.time')</label>
        <input type="date" name="time_from" id="time_from" class="form-control m-b-10" placeholder="@lang('dashboard.time_from')">
        <input type="date" name="time_to" id="time_to" class="form-control" placeholder="@lang('dashboard.time_to')">
    </div>

    <div class="form-group p-1 col-md-6">
        <label for="title_ar">@lang('messages.title_ar')</label>
        <input type="text" class="form-control" name="title_ar" id="title_ar" placeholder="@lang('messages.title_ar')">
    </div>
    <div class="form-group p-1 col-md-6">
        <label for="title_en">@lang('messages.title_en')</label>
        <input type="text" class="form-control" name="title_en" id="title_en" placeholder="@lang('messages.title_en')">
    </div>
    <div class="form-group p-1 col-md-6">
        <label for="category">@lang('messages.category')</label>
        <select name="category" id="category" class="form-control">
            <option value="">@lang('messages.Select')</option>
            @foreach ($Categories as $Category)
            <option value="{{ $Category['id'] }}">{{ $Category->title() }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group p-1 col-md-6">
        <label for="discount">@lang('messages.discount')</label>
        <select name="discount" id="discount" class="form-control">
            <option value="">@lang('messages.Select')</option>
            <option value="1">@lang('messages.Yes')</option>
            <option value="0">@lang('messages.No')</option>
        </select>
    </div>
    <div class="form-group p-1 col-md-6">
        <label for="sort">@lang('website.sort')</label>
        <select name="sort" id="sort" class="form-control">
            <option value="">@lang('messages.Select')</option>
            <option value="desc" data-key="price">@lang('website.price_desc')</option>
            <option value="asc"  data-key="price">@lang('website.price_asc')</option>
            <option value="desc" data-key="quantity">@lang('website.quantity_desc')</option>
            <option value="asc"  data-key="quantity">@lang('website.quantity_asc')</option>
        </select>
    </div>
    <div class="form-group p-1 col-md-12">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <button class="btn btn-primary form-control" id="search">@lang('messages.Search')</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@lang('dashboard.importExcel')</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.products.import') }}" method="POST" id="importExcel" enctype="multipart/form-data" data-parsley-validate>
            @csrf
            <p style="color: red;">
                @if(lang('en'))
                Notes: Do not change the file format. Please
                <br>
                and populate the table with the necessary information.
                <br>
                Every size or color must be on an individual line (in the same field), so use 
                 <br>
                 (ALT + Enter).
                @else
                ملاحظات: لا تقم بتغيير تنسيق الملف. لو سمحت
                 <br>
                 وملء الجدول بالمعلومات الضرورية.
                 <br>
                 يجب أن يكون كل حجم أو لون على سطر فردي (في نفس الحقل), لذا استخدم
                 <br> (ALT + Enter).
                @endif
            </p>
            <br>
            <a href="{{ public_asset('products.xlsx') }}">@lang('messages.download_example')</a>
            <div class="position-relative shadow p-3 w-100">
                <div class="d-flex align-items-center">
                    <div class="uploadOuter w-100">
                        <span class="dragBox w-100">
                            <p id="DargTxt" class=" d-flex align-items-center justify-content-center h-100 w-100">
                                @lang('messages.Darg_Drop')
                            </p>
                            <input required name="file" value="" type="file" accept=".xlsx,.xls,.csv" onchange="dragNdrop(event)" ondragover="drag()" ondrop="drop()" id="uploadFile">
                        </span>
                    </div>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('dashboard.close')</button>
        <button type="submit" form="importExcel" class="btn btn-primary">@lang('messages.save')</button>
      </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="my-2 col-12 col-md-4 text-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <button  class="btn btn-secondary">@lang('dashboard.importExcel')</button>
    </div>
    <div class="my-2 col-6 col-md-4 text-center">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary" disabled>@lang('dashboard.add_new')</a>
    </div>
    <div class="my-2 col-6 col-md-4 text-center">
        <button type="button" id="DeleteSelected" onclick="DeleteSelected('products')" class="btn btn-danger" disabled>@lang('dashboard.Delete_Selected')</button>
    </div>
</div>

<table class="table table-bordered data-table w-100" id="DataTable">
    <thead>
        <tr>
            <th><input type="checkbox" id="ToggleSelectAll" class="btn btn-primary"></th>
            <th>#</th>
            <th>@lang('messages.image')</th>
            <th>@lang('messages.category')</th>
            <th>@lang('messages.title_ar')</th>
            <th>@lang('messages.title_en')</th>
            <th>@lang('messages.price')</th>
            <th>@lang('dashboard.quantity')</th>
            <th>@lang('dashboard.most_selling')</th>
            <th>@lang('dashboard.popular')</th>
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
                        d.category = $('#category').val();
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
                        data: 'image',
                        sortable: false
                    },
                    {
                        data: 'category',
                        name: 'category',
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
                        data: 'most_selling',
                        sortable: false
                    },
                    {
                        data: 'popular',
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