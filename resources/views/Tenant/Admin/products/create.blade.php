@extends('Mix.layouts.app')

@section('pagetitle',__('messages.Add Product'))

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style>
        .preview_image{
            width:100px;
        }
    </style>
@endsection

@section('js')
<script src="https://unpkg.com/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {
        $(".selectpicker").selectpicker();
    });
    $(document).on("click", ".toggle-theme", function() {
        $(".selectpicker").selectpicker();
    });
    $('#discountDiscount').change(function() {
        if ($(this).val() === '1') {
            $('.discount').removeClass('hide');
        } else {
            $('.discount').addClass('hide');
            $('#discount').val('');
            $('#discount_from').val('');
            $('#discount_to').val('');
        }
    });
   $(document).on("change", "#filter", function() {
        
        $('.colors').addClass('hide');
        $('.sizes').addClass('hide');

        if ($(this).val() === 'has_size') {
            $('.sizes').removeClass('hide');
        }
        if ($(this).val() === 'has_color') {
            $('.colors').removeClass('hide');
        }
        if ($(this).val() === 'has_size_color') {
            $('.colors').removeClass('hide');
            $('.sizes').removeClass('hide');
        }
        

    });
    $('.add_two').click(function() {
        $('.block:last').before(
           '<div class="row block">' +
               '<div class="my-1 col-md-3 col-sm-12 sizes "><label class="my-1">@lang("dashboard.size")</label>' +
                '<select name="sizes[]" class="form-control selectpicker  w-100" data-live-search="true">' +
                    '<option value="">-----</option>'+
                        @foreach ($Sizes as $size) '<option value="{{ $size->id }}">{{ $size->title() }}</option>' + @endforeach
                   '</select>' +
               '</div>' +
               '<div class="my-1 col-md-3 col-sm-12 colors hide"><label class="my-1">@lang("dashboard.color")</label>' +
                '<select name="colors[]" class="form-control selectpicker  w-100" data-live-search="true">' +
                    '<option value="">-----</option>'+
                        @foreach ($Colors as $color) '<option value="{{ $color->id }}">{{ $color->title() }}</option>' + @endforeach
                   '</select>' +
               '</div>' +
               '<div class="my-1 col-md-3 col-sm-12"><label class="my-1">@lang("dashboard.price")</label><input type="text" value="0.000"  name="prices[]" placeholder="@lang("dashboard.price")" class="form-control"></div>' +
               '<div class="my-1 col-md-2 col-sm-12"><label class="my-1">@lang("dashboard.quantity")</label><input type="text" value="1" name="quantities[]" placeholder="@lang("dashboard.quantity")" class="form-control"></div>' +
               '<div class="my-1 col-md-1 col-sm-12"><label class="my-1 row">@lang("dashboard.delete")</label><button class="btn btn-danger remove text-center mx-auto" type="button">-</button></div>' +
           '</div>'
        );
        $(".selectpicker").selectpicker();
        
        $('.colors').addClass('hide');
        $('.sizes').addClass('hide');

        if ($('#filter').val() === 'has_size') {
            $('.sizes').removeClass('hide');
        }
        if ($('#filter').val() === 'has_color') {
            $('.colors').removeClass('hide');
        }
        if ($('#filter').val() === 'has_size_color') {
            $('.colors').removeClass('hide');
            $('.sizes').removeClass('hide');
        }
    });
    $(document).on('click', '.remove', function() {
        $(this).parent().parent().remove();
    });
    
    $(document).on('change', 'input[type="file"]', function() {
        var Preview = $(this).parent().parent().next();
        Preview.empty();
        if (this.files && this.files.length > 0) {
            for (var i = 0; i < this.files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var image = $("<img>").attr("src", e.target.result);
                    image.addClass("preview_image");
                    Preview.append(image);
                };
                reader.readAsDataURL(this.files[i]);
            }
        }
    });
