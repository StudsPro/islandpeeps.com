<div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-title"><?=$page_title;?></h3>
              <ul class="breadcrumb breadcrumb-arrows breadcrumb-default">
                <li><a href="<?=SITE_ADMIN_URL;?>"><i class="fa fa-home fa-lg"></i></a></li>
                <li><a href="#ignore">Modify Banner</a></li>
               </ul>
            </div>
          </div>
        </div>
		
 <div class="container">
           
           
           
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title col-md-11">Banner</h3>
				  <div class="col-md-1">
				  	<a href="<?=SITE_ADMIN_URL;?>banner/add" class="btn btn-success btn-xs"><span class="fa fa-plus-square-o"></span></a>
				  </div>
                </div>
                <div class="panel-body">
                  <table id="foo-table" class="table">
                    <thead>
                      <tr>
						<th width="8%" data-type="numeric" data-sort-initial="true">S.No</th>
                        <th width="70%">Banner Title</th>
						<th width="10%" data-hide="phone" data-sort-initial="false">Action</th>
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
									?>
										 <tr>
											<td><?php echo $key+1;?></td>
											<td><?php echo $objRow['title'];?></td>
											<td>
											<a href="<?=SITE_ADMIN_URL;?>banner/edit?id=<?=$objRow['id'];?>"><span class="fa fa-edit"></span></a> 
											<a href="<?=SITE_ADMIN_URL;?>banner/delete?id=<?=$objRow['id'];?>"><span class="fa fa-trash-o"></span></a> 
											</td>
										  </tr>
									<?php
								  }
							}
						?>
                    </tbody>
                  </table>
				
                </div>
				
              </div>
            </div>
          </div>
        </div>

			 <!--main content -->
				
 