<?php
/**
 * generic content display
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php sdm_posted_on(); ?>
			</div>
		<?php endif; ?>
	</header>

	<?php // show excerpts on search results and main content if options is selected ?>
	<?php if ( is_search() || get_theme_mod( 'sdm_post_content' ) == 'excerpt' ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	<?php else : ?>
		<div class="entry-content">
			
			<?php 
			// display featured image full
			if ( has_post_thumbnail() && get_theme_mod( 'sdm_featured_image' ) != 0 ) :
				the_post_thumbnail( 'full', array( 'class' => 'featured-img' ) );
			endif;
			
			the_content( __( get_theme_mod( 'sdm_read_more' ), 'sdm' ) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'sdm' ),
				'after'  => '</div>',
			) );
			?>
		</div>
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'sdm' ) );
				if ( $categories_list && sdm_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'sdm' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'sdm' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'sdm' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'sdm' ), __( '1 Comment', 'sdm' ), __( '% Comments', 'sdm' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'sdm' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
</article>
