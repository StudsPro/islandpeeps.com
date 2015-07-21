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
                          <h3 class="panel-title"> <?php echo $id >0 ? "Edit" : "Add"; ?> Affiliate</h3>
                        </div>
					 <?php
                            $getclass="class='form-control input-md'";
                          $hidden = array("id"=>$id);
                          $fromurl= $id >0 ? "admin/affiliate/edit/".$id : "admin/affiliate/create";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                         echo form_open_multipart($fromurl, $attributes, $hidden);
                        ?>
                      	<div class="panel-body">  
                          <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Username <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                                    $data = array('name'=> 'username','id'=> 'username','value'=> set_value('username',$username),'class'=> 'form-control input-md');
                               echo form_input($data);  
                              
                              ?>      
                             </div>
                               <?php echo form_error('username', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                          </div>      
						 		<div class="form-group">
								<label for="title" class="col-md-2 control-label">Password <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'userpass','id'=> 'userpass','value'=> set_value('userpass',$userpass),'class'=> 'form-control input-md');
                               echo form_password($data);
                              ?>      
                             </div> 
                             <?php echo form_error('userpass', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                                
                                </div>
                             <div class="form-group">
								<label for="title" class="col-md-2 control-label"> E-mail<span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'email','id'=> 'email','value'=> set_value('email',$email),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                             <?php echo form_error('email', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                                
                              
                             </div> 
                         <?php
                           $counter=1;
                          foreach($siteemail as $key => $value)
                          {
                         ?> 
                             <?php 
                             if($counter>1)
                             {
                             ?> 
                                 <div id="newmailcontent_<?php echo $counter; ?>">
                             <?php
                             }
                             ?> 
                          <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Site Email<span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'siteemail[]','id'=> 'siteemail','value'=> set_value('siteemail[]',$value),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>      
                             </div>
                             <?php //echo form_error('siteemail', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                         </div>
                             
                          <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Site Email Password<span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'siteemailpass[]','id'=> 'siteemailpass','value'=> set_value('siteemailpass[]',$siteemailpass[$key]),'class'=> 'form-control input-md');
                               echo form_password($data);
                              ?>      
                             </div>
                            <?php 
                             if($counter==1)
                             {
                             ?> 
                             <div class="col-md-5">
                                  <a href="javascript:void(0);" id="addmore" class="btn btn-primary hidden-xs">
                                    <span class="fa fa-pencil"></span>Add more E-mail</a>
                             </div>
                             <?php } ?> 
                             
                              <?php 
                             if($counter>1)
                             {
                             ?> 
                                  <a href="javascript:void(0)" alt="Remove" title="Remove" onclick="removenew('<?php echo $counter ?>')">x</a>
                                 
                             <?php
                             }
                             ?> 
                         </div> 
                             <?php 
                             if($counter>1)
                             {
                             ?> 
                                 
                                 </div>
                             <?php
                             }
                             ?> 
                          <?php
                             $counter++;
                          }
                          ?>
                         
                          
                          <div class="form-group" id="setemailcontent">
								<label for="title" class="col-md-2 control-label"> Type <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                                    $status_arr=array('0'=>"Affiliate",'1'=>"Super admin");
                                    echo form_dropdown('type', $status_arr, $type,$getclass);    
                              
                              ?>      
                             </div>
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
 <script>
  var strcounter='<?php echo $counter+1;?>'; 
  var html=""; 
  $(document).ready(function() {
       
     $('#addmore').bind('click',function(){  
     html='<div id="newmailcontent_'+strcounter+'"><div class="form-group"><label class="col-md-2 control-label" for="title"> Site Email<span class="require">*</span></label><div class="col-md-5">';
     html+='<input type="text" class="form-control input-md" id="siteemail_'+strcounter+'" value="" name="siteemail[]"></div></div>';
      
     html+='<div class="form-group"><label class="col-md-2 control-label" for="title"> Site Email Password<span class="require">*</span></label><div class="col-md-5">';                        
     html+='<input type="password" class="form-control input-md" id="siteemailpass" value="" name="siteemailpass[]"></div><a href="javascript:void(0)" alt="Remove" title="Remove" onclick="removenew('+strcounter+')">x</a></div></div>';
       
     $("#setemailcontent").before(html);    
      strcounter++; 
       
       
     });  
       
    });  
    
  function removenew(strid)
  {
    $("#newmailcontent_"+strid).remove();
    
  }                           
 function removeimg(strflag,strgetid)
 {
    $.ajax({
                    
                   // dataType: 'JSON',
                    type: 'POST',
                    cache: false,
                    url:  '<?php echo base_url();?>admin/affiliate/deleteimage',
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



    
		if(check_trim('username')==false)
		{
		  alert("Username should not be blank");
		  $('#username').val("");
		   $('#username').focus();
		   return false
		}
        
        	if(check_trim('userpass')==false)
		{
		  alert("Password should not be blank");
		  $('#userpass').val("");
		   $('#userpass').focus();
		   return false
		}
        
        	if(check_trim('email')==false)
		{
		  alert("Email should not be blank");
		  $('#email').val("");
		   $('#email').focus();
		   return false
		}
        
           if(validateEmail($('#email').val())==false)
        			{
        			 alert("Email should be right format (xxx@xxx.domain)");
                     $('#email').focus();
			          return false
        			}	
        
        
        	var emailempty = 0;
            var notrightemailformat = 0;
            $('input[name=\'siteemail[]\']').each(function(){
               if (this.value == "") {
                emailempty++
               }
               
                	if(validateEmail(this.value)==false)
        			{
        			  notrightemailformat++;
        			}	
                
            });
        
           if(emailempty>0)
           {
             alert("Site Email should not be blank");
             return false
           }
           
           if(notrightemailformat>0)
           {
             alert("Site Email should be right format (xx@xxx.domain)");
             return false
           }
           
           var emailpassempty = 0;
            $('input[name=\'siteemail[]\']').each(function(){
               if (this.value == "") {
                emailpassempty++
               }
            });
        
           if(emailpassempty>0)
           {
             alert("Site Password should not be blank");
             return false
           }
                
        $("#advanced-form").submit();
    });    
 </script>