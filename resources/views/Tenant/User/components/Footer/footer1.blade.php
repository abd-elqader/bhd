<style>
    .foot_link{
        color: var(--third--color);
    }
    .foot_link:hover{
        color: var(--main--color);
    }
    footer{
    
    }
    
    ul {
    list-style: none;
    list-style-position: inside;
}
footer {
    background-color: rgba(44, 44, 44, 1)
!important;
}

footer a {
    opacity: 80%;
    font-size: 18px;
}
footer p {
    opacity: 80%;
    font-size: 14px;
}
.foot_link{
        color:white;

}
.foot_link:hover {
    color: var(--main--color);
}


footer .social  li {
  list-style: none;
}
footer .social  li a {
  opacity: 100% !important;
  width: 40px;
  height: 40px;
    background-color: white;
  text-align: center;
  line-height: 30px;
  font-size: 20px;
  margin: 0 7px;
  display: block;
  border-radius: 50%;
  position: relative;
  overflow: hidden;
  border: 1px solid transparent;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  color: black;
}
footer .social  li a::before {
  content: "";
  position: absolute;
  top: 101%;
  left: 0;
  width: 100%;
  height: 100%;
  background: #f00;
  transition: 0.5s;
  z-index: 2;
}
footer .social  li a .icon {
  position: relative;
  transition: 0.5s;
  z-index: 3;
  color: var(--mainColor2);
  opacity: 1;
}
footer .social  li a:hover .icon {
  color: white;
  transform: rotateY(360deg);
}
footer .social  li a:hover::before {
  top: 0;
}

footer .social  li a:before {
  background: var(--main--color);
}

nav footer .social  a {
  width: 25px;
  height: 25px;
  font-size: 15px;
}
</style>
<footer>
  <div class="container py-5">
  <div class="row justify-content-between " >
  <div class="col-lg-3 col-md-4 col-12 text-white ">
                          <img onclick="location.href='{{ route('client.home') }}'" src="{{ public_asset(setting('logo')) }}" alt="image" class="img-fluid point" style="width: 130px">


  </div>
    <div class="col-lg-3 col-md-4 col-12 ">
      <h4 class="">@lang('website.quickLinks')</h4>
  
      <ul class="p-0 fs-6 list-footer">
        <li class="py-1">
<a href="{{ route('client.home') }}" class="text-decoration-none foot_link fw-light transition_me">@lang('messages.Home')</a>
        </li>
        <li class="py-1">
                                    <a href="{{ route('client.categories') }}" class="text-decoration-none foot_link fw-light transition_me">@lang('website.shopNow')</a>

      </li>
    <li class="py-1">
                                    <a href="{{ route('client.categories',['offers'=>true]) }}" class="text-decoration-none foot_link fw-light transition_me">@lang('messages.offers')</a>

  </li>
  <li class="py-1">
                                    <a href="{{ route('client.contact') }}" class="text-decoration-none foot_link fw-light transition_me">@lang('messages.Contact Us')</a>

</li>
<li class="py-1">
                                        <a href="{{ route('client.profile',['type'=>'index']) }}" class="text-decoration-none foot_link fw-light transition_me">@lang('messages.profile')</a>

