@extends('Mix.layouts.app')
@section('pagetitle', __('messages.features'))
@section('content')

<table class="table">
    <tbody class="text-center">
        <tr>
            <td>{{ __('messages.title_ar') . ':' }}</td>
            <td>{{ $FeatureHeader['title_ar'] }}</td>
        </tr>

        <tr>
            <td>{{ __('messages.title_en') . ':' }}</td>
            <td>{{ $FeatureHeader['title_en'] }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.head') . ':' }}</td>
            <td>{{ $FeatureHeader->Header->title() }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.type') . ':' }}</td>
            <td>{{ $FeatureHeader['type'] }}</td>
        </tr>
    </tbody>
</table>
@endsection
