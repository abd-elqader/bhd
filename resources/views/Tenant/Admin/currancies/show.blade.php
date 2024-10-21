@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.currencies'))
@section('content')

<table class="table">
    <tbody class="text-center">

        <div class="text-center">
            <img src="{{ $Currancy['image'] }}" alt="IMG" class="img-thumbnail rounded mx-auto" style="max-width: 300px">
        </div>

        <tr>
            <td>{{  __('messages.title_ar') . ':' }}</td>
            <td>{{ $Currancy['title_ar'] }}</td>
        </tr>
        <tr>
            <td>{{  __('messages.title_en') . ':' }}</td>
            <td>{{ $Currancy['title_en'] }}</td>
        </tr>
        <tr>
            <td>{{  __('messages.code') . ':' }}</td>
            <td>{{ $Currancy['code'] }}</td>
        </tr>
        <tr>
            <td>{{  __('messages.value') . ':' }}</td>
            <td>{{ $Currancy['value'] }}</td>
        </tr>
        <tr>
            <td>{{  __('messages.status') . ':' }}</td>
            <td colspan="2">{{ $Currancy['status'] ? __('messages.visible') : __('messages.hidden') }}</td>
        </tr>
    </tbody>
</table>

@endsection
