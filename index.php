<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package    ClassicPress
 * @subpackage GoGrid
 * @since      GoGrid 1.0
 */

get_header(); ?>

        <main id="content" class="main-content">
        <?php if ( have_posts() ) : ?>

            <?php
            // Start the loop.
            while ( have_posts() ) :
                the_post();

                if ( is_home() || is_archive() ) {
                    get_template_part( 'excerpt' );
                } else {
                    get_template_part( 'content' );
                    //comment_form( $args, $post );
                }

            // End the loop.
            endwhile;
            ?>

            <div id="postPagination" class="post-navigation">
                <?php
                // Previous/next page navigation.
                the_posts_pagination( ); 
                ?>
            </div>

            <?php 
            else: ?>
            <hr>
            <?php
            endif; ?>

        </main>
            <aside class="sidebar">
			<?php 
			if ( is_active_sidebar( 'sidebar' ) ) : ?>

					<?php dynamic_sidebar( 'sidebar' ); ?>
            
			<?php 
			else: 
			echo '<div class="nocta-blank"></div>';
			endif; ?>
			</aside>



    <aside class="gogridtwin">
    <?php 
		if ( is_active_sidebar( 'sidebar-2' ) ) {
            dynamic_sidebar( 'sidebar-2' );
            
        } else { ?>

        <div class="nosb2-blank"><small><?php esc_html_e( 'Add widgets here or set style to `.nosb2-blank{visibility: hidden}`', 'gogrid' ); ?></small></div>
    <?php 
    } ?>
    </aside>
    <aside class="gogridtwin">
    <?php 
    if ( is_active_sidebar( 'sidebar-3' ) ) {
        dynamic_sidebar( 'sidebar-3' ); 
    } else { ?>

        <div class="nosb3-blank"><small><?php esc_html_e( 'Add widgets here or set style to `.nosb3-blank{visibility: hidden}`', 'gogrid' ); ?></small></div>
    <?php 
    } ?>
    </aside>


    <?php get_footer(); ?>
</div>
