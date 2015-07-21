<div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-title"><?=$page_titles;?></h3>
              <?php echo $breadcrumds;?>
            </div>
          </div>
        </div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			 <div class="panel panel-default">
                 <div class="panel-heading">
                          <h3 class="panel-title"> <?php echo $id >0 ? "Edit" : "Add"; ?> Me Me</h3>
                        </div>
			 	 <?php
                            $getclass="class='form-control input-md'";
                          $hidden = array("id"=>$id);
                          $fromurl= $id >0 ? "admin/memelist/edit/".$id : "admin/memelist/add";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                         echo form_open_multipart($fromurl, $attributes, $hidden);
                        ?>
					<div class="panel-body">
						<fieldset>
							<div class="form-group">
								<label for="title" class="col-md-2 control-label"> Me Me Title</label>
								<div class="col-md-5">
								  <input id="title" name="title" type="text" placeholder="title" class="form-control input-md" 
								  value="<?php if(isset($results['title']))
								  				{echo $results['title'];}
												if(isset($results['status'])){$status=$results['status'];} else{$status=1;}?>">
								</div>
						  	</div>
							<div class="form-group">
								<label for="title" class="col-md-2 control-label"> Status</label>
								<div class="col-md-5">
								 <select name="status" id="status" class="form-control input-md" >
									 <option value="1" <?php if($status==1) echo 'selected';?>>Publish</option>
									 <option value="0" <?php if($status==0) echo 'selected';?>>Unpublish</option>
								 </select>
								</div>
						  	</div>
							<div class="form-group">
								<label for="title" class="col-md-2 control-label">  Me Me Image</label>
								<div class="col-md-5">
								<input type="file" class="form-control input-md"  name="db_memefile" id="db_memefile" /> 
								
								</div>
                                <div class="col-md-3">
                                   <?php if(isset($results['memefile'])) {
									if(trim($results['memefile'])!="")
									{ ?> <img src="<?php echo SITE_GETUPLOADPATH.$results['memefile'].'?'.time();?>" border="0" width="100" /><?php }
								 } ?>
                                </div>
						  	</div>
							
							 
						</fieldset>
					</div>
					<div class="panel-footer">
						<div class="form-group">
						  <div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-primary">Submit</button>
						  </div>
						</div>
                  </div>
				<input type="hidden" name="dir" value="pages" />
				<input type="hidden" name="task" value="savememe" />

				<?php echo form_close();?>
			 </div>
		</div>
	</div>
</div>		
 