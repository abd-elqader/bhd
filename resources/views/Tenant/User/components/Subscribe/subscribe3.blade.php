

<style>
    .hero {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2rem;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        height: 100%;
        width: 100%;
    }

    @media (min-width: 700px) {
        .hero {
            padding: 3rem;
        }
    }

    @media (min-width: 1200px) {
        .hero {
            padding: 6rem;
        }
    }

    .hero-inner {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
        max-width: 900px;
        margin: auto;
    }

    @media (min-width: 800px) {
        .hero-inner {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 2rem;
        }
    }

    .hero-inner p,
    .hero h2 {
        color: #fff;
    }

    .hero-button {
        background: #fff;
        color: #444;
        border: 0;
        padding: 1rem 2rem;
        display: inline-block;
        margin-top: 1rem;
    }

    @media (min-width: 700px) {
        .hero-button {
            margin-top: 2rem;
        }
    }

    .hero-image {
        order: -1;
        justify-items: center;
    }

    @media (min-width: 800px) {
        .hero-image {
            order: initial;
        }
    }

    .hero-image img {
        width: 100%;
    }

    .hero-form {
        margin-top: 1rem;
    }

    @media (min-width: 700px) {
        .hero-form {
            margin-top: 2rem;
        }
    }

    .hero-form-input {
        display: grid;
        grid-template-columns: 1fr;
    }

    @media (min-width: 400px) {
        .hero-form-input {
            display: grid;
            grid-template-columns: 1fr auto;
        }
    }

    .hero-email-input {
        padding: 1rem;
        box-sizing: border-box;
    }

    .hero-form-submit {
        background-color: var(--main--color);
        color: #fff;
        border: none;
        padding: 1rem 2rem;
        margin-top: 0.5rem;
    }

    @media (min-width: 400px) {
        .hero-form-submit {
            margin-top: 0;
        }
    }

</style>
<div class="hero">
    <div class="hero-inner">

        <div class="hero-text">
            <form method="post" action="{{ route('client.post_subscribe') }}" class="hero-form">
                @csrf
	            <h2 class="text-dark">@lang('website.subscribe')</h2>
                <div class="hero-form-input">
                    <input class="hero-email-input" type="email" , placeholder="@lang('website.email')" required>
                    <input class="hero-form-submit" type="submit" , value="@lang('messages.send')">
                </div>
            </form>
        </div>

        <div class="hero-image">
            <img src="{{ public_asset('subscribe.png') }}" />
        </div>

    </div>
</div>