</li>
      </ul>
    </div>
    <div class="col-lg-3 col-md-4 col-12 ">
      <h4 class="">@lang('messages.CUSTOMER SERVICE')</h4>
  
      <ul class="p-0 fs-6 list-footer">
        <li class="py-1 w-100">
                                    <a href="{{ route('client.home') }}" class="text-decoration-none foot_link fw-light transition_me">@lang('messages.Home')</a>

        </li>
        <li class="py-1 w-100">
                            <a href="{{ route('client.privacy') }}" class="text-decoration-none foot_link fw-light transition_me">@lang('dashboard.privacy')</a>

      </li>
        <li class="py-1 w-100">
                            <a href="{{ route('client.terms') }}" class="text-decoration-none foot_link fw-light transition_me">@lang('website.terms')</a>

      </li>
      <li class="py-1 w-100">
                            <a href="{{ route('client.about') }}" class="text-decoration-none foot_link fw-light transition_me">@lang('messages.About Us')</a>

      </li>
            <li class="py-1 w-100">
                                <a href="{{ route('client.profile',['type'=>'orders']) }}" class="text-decoration-none foot_link fw-light transition_me">@lang('messages.My Orders')</a>

      </li>
            <li class="py-1 w-100">
                                <a href="{{ route('client.profile',['type'=>'fav']) }}" class="text-decoration-none foot_link fw-light transition_me">@lang('messages.My Favourites')</a>

      </li>
      </ul>
    </div>
    <div class="col-lg-3 col-md-4 col-12 px-0">
              <h4 class="">@lang('messages.contact_us')</h4>
                    <ul class="social d-flex px-0">
                        <li class=" ">
                            <a target="_blank" href="{{ setting('facebook') }}" class="text-decoration-none foot_link fw-light transition_me">
                                <i class="fa-brands fa-facebook-f h4 mb-0 icon"></i>
                            </a>
                        </li>
                           <li class=" ">
                            <a target="_blank" href="{{ setting('instagram') }}" class="text-decoration-none foot_link fw-light transition_me">
                                <i class="fa-brands fa-instagram h4 mb-0 icon"></i>
                            </a>
                        </li>
                           <li class=" ">
                            <a target="_blank" href="{{ setting('snapchat') }}" class="text-decoration-none foot_link fw-light transition_me">
                                <i class="fa-brands fa-snapchat h4 mb-0 icon"></i>
                            </a>
                        </li>
                           <li class=" ">
                            <a target="_blank" href="{{ setting('twitter') }}" class="text-decoration-none foot_link fw-light transition_me">
                                <i class="fa-brands fa-twitter h4 mb-0 icon"></i>
                            </a>
                        </li>
                    </ul>

    </div>
  </div>
  </div>
  
<div class="container py-3">
  
  
  <div class="row  border-top border-light text-white-50 py-4 fw-medium gy-3">
  <div class="col-md-6 col-12  fs-6   ">

           @lang('messages.copyrights',['tenant'=>ucfirst(tenant()->id)]) 
    <a style="opacity: 1;" href="https://www.instagram.com/emcansolutions/" target="_blank" class="text-decoration-none">
        @lang('messages.emcan')
    </a>
  </div>
    <div class="col-md-4 col-12 text-center  emcan">
    </div>

  </div>
  
  </div>
  
  </footer>

