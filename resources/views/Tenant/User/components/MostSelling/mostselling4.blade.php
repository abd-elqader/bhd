@php($products = Products(18,'most_selling'))
@if($products->count())
    <div class="container">
        <div class="py-4">
            <h2 class="fw-bold text-center">{{ __('website.mostselling') }}</h2>
        </div>
                
        <div class="selling">
            @foreach($products as  $product)
            <div>
                @include('Tenant.User.components.SingleProducts.product4',['product'=>$product,'Col' =>'mx-2 single_product_design'])
            </div>
            @endforeach
        </div>
        <script>
            $('.selling').slick({
              
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

