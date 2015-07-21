<div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-title"><?=$page_title;?></h3>
              <!--<ul class="breadcrumb breadcrumb-arrows breadcrumb-default">
                <li><a href="<?=SITE_ADMIN_URL;?>"><i class="fa fa-home fa-lg"></i></a></li>
                <li><a href="#ignore">Country(s) Listing  </a></li>
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
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title" style="color:#FFF;">Email inbox</h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <!-- BEGIN LEFT PANEL-->
                    <div class="col-md-2 left-inbox">
                      <a id="compose-button" href="#" class="btn btn-block btn-primary">Compose</a>
                      <div  class="list-group">
                        <a href="<?php echo base_url()."admin/imailboxs";?>"  class="list-group-item "><i class="fa fa-inbox"></i>&nbsp;Inbox </a>
                      
                        <a href="<?php echo base_url()."admin/imailboxs/adminsendmails";?>"  class="list-group-item active"><i class="fa fa-sign-in"></i>&nbsp;Sent</a>
                        
                      </div>
                    </div>
                    <!-- END LEFT PANEL-->
                    <!-- BEGIN RIGHT PANEL-->
                    <div class="col-md-10 right-inbox">
                      
                       <?php 
							  //echo "<pre>";
							  //   echo "<pre>";
        //print_r($viewmails);
       // print_r($viewmails_data);
       // exit;
                                 if($viewmails[0]["sadmin_id"] <> $this->session->userdata('adminid'))
							     { 
								$replyid = $viewmails[0]["sadmin_id"];
								$replyuname =  $viewmails[0]["suname"].'&lt;'.$viewmails[0]["semail"].'&gt';
							     }else{
								
								$replyid = $viewmails[0]["radmin_id"];
								$replyuname =  $viewmails[0]["runame"].'&lt;'.$viewmails[0]["remail"].'&gt';
							     } 
        
							 // print_r($results); exit;
					
							  ?>  
                        
                      
                      <div class="tab-content">
                        <div id="inbox" class="panel panel-default tab-pane active">
                          <!-- BEGIN HEADER INBOX-->
                          
                                   
							  
							  
                         
                          <!-- END HEADER INBOX-->
                          <div class="panel-body ">
                             <div class="col-md-12">
                                   <!---- Reply ---->
                                          <div style="display:none" class="vmail col-md-12" id="reply">
		          <!-- BEGIN HEADER INBOX -->
		          <div class="header">
		            <button  id="replysubmit" class="btn btn-success"><i class="icon-ok"></i> Send</button>
		          </div>
		          <!-- END HEADER INBOX -->
		          <div class="body">
                   <?php
                            $getclass="class='form-control input-md'";
                         
                          $fromurl= "admin/imailboxs/reply";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'reply-form');
                         echo form_open_multipart($fromurl, $attributes);
                        ?>
		          
		            <div class="form-group">
		              <label class="control-label col-md-2" for="inputRecipients">To</label>
		              <div class="col-md-7">
					<?php echo $replyuname; ?>
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-md-2" for="inputSubject">Subject</label>
		              <div class="col-md-7">
		                <input type="text" class="form-control input-md" id="md_subject" name="md_subject" placeholder="Subject" value="<?php echo $viewmails[0]["subject"]?>">
		              </div>
		            </div>
		            <div class="form-group">
		              <div class="">
		                <textarea  id="ckeditor" name="db_message" class="input-block-level">
		                 </textarea>
		              </div>
		            </div>
				<input type="hidden" name="md_radmin_id" value="<?php echo $replyid?>" />
				<input type="hidden" name="md_pid" value="<?php echo $viewmails[0]["id"];?>" />
				<input type="hidden" name="task" value="sendadminmail" />
				
		         <?php echo form_close();?>


		          </div>
		          
		        </div>
                                   <!-----Reply End---->
                             <!-----forward start---->
							   	<div style="display:none" class="vmail col-md-12" id="forward">
		          <!-- BEGIN HEADER INBOX -->
		          <div class="header">
		            <button  id="forwardfrm" class="btn btn-success"><i class="icon-ok"></i> Send</button>
		          </div>
		          <!-- END HEADER INBOX -->
		          <div class="body">

		          <?php
                            $getclass="class='form-control input-md'";
                         
                          $fromurl= "admin/imailboxs/forward";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'forward-form');
                         echo form_open_multipart($fromurl, $attributes);
                        ?>
		         
		            <div class="form-group">
		              <label class="control-label col-md-2" for="inputRecipients">To</label>
		              <div class="col-md-7">
		                <select tabindex="1" class="form-control input-md" id="md_radmin_id" name="md_radmin_id">
					<?php echo $adminuser_data; ?>
				</select>
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-md-2" for="inputSubject">Subject</label>
		              <div class="col-md-7">
		                <input type="text" class="form-control input-md" id="md_subject" name="md_subject" placeholder="Subject" value="<?php echo $viewmails[0]["subject"]?>">
		              </div>
		            </div>
		            <div class="form-group">
		              <div class="">
		                <textarea  id="ckeditor2"  id="md_message" name="db_message" class="input-block-level">
					 <?php echo html_entity_decode($viewmails[0]["message"])?>
		                 </textarea>
		              </div>
		            </div>
				<input type="hidden" name="md_fid" value="<?php echo $viewmails[0]["id"];?>" />
				<input type="hidden" name="task" value="sendadminmail" />
		         <?php echo form_close();?>


		          </div>
		          
		        </div>
							 
							 <!-----forward End---->      
                          <!--- Compose---->
                                <div style="display:none" class="vmail col-md-12"  id="compose">
		          <!-- BEGIN HEADER INBOX -->
		          <div class="header">
		            <button  id="composefrom" class="btn btn-success"><i class="icon-ok"></i> Send</button>
		          </div>
		          <!-- END HEADER INBOX -->
		          <div class="body">

		          
		          <?php
                            $getclass="class='form-control input-md'";
                         
                          $fromurl= "admin/imailboxs/compose";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'compose-form');
                         echo form_open_multipart($fromurl, $attributes);
                        ?>
		            
				<div class="clearfix">&nbsp;</div>
					<div class="form-group">
		              <label class="control-label col-md-2" for="inputRecipients">To</label>
		              <div class="col-md-7">
		                <select tabindex="1" class="form-control input-md" id="md_radmin_id" name="md_radmin_id">
					<?php echo $adminuser_data; ?>
				</select>
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-md-2" for="inputSubject">Subject</label>
		              <div class="col-md-7">
		                <input type="text" class="form-control input-md" id="md_subject" name="md_subject" placeholder="Subject">
		              </div>
		            </div>
		            <div class="form-group">
		              <div class="col-md-10">
		                <textarea id="ckeditor3" id="md_message" name="db_message" class="input-block-level">
		                 </textarea>
		              </div>
		            </div>
				<input type="hidden" name="task" value="sendadminmail" />
		         <?php echo form_close();?>


		          </div>
		          
		        </div>
                          <!---- End Compose ---->
                            <!-- BEGIN EMAILS LIST-->
                                    <div id="email-content" class="col-md-9">   
									 <div class="header row-fluid">
                   
			                    <div class="col-md-8">
			                      <!-- BEGIN EMAIL ACTIONS -->
			                
			                      <a href="javascript:void(0);" id="showreply" data-toggle="tab" class="btn btn-primary"><i class="icon-mail-reply"></i> Reply</a>
			                      <a href="javascript:void(0);" id="showforward" data-toggle="tab" class="btn btn-primary"><i class="icon-mail-forward"></i>Forward</a>
			                      <!-- END EMAIL ACTIONS -->
			                       
			                    </div>
			                </div>  
							 <div class="clearfix">&nbsp;</div>   	
					                      <!-- BEGIN EMAIL CONTENT -->
					                      <dl class="dl-horizontal sender-info">
					                        <dt>From</dt>
					                        <dd><strong><?php echo $viewmails[0]["suname"];?></strong> &lt;<?php echo $viewmails[0]["semail"]; ?>&gt;</dd>
					                        <dt>Date</dt>
					                        <dd><?php echo   date('M d,Y h:i a ',strtotime($viewmails[0]["date"]));?></dd>
					                        <dt>Subject</dt>
					                        <dd><?php echo $viewmails[0]["subject"];?></dd>
								<dt>To</dt>
					                        <dd><strong><?php echo $viewmails[0]["runame"]; ?></strong> &lt;<?php echo $viewmails[0]["remail"];?>&gt;</dd>
					                      </dl>
					                      
								 <?php
								
								if($viewmails_data): // Check for the resource exists or not
								 $intI=1;
								
								 foreach($viewmails_data as $key => $objRow)
								 {
									
									echo '<br/><br/><div class="well"><p class="text-right"><strong>'.$objRow["suname"].'</strong> '.date('M d,Y h:i a ',strtotime($objRow["date"])).'</p>';
									 echo '<div class="message-content">'.html_entity_decode($objRow["message"]).'</div></div>';
								 }
					
								endif;
								echo '<br/><br/><div class="well"><p class="text-right"><strong>'.$viewmails[0]["suname"].'</strong> '.date('M d,Y h:i a ',strtotime($viewmails[0]["date"])).'</p>';
								?>
								
								<div class="message-content">
					                       <?php echo html_entity_decode($viewmails[0]["message"])?>
					                      </div>
					
					                      <!-- END EMAIL CONTENT -->
					                    </div>
                       
                          </div>
                           </div>
                        </div>
                       
                        <div id="sent" class="tab-pane"></div>
                        <div id="drafts" class="tab-pane"></div>
                      </div>
                    </div>
                    <!-- END RIGHT PANEL-->
                  </div>
                </div>
              </div>
              
                
            </div>
            
           
          </div>
          	
        </div>
               
			 <!--main content -->
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
          CKEDITOR.replace('ckeditor2', {
          contentsLangDirection: isRTL
        });
        CKEDITOR.replace('ckeditor3', {
          contentsLangDirection: isRTL
        });
      });
    </script>
 <script>
$(document).ready(function() {
     
     $("#showreply").on('click', function(){ 
        $("#reply").show();
        $("#forward").hide();
        $("#compose").hide();
        
        $("#email-content").hide();
        });
        
    $("#showforward").on('click', function(){ 
    	
    	$("#forward").show();
        $("#reply").hide();
         $("#compose").hide();
         $("#email-content").hide();
        });     
        
        
        
        $("#compose-button").on('click', function(){ 
    	$("#compose").show();
    	$("#forward").hide();
        $("#reply").hide();
        $("#email-content").hide();
        });     
        
        
       $("#replysubmit").on('click', function(){  
            $("#reply-form").submit();
        
          }); 
		  $("#forwardfrm").on('click', function(){  
            $("#forward-form").submit();
        
          }); 
           
		   $("#composefrom").on('click', function(){  
            $("#compose-form").submit();
        
          });   
		    
		      
   });       
    
    </script>				
 