<?php
$write=affilateright("regions","write");
$read=affilateright("regions","read");

?>
<div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-title"><?=$page_title;?></h3>
              <!--<ul class="breadcrumb breadcrumb-arrows breadcrumb-default">
                <li><a href="<?=SITE_ADMIN_URL;?>"><i class="fa fa-home fa-lg"></i></a></li>
                <li><a href="#ignore">Country(s) Listing  </a></li>
               </ul> -->
               
                <?php echo $breadcrumds;?>
            </div>
          </div>
        </div>
		
 <div class="container">
           <?php 
					 if(isset($error)) { ?> <div class="alert alert-danger"> <?php echo $error  ?></div><?php	} 
					  //$success = $this->session->flashdata('item'); 
					  if($this->session->flashdata('sucess')) { ?>
					  <div class="alert alert-success"> <?php echo $this->session->flashdata('sucess')  ?></div>
					 <?php } ?>
					
           
           
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <!--<h3 class="panel-title col-md-11">Country(s) Listing </h3> -->
                 <div class="col-md-8" style="margin-left: -15px;">
				   <?php
                   if($write==true)
                   {
                   ?>
                    <a href="<?=SITE_ADMIN_URL;?>regions/create" class="btn btn-primary ">
                    <span class="fa fa-pencil"></span>Add Country</a>
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
						<th width="10%" data-type="numeric" data-sort-initial="true">S.No</th>
                        <th width="50%">Country Name</th>
						<th width="10%">Flag</th>
                        <th data-hide="phone" width="10%">Status</th>
                      <?php
                     } 
                      ?>    
                        <?php
                   if($write==true)
                   {
                   ?> 
						<th width="10%" data-hide="phone" data-sort-initial="false">Edit</th>
                     <?php
                     }
                     ?>   
						<!--<th width="10%" data-hide="phone">Delete</th> -->
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
											<td><?php echo $objRow['region_name'];?></td>
											<td>
                                            <?php
                                               if(!empty($objRow['flag']) && file_exists(SITE_UPLOADPATH.$objRow['flag']) )
                                               {
                                                ?>
                                            <img src="<?php echo SITE_GETUPLOADPATH.$objRow['flag'];?>" width="30">
                                            <?php
                                            }else
                                            {
                                            ?>
                                             --
                                            <?php
                                            }
                                            ?>
                                            </td>
											<td>
												<?php 
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
											<td><a href="<?=SITE_ADMIN_URL;?>regions/edit/<?=$objRow['id'];?>">
                                             <img src="<?php echo SITE_IMAGEURL ;?>editicon.gif">
                                            </a> </td>
                                           <?php
                                             }
                                           ?> 
											<!--<td><a href="<?=SITE_ADMIN_URL;?>regions/delete/<?=$objRow['id'];?>"><span class="fa fa-trash-o"></span></a> </td> -->
										  </tr>
									<?php
								  }
							}
						?>
                    </tbody>
                  </table>
				
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
      "sDom": "<'row' <'col-xs-7'l><'col-xs-4'f>r>t<'row'<'col-xs-4'i><'col-xs-6'p> >",
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