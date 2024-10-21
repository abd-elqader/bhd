@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.blogs'))

@section('css')
    <style>
        .blogImg img{
            width: 100% !important;
            height: auto !important;
        }
    </style>
@endsection

@section('content')

<div>
    <h2>{{__('dashboard.arabicBlog')}}</h2>
    <div style="direction: rtl;" class="blogImg">
        {!!$blog['long_desc_'.lang()] !!}
    </div>
</div>



@endsection

