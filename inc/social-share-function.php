<?php 

if ( ! defined( 'ABSPATH' ) )
{
    exit; // Exit if accessed directly
}

/**
 * Show Icon in frontend
 */
class SocialShareFunctions
{
	
	function __construct()
	{
		$this->add_files();
	}

	public function add_files(){
    	if(file_exists(PLUGIN_URL_INCLUDE. '/admin/manage-social-icon.php')){
        	require_once(PLUGIN_URL_INCLUDE. '/admin/manage-social-icon.php');
    	}
    	if(file_exists(PLUGIN_URL_INCLUDE. '/frontend/show-social-icon.php')){
        	require_once(PLUGIN_URL_INCLUDE. '/frontend/show-social-icon.php');
    	}
	}
}





    