<?php
$write=affilateright("suggestion","write");
$read=affilateright("suggestion","read");

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
                  <div class="clearfix">&nbsp;</div> 
                  <div class="col-md-12" >  
                    <div class="col-md-3 text-right" > 
                    <h4>Search in master list</h4>
                    </div>
                     <div class="col-md-4" style="margin-left: -15px;" >
                       <input type="text" class="form-control input-md" id="mastername" value="" name="mastername">
                       	<input type="hidden" id="master_id" name="master_id" />
                  </div>  
                   <div class="col-md-4" style="margin-left: -15px;" >
                       <div id="showmsg"> </div>
                   </div>
                  </div>  
                  <div class="clearfix">&nbsp;</div> 
			</div> 
            <div class="panel-body">
              <?php
                  
                   $fromurl="admin/suggestion/index";
                  $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                 echo form_open_multipart($fromurl, $attributes);
                ?>   
                
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
                        <th width="10%">User Name</th>
                        <th width="5%">Email</th>    
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
                        <?php
                      }
                      ?>  
                       
                       <?php
                       if($read==true)
                       {
                       ?> 
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
											<td><?php 
                                            $de = mb_detect_encoding($objRow['title'], "UTF-8,ISO-8859-1");
			                                 $de = iconv($de, "UTF-8", $objRow['title']);
		                                      echo  stripslashes(html_entity_decode($de, ENT_QUOTES));
                                            
                                            ?></td>
                                             <?php $colrk = array('People profile'=>'success','Fun facts'=>'info','Me Me' => 'danger');?>
	    <td><button class="label btn-mini btn-<?php echo $colrk[$objRow["kind"]];?>" type="button"><?php echo $objRow["kind"];?></button></td>
                                            <td>
                                            
                                            <?php 
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
                                             echo $strregion;
                                            
                                            ?>
                                            
                                            </td>
                                            <td><?php echo $objRow['gname'];?></td>
                                            <td>
                                            <?php echo $objRow['email'];?>
                                            </td>
                                          <?php
                                          }
                                          ?>
                                           <?php
                                           if($write==true)
                                           {
                                             ?>   
											<td>
                                            
                                           <a href="<?=SITE_ADMIN_URL;?>suggestion/edit/<?=$objRow['id'];?>">
                                            <img src="<?php echo SITE_IMAGEURL ;?>editicon.gif">
                                            </a> 
                                            
                                            </td>
											<td>
											<input type="checkbox" name="selected[]" value="<?php echo $objRow['id']; ?>">  	
										 	</td>
                                        <?php
                                        }
                                        ?>    
                                           <?php
                                           if($read==true)
                                           {
                                           ?>  
										    <td>
                                             <a class="btn btn-default btn-mini" href="<?=SITE_ADMIN_URL;?>suggestion/profiledetail/<?=$objRow['id'];?>">
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
                           <input type="submit"  class="btn btn-success" value="Add To Master List" name="btn_avaible">
	                       <input type="submit"  value="Delete" id="deleteall" onclick="document.frmListing.status.value='-1';" class="btn btn-danger" name="btn_delete">
                                            <?php
                                        }
                                        ?>  
                     </div>	
                
			  	<?php echo form_close();?>
             
                 </div> 
                       
                 </div> 
            </div>
            
           
          </div>
          	
        </div>
               
			 <!--main content   -->
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
    
    $( "#fillter" ).change(function() {

    window.location.href='<?php echo base_url()."admin/suggestion/index/"?>'+this.value;
});
    
    
    
    //*************************************
       $("#mastername").autocomplete({
               // source: "autosuggestions.php",
                source: function(request, response) {
			
        $.ajax({
          url: "<?php echo base_url()."admin/suggestion/search_masterlist/"?>",
		    type: 'POST',
			cache: false,
            dataType: "json",
          data: {
            term : request.term
           
          },
          success: function(data) {
		
            response(data);
          }
        });
      },
		        minLength: 1,
				cacheLength: 0,
                select: function(event, ui) {
					
                    $('#master_id').val(ui.item.id);
                   
                }
            });
 
    
    //*****************************************
    
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
 