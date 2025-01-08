<?php
/**
 * Template Name: Four Widgets | Sidebar #3
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

<body>
<div class="site">
    <a class="skip-link screen-reader-text" href="#content">Skip to content</a>

    <div class="masthead">
    
				<p class="site-description"><?php echo esc_html( get_bloginfo( 'description', 'display' ) ); ?></p>

		
</div><!-- .masthead -->


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
        endif; ?>
        </main>


            <aside class="sidebar">
			<?php 
            /* fourth sidebar widget */
			if ( is_active_sidebar( 'sidebar-fourth' ) ) { ?>

				<?php dynamic_sidebar( 'sidebar-fourth' ); ?>
                <?php 
                } else { ?>
                <?php
                if ( is_active_sidebar( 'sidebar' ) ) 
                        dynamic_sidebar( 'sidebar' );
            } ?>
			</aside>

                <aside class="gogridtwin"><!-- starts s10 -->
                    <?php 
                    if ( is_active_sidebar( 'sidebar-10' ) ) {
                        dynamic_sidebar( 'sidebar-10' );
                        
                        } else { ?>

                    <div class="nosb10-blank"><small><?php esc_html_e( 'Add widgets here or set style to `.nosb10-blank{visibility: hidden}`', 'gogrid' ); ?></small></div>
                    <?php 
                    } ?><!-- ends s10 -->
                    <!-- starts s7 -->
                    <?php 
                    if ( is_active_sidebar( 'sidebar-7' ) ) {
                        dynamic_sidebar( 'sidebar-7' );
                        
                        } else { ?>

                    <div class="nosb7-blank"><small><?php esc_html_e( 'Add widgets here or set style to `.nosb7-blank{visibility: hidden}`', 'gogrid' ); ?></small></div>
                    <?php 
                    } ?><!-- ends s7 -->
                   
                </aside>

                <aside class="gogridtwin"> <!-- start s11 -->
                    <?php 
                    if ( is_active_sidebar( 'sidebar-11' ) ) {
                        dynamic_sidebar( 'sidebar-11' ); 
                        } else { ?>

                        <div class="nosb11-blank"><small><?php esc_html_e( 'Add widgets here or set style to `.nosb11-blank{visibility: hidden}`', 'gogrid' ); ?></small></div>
                    <?php 
                    } ?><!-- ends s11 -->
                    <!-- starts s8 -->
                    <?php 
                    if ( is_active_sidebar( 'sidebar-8' ) ) {
                        dynamic_sidebar( 'sidebar-8' );
                        
                        } else { ?>

                    <div class="nosb8-blank"><small><?php esc_html_e( 'Add widgets here or set style to `.nosb8-blank{visibility: hidden}`', 'gogrid' ); ?></small></div>
                    <?php 
                    } ?><!-- ends s8 -->
                </aside>
                
    <?php get_footer(); ?>
</div>
