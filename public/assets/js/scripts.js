//Menu slide
const navSlide = () => {
    const button = document.querySelector(".openSidenav");
    const nav = document.querySelector(".sidenav");
    const buttonClose = document.querySelector(".closeSidenav");
    const background = document.querySelector(".content_bg");
    const body = document.querySelector(".content_bg");

    button.addEventListener('click', () => {
        nav.style.width = "250px";
        background.style.width = "100%";
    });

    buttonClose.addEventListener('click', () => {
        nav.style.width = "0px";
        background.style.width = "0px";
    });

    body.addEventListener('click', () => {
        nav.style.width = "0px";
        background.style.width = "0px";
    });

}


//Execution
window.addEventListener('load', function () {
    navSlide();
})
