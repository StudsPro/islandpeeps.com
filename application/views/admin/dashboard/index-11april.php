
<?php $login_user_sadmin=$this->session->userdata('sadmin'); ?>
<style>
.abday.fc-event {
  color: #246887;
}
.fc-event-time, .fc-event-title {
  padding: 0 1px;
}
.fc-event {
  font-size: 0.85em;
}
.fc-ltr .fc-event-hori.fc-event-end, .fc-rtl .fc-event-hori.fc-event-start {
  border-bottom-right-radius: 3px;
  border-right-width: 1px;
  border-top-right-radius: 3px;
}
.fc-ltr .fc-event-hori.fc-event-start, .fc-rtl .fc-event-hori.fc-event-end {
  border-bottom-left-radius: 3px;
  border-left-width: 1px;
  border-top-left-radius: 3px;
}
.fc-event {
  background-color: #f19718 !important;
  border-color: #f89406 !important;
}
.inday.fc-event {
  color: #a59505;
}
.evtday.fc-event {
  color: #009100;
}
.panel-calendar .fc-button {
    top: 3px !important;
}
</style>


<div class="container">
          <div class="row-fluid">
              <h3 class="page-title make_font_normal"><?=$page_title;?></h3>
                <?php echo $breadcrumds;?>
        </div>


