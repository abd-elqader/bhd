
    <div class="top_img py-4" style="height: 100px">
        <div class="container"></div>
    </div>

    <div class="cart_2 my-4">
        <div class="container">

            <div class="rance">
                <div class="row justify-content-center align-items-center">
                    <div class="col-2">
                        <div class="main_bg mx-auto p-3 font-weight-bold rounded-circle d-flex justify-content-center align-items-center" style="width: 70px; height: 70px">
                            <h4 class="text-white">1</h4>
                        </div>
                        <div class="my-2">
                            <h6 class="main_bold text-center">@lang('website.cart')</h6>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="text-line main_bg"></div>
                    </div>
                    <div class="col-2">
                        <div class="main_bg mx-auto p-3 font-weight-bold rounded-circle d-flex justify-content-center align-items-center" style="width: 70px; height: 70px">
                            <h4 class="text-white">2</h4>
                        </div>
                        <div class="my-2">
                            <h6 class="main_bold text-center">@lang('website.paymentAddress')</h6>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="text-line bg-light"></div>
                    </div>
                    <div class="col-2">
                        <div class="bg-light mx-auto p-3 font-weight-bold rounded-circle d-flex justify-content-center align-items-center" style="width: 70px; height: 70px">
                            <h4 class="">3</h4>
                        </div>
                        <div class="my-2">
                            <h6 class="main_bold text-center">@lang('website.confirmOrder')</h6>
                        </div>
                    </div>
                </div>
            </div>


            <div class="my-4">
                <div class="row">
                    @if(count(auth('client')->user()->addresses) > 0)
                        @foreach(auth('client')->user()->addresses as $address)
                        <div class="col-12 col-md-6">
                            <div class="bg-light p-3 rounded mb-4 {{ app()->getLocale() == 'ar' ? 'text-right' : '' }}">
                                <a href="{{ route('confirmOrder', $address['id']) }}" class="main_bt border-0 py-2 px-5 rounded transition-me main_bold m-4 d-block text-center">@lang('website.deliverAddress')</a>
                                <ul class="my-3 list-unstyled">
                                    @php($block = auth('client')->user()->country_id == 1 ? __('website.block') : __('website.district'))
                                    @php($road = auth('client')->user()->country_id == 1 ? __('website.road') : __('website.street'))
                                    <li class="my-3"><i class="fa-solid fa-house-chimney h4 mx-2 main_text {{ app()->getLocale() == 'ar' ? 'float-right' : '' }}"></i>
                                        {{ $address->region['name_' . app()->getLocale()] ?? $address->city . ', ' . $block . ' ' . $address['block'] . ', ' . $road . ' ' . $address['road'] . ', ' . __('website.floorNo') . ' ' . $address['floor_no'] . ', ' . __('website.apartmentNo') . ' ' . $address['apartment'] }}
                                    </li>
                                    <li class="my-3"><i class="fa-solid fa-phone h4 mx-2 main_text {{ app()->getLocale() == 'ar' ? 'float-right' : '' }}"></i>{{ $address['phone'] }}</li>
                                </ul>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('client.address.edit', $address['id']) }}" class="h5 text-decoration-none last_link transition-me mx-4"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="{{ route('client.address.destroy', $address['id']) }}" class="h5 text-decoration-none last_link transition-me mx-4 deleteAddress"><i class="fa-solid fa-trash"></i></a>
                                    <form method="POST" action="{{ route('client.address.destroy', $address['id']) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="my-4">
                            <a href="{{ route('client.address.create') }}" class="h5 text-decoration-none last_link transition-me"><i class="fa-solid fa-plus mx-2"></i>@lang('website.addAddress')</a>
                        </div>
                    @else
                    <div class="col-12 text-center">
                        <div>
                            <img src="{{ url('website/assets_en/img/location.png') }}">
                        </div>
                        <p class="p-4 m-0">@lang('website.noSavedAddress')</p>
                        <div>
                            <a href="{{ route('client.address.create') }}" class="main_bt border-0 py-2 px-5 rounded transition-me main_bold my-4">@lang('website.addAddress')</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.deleteAddress').click(function (e) {
            e.preventDefault();
            $(this).next().submit();
        })
    </script>

