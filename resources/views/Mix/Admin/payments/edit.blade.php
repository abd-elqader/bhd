@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.paymentMethods'))
@section('content')
    <form method="POST" action="{{ route('admin.payments.update',$PaymentMethod) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col text-center">
                @foreach ($PaymentMethod->Images as $item)
                    <img id="image" width="200px" src="{{ public_asset($item['image']) }}" alt="item" class="changeimage">
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class=" col-md-6">
                <label for="title_ar">@lang('dashboard.title_ar')</label>
                <input id="title_ar" type="text" name="title_ar" required placeholder="@lang('dashboard.title_ar')"
                    class="form-control" value="{{ $PaymentMethod['title_ar'] }}">
            </div>
            <div class=" col-md-6">
                <label for="title_en">@lang('dashboard.title_en')</label>
                <input id="title_en" type="text" name="title_en" required placeholder="@lang('dashboard.title_en')"
                    class="form-control" value="{{ $PaymentMethod['title_en'] }}">
            </div>
            <div class=" col-md-6">
                <label for="visibility">@lang('dashboard.visibility')</label>
                <select class="form-control  select2me" required id="visibility" name="status">
                    <option {{ $PaymentMethod['status'] == 0 ? 'selected' : '' }} value="0">@lang('dashboard.hidden')</option>
                    <option {{ $PaymentMethod['status'] == 1 ? 'selected' : '' }} value="1">@lang('dashboard.visible')</option>
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
            <div class="col-12 my-3">
                <div class="button-group">
                    <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                        {{ __('messages.Submit') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
