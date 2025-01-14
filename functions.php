<?php
/**
 * GoGrid functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package    ClassicPress
 * @subpackage GoGrid
 * @since      GoGrid 1.0.2
 */

/**
 * ******************************************************************
 * INFO: This ClassicPress version based on WordPress Twenty_Sixteen. 
 * CMS required: "wp_body_open" action or function call not inserted.
 * ******************************************************************
 * @since 1.0
 */

// FAST LOADER References ( find #id in DocBlocks )
// ------------------------- Actions ---------------------------
// A1
add_action( 'after_setup_theme',  'gogrid_theme_setup' );
// A2
add_action( 'after_setup_theme',  'gogrid_theme_content_width', 0 );
// A3
add_action( 'wp_enqueue_scripts', 'gogrid_theme_enqueue_styles' );
//A3.1
add_action( 'admin_enqueue_scripts', 'gogrid_theme_load_admin_style' );
// A4
add_action( 'widgets_init',       'gogrid_theme_widgets_init' );
// A5
add_action( 'gogrid_theme_after_entry', 'gogrid_theme_after_entry_render' );
// ------------------------- Filters -----------------------------
// F1 
add_filter( 'body_class',            'gogrid_theme_body_classes' );
// F2
add_filter( 'excerpt_more', 'gogrid_theme_excerpt_more' );

/** #A1
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own gogrid_setup() function to override in a child theme.
 *
 * @since gogrid 1.0
 */
if ( ! function_exists( 'gogrid_theme_setup' ) ) :

function gogrid_theme_setup() {
	    /*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
		 * If you're building a theme based on gogrid, use a find and replace
		 * to change 'gogrid' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'gogrid', 
			get_template_directory_uri() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let ClassicPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		//add_image_size( 'gogrid-featured', 9999, 320 ); 
		//set_post_thumbnail_size( 9999, 320 );

		/*
		 * Enable support for custom logo.
		 *
		 *  @since gogrid 1.2
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 140,
				'width'       => 140,
				'flex-height' => true,
			)
		);
		// Add a filter to jacqui_header_image_width _height to change the width and height of your custom header.
    $custom_header_support = array(
        'flex-height' => true,
        'flex-width'  => true,
        'width'  => apply_filters( 'gogrid_header_image_width', 9999 ),
        'height' => apply_filters( 'gogrid_header_image_height', 740 ),
    );
    add_theme_support( 'custom-header', $custom_header_support );


		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'gogrid' ),
				'social'  => __( 'Social Links Menu', 'gogrid' ),
			)
		);
}
endif;

/** #A2
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since gogrid 1.0
 */
function gogrid_theme_content_width() {
	if ( ! function_exists( 'wp_body_open' ) ) {
    
		function wp_body_open() {
			do_action( 'wp_body_open' );
		}
	}
	if ( ! isset( $content_width ) ) {
		$content_width = 740;
	}
}



/** #A3
 * Enqueues scripts and styles.
 *
 * @since gogrid 1.0.3
 */
function gogrid_theme_enqueue_styles() {
	wp_enqueue_style( 
		'gogrid-style', 
		get_stylesheet_uri() 
	);
    
	wp_enqueue_script( 'gogrid-theme-script', 
		get_template_directory_uri() . '/js/gogrid-theme.js', 
		array( 'jquery' ), 
		'1.0.3', 
		true 
	);

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 
			'comment-reply' 
		);
	}
}

/** #A3.1
 * Enqueues scripts and styles.
 *
 * @since gogrid 1.0.3
 */
function gogrid_theme_load_admin_style() {
    
	wp_enqueue_style( 'gogrid-admin-style', 
	get_template_directory_uri() . '/css/gogrid-admin-style.css');
}

/**
 * Support for logo upload, output. 
 *
 * @since 1.0.1 
 */
function gogrid_theme_custom_logo() {
    $output = '';

    if ( function_exists( 'the_custom_logo' ) ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo           = wp_get_attachment_image_src( $custom_logo_id , 'medium' );

        if ( has_custom_logo() ) {
            $output = '<div class="header-logo">
			<img src="'. esc_url( $logo[0] ) .'" alt="'. get_bloginfo( 'name' ) .'" 
			class="gogrid-attachment-logo"/>
			</div>'; 
        } else { 
            $output = ''; 
        }
    }
        // Output sanitized in header to assure all html displays.
        return $output;
}
/** #A4
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since gogrid 1.0
 */
