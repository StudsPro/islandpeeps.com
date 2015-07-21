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

<div class="container" id="topoverview">
    <div class="row" id="categoryOverview">
	<div class="span12">
	    <div class="page-header">
		<h3><?php echo __('cats_head_allcategory') ?></h3>
		<button class="btn btn-primary" onClick="location.href='<?php echo site_url( 'admin/categories/add_category' ) ?>';"><span class="icon-plus icon-white"></span> <?php echo __('cats_btn_add') ?></button>
	    </div>
	    <blockquote>
		<p><?php echo __('cats_desc_allcategory') ?></p>
	    </blockquote>
	    <br />
	    <?php if( $errortype ): ?>
	    <div class="alert alert-<?php echo $errortype ?>">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php echo $errormsg ?>
	    </div>
	    <?php endif; ?>
	    <table class="table table-bordered table-condensed">
		<colgroup>
		    <col style="width:5%" />
		    <col style="width:87%" />
		    <col style="width:8%" />
		</colgroup>
		<thead>
		    <tr>
			<th class="tac"><?php echo __('cats_lsttit_count') ?></th>
			<th><?php echo __('cats_lsttit_name') ?></th>
			<th class="tac"><?php echo __('cats_lsttit_actions') ?></th>
		    </tr>
		</thead>
		<tbody>
		<?php if( $categories != false ): ?>
		<?php $i = 0; ?>
		<?php foreach( $categories AS $category ): ?>
		    <tr data-id="<?php echo $category->categoryUniqueID ?>">
			<td class="tac"><?php echo $i+1 ?></td>
			<td><a href="<?php echo site_url( 'admin/categories/edit_category?category='.$category->categoryUniqueID ) ?>"><?php echo stripslashes( $category->categoryTitle ) ?></a></td>
			<td class="tac">
			    <a href="#" data-cat-id="<?php echo $category->categoryUniqueID ?>" class="tip confirm" title="<?php echo __('user_txt_delete') ?>">
				<i class="icon-remove"></i>
			    </a>
			</td>
		    </tr>
		    <?php $i++; ?>
		<?php endforeach; ?>
		<?php else: ?>
		    <tr>
			<td colspan="7" class="tac"><?php echo __('cats_msg_nocatsfound') ?> <a href="<?php echo site_url( 'admin/categories/add_category' ) ?>"><?php echo __('cats_msg_createthefirst') ?></a></td>
		    </tr>
		<?php endif; ?>
		</tbody>
	    </table>
	</div>
    </div>
</div>
<div class="modal hide" id="deleteEntries">
    <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h3><?php echo __('cats_head_deletecategory') ?></h3>
    </div>
    <div class="modal-body">
	<div class="alert alert-error hidden"></div>			    
	<p><?php echo __('cats_desc_deletecategory') ?><br /><br /></p>
	<div class="control-group">
	    <label class="checkbox" for="inputRemoveFiles">
		<input type="checkbox" name="inputRemoveFiles" id="inputRemoveFiles" value="activate"> <?php echo __('cats_lbl_remallfiles') ?>
	    </label>
	</div>
    </div>
    <div class="modal-footer">
	<span class="mod-left hidden"></span>
	<a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('cats_btn_cancel') ?></a>
	<a href="#" class="btn btn-danger" id="deleteFiles"><?php echo __('cats_btn_delete') ?></a>
    </div>
</div>		    

<div class="modal hide" id="infoWindow">
    <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h3 style="text-transform:uppercase;"></h3>
    </div>
    <div class="modal-body">
	<p></p>
    </div>
    <div class="modal-footer">
	<span class="mod-left hidden"></span>
	<a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('cats_btn_close') ?></a>
    </div>
</div>		    
		    
<script type="text/javascript">
$(document).ready(function() {
    $('a.confirm').click(function(event) {
	event.preventDefault();
	$('#categoryOverview').prepend('<input type="hidden" id="selCat" value="'+$(this).attr('data-cat-id')+'" />');
	$('#deleteEntries').modal('show');
    }); 
    
    $('#deleteFiles').live('click',function() {
	var categoryID = $('#selCat').val();
	if( $('#inputRemoveFiles').is(':checked') ) {
	    var removeFiles = 1;
	} else {
	    var removeFiles = 0;
	}
	
	if( categoryID != 'undefined' && categoryID != '' ) {
	    $.post('<?php echo site_url('admin/categories/remove_category') ?>', { category: categoryID, files: removeFiles }, function( data ) {
		if( data.type == 'success' ) {
		    $('table tbody tr[data-id="'+categoryID+'"]').remove();
		}
		infoWindow( 'deleteEntries', data );
	    });
	}
    });
    
    function infoWindow( id, info ) {
	$('#'+id).modal('hide');
	$('#infoWindow .modal-header h3').html('').html( info.type );
	$('#infoWindow .modal-body p').html('').html( info.message );
	$('#infoWindow').modal('show');   
    }       
});  
</script>