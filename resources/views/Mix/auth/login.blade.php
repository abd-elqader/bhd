@extends('Mix.layouts.guest')

@section('content')
    <div class="col-lg-6">
        <div class="auth-cover-wrapper bg-primary-100">
            <div class="auth-cover">
                <div class="title text-center">
                    <h1 class="text-primary mb-10">{{__('website.login')}}</h1>
                </div>
                <div class="cover-image">
                    <img src="{{ public_asset('/images/auth/signin-image.svg') }}" alt="">
                </div>
                <div class="shape-image">
                    <img src="{{ public_asset('/images/auth/shape.svg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="signin-wrapper ">
            <div class="form-wrapper">
                <h6 class="mb-15">{{ __('website.loginProfile') }}</h6>
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="email">{{ __('website.email') }}</label>
                                <input @if(tenant() && tenant()->id == 'demo') value="demo@gmail.com" @endif @error('email') class="form-control is-invalid" @enderror type="email" name="email" id="email" placeholder="{{ __('website.email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="password">{{ __('website.password') }}</label>
                                <input @if(tenant() && tenant()->id == 'demo') value="123456" @endif type="password" @error('password') class="form-control is-invalid" @enderror name="password" id="password" placeholder="{{ __('website.password') }}" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if (Route::has('password.request'))
                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                <div class="text-start text-md-end text-lg-start text-xxl-end mb-30">
                                    <a href="{{ route('password.request') }}">{{ __('messages.Forget Password ?') }}</a>
                                </div>
                            </div>
                        @endif
                        @if (!tenant())
                            <div class="col-12">
                                <div class="text-center mb-30">
                                    <a href="{{ route('admin.register') }}">{{ __('website.dontHaveAccount') }}</a>
                                </div>
                            </div>
                        @endif
                        <div class="col-12">
                            <div class="button-group d-flex justify-content-center flex-wrap">
                                <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                    {{ __('website.login') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
