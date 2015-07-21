<div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-title"><?=$page_title;?></h3>
             <!-- <ul class="breadcrumb breadcrumb-arrows breadcrumb-default">
                <li><a href="<?=SITE_ADMIN_URL;?>"><i class="fa fa-home fa-lg"></i></a></li>
				 <li><a href="<?=SITE_ADMIN_URL;?>memelist">Me Me</a></li>
                <li><a href="#ignore"><?=$page_action;?></a></li>
               </ul> -->
               <?php echo $breadcrumds;?>
            </div>
          </div>
        </div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			 <div class="panel panel-default">
			 	<!--<form id="advanced-form" class="form-horizontal"> -->
               
				
                        <div class="panel-heading">
                           <div class="col-md-3">
                          <h3 class="panel-title"> <?php echo $id >0 ? "Edit" : "Add"; ?> Profile</h3>
                          </div>
                          <div class="col-md-9 text-right"> 
                              <a id="AddMoreFileBox" class="btn btn-info" href="#">Add More Field</a>
                           </div>
                        </div>
                        <?php echo validation_errors(); ?>
					 <?php
                            $getclass="class='form-control input-md'";
                          $hidden = array("id"=>$id);
                          $fromurl= $id >0 ? "admin/masterlist/bulkprofile/".$id : "admin/masterlist/bulkprofile";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                         echo form_open_multipart($fromurl, $attributes, $hidden);
                        ?>
                      	<div class="panel-body">  
                         <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable no-footer" id="">
                                    <!-- BEGIN -->
                                    <thead>
                                        <tr>
                                             <th width="15%">Name</th>
                        		    <th width="20%">Region</th>
                        	            <th width="10%">User Kind</th>
                        		    <th width="10%">Image</th>
                         		    <th width="10%">Date Of Birth</th>
                                            <th width="10%">Profile Details</th>
                        		    <th width="10%">Status</th>
                        		    <th width="5%">Remove</th>
                                         </tr>
                                    </thead>
                                    <!-- END -->
                                    <!-- BEGIN -->
                                    <tbody id="addrows">
                        
                                  <tr>
                                    <td ><input type="text"  size="5" name="md_title[]" id="db__Title" class="form-control input-md"  value=""/></td>
                                    <td>
                                      <?php
                                             $getclass="class='form-control input-md'";
                                              echo form_multiselect('md_regions[0][]', $regions_arr, $regions,$getclass);    
                              
                                      ?>   
                                    </td>
                        	    <td><select name="md_kind[]" id="md_kind" class="form-control input-md"  tabindex="1">
                        			 <option value="People profile">People profile</option>
                        			 <option value="Fun facts">Fun facts</option>
                        			 <option value="Me Me" >Me Me</option>
                                      </select></td>
                                    <td><input type="file" class="form-control input-md"  name="db_image[]"  id="m__image"/>
                        		<br /><span style="color:#009100">Image dimension must be 1200 X 900.</span>
                        		</td>
                        	    <td style="width:15%;">
                        		<select name="month[]" class="form-control input-md" > <!-- To Select Day -->
                        			<option value="">Month</option>
                        			<?php $mon = array('Jan','Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec')?>
                        			<?php for($m=1;$m<=12;$m++){?>
                        			 <option value="<?php echo $m;?>" ><?php echo  $mon[$m-1]?></option>
                        			<?php }?> 
                                        </select>
                        		<select name="day[]" class="form-control input-md" > <!-- To Select Day -->
                        			<option value="">Day</option>
                        			<?php for($d=1;$d<=31;$d++){?>
                        			 <option value="<?php echo $d;?>" ><?php echo  $d?></option>
                        			<?php }?> 
                                        </select>
                        
                        		<select name="year[]" class="form-control input-md" > <!-- To Select Day -->
                        			<option value="">Year</option>
                        			 
                        			<?php for($y=1800;$y<=(date('Y')-1);$y++){?>
                        			 <option value="<?php echo $y;?>" ><?php echo  $y?></option>
                        			<?php }?> 
                                        </select>
                        	    </td>
                        	    <td><textarea name="db_description[]" id="m__description" rows="3" cols="50"class="form-control input-md" ></textarea></td>
                         	    <td><select name="md_status[]" id="md_status" class="form-control input-md"  tabindex="1">
                        			 <option value="1">select</option>
                        			 <option value="2">Pending</option> 
                        		</select></td>
                        	    <td>-</td>
                                  </tr>
                        
                                                </tbody>
                                    <!-- END -->
                                </table>
                             
                             
                    </div>	<!--- End Panel -->     
					
					
					<div class="panel-footer">
						<div class="form-group">
						  <div class="col-sm-offset-3 col-sm-9 pull-right">
							<button type="button" class="btn btn-primary" id="savefrm">Save</button>
                         
                          </div>
						</div>
                  </div>
                  
				<input type="hidden" name="dir" value="pages" />
				<input type="hidden" name="task" value="savememe" />

			<?php echo form_close();?>
			 </div>
		</div>
	</div>
