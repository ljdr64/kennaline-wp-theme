<?php

// Remover auto-formateo de contenido
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

/* ===============================
   CARGAR ESTILOS Y SCRIPTS PRINCIPALES
================================ */
function kennaline_enqueue_assets() {
    // Cargar fuentes personalizadas PRIMERO (antes del CSS principal)
    $font_css = "
    @font-face {
        font-family: 'Saira Condensed';
        src: url('" . get_template_directory_uri() . "/assets/fonts/SairaCondensed-Regular.ttf') format('truetype');
        font-weight: 400;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Saira Condensed';
        src: url('" . get_template_directory_uri() . "/assets/fonts/SairaCondensed-Light.ttf') format('truetype');
        font-weight: 300;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Saira Condensed';
        src: url('" . get_template_directory_uri() . "/assets/fonts/SairaCondensed-Medium.ttf') format('truetype');
        font-weight: 500;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Saira Condensed';
        src: url('" . get_template_directory_uri() . "/assets/fonts/SairaCondensed-SemiBold.ttf') format('truetype');
        font-weight: 600;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Saira Condensed';
        src: url('" . get_template_directory_uri() . "/assets/fonts/SairaCondensed-Bold.ttf') format('truetype');
        font-weight: 700;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Saira Condensed';
        src: url('" . get_template_directory_uri() . "/assets/fonts/SairaCondensed-ExtraBold.ttf') format('truetype');
        font-weight: 800;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Saira Condensed';
        src: url('" . get_template_directory_uri() . "/assets/fonts/SairaCondensed-Italic.ttf') format('truetype');
        font-weight: 400;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Saira Condensed';
        src: url('" . get_template_directory_uri() . "/assets/fonts/SairaCondensed-BoldItalic.ttf') format('truetype');
        font-weight: 700;
        font-style: italic;
        font-display: swap;
    }
    ";
    
    // Cargar CSS principal
    wp_enqueue_style(
        'kennaline-main-style',
        get_template_directory_uri() . '/styles.css',
        [],
        '1.0'
    );
    
    // Agregar las fuentes como CSS inline después de cargar el CSS principal
    wp_add_inline_style('kennaline-main-style', $font_css);
    
    // Cargar script del menú móvil globalmente
    wp_enqueue_script(
        'kennaline-mobile-menu',
        get_template_directory_uri() . '/mobile-menu.js',
        [],
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'kennaline_enqueue_assets');

/* ===============================
   CSS POR PÁGINA
================================ */
function kennaline_page_styles() {
    // Hacer que los CSS de página dependan del CSS principal para asegurar que las fuentes estén cargadas
    
    if (is_page('nosotros')) {
        wp_enqueue_style(
            'nosotros-style',
            get_template_directory_uri() . '/css/nosotros.css',
            ['kennaline-main-style'], // Dependencia: se carga después del CSS principal
            '1.0'
        );
    }
    
    if (is_page('productos')) {
        wp_enqueue_style(
            'productos-style',
            get_template_directory_uri() . '/css/productos.css',
            ['kennaline-main-style'], // Dependencia: se carga después del CSS principal
            '1.0'
        );
    }

    if (is_page('fresas-integrales-metal-duro')) {
        wp_enqueue_style(
            'fresas-integrales-metal-duro-style',
            get_template_directory_uri() . '/css/fresas-integrales-metal-duro.css',
            ['kennaline-main-style'], // Dependencia: se carga después del CSS principal
            '1.0'
        );
    }
    
    if (is_page('servicios')) {
        wp_enqueue_style(
            'servicios-style',
            get_template_directory_uri() . '/css/servicios.css',
            ['kennaline-main-style'], // Dependencia: se carga después del CSS principal
            '1.0'
        );
    }
    
    if (is_page('soluciones')) {
        wp_enqueue_style(
            'soluciones-style',
            get_template_directory_uri() . '/css/soluciones.css',
            ['kennaline-main-style'], // Dependencia: se carga después del CSS principal
            '1.0'
        );
    }
    
    if (is_page('clientes')) {
        wp_enqueue_style(
            'clientes-style',
            get_template_directory_uri() . '/css/clientes.css',
            ['kennaline-main-style'], // Dependencia: se carga después del CSS principal
            '1.0'
        );
    }
}
add_action('wp_enqueue_scripts', 'kennaline_page_styles');

/* ===============================
   SCRIPTS POR PÁGINA
================================ */
function kennaline_page_scripts() {
    
    // Agregar scripts específicos por página si es necesario
    // Ejemplo:
    // if (is_page('productos')) {
    //     wp_enqueue_script(
    //         'productos-js',
    //         get_template_directory_uri() . '/js/productos.js',
    //         [],
    //         '1.0',
    //         true
    //     );
    // }
}
add_action('wp_enqueue_scripts', 'kennaline_page_scripts');
