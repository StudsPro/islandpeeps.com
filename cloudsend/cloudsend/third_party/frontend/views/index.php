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

if( mGlobal::getConfig('SHOW_CENTRAL_LOGIN')->configVal == 'no'): ?>
<div id="errornotfound">
    <div class="row" id="notfound">
	<div class="span12">
	    <div class="hero-unit">
		<h1><?php echo __('front_head_welcome') ?></h1>
		<p><?php echo __('front_desc_welcome') ?></p>
	    </div>
	</div>	
    </div>    
</div>
<?php else: ?>
<div class="container" id="centerbox">
    <div class="row">
	<div class="span7">
	    <div class="page-header">
		<h1><?php echo __('front_head_welcome') ?></h1>
		<p><?php echo __('front_desc_login') ?></p>
	    </div>
	    <div class="clearfix"></div>
	    <?php if( $errortype != false ): ?>
	    <div class="alert alert-<?php echo $errortype ?>">
		<?php echo $errormsg ?>
	    </div>
	    <?php endif; ?>
	    <form name="centerlogin" action="<?php echo site_url( 'verify' ) ?>" class="form-horizontal" autocomplete="off" method="post">
		<div class="control-group">
		    <label class="control-label" for="inputEmail"><?php echo __('front_lbl_email') ?></label>
		    <div class="controls">
			<input type="text" name="inputEmail" id="inputEmail" placeholder="<?php echo __('front_lbl_email') ?>" value="<?php echo set_value('inputEmail') ?>">
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="inputPassword"><?php echo __('front_lbl_password') ?></label>
		    <div class="controls">
			<input type="password" name="inputPassword" id="inputPassword" placeholder="<?php echo __('front_lbl_password') ?>" value="">
		    </div>
		</div>
		<div class="control-group">
		    <div class="controls">
			<button type="submit" class="btn"><?php echo __('front_btn_login') ?></button>
		    </div>
		</div>
	    </form>	    
	</div>
    </div>
</div>
<?php endif; ?>
<script type="text/javascript">
$(document).ready(function() { 
    <?php if( mGlobal::getConfig('SHOW_INDEX')->configVal == 'no' ): ?>
    window.location.href="<?php echo site_url('admin/account/login') ?>";
    location.href="<?php echo site_url('admin/account/login') ?>";
    <?php endif; ?>
    
    <?php if( file_exists( FCPATH.'data'.DS.'backgrounds'.DS.'default_1.4.jpg' ) ) : ?>
    $.supersized({  
	slides  :  [ { image : '<?php echo site_url( 'stream/default_1.4.jpg' ) ?>' } ]
    });
    <?php endif; ?>    
});  
</script>