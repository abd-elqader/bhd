@extends('Central.User.components.layout')
@section('content')


<div class="row">
@if (Packages()->count())
    <div class="package my-5">
        <div class="container">
            <div class="title text-center py-4">
                <h3 class="fw-bold">@lang('messages.Packages')</h3>
            </div>
            <div class="row align-items-end">
                <div class="col-sm-12 col-md ">
                    <div class="my-3">
                        <img src="/Central/img/Women studying vitamins in organic food.jpg" class="img-fluid" alt="image">
                    </div>
                </div>
                @foreach (Packages() as $Package)
                    <div class="col-sm-12 col-md">
                        <div class="in_package point rounded my-3 p-3">
                            <div class="text-center my-3">
                                <h3 class="main_color fw-bold">{{ $Package->title() }}</h3>
                                <span class="d-block fw-bold rounded-pill my-4 second_bg main_color py-3 px-1 w-75 mx-auto h5">{{ $Package->price() }}</span>
                            </div>
                            <ul class="list-unstyled px-0">
                                @foreach ($Package->Descriptions as $Description)
                                <li class="my-2">
                                    <p class="tiny_font">{{ $Description->title() }}</p>
                                </li>
                                @endforeach
                            </ul>
                            <div class="my-2 py-2 text-center">
                                <a  href="{{ route('client.post_renew',['package_id'=>$Package->id]) }}"  class="rounded-pill border-0 main_bt transition_me p-2  text-decoration-none h6">
                                    @lang('website.selectPackage')
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
</div>
@endsection