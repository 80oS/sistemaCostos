// resources/js/preloader.js

export function initPreloader() {
    // Mostrar preloader
    function showPreloader() {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.style.display = 'flex';
            preloader.classList.remove('fade-out');
        }
    }

    // Ocultar preloader
    function hidePreloader() {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.classList.add('fade-out');
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        }
    }

    // Eventos para navegación normal
    window.addEventListener('load', hidePreloader);

    // Eventos para navegación con AJAX
    document.addEventListener('ajax:send', showPreloader);
    document.addEventListener('ajax:complete', hidePreloader);

    // Eventos para Turbo/Hotwire si los usas
    document.addEventListener('turbo:load', hidePreloader);
    document.addEventListener('turbo:visit', showPreloader);

    // Interceptar enlaces para mostrar el preloader
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (link && !e.ctrlKey && !e.shiftKey && !e.metaKey && !e.defaultPrevented) {
            showPreloader();
        }
    });

    // Interceptar envíos de formularios
    document.addEventListener('submit', function(e) {
        if (!e.defaultPrevented) {
            showPreloader();
        }
    });
}