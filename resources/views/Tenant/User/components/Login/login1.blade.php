
<link rel="stylesheet" href="https://unpkg.com/intl-tel-input@17.0.3/build/css/intlTelInput.css">

<div class="container container-fluid mt-5 mb-5">
    <div class="d-flex justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('client.home') }}">@lang('website.home')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('website.login')</li>
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
            <form action="{{route('client.login')}}" method="POST" style="display:contents">
                @csrf
                <div class="signup-form">
                    <div class="container">
                        <div class="header">
                            <h1>@lang('website.login')</h1>
                        </div>
                        <div class="my-1">
                            <div class="input">
                                <input type="tel" name="phone" placeholder="@lang('website.phone')" id="phone" class="w-100" minlength="8" maxlength="8" size="8" autocomplete="off" />
                            </div>
                            <div class="input">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" name="password"  placeholder="@lang('website.password')" autocomplete="off" />
                            </div>
                            <div class="form-group d-flex justify-content-between">
    
                                <label class="checkbox-wrap checkbox-primary"><input type="checkbox" class="mx-1" checked>@lang('messages.remember')</label>
                                <a href="{{ route('client.forget') }}" class="text-decoration-none my_foot_link transition_me">@lang('website.forgetPassword')</a>
                            </div>
                            <input class="btn btn-primary btn-lg btn-block main_btn w-100 mx-auto" type="submit" value="@lang('website.login')" />
                        </div>
                        <p>@lang('website.dontHaveAccount') <a href="{{ route('client.register') }}" class="text-decoration-none my_foot_link transition_me">@lang('messages.register')</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://unpkg.com/intl-tel-input@17.0.3/build/js/intlTelInput.js"></script>
<script>
    var iti = window.intlTelInput(document.querySelector("#phone"), {
        separateDialCode: true
        , onlyCountries: @json(countries()->pluck('country_code')->toarray())
        , utilsScript: "https://unpkg.com/intl-tel-input@17.0.3/build/js/utils.js"
    , });
    window.iti = iti;
    document.querySelector("#phone").addEventListener("countrychange", function() {
        $('#phone').val('');
        dialCode = iti.getSelectedCountryData().dialCode;
        length = 0;
        @json(countries()).forEach(element => element.phone_code.includes(dialCode) ? (length =  element.length) : 0 );
 
        $('#phone').attr("minlength", length);
        $('#phone').attr("maxlength", length);
        $('#phone').attr("size", length);
    })
</script>