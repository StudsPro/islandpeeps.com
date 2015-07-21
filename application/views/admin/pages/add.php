<div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-title"><?=$page_titles;?></h3>
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
                          <h3 class="panel-title"> <?php echo $id >0 ? "Edit" : "Add"; ?> Content</h3>
                        </div>
					 <?php
                            $getclass="class='form-control input-md'";
                          $hidden = array("id"=>$id);
                          $fromurl= $id >0 ? "admin/pages/edit/".$id : "admin/pages/add";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                         echo form_open_multipart($fromurl, $attributes, $hidden);
                        ?>
                      	<div class="panel-body">  
                             <div class="form-group">
    								<label for="title" class="col-md-2 control-label">Page Title</label>
    								<div class="col-md-5">
    								  <input id="page_title" name="page_title" type="text" placeholder="page title" class="form-control input-md" 
    								  value="<?php if(isset($results['page_title']))
    								  				{echo $results['page_title'];}?>">
    								</div>
                                     <?php echo form_error('page_title', '<div class="col-md-7 red text-center">', '</div>'); ?> 
    						  	</div>
							<div class="form-group">
								<label for="title" class="col-md-2 control-label">Content</label>
								<div class="col-md-10">
									<?php
									if($id==4)
										{
										?>
										<textarea  id="ckeditor"    name="detailed_description" class="form-control input-md">
										<?php if(isset($results['detailed_description'])){echo html_entity_decode($results['detailed_description']);}?>
										</textarea>
									  <?php
										}
										  else
										{
										?>
								
										<textarea  id="ckeditor" name="detailed_description" class="form-control input-md">
										<?php if(isset($results['detailed_description'])){echo html_entity_decode($results['detailed_description']);}?>
										</textarea>
										<?php			 
										 }		
										?>
								</div>
						  	</div> 
                               <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Status</label>
								<div class="col-md-5">
						    <?php
                               
                                  $getclass="class='form-control input-md'";
                                  if(isset($results['status'])){ $status=$results['status'];}else
                                  {
                                    $status="";
                                  }
                                  
                                    $status_arr=array('1'=>"Publish",'0'=>"Unpublish");
                                    echo form_dropdown('status', $status_arr, $status,$getclass);    
                              
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

		if(check_trim('page_title')==false)
		{
		  alert("Page title should not be blank");
		  $('#page_title').val("");
		   $('#page_title').focus();
		   return false
		}
      
        $("#advanced-form").submit();
    });    
 </script>