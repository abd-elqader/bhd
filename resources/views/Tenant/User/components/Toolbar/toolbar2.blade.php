<div class="third_bg">
    <div class="container">
        <div class="d-flex align-items-center" style="overflow-x: auto;">
            <nav id="nav_nav" class="second_bg">
                <div class=" nav-tabs d-flex align-items-center justify-content-center bg-black" id="nav-tab" role="tablist">
                    @foreach (Categories() as $category)
                        <button class="nav-link  text-white border-0" style="width: max-content;" onclick="location.href='{{route('client.categories', $category->id)}}'">{{$category->title()}}</button>
                    @endforeach
                </div>
            </nav>
            <hr class="mb-0">
        </div>
    </div>
</div>