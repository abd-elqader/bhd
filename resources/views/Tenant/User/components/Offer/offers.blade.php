<div class="special_offer_two mt-5 pt-4" style="display: block;">
    <div class="container">
        <div class="row">
            <h2 class="fw-bold text-center">@lang('messages.offers')</h2>  <!--  {{ lang('ar') ? 'my_border_right' : 'my_border_left' }} -->
          @foreach (Offers() as $Offer)
          @php($route = ($Offer->for == 'products') ? route('client.categories', ['product_ids' => $Offer->Products->where('pivot.for','x')->pluck('id')->toarray()]) : route('client.categories',['category_ids'=>$Offer->Categories->where('pivot.for','x')->pluck('id')->toarray()]) )
          <div class="col-12 col-md-6" onclick="window.location.href='{{ $route }}'">
                <div class="my_last_offer my-4 in_offer">
                    @if (in_array($Offer->type_id , [2,3]))
                        @if ($Offer->type_id == 2)
                            <div class="rival">
                                <span>{{ number_format($Offer->value , 3) }} SAR</span>
                            </div>
                        @else
                            <div class="rival">
                                <span>{{ number_format($Offer->value , 0) }} %</span>
                            </div>
                        @endif
                    @endif
                    <div class="pt-4">
                        <img src="{{ public_asset($Offer->image) }}" class="img-fluid d-block mx-auto" alt="image" style="height: 230px;">
                    </div>
                    <div class="details">
                        <h5 class="fw-bolder main_color" style="height: 14px;margin: revert;">{{ $Offer->title() }}</h5>
                        <div class="d-flex align-items-center justify-content-between py-1">
                            <div class="time">
                                <span id="offer{{ $Offer->id }}-d"></span>
                            </div>
                            <div class="fw-bold" style="color:red; font-size:20px;">
                                :
                            </div>
                            <div class="time">
                                <span id="offer{{ $Offer->id }}-h"></span>
                            </div>
                            <div class="fw-bold" style="color:red; font-size:20px;">
                                :
                            </div>
                            <div class="time">
                                <span id="offer{{ $Offer->id }}-m"></span>
                            </div>
                            <div class="fw-bold" style="color:red; font-size:20px;">
                                :
                            </div>
                            <div class="time">
                                <span id="offer{{ $Offer->id }}-s"></span>
                            </div>
                            <script>
                                function updateTimer{{ $Offer->id }}() {
                                    future  = Date.parse('{{ $Offer->end_at }}');
                                    now     = new Date();
                                    diff    = future - now;

                                    days  = Math.floor( diff / (1000*60*60*24) );
                                    hours = Math.floor( diff / (1000*60*60) );
                                    mins  = Math.floor( diff / (1000*60) );
                                    secs  = Math.floor( diff / 1000 );

                                    d = days;
                                    h = hours - days  * 24;
                                    m = mins  - hours * 60;
                                    s = secs  - mins  * 60;

                                    $('#offer{{ $Offer->id }}-s').html( s + " {{ __('messages.second') }}");
                                    $('#offer{{ $Offer->id }}-m').html( m + " {{ __('messages.minute') }}");
                                    $('#offer{{ $Offer->id }}-h').html( h + " {{ __('messages.hour') }}");
                                    $('#offer{{ $Offer->id }}-d').html( d + " {{ __('messages.days') }}");

                                  }
                                  setInterval('updateTimer{{ $Offer->id }}()', 1000 );
                            </script>

                        </div>
                    </div>
                    <span class="my_border one"></span>
                    <span class="my_border two"></span>
                    <span class="my_border three"></span>
                    <span class="my_border four"></span>
                </div>
            </div>

          @endforeach
        </div>
    </div>
</div>
