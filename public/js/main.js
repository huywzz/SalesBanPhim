const searchBtn = document.querySelector('.nav--search');
const searchContainer = document.querySelector('.nav__search');

searchBtn.addEventListener('click', function () {
    if (searchContainer.style.display != 'flex') {
        searchContainer.style.display = 'flex';
    } else { 
        searchContainer.style.display = 'none';
    }
})

searchContainer.addEventListener("click", function (event) {
    event.stopPropagation();

});