@extends('Mix.layouts.guest')

@section('content')
    <div class="col-lg-6">
        <div class="auth-cover-wrapper bg-primary-100">
            <div class="auth-cover">
                <div class="title text-center">
                    <h1 class="text-primary mb-10">{{ __('Register') }}</h1>
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
                <h6 class="mb-15">{{ __('Register') }}</h6>
                <form action="{{ route('admin.register') }}" method="POST" disabled>
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="name">{{ __('messages.Name') }}</label>
                                <input type="text" @error('name') class="form-control is-invalid" @enderror name="name" id="name" placeholder="{{ __('messages.Name') }}" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="email">{{ __('messages.E-mail') }}</label>
                                <input @error('email') class="form-control is-invalid" @enderror type="email" name="email" id="email" placeholder="{{ __('messages.E-mail') }}" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="phone">{{ __('messages.Phone Number') }}</label>
                                <input @error('country_code') class="form-control is-invalid" error('phone_code') class="form-control is-invalid" @enderror @error('phone') class="form-control is-invalid" @enderror type="tel" name="phone" id="phone_number" placeholder="{{ __('messages.Phone Number') }}" value="{{ old('phone') }}" required autocomplete="phone">
                                <div id="recaptcha-container"></div>
                                <div id="getcode" class="btn btn-dark btn-sm position-absolute" style="right: 0px;margin-top: -50px;">{{ __('messages.Getcode') }}</div>
                                <input type="hidden" name="country_code" id="country_code" value="{{ old('country_code') }}">
                                <input type="hidden" name="phone_code" id="phone_code" value="{{ old('phone_code') }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @error('country_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                               @error('phone_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div class="form-group mt-4 d-none" id="Verify_phone_number">
                                    <input type="text" name="" id="codeToVerify" name="getcode" class="form-control" placeholder="{{ __('messages.code') }}">
                                    <div class="btn btn-dark btn-sm btn-block position-absolute" style="right: 0px;margin-top: -50px;" id="verifPhNum">{{ __('messages.Verify_phone_number') }}</div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="domain_name">{{ __('messages.domain_name') }}</label>
                                <input type="text" @error('domain_name') class="form-control is-invalid" @enderror name="domain_name" id="domain_name" placeholder="{{ __('messages.domain_name') }}" value="{{ old('domain_name') }}" required autocomplete="domain_name" autofocus>
                                @error('domain_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="password">{{ __('messages.Password') }}</label>
                                <input type="password" @error('password') class="form-control is-invalid" @enderror name="password" value="{{ old('password') }}" id="password" placeholder="{{ __('messages.password') }}" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="password_confirmation">{{ __('website.confirmPassword') }}</label>
                                <input type="password" @error('password') class="form-control is-invalid" @enderror name="password_confirmation" value="{{ old('password_confirmation') }}" id="password_confirmation" placeholder="{{ __('website.confirmPassword') }}" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="text-center mb-30">
                                <a href="{{ route('admin.login') }}">{{ __('website.haveAccount') }}</a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="button-group d-flex justify-content-center flex-wrap">
                                <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        var Succecss = false;
        var success_code = "";
        var full_number = '';
        var PhoneCode = '+973';
        var CountryCode = 'BH';

        $(document).ready(function() {
            $("form").submit(function(e) {
                if (Succecss == false) {
                    e.preventDefault();
                    swal({
                        title: "Verify Phone No"
                        , icon: "warning"
                        , buttons: true
                        , dangerMode: true
                    , });
                } else {
                    $("form").submit();
                }
            });

            $("#verifPhNum").on("click", function() {
                var code = $("#codeToVerify").val();
                $(this).attr("disabled", "disabled");
                $(this).text("Processing...");
                if (code == success_code) {
                    swal({
                        title: "😀❤️ Succecss"
                        , icon: "success"
                        , buttons: true
                        , dangerMode: false
                    , });
                    Succecss = true;
                    $("#Verify_phone_number").addClass("d-none");
                    $("#getcode").addClass("d-none");
                    $("#phone_number").prop("readonly", true);
                    $("#phone_number").addClass("border border-success");
                    $(".iti").addClass("disabled");
                } else {
                    $(this).removeAttr("disabled");
                    swal({
                        title: "Invalid Code"
                        , icon: "warning"
                        , buttons: true
                        , dangerMode: true
                    , });
                    setTimeout(() => {
                        $(this).text("Verify Phone No");
                    }, 2000);
                }
            });

            $("#getcode").on("click", function() {
                var phoneNo = "+" + PhoneCode + $("#phone_number").val();
                $.ajax({
                    method: "POST"
                    , url: "/sendotp/" + phoneNo
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , success: (result) => {
                        $("#Verify_phone_number").removeClass("d-none");
                        success_code = result.code;
                    }
                    , error: (error) => {
                        swal({
                            title: error.message
                            , icon: "warning"
                            , buttons: true
                            , dangerMode: true
                        , });
                    }
                , });
            });

            $(".disabled").on("click", function(event) {
                event.preventDefault();
                return false;
            });
        });

    </script>
@endpush
