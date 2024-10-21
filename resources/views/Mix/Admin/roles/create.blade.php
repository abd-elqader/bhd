@extends('Mix.layouts.app')
@section('pagetitle', __('messages.Roles'))
@section('content')


{!! Form::open(array('route' => ['admin.roles.store'],'method'=>'POST')) !!}

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>@lang('messages.title_ar')</strong>
            {!! Form::text('title_ar', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>@lang('messages.title_en')</strong>
            {!! Form::text('title_en', null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>@lang('messages.Permissions')</strong>
            <br />
            @foreach($permissions as $value)
            <label>{{ Form::checkbox('permissions[]', $value->id, true, array('class' => 'name')) }} {{ $value->title() }}</label>
            <br />
            @endforeach
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center my-3">
        <button type="submit" class="btn btn-primary">@lang('messages.Submit')</button>
    </div>
</div>
{!! Form::close() !!}

<p class="text-center text-primary"><small></small></p>

@endsection
