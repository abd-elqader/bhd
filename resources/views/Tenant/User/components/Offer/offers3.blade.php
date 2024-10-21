@php($products = Products(18,'offers'))
@if($products->count())
    <div class="container">
        <div class="py-4">
            <h2 class="fw-bold text-center">{{ __('dashboard.offers') }}</h2>
        </div>
                
        <div class="offers">
            @foreach($products as  $product)
            <div>
                @include('Tenant.User.components.SingleProducts.product3',['product'=>$product,'Col' =>'mx-2 single_product_design'])
            </div>
            @endforeach
        </div>
        <script>
            $('.offers').slick({
              
              slidesToScroll: 1,
              dots: true,
              infinite: true,
              speed: 300,
              centerMode: true,
              mobileFirst:true,//add this one
              variableWidth: true
            });
                 
        </script>
    </div>
@endif