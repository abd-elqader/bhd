@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.contact'))
@section('content')
    <div class="row">
        <div class="col-2">
            @lang('messages.name')
        </div>
        <div class="col-10">
            {{ $Contact['name'] }}
        </div>

        <div class="col-2">
            @lang('messages.phone')
        </div>
        <div class="col-10">
            {{ $Contact['phone'] }}
        </div>

        <div class="col-2">
            @lang('messages.email')
        </div>
        <div class="col-10">
            {{ $Contact['email'] }}
        </div>

        <div class="col-2">
            @lang('messages.subject')
        </div>
        <div class="col-10">
            {{ $Contact['subject'] }}
        </div>

        <div class="col-2">
            @lang('messages.message')
        </div>
        <div class="col-10">
            <p> {{ $Contact['message'] }}</p>
        </div>
    </div>

@endsection
