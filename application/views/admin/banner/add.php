<?php
if(!(isset($results['background_img']))){$results['background_img']="";}
if(!(isset($results['title'])))
{
	$results['title']="";
	$results['background']="";
	$results['image']="";
	$results['description']="";
}

$titleDisable='disabled';
$style="";
if($id <>6 && $id<>7 && $id<>8){$titleDisable='';}
if($id==7 || $id==8) {	$style='style="display:none"'; }
?>
<div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-title"><?=$page_titles;?></h3>
              <ul class="breadcrumb breadcrumb-arrows breadcrumb-default">
                <li><a href="<?=SITE_ADMIN_URL;?>"><i class="fa fa-home fa-lg"></i></a></li>
				 <li><a href="<?=SITE_ADMIN_URL;?>banner">Modify Banner</a></li>
                <li><a href="#ignore"><?=$page_action;?></a></li>
               </ul>
            </div>
          </div>
        </div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			 <div class="panel panel-default">
                 <div class="panel-heading">
                          <h3 class="panel-title"> <?php echo $id >0 ? "Edit" : "Add"; ?> Banner</h3>
                        </div>
			 	<form id="advanced-form" class="form-horizontal" enctype="multipart/form-data" onsubmit="return validateFrm(this);" method="post" name="frmContent">
					<div class="panel-body">
						<fieldset>
							<div class="form-group">
								<label for="title" class="col-md-2 control-label">Banner Title</label>
								<div class="col-md-5">
								  <input type="text" class="form-control input-md" name="md_title" id="m__Title" <?php echo $titleDisable;?> 
								  value="<?php echo html_entity_decode($results['title'], ENT_QUOTES);?>" />
								</div>
						  	</div>
							<div class="form-group">
								<label for="title" class="col-md-2 control-label">Slider Background Image</label>
								<div class="col-md-5">
									<input type="file" class="form-control input-md"  name="db_background_img" id="db_background_img" /><?php echo $results['background_img'];?>
								</div>
                                
                                 <?php
                              if(!empty($results['background_img']) && file_exists(SITE_UPLOADPATH.$results['background_img']) )
                               { 
                                ?>
                                <div class="col-md-3 text-center  " id="backgroundimg">
                                 <?php
                                 echo '<img src="'.SITE_GETUPLOADPATH.$results['background_img'].'?'.time().'" width="80" >'; 
                                 ?>
                                 <br>  <br>
                                 <button class="btn btn-danger btn-xs" onclick="removeimg('backgroundimg','<?php echo $id;?>')" type="button">Remove</button>
                                </div>
                              <?php } ?>
                                
						  	</div>  
							<div class="form-group" <?php echo $style;?>>
								<label for="title" class="col-md-2 control-label">Slider Background Video</label>
								<div class="col-md-5">
									<input type="file" class="form-control input-md"  name="db_background" id="db_background" /><?php echo $results['background'];?>
									<span class="help-inline"><small>Upload Video in MP4 format only.</small></span>
									<br />
									<br />
							</div>
						  	</div>		 
									<script src="<?=ADMIN_THEEM_JS;?>jwplayer/jwplayer.js"></script>  
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
								
							<?php
							if($id <>6 && $id<>7 && $id<>8)
							{
								?>
								<div class="form-group">
									<label for="title" class="col-md-2 control-label">Image</label>
									<div class="col-md-5">
										<input type="file" class="form-control input-md"  name="db_image" id="db_image" /><?php echo $results['image'];?>
									</div>
                                  <?php
                              if(!empty($results['image']) && file_exists(SITE_UPLOADPATH.$results['image']) )
                               { 
                                ?>
                                <div class="col-md-3 text-center  " id="dbimage"> 
                                 <?php
                                 echo '<img src="'.SITE_GETUPLOADPATH.$results['image'].'?'.time().'" width="80" >'; 
                                 ?>
                                 <br>  <br>
                                 <button class="btn btn-danger btn-xs" onclick="removeimg('dbimage','<?php echo $id;?>')" type="button">Remove</button>
                                </div>
                              <?php } ?>  
                                    
								</div>
								<div class="form-group">
									<label for="title" class="col-md-2 control-label">Description</label>
									<div class="col-md-5">
										<textarea    name="md_description" id="md_description" rows="12" class="form-control input-md"><?php if(isset($results['description'])){echo html_entity_decode($results['description']);}?></textarea>
									</div>
								</div>
								
								
										
								<?php
							}
							?>
						</fieldset>
					</div>
					<div class="panel-footer">
						<div class="form-group">
						  <div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-primary">Submit</button>
						  </div>
						</div>
                  </div>
				  <input type="hidden" name="id" value="<?php echo $id ?>"/>
				   <input type="hidden" name="dir" value="pages" />
<input type="hidden" name="task" value="save-banner" />
				</form>
			 </div>
		</div>
	</div>
</div>		

<script>

$( document ).ready(function() {

   $("#showvideo").click(function(){
    $("#showvideodata").toggle();
});

 
});
 

 $("#del_video").click(function() {
 	var id='';
/*	var arr = $('.Checkbox:checked').map(function() {
	id=id+','+$(this).attr("id");	
    return this.value; 
	}).get().join(', ');
	alert(arr);   */
	/*
	$.ajax({
		type: "POST",
		url: "'<?php echo base_url();?>admin/banner/del_video",
		data: { background : arr}
		})
		.done(function(json) {		
		alert( "Videos are Deleted  " + json );
		id =id.substring(1);
		var id1=id.split(",");
		
		//alert(id1[0]+id1[1]+id1[2]);
		//$.('#myElement_'+id[]).remove();
		$.each( id1, function( key, value ) {
		
		var k = value.split("_");
		//alert(k[0]+k[1]);
		$('.span5 #myElement_'+k[1]).remove();
		$('#text-center_'+k[1]).remove();
		$('#perent_'+k[1]).remove();
		 // alert( key + ": " + value );
		});
		});
        
        */
        
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
                    url:  '<?php echo base_url();?>admin/banner/del_video',
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
                    url:  '<?php echo base_url();?>admin/banner/deleteimage',
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
</script>