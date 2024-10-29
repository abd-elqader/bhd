@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.services'))
@section('content')

@if($Subscriptions->count())
    <h2>{{ __('dashboard.services') }}</h2>
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
                    <td>{{ $Item->Service->title }}</td>
                    <td>{{ $Item->start_date }}</td>
                    <td>{{ $Item->end_date }}</td>
                    <td>{{ $Item->Service->price }} BHD</td>
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



<div class="container mt-5 ">
    <h2 class="text-center mb-5">خدماتنا المتميزة</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mt-5 flex-row-reverse">
        @if (!empty($Services))
            @foreach ($Services as $service)
                <div class="col">
                    <div class="card h-100 text-center">
                        <div class="card-body shadow-sm">
                            <div class="circular-image">
                                {{-- Update the image path to point to the storage location --}}
                                <img src="{{ $service->image }}" alt="{{ $service->title }}" />
                                {{-- <img src="{{ $Store->image }}" alt="IMG" class="img-thumbnail rounded mx-auto" style="max-width: 300px"> --}}
                            </div>
                            <h4 class="card-title">{{ $service->title }}</h4>
                            <p class="card-text">
                                {{ $service->description }}
                            </p>
                            <div class="mt-3 ">
                                <span class="fw-bold">{{ $service->price }} BHD</span>
                                <th style="text-align:center;">
                                    <form action="{{ route('admin.services.store',['service_id'=>$service]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-info m-3"><i class="lni lni-label-dollar-2"></i>@lang('website.upgrade')</button>
                                    </form>
                                </th>
                                {{-- <a href="#" class="btn btn-sm btn-primary ms-2 "><i class="bi bi-cart"></i></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3>لا يوجد خدمات</h3>
        @endif
    </div>
</div>
<br>
{{ $Services->links() }}
@endsection

