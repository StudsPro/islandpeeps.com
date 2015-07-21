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
			 	<!--<form id="advanced-form" class="form-horizontal"> -->
               
				
                    <div class="panel-heading">
                          <h3 class="panel-title"> <?php echo $id >0 ? "Edit" : "Add"; ?> Site Settings</h3>
                        </div>
					 <?php
                            $getclass="class='form-control input-md'";
                          $hidden = array("id"=>$id);
                          $fromurl= $id >0 ? "admin/profile/sitesettings/".$id : "admin/profile/sitesettings";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                         echo form_open_multipart($fromurl, $attributes, $hidden);
                        ?>
                      	<div class="panel-body">  
                          <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Site name <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                                    $data = array('name'=> 'sitename','id'=> 'sitename','value'=> set_value('sitename',$sitename),'class'=> 'form-control input-md');
                               echo form_input($data);  
                              
                              ?>      
                             </div>
                               <?php echo form_error('sitename', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                          </div>      
						 		
                           
                         
                          
                          <div class="form-group" id="setemailcontent">
								<label for="title" class="col-md-2 control-label"> Site logo</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'image','id'=> 'image','value'=> set_value('image',$sitelogo),'class'=> 'form-control input-md','style' => '');
                               echo form_upload($data);
                              ?>   
                              
                              
                             </div>
                              <?php
                              if(!empty($sitelogo) && file_exists(SITE_UPLOADPATH.$sitelogo) )
                               { 
                                ?>
                                <div class="col-md-3 text-center  " id="raggionmapimg">
                                 <?php
                                 echo '<img src="'.SITE_GETUPLOADPATH.$sitelogo.'?'.time().'" width="80" >'; 
                                 ?>
                                 <br>  <br>
                                 <button class="btn btn-danger btn-xs" onclick="removeimg('raggionmapimg','<?php echo $id;?>')" type="button">Remove</button>
                                </div>
                              <?php }
                              ?>
                          </div>   
                       
                          </div>    
                            
                         
                           <div class="form-group">
								<label for="title" class="col-md-2 control-label">Admin E-mail <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'adminemail','id'=> 'adminemail','value'=> set_value('adminemail',$adminemail),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                               
                             </div>  
                            <div class="form-group">  
								<label for="title" class="col-md-2 control-label">Suggestion box E-mail<span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'suggestionbox_email','id'=> 'suggestionbox_email','value'=> set_value('suggestionbox_email',$suggestionbox_email),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                               
                             </div>  
                            <div class="form-group">
								<label for="title" class="col-md-2 control-label">Meta Title</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'metatitle','id'=> 'metatitle','value'=> set_value('metatitle',$metatitle),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                               
                             </div> 
                             <div class="form-group">
								<label for="title" class="col-md-2 control-label">Meta Tag</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'metatag','id'=> 'metatag','value'=> set_value('metatag',$metatag),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                               
                             </div> 
                             
                              <div class="form-group">
							<label for="title" class="col-md-2 control-label">Meta Description</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'metadescription','id'=> 'metadescription','rows'=> '3','cols'=> '10','value'=> set_value('metadescription',$metadescription),'class'=> 'form-control input-md');
                               echo form_textarea($data);
                              ?>      
                             </div>
                            </div>
                            
                            <div class="form-group">
							<label for="title" class="col-md-2 control-label">Dashboard Notification</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'dnotification','id'=> 'dnotification','rows'=> '3','cols'=> '10','value'=> set_value('dnotification',$dnotification),'class'=> 'form-control input-md');
                               echo form_textarea($data);
                              ?>      
                             </div>
                            </div>
                            <div class="form-group">
							<label for="title" class="col-md-2 control-label">Help</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'cnotification','id'=> 'cnotification','rows'=> '3','cols'=> '10','value'=> set_value('cnotification',$cnotification),'class'=> 'form-control input-md');
                               echo form_textarea($data);
                              ?>      
                             </div>
                            </div>
                             <div class="form-group">
							<label for="title" class="col-md-2 control-label">Master List Help</label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'mnotification','id'=> 'mnotification','rows'=> '3','cols'=> '10','value'=> set_value('mnotification',$mnotification),'class'=> 'form-control input-md');
                               echo form_textarea($data);
                              ?>      
                             </div>
                            </div>
                            <div class="form-group">
							<label for="title" class="col-md-2 control-label">Help page content</label>
								<div class="col-md-8">
						    <?php
                               $data = array('name'=> 'helpcontent','id'=> 'ckeditor','rows'=> '11','cols'=> '10','value'=> set_value('helpcontent',$helpcontent),'class'=> 'form-control input-md');
                               echo form_textarea($data);
                              ?>      
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
                      
 function removeimg(strflag,strgetid)
 {
    $.ajax({
                    
                   // dataType: 'JSON',
                    type: 'POST',
                    cache: false,
                    url:  '<?php echo base_url();?>admin/profile/deletesitelogoimage',
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
  	function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( $email ) ) {
    return false;
  } else {
    return true;
  }
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
  // username  userpass  email siteemail siteemailpass
  	
	$('#savefrm').bind('click',function(){



    //   adminemail  suggestionbox_email
		if(check_trim('sitename')==false)
		{
		  alert("Site name should not be blank");
		  $('#sitename').val("");
		   $('#sitename').focus();
		   return false
		}
       
        	if(check_trim('adminemail')==false)
		{
		  alert("Admin Email should not be blank");
		  $('#adminemail').val("");
		   $('#adminemail').focus();
		   return false
		}
        
           if(validateEmail($('#adminemail').val())==false)
        			{
        			 alert("Site Email should be right format (xxx@xxx.domain)");
                     $('#adminemail').focus();
			          return false
        			}	
        
        	if(check_trim('suggestionbox_email')==false)
		{
		  alert("Suggestion box  Email should not be blank");
		  $('#suggestionbox_email').val("");
		   $('#suggestionbox_email').focus();
		   return false
		}
        
           if(validateEmail($('#suggestionbox_email').val())==false)
        			{
        			 alert("Suggestion box Email should be right format (xxx@xxx.domain)");
                     $('#suggestionbox_email').focus();
			          return false
        			}
        	
           
                
        $("#advanced-form").submit();
    });    
 </script>