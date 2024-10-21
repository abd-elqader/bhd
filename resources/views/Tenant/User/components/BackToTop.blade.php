<style>
    .fot_icon1 {
        transition: all 0.3s ease-in-out;
        cursor: pointer;
        text-decoration: none;
        width: 50px;
        height: 50px;
        font-size: 90px;
        background-color: var(--third--color);
        color: var(--second--color);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        position: fixed;
        bottom: 50VH;
        left: -25px;
        z-index: 99;
        border: none;
        font-size: 30px;
        padding-right: 15px;
        padding-left: 15px;
        font-wight: bold;
    }

    .fot_icon1 span {
        position: absolute;
        right: 10px;
        bottom: 2px;
    }


    .fot_icon2 {
        transition: all 0.3s ease-in-out;
        cursor: pointer;
        text-decoration: none;
        width: 50px;
        height: 50px;
        font-size: 90px;
        border-radius: 50%;
        background-color: #00ff0d;
        color: var(--second--color);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .fot_icon2:hover {
        background-color: var(--third--color);
        color: var(--second--color);
    }

    .fot_icon3 {
        justify-content: center;
        transition: all 0.3s ease-in-out;
        cursor: pointer;
        text-decoration: none;
        width: 50px;
        height: 50px;
        font-size: 90px;
        border-radius: 50%;
        background-color: var(--main--color);
        color: black;
        display: flex;
        align-items: center;
        justify-content: center;
        display: none;
        position: fixed;
        bottom: 90px;
        right: 30px;
        z-index: 99;
        border: none;
        font-size: 35px;
        padding-right: 15px;
        padding-left: 15px;
        font-wight: bold;
    }

    .fot_icon3 span {
        position: absolute;
        right: 7px;
        bottom: 7px;
    }

    .fot_icon3:hover {
        background-color: var(--third--color);
        color: var(--second--color);
    }

    .fot_icon4 {
        transition: all 0.3s ease-in-out;
        cursor: pointer;
        text-decoration: none;
        width: 50px;
        height: 50px;
        font-size: 90px;
        border-radius: 50%;
        background-color: #00ff0d;
        color: var(--second--color);
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        bottom: 90px;
        right: 30px;
        z-index: 99;
    }

    .fot_icon4:hover {
        background-color: var(--third--color);
        color: var(--second--color);
    }


    .cart_icon {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 99;
        color: black;
        background: white;
    }

</style>


<button onclick="location.href='{{ route('lang', lang('ar') ? 'en' : 'ar') }}'" class="fot_icon1" id="LangButton">
    <span id="LangIcon">
        <i class="fa-solid fa-globe"></i>
    </span>
    <span id="LangText" style="display:none;right: 9px;bottom: 7px;font-size: 24px;">
        @if (lang('ar'))
            EN
        @else
            AR
        @endif
    </span>
</button>

<a href="{{ route('client.cart') }}" class="cart_icon  fot_icon2">
    <i class="fa-solid fa-cart-shopping h3 cartSymbol"></i>
    <span class="badge2">{{ session()->get('cart') ? count(session()->get('cart')) : 0 }}</span>
</a>


<a id="whatsappbutton" target="_blank" href="https://wa.me/{{ Setting('whatsapp') }}" class=" fot_icon4">
    <i class="fa-brands fa-whatsapp h3 mb-0"></i>
</a>

<button class="fot_icon3" id="scrollTopButton" onclick="scrollToTop()">
    <i class="fas fa-arrow-circle-up"></i>
</button>


<script>
    function scrollToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    $(document).ready(function() {
        window.onscroll = function() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                $('#scrollTopButton').css("display", "flex");
                $('#whatsappbutton').css({bottom: '150px'});
            } else {
                $('#scrollTopButton').css("display", "none");
                $('#whatsappbutton').css({bottom: '90px'});
            }
        };
    });
    
    
    $(document).on('mouseover', '#LangButton', function() {
        $('#LangButton').css({left: 0});
        $('#LangIcon').fadeOut('slow');
        $('#LangText').fadeIn('slow');
    });
    $(document).on('mouseleave', '#LangButton', function() {
        $('#LangButton').css({left: -25});
        $('#LangText').fadeOut('slow');
        $('#LangIcon').fadeIn('slow');
    });

</script>
