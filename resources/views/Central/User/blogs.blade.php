@extends('Central.User.components.layout')
@section('content')


<div class="bread py-5">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('client.home') }}">@lang('website.home')</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('client.blogs') }}">@lang('dashboard.blogs')</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="in_main_blog my-2">
    <div class="container">
        <div class="row">
            @foreach (Blogs() as $Blog)
                <div class="col-sm-12 col-md-6">
                    <div class="in_blog my-3 shadow point" onclick="location.href='{{ route('client.blog',str_replace(' ', '--', $Blog->title()) ) }}'">
                        <img src="{{ public_asset($Blog->image) }}" class="img-fluid" alt="image">
                        <div class="p-3" style="height: 300px;">
                            <h6 class="py-1">{{ $Blog->created_at }}</h6>
                            <h4>{{ $Blog->title() }}</h4>
                            <p style="line-height: 2;" class="my-4">
                                {!! $Blog['short_desc_'.lang()] !!}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
