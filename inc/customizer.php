<?php
/**
 * Theme Customizer
 */
function sdm_customize_register( $wp_customize ) {
	
	/** ===============
	 * Extends CONTROLS class to add textarea
	 */
	class sdm_customize_textarea_control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() { ?>
	
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
	
		<?php }
	}
	

	/** ===============
	 * Site Title (Logo) & Tagline
	 */
	// section adjustments
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Site Title (Logo) & Tagline', 'sdm' );
	$wp_customize->get_section( 'title_tagline' )->priority = 10;
	
	//site title
	$wp_customize->get_control( 'blogname' )->priority = 10;
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	
	// tagline
	$wp_customize->get_control( 'blogdescription' )->priority = 30;
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	
	// logo uploader
	$wp_customize->add_setting( 'sdm_logo', array( 'default' => null ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sdm_logo', array(
		'label'		=> __( 'Custom Site Logo (replaces title)', 'sdm' ),
		'section'	=> 'title_tagline',
		'settings'	=> 'sdm_logo',
		'priority'	=> 20
	) ) );	
	// hide the tagline?
	$wp_customize->add_setting( 'sdm_hide_tagline', array( 
		'default' => 0,
		'sanitize_callback' => 'sdm_sanitize_checkbox'  
	) );
	$wp_customize->add_control( 'sdm_hide_tagline', array(
		'label'		=> __( 'Hide Tagline', 'sdm' ),
		'section'	=> 'title_tagline',
		'priority'	=> 40,
		'type'      => 'checkbox',
	) );


	/** ===============
	 * Content Options
	 */
	$wp_customize->add_section( 'sdm_content_section', array(
    	'title'       	=> __( 'Content Options', 'sdm' ),
		'description' 	=> __( 'Adjust the display of content on your website. All options have a default value that can be left as-is but you are free to customize.', 'sdm' ),
		'priority'   	=> 20,
	) );
	// post content
	$wp_customize->add_setting( 'sdm_post_content', array( 
		'default' => 'full_content',
		'sanitize_callback' => 'sdm_sanitize_radio'  
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sdm_post_content', array(
		'label'		=> __( 'Post Feed Content', 'sdm' ),
		'section'	=> 'sdm_content_section',
		'settings'	=> 'sdm_post_content',
		'priority'	=> 10,
		'type'      => 'radio',
		'choices'   => array(
			'excerpt'		=> 'Excerpt',
			'full_content'	=> 'Full Content'
		),
	) ) );
	// read more link
	$wp_customize->get_setting( 'sdm_read_more' )->transport = 'postMessage';
	$wp_customize->add_setting( 'sdm_read_more', array(
		'default' => __( 'Read More &rarr;', 'sdm' ),
		'sanitize_callback' => 'sdm_sanitize_text' 
	) );		
	$wp_customize->add_control( 'sdm_read_more', array(
	    'label' 	=> __( 'Excerpt & More Link Text', 'sdm' ),
	    'section' 	=> 'sdm_content_section',
		'settings' 	=> 'sdm_read_more',
		'priority'	=> 20,
	) );
	// show featured images on feed?
	$wp_customize->add_setting( 'sdm_featured_image', array( 
		'default' => 1,
		'sanitize_callback' => 'sdm_sanitize_checkbox'  
	) );
	$wp_customize->add_control( 'sdm_featured_image', array(
		'label'		=> __( 'Show Featured Images in post listings?', 'sdm' ),
		'section'	=> 'sdm_content_section',
		'priority'	=> 30,
		'type'      => 'checkbox',
	) );
	// show featured images on posts?
	$wp_customize->add_setting( 'sdm_single_featured_image', array( 
		'default' => 1,
		'sanitize_callback' => 'sdm_sanitize_checkbox'  
	) );
	$wp_customize->add_control( 'sdm_single_featured_image', array(
		'label'		=> __( 'Show Featured Images on Single Posts?', 'sdm' ),
		'section'	=> 'sdm_content_section',
		'priority'	=> 40,
		'type'      => 'checkbox',
	) );
	// show single post footer?
	$wp_customize->add_setting( 'sdm_post_footer', array( 
		'default' => 1,
		'sanitize_callback' => 'sdm_sanitize_checkbox'  
	) );
	$wp_customize->add_control( 'sdm_post_footer', array(
		'label'		=> __( 'Show Post Footer on Single Posts?', 'sdm' ),
		'section'	=> 'sdm_content_section',
		'priority'	=> 50,
		'type'      => 'checkbox',
	) );
	// comments on pages?
	$wp_customize->add_setting( 'sdm_page_comments', array( 
		'default' => 0,
		'sanitize_callback' => 'sdm_sanitize_checkbox'  
	) );
	$wp_customize->add_control( 'sdm_page_comments', array(
		'label'		=> __( 'Display Comments on Standard Pages?', 'sdm' ),
		'section'	=> 'sdm_content_section',
		'priority'	=> 60,
		'type'      => 'checkbox',
	) );
	// credits & copyright
	$wp_customize->get_setting( 'sdm_credits_copyright' )->transport = 'postMessage';
	$wp_customize->add_setting( 'sdm_credits_copyright', array( 
		'default' => null,
		'sanitize_callback' => 'sdm_sanitize_text' 
	) );
	$wp_customize->add_control( 'sdm_credits_copyright', array(
		'label'		=> __( 'Footer Credits & Copyright', 'sdm' ),
		'section'	=> 'sdm_content_section',
		'settings'	=> 'sdm_credits_copyright',
		'priority'	=> 70,
	) );
	
	
	/** ===============
	 * Easy Digital Downloads Options
	 */
	// only if EDD is activated
	if ( class_exists( 'Easy_Digital_Downloads' ) ) {
		$wp_customize->add_section( 'sdm_edd_options', array(
	    	'title'       	=> __( 'Easy Digital Downloads', 'sdm' ),
			'description' 	=> __( 'All other EDD options are under Dashboard => Downloads. If you deactivate EDD, these options will no longer appear.', 'sdm' ),
			'priority'   	=> 30,
		) );
		// show comments on downloads?
		$wp_customize->add_setting( 'sdm_download_comments', array( 
			'default' => 0,
			'sanitize_callback' => 'sdm_sanitize_checkbox'  
		) );
		$wp_customize->add_control( 'sdm_download_comments', array(
			'label'		=> __( 'Comments on Downloads?', 'sdm' ),
			'section'	=> 'sdm_edd_options',
			'priority'	=> 10,
			'type'      => 'checkbox',
		) );
		// store front/downloads archive headline
		$wp_customize->get_setting( 'sdm_edd_store_archives_title' )->transport = 'postMessage';
		$wp_customize->add_setting( 'sdm_edd_store_archives_title', array( 
			'default' => null,
			'sanitize_callback' => 'sdm_sanitize_text' 
		) );
		$wp_customize->add_control( 'sdm_edd_store_archives_title', array(
			'label'		=> __( 'Store Front Main Title', 'sdm' ),
			'section'	=> 'sdm_edd_options',
			'settings'	=> 'sdm_edd_store_archives_title',
			'priority'	=> 20,
		) );
		// store front/downloads archive description
		$wp_customize->add_setting( 'sdm_edd_store_archives_description', array( 'default' => null ) );
		$wp_customize->add_control( new sdm_customize_textarea_control( $wp_customize, 'sdm_edd_store_archives_description', array(
			'label'		=> __( 'Store Front Description', 'sdm' ),
			'section'	=> 'sdm_edd_options',
			'settings'	=> 'sdm_edd_store_archives_description',
			'priority'	=> 30,
		) ) );
		// hide download description (excerpt)?
		$wp_customize->add_setting( 'sdm_download_description', array( 
			'default' => 0,
			'sanitize_callback' => 'sdm_sanitize_checkbox'  
		) );
		$wp_customize->add_control( 'sdm_download_description', array(
			'label'		=> __( 'Hide Download Description', 'sdm' ),
			'section'	=> 'sdm_edd_options',
			'priority'	=> 40,
			'type'      => 'checkbox',
		) );
		//  view details link
		$wp_customize->get_setting( 'sdm_product_view_details' )->transport = 'postMessage';
		$wp_customize->add_setting( 'sdm_product_view_details', array( 
			'default' => __( 'View Details', 'sdm' ),
			'sanitize_callback' => 'sdm_sanitize_text' 
		) );
		$wp_customize->add_control( 'sdm_product_view_details', array(
		    'label' 	=> __( 'Store Item Link Text', 'sdm' ),
		    'section' 	=> 'sdm_edd_options',
			'settings' 	=> 'sdm_product_view_details',
			'priority'	=> 50,
		) );
		// store front/archive item count
		$wp_customize->add_setting( 'sdm_store_front_count', array( 'default' => 9 ) );		
		$wp_customize->add_control( 'sdm_store_front_count', array(
		    'label' 	=> __( 'Store Front Item Count', 'sdm' ),
		    'section' 	=> 'sdm_edd_options',
			'settings' 	=> 'sdm_store_front_count',
			'priority'	=> 60,
		) );
	}
	

	/** ===============
	 * Navigation Menu(s)
	 */
	// section adjustments
	$wp_customize->get_section( 'nav' )->title = __( 'Navigation Menu(s)', 'sdm' );
	$wp_customize->get_section( 'nav' )->priority = 40;
	
	

	/** ===============
	 * Static Front Page
	 */
	// section adjustments
	$wp_customize->get_section( 'static_front_page' )->priority = 50;
}
add_action( 'customize_register', 'sdm_customize_register' );


