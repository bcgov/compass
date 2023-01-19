<?php
/**
 * Sextant functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sextant
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'sextant_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function sextant_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Sextant, use a find and replace
		 * to change 'sextant' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'sextant', get_template_directory() . '/languages' );

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
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Left Nav', 'sextant' ),
                'menu-2' => esc_html__( 'Left Nav Lower', 'sextant')
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'sextant_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'sextant_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sextant_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sextant_content_width', 640 );
}
add_action( 'after_setup_theme', 'sextant_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sextant_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__('Left Nav', 'sextant'),
            'id'            => 'left-nav',
            'description'   => esc_html__('The Main Site Navigation', 'sextant'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<p class="widget-title">',
            'after_title'   => '</p>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Events Section', 'sextant'),
            'id'            => 'events-menu',
            'description'   => esc_html__('The Calendar & Events Listing', 'sextant'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<p class="widget-title">',
            'after_title'   => '</p>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Ministry Intranets', 'sextant'),
            'id'            => 'mintranets',
            'description'   => esc_html__('The Ministry Intranets Links', 'sextant'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<p class="widget-title">',
            'after_title'   => '</p>',
        )
    );
    register_sidebar(
        array(
            'name'          => esc_html__('IT Resources', 'sextant'),
            'id'            => 'infotech',
            'description'   => esc_html__('Information Technology Resources', 'sextant'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<p class="widget-title">',
            'after_title'   => '</p>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('External Resources', 'sextant'),
            'id'            => 'externals',
            'description'   => esc_html__('Links to External Resources', 'sextant'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<p class="widget-title">',
            'after_title'   => '</p>',
        )
    );
    register_sidebar(
        array(
            'name'          => esc_html__('Footer Left', 'sextant'),
            'id'            => 'footer-left',
            'description'   => esc_html__('Leftmost column in the footer', 'sextant'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<p class="widget-title">',
            'after_title'   => '</p>',
        )
    );
    register_sidebar(
        array(
            'name'          => esc_html__('Footer Middle', 'sextant'),
            'id'            => 'footer-middle',
            'description'   => esc_html__('Links to External Resources', 'sextant'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<p class="widget-title">',
            'after_title'   => '</p>',
        )
    );
    register_sidebar(
        array(
            'name'          => esc_html__('Footer Right', 'sextant'),
            'id'            => 'footer-right',
            'description'   => esc_html__('Middle column in the footer', 'sextant'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<p class="widget-title">',
            'after_title'   => '</p>',
        )
    );
    register_sidebar(
        array(
            'name'          => esc_html__('Mobile Menu', 'sextant'),
            'id'            => 'mobile-menu',
            'description'   => esc_html__('The menu that appears before search', 'sextant'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<p class="widget-title">',
            'after_title'   => '</p>',
        )
    );

}
add_action( 'widgets_init', 'sextant_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sextant_scripts() {
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/bootstrap.css', '4.6.0');
	wp_enqueue_style( 'sextant-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_style_add_data( 'sextant-style', 'rtl', 'replace' );
    // wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '3.6.0' );
	wp_enqueue_script( 'sextant-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array() , '4.6.0', true);
    wp_enqueue_script('sextant-nav', get_template_directory_uri() . '/js/sextant-nav.js', array('jquery') , '0.1', true);
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sextant_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 *
 * Add page support for excerpts so SERP result previews render properly.
 */
add_post_type_support( 'page', 'excerpt' );