@if(categories()->count())
<style>
    .stokes{
        border: 2px solid transparent;
    }
    .stokes:hover{
        border: 2px solid var(--main--color);
        transform: scale(1.05);
    }
</style>
<div class="category_shop my-5">
    <div class="container">
        <div class="row justify-content-center align-items-center">
        @if(count((array)categories()))
            @foreach (categories() as $Category)
                @php($products = Products(18,'',[$Category->id]))
                @if($products->count())
                    <div class="col-12 col-md-6" onclick="location.href='{{ route('client.categories',['category_id'=>$Category->id]) }}'">
                        <div class="shadow stokes transition_me my-3 text-center">
                            <img style="width: auto;max-height: 300px;" src="{{ public_asset($Category->image) }}" alt="image" class="img-fluid me-4">
                        </div>
                    </div>
                    <div class="selling">
                        <div class="container">
                            <div class="section_them_two my-4">
                                <div class="py-4">
                                    <h2 class="fw-bold text-center">{{ $Category->title() }}</h2>
                                </div>
                                @if($products->count())
                                    <div class="Products-{{ $Category->id }}">
                                        @foreach($products as  $product)
                                        <div>
                                            @include('Tenant.User.components.SingleProducts.product4',['product'=>$product,'Col' =>'mx-2 single_product_design'])
                                        </div>
                                        @endforeach
                                    </div>
                                    <script>
                                        $('.Products-{{ $Category->id }}').slick({
                                          
                                          slidesToScroll: 1,
                                          dots: true,
                                          infinite: true,
                                          speed: 300,
                                          centerMode: true,
                                            mobileFirst:true,//add this one
                                          variableWidth: true
                                        });
                                             
                                    </script>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <img src="{{ public_asset('empty_products.png') }}" class="mx-auto w-50" />
            <h2 class="text-center h6 my-2" style="font: small-caps 27px/2 cursive;">{{ __('website.empty_categories') }}</h2>
        @endif
        </div>
    </div>
</div>
@endif
