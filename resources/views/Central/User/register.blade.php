@extends('Central.User.components.layout')
@section('content')


<div class="container p-0" style="height: 100vh;">
    <div class="row justify-content-center align-items-center h-100">

            <div class="col-12 col-sm-11 col-md-12 col-lg-6">
                <div class="my-4">
                    <div class="text-center p-4">
                        <img style="width: 100px" src="{{ public_asset(setting('logo')) }}" class="img-fluid" alt="img">
                    </div>
                    
                    
                    <div class="container">
                       <ul class="row p-0 nav nav-tabs">
                          <li class="col-6 tabs__label py-3 border-0 text-center point"  href="#1" data-toggle="tab">
                             <div>@lang('messages.Login')</div>
                          </li>
                          <li class="col-6 tabs__label py-3 border-0 text-center point active" href="#2" data-toggle="tab">
                              <div>@lang('messages.register')</div>
                          </li>
                       </ul>
                       <div class="tab-content ">
                          <div class="tab-pane" id="1">
                             <form class="rounded p-4 my-3" action="{{ route('client.login') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="position-relative my-4 py-2">
                                    <input type="phone" name="phone" id="login_phone" class="w-100 py-3 px-5 rounded border" placeholder="@lang('messages.phone')" minlength="{{ DefaultCurrancy()->length }}" maxlength="{{ DefaultCurrancy()->length }}" size="{{ DefaultCurrancy()->length }}" >
                                </div>
                                <div class="position-relative my-4 py-2">
                                    <input type="password" name="password" class="w-100 py-3 px-5 rounded border" placeholder="@lang('messages.Password')">
                                    <i class="fa-solid fa-eye position-absolute fs-3 mb-0" style="top: 25px;"></i>
                                </div>
                                <div class="d-flex align-items-center py-2 justify-content-between">
                                    <div class="">
                                        <input class="form-check-input mx-1" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="" for="flexCheckDefault">
                                            @lang('messages.remember')
                                        </label>
                                    </div>
                                    <div class="">
                                        <a class="main_link transition_me text-decoration-none h6 mb-0 point"  href="{{ route('client.forget') }}">@lang('messages.Forget Password ?')</a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <button class="main_bt transition_me w-100 p-3 border-0">@lang('messages.Login')</button>
                                </div>
                            </form>
                          </div>
                          <div class="tab-pane active" id="2">
                                <form method="POST" action="{{ route('client.register') }}" id="signUP">
                                    @csrf
                                    <div class="my-4">
                                      <label class="d-block h5">@lang('messages.Phone')</label>
                                      <input id="phone" minlength="{{ DefaultCurrancy()->length }}" maxlength="{{ DefaultCurrancy()->length }}" size="{{ DefaultCurrancy()->length }}" type="text" name="phone" data- class="p-3 m-x2 w-100 border rounded" placeholder="@lang('messages.Phone')">
                                      <input class="p-3 m-x2 w-100 border rounded" type="hidden" value="{{ old('country_code') }}" name="country_code" id="country_code">
                                      <input class="p-3 m-x2 w-100 border rounded" type="hidden" value="{{ old('phone_code') }}" name="phone_code" id="phone_code">
                                    </div>
                                    <div class="my-4">
                                      <label class="d-block h5">@lang('messages.Name')</label>
                                      <input type="text" name="name" class="p-3 mx-2 w-100 border rounded" placeholder="@lang('messages.Name')">
                                    </div>
                                    <div class="my-4">
                                      <label class="d-block h5">Benefit pay</label>
                                      <input type="text" name="benefit" class="p-3 mx-2 w-100 border rounded" placeholder="Benefit pay">
                                    </div>
                                    <div class="my-4">
                                      <label class="d-block h5">IBAN</label>
                                      <input type="text" name="iban" class="p-3 mx-2 w-100 border rounded" placeholder="IBAN">
                                    </div>
                                    <div class="my-4">
                                      <label class="d-block h5">@lang('messages.E-MAIL ADDRESS')</label>
                                      <input type="email" name="email" class="p-3 mx-2 w-100 border rounded" placeholder="@lang('messages.E-MAIL ADDRESS')">
                                    </div>
                                    <div class="my-4">
                                      <label class="d-block h5">@lang('messages.Password')</label>
                                      <input type="password" name="password" class="p-3 mx-2 w-100 border rounded" placeholder="@lang('messages.Password')">
                                    </div>
                                    <div class="text-center py-3">
                                      <button class="main_bt transition_me w-100 p-3 border-0" id="submitform">@lang('messages.Register')</button>
                                    </div>
                                    <div class="text-center">
                                      <p class=" w-100 p-3 border-0">
                                         <span>@lang('website.By_registering__I_agree_to') </span>
                                         <a class="main_link transition_me text-decoration-none fw-bold" href="{{ route('client.terms') }}" target="_blanck">@lang('messages.Terms and Conditions')</a>
                                      </p>
                                    </div>
                                </form>
                          </div>
                       </div>
                    </div>
                    
                    
                    
                </div>
            </div>
            
            
            <div class="col-12 col-sm-11 col-md-12 col-lg-6">
                <div class="row justify-content-center align-items-center h-100">
                    <div id="login-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach (LoginTestimonials() as $item)
                                <div class="carousel-item text-center {{ $loop->first ? 'active' : '' }}">
                                    <img style="max-width: 100%" src="{{ public_asset($item->image) }}" class="img-fluid" alt="img">
                                    <div class="my-4">
                                        <h2 class="fw-bold">{{ $item->title() }}</h2>
                                        <div class="tiny_font">{!! $item->desc() !!}</div>
                                    </div>
                                </div>
                            @endforeach
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
@endsection

@section('css')
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

        #phone ,
        #login_phone {
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
@endsection
@section('js')
    <script src="https://unpkg.com/intl-tel-input@17.0.3/build/js/intlTelInput.js"></script>
    <script>
        var login_iti = window.intlTelInput(document.querySelector("#login_phone"), {
            separateDialCode: true
            , onlyCountries: @json(countries()->pluck('country_code')->toarray())
            , utilsScript: "https://unpkg.com/intl-tel-input@17.0.3/build/js/utils.js"
        , });
        window.login_iti = login_iti;
        document.querySelector("#login_phone").addEventListener("countrychange", function() {
            $('#login_phone').val('');
            phone_code = login_iti.getSelectedCountryData().dialCode;
            country_code = login_iti.getSelectedCountryData().iso2;
            length = 0;
            @json(countries()).forEach(element => element.phone_code.includes(phone_code) ? (length =  element.length) : 0 );
    
            $('#login_phone').attr("minlength", length);
            $('#login_phone').attr("maxlength", length);
            $('#login_phone').attr("size", length);
        })
    </script>
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
@endsection