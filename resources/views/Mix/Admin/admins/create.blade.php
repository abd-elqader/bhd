@extends('Mix.layouts.app')
@section('pagetitle',__('messages.admins'))

@section('content')
<form action="{{ route('admin.admins.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('post')

    <div class="text-center">
        <img src="{{ public_asset(setting('logo')) }}" class="rounded mx-auto text-center" style="border-radius: 50% !important" id="image" width="200px" height="200px">
    </div>
    <div class="row">
        <div class="col-md-6 ">
            <label for="name">{{ __('website.name') }}</label>
            <input type="text" name="name" id="name" parsley-trigger="change" required value="" class="form-control">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="email">{{ __('website.email') }}</label>
            <input type="email" name="email" parsley-trigger="change" value="" required class="form-control">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="phone">{{ __('website.phone') }}</label>
            <input class="form-control  @error('country_code') is-invalid error('phone_code') is-invalid @enderror @error('phone') is-invalid @enderror" type="tel" name="phone" id="phone_number" placeholder="{{ __('messages.Phone Number') }}" value="{{ old('phone') }}" required autocomplete="phone">
            <input type="hidden" name="country_code" id="country_code" value="{{ 'BH' }}">
            <input type="hidden" name="phone_code" id="phone_code" value="{{ 973 }}">
        </div>
        <div class="form-group col-md-6">
            <label for="image">@lang('dashboard.image')</label>
            <label class="file-input btn btn-block btn-primary btn-file w-100">
                Browse&hellip;
                <input accept="image/*" type="file" name="image" id="image">
            </label>
        </div>

        <div class="col-md-6 col-sm-12">
            <label for="client_password">{{ __('website.password') }}</label>
            <input required type="password" name="password" parsley-trigger="change" class="form-control" data-parsley-id="10">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="client_password">{{ __('website.confirmPassword') }}</label>
            <input required type="password" name="password_confirmation" parsley-trigger="change" class="form-control" data-parsley-id="10">
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
