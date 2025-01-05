<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package    ClassicPress
 * @subpackage GoGrid
 * @since      GoGrid 1.0.0
 */
?>
<div class="sidebar-widget-section">
				
    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

	<aside id="secondary" class="sidebar widget-area" role="complementary">
		
		<?php dynamic_sidebar( 'sidebar-1' ); ?>

	</aside><!-- .sidebar .widget-area -->
    
	<?php endif; ?>
	
		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
		
		<div id="secondary" class="sidebar widget-area" role="complementary">

			<?php dynamic_sidebar( 'sidebar-3' ); ?>

		</div><!-- .sidebar .widget-area -->
		
		<?php endif; ?>

</div>
