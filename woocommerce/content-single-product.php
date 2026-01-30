<?php
/**
 * The template for displaying product content in the single-product.php template
 * Custom layout for industrial product technical sheet
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Validar que sea WC_Product
if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<div class="product-layout-grid">
		<div class="product-gallery">
			<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
			?>
		</div>

		<div class="product-buybox">
			<h1 class="product-title"><?php echo esc_html( $product->get_name() ); ?></h1>

			<?php if ( $product->get_sku() ) : ?>
				<p class="product-code">COD. <?php echo esc_html( $product->get_sku() ); ?></p>
			<?php endif; ?>

			<div class="product-price">
				<?php echo $product->get_price_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>

			<?php
			// Stock status
			$stock_status = $product->get_stock_status();
			$stock_text = '';
			if ( $product->is_in_stock() ) {
				$stock_quantity = $product->get_stock_quantity();
				if ( $stock_quantity !== null ) {
					$stock_text = sprintf( __( 'En stock (%d disponibles)', 'woocommerce' ), $stock_quantity );
				} else {
					$stock_text = __( 'En stock', 'woocommerce' );
				}
			} else {
				$stock_text = __( 'Agotado', 'woocommerce' );
			}
			?>
			<p class="product-stock stock-status-<?php echo esc_attr( $stock_status ); ?>">
				<?php echo esc_html( $stock_text ); ?>
			</p>

			<?php
			// Short description
			if ( $product->get_short_description() ) :
				?>
				<div class="product-short-description">
					<?php echo wp_kses_post( $product->get_short_description() ); ?>
				</div>
				<?php
			endif;
			?>

			<?php
			// Add to cart form
			woocommerce_template_single_add_to_cart();
			?>
		</div>
	</div>

	<?php
	// Long description
	if ( $product->get_description() ) :
		?>
		<div class="product-description">
			<h2><?php esc_html_e( 'Descripción', 'woocommerce' ); ?></h2>
			<?php echo wp_kses_post( $product->get_description() ); ?>
		</div>
		<?php
	endif;
	?>

	<?php
	// Technical specifications table
	$attributes = $product->get_attributes();
	$optional_meta_keys = array( 'diametro', 'norma_iso', 'recubrimiento' );
	$has_specs = false;

	// Check if there are any attributes or optional meta keys
	if ( ! empty( $attributes ) ) {
		$has_specs = true;
	} else {
		foreach ( $optional_meta_keys as $meta_key ) {
			if ( $product->get_meta( $meta_key ) ) {
				$has_specs = true;
				break;
			}
		}
	}

	if ( $has_specs ) :
		?>
		<div class="product-technical-specs">
			<h2><?php esc_html_e( 'Ficha técnica', 'woocommerce' ); ?></h2>
			<table class="specs-table">
				<tbody>
					<?php
					// Render taxonomy and custom attributes
					foreach ( $attributes as $attribute ) {
						$name = $attribute->get_name();
						$label = wc_attribute_label( $name );

						if ( $attribute->is_taxonomy() ) {
							// Taxonomy attribute
							$terms = wc_get_product_terms( $product->get_id(), $name, array( 'fields' => 'all' ) );
							if ( ! empty( $terms ) ) {
								$values = array();
								foreach ( $terms as $term ) {
									$values[] = esc_html( $term->name );
								}
								?>
								<tr>
									<th><?php echo esc_html( $label ); ?></th>
									<td><?php echo esc_html( implode( ', ', $values ) ); ?></td>
								</tr>
								<?php
							}
						} else {
							// Custom attribute
							$values = $attribute->get_options();
							if ( ! empty( $values ) ) {
								?>
								<tr>
									<th><?php echo esc_html( $label ); ?></th>
									<td><?php echo esc_html( implode( ', ', $values ) ); ?></td>
								</tr>
								<?php
							}
						}
					}

					// Render optional meta keys
					foreach ( $optional_meta_keys as $meta_key ) {
						$meta_value = $product->get_meta( $meta_key );
						if ( $meta_value ) {
							$meta_label = ucfirst( str_replace( '_', ' ', $meta_key ) );
							?>
							<tr>
								<th><?php echo esc_html( $meta_label ); ?></th>
								<td><?php echo esc_html( $meta_value ); ?></td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
			</table>
		</div>
		<?php
	endif;
	?>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
