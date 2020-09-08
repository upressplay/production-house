import trace from '@tvg/trace';

let menuOpen = false,
    dom = {};

function init() {
    trace.push("init1");
    trace.output();

    dom.nav = document.querySelector("nav");
    dom.header = document.querySelector("header");
    dom.closeBtn = dom.header.querySelector(".close-btn");
    dom.menuBtn = dom.header.querySelector(".menu-btn");

    dom.menuBtn.addEventListener('click', () => {
        openMenu();
    }, false);

    dom.closeBtn.addEventListener('click', () => {
        openMenu();
    }, false);
    

}

/*
    openMenu opens and closes the mobile nav
    */
function openMenu() {
    trace.push('openMenu');

    if (menuOpen) {
        menuOpen = false;

        dom.nav.classList.remove('active');
        dom.closeBtn.classList.remove('active');
    } else {
        menuOpen = true;

        dom.nav.classList.add('active');
        dom.closeBtn.classList.add('active');
    }


}

document.addEventListener("DOMContentLoaded", function () {
	init();
});
