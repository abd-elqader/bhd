@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.offertypes'))
@section('content')
<form method="POST" action="{{ route('admin.offertypes.store') }}" enctype="multipart/form-data" data-parsley-validate novalidate>
    @csrf
    <div class="row">
        <div class="col-md-6">
            <label for="title_ar">@lang('dashboard.title_ar')</label>
            <input type="text" name="title_ar" id="title_ar" class="form-control" required data-buttonname="btn-primary">
        </div>
        <div class="col-md-6">
            <label for="title_en">@lang('dashboard.title_en')</label>
            <input type="text" name="title_en" id="title_en" class="form-control" required data-buttonname="btn-primary">
        </div>

        <div class="col-md-6">
            <label for="visibility">@lang('dashboard.visibility')</label>
            <select class="form-control  select2me" required id="visibility" name="status">
                <option value="1">@lang('dashboard.visible')</option>
                <option value="0">@lang('dashboard.hidden')</option>
            </select>
        </div>

        <div class="clearfix"></div>
        <div class="row mx-auto">
            <div class="col-sm-12 my-4">
                <div class="text-center p-20 ">
                    <button type="submit" class="btn btn-primary">{{ __('messages.add') }}</button>
                    <button type="reset" class="btn btn-secondary">{{ __('website.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
