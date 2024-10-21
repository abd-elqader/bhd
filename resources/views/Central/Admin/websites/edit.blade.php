@extends('Mix.layouts.app')
@section('pagetitle', $Tenant->id)
@section('content')


{!! Form::model($Tenant, ['method' => 'PATCH','route' => ['admin.websites.update', $Tenant->id]]) !!}

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6">
        <label class="my-1">@lang('messages.name')</label>
        <input placeholder="@lang('messages.name')" class="form-control w-100" name="name" type="text" value="{{ $Tenant?->Client->name }}">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <label class="my-1">@lang('messages.phone')</label>
        <input placeholder="@lang('messages.phone')" class="form-control w-100" name="phone" type="tel" value="{{ $Tenant?->Client->phone }}">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <label class="my-1">@lang('messages.email')</label>
        <input placeholder="@lang('messages.email')" class="form-control w-100" name="email" type="email" value="{{ $Tenant?->Client->email }}">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <label class="my-1">@lang('messages.password')</label>
        <input placeholder="@lang('messages.password')" class="form-control w-100" name="password" type="text">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <label class="my-1">@lang('messages.expire_date')</label>
        <input placeholder="@lang('messages.expire_date')" class="form-control w-100" name="end_date" type="date" value="{{ $end_date }}">
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center my-3">
        <button type="submit" class="btn btn-primary">@lang('messages.Submit')</button>
    </div>
</div>

{!! Form::close() !!}

<p class="text-center text-primary"><small></small></p>

@endsection
