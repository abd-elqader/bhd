
<div class="bread position-relative">
    <div class="in_bread">
        <div class="container w-100 h-100 mt-5">
            <div class="d-flex justify-content-center align-items-center w-100 h-100">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item h2"><a href="/" class="text-decoration-none">{{ trans('messages.Home') }}</a></li>
                    <li class="breadcrumb-item h2 active" aria-current="page">{{ trans('messages.privacy') }}</li>
                  </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row py-5 text-center">
        <div class="col-md-6">
            <img src="{{ public_asset(setting('privacy_image') ?? setting('logo')) }}" class="img-fluid" alt="image">
        </div>
        <div class="col-md-6">
            <p class="between_bold h5" style="line-height: 2.2">{!! setting('privacy_'.lang()) !!}</p>
        </div>
    </div>
</div>