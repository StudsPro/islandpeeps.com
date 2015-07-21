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
 #menu-wrap .menu-item:hover > .text {bottom: 0;font-size:25px;padding:0;-webkit-transition: all 0.5s ease-in-out;-moz-transition: all 0.5s ease-in-out;-ms-transition: all 0.5s ease-in-out;-o-transition: all 0.5s ease-in-out;transition: all 0.5s ease-in-out;text-align:center;}
.disqus-btn {  cursor: pointer;  float: right;  padding-top: 24px;  width: 100px;}
.disqus-btn button {
  background: url("<?php echo SITE_IMAGEURL;?>disqus-btn.png") no-repeat scroll left top rgba(0, 0, 0, 0);
  border: medium none !important;  height: 36px;  width: 103px;}
.funfacts {
  color: #CE675B;
  font-size: 2em !important;
  font-weight: normal !important;
}  
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
                     <a class="btn btn-primary" href="<?=SITE_ADMIN_URL;?>masterlist">
                       <i class="fa fa-angle-double-left"></i> BACK
                     </a>
                 </div>
			  
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
                              
                          <?php  
                           if($result["kind"]=="Fun facts")
                           {
                          ?> 
                           <div class="row">                 
                           <h4  class="heading funfacts" >-<?php echo $result["kind"];?>-</h4>
                           </div>  
                          <?php
                          }
                          ?>                
                           <div class="row">                 
                           <h3 class="fp_head"><?php echo $result["title"];?></h3>
                           </div>
                            <div class="clearfix">&nbsp;</div>
                          
                           <div class="row" id="description">  <?php  	
                               echo   stripslashes($result["description"]);           
                                            ?>
                             
                           </div> 
                          </div> 
                           <div class="col-md-12 paddress-left0">
                            <div class="col-md-8 paddress-left0">
                                <div id="menu-wrap" class="row">
<div class="menu-item">
<span id="active" class="icon fa fa-facebook"></span>
<a style="outline: medium none;" hidefocus="true" id="hover" class="text share_fb"  href="javascript:void(0);"><i class="fa fa-facebook"></i></a>
</div>
<div class="menu-item">
<span id="active" class="icon fa fa-twitter"></span>
<a style="outline: medium none;" hidefocus="true" id="hover" target="_blank" href="http://twitter.com/share?text=<?php echo  urlencode(stripslashes($result["description"])); ?>&url=http://dev.islandpeeps.com/#<?php echo $strregion;?>&hashtags=<?php echo $result["tags"];?>" class="text share_t"><i class="fa fa-twitter"></i></a>
</div>
<div class="menu-item">
<span id="active" class="icon fa fa-pinterest-square"></span>
<a href="http://www.pinterest.com/pin/create/button/?url=http://dev.islandpeeps.com/#<?php echo $strregion;?>&media=<?php echo SITE_GETUPLOADPATH.$result["image"];?>&description=<?php echo  urlencode(stripslashes($result["description"])); ?>" target="_blank" class="text share_pinte" id="hover"><i class="fa fa-pinterest-square"></i></a>
</div> 
<div class="menu-item">
<span id="active" class="icon fa fa-tumblr"></span>
<a style="outline: medium none;" hidefocus="true" href="http://www.tumblr.com/share/photo?source=<?php echo SITE_GETUPLOADPATH.$result["image"];?>&caption=<?php echo  urlencode(stripslashes($result["description"])); ?>&click_thru=http://dev.islandpeeps.com/#<?php echo $strregion;?>" id="hover" class="text share_tumblr" target="_blank"><i class="fa fa-tumblr"></i></a>
</div> 
</div>
                            </div>
                              <div class="col-md-4">
                                <div class="disqus-btn">
                                 <button ></button>
                                </div>
                              </div>
                          
                          </div> 
                             
                        </div>
                       	
                    </div>
                </div>
			  
                  
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
 