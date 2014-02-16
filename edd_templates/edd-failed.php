<?php
/*
 * Template Name: EDD Transaction Failed
 */
get_header(); ?>

	<div id="edd-primary" class="content-area">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content/content', 'failed-transaction' ); ?>

		<?php endwhile; // end of the loop. ?>

	</div>

<?php get_footer(); ?>