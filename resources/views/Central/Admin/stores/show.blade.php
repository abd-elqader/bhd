@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.images'))
@section('content')

<table class="table">
    <tbody class="text-center">
        <div class="text-center">
            <img src="{{ $Store->image }}" alt="IMG" class="img-thumbnail rounded mx-auto" style="max-width: 300px">
        </div>

        <tr>
            <td>{{  __('messages.title_ar') . ':' }}</td>
            <td>{{ $Store['title_ar'] }}</td>
        </tr>
        <tr>
            <td>{{  __('messages.title_en') . ':' }}</td>
            <td>{{ $Store['title_en'] }}</td>
        </tr>
        <tr>
            <td>{{  __('messages.desc_ar') . ':' }}</td>
            <td>{!! $Store['desc_ar'] !!}</td>
        </tr>
        <tr>
            <td>{{  __('messages.desc_en') . ':' }}</td>
            <td>{!! $Store['desc_en'] !!}</td>
        </tr>
        <tr>
            <td>{{  __('messages.status') . ':' }}</td>
            <td colspan="2">{{ $Store['status'] ? __('messages.visible') : __('messages.hidden') }}</td>
        </tr>
    </tbody>
</table>

@endsection
