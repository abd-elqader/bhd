@extends('Mix.layouts.app')
@section('pagetitle', __('messages.Roles'))
@section('content')


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $role->name }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>@lang('messages.Permissions')</strong>
            @if(!empty($rolePermissions))
            <ul>
                @foreach($rolePermissions as $v)
                <li>
                    {{ $v->name }}
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</div>

<p class="text-center text-primary"><small></small></p>

@endsection
