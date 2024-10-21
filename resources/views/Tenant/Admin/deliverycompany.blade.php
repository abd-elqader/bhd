@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.DeliveryCompany'))
@section('content')

<style>
    input[type="radio"] {
      -ms-transform: scale(1.5); /* IE 9 */
      -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
      transform: scale(1.5);
    }
</style>
<form method="POST" action="{{ route('admin.company.update',1) }}">
    @csrf
    @method('put')

    <div class="row">
        <div class="col-md-6 my-5">
            <h4>@lang('dashboard.inBahrain')</h4>
            @foreach($Deliveries->where('bahrain',1) as $Delivery)
                <input @checked($delivry_id_in == $Delivery->id) type="radio" id="inBahrain-{{ $Delivery->id }}" name="delivry_id_in" value="{{ $Delivery->id }}">
                <label for="inBahrain-{{ $Delivery->id }}"> <img src="{{ env('APP_URL')  .$Delivery->image }}" width="100px" class="mx-2"> {{ $Delivery->title }}</label>
                <br>
            @endforeach
            <input @checked($delivry_id_in == 0) type="radio" id="inBahrain-0" name="delivry_id_in" value="inBahrain-0">
            <label for="inBahrain-0">
                <img src="{{ env('APP_URL')  .'/CustomShipping.png' }}" style="height:auto; width:100px" class="mx-2">
            </label>
            <label for="inBahrain-0">
                <div>
                    <p>
                        @lang('dashboard.CustomShipping')
                    </p>
                    <div class="input-group mb-3">
                        <span class="input-group-text rounded-0" id="charge_cost_in">@lang('dashboard.delivery_charge')</span>
                        <input type="text" class="form-control rounded-0" placeholder="2.500" name="charge_cost_in" value="{{ $charge_cost_in }}">
                    </div>
                </div>
            </label>
                
        </div>
        <div class="col-md-6 my-5">
            <h4>@lang('dashboard.outBahrain')</h4>
            @foreach($Deliveries->where('global',1) as $Delivery)
                <input @checked($delivry_id_out == $Delivery->id) type="radio" id="outBahrain-{{ $Delivery->id }}" name="delivry_id_out" value="{{ $Delivery->id }}">
                <label for="outBahrain-{{ $Delivery->id }}"> <img src="{{ env('APP_URL')  .$Delivery->image }}" width="100px" class="mx-2"> {{ $Delivery->title }}</label>
                <br>
            @endforeach
            <input @checked($delivry_id_out == 0) type="radio" id="outBahrain-0" name="delivry_id_out" value="outBahrain-0">
            <label for="outBahrain-0">
                <img src="{{ env('APP_URL')  .'/CustomShipping.png' }}" style="height:auto; width:100px" class="mx-2">
            </label>
            <label for="outBahrain-0">
                <div>
                    <p>
                        @lang('dashboard.CustomShipping')
                    </p>
                    <div class="input-group mb-3">
                        <span class="input-group-text rounded-0" id="charge_cost_out">@lang('dashboard.delivery_charge')</span>
                        <input type="text" class="form-control rounded-0" placeholder="2.500" name="charge_cost_out" value="{{ $charge_cost_out }}">
                    </div>
                </div>
            </label>

        </div>
    </div>

        <div class="clearfix"></div>
        <div class="form-group col-12 m-b-0 text-center mx-auto mt-2">
            <button class="btn btn-primary waves-effect waves-light px-5" type="submit">@lang('messages.update')</button>
        </div>
</form>
@endsection
