let navbarToggler = document.querySelector(".burger"),
    myNavbar = document.querySelector(".my-navbar"),
    header = document.querySelector("header"),
    navItems = document.querySelector(".nav-icons"),
    userMenu = document.querySelector(".user-menu");

navbarToggler.onclick = function () {
    myNavbar.classList.toggle("my-navbar--active");
    navbarToggler.classList.toggle("burger--open");
    header.classList.toggle("header--active");
    navItems.classList.toggle("hide-elem");
    document.body.classList.toggle("bgc-white");
};

document.addEventListener("DOMContentLoaded", function () {
    const setWidth = (elementToTrack, elementToSet) => {
        const width = elementToTrack.getBoundingClientRect().width;
        elementToSet.style.width = width + "px";
    };

    const elementToTrack = document.querySelector(".content-section");
    const elementToSet = document.querySelector(".header");

    // setWidth(elementToTrack, elementToSet);

    // window.addEventListener("resize", () => {
    //     setWidth(elementToTrack, elementToSet);
    // });

    function setHeaderPosition() {
        if (
            window.scrollY >= 0 ||
            header.classList.contains("header--active")
        ) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }

        var prevScrollpos = window.scrollY;

        window.onscroll = function () {
            if (userMenu.style.opacity === "0") {
                var currentScrollPos = window.scrollY;
                if (
                    prevScrollpos > currentScrollPos ||
                    currentScrollPos === 0 ||
                    header.classList.contains("header--active")
                ) {
                    header.classList.add("sticky");
                } else {
                    header.classList.remove("sticky");
                }
                prevScrollpos = currentScrollPos;
            }
        };
    }
    // setHeaderPosition();

    function headerFlex() {
        const container = document.querySelector(".header__container");
        const visibleElements = [...container.children].filter(
            (el) => el.offsetParent !== null
        );
        if (visibleElements.length === 1) {
            container.style.justifyContent = "flex-end";
        } else if (visibleElements.length >= 2) {
            container.style.justifyContent = "space-between";
        }
    }

    // headerFlex();
});

const userMenuFunc = () => {
    const userMenuToggler = document.querySelector("#userMenuIco");
    const userMenuCloseElems = userMenu.querySelectorAll(
        "[data-userMenu='closeItem']"
    );

    function userMenuOpen() {
        userMenu.classList.add("active");
    }

    function userMenuClose() {
        userMenu.classList.remove("active");
    }

    userMenuToggler.addEventListener("click", () => {
        userMenuOpen();
    });

    userMenuCloseElems.forEach((elem) => {
        elem.addEventListener("click", () => userMenuClose());
    });
};

userMenuFunc();
