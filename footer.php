<html>
	<body>

<?php
/**
 * the closing of the main content elements and the footer element
 */
?>

	<div class="footer-area full">
		<div class="main">
			<footer id="colophon" class="site-footer inner" role="contentinfo">
				<span class="site-info">
					<?php
						$site_info = get_bloginfo( 'description' ) . ' - ' . get_bloginfo( 'name' ) . ' &copy; ' . date( 'Y' );
						if ( '' != get_theme_mod( 'sdm_credits_copyright' ) ) :
							echo get_theme_mod( 'sdm_credits_copyright' );
						else : 
							echo $site_info;
						endif;
					?>
				</span>
			</footer>
		</div>
	</div>

<?php wp_footer(); ?>

	</body>
</html>
