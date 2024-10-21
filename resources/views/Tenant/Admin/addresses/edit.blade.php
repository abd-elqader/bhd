@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.addresses'))
@section('content')
<form method="POST" action="{{ route('admin.addresses.update', ['address' => $address]) }}">
    @csrf
    @method('PUT')
    <div class="row">
        <input type="hidden" name="client_id" value="{{$address->client->id}}">

        <div class="col-md-6 my-2">
            <label for="">@lang('messages.client')</label>
            <input type="text" readonly value="{{$address->client->name}}" class="form-control">
        </div>
        <div class="col-md-6 my-2">
            <label for="region_id">@lang('website.region')</label>
            <select name="region_id" class="form-control">
                <option selected hidden>@lang('messages.Select')</option>
                @foreach($regions as $key => $item)
                    <option @if($item->id == $address->region_id) selected @endif value="{{$item->id}}">
                        {{$item->title()}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 my-2">
            <label for="lat">@lang('dashboard.lat')</label>
            <input id="lat" type="text" name="lat" required placeholder="@lang('dashboard.lat')" value="{{$address->lat}}" class="form-control">
        </div>
        <div class="col-md-6 my-2">
            <label for="long">@lang('dashboard.long')</label>
            <input id="long" type="text" name="long" required placeholder="@lang('dashboard.long')" value="{{$address->long}}" class="form-control">
        </div>
        <div class="col-md-6 my-2">
            <label for="block">@lang('website.block')</label>
            <input id="block" type="text" name="block" required placeholder="@lang('website.block')" value="{{$address->block}}" class="form-control">
        </div>
        <div class="col-md-6 my-2">
            <label for="road">@lang('website.road')</label>
            <input id="road" type="text" name="road" required placeholder="@lang('website.road')" value="{{$address->road}}" class="form-control">
        </div>
        <div class="col-md-6 my-2">
            <label for="building_no">@lang('messages.Building')</label>
            <input id="building_no" type="text" name="building_no" required placeholder="@lang('messages.Building')" value="{{$address->building_no}}" class="form-control">
        </div>
        <div class="col-md-6 my-2">
            <label for="floor_no">@lang('website.floorNo')</label>
            <input id="floor_no" type="text" name="floor_no" required placeholder="@lang('website.floorNo')" value="{{$address->floor_no}}" class="form-control">
        </div>
        <div class="col-md-6 my-2">
            <label for="apartment">@lang('dashboard.apartment')</label>
            <input id="apartment" type="text" name="apartment" required placeholder="@lang('dashboard.apartment')" value="{{$address->apartment}}" class="form-control">
        </div>
        <div class="col-md-6 my-2">
            <label for="type">@lang('website.type')</label>
            <select name="type" class="form-control">
                <option selected hidden>@lang('messages.Select')</option>
                <option @if($address->type == 'flat') selected @endif value="flat">@lang('website.flat')</option>
                <option @if($address->type == 'office') selected @endif value="office">@lang('website.office')</option>
            </select>
        </div>
        <div class="col-md-6 my-2">
            <label for="additional_directions">@lang('dashboard.additional_directions')</label>
            <textarea id="additional_directions" type="text" name="additional_directions" required value="{{$address->additional_directions}}" placeholder="@lang('dashboard.additional_directions')" class="form-control mceNoEditor"></textarea>
        </div>

        <div class="clearfix"></div>
        <div class="form-group col-12 m-b-0 text-center mx-auto mt-2">
            <button class="btn btn-primary waves-effect waves-light" type="submit">@lang('website.update')</button>
            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">@lang('dashboard.cancel')</button>
        </div>
    </div>
</form>
@endsection
