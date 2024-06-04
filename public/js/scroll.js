window.onscroll = function () {
    scrollFunction();
};
function scrollFunction() {
    if (
        document.body.scrollTop > 600 ||
        document.documentElement.scrollTop > 600
    ) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }

    if (document.body.scrollTop > 200 ||
        document.documentElement.scrollTop > 200)
    { 
        document.getElementById("header").style.height = "60px";
        document.querySelector(".logo img").style.width = "150px";
    } else {
        document.getElementById("header").style.height = "90px";
        document.querySelector(".logo img").style.width = "180px";
    }
}
document.getElementById("myBtn").addEventListener("click", function () {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
});