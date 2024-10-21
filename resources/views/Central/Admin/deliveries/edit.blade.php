@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.deliveries'))
@section('content')
<form method="POST" action="{{ route('admin.deliveries.update',$Delivery->id) }}" enctype="multipart/form-data" data-parsley-validate novalidate>
    @csrf
    @method('PUT')
    <div class="row">
        <div class="form-group col-md-6">
            <label for="title">@lang('dashboard.title')</label>
            <input type="text" name="title" id="title" class="form-control" required value="{{ $Delivery['title'] }}">
        </div>
       <div class="form-group col-md-6">
            <label for="same_day_price">@lang('dashboard.same_day_price')</label>
            <input type="number" step="0.001" name="same_day_price" id="same_day_price" class="form-control" required value="{{ $Delivery['same_day_price'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="next_day_price">@lang('dashboard.next_day_price')</label>
            <input type="number" step="0.001" name="next_day_price" id="next_day_price" class="form-control" required value="{{ $Delivery['next_day_price'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="visibility">@lang('dashboard.visibility')</label>
            <select class="form-control  select2me" required id="visibility" name="status">
                <option {{ $Delivery['status'] == 1 ? 'selected' : '' }} value="1">@lang('dashboard.visible')</option>
                <option {{ $Delivery['status'] == 0 ? 'selected' : '' }} value="0">@lang('dashboard.hidden')</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="image">@lang('dashboard.image')</label>
            <label for="image" class="file-input btn btn-block btn-primary btn-file w-100">
                Browse&hellip;
                <input accept="image/*" type="file" name="image" id="image">
            </label>
        </div>
        <div class="form-group col-md-6">
            <label for="desc_ar">@lang('dashboard.desc_ar')</label>
            <textarea type="text" name="desc_ar" id="desc_ar" class="form-control" required>{{ $Delivery['desc_ar'] }}</textarea>
        </div>
        
        <div class="form-group col-md-6">
            <label for="desc_en">@lang('dashboard.desc_en')</label>
            <textarea type="text" name="desc_en" id="desc_en" class="form-control" required>{{ $Delivery['desc_en'] }}</textarea>
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
