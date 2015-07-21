<style>
.heading, .main_head {  color: #00ccff;  display: inline-block;  font-family: Cubano,Helvetica,sans-serif;  font-size: 2.4em;  font-weight: bold;  line-height: 0.9em;
  text-transform: uppercase;
}
.fp_head {  color: #999999;  font-family: Nunito,Arial,Helvetica,sans-serif;  font-size: 2.6em;  line-height: 1em;  margin: 4% 0 0;  padding: 0;}

 #menu-wrap {  margin-bottom: 0 !important;}
 #menu-wrap {  float: left;  height: auto;  line-height: 13px;  margin: 0 0 50px;  padding: 0;  text-align: left;  width: 170px;}

 #menu-wrap .menu-item {  border-radius: 3px;  display: inline-block;  height: 55px;  overflow: hidden;  position: relative;  width: 38px;}
 #menu-wrap .menu-item .text {  background-color: #fff;  bottom: -27px;  display: block;  font-family: Arial,Helvetica,sans-serif;  font-size: 0;
  font-weight: normal;  padding: 0 0 17px;  position: absolute;  text-align: center;  text-decoration: none;  transition: all 0.3s ease-in-out 0s;  width: 100%;
}
 #menu-wrap .menu-item a {  color: #445878;}
 #menu-wrap .menu-item .icon {
  font-size: 25px;  height: 32px;  padding: 13px 9px 5px 4px;  text-align: center;  width: 32px;
}
 #menu-wrap .menu-item span {  background: none repeat scroll 0 0 #fff;  border-radius: 50%;  color: #445878;  display: block;
  left: 0;  position: absolute;  top: 10px;  transition: all 0.3s ease-in-out 0s;}
 #menu-wrap .menu-item i {  border-radius: 3px;  padding: 7px 0 5px;  width: 100%;}
 #menu-wrap .menu-item i.fa-facebook {  background: none repeat scroll 0 0 #3b5998;  color: #fff;}
 #menu-wrap .menu-item i.fa-twitter {  background: none repeat scroll 0 0 #44ccf6;  color: #fff;}
 #menu-wrap .menu-item i.fa-pinterest-square {  background: none repeat scroll 0 0 #cb2027;  color: #fff;}
#menu-wrap .menu-item i.fa-tumblr {  background: none repeat scroll 0 0 #274152;  color: #fff;}
#description{  color: #525252;margin-top: 3%;text-align: justify;     font-size: 1em;    padding-right:4%;   font-family: Nunito,Helvetica,sans-serif;letter-spacing: -0.01em;
line-height: 1.4em;
}
.disqus-btn {  cursor: pointer;  float: right;  padding-top: 24px;  width: 100px;}
.disqus-btn button {
  background: url("<?php echo SITE_IMAGEURL;?>disqus-btn.png") no-repeat scroll left top rgba(0, 0, 0, 0);
  border: medium none !important;  height: 36px;  width: 103px;}
