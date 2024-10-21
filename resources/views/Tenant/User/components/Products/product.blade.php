<div class="categories my-4">
    <style>
        .dropdown-menu {
        
            min-width: 0rem;
        
        }
        .option-input {
          -webkit-appearance: none;
          -moz-appearance: none;
          -ms-appearance: none;
          -o-appearance: none;
          appearance: none;
          position: relative;
          top: 5px;
          right: 0;
          bottom: 0;
          left: 0;
          height: 20px;
          width: 20px;
          transition: all 0.15s ease-out 0s;
          background: #cbd1d8;
          border: none;
          color: #fff;
          cursor: pointer;
          display: inline-block;
          margin-right: 0.5rem;
          outline: none;
          position: relative;
          z-index: 1000;
        }
        .option-input:hover {
          background: #9faab7;
        }
        .option-input:checked {
          background: var(--main--color);
        }
        .option-input:checked::before {
          width: 20px;
          height: 22px;
          display:flex;
          content: '\f00c';
          font-size: 15px;
          font-weight:bold;
          position: absolute;
          align-items:center;
          justify-content:center;
          font-family:'Font Awesome 5 Free';
        }
        .option-input:checked::after {
          -webkit-animation: click-wave 0.65s;
          -moz-animation: click-wave 0.65s;
          animation: click-wave 0.65s;
          background: #40e0d0;
          content: '';
          display: block;
          position: relative;
          z-index: 100;
        }
        .option-input.radio {
          border-radius: 50%;
        }
        .option-input.radio::after {
          border-radius: 50%;
        }
        
        @keyframes click-wave {
          0% {
            height: 40px;
            width: 40px;
            opacity: 0.35;
            position: relative;
          }
          100% {
            height: 200px;
            width: 200px;
            margin-left: -80px;
            margin-top: -80px;
            opacity: 0;
          }
        }
    </style>
    
    
    <div class="container">
        <div class="row">
           @include('Tenant.User.components.Products.filter')
            <div class="col-12">
                <div class="">
                    @include('Tenant.User.components.Products.sort')
                    <div class="row gy-3">
                        @if($Products->count())
                            @foreach ($Products as $product)
                                @include('Tenant.User.components.SingleProducts.'.$product_page_num,['product'=>$product])
                            @endforeach
                        @else  
                            <div class="text-center">
                                <img src="{{ public_asset('empty_products.png') }}" class="mx-auto w-50" />
                                <h2 class="text-center h6 my-2" style="font-size: 27px;">{{ __('website.empty_products') }}</h2>
                            </div>
                        @endif
                        {{ $Products->appends(['type'=>$type,'size_ids' => isset($size_ids) ? $size_ids : null,'color_ids' => isset($color_ids) ? $color_ids : null,'category_ids' => isset($category_ids) ? $category_ids : null,'MaxPrice' =>  $MaxPrice ?? 0,'MinPrice' =>  $MinPrice ?? 0,])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
    <script>
        $(document).ready(function() {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: {{ $MaxPrice + 10 }},
                values: [{{ $MinPrice }}, {{ $MaxPrice }}],
                slide: function (event, ui) {
                    $("#amount").val("{{ DefaultCurrancy()->currancy_code }} " + ui.values[0] + " - {{ DefaultCurrancy()->currancy_code }} " + ui.values[1]);
                    $('#min_price').val(ui.values[0]);
                    $('#max_price').val(ui.values[1]);
                }
            });
            $("#amount").val("{{ DefaultCurrancy()->currancy_code }} " + $("#slider-range").slider("values", 0) +" - {{ DefaultCurrancy()->currancy_code }} " + $("#slider-range").slider("values", 1));
        });
    </script>
@endsection
