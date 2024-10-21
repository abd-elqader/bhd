@extends('Tenant.User.components.preview_layout')
@section('content')
    @foreach ($data as $item)
        {!! $item->preview !!}
    @endforeach
@endsection
