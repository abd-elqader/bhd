<style>
    .border_left {
        border-left: 5px solid rgba(000, 000, 000, 0.2);
    }

    .my_bt{
        border: 2px solid var(--main--color);
        color: var(--main--color);
        background-color: transparent;
    }
    .my_bt:hover{
        border: 2px solid var(--main--color);
        color: var(--second--color);
        background-color: var(--main--color);
    }

    body{
        background: url('{{ public_asset("Central/img/bg.jpg") }}');
        padding: 40px 0px 0px 0px;
    }
    @media (max-width: 992px){
        .main_head{
            text-align: center;
        }
    }
    .dropdown-menu{
        min-width: 0rem;
    }
    .dropdown-toggle::after{
        display: none;
    }
</style>
<div class="sign_login p-5" style="direction: ltr;">
    <div class="container {{ old('type') && old('type') == 'login' ? 'right-panel-active' : '' }}">
        <!-- Sign in -->
        <div class="container__form container--signup {{ lang('ar') ? 'rtl' : 'ltr' }}">
            <form action="{{route('client.login')}}" method="POST" class="form" id="form1">
                @csrf
                <input type="hidden" value="login" name="type">
                <h2 class="form__title">@lang('website.login')</h2>
                <div  class="position-absolute dropdown" style="left: 50px;top: 171px;">
                    <span style="width: 100px;height: 58px;display: -webkit-box;" class="dropdown-toggle px-1 py-3 SelectedData"  id="countryDropDown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img style="width: 50px;height: 30px;margin-top: -5px;" class="mx-1 col-6"  src="{{ public_asset(DefaultCurrancy()->image) }}" alt="Submit">
                        <span class="col-6">{{ DefaultCurrancy()->phone_code }}</span>
                    </span>
                    <div class="dropdown-menu" style="width: 100px;" aria-labelledby="countryDropDown">
                        @foreach (Countries() as $country)
                            <span class="dropdown-item point" style="text-align: left;" onclick="changePhoneCode({{ $country->id }},'{{ $country->phone_code }}','{{ $country->country_code }}',{{ $country->length }},'{{ public_asset( $country->image ) }}')">
                                <img style="width: 40px" class="mr-1"  src="{{ public_asset($country->image) }}" alt="Submit">
                                <span>{{ $country->phone_code }}</span>
                            </span>
                        @endforeach
                    </div>
                </div>
                <input  required minlength="{{ DefaultCurrancy()->length }}" maxlength="{{ DefaultCurrancy()->length }}" size="{{ DefaultCurrancy()->length }}" type="text" style="padding-left: 110px !important;" name="phone" data- class="p-3 m-x2 w-100 border rounded" placeholder="@lang('messages.Phone')">

                <input type="password" placeholder="@lang('website.password')" required name="password" class="input">
                <button type="submit" class="btn">@lang('website.login')</button>
                <p>@lang('website.dontHaveAccount') <a class="signIn text-decoration-none main_link transition_me mx-2 ShowSignUp point">@lang('messages.Sign Up')</a></p>
            </form>
        </div>

        <!-- Sign up -->
        <div class="container__form container--signin {{ lang('ar') ? 'rtl' : 'ltr' }}">
            <form action="{{ route('client.register') }}" method="POST" class="form" id="form2" style="    position: relative;">
                @csrf
                <input type="hidden" value="register" name="type">
                <h2 class="form__title">@lang('website.signUp')</h2>
                <input type="text" placeholder="@lang('website.name')" name="name" class="input">
                <div  class="position-absolute dropdown" style="left: 50px;top: 171px;">
                    <span style="width: 100px;height: 58px;display: -webkit-box;" class="dropdown-toggle px-1 py-3 SelectedData"  id="countryDropDown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img style="width: 50px;height: 30px;margin-top: -5px;" class="mx-1 col-6"  src="{{ public_asset(DefaultCurrancy()->image) }}" alt="Submit">
                        <span class="col-6">{{ DefaultCurrancy()->phone_code }}</span>
                    </span>
                    <div class="dropdown-menu" style="width: 100px;" aria-labelledby="countryDropDown">
                        @foreach (Countries() as $country)
                            <span class="dropdown-item point" style="text-align: left;" onclick="changePhoneCode({{ $country->id }},'{{ $country->phone_code }}','{{ $country->country_code }}',{{ $country->length }},'{{ public_asset( $country->image ) }}')">
                                <img style="width: 40px" class="mr-1"  src="{{ public_asset($country->image) }}" alt="Submit">
                                <span>{{ $country->phone_code }}</span>
                            </span>
                        @endforeach
                    </div>
                </div>
                <input id="phone_number" minlength="{{ DefaultCurrancy()->length }}" maxlength="{{ DefaultCurrancy()->length }}" size="{{ DefaultCurrancy()->length }}" type="text" style="padding-left: 110px !important;" name="phone" data- class="p-3 m-x2 w-100 border rounded" placeholder="@lang('messages.Phone')">
                <input class="p-3 m-x2 w-100 border rounded" type="hidden" value="{{ old('country_code') }}" name="country_code" id="country_code">
                <input class="p-3 m-x2 w-100 border rounded" type="hidden" value="{{ old('phone_code') }}" name="phone_code" id="phone_code">
                <input type="email" placeholder="@lang('website.email')" name="email" class="input">
                <input type="password" placeholder="@lang('website.password')" name="password" class="input">
                {{-- <a href="{{ route('password.request') }}" class="link">@lang('website.forgetPassword')</a> --}}
                <button class="btn" id="submitform">@lang('website.signUp')</button>
                <p>@lang('website.haveAccount') <a class="signUp text-decoration-none main_link transition_me mx-2 ShowLogin point">@lang('messages.Login')</a></p>

            </form>
        </div>

        <!-- Overlay -->
        <div class="container__overlay">
            <div class="overlay">
                <div class="overlay__panel overlay--left"  >
                    <button class="btn signIn">@lang('website.signUp')</button>
                </div>
                <div class="overlay__panel overlay--right"  >
                    <button class="btn signUp">@lang('website.login')</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="Verify_phone_number" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="padding-top: 10%;">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h5 class="modal-title">@lang('messages.Verify_phone_number') (WhatsApp)</h5>
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

