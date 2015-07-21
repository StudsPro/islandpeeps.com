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
                          <h3 class="panel-title"> <?php echo $id >0 ? "Edit" : "Add"; ?> Category</h3>
                        </div>
                        <?php //echo validation_errors(); ?>
					 <?php
                            $getclass="class='form-control input-md'";
                          $hidden = array("id"=>$id);
                          $fromurl= $id >0 ? "admin/masterlist/addcategory/".$id : "admin/masterlist/addcategory";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                         echo form_open_multipart($fromurl, $attributes, $hidden);
                        ?>
                      	<div class="panel-body">  
                           <?php echo form_error('category[]', '<div class="row red text-center">', '</div>'); ?> 
                         <span id="morecategory">
                          <?php
                          $int=1;
                           if(!empty($categorys_arr))
                           {
                             foreach($categorys_arr as $key => $value)
                             {
                                ?>
                               <div class="form-group">
								<label for="title" class="col-md-2 control-label"> Category  <span class="require">*</span></label>
								<div class="col-md-5">
						    <?php
                               $data = array('name'=> 'category['.$key.']','id'=> 'category','value'=> set_value('category',$value),'class'=> 'form-control input-md');
                               echo form_input($data);
                              ?>   
                             </div>
                                 <?php if($int==1):?> &nbsp; <div class="col-md-5 text-left" id="AddMore"> 
                                 <a href="javascript:void(0)" class="btn btn-primary"><i class="icon-pencil"></i>Add new category </a>
                                </div>
                                <?php endif;?>
                               
                             </div> 
                           <?php 
                               $int++;
                             }
                           }
                           ?> 
                           </span>  
                             
                    </div>	<!--- End Panel -->     
					
					
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
$( document ).ready(function() {


var MaxInputs       = '<?php echo $maxid+4;?>'; //maximum input boxes allowed
var InputsWrapper   = $("#morecategory"); //Input boxes wrapper ID
var AddButton       = $("#AddMore"); //Add button ID

var x =  $('.smail').length; //initlal text box count
var FieldCount='<?php echo $maxid;?>'; //to keep track of text box added

$(AddButton).click(function (e)  //on add input button click
{ 

        if(x <= MaxInputs) //max input box allowed
        {  
            FieldCount++; //text box added increment
            //add input box
            $(InputsWrapper).append('<div class="romove form-group">	<label for="title" class="col-md-2 control-label"> Category  <span class="require">*</span></label><div class="col-md-5"><input type="text" class="form-control input-md" name="category['+FieldCount+']"  id="db__category" value=""/>&nbsp;</div><div class="col-md-2"><a href="#" class="removeclass">&times;</a></div></div>');
            x++; //text box increment
        }
return false;
});
$("body").on("click",".removeclass", function(e){ 

        if( x > 0 ) {
                $(this).closest(".romove").remove(); //remove text box
                x--; //decrement textbox
        }
return false;
})
 
});
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
   /*
		if(check_trim('name')==false)
		{
		  alert("Name should not be blank");
		  $('#name').val("");
		   $('#name').focus();
		   return false
		} 
        */
        $("#advanced-form").submit();
    });    
 </script>