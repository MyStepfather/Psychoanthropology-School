
const tabs = (headerSelector, tabSelector, contentSelector, activeClassBtn, display = 'block') => {
    const header = document.querySelector(headerSelector),
        tab = document.querySelectorAll(tabSelector),
        content = document.querySelectorAll(contentSelector);

    function hideTabContent() {
        content.forEach(item => {
            item.style.display = 'none';
        });

        tab.forEach(item => {
            item.classList.remove(activeClassBtn);
        })
    }

    function showTabContent(i = 0) {
        content[i].style.display = display;

        tab[i].classList.add(activeClassBtn);
    }

    hideTabContent();
    showTabContent(0);

    header.addEventListener('click', (e) => {
        const target = e.target;
        if (target &&
            (target.classList.contains(tabSelector.replace(/\./, '')) ||
                target.parentNode.classList.contains(tabSelector.replace(/\./, '')))) {
            tab.forEach((item, i) => {
                if (target == item || target.parentNode == item) {
                    hideTabContent();
                    showTabContent(i);
                }
            });
        }
    });
};

const tabsNewFunc = (btnClass, contentClass, buttonActiveClass, contentActiveClass) => {
    const tabsBtn = document.querySelectorAll(btnClass);
    const contentTabs = document.querySelectorAll(contentClass);
    if (tabsBtn && contentTabs) {
        for (let i = 0; i < tabsBtn.length; i++) {
            tabsBtn[i].addEventListener('click', () => {
                tabsBtn.forEach(el => el.classList.remove(buttonActiveClass))
                contentTabs.forEach(el => el.classList.remove(contentActiveClass))
                tabsBtn[i].classList.add(buttonActiveClass)
                contentTabs[i].classList.add(contentActiveClass)
            })
        }
    }
}

const tabsWithPagination = (btnClass, contentClass, buttonActiveClass, contentActiveClass) => {
    const tabsBtn = document.querySelectorAll(btnClass);
    const contentTabs = document.querySelectorAll(contentClass);
    if (tabsBtn && contentTabs) {
        for (let i = 0; i < tabsBtn.length; i++) {
            tabsBtn[i].addEventListener('click', () => {
                tabsBtn.forEach(el => el.classList.remove(buttonActiveClass))
                contentTabs.forEach(el => el.classList.remove(contentActiveClass))
                const url = new URL(window.location.href);
                url.searchParams.delete('page');
                history.pushState({}, '', url.toString());
                tabsBtn[i].classList.add(buttonActiveClass)
                contentTabs[i].classList.add(contentActiveClass)
            })
        }
    }
}


//tabs ('.tab_about', '.tab__about-btn', '.tab__about-content', 'tab__btn-active');
//tabs ('#menu_tab__about', '.menu_tab__about-btn', '.tab__about-content', 'menu_point-active');
//tabs ('.menu__teaching-tabs', '.menu__teaching-tab', '.menu__teaching__content', 'menu_point-active'); /* - teaching menu tabs */
//tabs ('.teaching__tabs', '.teaching__tab', '.teaching__tab__content', 'teaching__tab-active'); /* - teaching page tabs */
//tabs ('.exercises__tabs', '.exercises__tab', '.exercises__tab__content', 'exercises__tab-active'); /* -teaching exercises tabs */
//tabs ('.stans-songs__tabs', '.stans-songs__tab', '.stans-songs__tab__content', 'stans-songs__tab-active');/*  - teaching stans and songs tabs */
//tabs('.menu__shop-tabs', '.menu__shop-tab', '.menu__shop__content', 'menu_point-active'); /* - shop menu tabs */
//tabs('.shop__tabs', '.shop__tab', '.shop__tab__content', 'shop__tab-active'); /* - shop page tabs */

/*
    Код к странице teaching
*/
tabsNewFunc('.tab__btn.exercises__tab', '.exercises__tab__content.collapse', 'exercises__tab-active', 'show');
tabsNewFunc('.tab__btn.item-song__tab', '.item-song-tab__content.collapse', 'item-song__tab-active', 'show');
tabsWithPagination('.tab__btn.stans-songs__tab', '.stans-songs__tab__content.collapse', 'stans-songs__tab-active', 'show');

