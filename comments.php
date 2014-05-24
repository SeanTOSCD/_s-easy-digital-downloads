<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'sdm' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'sdm' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'sdm' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'sdm' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<div class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'div',
					'short_ping' => true,
					'avatar_size'	=> 55
				) );
			?>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'sdm' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'sdm' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'sdm' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'sdm' ); ?></p>
	<?php endif; ?>

	<?php 
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		comment_form( 
			array(
				'id_form'				=> 'commentform',
				'id_submit'				=> 'submit',
				'title_reply'			=> __( 'Leave a Reply', 'sdm' ),
				'title_reply_to'		=> __( 'Leave a Reply to %s', 'sdm' ),
				'cancel_reply_link'		=> __( 'Cancel Reply', 'sdm' ),
				'label_submit'			=> __( 'Post Comment', 'sdm' ),	
				'comment_field'			=>  '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' . '</textarea></p>',	
				'must_log_in'			=> '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'sdm' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',	
				'logged_in_as'			=> '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'sdm' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',	
				'comment_notes_before'	=> '',	
				'comment_notes_after'	=> '',	
				'fields'				=> apply_filters( 'comment_form_default_fields', array(
					'author'				=> '<p class="comment-form-author comment-form-field"><input id="author" name="author" type="text" placeholder="' . __( 'Name', 'sdm' ) . '"' . $aria_req . ' /></p>',
				
					'email'					=> '<p class="comment-form-email comment-form-field"><input id="email" name="email" type="text" placeholder="' . __( 'Email', 'sdm' ) . '"' . $aria_req . ' /></p>',
				
					'url'					=> '<p class="comment-form-url comment-form-field"><input id="url" name="url" type="text" placeholder="' . __( 'Website URL', 'sdm' ) . '" /></p>'
					)
				),
			) 
		);
	?>
</div>