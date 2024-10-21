@extends('Mix.layouts.app')

@section('pagetitle',__('messages.Edit Product'))

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
        $(document).on('change', '#discountDiscount', function() {
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
                   '<div class="my-1 col-md-3 col-sm-12 sizes  {{ $Product->has_size ? '' : "hide" }}"><label class="my-1">@lang("dashboard.size")</label>' +
                    '<select name="sizes[]" class="form-control selectpicker  w-100" data-live-search="true">' +
                        '<option value="">-----</option>'+
                            @foreach ($Sizes as $size) '<option value="{{ $size->id }}">{{ $size->title() }}</option>' + @endforeach
                       '</select>' +
                   '</div>' +
                   '<div class="my-1 col-md-3 col-sm-12 colors {{ $Product->has_color ? '' : "hide" }}"><label class="my-1">@lang("dashboard.color")</label>' +
                    '<select name="colors[]" class="form-control selectpicker  w-100" data-live-search="true">' +
                        '<option value="">-----</option>'+
                            @foreach ($Colors as $color) '<option value="{{ $color->id }}">{{ $color->title() }}</option>' + @endforeach
                       '</select>' +
                   '</div>' +
                   '<div class="my-1 col-md-3 col-sm-12"><label class="my-1">@lang("dashboard.price")</label><input type="text" name="prices[]" placeholder="@lang("dashboard.price")" class="form-control"></div>' +
                   '<div class="my-1 col-md-2 col-sm-12"><label class="my-1">@lang("dashboard.quantity")</label><input type="text" name="quantities[]" placeholder="@lang("dashboard.quantity")" class="form-control"></div>' +
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
    <form method="POST" action="{{ route('admin.products.update',$Product) }}" enctype="multipart/form-data" data-parsley-validate>
        @csrf
        @method('PUT')
        <div class="row">
            <div class="form-group my-1 col-md-6 col-sm-12">
                <label class="my-1">@lang('dashboard.category')</label>
                <select name="categories[]" required class="form-control selectpicker w-100" data-live-search="true">
                    @foreach($Categories as $category)
                    <option {{ in_array($category->id, $Product->Categories->pluck('id')->toarray()) ? 'selected' : '' }} value="{{ $category['id'] }}">{{ $category->title() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group my-1 col-md-6 col-sm-12">
                <label class="my-1">@lang('dashboard.code')</label>
                <input type="text" name="code" value="{{ $Product->code }}" placeholder="@lang('dashboard.code')" class="form-control">
            </div>
    
            <div class="form-group my-1 col-md-6 col-sm-12">
                <label class="my-1">@lang('dashboard.title_ar')</label>
                <input type="text" name="title_ar" value="{{ $Product->title_ar }}" required placeholder="@lang('dashboard.title_ar')" class="form-control">
            </div>
            <div class="form-group my-1 col-md-6 col-sm-12">
                <label class="my-1">@lang('dashboard.title_en')</label>
                <input type="text" name="title_en" required value="{{ $Product->title_en }}" placeholder="@lang('dashboard.title_en')" class="form-control">
            </div>
            <div class="form-group my-1 col-md-6 col-sm-12">
                <label class="my-1">@lang('dashboard.desc_ar')</label>
                <textarea name="desc_ar" placeholder="@lang('dashboard.desc_ar')" class="form-control">{{ $Product->desc_ar }}</textarea>
            </div>
            <div class="form-group my-1 col-md-6 col-sm-12">
                <label class="my-1">@lang('dashboard.desc_en')</label>
                <textarea name="desc_en" placeholder="@lang('dashboard.desc_en')" class="form-control">{{ $Product->desc_en }}</textarea>
            </div>
            
            <div class="form-group my-1 col-md-6">
                <label class="my-1">@lang('dashboard.weight')</label>
                <input id="weight" type="number" min="0" value="{{ $Product->weight ?? 0 }}"  step="0.01" name="weight" placeholder="@lang('dashboard.weight')" class="form-control">
            </div>
        
        
            <div class="form-group my-1 col-md-6 col-sm-12">
                <label class="my-1">@lang('messages.size') & @lang('dashboard.color')</label>
                <select class="form-control" id="filter" name="filter">
                    <option hidden selected disabled>@lang('messages.Select')</option>
                    <option {{ !$Product->has_color && $Product->has_size ? 'selected' : '' }} value="has_size">@lang('dashboard.has_size')</option>
                    <option {{ $Product->has_color && $Product->has_size ? 'selected' : '' }} value="has_size_color">@lang('dashboard.has_size_color')</option>
                </select>
            </div>
    
                        
            <div class="col-12 col-md-6">
                <label class="my-1">
                    <span>@lang('dashboard.isThereDiscount')</span>
                </label>
                <select id="discountDiscount" name="have_discount" required class="form-control">
                    <option {{  $Product->SizeColor->first()?->discount > 0 ? 'selected' : '' }} value="1">@lang('dashboard.yes')</option>
                    <option {{  $Product->SizeColor->first()?->discount > 0 ? '' : 'selected' }} value="0">@lang('dashboard.no')</option>
                </select>
            </div>
            <div class="col-12 col-md-6 discount {{  $Product->SizeColor->first()?->discount <= 0 ? 'hide' : '' }}">
                <label class="my-1">@lang('dashboard.discount_from')</label>
                <input value="{{ $Product->SizeColor->first()?->from }}" id="discount_from" type="date" name="from" placeholder="@lang('dashboard.discount_from')" class="form-control">
            </div>
            <div class="col-12 col-md-6 discount {{  $Product->SizeColor->first()?->discount <= 0 ? 'hide' : '' }}">
                <label class="my-1">@lang('dashboard.discount_to')</label>
                <input value="{{ $Product->SizeColor->first()?->to }}" id="discount_to" type="date" name="to" placeholder="@lang('dashboard.discount_to')" class="form-control">
            </div>
            <div class="col-12 col-md-6 discount {{  $Product->SizeColor->first()?->discount <= 0 ? 'hide' : '' }}">
                <label class="my-1">@lang('dashboard.discount') <span class="h4">%</span></label>
                <input value="{{ $Product->SizeColor->first()?->discount }}" id="discount" type="number" step="any" name="discount" placeholder="@lang('dashboard.discount')" class="form-control">
            </div>
            <div class="form-group my-1 col-md-6 col-sm-12">
                <label class="my-1">@lang('dashboard.VAT')</label>
                <select class="form-control " required name="VAT">
                    <option hidden selected disabled>@lang('messages.Select')</option>
                    <option {{ $Product->VAT ==  'exclusive' ? 'selected' : '' }} value="exclusive">@lang('dashboard.exclusive')</option>
                    <option {{ $Product->VAT ==  'inclusive' ? 'selected' : '' }} value="inclusive">@lang('dashboard.inclusive')</option>
                </select>
            </div>
    
            <div class="form-group my-1 col-md-6 col-sm-12">
                <label class="my-1">@lang('dashboard.visibility')</label>
                <select class="form-control " required name="status">
                    <option {{ $Product->status ==  '0' ? 'selected' : '' }} value="0">@lang('dashboard.hidden')</option>
                    <option {{ $Product->status ==  '1' ? 'selected' : '' }} value="1">@lang('dashboard.visible')</option>
                </select>
            </div>

            <div class="form-group my-1 col-md-6 col-sm-12">
                <label class="my-1">@lang('dashboard.images')</label>
                <label class="file-input btn btn-block btn-primary btn-file w-100">
                    <input accept="image/*" type="file" type="file" name="images[]" multiple>
                    @lang("dashboard.Browse")
                </label>
            </div>
            <div class="form-group my-1 col-md-6 col-sm-12">
          
            </div>
    
    
                
            <div class="form-group my-1 col-md-12 col-sm-12">
                @foreach ($Product->SizeColor as $item)
                    <div class="row block">
                        <div class="my-1 col-md-3 col-sm-12 sizes {{ $Product->has_size ? '' : 'hide' }}">
                            <label class="my-1">@lang('dashboard.size')</label>
                            <select name="sizes[]" class="form-control selectpicker  w-100" data-live-search="true">
                                <option value="">-----</option>
                                @foreach ($Sizes as $size)
                                    <option @selected($item->size_id == $size['id']) value="{{ $size['id'] }}">{{ $size->title() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="my-1 col-md-3 col-sm-12 colors {{ $Product->has_color ? '' : 'hide' }}">
                            <label class="my-1">@lang('dashboard.color')</label>
                            <select name="colors[]" class="form-control selectpicker  w-100" data-live-search="true">
                                <option value="">-----</option>
                                @foreach ($Colors as $color)
                                    @php
                                        list($r, $g, $b) = sscanf($color->hexa, "#%02x%02x%02x");
                                    @endphp
                                    <option style="background-color: rgba({{ $r }},{{ $g }},{{ $b }},0.6);" @selected($item->color_id == $color['id']) value="{{ $color['id'] }}">{{ $color->title() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="my-1 col-md-3 col-sm-12">
                            <label class="my-1">@lang('dashboard.price')</label>
                            <input type="text" name="prices[]" value="{{ $item->price }}" placeholder="@lang('dashboard.price')" class="form-control">
                        </div>
                        <div class="my-1 col-md-2 col-sm-12">
                            <label class="my-1">@lang('dashboard.quantity')</label>
                            <input type="text" name="quantities[]" value="{{ $item->quantity }}" placeholder="@lang('dashboard.quantity')" class="form-control">
                        </div>
                        <div class="my-1 col-md-1 col-sm-12">
                            <label class="my-1 row">@lang('dashboard.delete')</label>
                            <button class="btn btn-danger remove text-center mx-auto" type="button">-</button>
                        </div>
                    </div>
                @endforeach
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



    @if (count($Product->images) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="text-align:center;">@lang('dashboard.images')</th>
                    @if($Product->images->whereNotNull('color_id')->count())
                        <th style="text-align:center;">@lang('dashboard.color')</th>
                    @endif
                    <th></th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($Product->images as $key => $image)
                        <tr class="gradeX {{ $image['id'] }}">
                            <td style="text-align:center;">{{ $key + 1 }}</td>
                            @if($Product->images->whereNotNull('color_id')->count())
                                <td style="text-align:center;">
                                    {{ $image->color?->title() }}
                                </td>
                            @endif
                            <td style="text-align:center;">
                                <label><img src="{{ $image['image'] }}" alt="{{ $Product['title_en'] }}" width="150"></label>
                            </td>
                            <td class="actions">
                                <a onclick="DeleteSelected('product_images',{{ $image['id'] }})">
                                    <i class="fa-solid fa-trash-can cursor-pointer"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    @endif

@endsection