<div class="container">
	<div class="row-fluid">
		<!-- BEGIN ICON BUTTONS SET-->
		<div class="btn-icon col-xs-6 col-sm-6 col-md-2 col-md-offset-2">
		  <a class="btn btn-success button_masterlist" role="button" href="<?=SITE_ADMIN_URL;?>masterlist"><i class="fa fa-list-alt fa-lg"></i>
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
                  
            if($today_events>0){echo '<span class="label label-success label-calender">'.$today_events.'</span>';}?>
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
  <style>
  .new_col6 > div:nth-child(2n+1) {
  clear: both;
}
.dashclass{
    cursor: move;
}
  </style>
 <?php
    $userdashboardmenus=dragdropmenu('dashboardsection');
    $rside_dashboard=array();
    //echo "<pre>";print_r($userdashboardmenus);exit;
 ?> 
  
  <div class="col-md-12 new_col6 grid" id="dashboardsort_items ">
   	   <?php
     $rightdashhtml='<div class="col-md-6 dashclass span2" id="rdashboard">
  	    <div class="panel panel-default panel_dashboard">
		<div class="panel-heading">
		  <h3 class="panel-title"><i class="fa fa-desktop"></i>Dashboard Notification</h3>
		</div>
		<div class="panel-body maxheight">'.$get_siteinfo.'</div>
	  </div>
	  </div>';
    
    $rside_dashboard["rdashboard"]=$rightdashhtml;
    
    ?>
       
       <?php
     $recenthtml='<div class="col-md-6 dashclass span2" id="rrecent">
	  <div class="panel panel-primary panel-recent" >
		<div class="panel-heading" id="recent">
		  <div class="panel-title recent-title"><i class="fa fa-list"></i> Recent </div>
		  <!-- //Notice .panel-tools class-->
		  <div class="panel-tools pull-right recent-tabs">
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
			  <div class="scroll maxheight_recent">';
			
				
                    
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
				
				
                      $recenthtml.=($i%2!=0) ? '<div class="row-fluid profile_each_row">' : '';
				  
				    $recenthtml.='<div class="col-md-6">	
                    
					  
                      <div class="col-md-5 padding_left_right_zero pull-left">	
					       <img src="'.$profimg.'" alt="'.$objRow['title'].'" style="width:68px;" class="feed-avatar profile_image">
                      </div> 
                      <div class="col-md-7 pull-right padding_left_right_zero">
                      <div class="row-fluid">';
					  
					  	if($login_user_sadmin == '1' || $objRow['status'] == '1' || ($this->session->userdata('uid') == $objRow['admin_id'] && $objRow['status'] == '2'))
							{
						
							$recenthtml.='<a href="'.SITE_ADMIN_URL.'peopleprofile/edit/'.$objRow['admin_id'].'"  class="userprofilename"><span>'.$objRow['title'].'</span></a>';
							
							}
						else
						{ $recenthtml.='<span>'.$objRow['title'].'</span>'; }
					 
					  $recenthtml.='</div>
					  <div class="row-fluid"><small class="tag_userprofilename">Affiliates  - '.$objRow['username'].'</small></div>
					  
					  <div class="row-fluid">';
					  $colr = array('1'=>'success','2'=>'warning','3' => 'ready','4'=> 'danger');
						$recenthtml.='<button type="button" class="profile_button btn btn-mini btn-'.$colr[$objRow['status']].'">';
						 
                         $stas = array('1'=>'AVAILABLE','2'=>'PENDING','3' => 'READY','4'=> 'USED'); 
                         
                          $recenthtml.=''.$stas[$objRow['status']].'';
						$recenthtml.='</button>
					  </div>
                      
				       </div>
				     </div>';
                     $recenthtml.=($i%2==0) ? '</div> ' : '';
                 
                  $i++;	
                   }
                  } 
                   
                  
			   $recenthtml.='</div>
			</div>
			<div id="tab_profile" class="tab-pane  activities-feed">
                     
                      <div class="scroll maxheight_recent">';
                        
						
						foreach($admin_getaffiliatelog as $key => $objRow)
						{
							if(strpos($objRow['log_msg'],'added'))
								{$lclr = 'success';$lsin = 'check';}
							else if(strpos($objRow['log_msg'],'edited'))
								{$lclr = 'info';$lsin = 'edit';}
							else if(strpos($objRow['log_msg'],'deleted'))
								{$lclr = 'warning';$lsin = 'remove'; }
						
                           $recenthtml.='<div class="col-md-12"> 
						      <div class="col-md-8 padding_left_right_zero activity_row"> 
								<a href="#ignore">
									<div class="label label-'.$lclr.'"><i class="fa fa-'.$lsin.'"></i></div>
								  	<span>'.$objRow['log_msg'].' by '.$objRow['username'].'</span>
								  </a>
                                </div>  
                                 <div class="col-md-4 activity_time">   
								 
								  <span class="feed-time">
									<em>';
								  
									  if(date('Y-m-d') == date('Y-m-d',strtotime($objRow['date']))){
										    $recenthtml.=''. date('h:i a ',strtotime($objRow['date'])).'';
										  }else{
										 $recenthtml.=''. date('M d,Y h:i a ',strtotime($objRow['date'])).'';
										  } 
									$recenthtml.='</em>
								  </span>
								 </div>
							  </div>';
						
						}
					
                       
                      	$recenthtml.='</div>
                    </div>
		  </div>
		</div>
	
	  </div>
	</div>';
    
    $rside_dashboard["rrecent"]=$recenthtml;
    
    ?>
    
    
   	 <?php
     $maphtml='<div class="col-md-6 dashclass span2" id="rmap">
              <div class="panel panel_location">
                <div class="panel-heading panel-success">
                  <div class="panel-title"><i class="icon-map-marker"></i>&nbsp;Visits by location</div>
                </div>
                <div class="panel-body scroll maxheight_visit">
                   <div id="vmap-world" class="vmap" style="width: 500px; height: 450px;"></div>
                </div>
              </div>
      </div>  ';
    
    $rside_dashboard["rmap"]=$maphtml;
    
    ?>
 
  	 <?php
     $rsthtml=' <div class="col-md-6 dashclass span2" id="rrst">
              <div class="panel panel-primary panel_tracking ">
                <div class="panel-heading">
                  <div class="panel-title">Referral source Tracking</div>
                </div>
                <div class="panel-body maxheight_resouce">
                  <div id="pie-chart" style="height:500px" class="plot"></div>
                </div>
              </div>
      </div>';
    
    $rside_dashboard["rrst"]=$rsthtml;
    
    ?>
      
      
       <?php
     $chattml='<div class="col-md-6 dashclass span2" id="rchat">
              <div class="panel panel-default panel-chat">
                <div class="panel-heading">
                  <div class="panel-title"><i class="fa fa-comments"></i>Chat
                  </div>
                </div>
                <div class="panel-body">
                  <ul class="scroll maxheight_chat">';
                    
					foreach($admin_getchatmsg as $key => $objRow )
					{
					
					$chattml.='<li class="'.(($key%2 == 0 ) ? 'left' : 'right').' clearfix" id="getchatid_'.$objRow['id'].'">';
                     
                      $chattml.='<span class="chat-avatar pull-'.(($key%2 == 0 ) ? 'left' : 'right').'">';
					 	if($objRow['image']=="")
								{$adminimg =SITE_GETUPLOADPATH.$objRow['image']; }
							else
								{$adminimg =SITE_CSSURL.'newadmin/img/avatar-55.png';}
									 	
                        $chattml.='<img src="'.$adminimg.'" alt="'.$objRow['username'].'">
                      </span>
                     
                      <div class="chat-body clearfix">
                        <div class="header"><strong class="primary-font '. (($key%2 == 0 ) ? ' ' : 'pull-right').'">'.$objRow['username'].' </strong>
                          <small class="'.(($key%2 == 0 ) ? 'pull-right' : ' ').' text-muted">
                            <span class="fa fa-clock-o"></span>';
							   
							  	if(date('Y-m-d') == date('Y-m-d',strtotime($objRow['date'])))
							  		{$chattml.=''.date('h:i a ',strtotime($objRow['date'])).''; }
								else
									{$chattml.=''.date('M d,Y h:i a ',strtotime($objRow['date'])).'';} 
							
							
                          $chattml.='</small>
                        </div>
                        <p class="chat-body-content">
                          '.html_entity_decode(stripslashes($objRow['message'])).'
                        </p>
				      </div>
                        <div class="chat-delete-button pull-right">';
                            	 if($login_user_sadmin==1) {
                            	   
        						      $chattml.='<button id="'.$objRow['id'].'" onclick="deletechat('.$objRow['id'].');" class="btn btn-mini btn-danger" type="button">Delete</button>';
        						 } 
                        $chattml.='</div></li>';
                   
					}
					
                  $chattml.='</ul>
                </div>
                <div class="panel-footer">
                  <div class="input-group col-lg-10 col-md-10 col-xs-10 col-sm-11">';
                    
                          $chatid=0; 
                            $getclass="class='form-control input-md'";
                          $hidden = array("id"=>$chatid);
                          $fromurl= "admin/dashboard/addchat";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'chatmsg');
                         $chattml.=''.form_open_multipart($fromurl, $attributes, $hidden).'';
                        
                    
						$chattml.='<input id="composerMessage" name="md_message" autocomplete="off" type="text" placeholder="Type your message here..." class="form-control">
						<span class="input-group-btn">
							<button id="btn-chat"  type="submit" class="btn btn-success btn-sm">Send</button>
						</span>';
					  $chattml.=''.form_close().'';
                  $chattml.='</div>
                </div>
              </div>
            </div>';
    
    $rside_dashboard["rchat"]=$chattml;
    
    ?>
  
       <?php
     $rcalendarhtml='<div class="col-md-6 dashclass span2" id="rcalendar">
	  <div class="panel panel-default panel-calendar">
      <div class="panel-heading">
		  <h3 class="panel-title"><i class="fa fa-calendar"></i>Calendar</h3>
		</div>
      
		<div class="panel-body scroll maxheight  maxheight_calender">
			<div class="col-md-12">
		  		<div id="calendar1" style="width:100%"></div>
		  	</div>
		</div>
       
	  </div>
	</div>';
    
    $rside_dashboard["rcalendar"]=$rcalendarhtml;
    
   
            //  echo "<pre>";
            // print_r($module_arr);
             //exit;
            // if(empty($userleftmenus))
             if(isset($userdashboardmenus) && count($userdashboardmenus) > 0)
             {
               foreach($userdashboardmenus as $key => $value)
               {
                 $showmenuname=$value["menuname"];
                 echo $rside_dashboard[$showmenuname];
               }
             }else
             {
              
                foreach($rside_dashboard as $key => $rsidedashboard)
                             {
                                echo $rsidedashboard;
                             }
             }
                
            
    
    
    ?>
  	

    
  </div>
