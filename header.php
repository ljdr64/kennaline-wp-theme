<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php
    // Precargar todas las fuentes para mejor rendimiento
    $font_dir = get_template_directory_uri() . '/assets/fonts/';
    ?>
    <link rel="preload" href="<?php echo $font_dir; ?>SairaCondensed-Light.ttf" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="<?php echo $font_dir; ?>SairaCondensed-Regular.ttf" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="<?php echo $font_dir; ?>SairaCondensed-Medium.ttf" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="<?php echo $font_dir; ?>SairaCondensed-SemiBold.ttf" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="<?php echo $font_dir; ?>SairaCondensed-Bold.ttf" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="<?php echo $font_dir; ?>SairaCondensed-ExtraBold.ttf" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="<?php echo $font_dir; ?>SairaCondensed-Italic.ttf" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="<?php echo $font_dir; ?>SairaCondensed-BoldItalic.ttf" as="font" type="font/ttf" crossorigin>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    <header class="main-header">
        <div class="header-container">
            <button class="hamburger-btn" id="hamburgerBtn" aria-label="Abrir menú">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/movil/Kennaline Movil_menu_hamburguesa.png" alt="Menú" class="hamburger-icon" />
            </button>
            <div class="logo-container">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Kennaline Web_logo.png" alt="Kennaline Logo" class="logo-img" />
                </a>
            </div>
            <nav class="main-nav">
                <div class="nav-menu-wrapper">
                    <a href="<?php echo home_url('/nosotros'); ?>" class="nav-link-area nav-link-nosotros">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Kennaline Web_navbar_nosotros.png" alt="Nosotros" />
                    </a>
                    <a href="<?php echo home_url('/productos'); ?>" class="nav-link-area nav-link-productos">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Kennaline Web_navbar_productos.png" alt="Productos" />
                    </a>
                    <a href="<?php echo home_url('/servicios'); ?>" class="nav-link-area nav-link-servicios">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Kennaline Web_navbar_servicios.png" alt="Servicios" />
                    </a>
                    <a href="<?php echo home_url('/soluciones'); ?>" class="nav-link-area nav-link-soluciones">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Kennaline Web_navbar_soluciones.png" alt="Soluciones" />
                    </a>
                    <a href="<?php echo home_url('/clientes'); ?>" class="nav-link-area nav-link-clientes">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Kennaline Web_navbar_clientes.png" alt="Clientes" />
                    </a>
                    <a href="#contacto" class="nav-link-area nav-link-contacto">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Kennaline Web_navbar_contacto.png" alt="Contacto" />
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Menú móvil -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>
    <nav class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-background"></div>
        <div class="mobile-menu-content">
            <button class="mobile-menu-close" id="mobileMenuClose" aria-label="Cerrar menú">×</button>
            <ul class="mobile-menu-list">
                <li><a href="<?php echo home_url('/nosotros'); ?>" class="mobile-menu-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Kennaline Web_navbar_nosotros.png" alt="Nosotros" />
                </a></li>
                <li><a href="<?php echo home_url('/productos'); ?>" class="mobile-menu-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Kennaline Web_navbar_productos.png" alt="Productos" />
                </a></li>
                <li><a href="<?php echo home_url('/servicios'); ?>" class="mobile-menu-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Kennaline Web_navbar_servicios.png" alt="Servicios" />
                </a></li>
                <li><a href="<?php echo home_url('/soluciones'); ?>" class="mobile-menu-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Kennaline Web_navbar_soluciones.png" alt="Soluciones" />
                </a></li>
                <li><a href="<?php echo home_url('/clientes'); ?>" class="mobile-menu-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Kennaline Web_navbar_clientes.png" alt="Clientes" />
                </a></li>
                <li><a href="#contacto" class="mobile-menu-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Kennaline Web_navbar_contacto.png" alt="Contacto" />
                </a></li>
            </ul>
        </div>
    </nav>

    <?php
    $current_url = $_SERVER['REQUEST_URI'];
    $is_category_page = false;
    
    if (is_product_category()) {
        $is_category_page = true;
    } elseif (strpos($current_url, '/kennaline/categoria-producto/') !== false) {
        $is_category_page = true;
    }
    
    if ($is_category_page && function_exists('kennaline_product_category_hero')) {
        kennaline_product_category_hero();
    }
    ?>