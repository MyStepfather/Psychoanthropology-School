const popupOpenCourseRead = document.querySelector('#open_course_read');

if(popupOpenCourseRead) {
    checkBoxesCourse = popupOpenCourseRead.querySelectorAll('input[type="checkbox"]'),
    popoverOpenCourse = popupOpenCourseRead.querySelector('.course_read__popover'),
    placeForNumberCourse = popoverOpenCourse.querySelector('.course_read_selected');
}

if (popupOpenCourseRead && checkBoxesCourse && popoverOpenCourse && placeForNumberCourse) {
    checkBoxesCourse.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            popoverOpenCourse.style.display= 'flex';
            let selectedNumber = checkbox.name;
            let span = document.createElement('span');
            span.innerHTML = selectedNumber + ' ';
            placeForNumberCourse.appendChild(span);
        })
    })
}
