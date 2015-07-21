 <script src="<?=ADMIN_THEEM_JS;?>demo/dashboard.js"></script>
<?php $login_user_sadmin=$this->session->userdata('sadmin'); ?>

<div class="container">
          <div class="row-fluid">
              <h3 class="page-title make_font_normal"><?=$page_title;?></h3>
                <?php echo $breadcrumds;?>
        </div>


<div class="container">
	<div class="row-fluid">
		<!-- BEGIN ICON BUTTONS SET-->
		<div class="btn-icon col-xs-6 col-sm-6 col-md-2 col-md-offset-2 ">
		  <a class="btn btn-success button_masterlist" role="button" href="#"><i class="fa fa-list-alt fa-lg"></i>
			
			<div class="title">Master List</div>
		  </a>
		</div>
		<div class="btn-icon col-xs-6 col-sm-6 col-md-2 ">
		  <a class="btn btn-neutral button_stats" role="button" href="<?=SITE_ADMIN_URL;?>stats"><i class="fa fa-bar-chart-o fa-lg"></i>
			<div class="title">Stats</div>
		  </a>
		</div>
		<div class="btn-icon col-xs-6 col-sm-6 col-md-2 ">
		  <a class="btn btn-success button_calender" role="button" href="<?=SITE_ADMIN_URL;?>calendar"><i class="fa fa-calendar fa-lg"></i>
			<?php 
                   $today_events=get_todayevent();
                  
            if($today_events>0){echo '<span class="label label-success">'.$today_events.'</span>';}?>
			<div class="title">Calendar</div>
		  </a>
		</div>
		<div class="btn-icon col-xs-6 col-sm-6 col-md-2 ">
		  <a class="btn btn-warning button_inbox" role="button" href="#"><i class="fa fa-inbox fa-lg"></i>
			<div class="title">Inbox</div>
			 
		  </a>
		</div>
		<!-- END ICON BUTTONS SET-->
  </div>
  <div class="row">
	<div class="col-md-6">
  	  <!-- //Notice .panel-primary class-->
	  <div class="panel panel-default panel_dashboard">
		<div class="panel-heading">
		  <h3 class="panel-title"><i class="fa fa-desktop"></i>Dashboard Notification</h3>
		</div>
		<div class="panel-body maxheight"><?php echo $get_siteinfo;?></div>
	  </div>
	</div>
   	<div class="col-md-6">
	  <div class="panel panel-primary panel_recent" >
		<div class="panel-heading" id="recent">
		  <div class="panel-title"><i class="fa fa-list"></i> Recent </div>
		  <!-- //Notice .panel-tools class-->
		  <div class="panel-tools pull-right">
			<ul class="nav nav-tabs">
			  <li class="active">
				<a data-toggle="tab" href="#tab_home" aria-expanded="true">Profiles</a>
			  </li>
			  <li class="">
				<a data-toggle="tab" href="#tab_profile" aria-expanded="tryue">Affiliates Activities</a>
			  </li>
			</ul>
		  </div>
		</div>
       	<div class="panel-body  full_width padding_left_right_zero">
		  <div class="tab-content full_width">
			<div id="tab_home" class="tab-pane active users-feed userprofile">
			  <div class="scroll maxheight_recent">
			
					<?php
                    
                    $admin_getprofile=admin_getprofile();
                   if(!empty($admin_getprofile))
                   {
                    	$i=1;
					foreach($admin_getprofile as $key=> $objRow)
					{
						if($objRow['image']!="")
								{$profimg =SITE_GETUPLOADPATH.$objRow['image']; }
							else
								{$profimg =SITE_CSSURL.'newadmin/img/avatar-55.png';}
				
					?>
                      <?php echo ($i%2!=0) ? '<div class="row-fluid profile_each_row">' : ''?>
				  
				    <div class="col-md-6">	
                    
					  <!-- //Notice .feed-avatar class-->
                      <div class="col-md-5 padding_left_right_zero pull-left">	
					       <img src="<?=$profimg;?>" alt="<?=$objRow['title'];?>" class="feed-avatar profile_image">
                      </div> 
                      <div class="col-md-7 pull-right padding_left_right_zero">
                      <div class="row-fluid">
					  <?php 
					  	if($login_user_sadmin == '1' || $objRow['status'] == '1' || ($this->session->userdata('uid') == $objRow['admin_id'] && $objRow['status'] == '2'))
							{
							?>
							<a href="<?=SITE_ADMIN_URL;?>pages/edit-profile/id/<?=$objRow['admin_id'];?>" class="userprofilename"><span><?=$objRow['title']?></span></a>
							<?php
							}
						else
						{ ?><span><?=$objRow['title']?></span><?php }
					  ?>
					  </div>
					  <div class="row-fluid"><small class="tag_userprofilename">Affiliates  - <?php echo $objRow['username'];?></small></div>
					  <!-- //Notice .feed-time class-->
					  <div class="row-fluid">
					  	<?php $colr = array('1'=>'success','2'=>'warning','3' => 'ready','4'=> 'danger');?>
						<button type="button" class="profile_button btn btn-mini btn-<?php echo $colr[$objRow['status']];?>">
						<?php $stas = array('1'=>'AVAILABLE','2'=>'PENDING','3' => 'READY','4'=> 'USED'); echo $stas[$objRow['status']];?>
						</button>
					  </div>
                      
				       </div>
				     </div>
                    <?php echo ($i%2==0) ? '</div> ' : ''?>
                 
                  <?php  $i++;	
                   }
                  } 
                   
                  ?>
			  </div>
			</div>
			<div id="tab_profile" class="tab-pane  activities-feed">
                      <!-- //Notice .scroll class-->
                      <div class="scroll maxheight_recent">
                        
						<?php
						foreach($admin_getaffiliatelog as $key => $objRow)
						{
							if(strpos($objRow['log_msg'],'added'))
								{$lclr = 'success';$lsin = 'check';}
							else if(strpos($objRow['log_msg'],'edited'))
								{$lclr = 'info';$lsin = 'edit';}
							else if(strpos($objRow['log_msg'],'deleted'))
								{$lclr = 'warning';$lsin = 'remove'; }
							?>
                           <div class="col-md-12"> 
						      <div class="col-md-8 padding_left_right_zero activity_row"> 
								<a href="#ignore">
									<div class="label label-<?php echo $lclr;?>"><i class="fa fa-<?php echo $lsin;?>"></i></div>
								  	<span><?php echo $objRow['log_msg'];?> by <?php echo $objRow['username'];?></span>
								  </a>
                                </div>  
                                 <div class="col-md-4 activity_time">   
								  <!-- //Notice .feed-time class-->
								  <span class="feed-time">
									<em>
									<?php   
									  if(date('Y-m-d') == date('Y-m-d',strtotime($objRow['date']))){
										   echo date('h:i a ',strtotime($objRow['date']));
										  }else{
										echo date('M d,Y h:i a ',strtotime($objRow['date']));
										  } 
									 ?>
									</em>
								  </span>
								 </div>
							  </div>
							<?php
						}
						?>
                       
                      </div>
                    </div>
		  </div>
		</div>
		<!--<div class="panel-footer">Panel footer</div> -->
	  </div>
	</div>
  </div>
  <div class="row">
  	<div class="col-md-6">
              <div class="panel panel_location">
                <div class="panel-heading panel-success">
                  <div class="panel-title"><i class="icon-map-marker"></i>&nbsp;Visits by location</div>
                </div>
                <div class="panel-body maxheight">
                   <div id="vmap-world" class="vmap"></div>
                </div>
              </div>
      </div>  
      
      <div class="col-md-6">
              <div class="panel panel-primary panel_tracking ">
                <div class="panel-heading">
                  <div class="panel-title">Referral source Tracking</div>
                </div>
                <div class="panel-body maxheight">
                  <div id="pie-chart" class="plot"></div>
                </div>
              </div>
      </div>  
      
   </div>                  
  <div class="row">
  	<div class="col-md-6">
              <div class="panel panel-primary  panel_chat">
                <div class="panel-heading">
                  <div class="panel-title"><i class="fa fa-comments"></i>Chat</div>
                </div>
                <div class="panel-body maxheight_chat">
                  <ul class="scroll">
                    <?php
					
					foreach($admin_getchatmsg as $key => $objRow )
					{
					?>
					<li class="<?php echo ($key%2 == 0 ) ? 'left' : 'right'?> chat-message clearfix">
                      <!-- //Notice .chat-avatar class-->
                      <span class="chat-avatar pull-<?php echo ($key%2 == 0 ) ? 'left' : 'right'?>">
					 	<?php 
							
							if($objRow['image']=="")
								{$adminimg =SITE_GETUPLOADPATH.$objRow['image']; }
							else
								{$adminimg =SITE_CSSURL.'newadmin/img/avatar-55.png';}
								?>	 	
                        <img src="<?=$adminimg;?>" alt="<?php echo $objRow['username'];?>">
                      </span>
                      <!-- //Notice .chat-body class-->
                      <div class="chat-body clearfix">
                        <div class="header"><strong class="primary-font"><?php echo $objRow['username'];?> </strong>
                          <small class="pull-<?php echo ($key%2 == 0 ) ? 'left' : 'right'?>">
                            <span class="fa fa-clock-o"></span>
							<?php    
							  	if(date('Y-m-d') == date('Y-m-d',strtotime($objRow['date'])))
							  		{echo date('h:i a ',strtotime($objRow['date']));}
								else
									{echo date('M d,Y h:i a ',strtotime($objRow['date']));} 
							 ?>
							
                          </small>
                        </div>
                        <div class="chat-body-content">
                          <?php echo html_entity_decode(stripslashes($objRow['message']));?>
                        </div>
				      </div>
                        <div class="chat-delete-button">
                            	<?php if($login_user_sadmin==1) {?>
        						      <button id="<?php echo $objRow['id'];?>" class="btn btn-mini btn-danger" type="button">Delete</button>
        						<?php } ?>
                        </div>
                    </li>
                   <?php
					}
					?>
					
                  </ul>
                </div>
                <div class="panel-footer">
                  <div class="input-group col-sm-10">
                    <form name="frmContent" id="chatmsg" method="post" onsubmit="return ValidateChatForm();">
						<input id="composerMessage" name='md_message' autocomplete="off" type="text" placeholder="Type your message here..." class="form-control">
						<span class="input-group-btn">
							<button id="btn-chat" onclick="submitDetailsForm();" type="submit" class="btn btn-success btn-sm">Send</button>
						</span>
					</form>
                  </div>
                </div>
              </div>
            </div>
	<div class="col-md-6">
	  <div class="panel panel-default panel-calendar">
      <div class="panel-heading">
		  <h3 class="panel-title"><i class="fa fa-calendar"></i>Calendar</h3>
		</div>
       <div class="maxheight"> 
		<div class="panel-body">
			<div class="col-md-12">
		  		<div id="calendar1" class="social-box-calendar"></div>
		  	</div>
		</div>
       </div> 
	  </div>
	</div>
  </div>
