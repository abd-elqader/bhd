@extends('Central.User.components.layout')
@section('content')
<link rel="stylesheet" href="https://unpkg.com/intl-tel-input@17.0.3/build/css/intlTelInput.css">
<style>
        
    .iti {
        width: 100% !important;
        @if(lang('en'))
        padding: 0px 0px 0px 50px;
        @endif
        background-color: rgb(255 255 255);
    }

    #phone {
       border: 0px !important;
    }
        
    ul#iti-0__country-listbox {
        position: absolute;
        left: 0px;
        direction: ltr;
    }
</style>

<style>
    .border_left {
        border-left: 5px solid rgba(000, 000, 000, 0.2);
    }
</style>
<style>
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

<div class="login">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-11 col-md-12 col-lg-5">
                <div class="my-4">
                    <div class="text-center p-4">
                        <img style="width: 100px" src="{{ public_asset(setting('logo')) }}" class="img-fluid" alt="img">
                    </div>
                    <form class="shadow rounded p-4 my-3" action="{{ route('client.forget') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="position-relative my-4 py-2">
                            <label class="d-block h5">@lang('messages.phone')</label>
                            <input type="phone" name="phone" id="phone" maxlength="{{ DefaultCurrancy()->length }}" size="{{ DefaultCurrancy()->length }}" class="w-100 py-3 px-5 rounded border back_me" placeholder="@lang('messages.phone')">
                        </div>
                        <div class="position-relative my-4 py-2 password d-none">
                            <label class="d-block h5">@lang('messages.Password')</label>
                            <input type="password" name="password"  id="password" class="p-3 mx-2 w-100 border rounded" placeholder="@lang('messages.Password')">
                        </div>
                        <div class="text-center py-4">
                            <button class="main_bt transition_me w-100 p-3 border-0" id="submitform">@lang('messages.Submit')</button>
                        </div>
                        <div class="text-center py-3">
                            <a class="main_link transition_me text-decoration-none h6 mb-0 point" href="{{ route('client.login') }}">@lang('website.haveAccount')</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-7 d-none d-md-none d-md-none d-lg-block">
                    <div class="position-fixed" style="top: 30%; width: 50%;">
                    <div class="row justify-content-center">
                        <div class="col-7">
                            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @foreach (LoginTestimonials() as $key => $item)
                                        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="true" aria-label="{{ $key }}"></button>
                                    @endforeach
                                </div>

                                <div class="carousel-inner">
                                    @foreach (LoginTestimonials() as $key => $item)
                                        <div class="carousel-item text-center {{ $loop->first ? 'active' : '' }}">
                                            <img style="height: 100px" src="{{ public_asset($item->image) }}" class="img-fluid" alt="img">
                                            <div class="my-4">
                                                <p class="tiny_font">{!! $item->desc() !!}</p>
                                                <h5 class="fw-bold">{{ $item->title() }}</h5>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                <input type="text" class="form-control" id="code" minlength="6" maxlength="6" required>
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
                            $("#code").focus();
                            success_code = result.code;
                        },
                        error: (error) => {
                            $("#Verify_phone").show();
                            $("#code").focus();
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
            var code = $("#code").val();
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

        

    });


</script>
@endsection
