@if(categories()->count())
<style>
    .stokes{
        border: 2px solid transparent;
    }
    .stokes:hover{
        border: 2px solid var(--main--color);
        transform: scale(1.05);
    }
</style>
<div class="category_shop my-5">
    <div class="container">
        <div class="row justify-content-center align-items-center">
        @if(count((array)categories()))
        <div class="py-4">
            <h2 class="fw-bold text-center main_color">{{ __('messages.main_categories') }}</h2>
        </div>
            @foreach (categories() as $Category)
            <div class="col-12 col-md-6 col-lg-4" onclick="location.href='{{ route('client.categories',['category_id'=>$Category->id]) }}'">
                <div class="shadow stokes transition_me my-3">
                    <div class="row in_cat p-2 my-2 transition_me point rounded d-flex align-items-center justify-content-center">
                        <div class="col-4">
                            <img style="width:130px" src="{{ public_asset($Category->image) }}" alt="image" class="img-fluid me-4">
                        </div>
                        <div class="col-8 text-center">
                            <h5 class="uppercase pb-3 mb-0">{{ $Category->title() }}</h5>
                            <a class="link">
                                <button class="main_bt transition_me border-0 rounded py-2 fw-bold px-4 sort dropdown-toggle">
                                    @lang('website.shopNow')
                                    <i class="fa-solid fa-arrow-{{ lang('en') ? 'right' : 'left' }}"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <img src="{{ public_asset('empty_products.png') }}" class="mx-auto w-50" />
            <h2 class="text-center h6 my-2" style="font: small-caps 27px/2 cursive;">{{ __('website.empty_categories') }}</h2>
        @endif
        </div>
    </div>
</div>
@endif