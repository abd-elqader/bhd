@if (categories()->count())
    <style>
        .container-img {
            height: 250px;
            overflow: hidden;
        }

        .container-img img {
            transition: all 0.8s ease;
        }

        .container-img img:hover {
            transform: scale(1.1);
            transform-origin: 50% 50%;
            cursor: pointer;
        }
    </style>
    <div class="special_offer_two mt-5 pt-4" style="display: block;">
        <div class="container">
            <div class="row py-2">

                <div class="col-lg-6 col-12 ">
                    <h2 class="fw-bold ">
                        @lang('messages.main_categories')
                    </h2>
                </div>

            </div>
            <div class="row">
                @foreach (categories() as $Category)
                    <div class="col-6 col-md-4 col-lg-3 d-md-flex"
                        onclick="window.location.href='{{ route('client.categories', $Category->id) }}'">
                        <div class="my_last_offer my-4 in_offer">
                            <div class="pt-4 container-img">
                                <img src="{{ public_asset($Category->image) }}" class="img-fluid d-block mx-auto" alt="image">
                            </div>
                            <div class="details text-center">
                                <h5 class="fw-bolder main_color" style="height: 14px;margin: revert;">{{ $Category->title() }}</h5>
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
@endif
