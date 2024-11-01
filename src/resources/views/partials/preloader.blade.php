<div id="preloader">
    <div id="loader"></div>
</div>

<style>
    .content-section {
        display: none;
    }

    #preloader {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: rgba(255, 255, 255, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #loader {
        border: 6px solid #f3f3f3;
        border-top: 6px solid #3498db;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<script>
    window.addEventListener('load', function() {
        // скрываем прелоадер после полной загрузки страницы
        const preloader = document.getElementById('preloader');
        preloader.style.display = 'none';
        const contentSection = document.querySelector('.content-section');
        contentSection.style.display = 'block';
    });

    // Показываем прелоадер при выполнении определенной задачи
    // Например, при отправке данных на сервер
    function showPreloader() {
        const preloader = document.getElementById('preloader');
        preloader.style.display = 'flex';
    }

    // Вызов функции showPreloader перед выполнением задачи, которая требует прелоадера
</script>
