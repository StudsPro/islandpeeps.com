<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * CloudSend
 *
 * @package    CloudSend
 * @author     codingking.co
 * @copyright  Copyright (c) 2013 codingking.co - all rights reserved
 * @license    Commercial
 * @link       http://www.codingking.co/
 * 
 * 
 * This source file is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
 * or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.
 */
 ?>

<?php if( isset( $this->session->userdata['frontlogin'] ) && $this->session->userdata['frontlogin'] == true && isset( $this->session->userdata['frontuser'] ) ): ?>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">	  
	 <div class="container">
	    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    </a>		  
	     
	    <a href="javascript:void(0);" class="brand"><?php echo stripslashes( mGlobal::getConfig('PRODUCT_NAME')->configVal ) ?></a>
	    <div class="nav-collapse collapse">
		<ul class="nav">
		<?php if( $user->userCanUpload == '1' ): ?>
		<li class="<?php echo uri_is( $user->userURL ) ?>"><a href="<?php echo site_url( $user->userURL ) ?>"><?php echo __('front_navi_dashboard') ?></a></li>
		<?php endif; ?>
		<li class="dropdown">
		    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<?php echo __('front_navi_downloads') ?>
			<b class="caret"></b>
		    </a>
		    <ul class="dropdown-menu">
			<li><a href="<?php echo site_url( $user->userURL.'/publicfiles' ) ?>"><?php echo __('front_navi_public') ?></a></li>
			<li class="divider"></li>
			<li><a href="<?php echo site_url( $user->userURL.'/userfiles' ) ?>"><?php echo __('front_navi_user') ?></a></li>
		    </ul>
		</li>
		<?php if( $user->userCanUpload == '1' ): ?>
		<li class="<?php echo uri_is( $user->userURL.'/uploads' ) ?>"><a href="<?php echo site_url( $user->userURL.'/uploads' ) ?>"><?php echo __('front_navi_uploads') ?></a></li>
		<?php endif; ?>
		</ul>
		<ul class="nav pull-right">
		    <li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			    <i class="icon-cog icon-white icon-large"></i>
			    <b class="caret"></b>
			</a>
			<ul class="dropdown-menu">
			    <li><a href="<?php echo site_url( $user->userURL.'/settings' ) ?>"><?php echo __('front_navi_settings') ?></a></li>
			    <li class="divider"></li>
			    <li><a href="<?php echo site_url( $user->userURL.'/logout' ) ?>"><?php echo __('front_navi_logout') ?></a></li>
			</ul>
		    </li>		
		</ul>
	    </div>
         </div>
      </div>
    </div>
<?php endif; ?>