@extends('Mix.layouts.app')
@section('pagetitle', __('messages.tenants'))
@section('content')


{!! Form::open(array('route' => ['admin.websites.store'],'method'=>'POST')) !!}

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-6">
        <label class="my-1">SubDomain:</label>
        {!! Form::text('subdomain', null, array('placeholder' => 'SubDomain','class' => 'form-control w-100')) !!}
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <label class="my-1">@lang('dashboard.client')</label>
        <select name="client_id" required class="form-control w-100">
            @foreach($clients as $item)
                <option selected hidden disabled>@lang('messages.Select')</option>
                <option value="{{ $item['id'] }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center my-3">
        <button type="submit" class="btn btn-primary">@lang('messages.Submit')</button>
    </div>
</div>

{!! Form::close() !!}

<p class="text-center text-primary"><small></small></p>

@endsection
