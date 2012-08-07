<?php
class myTinyMceButton_Admin{

    function __construct() {
        // init process for button control
        add_action( 'admin_init', array (&$this, 'addButtons' ) );
        add_action( 'wp_ajax_mybutton_shortcodePrinter', array( &$this, 'wp_ajax_fct' ) );
    }
    
    /*
    * The content of the javascript popin for the insertion
    *
    */
    

    function wp_ajax_fct(){
        ?>
        <h2><?php _e("L'Oréal custom contour", 'mytmceb');?></h2>
        <p>
            <?php _e("Please enter the text that should fit in a box: ", 'mytmceb');?><br />
            <textarea name="mytmceb_text" id="mytmceb_text" value="<?php _e('make some magic','mytmceb');?>"></textarea>
        </p>
        <script>
            jQuery.fn.tinymce_textareas = function(){
                tinyMCE.execCommand("mceAddControl", false, 'mytmceb_text');
            };
            function sample(){
                tinyMCE.execCommand('mceRemoveControl', false, 'mytmceb_text');
                jQuery("#mytmceb_text").tinymce_textareas();
            }
            setTimeout(sample,1000);
        </script>    
        <p class="description">
            <?php esc_html_e("The text you enter will be diplayed with border", 'mytmceb');?>
        </p>
        <input name="mytmceb_button" id="mytmceb_button" type="submit" class="button-primary" value="<?php _e("Insert the box", 'mytmceb');?>">

        <?php die();
    }

   
    /*
    * Add buttons to the tiymce bar
    */
    function addButtons() {
        // Don't bother doing this stuff if the current user lacks permissions
        if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
            return false;
    
        if ( get_user_option('rich_editing') == 'true') {
            add_filter('mce_external_plugins', array (&$this,'addScriptTinymce' ) );
            add_filter('mce_buttons', array (&$this,'registerTheButton' ) );
        }
    }

    /*
    * Add buttons to the tiymce bar
    *
    */
    function registerTheButton($buttons) {
        array_push($buttons, "|", "mybutton");
        return $buttons;
    }

    /*
    * Load the custom js for the tinymce button
    *

    */
    function addScriptTinymce($plugin_array) {
        $plugin_array['mybutton'] = MTMCE_URL. 'inc/ressources/tinymce.js';
        return $plugin_array;
    }

}
?>