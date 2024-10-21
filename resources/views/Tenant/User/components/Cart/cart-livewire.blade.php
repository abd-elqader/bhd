<div>
    
    @if (count($Cart))
        <style>
            .my_border {
                border: 2px solid var(--main--color);
            }
    
    
            .form_input {
                border: 0px;
                border-bottom: 3px solid #0003;
                width: 100%;
                padding: 10px;
                margin: 15px 0px;
                opacity: 0.6;
            }
    
            .option-input {
                -webkit-appearance: none;
                -moz-appearance: none;
                -ms-appearance: none;
                -o-appearance: none;
                appearance: none;
                position: relative;
                top: 13.33333px;
                right: 0;
                bottom: 0;
                left: 0;
                height: 25px;
                width: 25px;
                transition: all 0.15s ease-out 0s;
                background: #cbd1d8;
                border: none;
                color: #fff;
                cursor: pointer;
                display: inline-block;
                margin-right: 0.5rem;
                outline: none;
                position: relative;
                z-index: 1000;
            }
    
            .option-input:hover {
                background: #9faab7;
            }
    
            .option-input.radio {
                border-radius: 50%;
            }
    
            .option-input.radio::after {
                border-radius: 50%;
            }
    
            @keyframes click-wave {
                0% {
                    height: 25px;
                    width: 25px;
                    opacity: 0.35;
                    position: relative;
                }
    
                100% {
                    height: 200px;
                    width: 200px;
                    margin-left: -80px;
                    margin-top: -80px;
                    opacity: 0;
                }
            }
    
        </style>
    
        <div class="place_order my-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="rance">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-2">
                                    <div class="{{ $currentStep >= 1 ? 'main_bg' : 'bg-light' }} mx-auto p-3 font-weight-bold rounded-circle d-flex justify-content-center align-items-center" style="width: 70px; height: 70px">
                                        <h4 class="text-white">1</h4>
                                    </div>
                                    <div class="my-2 text-center">
                                        <h6 class="main_bold text-center" style="min-width:69px;display: inline-block">@lang('messages.Cart')</h6>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="d-none text-line position-relative {{ $currentStep >= 2 ? 'main_bg' : 'bg-dark' }}" style="height: 4px">
                                        <i class="fa-solid fa-chevron-right {{ $currentStep >= 2 ? 'main_color' : '' }}" style="margin-top: -9px;font-size: 20px;right: -12px;position: absolute;"></i>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="{{ $currentStep >= 2 ? 'main_bg' : 'bg-light' }} mx-auto p-3 font-weight-bold rounded-circle d-flex justify-content-center align-items-center" style="width: 70px; height: 70px">
                                        <h4>2</h4>
                                    </div>
                                    <div class="my-2 text-center">
                                        <h6 class="main_bold text-center" style="min-width:69px;display: inline-block">@lang('messages.Payment & Address')</h6>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="d-none  text-line position-relative {{ $currentStep >= 3 ? 'main_bg' : 'bg-dark' }}" style="height: 4px">
                                        <i class="fa-solid fa-chevron-right {{ $currentStep >= 3 ? 'main_color' : '' }}" style="margin-top: -9px;font-size: 20px;right: -12px;position: absolute;"></i>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="{{ $currentStep >= 3 ? 'main_bg' : 'bg-light' }} mx-auto p-3 font-weight-bold rounded-circle d-flex justify-content-center align-items-center" style="width: 70px; height: 70px">
                                        <h4 class="">3</h4>
                                    </div>
                                    <div class="my-2 text-center">
                                        <h6 class="main_bold text-center" style="min-width:69px;display: inline-block">@lang('messages.Confirm Order')</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                        <div class="col-12">
                        
                            <div class="my_border p-3 position-relative rounded">
                          
                                <div class="row align-items-center justify-content-center">
                                    <div class="col  d-none d-md-block">
                                        <h6 class="mb-0 text-center">#</h6>
                                    </div>
                                    <div class="col  d-none d-md-block">
                                        <h6 class="mb-0 text-center">@lang('messages.items')</h6>
                                    </div>
                                    <div class="col  d-none d-md-block">
                                        <h6 class="mb-0 text-center">@lang('messages.Price')</h6>
                                    </div>
                                    <div class="col  d-none d-md-block">
                                        <h6 class="mb-0 text-center">@lang('messages.Quantity')</h6>
                                    </div>
                                    <div class="col  d-none d-md-block">
                                        <h6 class="mb-0 text-center">@lang('messages.Total')</h6>
                                    </div>
                                </div>
                                <hr class="main_bg d-none d-md-block" style="height: 2px; opacity: 1;">
                                <div class="mt-2 in_list_cart">
                                    @foreach ($Cart as $Item)
                                    <div class="row py-4 align-items-center justify-content-center">
                                        <div  class="col-12 col-md-2 text-center">
                                            <img src="{{ $Item['Product']->RandomImage() }}" alt="image" class="img-fluid w-50">
                                        </div>
                                        <div  class="col-12 col-md-3">
                                            <div  class="row">
                                                <div class="col px-0">
                                                    <div class="d-flex align-items-center justify-content-center text-center h-100">
                                                        <div>
                                                            <span class="third_color d-block">{{ $Item['Product']->title() }}</span>
                                                            <div class="d-flex py-1 align-items-center justify-content-center">
                                                                @if ($Item['color_id'])
                                                                <span class="my_color point" style="background-color: {{ $Item['SelectedSizeColor']->Color->hexa }} ;"></span>
                                                                <span class="mx-2 third_color">/</span>
                                                                @endif
                                                                <span class="third_color">{{ $Item['SelectedSizeColor']->Size?->title() }}</span>
                                                            </div>
                                                            <div class="d-flex align-items-center justify-content-center text-danger point delete_cart" wire:click="Delete({{ $Item['id'] ?? 0 }})">
                                                                <i class="fa-solid fa-trash me-1 h5 pb-0"></i>
                                                                <span>@lang('messages.Delete')</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div  class="col-12 col-md-2 my-1">
                                            <div  class="row  text-center mx-auto">
                                                @if ($Item['Product']->HasDiscount())
                                                    <h5 class="col-6 col-md-12  p-0 text-danger mx-auto">{{ $Item['SelectedSizeColor']->CalcPrice() }} {{ DefaultCurrancy()->currancy_code }}</h5>
                                                    <strike class="col-6 col-md-12 p-0 opacity-50">{{ $Item['SelectedSizeColor']->price }} {{ DefaultCurrancy()->currancy_code }}</strike>
                                                @else
                                                    <h5 class="col-12 p-0">{{ $Item['SelectedSizeColor']->CalcPrice() }} {{ DefaultCurrancy()->currancy_code }}</h5>
                                                @endif
                                            </div>
                                        </div>
                                        <div  class="col-12 col-md-5">
                                            <div  class="row">
                                                <div class="col px-0">
                                                    <div class="row justify-content-center">
                                                        <div class="col-12 col-md-10 count px-0">
        
                                                            <div class="row count justify-content-center align-items-center my-3">
        
                                                                <div class="col-3 p-0" wire:click="MINUS({{ $Item['product_id'] }},{{ $Item['size_id'] }},{{ $Item['color_id'] }})">
                                                                    <div class="mx-0 point p-0 w-100 shadow">
                                                                        <div class="w-100 h-100 d-flex justify-content-center align-items-center px-2 py-1 third_bg">
                                                                            <i class="fa-solid fa-minus text-white tiny_font"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
        
                                                                <div class="col-5 px-0">
                                                                    <input type="text" value="{{ $Item['quantity'] }}" class="border-0 h5 pt-2 input_number w-100 text-center">
        
                                                                </div>
        
                                                                <div class="col-3 p-0" wire:click="PLUS({{ $Item['product_id'] }},{{ $Item['size_id'] }},{{ $Item['color_id'] }})">
                                                                    <div class="mx-0 point p-0 w-100 shadow">
                                                                        <div class="w-100 h-100 d-flex justify-content-center align-items-center px-2 py-1 third_bg">
                                                                            <i class="fa-solid fa-plus text-white tiny_font"></i>
                                                                        </div>
                                                                    </div>
        
                                                                </div>
        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col px-0 text-center my-auto">
                                                    <h5>{{ number_format($Item['SelectedSizeColor']->CalcPrice() * $Item['quantity'] , DefaultCurrancy()->decimals )  }} {{ DefaultCurrancy()->currancy_code }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                        </div>
                    
                   
                        <div class="col-12 col-md-8 col-lg-8 cart_confirm">
                            <div class="">
                                <div class="row">
                                    @if(! auth('client')->check())
                                        <div class="my_border p-3 pb-5 mb-4 mt-4 shadow-sm">
                                            <h5 class="capital my-3 fw-normal">@lang('messages.Customer Details')</h5>
                                            <div class="row mt-4 pt-4">
                                                <div class="col-12 col-md-6 my-1">
                                                    <input type="text" class="form_input m-0" wire:model="name" placeholder="@lang('messages.Name')">
                                                    <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="col-12 col-md-6 my-1">
                                                    <div class="position-relative pb-4">
                                                        <select class="form_input m-0" wire:model="SelectedCountry">
                                                            @foreach ($AllCountries as $country)
                                                                <option value="{{ $country->id }}">{{ $country->title() }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger">@error('country'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 my-1">
                                                    <input type="text" class="form_input m-0" wire:model="phone" placeholder="@lang('messages.Mobile')" type="tel" minlength="{{ $phone_length }}" maxlength="{{ $phone_length }}" size="{{ $phone_length }}" >
                                                    <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="col-12 col-md-6 my-1">
                                                    <input type="email" class="form_input m-0" wire:model="email" placeholder="@lang('messages.E-MAIL ADDRESS')">
                                                    <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12 col-md-12 my_border pb-5 shadow-sm rounded ">
                                        <h5 class="capital my-3 fw-normal">@lang('messages.Delivery Information')</h5>
                                        @foreach ($delivries as $method_item)
                                        <div class="input-group my-1">
                                            <div class="input-group-text">
                                                <input class="form-check-input mt-0" name="select_delivry_method" wire:model="delivry_method" type="radio" value="{{ $method_item->id }}">
                                            </div>
                                            <input type="text" class="form-control" style="border: none;background: none" readonly disabled value="{{ $method_item->title() }}">
                                        </div>
                                        @endforeach
                                        @if ($delivry_method && $delivry_method == 1)
        
                                            @if (auth('client')->check())
                                                <h6 class="capital my-3 fw-normal">@lang('messages.Select Address')</h6>
                                                <div class="position-relative pb-4">
                                                    <select class="my_border w-100 px-5 py-3" wire:model="address">
                                                        <option value="0">-----</option>
                                                        @foreach ($addresses as $address)
                                                        <option value="{{ $address->id }}">
                                                            {{ $address->Region->title() }} -
                                                            @lang('website.block'):{{ $address->block }} -
                                                            @if ($address->road)
                                                            @lang('website.road'):{{ $address->road }} -
                                                            @endif
                                                            @if ($address->building_no)
                                                            @lang('messages.Building'):{{ $address->building_no }} -
                                                            @endif
                                                            @if ($address->floor_no)
                                                            @lang('dashboard.floor_no'):{{ $address->floor_no }} -
                                                            @endif
                                                            @if ($address->floor_no)
                                                            @lang('website.apartmentNo'):{{ $address->apartment }} -
                                                            @endif
                                                            {{ $address->type }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <h6 class="capital my-3 fw-normal">@lang('messages.Add New Address')</h6>
                                            @endif
                                            <div class="row mt-4 pt-4">
                                           
                                                <div class="col-12 col-md-6 my-1">
                                                    <div class="position-relative pb-4">
                                                        <label>@lang('dashboard.region')</label>
                                                        <select class="form_input m-0" wire:model="region_id">
                                                            <option value="0">-----</option>
                                                            @if (collect($AllRegions)->count())
                                                                @foreach ($AllRegions as $region)
                                                                <option value="{{ $region->id }}">{{ $region->title() }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <span class="text-danger">@error('region_id'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 my-1">
                                                    <div class="position-relative pb-4">
                                                        <label>@lang('dashboard.city')</label>
                                                        <select class="form_input m-0" wire:model="city_id">
                                                            <option value="0">-----</option>
                                                            @if (collect($AllCities)->count())
                                                                @foreach ($AllCities as $City)
                                                                <option value="{{ $City->id }}">{{ $City->title() }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <span class="text-danger">@error('city_id'){{ $message }}@enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 my-1">
                                                    <label>@lang('website.block')</label>
                                                    <input  type="text" min="1" max="1100" class="form_input m-0" wire:model="block">
                                                    <span class="text-danger">@error('block'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="col-12 col-md-6 my-1">
                                                    <label>@lang('website.road')</label>
                                                    <input  type="number" min="1" max="99999" class="form_input m-0" wire:model="road">
                                                    <span class="text-danger">@error('road'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="col-12 col-md-6 my-1">
                                                    <label>@lang('messages.Building')</label>
                                                    <input type="text" class="form_input m-0" wire:model="building_no">
                                                    <span class="text-danger">@error('building_no'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="col-12 col-md-6 my-1">
                                                    <label>@lang('dashboard.floor_no')  <span class="p-2" style="color:red"> (@lang('website.optional')) </span>  </label>
                                                    <input type="text" class="form_input m-0" wire:model="floor_no">
                                                    <span class="text-danger">@error('floor_no'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="col-12 col-md-6 my-1">
                                                    <label>@lang('dashboard.apartment')  <span class="p-2" style="color:red"> (@lang('website.optional')) </span>  </label>
                                                    <input type="text" class="form_input m-0" wire:model="apartment">
                                                    <span class="text-danger">@error('apartment'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="col-12 col-md-6 my-1">
                                                    <label>@lang('website.flat') @lang('website.Or') @lang('website.office')   <span class="p-2" style="color:red"> (@lang('website.optional')) </span>  </label>
                                                    <input type="text" class="form_input m-0" wire:model="type">
                                                    <span class="text-danger">@error('type'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="col-12">
                                                    <label>@lang('dashboard.additional_directions')</label>
                                                    <input type="text" class="form_input m-0" wire:model="additional_directions">
                                                    <span class="text-danger">@error('additional_directions'){{ $message }}@enderror</span>
                                                </div>
                                            </div>
                                        @elseif($delivry_method && $delivry_method == 2)
                                            <h6 class="capital my-3 fw-normal">@lang('messages.branch')</h6>
                                            <div class="position-relative pb-4">
                                                <select class="form_input m-0" wire:model="branch">
                                                    <option value="0">-----</option>
                                                    @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->title() }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">@error('branch'){{ $message }}@enderror</span>
                                            </div>
                                        @endif
                                 
                                    </div>
                                </div>
                                <div class="row rounded my_border p-3 my-3">
                                    <div class="col-12">
                                        <label>@lang('website.note')</label>
                                        <input type="text" class="form_input m-0" wire:model="note">
                                        <span class="text-danger">@error('note'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                    
    
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="my-4">
                                <div class="row">
                                    @foreach ($payments as $payment)
                                        <div class=" col-6 my-3">
                                            <div class="rounded my_border h-100  position-relative text-center d-flex justify-content-center align-items-center py-2"> 
                                                <label>
                                                    <input type="radio" wire:model="payment" id="payment-{{ $payment->id }}" value="{{ $payment->id }}" class="radio mx-2" name="payment" />
                                                </label>
                                                <div>
                                                    <label  for="payment-{{ $payment->id }}">
                                                        <img src="{{ $payment->Images->first()?->image }}" style="max-width: 100px;max-height: 50px;" alt="image" class="img-fluid">
                                                    </label>
                                                    <label class="text-center" for="payment-{{ $payment->id }}" style="width: 150px;">{{ $payment->title() }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <div class="my_border p-3 my-3">
                                    <h5 class="capital fw-normal">@lang('website.HaveAnCoupon')</h5>
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="text" class="form_input m-0" wire:model="code" placeholder="@lang('messages.code')">
                                            <span class="text-danger">@error('code'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-12 mx-auto text-center">
                                            <button class="bt_details_reverce transition_me w-50 py-3 border-0 rounded" wire:click="SubmitCouponCode">@lang('messages.Submit')</button>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="my_border p-1 {{ $delivry_method && $delivry_method == 2 ? 'd-none' : '' }}">
                                    <div class="row">
                                       <div class="col-12">
                                            @include('Tenant.User.components.map')
                                            @if($distance)
                                            <br>
                                            <p>@lang('messages.distance'):  {{ number_format($distance, 4, '.', '') }} KM</p>
                                            <p>@lang('dashboard.delivery_cost'):  {{ number_format($delivery_cost , DefaultCurrancy()->decimals) }} {{ DefaultCurrancy()->currancy_code }}</p>
                                            @endif
                                            
                                            <span class="text-danger">@error('latitude'){{ $message }}@enderror , @error('longitude'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                        
                        
                        <div class="row my-2">
                            <div class="rounded my_border p-3">
                                <h4 class="py-3">@lang('messages.Summary')</h4>
                                @if ($SubTotal)
                                <div class="d-flex align-items-center justify-content-between my-2">
                                    <span>@lang('messages.Sub Total :')</span>
                                    <span>{{ number_format($SubTotal , DefaultCurrancy()->decimals) }} {{ DefaultCurrancy()->currancy_code }}</span>
                                </div>
                                @endif
                                @if ($Discount > 0)
                                <div class="d-flex align-items-center justify-content-between my-2">
                                    <span>@lang('messages.Discount')({{ setting('discount') }}%)</span>
                                    <span>{{ number_format($Discount , DefaultCurrancy()->decimals) }} {{ DefaultCurrancy()->currancy_code }}</span>
                                </div>
                                @endif
                                @if ($coupon > 0)
                                <div class="d-flex align-items-center justify-content-between my-2">
                                    <span>@lang('website.coupon')</span>
                                    <span>{{ number_format($coupon , DefaultCurrancy()->decimals) }} {{ DefaultCurrancy()->currancy_code }}</span>
                                </div>
                                @endif
                                @if ($delivery_cost > 0)
                                <div class="d-flex align-items-center justify-content-between my-2">
                                    <span>@lang('dashboard.delivery_cost')</span>
                                    <span>{{ number_format($delivery_cost , DefaultCurrancy()->decimals) }} {{ DefaultCurrancy()->currancy_code }}</span>
                                </div>
                                @endif
                                @if ($Vat > 0)
                                <div class="d-flex align-items-center justify-content-between my-2">
                                    <span>@lang('dashboard.VAT') ({{ setting('VAT') }}%)</span>
                                    <span>{{ number_format($Vat , DefaultCurrancy()->decimals) }} {{ DefaultCurrancy()->currancy_code }}</span>
                                </div>
                                @endif
                                @if ($OnlineVat)
                                <div class="d-flex align-items-center justify-content-between my-2">
                                    <span>@lang('dashboard.OnlineVat')</span>
                                    <span>{{ number_format($OnlineVat , DefaultCurrancy()->decimals) }} {{ DefaultCurrancy()->currancy_code }}</span>
                                </div>
                                @endif
                                @if ($NetTotal)
                                <div class="d-flex align-items-center justify-content-between my-2">
                                    <span>@lang('messages.Net Total :')</span>
                                    <span>{{ number_format($NetTotal , DefaultCurrancy()->decimals) }} {{ DefaultCurrancy()->currancy_code }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row d-flex justify-content-between my-2">
                            <button wire:loading.attr="disabled" class="bt_details_reverce transition_me w-50 py-3 border-0 rounded" wire:click="confirmOrder">
                                <i class="fa fa-cog fa-spin mx-2" style="font-size:24px" wire:loading wire:target="confirmOrder"></i>
                                @lang('website.confirmOrder')
                            </button>
                        </div>
                    <hr class="main_bg" style="height: 1px; opacity: 1;">
                </div>
            </div>
        </div>
    @else
    
        <div class="row text-center">
            <img src="{{ public_asset('empty_cart.png') }}" alt="" style="max-height: 400px; width: auto;margin: auto;">
            <h2 class="text-center mx-auto">@lang('messages.Empty Shopping Cart.')</h2>
        </div>
        
    @endif
</div>
