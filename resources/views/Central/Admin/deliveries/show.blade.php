@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.images'))
@section('desc_ar')

<table class="table">
    <tbody class="text-center">
        <div class="text-center">
            <img src="{{ $Delivery->image }}" alt="IMG" class="img-thumbnail rounded mx-auto" style="max-width: 300px">
        </div>

        <tr>
            <td>{{  __('messages.title') . ':' }}</td>
            <td>{{ $Delivery['title'] }}</td>
        </tr>
        <tr>
            <td>{{  __('messages.price') . ':' }}</td>
            <td>{{ $Delivery['price'] }} BHD</td>
        </tr>
        <tr>
            <td>{{  __('messages.desc_ar') . ':' }}</td>
            <td>{!! $Delivery['desc_ar'] !!}</td>
        </tr>
        <tr>
            <td>{{  __('messages.desc_en') . ':' }}</td>
            <td>{!! $Delivery['desc_en'] !!}</td>
        </tr>
        <tr>
            <td>{{  __('messages.status') . ':' }}</td>
            <td colspan="2">{{ $Delivery['status'] ? __('messages.visible') : __('messages.hidden') }}</td>
        </tr>
    </tbody>
</table>

@endsection
