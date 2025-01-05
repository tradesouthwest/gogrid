<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package    ClassicPress
 * @subpackage GoGrid
 * @since      GoGrid 1.0.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main">
    <?php esc_attr_e( 'Skip to content', 'gogrid' ); ?></a>

	<div class="header">
		
		<div id="header-menu" class="site-header-menu">
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		
			<nav id="nav" class="navbar navigation-top" aria-label="<?php esc_attr_e( 'Primary Menu', 'gogrid' ); ?>">
			
			<?php 
			if ( has_nav_menu( 'primary' ) ) : ?>
			<div id="menu-toggle">
				<details class="mobil-only-top">
				<summary class="mobil-only-button">
					<span class="menu-toggle">|||</span>
					<span class="menu-toggle-text screen-reader-text"><?php esc_html_e( 'open menu', 'gogrid' ); ?></span>	
				</summary>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_class' => 'primary-menu',
						)
					);
				?>
				</details>
			</div>
			<?php 
			endif; ?>
		
			</nav><!-- .main-navigation -->
			<?php 
            if( has_custom_logo() ) : ?>

            <div class="gogrid-logo-container site-logo">
                <a href="<?php 
				echo esc_url( home_url( '/' ) ); ?>" 
                   rel="bookmark"><?php 
				echo wp_kses_post( force_balance_tags( gogrid_theme_custom_logo() ) ); ?></a>
            </div>
            <?php 
            endif; ?>

		</div>
	</div><!-- .site-header -->