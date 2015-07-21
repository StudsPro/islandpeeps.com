<?php
$write=affilateright("banner","write");
$read=affilateright("banner","read");

?>
<div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-title"><?php echo $page_titles;?></h3>
              <!--<ul class="breadcrumb breadcrumb-arrows breadcrumb-default">
                <li><a href="<?php //SITE_ADMIN_URL;?>"><i class="fa fa-home fa-lg"></i></a></li>
                <li><a href="#ignore">Modify Banner</a></li>
               </ul> -->
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
                  <!--<h3 class="panel-title col-md-11">Country(s) Listing </h3> -->
                 <!-- <div class="col-md-8" style="margin-left: -15px;">
				    <a href="<?=SITE_ADMIN_URL;?>banner/add" class="btn btn-primary hidden-xs">
                    
                    <span class="fa fa-pencil"></span>Add Banner</a>
              </div>  -->
                </div>
                
                
                <div class="panel-body">
                  <table id="newtable"  class="table table-striped table-bordered dataTable no-footer dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
						 <?php
                         if($read==true)
                         {
                         ?>
                        <th width="10%" data-type="numeric" data-sort-initial="true">S.No</th>
                        <th width="20%">Title</th>
                        <?php
                        }
                        ?>
                      <?php
                         if($write==true)
                         {
                         ?>  
                        <th width="10%" data-hide="phone" data-sort-initial="false">Edit</th>
                        <!--<th data-hide="phone" width="10%">
                        <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
                        
                        Select</th> -->
						<!--<th width="10%" data-hide="phone">Delete</th> -->
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
						<?php
                        }
                        ?>	
                          <?php
                         if($write==true)
                         {
                         ?>				
                                            <td>
											<a href="<?=SITE_ADMIN_URL;?>banner/edit/<?=$objRow['id'];?>">
                                             <img src="<?php echo SITE_IMAGEURL ;?>editicon.gif">
                                            </a>
                                            	</td>
                          <?php
                          }
                          ?>                      
                                           	<!--<td>      
											<a href="<?=SITE_ADMIN_URL;?>banner/delete?id=<?=$objRow['id'];?>"><span class="fa fa-trash-o"></span></a> 
											</td> -->
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
 