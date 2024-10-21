@php($FirstSizeColor = $product->SizeColor->SortBy('price')->first())
<style>
    @media (min-width: 575.98px) {
        .pro-img {
            height: 300px;
            overflow: hidden;
        }

        .pro-font {
            font-size: 22px;
            font-weight: 400;

        }
    }

    @media (max-width: 575.98px) {

        .pro-font {
            font-size: 11px;
        }

        .pro-font2 {
            font-size: 10px;
        }

        .pro-img {
            height: 100px;
            overflow: hidden;
        }

        .single_product_design {
            max-width: 150px;
        }
    }
</style>
<div class="{{ isset($Col) ? $Col : 'col-6 col-md-6 col-lg-4' }} position-relative"
    style="{{ isset($style) ? $style : '' }}">
    @if ($FirstSizeColor?->hasDiscount())
        <div class="position-absolute best-sell py-3 px-2 start-0">
            <div class="rounded-pill bg-dark   text-white d-flex px-3 py-1 align-items-center gap-1  ">
                <span> {{ $FirstSizeColor?->price }}</span>
            </div>
        </div>
    @endif
    <div class="my_last_offer in_offer second_bg">
        <div class="d-flex justify-content-center point pro-img rounded-3">
            <img onclick="location.href='{{ route('client.product', $product->id) }}'" src="{{ public_asset($product->RandomImage()) }}" class="w-100 p-0 img-fluid m-auto  rounded-3" alt="image">
        </div>
        <div class="details p-2">
            <p onclick="location.href='{{ route('client.product', $product->id) }}'" class="point"> {{ mb_strimwidth($product->title(), 0, 35, '...') }}</p>
            <div style="width: max-content;" style="font-size:14px">
                @if ($FirstSizeColor?->hasDiscount())
                    <p>
                        <span class="fw-bold text-black-50 text-decoration-line-through"> {{ $FirstSizeColor?->price }}
                        </span>
                        <span class="fw-bold">{{ $FirstSizeColor?->CalcPrice() }} {{ DefaultCurrancy()->currancy_code }}</span>
                    </p>
                @else
                    <p class="fw-bold" style="font-size:14px">{{ $FirstSizeColor?->price }} {{ DefaultCurrancy()->currancy_code }}</p>
                @endif
            </div>
            <div class="ltr">
                <!--<div class="row d-flex align-items-center justify-content-center ">-->
                <!--    <div class="col-12 ">-->

                <!--    </div>-->
                <!--    <div class="col-3 pt-1">-->
                <!--        <span class="our_opacity text-secondary d-flex justify-content-center align-items-center">-->
                <!--            | <i class="fa-solid fa-cart-plus point mx-2" onclick="location.href='{{ route('addToCart', ['product_id' => $FirstSizeColor?->product_id, 'quantity' => 1, 'color_id' => $FirstSizeColor?->color_id, 'size_id' => $FirstSizeColor?->size_id]) }}'"></i>-->
                <!--        </span>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
