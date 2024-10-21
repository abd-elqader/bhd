@php($FirstSizeColor = $product->SizeColor->SortBy('price')->first())
<style>
    @media (min-width: 575.98px) {
        .pro-img{
            height: 250px;
        }
        .pro-font{
            font-size: 16px;
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
        .single_product_design{
            max-width: 150px;
        }
    }
</style>
<div class="{{ isset($Col) ? $Col : 'col-6 col-md-6 col-lg-4' }} my-3" style="{{ isset($style) ? $style : '' }}">
    <div onclick="location.href='{{route('client.product', $product->id)}}'" style="text-decoration: none; color: black;" class="h-100">
        <figure class="{{ $FirstSizeColor?->hasDiscount() ? 'discountttt' : '' }} point h-100 "  style="box-shadow: rgba(136, 165, 191, 0.48) 6px 2px 16px 0px, rgba(255, 255, 255, 0.8) -6px -2px 16px 0px;">
            <div class="d-flex justify-content-center text-center overflow-hidden">
                <img src="{{ public_asset($product->RandomImage()) }}" alt="MostsellingImage" class="m-auto pro-img rounded-2">
                @if ($FirstSizeColor?->hasDiscount())
                    <i class="fa-solid fa-tags h3 point second_color"></i>
                @endif
            </div>
            <figcaption style="padding-bottom: 10px;direction:{{ lang('en') ? 'ltr' : 'rtl' }};text-align: {{ lang('en') ? 'left' : 'right' }};">
                <div class="overflow-hidden text-center pro-font" style="height: 35px;">
				    <p>{{ mb_strimwidth($product->title(), 0, 40, "...") }}</p>
                </div>
                <div class="text-center ltr">
                    @if ($FirstSizeColor?->hasDiscount())
                        <p> 
                            <span class="pro-font2 text-decoration-line-through text-danger">
                                {{ $FirstSizeColor->price }} {{ DefaultCurrancy()->currancy_code }}
                            </span>
                            <span class="pro-font">{{ $FirstSizeColor->CalcPrice() }} {{ DefaultCurrancy()->currancy_code }}</span>
                        </p>
                    @else
                        <p class="pro-font">{{ $FirstSizeColor?->price }} {{ DefaultCurrancy()->currancy_code }}</p>
                    @endif
                </div>
            </figcaption>
        </figure>
    </div>
</div>