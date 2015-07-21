<?php
$write=affilateright("dashboard","gtaskwrite");
$read=affilateright("dashboard","gtaskread");

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
                 <div class="col-md-6" >
                   <?php
                  if($write==true)
                  {
                 ?> 
                  <div class="col-md-3" >
				   <a href="<?=SITE_ADMIN_URL;?>dashboard/addtask" class="btn btn-primary">
                         <span class="fa fa-pencil"></span>Add Task</a>
                  </div>
                  <div class="col-md-2 "  >
				   <a href="<?=SITE_ADMIN_URL;?>dashboard/task" class="btn btn-success">
                         My Task</a>
                  </div>
                  <?php
                  }
                  ?> 
                 </div>     
                </div>
			  
              <?php
                  
                   $fromurl="admin/dashboard/givetask";
                  $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                 echo form_open_multipart($fromurl, $attributes);
                ?>   
                <div class="panel-body">
                  <table id="newtable"  class="table table-striped table-bordered dataTable no-footer dt-responsive" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                      <?php
                  if($read==true)
                  {
                 ?> 
					<th data-type="numeric" data-sort-initial="true">S.No</th>
                    <th>From</th>
                    <th>Task</th>
                    <th>Status</th>
                     <?php
                    }
                    ?>  
                     <?php
                  if($write==true)
                  {
                 ?> 
                    <th>  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
                        
              Select</th>
                    <?php
                    }
                    ?>    
                        
                      </tr>
                    </thead>
                    <tbody>
						<?php
                       // echo "Test <pre>";
                       // print_r($results);
                       // exit;
                        
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
											<td><?php echo $objRow['username'];?></td>
                                            	<td><?php echo $objRow['task'];?></td>
                                            <td>
                                            <?php $colr = array('1'=>'info','2'=>'ready','3' => 'success','4'=> 'danger');?>
                                            <button class="btn btn-mini btn-<?php echo $colr[$objRow['status']];?>" type="button">
                                            <?php $stas = array('1'=>'Open','2'=>'In progress','3' => 'Completed','4'=> 'Closed'); echo $stas[$objRow['status']];?>
                                            </button>
                                            </td>
                                            <?php
                                            }
                                            ?>
                                             <?php
                                              if($write==true)
                                              {
                                             ?> 
											<td>
											<input type="checkbox" name="selected[]" value="<?php echo $objRow['id']; ?>">  	
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
			      <div class="clearfix">&nbsp;</div>   
                     <div class="panel-footer text-right">
                         <?php
                                              if($write==true)
                                              {
                                             ?> 
                           <input type="submit"  class="btn btn-ready" value="In progress" name="btn_ready">
	                        <input type="submit"  class="btn btn-success" value="Completed" name="btn_complete">
		                    <input type="submit" class="btn btn-danger" value="Closed" name="btn_close">
                           &nbsp;&nbsp;|&nbsp;&nbsp;
		                  <input type="submit"  value="Delete" id="deleteall" onclick="document.frmListing.status.value='-1';" class="btn btn-danger" name="btn_delete">
                             <?php
                                            }
                                            ?>
                     </div>	
                </div>
			  	<?php echo form_close();?>
                  
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
 
 function downloadpdf()
 {
    window.location.href='<?=SITE_ADMIN_URL;?>masterlist/downloadpdf/'+$("#fillter").val();
    
 }
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
    
    $( "#fillter" ).change(function() {

    window.location.href='<?php echo base_url()."admin/masterlist/index/"?>'+this.value;
});
    
    $(".setbackground").click(function() {
        var selid=this.id;
        $.ajax({
                    
                   // dataType: 'JSON',
                    type: 'POST',
                    cache: false,
                    url:  '<?php echo base_url();?>admin/ads/setbackgroundimage',
                    data : {
                      editid : selid
                    },
                    success: function(data){
                    if(data=="Y")
                    {
                     $("#"+strflag).remove(); 
                    }
                    return false;
                    }
                    });  
    });
      });
    </script>				
 