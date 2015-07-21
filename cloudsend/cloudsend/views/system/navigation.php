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
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
	 <div class="container">  
	     
	 <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
	 <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	 <span class="icon-bar"></span>
	 <span class="icon-bar"></span>
	 <span class="icon-bar"></span>
	 </a>	
	 
          <a class="brand" href="<?php echo site_url( 'admin/dashboard/index' ) ?>"><?php echo stripslashes( mGlobal::getConfig('PRODUCT_NAME')->configVal ) ?></a>
	  <?php if( $this->session->userdata('is_logged_in') == true ): ?>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="<?php echo uri_is( 'admin/dashboard/index' ) ?>"><a href="<?php echo site_url( 'admin/dashboard/index' ) ?>"><?php echo __('sys_navi_dashboard') ?></a></li>
              <?php if( mGlobal::getConfig('SHOW_CATFOLDER')->configVal == 'category' ): ?>
              <li class="<?php echo uri_is( 'admin/files/index' ) ?>"><a href="<?php echo site_url( 'admin/files/index' ) ?>"><?php echo __('sys_navi_files') ?></a></li>
              <?php elseif( mGlobal::getConfig('SHOW_CATFOLDER')->configVal == 'folder' ): ?>
              <li class="<?php echo uri_is( 'admin/folder/index' ) ?>"><a href="<?php echo site_url( 'admin/folder/index' ) ?>"><?php echo __('sys_navi_files') ?></a></li>
          	  <?php else: ?>
              <li class="dropdown">
			  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			      <?php echo __('sys_navi_files') ?>
			      <b class="caret"></b>
			  </a>
			  <ul class="dropdown-menu">
			      <li><a href="<?php echo site_url( 'admin/files/index' ) ?>"><?php echo __('sys_navi_files_cat') ?></a></li>
			      <li class="divider"></li>
			      <li><a href="<?php echo site_url( 'admin/folder/index' ) ?>"><?php echo __('sys_navi_files_folder') ?></a></li>
			  </ul>
		      </li>
		  	  <?php endif; ?>
              <li class="dropdown">
		  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
		      <?php echo __('sys_navi_upload') ?>
		      <b class="caret"></b>
		  </a>
		  <ul class="dropdown-menu">
		      <li><a href="<?php echo site_url( 'admin/uploads/index' ) ?>"><?php echo __('sys_navi_newupload') ?></a></li>
		      <li class="divider"></li>
		      <li><a href="<?php echo site_url( 'admin/uploads/latest' ) ?>"><?php echo __('sys_navi_lastupload') ?></a></li>
		      <li class="divider"></li>
		      <li><a href="<?php echo site_url( 'admin/import' ) ?>"><?php echo __('sys_navi_import') ?></a></li>
		  </ul>
	      </li>
              <li class="<?php echo uri_is( 'admin/publinks/all_entries' ) ?>"><a href="<?php echo site_url( 'admin/publinks/index' ) ?>"><?php echo __('sys_navi_public') ?></a></li>
              <li class="<?php echo uri_is( 'admin/pubuploads/all_entries' ) ?>"><a href="<?php echo site_url( 'admin/pubuploads/index' ) ?>"><?php echo __('sys_navi_pubupload') ?></a></li>
	      <?php if( $this->session->userdata['level'] == '1' ): ?>
              <li class="<?php echo uri_is( 'admin/user/all_entries' ) ?>"><a href="<?php echo site_url( 'admin/user/index' ) ?>"><?php echo __('sys_navi_user') ?></a></li>
	      <li>
		<form action="<?php echo site_url( 'admin/search/' ) ?>" class="navbar-form pull-left" method="post">
		    <input type="hidden" name="redirect" value="<?php echo current_url() ?>" />
		    <input type="hidden" name="limit" value="8" />
		    <input type="text" name="query" id="query" value="<?php echo set_value('query') ?>" placeholder="Search..." class="span2 typeahead" autocomplete="off">
		    <button type="submit" class="btn">Search</button>
		</form>		  
	      </li>
	      <?php endif; ?>
	    </ul>
	    <ul class="nav pull-right">
		<li class="dropdown">
		    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<i class="icon-cog icon-white icon-large"></i>
			<b class="caret"></b>
		    </a>
		    <ul class="dropdown-menu">
			<?php if( $this->session->userdata['level'] == '1' ): ?>
			<li><a href="<?php echo site_url( 'admin/settings/index' ) ?>"><?php echo __('sys_navi_settings') ?></a></li>
			<li class="divider"></li>
			<li><a href="<?php echo site_url( 'admin/log' ) ?>"><?php echo __('sys_navi_log') ?></a></li>
			<li class="divider"></li>
			<?php endif; ?>
			<li><a href="<?php echo site_url( 'admin/user/edit_user' ) ?>"><?php echo __('sys_navi_myaccount') ?></a></li>
			<li class="divider"></li>
			<li><a href="<?php echo site_url( 'admin/account/logout' ) ?>"><?php echo __('sys_navi_logout') ?></a></li>
		    </ul>
		</li>		
	    </ul>   
          </div>
	  <?php endif; ?>
        </div>
      </div>
    </div>
<script>
$(document).ready(function() {
   $('.typeahead').typeahead({
        source: function( query, process ) {
	    $.post( '<?php echo site_url( 'admin/search/typeahead/' ) ?>', { query: query }, function( data ) {      
		process( data );
	    },'json');
        },
	matcher: function() {
	    return true;
	}
    }); 
});  
</script>