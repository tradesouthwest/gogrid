<?php
/**
 * Template Name: Secondary Sidebars
 * The alternate template file.
 *
 * This is the theme file that you may choose to use from within the editor 
 * Page Attributes box. This template shows 3 completely different sidebars
 * That you must select from the widgets tool box.
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
			if ( is_active_sidebar( 'sidebar-secondary' ) ) : ?>

					<?php dynamic_sidebar( 'sidebar-secondary' ); ?>
            
			<?php 
			else: 
                if ( is_active_sidebar( 'sidebar' ) ) {
				    dynamic_sidebar( 'sidebar' );
                    } else { 
                    echo '<div class="nosb3-blank"></div>'; 
                } ?>
            <?php 
			endif; ?>
			</aside>

                <aside class="gogridtwin">
                <?php 
                    if ( is_active_sidebar( 'sidebar-4' ) ) {
                        dynamic_sidebar( 'sidebar-4' );
                        
                    } else { ?>

                    <div class="nosb4-blank"><small><?php esc_html_e( 'Add widgets here or set style to `.nosb4-blank{visibility: hidden}`', 'gogrid' ); ?></small></div>
                <?php 
                } ?>
                </aside>

                <aside class="gogridtwin">
                <?php 
                if ( is_active_sidebar( 'sidebar-5' ) ) {
                    dynamic_sidebar( 'sidebar-5' ); 
                } else { ?>

                    <div class="nosb5-blank"><small><?php esc_html_e( 'Add widgets here or set style to `.nosb5-blank{visibility: hidden}`', 'gogrid' ); ?></small></div>
                <?php 
                } ?>
                </aside>

    <?php get_footer(); ?>
</div>
