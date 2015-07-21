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

<div class="container" id="categoryedit">
    <div class="page-header">
	<h3><?php echo __('cats_head_editcategory') ?></h3>
    </div>
    <blockquote>
	<p><?php echo __('cats_desc_editcategory') ?></p>
    </blockquote>
    <br />

    <?php if( $errortype ): ?>
    <div class="alert alert-<?php echo $errortype ?>">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<?php echo $errormsg ?>
    </div>
    <?php endif; ?>

    <form name="editcategory" id="editcategory" action="<?php echo site_url( 'admin/categories/change_category' ) ?>" method="post" class="form-horizontal">
	<input type="hidden" name="category" value="<?php echo $category->categoryUniqueID ?>" />
	
	<div class="control-group">
	    <label class="control-label" for="inputCategory"><?php echo __('cats_lbl_title') ?></label>
	    <div class="controls">
		<input type="text" id="inputCategory" name="inputCategory" value="<?php echo set_value( 'inputCategory', stripslashes( $category->categoryTitle ) ) ?>" />
	    </div>
	</div>
	
	<div class="form-actions">
	    <button type="submit" class="btn btn-primary"><?php echo __('cats_btn_edit') ?></button>
	    <button type="button" class="btn" onClick="location.href='<?php echo site_url( 'admin/categories/all_categories' ) ?>';" ><?php echo __('cats_btn_cancel') ?></button>
	</div>	
    </form>
</div>