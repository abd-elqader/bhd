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
<div class="{{ isset($Col) ? $Col : 'col-6 col-md-6 col-lg-4 col-xl-3' }}" style="{{ isset($style) ? $style : '' }}">
    <a href="{{route('client.product', $product->id)}}" style="text-decoration: none; color: black;">
        <div class="thumb-wrapper position-relative">
			<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
			<div class="img-box d-flex justify-content-center">
				<img src="{{ public_asset($product->RandomImage()) }}" class="img-responsive pro-img" style="max-width: 100%;" alt="">
			</div>
			<div class="thumb-content text-center pro-font">
				<p style="height: 30px;" class="mt-2">{{ mb_strimwidth($product->title(), 0, 60, "...") }}</p>
				@if ($FirstSizeColor?->hasDiscount())
                    <p  style="direction: ltr;"> 
                        <span class="pro-font2 text-decoration-line-through text-danger" style="right: 65px">
                            {{ $FirstSizeColor?->price }} {{ DefaultCurrancy()->currancy_code }}
                        </span>
                        <span class="pro-font">{{ $FirstSizeColor?->CalcPrice() }} {{ DefaultCurrancy()->currancy_code }}</span>
                    </p>
                @else
                    <p style="direction: ltr;">
                        <span class="pro-font">
                            {{ $FirstSizeColor?->price }} {{ DefaultCurrancy()->currancy_code }}
                        </span>
                    </p>
                @endif
			    @php ($Rate = $product->Rates->avg('rate'))
			    @if ($Rate)
                <ul class="list-unstyled d-flex my-3 point position-absolute" style="top: 20px;background: #fff;right: 0px;" onclick="window.location.href='#reviews'">
                    <li class=""><i class="fa-regular fa-star {{ $Rate >= 1 ? 'text-warning' : '' }}"></i></li>
                    <li class=""><i class="fa-regular fa-star {{ $Rate >= 2 ? 'text-warning' : '' }}"></i></li>
                    <li class=""><i class="fa-regular fa-star {{ $Rate >= 3 ? 'text-warning' : '' }}"></i></li>
                    <li class=""><i class="fa-regular fa-star {{ $Rate >= 4 ? 'text-warning' : '' }}"></i></li>
                    <li class=""><i class="fa-regular fa-star {{ $Rate >= 5 ? 'text-warning' : '' }}"></i></li>
                </ul>
                @endif
				<a href="{{ route('addToCart',['product_id' => $FirstSizeColor?->product_id,'quantity' => 1,'color_id' => $FirstSizeColor?->color_id,'size_id' => $FirstSizeColor?->size_id]) }}" class="pro-font btn main_btn py-2">@lang('website.addToCart')</a>
			</div>						
		</div>
    </a>
</div>