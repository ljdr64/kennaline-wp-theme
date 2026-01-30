<?php
/**
 * The Template for displaying product category archives
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product_cat.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.7.0
 */

defined( 'ABSPATH' ) || exit;

get_header(); ?>

<div class="page-content">
	<?php
	/**
	 * Hook: woocommerce_before_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 */
	do_action( 'woocommerce_before_main_content' );
	?>

	<?php
	// Hero de categoría - renderizado directamente en el template
	$category = get_queried_object();
	$category_slug = $category->slug;
	
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
	if ( isset( $category_data[ $category_slug ] ) ) {
		$title = $category_data[ $category_slug ]['title'];
		$description = $category_data[ $category_slug ]['description'];
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
						<?php echo esc_html( $title ); ?>
					</div>
				</div>
			</div>
		</section>
		<!-- Hero Text Section -->
		<section class="hero-text-section">
			<div class="hero-text">
				<?php echo esc_html( $description ); ?>
			</div>
		</section>
	</div>

	<div class="woocommerce-products-container">
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop.
		 *
		 * @hooked woocommerce_output_all_notices - 10
		 * @hooked woocommerce_result_count - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 */
		do_action( 'woocommerce_before_shop_loop' );

		if ( woocommerce_product_loop() ) {

			woocommerce_product_loop_start();

			while ( have_posts() ) {
				the_post();

				/**
				 * Hook: woocommerce_shop_loop.
				 */
				do_action( 'woocommerce_shop_loop' );

				wc_get_template_part( 'content', 'product' );
			}

			woocommerce_product_loop_end();

			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action( 'woocommerce_no_products_found' );
		}
		?>
	</div>


</div>

<?php get_footer(); ?>
