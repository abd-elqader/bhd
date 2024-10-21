@extends('Mix.layouts.app')
@section('content')


{!! Form::model($role, ['method' => 'PATCH','route' => ['admin.roles.update', $role->id]]) !!}


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

    @if($role->id > 1)
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>Permission:</strong>
            <br />
            @foreach($permissions as $value)
            <label>{{ Form::checkbox('permissions[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }} {{ $value->title() }}</label>
            <br />
            @endforeach
        </div>
    </div>
    @endif


    <div class="col-12">
        <div class="button-group">
            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                {{ __('messages.Submit') }}
            </button>
        </div>
    </div>
</div>


{!! Form::close() !!}

<p class="text-center text-primary"><small></small></p>

@endsection