</div>
</div>
<!--<div class="row grid span8">
    <div class="well span2 tile">A</div>
    <div class="well span2 tile">B</div>
    <div class="well span2 tile">C</div>
    <div class="well span4 tile">D</div>
</div>-->
 <?php
      include "gapi/gapi.php"; 
    //  echo $userType; 
     // echo "Test<br>";
   //  echo $mobdiv;
   //   '{ label: "Apple iPhone [15]",data: 15 },{ label: "Apple iPad [4]",data: 4 }';
   //   exit;
   
   $eventsurl = base_url().'admin/calendar/getdata'; //'http://'.$_SERVER["HTTP_HOST"].ROOT_FOLDER.'/events.php?g=full';
     ?>          
			 <!--main content -->
   
   <script src="<?php echo ADMIN_THEEM_JS;?>plugins/jquery.jqvmap/jquery.vmap.min.js"></script>
    <script src="<?php echo ADMIN_THEEM_JS;?>plugins/jquery.jqvmap/maps/jquery.vmap.world.js"></script>
   
  	<script>
    var sample_data = {<?php echo rtrim($sampledata,",");?>};
    

    $('#vmap-world').vectorMap({
    map: 'world_en',
    backgroundColor: null,
    color: '#ffffff',
    hoverOpacity: 0.7,
    selectedColor: '#666666',
    enableZoom: true,
    showTooltip: true,
    values: sample_data,
    scaleColors: ['#C8EEFF', '#006491'],
    normalizeFunction: 'polynomial'
});
    
    
      $(function() {
      //  var urlAvatar = "../assets/img/avatar-55.png";
        //  Dashboard.init({urlAvatar:urlAvatar});
        });
    </script>
    
    
    <script src="<?=ADMIN_THEEM_JS?>amcharts/raphael.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>amcharts/amcharts.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/jquery.slimscroll/jquery.slimscroll.min.js"></script>
  <script src="http://dev.islandpeeps.com/css/newadmin/plugins/jquery.fullcalendar/fullcalendar.min.js"></script>
   <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
   
   <script>
       	var userTypeChart = '<?= $userType ? 'yes' : ''?>';
		var pieDataUserType1 = [<?= rtrim($userType,',')?>];
		
		var deviceChart = '<?= $device ? 'yes' : ''?>';
		var pieDataDevice = [<?=rtrim($device,',')?>];
		
		var mobdivChart = '<?= $mobdiv ? 'yes' : ''?>';
		var pieDataMobileDevice = [<?=rtrim($mobdiv,',')?>];
		
		var sourceChart = '<?= $sourcemedium ? 'yes' : ''?>';
		var pieDataSource = [<?=rtrim($sourcemedium,',')?>];
		
		var keywordChart = '<?= $gkeyword ? 'yes' : ''?>';
		var pieDataKeyword = [<?=rtrim($gkeyword,',')?>];
		
		var socialChart = '<?= $socialtr ? 'yes' : ''?>';
		var pieDataSocial = [<?=rtrim($socialtr,',')?>];
		
		var countryChart = '<?= $countries ? 'yes' : ''?>';
		 
        //var pieDataCountry = [<?=rtrim($countries,',')?>];
         var pieDataCountry = [<?=rtrim($countries,',')?>];
         
         		
		var cityChart = '<?= $cities ? 'yes' : ''?>';
		var pieDataCity = [<?=$cities?>];
	
		var browsersChart = '<?= $browsers ? 'yes' : ''?>';
		var pieDataBrowsers = [<?=rtrim($browsers,',')?>];
		
		var osChart = '<?= $os ? 'yes' : ''?>';
		var pieDataOS = [<?=rtrim($os,',')?>];
		
		var networkLocationsChart = '<?= $networkLocations ? 'yes' : ''?>';
		var pieDataNetworkLocations = [<?=rtrim($networkLocations,',')?>];
		
		var screenResolutionsChart = '<?= $screenResolutions ? 'yes' : ''?>';
		var pieDataScreenResolutions = [<?=rtrim($screenResolutions,',')?>];
		
		var socialChart = '<?= $socialtr ? 'yes' : ''?>';
		var pieDataSocial = [<?=rtrim($socialtr,',')?>];
		
		var pageTrackChart = '<?= $pagetrackingviews ? 'yes' : ''?>';
		var chartDataPageTrack = [<?=rtrim($pagetrackingviews,',')?>];
   
   
     if(sourceChart){
          	    AmCharts.ready(function () {  	  
				pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataSource;
				pie.titleField = "label";
				pie.valueField = "data";
				pie.outlineColor = "#FFFFFF";
				pie.outlineAlpha = 0.8;
				pie.outlineThickness = 2;
				pie.labelRadius = -30;
				pie.labelText = "[[value]]";
				pie.startDuration = 0;
				// this makes the chart 3D
				pie.depth3D = 15;
				pie.angle = 30;
				pie.colors = "#76ba35,#00AFF0,#C72C95,#F8FF01,#FF6600,#04D215,#2A0CD0,#FF0F00,#B0DE09,#0D52D1,#0D5221,#76b035,#06AFF0,#C70C95,#58FF01,#B05209,#44D215,#2A0C95,#2F0F0F,#B05E09".split(",");
				
				legend = new AmCharts.AmLegend();
				legend.position = "bottom";
				legend.borderAlpha = 0;
				legend.horizontalGap = 10;
				legend.switchType = "x"; // or v
				legend.valueText = "";
				pie.addLegend(legend);
				// WRITE
				pie.write("pie-chart");
                });
			}
   
   
   	function check_trim(getstrid)
	{
	  if(!$.trim($('#'+getstrid).val()).length) {
                return false;
            }else
			{
				 return true;
			}
	}
  
  	
	$("#btn-chat").bind('click',function(){
     
		if(check_trim('composerMessage')==false)
		{
		  alert("Message should not be blank");
		  $('#composerMessage').val("");
		   $('#composerMessage').focus();
		   return false
		}
    
        $("#chatmsg").submit();
    });    
   
   function deletechat(strid)
   {
     $.ajax({
                    
                   // dataType: 'JSON',
                    type: 'POST',
                    cache: false,
                    url:  '<?php echo base_url();?>admin/dashboard/deletechat',
                    data : {
                     strgetid : strid
                    },
                    success: function(data){
                    //$("#postlist").html(data);		 
                                        
                     $("#getchatid_"+data).remove(); 
                       
                   
                    return false;
                    }
                    });   
    
   }
   
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
         $(".maxheight_visit").slimScroll({
          height: '450px',
        });
        $(".maxheight_resouce").slimScroll({
          height: '450px',
        });
        
        $(".maxheight_calender").slimScroll({
          height: '450px',
        });
        
        
      });  
       </script>
