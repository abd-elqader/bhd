@extends('Mix.layouts.app')
@section('pagetitle', __('messages.permissions'))
@section('content')


{!! Form::model($permission, ['method' => 'PATCH','route' => ['admin.permissions.update', $permission->id]]) !!}

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>{{  __('messages.title_ar') }}:</strong>
            {!! Form::text('title_ar', null, array('placeholder' => __('messages.title_ar'),'class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>{{  __('messages.title_en') }}:</strong>
            {!! Form::text('title_en', null, array('placeholder' =>  __('messages.title_en') ,'class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-12">
        <div class="button-group">
            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center my-3">
                {{ __('messages.Submit') }}
            </button>
        </div>
    </div>
</div>

{!! Form::close() !!}

<p class="text-center text-primary"><small></small></p>

@endsection
