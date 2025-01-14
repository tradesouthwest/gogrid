<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package    ClassicPress
 * @subpackage GoGrid
 * @since      GoGrid 1.0.2 
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
<div class="site">

    <div class="masthead">

	<header class="header">
			<?php $header_image = get_header_image();
			            if ( ! empty( $header_image ) ) : ?>

	<figure class="header-banner">

                        <a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" 
                        rel="home"><img id="header-img" src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" 
                        height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
                        </figure>
                        		            	<?php 
                        endif; ?>

		<div id="header-menu" class="site-header-menu">
		
		
			<nav id="nav" class="navbar navigation-top" aria-label="<?php esc_attr_e( 'Primary Menu', 'gogrid' ); ?>">
			<h1 class="site-title"><a class="nobkg" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
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
			

		</div>
		
		<?php 
            if( has_custom_logo() ) : ?>

	<div class="site-logo-container">

            <p class="site-description">	<?php echo esc_html( get_bloginfo( 'description', 'display' ) ); ?></p>
			<div class="gogrid-logo-container site-logo">
                <a href="<?php 
				echo esc_url( home_url( '/' ) ); ?>" 
                   rel="bookmark"><?php 
				echo wp_kses_post( force_balance_tags( gogrid_theme_custom_logo() ) ); ?></a>
            </div>
	</div>
            <?php 
            else:
            ?>
		<p class="site-description">	<?php echo esc_html( get_bloginfo( 'description', 'display' ) ); ?></p>
<?php
		endif; ?>
	</header><!-- .site-header -->

	
    </div><!-- .masthead -->
