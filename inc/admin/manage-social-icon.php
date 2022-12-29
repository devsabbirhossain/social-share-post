<?php 

if ( ! defined( 'ABSPATH' ) )
{
    exit; // Exit if accessed directly
}

class ManageSocialIcon {

	public function __construct() {
		add_action( 'admin_menu', array(&$this, 'register_main_menu') );
		add_action( 'admin_menu', array(&$this, 'register_submain_menu') );
		add_action( 'admin_menu', array(&$this, 'remove_submain_menu') );
	}

	/**
	 * Register Main menu
	 * @return void
	 */
	public function register_main_menu() {
		add_menu_page(
	       	__( 'Social Share Post', 'ssp' ),
	       	'Social Share Post',
	       	'manage_options',
	       	'social_share_post_mainmenu',
	        array(&$this,'call_back_functions_display'),
	       	'dashicons-share',
	       //plugins_url( 'myplugin/images/icon.png' ),
	       5
	   	);
	}
	public function call_back_functions_display(){

	}

	public function remove_submain_menu() {
		remove_submenu_page( 'social_share_post_mainmenu', 'social_share_post_mainmenu' );
	}

	/**
	 * Register Submenu
	 * @return void
	 */
	public function register_submain_menu() {
		add_submenu_page( 
			'social_share_post_mainmenu', 
			'Manage Social Icon', 
			'Manage Social Icon', 
			'manage_options', 
			'manage-social-icon-submenu', 
			array(&$this, 'manage_social_icons')
		);
		add_submenu_page( 
			'social_share_post_mainmenu', 
			'Settings', 
			'Settings', 
			'manage_options', 
			'manage-social-icon-settings', 
			array(&$this, 'manage_settings_social_icons')
		);
	}

	/**
	 * Render submenu
	 * @return void
	 */
	public function manage_social_icons() {
            if(isset($_POST['submit'])){
            	$facebook = isset($_POST['facebook'])? $_POST['facebook'] : '';
            	$twitter = isset($_POST['twitter'])? $_POST['twitter'] : '';
            	$linkdin = isset($_POST['linkdin'])? $_POST['linkdin'] : '';
            	$digg = isset($_POST['digg'])? $_POST['digg'] : '';

                update_option( 'facebook-ssp', $facebook );
                update_option( 'twitter-ssp', $twitter );
                update_option( 'linkdin-ssp', $linkdin );
                update_option( 'digg-ssp', $digg );
            } 

        ?>
            <div class="wrap">
                <div id="icon-tools" class="icon32"></div>
                <h1>Select Sharing Services</h1>
            </div>

            <div>
                <form action="" method="POST">
                    <div class="form-group">
                    	<label class="switch" for="facebook">
						  <input type="checkbox" name="facebook" id="facebook" <?php if(get_option('facebook-ssp')){ echo 'checked'; } ?>>
						  <span class="slider round"></span>
						</label><span>Facebook</span>
                    </div><br>
                    <div class="form-group">
                    	<label class="switch" for="twitter">
						  <input type="checkbox" name="twitter" id="twitter" <?php if(get_option('twitter-ssp')){ echo 'checked'; } ?>>
						  <span class="slider round"></span>
						</label><span>Twitter</span>
                    </div><br>
                    <div class="form-group">
                    	<label class="switch" for="linkdin">
						  <input type="checkbox" name="linkdin" id="linkdin" <?php if(get_option('linkdin-ssp')){ echo 'checked'; } ?>>
						  <span class="slider round"></span>
						</label><span>Linkdin</span>
                    </div>
                    <br>
                    <div class="form-group">
                    	<label class="switch" for="digg">
						  <input type="checkbox" name="digg" id="digg" <?php if(get_option('digg-ssp')){ echo 'checked'; } ?>>
						  <span class="slider round"></span>
						</label><span>Digg</span>
                    </div><br>

                    <input type="submit" name="submit" value="Save" class="btn btn-primary my-1">
                </form>
            </div>
        <?php
	}

	public function manage_settings_social_icons(){
		if(isset($_POST['saveSettings'])){
        	$afterContent = isset($_POST['afterContent'])? $_POST['afterContent'] : '';
        	$beforeContent = isset($_POST['beforeContent'])? $_POST['beforeContent'] : '';

            update_option( 'afterContent-ssp', $afterContent );
            update_option( 'beforeContent-ssp', $beforeContent );
        }

        ?>
            <div class="wrap">
                <div id="icon-tools" class="icon32"></div>
                <h1>Select Sharing Services</h1>
            </div>

            <div>
                <form action="" method="POST">
                	<div class="form-group">
                    	<label class="switch" for="afterContent">
						  <input type="checkbox" name="afterContent" id="afterContent" <?php if(get_option('afterContent-ssp')){ echo 'checked'; } ?>>
						  <span class="slider round"></span>
						</label><span>After The Content</span>
                    </div><br>

                    <div class="form-group">
                    	<label class="switch" for="beforeContent">
						  <input type="checkbox" name="beforeContent" id="beforeContent" <?php if(get_option('beforeContent-ssp')){ echo 'checked'; } ?>>
						  <span class="slider round"></span>
						</label><span>Before The Content</span>
                    </div><br>
                    
                    <input type="submit" name="saveSettings" value="Save" class="btn btn-primary my-1">
                </form>
            </div>
        <?php
	}
}

new ManageSocialIcon();