<!--<footer class="second_bg pt-4 w-100">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-12 col-md-4 col-lg-2">-->
<!--                <div class="my-3">-->
<!--                    <img onclick="location.href='{{ route('client.home') }}'" src="{{ public_asset(setting('logo')) }}" alt="image" class="img-fluid point" style="width: 130px">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-12 col-sm-6 col-md-4 col-lg-3">-->
<!--                <div class="my-3">-->
<!--                    <h4 class="third_color">@lang('website.quickLinks')</h4>-->
<!--                    <div class="row align-items-center">-->
<!--                        <div class="col-12 px-0">-->
<!--                            <ul class="list-unstyled">-->
<!--                                <li class="my-3 tiny_font">-->
<!--                                    <a href="{{ route('client.home') }}" class="text-decoration-none foot_link fw-light transition_me">@lang('messages.Home')</a>-->
<!--                                </li>-->
<!--                                <li class="my-3 tiny_font">-->
<!--                                    <a href="{{ route('client.categories') }}" class="text-decoration-none foot_link fw-light transition_me">@lang('website.shopNow')</a>-->
<!--                                </li>-->
<!--                                <li class="my-3 tiny_font">-->
<!--                                    <a href="{{ route('client.categories',['offers'=>true]) }}" class="text-decoration-none foot_link fw-light transition_me">@lang('messages.offers')</a>-->
<!--                                </li>-->
<!--                                <li class="my-3 tiny_font">-->
<!--                                    <a href="{{ route('client.contact') }}" class="text-decoration-none foot_link fw-light transition_me">@lang('messages.Contact Us')</a>-->
<!--                                </li>-->
<!--                                @if (auth('client')->check())-->
<!--                                    <li class="my-3 tiny_font">-->
<!--                                        <a href="{{ route('client.profile',['type'=>'index']) }}" class="text-decoration-none foot_link fw-light transition_me">@lang('messages.profile')</a>-->
<!--                                    </li>-->
<!--                                @endif-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-12 col-sm-6 col-md-4 col-lg-3">-->
<!--                <div class="my-3">-->
<!--                    <h4 class="third_color mb-4">@lang('messages.CUSTOMER SERVICE')</h4>-->
<!--                    <ul class="list-unstyled">-->
<!--                        <li class="my-3 tiny_font">-->
<!--                            <a href="{{ route('client.privacy') }}" class="text-decoration-none foot_link fw-light transition_me">@lang('messages.privacy')</a>-->
<!--                        </li>-->
<!--                        <li class="my-3 tiny_font">-->
<!--                            <a href="{{ route('client.terms') }}" class="text-decoration-none foot_link fw-light transition_me">@lang('website.terms')</a>-->
<!--                        </li>-->
<!--                        <li class="my-3 tiny_font">-->
<!--                            <a href="{{ route('client.about') }}" class="text-decoration-none foot_link fw-light transition_me">@lang('messages.About Us')</a>-->
<!--                        </li>-->
<!--                        @if (auth('client')->check())-->
<!--                            <li class="my-3 tiny_font">-->
<!--                                <a href="{{ route('client.profile',['type'=>'orders']) }}" class="text-decoration-none foot_link fw-light transition_me">@lang('messages.My Orders')</a>-->
<!--                            </li>-->
<!--                            <li class="my-3 tiny_font">-->
<!--                                <a href="{{ route('client.profile',['type'=>'fav']) }}" class="text-decoration-none foot_link fw-light transition_me">@lang('messages.My Favourites')</a>-->
<!--                            </li>-->
<!--                        @endif-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-12 col-sm-6 col-md-5 col-lg-4">-->
<!--                <div class="my-3">-->
<!--                    <h4 class="third_color mb-3">@lang('messages.contact_us')</h4>-->
<!--                    <ul class="list-unstyled d-flex mb-4">-->
<!--                        <li class="my-3 tiny_font me-3">-->
<!--                            <a target="_blank" href="{{ setting('facebook') }}" class="text-decoration-none foot_link fw-light transition_me">-->
<!--                                <i class="fa-brands fa-facebook-f h4 mb-0"></i>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="my-3 tiny_font me-3">-->
<!--                            <a target="_blank" href="{{ setting('instagram') }}" class="text-decoration-none foot_link fw-light transition_me">-->
<!--                                <i class="fa-brands fa-instagram h4 mb-0"></i>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="my-3 tiny_font me-3">-->
<!--                            <a target="_blank" href="{{ setting('snapchat') }}" class="text-decoration-none foot_link fw-light transition_me">-->
<!--                                <i class="fa-brands fa-snapchat h4 mb-0"></i>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="my-3 tiny_font me-3">-->
<!--                            <a target="_blank" href="{{ setting('twitter') }}" class="text-decoration-none foot_link fw-light transition_me">-->
<!--                                <i class="fa-brands fa-twitter h4 mb-0"></i>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    </ul>-->
                    
<!--                    <a href="{{ setting('apple') }}" class="text-decoration-none fw-light transition_me">-->
<!--                        <img src="{{ public_asset('/apple-store.png') }}" alt="image" class="img-fluid" style="height: 100px;">-->
<!--                    </a>-->
<!--                    <a href="{{ setting('android') }}" class="text-decoration-none fw-light transition_me">-->
<!--                        <img src="{{ public_asset('/Google-Play.png') }}" alt="image" class="img-fluid" style="height: 80px;">-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</footer>-->
