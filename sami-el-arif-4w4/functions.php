<?php
/**
 * theme4w4ed functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package theme4w4ed
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'theme4w4ed_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function theme4w4ed_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on theme4w4ed, use a find and replace
		 * to change 'theme4w4ed' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'theme4w4ed', get_template_directory() . '/languages' );

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
		add_theme_support( 'post-thumbnails' ); /// Permet de mettre des images

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'theme4w4ed' ),
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
				'theme4w4ed_custom_background_args',
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
add_action( 'after_setup_theme', 'theme4w4ed_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function theme4w4ed_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'theme4w4ed_content_width', 640 );
}
add_action( 'after_setup_theme', 'theme4w4ed_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function theme4w4ed_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'theme4w4ed' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'theme4w4ed' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
 
	register_sidebar(
		array(
			'name'          => esc_html__( 'Pied de page', 'theme4w4ed' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'theme4w4ed' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Pied de page 2', 'theme4w4ed' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'theme4w4ed' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
/// Equivalent au add.EventListener . C'est un hook
add_action( 'widgets_init', 'theme4w4ed_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
/*
echo "<pre>";
echo filemtime(get_template_directory(). "/style.css");
echo "</pre>";
 wp_die();
*/

// wp_register_style

function theme4w4ed_scripts() {
	/// pour rendre le démarrage du site plus rapide
	wp_register_style( 'theme4w4ed-style', get_stylesheet_uri(), array(), filemtime(get_template_directory(). "/style.css"), 'all' );
	wp_enqueue_style( 'theme4w4ed-style');


	wp_style_add_data( 'theme4w4ed-style', 'rtl', 'replace' );

	wp_enqueue_script( 'theme4w4ed-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'theme4w4ed-burger', get_template_directory_uri() . '/js/burger.js', array(), _S_VERSION, true );

	/// WP Register implémente le code sans l'activer tout de suite
	wp_register_script('theme4w4ed-carrousel', get_template_directory_uri() . '/js/carrousel.js', array(), _S_VERSION, true );
	wp_register_script('theme4w4ed-carrousel-2', get_template_directory_uri() . '/js/carrousel-2.js', array(), _S_VERSION, true );
	wp_register_script('theme4w4ed-api-rest', get_template_directory_uri() . '/js/api-rest', array(), filemtime(get_template_directory(). "/js/api-rest.js"), true );


	if ( is_front_page()) { /// Ajoute le script de carrousel et api-rest seulement si on est dans la page d'acceuil
	//	wp_enqueue_script( 'theme4w4ed-carrousel' );
		wp_enqueue_script( 'theme4w4ed-carrousel-2' );
		wp_enqueue_script( 'theme4w4ed-api-rest' );
		wp_localize_script( 'theme4w4ed-api-rest', 'monObjJS', array(
			'nonce' => wp_create_nonce( 'wp_rest' ), /// Tableau Associatif
			'siteURL' => get_site_url()) /// Va chercher l'URL du site qui va rentrer dans la variable 'monObjJS'
		);
	}


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme4w4ed_scripts' );

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

function extraire_cours_front_page($query){
		if( !is_admin() && $query->is_front_page() && $query->is_main_query() ){

		$query->set( 'category_name', 'cours' );
		$query->set('posts_per_page', -1 );
		$query->set('meta_key', "type_de_cours");
		$query->set('orderby', array( 'meta_value' => 'DESC', 'title' => 'ASC' ));
		
	}
}
/// Add action sert à ÉCOUTER les hooks. Un crochet qui se trouve à l'intérieur de word press. Dès qu'il en trouve un, il s'active. 
/// Il sert à adapter la function de wordpress, en fonction de où WordPress est rendu dans l'éxécution de son code
/// pre get post = avant d'extraire les articles
add_action('pre_get_posts','extraire_cours_front_page');


