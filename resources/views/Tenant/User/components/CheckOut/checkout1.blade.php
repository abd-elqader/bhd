<style>
    .tiny_font_2 {
        font-size: 16px;
    }

    .text-line {
        height: 3px
    }

    .color_cart {
        background: #EEE;
        color: #000
    }
    @if(lang('ar'))
    .form-check .form-check-input {
        float: right;
        margin-left: 0.5em;
    }
    @endif
</style>

<!--start rance-->

<div class="rance py-4">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-2">
                <div class="main_bg mx-auto p-3 fw-bold rounded-circle d-flex justify-content-center align-items-center" style="width: 70px; height: 70px">
                    <span style="font-size: 20px" class="text-white">1</span>
                </div>
                <div class="my-2">
                    <h6 class="main_bold text-center">@lang('messages.Cart')</h6>
                </div>
            </div>
            <div class="col-3">
                <div class="text-line main_bg"></div>
            </div>

            <div class="col-3">
                <div class="text-line main_bg"></div>
            </div>
            <div class="col-2">
                <div class="main_bg mx-auto p-3 fw-bold rounded-circle d-flex justify-content-center align-items-center" style="width: 70px; height: 70px">
                    <span style="font-size: 20px" class="text-white">2</span>
                </div>
                <div class="my-2">
                    <h6 class="main_bold text-center">@lang('website.confirmOrder')</h6>
                </div>
            </div>
        </div>
    </div>
</div>




<!--start confirm_order-->

<div class="confirm_order">
    <div class="container">

        <!--start costomer-->
        <div class="main_bg rounded p-3 my-3">
            <h5 class="text-white fw-bold pt-1">@lang('messages.Customer Details')</h5>
        </div>

        <input type="hidden" id="regionId" value="">
        <input type="hidden" id="addressId" value="">
        <input type="hidden" id="deliveryCost" value="">

        <div class="m-2">
            <h5 class="main_bold">{{$client->name}}</h5>
        </div>
        
        @foreach(Delivries() as $key => $item)
            <div class="form-check">
                <input class="form-check-input" name="delivery_t" type="radio" value="{{ $item->id }}" id="Delivries-{{ $item->id }}">
                <label class="form-check-label" for="Delivries-{{ $item->id }}">
                    {{ $item->title() }}
                </label>
            </div>
        @endforeach
       
        @foreach($client->addresses as $key => $address)
            <div class="row card my-2 address" style="cursor: pointer;display:none" data-region="{{$address->region->id}}" data-address="{{$address->id}}" data-delivery="{{$address->region->delivery_cost}}">
                <ul class="my-3 list-unstyled px-0">
                    <li class="my-3"><i class="fa-solid fa-house-chimney h4 mx-2 main_color"></i>{{$address->region->title() . ' ' . $address->block  . ' ' . $address->road  . ' ' . $address->building_no  . ' ' . $address->type  }}</li>
                    <li class="my-3"><i class="fa-solid fa-phone h4 mx-2 main_color"></i>{{$client->phone}}</li>
                </ul>
            </div>
        @endforeach

        <!--end costomer-->



        <div class="main_bg rounded p-3 my-3">
            <h5 class="text-white fw-bold pt-1">@lang('website.orderDetails')</h5>
        </div>


        <!--start cart and delete-->
        @foreach($data as $key => $item)
            @if($key == 'netTotal' || $key == 'coupon' || $key == 'discount' || $key == 'subTotal' || $key == 'vat')
                @continue
            @endif
            <div class="cart_order py-4 position-relative shadow my-4">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-md-4">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-12 col-md-5">
                                <div class="">
                                    <img src="{{public_asset($item['image'])}}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-12 col-md-7">
                                <div class="h-100 text-center">
                                    <div class="mb-4">
                                        <span class="font-weight-lighter h4">{{$item['title']}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-12 col-md-4 my-3">
                                    <div class="h-100 text-center">
                                        <div class="mb-4">
                                            <span class="font-weight-lighter h4">@lang('website.quantity')</span>
                                        </div>
                                        <div class="">
                                            <span class="main_bold">{{$item['quantity']}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 my-3">
                                    <div class="h-100 text-center">
                                        <div class="mb-4">
                                            <span class="font-weight-lighter h4">@lang('website.price')</span>
                                        </div>
                                        <div class="">
                                            <span class="main_bold">{{DefaultCurrancy()->currancy_code}} {{number_format(floatval(floatval($item['price']) * floatval(DefaultCurrancy()->currancy_value)), 3)}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 my-3">
                                    <div class="h-100 text-center">
                                        <div class="mb-4">
                                            <span class="font-weight-lighter h4">@lang('website.total')</span>
                                        </div>
                                        <div class="">
                                            <span class="main_bold">{{DefaultCurrancy()->currancy_code}} {{number_format(floatval(floatval($item['total']) * floatval(DefaultCurrancy()->currancy_value)), 3)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="main_bg rounded p-3 my-3">
            <h5 class="text-white fw-bold pt-1">@lang('messages.Payment Method')</h5>
        </div>

        <!--start payment method-->

        <div class="payment w-100 my-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">

                        @foreach($payment as $key => $item)
                            <div class="form-check my-4 mx-3 paymentOption" data-id="{{$item->id}}">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="{{$item->id}}" @if($key == 0) checked @endif>
                                <label class="form-check-label w-100" for="exampleRadios1">
                                    <div class="row justify-content-between">
                                        <div class="col">
                                            <div>{{$item->title()}}</div>
                                        </div>
                                        <div class="col">
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @endforeach

                    </div>
                    <div class="col-12 col-md-6">
                        <!--start cart total-->
                        <div class="p-3 h-100 border shadow-sm mx-3 d-flex align-items-center">
                            <div class="container">
                                <div class="p-2">
                                    <div class="d-flex justify-content-between my-3">
                                        <span class="main_bold">@lang('website.subTotal') :</span>
                                        <span class="main_bold">{{DefaultCurrancy()->currancy_code}} {{number_format(floatval(floatval($data['subTotal']) * floatval(DefaultCurrancy()->currancy_value)), 3)}}</span>
                                    </div>
                                    @if($data['discount'] > 0)
                                    <div class="d-flex justify-content-between my-3">
                                        <span class="main_bold">@lang('website.discount') :</span>
                                        <span class="main_bold">{{DefaultCurrancy()->currancy_code}} {{number_format(floatval(floatval($data['discount']) * floatval(DefaultCurrancy()->currancy_value)), 3)}}</span>
                                    </div>
                                    @endif
                                    <div class="d-flex justify-content-between my-3">
                                        <span class="main_bold">@lang('website.vat') ({{ setting('VAT') }})%:</span>
                                        <span class="main_bold">{{DefaultCurrancy()->currancy_code}} {{number_format(floatval(floatval($data['vat']) * floatval(DefaultCurrancy()->currancy_value)), 3)}}</span>
                                    </div>
                                    <div class="d-flex justify-content-between my-3">
                                        <span class="main_bold">@lang('website.deliveryCost') :</span>
                                        <span class="main_bold" id="deliveryFinal">{{DefaultCurrancy()->currancy_code}} {{number_format(0.000, 3)}} </span>
                                    </div>
                                    <div class="d-flex justify-content-between my-3">
                                        <span class="main_bold">@lang('website.netTotal') :</span>
                                        <span class="main_bold" id="netTotalFinal">{{DefaultCurrancy()->currancy_code}} {{number_format(floatval(floatval($data['netTotal']) * floatval(DefaultCurrancy()->currancy_value)), 3)}}</span>
                                    </div>
                                </div>
                                <input type="hidden" id="netTotalStart" value="{{$data['netTotal']}}">
                                <div class="my-2">
                                    <form action="{{route('confirmOrder')}}" method="POST" id="mainForm">
                                        @csrf
                                        <input type="hidden" id="subTotal" name="subTotal" value="">
                                        <input type="hidden" id="discount" name="discount" value="">
                                        <input type="hidden" id="vat" name="vat" value="">
                                        <input type="hidden" id="coupon" name="coupon" value="">
                                        <input type="hidden" id="delivery" name="delivery" value="">
                                        <input type="hidden" id="delivery_id" name="delivery_id" value="">
                                        <input type="hidden" id="netTotal" name="netTotal" value="">
                                        <input type="hidden" id="payment" name="payment" value="1">
                                        <input type="hidden" id="address" name="address" value="1">

                                        <button type="button" id="submitBtn" class="main_bt border-0 py-3 w-100 rounded transition_me main_bold my-4">@lang('website.placeOrder')</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--end cart total-->
                    </div>
                </div>
            </div>
        </div>

        <!--end payment method-->

    </div>
</div>


@section('js')
    <script>
        $(document).on('click','.paymentOption', function(){
            $('#payment').val($(this).attr('data-id'));
        });

        $(document).on('click','.address', function(){
            $(this).addClass('active');
            $('.address').css('background-color', 'transparent');
            $(this).css('background-color', 'lightblue');
            $('#regionId').val($(this).attr('data-region'));
            $('#addressId').val($(this).attr('data-address'));
            $('#deliveryCost').val($(this).attr('data-delivery'));

            $('#address').val($(this).attr('data-address'));

            $('#deliveryFinal').text('{{DefaultCurrancy()->currancy_code}} ' + parseFloat(parseFloat($(this).attr('data-delivery')) * parseFloat({{DefaultCurrancy()->currancy_value}})).toFixed(3));

            $('#netTotalFinal').text('{{DefaultCurrancy()->currancy_code}} ' + parseFloat(parseFloat(parseFloat($('#netTotalStart').val()) + parseFloat($(this).attr('data-delivery'))) * parseFloat({{DefaultCurrancy()->currancy_value}})).toFixed(3));
        });

        $(document).on('click', '#submitBtn', function(){
            if($('#regionId').val() ||  $('input[name="delivery_t"]:checked').val() == 2){

                $('#subTotal').val({{$data['subTotal']}});
                $('#discount').val({{$data['discount']}});
                $('#vat').val({{$data['vat']}});
                $('#coupon').val({{$data['coupon']}});
                $('#netTotal').val(parseFloat($('#netTotalFinal').text().replace('{{DefaultCurrancy()->currancy_code}} ','')) / parseFloat({{DefaultCurrancy()->currancy_value}}));
                $('#delivery').val(parseFloat($('#deliveryCost').val()) / parseFloat({{DefaultCurrancy()->currancy_value}}));

                $('#mainForm').submit();
            }else{
                swal({
                    title: 'error',
                    text: '{{__("messages.Select Address")}}',
                    icon: 'error',
                    buttons: ["Ok!"],
                })
            }
        });
        $(document).on('change', 'input[type=radio][name=delivery_t]', function(){
            $('#delivery_id').val(this.value);
            if (this.value == 1) {
                $('.address').css({'display':'block'});
            }else {
                $('.address').css({'display':'none'});
            }
        });
        

    </script>
@endsection

