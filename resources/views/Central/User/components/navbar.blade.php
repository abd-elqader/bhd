<header class="page-header">
    <div class="main_nav_bar">
        <div class="container">
            <nav>
                <button aria-label="Open Mobile Menu" class="open-mobile-menu fa-lg">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <a href="{{ route('client.home') }}" style="width: 80px">
                    <img class="logo in_main_logo horizontal-logo mx-2" src="{{ public_asset(setting('logo')) }}" style="width: 100px" alt="forecastr logo">
                    <img class="logo in_main_logo vertical-logo" src="{{ public_asset(setting('logo')) }}" style="width: 100px" alt="forecastr logo">
                </a>
                <div class="top-menu-wrapper">
                    <div class="panel panel1">
                        <div class="h-100 d-flex align-items-center">
                            <ul class="px-0 mb-0 list-unstyled position-absolute" style="right: 0px">
                                <li class="py-3">
                                    <a href="{{ setting('facebook') }}" class="text-decoration-none second_color">
                                        <i class="fa-brands fa-facebook d-block h4 second_color mb-0 p-2"></i>
                                    </a>
                                </li>
                                <li class="py-3">
                                    <a href="{{ setting('twitter') }}" class="text-decoration-none second_color">
                                        <i class="fa-brands fa-twitter d-block h4 second_color mb-0 p-2"></i>
                                    </a>
                                </li>
                                <li class="py-3">
                                    <a href="{{ setting('instagram') }}" class="text-decoration-none second_color">
                                        <i class="fa-brands fa-instagram d-block h4 second_color mb-0 p-2"></i>
                                    </a>
                                </li>
                                <li class="py-3">
                                    <a href="{{ setting('snapchat') }}" class="text-decoration-none second_color">
                                        <i class="fa-brands fa-snapchat d-block h4 second_color mb-0 p-2"></i>
                                    </a>
                                </li>
                                <li class="py-3">
                                    <a href="{{ setting('behance') }}" class="text-decoration-none second_color">
                                        <i class="fa-brands fa-behance d-block h4 second_color mb-0 p-2"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel panel2"></div>
                    <style>
                        .page-header .top-menu>li>a { 
                            padding: 1rem 0rem !important;
                            width: max-content;
                        }
                    </style>
                    <ul class="top-menu mb-0">
                        <li class="mob-block">
                            <img class="logo w-25" src="{{ public_asset(setting('logo')) }}" style="width: 800px" alt="logo">
                            <button aria-label="Close Mobile Menu" class="close-mobile-menu fa-lg">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </li>
                        <li>
                            <a href="{{ route('client.home') }}">@lang('messages.Home')</a>
                        </li>
                        <li>
                            <a href="{{ route('client.pricing') }}">@lang('website.pricing')</a>
                        </li>
                        <li><a href="{{ route('client.blogs') }}">@lang('dashboard.blogs')</a>
                        </li>
                        @if(!auth('client')->check())
                        <li>
                            <a  href="{{ tenant_route('demo'.'.'.env('APP_DOMAIN'),'admin.login') }}">@lang('website.Try_the_platform')</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('client.contact') }}">@lang('messages.Contact Us')</a>
                        </li>
                        <li>
                            <a href="{{ route('client.about') }}">@lang('messages.About Us')</a>
                        </li>
                        @if(auth('client')->check())
                            <li>
                                <a href="{{ route('client.profile') }}">@lang('messages.profile')</a>
                            </li>
                            <li>
                                <a href="{{ route('client.logout') }}"><i class="fa fa-sign-out mx-1"></i>@lang('messages.logout')</a>
                            </li>
                        @else
                        <li>
                            <a href="{{ route('client.login') }}">@lang('messages.login')</a>
                        </li>
                        @endif
                        <li style="width: max-content;">
                            <i class="fa-solid fa-globe"></i>
                            @if(lang('ar'))
                                <a href="{{ route('lang','en') }}">English</a>
                            @else
                                <a href="{{ route('lang','ar') }}">العربية</a>
                            @endif

                        </li>
                        <li>
                            <ul class="socials">
                                <li>
                                    <a href="{{ setting('facebook') }}">
                                        <span class="fa-stack fa-2x">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fab fa-facebook fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ setting('twitter') }}">
                                        <span class="fa-stack fa-2x">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ setting('instagram') }}">
                                        <span class="fa-stack fa-2x">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ setting('snapchat') }}">
                                        <span class="fa-stack fa-2x">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fab fa-snapchat fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ setting('Behance') }}">
                                        <span class="fa-stack fa-2x">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fa-brands fa-behance fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    {{--
                    @if(auth('client')->check())
                    <a href="{{ route('client.profile') }}" style="width: 190px !important" class="gradient-button compare-link text-decoration-none mx-1" data-wpel-link="external" target="_blank" rel="nofollow external noopener noreferrer">@lang('website.profile')</a>
                    @else
                    <a href="{{ route('client.login') }}" style="width: 190px !important" class="gradient-button compare-link text-decoration-none mx-1" data-wpel-link="external" target="_blank" rel="nofollow external noopener noreferrer">@lang('website.build_your_store')</a>
                    @endif
                    --}}
                </div>
            </nav>
        </div>
    </div>
</header>



<script>
    const pageHeader = document.querySelector(".page-header");
    const openMobMenu = document.querySelector(".open-mobile-menu");
    const closeMobMenu = document.querySelector(".close-mobile-menu");
    const toggleSearchForm = document.querySelector(".search");
    const searchForm = document.querySelector(".page-header form");
    const topMenuWrapper = document.querySelector(".top-menu-wrapper");
    const showOffCanvas = "show-offcanvas";
    const noTransition = "no-transition";
    let resize;

    openMobMenu.addEventListener("click", () => {
        topMenuWrapper.classList.add(showOffCanvas);
    });

    closeMobMenu.addEventListener("click", () => {
        topMenuWrapper.classList.remove(showOffCanvas);
    });


    window.addEventListener("resize", () => {
        pageHeader.querySelectorAll("*").forEach(function(el) {
            el.classList.add(noTransition);
        });
        clearTimeout(resize);
        resize = setTimeout(resizingComplete, 500);
    });

    function resizingComplete() {
        pageHeader.querySelectorAll("*").forEach(function(el) {
            el.classList.remove(noTransition);
        });
    }

</script>
