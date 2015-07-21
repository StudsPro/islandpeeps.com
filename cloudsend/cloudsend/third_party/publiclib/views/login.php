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

<div class="container" id="login">
    <div class="row">
	<div class="page-header span7 offset2">
	    <h3><?php echo __('public_title_login') ?></h3>
	</div>

	<div class="span7 offset2">
	    <form name="loginForm" action="<?php echo site_url('public/verify') ?>" method="post" class="form-horizontal">
		<input type="hidden" name="linkid" value="<?php echo $this->uri->segment(3) ?>" />
		<div class="control-group">
		    <label class="control-label" for="inputPassword"><?php echo __('public_lbl_password') ?></label>
		    <div class="controls">
			<input type="password" id="inputPassword" name="inputPassword" />
		    </div>
		</div>
		<div class="control-group">
		    <div class="controls">
			<button type="submit" class="btn"><i class="icon-user"></i> <?php echo __('public_btn_login') ?></button>
		    </div>
		</div>
	    </form>	
	</div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    
    $('button.btn').click(function(e) {
	e.preventDefault();
	$('form div.alert').remove();
	$.post( $('form[name=loginForm]').attr('action'), $('form[name=loginForm]').serialize(), function( e ) {
	   if( e.type == 'error' ) {
	       $('form').prepend('<div class="alert alert-error">'+e.message+'</div>');
	   } else {
	       location.reload();
	       window.location.reload(true);
	   }
	},'json');
    });
    
});  
</script>