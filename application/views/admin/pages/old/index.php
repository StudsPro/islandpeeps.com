<div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-title"><?=$page_title;?></h3>
              <ul class="breadcrumb breadcrumb-arrows breadcrumb-default">
                <li><a href="<?=SITE_ADMIN_URL;?>"><i class="fa fa-home fa-lg"></i></a></li>
                <li><a href="#ignore">Modify Pages</a></li>
               </ul>
            </div>
          </div>
        </div>
		
 <div class="container">
           
           
           
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title col-md-11">Modify Pages</h3>
				  <div class="col-md-1">
				  	<a href="<?=SITE_ADMIN_URL;?>pages/add" class="btn btn-success btn-xs"><span class="fa fa-plus-square-o"></span></a>
				  </div>
                </div>
				<form method="post" name="frmListing">
                <div class="panel-body">
                  <table id="foo-table" class="table">
                    <thead>
                      <tr>
						<th width="10%" data-type="numeric" data-sort-initial="true">S.No</th>
                        <th width="60%">Title</th>
                        <th data-hide="phone" width="10%">Status</th>
						<th width="10%" data-hide="phone" data-sort-initial="false">Edit</th>
						<th width="10%" data-hide="phone">Select</th>
						<!--<th data-sort-ignore="true">Last Name</th>
                        <th data-hide="phone,tablet">Job Title</th>
                        <th data-type="numeric" data-hide="phone,tablet">DOB</th>-->
                      </tr>
                    </thead>
                    <tbody>
						<?php
						 if(!empty($results))
						   {
							  foreach($results as $key => $objRow)
								  {
								  	$strStatus = ($objRow['status'])?'activepage.jpg':'inactivepage.gif';
									?>
										 <tr>
											<td><?php echo $key+1;?></td>
											<td><?php echo $objRow['page_title'];?></td>
											<td>
												<?php 
												if($objRow['status']) 
													{?><span title="Active" class="status-metro status-active">Active</span><?php } 
												else 
													{?><span class="status-metro status-disabled" title="Disabled">Disabled</span><?php } 
												?>
											</td>
											<td><a href="<?=SITE_ADMIN_URL;?>pages/edit?id=<?=$objRow['id'];?>"><span class="fa fa-pencil"></span></a> </td>
											<td>
											<?php if(!(($objRow['id']==4) || ($objRow['id']==6)))
												{ ?><input type="checkbox" name="delete[]" value="<?php echo $objRow['id'];?>" /><?php }
											?>
											</td>
										  </tr>
									<?php
								  }
							}
						?>
                    </tbody>
                  </table>
				
                </div>
				<div class="panel-footer">
					 <input type="submit" name="btn_UnPublish" value="UnPublish" class="btn btn-warning" onclick="document.frmListing.status.value='0';" />
               
              <input type="submit" name="btn_Publish" value="Publish" class="btn btn-primary" onclick="document.frmListing.status.value='1';" />
              
              <input type="submit" name="btn_delete" value="Delete" class="btn btn-danger" onclick="document.frmListing.status.value='-1';" />
			  <input type="hidden" name="status" value="1" />
        <input type="hidden" name="task" value="modify" />
				</div>
				  </form>
              </div>
            </div>
          </div>
        </div>

			 <!--main content -->
				
 