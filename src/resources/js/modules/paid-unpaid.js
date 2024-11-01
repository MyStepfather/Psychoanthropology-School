let unpaidElements = document.querySelectorAll('.months__item--unpaid');
let paidElements = document.querySelectorAll('.months__item--paid');

if (unpaidElements && paidElements) {
    paidElements.forEach(function(paidElement) {
        unpaidElements.forEach(function(unpaidElement) {
            if (paidElement) {
                unpaidElement.style.display = 'none';
            } else {
                unpaidElement.style.display = 'flex';
                paidElement.style.display = 'none';
            }
        });
    });
}
