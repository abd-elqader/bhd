@extends('Mix.layouts.app')
@section('pagetitle', __('messages.deliveries'))
@section('content')
<form method="POST" action="{{ route('admin.deliveries.update',$Delivry) }}" enctype="multipart/form-data" data-parsley-validate novalidate>
    @csrf
    @method('PUT')
    <div class="row">
        <div class=" col-md-6">
            <label for="title_ar">@lang('dashboard.title_ar')</label>
            <input id="title_ar" type="text" name="title_ar" required placeholder="@lang('dashboard.title_ar')" class="form-control" value="{{ $Delivry['title_ar'] }}">
        </div>
        <div class=" col-md-6">
            <label for="title_en">@lang('dashboard.title_en')</label>
            <input id="title_en" type="text" name="title_en" required placeholder="@lang('dashboard.title_en')" class="form-control" value="{{ $Delivry['title_en'] }}">
        </div>
        <div class=" col-md-6">
            <label for="visibility">@lang('dashboard.visibility')</label>
            <select class="form-control  select2me" required id="visibility" name="status">
                <option {{ $Delivry['status'] == 0 ? 'selected' : '' }} value="0">@lang('dashboard.hidden')</option>
                <option {{ $Delivry['status'] == 1 ? 'selected' : '' }} value="1">@lang('dashboard.visible')</option>
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
