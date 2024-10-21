@extends('Mix.layouts.app')
@section('pagetitle',__('messages.offers'))
@section('content')
<form method="POST" action="{{ route('admin.offers.store') }}" enctype="multipart/form-data" data-parsley-validate novalidate>
    @csrf
    <div class="row">
        <div class="form-group col-12 col-md-6">
            <label for="title_ar">@lang('dashboard.title_ar')</label>
            <input type="text" name="title_ar" id="title_ar" class="form-control" required>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="title_en">@lang('dashboard.title_en')</label>
            <input type="text" name="title_en" id="title_en" class="form-control" required>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="start_at">@lang('dashboard.start_at')</label>
            <input type="datetime-local" name="start_at" id="start_at" class="form-control" required>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="end_at">@lang('dashboard.end_at')</label>
            <input type="datetime-local" name="end_at" id="end_at" class="form-control" required>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="visibility">@lang('dashboard.visibility')</label>
            <select class="form-control form-select" required id="visibility" name="status">
                <option value="1">@lang('dashboard.visible')</option>
                <option value="0">@lang('dashboard.hidden')</option>
            </select>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="file">@lang("dashboard.image")</label>
            <label for="file" class="file-input btn btn-block btn-primary btn-file w-100">
                Browse&hellip;
                <input accept="image/*" type="file" type="file" name="image" id="file">
            </label>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="type">@lang('dashboard.type')</label>
            <select class="form-control form-select" required id="type_id" name="type_id">
                <option value="0" selected hidden disabled>{{ trans('messages.Select') }}</option>
                @foreach ($OfferTypes as $type)
                <option value="{{  $type['id'] }}">{{ $type->title() }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="for_id">@lang('dashboard.offer_for')</label>
            <select class="form-control form-select" required id="for_id" name="for_id">
                <option value="0" selected hidden disabled>{{ trans('messages.Select') }}</option>
                <option value="products">@lang('website.products')</option>
                <option value="categories">@lang('website.categories')</option>
            </select>
        </div>

        <div class="for_products d-none">
            <div class="row d-none for_type1">
                <div class="col-12 border border-primary p-1 m-2">
                    <div class="row">
                        <div class="form-group col-12 col-md-1 m-auto text-center">
                            <h2>X</h2>
                        </div>
                        <div class="form-group col-12 col-md-11">
                            <div class="row">
                                <div class="form-group col-12 col-md-6">
                                    <label>@lang('dashboard.quantity')</label>
                                    <input type="number" name="products[1][x][quantity]" min="0" step="1" class="form-control">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label>@lang('dashboard.product')</label>
                                    <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="products[1][x][product_ids][]">
                                        @foreach ($products as $product)
                                        <option value="{{  $product['id'] }}">{{ $product->title() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 border border-primary p-1 m-2">
                    <div class="row">
                        <div class="form-group col-12 col-md-1 m-auto text-center">
                            <h2>Y</h2>
                        </div>
                        <div class="form-group col-12 col-md-11">
                            {{--  for type for Y (free items or discount)  --}}
                            <div class="row">
                                <div class="col-12">
                                    <label>@lang('dashboard.y_for')</label>
                                    <select class="form-control for_products_xy" required name="products[1][y][type]">
                                        <option value="0" selected hidden disabled>{{ trans('messages.Select') }}</option>
                                        <option value="items">@lang('messages.items')</option>
                                        <option value="discount">@lang('messages.value')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    {{--  for free items  --}}
                                    <div class="row for_products_xy_items d-none">
                                        <div class="form-group col-12 col-md-6">
                                            <label>@lang('dashboard.quantity')</label>
                                            <input type="number" name="products[1][y][items][quantity]" min="0" step="1" class="form-control">
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <label>@lang('dashboard.product')</label>
                                            <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="products[1][y][items][product_ids][]">
                                                @foreach ($products as $product)
                                                <option value="{{  $product['id'] }}">{{ $product->title() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--  for discount (fixedprice or Percentage)  --}}
                                    <div class="row for_products_xy_discount d-none">
                                        <div class="form-group col-12 col-md-6">
                                            <label>@lang('dashboard.value')</label>
                                            <input type="number" name="products[1][y][discount][value]" min="0" step="1" class="form-control">
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <label>@lang('dashboard.type')</label>
                                            <select class="form-control" required name="products[1][y][discount][type]">
                                                <option value="0" selected hidden disabled>{{ trans('messages.Select') }}</option>
                                                <option value="fixedprice">@lang('messages.fixedprice')</option>
                                                <option value="percentage">@lang('messages.Percentage')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-none for_type2">
                <div class="form-group col-12 col-md-6">
                    <label for="value">@lang('dashboard.value')</label>
                    <input type="number" name="products[2][value]" min="0" step="0.001" class="form-control">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="product">@lang('dashboard.product')</label>
                    <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="products[2][product_ids][]">
                        @foreach ($products as $product)
                        <option value="{{  $product['id'] }}">{{ $product->title() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row d-none for_type3">
                <div class="form-group col-12 col-md-6">
                    <label for="value">@lang('dashboard.value')</label>
                    <input type="number" name="products[3][value]" min="0" step="1" class="form-control">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="product">@lang('dashboard.product')</label>
                    <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="products[3][product_ids][]">
                        @foreach ($products as $product)
                        <option value="{{  $product['id'] }}">{{ $product->title() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>




        <div class="for_categories d-none">
            <div class="row d-none for_type1">
                <div class="col-12 border border-primary p-1 m-2">
                    <div class="row">
                        <div class="form-group col-12 col-md-1 m-auto text-center">
                            <h2>X</h2>
                        </div>
                        <div class="form-group col-12 col-md-11">
                            <div class="row">
                                <div class="form-group col-12 col-md-6">
                                    <label>@lang('dashboard.quantity')</label>
                                    <input type="number" name="categories[1][x][quantity]" min="0" step="1" class="form-control">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label>@lang('dashboard.category')</label>
                                    <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="categories[1][x][category_ids][]">
                                        @foreach ($categories as $category)
                                        <option value="{{  $category['id'] }}">{{ $category->title() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 border border-primary p-1 m-2">
                    <div class="row">
                        <div class="form-group col-12 col-md-1 m-auto text-center">
                            <h2>Y</h2>
                        </div>
                        <div class="form-group col-12 col-md-11">
                            {{--  for type for Y (products & categories)  --}}
                            <div class="row">
                                <div class="col-12">
                                    <label>@lang('dashboard.y_for')</label>
                                    <select class="form-control for_categories_xy" required name="categories[1][y][for]">
                                        <option value="0" selected hidden disabled>{{ trans('messages.Select') }}</option>
                                        {{-- <option value="products">@lang('website.products')</option> --}}
                                        <option value="categories">@lang('website.categories')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    {{--  for free categories  --}}
                                    <div class="row for_categories_xy_categories d-none">
                                        <div class="form-group col-12 col-md-6">
                                            <label>@lang('dashboard.category')</label>
                                            <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="categories[1][y][categories][category_ids][]">
                                                @foreach ($categories as $category)
                                                <option value="{{  $category['id'] }}">{{ $category->title() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <label>@lang('dashboard.offer_for')</label>
                                            <select class="form-control for_categories_xy_type" required name="categories[1][y][type]">
                                                <option value="0" selected hidden disabled>{{ trans('messages.Select') }}</option>
                                                <option value="quantity">@lang('website.quantity')</option>
                                                <option value="fixedprice">@lang('messages.fixedprice')</option>
                                                <option value="percentage">@lang('messages.Discount Percentage')</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{--  for free products  --}}
                                    <div class="row for_categories_xy_products d-none">
                                        <div class="form-group col-12 col-md-6">
                                            <label>@lang('dashboard.products')</label>
                                            <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="categories[1][y][products][products_ids][]">
                                                @foreach ($products as $product)
                                                <option value="{{  $product['id'] }}">{{ $product->title() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <label>@lang('dashboard.offer_for')</label>
                                            <select class="form-control for_categories_xy_type" required name="categories[1][y][type]">
                                                <option value="0" selected hidden disabled>{{ trans('messages.Select') }}</option>
                                                <option value="quantity">@lang('website.quantity')</option>
                                                <option value="fixedprice">@lang('messages.fixedprice')</option>
                                                <option value="percentage">@lang('messages.Discount Percentage')</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="row for_categories_xy_categories_type_quantity d-none">
                                            <div class="form-group col-12 col-md-6">
                                                <label>@lang('dashboard.quantity')</label>
                                                <input type="number" name="categories[1][y][quantity]" min="0" step="1" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row for_categories_xy_categories_type_value d-none">
                                            <div class="form-group col-12 col-md-6">
                                                <label>@lang('dashboard.value')</label>
                                                <input type="number" name="categories[1][y][value]" min="0" step="1" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-none for_type2">
                <div class="form-group col-12 col-md-6">
                    <label for="value">@lang('dashboard.value')</label>
                    <input type="number" name="categories[2][value]" min="0" step="0.001" class="form-control">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="category">@lang('dashboard.category')</label>
                    <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="categories[2][category_ids][]">
                        @foreach ($categories as $category)
                        <option value="{{  $category['id'] }}">{{ $category->title() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row d-none for_type3">
                <div class="form-group col-12 col-md-6">
                    <label for="value">@lang('dashboard.value')</label>
                    <input type="number" name="categories[3][value]" min="0" step="1" class="form-control">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="category">@lang('dashboard.category')</label>
                    <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="categories[3][category_ids][]">
                        @foreach ($categories as $category)
                        <option value="{{  $category['id'] }}">{{ $category->title() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>


        <div class="clearfix"></div>
        <div class="form-group col-12 my-4">
            <div class="button-group">
                <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                    {{ __('messages.Submit') }}
                </button>
            </div>
        </div>
    </div>
</form>
@endsection


@section('js')
<link href="https://unpkg.com/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://unpkg.com/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
    $(document).on('change', '#type_id', function() {
        display_products_categories();
    });
    $(document).on('change', '#for_id', function() {
        display_products_categories();
    });

    function empty_products_categories() {
        $('.for_products').find('input').val('');
        $('.for_categories').find('input').val('');
        $("select").not("[class=form-select]").removeAttr("selected");
        $(".for_products select").not("[class=select2]").find('option:eq(0)').prop('selected', true);
        $(".for_categories select").not("[class=select2]").find('option:eq(0)').prop('selected', true);
        $('.select2').val(null).trigger("change");

        $('.for_products').addClass('d-none');
        $('.for_categories').addClass('d-none');
        $('.for_type1').addClass('d-none');
        $('.for_type2').addClass('d-none');
        $('.for_type3').addClass('d-none');
        $('.for_products_xy_items').addClass('d-none');
        $('.for_products_xy_discount').addClass('d-none');
        $('.for_categories_xy_categories').addClass('d-none');
        $('.for_categories_xy_products').addClass('d-none');
    }
    function display_products_categories() {
        type_id = $('#type_id').find('option:selected').val();
        for_id = $('#for_id').find('option:selected').val();
        if (type_id && for_id) {
            empty_products_categories();
            if (type_id == 1) {
                $('.for_type1').removeClass('d-none');
                if (for_id == 'products') {
                    $('.for_products').removeClass('d-none');

                }
                if (for_id == 'categories') {
                    $('.for_categories').removeClass('d-none');

                }
            }
            if (type_id == 2) {
                $('.for_type2').removeClass('d-none');
                if (for_id == 'products') {
                    $('.for_products').removeClass('d-none');

                }
                if (for_id == 'categories') {
                    $('.for_categories').removeClass('d-none');

                }
            }
            if (type_id == 3) {
                $('.for_type3').removeClass('d-none');
                if (for_id == 'products') {
                    $('.for_products').removeClass('d-none');

                }
                if (for_id == 'categories') {
                    $('.for_categories').removeClass('d-none');

                }
            }
        }

    }

    $(document).on('change', '.for_products_xy', function() {
        $(".for_products_xy_items .select2").val(null).trigger("change");
        $(".for_products_xy_items").find('select').removeAttr("selected");
        $('.for_products_xy_items').find('input').val('');
        $(".for_products_xy_discount .select2").val(null).trigger("change");
        $(".for_products_xy_discount").find('select').removeAttr("selected");
        $('.for_products_xy_discount').find('input').val('');
        xy = $(this).val();
        $('.for_products_xy_items').addClass('d-none');
        $('.for_products_xy_discount').addClass('d-none');
        if (xy == 'items') {
            $('.for_products_xy_items').removeClass('d-none');
        }
        if (xy == 'discount') {
            $('.for_products_xy_discount').removeClass('d-none');
        }
    });
    $(document).on('change', '.for_categories_xy', function() {
        $(".for_categories_xy_products .select2").val(null).trigger("change");
        $(".for_categories_xy_products").find('select').removeAttr("selected");
        $('.for_categories_xy_products').find('input').val('');
        $(".for_categories_xy_categories .select2").val(null).trigger("change");
        $(".for_categories_xy_categories").find('select').removeAttr("selected");
        $('.for_categories_xy_categories').find('input').val('');
        xy = $(this).val();
        $('.for_categories_xy_categories').addClass('d-none');
        $('.for_categories_xy_products').addClass('d-none');
        $('.for_categories_xy_categories_type_quantity').addClass('d-none');
        $('.for_categories_xy_categories_type_value').addClass('d-none');
        if (xy == 'categories') {
            $('.for_categories_xy_categories').removeClass('d-none');
        }
        if (xy == 'products') {
            $('.for_categories_xy_products').removeClass('d-none');
        }
    });
    $(document).on('change', '.for_categories_xy_type', function() {
        $('.for_categories_xy_categories_type_quantity').val('');
        $('.for_categories_xy_categories_type_value').val('');
        xy = $(this).val();
        $('.for_categories_xy_categories_type_quantity').addClass('d-none');
        $('.for_categories_xy_categories_type_value').addClass('d-none');
        if (xy == 'quantity') {
            $('.for_categories_xy_categories_type_quantity').removeClass('d-none');
        }else{
            $('.for_categories_xy_categories_type_value').removeClass('d-none');
        }
    });

</script>
@endsection
