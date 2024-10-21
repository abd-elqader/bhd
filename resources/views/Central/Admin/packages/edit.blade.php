@extends('Mix.layouts.app')
@section('pagetitle', __('messages.Packages'))
@section('js')
    <script>
        $(document).on("click", "#add_desc", function() {
            if($('#desc_title_ar').val() && $('#desc_title_en').val()){
                $('<div class="row my-3">' +
                    '<div class="col-md-5 col-sm-12">' +
                        '<label>@lang("dashboard.title_ar")</label>' +
                        '<input value="' + $('#desc_title_ar').val() + '" class="form-control" name="desc_title_ar[]"  type="text" required >' +
                    '</div>' +
                    '<div class="col-md-5 col-sm-12">' +
                        '<label>@lang("dashboard.title_en")</label>' +
                        '<input value="' + $('#desc_title_en').val() + '" class="form-control" name="desc_title_en[]"  type="text" required >' +
                    '</div>' +
                    '<div class="col-md-2 col-sm-12">' +
                        '<button class="btn btn-danger mt-4 w-100" type="button">-</button>' +
                    '</div>' +
                '</div>').insertAfter(".PackageDesc .item");
                $('#desc_title_ar').val('');
                $('#desc_title_en').val('');
            }
        });
        $(document).on('click', '.btn-danger', function() {
            $(this).parent().parent().remove();
        });
        $(document).on('click', 'input[type="checkbox"]', function() {
            $(this).parent().parent().find("input[type='text']").val('');
            $(this).parent().parent().find("i").toggleClass('bg-danger-900 bg-success-900');
            $(this).parent().parent().find("i").toggleClass('fa-xmark fa-check');
            $(this).parent().parent().find("input[type='text']").prop('disabled', function(i, v) { return !v; });
        });
    </script>
@endsection
@section('content')
<form method="POST" action="{{ route('admin.packages.update',$Package) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="form-group col-md-6">
            <label for="title_ar">@lang('dashboard.title_ar')</label>
            <input type="text" name="title_ar" id="title_ar" class="form-control" required value="{{ $Package['title_ar'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">@lang('dashboard.title_en')</label>
            <input type="text" name="title_en" id="title_en" class="form-control" required value="{{ $Package['title_en'] }}">
        </div>

        <div class="form-group col-md-6">
            <label for="price">@lang('dashboard.price')</label>
            <input type="number" min="0"  step="0.01" name="price" id="price" class="form-control" required  value="{{ $Package['price'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="discount">@lang('dashboard.discount')</label>
            <input type="number" min="0"  step="0.01" name="discount" id="price" class="form-control" required  value="{{ $Package['discount'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="days">@lang('dashboard.days')</label>
            <input type="number" min="0" step="1" name="days" id="days" class="form-control" required  value="{{ $Package['days'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="visibility">@lang('dashboard.visibility')</label>
            <select class="form-control  select2me" required id="visibility" name="status">
                <option {{ $Package['status'] == 1 ? 'selected' : '' }} value="1">@lang('dashboard.visible')</option>
                <option {{ $Package['status'] == 0 ? 'selected' : '' }} value="0">@lang('dashboard.hidden')</option>
            </select>
        </div>
        {{--
        <div class="clearfix my-5"></div>
        <div class="col-12">
            <h2 class="control-label text-danger">
                @lang('messages.description')
            </h2>
        </div>
        <div class="PackageDesc text-center col-12 mx-auto">
            <div class="row item">
                <div class="form-group  col-md-5 col-sm-12">
                    <label>@lang('dashboard.title_ar')</label>
                    <input type="text" id="desc_title_ar" class="form-control text-center">
                </div>
                <div class="form-group  col-md-5 col-sm-12">
                    <label>@lang('dashboard.title_en')</label>
                    <input type="text" id="desc_title_en" class="form-control text-center">
                </div>
                <div class="form-group  col-md-2 col-sm-12">
                    <label>@lang('messages.add')</label>
                    <button id="add_desc" class="btn btn-primary waves-effect waves-light w-100" type="button">+</button>
                </div>
            </div>
            @foreach ($Package->Descriptions as $desc)
            <div class="row">
                <div class="col-md-5 col-sm-12">
                    <label>@lang("dashboard.title_ar")</label>
                    <input value="{{ $desc->title_ar }}" class="form-control" name="desc_title_ar[]"  type="text" required >
                </div>
                <div class="col-md-5 col-sm-12">
                    <label>@lang("dashboard.title_en")</label>
                    <input value="{{ $desc->title_en }}" class="form-control" name="desc_title_en[]"  type="text" required >
                </div>
                <div class="col-md-2 col-sm-12">
                    <button class="btn btn-danger mt-4 w-100" type="button">-</button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="clearfix my-5"></div>
        <div class="col-12">
            <h2 class="control-label text-danger">
                @lang('messages.features')
            </h2>
        </div>
        @foreach ($FeatureHeader as $Header)
            @if($Header->features->count())
                <div class="clearfix"></div>
                <div class="col-12  my-1 py-3">
                    <h4 class="control-label text-danger">
                        - {{ $Header->title() }}
                    </h4>
                </div>
                <div class="col-12 mx-auto">
                    @foreach($Header->features as $item)
                        @php($PivotData =  $item->Packages->where('id',$Package->id)->where('pivot.feature_id',$item->id)->first())
                        <div class="row item my-1">
                            <div class="form-group form-check  border-bottom-danger col-md-6 {{ $item->type == 'icon' ? 'col-sm-6' : 'col-sm-12' }} m-auto {{ $item->type == 'icon' ? '' : 'mt-3' }} ">
                                <input {{  $PivotData ? 'checked' : ''}} name="feature_id[]" type="checkbox" value="{{ $item->id }}" class="form-check" style="float:left; width:10%">
                                @if($item->title() )
                                    <label class="form-check-label">{{ $item->title() }}</label>
                                @endif
                                @if($item['image'] )
                                    <img style="width: 100px" src="{{ public_asset($item['image']) }}" alt="" srcset="">
                                @endif
                            </div>
                            <div class="form-group  col-md-6 col-sm-12 m-auto text-center">
                                @if ( $item->type == 'text' ||  $item->type == 'icon')
                                    <input placeholder="@lang('dashboard.title_ar')" value="{{ $PivotData ? $PivotData->pivot['title_ar'] : '' }}"  {{ $item->type == 'text' ? ''  : 'hidden'}}  name="feature_title_ar[]" type="text" {{ $PivotData ? '' : 'disabled' }} class="form-control text-center m-3">
                                    <input placeholder="@lang('dashboard.title_en')" value="{{ $PivotData ? $PivotData->pivot['title_en'] : '' }}"  {{ $item->type == 'text' ? ''  : 'hidden'}}  name="feature_title_en[]" type="text" {{ $PivotData ? '' : 'disabled' }} class="form-control text-center m-3">
                                    @if ( $item->type == 'icon')
                                        <i class="fas {{ $PivotData ? 'fa-check bg-success-900' : 'fa-xmark bg-danger-900'   }} p-2 rounded-circle"></i>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
        --}}
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

