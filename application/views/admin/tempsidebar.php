<!--<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>  -->
<script src="<?=ADMIN_THEEM_JS?>jquery-ui.min.js"></script>
<?php
$login_user_sadmin=$this->session->userdata('sadmin');
 if($admininfo["dividers"]=='1') 
 {
 ?> 
<style>
.social-sidebar .menu-content li {
  border-bottom: 1px solid #2a2d36;
}

</style>

<?php
}
  $userleftmenus=dragdropmenu('leftsection');
  $getusermenus=array();
  $module_arr=array();
  
 
  $adminimage=$admininfo["image"];
   $adminusername=$admininfo["username"]; 
  
  
 //$module_arr=array("dashboard","pages","banner","memelist","regions","peopleprofile","ads","affiliate","masterlist","mliststats","stats","calendar","imailboxs","suggestion","emailtemplate");
 $modulename= $this->uri->segment(2); 

?>

    <aside class="social-sidebar custom-slidebar">
       <!-- <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto;"> -->
       <div class="social-sidebar-content">
            <div class="scroll Sidebarheight">
          <!-- BEGIN USER SECTION-->
          <div class="user">
                <?php
                if(!empty($adminimage) && file_exists(SITE_UPLOADPATH.$adminimage) )
                {
                ?>
                <img src="<?php echo SITE_GETUPLOADPATH.$adminimage;?>" width="50" height="46">
                <?php
                }else
                {
                ?>
                <img width="50" height="46" class="avatar" alt="Admin" src="<?=ADMIN_THEEM_IMG?>avatars/avatar-30.png"> 
                <?php
                }
                ?>
       <span><?php echo substr($adminusername,0,15); ?></span>
            <i class="trigger-user-settings fa fa-user" data-toggle="dropdown" aria-expanded="false"></i>
            <div class="user-settings">
              <!-- BEGIN USER SETTINGS TITLE-->
              <h3 class="user-settings-title">Settings shortcuts</h3>
              <!-- END USER SETTINGS TITLE-->
              <!-- BEGIN USER SETTINGS CONTENT-->
              <div class="user-settings-content">
                 <a href="<?=SITE_ADMIN_URL;?>profile/myprofile">
                  <!-- //Notice .icon class-->
                  <div class="icon"><i class="fa fa-user"></i>
                  </div>
                  <!-- //Notice .title class-->
                  <div class="title">My Profile</div>
                  <!-- //Notice .content class-->
                  <div class="content">View your profile</div>
                </a>
                <a href="<?=SITE_ADMIN_URL;?>imailboxs">
                  <!-- //Notice .icon class-->
                  <div class="icon"><i class="fa fa-envelope-o"></i>
                  </div>
                  <!-- //Notice .title class-->
                  <div class="title">View Messages</div>
                  <!-- //Notice .content class-->
                  <div class="content">
                  Click here to go in message board
                   <!-- You have <strong>17</strong>
                    new messages-->
                  </div>
                </a>
                 <a href="<?=SITE_ADMIN_URL;?>dashboard/task">
                  <!-- //Notice .icon class-->
                  <div class="icon"><i class="fa fa-tasks"></i>
                  </div>
                  <!-- //Notice .title class-->
                  <div class="title">View Tasks</div>
                  <!-- //Notice .content class-->
                  <div class="content">
                  Click to get Tasks
                  
                  </div>
                </a>
              </div>
              <!-- END USER SETTINGS CONTENT-->
              <!-- BEGIN USER SETTINGS FOOTER-->
              <div class="user-settings-footer">
                <!--<a href="#more-settings">See more settings</a>-->
              </div>
              <!-- END USER SETTINGS FOOTER-->
            </div>
          </div> 
          <!-- EDN USER SECTION-->
          <!-- BEGIN MENU SECTION-->
          <div class="menu">
            <div class="menu-content" id="sort_items">
              <ul id="social-sidebar-menu sidebar">
                <!-- BEGIN ELEMENT MENU-->
                <!-- //Notice .active class-->
              <?php
               $dashbaordhtml='<li id="dashboard" class="'. ($modulename=='dashboard' ? 'active' : '') .'">';
                  $dashbaordhtml.='<a href="'.SITE_ADMIN_URL.'dashboard">
                    <img alt="Dashboard" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/home.png">
                    <span>Dashboard</span>
                    
                    <span class="badge"></span>
                  </a>
                </li>';
             
               $module_arr["dashboard"]=$dashbaordhtml;
              ?>  
                
                
                <!-- END ELEMENT MENU-->
                <?php //if($login_user_sadmin == '1'){ ?>
                
                 <?php
               $abouthtml='<li id="about" class="'. ($modulename=="pages" ? "active" : "" ).'">';
                  $abouthtml.='<a href="'.SITE_ADMIN_URL.'pages">
                    <img alt="about" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/about.png">
                    <span>About</span>
                    
                    <span class="badge"></span>
                  </a>
                </li>';
               
               $module_arr["about"]=$abouthtml;
             
              ?>  
                
               <?php
               $bannerhtml='<li id="banner" class="'. ($modulename=="banner" ? "active" : "" ).'">';
                  $bannerhtml.='<a href="'.SITE_ADMIN_URL.'banner">
                    <img alt="Manage Banners" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/banner.png">
                    <span>Manage Banners</span>
                    
                    <span class="badge"></span>
                  </a>
                </li>';
               
               $module_arr["banner"]=$bannerhtml;
               
              
              ?>  
                
			  <?php
               $memlisthtml='<li id="memlist" class="'. ($modulename=="memelist" ? "active" : "") .'">';
                  $memlisthtml.='<a href="'.SITE_ADMIN_URL.'memelist">
                    <img alt="Me Me Page" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/premium.png">
                    <span>Me Me Page</span>
                    
                    <span class="badge"></span>
                  </a>
                </li>';
               
               $module_arr["memlist"]=$memlisthtml;
                 
              ?>  	
				
                <?php
               $regionsthtml='<li id="regions" class="'. ($modulename=="regions" ? "active" : "" ).'">';
                  $regionsthtml.='<a href="'.SITE_ADMIN_URL.'regions">
                    <img alt="Country Profiles" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/country.png">
                    <span>Country Profiles</span>
                    
                    <span class="badge"></span>
                  </a>
                </li>';
               
               $module_arr["regions"]=$regionsthtml;
       ?>  	 
		  <?php //}?>
                 
                <?php
               $peopleprofilehtml='<li id="peopleprofile" class="'. ($modulename=="peopleprofile" ? "active" : "") .'">';
                  $peopleprofilehtml.='<a href="'.SITE_ADMIN_URL.'peopleprofile">
                    <img alt="People Profiles" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/people.png">
                    <span>People Profiles</span>
                    
                    <span class="badge"></span>
                  </a>
                </li>';
               
               $module_arr["peopleprofile"]=$peopleprofilehtml;
               
              
               
              ?>  	   
                 
                	   
                
                <?php if($login_user_sadmin == '1'){ ?>
                
                   <?php
               $pollshtml='<li id="polls" class="'. ($modulename=="polls" ? "active" : "" ).'">';
                  $pollshtml.='<a href="#">
                    <img alt="Manage Polls" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/polls.png">
                    <span>Manage Polls</span>
                    
                    <span class="badge"></span>
                  </a>
                </li>';
               
               $module_arr["polls"]=$pollshtml;
               
                
              ?>  
              
                <?php
               $adshtml='<li id="ads" class="'. ($modulename=="ads" ? "active" : "") .'">';
                  $adshtml.='<a href="'.SITE_ADMIN_URL.'ads">
                    <img alt="Manage Ads" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/ads.png">
                    <span>Manage Ads</span>
                    
                    <span class="badge"></span>
                  </a>
                </li>';
               
               $module_arr["ads"]=$adshtml;
             ?>  
              
               <?php
                $affilate_arr=array("affiliate"=>"affiliate","affilateright"=>"affilateright");
               $affilatehtml='<li id="affilate" class="'.( ($modulename=="affiliate" ||  $modulename=="affilateright")  ? "active" : "") .'">';
                  $affilatehtml.='<a href="#affiliate-ui" data-toggle="collapse" data-parent="#social-sidebar-menu">
                    <img alt="Affiliates" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/customers.png">
                    <span>Affiliates</span>
                    
                    <span class="badge"></span>
                  <i class="fa arrow"></i></a>';
               $affilatehtml.='<ul id="affiliate-ui" class="collapse">';
                  
        		$affilatehtml.='<li id=""><a href="'.SITE_ADMIN_URL.'affiliate">Affiliate</a></li>'; 
                $affilatehtml.='<li id=""><a href="'.SITE_ADMIN_URL.'affilateright">Permissions</a></li>';      
                  
                $affilatehtml.='</ul></li>';
               
               $module_arr["affilate"]=$affilatehtml;
           ?>    
               
                <?php }?>
                
                 <?php
               $masterlisthtml='<li id="masterlist" class="'. ($modulename=="masterlist" ? "active" : "") .'">';
                  $masterlisthtml.='<a href="'.SITE_ADMIN_URL.'masterlist">
                    <img alt="Master List" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/sitemap.png">
                    <span>Master List</span>
                    
                    <span class="badge"></span>
                  </a>
                </li>';
               
               $module_arr["masterlist"]=$masterlisthtml;
            ?>   
            <?php
               $catmasterlistthtml='<li id="catmasterlist" class="'. ($modulename=="catmasterlist" ? "active" : "") .'">';
                  $catmasterlistthtml.='<a href="'.SITE_ADMIN_URL.'catmasterlist">
                    <img alt="Master List" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/sitemap.png">
                    <span>Master List Category</span>
                    
                    <span class="badge"></span>
                  </a>
                </li>';
               
               $module_arr["catmasterlist"]=$catmasterlistthtml;
            ?>   
                 <?php
               $mliststatshtml='<li id="mliststats" class="'. ($modulename=="mliststats" ? "active" : "") .'">';
                  $mliststatshtml.='<a href="'.SITE_ADMIN_URL.'mliststats">
                    <img alt="Master List stats" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/banner.png">
                    <span>Master List stats</span>
                    
                    <span class="badge"></span>
                  </a>
                </li>';
               
               $module_arr["mliststats"]=$mliststatshtml;
               
               
               
              ?>  
                
                <?php
        			$seamildata = get_user_semail_list(); 
        			$seamils = explode(',',$seamildata);
        			if(count($seamils) > 1){
        			?>
                    
                      <?php
               $emailshtml='<li id="emails" class="'. ($modulename=="emails" ? "active" : "" ).'">';
                  $emailshtml.='<a href="#menu-ui" data-toggle="collapse" data-parent="#social-sidebar-menu">
                    <img alt="Master List stats" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/email.png">
                    <span>E-mail</span>
                   <span class="badge"></span>
                    <i class="fa arrow"></i>
                  </a>';
                  $emailshtml.='<ul id="menu-ui" class="collapse">';
                   	foreach($seamils as $kemail => $vemail)
        				{
        				    $emailshtml.='	<li id="">
        					  <a href="mailto:'.$vemail.'">'.$vemail.'</a>
        					</li>'; 
                        }    
                  
                $emailshtml.='</ul></li>';
               
               $module_arr["emails"]=$emailshtml;
            ?>  
                <?php } ?>
                
                
                 <?php
               $calendarhtml='<li id="calendar" class="'.( $modulename=="calendar" ? "active" : "") .'">';
                  $calendarhtml.='<a href="'.SITE_ADMIN_URL.'calendar">
                    <img alt="Calendar" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/calendar.png">
                    <span>Calendar</span>';
                    
                         $today_events = get_todayevent();
                       
                     if($today_events > 0) {   
                       $calendarhtml.='<span class="badge">'.$today_events.'</span>';
                         }
                  $calendarhtml.='</a>
                </li>';
               
               $module_arr["calendar"]=$calendarhtml;
               
                ?>  
                
                <?php
               $statshtml='<li id="stats" class="'. ($modulename=="stats" ? "active" : "") .'">';
                  $statshtml.='<a href="'.SITE_ADMIN_URL.'stats">
                    <img alt="Stats" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/statistics.png">
                    <span>Stats</span>
                 </a>
                </li>';
               
               $module_arr["stats"]=$statshtml;
                
              ?>  
                
                 <?php
               $messagehtml='<li id="message" class="'. ($modulename=="imailboxs" ? "active" : "") .'">';
                  $messagehtml.='<a href="'.SITE_ADMIN_URL.'imailboxs">
                    <img alt="Stats" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/old-versions.png">
                    <span>Messages</span>';
                  	if(!isset($EmailCount))
    					{
    						$EmailCount=0;
    						$emailCountArr=CountUnreadMail();
    						if(is_array($emailCountArr)){if(count($emailCountArr)>0){$EmailCount=$emailCountArr['count'];}}
    					}  
                        
                        	if($EmailCount>0) { $messagehtml.='<span class="badge">'.$EmailCount.'</span>'; } 
                 $messagehtml.='</a>
                </li>';
               
               $module_arr["message"]=$messagehtml;
         ?>  
    		   
    		   
               <?php if($login_user_sadmin == '1') { ?>
               
                <?php
               $suggestionhtml='<li id="suggestion" class="'. ($modulename=="suggestion" ? "active" : "") .'">';
                  $suggestionhtml.='<a href="#suggestion-ui" data-toggle="collapse" data-parent="#social-sidebar-menu">
                    <img alt="Suggestions" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/archives.png">
                    <span>Suggestions</span><i class="fa arrow"></i></a>';
               $suggestionhtml.='<ul id="suggestion-ui" class="collapse">';
                  
        		$suggestionhtml.='	<li id=""><a href="'.SITE_ADMIN_URL.'suggestion">Suggestion</a></li>'; 
               $suggestionhtml.='	<li id=""><a href="'.SITE_ADMIN_URL.'suggestion/suggestemail">Email</a></li>';      
                  
                $suggestionhtml.='</ul></li>';
               
               $module_arr["suggestion"]=$suggestionhtml;
          ?> 
               
                <?php
               $emailtemplatehtml='<li id="emailtemplate" class="'.( $modulename=="emailtemplate" ? "active" : "") .'">';
                  $emailtemplatehtml.='<a href="'.SITE_ADMIN_URL.'emailtemplate">
                    <img alt="Mail Templates" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/sitemap.png">
                    <span>Mail Templates</span></a>
                </li>';
               
               $module_arr["emailtemplate"]=$emailtemplatehtml;
               
                 
              ?> 
           	     <?php } ?>  
               <?php
               $affilaterighthtml='<li id="affilateright" class="'. ($modulename=="affilateright" ? "active" : "") .'">';
                  $affilaterighthtml.='<a href="'.SITE_ADMIN_URL.'affilateright">
                    <img alt="Affilate right" src="'.base_url().'images/icons/stuttgart-icon-pack/32x32/archives.png">
                    <span>Permissions</span></a>
                </li>';
               
            //   $module_arr["affilateright"]=$affilaterighthtml;
          ?> 
         
              <?php
            //  echo "<pre>";
            // print_r($module_arr);
             //exit;
            // if(empty($userleftmenus))
            $allotaffilatemodules=allotaffilatemodules();
             // echo "<pre>";
             // print_r($allotaffilatemodules);
            // exit;
            //unset($userleftmenus);
          
            
      
             if(isset($userleftmenus) && count($userleftmenus) > 0 && count($allotaffilatemodules)>0)
             { 
               foreach($userleftmenus as $key => $value)
               {
                 $showmenuname=$value["menuname"];
                 if (array_key_exists($showmenuname, $allotaffilatemodules)) 
                 {
                   echo $module_arr[$showmenuname];
                  }  
               }
             }else
             {
               /*
                foreach($module_arr as $key => $value)
               {
                  $showmenuname=$key;
                  if($key=="about")
                  {
                    echo $key; exit;
                  }  
                 if (array_key_exists($showmenuname, $allotaffilatemodules)) 
                 {
                   echo $module_arr[$showmenuname];
                  }  
               } */
               
                        if(count($allotaffilatemodules)>0)
                               {
                                  foreach($allotaffilatemodules as $key => $value)
                                   {
                                     $showmenuname=$key;
                                     if (array_key_exists($showmenuname, $module_arr)) 
                                     {  
                                       echo $module_arr[$showmenuname];
                                      }  
                                   }
                               }
               
             }
             //echo $catmasterlistthtml;
              ?>      
                    
                       
              </ul>
            </div>
          </div>
          <!-- END MENU SECTION-->
        </div>
      </div>
   </aside>
   <script>
     $(document).ready(function(){ 
	$(function() {
		$("#sort_items ul").sortable({ containment: "parent", update: function() {
		  
			var leftmenuname =  Array(); 
  	        var leftmenureorder =  Array(); 
            var getids="";
             var li=0;
             $('#sort_items ul li').each( function(e) {
                if($(this).attr('id')!= '')
                {
                    getids=$(this).attr('id');
                    leftmenuname[li] = getids;  
                   leftmenureorder[li]= $(this).index() + 1;
            //alert($(this).index() + 1);
            li++;
                                }
                            });
       
               $.ajax({
                    
                   // dataType: 'JSON',
                    type: 'POST',
                    cache: false,
                    url:  '<?php echo base_url();?>admin/dashboard/dragleftmenu',
                    data : {
                    leftmenunames : leftmenuname,
                    leftmenureorders : leftmenureorder
                    },
                    success: function(data){
                        
                       // alert(data);
                    //$("#postlist").html(data);		 
                    // alert(data);  
                    
                    
                    return false;
                    }
                    });  
            
            
            /*
            var order = $(this).sortable("serialize") + '&action=sort'; 
            alert(order);
			$.post("order.php", order); 
            */															 
		}								  
		});
	});
    
    
      
    
});
   </script>