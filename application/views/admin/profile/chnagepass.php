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
                          <h3 class="panel-title"> <?php echo $id >0 ? "Edit" : "Add"; ?> Password</h3>
                        </div>
					 <?php
                            $getclass="class='form-control input-md'";
                          $hidden = array("id"=>$id);
                          $fromurl= $id >0 ? "admin/profile/changepassword/".$id : "admin/profile/changepassword";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                         echo form_open_multipart($fromurl, $attributes, $hidden);
                        ?>
                      	<div class="panel-body">  
                          <div class="form-group">
								<label for="title" class="col-md-2 control-label">Old Password <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'olduserpass','id'=> 'olduserpass','value'=> set_value('olduserpass',''),'class'=> 'form-control input-md');
                               echo form_password($data);
                              ?>      
                             </div> 
                             <?php echo form_error('olduserpass', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                                
                                </div>
						 		
                             <div class="form-group">
								<label for="title" class="col-md-2 control-label">New Password <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'newuserpass','id'=> 'newuserpass','value'=> set_value('newuserpass',''),'class'=> 'form-control input-md');
                               echo form_password($data);
                              ?>      
                             </div> 
                             <?php echo form_error('newuserpass', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                                
                                </div>
                                <div class="form-group">
								<label for="title" class="col-md-2 control-label">Confirm Password <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'confirmuserpass','id'=> 'confirmuserpass','value'=> set_value('confirmuserpass',''),'class'=> 'form-control input-md');
                               echo form_password($data);
                              ?>      
                             </div> 
                             <?php echo form_error('confirmuserpass', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                                
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
</div>
 <script>
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

 
        	if(check_trim('olduserpass')==false)
		{
		  alert("Old Password should not be blank");
		  $('#olduserpass').val("");
		   $('#olduserpass').focus();
		   return false
		}
       if(check_trim('newuserpass')==false)
		{
		  alert("New Password should not be blank");
		  $('#newuserpass').val("");
		   $('#newuserpass').focus();
		   return false
		}
        if(check_trim('confirmuserpass')==false)
		{
		  alert("Confirm Password should not be blank");
		  $('#confirmuserpass').val("");
		   $('#confirmuserpass').focus();
		   return false
		}
        
        if($('#newuserpass').val() != $('#confirmuserpass').val()) {
            alert("New Password and Confirm Password don't match");
            return false
        }
           
                
        $("#advanced-form").submit();
    });    
 </script>