</script>
@endsection
@section('content')
<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" data-parsley-validate>
    @csrf
    <div class="row">
        
        <div class="form-group my-1 col-md-6 col-sm-12">
            <label class="my-1">@lang('dashboard.category')</label>
            <select name="categories[]" required class="form-control selectpicker  w-100" data-live-search="true">
                @foreach($Categories as $category)
                <option @selected(in_array($category['id'], (array)old('categories') )) value="{{ $category['id'] }}">{{ $category->title() }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group my-1 col-md-6 col-sm-12">
            <label class="my-1">@lang('dashboard.code')</label>
            <input type="text" name="code" value="{{ old('code') }}" placeholder="@lang('dashboard.code')" class="form-control">
        </div>


        <div class="form-group my-1 col-md-6 col-sm-12">
            <label class="my-1">@lang('dashboard.title_ar')</label>
            <input required type="text" name="title_ar" value="{{ old('title_ar') }}" placeholder="@lang('dashboard.title_ar')" class="form-control">
        </div>
        <div class="form-group my-1 col-md-6 col-sm-12">
            <label class="my-1">@lang('dashboard.title_en')</label>
            <input required type="text" name="title_en" value="{{ old('title_en') }}" placeholder="@lang('dashboard.title_en')" class="form-control">
        </div>
        <div class="form-group my-1 col-md-6 col-sm-12">
            <label class="my-1">@lang('dashboard.desc_ar')</label>
            <textarea name="desc_ar" placeholder="@lang('dashboard.desc_ar')" class="form-control">{{ old('desc_ar') }}</textarea>
        </div>
        <div class="form-group my-1 col-md-6 col-sm-12">
            <label class="my-1">@lang('dashboard.desc_en')</label>
            <textarea name="desc_en" placeholder="@lang('dashboard.desc_en')" class="form-control">{{ old('desc_en') }}</textarea>
        </div>
        <div class="form-group my-1 col-md-6">
            <label class="my-1">@lang('dashboard.weight')</label>
            <input id="weight" type="number" min="0" step="0.01" name="weight" placeholder="@lang('dashboard.weight')" class="form-control">
        </div>

        <div class="form-group my-1 col-md-6 col-sm-12">
            <label class="my-1">@lang('messages.size') & @lang('dashboard.color')</label>
            <select class="form-control" id="filter" name="filter">
                <option @selected('has_size' == old('filter') )  value="has_size">@lang('dashboard.has_size')</option>
                <option @selected('has_color' == old('filter') )  value="has_color">@lang('dashboard.has_color')</option>
                <option @selected('has_size_color' == old('filter') )  value="has_size_color">@lang('dashboard.has_size_color')</option>
            </select>
        </div>


        <div class="form-group my-1 col-md-6 col-sm-12">
            <label class="my-1">@lang('dashboard.VAT')</label>
            <select class="form-control " required name="VAT">
                <option @selected('exclusive' == old('VAT') )  value="exclusive">@lang('dashboard.exclusive')</option>
                <option @selected('inclusive' == old('VAT') )  value="inclusive">@lang('dashboard.inclusive')</option>
            </select>
        </div>

        <div class="form-group my-1 col-md-6 col-sm-12">
            <label class="my-1">@lang('dashboard.visibility')</label>
            <select class="form-control " required name="status">
                <option  @selected(1 == old('status') ) value="1">@lang('dashboard.visible')</option>
                <option  @selected(0 == old('status') ) value="0">@lang('dashboard.hidden')</option>
            </select>
        </div>


        <div class="form-group my-1 col-md-6 col-sm-12">
            <label class="my-1">@lang('dashboard.isThereDiscount')</label>
            <select id="discountDiscount" name="have_discount"  class="form-control">
                <option @selected(1 == old('have_discount') ) value="1">@lang('dashboard.yes')</option>
                <option @selected(0 == old('have_discount') ) value="0">@lang('dashboard.no')</option>
            </select>
        </div>
        <div class="form-group my-1 col-md-6 discount {{ old('from') ? '' : 'hide' }}">
            <label class="my-1">@lang('dashboard.discount_from')</label>
            <input id="discount_from" type="date" name="from" placeholder="@lang('dashboard.discount_from')" class="form-control">
        </div>
        <div class="form-group my-1 col-md-6 discount {{ old('to') ? '' : 'hide' }}">
            <label class="my-1">@lang('dashboard.discount_to')</label>
            <input id="discount_to" type="date" name="to" placeholder="@lang('dashboard.discount_to')" class="form-control">
        </div>
        <div class="form-group my-1 col-md-6 discount {{ old('discount') ? '' : 'hide' }}">
            <label class="my-1">@lang('dashboard.discount')</label>
            <input id="discount" type="number" step="any" name="discount" placeholder="@lang('dashboard.discount')" class="form-control">
        </div>
        <div class="form-group my-1 col-md-6 col-sm-12">
            <label class="my-1">@lang('dashboard.images')</label>
            <label class="file-input btn btn-block btn-primary btn-file w-100">
                @lang("dashboard.Browse")
                <input accept="image/*" type="file" type="file" name="images[]" multiple>
            </label>
        </div>
        <div class="form-group my-1 col-md-6 col-sm-12">
      
        </div>
        
        
        
            
        <div class="form-group my-1 col-md-12 col-sm-12">
            <div class="row block">
                <div class="my-1 col-md-3 col-sm-12 sizes">
                    <label class="my-1">@lang('dashboard.size')</label>
                    <select name="sizes[]" class="form-control selectpicker  w-100" data-live-search="true">
                        @foreach ($Sizes as $size)
                            <option {{ $loop->first ? 'selected' : '' }} value="{{ $size['id'] }}">{{ $size->title() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="my-1 col-md-3 col-sm-12 colors hide">
                    <label class="my-1">@lang('dashboard.color')</label>
                    <select name="colors[]" class="form-control selectpicker  w-100" data-live-search="true">
                        <option value="">-----</option>
                        @foreach ($Colors as $color)
                            @php
                                list($r, $g, $b) = sscanf($color->hexa, "#%02x%02x%02x");
                            @endphp
                            <option style="background-color: rgba({{ $r }},{{ $g }},{{ $b }},0.6);"  value="{{ $color['id'] }}">{{ $color->title() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="my-1 col-md-3 col-sm-12">
                    <label class="my-1">@lang('dashboard.price')</label>
                    <input type="text" value="0.000"  name="prices[]" placeholder="@lang('dashboard.price')" class="form-control">
                </div>
                <div class="my-1 col-md-2 col-sm-12">
                    <label class="my-1">@lang('dashboard.quantity')</label>
                    <input type="text" value="1" name="quantities[]"  placeholder="@lang('dashboard.quantity')" class="form-control">
                </div>
                <div class="my-1 col-md-1 col-sm-12">
                    <label class="my-1 row">@lang('dashboard.delete')</label>
                    <button class="btn btn-danger remove text-center mx-auto" type="button">-</button>
                </div>
            </div>
            <div class="block text-center col-12 mx-auto" style="padding-top: 15px;">
                <span class="btn btn-primary add-more add_two">+</span>
            </div>
        </div>
    

        <div class="clearfix"></div>
        <div class="col-12 my-4">
            <div class="button-group">
                <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                    {{ __('messages.Submit') }}
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
