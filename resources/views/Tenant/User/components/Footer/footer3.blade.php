<style>
    .my_foot_link_2{
        color: var(--second--color);
    }
    .my_foot_link_2:hover{
        color: var(--main--color);
    }
</style>


<footer class="py-4 third_bg">
    <div class="container">
        <div class="row">
            <div class="col-12 col-6 col-lg-4">
                <div class="my-4 text-center">
                    <h3 class="pb-4 fw-bold second_color">عن متجر</h3>
                    <div class="d-flex justify-content-center">
                        <div class="new_logo point">
                            <h3 class="fw-bold position-absolute text-secondary text-center" onclick="location.href='{{ route('client.home') }}'">
                                <img src="{{ public_asset(setting('logo')) }}" alt="Example1" width="200">
                            </h3>
                        </div>
                    </div>
                    <p class="tiny_font second_color my-4">{!! setting('about_'.lang()) !!}</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="my-4 text-center">
                    <h3 class="pb-2 fw-bold second_color">الروابط السريعة</h3>
                    <div class="d-flex align-items-center justify-content-center">
                        <ul class="list-unstyled">
                            <li class="my-4 row justify-content-center">
                                <a href="{{ route('client.home') }}" class="col-6 text-decoration-none my_foot_link_2 h6 mb-0 fw-bold transition_me">
                                    <p>@lang('website.home')</p>
                                </a>
                                <a href="{{ route('client.home', 'About') }}" class="col-6 text-decoration-none my_foot_link_2 h6 mb-0 fw-bold transition_me">
                                    <p>@lang('website.about')</p>
                                </a>
                                <a href="{{ route('client.home', 'profile') }}" class="col-6 text-decoration-none my_foot_link_2 h6 mb-0 fw-bold transition_me">
                                    <p>@lang('website.myOrder')</p>
                                </a>
                                <a href="{{ route('client.home', 'Category') }}" class="col-6 text-decoration-none my_foot_link_2 h6 mb-0 fw-bold transition_me">
                                    <p>@lang('website.categories')</p>
                                </a>
                                <a href="{{ route('client.home', 'Contact') }}" class="col-6 text-decoration-none my_foot_link_2 h6 mb-0 fw-bold transition_me">
                                    <p>@lang('website.contact')</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="my-4 text-center">
                    <h3 class="pb-4 fw-bold second_color">@lang('messages.Contact Us')</h3>
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <i class="fa-solid fa-phone ms-1 h5 mb-0 second_color"></i>
                        <span class="mx-2 second_color">
                            <a target="_blank" href="tel:+{{ setting('phone') }}" class="my_foot_link_2 fw-bold transition_me">
                                {{ setting('phone') }}
                            </a>
                        </span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <i class="fa-solid fa-envelope ms-1 h5 mb-0 second_color"></i>
                        <span class="mx-2 second_color">
                            <a target="_blank" href="mailto:+{{ setting('email') }}" class="my_foot_link_2 fw-bold transition_me">
                                {{ setting('email') }}
                            </a>
                        </span>
                    </div>
                </div>
                <div class="my-4 text-center">
                    <a target="_blank" href="{{ setting('facebook') }}"><i class="h3 px-2 fa-brands fa-facebook my_foot_link_2 transition_me"></i></a>
                    <a target="_blank" href="{{ setting('instagram') }}"><i class="h3 px-2 fa-brands fa-instagram my_foot_link_2 transition_me"></i></a>
                    <a target="_blank" href="{{ setting('twitter') }}"><i class="h3 px-2 fa-brands fa-twitter my_foot_link_2 transition_me"></i></a>
                    <a target="_blank" href="{{ setting('snapchat') }}"><i class="h3 px-2 fa-brands fa-snapchat my_foot_link_2 transition_me"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