</div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/jquery.slimscroll/jquery.slimscroll.min.js"></script>
  <script src="http://dev.islandpeeps.com/css/newadmin/plugins/jquery.fullcalendar/fullcalendar.min.js"></script>
   
   <script>
      $(function() {
        // Chat inbox
        $(".maxheight_chat").slimScroll({
          height: '380px',
        });
         $(".maxheight_recent").slimScroll({
          height: '435px',
        });
         $(".maxheightt").slimScroll({
          height: '450px',
        });
      });  
       </script>
<script>
  //$(document).ready(function(){
  test();
  function test()
  {
	  var date = new Date();
	  var d = date.getDate();
	  var m = date.getMonth();
	  var y = date.getFullYear();
	
	  var calendar = $('#calendar1').fullCalendar({
												   editable: true,
												    
												   events: "<?=SITE_ADMIN_URL;?>events/ajax",
												   // Convert the allDay from string to boolean
												   eventRender: function(event, element, view) 
													{
														if (event.type =='nd'){element.draggable = false;}
														if (event.allDay === 'true') 
															{event.allDay = true;} 
														else 
															{event.allDay = false;}
												   },
												   selectable: true,
												   selectHelper: true,
												   select: function(start, end, allDay) 
												   {
														var title = prompt('Event Title:');
														if (title) 
															{
															   var start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
															   var end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
																$.ajax({
																		url:"<?=SITE_ADMIN_URL;?>setting/add_events",
																		data: 'title='+ title+'&start='+ start +'&end='+ end  ,
																		type: "POST",
																		success: function(json) 
																		{}// alert(json);
																	});
																calendar.fullCalendar('renderEvent', { title: title, start: start, end: end, allDay: allDay },true );// make the event "stick"
															}
														calendar.fullCalendar('unselect');
												   },
												   editable: true,
												   eventDrop: function(event, delta) 
														{
														   var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
														   var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
															$.ajax({
																	   url: "<?=SITE_ADMIN_URL;?>setting/update_events",
																	   data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
																	   type: "POST",
																	   success: function(json) {}// alert(json);
																	});
														},
													eventClick: function(event) 
														{
															var decision = confirm("Do you really want to Delete?"); 
															if (decision) 
																{	
																	$.ajax({type: "POST",url: "<?=SITE_ADMIN_URL;?>setting/delete_events",data: "&id=" + event.id, type: "POST",
																			  success: function(json) {}//alert("Updated Successfully");
																		});
																	$('#calendar1').fullCalendar('removeEvents', event.id);
																} 
														},
												   eventResize: function(event) 
														{
														   var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
														   var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
														   $.ajax({
																	url: "<?=SITE_ADMIN_URL;?>setting/update_events",
																	data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
																	type: "POST",
																	success: function(json) {}//alert("Updated Successfully");
																});
														}
  												});
// });
 }
</script>