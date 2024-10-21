@extends('Central.User.components.layout')
@section('content')

<style>
    .mainDiv{
        background-color: #EEE;
        position: relative;
        overflow: hidden;
    }
</style>
<div class="bread py-5">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('client.home') }}">@lang('website.home')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('website.about')</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="our_contact my-5">
    <div class="container">
        <div class="row justify-content-center py-4">
            <div class="col-12 col-md-6 px-0">
                <div class="row justify-content-center">
                    <img src="{{setting('logo')}}" alt="coffee" style="width: auto;max-height: 200px;">
                </div>
            </div>
            <div class="col-12 col-md-6 px-0">
                <div class="row justify-content-center">
                    {!!setting('about_'.lang())!!}
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
