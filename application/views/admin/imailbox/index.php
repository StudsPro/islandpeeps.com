<?php
$write=affilateright("message","write");
$read=affilateright("message","read");

?>
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
                      <?php
                      if($write==true)
                      {
                      ?>
                      <a id="compose-button" href="javascript:void(0);" class="btn btn-block btn-primary">Compose</a>
                      <?php
                      }else
                      {
                      ?>
                        <a  href="javascript:void(0);" class="btn btn-block btn-primary">Compose</a>
                      <?php
                      }
                      ?>
                      <div  class="list-group">
                        <a href="<?php echo base_url()."admin/imailboxs";?>" class="list-group-item active"><i class="fa fa-inbox"></i>&nbsp;Inbox </a>
                      
                        <a href="<?php echo base_url()."admin/imailboxs/adminsendmails";?>"  class="list-group-item"><i class="fa fa-sign-in"></i>&nbsp;Sent</a>
                        
                      </div>
                    </div>
                    <!-- END LEFT PANEL-->
                    <!-- BEGIN RIGHT PANEL-->
                    <div class="col-md-10 right-inbox">
                     
                      <div class="tab-content">
                        <div id="inbox" class="panel panel-default tab-pane active">
                          <!-- BEGIN HEADER INBOX-->
                          <div class="panel-heading">
                                         
                          </div>
                          <!-- END HEADER INBOX-->
                          <div class="panel-body">
                          <div id="showlist" class="col-md-12">
                            <?php
                            $getclass="class='form-control input-md'";
                         
                          $fromurl= "admin/imailboxs/index";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'delete-form');
                         echo form_open_multipart($fromurl, $attributes);
                        ?>
                          
                            <!-- BEGIN EMAILS LIST-->
                            <table id="newtable1"  class="table table-striped table-bordered dataTable no-footer dt-responsive" cellspacing="0" width="100%">
                              <thead>
			                      <tr>
                                    <?php
                                  if($write==true)
                                  {
                                  ?>  
			                        <th data-hide="phone" width="5%">
			                        <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
			                        
			                        Select</th>
                                  <?php
                                  }
                                  ?>  
									<th width="15%" data-type="numeric" data-sort-initial="true">From</th>
			                        <th width="15%">Subject</th>
			                        <th width="10%">Date</th>
			                       	<!--<th width="10%" data-hide="phone">Delete</th> -->
			                      </tr>
			                    </thead>
                              <tbody>
                              <?php 
							  //echo "<pre>";
							  
							 // print_r($results); exit;
						if(!empty($results))
						{	  
							  foreach($results as $key => $value)
							  {
							  	
							   $strStatus =	$value["status"] ?'activepage.jpg':'inactivepage.gif';
							  ?>
                              <!-- BEGIN EMAIL INFO-->
                              <tr>
                                <?php
                                  if($write==true)
                                  {
                                  ?>  
                                <td>
                                  <input type="checkbox" name="selected[]" value="<?php echo $value["id"];?>" />
                                </td>
                                <?php
                                }
                                ?>
                                <td>
                                 <?php
                      if($write==true)
                      {
                      ?>
                                <a href="<?php echo SITE_ADMIN_URL;?>imailboxs/viewmail/<?php echo $value["id"];?>"><?php echo ($value["status"]=='0') ? '<strong>'.$value["username"].'</strong>' : $value["username"]  ;?></a>
                            <?php
                            }else
                            {
                            ?>
                             <?php echo ($value["status"]=='0') ? '<strong>'.$value["username"].'</strong>' : $value["username"]  ;?>
                            <?php
                            }
                            ?>    
                                </td>
                                <td class="hidden-sm">
                               <?php
                              if($write==true)
                              {
                              ?>  
                                <a href="<?php echo SITE_ADMIN_URL;?>imailboxs/viewmail/<?php echo $value["id"];?>"><?php echo ($value["status"]=='0') ? '<strong>'.$value["subject"].'</strong>' : $value["subject"]  ;?></a>
                              <?php
                            }else
                            {
                            ?>
                             <?php echo ($value["status"]=='0') ? '<strong>'.$value["subject"].'</strong>' : $value["subject"]  ;?>
                            <?php
                            }
                            ?>           
                                
                                </td>
                                <td>
                                   <?php echo ($value["status"]=='0') ? '<strong>'. date('M d,Y h:i a ',strtotime($value["date"])).'</strong>' : date('M d,Y h:i a ',strtotime($value["date"]))  ;?>
                                </td>
                                
                                <!-- END EMAIL INFO-->
                                <!-- BEGIN EMAIL INFO-->
                              </tr>
                             <?php
							 }
					     }		 
							 ?>
                             </tbody>
                              
                             
                              <!-- @endfor-->
                            </table>
                            <!-- END EMAILS LIST-->
                            
                              <div class="clearfix">&nbsp;</div>   
                     <div class="panel-footer text-right">
                      <?php
                      if($write==true)
                      {
                      ?>
		                  <input type="submit"  value="Delete" id="deleteall" onclick="document.frmListing.status.value='-1';" class="btn btn-danger" name="btn_delete">
                     <?php
                     }
                     ?>
                     </div>	
                     
                          <?php echo form_close();?>
                     
                            </div>
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
              <?php 
   
   $admininfo=get_admininfo(); 
    $perpage=($admininfo["masterlistperpage"]) ? $admininfo["masterlistperpage"] :'50';
   ?>  
 <script>
       $(document).ready(function() {
       // Tables.initDynamicTables();
    $("#newtable1").DataTable({
      "sDom": "<'row' <'col-xs-7'l><'col-xs-4'f>r>t<'row'<'col-xs-4'i><'col-xs-6'p> >",
      "aaSorting": [[2, "desc"]],
      "pageLength": 5,
       stateSave:true,
	   "stateDuration": 60 * 60 * 24,
        "iDisplayLength": <?php echo $perpage;?>,
        //"bPaginate": true,
        "bLengthChange": true, 
        responsive: true,
        	"language": {
			"lengthMenu": "_MENU_ <span class='hidden-xs'>records per page </span>"
	   } 
    });
    });
    </script>				
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
    	$("#showlist").hide();
        
        });     
     	   $("#composefrom").on('click', function(){  
            $("#compose-form").submit();
        
          });   
		    
		      
   });       
    
    </script>