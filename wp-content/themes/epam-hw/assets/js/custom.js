jQuery(document).ready(function ($) {


    "use strict";


    // Page loading animation

    $("#preloader").animate({
        'opacity': '0'
    }, 600, function () {
        setTimeout(function () {
            $("#preloader").css("visibility", "hidden").fadeOut();
        }, 300);
    });


    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        var box = $('.header-text').height();
        var header = $('header').height();

        if (scroll >= box - header) {
            $("header").addClass("background-header");
        } else {
            $("header").removeClass("background-header");
        }
    });

    if ($('.owl-clients').length) {
        $('.owl-clients').owlCarousel({
            loop: true,
            nav: false,
            dots: true,
            items: 1,
            margin: 30,
            autoplay: false,
            smartSpeed: 700,
            autoplayTimeout: 6000,
            responsive: {
                0: {
                    items: 1,
                    margin: 0
                },
                460: {
                    items: 1,
                    margin: 0
                },
                576: {
                    items: 3,
                    margin: 20
                },
                992: {
                    items: 5,
                    margin: 30
                }
            }
        });
    }

    if ($('.owl-banner').length) {
        $('.owl-banner').owlCarousel({
            loop: true,
            nav: true,
            dots: true,
            items: 3,
            margin: 10,
            autoplay: false,
            smartSpeed: 700,
            autoplayTimeout: 6000,
            responsive: {
                0: {
                    items: 1,
                    margin: 0
                },
                460: {
                    items: 1,
                    margin: 0
                },
                576: {
                    items: 1,
                    margin: 10
                },
                992: {
                    items: 3,
                    margin: 10
                }
            }
        });
    }

    // AJAX send comment 
    $('#comment').on('submit', function (e) {
        e.preventDefault();
        var username = $("input[name=name]").val();
        var email = $("input[name=email]").val();
        var post_id = $("input[name=post_id]").val();
        var comment_text = $("textarea[name=message]").val();

        $.ajax({
            url: ajax_params.ajaxurl,
            method: 'post',
            data: {
                action: 'add_comment',
                username: username,
                post_id: post_id,
                email: email,
                comment_text: comment_text
            },
            success: function (data) {
                if (data == 'success') {
                    $('.success').fadeIn();
                    location.reload();
                }
            }
        })
    });

});
