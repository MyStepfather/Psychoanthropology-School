let browser = window.innerHeight,
    overlay = document.querySelector("#overlay"),
    wrapper = document.querySelector('.lk-modals');

// Написать в школу
// function schoolModal() {
//     let schoolModal = document.querySelector("#form_to_school_modal"),
//         btnSchool = document.querySelector(".btn-school"),
//         closeCross = document.querySelector(".mod-close-cross");

    // function schoolOpenModal() {
    //     btnSchool.addEventListener('click', function () {
    //         let modals = document.querySelectorAll('.mod');
    //         modals.forEach(modal => {
    //             if (modal.classList.contains('lk-mod-vis')) {
    //                 modal.classList.remove('lk-mod-vis');
    //             }
    //         })
    //         schoolModal.classList.add('lk-mod-vis');
    //         overlay.style.opacity = '1';
    //         overlay.style.zIndex = '500';
    //         overlay.style.backgroundColor = 'rgba(0,0,0,0.7)';
    //         document.body.classList.add('overflow-hidden');
    //         document.querySelector('html').classList.add('overflow-hidden');
    //     })
    // }
    // schoolOpenModal();

    // function schoolCloseModal() {
    //     overlay.addEventListener('click', function () {
    //         overlay.style.opacity = '0';
    //         overlay.style.zIndex = '-1';
    //         schoolModal.classList.remove('lk-mod-vis');
    //         document.body.classList.remove('overflow-hidden');
    //         document.querySelector('html').classList.remove('overflow-hidden');
    //     });
    //     closeCross.addEventListener('click', function () {
    //         overlay.style.opacity = '0';
    //         overlay.style.zIndex = '-1';
    //         schoolModal.classList.remove('lk-mod-vis');
    //         document.body.classList.remove('overflow-hidden');
    //         document.querySelector('html').classList.remove('overflow-hidden');
    //     })
    // }
    // schoolCloseModal()
// }
// schoolModal();

// Группа чтения
function readingModal() {
    let readingModalElem = document.querySelector("#modal-reading"),
        btnReading = document.querySelector(".mod-btn-reading-trig"),
        crossReading = document.querySelector(".mod-cross-reading");
    if (readingModalElem && btnReading && crossReading && wrapper) {
        function readingOpenModal() {
            btnReading.addEventListener("click", function () {
                readingModal.classList.add("lk-mod-vis");
                wrapper.classList.add('lk-modals--active');
                document.body.classList.add("overflow-hidden");
                document.querySelector("html").classList.add("overflow-hidden");
            });
        }
        readingOpenModal();

        function readingCloseModal() {
            crossReading.addEventListener("click", function () {
                readingModalElem.classList.remove("lk-mod-vis");
                wrapper.classList.remove('lk-modals--active');
                document.body.classList.remove("overflow-hidden");
                document.querySelector("html").classList.remove("overflow-hidden");
            });
        }
        readingCloseModal();
    }
}

readingModal();

