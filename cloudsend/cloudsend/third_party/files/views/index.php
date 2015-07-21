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
	    <?php if( $errortype ): ?>
	    <div class="alert alert-<?php echo $errortype ?>">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php echo $errormsg ?>
	    </div>
	    <?php endif; ?>
	    <div class="page-header">
		<h3><?php echo ( $catdetail != false ) ? 'Category: "'.$catdetail->categoryTitle.'"' : __('files_head_files') ?> <small>( <?php echo (is_array( $files )) ? count( $files ) : '0' ?> )</small></h3>
	    </div>
	    <blockquote>
		<p><?php echo __('files_desc_files') ?></p>
	    </blockquote>
	</div>
	
    </div>
    
    <div class="row">
	<div class="span2" id="navigationTable">
	    <a href="<?php echo site_url( 'admin/categories/index' ) ?>" class="settings hidden"><i class="icon-cog"></i></a>
	    <ul class="nav nav-list">
		<li class="nav-header"><?php echo __('files_title_cats') ?></li>
		<li<?php if( $selected == false ) echo ' class="active"' ?> data-cat-id="all"><a href="<?php echo site_url( 'admin/files/index' ) ?>"><?php echo __('files_lnk_allfiles') ?></a></li>
		<?php if( $categories != false ): ?>
		<?php foreach( $categories AS $category ): ?>
		<li<?php if( $selected != false && $selected == $category->categoryUniqueID ) echo ' class="active"' ?> data-cat-id="<?php echo $category->categoryUniqueID ?>"><a href="<?php echo site_url( 'admin/files/index?category='.$category->categoryUniqueID ) ?>"><?php echo stripslashes( $category->categoryTitle ) ?></a></li>
		<?php endforeach; ?>
		<?php endif; ?>
	    </ul>
	</div>

	<div class="span10">
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
                                <th><?php echo __('files_lsttit_file') ?></th>
                                <th><?php echo __('files_lsttit_size') ?></th>
                                <th><?php echo __('files_lsttit_uploaded') ?></th>
                                <th><?php echo __('files_lsttit_user') ?></td>
                                <th><center><?php echo __('files_lsttit_public') ?></center></th>
			    </tr>
			</thead>
			<tbody>
			    <?php foreach( $files AS $file ): ?>
			    <?php
				if ( empty( $file->uploadRequest ) ) {
				    $_user = mUser::getUser($file->fileUploadBy)->companyName;
				    if( isset( $_user ) && !empty( $_user ) ) {
					$_lbl_user = $_user;
				    } else {
					$_lbl_user = 'n/a';
				    }
				} else {
				    $_lbl_user = __('dash_txt_uprequest');
				}

			    
				if( $file->filePublic == '0' ) {
				    $_icon = 'icon-lock icon-large';
				} else {
				    $_icon = 'icon-unlock icon-large';
				}
			    ?>
			    <tr data-file-id="<?php echo $file->fileUniqueID ?>" class="selectable">
					<td><center><input type="checkbox" name="onefile[]" data-size="<?php echo $file->fileSize ?>" value="<?php echo $file->fileUniqueID ?>" class="onefile" /></center></td>
	                <td><?php if( is_image( $file->fileNewName ) ): ?><a href="<?php echo site_url( 'admin/files/preview/full/' . $file->fileNewName ) ?>" rel="colorbox" title="<?php echo $file->fileName ?>"><?php endif; ?><img src="<?php echo site_url( 'admin/files/preview/icon/'.$file->fileNewName ) ?>" /><?php if( is_image( $file->fileNewName ) ): ?></a><?php endif; ?></td>
					<td>
						<a href="<?php echo site_url( 'admin/files/details?entry='.$file->fileUniqueID ) ?>" data-file-id="<?php echo $file->fileUniqueID ?>"><?php echo shorten_string( $file->fileName, 40 ) ?></a> 
						<div class="buttonline">
							<a href="<?php echo site_url( 'admin/files/download/'.$file->fileUniqueID ) ?>" class="btn btn-mini icon-cloud-download"></a> 
							<a href="javascript:void(0);" data-toggle="modal" data-name="<?php echo $file->fileName ?>" data-id="<?php echo $file->fileUniqueID ?>" class="btn btn-mini icon-pencil rename"></a>
							<a href="#" class="btn btn-mini icon-trash trash" data-id="<?php echo $file->fileUniqueID ?>"></a>
						</div>
						<?php if( !empty( $file->fileMD5 ) ): ?><br /><span class="md5">MD5: <?php echo $file->fileMD5 ?></span><?php endif; ?>
					</td>
					<td><?php echo roundsize($file->fileSize) ?></td>
					<td><?php echo cvTZ($file->fileTime) ?></td>
					<td><?php echo $_lbl_user ?></td>
					<td><center><a href="<?php echo site_url( 'admin/files/published/'.$file->fileUniqueID ) ?>" class="publish"><i class="<?php echo $_icon ?>"></i></a></center></td>
			    </tr>
			    <?php endforeach; ?>
			</tbody>
		    </table>
                    <div class='markedFiles'></div>
		    <?php echo $this->load->view('files/modal_actions') ?>
		</fieldset>
	    </form>
	<?php endif; ?>
	</div>	
    </div>
</div>
<?php echo $this->load->view('files/javascripts') ?>