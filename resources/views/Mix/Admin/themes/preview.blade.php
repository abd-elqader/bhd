@extends('Tenant.User.preview_layout')
@section('content')
    @foreach ($data as $item)
        {!! $item->preview !!}
    @endforeach
@endsection
