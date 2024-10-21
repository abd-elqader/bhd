<div class="">
    <div class="toolbar_tow third_bg py-2 d-none d-md-block">
        <div class="container">
            <!-- start media screen -->
            <div class="row justify-content-center">
                @foreach (Categories() as $category)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 col-xl p-0 d-flex justify-content-center">
                    <div class="my-2 text-center" style="    width: max-content;">
                        <a href="{{route('client.categories', $category->id)}}" class="fw-bold text-decoration-none tiny_font">{{$category->title()}}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- start small screen -->
    <div class="third_bg py-3 d-block d-md-none">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="second_color fw-bold mb-0 me-5">{{ __('dashboard.categories') }}</h5>
                <span class="toggle_bt">
                    <span class="the_bar"></span>
                    <span class="the_bar"></span>
                    <span class="the_bar"></span>
                </span>
            </div>
            <div class="toolbar_list ">
                <ul class="list-unstyled">
                    @foreach (Categories() as $category)
                    <li>
                        <a href="{{route('client.categories', $category->id)}}" class="fw-bold text-decoration-none">{{$category->title()}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</div>
