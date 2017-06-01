<?php
/**
 * cci_snap functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package cci_snap
 */

if ( ! function_exists( 'cci_snap_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cci_snap_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on cci_snap, use a find and replace
	 * to change 'cci_snap' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'cci_snap', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'cci_snap' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'cci_snap_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'cci_snap_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cci_snap_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cci_snap_content_width', 640 );
}
add_action( 'after_setup_theme', 'cci_snap_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cci_snap_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'cci_snap' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'cci_snap' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'cci_snap_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cci_snap_scripts() {
    wp_enqueue_script("jquery");
	wp_enqueue_style( 'cci_snap-style', get_stylesheet_uri() );


	wp_enqueue_script( 'cci_snap-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'cci_snap-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cci_snap_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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


/**
 * Creating Custom Post Type: Digital Asset
 */

function my_custom_asset() {
  $labels = array(
    'name'               => _x( 'Assets', 'post type general name' ),
    'singular_name'      => _x( 'Asset', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'asset' ),
    'add_new_item'       => __( 'Add New Asset' ),
    'edit_item'          => __( 'Edit Asset' ),
    'new_item'           => __( 'New Asset' ),
    'all_items'          => __( 'All Assets' ),
    'view_item'          => __( 'View Asset' ),
    'search_items'       => __( 'Search Assets' ),
    'not_found'          => __( 'No assets found' ),
    'not_found_in_trash' => __( 'No assets found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Assets'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our digital asset data',
    'public'        => true,
    'menu_position' => 21,
    'menu_icon'     => 'dashicons-media-default',
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'   => false,
  );
  register_post_type( 'asset', $args ); 
}
add_action( 'init', 'my_custom_asset' );


/**
 * Creating Custom Authorship
 */

function my_custom_author() {
  $labels = array(
    'name'               => _x( 'Authors', 'post type general name' ),
    'singular_name'      => _x( 'Author', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'author' ),
    'add_new_item'       => __( 'Add New Author' ),
    'edit_item'          => __( 'Edit Author' ),
    'new_item'           => __( 'New Author' ),
    'all_items'          => __( 'All Authors' ),
    'view_item'          => __( 'View Author' ),
    'search_items'       => __( 'Search Authors' ),
    'not_found'          => __( 'No authors found' ),
    'not_found_in_trash' => __( 'No authors found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Authors'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Specific Details about our Authors',
    'public'        => true,
    'menu_position' => 23,
    'menu_icon'     => 'dashicons-id',
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'   => false,
  );
  register_post_type( 'author', $args ); 
}
add_action( 'init', 'my_custom_author' );



/**
 * Creating Section Definer
 */

function my_custom_section() {
  $labels = array(
    'name'               => _x( 'Sections', 'post type general name' ),
    'singular_name'      => _x( 'Section', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'section' ),
    'add_new_item'       => __( 'Add New Section' ),
    'edit_item'          => __( 'Edit Section' ),
    'new_item'           => __( 'New Section' ),
    'all_items'          => __( 'All Sections' ),
    'view_item'          => __( 'View Section' ),
    'search_items'       => __( 'Search Sections' ),
    'not_found'          => __( 'No sections found' ),
    'not_found_in_trash' => __( 'No sections found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Sections'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Specific details on sections',
    'public'        => true,
    'menu_position' => 22,
    'menu_icon'     => 'dashicons-slides',
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'   => false,
  );
  register_post_type( 'section', $args ); 
}
add_action( 'init', 'my_custom_section' );


/**
 * Removing icons/menus in admin
 */

add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );

function remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
}
add_action( 'admin_menu', 'remove_menus' );
function remove_menus(){
    remove_menu_page('themes.php');
    remove_menu_page('plugins.php');
}

function get_section_nav(){
    $args = array( 
        'post_type' => 'section', 
        'posts_per_page' => -1,
        'orderby' =>'menu_order',
    );
    $loop = new WP_Query( $args );
    $sectionnum = 0;
    echo '<ul class="top-nav-sections">';
    while ( $loop->have_posts() ) : $loop->the_post();
        echo '<li><a href="'.get_permalink().'" id="section-'.$sectionnum.'">';
        echo get_the_title();
        echo '</a>';
    
        //for specifying color of btn
        echo "\n";
        echo '<script type="text/javascript">';
        echo 'jQuery(document).ready(function($){';
        echo '$(\'#section-'.$sectionnum.'\').parent().hover(function(){';
        echo '$(this).css("background-color","'.get_field("section_color").'");';
        echo '},function(){$(this).css("background-color","white");});';
        echo '});';
        echo '</script>';

        
        if( have_rows('subsectionbuilder') ):
            echo '<div class="section-top-nav-expanded">';
            while ( have_rows('subsectionbuilder') ) : the_row();
                echo '<div class="subsection" style="border-top:0.35em solid '.get_field("section_color").'">';
                echo '<div class="subsection-col1">';
                echo '<div class="subsection-title">'.get_sub_field('sub_section_title').'</div>';
                echo '<div class="subsection-description">'.get_sub_field('sub_section_description').'</div>';
                echo '</div>';
                echo '<div class="subsection-col2">';
                if (have_rows('assetselection')) :
                    echo '<ul class="subsection-nav">';
                    while(have_rows('assetselection')) : the_row();
                        echo '<li>';
                        $asset_obj = get_sub_field('asset');
                        
                        echo '<a href="'.get_permalink($asset_obj->ID).'">';
                        echo '<div class="nav-icon-'.get_field('digital_asset_type',$asset_obj).'"></div>';
                        echo get_the_title($asset_obj).'</a></li>';
                    endwhile;
                    echo '</ul>';
                endif;
                echo '</div></div>';
            endwhile;
            echo '</div>';
        endif;
        echo '</li>';
        $sectionnum++;
    endwhile;
    echo '</ul>';

}


function get_section_nav_mobile(){
    $args = array( 
        'post_type' => 'section', 
        'posts_per_page' => -1,
        'orderby' =>'menu_order',
    );
    $loop = new WP_Query( $args );
    $sectionnum = 0;
    echo '<ul class="top-nav-sections">';
    while ( $loop->have_posts() ) : $loop->the_post();
        echo '<li><a href="'.get_permalink().'" id="section-mobile-'.$sectionnum.'">';
        echo get_the_title();
        echo '</a>';
    
        //for specifying color of btn
    
        echo "\n";
        echo '<script type="text/javascript">';
        echo 'jQuery(document).ready(function($){';
        echo '$(\'#section-mobile'.$sectionnum.'\').parent().hover(function(){';
        echo '$(this).css("background-color","'.get_field("section_color").'");';
        echo '},function(){});';
        echo '});';
        echo '</script>';
        
        if( have_rows('subsectionbuilder') ):
            echo '<div class="section-top-nav-expanded">';
            while ( have_rows('subsectionbuilder') ) : the_row();
                echo '<div class="subsection" style="border-top:0.35em solid '.get_field("section_color").'">';
                echo '<div class="subsection-col1">';
                echo '<div class="subsection-title">'.get_sub_field('sub_section_title').'</div>';
                echo '<div class="subsection-description">'.get_sub_field('sub_section_description').'</div>';
                echo '</div>';
                echo '<div class="subsection-col2">';
                if (have_rows('assetselection')) :
                    echo '<ul class="subsection-nav">';
                    while(have_rows('assetselection')) : the_row();
                        echo '<li>';
                        $asset_obj = get_sub_field('asset');
                        
                        echo '<a href="'.get_permalink($asset_obj->ID).'">';
                        echo '<div class="nav-icon-'.get_field('digital_asset_type',$asset_obj).'"></div>';
                        echo get_the_title($asset_obj).'</a></li>';
                    endwhile;
                    echo '</ul>';
                endif;
                echo '</div></div>';
            endwhile;
            echo '</div>';
        endif;
        echo '</li>';
        $sectionnum++;
    endwhile;
    echo '</ul>';

}

function get_section_nav_page(){
    $args = array( 
        'post_type' => 'section', 
        'posts_per_page' => -1,
        'orderby' =>'menu_order',
    );
    $loop = new WP_Query( $args );
    $code = '<ul class="nav-sections">';
    while ( $loop->have_posts() ) : $loop->the_post();
        $code .= '<li><a href="'.get_permalink().'" style="background-color:'.get_field('section_color').'"><div class="text-center">';
        $code .= get_the_title();
        $code .= '</div></a></li>';
    endwhile;

    return $code;
}
add_shortcode('section_nav','get_section_nav_page');

/**
 * Creating Sections
 */

/* Adding custom footer comment */

function remove_footer_admin () {
echo '<i>Fueled by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Created by <a href="http://clicktoplaymedia.com/" target="_blank">Click to Play Media</a></i>';
}

add_filter('admin_footer_text', 'remove_footer_admin');

/* customize login screen */




function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/style-login.css' );
    //wp_enqueue_script( 'custom-login', get_template_directory_uri() . '/style-login.js' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );