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

<div class="container" id="folderadd">
    <div class="page-header">
		<h3><?php echo __('folder_head_add') ?></h3>
    </div>
    <blockquote>
		<p><?php echo __('folder_desc_add') ?></p>
    </blockquote>
    <br />

    <?php if( $errortype ): ?>
    <div class="alert alert-<?php echo $errortype ?>">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php echo $errormsg ?>
    </div>
    <?php endif; ?>

    <form name="addfolder" id="addfolder" action="<?php echo site_url( 'admin/folder/verify_folder' ) ?>" method="post" class="form-horizontal">
		<div class="control-group">
		    <label class="control-label" for="inputTitle"><?php echo __('folder_lbl_title') ?></label>
		    <div class="controls">
				<input type="text" id="inputTitle" name="inputTitle" value="<?php echo set_value( 'inputTitle' ) ?>" />
		    </div>
		</div>

		<div class="control-group">
		    <label class="control-label" for="inputParent"><?php echo __('folder_lbl_parent') ?></label>
		    <div class="controls">
		    	<?php echo $folderTag ?>
		    </div>
		</div>
		
		<div class="form-actions">
		    <button type="submit" class="btn btn-primary"><?php echo __('folder_btn_addfolder') ?></button>
		    <button type="button" class="btn" onClick="location.href='<?php echo site_url( 'admin/folder/index' ) ?>';" ><?php echo __('folder_btn_cancel') ?></button>
		</div>	
    </form>
</div>