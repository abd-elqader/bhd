@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.weights'))
@section('content')
    <form method="POST" action="{{ route('admin.weights.store') }}" data-parsley-validate novalidate>
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="weight">@lang('dashboard.weight')</label>
                <input id="weight" type="number" step="any" min="0" name="weight" required placeholder="@lang('dashboard.weight')"
                    class="form-control">
            </div>
            <div class="col-md-6">
                <label for="price">@lang('dashboard.price')</label>
                <input id="price" type="number" step="any" min="0" name="price" required placeholder="@lang('dashboard.price')"
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
