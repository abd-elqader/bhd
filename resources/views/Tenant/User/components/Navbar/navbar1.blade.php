<style>
    .them_2 .med_them button,
    .them_1 .med_them button {
        position: absolute;
        @if (lang('ar')) left: 0px; @else right: 0px;@endif
    }
    
    .button_nav{
      cursor: pointer; 
      text-decoration: none;
      /*color: var(--main--color);*/
      background: transparent !important;
      margin: 0px !important;
      padding: 5px !important;
    }
    
    .button:hover{
        color: var(--main--color);
    }
    
    /* Float Shadow */
    .float-shadow {
      display: inline-block;
      position: relative;
      transition-duration: 0.3s;
      transition-property: transform;
      -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
      transform: translateZ(0);
      box-shadow: 0 0 1px rgba(0, 0, 0, 0);
    }
    .float-shadow:before {
      pointer-events: none;
      position: absolute;
      z-index: -1;
      content: "";
      top: 100%;
      left: 5%;
      height: 10px;
      width: 90%;
      opacity: 0;
      background: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.35) 0%, rgba(0, 0, 0, 0) 80%);
      /* W3C */
      transition-duration: 0.3s;
      transition-property: transform opacity;
    }
    .float-shadow:hover {
      transform: translateY(-5px);
      /* move the element up by 5px */
    }
    .float-shadow:hover:before {
      opacity: 1;
      transform: translateY(5px);
      /* move the element down by 5px (it will stay in place because it's attached to the element that also moves up 5px) */
    }
.social li {
  list-style: none;
}
.social li a {
  opacity: 100% !important;
  width: 25px;
  height: 25px;
  background-color: var(--mainColor2);
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
  color: white;
      text-decoration: none;
}
.social li a::before {
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
.social li a .icon {
  position: relative;
  transition: 0.5s;
  z-index: 3;
  color: white;
  opacity: 1;
}
.social li a:hover .icon {
  color: var(--primaryColor);
  transform: rotateY(360deg);
}
.social li a:hover::before {
  top: 0;
}

.social li a:before {
  background: var(--mainColor4);
}
.dropdown-toggle::after {
display:none;
}
.little_back {
    background: url(data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E) no-repeat 12px center;
    background-size: 35px 15px;
    padding: 9px 40px 9px 40px;
}
</style>

<div class="them_1 py-2 ">
    <div class="container">
        <div class="my_nav">
            <div class="row align-items-center justify-content-between">
                <div class="col-7 col-md-6 col-lg-2">
                    <div class="">
                        <div class="d-flex align-items-center justify-content-end">
                            @if(auth('client')->check())
                                <div class="in_in">
                                    <a href="{{ route('client.profile','index') }}"
                                        class="notification d-flex align-items-center justify-content-center button_nav float-shadow back_me">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="#303030" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M20.5899 22C20.5899 18.13 16.7399 15 11.9999 15C7.25991 15 3.40991 18.13 3.40991 22" stroke="#303030" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

                                    </a>
                                </div>
                                <div class="in_in">
                                    <a href="{{ route('client.logout') }}"
                                        class="notification d-flex align-items-center justify-content-center button_nav float-shadow back_me">
                                        <i class="fa fa-sign-out h5 mb-0"></i>
                                    </a>
                                </div>
                            @else
                                <div class="in_in">
                                    <!--<i style="margin-top: 6px;" class="my_cart fa-regular fa-user main_color h5 text-center d-flex d-flex justify-content-center align-items-center"  ></i>-->
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" data-bs-toggle="dropdown" aria-expanded="false">
<path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="#303030" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M20.5899 22C20.5899 18.13 16.7399 15 11.9999 15C7.25991 15 3.40991 18.13 3.40991 22" stroke="#303030" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg >

                                    <ul class="dropdown-menu">
                                       @if(auth('client')->check())
                                            <li>
                                                <a class="dropdown-item" href="{{ route('client.profile','fav') }}">
                                                    @lang('website.profile')
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('client.logout','fav') }}">
                                                    @lang('website.logout')
                                                </a>
                                            </li>
                                        @endif
                                        @if(!auth('client')->check())
                                            <li>
                                                <a class="dropdown-item" href="{{ route('client.login') }}">
                                                    <i class="fa-solid fa-right-to-bracket"></i>
                                                    <span class="tiny_font my-auto">@lang('messages.login')</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('client.login') }}">
                                                    <i class="fa-solid fa-user-plus"></i>
                                                    <span class="tiny_font my-auto">@lang('messages.register')</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                            <div class="in_in">
                                <a href="{{ route('client.cart') }}" class="notification button_nav float-shadow back_me">
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2 2H3.74001C4.82001 2 5.67 2.93 5.58 4L4.75 13.96C4.61 15.59 5.89999 16.99 7.53999 16.99H18.19C19.63 16.99 20.89 15.81 21 14.38L21.54 6.88C21.66 5.22 20.4 3.87 18.73 3.87H5.82001" stroke="#303030" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M16.25 22C16.9404 22 17.5 21.4404 17.5 20.75C17.5 20.0596 16.9404 19.5 16.25 19.5C15.5596 19.5 15 20.0596 15 20.75C15 21.4404 15.5596 22 16.25 22Z" stroke="#303030" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.25 22C8.94036 22 9.5 21.4404 9.5 20.75C9.5 20.0596 8.94036 19.5 8.25 19.5C7.55964 19.5 7 20.0596 7 20.75C7 21.4404 7.55964 22 8.25 22Z" stroke="#303030" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M9 8H21" stroke="#303030" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

                                    <span class="badge">{{ \App\Models\Tenant\Cart::where('client_id',client_id())->count() }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-11 col-md-8 d-block d-lg-none">
                    <div class="row justify-content-center">
                        <div class="col-12 px-0">
                            <div class="position-relative med_them my-3">
                                <form action="{{route('client.categories')}}" method="POST">
                                    @csrf
                                    <button class="rounded-pill border-0 main_bt transition_me py-3 px-5 h5">@lang('website.search')</button>
                                    <input type="text" name="search" value="" class="little_back border-0 rounded-pill w-100 px-5 py-3">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 d-none d-lg-block">
                    <div class="">
                        <div class="position-relative med_them my-3">
                            <form action="{{route('client.categories')}}" method="GET">
                                <!--<button class="rounded-pill border-0 main_bt transition_me py-3 px-5 h5">@lang('website.search')</button>-->
                                <input type="search" name="search" value="" required class="little_back border-0 rounded-pill w-100 px-5 py-3 bg-light">
                            </form>
                        </div>
                    </div>
                </div>
                                <div class="col-5 col-md-6 col-lg-2">
                    <div class="">
                        <div class="d-flex align-items-center point justify-content-center justify-content-md-start" onclick="location.href='{{ route('client.home') }}'">
                            <div class="new_logo point">
                                <img src="{{ public_asset(setting('logo')) }}" alt="{{ tenant()->id }}" style="width: 100%; height:100%;">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

