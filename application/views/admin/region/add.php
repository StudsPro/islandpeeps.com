<div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-title"><?=$page_action;?> <?=$page_title;?></h3>
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
                          <h3 class="panel-title"> <?php echo $id >0 ? "Edit" : "Add"; ?> Country</h3>
                        </div>
                <?php
                  $hidden = array("id"=>$id);
                  $fromurl= $id >0 ? "admin/regions/edit/".$id : "admin/regions/create";
                  $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                 echo form_open_multipart($fromurl, $attributes, $hidden);
                
                ?>
					<div class="panel-body">
						<fieldset>
							<div class="form-group">
								<label for="title" class="col-md-2 control-label">Country Name <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'name','id'=> 'name','value'=> set_value('name',$name),'class'=> 'form-control input-md','style' => '');
                               echo form_input($data);
                              ?>      
                             </div>
                             <?php echo form_error('name', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                                
                                </div>
                                <!--  banner only -->
                                <div class="form-group">
								    <label for="title" class="col-md-2 control-label">Country Banner Name <span class="require">*</span></label>
								    <div class="col-md-5">
        						    <?php
                                       $data = array('name'=> 'banner','id'=> 'banner','value'=> set_value('banner',$banner),'class'=> 'form-control input-md','style' => '');
                                       echo form_input($data);
                                      ?>      
                                    </div>
                                    <?php echo form_error('banner', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                                </div>
                                <!-- close-->
						  		<div class="form-group">
								<label for="title" class="col-md-2 control-label">Country Title <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'title','id'=> 'title','value'=> set_value('title',$title),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                             <?php echo form_error('title', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                                
                                </div>
                          	<div class="form-group">
								<label for="title" class="col-md-2 control-label">Independence Day</label>
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
								<label for="title" class="col-md-2 control-label"> Longitude </label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'longitude','id'=> 'longitude','value'=> set_value('longitude',$longitude),'class'=> 'form-control input-md','style' => '');
                               echo form_input($data);
                              ?>      
                             </div>
                          </div> 
                           <div class="form-group">
								<label for="title" class="col-md-2 control-label">  Latitude </label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'latitude','id'=> 'latitude','value'=> set_value('latitude',$latitude),'class'=> 'form-control input-md','style' => '');
                               echo form_input($data);
                              ?>      
                             </div>
                          </div>   
                           <div class="form-group">
								<label for="title" class="col-md-2 control-label">  Country Map Area </label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'ragion_map','id'=> 'ragion_map','value'=> set_value('ragion_map',$name),'class'=> 'form-control input-md','style' => '');
                               echo form_upload($data);
                              ?>   
                              
                              
                             </div>
                              <?php
                               if(!empty($ragion_map) && file_exists(SITE_UPLOADPATH.$ragion_map) )
                               {
                                ?>
                                <div class="col-md-3 text-center  " id="raggionmapimg">
                                 <?php
                                 echo '<img src="'.SITE_GETUPLOADPATH.$ragion_map.'?'.time().'" width="80" style="background:#000;">'; 
                                 ?>
                                 <br> <br>
                                 <button class="btn btn-danger btn-xs" onclick="removeimg('raggionmapimg','<?php echo $id;?>')" type="button">Remove</button>
                                </div>
                              <?php }
                              ?>   
                              
                            
                                <?php 
                                 if(!empty($images_error) && isset($images_error["remap_error"]))
                                 {
                                  echo '<div class="col-md-7 red text-center">'.$images_error["remap_error"].'</div>';
                                 }
                                 ?> 
                          </div>    
                           <div class="form-group">
								<label for="title" class="col-md-2 control-label">  Flag </label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'flag','id'=> 'flag','value'=> set_value('flag',$name),'class'=> 'form-control input-md','style' => '');
                               echo form_upload($data);
                              ?> 
                              <br>
                              <span style="color:#009100">Image dimension must be 300 X 180.</span>     
                             </div>
                             <?php
                               if(!empty($flag) && file_exists(SITE_UPLOADPATH.$flag) )
                               {
                                ?>
                                <div class="col-md-3 text-center" id="raggionflagimg">
                                 <?php
                                 echo '<img src="'.SITE_GETUPLOADPATH.$flag.'?'.time().'" width="80" >'; 
                                 ?>
                                 <br> <br>
                                 <button class="btn btn-danger btn-xs" onclick="removeimg('raggionflagimg','<?php echo $id;?>')" type="button">Remove</button>
                                </div>
                              <?php }
                              ?>   
                              <?php 
                                 if(!empty($images_error) && isset($images_error["flag_error"]))
                                 {
                                  echo '<div class="col-md-7 red text-center">'.$images_error["flag_error"].'</div>';
                                 }
                                 ?> 
                          </div>  
                          <div class="control-group">
                        		<strong>Flag Content</strong>
                        	</div>
                         	<div class="form-group">
								<label for="title" class="col-md-2 control-label">Motto</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'motto','id'=> 'motto','value'=> set_value('motto',$motto),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                            </div>    
                            <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Anthem</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'anthem','id'=> 'anthem','value'=> set_value('anthem',$anthem),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                            </div>   
                             <div class="form-group">
								<label for="title" class="col-md-2 control-label">  National Dish</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'national_dish','id'=> 'national_dish','value'=> set_value('national_dish',$national_dish),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                            </div>  
                             <div class="form-group">
								<label for="title" class="col-md-2 control-label">  Image </label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'image','id'=> 'image','value'=> set_value('image',$name),'class'=> 'form-control input-md','style' => '');
                               echo form_upload($data);
                              ?>  
                              <br>
                              <span style="color:#009100">Image dimension must be 490 X 300.</span>  
                                  
                             </div>
                              <?php
                               if(!empty($image) && file_exists(SITE_UPLOADPATH.$image) )
                               {
                                ?>
                                <div class="col-md-3 text-center" id="raggionimageimg">
                                 <?php
                                 echo '<img src="'.SITE_GETUPLOADPATH.$image.'?'.time().'" width="80" >'; 
                                 ?>
                                 <br> <br>
                                 <button class="btn btn-danger btn-xs" onclick="removeimg('raggionimageimg','<?php echo $id;?>')" type="button">Remove</button>
                                </div>
                              <?php }
                              ?>   
                             <?php 
                                 if(!empty($images_error) && isset($images_error["image_error"]))
                                 {
                                  echo '<div class="col-md-7 red text-center">'.$images_error["image_error"].'</div>';
                                 }
                                 ?> 
                          </div>  
                            
                              <div class="control-group">
                        		<strong> Court of Arms Circle Content </strong>
                        	</div>
                                  <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Capital</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'capital','id'=> 'capital','value'=> set_value('capital',$capital),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                            </div>  
                            
                            <div class="form-group">
							<label for="title" class="col-md-2 control-label">National language</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'language','id'=> 'language','value'=> set_value('language',$language),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                            </div>  
                            <div class="form-group">
							<label for="title" class="col-md-2 control-label">Population</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'population','id'=> 'population','value'=> set_value('population',$population),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                            </div>  
                              <div class="form-group">
							<label for="title" class="col-md-2 control-label">Short Desc</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'shortdesc','id'=> 'shortdesc','rows'=> '3','cols'=> '10','value'=> set_value('shortdesc',$shortdesc),'class'=> 'form-control input-md');
                               echo form_textarea($data);
                              ?>      
                             </div>
                            </div>  
                            
                              <div class="form-group">
								<label for="title" class="col-md-2 control-label">Population Cover Image</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'cover_image','id'=> 'cover_image','value'=> set_value('cover_image',$name),'class'=> 'form-control input-md','style' => '');
                               echo form_upload($data);
                              ?>  
                               <br>
                              <span style="color:#009100">Image dimension must be 200 X 200.</span>     
                             </div>
                              <?php
                               if(!empty($coverimage) && file_exists(SITE_UPLOADPATH.$coverimage) )
                               {
                                ?>
                                <div class="col-md-3 text-center" id="raggioncoverimg">
                                 <?php
                                 echo '<img src="'.SITE_GETUPLOADPATH.$coverimage.'?'.time().'" width="80" >'; 
                                 ?>
                                 <br> <br>
                                 <button class="btn btn-danger btn-xs" onclick="removeimg('raggioncoverimg','<?php echo $id;?>')" type="button">Remove</button>
                                </div>
                              <?php }
                              ?>   
                              
                             
                             <?php 
                                 if(!empty($images_error) && isset($images_error["coverimage_error"]))
                                 {
                                  echo '<div class="col-md-7 red text-center">'.$images_error["coverimage_error"].'</div>';
                                 }
                                 ?> 
                          </div>  
                          <div class="form-group">
							<label for="title" class="col-md-2 control-label">Content</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'content','id'=> 'content','rows'=> '11','cols'=> '10','value'=> set_value('content',$content),'class'=> 'form-control input-md');
                               echo form_textarea($data);
                              ?>      
                             </div>
                            </div>
                            
                             <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Status </label>
								<div class="col-md-5">
						    <?php
                                    $status_arr=array('1'=>"Active",'0'=>"Disabled");
                                    echo form_dropdown('status', $status_arr, $status,$getclass);    
                              
                              ?>      
                             </div>
                          </div> 
                          <div class="form-group">
								<label for="title" class="col-md-2 control-label">Twitter Description</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'twittershortdesc','id'=> 'twittershortdesc','value'=> set_value('twittershortdesc',$twittershortdesc),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                              </div>     
						     
						</fieldset>
					</div>
					<div class="panel-footer">
						<div class="form-group">
						  <div class="col-sm-offset-3 col-sm-9">
							<button type="button" class="btn btn-primary" id="savefrm">Submit</button>
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
 
 function removeimg(strflag,strgetid)
 {
    $.ajax({
                    
                   // dataType: 'JSON',
                    type: 'POST',
                    cache: false,
                    url:  '<?php echo base_url();?>admin/regions/deleteimage',
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
		  alert("Country Name should not be blank");
		  $('#name').val("");
		   $('#name').focus();
		   return false
		}
        if(check_trim('title')==false)
		{
		  alert("Country Title should not be blank");
		  $('#title').val("");
		   $('#title').focus();
		   return false
		} 
        $("#advanced-form").submit();
    });    
 </script>