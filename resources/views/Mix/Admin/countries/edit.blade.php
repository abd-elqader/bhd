@extends('Mix.layouts.app')
@section('pagetitle', __('messages.Countries'))
@section('content')
<form method="POST" action="{{ route('admin.countries.update',$Country) }}" enctype="multipart/form-data" data-parsley-validate novalidate>
    @csrf
    @method('PUT')
    <div class="row">
        <div class="form-group col-md-6">
            <label for="title_ar">@lang('dashboard.title_ar')</label>
            <input type="text" name="title_ar" id="title_ar" class="form-control" required value="{{ $Country['title_ar'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">@lang('dashboard.title_en')</label>
            <input type="text" name="title_en" id="title_en" class="form-control" required value="{{ $Country['title_en'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="country_code">@lang('dashboard.country_code')</label>
            <input type="text" name="country_code" id="country_code" class="form-control" required value="{{ $Country['country_code'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="phone_code">@lang('dashboard.phone_code')</label>
            <input type="text" name="phone_code" id="phone_code" class="form-control" required value="{{ $Country['phone_code'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="currancy_code">@lang('dashboard.currancy_code')</label>
            <input type="text" name="currancy_code" id="currancy_code" class="form-control" required value="{{ $Country['currancy_code'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="currancy_value">@lang('dashboard.currancy_value')</label>
            <input type="text" name="currancy_value" id="currancy_value" class="form-control" required value="{{ $Country['currancy_value'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="phone_length">@lang('dashboard.phone_length')</label>
            <input type="text" name="length" id="phone_length" class="form-control" required value="{{ $Country['length'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="visibility">@lang('dashboard.visibility')</label>
            <select class="form-control  select2me" required id="visibility" name="status">
                <option {{ $Country['status'] == 1 ? 'selected' : '' }} value="1">@lang('dashboard.visible')</option>
                <option {{ $Country['status'] == 0 ? 'selected' : '' }} value="0">@lang('dashboard.hidden')</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="accept_orders">@lang('dashboard.accept_orders')</label>
            <select class="form-control  select2me" required id="accept_orders" name="status">
                <option {{ $Country['accept_orders'] == 1 ? 'selected' : '' }} value="1">@lang('dashboard.yes')</option>
                <option {{ $Country['accept_orders'] == 0 ? 'selected' : '' }} value="0">@lang('dashboard.no')</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="file">@lang("dashboard.image")</label>
            <label for="file" class="file-input btn btn-block btn-primary btn-file w-100">
                Browse&hellip;
                <input accept="image/*" type="file" type="file" name="image" id="file">
            </label>
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
