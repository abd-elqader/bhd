<style>
    .foot_links{
        color: var(--second--color);
    }
    .foot_links:hover{
        color: var(--main--color);
    }
</style>


<footer>
    <div class="top_header">
        <section>
            <span><i class="fa fa-map-marker"></i></span>
            <span class="mx-2">
                <a href="tel:+{{ setting('phone') }}" class="foot_links transition_me">
                    {!! setting('address_'.lang()) !!}
                </a>
            </span>
        </section>
        <section>
            <span><i class="fa fa-phone"></i></span>
            <span class="mx-2">
                <a href="tel:+{{ setting('phone') }}" class="foot_links transition_me">
                    {{ setting('phone') }}
                </a>
            </span>
        </section>
        <section>
            <span><i class="fa fa-envelope"></i></span>
            <span class="mx-2">
                <a href="tel:+{{ setting('email') }}" class="foot_links transition_me">
                    {{ setting('email') }}
                </a>
            </span>
        </section>
    </div>
    <span class="border-shape"></span>
    <div class="bottom_content">
        <section>
            <a href="{{ setting('facebook') }}"><i class="fa-brands fa-facebook"></i></a>
            <a href="{{ setting('instagram') }}"><i class="fa-brands fa-instagram"></i></a>
            <a href="{{ setting('twitter') }}"><i class="fa-brands fa-twitter"></i></a>
            <a href="{{ setting('snapchat') }}"><i class="fa-brands fa-snapchat"></i></a>
        </section>
        <section>
            <a href="{{ route('client.home') }}">@lang('website.home')</a>
            <a href="{{ route('client.about') }}">@lang('website.about') us</a>
            <a href="{{ route('client.profile','index') }}">@lang('website.myOrder')</a>
            <a href="{{ route('client.categories') }}">@lang('website.categories')</a>
            <a href="{{ route('client.contact') }}">@lang('website.contact')</a>
        </section>
    </div>
</footer>
