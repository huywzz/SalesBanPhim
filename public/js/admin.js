

page = window.location.pathname.split('/')[2];
document.querySelectorAll('.sidebar-admin li').forEach(element => {
    if (element.dataset.namepage == page) {
        element.querySelector('a').classList.add('nav-active');
    }
})