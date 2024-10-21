@extends('Mix.layouts.app')
@section('pagetitle', __('messages.settings'))
@section('content')
@if($type == 'advertising')
<pre style="    direction: rtl; text-align: center; font-weight: 900; font-size: 15px;">
    
    الخدمة لادارة الحملة الأعلانية بشكل كامل
    نجاح الحملة يعتمد على شخص خبير وفاهم خفايا وأسرار التسويق 
    تحليل المتجر + التصميم والمحتوى والكلمات قبل اطلاق الحملة .
    استهداف العمر والمنطقة والمكان الاكثر تفاعلا مع اعلانك

</pre>
@endif

<form method="POST" action="{{ route('admin.settings.update',['setting' => 1, 'type' => $type]) }}" enctype="multipart/form-data" data-parsley-validate novalidate>
    @csrf
    @method('PUT')
    <div class="row">
        @foreach ($Settings as $Setting)
            @if (str_contains($Setting['key'], 'image') || $Setting['type'] == 'image' || in_array($Setting['key'], ['logo','watermark']))
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="{{ $Setting['key'] }}">@lang('dashboard.'.$Setting['key'])</label>
                        <input accept="image/*" type="file" name="{{ $Setting['key'] }}" id="{{ $Setting['key'] }}" class="form-control" data-buttonname="btn-primary" onchange="document.getElementById('image-{{ $Setting['key'] }}').src = window.URL.createObjectURL(this.files[0])">
                        <div class="text-center" style="height: 200px">
                            <img id="image-{{ $Setting['key'] }}" src="{{ public_asset($Setting['value']) }}" class="d-block mx-auto" alt="image" style="height: 200px">
                        </div>
                    </div>
                </div>
             @elseif(in_array($Setting['key'], ['DefaultCurrancy']))
                <div class="col-sm-12">
                    <div class="form-group col-md-12">
                        <label for="{{ $Setting['key'] }}">@lang('dashboard.' . $Setting['key'])</label>
                        <select id="{{ $Setting['key'] }}" name="{{ $Setting['key'] }}" required class="form-control">
                            @foreach (Countries() as $Country)
                                <option {{ $Setting['value'] == $Country->id ? 'selected' : '' }} value="{{ $Country->id }}">{{ $Country->title() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @elseif(str_contains($Setting['key'], 'color'))
                <div class="row">
                    <div class="col-6">
                        <h5 style="padding-top:20px">@lang('dashboard.color')</h5>
                    </div>
                    <div class="col-6">
                        <input id="color" type="color" name="color" required value="{{setting('color')}}" class="form-control my-2" style="width: 60px; height:40px;">
                    </div>
                </div>
             @elseif(in_array($Setting['key'], ['login','register']))
                <div class="col-sm-12">
                    <div class="form-group col-md-12">
                        <label for="{{ $Setting['key'] }}">@lang('dashboard.' . $Setting['key'])</label>
                        <select id="{{ $Setting['key'] }}" name="{{ $Setting['key'] }}" required class="form-control">
                            <option {{ $Setting['value'] == 0 ? 'selected' : '' }} value="0">@lang('dashboard.hidden')</option>
                            <option {{ $Setting['value'] == 1 ? 'selected' : '' }} value="1">@lang('dashboard.visible')</option>
                        </select>
                    </div>
                </div>
             @elseif(in_array($Setting['key'], ['accept_order']))
                <div class="col-sm-12">
                    <div class="form-group col-md-12">
                        <label for="{{ $Setting['key'] }}">@lang('dashboard.' . $Setting['key'])</label>
                        <select id="{{ $Setting['key'] }}" name="{{ $Setting['key'] }}" required class="form-control">
                            <option {{ $Setting['value'] == 0 ? 'selected' : '' }} value="0">@lang('dashboard.no')</option>
                            <option {{ $Setting['value'] == 1 ? 'selected' : '' }} value="1">@lang('dashboard.yes')</option>
                        </select>
                    </div>
                </div>
            @elseif(in_array($Setting['key'], ['OnlineVat']))
                <div class="col-sm-12">
                    <div class="form-group col-md-12">
                        <label for="{{ $Setting['key'] }}">@lang('dashboard.' . $Setting['key'])</label>
                        <select id="{{ $Setting['key'] }}" name="{{ $Setting['key'] }}" required class="form-control">
                                <option {{ $Setting['value'] == 1 ? 'selected' : '' }} value="1">@lang('dashboard.on_store')</option>
                                <option {{ $Setting['value'] == 0 ? 'selected' : '' }} value="0">@lang('dashboard.on_custumer')</option>
                        </select>
                    </div>
                </div>
            @elseif(in_array($Setting['key'], ['DefaultLang']))
                <div class="col-sm-12">
                    <div class="form-group col-md-12">
                        <label for="{{ $Setting['key'] }}">@lang('dashboard.' . $Setting['key'])</label>
                        <select id="{{ $Setting['key'] }}" name="{{ $Setting['key'] }}" required class="form-control">
                                <option {{ $Setting['value'] == 'en' ? 'selected' : '' }} value="en">En</option>
                                <option {{ $Setting['value'] == 'ar' ? 'selected' : '' }} value="ar">Ar</option>
                        </select>
                    </div>
                </div>
            @elseif($Setting['type'] == 'theme')
                <input id="themeValue" type="hidden" name="theme" value="{{setting('theme')}}">
                <div class="row text-center my-4">
                    @if(isset($defaultThemes))
                        @foreach ($defaultThemes as $theme)
                            <div class="theme col-md-3" data-id="default-{{$theme->id}}">
                                <div class="card-styles h-100" style="padding-top: 30px;padding-bottom: 30px; @if(setting('theme') == 'default-'.$theme->id) background-color: {{setting('color')}}; @endif">
                                    <h4 class="my-2">@lang('dashboard.default')-{{$theme->title()}}</h4>
                                    <div class="col h-100 d-flex" style="max-height: 500px;overflow-y: scroll;">
                                        <img src="{{$theme->image}}" style="max-width: 100%;height: fit-content;">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            @elseif (str_contains($Setting['key'], '_services') || str_contains($Setting['key'], 'ar') || str_contains($Setting['key'], 'en') || $Setting['type'] == 'meta')
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="{{ $Setting['key'] }}">@lang('dashboard.'.$Setting['key'])</label>
                        <textarea style="min-height: 300px" class="form-control @if(tenant() != null || $Setting['type'] == 'meta' ) mceNoEditor @endif" id="{{ $Setting['key'] }}" name="{{ $Setting['key'] }}" required>{!! $Setting['value'] !!}</textarea>
                    </div>
                </div>
            @elseif($Setting['key'] == 'IndividualDomain')
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="{{ $Setting['key'] }}">@lang('dashboard.'.$Setting['key'])</label>
                        <input id="{{ $Setting['key'] }}" type="number" step="0.01" name="{{ $Setting['key'] }}" required class="form-control" value="{{ $Setting['value'] }}">
                    </div>
                </div>
            @else
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="{{ $Setting['key'] }}">@lang('dashboard.'.$Setting['key'])</label>
                        <input id="{{ $Setting['key'] }}" type="text" name="{{ $Setting['key'] }}" required class="form-control" value="{{ $Setting['value'] }}">
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="clearfix"></div>
    <div class="col-12 my-4">
        <div class="button-group">
            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                {{ __('messages.Submit') }}
            </button>
        </div>
    </div>
</form>

@endsection

@section('js')
    <script>
        $(document).on('click', '.theme', function(){
            $('.theme .card-styles').css('background-color', 'transparent');
            $(this).children('div').css('background-color', '{{setting("color")}}');
            $('#themeValue').val($(this).attr('data-id'));
        });
    </script>
@endsection
