const cartBtn = document.querySelector('.js-cart-btn');
const modal = document.querySelector('.js-modal');
const cartContainer = document.querySelector('.js-cart-container');
const btnClose = document.querySelector('.js-cart-close');

function showCart() {
    modal.classList.add("open");
}

function hideCart() {
    modal.classList.remove("open");
}

cartBtn.addEventListener("click", showCart);
btnClose.addEventListener("click", hideCart);

modal.addEventListener("click", hideCart);

cartContainer.addEventListener("click", function (event) {
    event.stopPropagation();

});

// $('input.input-qty').each(function() {
//   var $this = $(this),
//     qty = $this.parent().find('.is-form'),
//     min = Number($this.attr('min')),
//     max = Number($this.attr('max'))
//   if (min == 0) {
//     var d = 0
//   } else d = min
//   $(qty).on('click', function() {
//     if ($(this).hasClass('minus')) {
//       if (d > min) d += -1
//     } else if ($(this).hasClass('plus')) {
//       var x = Number($this.val()) + 1
//       if (x <= max) d += 1
//     }
//     $this.attr('value', d).val(d)
//   })
// })