// Модальное окно Изменения в группе
function changesModal() {
    let changesModal = document.querySelector("#form_to_group_change");
    let btnChanges = document.querySelector("#group-tools_changes");
    let crossChanges = document.querySelector(".cross-changes");

    if (changesModal && btnChanges && crossChanges && wrapper) {
        btnChanges.addEventListener("click", function () {
            //передача данных в livewirecomponent
            const groupId = btnChanges.getAttribute("data-id-group");
            Livewire.emit("groupChangesSelected", groupId);
            changesOpenModal();
            // if (document.body.clientWidth < 642) {
            //     openModalMobile();
            // } else {
            //     openModalDesktop();
            // }
        });
        // function openModalDesktop() {
            function changesOpenModal() {
                // let height = null;
                // let container = document.querySelector(".for-group-changes-modal");

                changesModal.classList.add("lk-mod-vis");
                wrapper.classList.add('lk-modals--active');
            //     let observer = new ResizeObserver(function (entries) {
            //         for (let entry of entries) {
            //             height = entry.contentRect.height;
            //             changesModal.style.top = +height - 255.5 + "px";
            //         }
            //     });
                // observer.observe(container);
            }

            function changesCloseModal() {
                crossChanges.addEventListener("click", function () {
                    changesModal.classList.remove("lk-mod-vis");
                    wrapper.classList.remove('lk-modals--active');
                });
            }
            changesCloseModal();
        // }

        // function openModalMobile() {
        //     function changesOpenModal() {
        //         changesModal.classList.add("lk-mod-vis");
        //         changesModal.style.top = "0px";
        //         document.body.classList.add("overflow-hidden");
        //         document.querySelector("html").classList.add("overflow-hidden");
        //     }
        //     changesOpenModal();
        //
        //     function changesCloseModal() {
        //         crossChanges.addEventListener("click", function () {
        //             changesModal.classList.remove("lk-mod-vis");
        //             document.body.classList.remove("overflow-hidden");
        //             document
        //                 .querySelector("html")
        //                 .classList.remove("overflow-hidden");
        //         });
        //     }
        //     changesCloseModal();
        // }
    }
}
changesModal();

let crossChanges = document.querySelector(".cross-changes");
if (crossChanges) {
    window.addEventListener("closeChangesModal", (event) => {
        crossChanges.click();
    });
}

// Модальное окно -Карточка ученика
// реализация подгрузки данных в livewire-component
function studentCardModal() {
    let studentModal = document.querySelector(".mod-container-student");
    let btnStudent = document.querySelectorAll(
        '[data-bs-target="#student_card"]'
    );
    let crossStudent = document.querySelector(".cross-student");

    let container = document.querySelector(".for-group-changes-modal");

    if (studentModal && btnStudent && crossStudent && container && wrapper) {
        // let observer = new ResizeObserver(function (entries) {
        //     let height;
        //     for (let entry of entries) {
        //         height = entry.contentRect.height;
        //         studentModal.style.top = +height - 255.5 + "px";
        //     }
        // });

        btnStudent.forEach(function (btnTrig) {
            btnTrig.addEventListener("click", function () {
                //передача данных в livewirecomponent
                const userId = btnTrig.getAttribute("data-id-student");
                Livewire.emit("userSelected", userId);

                // if (document.body.clientWidth > 642) {
                    function openModalDesktop() {
                        studentModal.classList.add("lk-mod-vis");
                        wrapper.classList.add('lk-modals--active');
                        // observer.observe(container);
                    }
                    openModalDesktop();

                    function closeModalDesktop() {
                        crossStudent.addEventListener("click", function () {
                            studentModal.classList.remove("lk-mod-vis");
                            wrapper.classList.remove('lk-modals--active');
                            // observer.disconnect();
                        });
                    }
                    closeModalDesktop();
                // } else {
                //     function openModalMob() {
                //         studentModal.classList.add("lk-mod-vis");
                //         studentModal.style.top = "0px";
                //         document.body.classList.add("overflow-hidden");
                //         document
                //             .querySelector("html")
                //             .classList.add("overflow-hidden");
                //     }
                //     openModalMob();
                //
                //     function closeModalMob() {
                //         crossStudent.addEventListener("click", function () {
                //             studentModal.classList.remove("lk-mod-vis");
                //             document.body.classList.remove("overflow-hidden");
                //             document
                //                 .querySelector("html")
                //                 .classList.remove("overflow-hidden");
                //         });
                //     }
                //     closeModalMob();
                // }
            });
        });
    }
}
studentCardModal();

