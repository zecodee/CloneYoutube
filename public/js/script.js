var menuIcon = document.querySelector(".menu-icon");
var sidebar = document.querySelector(".sidebar");
var container = document.querySelector(".container");

menuIcon.onclick = function() {
    sidebar.classList.toggle("sm-sidebar");
    container.classList.toggle("lg-container");
}