@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.imagetypes'))
@section('content')

<table class="table">
    <tbody class="text-center">
        <div class="text-center">
            <img src="{{ $ImageType['image'] }}" alt="IMG" class="img-thumbnail rounded mx-auto" style="max-width: 300px">
        </div>

        <tr>
            <td>{{  __('messages.title_ar') . ':' }}</td>
            <td>{{ $ImageType['title_ar'] }}</td>
        </tr>
        <tr>
            <td>{{  __('messages.title_en') . ':' }}</td>
            <td>{{ $ImageType['title_en'] }}</td>
        </tr>
    </tbody>
</table>

@endsection