<script>
  $(document).ready(function() {
  
  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();

  var calendar = $('#calendar1').fullCalendar({
   editable: true,
   header: {
    left: 'prev,next today',
    center: 'title',
    right: "month,agendaWeek,agendaDay",
   },
   
   events: "<?php echo $eventsurl;?>",

   // Convert the allDay from string to boolean
   eventRender: function(event, element, view) {

     if (event.type =='nd'){
	 
	    element.draggable = false;
     }
    if (event.allDay === 'true') {
     event.allDay = true;
    } else {
     event.allDay = false;
    }
   },
   selectable: true,
   selectHelper: true,
   select: function(start, end, allDay) {
   var title = prompt('Event Title:');

   if (title) {
   var start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
   var end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");

   $.ajax({
  	url:"<?=SITE_ADMIN_URL;?>calendar/add_events",
   data: 'title='+ title+'&start='+ start +'&end='+ end  ,
   type: "POST",
   success: function(json) {
  // alert(json);
   }
   });
   calendar.fullCalendar('renderEvent',
   {
   title: title,
   start: start,
   end: end,
   allDay: allDay
   },
   true // make the event "stick"
   );
   }
   calendar.fullCalendar('unselect');
   },
   
   editable: true,
   eventDrop: function(event, delta) {
   var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
   var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
   $.ajax({
   url: "<?=SITE_ADMIN_URL;?>calendar/update_events",
   data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
   type: "POST",
   success: function(json) {
   // alert(json);
   }
   });
   },
eventClick: function(event) {
var decision = confirm("Do you really want to Delete?"); 
if (decision) {
$.ajax({
type: "POST",
url: "<?=SITE_ADMIN_URL;?>calendar/delete_events",

data: "&id=" + event.id,
 type: "POST",
   success: function(json) {
    //alert("Updated Successfully");
   }
});
$('#calendar1').fullCalendar('removeEvents', event.id);

} else {
}
},
   eventResize: function(event) {
   var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
   var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
   $.ajax({
    url: "<?=SITE_ADMIN_URL;?>calendar/update_events",
    data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
    type: "POST",
    success: function(json) {
     //alert("Updated Successfully");
    }
   });

}
   

  });
  
 });
