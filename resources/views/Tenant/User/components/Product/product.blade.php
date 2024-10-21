<div>
    @php($Rate = $Product->Rates->avg('rate'))
    
    <style>
        @media only screen and (max-width: 600px){
        	.gallery_img {
        	    display: flex;
        	    overflow-x: auto;
            }
            .gallery_img img {
                padding: 10px;
            }
        }
        .breadcrumb-item{
            font-size:18px;
        }
    </style>
    <div class="categories" style="background: #f6f6f6;">

        <!--<nav aria-label="breadcrumb">-->
        <!--    <ol class="breadcrumb d-flex justify-content-center  mt-2">-->
        <!--        <li class="breadcrumb-item"><a href="/"><i class="fa-solid fa-house-chimney"></i>@lang('messages.home')</a></li>-->
        <!--        <li class="breadcrumb-item"><a href="{{ route('client.categories') }}">@lang('messages.categories')</a></li>-->
        <!--        <li class="breadcrumb-item active second_color" aria-current="page">@lang('dashboard.product')</li>-->
        <!--    </ol>-->
        <!--</nav>-->
        <div class="details my-4">
            <div class="container">
                                <div class="row">

                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb fw-medium">
        <li class="breadcrumb-item "><a class="text-secondary fw-medium" href="/">@lang('messages.home')</a></li>
        <li class="breadcrumb-item "><a class="text-secondary fw-medium" href="{{ route('client.categories') }}">@lang('messages.categories')</a></li>
        <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.product')</li>
      </ol>
    </nav>
    </div>
                <div class="row">
                    <div class="col-12 col-md-7"  wire:ignore>
                        <style>
                       
                        </style>
                       <div class="carouselPro">
                            @foreach ($Product->Images as $ImageItem)
                                <img src="{{ public_asset($ImageItem->image) }}" class="img-fluid d-block mb-3 point" alt="image" style="width: 100%;">
                            @endforeach
                       </div>
                        <script>
                            $('.carouselPro').slick({
                              
                              slidesToScroll: 1,
                              dots: true,
                              infinite: true,
                              speed: 300,
                              centerMode: false,
                              mobileFirst:false,//add this one
                            });
                                 
                        </script>
                    </div>
                    <div class="col-12 col-md-5">
                                                <div class="d-flex justify-content-end ">

                                                                                                @if ($Product->IsFav())
                                            <i wire:click="ToggleLikeProduct" class="mx-2 fa-solid fa-heart text-danger h3 mb-0 point"></i>
                                        @else
                                            <i wire:click="ToggleLikeProduct" class="mx-2 fa-solid fa-heart h3 mb-0 point"></i>
                                        @endif
                                        </div>
                        <div class="m-4">
                                                            <h4 class=" fw-bold">{{ $Product->title() }}</h4>

                            <div class="d-flex align-items-center justify-content-between ">
                                                                    <div  class=""  style="display: flex;justify-content: space-between;align-items: center;">
                                        <!--<label for="quantity" class="col-sm-2 col-form-label">@lang('website.price')</label>-->
                                        @if ($Product->HasDiscount())
                                            <div class="text-center ">
                                                <span class="fs-4 ">{{ $SelectedSizeColor?->CalcPrice() }} {{ DefaultCurrancy()->currancy_code }}</span>
                                                <span class="text-decoration-line-through">{{ $SelectedSizeColor?->Price() }}</span>
                                            </div>
                                        @else
                                            <div>
                                                <span class="fs-4 ">{{ $SelectedSizeColor?->CalcPrice() }} {{ DefaultCurrancy()->currancy_code }}</span>
                                            </div>
                                        @endif
                                                                        <div class="text-{{ lang('en') ? 'end' : 'start' }}">
                                    @if ($Rate)
                                        <ul class="list-unstyled d-flex align-items-center my-3 point" onclick="window.location.href='#reviews'">
                                            <li class=""><i class="fa-regular fa-star {{ $Rate >= 1 ? 'text-warning' : '' }}"></i></li>
                                            <li class=""><i class="fa-regular fa-star {{ $Rate >= 2 ? 'text-warning' : '' }}"></i></li>
                                            <li class=""><i class="fa-regular fa-star {{ $Rate >= 3 ? 'text-warning' : '' }}"></i></li>
                                            <li class=""><i class="fa-regular fa-star {{ $Rate >= 4 ? 'text-warning' : '' }}"></i></li>
                                            <li class=""><i class="fa-regular fa-star {{ $Rate >= 5 ? 'text-warning' : '' }}"></i></li>
                                        </ul>
                                    @endif
                                </div>
                                    </div>

                            </div>

                            @if ( strip_tags($Product->desc()) )
                                <div class="my-3">
                                    <p class="h4">@lang('messages.description')</p>
                                    {!! $Product->desc() !!}
                                </div>
                            @endif


                            <div class="my-4" style="padding: 20px !important;border: 0;box-shadow: 0px 3px 8px -3px #00000029;border-radius: 15px;">

                                @if($SizeColor->unique('size_id')->count() > 1)
                                    <div class="size d-flex align-items-center">
                                        @foreach ($SizeColor->unique('size_id')->chunk(4) as $SizeItems)
                                            <div class="row">
                                                @foreach ($SizeItems as $SizeItem)
                                                    <span wire:click="$set('SelectedSize',{{ $SizeItem->Size?->id }})" style="max-width: fit-content;" class="mx-1 in_size {{ $SizeItem->size_id == $SelectedSize ? 'active' : '' }}">{{ $SizeItem->Size?->title() }}</span>    
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if ($SizeColor->whereNotNULL('color_id')->unique('color_id')->count() > 1)
                                    <ul class="in_details list-unstyled d-flex align-items-center">
                                        @foreach ($SizeColor->where('size_id',$SelectedSize)->unique('color_id') as $ColorItem)
                                        <li class="mx-2 {{ $ColorItem->color_id == $SelectedColor ? 'active' : '' }}">
                                            <span wire:click="$set('SelectedColor',{{ $ColorItem->color_id }})" class="my_color_2 point" style="background-color: {{ $ColorItem->Color?->hexa }};"></span>
                                        </li>
                                        @endforeach
                                    </ul>
                                @endif
                                
                                
                                @if ($SelectedSizeColor?->status == 1 && $SelectedSizeColor?->quantity > 0)

                                    
                                    <div class="add_cart my-3 gap-2" style="display: flex;align-items: center;">

                                        <div class="qty text-center rounded-pill px-2 " style="width: 150px;border: 1px solid #CCC;border-radius: 9px;    display: flex;justify-content: space-evenly;">
                                            <span class="minus" wire:click="qtyminus">-</span>
                                            <input type="number" class="count text-center" value="{{ $quantity }}" disabled>
                                            <span class="plus" wire:click="qtyPlus">+</span>
                                        </div>
                                        <button wire:click="AddToCart"  class="bt_details transition_me w-100 py-2 border-0 rounded-pill">@lang('website.addToCart')</button>
                                    </div>
                                @else
                                    <div class="add_cart my-3">
                                        <button class="w-100 py-3 border-0 rounded">@lang('messages.Sold Out')</button>
                                    </div>
                                @endif
                            </div>




                        </div>
                    </div>
                </div>
                @if ($similar->count())

                <div class="offers my-5" wire:ignore>
                    <div class="selling">
                        <div class="container">
                            <div class="section_them_two my-4">
                                <div class="py-4">
                                    <h2 class="fw-bold text-center">{{ __('website.relatedProducts') }}</h2>
                                </div>
                                <div class="relatedProducts">
                                    @foreach($similar as  $product)
                                    <div>
                                        @include('Tenant.User.components.SingleProducts.'.$product_page_num,['product'=>$product,'Col' =>'mx-2 single_product_design'])
                                    </div>
                                    @endforeach
                                </div>
                                <script>
                                    $('.relatedProducts').slick({
                                      
                                      slidesToScroll: 1,
                                      dots: true,
                                      infinite: true,
                                      speed: 300,
                                      centerMode: true,
                                      mobileFirst:true,//add this one
                                      variableWidth: true
                                    });
                                         
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="my-4" id="reviews"  wire:ignore>
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="me-5">@lang('website.Reviews')</h5>
                        <a class="my-2 px-4 text-decoration-none py-2 main_bottom transition_me d-flex align-items-center justify-content-center review point h3"><i class="fa-solid fa-comment me-1 main_color"></i><span class="tiny_font me-2" data-bs-toggle="modal" data-bs-target="#RateModal">@lang('website.addReview')</span></a>
                    </div>
                    <div class="d-flex align-items-center my-3">
                        <ul class="list-unstyled d-flex align-items-center me-4">
                            <li class=""><i class="fa-regular fa-star h3 point mb-0 {{ $Rate >= 1 ? 'text-warning' : '' }}"></i></li>
                            <li class=""><i class="fa-regular fa-star h3 point mb-0 {{ $Rate >= 2 ? 'text-warning' : '' }}"></i></li>
                            <li class=""><i class="fa-regular fa-star h3 point mb-0 {{ $Rate >= 3 ? 'text-warning' : '' }}"></i></li>
                            <li class=""><i class="fa-regular fa-star h3 point mb-0 {{ $Rate >= 4 ? 'text-warning' : '' }}"></i></li>
                            <li class=""><i class="fa-regular fa-star h3 point mb-0 {{ $Rate >= 5 ? 'text-warning' : '' }}"></i></li>
                        </ul>
                        <p>({{ number_format($Rate, 1, ',', ' ') }})</p>
                    </div>
                </div>
                <div  wire:ignore>
                    @foreach ($Product->Rates as $Rate)
                    <hr class="third_bg">
                    <div class="my-4">
                        <span class="tiny_font d-block mt-2">{{ $Rate->created_at }}</span>
                        <ul class="list-unstyled d-flex align-items-center my-0">
                            <li class=""><i class="fa-regular fa-star h6 point mb-0 {{ $Rate->rate >= 1 ? 'text-warning' : '' }}"></i></li>
                            <li class=""><i class="fa-regular fa-star h6 point mb-0 {{ $Rate->rate >= 2 ? 'text-warning' : '' }}"></i></li>
                            <li class=""><i class="fa-regular fa-star h6 point mb-0 {{ $Rate->rate >= 3 ? 'text-warning' : '' }}"></i></li>
                            <li class=""><i class="fa-regular fa-star h6 point mb-0 {{ $Rate->rate >= 4 ? 'text-warning' : '' }}"></i></li>
                            <li class=""><i class="fa-regular fa-star h6 point mb-0 {{ $Rate->rate >= 5 ? 'text-warning' : '' }}"></i></li>
                        </ul>
                        <h5 class="d-block mb-2">{{ $Rate->Client ? $Rate->Client->name : '' }}</h5>
                        <span class="d-block my-2">{{ $Rate->comment }}</span>
                    </div>
                    @endforeach
                </div>
                <link rel="stylesheet" href="{{ public_asset('Tenant/css/rating.css') }}">

                <div  wire:ignore class="modal fade p-0" id="RateModal" tabindex="-1" aria-labelledby="RateModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex justify-content-center align-items-center h-100">
                                    <div class="insert bg-white d-flex justify-content-center align-items-center p-4">
                                        <div class="w-100 h-100 p-4">
                                            <span class="text-center d-block mb-4">
                                                @lang('website.addReview')
                                            </span>
                                            <form action="{{ route('client.addReview') }}" method="post" style="display: contents">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $Product->id }}">
                                                <div class="rating">
                                                    <input type="radio" name="rate" id="rating-5" value="5"> <label for="rating-5"></label>
                                                    <input type="radio" name="rate" id="rating-4" value="4"> <label for="rating-4"></label>
                                                    <input type="radio" name="rate" id="rating-3" value="3"> <label for="rating-3"></label>
                                                    <input type="radio" name="rate" id="rating-2" value="2"> <label for="rating-2"></label>
                                                    <input type="radio" name="rate" id="rating-1" value="1"> <label for="rating-1"></label>
                                                    <div class="emoji-wrapper">
                                                        <div class="emoji">
                                                            <svg class="rating-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                                                <path d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z" fill="#f4c534" />
                                                                <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318" cy="199.829" rx="56.146" ry="56.13" fill="#fff" />
                                                                <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822" rx="28.048" ry="28.08" fill="#3e4347" />
                                                                <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993" rx="8.016" ry="5.296" fill="#5a5f63" />
                                                                <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695" cy="199.819" rx="56.146" ry="56.13" fill="#fff" />
                                                                <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84" rx="28.048" ry="28.08" fill="#3e4347" />
                                                                <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794" cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63" />
                                                                <path d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z" fill="#3e4347" />
                                                            </svg>
                                                            <svg class="rating-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                                                <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534" />
                                                                <path d="M328.4 428a92.8 92.8 0 0 0-145-.1 6.8 6.8 0 0 1-12-5.8 86.6 86.6 0 0 1 84.5-69 86.6 86.6 0 0 1 84.7 69.8c1.3 6.9-7.7 10.6-12.2 5.1z" fill="#3e4347" />
                                                                <path d="M269.2 222.3c5.3 62.8 52 113.9 104.8 113.9 52.3 0 90.8-51.1 85.6-113.9-2-25-10.8-47.9-23.7-66.7-4.1-6.1-12.2-8-18.5-4.2a111.8 111.8 0 0 1-60.1 16.2c-22.8 0-42.1-5.6-57.8-14.8-6.8-4-15.4-1.5-18.9 5.4-9 18.2-13.2 40.3-11.4 64.1z" fill="#f4c534" />
                                                                <path d="M357 189.5c25.8 0 47-7.1 63.7-18.7 10 14.6 17 32.1 18.7 51.6 4 49.6-26.1 89.7-67.5 89.7-41.6 0-78.4-40.1-82.5-89.7A95 95 0 0 1 298 174c16 9.7 35.6 15.5 59 15.5z" fill="#fff" />
                                                                <path d="M396.2 246.1a38.5 38.5 0 0 1-38.7 38.6 38.5 38.5 0 0 1-38.6-38.6 38.6 38.6 0 1 1 77.3 0z" fill="#3e4347" />
                                                                <path d="M380.4 241.1c-3.2 3.2-9.9 1.7-14.9-3.2-4.8-4.8-6.2-11.5-3-14.7 3.3-3.4 10-2 14.9 2.9 4.9 5 6.4 11.7 3 15z" fill="#fff" />
                                                                <path d="M242.8 222.3c-5.3 62.8-52 113.9-104.8 113.9-52.3 0-90.8-51.1-85.6-113.9 2-25 10.8-47.9 23.7-66.7 4.1-6.1 12.2-8 18.5-4.2 16.2 10.1 36.2 16.2 60.1 16.2 22.8 0 42.1-5.6 57.8-14.8 6.8-4 15.4-1.5 18.9 5.4 9 18.2 13.2 40.3 11.4 64.1z" fill="#f4c534" />
                                                                <path d="M155 189.5c-25.8 0-47-7.1-63.7-18.7-10 14.6-17 32.1-18.7 51.6-4 49.6 26.1 89.7 67.5 89.7 41.6 0 78.4-40.1 82.5-89.7A95 95 0 0 0 214 174c-16 9.7-35.6 15.5-59 15.5z" fill="#fff" />
                                                                <path d="M115.8 246.1a38.5 38.5 0 0 0 38.7 38.6 38.5 38.5 0 0 0 38.6-38.6 38.6 38.6 0 1 0-77.3 0z" fill="#3e4347" />
                                                                <path d="M131.6 241.1c3.2 3.2 9.9 1.7 14.9-3.2 4.8-4.8 6.2-11.5 3-14.7-3.3-3.4-10-2-14.9 2.9-4.9 5-6.4 11.7-3 15z" fill="#fff" />
                                                            </svg>
                                                            <svg class="rating-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                                                <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534" />
                                                                <path d="M336.6 403.2c-6.5 8-16 10-25.5 5.2a117.6 117.6 0 0 0-110.2 0c-9.4 4.9-19 3.3-25.6-4.6-6.5-7.7-4.7-21.1 8.4-28 45.1-24 99.5-24 144.6 0 13 7 14.8 19.7 8.3 27.4z" fill="#3e4347" />
                                                                <path d="M276.6 244.3a79.3 79.3 0 1 1 158.8 0 79.5 79.5 0 1 1-158.8 0z" fill="#fff" />
                                                                <circle cx="340" cy="260.4" r="36.2" fill="#3e4347" />
                                                                <g fill="#fff">
                                                                    <ellipse transform="rotate(-135 326.4 246.6)" cx="326.4" cy="246.6" rx="6.5" ry="10" />
                                                                    <path d="M231.9 244.3a79.3 79.3 0 1 0-158.8 0 79.5 79.5 0 1 0 158.8 0z" />
                                                                </g>
                                                                <circle cx="168.5" cy="260.4" r="36.2" fill="#3e4347" />
                                                                <ellipse transform="rotate(-135 182.1 246.7)" cx="182.1" cy="246.7" rx="10" ry="6.5" fill="#fff" />
                                                            </svg>
                                                            <svg class="rating-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                                                <path d="M407.7 352.8a163.9 163.9 0 0 1-303.5 0c-2.3-5.5 1.5-12 7.5-13.2a780.8 780.8 0 0 1 288.4 0c6 1.2 9.9 7.7 7.6 13.2z" fill="#3e4347" />
                                                                <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534" />
                                                                <g fill="#fff">
                                                                    <path d="M115.3 339c18.2 29.6 75.1 32.8 143.1 32.8 67.1 0 124.2-3.2 143.2-31.6l-1.5-.6a780.6 780.6 0 0 0-284.8-.6z" />
                                                                    <ellipse cx="356.4" cy="205.3" rx="81.1" ry="81" />
                                                                </g>
                                                                <ellipse cx="356.4" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347" />
                                                                <g fill="#fff">
                                                                    <ellipse transform="scale(-1) rotate(45 454 -906)" cx="375.3" cy="188.1" rx="12" ry="8.1" />
                                                                    <ellipse cx="155.6" cy="205.3" rx="81.1" ry="81" />
                                                                </g>
                                                                <ellipse cx="155.6" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347" />
                                                                <ellipse transform="scale(-1) rotate(45 454 -421.3)" cx="174.5" cy="188" rx="12" ry="8.1" fill="#fff" />
                                                            </svg>
                                                            <svg class="rating-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                                                <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534" />
                                                                <path d="M232.3 201.3c0 49.2-74.3 94.2-74.3 94.2s-74.4-45-74.4-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b" />
                                                                <path d="M96.1 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2C80.2 229.8 95.6 175.2 96 173.3z" fill="#d03f3f" />
                                                                <path d="M215.2 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff" />
                                                                <path d="M428.4 201.3c0 49.2-74.4 94.2-74.4 94.2s-74.3-45-74.3-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b" />
                                                                <path d="M292.2 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2-77.8-65.7-62.4-120.3-61.9-122.2z" fill="#d03f3f" />
                                                                <path d="M411.3 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff" />
                                                                <path d="M381.7 374.1c-30.2 35.9-75.3 64.4-125.7 64.4s-95.4-28.5-125.8-64.2a17.6 17.6 0 0 1 16.5-28.7 627.7 627.7 0 0 0 218.7-.1c16.2-2.7 27 16.1 16.3 28.6z" fill="#3e4347" />
                                                                <path d="M256 438.5c25.7 0 50-7.5 71.7-19.5-9-33.7-40.7-43.3-62.6-31.7-29.7 15.8-62.8-4.7-75.6 34.3 20.3 10.4 42.8 17 66.5 17z" fill="#e24b4b" />
                                                            </svg>
                                                            <svg class="rating-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <g fill="#ffd93b">
                                                                    <circle cx="256" cy="256" r="256" />
                                                                    <path d="M512 256A256 256 0 0 1 56.8 416.7a256 256 0 0 0 360-360c58 47 95.2 118.8 95.2 199.3z" />
                                                                </g>
                                                                <path d="M512 99.4v165.1c0 11-8.9 19.9-19.7 19.9h-187c-13 0-23.5-10.5-23.5-23.5v-21.3c0-12.9-8.9-24.8-21.6-26.7-16.2-2.5-30 10-30 25.5V261c0 13-10.5 23.5-23.5 23.5h-187A19.7 19.7 0 0 1 0 264.7V99.4c0-10.9 8.8-19.7 19.7-19.7h472.6c10.8 0 19.7 8.7 19.7 19.7z" fill="#e9eff4" />
                                                                <path d="M204.6 138v88.2a23 23 0 0 1-23 23H58.2a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#45cbea" />
                                                                <path d="M476.9 138v88.2a23 23 0 0 1-23 23H330.3a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#e84d88" />
                                                                <g fill="#38c0dc">
                                                                    <path d="M95.2 114.9l-60 60v15.2l75.2-75.2zM123.3 114.9L35.1 203v23.2c0 1.8.3 3.7.7 5.4l116.8-116.7h-29.3z" />
                                                                </g>
                                                                <g fill="#d23f77">
                                                                    <path d="M373.3 114.9l-66 66V196l81.3-81.2zM401.5 114.9l-94.1 94v17.3c0 3.5.8 6.8 2.2 9.8l121.1-121.1h-29.2z" />
                                                                </g>
                                                                <path d="M329.5 395.2c0 44.7-33 81-73.4 81-40.7 0-73.5-36.3-73.5-81s32.8-81 73.5-81c40.5 0 73.4 36.3 73.4 81z" fill="#3e4347" />
                                                                <path d="M256 476.2a70 70 0 0 0 53.3-25.5 34.6 34.6 0 0 0-58-25 34.4 34.4 0 0 0-47.8 26 69.9 69.9 0 0 0 52.6 24.5z" fill="#e24b4b" />
                                                                <path d="M290.3 434.8c-1 3.4-5.8 5.2-11 3.9s-8.4-5.1-7.4-8.7c.8-3.3 5.7-5 10.7-3.8 5.1 1.4 8.5 5.3 7.7 8.6z" fill="#fff" opacity=".2" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group my-1">
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"></textarea>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="bt_details transition_me w-100 py-2 border-0 rounded">@lang('messages.Submit')</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
