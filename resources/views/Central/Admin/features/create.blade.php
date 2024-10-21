@extends('Mix.layouts.app')
@section('pagetitle', __('messages.features'))
@section('content')
<form method="POST" action="{{ route('admin.features.store') }}" enctype="multipart/form-data" data-parsley-validate novalidate>
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label for="title_ar">@lang('dashboard.title_ar')</label>
            <input type="text" name="title_ar" id="title_ar" class="form-control" required placeholder="@lang('dashboard.title_ar')">
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">@lang('dashboard.title_en')</label>
            <input type="text" name="title_en" id="title_en" class="form-control" required placeholder="@lang('dashboard.title_en')">
        </div>
        <div class="form-group col-md-6">
            <label for="file">@lang('dashboard.image')</label>
            <label for="file" class="file-input btn btn-block btn-primary btn-file w-100">
                Browse&hellip;
                <input accept="image/*" type="file" type="file" name="image" id="file" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
            </label>
        </div>
        <div class="form-group col-md-6">
            <label>@lang('dashboard.head')</label>
            <select name="header_id" required class="form-control">
                <option selected hidden disabled>{{ __('messages.Select') }}</option>
                @foreach($heads as $head)
                <option value="{{ $head['id'] }}">{{ $head->title() }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>@lang('dashboard.type')</label>
            <select name="type" required class="form-control">
                <option selected hidden disabled>{{ __('messages.Select') }}</option>
                <option value="icon">{{ __('messages.icon') }}</option>
                <option value="text">{{ __('messages.text') }}</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>@lang('dashboard.visibility')</label>
            <select class="form-control " required name="status">
                <option value="0">@lang('dashboard.hidden')</option>
                <option selected value="1">@lang('dashboard.visible')</option>
            </select>
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
