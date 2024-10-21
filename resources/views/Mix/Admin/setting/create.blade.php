@extends('Mix.layouts.app')
@section('pagetitle', __('messages.addSetting'))
@section('content')
    <form method="POST" action="{{ route('admin.setting.store') }}" enctype="multipart/form-data" data-parsley-validate
        novalidate>
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="key">@lang('dashboard.keywords')</label>
                <input type="text" name="key" id="key" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="type">@lang('dashboard.type')</label>
                <input type="text" name="type" id="type" class="form-control" required>
            </div>


            <div class="col-md-6">
                <label for="valuetype">@lang('dashboard.valuetype')</label>
                <select class="form-control  select2me" required id="valuetype" name="valuetype">
                    <option disabled selected hidden>@lang('messages.Select')</option>
                    <option value="description">@lang('messages.description')</option>
                    <option value="image">@lang('dashboard.image')</option>
                </select>
            </div>
            <div class="col-md-6" id="ValueFild">

            </div>
        </div>


        <div class="clearfix"></div>
        <div class="text-right m-b-0 text-center">
            <button class="btn btn-primary waves-effect waves-light" type="submit">@lang('dashboard.add')</button>
            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">@lang('dashboard.cancel')</button>
        </div>
    </form>
@endsection

@section('js')



    <script>
        $("#itemSetting").addClass('active');


        $(document).on('change', '#valuetype', function() {
            $('#ValueFild').empty();
            if ($(this).val() == 'description') {
                $('#ValueFild').html('<label for="description">@lang("messages.description")</label><input type="text" name="value"  class="form-control" required>');
            }
            if ($(this).val() == 'image') {
                $('#ValueFild').html('<label for="image">@lang("dashboard.image")</label><input accept="image/*" type="file" name="Imagevalue" class="form-control" data-buttonname="btn-primary">');
            }
        });
    </script>
@endsection
