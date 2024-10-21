@php($FirstSizeColor = $product->SizeColor->SortBy('price')->first())
<style>
    @media (min-width: 575.98px) {
        .pro-img{
            height: 150px;
        }
        .pro-font{
            font-size: 14px;
        }
        .pro-font2{
            font-size: 13px;
        }
        .pro-width{
            width: 400px;
        }
    }
    @media (max-width: 575.98px) {
        
        .pro-font{
            font-size: 11px;
        }
        .pro-font2{
            font-size: 10px;
        }
        .pro-img{
            height: 100px;
        }
        .pro-width{
            width: 250px;
        }
    }
</style>
<div class="pro-width {{ isset($Col) ? $Col : 'col-6 col-md-6 col-lg-4' }}" style="{{ isset($style) ? $style : '' }};">
    <a href="{{route('client.product', $product->id)}}" style="text-decoration: none; color: black;">
        <div class="in_details d-flex align-items-center justify-content-around my-4 p-3">
            <img src="{{ public_asset($product->RandomImage()) }}" class="img-fluid pro-img" alt="image">
            <div class="row mx-2">
                <div class="col-12 pro-font2">
				    <p>{{ mb_strimwidth($product->title(), 0, 40, "...") }}</p>
                </div>
                <div class="w-100 ltr p-0">
                    @if ($product->SizeColor->unique('price')->count() > 1)
                        {{--  <small>{{ __('website.start_from') }}</small>  --}}
                    @endif
                    @if ($FirstSizeColor?->hasDiscount())
                        <p class="text-center"> 
                            <span class="pro-font2 text-decoration-line-through text-danger">
                                {{ $FirstSizeColor?->price }} {{ DefaultCurrancy()->currancy_code }}
                            </span>
                            <span class="pro-font">{{ $FirstSizeColor?->CalcPrice() }} {{ DefaultCurrancy()->currancy_code }}</span>
                        </p>
                    @else
                        <p class="pro-font">{{ $FirstSizeColor?->price }} {{ DefaultCurrancy()->currancy_code }}</p>
                    @endif
                </div>
                <p  class="text-center">
                    <span class="main_bt transition_me border-0 pro-font rounded py-1 fw-bold px-4 sort dropdown-toggle">{{ __('website.Quickview') }}</span>
                </p>
            </div>
        </div>
    </a>
</div>