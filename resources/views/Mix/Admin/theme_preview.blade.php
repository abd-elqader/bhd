@extends('Mix.layouts.app')

@section('content')
<div class="row w-75 m-auto">
    <div class="col-1 m-auto">
        <button style="all: unset; cursor: pointer; font-size: 30px;" id="prevBtn"><i class="fa-solid fa-chevron-left"></i></button>
    </div>
    <div class="col-10">
        <div class="themePages row text-center">
            @if($type == 'default')
                @foreach($theme->defaultThemePages as $key => $page)
                    <div class="col-4 m-auto">
                        <div class=" card-styles">
                            <div class="col">
                                {{-- <img src="{{$theme->image}}" style="width:100%; height:400px;"> --}}
                                <h4>{{$page->type}}</h4>
                            </div>
                            <div class="col pt-4">
                                <h4>{{$page->title()}}</h4>
                            </div>
                            <div class="col pt-4">
                                <div class="row w-50 m-auto">
                                    <div class="col-4 m-auto">
                                        <a target="_blank" href="{{route('previewDefaultFullThemePage', $page->id)}}"><i class="fa-solid fa-eye"></i></a>
                                    </div>

                                    @if(!tenant())
                                        <div class="col-4">
                                            <a href="{{route('admin.default_theme_pages.edit', $page->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </div>

                                        <div class="col-4">
                                            <form class="formDelete" method="POST" action="{{route('admin.default_theme_pages.destroy', $page->id)}}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                                    <i class="fa-solid fa-eraser"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach($theme->themePages as $key => $page)
                    <div class="col-4 m-auto">
                        <div class=" card-styles">
                            <div class="col">
                                {{-- <img src="{{$theme->image}}" style="width:100%; height:400px;"> --}}
                                <h4>{{$page->type}}</h4>
                            </div>
                            <div class="col pt-2">
                                <h4>{{$page->title()}}</h4>
                            </div>
                            <div class="col pt-2">
                                <div class="row w-50 m-auto">
                                    <div class="col-4 m-auto">
                                        <a target="_blank" href="{{route('previewFullThemePage', $page->id)}}"><i class="fa-solid fa-eye"></i></a>
                                    </div>

                                    <div class="col-4">
                                        <a href="{{route('admin.theme_pages.edit', $page->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>

                                    <div class="col-4">
                                        <form class="formDelete" method="POST" action="{{route('admin.theme_pages.destroy', $page->id)}}">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                                <i class="fa-solid fa-eraser"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
    <div class="col-1 m-auto">
        <button style="all: unset; cursor: pointer; font-size: 30px;" id="nextBtn"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
</div>


@endsection

@section('js')

<script>
    $(document).ready(function(){
        $('.themePages').slick({
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 1,
            prevArrow: $('#prevBtn'),
            nextArrow: $('#nextBtn'),
            responsive: [
                {
                breakpoint: 768,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
                },
                {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
                }
            ]
        });
    });
</script>

@endsection
