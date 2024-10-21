$(function () {
    "use strict";


    $('.custom_input input').on('focusout', function () {

        if ($(this).val() != '') {
            $(this).parent().addClass('has_data');
        } else {
            $(this).parent().removeClass('has_data');
        }

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

    $('#log_in').on('click', function () {

        $(this).fadeOut(500);

    });

    $('#log_in .insert_2').on('click', function (e) {

        e.stopPropagation();

    });

    $('.signup').on('click', function () {

        $('#sign_up').fadeIn(500);

    });

    $('#sign_up').on('click', function () {

        $(this).fadeOut(500);

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
    // $("#amount").val("BHD" + " " + $("#slider-range").slider("values", 0) + " - BHD" + " " + $("#slider-range").slider("values", 1));



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

    Array.prototype.forEach.call($btns, (el, i) => {
        el.addEventListener('click', function (event) {
            $cart.classList.add('add');
            $cart.querySelector('span').innerText = ++count;
            setTimeout(() => {
                $cart.classList.remove('add');
            }, 1500);
        });
    });


    const signInBtn = document.getElementById("signIn");
const signUpBtn = document.getElementById("signUp");
const fistForm = document.getElementById("form1");
const secondForm = document.getElementById("form2");
const container = document.querySelector(".container");

signInBtn.addEventListener("click", () => {
	container.classList.remove("right-panel-active");
});

signUpBtn.addEventListener("click", () => {
	container.classList.add("right-panel-active");
});

fistForm.addEventListener("submit", (e) => e.preventDefault());
secondForm.addEventListener("submit", (e) => e.preventDefault());




    // $('.pro').on('click', function () {

    //     var index = $('.pro').index(this);

    //     $(this).toggleClass('riden');

    //     $('.in_pro').eq(index).slideToggle(500);

    // })


    // $('.my_list_nav .search').on('click', function () {

    //     $(this).toggleClass('is_visible');

    //     if (window.matchMedia(' (max-width: 575.98px) ').matches){

    //         if ($(this).hasClass('is_visible')) {

    //             $('.bt_search').animate({
    //                 width: '340px',
    //             }, 300);

    //         } else {
    //             $('.bt_search').animate({
    //                 width: 0,
    //             }, 300)

    //             $('.bt_search input').animate({
    //                 borderBottom: 'none'
    //             }, 300)
    //         };

    //     };

    //     if (window.matchMedia(' (min-width: 576px) and (max-width: 767.98px) ').matches){

    //         if ($(this).hasClass('is_visible')) {

    //             $('.bt_search').animate({
    //                 width: '420px',
    //             }, 300);

    //         } else {
    //             $('.bt_search').animate({
    //                 width: 0,
    //             }, 300)

    //             $('.bt_search input').animate({
    //                 borderBottom: 'none'
    //             }, 300)
    //         };

    //     };

    //     if (window.matchMedia(' (min-width: 768px) and (max-width: 991.98px) ').matches){

    //         if ($(this).hasClass('is_visible')) {

    //             $('.bt_search').animate({
    //                 width: '600px',
    //             }, 300);

    //         } else {
    //             $('.bt_search').animate({
    //                 width: 0,
    //             }, 300)

    //             $('.bt_search input').animate({
    //                 borderBottom: 'none'
    //             }, 300)
    //         };

    //     };

    //     if (window.matchMedia(' (min-width: 992px) and (max-width: 1199.98px) ').matches){

    //         if ($(this).hasClass('is_visible')) {

    //             $('.bt_search').animate({
    //                 width: '900px',
    //             }, 300);

    //         } else {
    //             $('.bt_search').animate({
    //                 width: 0,
    //             }, 300)

    //             $('.bt_search input').animate({
    //                 borderBottom: 'none'
    //             }, 300)
    //         };

    //     };

    //     if (window.matchMedia(' (min-width: 1200px) ').matches){

    //         if ($(this).hasClass('is_visible')) {

    //             $('.bt_search').animate({
    //                 width: '850px',
    //             }, 300);

    //         } else {
    //             $('.bt_search').animate({
    //                 width: 0,
    //             }, 300)

    //             $('.bt_search input').animate({
    //                 borderBottom: 'none'
    //             }, 300)
    //         };

    //     };

    // });


    // $('.add_order').on('click', function () {

    //     var index = $('.add_order').index(this);

    //     $('.popup').eq(index).fadeIn(500);

    // });

    // $('.popup').on('click', function () {

    //     $(this).fadeOut(500);

    // });

    // $('.popup .insert').on('click', function (e) {

    //     e.stopPropagation();

    // });

    // $('.package').hover(function(){

    //     $('.package .foot .get h5').animate({

    //         width: '50%',
    //         right: '0px'
    //     }, 300)

    // }, function(){

    //     $('.package .foot .get h5').animate({

    //         width: '0%',
    //         right: '-500px'
    //     }, 300)

    // })


    // $(".promotion").on("click", function () {
    //     var index = $(".promotion").index(this);

    //     $(this).toggleClass('is_visible');

    //     if ($(this).hasClass('is_visible')) {

    //         $('.icon-check').toggleClass(".icon-close");

    //         $(this).animate({

    //             backgroundColor: '#b84a57',
    //             color: 'white',
    //         }, 500);

    //         $(".in_promotion").eq(index).slideToggle(500);
    //     } else {
    //         $(this).animate({

    //             backgroundColor: 'none',
    //             color: '#000',
    //         }, 500 );
    //         $(".in_promotion").eq(index).slideToggle(500);
    //     }

    // });





    // $('body').css('paddingTop', $('.nav-link').innerHeight());

    // $('.nav-link').click(function () {

    //     $('html, body').animate({

    //         scrollTop: $('#' + $(this).data('scroll')).offset().top - 50

    //     }, 500);

    // });

    // $(window).scroll(function () {

    //     $('.block').each(function () {

    //         var blockID = $(this).attr('id');

    //         $('.nav-link').removeClass('active');

    //         $('.nav-link[data-scroll="' + blockID + '"]').addClass('active');

    //     });

    // });


    $(".option").click(function () {
        $(".option").removeClass("active");
        $(this).addClass("active");

    });


});


// function openNav() {
//     document.getElementById("mySidebar").style.width = "250px";
//     document.getElementById("main").style.marginLeft = "250px";
// }

// function closeNav() {
//     document.getElementById("mySidebar").style.width = "0";
//     document.getElementById("main").style.marginLeft = "0";
// }



    // $(document).ready(function () {

    //     var scrollButton = $('#scroll-top');

    //     $(window).on('scroll', function () {

    //         if ($(this).scrollTop() >= 600) {

    //             scrollButton.fadeIn(800);

    //         } else {

    //             scrollButton.fadeOut(800);

    //         }

    //     });


    //     scrollButton.on('click', function () {

    //         $('html, body').animate({scrollTop: 0}, 800);

    //     });

    // });
    // $(document).ready(function () {


    //     var whatsAap = $('#whats');
    //     $(window).on('scroll', function () {

    //         if ($(this).scrollTop() >= 600) {

    //             whatsAap.fadeIn(800);

    //         } else {

    //             whatsAap.fadeOut(800);

    //         }

    //     });

    // });







//    $(document).ready(function () {
//        $('.side_bar').mouseenter(function () {
//
//            $('.list_bar').animate({
//
//                right: '0px'
//            }, 500);
//        });
//        $('.list_bar').mouseleave(function () {
//
//            $(this).animate({
//
//                right: '-300px'
//            }, 500);
//        });
//    });



