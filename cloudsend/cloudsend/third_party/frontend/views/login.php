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

<div id="login">
    <div class="header">
	<h3><?php echo __('front_head_welcome') ?>, <small><?php echo $user->companyName ?></small></h3>
    </div>

    <div class="box">
	<form name="loginForm" action="<?php echo site_url( $user->userURL.'/verify') ?>" method="post" class="form-horizontal">
	    <input type="hidden" name="userID" value="<?php echo $user->userUniqueID ?>" />
	    <div class="control-group">
		<label class="control-label" for="inputPassword"><?php echo __('front_lbl_password') ?></label>
		<div class="controls">
		    <input type="password" id="inputPassword" name="inputPassword" />
		</div>
	    </div>
	    <div class="control-group">
		<div class="controls">
		    <button type="submit" class="btn"><i class="icon-user"></i> <?php echo __('front_btn_login') ?></button>
		</div>
	    </div>
	</form>	
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {    
    <?php if( !empty( $user->userFile ) && file_exists( FCPATH.'data'.DS.'backgrounds'.DS.$user->userFile ) ): ?> 
    $.supersized({  
	slides  :  [ { image : '<?php echo site_url( 'stream/'.$user->userFile ) ?>' } ]
    });
    <?php elseif( file_exists( FCPATH.'data'.DS.'backgrounds'.DS.'default_1.4.jpg' ) ) : ?>
    $.supersized({  
	slides  :  [ { image : '<?php echo site_url( 'stream/default_1.4.jpg' ) ?>' } ]
    });
    <?php endif; ?>
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