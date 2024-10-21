
<style>
    .fot_icon2{
        width: 50px;
        height: 50px;
        font-size: 20px;
        border-radius: 50%;
        background-color: #00ff0d;
        color: var(--second--color);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .fot_icon2:hover{
        background-color: var(--third--color);
        color: var(--second--color);
    }

    .fot_icon3{
        width: 50px;
        height: 50px;
        font-size: 20px;
        border-radius: 50%;
        background-color: var(--main--color);
        color: black;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .fot_icon3:hover{
        background-color: var(--third--color);
        color: var(--second--color);
    }


</style>

<a id="whatsappbutton" target="_blank" href="https://wa.me/{{ Setting('whatsapp') }}" style="position: fixed; bottom: 80px; right: 30px;z-index: 99;" class="text-decoration-none point fot_icon2 transition_me">
    <i class="icon-whatsapp h3 mb-0"></i>
</a>

    
<button style="display:none; position: fixed; bottom: 20px; right: 30px;z-index: 99; border: none; font-size: 35px; padding-right: 15px; padding-left: 15px; font-wight: bold;" class=" point fot_icon3 transition_me" id="scrollTopButton" onclick="scrollToTop()" title="Go to top">
    <i class="fas fa-arrow-circle-up" style="    position: absolute;right: 8px;bottom: 7px;"></i>
</button>


<script>
    mybutton = document.getElementById("scrollTopButton");
    whatsapp = document.getElementById("whatsappbutton");

    function scrollToTop(){
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
            whatsapp.style.bottom = '80px';
        } else {
            mybutton.style.display = "none";
            whatsapp.style.bottom = '20px';
        }
    }


    $(document).ready(function () {
        window.onscroll = function() {scrollFunction()};
    });

</script>
<!--BACK TO TOP BUTTON-->