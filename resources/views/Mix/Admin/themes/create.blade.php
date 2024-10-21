@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.themes'))

@section('content')
<form method="POST" action="{{ route('admin.themes.store') }}" enctype="multipart/form-data" data-parsley-validate novalidate>
    @csrf
    <div class="row">

        <div class="col-sm-12 col-md-6 pb-4 mb-4">
            <h2 id="title_ar" style="cursor: pointer">@lang('dashboard.title_ar')</h2>
            <input type="text" name="title_ar" placeholder="@lang('dashboard.title_ar')" class="form-control mt-2">
        </div>

        <div class="col-sm-12 col-md-6 pb-4 mb-4">
            <h2 id="title_en" style="cursor: pointer">@lang('dashboard.title_en')</h2>
            <input type="text" name="title_en" placeholder="@lang('dashboard.title_en')" class="form-control mt-2">
        </div>

        <div class="col-sm-12 col-md-12 pb-4 mb-4">
            <h2 id="image" style="cursor: pointer">@lang('dashboard.image')</h2>
            <input type="file" name="image" class="form-control mt-2">
        </div>


        <div class="col-sm-12 col-md-6">
            <h2 id="preview" style="cursor: pointer">@lang('dashboard.preview')</h2>
            <ul class="selected_pages  py-2 my-2"></ul>
        </div>

        <div class="col-sm-12 col-md-6 d-md-grid justify-content-center align-items-center">
            <h2 class="text-center">@lang('dashboard.pages')</h2>
            <ul class="pages py-4 my-4">
                @foreach($ThemePages->unique('type') as $item)
                    <h3>{{$item->type}}</h3>
                    @foreach ($ThemePages->where('type',$item->type) as $page)
                        <li>
                            <input class="{{$item->type}}box" type="checkbox" value="{{ $page->id }}" data-order="{{$page->order}}" data-type="{{$item->type}}">
                            <a target="_blanck" href="{{ route('previewFullThemePage',$page->id)   }}">{{ $page->title() }}</a>
                        </li>
                    @endforeach
                    <hr>
                @endforeach

            </ul>
        </div>
        <button class="btn btn-primary" type="submit">@lang('messages.Submit')</button>
    </div>


</form>
@endsection
@section('js')
    <script>
        $(document).on('click', '.pages input[type="checkbox"]', function() {
            order = $(this).attr("data-order");
            type = $(this).attr("data-type");
            $('.' + type + 'box').not(this).prop('checked', false);
            id = $(this).val();
            text = $(this).parent().find("a").html();

            if($(this).is(':checked')){
                $("." + type + "comp").remove();
                $(".selected_pages").append('<li class="li-comp li-'+id+ ' ' + type + 'comp"><h3 class="pb-2" style="opacity:70%">' + type + '</h3><input name="themePages[]" type="text" hidden value="'+id+'"><a target="_blanck" href="/previewFullThemePage/'+id+'">'+text+'</a></li>');

            }else{
                $('.li-'+id).remove();
            }
        });
        $(document).on('click', '#preview', function() {
            var route = "{{ route('previewTheme') }}";
            var ids = [];
            $('.selected_pages input[type="text"]').each(function () {
                ids.push(parseInt(this.value));
            });
            if(ids.length > 0){
                window.open(route + '?ids=' + ids,'_blank');
            }
        });
    </script>
@endsection
@section('css')
    <style>
        li{
            margin: 10px
        }
    </style>
@endsection
