<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" integrity="sha512-0bEtK0USNd96MnO4XhH8jhv3nyRF0eK87pJke6pkYf3cM0uDIhNJy9ltuzqgypoIFXw3JSuiy04tVk4AjpZdZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
    .SideBar {
        height: 100%;
        width: 25%;
        display: none;
        position: fixed;
        z-index: 1;
        top: 0;
        {{ lang('en') ? 'left' : 'right' }}: 0;
        overflow-x: hidden;
        overflow-y: auto;
        transition: 0.5s;
        padding-top: 60px;
        background: #fff;
        padding: 25px 10px 0px 25px;
        z-index: 999;
    }
    @media (max-width: 575.98px) {
        .SideBar {
            width: 100% !important;
        }
    
    }
    .SideBar a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;

    }

    .SideBar a:hover {
        color: #f1f1f1;
    }

    .SideBar .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-{{ lang('en') ? 'left' : 'right' }}: 50px;
    }

    @media screen and (max-height: 450px) {
        .SideBar {
            padding-top: 15px;
        }

        .SideBar a {
            font-size: 18px;
        }
    }
    label{
            width: max-content;
        display: revert;
    }
</style>
<div id="mySideBar" class="SideBar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <form action="{{ route('client.categories') }}" style="display:contents" method="GET">
        <h3 class="fw-bold py-3 text-black">@lang('website.categories')</h3>
        <div class="row">
            @foreach ($Categories as $category)
            <div class="col-md-12">
                <div class="my-3">
                    <label>
                        <input id="category-{{ $category->id }}" type="checkbox" {{ isset($category_ids) && in_array( $category->id, $category_ids ) ? 'checked' : '' }} class="checkbox" value="{{$category->id}}" name="category_ids[]" />
                        <label for="category-{{ $category->id }}">{{$category->title()}}</label>
                    </label>
                </div>
            </div>
            @endforeach
        </div>
        @if($Colors->count() > 1)
        <h4 class="main_bold py-3">@lang('messages.sortByColor')</h4>
        <div class="row">
            @foreach ($Colors as $color)
            <div class="col-md-12">
                <div class="my-3">
                    <label>
                        <input id="color-{{ $color->id }}" type="checkbox" {{ isset($color_ids) && in_array( $color->id, $color_ids ) ? 'checked' : '' }} class="checkbox" value="{{$color->id}}" name="color_ids[]" />
                        <label for="color-{{ $color->id }}">{{ $color->title() }}</label>
                    </label>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        @if($Sizes->count() > 1)
        <h4 class="main_bold py-3">@lang('messages.sortBySize')</h4>
        <div class="row">
            @foreach ($Sizes as $size)
            <div class="col-md-12">
                <div class="my-3">
                    <label>
                        <input id="size-{{ $size->id }}" type="checkbox" {{ isset($size_ids) && in_array( $size->id, $size_ids ) ? 'checked' : '' }} class=" checkbox border-light" value="{{$size->id}}" name="size_ids[]" />
                        <label for="size-{{ $size->id }}">{{$size->title()}}</label>
                    </label>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        <div class="my-4">
            <p>
                <label for="amount" class="main_bold h4">@lang('messages.sortByPrice')</label>
                <input type="hidden" id="min_price" name="min_price">
                <input type="hidden" id="max_price" name="max_price">
                <input type="text" id="amount" readonly="" style="border:0; font-weight:bold;">
            </p>
            <div class="py-3">
                <div id="slider-range" class="ltr ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="{{ lang('en') ? 'left' : 'right' }}: 24.5%;"></span>
                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="{{ lang('en') ? 'left' : 'right' }}: 63.3%;"></span>
                </div>
            </div>
        </div>
        <button type="submit" class="main_bt transition-me px-4 py-3 rounded-pill border-0 transition_me w-100">
            @lang('messages.search')
        </button>
    </form>
</div>

<script>
    function openNav() {
        $('#mySideBar').toggle('slow');
    }

    function closeNav() {
        $('#mySideBar').hide('slow')
    }

</script>
