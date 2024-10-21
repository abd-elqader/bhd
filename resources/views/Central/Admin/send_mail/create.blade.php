@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.emails'))
@section('content')
<form method="POST" action="{{ route('admin.send_mail.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        
        <div class="form-group col-md-6">
            <label for="title">@lang('dashboard.title')</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group col-md-6">
            <label>@lang('dashboard.packages')</label>
            <select class="form-select" name="package" id="package">
              <option selected value="">-----</option>
              <option value="Valid">{{ __('dashboard.valid') }}</option>
              <option value="Expired">{{ __('dashboard.expired') }}</option>
            </select>
        </div>
        
        <div class="form-group col-md-6">
            <label for="image">@lang('dashboard.image')</label>
            <label for="image" class="file-input btn btn-block btn-primary btn-file w-100">
                Browse&hellip;
                <input accept="image/*" type="file" name="image" id="image">
            </label>
        </div>
        
        <div class="form-group col-md-12">
            <label for="content">@lang('dashboard.content')</label>
            <textarea  name="content" id="content" class="form-control"></textarea>
        </div>
       
        <div class="col-12 my-4">
            <div class="button-group">
                <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                    {{ __('messages.Submit') }}
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
