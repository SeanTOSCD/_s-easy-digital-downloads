<?php
/**
 * functions and definitions
 */
 
/**
 * definitions
 */
define( 'THEME_NAME', '' );
define( 'THEME_VERSION', '1.0.3' );


if ( ! function_exists( 'sdm_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sdm_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'sdm', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	
	// add a hard cropped (for uniformity) image size for the product grid
	add_image_size( 'product-img', 540, 360, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Header Menu', 'sdm' ),
	) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // sdm_setup
add_action( 'after_setup_theme', 'sdm_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function sdm_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'sdm' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'EDD Sidebar', 'sdm' ),
		'id'            => 'sidebar-edd',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'sdm_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sdm_scripts() {
	wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri() . '/inc/fonts/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'sdm-style', get_stylesheet_uri() );
	wp_enqueue_script( 'sdm-navigation', get_template_directory_uri() . '/inc/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'sdm-skip-link-focus-fix', get_template_directory_uri() . '/inc/js/skip-link-focus-fix.js', array(), '20130115', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sdm_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/** ===============
 * Adjust excerpt length
 */
function sdm_custom_excerpt_length( $length ) {
	return 35;
}
add_filter( 'excerpt_length', 'sdm_custom_excerpt_length', 999 );


/** ===============
 * Replace excerpt ellipses with new ellipses and link to full article
 */
function sdm_excerpt_more( $more ) {
	if ( is_page_template( 'edd_templates/edd-store-front.php' ) || is_archive( 'download') ) {
		return '...';
	} else {
		return '...</p> <div class="continue-reading"><a class="more-link" href="' . get_permalink( get_the_ID() ) . '">' . get_theme_mod( 'sdm_read_more', __( 'Read More &rarr;', 'sdm' ) ) . '</a></div>';
	}
}
add_filter( 'excerpt_more', 'sdm_excerpt_more' );


/** ===============
 * Add .top class to the first post in a loop
 */
function sdm_first_post_class( $classes ) {
	global $wp_query;
	if ( 0 == $wp_query->current_post )
		$classes[] = 'top';
	return $classes;
}
add_filter( 'post_class', 'sdm_first_post_class' );


/** ===============
 * Only show regular posts in search results
 */
function sdm_search_filter( $query ) {
	if ( $query->is_search && !is_admin )
		$query->set( 'post_type', 'post' );
	return $query;
}
add_filter( 'pre_get_posts','sdm_search_filter' );


/** ===============
 * Allow comments on downloads
 */
function sdm_edd_add_comments_support( $supports ) {
	$supports[] = 'comments';
	return $supports;	
}
add_filter( 'edd_download_supports', 'sdm_edd_add_comments_support' );

	
/** ===============
 * No purchase button below download content
 */
remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );