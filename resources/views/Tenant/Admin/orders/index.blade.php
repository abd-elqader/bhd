@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.orders'))
@section('content')
    <style>
        @media (min-width: 760px){
            td {
                text-align: center;
            }
        }
        @media (max-width: 760px){
            #DataTable tr {
                display: inline-block;
            }
            td {
                text-align: !important;
            }
        }
        select,
        button{
            font-size: 9px;
        }
    </style>


    <form>
        <div class="row">
            <div class="form-group col-md-4">
                <label>@lang('dashboard.orderNo')</label>
                <input type="text" name="id" class="form-control" value="{{ $_GET['id'] ?? '' }}">
            </div>
            <div class="form-group col-md-12 text-center">
                <button class="btn btn-primary">@lang('dashboard.search')</button>
            </div>
        </div>
    </form>


    <table class="table table-striped text-center"  id="DataTable">
        <thead>
            <tr>
                <th></th>
                <th>@lang('dashboard.orderNo')</th>
                <th>@lang('dashboard.client')</th>
                <th>@lang('dashboard.phone')</th>
                <th>@lang('dashboard.type')</th>
                <th>@lang('dashboard.details')</th>
                <th>@lang('dashboard.status')</th>
                <th>@lang('dashboard.netTotal')</th>
                <th>@lang('dashboard.paymentMethod')</th>
                <th>@lang('dashboard.time')</th>
            </tr>
        </thead>
        <tbody>
        @if(count($Orders) > 0)
            @foreach($Orders as  $Order)
                <tr class="mt-4 gradeX {{ $Order['id'] }}">
                    <td>
                        <img src="{{ public_asset( $Countries->where('phone_code',$Order->client->phone_code)->first()?->image ) }}" style="width:50px" >
                    </td>
                    <td>{{ $Order['id'] }}</td>
                    <td data-label="@lang('dashboard.client')">{{ $Order->client->name }}</td>
                    <td data-label="@lang('dashboard.phone')">{{ $Order->client->phone }}</td>
                    <td data-label="@lang('dashboard.phone')">{{ $Order->delivery->title() }}</td>
                    <td data-label="@lang('dashboard.details')">
                        <button type="button" class="btn btn-primary"   style="min-width: 130px;font-size: 11px;" data-bs-toggle="modal" data-bs-target="#order-{{ $Order['id'] }}">@lang('dashboard.orderDetails')</button>
                    </td>
                    <td data-label="@lang('dashboard.status')">
                        @if ($Order['status'] == 0 && $Order['follow'] == 0)
                            <select class="select form-control"  style="min-width: 100px;">
                                <option></option>
                                <option data-href="{{ route('admin.orderStatus',[ 'id' => $Order->id,'status'=> 1,'follow'=> 1]) }}" data-status="1" data-follow="1"  data-id="{{ $Order['id'] }}">{{  __('dashboard.accept_order')  }}</option>
                                <option data-href="{{ route('admin.orderStatus',[ 'id' => $Order->id,'status'=> 2,'follow'=> 0]) }}" data-status="2" data-follow="0"  data-id="{{ $Order['id'] }}">{{  __('dashboard.decline')  }}</option>
                            </select>
                        @elseif ($Order['status'] == 1)
                            @if($Order['follow'] == 1)
                                @if($Order->delivery_id == 1)
                                    <select class="select form-control"  style="min-width: 100px;">
                                        <option></option>
                                        <option data-href="{{ route('admin.orderStatus',[ 'id' => $Order->id,'status'=> 1,'follow'=> 2]) }}" data-status="1" data-follow="2"  data-id="{{ $Order['id'] }}">{{  __('messages.order_onway')  }}</option>
                                        <option data-href="{{ route('admin.orderStatus',[ 'id' => $Order->id,'status'=> 1,'follow'=> 3]) }}" data-status="1" data-follow="3"  data-id="{{ $Order['id'] }}">{{  __('messages.order_delivered')  }}</option>
                                    </select>
                                @elseif($Order->delivery_id > 1)
                                    <select class="select form-control"  style="min-width: 100px;">
                                        <option></option>
                                        <option data-href="{{ route('admin.orderStatus',[ 'id' => $Order->id,'status'=> 1,'follow'=> 2]) }}" data-status="1" data-follow="2"  data-id="{{ $Order['id'] }}">{{  __('messages.order_ready')  }}</option>
                                        <option data-href="{{ route('admin.orderStatus',[ 'id' => $Order->id,'status'=> 1,'follow'=> 3]) }}" data-status="1" data-follow="3"  data-id="{{ $Order['id'] }}">{{  __('messages.order_delivered')  }}</option>
                                    </select>
                                @endif
                            @elseif($Order['follow'] == 2)
                                <select class="select form-control"  style="min-width: 100px;">
                                    @if($Order->delivery_id == 1)
                                        <option disabled hidden selected>{{  __('messages.order_onway')  }}</option>
                                    @elseif($Order->delivery_id > 1)
                                        <option disabled hidden selected>{{  __('messages.order_ready')  }}</option>
                                    @endif
                                    <option data-href="{{ route('admin.orderStatus',[ 'id' => $Order->id,'status'=> 1,'follow'=> 3]) }}" data-status="1" data-follow="3"  data-id="{{ $Order['id'] }}">{{  __('messages.order_delivered')  }}</option>
                                </select>
                            @elseif($Order['follow'] == 3)
                                {{ __('messages.order_delivered') }}
                            @endif
                        @elseif ($Order['status'] == 2)
                            <select class="select form-control"  style="min-width: 100px;">
                                <option selected hidden disabled>{{  __('dashboard.decline')  }}</option>
                                <option data-href="{{ route('admin.orderStatus',[ 'id' => $Order->id,'status'=> 0,'follow'=> 0]) }}" data-status="0" data-follow="0"  data-id="{{ $Order['id'] }}">{{  __('website.back')  }}</option>
                            </select>
                        @endif
                    </td>
                    <td data-label="@lang('dashboard.netTotal')">{{ $Order['net_total'] }} BD</td>
                    <td data-label="@lang('dashboard.paymentMethod')"  style="min-width: 100px;">{{ $Order->PaymentMethod['title_' . lang()] }}</td>
                    <td data-label="@lang('dashboard.time')"  style=" min-width: 120px; ">{{ $Order['created_at'] }}</td>
                </tr>

            @endforeach
        @else
            <tr>
                <td colspan="10" style="text-align: center!important;">@lang('dashboard.noElements')</td>
            </tr>
        @endif
        </tbody>
    </table>
    @if ($Orders->hasPages())
        <div class="pagination-wrapper">
             {{ $Orders->links() }}
        </div>
    @endif

    @foreach($Orders as  $Order)
        <div class="modal fade" id="order-{{ $Order['id'] }}" tabindex="-1" aria-labelledby="order-{{ $Order['id'] }}Label" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="order-{{ $Order['id'] }}Label">@lang('dashboard.orderDetails')</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                &times;
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-hover text-center">
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <h4>{{ __("dashboard.client") }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.name") }}</th>
                                    <td colspan="3">{{ $Order->Client->name }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.email") }}</th>
                                    <td colspan="3">{{ $Order->Client->email }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.phone") }}</th>
                                    <td colspan="3">{{ $Order->Client->phone_code . $Order->Client->phone }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <h4>{{ __("dashboard.Payment") }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.sub_total") }}</th>
                                    <td colspan="3">{{ $Order->sub_total }} BD</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.charge_cost") }}</th>
                                    <td colspan="3">{{ $Order->charge_cost }} BD</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.discount") }}</th>
                                    <td colspan="3">{{ $Order->discount }} BD</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.vat") }}</th>
                                    <td colspan="3">{{ $Order->vat }} BD</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.coupon") }}</th>
                                    <td colspan="3">{{ $Order->coupon }} BD</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.OnlineVat") }}</th>
                                    <td colspan="3">{{ $Order->OnlineVat }} BD</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.net_total") }}</th>
                                    <td colspan="3">{{ $Order->net_total }} BD</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.mobile_type") }}</th>
                                    <td colspan="3">{{ $Order->mobile_type }}</td>
                                </tr>
                                @php ($Order->address = $Order->address ? $Order->address : $Order->address()->first())
                                @if ($Order->address)
                                <tr>
                                    <td colspan="6">
                                        <h4>{{ __("dashboard.address") }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.country") }}</th>
                                    <td colspan="3">{{ $Order->address->region->Country->title() }}</td>
                                </tr>
                                <tr>
                                    @if($Order->address->region->country_id == 2)
                                        <th colspan="3">{{ __("dashboard.region") }}</th>
                                    @else
                                        <th colspan="3">{{ __("dashboard.city") }}</th>
                                    @endif
                                    <td colspan="3">{{ $Order->address->region->title() }}</td>
                                </tr>
                                <tr>
                                    @if($Order->address->region->country_id == 2)
                                        <th colspan="3">{{ __("dashboard.block") }}</th>
                                    @else
                                        <th colspan="3">{{ __("dashboard.district") }}</th>
                                    @endif
                                    <td colspan="3">{{ $Order->address->block }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("website.building_no") }}</th>
                                    <td colspan="3">{{ $Order->address->building_no }}</td>
                                </tr>
                                <tr>
                                    @if($Order->address->region->country_id == 2)
                                    <th colspan="3">{{ __("website.street") }}</th>
                                    @else
                                        <th colspan="3">{{ __("website.road") }}</th>
                                    @endif
                                    <td colspan="3">{{ $Order->address->road }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.floor_no") }}</th>
                                    <td colspan="3">{{ $Order->address->floor_no }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.apartment") }}</th>
                                    <td colspan="3">{{ $Order->address->apartment }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.type") }}</th>
                                    <td colspan="3">{{ $Order->address->type }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.additional_directions") }}</th>
                                    <td colspan="3">{{ $Order->address->additional_directions }}</td>
                                </tr>
                                @endif
                                @if($Order->store_tracking_link)
                                 <tr>
                                    <td colspan="6">{{ $Order->store_tracking_link }}</td>
                                </tr>
                                @endif
                                @if($Order->store_tracking_link)
                                 <tr>
                                    <th colspan="3">{{ "Tracking Link" }}</th>
                                    <td colspan="3"><a href="{{ $Order->store_tracking_link }}" target="_blank">{{ $Order->store_tracking_link }}</a></td>
                                </tr>
                                @endif
                                @if($Order->client_tracking_link)
                                 <tr>
                                    <th colspan="3">{{ "Client Tracking Link" }}</th>
                                    <td colspan="3"><a href="{{ $Order->client_tracking_link }}"  target="_blank">{{ $Order->client_tracking_link }}</a></td>
                                </tr>
                                @endif
                                @if($Order->deliveryId)
                                 <tr>
                                    <th colspan="3">{{ "Delivery Id" }}</th>
                                    <td colspan="3">{{ $Order->deliveryId }}</td>
                                </tr>
                                @endif
                                @if($Order->note)
                                 <tr>
                                    <th colspan="3">{{ __("website.note") }}</th>
                                    <td colspan="3">{{ $Order->note }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                        <h4 class="text-center">{{ __("dashboard.products") }}</h4>
                        <table class="table table-striped table-hover text-center">
                            <tbody>
                                @foreach($Order->OrderProducts as $item )
                                    <tr>
                                        <th>
                                            <p>{{ $item->product->title() }}</p>
                                        </th>
                                        <td>
                                            <p>{{ $item->Size->title() }}</p>
                                            <p>{{ $item->Color?->title() }}</p>
                                            <p>{{ $item->quantity }} * {{ $item->price }} BD</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
    <div class="modal fade" id="SelectDelivery" tabindex="-1" aria-labelledby="SelectDeliveryLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="/dashboard/orderStatus" style="display:contents" id="SelectDeliveryForm">
                @csrf
                <input id="order_id_for_delivery" name="id" type="hidden" value="0">
                <input name="status" type="hidden" value="1">
                <input name="follow" type="hidden" value="1">
                <input name="method" type="hidden" value="{{ $method }}">
                <select name="order_delivery" class="form-select mb-3">
                  <option selected value="" selected disable hidden>-----</option>
                  <option value="Parcel">Parcel</option>
                  <option value="Apiary">Apiary</option>
                </select>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('dashboard.close')</button>
            <button type="submit" form="SelectDeliveryForm" class="btn btn-primary">@lang('messages.Submit')</button>
          </div>
        </div>
      </div>
    </div>

@endsection

@section('css')
    @if(str_contains(url()->full(), 'new'))
    <script src="{{ public_asset('/js/ion.sound.js') }}"></script>
    @endif
@endsection


@section('js')
<script type="text/javascript">
    $(document).on('change', '.select', function() {
        window.location = $(this).find(':selected').attr('data-href'); 
    });

    @if(str_contains(url()->full(), 'new'))
        ion.sound({
            sounds: [
                {name: "door_bell"},
                {name: "door_bell"}
            ],
            path: "/sounds/",
            preload: true,
            volume: 1.0
        });


        var time = 60
        setInterval(function () {
            time--;
            if(time <= 0 )
                time = 60;
            $('#time').html(time);
        }, 1000);
        setInterval(function () {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.orders.last_order_id') }}",
                data: {
                    last_order_id: {{ $last_order_id }}
                },
                dataType: 'text',
                cache: false,
                success: function (Data) {
                    if ( Data > 0 ) {
                        ion.sound.play("door_bell", {loop: 10});
                    }
                },
            });
        }, 60000);
    @endif
</script>
@endsection
