@extends('Mix.layouts.app')
@section('pagetitle', __('messages.features'))
@section('content')
<form method="POST" action="{{ route('admin.features.update',$Feature) }}" enctype="multipart/form-data" data-parsley-validate novalidate>
    @csrf
    @method('PUT')
    <div class="row">
        @if ($Feature['image'])
        <div class="col-12">
            <div class="text-center">
                <img src="{{ public_asset($Feature['image']) }}" class="rounded mx-auto text-center" style="border-radius: 50% !important" id="image" width="200px" height="200px">
            </div>
        </div>
        @endif
        <div class="form-group col-md-6">
            <label for="title_ar">@lang('dashboard.title_ar')</label>
            <input type="text" name="title_ar" id="title_ar" class="form-control" value="{{ $Feature['title_ar'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">@lang('dashboard.title_en')</label>
            <input type="text" name="title_en" id="title_en" class="form-control" value="{{ $Feature['title_en'] }}">
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
            <select name="header_id" required class="form-control w-100">
                @foreach($heads as $head)
                    <option {{ $head['id'] == $Feature['header_id'] ? 'selected' : ''  }} value="{{ $head['id'] }}">{{ $head->title() }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>@lang('dashboard.type')</label>
            <select name="type" required class="form-control w-100">
                <option {{ 'icon' == $Feature['type'] ? 'selected' : ''  }}  value="icon">{{ __('messages.icon') }}</option>
                <option {{ 'text' == $Feature['type'] ? 'selected' : ''  }}  value="text">{{ __('messages.text') }}</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>@lang('dashboard.visibility')</label>
            <select class="form-control " required name="status">
                <option {{ 0 == $Feature['status'] ? 'selected' : ''  }} value="0">@lang('dashboard.hidden')</option>
                <option {{ 1 == $Feature['status'] ? 'selected' : ''  }} value="1">@lang('dashboard.visible')</option>
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
