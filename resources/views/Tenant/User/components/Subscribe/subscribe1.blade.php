<form method="post" action="{{ route('client.post_subscribe') }}" style="display:contents">
    @csrf
    <div class="subscribe_THREE overflow-auto">
        <div class="parent-wrapper">
            <span class="close-btn glyphicon glyphicon-remove">
                <i class="fa-solid fa-bell"></i>
            </span>
            <div class="subscribe-wrapper">
                <h4>@lang('website.subscribe')</h4>
                <input type="email" name="email" class="subscribe-input" required placeholder="@lang('messages.E-MAIL ADDRESS')">
                <button class="submit-btn">@lang('messages.Submit')</button>
            </div>
        </div>
    </div>
</form>