</div>	
<?php
$option="";
foreach($regions_arr as  $regionid => $value)
{
    
  $option.='<option value="'.$regionid.'">'.$value.'</option>';   
}

?>
	
 <script>
$(document).ready(function() {

var MaxInputs       = 9; //maximum input boxes allowed
var InputsWrapper   = $("#addrows"); //Input boxes wrapper ID
var AddButton       = $("#AddMoreFileBox"); //Add button ID

var x = InputsWrapper.length; //initlal text box count
var FieldCount=1; //to keep track of text box added

$(AddButton).click(function (e)  //on add input button click
{
        if(x <= MaxInputs) //max input box allowed
        {
            FieldCount++; //text box added increment
            //add input box
            $(InputsWrapper).append('<tr><td ><input type="text"  size="5" name="md_title[]" class="form-control input-md" id="db__Title" value=""/></td><td><select name="md_regions['+x+'][]" multiple="multiple" id="md_region_id" class="form-control input-md" tabindex="1"><?php echo $option;?></select></td><td><select name="md_kind[]" id="md_kind" class="form-control input-md" tabindex="1"><option value="People profile" >People profile</option><option value="Fun facts">Fun facts</option><option value="Me Me" >Me Me</option></select></td><td><input type="file" class="form-control input-md" name="db_image[]"  id="m__image"/></td> <td style="width:15%;"><select name="month[]" class="form-control input-md"><option value="">Month</option><?php $mon = array('Jan','Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec')?><?php for($m=1;$m<=12;$m++){?><option value="<?php echo $m;?>" ><?php echo  $mon[$m-1]?></option><?php }?></select><select name="day[]" class="form-control input-md"><option value="">Day</option><?php for($d=1;$d<=31;$d++){?><option value="<?php echo $d;?>" ><?php echo  $d?></option><?php }?></select><select name="year[]" class="form-control input-md"><option value="">Year</option><?php for($y=1800;$y<=(date('Y')-1);$y++){?><option value="<?php echo $y;?>" ><?php echo  $y?></option><?php }?></select></td><td><textarea name="db_description[]" id="m__description" rows="3" cols="50" class="form-control input-md"></textarea></td><td><select name="md_status[]" id="md_status" class="form-control input-md" tabindex="1"><option value="1">select</option><option value="2">Pending</option></select></td><td><a href="#" class="removeclass">&times;</a></td></tr>');
            x++; //text box increment
        }
return false;
});

$("body").on("click",".removeclass", function(e){ //user click on remove text
        if( x > 1 ) {
                $(this).closest("tr").remove(); //remove text box
                x--; //decrement textbox
        }
return false;
});

$('#savefrm').bind('click',function(){
        $("#advanced-form").submit();
  });
});
</script>