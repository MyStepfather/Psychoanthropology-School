'use strict';

window.addEventListener('DOMContentLoaded', () => {

    const collapsHandle = (triggerSelector) => {
        const btns = document.querySelectorAll(triggerSelector);
        btns.forEach(btn => {
          if (btn.querySelector('#topic_form_main')) {
            let select = btn.querySelector('#topic_form_main');
            select.addEventListener('change', function() {
              if (select.value !== "Выберите пожалуйста тему") {
                btn.nextElementSibling.style.display = 'block';
              } else {
                btn.nextElementSibling.style.display = 'none';
              }
            })
          }
        });
      };
      collapsHandle('.excludeSelector_on_page');



    //local Storage


    const selectsChooseTopic = document.querySelectorAll('.form_choose_topic'),
        inputsCustomTopic = document.querySelectorAll('.form_custom_topic'),
        selectsToWhom = document.querySelectorAll('.form_to_whom'),
        inputsMessage = document.querySelectorAll('.form_message');


    function getLocalStorage(array, key) {
        if (localStorage.getItem(key)) {
            array.forEach(i => {
                i.value = localStorage.getItem(key)
            })
        }
    }
    getLocalStorage(selectsChooseTopic, 'choose_topic');
    getLocalStorage(inputsCustomTopic, 'custom_topic');
    getLocalStorage(selectsToWhom, 'to_whom');
    getLocalStorage(inputsMessage, 'form_message');

    function setLocalStorage (array, key) {
        array.forEach(item => {
            item.addEventListener('change', () => {
                localStorage.setItem(key, item.value);
                getLocalStorage(array, key);
            });
        });
    }
    setLocalStorage(selectsChooseTopic, 'choose_topic');
    setLocalStorage(inputsCustomTopic, 'custom_topic');
    setLocalStorage(selectsToWhom, 'to_whom');
    setLocalStorage(inputsMessage, 'form_message');



});


