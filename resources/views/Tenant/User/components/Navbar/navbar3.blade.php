
<style>
    li.nav-item a{
        color:var(--third--color);
    }
    li.nav-item a:hover{
        color:var(--main--color);
    }
</style>

<nav class="navbar container navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{setting('logo')}}" alt="coffee" class="rounded-circle" style="width: 70px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 text-center" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a href="{{route('client.home')}}" class="text-decoration-none nav_line_link transition-me font-weight-bold hover_out transition_me">@lang('website.home')</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('client.cart')}}" class="text-decoration-none nav_line_link transition-me font-weight-bold hover_out transition_me">@lang('website.cart')</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('client.categories')}}" class="text-decoration-none nav_line_link transition-me font-weight-bold hover_out transition_me">@lang('messages.categories')</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('client.about')}}" class="text-decoration-none nav_line_link transition-me font-weight-bold hover_out transition_me">@lang('messages.about')</a>
                </li>
                <li class="nav-item">
                    @if(!auth('client')->user())
                        <a href="{{route('client.login')}}" class="text-decoration-none nav_line_link transition-me font-weight-bold hover_out transition_me">@lang('website.login')</a>
                    @else
                        <form action="{{route('client.logout')}}" method="POST">
                            @csrf
                            <a class="text-decoration-none nav_line_link transition-me font-weight-bold hover_out transition_me"><button type="submit" style="all: unset; cursor: pointer;">@lang('website.logout')</button></a>
                        </form>
                        <li class="nav-item">
                            <a href="{{route('client.profile','index')}}" class="text-decoration-none nav_line_link transition-me font-weight-bold hover_out transition_me">@lang('messages.profile')</a>
                        </li>
                    @endif
                </li>
                <li class="nav-item">
                    @if(lang('ar'))
                    <a href="{{route('lang', 'en')}}" class="text-decoration-none nav_line_link transition-me font-weight-bold hover_out transition_me">English</a>
                    @else
                    <a href="{{route('lang', 'ar')}}" class="text-decoration-none nav_line_link transition-me font-weight-bold hover_out transition_me">العربية</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
