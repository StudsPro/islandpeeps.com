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
<div class="container" id="files">
    <div class="row" id="filesOverview">
	<div class="span12">
	    <div class="page-header">
		<h3><?php echo __('up_head_latestupload') ?></h3>
	    </div>
	    <blockquote>
		<p><?php echo __('up_desc_latestupload') ?></p>
	    </blockquote>
	    <br />
	    <?php if( $imports != false ): ?>
	    <div class="row" id="filter">
		<div class="span12">
		    <form name="filter" action="<?php echo site_url( 'admin/uploads/latest' ) ?>" method="POST">
			Filter 
			<select name="fileImportID" class="span3">
			    <?php foreach( $imports AS $import ): ?>
			    <?php
				if( empty( $import->companyName ) ) {
				    if( !empty( $import->uploadRequest ) ) {
					$_company = ' ( '.__('up_txt_uprequest').' )';
				    } else {
					$_company = ' ( '.__('up_txt_userremoved').' )';
				    }
				} else {
				    $_company = ' ( '.$import->companyName.') ';
				}
			    ?>
			    <option value="<?php echo $import->fileID ?>"<?php if( $latest == $import->fileID ) echo ' selected="selected"' ?>><?php echo cvTZ( $import->fileTime ) ?><?php echo $_company ?></option>
			    <?php endforeach; ?>
			</select>
			<button type="submit" class="btn"><i class="icon-search"></i></button>
		    </form>
		</div>
	    </div>
	    <?php endif; ?>
	<?php if( $files != false ): ?>
    	    <form class="form-horizontal" id="fileForm">
		<fieldset>
	    
		    <table class="table table-striped table-condensed" id="fileTable">
				<colgroup>
				    <col style="width:5%" />
				    <col style="width:7%" />
				    <col style="width:40%" />
				    <col style="width:10%" />
				    <col style="width:15%" />
				    <col style="width:15%" />
				    <col style="width:8%" />
				</colgroup>
				<thead>
				    <tr>
                                        <th><center><input type="checkbox" class="checkall" /></center></th>
                                        <th></th>
                                        <th><?php echo __('up_lsttit_file') ?></th>
                                        <th><?php echo __('up_lsttit_size') ?></th>
                                        <th><?php echo __('up_lsttit_uploaded') ?></th>
                                        <th><center><?php echo __('up_lsttit_downloads') ?></center></th>
                                        <th style="width:80px;"><center><?php echo __('up_lsttit_public') ?></center></th>
				    </tr>
				</thead>
				<tbody>
				    <?php foreach( $files AS $file ): ?>
				    <?php
					if( $file->filePublic == '0' ) {
					    $_icon = 'icon-lock icon-large';
					} else {
					    $_icon = 'icon-unlock icon-large';
					}
				    ?>
				    <tr data-file-id="<?php echo $file->fileUniqueID ?>">
                                        <td><center><input type="checkbox" name="onefile[]" data-size="<?php echo $file->fileSize ?>" value="<?php echo $file->fileUniqueID ?>" class="onefile" /></center></td>
                                        <td><?php if( is_image( $file->fileNewName ) ): ?><a href="<?php echo site_url( 'admin/files/preview/full/' . $file->fileNewName ) ?>" rel="colorbox" title="<?php echo $file->fileName ?>"><?php endif; ?><img src="<?php echo site_url( 'admin/files/preview/icon/'.$file->fileNewName ) ?>" /><?php if( is_image( $file->fileNewName ) ): ?></a><?php endif; ?></td>
                                        <td>
                                            <a href="<?php echo site_url( 'admin/files/details?entry='.$file->fileUniqueID ) ?>" data-file-id="<?php echo $file->fileUniqueID ?>"><?php echo $file->fileName ?></a> 
                                            <div class="buttonline">
                                                    <a href="<?php echo site_url( 'admin/files/download/'.$file->fileUniqueID ) ?>" class="btn btn-mini icon-cloud-download"></a> 
                                                    <a href="javascript:void(0);" data-toggle="modal" data-name="<?php echo $file->fileName ?>" data-id="<?php echo $file->fileUniqueID ?>" class="btn btn-mini icon-pencil rename"></a>
                                                    <a href="#" class="btn btn-mini icon-trash trash" data-id="<?php echo $file->fileUniqueID ?>"></a>
                                            </div>
                                            <?php if( !empty( $file->fileMD5 ) ): ?><br /><span class="md5">MD5: <?php echo $file->fileMD5 ?></span><?php endif; ?>
                                        </td>
                                        <td><?php echo roundsize($file->fileSize) ?></td>
                                        <td><?php echo cvTZ($file->fileTime) ?></td>
                                        <td><center><?php echo $file->fileCounter ?></center></td>
                                        <td><center><a href="<?php echo site_url( 'admin/files/published/'.$file->fileUniqueID ) ?>" class="publish"><i class="<?php echo $_icon ?>"></i></a></center></td>
				    </tr>
				    <?php endforeach; ?>
				</tbody>
		    </table>
                    <div class="markedFiles"></div>
		    <?php echo $this->load->view('files/modal_actions') ?>
		</fieldset>
	    </form>
	<?php else: ?>
	    <div class="alert">
		<?php echo __('up_msg_nofilesinsystem') ?> <a href="<?php echo site_url( 'admin/uploads/index' ) ?>"><?php echo __('up_msg_addthefirst') ?></a>
	    </div>
	<?php endif; ?>
	</div>
	
    </div>    
</div>	    

<?php echo $this->load->view('files/javascripts') ?>