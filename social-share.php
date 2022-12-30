<?php

/*
* @wordpress-plugin
* Plugin Name: 	Social Share Post
* Plugin URI: 	https://github.com/devsabbirhossain/social-share-post
* Description: 	This Plugin is basically for share your post and blogs to social site like facebook, linkdin, twitter etc.
* Author: 		Md Sabbir Hossain Shawon <sabbir2dev@gmail.com>
* Author URI: 	https://github.com/devsabbirhossain
* Version: 		1.0.0
* Text Domain: 	ssp
* License:		GPL-2.0+
* License URI:  http://www.gnu.org/licenses/gpl-2.0.txt
*/

if ( ! defined( 'ABSPATH' ) )
{
    exit; // Exit if accessed directly
}

define('PLUGIN_URL', plugin_dir_path( __FILE__ ));
define('PLUGIN_URL_INCLUDE', PLUGIN_URL.'/inc');
define('PLUGIN_URL_ASSETS', PLUGIN_URL.'/assets');

function ssp_load_plugin(){
    $plugin_dir = basename(dirname(__FILE__))."/languages/";
    load_plugin_textdomain( 'ssp', false, $plugin_dir );
}
add_action( 'plugins_loaded', 'ssp_load_plugin' );

/**
 * add file and functinos for this plugin
 */
class SocialShare
{
	
	function __construct()
	{
		register_activation_hook( __FILE__, array( $this, 'activation_hook' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivation_hook' ) );
		add_action( 'wp_enqueue_scripts',array( $this, 'add_scripts_frontend' ) );
		add_action( 'admin_enqueue_scripts', array( $this,'add_scripts_admin_page' ) );
		$this->add_other_files();
	}

	//this function will work when this plugin will activate
	public function activation_hook(){
		update_option( 'facebook-ssp', true );
        update_option( 'linkdin-ssp', true );
        update_option( 'beforeContent-ssp', true );
	}

	//this function will work when this plugin will deactivate
	public function deactivation_hook(){
		delete_option( 'facebook-ssp' );
        delete_option( 'twitter-ssp' );
        delete_option( 'linkdin-ssp' );
        delete_option( 'digg-ssp' );
        delete_option( 'pinterest-ssp' );
        delete_option( 'afterContent-ssp' );
        delete_option( 'beforeContent-ssp' );
	}

	public function add_other_files(){
		if(file_exists(PLUGIN_URL_INCLUDE. '/social-share-function.php')){
        	require_once(PLUGIN_URL_INCLUDE. '/social-share-function.php');
    	}
    	
	}

	public function add_scripts_frontend(){
		wp_enqueue_style( 'font-styles-all', plugins_url( '/assets/admin/css/fontawesome/css/all.min.css', __FILE__ ));
		wp_enqueue_style( 'font-styles-brands', plugins_url( '/assets/admin/css/fontawesome/css/brands.min.css', __FILE__ ) );
		wp_enqueue_style( 'custom-style-plugin', plugins_url( '/assets/frontend/css/style.css', __FILE__ ));
	}

	public function add_scripts_admin_page(){
		wp_enqueue_style( 'bootstrap-plugin', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
		wp_enqueue_style( 'font-styles-all', plugins_url( '/assets/admin/css/fontawesome/css/all.min.css', __FILE__ ));
		wp_enqueue_style( 'font-styles-brands', plugins_url( '/assets/admin/css/fontawesome/css/brands.min.css', __FILE__ ) );
		wp_enqueue_style( 'custom-style-plugin', plugins_url( '/assets/admin/css/style.css', __FILE__ ));
	}
}

new SocialShare();
new SocialShareFunctions();
new ShowSocialShare();



