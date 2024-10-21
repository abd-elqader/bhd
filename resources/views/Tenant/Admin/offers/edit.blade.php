@extends('Mix.layouts.app')
@section('pagetitle',__('messages.offers'))
@section('content')
<form method="POST" action="{{ route('admin.offers.update',$Offer) }}" enctype="multipart/form-data" data-parsley-validate novalidate>
    @csrf
    @method('PUT')
    <div class="row">
        <div class="form-group col-12 col-md-6">
            <label for="title_ar">@lang('dashboard.title_ar')</label>
            <input type="text" name="title_ar" value="{{ $Offer->title_ar }}" id="title_ar" class="form-control" required>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="title_en">@lang('dashboard.title_en')</label>
            <input type="text" name="title_en" value="{{ $Offer->title_en }}" id="title_en" class="form-control" required>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="start_at">@lang('dashboard.start_at')</label>
            <input type="datetime-local" value="{{ $Offer->start_at }}" name="start_at" id="start_at" class="form-control" required>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="end_at">@lang('dashboard.end_at')</label>
            <input type="datetime-local" value="{{ $Offer->end_at }}" name="end_at" id="end_at" class="form-control" required>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="visibility">@lang('dashboard.visibility')</label>
            <select class="form-control form-select" required id="visibility" name="status">
                <option {{ $Offer->status == 1 ? 'selected' : '' }} value="1">@lang('dashboard.visible')</option>
                <option {{ $Offer->status == 0 ? 'selected' : '' }} value="0">@lang('dashboard.hidden')</option>
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
                <option {{ $Offer->type_id == $type->id ? 'selected' : '' }} value="{{  $type['id'] }}">{{ $type->title() }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="for_id">@lang('dashboard.offer_for')</label>
            <select class="form-control form-select" required id="for_id" name="for_id">
                <option value="0" selected hidden disabled>{{ trans('messages.Select') }}</option>
                <option {{ $Offer->for == 'products' ? 'selected' : '' }} value="products">@lang('website.products')</option>
                <option {{ $Offer->for == 'categories' ? 'selected' : '' }} value="categories">@lang('website.categories')</option>
            </select>
        </div>
        <div class="for_products   {{ $Offer->for == 'products' || $Offer->ProductsData && $Offer->value  ? '' : 'd-none' }}">
            <div class="row {{ $Offer->type_id == 1 ? '' : 'd-none' }} for_type1">
                <div class="col-12 border border-primary p-1 m-2">
                    <div class="row">
                        <div class="form-group col-12 col-md-1 m-auto text-center">
                            <h2>X</h2>
                        </div>
                        <div class="form-group col-12 col-md-11">
                            <div class="row">
                                <div class="form-group col-12 col-md-6">
                                    <label>@lang('dashboard.quantity')</label>
                                    <input type="number" name="products[1][x][quantity]" value="{{ $Offer->ProductsData ? $Offer->ProductsData->x_quantity : '' }}" min="0" step="1" class="form-control">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label>@lang('dashboard.product')</label>
                                    <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="products[1][x][product_ids][]">
                                        @foreach ($Products as $Product)
                                        <option {{ in_array($Product->id , $Offer->Products->where('pivot.for','x')->pluck('id')->toarray() )? 'selected' : '' }} value="{{  $Product['id'] }}">{{ $Product->title() }}</option>
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
                            {{-- for type for Y (free items or discount)  --}}
                            <div class="row">
                                <div class="col-12">
                                    <label>@lang('dashboard.y_for')</label>
                                    <select class="form-control for_products_xy" required name="products[1][y][type]">
                                        <option value="0" selected hidden disabled>{{ trans('messages.Select') }}</option>
                                        <option {{ $Offer->ProductsData && $Offer->ProductsData->y_for == 'items' ? 'selected' : ''  }} value="items">@lang('messages.items')</option>
                                        <option {{ $Offer->ProductsData && $Offer->ProductsData->y_for == 'discount' ? 'selected' : ''  }} value="discount">@lang('messages.value')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    {{-- for free items  --}}
                                    <div class="row for_products_xy_items {{  $Offer->ProductsData &&  $Offer->ProductsData->y_for_quantity ? '' : 'd-none' }}">
                                        <div class="form-group col-12 col-md-6">
                                            <label>@lang('dashboard.quantity')</label>
                                            <input type="number" name="products[1][y][items][quantity]" value="{{ $Offer->ProductsData ? $Offer->ProductsData->y_for_quantity : '' }}" min="0" step="1" class="form-control">
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <label>@lang('dashboard.product')</label>
                                            <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="products[1][y][items][product_ids][]">
                                                @foreach ($Products as $Product)
                                                <option {{ in_array($Product->id , $Offer->Products->where('pivot.for','y')->pluck('id')->toarray() )? 'selected' : '' }} value="{{  $Product['id'] }}">{{ $Product->title() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- for discount (fixedprice or Percentage)  --}}
                                    <div class="row for_products_xy_discount {{  $Offer->ProductsData &&  $Offer->ProductsData->y_for_value > 0 ? '' : 'd-none' }}">
                                        <div class="form-group col-12 col-md-6">
                                            <label>@lang('dashboard.value')</label>
                                            <input type="number" name="products[1][y][discount][value]" value="{{ $Offer->ProductsData ? $Offer->ProductsData->y_for_value : '' }}" min="0" step="1" class="form-control">
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <label>@lang('dashboard.type')</label>
                                            <select class="form-control" required name="products[1][y][discount][type]">
                                                <option value="0" selected hidden disabled>{{ trans('messages.Select') }}</option>
                                                <option {{ $Offer->ProductsData  && $Offer->ProductsData->y_for_type == 'fixedprice' ? 'selected' : '' }} value="fixedprice">@lang('messages.fixedprice')</option>
                                                <option {{ $Offer->ProductsData  && $Offer->ProductsData->y_for_type == 'percentage' ? 'selected' : '' }} value="percentage">@lang('messages.Discount Percentage')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row {{ $Offer->value && $Offer->type_id == 2 ? '' : 'd-none' }} for_type2">
                <div class="form-group col-12 col-md-6">
                    <label for="value">@lang('dashboard.value')</label>
                    <input type="number" name="products[2][value]" value="{{ $Offer->value }}" min="0" step="0.001" class="form-control">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="product">@lang('dashboard.product')</label>
                    <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="products[2][product_ids][]">
                        @foreach ($Products as $Product)
                        <option {{ in_array($Product->id , $Offer->Products->pluck('id')->toarray() )? 'selected' : '' }} value="{{  $Product['id'] }}">{{ $Product->title() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row {{  $Offer->value && $Offer->type_id == 3 ? '' : 'd-none' }} for_type3">
                <div class="form-group col-12 col-md-6">
                    <label for="value">@lang('dashboard.value')</label>
                    <input type="number" name="products[3][value]" value="{{ $Offer->value }}" min="0" step="1" class="form-control">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="product">@lang('dashboard.product')</label>
                    <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="products[3][product_ids][]">
                        @foreach ($Products as $Product)
                        <option {{ in_array($Product->id , $Offer->Products->pluck('id')->toarray() )? 'selected' : '' }} value="{{  $Product['id'] }}">{{ $Product->title() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>




        <div class="for_categories  {{ $Offer->for == 'categories' || $Offer->CategoriesData ? '' : 'd-none' }}">
            <div class="row {{ $Offer->type_id == 1 ? '' : 'd-none' }} for_type1">
                <div class="col-12 border border-primary p-1 m-2">
                    <div class="row">
                        <div class="form-group col-12 col-md-1 m-auto text-center">
                            <h2>X</h2>
                        </div>
                        <div class="form-group col-12 col-md-11">
                            <div class="row">
                                <div class="form-group col-12 col-md-6">
                                    <label>@lang('dashboard.quantity')</label>
                                    <input type="number" name="categories[1][x][quantity]" value="{{ $Offer->CategoriesData && $Offer->CategoriesData->x_quantity }}" min="0" step="1" class="form-control">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label>@lang('dashboard.category')</label>
                                    <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="categories[1][x][category_ids][]">
                                        @foreach ($Categories as $Category)
                                        <option {{ in_array($Category->id , $Offer->Categories->where('pivot.for','x')->pluck('id')->toarray() )? 'selected' : '' }} value="{{  $Category['id'] }}">{{ $Category->title() }}</option>
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
                            {{-- for type for Y (products & categories)  --}}
                            <div class="row">
                                <div class="col-12">
                                    <label>@lang('dashboard.y_for')</label>
                                    <select class="form-control for_categories_xy" required name="categories[1][y][for]">
                                        <option value="0" selected hidden disabled>{{ trans('messages.Select') }}</option>
                                        {{-- <option {{  $Offer->CategoriesData && $Offer->CategoriesData->y_for == 'products' ? 'selected' : ''  }} value="products">@lang('website.products')</option> --}}
                                        <option {{  $Offer->CategoriesData && $Offer->CategoriesData->y_for == 'categories' ? 'selected' : ''  }} value="categories">@lang('website.categories')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    {{-- for free categories  --}}
                                    <div class="row for_categories_xy_categories  {{ ($Offer->CategoriesData && $Offer->CategoriesData->y_for == 'categories') && $Offer->Categories ? '' : 'd-none' }}">
                                        <div class="form-group col-12 col-md-6">
                                            <label>@lang('dashboard.category')</label>
                                            <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="categories[1][y][categories][category_ids][]">
                                                @foreach ($Categories as $Category)
                                                <option {{ in_array($Category->id , $Offer->Categories->where('pivot.for','y')->pluck('id')->toarray() )? 'selected' : '' }} value="{{  $Category['id'] }}">{{ $Category->title() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <label>@lang('dashboard.offer_for')</label>
                                            <select class="form-control for_categories_xy_type" required name="categories[1][y][type]">
                                                <option value="0" selected hidden disabled>{{ trans('messages.Select') }}</option>
                                                <option {{ $Offer->CategoriesData && $Offer->CategoriesData->y_for_type == 'quantity' ? 'selected' : ''  }} value="quantity">@lang('website.quantity')</option>
                                                <option {{ $Offer->CategoriesData && $Offer->CategoriesData->y_for_type == 'fixedprice' ? 'selected' : ''  }} value="fixedprice">@lang('messages.fixedprice')</option>
                                                <option {{ $Offer->CategoriesData && $Offer->CategoriesData->y_for_type == 'percentage' ? 'selected' : ''  }} value="percentage">@lang('messages.Discount Percentage')</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- for free products  --}}
                                    <div class="row for_categories_xy_products {{ ($Offer->CategoriesData && $Offer->CategoriesData->y_for == 'products') && $Offer->Products ? '' : 'd-none' }}">
                                        <div class="form-group col-12 col-md-6">
                                            <label>@lang('dashboard.products')</label>
                                            <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="categories[1][y][products][product_ids][]">
                                                @foreach ($Products as $Product)
                                                <option {{ in_array($Product->id , $Offer->Products->where('pivot.for','y')->pluck('id')->toarray() )? 'selected' : '' }} value="{{  $Product['id'] }}">{{ $Product->title() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <label>@lang('dashboard.offer_for')</label>
                                            <select class="form-control for_categories_xy_type" required name="categories[1][y][type]">
                                                <option value="0" selected hidden disabled>{{ trans('messages.Select') }}</option>
                                                <option {{ $Offer->CategoriesData && $Offer->CategoriesData->y_for_type == 'quantity' ? 'selected' : ''  }} value="quantity">@lang('website.quantity')</option>
                                                <option {{ $Offer->CategoriesData && $Offer->CategoriesData->y_for_type == 'fixedprice' ? 'selected' : ''  }} value="fixedprice">@lang('messages.fixedprice')</option>
                                                <option {{ $Offer->CategoriesData && $Offer->CategoriesData->y_for_type == 'percentage' ? 'selected' : ''  }} value="percentage">@lang('messages.Discount Percentage')</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-6 for_categories_xy_categories_type_quantity {{ $Offer->CategoriesData && $Offer->CategoriesData->y_for_quantity ? '' : 'd-none' }}">
                                            <label>@lang('dashboard.quantity')</label>
                                            <input type="number" name="categories[1][y][quantity]" value="{{ $Offer->CategoriesData && $Offer->CategoriesData->y_for_quantity }}" min="0" step="1" class="form-control">
                                        </div>
                                        <div class="col-12 col-md-6 for_categories_xy_categories_type_value {{ $Offer->CategoriesData && in_array($Offer->CategoriesData->y_for_type,['percentage','fixedprice']) ? '' : 'd-none' }}">
                                            <label>@lang('dashboard.value')</label>
                                            <input type="number" name="categories[1][y][value]" value="{{ $Offer->CategoriesData && in_array($Offer->CategoriesData->y_for_type,['quantity']) ? '' : 'd-none' }}" min="0" step="1" class="form-control">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row {{  $Offer->value &&  $Offer->type_id == 2 ? '' : 'd-none' }} for_type2">
                <div class="form-group col-12 col-md-6">
                    <label for="value">@lang('dashboard.value')</label>
                    <input type="number" name="categories[2][value]" value="{{ $Offer->value }}" min="0" step="0.001" class="form-control">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="category">@lang('dashboard.category')</label>
                    <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="categories[2][category_ids][]">
                        @foreach ($Categories as $Category)
                        <option {{ in_array($Category->id , $Offer->Categories->pluck('id')->toarray() )? 'selected' : '' }} value="{{  $Category['id'] }}">{{ $Category->title() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row {{  $Offer->value &&  $Offer->type_id == 3 ? '' : 'd-none' }} for_type3">
                <div class="form-group col-12 col-md-6">
                    <label for="value">@lang('dashboard.value')</label>
                    <input type="number" name="categories[3][value]" value="{{ $Offer->value }}" min="0" step="1" class="form-control">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="category">@lang('dashboard.category')</label>
                    <select class="form-control  select2 select2-hidden-accessible" multiple data-live-search="true" name="categories[3][category_ids][]">
                        @foreach ($Categories as $Category)
                        <option {{ in_array($Category->id , $Offer->Categories->pluck('id')->toarray() )? 'selected' : '' }} value="{{  $Category['id'] }}">{{ $Category->title() }}</option>
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
        } else {
            $('.for_categories_xy_categories_type_value').removeClass('d-none');
        }
    });

</script>
@endsection
