@extends('Mix.layouts.app')
@section('pagetitle', $Image_Type->title() ?? '')
@section('content')
<form method="POST" action="{{ route('admin.type.images.update',['image'=>$Image->id,'type'=>$Image_Type->id]) }}" enctype="multipart/form-data" data-parsley-validate novalidate>
    @csrf
    @method('PUT')
    <div class="row text-center">
        <img id="image" src="{{ public_asset($Image->image) }}" class="d-block mx-auto" alt="image" style="height: 200px;width: auto;">
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="title_ar">@lang('dashboard.title_ar')</label>
            <input type="text" name="title_ar" id="title_ar" class="form-control" required value="{{ $Image['title_ar'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">@lang('dashboard.title_en')</label>
            <input type="text" name="title_en" id="title_en" class="form-control" required value="{{ $Image['title_en'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="desc_ar">@lang('dashboard.desc_ar')</label>
            <textarea type="text" name="desc_ar" id="desc_ar" class="form-control" required>{{ $Image['desc_ar'] }}</textarea>
        </div>
        <div class="form-group col-md-6">
            <label for="desc_en">@lang('dashboard.desc_en')</label>
            <textarea type="text" name="desc_en" id="desc_en" class="form-control" required>{{ $Image['desc_en'] }}</textarea>
        </div>

        <div class="form-group col-md-6">
            <label for="visibility">@lang('dashboard.visibility')</label>
            <select class="form-control  select2me" required id="visibility" name="status">
                <option {{ $Image['status'] == 1 ? 'selected' : '' }} value="1">@lang('dashboard.visible')</option>
                <option {{ $Image['status'] == 0 ? 'selected' : '' }} value="0">@lang('dashboard.hidden')</option>
            </select>
        </div>


        @if(!$Image_Type)
            @php($ids = $Types->pluck('id')->toarray())
            <div class="form-group col-md-6">
                <label for="type_id">@lang('dashboard.type')</label>
                <select class="form-control  select2me" required id="type_id" name="type_id">
                    @foreach ($Types as $type)
                        <option {{ in_array($Image->type_id ,$ids ) }} value="{{ $type->id }}">{{ $type->title() }}</option>
                    @endforeach
                </select>
            </div>
        @else
            <input type="hidden" name="type_id" value="{{ $Image_Type->id }}">
        @endif
        <div class="form-group col-md-6">
            <label for="image">@lang('dashboard.image')</label>
            <label class="file-input btn btn-block btn-primary btn-file w-100">
                Browse&hellip;
                <input accept="image/*" type="file" name="image" id="image" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
            </label>
        </div>
        <div class="clearfix"></div>
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
