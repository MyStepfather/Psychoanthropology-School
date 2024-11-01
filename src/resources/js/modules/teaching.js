let checkboxes = document.querySelectorAll('.checkboxes');
let buyButton = document.querySelector('.archive__list__btn');
if (buyButton) {
    let buyButtonOffsetTop = buyButton.offsetTop;
}

if (checkboxes && buyButton && buyButtonOffsetTop) {
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            let checked = false;
            for (let i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    checked = true;
                    break;
                }
            }
            if (checked) {
                // хоть один чекбокс отмечен
                // изменить стили кнопки "Оплатить"
                buyButton.style.position = 'fixed';
                buyButton.style.bottom = '20px';
            } else {
                // ни один чекбокс не отмечен
                // вернуть исходные стили кнопки "Оплатить"
                buyButton.style.position = 'static';
            }
        });
    });
}
