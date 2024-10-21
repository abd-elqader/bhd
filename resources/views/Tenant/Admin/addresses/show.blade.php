@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.addresses'))
@section('content')

<table class="table">
    <tbody class="text-center">

        <tr>
            <td>{{  __('messages.client') . ':' }}</td>
            <td>{{ $address->client->name }}</td>
        </tr>
        <tr>
            <td>{{  __('website.email') . ':' }}</td>
            <td>{{ $address->client->email }}</td>
        </tr>
        <tr>
            <td>{{  __('website.phone') . ':' }}</td>
            <td>{{ $address->client->phone }}</td>
        </tr>
        <tr>
            <td>{{  __('website.region') . ':' }}</td>
            <td>{{ $address->region->title() }}</td>
        </tr>
        <tr>
            <td>{{  __('dashboard.lat') . ':' }}</td>
            <td>{{ $address['lat'] }}</td>
        </tr>
        <tr>
            <td>{{  __('dashboard.long') . ':' }}</td>
            <td>{{ $address['long'] }}</td>
        </tr>
        <tr>
            <td>{{  __('website.block') . ':' }}</td>
            <td>{{ $address['block'] }}</td>
        </tr>
        <tr>
            <td>{{  __('website.road') . ':' }}</td>
            <td>{{ $address['road'] }}</td>
        </tr>
        <tr>
            <td>{{  __('messages.Building') . ':' }}</td>
            <td>{{ $address['building_no'] }}</td>
        </tr>
        <tr>
            <td>{{  __('website.floorNo') . ':' }}</td>
            <td>{{ $address['floor_no'] }}</td>
        </tr>
        <tr>
            <td>{{  __('dashboard.apartment') . ':' }}</td>
            <td>{{ $address['apartment'] }}</td>
        </tr>
        </tr>
        <tr>
            <td>{{  __('website.type') . ':' }}</td>
            <td>{{ $address['type'] }}</td>
        </tr>
        <tr>
            <td>{{  __('website.additionalDirection') . ':' }}</td>
            <td>{{ $address['additional_directions'] }}</td>
        </tr>

    </tbody>
</table>

@endsection
