$(function () {
    "use strict";


    $('.custom_input input').on('focusout', function () {

        if ($(this).val() != '') {
            $(this).parent().addClass('has_data');
        } else {
            $(this).parent().removeClass('has_data');
        }

    });
    
    $('.review').on('click', function () {

        $('.popup').fadeIn(500);

    });

    $('.custom_input_2 input').on('focusout', function () {

        if ($(this).val() != '') {
            $(this).parent().addClass('has_data');
        } else {
            $(this).parent().removeClass('has_data');
        }

    });
    $('.custom_input_3 input').on('focusout', function () {

        if ($(this).val() != '') {
            $(this).parent().addClass('has_data');
        } else {
            $(this).parent().removeClass('has_data');
        }

    });
    $('.custom_input textarea').on('focusout', function () {

        if ($(this).val() != '') {
            $(this).parent().addClass('has_data');
        } else {
            $(this).parent().removeClass('has_data');
        }

    });
    $('.custom_input_2 textarea').on('focusout', function () {

        if ($(this).val() != '') {
            $(this).parent().addClass('has_data');
        } else {
            $(this).parent().removeClass('has_data');
        }

    });


    // start style button
    $('.toggle_bt').on('click', function () {

        $(this).toggleClass('transformed');

        if ($(this).hasClass('transformed')) {

            $('.toolbar_list').slideDown(500)
        } else (

            $('.toolbar_list').slideUp(500)
        )

    })


    $('.login').on('click', function () {

        $('#log_in').fadeIn(500);

    });



    $('#log_in .insert_2').on('click', function (e) {

        e.stopPropagation();

    });





    $('.ShowSignUp').on('click', function () {

        $('#signUP').show();
        $('#log_in').hide();
        $('#forgetPass').hide();

    });
    $('.ShowLogin').on('click', function () {

        $('#signUP').hide();
        $('#forgetPass').hide();
        $('#log_in').show();

    });
    $('.forget').on('click', function () {

        $('#log_in').hide();
        $('#signUP').hide();
        $('#forgetPass').show();

    });




    $('.signup').on('click', function () {

        $('#sign_up').fadeIn(500);

    });



    $('#sign_up .insert_2').on('click', function (e) {

        e.stopPropagation();

    });


    $('.icon-heart-outlined').on('click', function () {

        var index = $('.icon-heart-outlined').index(this);

        $(this).eq(index).toggleClass('icon-heart2');

    });


    // $("#slider-range").slider({
    //     range: true,
    //     min: 0,
    //     max: 1000,
    //     values: [200, 800],
    //     slide: function (event, ui) {
    //         $("#amount").val("BHD" + " " + ui.values[0] + " - BHD" + " " + ui.values[1]);
    //     }
    // });
    // $("#amount").val("BHD" + " " + $("#slider-range").slider("values", 0) +" - BHD" + " " + $("#slider-range").slider("values", 1));



    $(document).ready(function () {
        $('.quantity-plus').on('click', function () {
            var index = $('.quantity-plus').index(this);
            var quantity = parseInt($('.input_number').eq(index).val());
            $('.input_number').eq(index).val(quantity + 1);
        });
        $('.quantity-minus').on('click', function () {
            var index = $('.quantity-minus').index(this);
            var quantity = parseInt($('.input_number').eq(index).val());
            if (quantity > 1) {
                $('.input_number').eq(index).val(quantity - 1);
            }
        });
    });


    $('.thumbnails img').on('click', function () {

        'use strict';

        $('.thumbnails img').removeClass('selected');

        $(this).addClass('selected');

        $('.master-img img').attr('src', $(this).attr('src'));

    });

    $('.hover_out').mouseenter(function () {

        var index = $('.hover_out').index(this);

        $('.hover_in:eq(' + index + ')').fadeIn(500);

    });

    $('.hover_in').mouseleave(function () {

        $('.hover_in').fadeOut(500);

    });

    $(".option").click(function(){
        $(".option").removeClass("active");
        $(this).addClass("active");

     });




    /* Demo purposes only */
    $(".hover").mouseleave(
        function () {
            $(this).removeClass("hover");
        }
    );



    $('.top_cat_bt button').click(function () {
        var get_id = this.id;
        var get_current = $('.posts .' + get_id);

        $('.post').not(get_current).fadeOut(200);
        get_current.fadeIn(200);
    });


    $('#all').click(function () {
        $('.post').fadeIn(200);
    });


    let $wrap = document.querySelector('.wrap'),
        $opts = document.querySelectorAll('.bar a');

    Array.prototype.forEach.call($opts, (el, i) => {
        el.addEventListener('click', function (event) {
            $wrap.setAttribute('data-pos', i);
        });
    });

    let count = 0,
        $btns = document.querySelectorAll('.btn'),
        $cart = document.querySelector('.cart');

    // Array.prototype.forEach.call($btns, (el, i) => {
    //     el.addEventListener('click', function (event) {
    //         $cart.classList.add('add');
    //         $cart.querySelector('span').innerText = ++count;
    //         setTimeout(() => {
    //             $cart.classList.remove('add');
    //         }, 1500);
    //     });
    // });


    const signInBtn = document.getElementById("signIn");
    const signUpBtn = document.getElementById("signUp");
    const fistForm = document.getElementById("form1");
    const secondForm = document.getElementById("form2");
    const container = document.querySelector(".container");

    if (signInBtn) {
        signInBtn.addEventListener("click", () => {
            container.classList.remove("right-panel-active");
        });

    }
    if (signUpBtn) {
        signUpBtn.addEventListener("click", () => {
            container.classList.add("right-panel-active");
        });
    }

    $('.in_details li').on('click', function () {

        $(this).addClass('active').siblings().removeClass('active');

    });





    $(".option").click(function(){
        $(".option").removeClass("active", 1000);
        $(this).addClass("active");
    });

});





window.addEventListener('alert', event => {
    swal({
        title: event.detail.message,
        icon: event.detail.type,
        buttons: true,
        dangerMode: true,
    })
});
window.addEventListener('RefreshCartModal', event => {
    $('.badge').html(event.detail.count);
    $('.badge2').html(event.detail.count);
});
$('#scroll').click(function () {
    $("html, body").animate({ scrollTop: 0 }, 000);
    return false;
});

$(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
        $('#scroll').fadeIn();
        $('.side_bar').fadeIn();
    } else {
        $('#scroll').fadeOut();
        $('.side_bar').fadeOut();
    }
});