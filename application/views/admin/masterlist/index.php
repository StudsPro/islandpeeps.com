<?php
$write=affilateright("masterlist","write");
$read=affilateright("masterlist","read");

?>

<!--<link  href="<?=ADMIN_THEEM_CSS?>datatable/jquery.dataTables.css" rel="stylesheet"/>-->
<!--<link  href="<?=ADMIN_THEEM_CSS?>datatable/dataTables.bootstrap.css" rel="stylesheet"/> -->




  
   
   
<style>
.master-btn .btn {
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  background-color: #f5f5f5;
  background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
  background-repeat: repeat-x;
  border-color: #cccccc #cccccc #b3b3b3;
  border-image: none;
  border-style: solid;
  border-width: 1px;
  box-shadow: 0 1px 0 rgba(255, 255, 255, 0.2) inset, 0 1px 2px rgba(0, 0, 0, 0.05);
  color: #333333;
  cursor: pointer;
  display: inline-block;
  line-height: 20px;
  margin-bottom: 0;
  padding: 4px 12px;
  text-align: center;
  text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
  vertical-align: middle;
}

.master-btn .btn:hover, .btn:focus, .btn:active, .btn.active, .btn.disabled, .btn[disabled] {
  background-color: #e0e3ea;
}

.master-btn .btn-group > .btn:first-child {
  border-radius: 0px 0px 0px 0px !important;
  
  margin-left: 0;
}
.modal-dialog {
  margin: 30px auto;
  width: auto !important;
}

