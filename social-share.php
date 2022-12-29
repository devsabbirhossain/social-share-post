<?php

/*
* Plugin Name: Social Share Post
* Plugin URI: https://brothersdeveloper.com
* Description: This Plugin is basically for share your post and blogs to social site like facebook, linkdin, twitter etc.
* Author: Sabbir Hossain
* Author URI: https://github.com/devsabbirhossain
* Version: 1.0.0
* Text Domain: ssp
*/

if ( ! defined( 'ABSPATH' ) )
{
    exit; // Exit if accessed directly
}


define('PLUGIN_URL', plugin_dir_path( __FILE__ ));
define('PLUGIN_URL_INCLUDE', PLUGIN_URL.'/inc');
define('PLUGIN_URL_ASSETS', PLUGIN_URL.'/assets');
/**
 * add file and functinos for this plugin
 */
class SocialShare
{
	
	function __construct()
	{
		add_action( 'wp_enqueue_scripts',array( $this, 'add_scripts_frontend' ) );
		add_action( 'admin_enqueue_scripts', array( $this,'add_scripts_admin_page' ) );
		$this->add_other_files();
	}

	public function add_other_files(){
		if(file_exists(PLUGIN_URL_INCLUDE. '/social-share-function.php')){
        	require_once(PLUGIN_URL_INCLUDE. '/social-share-function.php');
    	}
    	
	}

	public function add_scripts_frontend(){
		wp_enqueue_style( 'font-styles-all', plugins_url( '/assets/css/fontawesome/css/all.min.css', __FILE__ ));
		wp_enqueue_style( 'font-styles-brands', plugins_url( '/assets/css/fontawesome/css/brands.min.css', __FILE__ ) );
		wp_enqueue_style( 'custom-style-plugin', plugins_url( '/assets/css/style.css', __FILE__ ));
	}

	public function add_scripts_admin_page(){
		wp_enqueue_style( 'bootstrap-plugin', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
		wp_enqueue_style( 'font-styles-all', plugins_url( '/assets/css/fontawesome/css/all.min.css', __FILE__ ));
		wp_enqueue_style( 'font-styles-brands', plugins_url( '/assets/css/fontawesome/css/brands.min.css', __FILE__ ) );
		wp_enqueue_style( 'custom-style-plugin', plugins_url( '/assets/css/style.css', __FILE__ ));
	}
}

new SocialShare();
new SocialShareFunctions();
new ShowSocialShare();



