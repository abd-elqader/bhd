<link rel="stylesheet" href="https://unpkg.com/intl-tel-input@17.0.3/build/css/intlTelInput.css">

<div class="container container-fluid mt-5 mb-5">
    <div class="d-flex justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('client.home') }}">@lang('website.home')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('messages.register')</li>
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
            <form action="{{route('client.register')}}" method="POST" style="display:contents" id="signUP">
                @csrf
                <div class="signup-form">
                    <div class="container">
                        <div class="header">
                            <h1>@lang('messages.register')</h1>
                        </div>
                        <div class="my-1">
                            <div class="input">
                                <i class="fa-solid fa-signature"></i>
                                <input type="text" placeholder="@lang('website.name')" id="name" name="name" class="w-100" autocomplete="off" />
                            </div>
                            <div class="input">
                                <input type="tel" placeholder="@lang('website.phone')" id="phone" name="phone" class="w-100" autocomplete="off" minlength="8" maxlength="8" size="8" />
                                <input type="hidden"  id="country_code" name="country_code"/>
                                <input type="hidden"  id="phone_code" name="phone_code"/>
                            </div>
                            <div class="input">
                                <i class="fa-solid fa-envelope-open"></i>
                                <input type="email" placeholder="@lang('website.email')" id="email" name="email" class="w-100" autocomplete="off" />
                            </div>
                            <div class="input">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" placeholder="Password" name="password" autocomplete="off" />
                            </div>
                            <input class="btn btn-primary btn-lg btn-block main_btn w-100 mx-auto" type="submit" id="submitform" value="@lang('messages.register')" />
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
                <h5 class="modal-title">@lang('messages.Verify_phone') (WhatsApp)</h5>
            </div>
            <div class="modal-body">
                <div class="form-group mt-4" >
                    <div id="digitsContainer">
                        <form id="codeverifyForm">
                            <div id="inputs" class="ltr">
                                <input type="text" class="form-control" id="code" minlength="6" maxlength="6" required>
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

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://unpkg.com/intl-tel-input@17.0.3/build/css/intlTelInput.css">
<style>
    .tabs__label.active, .tabs__label:hover {
        background-color: var(--main--color);
        color: ##ffffff;
    }
    .nav-tabs {
        border: var(--main--color) 1px solid;
    }

    
    .iti {
        width: 100% !important;
        @if(lang('en'))
        padding: 0px 0px 0px 50px;
        @endif
    }
    .iti__country-list{
        background-color: rgb(255 255 255);
    }
    @media (max-width: 575.98px) {
        .iti.iti--container {
            right: -20px;
        }
    }

    #phone {
       border: 0px !important;
    }
    ul#iti-1__country-listbox,
    ul#iti-0__country-listbox {
        position: absolute;
        left: 0px;
        direction: ltr;
    }

    .my_bt {
        border: 2px solid var(--main--color);
        color: var(--main--color);
        background-color: transparent;
    }

    .my_bt:hover {
        border: 2px solid var(--main--color);
        color: var(--second--color);
        background-color: var(--main--color);
    }

    body {
        background: url('{{ public_asset("Central/img/bg.jpg") }}');
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>

<script src="https://unpkg.com/intl-tel-input@17.0.3/build/js/intlTelInput.js"></script>

<script>
    
    var Succecss = false;
    var success_code = "";
    var country_code = '{{ DefaultCurrancy()->country_code }}';
    var phone_code = '{{ DefaultCurrancy()->phone_code }}';
    var phone_length = {{ DefaultCurrancy()->length }};
        
        
    var iti = window.intlTelInput(document.querySelector("#phone"), {
        separateDialCode: true
        , onlyCountries: @json(countries()->pluck('country_code')->toarray())
        , utilsScript: "https://unpkg.com/intl-tel-input@17.0.3/build/js/utils.js"
    , });
    window.iti = iti;
    document.querySelector("#phone").addEventListener("countrychange", function() {
        $('#phone').val('');
        phone_code = iti.getSelectedCountryData().dialCode;
        country_code = iti.getSelectedCountryData().iso2;
        phone_length = length = 0;
        @json(countries()).forEach(element => element.phone_code.includes(phone_code) ? (length =  element.length) : 0 );

        $('#country_code').val(country_code);
        $('#phone_code').val(phone_code);

        $('#phone').attr("minlength", length);
        $('#phone').attr("maxlength", length);
        $('#phone').attr("size", length);
        phone_length = length;
    })


    $(document).ready(function () {
        $("#submitform").click(function (e) {
            e.preventDefault();
            if (Succecss == false) {
                if($("#phone").val().length == phone_length){
                    var phoneNo = "+" + phone_code +$("#phone").val();
                    console.log(phoneNo);
                    $.ajax({
                        method: "POST",
                        url: "/sendotp/" + phoneNo,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (result) => {
                            $("#Verify_phone").show();
                            success_code = result.code;
                        },
                        error: (error) => {
                            $("#Verify_phone").show();
                            success_code = result.code;
                        },
                    });
                }else{
                    swal({title: "Invalid Code",icon: "warning",buttons: true,dangerMode: true});
                }
            } else {
                $("#signUP").submit();
            }
        });
        $(document).on("click", "#verifPhNum", function () {
            $(this).attr("disabled", "disabled");
            $(this).text("Processing...");
            if ($("#code").val() == success_code) {
                $("#signUP").submit();
                swal({title: "😀❤️ Succecss",icon: "success",buttons: true,dangerMode: false});
                $("#signUP").submit();
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

    });


</script>
