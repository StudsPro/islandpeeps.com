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

<div class="container" id="accountadd">
    <div class="page-header">
	<h3><?php echo __('uploads_head_add') ?></h3>
    </div>
    <blockquote>
	<p><?php echo __('uploads_desc_add') ?></p>
    </blockquote>
    <br />

    <?php if( $errortype ): ?>
    <div class="alert alert-<?php echo $errortype ?>">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<?php echo $errormsg ?>
    </div>
    <?php endif; ?>

    <form name="addupload" id="addupload" action="<?php echo site_url( 'admin/pubuploads/verify_upload' ) ?>" method="post" class="form-horizontal">
	<div class="control-group">
	    <label class="control-label" for="inputDescription"><?php echo __('uploads_lbl_desc') ?></label>
	    <div class="controls">
		<textarea id="inputDescription" name="inputDescription" class="span7" rows="10"><?php echo set_value( 'inputDescription' ) ?></textarea>			
	    </div>
	</div>
        
	<div class="control-group">
	    <label class="control-label" for="inputDefaultFolder"><?php echo __('uploads_lbl_folder') ?></label>
	    <div class="controls">
		<?php echo $folders ?>
	    </div>
	</div>
	
	<div class="form-actions">
	    <button type="submit" class="btn btn-primary"><?php echo __('uploads_btn_create') ?></button>
	    <button type="button" class="btn" onClick="location.href='<?php echo site_url( 'admin/pubuploads/all_entries' ) ?>';" ><?php echo __('uploads_btn_cancel') ?></button>
	</div>	
    </form>
</div>

<script src="<?php echo base_url() ?>assets/scripts/libs/wysihtml5-0.3.0.js"></script>
<script src="<?php echo base_url() ?>assets/scripts/libs/bootstrap-wysihtml5-0.0.2.js"></script>
<script type="text/javascript">
$(function(){
    $('#inputDescription').wysihtml5({
        "font-styles": false,
        "image": false	
    });
});   
</script>