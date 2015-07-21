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
                          <h3 class="panel-title"> <?php echo $id >0 ? "Edit" : "Add"; ?> Task</h3>
                        </div>
					 <?php
                            $getclass="class='form-control input-md'";
                          $hidden = array("id"=>$id);
                          $fromurl= $id >0 ? "admin/dashboard/addtask/".$id : "admin/dashboard/addtask";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                         echo form_open_multipart($fromurl, $attributes, $hidden);
                        ?>
                      	<div class="panel-body">  
                           <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Affiliate <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php  echo form_dropdown('radmin_id', $affilates, $radmin_id,$getclass); ?>      
                             </div>
                          </div>  
                           <div class="form-group">
								<label for="title" class="col-md-2 control-label">Task <span class="require">*</span></label>
								<div class="col-md-5">
						     <?php
                               $data = array('name'=> 'task','id'=> 'task','rows'=> '5','cols'=> '10','value'=> set_value('task',stripcslashes($task)),'class'=> 'form-control input-md');
                               echo form_textarea($data);
                              ?>            
                             </div>
                             <?php echo form_error('task', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                                
                                </div>
                    <div class="panel-footer">
						<div class="form-group">
						  <div class="col-sm-offset-3 col-sm-9">
							<button type="button" class="btn btn-primary" id="savefrm">Save</button>
						  </div>
						</div>
                  </div>
                
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
    
		if(check_trim('task')==false)
		{
		  alert("Task should not be blank");
		  $('#task').val("");
		   $('#task').focus();
		   return false
		}
     
        $("#advanced-form").submit();
    });    
 </script>