/** ===============
 * Sanitize checkbox options
 */
function sdm_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return 0;
    }
}


/** ===============
 * Sanitize radio options
 */
function sdm_sanitize_radio( $input ) {
    $valid = array(
		'excerpt'		=> 'Excerpt',
		'full_content'	=> 'Full Content'
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}


/** ===============
 * Sanitize text input
 */
function sdm_sanitize_text( $input ) {
    return strip_tags( stripslashes( $input ) );
}


/** ===============
 * Add Customizer UI styles to the <head> only on Customizer page
 */
function sdm_customizer_styles() { ?>
	<style type="text/css">
		body { background: #fff; }
		#customize-controls #customize-theme-controls .description { display: block; color: #999; margin: 2px 0 15px; font-style: italic; }
		textarea, input, select, .customize-description { font-size: 12px !important; }
		.customize-control-title { font-size: 13px !important; margin: 10px 0 3px !important; }
		.customize-control label { font-size: 12px !important; }
		#customize-control-sdm_read_more { margin-bottom: 30px; }
		#customize-control-sdm_store_front_count input { width: 50px; }
	</style>
<?php }
add_action('customize_controls_print_styles', 'sdm_customizer_styles');


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sdm_customize_preview_js() {
	wp_enqueue_script( 'sdm_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'sdm_customize_preview_js' );
