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
                          <h3 class="panel-title"> <?php echo $id >0 ? "Edit" : "Add"; ?> Ad</h3>
                        </div>
					 <?php
                            $getclass="class='form-control input-md'";
                          $hidden = array("id"=>$id);
                          $fromurl= $id >0 ? "admin/ads/edit/".$id : "admin/ads/create";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                         echo form_open_multipart($fromurl, $attributes, $hidden);
                        ?>
                      	<div class="panel-body">  
                        <?php
                        if($id==7) //  this work for background image 
                        {
                        ?>
                             <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Ad Video/Image<span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'image','id'=> 'image','value'=> set_value('image',$image),'class'=> 'form-control input-md','style' => '');
                               echo form_upload($data);
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
                              
                        }
                        else{
                        ?>
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
								<label for="title" class="col-md-2 control-label"> Ad Size <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                                    $status_arr=array('1'=>"Big Video",'2'=>"Small");
                                    echo form_dropdown('type', $status_arr, $type,$getclass);    
                              
                              ?>      
                             </div>
                          </div>      
						 		<div class="form-group">
								<label for="title" class="col-md-2 control-label">Title <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'title','id'=> 'title','value'=> set_value('title',$title),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                             <?php echo form_error('title', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                                
                                </div>
                          <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Ad Video/Image<span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'image','id'=> 'image','value'=> set_value('image',$image),'class'=> 'form-control input-md','style' => '');
                               echo form_upload($data);
                              ?>   
                              
                              
                             </div>
                              <?php
                               echo $image;
                             $arrimg_value=array(".jpg",".jpeg",".png",".bmp"); 
                              if(in_array($ext,$arrimg_value))
                             {  
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
                              
                             } 
                              ?>  
                                <script src="<?=ADMIN_THEEM_JS;?>jwplayer/jwplayer.js"></script>   
                              <?php
                             
                             $arrvideo_value=array(".mp41",".flv1",".bat1"); 
                             if(in_array($ext,$arrvideo_value))
                             { 
                               if(!empty($image) && file_exists(SITE_UPLOADPATH.$image) )
                               {
                                ?>
                            
                            
                                <div class="col-md-3 text-center  " id="raggionmapimg">
                                  <div id="showvideo">Loading the player...</div>  
							
							<script type="text/javascript">
								jwplayer("showvideo").setup({
								file: "<?php echo SITE_GETUPLOADPATH.''.$image;?>",
								image: "<?php echo SITE_GETUPLOADPATH;?>14097457041394567990Tropical-Island-Panorama-1920x1080.jpg"
								 });
							</script>    
                                 <br>  <br>
                                 <button class="btn btn-danger btn-xs" onclick="removeimg('raggionmapimg','<?php echo $id;?>')" type="button">Remove</button>
                                </div>
                              <?php }
                              
                             } 
                              ?>    
                            
                                <?php 
                                 if(!empty($images_error) && isset($images_error["ads_error"]))
                                 {
                                  echo '<div class="col-md-7 red text-center">'.$images_error["ads_error"].'</div>';
                                 }
                                 ?> 
                          </div> 
                          
                          <!-------------------->
                          <?php
                          if($id==1 || $id==8)
                          {
                          ?>
                                   			 
						   <div class="form-group" >
								<label for="title" class="col-md-2 control-label">&nbsp;</label>
								<div class="col-md-5">
							       <a href="javascript:void(0)" class="btn btn-primary hidden-xs" id="showvideo" >Browser</a>	
							    </div>
						  	</div>	
                           
                              <div class="form-group" id="showvideodata" style="display:none">
								<label for="title" class="col-md-2 control-label">&nbsp;</label> 			
									<div class="col-md-10">
                                      <div class="row">
                                        	<div class="col-md-12 ">
									         <input type="button" value="Delete selected Videos" class="btn btn-xs btn-danger" name="btn_delete" id="del_video">
										</div>
                                        <div class="clearfix">&nbsp;</div>
										<div class="col-md-12" >
										  	 <?php 
													$dir = SITE_UPLOADPATH;
													$files1=array();
													$dh = scandir($dir);
													foreach($dh as $key=>$value)
													{
													   $ext = substr($value, strrpos($value, '.') + 1);
													   if($ext=="mp4") {$files1[] = $value;}
													}
													$k=1;
                                                    if(!empty($files1))
                                                    {
													foreach ($files1 as $key => $value) 
														{
															$k++;
															$value1=explode('.',$value);
													  		?>
															<div class="col-md-5" id="perent_<?php echo $k; ?>">
																<div id="myElement_<?php echo $k; ?>">Loading the player...</div>  
																	<script type="text/javascript">
																		jwplayer("myElement_<?php echo $k; ?>").setup({
																		file: "<?php echo SITE_GETUPLOADPATH.''.$value;?>",
																		image: "<?php echo SITE_GETUPLOADPATH;?>14097457041394567990Tropical-Island-Panorama-1920x1080.jpg"
																		 });
																	</script>               
																	<div class="text-center" id="text-center_<?php echo $k; ?>">  
																	<span><?php echo $value; ?></span> <br />       
																	<input type="radio" name="video_name" value="<?php echo $value;?>">&nbsp;&nbsp; Select video /  
																	<input type="checkbox" value="<?php echo $value;?>" id="<?php echo $k; ?>" name="delete[]" class="Checkbox" 
																	id="check_<?php echo $k; ?>">&nbsp;&nbsp; Delete
																</div>
															</div>
															<div class="clear"></div>
														<?php 
														}
                                                        
                                                      }  
													?>
										</div>
										 
									  </div>
									</div>
                                 </div>
                          
                          
                          <!----------------------->
                           <?php 
                           }
                           
                          } 
                           ?>  
                       
					</div>	     
					
					
					<div class="panel-footer">
						<div class="form-group">
						  <div class="col-sm-offset-3 col-sm-9">
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
 <script>


   $("#showvideo").click(function(){ 
    $("#showvideodata").toggle();
});

 

 

 $("#del_video").click(function() {
 	var id='';
    var val = [];
    var delvar=[];
    $('.Checkbox:checkbox:checked').each(function(i){
      val[i] = $(this).val();
      delvar[i]=$(this).attr("id"); 
    });
   
  
       
        
        $.ajax({
                    
                   // dataType: 'JSON',
                    type: 'POST',
                    cache: false,
                    url:  '<?php echo base_url();?>admin/ads/del_video',
                    data : {
                    deletedata : val
                    },
                    success: function(data){
                    //$("#postlist").html(data);		 
               
                   
                    $.each(delvar, function( index, value ) {
                    $("#perent_"+value).remove();
                    });
                    if(data=="Y")
                    {
                     
                     $("#"+strflag).remove(); 
                       
                    }
                    return false;
                    }
                    });     
        
	});
 function removeimg(strflag,strgetid)
 {
    $.ajax({
                    
                   // dataType: 'JSON',
                    type: 'POST',
                    cache: false,
                    url:  '<?php echo base_url();?>admin/ads/deleteimage',
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
      <?php if($id !=7)
       {
      ?>
		if(check_trim('title')==false)
		{
		  alert("Ad title should not be blank");
		  $('#title').val("");
		   $('#title').focus();
		   return false
		}
      <?php
       }
      ?>
        $("#advanced-form").submit();
    });    
 </script>