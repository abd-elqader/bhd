
<div class="bread py-5">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('client.home') }}">@lang('website.home')</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('client.contact') }}">@lang('messages.Contact Us')</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="our_contact my-5">
    <div class="container">
        <form method="POST" action="{{ route('client.post_contact') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row justify-content-center py-4">
                <div class="col-11 col-md-9 col-lg-7 px-0">

                    <div class="row justify-content-center">
                        <h4 class="fw-bold main_color my-5">@lang('messages.Contact With Us')</h4>
                        <div class="col-12 col-md-6">
                            <div class="custom_input_2 col position-relative my-3">
                                <input name="name" type="text" class="border-0 rounded-pill w-100 p-4 back_me my-3" style="background-color: #2eafc61a;">
                                <label>@lang('messages.Name')</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="custom_input_2 col position-relative my-3">
                                <input name="phone" type="text" class="border-0 rounded-pill w-100 p-4 back_me my-3" style="background-color: #2eafc61a;">
                                <label>@lang('messages.phone')</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="custom_input_2 col position-relative my-3">
                                <input name="email" type="email" class="border-0 rounded-pill w-100 p-4 back_me my-3" style="background-color: #2eafc61a;">
                                <label>@lang('messages.E-MAIL ADDRESS')</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="custom_input_2 col position-relative my-3">
                                <input name="subject" type="text" class="border-0 rounded-pill w-100 p-4 back_me my-3" style="background-color: #2eafc61a;">
                                <label>@lang('messages.subject')</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="custom_input_2 col position-relative my-3">
                                <textarea name="message" class="border-0 w-100 p-4 back_me my-3" style="background-color: #2eafc61a; border-radius: 30px;" rows="4"></textarea>
                                <label>@lang('messages.details')</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-8 col-lg-5">
                            <button type="submit" class="main_bt transition_me border-0 rounded-pill w-100 py-3 px-2 h4">@lang('messages.Send Message')</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>