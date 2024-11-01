const accordion = (triggerSelector, triggerActiveClass,  blockSelector, blockActiveClass) => {
    const btn = document.querySelector(triggerSelector),
        block = document.querySelector(blockSelector);

    block.classList.add('animate__animated');

    btn.addEventListener('click', function () {
        if(btn.classList.contains(triggerActiveClass)) {

            btn.classList.remove(triggerActiveClass);
            block.classList.remove(blockActiveClass);
        } else {
            btn.classList.add(triggerActiveClass);
            block.classList.add(blockActiveClass);
        }
    })
};

export default accordion;
