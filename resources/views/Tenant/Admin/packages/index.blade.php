@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.packages'))
@section('content')
    
@if($Subscriptions->count())
    <h2>{{ __('dashboard.packages') }}</h2>
     <table class="table">
        <thead>
            <tr>
                <th scope="col">@lang('dashboard.name')</th>
                <th scope="col">@lang('dashboard.start_date')</th>
                <th scope="col">@lang('dashboard.end_date')</th>
                <th scope="col">@lang('dashboard.price')</th>
                <th scope="col">@lang('messages.paid')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Subscriptions as $Item)
                <tr>
                    <td>{{ $Item->Package->title() }}</td>
                    <td>{{ $Item->start_date }}</td>
                    <td>{{ $Item->end_date }}</td>
                    <td>{{ $Item->Package->price }} BHD</td>
                    <td>{{ $Item->paid ? __('dashboard.yes') : __('dashboard.no') }}</td>
                </tr>
            @endforeach
            {{--
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <form action="{{ route('admin.packages.store') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger m-3">@lang('website.renew')</button>
                    </form>
                </td>
            </tr>
            --}}
        </tbody>
    </table>
@endif



<table class="table" >
    <thead>
        <tr>
            <th>#</th>
            <th style="text-align:center;">@lang('dashboard.title')</th>
            <th style="text-align:center;">@lang('dashboard.price')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($Packages as $Package)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <th style="text-align:center;">{{ $Package->title() }}</th>
                <th style="text-align:center;">{{ $Package->price() }}</th>
                <th style="text-align:center;">
                    <form action="{{ route('admin.packages.store',['package_id'=>$Package]) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-info m-3">@lang('website.upgrade')</button>
                    </form>
                </th>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
