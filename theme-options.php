<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/* ------------------------------------------------------------------------ *
 * Setting Registration for theme Gogrid
 * ------------------------------------------------------------------------ */

/**
 * Initializes the theme options page by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */
add_action( 'admin_init', 'gogrid_add_theme_settings' );
add_action( 'admin_menu', 'gogrid_add_options_page' );
/**
 * Add theme menu
 *
 * @since 1.0.6
 * @uses add_theme_page()
 * $page_title, $menu_title, $capability, $menu_slug, $function
 */

function gogrid_add_options_page() {

    add_theme_page(

        __( 'Instructions Etc', 'gogrid' ),
        __( 'Theme Overview', 'gogrid' ),
        'edit_theme_options',
        'gogrid_page_elements',
        'gogrid_display_options_page'
    );
}

/**
 * Add theme settings and section
 *
 * @since 1.0.6
 * @uses add_settings_section()
 * $id, $title, $callback, $page
 */
function gogrid_add_theme_settings() {

        add_settings_section (
            'gogrid_page_section',
            __( 'Theme Overview', 'gogrid' ),
            'gogrid_options_page_callback',
            'gogrid_page_elements'
        );
}

function gogrid_options_page_callback() {

    echo esc_attr( '<h2>' );
    esc_html_e( 'Gogrid Theme Instructions and General Information', 'gogrid' );
    echo esc_attr( '</h2>' );
}

function gogrid_display_options_page(){
  ?>
	<div class="wrap">
    <h1><div id="icon-info" class="dashicons dashicons-welcome-learn-more"></div>
    <?php esc_html_e( 'Gogrid theme page', 'gogrid' ); ?></h1>

        <h3><?php esc_html_e( 'General Overview of Theme Settings', 'gogrid' ); ?></h3>
        <figure>
<img src="<?php echo esc_url( get_template_directory_uri() . '/css/instruct.png' ); ?>" height="600" width="auto" alt="boxes"/>
</figure>
<ul><li><?php esc_html_e( 'The areas for widgets all have alternative fallbacks that are created so there should be content in every widget box.', 'gogrid' ); ?></li>
<li><?php esc_html_e( 'If a widget does not exists (you have not added any widgets yet) then you will see a message telling you what box is empty.', 'gogrid' ); ?></li>
<li><?php esc_html_e( 'All templates will follow the previous template\'s default. If Secondary Template has no widgets then it will use the widgets from the Primary Template.', 'gogrid' ); ?></li>
<li><?php esc_html_e( 'As follows, the Quad Template will use the widgets from the Secondary but display secondary widgets AFTER Quad Widgets, if installed.', 'gogrid' ); ?></li>
</ul>
	</div>
	<?php
}
/**
 * This function renders the interface elements.
 *
 * It accepts an array of arguments and expects the first element in the array to be the description
 * to be displayed.
 */
/*
.main-content {
	background: white;
}
.masthead {
	background: #2185C588;
	color: white;
}

.sidebar {
	background: #FF7F6688;
}

.gogridtwin {
	background: #2185C588;
}

.gogridtwin:last-of-type {
	background: #7ECEFD88;
}

.colophon {
	padding: 2em;
	background: #3E454C88;
	color: white;
}
*/