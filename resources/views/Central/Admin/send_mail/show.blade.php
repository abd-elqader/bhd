@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.emails'))
@section('content')

<table class="table">
    <tbody class="text-center">
        <div class="text-center">
            <img src="{{ $Mail->image }}" alt="IMG" class="img-thumbnail rounded mx-auto" style="max-width: 300px">
        </div>
        <tr>
            <td>{{  __('messages.title') . ':' }}</td>
            <td>{{ $Mail['title'] }}</td>
        </tr>
        <tr>
            <td>{{  __('messages.content') . ':' }}</td>
            <td>{!! $Mail['content'] !!}</td>
        </tr>
    </tbody>
</table>

@endsection
