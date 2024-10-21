@extends('Mix.layouts.app')
@section('pagetitle', __('messages.categories'))

@section('content')
<form method="POST" action="{{ route('admin.categories.update',$Category) }}" enctype="multipart/form-data" data-parsley-validate novalidate>
    @csrf
    @method('PUT')
    <div class="row">

        <div class="form-group col-md-12">
            <div class="text-center">
                @if (!blank($Category['image']))
                <img id="image" width="200px" src="{{ public_asset($Category['image']) }}" alt="item" class="changeimage">
                @endif
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="title_ar">@lang('dashboard.title_ar')</label>
            <input type="text" name="title_ar" id="title_ar" class="form-control" required value="{{ $Category['title_ar'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">@lang('dashboard.title_en')</label>
            <input type="text" name="title_en" id="title_en" class="form-control" required value="{{ $Category['title_en'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="visibility">@lang('dashboard.visibility')</label>
            <select class="form-control  select2me" required id="visibility" name="status">
                <option {{ $Category['status'] == 1 ? 'selected' : '' }} value="1">@lang('dashboard.visible')</option>
                <option {{ $Category['status'] == 0 ? 'selected' : '' }} value="0">@lang('dashboard.hidden')</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="image">@lang('dashboard.image')</label>
            <label class="file-input btn btn-block btn-primary btn-file w-100">
                Browse&hellip;
                <input accept="image/*" type="file" name="image" id="image" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
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
