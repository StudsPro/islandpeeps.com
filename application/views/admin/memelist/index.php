<?php
$write=affilateright("memlist","write");
$read=affilateright("memlist","read");

?>
<div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-title"><?=$page_titles;?></h3>
               <?php echo $breadcrumds;?>
            </div>
          </div>
        </div>
		
 <div class="container">
             <?php 
					 if($this->session->flashdata('error')) 
                     { ?> <div class="alert alert-danger"> <?php echo $this->session->flashdata('error');  ?></div><?php	} 
					  //$success = $this->session->flashdata('item'); 
					  if($this->session->flashdata('sucess')) { ?>
					  <div class="alert alert-success"> <?php echo $this->session->flashdata('sucess')  ?></div>
					 <?php } ?>
           
           
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                   <div class="col-md-8" style="margin-left: -15px;">
				   <?php
                   if($write==true)
                   {
                   ?> <a href="<?=SITE_ADMIN_URL;?>memelist/add" class="btn btn-primary "><span class="fa fa-pencil"></span>Add Me Me</a>
                 <?php
                   }
                 ?>   
              </div>
                </div>
				<form method="post" name="frmListing">
                <div class="panel-body">
                    <table id="newtable"  class="table table-striped table-bordered dataTable no-footer dt-responsive" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                       <?php
                   if($read==true)
                   {
                   ?> 
						<th width="15%" data-type="numeric" data-sort-initial="true">S.No</th>
                        <th width="25%">Me Me Title</th>
						<th width="15%">Image</th>
                        <th data-hide="phone" width="15%">Status</th>
                  <?php
                  }
                  ?>      
                        <?php
                   if($write==true)
                   {
                   ?>  
						<th width="15%" data-hide="phone" data-sort-initial="false">Edit</th>
						<th width="15%" data-hide="phone">
                        <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
                        Select</th>
                   <?php
                   }
                   ?>     
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
                                           <?php
                                           if($read==true)
                                           {
                                           ?> 
											<td><?php echo $key+1;?></td>
											<td><?php echo $objRow['title'];?></td>
											<td>
                                          
                                            <img src="<?php echo SITE_GETUPLOADPATH.$objRow['memefile'].'?time='.time();?>" border="0" width="50" /></td>
											<td ><?php 
                                            if($objRow['status']=='1')
                                            { ?>
                                               <img src="<?php echo SITE_IMAGEURL ;?>activepage.jpg">
                                          <?php    
                                            }else{ 
                                            ?>    
                                              <img src="<?php echo SITE_IMAGEURL ;?>inactivepage.gif">
                                            <?php    }
                                            ?>
                                          </td>
                                         <?php
                                          }
                                         ?>
                                           <?php
                                           if($write==true)
                                           {
                                           ?>  
											<td><a href="<?=SITE_ADMIN_URL;?>memelist/edit/<?=$objRow['id'];?>">
                                             <img src="<?php echo SITE_IMAGEURL ;?>editicon.gif">
                                            
                                            </a> </td>
											<td>
											<?php if(!(($objRow['id']==4) || ($objRow['id']==6)))
												{ ?><input type="checkbox" name="selected[]" value="<?php echo $objRow['id'];?>" /><?php }
											?>
											</td>
                                          <?php
                                          }
                                          ?>  
										  </tr>
									<?php
								  }
							}
						?>
                    </tbody>
                  </table>
				
                </div>
				<div class="panel-footer text-right" >
					<?php
                   if($write==true)
                   {
                   ?>
                     <input type="submit" name="btn_UnPublish" value="UnPublish" class="btn btn-warning"  />
               
              <input type="submit" name="btn_Publish" value="Publish" class="btn btn-primary"  />
              
              <input type="submit" name="btn_delete" value="Delete" class="btn btn-danger"  />
			  <input type="hidden" name="status" value="1" />
        <input type="hidden" name="task" value="modify" />
                  <?php
                  }
                  ?>   
				</div>
				  </form>
              </div>
            </div>
          </div>
        </div>

			 <!--main content -->
				
 <?php 
   
   $admininfo=get_admininfo(); 
    $perpage=($admininfo["masterlistperpage"]) ? $admininfo["masterlistperpage"] :'50';
   ?> 
<script>
     $(document).ready(function() {
       // Tables.initDynamicTables();
    $("#newtable").DataTable({
      "sDom": "<'row' <'col-xs-7'l><'col-xs-4'f>r>t<'row'<'col-xs-6'i><'col-xs-3'p> >",
      "aaSorting": [[2, "desc"]],
      "pageLength": 5,
       stateSave:true,
	   "stateDuration": 60 * 60 * 24,
        "iDisplayLength": <?php echo $perpage;?>,
        //"bPaginate": true,
        "bLengthChange": true, 
        responsive: true,
        	"language": {
			"lengthMenu": "_MENU_ <span class='hidden-xs'>records per page </span>"
	}
      
    });
    });
 </script>   	