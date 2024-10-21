<link rel="stylesheet" href="https://unpkg.com/intl-tel-input@17.0.3/build/css/intlTelInput.css">

@if(!auth('client')->check())
<div class="bg-dark ">
    <nav class="container navbar navbar-expand-md navbar-dark d-flex justify-content-between">
        <div>
            <div class="dropdown">
                <button class="border-0 rounded-pill px-2 py-1 mx-1 text-white" style="background: none;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img style="width: 30px;height: 18px;" src="{{ public_asset( DefaultCurrancy()->image ) }}" class="img-fluid" alt="image"> {{ DefaultCurrancy()->currancy_code }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @foreach (Currancies() as $Currancy)
                    <li class="">
                        <a class="dropdown-item d-flex align-items-center justify-content-around py-2" href="{{ route('ChangeDefaultCurrancy',$Currancy->id) }}">
                            <img style="width: 26px;height: 17px;" src="{{ public_asset($Currancy->image) }}" class="img-fluid" alt="image">
                            <span class="tiny_font">
                                {{ $Currancy->currancy_code }}
                            </span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <h3 class="my-3"  data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-regular fa-user main_color point"></i>
        </h3>
        
    </nav>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body overflow-hidden">
               <form action="{{route('client.login')}}" method="POST" style="display:contents">
                @csrf
                    <div class="row signup-form">
                        <div class="h2 text-center">
                            <i class="fa-regular fa-user main_color p-4 rounded"  style="border: 2px solid var(--main--color);"></i>
                        </div>
                        <h5  class="text-center">
                            @lang('website.login')
                        </h5>
                        <div class="form-group mt-3">
                            <input type="tel" name="phone" placeholder="@lang('website.phone')"  id="login_phone" class="form-control w-100" minlength="8" maxlength="8" size="8" autocomplete="off" />
                        </div>
                        <div class="form-group my-3">
                            <input type="password" name="password" placeholder="@lang('website.password')" id="login_password"  placeholder="@lang('website.password')" class="form-control" autocomplete="off" />
                        </div>
                        <input class="btn btn-primary btn-lg btn-block main_btn w-75 mx-auto" type="submit" value="@lang('website.login')" />
                    </div>
                </form>
                <p  class="text-center">@lang('website.dontHaveAccount') <a href="{{ route('client.register') }}" class="text-decoration-none my_foot_link transition_me">@lang('messages.register')</a></p>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/intl-tel-input@17.0.3/build/js/intlTelInput.js"></script>
<script>
    var iti = window.intlTelInput(document.querySelector("#login_phone"), {
        separateDialCode: true
        , onlyCountries: @json(countries()->pluck('country_code')->toarray())
        , utilsScript: "https://unpkg.com/intl-tel-input@17.0.3/build/js/utils.js"
    , });
    window.iti = iti;
    document.querySelector("#login_phone").addEventListener("countrychange", function() {
        $('#login_phone').val('');
        dialCode = iti.getSelectedCountryData().dialCode;
        length = 0;
        @json(countries()).forEach(element => element.phone_code.includes(dialCode) ? (length =  element.length) : 0 );
 
        $('#login_phone').attr("minlength", length);
        $('#login_phone').attr("maxlength", length);
        $('#login_phone').attr("size", length);
    })
</script>
@else
<div class="bg-dark ">
    <nav class="container navbar navbar-expand-md navbar-dark d-flex justify-content-end">
        <h3 class="my-3 mx-2" onclick="location.href='{{ route('client.logout') }}'">
            <i class="fa-solid fa-right-from-bracket main_color point"></i>
        </h3>
        <h3 class="my-3" onclick="location.href='{{ route('client.profile','index') }}'">
            <i class="fa-regular fa-user main_color point"></i>
        </h3>
    </nav>
</div>
@endif