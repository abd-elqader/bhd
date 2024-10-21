<style>
    .phone_code_preview {
        font-size: 16px;
    }

</style>
<div class="container py-5">
    <form action="{{ route('client.login') }}" method="POST" class="my-4" style="display:contents">
        <div id="log_in" class="row">
            <div class="col-12 col-md-6">
                <img src="{{ public_asset(setting('logo')) }}" class="img-fluid" alt="image">
            </div>
            <div class=" col-12 col-md-6">
                @csrf
                <input type="hidden" value="login" name="type">
                <div class="insert_3 bg-white">
                    <div class="">
                        <h5 class="my-3">@lang('website.loginProfile')</h5>
                        <div class="row my-4">
                            <div class="col-sm-12 col-md-12 position-relative">
                                <select value="{{ old('country_id') }}" name="country_id" required class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    @php($Countries = Countries())
                                    @foreach($Countries as $Country)
                                    <option data-phone_code="{{ $Country->phone_code }}" data-length="{{ $Country->length }}" data-country_code="{{ $Country->country_code }}" value="{{ $Country['id'] }}">{{ $Country['title_' . lang()] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 position-relative">
                                <input required minlength="{{ DefaultCurrancy()->length }}" maxlength="{{ DefaultCurrancy()->length }}" size="{{ DefaultCurrancy()->length }}" type="tel" value="{{ old('phone') }}" name="phone" class="w-100 shadow my-2 px-5 py-3 border-0 phone_number" placeholder="@lang('messages.Mobile')">
                                <span class="main_color h5 position-absolute phone_code_preview" style="left: 20px; top:25px">{{ $Countries->first()->phone_code }}</span>
                            </div>
                            <div class="col-12 position-relative">
                                <input required type="password" value="{{ old('password') }}" name="password" class="w-100 shadow my-2 px-5 py-3 border-0" placeholder="@lang('website.password')">
                                <i class="fa-solid fa-lock main_color h3 position-absolute loginicon"></i>
                            </div>
                        </div>
                        <a class="text-decoration-none main_link fw-bold transition_me point forget">@lang('messages.Forget Password')</a>
                        <div class="d-flex justify-content-center my-3">
                            <button class="main_bt main_border main_bold py-2 px-5 rounded transition_me main_bold">@lang('messages.Login')</button>
                        </div>
                        <p>@lang('website.dontHaveAccount') <a class="text-decoration-none main_link transition_me mx-2 ShowSignUp point">@lang('messages.Sign Up')</a></p>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="{{ route('client.register') }}" method="POST" class="my-4"  style="display:contents">
        <div id="signUP" class="row" style="display: none;">
            <div class="col-12 col-md-6">
                <img src="{{ public_asset(setting('logo')) }}" class="img-fluid" alt="image">
            </div>
            <div class=" col-12 col-md-6">
                @csrf
                <input type="hidden" value="register" name="type">
                <div class="insert_2  bg-white d-flex justify-content-center align-items-center p-4">
                    <div class="">
                        <h5 class="my-3">@lang('website.signUpProfile')</h5>
                        <div class="row my-4">
                            <div class="col-sm-12 col-md-12 position-relative">
                                <select value="{{ old('country_id') }}" name="country_id" required class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    @foreach($Countries as $Country)
                                    <option data-phone_code="{{ $Country->phone_code }}" data-length="{{ $Country->length }}" data-country_code="{{ $Country->country_code }}" value="{{ $Country['id'] }}">{{ $Country['title_' . lang()] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="position-relative">
                                <input required minlength="{{ DefaultCurrancy()->length }}" maxlength="{{ DefaultCurrancy()->length }}" size="{{ DefaultCurrancy()->length }}" type="tel" value="{{ old('phone') }}" id="phone_number" name="phone" class="w-100 shadow my-2 px-5 py-3 border-0 phone_number" placeholder="@lang('messages.Mobile')">
                                <span class="main_color h5 position-absolute phone_code_preview" style="left: 20px; top:25px">{{ $Countries->first()->phone_code }}</span>
                                <input class="w-100 shadow my-2 px-5 py-3 border-0 no-arrow" type="hidden" value="{{ old('country_code') }}" name="country_code">
                                <input class="w-100 shadow my-2 px-5 py-3 border-0 no-arrow" type="hidden" value="{{ old('phone_code') }}" name="phone_code">
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
                            <div class="position-relative">
                                <input required type="email" value="{{ old('email') }}" name="email" class="w-100 shadow my-2 px-5 py-3 border-0" placeholder="@lang('messages.E-MAIL ADDRESS')">
                                <i class="fa-solid fa-at main_color h3 position-absolute loginicon"></i>
                            </div>
                            <div class="position-relative">
                                <input required type="text" value="{{ old('name') }}" name="name" class="w-100 shadow my-2 px-5 py-3 border-0" placeholder="@lang('website.name')">
                                <i class="fa-solid fa-signature main_color h3 position-absolute loginicon"></i>
                            </div>
                            <div class="position-relative">
                                <input required type="password" value="{{ old('password') }}" name="password" class="w-100 shadow my-2 px-5 py-3 border-0" placeholder="@lang('website.password')">
                                <i class="fa-solid fa-lock main_color h3 position-absolute loginicon"></i>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center my-3">
                            <button class="main_bt main_border main_bold py-2 px-5 rounded transition_me main_bold" id="submitform">@lang('messages.Sign Up')</button>
                        </div>
                        <p>@lang('website.haveAccount') <a class="text-decoration-none main_link transition_me mx-2 ShowLogin point">@lang('messages.Login')</a></p>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="{{ route('client.forgetpassword') }}" method="POST" class="my-4"  style="display:contents">
        <div id="forgetPass" class="row" style="display: none;">
            <div class="col-12 col-md-6">
                <img src="{{ public_asset(setting('logo')) }}" class="img-fluid" alt="image">
            </div>
            <div class=" col-12 col-md-6">
                @csrf
                <input type="hidden" value="register" name="type">
                <div class="insert_2  bg-white d-flex justify-content-center align-items-center p-4">
                    <div class="">
                        <h5 class="my-3">@lang('website.forgetPassword')</h5>
                        <div class="row my-4">
                            <div class="col-sm-12 col-md-12 position-relative">
                                <select value="{{ old('country_id') }}" name="country_id" required class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    @foreach($Countries as $Country)
                                    <option data-phone_code="{{ $Country->phone_code }}" data-length="{{ $Country->length }}" data-country_code="{{ $Country->country_code }}" value="{{ $Country['id'] }}">{{ $Country['title_' . lang()] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="position-relative">
                                <input required minlength="{{ DefaultCurrancy()->length }}" maxlength="{{ DefaultCurrancy()->length }}" size="{{ DefaultCurrancy()->length }}" type="tel" value="{{ old('phone') }}" id="phone_number2" name="phone" class="w-100 shadow my-2 px-5 py-3 border-0 phone_number" placeholder="@lang('messages.Mobile')">
                                <span class="main_color h5 position-absolute phone_code_preview" style="left: 20px; top:25px">{{ $Countries->first()->phone_code }}</span>
                                <input class="w-100 shadow my-2 px-5 py-3 border-0 no-arrow" type="hidden" value="{{ old('country_code') }}" name="country_code">
                                <input class="w-100 shadow my-2 px-5 py-3 border-0 no-arrow" type="hidden" value="{{ old('phone_code') }}" name="phone_code">
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

                            <div class="position-relative">
                                <input required type="password" value="{{ old('password') }}" name="password" class="w-100 shadow my-2 px-5 py-3 border-0" placeholder="@lang('website.password')">
                                <i class="fa-solid fa-lock main_color h3 position-absolute loginicon"></i>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center my-3">
                            <button class="main_bt main_border main_bold py-2 px-5 rounded transition_me main_bold" id="submitForget">@lang('messages.Sign Up')</button>
                        </div>
                        <p>@lang('website.haveAccount') <a class="text-decoration-none main_link transition_me mx-2 ShowLogin point">@lang('messages.Login')</a></p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal" id="Verify_phone_number" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="padding-top: 10%;">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h5 class="modal-title">@lang('messages.Verify_phone_number')</h5>
            </div>
            <div class="modal-body">
                <div class="form-group mt-4">
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
    var Succecss = false;
    var success_code = "";
    var countrycode = '{{ DefaultCurrancy()->country_code }}';
    var phonecode = '{{ DefaultCurrancy()->phone_code }}';
    var phone_length = '{{ DefaultCurrancy()->length }}';
    
    $(document).on('change', "select", function(e) {
        countrycode = $(this).find(':selected').attr('data-country_code');
        $('.country_code').val(countrycode);
        phonecode = $(this).find(':selected').attr('data-phone_code');
    
        $('.phone_code_preview').html(phonecode);
        $('.phone_code').val(phonecode);
        
        length = $(this).find(':selected').attr('data-length');

        $('.phone_number').attr("minlength", length);
        $('.phone_number').attr("maxlength", length);
        $('.phone_number').attr("size", length);
        $('.phone_number').val('');
        $('select  option[value="'+$(this).find(':selected').val()+'"]').prop("selected", true);

    });
    
    
    $(document).ready(function () {
        $("#submitform").click(function (e) {
            if (Succecss == false) {
                e.preventDefault();
                if($("#phone_number").val().length > 5 ){
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
                Succecss = true;
                $("#Verify_phone_number").hide();
                $("#phone_number").prop("readonly", true);
                $("#phone_number").addClass("border border-success");
                $("select").addClass("readonly");
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
