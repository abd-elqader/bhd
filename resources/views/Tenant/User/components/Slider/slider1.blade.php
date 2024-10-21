@php($Sliders = ImageType(1))
<style>

</style>
@if($Sliders->images->count())
    <div class="main_header position-relative ltr" wire:ignore>
        <div id="sliders-lg" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" style="">
                @foreach ($Sliders->images as $key => $slider)
                <div class="carousel-item {{$loop->first ? 'active' : '' }}">
                    <div class="row align-items-center landing position-relative">
                        <div class="text text-center py-4 point position-absolute">
                            <h1 class="second_color fw-bold">{{$slider['title_' . lang()]}}</h1>
                             <h1 class="second_color fw-bold">{{$slider['title_' . lang()]}}</h1>
                            <h2 class="second_color my-3">{!!$slider['desc_' . lang()]!!}</h2>
                        </div>
                        <div class="col-12 col-md-12 p-0">
                            <div class="text-center">
                                <img src="{{public_asset($slider->image)}}" class="img-fluid w-100 sliderimage" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    
            @if ($Sliders->images && count($Sliders->images) > 1)
            <div class="container">
                <button class="carousel-control-prev" type="button" data-bs-target="#sliders-lg" data-bs-slide="prev">
                    <i class="fa-solid fa-angle-left"></i>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#sliders-lg" data-bs-slide="next">
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            </div>
            @endif
        </div>
    </div>
@endif