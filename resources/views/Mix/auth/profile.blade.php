@extends('Mix.layouts.app')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('messages.My Profile') }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card-styles">
        <div class="card-content">
            <form action="{{ route('admin.profile.update') }}" method="POST" accept-charset="UTF-8" id="signUP">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="input-style-1">
                            <label for="name">{{ __('messages.user_name') }}</label>
                            <input type="text" @error('name') class="form-control is-invalid" @enderror name="name" id="name" placeholder="{{ __('messages.user_name') }}" value="{{ old('name', auth()->user()->name) }}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label for="email">{{ __('messages.Email') }}</label>
                            <input @error('email') class="form-control is-invalid" @enderror type="email" name="email" id="email" placeholder="{{ __('messages.Email') }}" value="{{ old('email', auth()->user()->email) }}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label for="phone">{{ __('messages.Phone') }}</label>
                            <div  class="position-absolute dropdown">
                                <span style="width: 100px;height: 58px;display: -webkit-box;" class="cursor-pointer btn-info dropdown-toggle px-1 py-3 SelectedData"  id="countryDropDown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img style="width: 50px;height: 30px;margin-top: -5px;" class="mx-1 col-6"  src="{{ public_asset($countries->where('phone_code',auth()->user()->phone_code)->first()->image) }}" alt="Submit">
                                    <span class="col-6">{{ auth()->user()->phone_code }}</span>
                                </span>
                                <div class="dropdown-menu" style="width: 100px;" aria-labelledby="countryDropDown">
                                    @foreach ($countries as $country)
                                        <span class="dropdown-item point Country cursor-pointer" style="text-align: left;" data-id="{{ $country->id }}" data-img="{{ public_asset($country->image) }}" data-phone="{{ $country->phone_code }}" data-country="{{ $country->country_code }}">
                                            <img style="width: 40px" class="mr-1"  src="{{ public_asset($country->image) }}" alt="Submit">
                                            <span>{{ $country->phone_code }}</span>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            <input id="phone_number" type="text" style="margin-left: 100px;width: 91%;" name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="form-control @error('phone_code') is-invalid @enderror @error('country_code')is-invalid @enderror @error('phone')is-invalid @enderror"  placeholder="@lang('messages.Phone')">
                            <input class="p-3 m-x2 w-100 border rounded" type="hidden" value="{{ old('country_code') }}" name="country_code" id="country_code" value="{{ auth()->user()->country_code ?? 'BH' }}">
                            <input class="p-3 m-x2 w-100 border rounded" type="hidden" value="{{ old('phone_code') }}" name="phone_code" id="phone_code" value="{{ auth()->user()->phone_code ?? 973 }}">
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
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label for="password">{{ __('website.New') . ' ' . __('messages.password')}}</label>
                            <input type="password" @error('password') class="form-control is-invalid" @enderror name="password" id="password" placeholder="{{ __('website.New') . ' ' . __('messages.password')}}">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label for="password_confirmation">{{ __('website.New') . ' ' . __('website.confirmPassword')}}</label>
                            <input type="password" @error('password') class="form-control is-invalid" @enderror name="password_confirmation" id="password_confirmation" placeholder="{{ __('website.New') . ' ' . __('website.confirmPassword')}}">
                        </div>
                    </div>



                    <div class="col-12">
                        <div class="button-group d-flex justify-content-center flex-wrap">
                            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center" id="submitform">
                                {{ __('messages.Submit') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>


    <div class="modal" id="Verify_phone_number" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="padding-top: 10%;">
            <div class="modal-content w-100">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('messages.Verify_phone_number')</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group mt-4" >
                        <div id="digitsContainer">
                            <form id="codeverifyForm">
                                <div id="inputs" class="ltr">
                                    <input type="text" class="digit" id="verificationCodeDigit1" minlength="1" maxlength="1" required>
                                    <input type="text" class="digit" id="verificationCodeDigit2" minlength="1" maxlength="1" required>
                                    <input type="text" class="digit" id="verificationCodeDigit3" minlength="1" maxlength="1" required>
                                    <input type="text" class="digit" id="verificationCodeDigit4" minlength="1" maxlength="1" required>
                                    <input type="text" class="digit" id="verificationCodeDigit5" minlength="1" maxlength="1" required>
                                    <input type="text" class="digit" id="verificationCodeDigit6" minlength="1" maxlength="1" required>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn px-2 py-1 btn-primary" id="verifPhNum">@lang('website.send')</button>
                    <button type="button" class="btn px-2 py-1 btn-secondary" data-dismiss="modal" id="Close">@lang('website.close')</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <style>
        .dropdown-toggle::after {
            display: none !important;
        }
        @media (max-width: 500px) {
            input#phone_number {
                width: 61% !important;
            }
        }
    </style>
@endsection

@section('js')
    <script>
        var Succecss = false;
        var success_code = "";
        var countrycode = "BH";
        var phonecode = 973;



        $(document).on("click", ".Country", function () {
            $('.SelectedData>img').attr('src',$(this).attr('data-img'));
            $('.SelectedData>span').text($(this).attr('data-phone'));

            countrycode = $(this).attr('data-country');
            $('#country_code').val(countrycode);
            phonecode = $(this).attr('data-phone');
            $('#phone_code').val(phonecode);
        });

        $(document).ready(function () {
            $("#submitform").click(function (e) {
                if (Succecss == false) {
                    e.preventDefault();
                    if($("#phone_number").val().length > 5 ){
                        var phoneNo = "+" + phonecode +$("#phone_number").val();
                        console.log(phoneNo);
                        $.ajax({
                            method: "POST",
                            url: "/sendotp/" + phoneNo,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: (result) => {
                                $("#Verify_phone_number").show();
                                $("#verificationCodeDigit1").focus();
                                success_code = result.code;
                            },
                            error: (error) => {
                                swal({title: 'Invalid Data',icon: "warning",buttons: true,dangerMode: true});
                            },
                        });
                    }else{
                    swal({title: 'Invalid Data',icon: "warning",buttons: true,dangerMode: true});
                    }
                } else {
                    $("#signUP").submit();
                }
            });
            $(document).on("click", "#verifPhNum", function () {
                var code = $("#verificationCodeDigit1").val() + $("#verificationCodeDigit2").val() + $("#verificationCodeDigit3").val()+ $("#verificationCodeDigit4").val() + $("#verificationCodeDigit5").val() + $("#verificationCodeDigit6").val();
                $(this).attr("disabled", "disabled");
                $(this).text("Processing...");
                if (code == success_code) {
                    $("#signUP").submit();
                    swal({title: "😀❤️ Succecss",icon: "success",buttons: true,dangerMode: false});
                    $("#signUP").submit();
                    Succecss = true;
                    $("#Verify_phone_number").hide();
                    $("#phone_number").prop("readonly", true);
                    $("#phone_number").addClass("border border-success");
                } else {
                    $(this).removeAttr("disabled");
                    swal({title: "Invalid Code",icon: "warning",buttons: true,dangerMode: true});
                    setTimeout(() => {
                        $(this).text("Verify Phone No");
                    }, 2000);
                }
            });


            $(".disabled").on("click", function (event) {
                event.preventDefault();
                return false;
            });

            $("#Close").on("click", function (event) {
                $("#Verify_phone_number").hide();
            });

            $(".digit").keyup(function () {
                $(this).next("input").focus();
                var code = $("#verificationCodeDigit1").val() + $("#verificationCodeDigit2").val() + $("#verificationCodeDigit3").val()+ $("#verificationCodeDigit4").val() + $("#verificationCodeDigit5").val() + $("#verificationCodeDigit6").val();
                if($("#verificationCodeDigit1").val() && $("#verificationCodeDigit2").val() && $("#verificationCodeDigit3").val() && $("#verificationCodeDigit4").val() && $("#verificationCodeDigit5").val() && $("#verificationCodeDigit6").val()){
                    if (code == success_code) {
                        $("#signUP").submit();
                    } else {
                        $("#verificationCodeDigit1").val('');
                        $("#verificationCodeDigit2").val('');
                        $("#verificationCodeDigit3").val('');
                        $("#verificationCodeDigit4").val('');
                        $("#verificationCodeDigit5").val('');
                        $("#verificationCodeDigit6").val('');
                        $("#verificationCodeDigit1").focus();
                        swal({title: "Invalid Code",icon: "warning",buttons: true,dangerMode: true});
                    };
                }
            });

        });

    </script>
@endsection
