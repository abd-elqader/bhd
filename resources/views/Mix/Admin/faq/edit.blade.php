@extends('Mix.layouts.app')
@section('pagetitle', __('messages.FAQ'))
@section('content')
    <form method="POST" action="{{ route('admin.faq.update',$FAQ) }}" enctype="multipart/form-data" data-parsley-validate
        novalidate>
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <label for="question_ar">@lang('dashboard.question_ar')</label>
                <input id="question_ar" type="text" name="question_ar" required placeholder="@lang('dashboard.question_ar')"
                    class="form-control" value="{{ $FAQ['question_ar'] }}">
            </div>
            <div class="col-md-6">
                <label for="question_en">@lang('dashboard.question_en')</label>
                <input id="question_en" type="text" name="question_en" required placeholder="@lang('dashboard.question_en')"
                    class="form-control" value="{{ $FAQ['question_en'] }}">
            </div>
            <div class="col-md-6">
                <label for="answer_ar">@lang('dashboard.answer_ar')</label>
                <textarea id="answer_ar" name="answer_ar" required placeholder="@lang('dashboard.answer_ar')"
                    class="form-control">{{ $FAQ['answer_ar'] }}</textarea>
            </div>
            <div class="col-md-6">
                <label for="answer_en">@lang('dashboard.answer_en')</label>
                <textarea id="answer_en" name="answer_en" required placeholder="@lang('dashboard.answer_en')"
                    class="form-control">{{ $FAQ['answer_en'] }}</textarea>
            </div>
            <div class="col-md-6">
                <label for="visibility">@lang('dashboard.visibility')</label>
                <select class="form-control  select2me" required id="visibility" name="status">
                    <option {{ $FAQ['status'] == 0 ? 'selected' : '' }} value="0">@lang('dashboard.hidden')</option>
                    <option {{ $FAQ['status'] == 1 ? 'selected' : '' }} value="1">@lang('dashboard.visible')</option>
                </select>
            </div>
            <div class="clearfix"></div>
            <div class="col-12">
                <div class="button-group">
                    <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                        {{ __('messages.Submit') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection


