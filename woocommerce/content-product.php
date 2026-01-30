<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );

	// Mostrar SKU primero y luego título (solo en categorías)
	if ( is_product_category() || is_product_taxonomy() ) {
		// Remover el título del lugar original
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
		
		// Mostrar SKU primero
		$sku = $product->get_sku();
		if ( $sku && ! empty( $sku ) ) {
			echo '<p class="product-code">COD. ' . esc_html( $sku ) . '</p>';
			// Agregar separador después del SKU
			$separator_url = get_template_directory_uri() . '/assets/images/productos/Kennaline Movil_product_separator.png';
			echo '<img src="' . esc_url( $separator_url ) . '" alt="" class="product-separator-img" style="width: 100%; height: auto; margin-top: 5px; margin-bottom: 10px;" />';
		}
		
		// Luego mostrar el título
		echo '<h2 class="woocommerce-loop-product__title">' . esc_html( get_the_title() ) . '</h2>';
	} else {
		// En otras páginas (shop, etc.), usar el hook normal
		do_action( 'woocommerce_shop_loop_item_title' );
	}

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>
