@extends('Central.User.components.layout')
@section('content')

    @php($type5 = Types()->where('id',5)->first())
    @if ($type5 && $type5 ->status && $type5 ->images->count())
        <div class="main_header">
            <div class="main_slider my-5 pt-4">
                <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner container">
                        @foreach ($type5->images as  $key => $slider)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-6">
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <div class="my-3">
                                                <h4 class="main_color fw-bold">{{ $slider->title() }}</h4>
                                                <p class="h5 my-2 py-2">{!! html_entity_decode($slider->desc()) !!}</p>
                                                <div class="d-flex justify-content-around align-items-center">
                                                    <a class="main_bt transition_me px-4 py-2 border-0 text-decoration-none rounded-pill h6 text-center" href="{{ auth('client')->check() ? route('client.profile') : route('client.login') }}" style="width: 45%;">
                                                        @if(auth('client')->check())
                                                            @lang('website.visit_shop')
                                                        @else
                                                            @lang('website.build_your_store')
                                                        @endif
                                                    </a>
                                                    <a class="main_bt transition_me px-4 py-2 border-0 text-decoration-none rounded-pill h6 text-center" href="{{ tenant_route('demo'.'.'.env('APP_DOMAIN'),'admin.login_wihout_form') }}" style="width: 45%;">
                                                        @if(auth('client')->check())
                                                            @lang('website.Try_the_platform')
                                                        @else
                                                            @lang('website.Try_the_platform')
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 d-none d-lg-block">
                                        <div class="my-3">
                                            <img style="height: 400px" src="{{ public_asset($slider->image) }}" class="img-fluid d-none d-md-block" alt="image">
                                            <div class="mt-4">
                                                <ul class="list-unstyled d-flex align-items-center justify-content-center py-2">
                                                    <li class="mx-3">
                                                        <a href="{{ setting('youtube') }}" target="_blanck" class="main_link transition_me text-decoration-none">
                                                            <i class="fa-brands fa-youtube h4"></i>
                                                        </a>
                                                    </li>
                                                    <li class="mx-3">
                                                        <a href="{{ setting('twitter') }}" target="_blanck" class="main_link transition_me text-decoration-none">
                                                            <i class="fa-brands fa-twitter h4"></i>
                                                        </a>
                                                    </li>
                                                    <li class="mx-3">
                                                        <a href="{{ setting('facebook') }}" target="_blanck" class="main_link transition_me text-decoration-none">
                                                            <i class="fa-brands fa-facebook h4"></i>
                                                        </a>
                                                    </li>
                                                    <li class="mx-3">
                                                        <a href="{{ setting('snapchat') }}" target="_blanck" class="main_link transition_me text-decoration-none">
                                                            <i class="fa-brands fa-snapchat h4"></i>
                                                        </a>
                                                    </li>
                                                    <li class="mx-3">
                                                        <a href="{{ setting('instagram') }}" target="_blanck" class="main_link transition_me text-decoration-none">
                                                            <i class="fa-brands fa-instagram h4"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <div class="in_arrow">
                            <i class="fa-solid fa-chevron-left"></i>
                        </div>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <div class="in_arrow">
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    @endif
    
    @php($type6 = Types()->where('id',6)->first())
    @if ($type6 && $type6 ->status && $type6 ->images->count())
        <div class="static py-4">
            <div class="container">
                <div class="title text-center py-3">
                    <h3 class="fw-bold">{{ $type6->title() }}</h3>
                </div>
                <div class="row align-items-center justify-content-center">
                    @foreach ($type6->images as $item6)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="my-4 in_static">
                                <div class="text-center w-100 p-4">
                                    <img src="{{ public_asset( $item6->image ) }}" alt="statistics" style="width: 100px">
                                    <span class="our_opacity d-block py-2 h3">{{ $item6->title() }}</span>
                                    <h3 class="fw-bold third_color">{!! html_entity_decode($item6->desc()) !!}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    
    @php($type3 = Types()->where('id',3)->first())
    @if ($type3 && $type3 ->status && $type3 ->images->count())
        <div class="why my-5">
            <div class="container">
                <div class="title text-center py-3">
                    <h3 class="fw-bold">{{ $type3->title() }}</h3>
                </div>
                <div class="row">
                    @foreach ($type3->images as $item3)
                        <div class="col-12 col-md-6 col-lg-4  mx-auto">
                            <div class="my-4 in_why px-2 pt-5 text-center shadow h-100">
                                <img src="{{ public_asset($item3->image) }}" class="img-fluid w-75" alt="image">
                                <h6 class="fw-bold py-3">{{ $item3->title() }}</h6>
                                <p class="our_opacity tiny_font">{!! $item3->desc() !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    
    @if (Stores()->count())
        <div class="on_matjr py-4">
            <div class="container">
                <div>
                    <div class="title text-center my-4">
                        <h3 class="fw-bold">@lang('dashboard.online_stores_on_matjr')</h3>
                    </div>
                    <div class="row py-5 align-items-center">
                        <div class="col-12 col-lg-6">
                            <div class="my-3 position-relative overflow-hidden">
                                <img src="{{ public_asset('/Central/img/windowscreen.png') }}" class="img-fluid" alt="image">
                                <img src="" style="position: absolute;left: 0;padding: 70px;top: -51px;" class="img-fluid WebsiteImage" alt="image">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="my-3">
                                <div class="in_on_matjr position-relative">
                                    <div id="websites" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                            @foreach (Stores() as $key => $Store)
                                                <button type="button" data-bs-target="#websites" data-bs-slide-to="{{ $key  }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $key  }}"></button>
                                            @endforeach
                                        </div>
                                        <div class="carousel-inner">
                                            @foreach (Stores() as $key => $Store)
                                                <div style="height: 300px;" class="itemX carousel-item {{ $loop->first ? 'active' : '' }}" data-website-image="{{ public_asset($Store->website) }}">
                                                    <div class="w-100 py-4">
                                                        <img style="height: 100px" src="{{ public_asset($Store->image) }}" class="img-fluid" alt="image">
                                                    </div>
                                                    <a class="fw-bold position-relative h2 text-decoration-none" target="_blanck" href="{{ $Store->link }}" style="top: -15px;">{{ $Store->title() }}</a>
                                                    <p class="px-2 w-100">{!! html_entity_decode($Store->desc()) !!}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="button_slider position-absolute w-100 index_over" style="bottom: -35px !important">
                                            <button class="carousel-control-prev" type="button" data-bs-target="#websites" data-bs-slide="prev">
                                                <div class="in_arrow">
                                                    <i class="fa-solid fa-chevron-left"></i>
                                                </div>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#websites" data-bs-slide="next">
                                                <div class="in_arrow">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    @if (Packages()->count())
        <div class="package my-5">
            <div class="container">
                <div class="title text-center py-4">
                    <h3 class="fw-bold">@lang('dashboard.home_packages')</h3>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="my-3">
                            <img src="/Central/img/Women studying vitamins in organic food.jpg" class="img-fluid" alt="image">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            @foreach (PackageDesc() as $Description)
                                <div class="col-md-6">
                                    <li>{{ $Description->title() }}</li>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach (Packages() as $Package)
                        <div class="col-sm-12 col-md" onclick="location.href='{{ route('client.register') }}'">
                            <div class="in_package point rounded my-3 p-3">
                                <div class="text-center my-3">
                                    <h3 class="main_color fw-bold">{{ $Package->title() }}</h3>
                                    <span class="d-block fw-bold rounded-pill my-4 second_bg main_color py-3 px-1 w-100 mx-auto h5">
                                        @if($Package->discount)
                                        <small style="text-decoration: line-through 2px red;    font-size: 14px;">{{ $Package->price_before }}</small><span class="text-danger mx-4"><b>{{ $Package->price_after }}</b></span>
                                        @else
                                        <span>{{ $Package->price() }}</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    
    
    @php($type7 = Types()->where('id',7)->first())
    @if ($type7 && $type7 ->status && $type7 ->images->count())
        <div class="client my-5">
            <div class="container">
                <div class="title text-center py-3">
                    <h3 class="fw-bold">{{ $type7->title() }}</h3>
                </div>
                <div class="py-4 d-none d-md-none d-lg-block">
                    <div id="_client" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach ($type7->images->chunk(5) as $key => $Clients)
                            <button type="button" data-bs-target="#_client" data-bs-slide-to="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="true" aria-label="{{ $key }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach ($type7->images->chunk(5) as $key => $Clients)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="row">
                                    @foreach ($Clients as $Client)
                                        <div class="col">
                                            <div class="in_client shadow point my-3 text-center">
                                                <img src="{{ public_asset($Client->image) }}" class="img-fluid mx-auto" style="height: 100px" alt="image">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
    
                <div class="py-4 d-none d-md-block d-lg-none">
                    <div id="_client_md" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach ($type7->images->chunk(3) as $key => $Clients)
                                <button type="button" data-bs-target="#_client_md" data-bs-slide-to="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="true" aria-label="{{ $key }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach ($type7->images->chunk(3) as $key => $Clients)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="row">
                                    @foreach ($Clients as $item7)
                                        <div class="col-4">
                                            <div class="in_client shadow point my-3">
                                                <img src="{{ public_asset($Client->image) }}" class="img-fluid" alt="image">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
    
                <div class="py-4 d-block d-md-none d-lg-none">
                    <div id="_client_sm" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach ($type7->images->chunk(2) as $key => $Clients)
                            <button type="button" data-bs-target="#_client_sm" data-bs-slide-to="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="true" aria-label="{{ $key }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach ($type7->images->chunk(2) as $key => $Clients)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="row">
                                    @foreach ($Clients as $Client)
                                    <div class="col-6">
                                        <div class="in_client point my-3 text-center">
                                            <img src="{{ public_asset($Client->image) }}" class="img-fluid" alt="image">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    @endif
    
    
    @php($type1 = Types()->where('id',1)->first())
    @if ($type1 && $type1 ->status && $type1 ->images->count())
        <div class="reviews my-5">
            <div class="container">
                <div class="title text-center py-3">
                    <h3 class="fw-bold">{{ $type1->title() }}</h3>
                </div>
                <div id="testimonials" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($type1->images as $key => $testimonial)
                            <div class="carousel-item px-5 {{ $loop->first ? 'active' : '' }}">
                                <div class="text-center mx-auto">
                                    <img src="{{ public_asset($testimonial->image) }}" alt="" style="height:200px">
                                </div>
                                <h5 class="fw-bold text-center">{{ $testimonial->title() }}</h5>
                                <p class="in_reviews">
                                    {!! html_entity_decode($testimonial->desc()) !!}
                                </p>
                            </div>
                        @endforeach
                    </div>
                    @if($type1->images->count() > 0)
                        <button style="width: 3%" class="carousel-control-prev" type="button" data-bs-target="#testimonials" data-bs-slide="prev">
                            <div class="in_arrow">
                                <i class="fa-solid fa-chevron-left"></i>
                            </div>
                        </button>
                        <button style="width: 3%" class="carousel-control-next" type="button" data-bs-target="#testimonials" data-bs-slide="next">
                            <div class="in_arrow">
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endif
    
    
    <div class="download my-5 pt-4 pb-5">
        <div class="container">
            <div class="title text-center py-4">
                <h3 class="fw-bold">@lang('website.Download_the_app_now')</h3>
            </div>
            <div class="text-center">
                <p class="h5">@lang('website.The_app_is_now_available_on_iPhone_and_Android')</p>
            </div>
            <div class="row mt-4 d-flex align-items-center justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-center justify-content-center my-3">
                        <button class="my_other_bt border-0 px-5 py-3 rounded-pill d-flex d-flex align-items-center justify-content-center">
                            <span class="in_icon ms-3"><i class="mx-3 fa-brands fa-apple"></i></span>
                            <a class="second_color h6 fw-bold mb-0 mx-3 text-decoration-none text-white" target="_blank" href="{{ setting('apple') }}">@lang('website.Download_the application_on_iPhone')</a>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-center justify-content-center my-3">
                        <button class="my_other_bt border-0 px-5 py-3 rounded-pill d-flex d-flex align-items-center justify-content-center">
                            <span class="in_icon ms-3"><i class="mx-3 fa-brands fa-android"></i></span>
                            <a class="second_color h6 fw-bold mb-0 mx-3 text-decoration-none text-white" target="_blank" href="{{ setting('android') }}">@lang('website.Download_the_application_on_Android')</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="contact">
        <div class="container">
            <div class="title text-center py-4">
                <h3 class="fw-bold">@lang('messages.Contact Us')</h3>
            </div>
            <div class="d-flex align-items-center justify-content-center my-4">
                <img src="/Central/img/undraw_contact_us_re_4qqt.jpg" class="img-fluid" alt="image">
            </div>
            <form method="POST" action="{{ route('client.post_contact') }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('POST')
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="custom_input position-relative my-4">
                            <input name="name" type="text" class="border-0 rounded-pill w-100 p-4 back_me my-3" style="background-color: #2eafc61a;">
                            <label>@lang('messages.Name')</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="custom_input position-relative my-4">
                            <input name="phone" type="text" class="border-0 rounded-pill w-100 p-4 back_me my-3" style="background-color: #2eafc61a;">
                            <label>@lang('messages.phone')</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="custom_input position-relative my-4">
                            <input name="email" type="email" class="border-0 rounded-pill w-100 p-4 back_me my-3" style="background-color: #2eafc61a;">
                            <label>@lang('messages.E-MAIL ADDRESS')</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="custom_input position-relative my-4">
                            <input name="subject" type="text" class="border-0 rounded-pill w-100 p-4 back_me my-3" style="background-color: #2eafc61a;">
                            <label>@lang('messages.subject')</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="custom_input position-relative my-4">
                            <textarea name="message" class="border-0 w-100 p-4 back_me my-3" style="background-color: #2eafc61a; border-radius: 30px;" rows="4"></textarea>
                            <label>@lang('messages.details')</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 col-lg-5">
                        <button type="submit" class="main_bt transition_me border-0 rounded-pill w-100 py-3 px-5 h4">@lang('messages.Send Message')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.WebsiteImage').attr('src',$('.itemX.active').attr('data-website-image'));
        });
        $('#websites').bind('slide.bs.carousel',  function (e) {
            setTimeout(function(){
                $('.WebsiteImage').attr('src',$('.itemX.active').attr('data-website-image'));
             }, 650);
        });
    </script>

@endsection