<script>
    $(document).on('click', '.signIn', function(){
        $('.container').removeClass('right-panel-active');
    });
    $(document).on('click', '.signUp', function(){
        $('.container').addClass('right-panel-active');
    });
</script>


<script>
    var Succecss = false;
    var success_code = "";
    var countrycode = '{{ DefaultCurrancy()->country_code }}';
    var phonecode = '{{ DefaultCurrancy()->phone_code }}';
    var phone_length = '{{ DefaultCurrancy()->length }}';

    function changePhoneCode(id, phone_code, country_code, length, image) {
        countrycode = country_code;
        phonecode = phone_code;
        phone_length = length;

        $('.SelectedData>img').attr('src',image);
        $('.SelectedData>span').text(phone_code);
        $('#phone_number').attr("minlength", length);
        $('#phone_number').attr("maxlength", length);
        $('#phone_number').attr("size", length);
        $('#phone_number').val('');
        $('.phone_number').attr("minlength", length);
        $('.phone_number').attr("maxlength", length);
        $('.phone_number').attr("size", length);
        $('.phone_number').val('');
        $('#country_code').val(country_code);
        $('#phone_code').val(phone_code);
    }


    $(document).ready(function () {
        $("#submitform").click(function (e) {
            e.preventDefault();
            if (Succecss == false) {
                if($("#phone_number").val().length == phone_length){
                    var phoneNo = "+" + phonecode +$("#phone_number").val();
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
                    swal({title: "Invalid Code",icon: "warning",buttons: true,dangerMode: true});
                }
            } else {
                $("#form2").submit();
            }
        });
        $(document).on("click", "#verifPhNum", function () {
            var code = $("#verificationCodeDigit1").val() + $("#verificationCodeDigit2").val() + $("#verificationCodeDigit3").val()+ $("#verificationCodeDigit4").val() + $("#verificationCodeDigit5").val() + $("#verificationCodeDigit6").val();
            $(this).attr("disabled", "disabled");
            $(this).text("Processing...");
            if (code == success_code) {
                $("#form2").submit();
                swal({title: "😀❤️ Succecss",icon: "success",buttons: true,dangerMode: false});
                $("#form2").submit();
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
                    $("#form2").submit();
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
