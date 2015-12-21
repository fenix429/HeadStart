<?php
/**
 * HeadStart functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package HeadStart
 */

if ( ! function_exists( '_hs_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function _hs_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on HeadStart, use a find and replace
	 * to change '_hs' to the name of your theme in all the template files
	 */
	load_theme_textdomain( '_hs', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'header' => __( 'Header Menu', '_hs' ),
		/* WPGEN:CONFIG FOOTER_NAVIGATION:BEGIN */
		'footer' => __( 'Footer Menu', '_hs' ),
		/* WPGEN:CONFIG FOOTER_NAVIGATION:END */
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	/* WPGEN:CONFIG THEME_SETTINGS:BEGIN */
	/*
	*  Initialize the ACF options page
	*/
	if(function_exists('acf_add_options_sub_page')) { 
		acf_add_options_sub_page(array(
			'page_title'	=> 'Theme Settings',
			'parent'		=> 'themes.php',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));
	}
	/* WPGEN:CONFIG THEME_SETTINGS:END */

	// Tells wordpress to look for shortcodes in widget text
	//add_filter('widget_text', 'do_shortcode');

	// Enables The 'Hide' option for labels in Gravity Forms
	//add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

	// Set up the WordPress core custom background feature.
	//add_theme_support( 'custom-background', apply_filters( '_hs_custom_background_args', array(
	//	'default-color' => 'ffffff',
	//	'default-image' => '',
	//) ) );
}
endif; // _hs_setup
add_action( 'after_setup_theme', '_hs_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _hs_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_hs_content_width', 640 );
}
add_action( 'after_setup_theme', '_hs_content_width', 0 );

/**
 * Hide the ACF Menu from non-admins
 * Requires ACF v5
 */
function _hs_acf_show_admin( $show ) {
    
    return current_user_can('manage_options'); // Admin Only
    
}
add_filter('acf/settings/show_admin', '_hs_acf_show_admin');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _hs_widgets_init() {
	/* WPGEN:CONFIG WIDGETIZED_FOOTER:BEGIN */
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', '_hs' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	/* WPGEN:CONFIG WIDGETIZED_FOOTER:END */
	
	/* WPGEN:CONFIG WIDGETIZED_SIDEBAR:BEGIN */
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', '_hs' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	/* WPGEN:CONFIG WIDGETIZED_SIDEBAR:END */
}
add_action( 'widgets_init', '_hs_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function _hs_scripts() {
	wp_enqueue_style( '_hs-style', get_stylesheet_uri() );

	//wp_enqueue_script( '_hs-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'),  '20150306', true );

	wp_enqueue_script( '_hs-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_hs_scripts' );

remove_action('wp_head', 'feed_links_extra', 3); // Remove category feeds
remove_action('wp_head', 'feed_links', 2); // Remove Post and Comment Feeds

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * ACF Predefined Fields
 */
require get_template_directory() . '/inc/acf-predefined-fields.php';

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

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
