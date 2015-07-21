<?php
$write=affilateright("ads","write");
$read=affilateright("ads","read");

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
                  <!--<h3 class="panel-title col-md-11">Country(s) Listing </h3> -->
                  <div class="col-md-8" style="margin-left: -15px;">
                    <?php
                    if($write==true)
                    {
                    ?>
				    <a href="<?=SITE_ADMIN_URL;?>ads/create" class="btn btn-primary ">
                    
                    <span class="fa fa-pencil"></span>Add Ads</a>
                   <?php
                   }
                   ?> 
              </div>
                </div>
			
              <?php
                  
                   $fromurl="admin/ads/index";
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
						<th width="10%" data-type="numeric" data-sort-initial="true">S.No</th>
                        <th width="20%">Ad Title</th>
                        <th width="10%">Image</th>
                         
                     <?php
                     }
                     ?>
                      <?php
                    if($write==true)
                    {
                    ?>   <th width="10%" data-hide="phone" data-sort-initial="false">Edit</th>  
                        <th data-hide="phone" width="10%">
                        <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
                        
                        Select</th>
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
											<td><?php echo $objRow['title'];?></td>
                                            	<td>
                                                <?php
                                                $ext = pathinfo($objRow['image'], PATHINFO_EXTENSION);
                                         $video_arr=array("mp4","bat","mov","flv"); 
                                 if(!in_array($ext,$video_arr))
                                 {              
                                              if(!empty($objRow['image']) && file_exists(SITE_UPLOADPATH.$objRow['image']) )
                                               { 
                                                ?> 
                                                                
                                                                 <?php
                                                 echo '<img src="'.SITE_GETUPLOADPATH.$objRow['image'].'?'.time().'" width="80" >'; 
                                                 ?>
                                                    <?php
                                                    }else
                                                    {
                                                        echo "--";
                                                    }
                                    
                                    
                                    }else
                                    {
                                      echo "Video";   
                                    }    
                                    ?>            
                                                </td>
                                      <?php
                                      }
                                      ?>  
                                     <?php
                    if($write==true)
                    {
                    ?>          
                                            <td><a href="<?=SITE_ADMIN_URL;?>ads/edit/<?=$objRow['id'];?>">
                                            <img src="<?php echo SITE_IMAGEURL ;?>editicon.gif">
                                            </a> </td>
											<td>
                                           <?php
                                           if($objRow['id'] !=7)
                                           {
                                           ?> 
											<input type="checkbox" name="selected[]" value="<?php echo $objRow['id']; ?>">  	
										  <?php
                                           }else
                                           {
                                          ?>
                                           --
                                          <?php
                                          }
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
			      <div class="clearfix">&nbsp;</div>   
                     <div class="panel-footer text-right">
                       <?php
                    if($write==true)
                    {
                    ?>
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
 