
$(document).ready(function () {
    $(".product-container-slider").slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 3000,
        prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fa-solid fa-chevron-left' aria-hidden='true'></i></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><i class='fa-solid fa-chevron-right' aria-hidden='true'></i></button>"
    });
});

$(".slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    arrows: true,
    centerMode: true,
    speed: 500,
    fade: true,
    cssEase: 'linear',
    dragger: true,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow: "<button type='button' class='slick-prev pull-left'><i style='opacity: 1;' class='fa-solid fa-chevron-left' aria-hidden='true'></i></button>",
    nextArrow: "<button type='button' class='slick-next pull-right'><i style='opacity: 1;' class='fa-solid fa-chevron-right' aria-hidden='true'></i></button>"
});

$(document).ready(function () {
    $(".instagram-review-slider").slick({
        slidesToShow: 4,
        slidesToScroll: 4,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        dots: true
    });
});

$(document).ready(function () {
    $(".insta-post-slider").slick({
        slidesToShow: 4,
        slidesToScroll: 4,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        dots: true
    });
});

















