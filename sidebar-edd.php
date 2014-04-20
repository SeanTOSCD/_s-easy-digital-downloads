<?php
/**
 * The Sidebar containing the EDD widget areas.
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		<div class="widget product-info-wrapper">
			<div class="product-sidebar-price">
				<?php if ( edd_has_variable_prices( get_the_ID() ) ) : ?>
					<h3 class="widget-title"><?php _e( 'Starting at:', 'sdm'); edd_price( get_the_ID() ); ?></h3>						
				<?php elseif ( '0' != edd_get_download_price( get_the_ID() ) && !edd_has_variable_prices( get_the_ID() ) ) : ?>	
					<h3 class="widget-title"><?php _e( 'Price:', 'sdm' ); edd_price( get_the_ID() ); ?></h3> 
				<?php else : ?>
					<h3 class="widget-title"><?php _e( 'Free','sdm' ); ?></h3>
				<?php endif;  ?>
			</div>	
			<div class="product-download-buy-button">
				<?php echo edd_get_purchase_link( array( 'id' => get_the_ID() ) ); ?>
			</div>
		</div>
		<?php if ( is_active_sidebar( 'sidebar-edd' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-edd' ); ?>
		<?php else : ?>
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		<?php endif; ?>
	</div>
