@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.online_stores'))
@section('content')
<form method="POST" action="{{ route('admin.stores.store') }}" enctype="multipart/form-data" data-parsley-validate novalidate>
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label for="title_ar">@lang('dashboard.title_ar')</label>
            <input type="text" name="title_ar" id="title_ar" class="form-control" required>
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">@lang('dashboard.title_en')</label>
            <input type="text" name="title_en" id="title_en" class="form-control" required>
        </div>

        <div class="form-group col-md-6">
            <label for="desc_ar">@lang('dashboard.desc_ar')</label>
            <textarea type="text" name="desc_ar" id="desc_ar" class="form-control" required></textarea>
        </div>
        <div class="form-group col-md-6">
            <label for="desc_en">@lang('dashboard.desc_en')</label>
            <textarea type="text" name="desc_en" id="desc_en" class="form-control" required></textarea>
        </div>

        <div class="form-group col-md-6">
            <label for="visibility">@lang('dashboard.visibility')</label>
            <select class="form-control  select2me" required id="visibility" name="status">
                <option disabled hidden selected>@lang('messages.Select')</option>
                <option value="1">@lang('dashboard.visible')</option>
                <option value="0">@lang('dashboard.hidden')</option>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="link">@lang('dashboard.link')</label>
            <input type="text" name="link" id="link" class="form-control" required>
        </div>

        <div class="form-group col-md-6">
            <label for="image">@lang('dashboard.image')</label>
            <label for="image" class="file-input btn btn-block btn-primary btn-file w-100">
                Browse&hellip;
                <input accept="image/*" type="file" name="image" id="image">
            </label>
        </div>
        <div class="form-group col-md-6">
            <label for="website">@lang('dashboard.website_image')</label>
            <label for="website" class="file-input btn btn-block btn-primary btn-file w-100">
                Browse&hellip;
                <input accept="image/*" type="file"  name="website" id="website">
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
