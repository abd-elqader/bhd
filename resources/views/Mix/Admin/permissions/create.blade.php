@extends('Mix.layouts.app')
@section('pagetitle', __('messages.permissions'))
@section('content')


{!! Form::open(array('route' => ['admin.permissions.store'],'method'=>'POST')) !!}

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>{{ __('messages.Name') }}:</strong>
            {!! Form::text('name', null, array('placeholder' => __('messages.Name'),'class' => 'form-control')) !!}
        </div>
    </div>
    {{--  <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>{{  __('messages.title_ar') }}:</strong>
            {!! Form::text('title_ar', null, array('placeholder' => __('messages.title_ar'),'class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>{{  __('messages.title_en') }}:</strong>
            {!! Form::text('title_en', null, array('placeholder' =>__('messages.title_en') ,'class' => 'form-control')) !!}
        </div>
    </div>  --}}

    <div class="col-xs-12 col-sm-12 col-md-12 text-center my-3">
        <button type="submit" class="btn btn-primary">@lang('messages.Submit')</button>
    </div>
</div>

{!! Form::close() !!}

<p class="text-center text-primary"><small></small></p>

@endsection 
