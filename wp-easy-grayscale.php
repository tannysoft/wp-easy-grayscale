<?php
/**
* Plugin Name:		 WordPress Easy Grayscale
* Plugin URI:		 http://www.tannysoft.com/content/wordpress-easy-grayscale
* Description:		 ปลั้กอินสำหรับเปลี่ยนสีเว็บไซต์ที่ใช้ WordPress เป็นสีขาวดำ สอบถามเพิ่มเติมได้ที่ http://www.tannysoft.com
* Version:			 1.0.1
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
		wp_enqueue_style( 'wp-easy-grayscale', plugin_dir_url( __FILE__ ) . 'css/wp-easy-grayscale.css' , array() );
	}
}