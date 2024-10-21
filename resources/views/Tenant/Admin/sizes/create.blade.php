@extends('Mix.layouts.app')
@section('pagetitle', __('messages.size'))
@section('content')
    <form method="POST" action="{{ route('admin.sizes.store') }}" data-parsley-validate novalidate>
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="title_ar">@lang('dashboard.title_ar')</label>
                <input id="title_ar" type="text" name="title_ar" required placeholder="@lang('dashboard.title_ar')"
                    class="form-control">
            </div>
            <div class="col-md-6">
                <label for="title_en">@lang('dashboard.title_en')</label>
                <input id="title_en" type="text" name="title_en" required placeholder="@lang('dashboard.title_en')"
                    class="form-control">
            </div>
            <div class="col-md-6">
                <label for="visibility">@lang('dashboard.visibility')</label>
                <select class="form-control  select2me" required id="visibility" name="status">
                    <option value="0">@lang('dashboard.hidden')</option>
                    <option value="1">@lang('dashboard.visible')</option>
                </select>
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-12 m-b-0 text-center mx-auto mt-2">
                <button class="btn btn-primary waves-effect waves-light" type="submit">@lang('dashboard.add')</button>
                <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">@lang('dashboard.cancel')</button>
            </div>
        </div>
    </form>
@endsection
