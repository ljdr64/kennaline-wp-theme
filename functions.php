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

    // CSS por categoría de producto (WooCommerce)
    if (is_product_category()) {
        $category = get_queried_object();
        $category_slug = $category->slug;
        
        // Mapeo de slugs de subcategorías a sus archivos CSS
        $category_css_map = [
            // PERFORADO
            'brocas-integrales-de-metal-duro' => 'categoria-producto',
            'brocas-modulares' => 'categoria-producto',
            'brocas-con-insertos-intercambiables' => 'categoria-producto',
            
            // FRESADO
            'fresas-integrales-de-metal-duro' => 'categoria-producto',
            'fresas-de-planeado' => 'categoria-producto',
            'fresas-de-escuadrado' => 'categoria-producto',
            'fresas-de-alto-avance' => 'categoria-producto',
            
            // TORNEADO
            'torneado-interior' => 'categoria-producto',
            'torneado-exterior' => 'categoria-producto',
            'ranurado-y-tronzado' => 'categoria-producto',
            'perfilado-de-precision' => 'categoria-producto',
            
            // ROSCADO
            'torneado-de-rosca' => 'categoria-producto',
            'fresado-de-rosca' => 'categoria-producto',
            'roscado-con-machos' => 'categoria-producto',
        ];
        
        // Cargar CSS si existe para esta categoría
        if (isset($category_css_map[$category_slug])) {
            $css_file = $category_css_map[$category_slug];
            wp_enqueue_style(
                $css_file . '-category-style',
                get_template_directory_uri() . '/css/' . $css_file . '.css',
                ['kennaline-main-style'],
                '1.0'
            );
        }
    }
    
    // CSS para página individual de producto (WooCommerce)
    if (is_singular('product') || (function_exists('is_product') && is_product())) {
        wp_enqueue_style(
            'single-product-style',
            get_template_directory_uri() . '/css/single-product.css',
            ['kennaline-main-style'],
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


/* ===============================
   WOOCOMMERCE: SOPORTE DEL TEMA
================================ */
function kennaline_woocommerce_setup() {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'kennaline_woocommerce_setup');

/* ===============================
   WOOCOMMERCE: CONFIGURACIÓN PARA PRODUCTOS INDIVIDUALES
================================ */
// Configurar productos individuales: wrappers, remover elementos por defecto, etc.
add_action('template_redirect', 'kennaline_setup_single_product');
function kennaline_setup_single_product() {
    if (!is_product()) {
        return;
    }
    
    // Remover wrappers por defecto y agregar personalizados
    remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    add_action('woocommerce_before_main_content', 'kennaline_wrapper_start', 10);
    add_action('woocommerce_after_main_content', 'kennaline_wrapper_end', 10);
    
    // Remover breadcrumb
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    
    // Remover sidebar
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    
    // Remover meta del producto
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    
    // Remover todas las acciones por defecto del summary para layout limpio
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
}

// Remover breadcrumb en categorías de productos
add_action('template_redirect', 'kennaline_remove_breadcrumb_categories');
function kennaline_remove_breadcrumb_categories() {
    if (is_product_category() || is_product_taxonomy()) {
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    }
}

function kennaline_wrapper_start() {
    echo '<div class="woocommerce">';
}

function kennaline_wrapper_end() {
    echo '</div>';
}

// Remover pestañas de valoraciones en productos individuales
add_filter('woocommerce_product_tabs', 'kennaline_remove_product_tabs', 98);
function kennaline_remove_product_tabs($tabs) {
    if (is_product()) {
        unset($tabs['reviews']);
    }
    return $tabs;
}

/* ===============================
   WOOCOMMERCE: AGREGAR HERO EN CATEGORÍAS DE PRODUCTOS
================================ */
function kennaline_product_category_hero() {
    // Detectar por URL o por categoría de WooCommerce
    $current_url = $_SERVER['REQUEST_URI'];
    $is_category_page = false;
    $category_slug = '';
    
    // Verificar si es una categoría de WooCommerce
    if (is_product_category()) {
        $category = get_queried_object();
        $category_slug = $category->slug;
        $is_category_page = true;
    }
    // Verificar si la URL contiene /kennaline/categoria-producto/
    elseif (strpos($current_url, '/kennaline/categoria-producto/') !== false) {
        // Extraer el slug de la URL
        $url_parts = explode('/kennaline/categoria-producto/', $current_url);
        if (isset($url_parts[1])) {
            $category_slug = trim($url_parts[1], '/');
            $is_category_page = true;
        }
    }
    
    if (!$is_category_page || empty($category_slug)) {
        return;
    }
    
    // Array con datos mockeados por categoría
    $category_data = [
        // PERFORADO
        'brocas-integrales-de-metal-duro' => [
            'title' => 'Brocas Integrales de Metal Duro',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem tenetur reprehenderit excepturi praesentium nihil temporibus, minus a repellat repudiandae asperiores hic debitis ipsam, laudantium vel. Tempora facilis doloremque consequuntur rerum.'
        ],
        'brocas-modulares' => [
            'title' => 'Brocas Modulares',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem tenetur reprehenderit excepturi praesentium nihil temporibus, minus a repellat repudiandae asperiores hic debitis ipsam, laudantium vel. Tempora facilis doloremque consequuntur rerum.'
        ],
        'brocas-con-insertos-intercambiables' => [
            'title' => 'Brocas con Insertos Intercambiables',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem tenetur reprehenderit excepturi praesentium nihil temporibus, minus a repellat repudiandae asperiores hic debitis ipsam, laudantium vel. Tempora facilis doloremque consequuntur rerum.'
        ],
        // FRESADO
        'fresas-integrales-de-metal-duro' => [
            'title' => 'Fresas Integrales de Metal Duro',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem tenetur reprehenderit excepturi praesentium nihil temporibus, minus a repellat repudiandae asperiores hic debitis ipsam, laudantium vel. Tempora facilis doloremque consequuntur rerum.'
        ],
        'fresas-de-planeado' => [
            'title' => 'Fresas de Planeado',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem tenetur reprehenderit excepturi praesentium nihil temporibus, minus a repellat repudiandae asperiores hic debitis ipsam, laudantium vel. Tempora facilis doloremque consequuntur rerum.'
        ],
        'fresas-de-escuadrado' => [
            'title' => 'Fresas de Escuadrado',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem tenetur reprehenderit excepturi praesentium nihil temporibus, minus a repellat repudiandae asperiores hic debitis ipsam, laudantium vel. Tempora facilis doloremque consequuntur rerum.'
        ],
        'fresas-de-alto-avance' => [
            'title' => 'Fresas de Alto Avance',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem tenetur reprehenderit excepturi praesentium nihil temporibus, minus a repellat repudiandae asperiores hic debitis ipsam, laudantium vel. Tempora facilis doloremque consequuntur rerum.'
        ],
        // TORNEADO
        'torneado-interior' => [
            'title' => 'Torneado Interior',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem tenetur reprehenderit excepturi praesentium nihil temporibus, minus a repellat repudiandae asperiores hic debitis ipsam, laudantium vel. Tempora facilis doloremque consequuntur rerum.'
        ],
        'torneado-exterior' => [
            'title' => 'Torneado Exterior',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem tenetur reprehenderit excepturi praesentium nihil temporibus, minus a repellat repudiandae asperiores hic debitis ipsam, laudantium vel. Tempora facilis doloremque consequuntur rerum.'
        ],
        'ranurado-y-tronzado' => [
            'title' => 'Ranurado y Tronzado',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem tenetur reprehenderit excepturi praesentium nihil temporibus, minus a repellat repudiandae asperiores hic debitis ipsam, laudantium vel. Tempora facilis doloremque consequuntur rerum.'
        ],
        'perfilado-de-precision' => [
            'title' => 'Perfilado de Precisión',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem tenetur reprehenderit excepturi praesentium nihil temporibus, minus a repellat repudiandae asperiores hic debitis ipsam, laudantium vel. Tempora facilis doloremque consequuntur rerum.'
        ],
        // ROSCADO
        'torneado-de-rosca' => [
            'title' => 'Torneado de Rosca',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem tenetur reprehenderit excepturi praesentium nihil temporibus, minus a repellat repudiandae asperiores hic debitis ipsam, laudantium vel. Tempora facilis doloremque consequuntur rerum.'
        ],
        'fresado-de-rosca' => [
            'title' => 'Fresado de Rosca',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem tenetur reprehenderit excepturi praesentium nihil temporibus, minus a repellat repudiandae asperiores hic debitis ipsam, laudantium vel. Tempora facilis doloremque consequuntur rerum.'
        ],
        'roscado-con-machos' => [
            'title' => 'Roscado con Machos',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem tenetur reprehenderit excepturi praesentium nihil temporibus, minus a repellat repudiandae asperiores hic debitis ipsam, laudantium vel. Tempora facilis doloremque consequuntur rerum.'
        ],
    ];
    
    // Obtener datos del array o usar valores por defecto
    if (isset($category_data[$category_slug])) {
        $title = $category_data[$category_slug]['title'];
        $description = $category_data[$category_slug]['description'];
    } else {
        // Valores por defecto si no se encuentra la categoría
        $title = 'Categoría de Producto';
        $description = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem tenetur reprehenderit excepturi praesentium nihil temporibus, minus a repellat repudiandae asperiores hic debitis ipsam, laudantium vel. Tempora facilis doloremque consequuntur rerum.';
    }
    
    ?>
    <div class="category-product-hero">
    <!-- Hero Section 1 -->
    <section class="hero">
        <div class="hero-banner-top-left-wrapper">
            <div class="hero-banner-top-left">
                <div class="hero-banner-top-left-text">
                    <?php echo esc_html($title); ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Text Section -->
    <section class="hero-text-section">
        <div class="hero-text">
            <?php echo esc_html($description); ?>
        </div>
    </section>
    </div>
    <?php
}

/* ===============================
   WOOCOMMERCE: MOSTRAR SKU EN LOOP DE PRODUCTOS (LISTADO) - ANTES DEL TÍTULO
================================ */
// Remover el título del lugar original
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

// Agregar SKU, separador y título en el orden correcto
add_action('woocommerce_shop_loop_item_title', function () {
    global $product;
    // Mostrar SKU primero
    if ($product) {
        $sku = $product->get_sku();
        if ($sku && !empty($sku)) {
            echo '<p class="product-code">COD. ' . esc_html($sku) . '</p>';
            // Agregar separador después del SKU
            $separator_url = get_template_directory_uri() . '/assets/images/productos/Kennaline Movil_product_separator.png';
            echo '<img src="' . esc_url($separator_url) . '" alt="" class="product-separator-img" style="width: 100%; height: auto; margin-top: 5px; margin-bottom: 10px;" />';
        }
    }
    // Luego mostrar el título
    echo '<h2 class="woocommerce-loop-product__title">' . get_the_title() . '</h2>';
}, 10);
