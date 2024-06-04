$(document).ready(function () {

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        // autoplay: true,
        // autoplaySpeed: 3000,
        prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
        asNavFor: '.slider-nav',
    });

    $('.slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        // dots: true,
        arrows: true,
        centerMode: true,
        focusOnSelect: true,
        prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>"
    });


});


const option = document.querySelector('.product-info--select');
const article1 = document.querySelector('.slider-for');


var optionArray = option.children;


optionArray[0].addEventListener('click', function () {
    console.log(optionArray[0].dataset.index);
});

$('.slider-for').on('click', function (e) {
    var currentIndex = $('.slider-for .slick-slide');


    // currentIndex++;
    // $('.caption').html('Slide number: ' + currentIndex);
    console.log(currentIndex);
    // console.log(currentIndex.className());
    // if (optionArray[0].dataset.index == currentIndex) {

    //     $('.slick-current').classList.add('.')
    // }
});


// console.log(formatCash('1234567890')) // 1,234,567,890
// var productInfoPrice = document.querySelector('.product-info__price');
// console.log(productInfoPrice.innerText);

// console.log(formatCash(productInfoPrice.innerText));

// productInfoPrice.innerText = formatCash(productInfoPrice.innerText);




    // var currentIndex = $('.slider-for').attr('data-slick-index');





