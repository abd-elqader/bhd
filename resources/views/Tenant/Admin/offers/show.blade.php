@extends('Mix.layouts.app')
@section('pagetitle',__('messages.offers'))
@section('content')

<table class="table">
    <tbody class="text-center">
        <tr>
            <td>{{  __('messages.title_ar') . ':' }}</td>
            <td>{{ $Offer['title_ar'] }}</td>
        </tr>
        <tr>
            <td>{{  __('messages.title_en') . ':' }}</td>
            <td>{{ $Offer['title_en'] }}</td>
        </tr>
        <tr>
            <td>{{  __('messages.Country') . ':' }}</td>
            <td>{{ $Offer->Country->title() }}</td>
        </tr>
        <tr>
            <td>{{  __('messages.status') . ':' }}</td>
            <td>{{ $Offer['status'] ? __('messages.visible') : __('messages.hidden') }}</td>
        </tr>
    </tbody>
</table>

@endsection
