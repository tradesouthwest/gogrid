<?php
/**
 * The template part for displaying content
 *
 * @package    ClassicPress
 * @subpackage GoGrid
 * @since      GoGrid 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="content-title">
    <h2 class="card-title h4">
    <a href="<?php the_permalink(); ?>" 
    title="<?php the_title_attribute(); ?>">
    <?php the_title(); ?> <small class="post-publish-date"><em> 
        <?php the_date(); ?></em></small></a>
    </h2>
	</header>
	<div class="entry-content">
		<?php 
		the_excerpt(); 
		?>
	</div><!-- .entry-content -->
    <div class="after-entry">

        <?php do_action( 'gogrid_theme_after_entry' ); ?>
        
    </div>
</article><!-- #post-## -->
