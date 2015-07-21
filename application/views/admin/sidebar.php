<?php
$login_user_sadmin=$this->session->userdata('sadmin');
?>
<?php $admininfo=get_admininfo(); ?>

<aside class="social-sidebar <?php  echo $admininfo["autohide"]=='1' ?  'auto-hide' :'sidebar-full' ?>  <?php  echo $admininfo["dividers"]=='1' ?  'dividers' :'' ?> ">
	<div class="social-sidebar-content">
    <div class="scroll Sidebarheight">
	  <!-- BEGIN USER SECTION-->
	  <div class="user" id="sidebar_user">
		<!-- //Notice .avatar class-->
		<img width="25" height="25" src="<?=ADMIN_THEEM_IMG;?>avatars/avatar-30.png" alt="Admin" class="avatar"> 
		<span>Admin</span>
		  
		 
	  </div>
	  <!-- END USER SETTINGS SECTION-->
	  <!-- EDN USER SECTION-->
	  
	  
	  <div class="clearfix"></div>
	  <!-- END SEARCH SECTION-->
	  <!-- BEGIN MENU SECTION-->
	  <div class="menu">
		<div class="menu-content">
		  <ul id="social-sidebar-menu">
			<!-- BEGIN ELEMENT MENU-->
			<!-- //Notice .active class-->
			<li class="active">
			  <a href="<?=SITE_ADMIN_URL;?>">
				<!-- icon-->
                <!--<i class="fa fa-home"></i> -->
                <img alt="Dashboard" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/home.png">
                
				<span>Dashboard</span>
				<!-- badge-->
				<!--<span class="badge">9</span>-->
			  </a>
			</li>
			<?php if($login_user_sadmin == '1'){ ?>
				<li><a href="<?=SITE_ADMIN_URL;?>pages">
                <!--<i class="fa fa-info-circle"></i> -->
                <img alt="About" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/about.png">
                <span>About</span></a>
               </li>
				<li><a href="<?=SITE_ADMIN_URL;?>banner">
                <!--<i class="fa fa-cogs"></i> -->
                <img alt="Banner" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/banner.png">
                <span>Manage Banners</span></a></li>
				<li><a href="<?=SITE_ADMIN_URL;?>memelist">
                <!--<i class="fa fa-eye"></i> -->
                <img alt="Member List" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/premium.png">
                <span>Me Me Page</span></a></li>
				<li><a href="<?=SITE_ADMIN_URL;?>regions">
                <!--<i class="fa fa-flag"></i> -->
                <img alt="Regions" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/country.png">
                <span>Country Profiles</span></a></li>
			<?php }?>
			
			<li><a href="<?=SITE_ADMIN_URL;?>peopleprofile"> <!--<i class="fa fa-user"></i> -->
              <img alt="People Profiles" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/people.png">
            <span>People Profiles</span></a></li>
			
			<?php if($login_user_sadmin == '1'){ ?>
				<li><a href="<?=SITE_ADMIN_URL;?>pages/update-social-media-poll">
                <!--<i class="fa fa-cutlery"></i> -->
                <img alt="Manage Polls" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/polls.png">
                <span>Manage Polls</span></a></li>
				<li><a href="<?=SITE_ADMIN_URL;?>ads"> <!--<i class="fa fa-adn"></i> -->
                 <img alt="Manage Ads" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/ads.png">
                <span>Manage Ads</span></a></li>
				<li><a href="<?=SITE_ADMIN_URL;?>affiliate">
                <!--<i class="fa fa-comments"></i> -->
                <img alt="Affiliates" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/customers.png">
                <span>Affiliates</span></a></li>
			<?php }?>
			<li><a href="<?=SITE_ADMIN_URL;?>masterlist"> <!--<i class="fa fa-crosshairs"></i> -->
            <img alt="Master List" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/sitemap.png">
            <span>Master List</span></a></li>
			<li><a href="<?=SITE_ADMIN_URL;?>stats/masterstats"> <!--<i class="fa fa-bullhorn"></i> -->
            <img alt="Master List stats" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/banner.png">
            <span>Master List stats</span></a></li>
			<?php
			$seamildata = get_user_semail_list(); 
			$seamils = explode(',',$seamildata);
			if(count($seamils) > 1){
			?>
				<li>
			  <a href="#menu-ui" data-toggle="collapse" data-parent="#social-sidebar-menu">
				<!-- icon-->
                <!--<i class="fa fa-cogs"></i> -->
                <img alt="E-mail" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/email.png">
				<span>E-mail</span>
				<!-- arrow--><i class="fa arrow"></i>
			  </a>
			  <!-- BEGIN SUB-ELEMENT MENU-->
			  <ul id="menu-ui" class="collapse">
			  	<?php
				foreach($seamils as $kemail => $vemail)
				{
					?>
					<li>
					  <a href="<?php echo $vemail;?>"><?php echo $vemail;?></a>
					</li>
					<?php
				}
				?>
			  </ul>
			  <!-- END SUB-ELEMENT MENU-->
			</li>
			<?php
			}?>    
			<li>
			  <a href="<?=SITE_ADMIN_URL;?>calendar" target="">
				<!-- icon-->
                <!--<i class="fa fa-calendar"></i> -->
                <img alt="Calendar" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/calendar.png">
				<span>Calendar</span>
				<!-- badge-->
				<?php
				if(!isset($today_events)){$today_events = get_todayevent();}
				if($today_events>0) { ?><span class="badge"><?=$today_events;?></span><?php } ?>
			  </a>
			</li>
			<li><a href="<?=SITE_ADMIN_URL;?>stats">
            <!--<i class="fa fa-gear"></i> -->
              <img alt="Stats" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/statistics.png">
            <span>Stats</span></a></li>
			<li>
				<a href="<?=SITE_ADMIN_URL;?>">
                <!--<i class="fa fa-microphone"></i> -->
                 <img alt="Messages" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/old-versions.png">
                <span>Messages</span>
				<?php
				if(!isset($EmailCount))
					{
						$EmailCount=0;
						$emailCountArr=CountUnreadMail();
						if(is_array($emailCountArr)){if(count($emailCountArr)>0){$EmailCount=$emailCountArr['count'];}}
					}
				if($EmailCount>0) { ?><span class="badge"><?=$EmailCount;?></span><?php } ?>
				</a>
			</li>
			<?php if($login_user_sadmin == '1')
				{ ?>
				<li><a href="<?=SITE_ADMIN_URL;?>suggestion"> <!--<i class="fa fa-group"></i> -->
                 <img alt="Suggestion" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/archives.png">
                <span>Suggestion</span></a></li>
				<li><a href="<?=SITE_ADMIN_URL;?>emailtemplate"> <!--<i class="fa fa-maxcdn"></i> -->
                <img alt="Mail Templates" src="<?php echo base_url();?>images/icons/stuttgart-icon-pack/32x32/sitemap.png">
                <span>Mail Templates</span></a></li>
			<?php } ?>
 			<!-- END ELEMENT MENU-->
		  </ul>
		</div>
	  </div>
	  <!-- END MENU SECTION-->
	</div>
 </div>   
</aside>
 