<link rel="stylesheet" href="https://unpkg.com/intl-tel-input@17.0.3/build/css/intlTelInput.css">

<div class="container container-fluid mt-5 mb-5">
    <div class="d-flex justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('client.home') }}">@lang('website.home')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('website.forgetPassword')</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 text-center">
                <div class="mt-4">
                    <img src="{{ asset(setting('logo')) }}" class="img-fluid footer-logoimg" alt="image">
                </div>
            </div>
            <form action="{{route('client.forget')}}" method="POST" style="display:contents">
                @csrf
                <div class="signup-form">
                    <div class="container">
                        <div class="header">
                            <h1>@lang('website.forgetPassword')</h1>
                        </div>
                        <div class="my-1">
                            <div class="input">
                                <input type="tel" placeholder="phone" id="phone" name="phone" minlength="8" maxlength="8" size="8" class="w-100" autocomplete="off" />
                            </div>
                            <div class="input password d-none">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" id="password" placeholder="Password" name="password" autocomplete="off" />
                            </div>
                            <input class="btn btn-primary btn-lg btn-block main_btn w-100 mx-auto" type="submit" id="submitform" value="@lang('messages.Submit')" />
                        </div>
                        <p>@lang('website.haveAccount') <a href="{{ route('client.login') }}" class="text-decoration-none my_foot_link transition_me">@lang('website.login')</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>


<div class="modal" id="Verify_phone" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="padding-top: 10%;">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h5 class="modal-title">@lang('messages.Verify_phone_number') (WhatsApp)</h5>
            </div>
            <div class="modal-body">
                <div class="form-group mt-4" >
                    <div id="digitsContainer">
                        <div id="codeverifyForm">
                            <div id="inputs" class="ltr">
                                <input type="text" class="digit" id="verificationCodeDigit1" minlength="1" maxlength="1" required>
                                <input type="text" class="digit" id="verificationCodeDigit2" minlength="1" maxlength="1" required>
                                <input type="text" class="digit" id="verificationCodeDigit3" minlength="1" maxlength="1" required>
                                <input type="text" class="digit" id="verificationCodeDigit4" minlength="1" maxlength="1" required>
                                <input type="text" class="digit" id="verificationCodeDigit5" minlength="1" maxlength="1" required>
                                <input type="text" class="digit" id="verificationCodeDigit6" minlength="1" maxlength="1" required>
                            </div>
                        </div>
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
<script src="https://unpkg.com/intl-tel-input@17.0.3/build/js/intlTelInput.js"></script>
<script>

    var Succecss = false;
    var success_code = "";
    var countrycode = '{{ DefaultCurrancy()->country_code }}';
    var phonecode = '{{ DefaultCurrancy()->phone_code }}';
    var phone_length = {{ DefaultCurrancy()->length }};
    
    
    var iti = window.intlTelInput(document.querySelector("#phone"), {
        separateDialCode: true
        , onlyCountries: @json(countries()->pluck('country_code')->toarray())
        , utilsScript: "https://unpkg.com/intl-tel-input@17.0.3/build/js/utils.js"
    , });
    window.iti = iti;
    document.querySelector("#phone").addEventListener("countrychange", function() {
        $('#phone').val('');
        
        dialCode = iti.getSelectedCountryData().dialCode;
        iso2 = iti.getSelectedCountryData().iso2;
        
        phone_length = length = 0;
        @json(countries()).forEach(element => element.phone_code.includes(dialCode) ? (length =  element.length) : 0 );
        
        countrycode = iso2;
        phonecode = dialCode;
        phone_length = length;
        $('#phone').attr("minlength", length);
        $('#phone').attr("maxlength", length);
        $('#phone').attr("size", length);
    })
</script>

<script>

    $(document).ready(function () {
        $("#submitform").click(function (e) {
            e.preventDefault();
            if (Succecss == false) {
                if($("#phone").val().length == phone_length){
                    var phoneNo = "+" + phonecode +$("#phone").val();
                    $.ajax({
                        method: "POST",
                        url: "/sendotp/" + phoneNo,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (result) => {
                            $("#Verify_phone").show();
                            $("#verificationCodeDigit1").focus();
                            success_code = result.code;
                        },
                        error: (error) => {
                            $("#Verify_phone").show();
                            $("#verificationCodeDigit1").focus();
                            success_code = result.code;
                        },
                    });
                }else{
                    swal({title: "Invalid Code",icon: "warning",buttons: true,dangerMode: true});
                }
            } else {
                if($('#password').val().length){
                    $("form").submit();
                }else{
                    $(".password").removeClass('d-none');
                }
            }
        });
        $(document).on("click", "#verifPhNum", function () {
            var code = $("#verificationCodeDigit1").val() + $("#verificationCodeDigit2").val() + $("#verificationCodeDigit3").val()+ $("#verificationCodeDigit4").val() + $("#verificationCodeDigit5").val() + $("#verificationCodeDigit6").val();
            $(this).attr("disabled", "disabled");
            $(this).text("Processing...");
            if (code == success_code) {
                $(".password").removeClass('d-none');
                swal({title: "😀❤️ Succecss",icon: "success",buttons: true,dangerMode: false});
                $(".password").removeClass('d-none');
                Succecss = true;
                $("#Verify_phone").hide();
                $("#phone").prop("readonly", true);
                $("#phone").addClass("border border-success");
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
            $("#Verify_phone").hide();
        });

        $(".digit").keyup(function () {
            $(this).next("input").focus();
            var code = $("#verificationCodeDigit1").val() + $("#verificationCodeDigit2").val() + $("#verificationCodeDigit3").val()+ $("#verificationCodeDigit4").val() + $("#verificationCodeDigit5").val() + $("#verificationCodeDigit6").val();
            if($("#verificationCodeDigit1").val() && $("#verificationCodeDigit2").val() && $("#verificationCodeDigit3").val() && $("#verificationCodeDigit4").val() && $("#verificationCodeDigit5").val() && $("#verificationCodeDigit6").val()){
                if (code == success_code) {
                    $(".password").removeClass('d-none');
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