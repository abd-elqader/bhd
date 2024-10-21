@extends('Mix.layouts.app')
@section('pagetitle', __('messages.admins'))

@section('content')

<form action="{{ route('admin.admins.update',$Admin) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="text-center">
        <img src="{{ public_asset(setting('logo')) }}" class="rounded mx-auto text-center" style="border-radius: 50% !important" id="image" width="200px" height="200px">
    </div>
    <div class="row">
        <div class="col-12"></div>
        <div class="col-md-6 ">
            <label for="name">{{ __('website.name') }}</label>
            <input value="{{ $Admin->name }}" type="text" name="name" id="name" parsley-trigger="change" required value="" class="form-control">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="email">{{ __('website.email') }}</label>
            <input value="{{ $Admin->email }}" type="email" name="email" parsley-trigger="change" value="" required class="form-control">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="phone">{{ __('website.phone') }}</label>
            <input  class="form-control @error('phone_code') is-invalid @enderror @error('country_code')is-invalid @enderror @error('phone')is-invalid @enderror" type="phone" name="phone" id="phone_number" placeholder="{{ __('messages.Phone') }}" value="{{ old('phone',$Admin->phone) }}" required>
            <input type="hidden" name="country_code" id="country_code" value="{{$Admin->country_code ?? 'BH' }}">
            <input type="hidden" name="phone_code" id="phone_code" value="{{$Admin->phone_code ?? 973 }}">
        </div>
        <div class="form-group col-md-6">
            <label for="file">@lang('dashboard.image')</label>
            <label for="file" class="file-input btn btn-block btn-primary btn-file w-100">
                Browse&hellip;
                <input accept="image/*" type="file" type="file" name="image" id="file" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
            </label>
        </div>

        <div class="col-md-6 col-sm-12">
            <label for="password">{{ __('website.password') }}</label>
            <input required type="password" name="password" id="password" parsley-trigger="change" class="form-control" data-parsley-id="10">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="password_confirmation">{{ __('website.confirmPassword') }}</label>
            <input required type="password" name="password_confirmation" id="password_confirmation" parsley-trigger="change" class="form-control" data-parsley-id="10">
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