</script>

<script>

     $(document).ready(function(){ 
            $(".grid").sortable({
                    tolerance: 'pointer',
                    revert: 'invalid',
                    placeholder: 'span2 well placeholder tile',
                    forceHelperSize: true,
                    update: function() {
			var dashmenuname =  Array(); 
  	        var dashmenuorder =  Array(); 
            var dashgetids="";
             var dli=0;
             $('.span2').each( function(e) {
                if($(this).attr('id')!= '')
                {
                    dashgetids=$(this).attr('id');
                    dashmenuname[dli] = dashgetids;  
                    dashmenuorder[dli]= $(this).index() + 1;
                  
         //   alert(dashmenuname);
            dli++;
                                }
                            });
                $.ajax({
                    
                   // dataType: 'JSON',
                    type: 'POST',
                    cache: false,
                    url:  '<?php echo base_url();?>admin/dashboard/dragdashboradmenu',
                    data : {
                    leftmenunames : dashmenuname,
                    leftmenureorders : dashmenuorder
                    },
                    success: function(data){
                        
                       // alert(data);
                    //$("#postlist").html(data);		 
                    // alert(data);  
                    
                    
                    return false;
                    }
                    });  
                            
            }					
       });
       // alert("hello")

		/*
        $("#dashboardsort_items div.dashclass").sortable({ opacity:0.6, update: function() {
			var dashmenuname =  Array(); 
  	        
            var dashgetids="";
             var dli=0;
             $('#dashboardsort_items div.dashclass').each( function(e) {
                if($(this).attr('id')!= '')
                {
                    dashgetids=$(this).attr('id');
                    dashmenuname[dli] = dashgetids;  
                  
            alert(dashgetids);
            dli++;
                                }
                            });
            }								  
		});
        */
        
      /*
         $("#dashboardsort_items").sortable({  opacity:0.6, update: function() {
			var dashmenuname =  Array(); 
  	        
            var dashgetids="";
             var dli=0;
             $('#dashboardsort_items div.dashclass').each( function(e) {
                if($(this).attr('id')!= '')
                {
                    dashgetids=$(this).attr('id');
                    dashmenuname[dli] = dashgetids;  
                  
            alert(dashgetids);
            dli++;
                                }
                            });
            }								  
		});
      */
	
  });
   </script>