function gogrid_theme_widgets_init() {
	
	register_sidebar(
		array(
			'name'          => __( 'Primary Side', 'gogrid' ),
			'id'            => 'sidebar',
			'description'   => __( 'Appears on the side of all content with default template. (sidebar)', 'gogrid' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => __( 'Primary Left Content', 'gogrid' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Add widgets here to appear in this spot. (sidebar-2)', 'gogrid' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => __( 'Primary Right Content', 'gogrid' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Appears at the bottom of the content on posts and pages. (sidebar-3)', 'gogrid' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Secondary Alternative Sidebar', 'gogrid' ),
			'id'            => 'sidebar-secondary',
			'description'   => __( 'Appears on the side of all Secondary content. (sidebar-secondary)', 'gogrid' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => __( 'Secondary Left Content', 'gogrid' ),
			'id'            => 'sidebar-4',
			'description'   => __( 'Apperears for Secondary Template, lower left. (sidebar-4)', 'gogrid' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => __( 'Secondary Right Content', 'gogrid' ),
			'id'            => 'sidebar-5',
			'description'   => __( 'Appears for Secondary Template, lower right. (sidebar-5)', 'gogrid' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Third Main Sidebar', 'gogrid' ),
			'id'            => 'sidebar-third',
			'description'   => __( 'Appears on the side of all Third content. (sidebar-third)', 'gogrid' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => __( 'Third Lower Left', 'gogrid' ),
			'id'            => 'sidebar-7',
			'description'   => __( 'Apperears for Third Template, lower left. (sidebar-7)', 'gogrid' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => __( 'Third Lower Right', 'gogrid' ),
			'id'            => 'sidebar-8',
			'description'   => __( 'Appears for Third Template, lower right. (sidebar-8)', 'gogrid' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Fourth Main Sidebar', 'gogrid' ),
			'id'            => 'sidebar-fourth',
			'description'   => __( 'Appears on the side of all Fourth content. (sidebar-fourth)', 'gogrid' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => __( 'Fourth Lower Left', 'gogrid' ),
			'id'            => 'sidebar-10',
			'description'   => __( 'Apperears for Fourth Template. (sidebar-10)', 'gogrid' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => __( 'Fourth Lower Right', 'gogrid' ),
			'id'            => 'sidebar-11',
			'description'   => __( 'Appears for Fourth Template, lower right. (sidebar-11)', 'gogrid' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'gogrid' ),
			'id'            => 'sidebar-footer',
			'description'   => __( 'Appears in the theme footer. (sidebar-footer)', 'gogrid' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

/** #A5
 * gogrid_theme_after_entry
 * 
 */
function gogrid_theme_after_entry_render(){
?>
	<div class="gogrid-heading-meta">
		<small><?php esc_html_e('By: ', 'gogrid'); ?> <em><?php the_author(); ?></em>
		| <?php esc_html_e('Categorized as: ', 'gogrid'); ?> <em><?php the_category( ' &bull; ' ); ?></em>
		| <?php esc_html_e('Keys: ', 'gogrid'); ?><em> <?php the_tags( ' ' ); ?></em>
		<!-- <?php esc_html_e('Added on: ', 'gogrid'); ?> <em><?php echo esc_html( get_the_date() ); ?></em> -->
		</small>
	</div>
	<?php 
}
/** #F1
 * Adds custom classes to the array of body classes.
 *
 * @since GoGrid 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function gogrid_theme_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}

/**
 * Text sanitizer for outputs
 * @since 1.0.5
 * 
 * @return string $input
 */
function gogrid_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}


/** F2
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function gogrid_theme_excerpt_more( $more ) {
	if ( ! is_single() ) {
		$more = sprintf( '&nbsp;<a class="read-more" href="%1$s">%2$s</a>',
			get_permalink( get_the_ID() ),
			esc_html__( 'More...', 'gogrid' )
		);
	}

	return $more;
}
/**
 * Customizer additions.
 * @since 1.0.2
 */
require get_template_directory() . '/inc/gogrid-customizer.php';
?>
