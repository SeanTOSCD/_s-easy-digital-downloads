<?php
/**
 * The template used for displaying the EDD purchase confirmation
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<?php edit_post_link( __( 'Edit', 'sdm' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article>