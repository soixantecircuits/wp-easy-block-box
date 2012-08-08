<?php
class myTinyMceButton_Client {
    
    function __construct() {
        wp_register_style(
            "style_box",
            plugins_url( "ressources/css/style_box.css", __FILE__ ),
            false,
            0.1
        );
        wp_enqueue_style( "style_box" );

        add_shortcode( 'easybox', array( &$this, 'box_shortcode' ));
    }

    function box_shortcode( $attr, $content = null ) {
        return '<div class="box">' . $content . '</div>';
    }

}
?>
