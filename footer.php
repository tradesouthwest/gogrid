<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package    ClassicPress
 * @subpackage GoGrid
 * @since      GoGrid 1.0.0
 */
?>    <footer class="colophon grid">

	<div class="footer">

		<footer id="colophon" class="site-footer" role="contentinfo">
		
			<div class="footer-side-item">
									
			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'gogrid' ); ?>">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1
							)
						);
					?>
				</nav><!-- .social-navigation -->
			<?php endif; ?>
			
			</div>
			
			<div class="site-info">
				<p><span class="foot-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
				}
				?>
				<!--<p><a class="classicpress-credit" href="<?php echo esc_url( __( 'https://www.classicpress.net/', 'gogrid' ) ); ?>" class="imprint">
				<?php
				printf( esc_attr__( 'Proudly powered by %s', 'gogrid' ), 'ClassicPress' );
				?></a></p>-->
				<div class="upto">
    				<a class="back_to_top" title="<?php esc_attr_e('Top of page link', 'gogrid'); ?>"><sup>^</sup></a>
				</div>
			</div><!-- .site-info -->

<?php wp_footer(); ?>
</footer>


</body>
</html>
