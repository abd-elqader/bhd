<header class="p-3 mb-2">
    <div class="container">
      <div class="row d-flex align-items-center justify-content-center">
            <div class="col-6 col-md-3">
                <a class="navbar-brand" href="{{ route('client.home') }}">
                  <img src="{{ asset(setting('logo')) }}" alt="Logo" width="70" height="70" class="d-inline-block align-text-top">
                </a>
            </div>
            <div class="col-md-5 d-none d-md-block">
                <form action="{{route('client.categories')}}" style="display:contents">
                  <input type="search" name="search"  class="form-control py-2" placeholder="@lang('website.search')..." aria-label="search">
                </form>
            </div>
            <div class="col-6 col-md-4">
                <a data-cart-small="" href="{{ route('client.cart') }}" class="ml-1 site-header__cart" rel="nofollow">
                    <div><span class="fa-solid fa-cart-plus"></span></div>
                    <div class=" d-flex align-items-center justify-content-center">
                        <span style="float: right;background: #CCC;padding: 3px 10px 3px 8px;border-radius: 50px;margin: 0px 6px;">{{ \App\Models\Tenant\Cart::where('client_id',client_id())->count() }}</span>
                        <span style="float: right;margin: 3px 0px;">@lang('website.cart')</span>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-5 d-md-none d-sm-block d-flex align-items-center justify-content-center">
                <form action="{{route('client.categories')}}" style="display:contents">
                  <input type="search" name="search" required  class="form-control py-2" placeholder="@lang('website.search')..." aria-label="search">
                </form>
            </div>
            <!--<div class="col-2 col-md-5 d-md-none d-sm-block d-flex align-items-center justify-content-center">-->
            <!--    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">-->
            <!--      <span class="fa-solid fa-bars-staggered border-0"></span>-->
            <!--    </button>-->
            <!--</div>-->
      </div>
    </div>
</header>
@if(Categories()->count())
<nav class="main_bg bg-body-tertiary">
    <div class="container" style="overflow-y: hidden;overflow-x: auto;">
        <ul style="flex-direction: row;width: max-content;" class="d-flex  py-1">
            <li class="nav-item"><a class="text-white px-2 text-decoration-none" href="{{ route('client.home') }}">{{ __('website.home') }}</a></li>
            <li class="nav-item"><a class="text-white px-2 text-decoration-none" href="{{ route('client.categories',['type' => 'sale']) }}">{{ __('website.discount') }}</a></li>
            @foreach(Categories() as $Category)
                <li class="nav-item"><a class="text-white px-2 text-decoration-none" href="{{ route('client.categories',['category_id' => $Category->id]) }}">{{ $Category->title() }}</a></li>
            @endforeach
        </ul>
    </div>
</nav>
@endif