</style>
 
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
              <div class="panel panel-default">
                 <div class="panel-heading text-right">
                     <div class="col-md-10">
                     <?php echo form_error('title', '<div class="col-md-7 red text-center">', '</div>'); ?> 
                     </div>
                     <div class="col-md-2">
                     <a class="btn btn-primary" href="<?=SITE_ADMIN_URL;?>suggestion">
                       <i class="fa fa-angle-double-left"></i> BACK
                     </a>
                     </div>
                 </div>
			   <?php
                            $getclass="class='form-control input-md'";
                          $hidden = array("id"=>$id,
                           "kind"=>$result["kind"],
                           "title"=>$result["title"],
                           "dob"=>$result["dob"],
                           "region_id"=>$result["region_id"],
                           "description"=>$result["description"],
                           "email"=>$result["email"],
                           "image"=>$result["image"]
                           
                          );
                          $fromurl= $id >0 ? "admin/suggestion/profiledetail/".$id : "admin/suggestion/profiledetail";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                         echo form_open_multipart($fromurl, $attributes, $hidden);
                        ?>
                <div class="panel-body">
                  
                   <div class="col-md-12">
                        <div class="col-md-7">
                     	  <?php  
                          
                               if(!empty($result["image"]) && file_exists(SITE_UPLOADPATH.$result["image"]) )
                               { 
                                ?>
                                
                                 <?php
                                 echo '<img src="'.SITE_GETUPLOADPATH.$result["image"].'?'.time().'" width="100%">'; 
                                 ?>
                                
                              <?php }
                              ?>   
                        </div>
                        <div class="col-md-5">
                         <div class="col-md-12">
                         <div class="row">
                     	  <h2 class="heading"><?php  	
                                              $regions_arr;
                                              $strregion="";
                                              $tmpcounter=1;
                                             if(!empty($result['region_id']))
                                             {
                                                $tmp_arr=explode(",",$result['region_id']);
                                                $tmpcount=count($tmp_arr);
                                                if(!empty($tmp_arr))
                                                {
                                                   foreach($tmp_arr as $key => $value)
                                                   {  
                                                    if($tmpcounter < $tmpcount)
                                                    {
                                                        $str=",";
                                                    }else
                                                    {
                                                        $str=" ";
                                                    }
                                                     $strregion.=$regions_arr[$value].$str;
                                                     $tmpcounter++;
                                                    }  
                                                 } 
                                             }
                                             echo $strregion;
                                            
                                            ?></h2>
                              </div>              
                           <div class="row">                 
                           <h3 class="fp_head"><?php echo $result["title"];?></h3>
                           </div>
                            <div class="clearfix">&nbsp;</div>
                          
                           <div class="row" id="description">  <?php  	
                               echo   stripslashes($result["description"]);           
                                            ?>
                             
                           </div> 
                          </div> 
                            <div class="clearfix">&nbsp;</div>
                           <div class="row">
                            
                            
                              <div class="form-group">
                              <label class="col-sm-4 control-label" for="form-input" style="color: #999;"><b>User Kind</b></label>
                              <div class="col-sm-7">
                                  <span class="help-block"><?php  	
                               echo   stripslashes($result["kind"]);           
                                            ?></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label" for="form-input" style="color: #999;"><b>Date of Birth</b></label>
                              <div class="col-sm-7">
                                  <span class="help-block"><?php  	
                               echo   stripslashes($result["dob"]);           
                                            ?></span>
                              </div>
                            </div>
                             <div class="form-group">
                              <label class="col-sm-4 control-label" for="form-input" style="color: #999;"><b>Email</b></label>
                              <div class="col-sm-7">
                                  <span class="help-block"><?php  	
                               echo   stripslashes($result["email"]);           
                                            ?></span>
                              </div>
                            </div>
                          </div> 
                             
                        </div>
                       	
                    </div>
                </div>
			      
                  
                  <div class="panel-footer text-center">
				      <input type="submit" class="btn btn-primary" id="savefrm" value="Accept" name="accept">
                      <input type="submit" class="btn btn-danger" id="savefrm" value="Deny" name="accept">  
					
                  </div>
                  	<?php echo form_close();?>
              </div>
              
                
            </div>
            
           
          </div>
          	
        </div>
               
			 <!--main content -->
 <script>
 
 function downloadpdf()
 {
    window.location.href='<?=SITE_ADMIN_URL;?>masterlist/downloadpdf/'+$("#fillter").val();
    
 }
      $(function() { 
       // Tables.initDynamicTables();
    $("#newtable").dataTable({
      "sDom": "<'row' <'col-xs-5'l><'col-xs-4'f>r>t<'row'<'col-xs-4'i><'col-xs-7'p> >",
      "aaSorting": [[2, "desc"]],
      "pageLength": 5,
     responsive: true
      
    });
    
    $( "#fillter" ).change(function() {

    window.location.href='<?php echo base_url()."admin/masterlist/index/"?>'+this.value;
});
    
    $(".setbackground").click(function() {
        var selid=this.id;
        $.ajax({
                    
                   // dataType: 'JSON',
                    type: 'POST',
                    cache: false,
                    url:  '<?php echo base_url();?>admin/ads/setbackgroundimage',
                    data : {
                      editid : selid
                    },
                    success: function(data){
                    if(data=="Y")
                    {
                     $("#"+strflag).remove(); 
                    }
                    return false;
                    }
                    });  
    });
      });
    </script>				
 