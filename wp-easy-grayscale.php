<?php
/**
* Plugin Name:		 WordPress Easy Grayscale
* Plugin URI:		 http://www.tannysoft.com/content/wordpress-easy-grayscale
* Description:		 ปลั้กอินสำหรับเปลี่ยนสีเว็บไซต์ที่ใช้ WordPress เป็นสีขาวดำ สอบถามเพิ่มเติมได้ที่ http://www.tannysoft.com
* Version:			 1.1.0
* Author:			 Tannysoft
* Author 			 URI: http://www.tannysoft.com
* License:           GPL-2.0+
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain:       wp-easy-grayscale
* Domain Path:       /languages
*/

add_action( 'wp_enqueue_scripts', 'wp_easy_grayscale_styles' );

function wp_easy_grayscale_styles() {
	if(!is_admin()) {
		$option = get_option( 'wp_easy_grayscale_option' );

		if(($option) and ($option!==null) and !empty($option)):
			$percent = $option['percent_number'];
			$percent_divide = $percent / 100;
		else:
			$percent = 90;
			$percent_divide = 9;
		endif;

		wp_enqueue_style(
			'wp-easy-grayscale',
			plugin_dir_url( __FILE__ ) . 'css/wp-easy-grayscale.css'
		);
        $custom_css = "
        	html {
				/* IE */
				filter: progid:DXImageTransform.Microsoft.BasicImage(grayscale=$percent_divide);
				/* Chrome, Safari */
				-webkit-filter: grayscale($percent_divide);
				/* Firefox */
				filter: grayscale($percent_divide);
				filter: grayscale($percent%);
				filter: gray; 
				-moz-filter: grayscale($percent%);
				-webkit-filter: grayscale($percent%);
			}";
    	wp_add_inline_style( 'wp-easy-grayscale', $custom_css );
	}
}

class WP_Easy_Grayscale_Page
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'WP Easy Grayscale', 
            'manage_options', 
            'wp-easy-grayscale', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'wp_easy_grayscale_option' );
        ?>
        <div class="wrap">
            <h1>WordPress Easy Grayscale</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'my_option_group' );
                do_settings_sections( 'wp-easy-grayscale' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'my_option_group', // Option group
            'wp_easy_grayscale_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            '', // Title
            array( $this, 'print_section_info' ), // Callback
            'wp-easy-grayscale' // Page
        );  

        add_settings_field(
            'percent_number', // ID
            'ค่าสีขาวดำ (1-100%)', // Title 
            array( $this, 'percent_number_callback' ), // Callback
            'wp-easy-grayscale', // Page
            'setting_section_id' // Section           
        );      

    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['percent_number'] ) )
            $new_input['percent_number'] = absint( $input['percent_number'] );

        return $new_input;
    }

    public function print_section_info()
    {
        print 'ปรับค่าสีขาวดำของเว็บไซต์:';
    }

    public function percent_number_callback()
    {
        printf(
            '<input type="text" id="percent_number" name="wp_easy_grayscale_option[percent_number]" value="%s" />',
            isset( $this->options['percent_number'] ) ? esc_attr( $this->options['percent_number']) : '90'
        );
    }

}

if( is_admin() )
    $my_settings_page = new WP_Easy_Grayscale_Page();