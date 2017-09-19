<?php
/**
 * codexin functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package codexin
 */

/**
 * Navigations Menus
 */
require get_template_directory() . '/lib/menus.php';

/**
 * Shortcodes
 */
//require get_template_directory() . '/lib/shortcodes.php';

/**
 * Enque styles and js
 */
require get_template_directory() . '/lib/scripts.php';


/**
 * Adding widgets
 */
require get_template_directory() . '/lib/widgets.php';

/**
 * load all Puremedia Custom widgets in dashboard
 */ 
 require get_template_directory() . '/lib/widgets/widget-init.php';


/**
 * Adding metaboxes
 */
require get_template_directory() . '/lib/metaboxes.php';

/**
 * Adding plugins
 */
require get_template_directory() . '/lib/plugins/required-plugins.php';

/**
 * Adding Custom Posts
 */
require get_template_directory() . '/lib/custompost.php';

/**
 * Adding Custom Shortcode
 */
require get_template_directory() . '/lib/codexin-kc-shortcodes/init.php';



if ( ! isset( $content_width ) ) {
	$content_width = 800;
}

if ( ! function_exists( 'codexin_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function codexin_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on codexin, use a find and replace
	 * to change 'codexin' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'codexin', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Add support for post formats.
	 */
	add_theme_support( 'post-formats',
		array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'status',
			'audio',
			'chat',
		)
	);

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

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

	// Providing Shortcode Support on text widget
	add_filter( 'widget_text', 'do_shortcode' );

}
endif;
add_action( 'after_setup_theme', 'codexin_setup' );


// include Redux framework theme  options

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/admin-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/admin-config.php' );
}


/* Removing 'Redux Framework' sub menu under Tools */

/** remove redux menu under the tools **/
add_action( 'admin_menu', 'remove_redux_menu',12 );
function remove_redux_menu() {
    remove_submenu_page('tools.php','redux-about');
}


// Removing srcset from featured image
add_filter( 'max_srcset_image_width', create_function( '', 'return 1;' ) );

// Removing width & height from featured image
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

add_image_size('puremedia-post-single', 647, 303, true);
add_image_size('portfolio-small-thum', 291, 291, true);


require get_template_directory() . '/lib/puremedia-comments.php';