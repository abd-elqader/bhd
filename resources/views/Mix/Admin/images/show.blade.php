@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.images'))
@section('content')

<table class="table">
    <tbody class="text-center">
        <div class="text-center">
            <img src="{{ $Image['image'] }}" alt="IMG" class="img-thumbnail rounded mx-auto" style="max-width: 300px">
        </div>

        @if($Image['title_ar'])
        <tr>
            <td>{{  __('messages.title_ar') . ':' }}</td>
            <td>{{ $Image['title_ar'] }}</td>
        </tr>
        @endif
        @if($Image['title_en'])    
        <tr>
            <td>{{  __('messages.title_en') . ':' }}</td>
            <td>{{ $Image['title_en'] }}</td>
        </tr>
        @endif
        @if($Image['desc_ar'])    
        <tr>
            <td>{{  __('messages.desc_ar') . ':' }}</td>
            <td>{!! $Image['desc_ar'] !!}</td>
        </tr>
        @endif
        @if($Image['desc_en'])    
        <tr>
            <td>{{  __('messages.desc_en') . ':' }}</td>
            <td>{!! $Image['desc_en'] !!}</td>
        </tr>
        @endif
    </tbody>
</table>

@endsection
