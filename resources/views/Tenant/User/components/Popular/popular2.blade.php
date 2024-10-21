@php($products = Products(18,'popular'))

    <style>
        .btn-black{
            background-color: black;
         font-size:18px;
        }
    </style>
@if($products->count())
    <div class="container">
        <div class="row  py-2">      
            <div class="col-lg-6 col-12 ">
                <h2 class="fw-bold ">
                    {{ __('dashboard.popular') }}
                </h2>
            </div>
        </div>   
        <div class="popular">
            @foreach($products as  $product)
                <div>
                    @include('Tenant.User.components.SingleProducts.product2',['product'=>$product,'Col' =>'mx-2 single_product_design'])
                </div>
            @endforeach
        </div>
        <script>
            $('.popular').slick({
              
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
