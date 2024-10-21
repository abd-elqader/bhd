<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js" type="text/javascript"></script>
<div class="profile my-4">
    <div class="container">

        <div class="p-3">
            <h2 class="main_bold {{ lang() == 'ar' ? 'text-right' : '' }}">@lang('website.myProfile')</h2>
        </div>
        <hr class="text-dark border-dark">
        <div class="row">
            <div class="col-12 col-md-3 {{ lang() == 'ar' ? 'text-right' : '' }}">
                <div class="nav flex-column nav-pills m-2 py-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="bt_details_reverce transition_me w-100 py-3 border-0 rounded {{ $section == 'index' ? 'active' : '' }}" id="v-pills-info-tab" data-toggle="pill" href="#v-pills-info" role="tab" aria-controls="v-pills-info" aria-selected="true">@lang('website.accountInfo')</button>
                    <button class="bt_details_reverce transition_me w-100 py-3 border-0 rounded {{ $section == 'address' ? 'active' : '' }}" id="v-pills-addresses-tab" data-toggle="pill" href="#v-pills-addresses" role="tab" aria-controls="v-pills-addresses" aria-selected="false">@lang('website.myAddresses')</button>
                    <button class="bt_details_reverce transition_me w-100 py-3 border-0 rounded {{ $section == 'orders' ? 'active' : '' }}" id="v-pills-orders-tab" data-toggle="pill" href="#v-pills-orders" role="tab" aria-controls="v-pills-orders" aria-selected="false">@lang('website.myOrder')</button>
                    <button class="bt_details_reverce transition_me w-100 py-3 border-0 rounded {{ $section == 'fav' ? 'active' : '' }}" id="v-pills-favourites-tab" data-toggle="pill" href="#v-pills-favourites" role="tab" aria-controls="v-pills-favourites" aria-selected="false">@lang('website.myFavourite')</button>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <div class="tab-content m-2" id="v-pills-tabContent">

                    <div class="tab-pane {{ $section == 'index' ? 'show active' : '' }}" id="v-pills-info" role="tabpanel" aria-labelledby="v-pills-info-tab">

                        <div class="row">
                            <form method="POST" action="{{ route('client.profile',1) }}" class="{{ lang() == 'ar' ? 'text-right' : '' }}">
                                @csrf
                                <div class="my-2 px-1 col-12 col-md-6">
                                    <label for="name" class="main_bold p-1">@lang('website.name')</label>
                                    <input type="text" name="name" class="form-control rounded w-100 border" id="name" placeholder="@lang('website.name')" value="{{ auth('client')->user()->name }}">
                                </div>

                                <div class="my-2 px-1 col-12 col-md-6">
                                    <label for="email" class="main_bold p-1">@lang('website.email')</label>
                                    <input type="email" name="email" class="form-control rounded w-100 border" id="email" placeholder="@lang('website.email')" value="{{ auth('client')->user()->email }}">
                                </div>
                                <div class="my-2 px-1 col-12 col-md-6">
                                    <label for="password" class="main_bold p-1">@lang('website.password') <i class="fa-solid fa-pencil h5 main_text"></i></label>
                                    <input type="password" name="password" class="form-control rounded w-100 border" id="password" placeholder="@lang('website.password')">
                                </div>
                                <div class="my-2 px-1 col-12 text-center">
                                    <button class="bt_details transition_me w-50 py-3 border-0 rounded">@lang('website.update')</button>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="tab-pane {{ $section == 'address' ? 'show active' : '' }}" id="v-pills-addresses" role="tabpanel" aria-labelledby="v-pills-addresses-tab">

                        <div class="row my-4">
                            @if(count(auth('client')->user()->addresses) > 0)
                            <div class="col-12">
                                @foreach(auth('client')->user()->addresses as $address)
                                <div class="bg-light p-3 rounded mb-4 {{ lang() == 'ar' ? 'text-right' : '' }}">
                                    <ul class="my-3 list-unstyled">
                                        <li class="row my-3">

                                            @php($country_id = $address->region['country_id'])
                                            <p class="col-12 col-md-6">
                                                @lang('dashboard.country')
                                                :
                                                {{ $address->region->Country['title_' . lang()] }}
                                            </p>
                                            <p class="col-12 col-md-6">
                                                @if($country_id != 2)
                                                    @lang('website.city')
                                                @else
                                                    @lang('website.region')
                                                @endif
                                                :
                                                {{ $address->region['title_' . lang()] }}
                                            </p>
                                            <p class="col-12 col-md-6">
                                                @if($country_id != 2)
                                                    @lang('website.district')
                                                @else
                                                    @lang('website.block')
                                                @endif
                                                :
                                                {{ $address['block'] }}
                                            </p>
                                            <p class="col-12 col-md-6">
                                                @if($country_id != 2)
                                                    @lang('website.street')
                                                @else
                                                    @lang('website.road')
                                                @endif
                                                :
                                                {{ $address['road'] }}
                                            </p>
                                            <p class="col-12 col-md-6">
                                                @lang('messages.building_floor')
                                                :
                                                {{ $address['building_no'] }}
                                            </p>
                                            <p class="col-12 col-md-6">
                                                @lang('dashboard.floor_no')
                                                :
                                                {{ $address['floor_no'] }}
                                            </p>
                                            <p class="col-12 col-md-6">
                                                @lang('dashboard.apartment')
                                                :
                                                {{ $address['apartment'] }}
                                            </p>
                                            <p class="col-12 col-md-6">
                                                @lang('dashboard.type')
                                                :
                                                {{ $address['type'] }}
                                            </p>
                                            <p class="col-12 col-md-6">
                                                @lang('dashboard.additional_directions')
                                                :
                                                {{ $address['additional_directions'] }}
                                            </p>
                                        </li>
                                    </ul>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('client.address.edit', $address['id']) }}" class="h5 text-decoration-none last_link transition-me mx-4"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form method="POST" action="{{ route('client.address.destroy', $address['id']) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button style="display: contents;color: red;" type="submit" class="show_confirm h5 text-decoration-none last_link transition-me mx-4 deleteAddress"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                                <div class="my-4">
                                    <button onclick="location.href='{{ route('client.address.create') }}'"  class="bt_details transition_me w-50 py-3 border-0 rounded"><i class="fa-solid fa-plus mx-2"></i>@lang('website.addAddress')</button>
                                </div>
                            </div>
                            @else
                            <div class="col-12 text-center">
                                <h4 class="p-4 m-0">@lang('website.noSavedAddress')</h4>
                                <div>
                                    <button onclick="location.href='{{ route('client.address.create') }}'"  class="bt_details transition_me w-50 py-3 border-0 rounded">@lang('website.addAddress')</button>
                                </div>
                            </div>
                            @endif
                        </div>

                    </div>

                    <div class="tab-pane {{ $section == 'orders' ? 'show active' : '' }}" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab">

                        <ul class="nav nav-pills mb-3 p-0 row" id="pills-tab" role="tablist">
                            <li class="nav-item col-6 text-center active" role="presentation">
                                <button class="bt_details_reverce transition_me w-50 py-3 border-0 rounded px-5" id="pills-Current-tab" data-toggle="pill" href="#Current-home" role="tab" aria-controls="pills-Current" aria-selected="true">@lang('website.currentOrder')</button>
                            </li>
                            <li class="nav-item col-6 text-center" role="presentation">
                                <button class="bt_details_reverce transition_me w-50 py-3 border-0 rounded px-5" id="pills-Last-tab" data-toggle="pill" href="#pills-Last" role="tab" aria-controls="pills-Last" aria-selected="false">@lang('website.previousOrder')</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">

                            <div class="tab-pane show active" id="Current-home" role="tabpanel" aria-labelledby="pills-Current-tab">
                                @if(count($currentOrders) > 0)
                                <div id="accordion" class="{{ lang() == 'ar' ? 'text-right' : '' }}">
                                    @foreach($currentOrders as $key => $order)

                                        <button style="display:  contents" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $order->id }}" aria-expanded="false" aria-controls="collapse{{ $order->id }}">
                                            <div class="row justify-content-center align-items-center">
                                                <div class="col-12 col-md-5">
                                                    <div class="row justify-content-center align-items-center mb-3">
                                                        <div class="col-4">
                                                            <img src="{{ public_asset(setting('logo')) }}" class="img-fluid w-75" alt="COMM">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="px-4">
                                                                @php($time = explode(' ', $order['created_at']))
                                                                <span class="d-block text-center font-weight-bold">{{ $time[0] }}</span>
                                                                <span class="d-block text-center font-weight-bold">{{ $time[1] }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-7">
                                                    <div class="row justify-content-center">
                                                        <div class="col-5">
                                                            <div class="text-center">
                                                                <span class="font-weight-bold d-block">@lang('website.netTotal')</span>
                                                                <span class="font-weight-bold d-block">{{ number_format($order['net_total'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }} {{ DefaultCurrancy()->currancy_code }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-5">
                                                            <div class="text-center">
                                                                <span class="font-weight-bold d-block">@lang('website.orderNo')</span>
                                                                <span class="font-weight-bold d-block">{{ $order['id'] }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                        <div class="collapse" id="collapse{{ $order->id }}">
                                            <div class="card card-body">
                                                @foreach($order->orderProducts as $orderProduct)
                                                <div class="p-2 my-4 shadow">
                                                    <div class="row justify-content-center align-items-center">
                                                        <div class="col-12 col-md-5">
                                                            <div class="row justify-content-center align-items-center">
                                                                <div class="col-6">
                                                                    <img src="{{ $orderProduct->product->RandomImage() }}" class="img-fluid w-75" alt="screen">
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="">
                                                                        <span class="font-weight-bold d-block mb-3">@lang('website.productName')</span>
                                                                        <span style="font-size: 13px">{{ $orderProduct->product['title_' . lang()] }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-7">
                                                            <div class="row mt-2">
                                                                <div class="col-4">
                                                                    <span class="font-weight-bold d-block mb-3">@lang('website.quantity')</span>
                                                                    <span>{{ $orderProduct['quantity'] }}</span>
                                                                </div>
                                                                <div class="col-4">
                                                                    <span class="font-weight-bold d-block mb-3">@lang('website.price')</span>
                                                                    <span>{{ number_format($orderProduct['price'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals) }} {{ DefaultCurrancy()->currancy_code }}</span>
                                                                </div>
                                                                <div class="col-4">
                                                                    <span class="font-weight-bold d-block mb-3">@lang('website.total')</span>
                                                                    <span>{{ number_format($orderProduct['total'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals) }} {{ DefaultCurrancy()->currancy_code }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="progr my-5 text-center">
                                                    <div class="container">
                                                        <div class="row justify-content-center align-items-end">
                                                            <div class="col-2">
                                                                <img src="{{ public_asset('Pending.png') }}" class="img-fluid rounded w-50 mx-auto d-block mb-3" alt="creativity">
                                                                <span class="font-weight-bold">@lang('website.pending')</span>
                                                            </div>
                                                            <div class="col-3">
                                                                <div style="height: 2px;bottom: 50px;position: relative;" class="text-line {{ in_array($order['status'], [1]) && in_array($order['follow'], [1,2,3]) ? 'bg-warning' : 'bg-light' }} m-auto"></div>
                                                            </div>
                                                            <div class="col-2">
                                                                @if(in_array($order['status'], [1]) && in_array($order['follow'], [1,2,3]))
                                                                    <img src="{{ public_asset('preparing-1.svg') }}" class="img-fluid rounded w-50 mx-auto d-block mb-3" alt="food-delivery">
                                                                @else
                                                                    <img src="{{ public_asset('preparing-0.png') }}" class="img-fluid rounded w-50 mx-auto d-block mb-3" alt="food-delivery">
                                                                @endif
                                                                <span class="font-weight-bold">@lang('website.preparing')</span>
                                                            </div>
                                                            <div class="col-3">
                                                                <div style="height: 2px;bottom: 50px;position: relative;" class="text-line {{ in_array($order['status'], [1]) && in_array($order['follow'], [3]) ? 'bg-warning' : 'bg-light' }} m-auto"></div>
                                                            </div>
                                                            <div class="col-2">
                                                                @if(in_array($order['status'], [1]) && in_array($order['follow'], [1,2,3]))
                                                                <img src="{{ public_asset('Delivered-1.svg') }}" class="img-fluid rounded w-50 mx-auto d-block mb-3" alt="delivery-man">
                                                                @else
                                                                <img src="{{ public_asset('Delivered-0.png') }}" class="img-fluid rounded w-50 mx-auto d-block mb-3" alt="delivery-man">
                                                                @endif
                                                                <span class="font-weight-bold">@lang('website.delivered')</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="p-4 bg-light d-none d-md-block">
                                                    <div class="container">
                                                        <div class="sub-total d-flex justify-content-between my-2">
                                                            <h4 class="font-weight-bold">@lang('website.subTotal'):</h4>
                                                            <h4 class="font-weight-bold">{{ number_format($order['sub_total'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }} {{ DefaultCurrancy()->currancy_code }}</h4>
                                                        </div>
                                                        <div class="sub-total d-flex justify-content-between my-2">
                                                            <h4 class="font-weight-bold">@lang('website.discount'):</h4>
                                                            <h4 class="font-weight-bold">{{ number_format($order['discount'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }} {{ DefaultCurrancy()->currancy_code }}</h4>
                                                        </div>
                                                        <div class="sub-total d-flex justify-content-between my-2">
                                                            <h4 class="font-weight-bold">@lang('website.vat'):</h4>
                                                            <h4 class="font-weight-bold">{{ number_format($order['vat'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }} {{ DefaultCurrancy()->currancy_code }}</h4>
                                                        </div>
                                                        <div class="sub-total d-flex justify-content-between my-2">
                                                            <h4 class="font-weight-bold">@lang('website.deliveryCost'):</h4>
                                                            <h4 class="font-weight-bold">{{ number_format($order['charge_cost'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }} {{ DefaultCurrancy()->currancy_code }}</h4>
                                                        </div>
                                                        <div class="sub-total d-flex justify-content-between my-2">
                                                            <h4 class="font-weight-bold">@lang('website.netTotal'):</h4>
                                                            <h4 class="font-weight-bold">{{ number_format($order['net_total'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }} {{ DefaultCurrancy()->currancy_code }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bg-light d-block d-md-none">
                                                    <div class="container">
                                                        <div class="sub-total d-flex justify-content-between my-2">
                                                            <span>@lang('website.subTotal'):</span>
                                                            <span>{{ number_format($order['sub_total'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }} {{ DefaultCurrancy()->currancy_code }}</span>
                                                        </div>
                                                        <div class="sub-total d-flex justify-content-between my-2">
                                                            <span>@lang('website.discount'):</span>
                                                            <span>{{ number_format($order['discount'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }} {{ DefaultCurrancy()->currancy_code }}</span>
                                                        </div>
                                                        <div class="sub-total d-flex justify-content-between my-2">
                                                            <span>@lang('website.vat'):</span>
                                                            <span>{{ number_format($order['vat'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }} {{ DefaultCurrancy()->currancy_code }}</span>
                                                        </div>
                                                        <div class="sub-total d-flex justify-content-between my-2">
                                                            <span>@lang('website.deliveryCost'):</span>
                                                            <span>{{ number_format($order['charge_cost'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }} {{ DefaultCurrancy()->currancy_code }}</span>
                                                        </div>
                                                        <div class="sub-total d-flex justify-content-between my-2">
                                                            <span>@lang('website.netTotal'):</span>
                                                            <span>{{ number_format($order['net_total'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }} {{ DefaultCurrancy()->currancy_code }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                                @else
                                <div class="col-12 text-center">
                                    <h4 class="p-4 m-0">@lang('website.noOrders')</h4>
                                </div>
                                @endif
                            </div>

                            <div class="tab-pane" id="pills-Last" role="tabpanel" aria-labelledby="pills-Last-tab">

                                @if(count($previousOrders) > 0)
                                <div id="accordion" class="{{ lang() == 'ar' ? 'text-right' : '' }}">
                                    @foreach($previousOrders as $key => $order)

                                    <button style="display:  contents" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $order->id }}" aria-expanded="false" aria-controls="collapse{{ $order->id }}">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-12 col-md-5">
                                                <div class="row justify-content-center align-items-center mb-3">
                                                    <div class="col-4">
                                                        <img src="{{ public_asset(setting('logo')) }}" class="img-fluid w-75" alt="COMM">
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="px-4">
                                                            @php($time = explode(' ', $order['created_at']))
                                                            <span class="d-block text-center font-weight-bold">{{ $time[0] }}</span>
                                                            <span class="d-block text-center font-weight-bold">{{ $time[1] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-7">
                                                <div class="row justify-content-center">
                                                    <div class="col-5">
                                                        <div class="text-center">
                                                            <span class="font-weight-bold d-block">@lang('website.netTotal')</span>
                                                            <span class="font-weight-bold d-block">{{ number_format($order['net_total'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="text-center">
                                                            <span class="font-weight-bold d-block">@lang('website.orderNo')</span>
                                                            <span class="font-weight-bold d-block">{{ $order['id'] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                    <div class="collapse" id="collapse{{ $order->id }}">
                                        <div class="card card-body">
                                            @foreach($order->orderProducts as $orderProduct)
                                            <div class="p-2 my-4 shadow">
                                                <div class="row justify-content-center align-items-center">
                                                    <div class="col-12 col-md-5">
                                                        <div class="row justify-content-center align-items-center">
                                                            <div class="col-6">
                                                                <img src="{{ $orderProduct->product->RandomImage() }}" class="img-fluid w-75" alt="screen">
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="">
                                                                    <span class="font-weight-bold d-block mb-3">@lang('website.productName')</span>
                                                                    <span style="font-size: 13px">{{ $orderProduct->product['title_' . lang()] }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-7">
                                                        <div class="row mt-2">
                                                            <div class="col-4">
                                                                <span class="font-weight-bold d-block mb-3">@lang('website.quantity')</span>
                                                                <span>{{ $orderProduct['quantity'] }}</span>
                                                            </div>
                                                            <div class="col-4">
                                                                <span class="font-weight-bold d-block mb-3">@lang('website.price')</span>
                                                                <span>{{ number_format($orderProduct['price'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals) }} {{ DefaultCurrancy()->currancy_code }}</span>
                                                            </div>
                                                            <div class="col-4">
                                                                <span class="font-weight-bold d-block mb-3">@lang('website.total')</span>
                                                                <span>{{ number_format($orderProduct['total'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals) }} {{ DefaultCurrancy()->currancy_code }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="progr my-5 text-center">
                                                <div class="container">
                                                    <div class="row justify-content-center align-items-end">
                                                        <div class="col-2">
                                                            <img src="{{ public_asset('Pending.png') }}" class="img-fluid rounded w-50 mx-auto d-block mb-3" alt="creativity">
                                                            <span class="font-weight-bold">@lang('website.pending')</span>
                                                        </div>
                                                        <div class="col-3">
                                                            <div style="height: 2px;bottom: 50px;position: relative;" class="text-line {{ in_array($order['status'], [1]) && in_array($order['follow'], [1,2,3]) ? 'bg-warning' : 'bg-light' }} m-auto"></div>
                                                        </div>
                                                        <div class="col-2">
                                                            @if(in_array($order['status'], [1]) && in_array($order['follow'], [1,2,3]))
                                                                <img src="{{ public_asset('preparing-1.svg') }}" class="img-fluid rounded w-50 mx-auto d-block mb-3" alt="food-delivery">
                                                            @else
                                                                <img src="{{ public_asset('preparing-0.png') }}" class="img-fluid rounded w-50 mx-auto d-block mb-3" alt="food-delivery">
                                                            @endif
                                                            <span class="font-weight-bold">@lang('website.preparing')</span>
                                                        </div>
                                                        <div class="col-3">
                                                            <div style="height: 2px;bottom: 50px;position: relative;" class="text-line {{ in_array($order['status'], [1]) && in_array($order['follow'], [3]) ? 'bg-warning' : 'bg-light' }} m-auto"></div>
                                                        </div>
                                                        <div class="col-2">
                                                            @if(in_array($order['status'], [1]) && in_array($order['follow'], [1,2,3]))
                                                            <img src="{{ public_asset('Delivered-1.svg') }}" class="img-fluid rounded w-50 mx-auto d-block mb-3" alt="delivery-man">
                                                            @else
                                                            <img src="{{ public_asset('Delivered-0.png') }}" class="img-fluid rounded w-50 mx-auto d-block mb-3" alt="delivery-man">
                                                            @endif
                                                            <span class="font-weight-bold">@lang('website.delivered')</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="p-4 bg-light d-none d-md-block">
                                                <div class="container">
                                                    <div class="sub-total d-flex justify-content-between my-2">
                                                        <h4 class="font-weight-bold">@lang('website.subTotal'):</h4>
                                                        <h4 class="font-weight-bold">{{ number_format($order['sub_total'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }}</h4>
                                                    </div>
                                                    <div class="sub-total d-flex justify-content-between my-2">
                                                        <h4 class="font-weight-bold">@lang('website.discount'):</h4>
                                                        <h4 class="font-weight-bold">{{ number_format($order['discount'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }}</h4>
                                                    </div>
                                                    <div class="sub-total d-flex justify-content-between my-2">
                                                        <h4 class="font-weight-bold">@lang('website.vat'):</h4>
                                                        <h4 class="font-weight-bold">{{ number_format($order['vat'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }}</h4>
                                                    </div>
                                                    <div class="sub-total d-flex justify-content-between my-2">
                                                        <h4 class="font-weight-bold">@lang('website.deliveryCost'):</h4>
                                                        <h4 class="font-weight-bold">{{ number_format($order['charge_cost'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }}</h4>
                                                    </div>
                                                    <div class="sub-total d-flex justify-content-between my-2">
                                                        <h4 class="font-weight-bold">@lang('website.netTotal'):</h4>
                                                        <h4 class="font-weight-bold">{{ number_format($order['net_total'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-light d-block d-md-none">
                                                <div class="container">
                                                    <div class="sub-total d-flex justify-content-between my-2">
                                                        <span>@lang('website.subTotal'):</span>
                                                        <span>{{ number_format($order['sub_total'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }}</span>
                                                    </div>
                                                    <div class="sub-total d-flex justify-content-between my-2">
                                                        <span>@lang('website.discount'):</span>
                                                        <span>{{ number_format($order['discount'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }}</span>
                                                    </div>
                                                    <div class="sub-total d-flex justify-content-between my-2">
                                                        <span>@lang('website.vat'):</span>
                                                        <span>{{ number_format($order['vat'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }}</span>
                                                    </div>
                                                    <div class="sub-total d-flex justify-content-between my-2">
                                                        <span>@lang('website.deliveryCost'):</span>
                                                        <span>{{ number_format($order['charge_cost'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }}</span>
                                                    </div>
                                                    <div class="sub-total d-flex justify-content-between my-2">
                                                        <span>@lang('website.netTotal'):</span>
                                                        <span>{{ number_format($order['net_total'] * (float)DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals)  }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                </div>
                                @else
                                <div class="col-12 text-center">
                                    <h4 class="p-4 m-0">@lang('website.noOrders')</h4>
                                </div>
                                @endif

                            </div>

                        </div>

                    </div>

                    <div class="tab-pane {{ $section == 'fav' ? 'show active' : '' }}" id="v-pills-favourites" role="tabpanel" aria-labelledby="v-pills-favourites-tab">
                        @if(count(auth('client')->user()->favourites) > 0)
                        @foreach(auth('client')->user()->favourites as $product)
                        <div class="border shadow-sm my-3 fav {{ lang() == 'ar' ? 'text-right' : '' }}">
                            <div class="row">
                                <div class="col-3">
                                    <div class="p-2 {{ lang() == 'ar' ? 'text-right' : '' }}">
                                        <a href="{{ route('client.product', $product['id']) }}" class="text-decoration-none">
                                            <img src="{{ $product->RandomImage() }}" class="w-75" height="150" alt="favourite">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="p-2">
                                        <h4 class="main_bold pt-0 pb-2">
                                            <a href="{{ route('client.product', $product['id']) }}" class="text-decoration-none text-dark">
                                                {{ $product['title_' . lang()] }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="col-12 text-center">
                            <h4 class="p-4 m-0">@lang('website.noProducts')</h4>
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



    <script>
        $(document).on("click", "#v-pills-tab button", function () {
            $('#v-pills-tab button').removeClass('active');
            $(this).addClass('active');
        });

        $(document).on("click", ".show_confirm", function () {
            event.preventDefault();
            var form = $(this).closest("form");
            var name = $(this).data("name");
            swal({
                title: "{{ __('messages.confirmDelete') }}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>
