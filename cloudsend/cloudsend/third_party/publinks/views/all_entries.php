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
		<h3><?php echo __('pub_head_publiclinks') ?></h3>
	    </div>
	    <blockquote>
		<p><?php echo __('pub_desc_publiclinks') ?></p>
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
		    <col style="width:58%" />
		    <col style="width:19%" />
		    <col style="width:7%" />
		    <col style="width:7%" />
		    <col style="width:8%" />
		    <col style="width:8%" />
		</colgroup>
		<thead>
		    <tr>
			<th><center><?php echo __('pub_lsttit_count') ?></center></th>
			<th><?php echo __('pub_lsttit_link') ?></th>
			<th><?php echo __('pub_lsttit_created') ?></th>
			<th><?php echo __('pub_lsttit_password') ?></th>
			<th><?php echo __('pub_lsttit_limit') ?></th>
			<th class="tac"><?php echo __('pub_lsttit_release') ?></th>
			<th class="tac"><?php echo __('pub_lsttit_actions') ?></th>
		    </tr>
		</thead>
		<tbody>
		<?php if( $items != false ): ?>
		<?php $i = 0; ?>
		<?php foreach( $items AS $item ): ?>
		    <?php 
			$_entryfiles = mPublinks::getEntryFiles( $item->publicUniqueID );
			$_files = array();
			$_short = array();
			if( $_entryfiles != false ) {
			    $_count = 0;
			    foreach( $_entryfiles AS $_entryfile ) {
				$_files[] = $_entryfile->fileName;
				if( $_count <= 2 ) $_short[] = $_entryfile->fileName;
				$_count++;
			    }
			} else {
			    $_files[] = '';
			}
		    ?>
		    <tr>
			<td><center><?php echo $i+1 ?></center></td>
			<td>
			    <a href="<?php echo site_url( 'admin/publinks/edit_entry?entry='.$item->publicUniqueID ) ?>">
				<?php echo site_url( 'public/'.$item->publicUUID ) ?>
			    </a>
			    <br /><small><strong><?php echo __('pub_txt_files') ?></strong> 
			    <?php if( count( $_files ) >= 3 ): ?>
			    <?php echo implode( ', ', $_short ).' <strong>'.__('pub_txt_more', count( $_files )-count( $_short ) ).'</strong>'; ?>
			    <?php else: ?>
			    <?php echo implode( ', ', $_files ); ?>
			    <?php endif; ?></small>
			</td>
			<td><?php echo mUser::getUser( $item->userUniqueID )->companyName ?></td>
			<td><?php echo ($item->publicPassword != NULL ) ? __('pub_txt_passyes') : __('pub_txt_passno') ?></td>
			<td><?php echo ($item->publicLimit != NULL ) ? cvTZ( $item->publicLimit ) : __('pub_txt_passno') ?></td>
			<td class="tac">
			    <a href="<?php echo site_url( 'admin/publinks/published_entry?is='.$item->published.'&entry='.$item->publicUniqueID ) ?>">
				<i class="icon-<?php echo ($item->published == 1 ) ? 'ok' : 'remove' ?>"></i>
			    </a>
			</td>
			<td class="tac">
			    <a href="<?php echo site_url( 'admin/publinks/delete_entry?entry='.$item->publicUniqueID ) ?>" class="tip confirm" title="<?php echo __('pub_txt_delete') ?>">
				<i class="icon-remove"></i>
			    </a>
			</td>
		    </tr>
		    <?php $i++; ?>
		<?php endforeach; ?>
		<?php else: ?>
		    <tr>
			<td colspan="7" class="tac"><?php echo __('pub_msg_nolinksfound') ?></td>
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
	msg: '<?php echo __('pub_txt_sure') ?><br />',
	buttons: {
	    ok: '<?php echo __('pub_txt_yes') ?>',
	    cancel: '<?php echo __('pub_txt_no') ?>',
	    separator: ' / '	    
	}
    }); 
});  
</script>