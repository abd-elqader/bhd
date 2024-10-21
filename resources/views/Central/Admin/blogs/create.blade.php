@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.blogs'))
@section('css')

    <style>
        .trix-content img {
            width: 300px;
            height: 300px;
        }
    </style>
@endsection
@section('content')
    <form method="POST" action="{{ route('admin.blogs.store') }}" data-parsley-validate novalidate enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 py-2">
                <label for="title_ar">@lang('dashboard.title_ar')</label>
                <input id="title_ar" type="text" name="title_ar" required placeholder="@lang('dashboard.title_ar')" class="form-control">
            </div>
            <div class="col-md-6 py-2">
                <label for="title_en">@lang('dashboard.title_en')</label>
                <input id="title_en" type="text" name="title_en" required placeholder="@lang('dashboard.title_en')" class="form-control">
            </div>
            <div class="col-md-6 py-2">
                <label for="short_desc_ar">@lang('dashboard.short_desc_ar')</label>
                <textarea id="short_desc_ar" name="short_desc_ar" required placeholder="@lang('dashboard.short_desc_ar')" class="form-control mceNoEditor"></textarea>
            </div>
            <div class="col-md-6 py-2">
                <label for="short_desc_en">@lang('dashboard.short_desc_en')</label>
                <textarea id="short_desc_en" name="short_desc_en" required placeholder="@lang('dashboard.short_desc_en')" class="form-control mceNoEditor"></textarea>
            </div>
            <div class="col-md-6 py-2">
                <label for="visibility">@lang('dashboard.visibility')</label>
                <select class="form-control  select2me" required id="visibility" name="status">
                    <option value="0">@lang('dashboard.hidden')</option>
                    <option value="1">@lang('dashboard.visible')</option>
                </select>
            </div>
            <div class="col-md-6 py-2">
                <label for="image">@lang('dashboard.main_image')</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="col-12 py-2">
                <label for="image">@lang('dashboard.long_desc_ar')</label>
            </div>
            <div class="col-12 py-2">
                @trix(\App\Blog::class, 'long_desc_ar')
            </div>
            <div class="col-12 py-2">
                <label for="image">@lang('dashboard.long_desc_en')</label>
            </div>
            <div class="col-12 py-2">
                @trix(\App\Blog::class, 'long_desc_en')
            </div>


            <div class="clearfix"></div>
            <div class="row">
                <div class="col-sm-12 my-4 py-2">
                    <div class="text-center p-20">
                        <button type="submit" class="btn btn-primary">{{ __('messages.add') }}</button>
                        <button type="reset" class="btn btn-secondary">{{ __('website.cancel') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
