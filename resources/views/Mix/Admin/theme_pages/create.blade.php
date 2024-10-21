@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.theme_pages'))

@section('content')
<form method="POST" action="{{ route('admin.theme_pages.store') }}" enctype="multipart/form-data" data-parsley-validate novalidate>
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

        <div class="col-sm-12 col-md-7 pb-4 mb-4 mx-auto">
            <h2 id="type" style="cursor: pointer">@lang('dashboard.type')</h2>
            {{--  <input type="text" name="type" placeholder="@lang('dashboard.type')" class="form-control mt-2">  --}}
            <select id="typePicker" required name="type" class="form-control mt-2">>
                <option selected hidden disabled>@lang('messages.Select')</option>
                <option value="Home">@lang('website.home')</option>
                <option value="Product">@lang('dashboard.product')</option>
                <option value="Category">@lang('messages.Category')</option>
                <option value="Profile">@lang('website.profile')</option>
                <option value="Cart">@lang('website.cart')</option>
                <option value="Checkout">@lang('messages.check_out')</option>
                <option value="About">@lang('website.about')</option>
                <option value="Contact">@lang('website.contact')</option>
                <option value="Branch">@lang('website.branchs')</option>
                <option value="Login">@lang('website.login')</option>
                <option value="Register">@lang('messages.Register')</option>
                <option value="Term">@lang('website.terms')</option>
                <option value="Privacy">@lang('messages.privacy')</option>
                <option value="Faq">@lang('website.faq')</option>
                <option value="About">@lang('messages.About Us')</option>
            </select>
        </div>

        <div class="col-sm-12 col-md-6">
            <h2 id="preview" style="cursor: pointer">@lang('dashboard.preview')</h2>
            <ul class="selected_components py-2 my-2"></ul>
        </div>
        <div class="col-sm-12 col-md-6 d-md-grid justify-content-center align-items-center">
            <h2 class="text-center">@lang('dashboard.components')</h2>
            <ul class="components py-4 my-4">
                @foreach($Components->unique('type') as $item)
                    <h3>{{$item->type}}</h3>
                    @foreach ($Components->where('type',$item->type) as $component)
                        <li>
                            <input class="componentInput {{$item->type}}box @if($item->type == 'Copyright') CR @endif" type="checkbox" value="{{ $component->id }}" data-order="{{$component->row_id}}" data-type="{{$item->type}}" data-pages="{{$item->pages}}">
                            <a target="_blanck" href="{{ route('previewComponent',$component->id)}}">{{ $component->title() }}</a>
                        </li>
                    @endforeach
                    <hr>
                @endforeach

            </ul>
        </div>
        <button class="submitbtn btn btn-primary" type="button">@lang('messages.Submit')</button>
    </div>


</form>
@endsection
@section('js')
    <script>

        $(document).on('click', '.submitbtn', function(){
            if($('.CR:checked').length > 0){
                $('#mainForm').submit();
            }else{
                alert('CopyRights required');
            }
        });

        $(document).on('change', '#typePicker', function(){
            $('.selected_components').empty();
            $(".componentInput").prop('checked', false);
            $(".componentInput").each(function() {
                if($( this ).attr('data-pages').split(',').length > 1 && !$( this ).attr('data-pages').split(',').includes($('#typePicker').val().toLowerCase())){
                    $( this ).prop('disabled', true);
                }else{
                    $( this ).prop('disabled', false);
                };
            });
        });

        $(document).on('click', '.selected_components li .up', function(){
            item = $(this).parent().parent().parent();
            target = item.prev();

            // item.attr('data-order', '9.00');
            if(target.length >= 1){
                target_order = target.attr('data-order');
                target.attr('data-order', item.attr('data-order'));
                item.attr('data-order', target_order);

                $('#row_id_' + item.attr('data-id')).val(item.attr('data-order'));
                $('#row_id_' + target.attr('data-id')).val(target.attr('data-order'));

                console.log($('#row_id_' + item.attr('data-id')).val());

                $('.li-comp').sort(function(a, b){
                    return (parseFloat($(b).attr('data-order'))) < (parseFloat($(a).attr('data-order'))) ? 1 : -1;
                })
                .appendTo('.selected_components');
            }
            $(".selected_components li .up i").css({'color':'black','cursor':'pointer'});
            $(".selected_components li .down i").css({'color':'black','cursor':'pointer'});
            $(".selected_components li:first .up i").css({'color':'lightgrey','cursor':'default'});
            $(".selected_components li:last .down i").css({'color':'lightgrey','cursor':'default'});
        });

        $(document).on('click', '.selected_components li .down', function(){
            item = $(this).parent().parent().parent();
            target = item.next();

            if(target.length >= 1){
                target_order = target.attr('data-order');
                target.attr('data-order', item.attr('data-order'));
                item.attr('data-order', target_order);

                $('#row_id_' + item.attr('data-id')).val(item.attr('data-order'));
                $('#row_id_' + target.attr('data-id')).val(target.attr('data-order'));

                $('.li-comp').sort(function(a, b){
                    return (parseFloat($(b).attr('data-order'))) < (parseFloat($(a).attr('data-order'))) ? 1 : -1;
                })
                .appendTo('.selected_components');
            }
            $(".selected_components li .up i").css({'color':'black','cursor':'pointer'});
            $(".selected_components li .down i").css({'color':'black','cursor':'pointer'});
            $(".selected_components li:first .up i").css({'color':'lightgrey','cursor':'default'});
            $(".selected_components li:last .down i").css({'color':'lightgrey','cursor':'default'});

        });

        $(document).on('click', '.components input[type="checkbox"]', function() {
            order = $(this).attr("data-order");
            type = $(this).attr("data-type");
            $('.' + type + 'box').not(this).prop('checked', false);
            id = $(this).val();
            text = $(this).parent().find("a").html();

            if($(this).is(':checked')){
                $("." + type + "comp").remove();
                $(".selected_components").append('<li data-id="'+id+'" data-type="'+type+'" data-order="'+ order +'" class="li-comp li-'+id+ ' ' + type + 'comp"><input hidden id="row_id_'+id+'" name="row_id[]" value="' + order + '"><div class="row"><div class="col-1"><button style="all:unset; cursor:pointer;" type="button" class="up"><i class="fas fa-caret-up" style="color:black;"></i></button><br><button style="all:unset; cursor:pointer;" type="button" class="down"><i class="fas fa-caret-down" style="color:black;"></i></button></div><div class="col-11"><h3 class="pb-2" style="opacity:70%">' + type + '</h3><input name="components[]" type="text" hidden value="'+id+'"><a target="_blanck" href="/previewComponent/'+id+'">'+text+'</a></div></div></li>');

                $('.li-comp').sort(function(a, b){
                    return (parseFloat($(b).data('order'))) < (parseFloat($(a).data('order'))) ? 1 : -1;
                })
                .appendTo('.selected_components');

                $(".selected_components li .up i").css({'color':'black','cursor':'pointer'});
                $(".selected_components li .down i").css({'color':'black','cursor':'pointer'});
                $(".selected_components li:first .up i").css({'color':'lightgrey','cursor':'default'});
                $(".selected_components li:last .down i").css({'color':'lightgrey','cursor':'default'});

            }else{
                $('.li-'+id).remove();
            }
        });
        $(document).on('click', '#preview', function() {
            var route = "{{ route('previewThemePage') }}";
            var ids = [];
            $('.selected_components input[type="text"]').each(function () {
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
