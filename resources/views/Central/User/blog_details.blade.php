@extends('Central.User.components.layout')
@section('content')


<div class="bread py-5">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('client.home') }}">@lang('website.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('client.blogs') }}">@lang('dashboard.blogs')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $Blog->title() }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<!-- start blog -->
<div class="blog">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-8">
                <div class="in_blog my-4">
                    <img src="{{ $Blog->image }}" class="img-fluid" alt="image">
                    <h6 class="py-1">{{ $Blog->created_at }}</h6>
                    <h4>{{ $Blog->title() }}</h4>
                    <p style="line-height: 2;" class="my-4">
                        {!! $Blog['long_desc_'.lang()] !!}
                    </p>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="my-4">
                    @foreach ($Blogs as $Blog)
                    <div class="row align-items-center justify-content-center py-3 point" onclick="location.href='{{ route('client.blog',str_replace(' ', '--', $Blog->title()) ) }}'">
                        <div class="col-4">
                            <img src="{{ $Blog->image }}" class="img-fluid" alt="image">
                        </div>
                        <div class="col-8">
                            {!! $Blog->title() !!}
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
