@extends('Mix.layouts.app')
@section('pagetitle', __('messages.FAQ'))
@section('content')
    <form method="POST" action="{{ route('admin.faq.store') }}" data-parsley-validate novalidate>
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="question_ar">@lang('dashboard.question_ar')</label>
                <input id="question_ar" type="text" name="question_ar" required placeholder="@lang('dashboard.question_ar')"
                    class="form-control">
            </div>
            <div class="col-md-6">
                <label for="question_en">@lang('dashboard.question_en')</label>
                <input id="question_en" type="text" name="question_en" required placeholder="@lang('dashboard.question_en')"
                    class="form-control">
            </div>
            <div class="col-md-6">
                <label for="answer_ar">@lang('dashboard.answer_ar')</label>
                <textarea id="answer_ar" name="answer_ar" required placeholder="@lang('dashboard.answer_ar')"
                    class="form-control"></textarea>
            </div>
            <div class="col-md-6">
                <label for="answer_en">@lang('dashboard.answer_en')</label>
                <textarea id="answer_en" name="answer_en" required placeholder="@lang('dashboard.answer_en')"
                    class="form-control"></textarea>
            </div>
            <div class="col-md-6">
                <label for="visibility">@lang('dashboard.visibility')</label>
                <select class="form-control  select2me" required id="visibility" name="status">
                    <option value="0">@lang('dashboard.hidden')</option>
                    <option value="1">@lang('dashboard.visible')</option>
                </select>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-sm-12 my-4">
                    <div class="text-center p-20">
                        <button type="submit" class="btn btn-primary">{{ __('messages.add') }}</button>
                        <button type="reset" class="btn btn-secondary">{{ __('website.cancel') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

