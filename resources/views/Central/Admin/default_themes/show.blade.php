@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.themes'))
@section('content')

<table class="table">
    <tbody class="text-center">
        <tr>
            <td>{{  __('messages.description') . ':' }}</td>
            <td>{!! $Component['description'] !!}</td>
        </tr>
        <tr>
            <td>{{  __('messages.status') . ':' }}</td>
            <td colspan="2">{{ $Component['status'] ? __('messages.visible') : __('messages.hidden') }}</td>
        </tr>
    </tbody>
</table>

@endsection
