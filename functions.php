<?php

// Remover auto-formateo de contenido
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

/* ===============================
   CARGAR ESTILOS Y SCRIPTS PRINCIPALES
================================ */
function kennaline_enqueue_assets() {
    // Cargar CSS principal
    wp_enqueue_style(
        'kennaline-main-style',
        get_template_directory_uri() . '/styles.css',
        [],
        '1.0'
    );
    
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
    
    if (is_page('nosotros')) {
        wp_enqueue_style(
            'nosotros-style',
            get_template_directory_uri() . '/css/nosotros.css',
            [],
            '1.0'
        );
    }
    
    if (is_page('productos')) {
        wp_enqueue_style(
            'productos-style',
            get_template_directory_uri() . '/css/productos.css',
            [],
            '1.0'
        );
    }
    
    if (is_page('servicios')) {
        wp_enqueue_style(
            'servicios-style',
            get_template_directory_uri() . '/css/servicios.css',
            [],
            '1.0'
        );
    }
    
    if (is_page('soluciones')) {
        wp_enqueue_style(
            'soluciones-style',
            get_template_directory_uri() . '/css/soluciones.css',
            [],
            '1.0'
        );
    }
    
    if (is_page('clientes')) {
        wp_enqueue_style(
            'clientes-style',
            get_template_directory_uri() . '/css/clientes.css',
            [],
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
