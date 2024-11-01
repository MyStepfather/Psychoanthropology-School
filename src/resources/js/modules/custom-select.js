document.addEventListener('livewire:load', function () {
    initDropdowns();
});

document.addEventListener('livewire:update', function () {
    console.log('Livewire component updated');
    initDropdowns(); // Перезапуск логики для селектов после обновления Livewire
});

function initDropdowns() {
    console.log("Initializing dropdowns...");
    let dropdowns = document.querySelectorAll(".dropdown");

    console.log("Found dropdowns:", dropdowns); // Проверь, находятся ли дропдауны

    dropdowns.forEach(function (dropdown) {
        let selected = dropdown.querySelector(".dropdown__selected");
        let list = dropdown.querySelector(".dropdown__list");

        if (selected && list) {
            console.log("Initializing dropdown:", selected);

            // Удаление предыдущих обработчиков для предотвращения дублирования
            selected.removeEventListener("click", toggleDropdown); 
            selected.addEventListener("click", toggleDropdown);

            list.removeEventListener("click", selectDropdownItem);
            list.addEventListener("click", selectDropdownItem);
        } else {
            console.warn("Dropdown elements not found", dropdown);
        }
    });

    setValues(); // Обновление значений input'ов
}

function toggleDropdown(event) {
    console.log("Toggling dropdown...");
    const list = event.target.nextElementSibling;
    const selected = event.target;

    list.classList.toggle("visible");
    selected.classList.toggle("dropdown__selected--active");
}

function selectDropdownItem(event) {
    console.log("Selecting dropdown item...");
    const selected = event.target.closest(".dropdown").querySelector(".dropdown__selected");
    const list = event.target.closest(".dropdown__list");

    selected.textContent = event.target.textContent;

    // Проверка на выбор дня недели
    if (event.target.hasAttribute('data-day')) {
        const selectedDay = event.target.getAttribute('data-day');
        Livewire.emit('daySelected', selectedDay); // Отправка события в Livewire
    }

    list.querySelectorAll(".selected").forEach(item => item.classList.remove("selected"));
    event.target.classList.add("selected");

    list.classList.remove("visible");
    selected.classList.remove("dropdown__selected--active");
}

function setValues() {
    let selects = document.querySelectorAll(".dropdown");

    selects.forEach((select) => {
        const optionsList = select.querySelector(".dropdown__list");
        let selectedOption = select.querySelector(".dropdown__selected");
        const input = select.querySelector("input");

        optionsList.addEventListener("click", () => {
            let value = getValue(selectedOption);
            if (input.getAttribute('name') === 'birthday_month') {
                input.value = monthMap.get(value);
            } else {
                input.value = value;
            }
        });
    });

    function getValue(item) {
        return item.textContent.trim(); // Удаление лишних пробелов
    }
}
