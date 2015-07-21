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

<div class="container" id="containeropenfiles">
    <div class="row" id="openlinkfiles">
	<div class="span12">
	    <div class="page-header">
		<h3><?php echo __('uploads_head_alluploads') ?></h3>
		<button class="btn btn-primary" onClick="location.href='<?php echo site_url( 'admin/pubuploads/add_upload' ) ?>';"><span class="icon-plus icon-white"></span> <?php echo __('uploads_btn_add') ?></button>
	    </div>
	    <blockquote>
		<p><?php echo __('uploads_desc_alluploads') ?></p>
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
		    <col style="width:3%" />
		    <col style="width:72%" />
		    <col style="width:19%" />
		    <col style="width:8%" />
		    <col style="width:8%" />
		</colgroup>
		<thead>
		    <tr>
			<th><center><?php echo __('uploads_lsttit_count') ?></center></th>
			<th><?php echo __('uploads_lsttit_link') ?></th>
			<th><?php echo __('uploads_lsttit_created') ?></th>
			<th class="tac"><?php echo __('uploads_lsttit_release') ?></th>
			<th class="tac"><?php echo __('uploads_lsttit_actions') ?></th>
		    </tr>
		</thead>
		<tbody>
		<?php if( $items != false ): ?>
		<?php $i = 0; ?>
		<?php foreach( $items AS $item ): ?>
		    <tr>
			<td><center><?php echo $i+1 ?></center></td>
			<td>
			    <a href="<?php echo site_url( 'admin/pubuploads/edit_entry?entry='.$item->uploadUniqueID ) ?>">
				<?php echo site_url( 'request/'.$item->uploadUUID ) ?>
			    </a> <a href="<?php echo site_url( 'request/'.$item->uploadUUID ) ?>"><span class="icon-link icon-small"></span></a>
			</td>
			<td><?php echo $item->companyName ?></td>
			<td class="tac">
			    <a href="<?php echo site_url( 'admin/pubuploads/published_entry?is='.$item->published.'&entry='.$item->uploadUniqueID ) ?>">
				<i class="icon-<?php echo ($item->published == 1 ) ? 'ok' : 'remove' ?>"></i>
			    </a>
			</td>
			<td class="tac">
			    <a href="<?php echo site_url( 'admin/pubuploads/delete_entry?entry='.$item->uploadUniqueID ) ?>" class="tip confirm" title="<?php echo __('uploads_txt_delete') ?>">
				<i class="icon-remove"></i>
			    </a>
			</td>
		    </tr>
		    <?php $i++; ?>
		<?php endforeach; ?>
		<?php else: ?>
		    <tr>
			<td colspan="7" class="tac"><?php echo __('uploads_msg_nolinksfound') ?></td>
		    </tr>
		<?php endif; ?>
		</tbody>
	    </table>
	</div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/libs/jquery.confirm.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('a.confirm').click(function(event) {
	location.href = $(this).attr('href');
    }).confirm({
	msg: '<?php echo __('uploads_txt_sure') ?><br />',
	buttons: {
	    ok: '<?php echo __('uploads_txt_yes') ?>',
	    cancel: '<?php echo __('uploads_txt_no') ?>',
	    separator: ' / '	    
	}
    }); 
});  
</script>