// Модальное окно -Карточка ученика
// реализация подгрузки данных в livewire-component
function coordinatorCardModal() {
    let coordinatorModal = document.querySelector(".mod-container-coordinator");
    let btnCoordinator = document.querySelectorAll(
        '[data-bs-target="#coordinator_card"]'
    );
    let crossCoordinator = document.querySelector(".cross-coordinator");
    if (coordinatorModal && btnCoordinator && crossCoordinator && wrapper) {

        btnCoordinator.forEach(function (btnTrig) {
            btnTrig.addEventListener("click", function () {
                //передача данных в livewirecomponent
                const groupId = btnTrig.getAttribute("data-id-group");
                console.log(groupId)
                Livewire.emit("groupSelector", groupId);

                // if (document.body.clientWidth > 642) {
                    function openModalDesktop() {
                        coordinatorModal.classList.add("lk-mod-vis");
                        wrapper.classList.add("lk-modals--active")
                    }
                    openModalDesktop();

                    function closeModalDesktop() {
                        crossCoordinator.addEventListener("click", function () {
                            coordinatorModal.classList.remove("lk-mod-vis");
                            wrapper.classList.remove("lk-modals--active");
                        });
                    }
                    closeModalDesktop();
                // } else {
                //     function openModalMob() {
                //         coordinatorModal.classList.add("lk-mod-vis");
                //         coordinatorModal.style.top = "0px";
                //         document.body.classList.add("overflow-hidden");
                //         document
                //             .querySelector("html")
                //             .classList.add("overflow-hidden");
                //     }
                //     openModalMob();
                //
                //     function closeModalMob() {
                //         crossCoordinator.addEventListener("click", function () {
                //             coordinatorModal.classList.remove("lk-mod-vis");
                //             document.body.classList.remove("overflow-hidden");
                //             document
                //                 .querySelector("html")
                //                 .classList.remove("overflow-hidden");
                //         });
                //     }
                //     closeModalMob();
                // }
            });
        });
    }
}
coordinatorCardModal();

// Модальное окно -Настройки группы
// реализация подгрузки данных в livewire-component
function settingsModal() {
    let settingsModal = document.querySelector("#form_to_group_settings");
    let btnSettings = document.querySelectorAll(".group__settings-btn");
    let crossSettings = document.querySelector(".close-settings-modal");
    let container = document.querySelector(".for-group-changes-modal");

    if (settingsModal && btnSettings && crossSettings && container && wrapper) {
        // let observer = new ResizeObserver(function (entries) {
        //     for (let entry of entries) {
        //         let heightChange = entry.contentRect.height;
        //         height = heightChange;
        //         settingsModal.style.top = +height - 310 + "px";
        //     }
        // });

        btnSettings.forEach((btn) => {
            btn.addEventListener("click", function () {
                //передача данных в livewirecomponent
                const groupId = btn.getAttribute("data-id-group");
                Livewire.emit("groupSelected", groupId);

                // if (document.body.clientWidth > 641) {
                    function openModalDesktop() {
                        settingsModal.classList.add("lk-mod-vis");
                        wrapper.classList.add("lk-modals--active");

                        // observer.observe(container);
                    }
                    openModalDesktop();

                    function closeModalDesktop() {
                        crossSettings.addEventListener("click", function () {
                            settingsModal.classList.remove("lk-mod-vis");
                            wrapper.classList.remove("lk-modals--active");
                            // observer.disconnect();
                        });
                    }
                    closeModalDesktop();
                // } else {
                //     function openModalMob() {
                //         // if (observer) {
                //         //     observer.disconnect();
                //         // }
                //         document.body.classList.add("overflow-hidden");
                //         document
                //             .querySelector("html")
                //             .classList.add("overflow-hidden");
                //     }
                //     openModalMob();
                //
                //     function closeModalMob() {
                //         crossSettings.addEventListener("click", function () {
                //             document.body.classList.remove("overflow-hidden");
                //             document
                //                 .querySelector("html")
                //                 .classList.remove("overflow-hidden");
                //         });
                //     }
                //     closeModalMob();
                // }
            });
        });
    }
}
settingsModal();



let closeSettingsModal = document.querySelector(".close-settings-modal")
if (closeSettingsModal) {
    window.addEventListener("closeSettingsModal", (event) => {
        closeSettingsModal.click();
    });
}
