<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?=SITE_NAME;?> :: <?php echo $sitetitle ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=META_DESCRIPTION;?>">
	<meta name="keyword" content="<?=META_KEYWORDS;?>">
    <meta name="author" content="<?=SITE_NAME;?>">
    <link href="<?=ADMIN_THEEM_CSS;?>social1.core.css" rel="stylesheet">
    <link href="<?=ADMIN_THEEM_CSS;?>social1.admin.css" rel="stylesheet"> 

<!--    <link href="<?=ADMIN_THEEM_CSS;?>twitter-bootstrap/bootstrap.css" rel="stylesheet"> -->
    
    <!-- Chose your icons set-->
    <link href="<?=ADMIN_THEEM_CSS;?>glyphicons_free/glyphicons.css" rel="stylesheet">
    <link href="<?=ADMIN_THEEM_CSS;?>glyphicons_pro/glyphicons.css" rel="stylesheet">
    <link href="<?=ADMIN_THEEM_CSS;?>glyphicons_pro/glyphicons.halflings.css" rel="stylesheet">
    <link href="<?=ADMIN_THEEM_CSS;?>font-awesome/font-awesome.css" rel="stylesheet">
    
    <link href="<?=ADMIN_THEEM_CSS;?>jquery-ui/social/jquery.ui.css" rel="stylesheet">
    <!-- Current theme-->
    <link id="current-theme" href="<?=ADMIN_THEEM_CSS;?>themes/admin/facebook.css" rel="stylesheet">
	<!-- BEGIN CURRENT PAGE STYLES-->
    <link href="<?=ADMIN_THEEM_JS?>plugins/jqvmap/jqvmap.css" rel="stylesheet">
    <link href="<?=ADMIN_THEEM_CSS;?>plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="<?=ADMIN_THEEM_JS?>plugins/pnotify/pnotify.custom.min.css" rel="stylesheet">
    <!-- END CURRENT PAGE STYLES-->
	
    <!-- BEGIN DEMO FILES-->
    <link href="<?=ADMIN_THEEM_CSS;?>demo.css" rel="stylesheet">
    <link href="<?=ADMIN_THEEM_JS?>plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet">
    <!-- END DEMO FILES-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--[if lte IE 8]>
    <script src="<?=ADMIN_THEEM_JS?>html5shiv/html5shiv.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/respond/respond.min.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/flot/excanvas.min.js"></script> 
    <![endif]
    <link href="<?=ADMIN_THEEM_CSS?>customstyle.css" rel="stylesheet"> -->
    <!-- jQuery-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
      window.jQuery || document.write('<script src="<?=ADMIN_THEEM_JS?>jquery/jquery.min.js"><\/script>')
    </script>
    <!-- Bootstrap JS-->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script>
      $.fn.modal || document.write('<script src="<?=ADMIN_THEEM_JS?>plugins/bootstrap/bootstrap.min.js"><\/script>')
       // Prevent jQueryUI Conflicts
       var bootstrapTooltip = $.fn.tooltip.noConflict()
       $.fn.bootstrapTooltip = bootstrapTooltip
    </script>
    <!-- jQueryUI-->
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
      window.jQuery.ui || document.write('<script src="<?=ADMIN_THEEM_JS?>jquery-ui/jquery-ui.min.js"><\/script>')
    </script>
    <!-- Bootstrap Hover Dropdown-->
    <script src="<?=ADMIN_THEEM_JS?>plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
    <script type="text/javascript" src="<?=ADMIN_THEEM_JS?>marquee/jquery.marquee.min.js"></script>
  
    <link  href="<?=ADMIN_THEEM_CSS?>stylecustom.css" rel="stylesheet"/>
  </head>
   <?php 
  $admininfo=get_admininfo(); 
  //echo "<pre>";print_r($admininfo);exit;
  
  ?>
  <body class="<?php  echo $admininfo["autohide"]=='1' ?  'reduced-sidebar' :'' ?>" id="bodyCls">
    <div class="wrapper">
      <!-- BEGIN SIDEBAR-->
       <?php include_once("tempsidebar.php"); ?>
      <!-- END SIDEBAR-->
      <header>
        <!-- BEGIN NAVBAR-->
        <nav role="navigation" class="navbar navbar-fixed-top navbar-super social-navbar top_bar">
          <div class="navbar-header">
            <a href="<?=SITE_ADMIN_URL;?>" title="Social" class="navbar-brand">
              <img width="25" height="25" src="<?=ADMIN_THEEM_IMG?>logo-white-181.png" alt="Social" class="light">
              <img width="25" height="25" src="<?=ADMIN_THEEM_IMG?>logo-gray-181.png" alt="Social" class="dark">
              <span>&nbsp;Social</span>
            </a>
          </div>
          <div class="navbar-toggle"><i class="fa fa-align-justify"></i>
          </div>
          <div>
            <ul class="nav navbar-nav top_panel_first">
              <li class="dropdown navbar-super-fw">
                <a href="#" class="dropdown-toggle top_panel_name">ADMIN PANEL</a></li>
            </ul>
            <ul class="nav navbar-nav top_panel_second">
              <li class="dropdown navbar-super-fw">
                <a href="#" class="dropdown-toggle top_panel_username"> Welcome <strong><?php echo $this->session->userdata('username');?></strong> !</a></li>
            </ul>
            <ul class="nav navbar-nav marquee top_panel_third">
                 <li><a>Launch Day April 1st  2015!!! ***WWW.ISLANDPEEPS.COM*** </a></li> 
            </ul>
            <ul class="nav navbar-nav navbar-right top_panel_last">
              <!-- END DROPDOWN MESSAGES-->
              <li class="divider-vertical"></li>
              <!-- BEGIN EXTRA DROPDOWN-->
              <li class="dropdown">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="0" class="dropdown-toggle"><i class="fa fa-caret-down fa-lg"></i>
                </a>
                <ul class="dropdown-menu">
                  <li class="visible_moblie">
                    <a href="<?=SITE_ADMIN_URL;?>setting/myprofile">Welcome <strong><?php echo $this->session->userdata('username');?></strong> !</a>
                  </li>
                  <li>
                    <a href="<?=SITE_ADMIN_URL;?>setting/myprofile"><i class="fa fa-user"></i>&nbsp;My Profile</a>
                  </li>
                  <li>
                    <a href="<?=SITE_ADMIN_URL;?>setting/sitesettings"><i class="fa fa-cogs"></i>&nbsp;Settings</a>
                  </li>
                  <li>
                    <a href="<?=SITE_ADMIN_URL;?>home/logout"><i class="fa fa-sign-out"></i>&nbsp;Log Out</a>
                  </li>
                  <li class="divider"></li>
                  <li>
                    <a href="<?=SITE_ADMIN_URL;?>pages/help"><i class="fa fa-info"></i>&nbsp;Help</a>
                  </li>
                </ul>
              </li>
              <!-- END EXTRA DROPDOWN-->
            </ul>
            <div class="nav-indicators top_panel_four">
              <ul class="nav navbar-nav navbar-right nav-indicators-body top_panel_four_first">
                <li id="demo-setting" class="dropdown nav-notifications nav-setting">
                  <!-- BEGIN DROPDOWN TOGGLE-->
                  <a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="0" class="dropdown-toggle">
                       <span class="badge"></span><i class="fa fa-cog"></i>
                  </a>
                  <!-- END DROPDOWN TOGGLE-->
                  <!-- BEGIN DROPDOWN MENU-->
                  <ul class="dropdown-menu">
                    <!-- BEGIN DROPDOWN HEADER-->
                    <li class=" nav-notifications-header header">Sidebar</li>
                    <!-- END DROPDOWN HEADER-->
                    <!-- BEGIN NOTIFICATION ITEMS-->
                    <li class="nav-notifications-body">
                    <?php
                   $autohide_check="";
                   
                   if($admininfo["autohide"]==1)
                   {$autohide_check="checked";}
                  ?>
                     <label class="checkbox setting_checkbox"><input type="checkbox" value="option1" <?php echo $autohide_check;?> id="sidebar-autohide"/>Auto Hide</label>
                    </li>
                     <?php
                   if($admininfo["dividers"]==1)
                   {
                     $dividers_check="checked";
                   }else
                   {
                     $dividers_check="";
                   }
                  
                  ?>
                    <li class="nav-notifications-body">
                     <label class="checkbox setting_checkbox"><input type="checkbox" <?php echo $dividers_check?> value="option2" id="sidebar-dividers"/>Dividers</label>
                    </li>
                    <li class="header">Page per record</li>
                    <li class="nav-notifications-body">
                     <label class="radio setting_checkbox"><input type="radio" name="pageper" value="10" class="pageper"/>10</label>
                    </li>
                    <li class="nav-notifications-body">
                     <label class="radio setting_checkbox"><input type="radio" name="pageper" value="25" class="pageper"/>25</label>
                    </li>
                    <li class="nav-notifications-body">
                     <label class="radio setting_checkbox"><input type="radio" name="pageper"value="50" class="pageper"/>50</label>
                    </li>
                    <li class="nav-notifications-body">
                     <label class="radio setting_checkbox"><input type="radio" name="pageper" value="100" class="pageper"/>100</label>
                    </li>
                    <li class="divider"></li>
                    <li class="header">Theme</li>
                    <li class="colorpickers">
                    <select name="colorpicker" style="display: none;">
                                        <option value="#f2f2f2">Light</option>
                                        <option data-class="blue" value="#3b5998">Blue</option>
                                        <option data-class="green" value="#51a351">Green</option>
                                        <option data-class="orange" value="#f89406">Orange</option>
                    </select><span class="simplecolorpicker inline"><span tabindex="0" role="button" data-color="#f2f2f2" class="white_theme_button"  title="Light" class="selected">&nbsp;&nbsp;&nbsp;&nbsp;</span><span tabindex="0" role="button" data-color="#3b5998" class="blue_theme_button" title="Blue">&nbsp;&nbsp;&nbsp;&nbsp;</span><span tabindex="0" role="button" data-color="#51a351" class="green_theme_button" title="Green">&nbsp;&nbsp;&nbsp;&nbsp;</span><span tabindex="0" role="button" data-color="#f89406" class="orange_theme_button" title="Orange">&nbsp;&nbsp;&nbsp;&nbsp;</span></span>
                    </li>
                   
                  </ul>
                  <!-- END DROPDOWN MENU-->
                </li>
                <li class="dropdown nav-notifications">
                  <a href="http://dev.islandpeeps.com/index.php/administrator/setting/cloud" data-toggle="dropdown" data-hover="dropdown" data-delay="0" class="dropdown-toggle">
                    <span class="badge"></span><i class="fa fa-cloud"></i>
                  </a>
                </li>
                  <?php
                
                if($this->session->userdata('sadmin')==1)
               { 
                //get_todayevent_general   ;
		   	   $today_events = get_adminnotification();
				if(count($today_events)>0)
				{
				?>
                <!-- BEGIN DROPDOWN NOTIFICATIONS-->
                <li class="dropdown nav-notifications anotifilog profile">
                  <!-- BEGIN DROPDOWN TOGGLE-->
                  <a href="<?=SITE_ADMIN_URL;?>setting/calendar" data-toggle="dropdown" data-hover="dropdown" data-delay="0" class="dropdown-toggle">
                    <span class="badge"><?=count($today_events);?></span><i class="fa fa-warning"></i>
                  </a>
                  <!-- END DROPDOWN TOGGLE-->
                  <!-- BEGIN DROPDOWN MENU-->
                  <ul class="dropdown-menu">
                    <!-- BEGIN DROPDOWN HEADER-->
                    <li class="nav-notifications-header">
                      <a tabindex="-1" href="<?=SITE_ADMIN_URL;?>setting/calendar">You have <strong><?=count($today_events);?></strong> new notifications</a>
                    </li>
                    <!-- END DROPDOWN HEADER-->
                     <?php $ids= '';
                    	     foreach($today_events as $key => $objRow)  // Fetch the result in the object array
                    	      {
                    	 	$ids.=$objRow["id"].','; 
                            ?>
                    		
                    <!-- BEGIN NOTIFICATION ITEMS-->
                    <?php $colr = array('1'=>'info','2'=>'warning','3' => 'success','4'=> 'error');?>
                    <li class="nav-notifications-body text-<?php echo $colr[1];?>">
                      <a><i class="fa fa-user"></i>
                            <?php  
                    				 if(date('Y-m-d') == date('Y-m-d',strtotime($objRow["date"]))){
                    			       $datea =  date('h:i a ',strtotime($objRow["date"]));
                    			      }else{
                    				$datea = date('M d,Y h:i a ',strtotime($objRow["date"]));
                    			      }  
                    			       
                    				echo  $objRow["data"].'<small class="pull-right">'.$datea.'</small>'; 
                    
                    			     
                    			?>	
                      </a>
                    </li>
                    <!-- END NOTIFICATION ITEMS-->
                    <!-- BEGIN DROPDOWN FOOTER-->
                    <?php } ?>
                    <input type="hidden" name="notifiids" id="notifiids" value="<?php echo rtrim($ids,',');?>"/>
                    <!-- END DROPDOWN FOOTER-->
                  </ul>
                  <!-- END DROPDOWN MENU-->
                </li>
                	<?php
				}
                }
				?>
                <!-- END DROPDOWN NOTIFICATIONS-->
                <?php
					if(!isset($EmailCount))
						{
							$EmailCount=0;
							$emailCountArr=CountUnreadMail();
							if(is_array($emailCountArr)){if(count($emailCountArr)>0){$EmailCount=$emailCountArr['count'];}}
						}
					 
						
					if($EmailCount>0)
					{ 
					?>
                <!-- BEGIN DROPDOWN TASKS-->
                <li class="dropdown nav-messages">
                  <!-- BEGIN DROPDOWN TOGGLE-->
                  <a href="<?=SITE_ADMIN_URL;?>setting/mailbox" data-toggle="dropdown" data-hover="dropdown" data-delay="0" class="dropdown-toggle">
                    <span class="badge"><?=$EmailCount;?></span><i class="fa fa-envelope"></i>
                  </a>
                  <!-- END DROPDOWN TOGGLE-->
                  <!-- BEGIN DROPDOWN MENU-->
                  <ul class="dropdown-menu" style="display: block;">
                    <!-- BEGIN DROPDOWN HEADER-->
                    <li class="nav-tasks-header">
                      <a href="<?=SITE_ADMIN_URL;?>setting/mailbox">You have <strong><?=$EmailCount;?></strong> tasks in progress</a>
                    </li>
                   <li class="nav-messages-footer">
					  <a tabindex="-1" href="<?=SITE_ADMIN_URL;?>setting/mailbox">View all messages</a>
                    </li>
                  </ul>
                  <!-- END DROPDOWN MENU-->
                </li>
                <!-- END DROPDOWN TASKS-->
                	<?php
					}
				  ?>
                  
                    <?php
               $notifictios=0; 
                    $objRsnote = get_afftask();  
			   $notifictios =  (count($objRsnote) > 0 ) ? count($objRsnote)  : '';
			   $objRsnotec = get_comptask();  
			   $notifictios+=  (count($objRsnotec) > 0 ) ? count($objRsnotec)  : '';
	 if($this->session->userdata('sadmin')=='1'){
			   $objRsrnote = get_readyprofile();  
			    $notifictios+=  (count($objRsrnote) > 0 ) ? count($objRsrnote)  : ''; 
	}else if($this->session->userdata('sadmin') <> '1'){
			$objRsrjnote = get_rejectprofile();  
			    $notifictios+=  (count($objRsrjnote) > 0 ) ? count($objRsrjnote)  : ''; 
	}
			    $objRsrnote1 = get_notelog();  
			   $notifictios+=  ( count($objRsrnote1) > 0 ) ? count($objRsrnote1)  : '';
                
                ?>  
                <!-- BEGIN DROPDOWN MESSAGES-->
                <li class="dropdown nav-notifications nav-task">
                  <!-- BEGIN DROPDOWN TOGGLE-->
                  <a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="0" class="dropdown-toggle">
                    <?php if($notifictios > 0 ){?><span class="badge"><?php echo $notifictios;?></span><?php } ?><i class="fa fa-tasks"></i>
                  </a>
                  <!-- END DROPDOWN TOGGLE-->
                  <!-- BEGIN DROPDOWN MENU-->
                  <ul class="dropdown-menu">
                    <!-- BEGIN DROPDOWN HEADER-->
                    <li class="nav-notifications-header">
                      <a tabindex="-1" href="#">You have <strong><?php echo $notifictios;?></strong> new messages</a>
                    </li>
                    <!-- END DROPDOWN HEADER-->
                    <!-- BEGIN DROPDOWN ITEMS-->
                     <?php  
                       if(!empty($objRsnote)) 
                              { 
                               foreach($objRsnote as $key => $value)
                              {
                    
                            ?>
                            <!-- BEGIN NOTIFICATION ITEMS -->
                    		<?php $colr = array('1'=>'info','2'=>'warning','3' => 'success','4'=> 'error');?>
                                     <li class="nav-notification-body text-<?php echo $colr[$value["status"]];?>">
                                        <a href="<?php  echo "#"; //echo ISP :: AdminUrl('setting/task');?>">
                                              <i class="fa fa-user"></i>
                    			<?php if($value["status"] == '1'){
                    				echo 'New task ('.substr($value["task"] , 0, 15) .'...) <small class="pull-right">Opened</small>';
                    			      }else if($value["status"] == '2'){
                    				echo 'Task ('.substr($value["task"], 0, 15) .'...) <small class="pull-right">In progress</small>';
                    			      } 
                    			?>
                                 </a>
                               </li>
                                      
                                    <!-- END NOTIFICATION ITEMS -->
                        	<?php }
                            
                           } 
                           
                            ?>
                      <?php
                             if(!empty($objRsnotec))
                             {
                                foreach($objRsnotec as $key => $value)
                    	      {
                     
                            ?>
                                    <!-- BEGIN NOTIFICATION ITEMS -->
                    		<?php $colr = array('1'=>'info','2'=>'warning','3' => 'success','4'=> 'error');?>
                                     <li class="nav-notification-body alert-success text-<?php echo $colr[$value["status"]];?>">
                                        <a href="<?php echo "#";//echo ISP :: AdminUrl('setting/giventask');?>">
                                              <i class="fa fa-user"></i>
                    			<?php if($value["status"] == '3'){ 
                    				echo 'Task ('.substr($value["task"], 0, 15) .'...)  <small class="pull-right ">Completed</small>';
                    			      } 
                    			?>	
                    
                                        </a>
                                      </li>
                                      
                                    <!-- END NOTIFICATION ITEMS -->
                        	<?php }
                            }
                              ?>      
                  </ul>
                  <!-- END DROPDOWN MENU-->
                </li>
                
                <li id="emsg" class="dropdown nav-messages nav-dd"><a data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-envelope"></i>
              </a></li>

                                                            
              </ul>
            </div>
          </div>
          <!-- /.navbar-collapse-->
        </nav>
        <!-- END NAVBAR-->
      </header>
      <div class="main">
        <!-- END CONTENT-->
  <script type="text/javascript">
  
  $(document).ready(function() {
     
       $(".anotifilog").on('click', function(){
	
var data = $('#notifiids').val();
 
         $.ajax({
	   url: '<?php echo base_url();?>admin/dashboard/admin_setprepage',
	   data: {'changnotifilog' : '1','dataids' : data} ,
	   type: "POST",
	   success: function(json) {

          // alert(json);
	   }
	   });
     });  
     
      $(".pageper").on('click', function(){
	
var data = $(this).val();	
         $.ajax({
	   url: '<?php echo base_url();?>admin/dashboard/admin_setprepage',
	   data: {'perpage' : '1','perpageval' : data} ,
	   type: "POST",
	   success: function(json) {

          // alert(json);
	   }
	   });
setTimeout('location.reload()', 2000);
//return false;
     });
      
                      $("#sidebar-autohide").on('click', function(){
                	
                var data = 0;
                if($('#sidebar-autohide:checkbox:checked').length > 0){
                data = '1';
                }
                
                         $.ajax({
                	   url: '<?php echo base_url();?>admin/dashboard/admin_setprepage',
                	   data: {'autohide' : '1','setdata' : data} ,
                	   type: "POST",
                	   success: function(json) {
                	      // alert(data)
                             if(data==1)
                               {$("#bodyCls").addClass('reduced-sidebar')}
                              else
                                {$("#bodyCls").removeClass('reduced-sidebar')} 
                          // alert(json);
                	   }
                	   });
               //setTimeout('location.reload()', 2000);
                return false;
                     });
                     
                  
 $("#sidebar-dividers").on('click', function(){
	
var data = 0;
if($('#sidebar-dividers:checkbox:checked').length > 0){
data = '1';
}

         $.ajax({
	   url: "<?php echo base_url();?>admin/dashboard/admin_setprepage",
	   data: {'dividers' : '1','setdata' : data} ,
	   type: "POST",
	   success: function(json) {

          // alert(json);
	   }
	   });
setTimeout('location.reload()', 2000);
return false;
     });
                     
    });
  
  $('.marquee').marquee({
    showSpeed:1000, //speed of drop down animation
    scrollSpeed: 10, //lower is faster
    yScroll: 'bottom',  // scroll direction on y-axis 'top' for down or 'bottom' for up
    direction: 'left', //scroll direction 'left' or 'right'
    pauseSpeed: 1000, // pause before scroll start in milliseconds
    pauseOnHover: true,
    duplicated: true  //continuous true or false
    });
 </script>    