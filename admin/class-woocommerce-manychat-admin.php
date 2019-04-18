<?php

/**
* The admin-specific functionality of the plugin.
*
* @link       http://fsylum.net
* @since      1.0.0
*
* @package    woocommerce_manychat
* @subpackage woocommerce_manychat/admin
*/

/**
* The admin-specific functionality of the plugin.
*
* Defines the plugin name, version, and two examples hooks for how to
* enqueue the admin-specific stylesheet and JavaScript.
*
* @package    woocommerce_manychat
* @subpackage woocommerce_manychat/admin
* @author     Firdaus Zahari <firdaus@fsylum.net>
*/
class woocommerce_manychat_Admin {

    /**
    * The ID of this plugin.
    *
    * @since    1.0.0
    * @access   private
    * @var      string    $plugin_name    The ID of this plugin.
    */
    private $plugin_name;

    /**
    * The options name to be used in this plugin
    *
    * @since  	1.0.0
    * @access 	private
    * @var  	string 		$option_name 	Option name of this plugin
    */
    private $option_name = 'woocommerce_manychat';

    /**
    * The version of this plugin.
    *
    * @since    1.0.0
    * @access   private
    * @var      string    $version    The current version of this plugin.
    */
    private $version;

    /**
    * Initialize the class and set its properties.
    *
    * @since    1.0.0
    * @param      string    $plugin_name       The name of this plugin.
    * @param      string    $version    The version of this plugin.
    */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
    * Register the stylesheets for the admin area.
    *
    * @since    1.0.0
    */
    public function enqueue_styles() {

        /**
        * This function is provided for demonstration purposes only.
        *
        * An instance of this class should be passed to the run() function
        * defined in woocommerce_manychat_Loader as all of the hooks are defined
        * in that particular class.
        *
        * The woocommerce_manychat_Loader will then create the relationship
        * between the defined hooks and the functions defined in this
        * class.
        */

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woocommerce-manychat-admin.css', array(), $this->version, 'all' );

    }

    /**
    * Register the JavaScript for the admin area.
    *
    * @since    1.0.0
    */
    public function enqueue_scripts() {

        /**
        * This function is provided for demonstration purposes only.
        *
        * An instance of this class should be passed to the run() function
        * defined in woocommerce_manychat_Loader as all of the hooks are defined
        * in that particular class.
        *
        * The woocommerce_manychat_Loader will then create the relationship
        * between the defined hooks and the functions defined in this
        * class.
        */

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woocommerce-manychat-admin.js', array( 'jquery' ), $this->version, false );

    }

    /**
    * Add an options page under the Settings submenu
    *
    * @since  1.0.0
    */
    public function add_options_page() {

        $this->plugin_screen_hook_suffix = add_options_page(
            __( 'Woocommerce-Manychat Settings', 'woocommerce-manychat' ),
            __( 'Woocommerce-Manychat', 'woocommerce-manychat' ),
            'manage_options',
            $this->plugin_name,
            array( $this, 'display_options_page' )
        );

    }

    /**
    * Render the options page for plugin
    *
    * @since  1.0.0
    */
    public function display_options_page() {
        include_once 'partials/woocommerce-manychat-admin-display.php';
    }

    /**
    * Register all related settings of this plugin
    *
    * @since  1.0.0
    */
    public function register_setting() {

        add_settings_section(
            $this->option_name . '_general',
            __( 'General', 'woocommerce-manychat' ),
            array( $this, $this->option_name . '_general_cb' ),
            $this->plugin_name
        );

        add_settings_field(
            $this->option_name . '_integration',
            __( 'Manychat JS', 'woocommerce-manychat' ),
            array( $this, $this->option_name . '_integration_ta' ),
            $this->plugin_name,
            $this->option_name . '_general',
            array( 'label_for' => $this->option_name . '_integration' )
        );

        add_settings_field(
            $this->option_name . '_api_key',
            __( 'API key', 'woocommerce-manychat' ),
            array( $this, $this->option_name . '_api_key_txt' ),
            $this->plugin_name,
            $this->option_name . '_general',
            array( 'label_for' => $this->option_name . '_api_key' )
        );

        add_settings_field(
            $this->option_name . '_mc_id_variable',
            __( 'Manychat ID var', 'woocommerce-manychat' ),
            array( $this, $this->option_name . '_mc_id_variable_txt' ),
            $this->plugin_name,
            $this->option_name . '_general',
            array( 'label_for' => $this->option_name . '_mc_id_variable' )
        );




        register_setting( $this->plugin_name, $this->option_name . '_integration');
        register_setting( $this->plugin_name, $this->option_name . '_api_key');
        register_setting( $this->plugin_name, $this->option_name . '_mc_id_variable');

    }

    /**
    * Render the text for the general section
    *
    * @since  1.0.0
    */
    public function woocommerce_manychat_general_cb() {
        echo '<p>' . __( 'Please change the settings accordingly.<br><br>
            Hi beautiful
                ', 'woocommerce-manychat' ) . '</p>';
    }



    /**
    * Render the treshold day input for this plugin
    *
    * @since  1.0.0
    */
    public function woocommerce_manychat_integration_ta() {
        $embed = get_option( $this->option_name . '_integration' );
        echo '<textarea rows="4" cols="60" name="' . $this->option_name . '_integration' . '" id="' . $this->option_name . '_integration' . '">' . $embed . '</textarea>
            <p>Put here the integration code of Manychat (if you didn\'t embed it somewhere else)</p> ' . __( '', 'woocommerce-manychat' );
    }
    public function woocommerce_manychat_api_key_txt() {
        $form_prefix = get_option( $this->option_name . '_api_key' );
        echo '<input size="60" type="text" name="' . $this->option_name . '_api_key' . '" id="' . $this->option_name . '_api_key' . '" value="' . $form_prefix . '">
            <p>The API key of Manychat</p> ' . __( '', 'woocommerce-manychat' );
    }
    public function woocommerce_manychat_mc_id_variable_txt() {
        $mc_id_var = get_option( $this->option_name . '_mc_id_variable' );
        echo '<input size="60" type="text" name="' . $this->option_name . '_mc_id_variable' . '" id="' . $this->option_name . '_mc_id_variable' . '" value="' . $mc_id_var . '">
            <p>The GET variable that may contain the Manychat Subsciber ID</p> ' . __( '', 'woocommerce-manychat' );
    }


    /**
    * Sanitize the text position value before being saved to database
    *
    * @param  string $position $_POST value
    * @since  1.0.0
    * @return string           Sanitized value
    */
    public function woocommerce_manychat_sanitize_position( $position ) {
        if ( in_array( $position, array( 'before', 'after' ), true ) ) {
            return $position;
        }
    }

}
