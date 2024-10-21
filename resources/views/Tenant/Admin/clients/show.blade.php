@extends('Mix.layouts.app')
@section('pagetitle', __('messages.clients'))
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-lg-5 col-md-5 col-sm-6  my-auto">
                    <div class="pro-img-details text-center">
                        <img  src="{{ public_asset($Client['image'] ?? setting('logo')) }}" alt="" style="max-height: 330px" class="m-auto w-100" id="myimg">
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-6">
                    <h2 class="box-title mt-5 bold">{{ $Client['name'] }}</h2>
                    <h2 class="mt-5 ">{{ $Client['phone'] }}</h2>
                    <h2 class="mt-5 ">{{ $Client['email'] }}</h2>
                    <h2 class="mt-5 ">{{ $Client['phone'] }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
