<?php 

if ( ! defined( 'ABSPATH' ) )
{
    exit; // Exit if accessed directly
}

/**
 * Show Icon in frontend
 */
class ShowSocialShare
{
	
	function __construct()
	{
		add_filter( 'the_content', array( $this, 'add_content_after' ) );
	}

	function add_content_after($content) {
		$permalink = get_permalink();
		if(get_option('afterContent-ssp')){
			$fullcontent = $content . $this->ssp_theme_share_buttons($permalink);
		}
		
		if(get_option('beforeContent-ssp')){
			$fullcontent = $this->ssp_theme_share_buttons($permalink) . $content;
		}else{
			$fullcontent = $content . $this->ssp_theme_share_buttons($permalink);
		}
	   	return $fullcontent;
	}

	public function ssp_theme_share_buttons($permalink) {
    	ob_start();
        ?>
        <div class="social-share-post">
	        <div class="share-title">
	        	<p><i class="fa-solid fa-share-from-square"></i> Share this</p>
	        </div>
	        <div class="share-button">
	        	<?php if(get_option('facebook-ssp')): ?>
		        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($permalink); ?>"
		            onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="btn"
		            target="_blank" title="<?php esc_attr_e('Share on Facebook', 'ssp'); ?>">
		            <i class="fa-brands fa-facebook"></i>
		        </a>
		    	<?php endif; ?>

		    	<?php if(get_option('twitter-ssp')): ?>
		        <a href="https://twitter.com/share?url=<?php echo esc_url($permalink); ?>"
		            onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="btn"
		            target="_blank" title="<?php esc_attr_e('Share on Twitter', 'ssp'); ?>">
		            <i class="fa-brands fa-twitter"></i>
		        </a>
		        <?php endif; ?>

		        <?php if(get_option('linkdin-ssp')): ?>
		        <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($permalink); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn"
		            title="<?php esc_attr_e('Share on LinkedIn', 'ssp'); ?>">
		            <i class="fa-brands fa-linkedin"></i>
		        </a>
		        <?php endif; ?>

		        <?php if(get_option('digg-ssp')): ?>
		        <a href="http://www.digg.com/submit?url=<?php echo esc_url($permalink); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn"
		            title="<?php esc_attr_e('Share on Digg', 'ssp'); ?>">
		            <i class="fa-brands fa-digg"></i>
		        </a>
		        <?php endif; ?>
		        <?php if(get_option('pinterest-ssp')): ?>
		        <a href="http://pinterest.com/pin/create/bookmarklet/?url=<?php echo esc_url($permalink);?>&amp;is_video=false&amp;description=<?php esc_url(the_title());?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn" title="<?php esc_attr_e('Share on Pinterest', 'ssp'); ?>">
		        	<i class="fa-brands fa-pinterest"></i>
		        </a>
		        <?php endif; ?>
	        </div>
        </div>
   		<?php 
   		return ob_get_clean();
	}
}
