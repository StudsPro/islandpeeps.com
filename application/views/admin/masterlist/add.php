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
                          <h3 class="panel-title"> <?php echo $id >0 ? "Edit" : "Add"; ?> Profile</h3>
                        </div>
                        <?php echo validation_errors(); ?>
					 <?php
                            $getclass="class='form-control input-md'";
                          $hidden = array("id"=>$id);
                          $fromurl= $id >0 ? "admin/masterlist/edit/".$id : "admin/masterlist/create";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                         echo form_open_multipart($fromurl, $attributes, $hidden);
                        ?>
                      	<div class="panel-body">  
                         <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Select Region <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                                    
                                    echo form_multiselect('regions[]', $regions_arr, $regions,$getclass);    
                              
                              ?>      
                             </div>
                               <?php echo form_error('regions[]', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                          </div>
                          	<div class="form-group">
								<label for="title" class="col-md-2 control-label">Name <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'name','id'=> 'name','value'=> set_value('name',$name),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                             <?php echo form_error('name', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                                
                                </div>
                           <div class="form-group">
								<label for="title" class="col-md-2 control-label"> User Kind <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                                    $kindgetclass="class='form-control input-md' id='kind' "; 
                                    $kind_arr=array(''=>"--Select--",'People profile'=>"People profile",'Fun facts'=>"Fun facts",'Me Me'=>"Me Me");
                                    echo form_dropdown('kind', $kind_arr, $kind,$kindgetclass);    
                              
                              ?>      
                             </div>
                          </div>      
						   <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Category <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                                    $categetclass="class='form-control input-md' id='category' "; 
                                    echo form_dropdown('category', array(""=>"--Select--")+$categorys_arr, $category,$categetclass);    
                              
                              ?>      
                             </div>
                          </div> 
                         	<div class="form-group">
								<label for="title" class="col-md-2 control-label">Date of Birth</label>
								<div class="col-md-7">
                                <div class="col-md-3">
							    <?php
                                 $getclass="class='form-control input-md'";
                                $months = array('00'=>"Months",'01' => 'Jan.', '02' => 'Feb.', '03' => 'Mar.', '04' => 'Apr.', 
                                '05' => 'May', '06' => 'Jun.', '07' => 'Jul.', '08' => 'Aug.', '09' => 'Sep.', '10' => 'Oct.', '11' => 'Nov.', '12' => 'Dec.');
                                         
                                echo form_dropdown('month', $months, $month,$getclass);
                                 ?> 
                                </div> 
                                  <div class="col-md-2">
							    <?php
                                 foreach (range(1, 31) as $getday) {
                                     if(strlen($getday)<2)
                                     {
                                        $getday="0".$getday;
                                     }
                                                $days_arr[$getday]=$getday;
                                                
                                                }         
                                echo form_dropdown('day', array('00'=>"Days")+$days_arr, $day,$getclass);           
                                          
                                          
                                        ?> 
                                </div> 
                                  <div class="col-md-3">
							    <?php
                                 foreach (range(1800, date("Y")+1) as $getyear) {
                                      $getyear_arr[$getyear]=$getyear;
                                                
                                                }         
                                echo form_dropdown('year', array('0000'=>"Years")+$getyear_arr, $year,$getclass);           
                                          
                                          
                                        ?> 
                                </div> 
                              </div>
						  	</div>    	
                          <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Image</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'image','id'=> 'image','value'=> set_value('image',$image),'class'=> 'form-control input-md','style' => '');
                               echo form_upload($data);
                              ?> 
                              <br>
                              <span style="color:#009100">Image dimension must be 1200 X 900.</span>
                              <?php 
                                 if(!empty($images_error) && isset($images_error["masterlist_error"]))
                                 {
                                  echo '<div class="col-md-7 red text-center">'.$images_error["masterlist_error"].'</div>';
                                 }
                                 ?>   
                          </div>
                              <?php
                               if(!empty($image) && file_exists(SITE_UPLOADPATH.$image) )
                               { 
                                ?>
                                <div class="col-md-3 text-center  " id="raggionmapimg">
                                 <?php
                                 echo '<img src="'.SITE_GETUPLOADPATH.$image.'?'.time().'" width="80" >'; 
                                 ?>
                                 <br>  <br>
                                 <button class="btn btn-danger btn-xs" onclick="removeimg('raggionmapimg','<?php echo $id;?>')" type="button">Remove</button>
                                </div>
                              <?php }
                              ?>   
                              
                          </div>
                          <div class="control-group">OR</div>
                           	<div class="form-group">
								<label for="title" class="col-md-2 control-label">You Tube </label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'video','id'=> 'video','value'=> set_value('video',$video),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                             <div class="col-md-4">EX: http://www.youtube.com/watch?v=yFHjS6vuFI0&feature=player_embedded</div>
                                 <?php echo form_error('video', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                             </div>
                             
                            <div class="form-group">
							<label for="title" class="col-md-2 control-label"> Profile Details</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'profiledetail','id'=> 'profiledetail','rows'=> '8','cols'=> '10','value'=> set_value('profiledetail',stripcslashes($profiledetail)),'class'=> 'form-control input-md');
                               echo form_textarea($data);
                              ?>      
                             </div>
                            </div>  
                            <div class="form-group">
								<label for="title" class="col-md-2 control-label">Short Description</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'shortdesc','id'=> 'shortdesc','value'=> set_value('shortdesc',$shortdesc),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                              </div>   
                            <div class="form-group">
								<label for="title" class="col-md-2 control-label">Tags <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'tags','id'=> 'tags','value'=> set_value('tags',$tags),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                               <?php echo form_error('tags', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                             </div> 
                             <div class="form-group">
								<label for="title" class="col-md-2 control-label">Facebook</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'facebook','id'=> 'facebook','value'=> set_value('facebook',$facebook),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                               
                             </div> 
                             <div class="form-group">
								<label for="title" class="col-md-2 control-label">Facebook fan page </label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'facebookfunpage','id'=> 'facebookfunpage','value'=> set_value('facebookfunpage',$facebookfunpage),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                               
                             </div> 
                             <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Twitter</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'twitter','id'=> 'twitter','value'=> set_value('twitter',$twitter),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                               
                             </div> 
                             <div class="form-group">
								<label for="title" class="col-md-2 control-label">Twitter Description</label>
								<div class="col-md-5">
						      <?php
                              //stripcslashes($twittershortdesc) 
                               $data = array('name'=> 'twittershortdesc','id'=> 'twittershortdesc','rows'=> '4','cols'=> '10','value'=> set_value('twittershortdesc',stripcslashes($twittershortdesc)),'class'=> 'form-control input-md', 'maxlength'=> '120','onkeyup'=>'countChar(this)');
                               echo form_textarea($data);
                              ?>     
                                 <br>
                              <span style="color:#009100">120 characters limit.</span>   
                             </div>
                             <div class="col-md-2" id="charNum"></div>
                              </div> 
                              <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Twitter fan page </label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'twitterfunpage','id'=> 'twitterfunpage','value'=> set_value('twitterfunpage',$twitterfunpage),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                               
                             </div> 
                               <?php  // && $id ==0
                                if(( $this->session->userdata('sadmin') == '1' || $status=='1')):?>
                                       <div class="form-group" id="rejectblock">
								<label for="title" class="col-md-2 control-label">Status<span class="require">*</span></label>        
                                              	<div class="col-md-5">
                                		<select name="status" id="status"  tabindex="1" class="form-control input-md">
                                			 <option value="1" <?php if($status=='1') echo 'selected';?>>AVAILABLE</option>
                                			 <option value="2" <?php if($status=='2') echo 'selected';?>>PENDING</option>
                                			<?php if($this->session->userdata('sadmin') == '1'):?>
                                			 <option value="3" <?php if($status=='3') echo 'selected';?>>READY</option>
                                			 <option value="4" <?php if($status=='4') echo 'selected';?>>USED</option>
                                			<?php endif;?>	
                                		</select>
                                              </div>
                                           </div> 
                                
                                         
                                  <?php endif;?>  
                             
                             
                    </div>	<!--- End Panel -->     
					
					
					<div class="panel-footer">
						<div class="form-group">
						  <div class="col-sm-offset-3 col-sm-9">
							<button type="button" class="btn btn-primary" id="savefrm">Save</button>
                            <input type="reset" class="btn btn-danger" onchange="ResetJs();" value="Reset">
                            
                            <?php
                            // && $status=='2' && $this->session->userdata('sadmin') <> '1'
                             if($this->session->userdata('adminid') == $admin_id && $status=='2' && $this->session->userdata('sadmin') <> '1'):?>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                 <input type="button" value="Send to Admin Confirmation" id="submitforready" class="btn btn-ready"/>
                                <?php endif;?>
                                <?php if($status=='3' && $this->session->userdata('adminid') == '1'):?>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                 <input type="button" value="Reject" id="rejectreq" class="btn btn-ready"/>
                                <?php endif;?>
                                                            
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
 <script>
$( document ).ready(function() {

  $("#submitforready").on('click', function(){ 
       	$("#frmrequest").submit();
     });
 <?php if($status=='3' && $this->session->userdata('adminid') == '1'):?>
  $("#rejectreq").on('click', function(){
      if($('#md__rejectreason').length == 0){
	$("#rejectblock").after('<div class="control-group"><label class="col-md-2 control-label">Reason for rejection<span class="require">*</span></label><div class="controls"><textarea id="md__rejectreason" class="input-block-level span6" rows="5" cols="52" name="rejectreason"></textarea></div>');
	alert('Enter the Reason for rejection');
	return false;
        }
       // $("#saveform").trigger('click');
    });
<?php endif;?>


   $("#submitforready").on('click', function(){ 
        $.ajax({
                    
                   // dataType: 'JSON',
                    type: 'POST',
                    cache: false,
                    url:  '<?php echo base_url();?>admin/masterlist/changestatus',
                    data : {
                    strgetstatus : "3",
                    strgetid : '<?php echo $id;?>'
                    },
                    success: function(data){
                    //$("#postlist").html(data);		 
                
                    if(data=="Y")
                    {
                     
                    window.location.href="<?php echo base_url();?>admin/masterlist";
                       
                    }
                    return false;
                    }
                    });    
    
     });


});
 
 function removeimg(strflag,strgetid)
 {
    $.ajax({
                    
                   // dataType: 'JSON',
                    type: 'POST',
                    cache: false,
                    url:  '<?php echo base_url();?>admin/masterlist/deleteimage',
                    data : {
                    strflag : strflag,
                    strgetid : strgetid
                    },
                    success: function(data){
                    //$("#postlist").html(data);		 
                 
                    if(data=="Y")
                    {
                     
                     $("#"+strflag).remove(); 
                       
                    }
                    return false;
                    }
                    });    
    
 }
 
 	function check_trim(getstrid)
	{
	  if(!$.trim($('#'+getstrid).val()).length) {
                return false;
            }else
			{
				 return true;
			}
	}
  
  	
	$('#savefrm').bind('click',function(){

		if(check_trim('name')==false)
		{
		  alert("Name should not be blank");
		  $('#name').val("");
		   $('#name').focus();
		   return false
		}
        
        	if(check_trim('kind')==false)
		{
		  alert("User Kind should not be blank");
		  $('#kind').val("");
		   $('#kind').focus();
		   return false
		}
        
        	if(check_trim('category')==false)
		{
		  alert("Category should not be blank");
		  $('#category').val("");
		   $('#category').focus();
		   return false
		}
        
        	if(check_trim('tags')==false)
		{
		  alert("Tags should not be blank");
		  $('#tags').val("");
		   $('#tags').focus();
		   return false
		}
        
        $("#advanced-form").submit();
    });    
 </script>
 <script>
      function countChar(val) {
        var len = val.value.length;
        if (len >= 120) {
            len = val.value.length;
            $('#charNum').text(len);
          val.value = val.value.substring(0, 120);
        } else {
          $('#charNum').text(len);
        }
      };
    </script>