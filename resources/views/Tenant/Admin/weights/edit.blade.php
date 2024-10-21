@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.weights'))
@section('content')
<form method="POST" action="{{ route('admin.weights.update',$Weight) }}" enctype="multipart/form-data" data-parsley-validate novalidate>
    @csrf
    @method('PUT')
    <div class="row">
        <div class=" col-md-6">
            <label for="weight">@lang('dashboard.weight')</label>
            <input id="weight" type="number" min="0" step="any" name="weight" required placeholder="@lang('dashboard.weight')" class="form-control" value="{{ $Weight['weight'] }}">
        </div>
        <div class=" col-md-6">
            <label for="price">@lang('dashboard.price')</label>
            <input id="price" type="number" min="0" step="any" name="price" required placeholder="@lang('dashboard.price')" class="form-control" value="{{ $Weight['price'] }}">
        </div>
        <div class=" col-md-6">
            <label for="visibility">@lang('dashboard.visibility')</label>
            <select class="form-control  select2me" required id="visibility" name="status">
                <option {{ $Weight['status'] == 0 ? 'selected' : '' }} value="0">@lang('dashboard.hidden')</option>
                <option {{ $Weight['status'] == 1 ? 'selected' : '' }} value="1">@lang('dashboard.visible')</option>
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
