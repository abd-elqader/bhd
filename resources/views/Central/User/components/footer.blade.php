<footer class="py-4 mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="my-4">
                    <a class="text-decoration-none d-block" href="{{ route('client.home') }}">
                        <img style="height: 200px" src="{{ public_asset(setting('logo')) }}" class="img-fluid" alt="image">
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-5">
                <div class="my-4">
                    <h3 class="pb-4 fw-bold">@lang('website.quickLinks')</h3>
                    <div class="row">
                        <div class="col-12 col-md-5 px-0">
                            <div class="">
                                <ul class="list-unstyled px-0">
                                    <li class="my-4"><a href="{{ route('client.home') }}" class="text-decoration-none my_foot_link h5 text-white transition_me">@lang('website.home')</a></li>
                                    <li class="my-4"><a href="{{ route('client.pricing') }}" class="text-decoration-none my_foot_link h5 text-white transition_me">@lang('website.pricing')</a></li>
                                    <li class="my-4"><a href="{{ route('client.blogs') }}" class="text-decoration-none my_foot_link h5 text-white transition_me">@lang('dashboard.blogs')</a></li>
                                    <li class="my-4"><a href="{{ tenant_route('demo'.'.'.env('APP_DOMAIN'),'admin.login') }}" class="text-decoration-none my_foot_link h5 text-white transition_me">@lang('website.Try_the_platform')</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-7 px-0">
                            <div class="">
                                <ul class="list-unstyled px-0">
                                    <li class="my-4"><a href="{{ route('client.terms') }}" class="text-decoration-none my_foot_link h5 text-white transition_me">@lang('messages.Terms and Conditions')</a></li>
                                    <li class="my-4"><a href="{{ route('client.privacy') }}" class="text-decoration-none my_foot_link h5 text-white transition_me">@lang('messages.Privacy Policy')</a></li>
                                    <li class="my-4"><a href="{{ route('client.faq') }}" class="text-decoration-none my_foot_link h5 text-white transition_me">@lang('messages.FAQ')</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="my-4">
                    <h3 class="pb-4 fw-bold">@lang('messages.Contact Us')</h3>
                    <ul class="list-unstyled px-0 d-flex align-items-center  mt-4">
                        <li class="mx-2"><a target="_blanck" href="{{ setting('instagram') }}" class="text-decoration-none my_icon_link h2 transition_me"><i class="fa-brands fa-instagram"></i></a></li>
                        <li class="mx-2"><a target="_blanck" href="{{ setting('twitter') }}" class="text-decoration-none my_icon_link h2 transition_me"><i class="fa-brands fa-twitter"></i></a></li>
                        <li class="mx-2"><a target="_blanck" href="{{ setting('facebook') }}" class="text-decoration-none my_icon_link h1 transition_me"><i class="fa-brands fa-facebook"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mt-5 d-flex justify-content-center">
            <p class="main_color h5 my_copy">@lang('messages.copyrights',['tenant' => 'Matjr'])
                <a href="https://emcan-group.com/" target="_blank" class="main_link">@lang('messages.emcan')</a>
            </p>
        </div>
    </div>
</footer>

@include('Central/User/components.BackToTop')

</body>
</html>
