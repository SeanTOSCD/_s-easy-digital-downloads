<?php
/**
 * search results display
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<div class="entry-meta">
			<?php sdm_posted_on(); ?>
		</div>
	</header>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
</article>