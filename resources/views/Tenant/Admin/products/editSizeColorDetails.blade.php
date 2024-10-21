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
                            <li class="active mx-2">@lang('messages.size'): {{ $product->SizeColor->first()->Size->title() }}</li>
                        </ol>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.updateSizeColorDetails', [$product->id,$product->SizeColor->first()->size_id]) }}" enctype="multipart/form-data" data-parsley-validate novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        @if ($product->SizeColor->whereNotNULL('color_id')->count())
                        <div class="col-lg-12 mb-5">
                            <div class="card-box">

                                <hr class="h2" style="height:1px;border:none;color:#333;background-color:#333;">
                                @foreach ($product->SizeColor as $item)
                                <div class="row" style="margin-top: 20px;">
                                    @if ($item->Size)
                                    <div class="col-md-6 col-sm-12">
                                        <p for="color_id_{{ $item->color_id }}">@lang('dashboard.color')</p>
                                        <input class="form-check mx-1" style="float: {{ lang('en') ? 'left' : 'right' }}" {{ $item->status ? 'checked' : '' }} type="checkbox" name="colors[]" id="color_id_{{ $item->color_id }}" value="{{ $item->color_id }}">
                                        <label for="color_id_{{ $item->color_id }}">
                                            <a href="{{ route('admin.editColorImageDetails',[$product->id,$item->color_id]) }}">
                                                {{ $item->Color->title() }}
                                            </a>
                                        </label>
                                    </div>
                                    @endif
                                    <div class="col-md-6 col-sm-12">
                                        <p for="size_id_{{ $item->size_id }}">@lang('dashboard.quantity')</p>
                                        <input class="form-control" type="number" min="0" step="1" name="quantity[]" id="quantity_{{ $item->size_id }}" value="{{ $item->quantity }}">
                                    </div>
                                </div>
                                <hr class="h2" style="height:1px;border:none;color:#333;background-color:#333;">
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <div class="col-md-6 col-sm-12">
                            <p>
                                @lang('dashboard.price')
                            </p>
                            <input type="number" min="0" step="any" name="price" value="{{ $product->SizeColor->first()->price }}" placeholder="@lang('dashboard.price')" class="form-control">
                        </div>

                        @if($product->SizeColor->whereNotNULL('color_id')->count() == 0)
                            <div class="col-md-6 col-sm-12">
                                <p for="size_id_{{ $product->SizeColor->first()->size_id }}">@lang('dashboard.quantity')</p>
                                <input class="form-control" type="number" min="0" step="1" name="size_quantity" id="quantity_{{ $product->SizeColor->first()->size_id }}" value="{{ $product->SizeColor->first()->quantity }}">
                            </div>
                        @endif
                    </div>

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
