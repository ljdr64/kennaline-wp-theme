// Control del menú móvil - Script global
document.addEventListener('DOMContentLoaded', function() {
    // Control del menú móvil
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuClose = document.getElementById('mobileMenuClose');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const mobileMenuLinks = document.querySelectorAll('.mobile-menu-link');

    // Validar que los elementos existan
    if (!hamburgerBtn || !mobileMenu || !mobileMenuClose || !mobileMenuOverlay) {
        console.error('Error: No se encontraron los elementos del menú móvil');
        return;
    }

    function openMobileMenu(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('Abriendo menú móvil');
        mobileMenu.classList.add('active');
        mobileMenuOverlay.classList.add('active');
        hamburgerBtn.classList.add('active');
    }

    function closeMobileMenu(e, callback) {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }
        console.log('Cerrando menú móvil');
        mobileMenu.classList.remove('active');
        mobileMenuOverlay.classList.remove('active');
        hamburgerBtn.classList.remove('active');
        
        // Esperar a que termine la animación antes de ejecutar el callback
        if (callback) {
            setTimeout(callback, 300);
        }
    }

    // Agregar event listeners
    hamburgerBtn.addEventListener('click', openMobileMenu);
    mobileMenuClose.addEventListener('click', closeMobileMenu);
    mobileMenuOverlay.addEventListener('click', closeMobileMenu);

    // Cerrar menú al hacer clic en un enlace, pero permitir la navegación
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = link.getAttribute('href');
            
            // Si es un enlace de ancla (#contacto), cerrar el menú y hacer scroll
            if (href.startsWith('#')) {
                e.preventDefault();
                closeMobileMenu(e, function() {
                    const targetId = href.substring(1);
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            } else {
                // Para enlaces externos, prevenir navegación inmediata, cerrar menú y luego navegar
                e.preventDefault();
                closeMobileMenu(e, function() {
                    window.location.href = href;
                });
            }
        });
    });

    // Cerrar menú con la tecla ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });
});
