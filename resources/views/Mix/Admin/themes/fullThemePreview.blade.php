@extends('Tenant.User.components.preview_layout')
@section('content')
    @foreach ($data as $item)
        @foreach ($item as $key => $component)
            @if ($key == 'name')
                <h1 class="text-center w-100"> {{$component}} </h1>
            @else
                {!! $component['preview'] !!}
            @endif
        @endforeach
    @endforeach
@endsection
