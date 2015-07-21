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
	    <h3><?php echo __('account_head_login') ?> <?php echo stripslashes( mGlobal::getConfig('PRODUCT_NAME')->configVal ) ?></h3>
	</div>

	<div class="span7 offset2">
	    <form name="loginForm" action="<?php echo site_url('admin/account/validate') ?>" method="post" class="form-horizontal" autocomplete="off">
		<div class="alert alert-<?php echo $errortype ?>">
		    <?php echo $errormsg ?>
		</div>
		<div class="control-group">
		    <label class="control-label" for="inputEmail"><?php echo __('account_lbl_email') ?></label>
		    <div class="controls">
			<input type="text" id="inputEmail" autocomplete="off" name="inputEmail" placeholder="<?php echo __('account_lbl_email') ?>" value="<?php echo set_value('inputEmail') ?>" />
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="inputPassword"><?php echo __('account_lbl_password') ?></label>
		    <div class="controls">
			<input type="password" id="inputPassword" name="inputPassword" placeholder="<?php echo __('account_lbl_password') ?>" value="<?php echo set_value('inputPassword') ?>" />
		    </div>
		</div>
		<div class="control-group">
		    <div class="controls">
			<button type="submit" class="btn"><i class="icon-user"></i> <?php echo __('account_btn_signin' ) ?></button>
		    </div>
		</div>
	    </form>	
	</div>
    </div>
</div>
