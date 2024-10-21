<div class="d-flex justify-content-end py-3">
    <div class="dropdown w-100   d-none d-sm-none d-md-block">
        <button class="main_bt transition_me border-0 rounded py-2 fw-bold px-4 sort dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            @lang('messages.SortBy')
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item point" onclick="location.href='{{ route('client.categories',['type'=>'low_price','size_ids' => isset($size_ids) ? $size_ids : null,'color_ids' => isset($color_ids) ? $color_ids : null,'category_ids' => isset($category_ids) ? $category_ids : null,'MaxPrice' =>  $MaxPrice ,'MinPrice' =>  $MinPrice ,]) }}'">@lang('messages.lowestPrice')</a></li>
            <li><a class="dropdown-item point" onclick="location.href='{{ route('client.categories',['type'=>'high_price','size_ids' => isset($size_ids) ? $size_ids : null,'color_ids' => isset($color_ids) ? $color_ids : null,'category_ids' => isset($category_ids) ? $category_ids : null,'MaxPrice' =>  $MaxPrice ,'MinPrice' =>  $MinPrice ,]) }}'">@lang('messages.highestPrice')</a></li>
        </ul>
    </div>
    <div class="dropdown w-75 d-md-none d-sm-block">
        <button class="main_bt transition_me border-0 rounded py-2 fw-bold px-4 sort dropdown-toggle  w-100 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
            @lang('messages.SortBy')
        </button>
        <ul class="dropdown-menu w-100 text-center" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item point" onclick="location.href='{{ route('client.categories',['type'=>'low_price','size_ids' => isset($size_ids) ? $size_ids : null,'color_ids' => isset($color_ids) ? $color_ids : null,'category_ids' => isset($category_ids) ? $category_ids : null,'MaxPrice' =>  $MaxPrice ,'MinPrice' =>  $MinPrice ,]) }}'">@lang('messages.lowestPrice')</a></li>
            <li><a class="dropdown-item point" onclick="location.href='{{ route('client.categories',['type'=>'high_price','size_ids' => isset($size_ids) ? $size_ids : null,'color_ids' => isset($color_ids) ? $color_ids : null,'category_ids' => isset($category_ids) ? $category_ids : null,'MaxPrice' =>  $MaxPrice ,'MinPrice' =>  $MinPrice ,]) }}'">@lang('messages.highestPrice')</a></li>
        </ul>
    </div>
    <div class="dropdown w-25 mx-1" onclick="openNav()">
        <button class="main_bt transition_me border-0 rounded py-2 fw-bold px-4 sort dropdown-toggle  w-100 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
            @lang('messages.filter')
        </button>
    </div>
</div>