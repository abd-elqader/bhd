@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.online_stores'))

@section('title')
    الخدمات
@endsection

@section('content')
    <div class="container mt-5 ">
        <h2 class="text-center mb-5">خدماتنا المتميزة</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mt-5 flex-row-reverse">
            @if (!empty($data))
                @foreach ($data as $item)
                    <div class="col">
                        <div class="card h-100 text-center">
                            <div class="card-body shadow-sm">
                                <div class="circular-image">
                                    {{-- Update the image path to point to the storage location --}}
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" />
                                </div>
                                <h4 class="card-title">{{ $item->title }}</h4>
                                <p class="card-text">
                                    {{ $item->description }}
                                </p>
                                <div class="mt-3 ">
                                    <span class="fw-bold">{{ $item->price }} BHD</span>
                                    <a href="#" class="btn btn-sm btn-primary ms-2 "><i class="bi bi-cart"></i></a>
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
    {{ $data->links() }}
@endsection
