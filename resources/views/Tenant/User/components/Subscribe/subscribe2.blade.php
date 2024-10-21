<form method="post" action="{{ route('client.post_subscribe') }}" style="display:contents">
    @csrf
    <div class="subscribe_two py-4 shadow">
        <div class="container position-relative">
            <div class="title text-center pt-4">
                <h3 class="fw-bold third_color">@lang('website.subscribe')</h3>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="custom_input_3 position-relative my-4">
                        <input type="text" name="email" class="shadow border-0 rounded-pill w-100 p-4 mt-2" required style="background-color: #2eafc61a;" placeholder="@lang('messages.E-MAIL ADDRESS')">
                        <button class="rounded-pill border-0 main_bt transition_me py-3 px-5 h5"  style="    position: absolute;{{ lang('en') ? 'right' : 'left' }}: 0px;top: 7px;height: 73px;">@lang('messages.send')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>