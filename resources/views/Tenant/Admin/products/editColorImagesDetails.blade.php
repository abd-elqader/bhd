@extends('Mix.layouts.app')

@section('pagetitle', __('messages.Products'))

@section('content')

<div class="wrapper">
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">@lang('dashboard.products')</h4>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('admin.products.edit',$product->id) }}">{{ $product->title() }}</a></li>
                            <li class="active mx-2">@lang('dashboard.color'): {{ $Color->title() }}</li>
                        </ol>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.updateColorImageDetails', [$product->id,$Color->id]) }}" enctype="multipart/form-data" data-parsley-validate novalidate>
                    @csrf
                    @method('PUT')
                    

                    @foreach ($product->SizeColor->where('color_id',$Color->id) as $item)
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-6 col-sm-12">
                            <p>@lang('dashboard.price')</p>
                            <input class="form-control" type="number" min="0" step="0.01" name="price"  value="{{ $item->price }}">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <p>@lang('dashboard.quantity')</p>
                            <input class="form-control" type="number" min="0" step="1" name="quantity" value="{{ $item->quantity }}">
                        </div>
                    </div>
                    @endforeach

                    
                    @if (count($product->images) > 0)
                    <div class="table-responsive my-5">
                        <table class="table table-striped" id="custom_tbl_dt">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">@lang('dashboard.image')</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->images as $key => $image)
                                <tr>
                                    <td class="text-center">
                                        <input class="form-check m-auto" {{ $image->status ? 'checked' : '' }} type="checkbox" name="images[]" id="image_id_{{ $image->id }}" value="{{ $image->id }}">
                                    </td>
                                    <td class="text-center">
                                        <img src="{{ $image['image'] }}" alt="{{ $product['title_en'] }}" width="150">
                                    </td>
                                    <td class="text-center">
                                        <a onclick="DeleteSelected('product_images',{{ $image['id'] }})">
                                            <i class="fa-solid fa-trash-can cursor-pointer"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                    <div class="clearfix"></div>
                    <div class="form-group text-center m-4">
                        <button class="btn btn-primary waves-effect waves-light" type="submit" name="submit">@lang('dashboard.edit')</button>
                        <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">@lang('dashboard.cancel')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection