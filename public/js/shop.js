function number_format(number, decimals, dec_point, thousands_point) {

    if (number == null || !isFinite(number)) {
        throw new TypeError("number is not valid");
    }

    if (!decimals) {
        var len = number.toString().split('.').length;
        decimals = len > 1 ? len : 0;
    }

    if (!dec_point) {
        dec_point = '.';
    }

    if (!thousands_point) {
        thousands_point = ',';
    }

    number = parseFloat(number).toFixed(decimals);

    number = number.replace(".", dec_point);

    var splitNum = number.split(dec_point);
    splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
    number = splitNum.join(dec_point);

    return number;
}

var rangeSlider = $(".price-range"),
    minamount = $("#minamount"),
    maxamount = $("#maxamount"),
    minPrice = rangeSlider.data('min'),
    maxPrice = rangeSlider.data('max'),
    minValue = rangeSlider.data('min-value') !== '' ? rangeSlider.data('min-value') : minPrice,
    maxValue = rangeSlider.data('max-value') !== '' ? rangeSlider.data('max-value') : maxPrice;

rangeSlider.slider({
    range: true,
    min: minPrice,
    max: maxPrice,
    values: [minValue, maxValue],
    slide: function (event, ui) {
        // minamount.val(number_format(ui.values[0], 0, '.', ','));
        // maxamount.val(number_format(ui.values[1], 0, '.', ','));
        minamount.val(ui.values[0]);
        maxamount.val(ui.values[1]);
        // var minA = number_format(nA, 0, '.', ',');
        // console.log(minA);
    }
});
// minamount.val(number_format((rangeSlider.slider("values", 0)), 0, '.', ','));
// maxamount.val(number_format((rangeSlider.slider("values", 1)), 0, '.', ','));
minamount.val(rangeSlider.slider("values", 0));
maxamount.val(rangeSlider.slider("values", 1));

var sortSelect = document.querySelector('#sort');
console.log(sortSelect);
sortSelect.addEventListener('change', (e) => { 
    // console.log(e.target.value);
    location.reload();
    // window.location = ....
})