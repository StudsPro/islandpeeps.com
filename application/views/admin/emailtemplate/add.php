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
                          <h3 class="panel-title"> <?php echo $id >0 ? "Edit" : "Add"; ?> Email template</h3>
                        </div>
					 <?php
                            $getclass="class='form-control input-md'";
                          $hidden = array("id"=>$id);
                          $fromurl= $id >0 ? "admin/emailtemplate/edit/".$id : "admin/emailtemplate/create";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                         echo form_open_multipart($fromurl, $attributes, $hidden);
                        ?>
                      	<div class="panel-body">  
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
								<label for="title" class="col-md-2 control-label">From Mail <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'from_mail','id'=> 'from_mail','value'=> set_value('from_mail',$from_mail),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                             <?php echo form_error('from_mail', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                                
                             </div>  
                           <div class="form-group">
								<label for="title" class="col-md-2 control-label">Email Subject <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'subject','id'=> 'subject','value'=> set_value('subject',$subject),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                             <?php echo form_error('subject', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                                
                             </div>
                             <div class="form-group">
								<label for="title" class="col-md-2 control-label">Email Content <span class="require">*</span></label>
								<div class="col-md-8">
						          <?php
                               $data = array('name'=> 'temp_content','id'=> 'ckeditor','rows'=> '8','cols'=> '20','value'=> set_value('temp_content',stripcslashes($temp_content)),'class'=> 'form-control input-md');
                               echo form_textarea($data);
                              ?>    
                              
                                  
                             </div>
                             <?php echo form_error('temp_content', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                                
                             </div>     
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
<script src="<?=ADMIN_THEEM_JS?>plugins/wysihtml5/wysihtml5-0.3.0.min.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/ckeditor/ckeditor.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/marked/marked.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/to-markdown/to-markdown.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/bootstrap-markdown/bootstrap-markdown.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>demo/ui-elements.js"></script>
    <script>
      $(function() {
        UIElements.initWYSIWYGEditors();
        var isRTL = $("html").attr("dir") === "rtl" ? "rtl" : "ltr";
        CKEDITOR.replace('ckeditor', {
          contentsLangDirection: isRTL
        });
      });
    </script>	
 <script>
 function check_trim(getstrid)
	{
	  if(!$.trim($('#'+getstrid).val()).length) {
                return false;
            }else
			{
				 return true;
			}
	}
  
 	function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( $email ) ) {
    return false;
  } else {
    return true;
  }
} 	
	$('#savefrm').bind('click',function(){
 
		if(check_trim('title')==false)
		{
		  alert("Email title should not be blank");
		  $('#title').val("");
		   $('#title').focus();
		   return false
		}
       
       	if(check_trim('from_mail')==false)
		{
		  alert("From Email should not be blank");
		  $('#from_mail').val("");
		   $('#from_mail').focus();
		   return false
		}
       	if(validateEmail($('#from_mail').val())==false)
			{
			  alert("Email id should be right format (xx@xxx.com)");
			  
		   $('#from_mail').focus();
			   return false
			}	
        	if(check_trim('subject')==false)
		{
		  alert("Email Subject should not be blank");
		   $('#subject').val("");
		   $('#subject').focus();
		   return false
		}
     
        if(check_trim('ckeditor')==false)
		{
		  alert("Email Content should not be blank");
		   $('#ckeditor').val("");
		   $('#ckeditor').focus();
		   return false
		}
        
        $("#advanced-form").submit();
    });    
 </script>