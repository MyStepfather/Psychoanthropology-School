let maxCount = 12;
let subscribe = document.querySelectorAll('.subscribe__q');

if (subscribe) {
    subscribe.forEach(function(item) {
        let count = parseInt(item.textContent);
        item.closest('.subscribe__wrapper').querySelector('.subscribe__plus').addEventListener('click', function() {
            if (count < maxCount) {
                count++;
                item.textContent = count;
            }
        });
        item.closest('.subscribe__wrapper').querySelector('.subscribe__minus').addEventListener('click', function() {
            if (count > 1) {
                count--;
                item.textContent = count;
            }
        });
    });
}
