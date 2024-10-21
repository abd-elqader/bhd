@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.components'))
@section('content')
<form method="POST" action="{{ route('admin.components.update',$Component) }}" enctype="multipart/form-data" data-parsley-validate novalidate>
    @csrf
    @method('PUT')
    <div class="row">
        <div class="form-group col-md-12 text-center">
            <img src="{!! public_asset($Component['preview']) !!}" alt="" width="200px">
        </div>
        <div class="form-group col-md-6">
            <label for="title_ar">@lang('dashboard.title_ar')</label>
            <input type="text" name="title_ar" id="title_ar" class="form-control" required value="{{ $Component['title_ar'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">@lang('dashboard.title_en')</label>
            <input type="text" name="title_en" id="title_en" class="form-control" required value="{{ $Component['title_en'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="type">@lang('dashboard.type')</label>
            <input type="text" name="type" id="type" class="form-control" required value="{{ $Component['type'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="path">@lang('dashboard.path')</label>
            <input type="text" name="path" id="path" class="form-control" required value="{{ $Component['path'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="type">@lang('dashboard.type')</label>
            <input type="text" name="type" id="type" class="form-control" required value="{{ $Component['type'] }}">
        </div>


        <div class="form-group col-md-6">
            <label for="image">@lang('dashboard.image')</label>
            <label for="image" class="file-input btn btn-block btn-primary btn-file w-100">
                Browse&hellip;
                <input accept="image/*" type="file" type="file" name="preview" multiple id="image" required>
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