.modal-backdrop {
  background-color: #000000;
  bottom: 0;
  left: 0;
  position: fixed;
  right: 0;
  top: 0;
  z-index: 1040;
  z-index: -1 !important;
}
.modal {
    background-color: transparent;
  background-clip: padding-box;
  border: 0 solid rgba(0, 0, 0, 0.3);
  border-radius: 6px;
  box-shadow: 0 0 0 rgba(0, 0, 0, 0.3);
  width: 560px;
  left: 50%;
    margin-left: -280px;
    outline: medium none;
    position: fixed;
    z-index: 1050;
}
#newtable a { color: #6d84b4 !important; }
</style>
<link href="<?=ADMIN_THEEM_JS;?>tooltip/tooltip.css" rel="stylesheet" type="text/css" />
<script src="<?=ADMIN_THEEM_JS;?>tooltip/tooltip.js" type="text/javascript"></script>

 <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
            <h4 id="myModalLabel" class="modal-title">Help</h4>
          </div>
          <div class="modal-body">
           <?php
            $setting_data=get_siteinfo();
            echo $setting_data[0]["cnotification"]; 
           ?>
          
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default">OK</button>
            
          </div>
        </div>
      </div>
    </div>
    
 
        
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <?php                  
                   if($write==true){?>
                  <div class="col-lg-2 col-md-3 col-sm-2 col-xs-0" >
				   <a href="<?=SITE_ADMIN_URL;?>masterlist/create" class="btn btn-primary hidden-xs">
                         <span class="fa fa-pencil"></span>Add Profile</a>
                  </div>
                 
                  <div class="col-lg-2 col-md-4 col-xs-10" >
				             <?php
                                    $kindgetclass="class='form-control input-md' id='fillter' "; 
                                    $kind_arr=array(''=>"--Select--",'title'=>"ABC Order",'1'=>"Available",'2'=>"Pending",'3'=>"Ready",'4'=>"Used");
                                    echo form_dropdown('fillter', $kind_arr, $fillter,$kindgetclass);    
                              
                              ?> 
                          
                              
                                   
                  </div>
                  <div class="col-lg-2 col-md-4 col-xs-7" >
                   <a href="<?=SITE_ADMIN_URL;?>masterlist/create" alt="Add Profile" title="Add Profile" class="btn btn-primary visible-xs col-xs-4">
                         <span class="fa fa-inbox"></span></a>
				   <a href="<?=SITE_ADMIN_URL;?>masterlist/bulkprofile" class="btn btn-info hidden-xs">
                         <span class="fa fa-pencil"></span>Bulk Profiles Add</a>
                      <a href="<?=SITE_ADMIN_URL;?>masterlist/bulkprofile" alt="Bulk Profiles Add" title="Bulk Profiles Add" class="btn btn-info visible-xs col-xs-4 col-xs-offset-3">
                         <span class="fa fa-inbox"></span></a>   
                  </div>
                  <div class="col-lg-2 col-md-4 col-xs-5" >
				   <a href="<?=SITE_ADMIN_URL;?>masterlist/addcategory" class="btn btn-success hidden-xs">
                         <span class="fa fa-pencil"></span>Add new category</a>
                         <a href="<?=SITE_ADMIN_URL;?>masterlist/addcategory" alt="Add new category" title="Add new category" class="btn btn-success  visible-xs col-xs-6">
                         <span class="fa fa-inbox"></span></a>
                  </div>
                 
                    <div class="col-lg-3 col-md-4 col-xs-10" >
                         <div class="btn-group">
                            <?php 
                            		if(!empty($kinds_arr)): // Check for the resource exists or not
                            			 $intI=0;
                                        
                                        $kindsarr=array("People profile","Fun facts","Me Me");
                            		 $color=array('success','danger','info');
                                 //   $kinds_arr
                            			 foreach($kindsarr as $key => $value)
                            			  {
                             			   if(isset($kinds_arr[$key]["kind"]))
                                           {
                            			  echo '<span class="btn btn-'.$color[$intI].' btn-mini">'.$kinds_arr[$key]["pcount"].' '.$kinds_arr[$key]["kind"].'</span>';
                            			   }else
                                           {
                                              echo '<span class="btn btn-'.$color[$intI].' btn-mini"> 0'.$value.'</span>';
                                           }
                                        
                                         $intI++;
                            			  }
                            		endif;
                            
                            ?>	
                    
                  </div>
                     </div>  
                    <?php
                 }
                 ?>   
                    
                     <?php
                     if($this->session->userdata('sadmin') == '1')
                     {
                     ?>
                     <?php                  
                   if($write==false){?>
                      <div class="col-md-11" >&nbsp; </div>
                   <?php
                   }
                   ?>
                     
                      <div class="col-lg-1 col-md-2 col-xs-2" >
                  <i class="fa fa-cog" data-target="#myModal" style="cursor: pointer;" data-toggle="modal"></i>
                      <div class="btn-group master-btn">
                        <button data-toggle="dropdown" class="btn dropdown-toggle" ><i class="fa fa-cog"></i></button>
                        <ul class="dropdown-menu pull-right">
                        <!--   <li><a href="javascript:void(0)">Print</a></li> -->
                          <li><a href="javascript:void(0);" onclick="downloadpdf();">Save as PDF</a></li>
                         <!--   <li class="divider"></li>
                        <li><a href="javascript:void(0)">Export to Excel</a></li>-->
                        </ul>
                    </div>
                    
                     </div>
                    <?php
                    }
                    ?>
                   
                  <div class="clearfix"></div>
                     
                </div>
			  
              <?php
                  
                   $fromurl="admin/masterlist/index";
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
                        <th width="15%">Profile Title</th>
                        <th width="10%">User Kind</th>
                        <th width="20%">Region</th>
                        <th width="10%">Affilate</th>
                        <th width="5%">Status</th>  
                       <?php
                        } 
                       ?>  
                       <?php
                        if($write==true)
                        {
                        ?> 
					    <th width="10%" data-hide="phone" data-sort-initial="false">Edit</th>
                        <th data-hide="phone" width="10%">
                        <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
                        
                        Select</th>
                         <th width="5%">Preview</th>  
                     <?php
                        }
                     ?>      
						<!--<th width="10%" data-hide="phone">Delete</th> -->
                      </tr>
                    </thead>
                    <tbody>
						<?php
						 if(!empty($results))
						   {  $sno=0;
							  foreach($results as $key => $objRow)
								  {
								  	 $sno++;
                                     $regions_arr;
                                              $strregion="";
                                              $tmpcounter=1;
                                             if(!empty($objRow['region_id']))
                                             {
                                                $tmp_arr=explode(",",$objRow['region_id']);
                                                $tmpcount=count($tmp_arr);
                                                if(!empty($tmp_arr))
                                                {
                                                   foreach($tmp_arr as $key => $value)
                                                   {  
                                                    if($tmpcounter < $tmpcount)
                                                    {
                                                        $str=",";
                                                    }else
                                                    {
                                                        $str=" ";
                                                    }
                                                     $strregion.=$regions_arr[$value].$str;
                                                     $tmpcounter++;
                                                    }  
                                                 } 
                                             } 
                                     
                                     $colrk = array('People profile'=>'success','Fun facts'=>'info','Me Me' => 'danger');
                                     $stas = array('1'=>'AVAILABLE','2'=>'PENDING','3' => 'READY','4'=> 'USED');
									?>
										 <tr>
                                            <?php
                                            if($read==true)
                                            {
                                            ?> 
											<td><?php echo $sno;?></td>
											<td>
                                            <a  href="#demo<?php echo $sno;?>_tip" onMouseOver="tooltip.pop(this, '#demo<?php echo $sno;?>_tip')">
                                            <?php 
                                            $de = mb_detect_encoding($objRow['title'], "UTF-8,ISO-8859-1");
			                                 $de = iconv($de, "UTF-8", $objRow['title']);
		                                      echo $title= stripslashes(html_entity_decode($de, ENT_QUOTES));
                                            
                                            ?>
                                            
                                            </a>
                                            <div style="display:none;">
                                                 <div id="demo<?php echo $sno;?>_tip">
                                                 <div class="row">
                                                  <div class="col-md-12">
                                                    
                                                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                         <?php  
                          
                                                           if(!empty($objRow["image"]) && file_exists(SITE_UPLOADPATH.$objRow["image"]) )
                                                           { 
                                                            ?>
                                                            
                                                             <?php
                                                             echo '<img src="'.SITE_GETUPLOADPATH."thumbs/".$objRow["image"].'?'.time().'" width="100%">'; 
                                                             ?>
                                                            
                                                          <?php }
                                                          ?>   
                                                       </div>
                                                      
                                                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <h4><?php echo $title; ?></h4> </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b>Region : </b><?php echo $strregion;?> </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b>User Kind: </b><?php echo $colrk[$objRow["kind"]];?> </div>
                                                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b> Category : </b><?php echo $objRow["kind"];?></div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b> Date of Birth :</b> <?php echo $objRow["dob"];?> </div> 
                                                         
                                                           
                                                      </div>
                                                    
                                                    </div>
                                                    <div class="col-md-12">
                                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b>You Tube : </b> </div>
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" > <?php echo $objRow["video"];?> </div>
                                                        
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b>Profile Details : </b> </div>
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" > <?php echo $objRow["description"];?></div>
                                                        
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b>Tags :</b>  <?php echo $objRow["tags"];?></div>
                                                         
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b>Facebook :</b>  <?php echo $objRow["facebook"];?></div>
                                                        
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b>Facebook fun page  :</b>  <?php echo $objRow["facebookfanpage"];?></div>
                                                        
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b>Twitter  : </b><?php echo $objRow["twitter"];?></div> 
                                                        
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b>Twitter fun page  : </b>  <?php echo $objRow["twitterfanpage"];?></div>
                                                        
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <b>Status  :</b> <?php echo $stas[$objRow["status"]];?></div>
                                                     
                                                    
                                                    </div>
                                                    
                                                    
                                                  </div>  
                                                   
                                                 </div>
                                            </div> 
                                            
                                            </td>
                                            
	    <td><button class="label btn-mini btn-<?php echo $colrk[$objRow["kind"]];?>" type="button"><?php echo $objRow["kind"];?></button></td>
                                            <td>
                                            
                                            <?php 
                                              
                                             echo $strregion;
                                            
                                            ?>
                                            
                                            </td>
                                            <td><?php echo $objRow['username'];?></td>
                                            <td>
                                            <?php $colr = array('1'=>'success','2'=>'warning','3' => 'ready','4'=> 'danger');?>
                                            <button class="btn btn-mini btn-<?php echo $colr[$objRow['status']];?>" type="button">
                                            <?php  echo $stas[$objRow['status']];?>
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
                                            
                                           <a href="<?=SITE_ADMIN_URL;?>masterlist/edit/<?=$objRow['id'];?>">
                                            <img src="<?php echo SITE_IMAGEURL ;?>editicon.gif">
                                            </a> 
                                            
                                            </td>
											<td>
											<input type="checkbox" name="selected[]" value="<?php echo $objRow['id']; ?>">  	
										 	</td> 
										    <td>
                                             <a class="btn btn-default btn-mini" href="<?=SITE_ADMIN_URL;?>masterlist/profiledetail/<?=$objRow['id'];?>">
                                            Preview </a> </td>
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
                           <input type="submit"  class="btn btn-success" value="AVAILABLE" name="btn_avaible">
	                        <input type="submit"  class="btn btn-warning" value="PENDING" name="btn_pending">
		                      <input type="submit" class="btn btn-ready" value="READY" name="btn_ready">
                            <?php if($this->session->userdata('sadmin') == '1'):?>
                            		 <input type="submit" class="btn btn-danger" value="PUBLISH" name="btn_publish">
                            <?php endif;?>		
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
       
 
      var table =$("#newtable").DataTable({
      "sDom": "<'row' <'col-xs-3'l><'col-xs-6'f>r>t<'row'<'col-xs-4'i><'col-xs-7'p> >",
      "aaSorting": [[2, "desc"]],
      //"pageLength": 10,
      // stateSave:true,
	  // "stateDuration": 60 * 60 * 24,
        "iDisplayLength": <?php echo $perpage;?>,
       // "bPaginate": true,
      // "pagingType": "full_numbers",
      // "sPaginationType":"full_numbers",
       // "bLengthChange": false,
        responsive: true,
        "bLengthChange": true,
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse(localStorage.getItem('offersDataTables'));
        },"language": {
			"lengthMenu": "_MENU_ <span class='hidden-xs'>records per page </span>"
	}
        
    });
  
    
   // $.fn.DataTable.ext.pager.numbers_length = 3;
  // $.fn.dataTableExt.oPagination.iFullNumbersShowPages(7,true); 
    //table.fnPageChange(6,true);
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
 