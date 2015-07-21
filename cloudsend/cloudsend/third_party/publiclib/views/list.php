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
    <div class="row" id="dashboardOverview">
	<div class="span12">
	    <div class="page-header">
		<h3><?php echo __('public_head_public') ?></h3>
	    </div>
	    <blockquote>
		<p><?php echo ( !empty( $public->publicMessage ) ) ? nl2br( stripslashes( $public->publicMessage ) ) : __('public_desc_filelist') ?></p>
	    </blockquote>
	    <br />
	    <?php if( $files != false ): ?>
	    <table class="table table-condensed">
		<colgroup>
		    <col style="width:5%" />
		    <col style="width:35%" />
		    <col style="width:46%" />
		    <col style="width:7%" />
		    <col style="width:7%" />
		</colgroup>
		<thead>
		    <tr>
			<th></th>
			<th><?php echo __('public_lsttit_file') ?></th>
			<th></th>
			<th><?php echo __('public_lsttit_size') ?></th>
			<th><center><?php echo __('public_lsttit_available') ?></center></th>
		    </tr>
		</thead>
		<tbody>
		    <?php $_count = 1; ?>
		    <?php foreach( $files AS $_file ): ?>
		    <tr>
                        <td><img src="<?php echo site_url( 'public/preview/icon/'.$_file->fileNewName ) ?>" /></td>
			<td><a href="<?php echo site_url( 'public/download/'.$public->publicUUID.'/'.$_file->fileUniqueID ) ?>"><?php echo $_file->fileName ?></a><?php if( !empty( $_file->fileMD5 ) ): ?><br /><span class="md5">MD5: <?php echo $_file->fileMD5 ?></span><?php endif; ?></td>
			<td><?php if( !empty( $_file->fileDescription ) ) echo stripslashes( $_file->fileDescription ) ?></td>
			<td><?php echo roundsize( $_file->fileSize ) ?></td>
			<td><center><a href="<?php echo site_url( 'public/download/'.$public->publicUUID.'/'.$_file->fileUniqueID ) ?>" class="btn btn-mini"><i class="icon-download-alt"></i></a></center></td>
		    </tr>
		    <?php $_count++; ?>
		    <?php endforeach; ?>
		</tbody>
	    </table>
	    <?php else: ?>
	    <div class="alert alert-error">
		<?php echo __('public_msg_nofilesfound') ?>
	    </div>
	    <?php endif; ?>
	</div>
    </div>
</div>