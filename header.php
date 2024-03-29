<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cci_snap
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'cci_snap' ); ?></a> 

	<header id="masthead" class="site-header" role="banner">
        
            <div class="site-branding">
                <div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="header-logo-img" src="<?php echo get_template_directory_uri();?>/img/ccilogo.png"></a></h1>
            </div><!-- .site-branding -->

            
            <nav id="site-navigation" class="main-navigation" role="navigation">
                <label class="menuswitch" for="sidetoggle"><input type="checkbox" id="sidetoggle"><?php get_section_nav_mobile(); ?><div class="menutoggle"></div></label>
                <?php get_section_nav(); ?>
                <?php 
                //wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); 
                ?>
            </nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content" >
