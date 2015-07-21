<?php
$write=affilateright("affilateright","write");
$read=affilateright("affilateright","read");

?>
 <?php
                          include "rights.php";
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
                 <div class="col-md-2 text-left" style="margin-left: 6%;">
                  Affilate Right 
                 </div> 
                  <div class="col-md-4" style="margin-left: -15px;">
                    
				     <?php
                                    $kindgetclass="class='form-control input-md' id='affilateid' "; 
                                   // $kind_arr=array(''=>"--Select--",'People profile'=>"People profile",'Fun facts'=>"Fun facts",'Me Me'=>"Me Me");
                                    echo form_dropdown('affilateid',array("0"=>"--Select--")+$affilates,$affilateid,$kindgetclass);    
                              
                              ?>   
              </div>
                </div>
			
              <?php
                  
                   $fromurl="admin/affilateright/index/".$affilateid;
                  $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                 echo form_open_multipart($fromurl, $attributes);
                ?>   
                <div class="panel-body">
                  <table id="newtable"  class="table table-striped table-bordered dataTable no-footer dt-responsive" cellspacing="0" width="100%">
                    <thead>
                      <tr>
						<th width="10%" data-type="numeric" data-sort-initial="true">S.No</th>
                        <th width="10%">Module</th>
                        <th width="30%">Right</th>
                       
                      </tr>
                    </thead>
                    <tbody>
						<?php
                        //echo "<pre>";
                      //  print_r($resultsaffilate);
                       // exit; 
						 if(!empty($results))
						   {
							  foreach($results as $key => $objRow)
								  {
								  	 
									?>
										 <tr>
											<td><?php echo $key+1;?></td>
											<td><?php echo $objRow['title'];?></td>
                                            <td>
                                            <?php
                                             $tmprights=array();
                                             $modulename=$objRow['modulesname'];
                                             $check_box="";
                                             $getmodulerights= $modules_rights[$modulename];
                                             if (array_key_exists($modulename, $resultsaffilate)) {
                                                    $tmprights=explode(",",$resultsaffilate[$modulename]); 
                                                }
 
                                               
                                            
                                            
                                            foreach($getmodulerights as $rightkey=> $title)
                                            {
                                                //echo $title;
                                               if(!empty($tmprights))
                                               {
                                                  if(in_array($rightkey,$tmprights))
                                                  {
                                                    $check_box="checked=checked";
                                                  }else
                                                  {
                                                    $check_box="";
                                                  }
                                               } 
                                                
                                               echo '<input type="checkbox" '.$check_box.' name="affilaterights['.$modulename.'][]" value="'.$rightkey.'">';
                                               echo '&nbsp;&nbsp;';
                                               echo $title; echo '&nbsp;&nbsp;';
                                            }
                                            ?>
                                            
                                            </td>
										
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
		                  <input type="submit"  value="Allot" id="deleteall" onclick="document.frmListing.status.value='-1';" class="btn btn-danger" name="btn_allot">
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
    });
      
       $("#affilateid").change(function() {

    window.location.href='<?php echo base_url()."admin/affilateright/index/"?>'+this.value;
});
    </script>				
 