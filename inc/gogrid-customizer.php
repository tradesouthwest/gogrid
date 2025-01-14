<?php
    /**
     * Customizer assets - gogrid
	 * Header Background Color setting
	 *
	 * Uses a color wheel to configure the Header Background Color setting.
	 *
	 * https://developer.wordpress.org/reference/classes/wp_customize_manager/add_setting/
     *
     * Excerpt Length for Pullquote (page excerpt enabled in functions.php)
     * Uses 'gogrid_teaser_length()' to callback on page output
*/
add_action( 'wp_head', 'gogrid_customizer_css');

add_action( 'customize_register', 'gogrid_register_theme_customizer' );  

function gogrid_register_theme_customizer($wp_customize)
{

    $wp_customize->add_section('gogrid_theme_setup_section', array(
        'title'             => __( 'Gogrid Theme Controls', 'gogrid' ),
        'priority'          => 45
    ));
    /** (5)
     * WP_Customize_ /add_setting for pullquote teaser width
    */
	$wp_customize->add_setting(	'gogrid_full_site_width_setting', array(
        'type'              => 'theme_mod',
        'default'           => 520,
        'sanitize_callback'	=> 'sanitize_text_field',
        'transport'			=> 'refresh'
    )
    );
    /** (6)
     * WP_Customize_ /add_setting for post excerpt words
    */
	$wp_customize->add_setting(	'gogrid_posts_excerpt_length_setting', array(
        'type'              => 'theme_mod',
        'default'           => 58,
        'sanitize_callback'	=> 'sanitize_text_field',
        'transport'			=> 'refresh'
    )
    );

    // (5) width of teaser
    $wp_customize->add_control(
        'gogrid_custom_teaser_width', array(
            'settings'          => 'gogrid_full_site_width_setting',
            'type'              => 'number',
            'section'           => 'gogrid_theme_setup_section',
            'label'             => __( 'Set Site Container Width', 'gogrid' ),
            'description'       => __( 'This sets how wide the inner content will be, in pixels.', 'gogrid' ),
            'input_attrs' => array(
                'min' => 0,
                'max' => 980,
            ),
        )
    );
    // (6) posts excerpt length control
    $wp_customize->add_control(
        'gogrid_posts_excerpt_length', array(
            'settings'          => 'gogrid_posts_excerpt_length_setting',
            'type'              => 'number',
            'section'           => 'gogrid_theme_setup_section',
            'label'             => __( 'Set POSTS ONLY Excerpt Length', 'gogrid' ),
            'input_attrs' => array(
                'min' => 0,
                'max' => 385,
            ),
        )
    );
}


/** (1), (2), (3), (5), (8 called from template directly)
 * Writes the Header Background Anchor Links and Width of Teaser related controls'
 * values outputed to the 'head' of the document
 * by reading the value(s) from the theme mod value in the options table.
 */
function gogrid_customizer_css() {
    if ( get_theme_mods() )
    :
    echo '<style type="text/css" id="gogrid-customizer-style">';
        
        if ( get_theme_mod( 'gogrid_full_site_width_setting' ) ) :
            $gogridmain = get_theme_mod( 'gogrid_full_site_width_setting', 520);
            echo '@media screen and (min-width: 680px){.main-content{ width:' . esc_attr( $gogridmain ) .'px;}}';

        endif;
    echo '</style>';
    endif;

    }

/** (6)
 * post excerpt length
 * @return excerpt_length
 * integer value
*/
function gogrid_custom_posts_excerpt_length()
{ 
    if( !is_admin()) : 
    if ( get_theme_mods( ) ) {
        $length = get_theme_mod( 'gogrid_posts_excerpt_length_setting', 60 );
        return esc_attr( $length );
    }
    endif;
}
add_filter( 'excerpt_length', 'gogrid_custom_posts_excerpt_length' );


//sanitizer for integer
function gogrid_sanitize_number_absint( $number, $setting ) {
    // Ensure $number is an absolute integer (whole number, zero or greater).
    $number = absint( $number );
  
    // If the input is an absolute integer, return it; otherwise, return the default
    return ( $number ? $number : $setting->default );
  }
  //sanitize for checkbox
  function gogrid_sanitize_checkbox( $checked ) {
      // Boolean check.
      return ( ( isset( $checked ) && true == $checked ) ? true : false );
  }
  