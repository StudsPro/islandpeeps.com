<?php
$write=affilateright("calendar","write");
$read=affilateright("calendar","read");

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
					 <?php } 
                    
                     ?>
					
           
           
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #fff;">
                  <!--<h3 class="panel-title col-md-11">Country(s) Listing </h3> -->
                  <div class="col-md-12" style="margin-left: -15px;">
				   
                  <div class="col-md-2" ><span class="label" style="background-color:#3B5998;display: inherit;font-weight: 400;">Profile publish date</span></div>
                  <div class="col-md-2" ><span class="label" style="background-color:#EBBBA8;color:#C95325;display: inherit;font-weight: 400;">Profile's Birthday</span></div>
                  <div class="col-md-2" ><span class="label" style="background-color:#F3FDAE;color:#A59505;display: inherit;font-weight: 400;">Independence day</span></div>
                  <div class="col-md-2" ><span class="label" style="background-color:#BBE2AE;color:#009100;display: inherit;font-weight: 400;">Current (or) future Events</span></div>
        	      <div class="col-md-2" ><span class="label" style="background-color:#C2DFF2;color:#246887;display: inherit;font-weight: 400;">Affiliates Birthday</span></div>
        	     <div class="col-md-2" ><span class="label" style="background-color:#F0F1F6;color:#919192;display: inherit;font-weight: 400;">Past events</span></div>
                   
              </div>
                
                <div class="clearfix">&nbsp;</div>
                
                <div class="col-md-6">
                   <a href="javascript:void(0)" class="btn btn-success hidden-xs">
                    
                    <span class="fa fa-gift"></span>&nbsp;Date of Birth added &nbsp;(<?php echo $dobcount; ?>)</a>
                </div>
                <div class="clearfix">&nbsp;</div>
                </div>
			     <div class="panel-body">
                   <div id='calendar2'></div>
                 </div>  
              </div>
              
                
            </div>
            
           
          </div>
           <span id="pastyear"></span>	
        </div>
               
			 <!--main content -->
  <?php 
$date=array();
if($this->input->get('go')){ 
       $data = date('Y-m-d',$this->input->get('go'));
	$date=explode('-',$data);
 
}



 $eventsurl = base_url().'admin/calendar/getdata?g=full'; //'http://'.$_SERVER["HTTP_HOST"].ROOT_FOLDER.'/events.php?g=full';
$pasteventsurl = base_url().'admin/calendar/getdata?g=pastyear'; //'http://'.$_SERVER["HTTP_HOST"].ROOT_FOLDER.'/events.php?g=pastyear';
?>           
           <style >
.fc-view {
margin-top:25px;
}
.pbday.fc-event {
  color: #c95325;
}
.pastevent.fc-event {
  color: #919192;
}
.inday.fc-event {
  color: #a59505;
}
.evtday.fc-event {
  color: #009100;
}
</style>

 <script src="<?=ADMIN_THEEM_JS?>jquery-ui/jquery.ui.draggable.min.js"></script>
 <script src="<?=ADMIN_THEEM_JS?>plugins/fullcalendar/fullcalendar.min.js"></script>
  <script src="<?=ADMIN_THEEM_JS?>plugins/fullcalendar/calendar.js"></script>
<script>
 $(document).ready(function() {
	  var date = new Date();
	  var d = date.getDate();
	  var m = date.getMonth();
	  var y = date.getFullYear();
	
	  var calendar = $('#calendar2').fullCalendar({
												    editable: true,
                                                       header: {
                                                        left: 'prev,next today',
                                                        center: 'title',
                                                        right: "month,agendaWeek,agendaDay",
                                                       },
												     
												   events: "<?=$eventsurl;?>",
                                                    dayClick: function(date, jsEvent, view) {
                                                        //$('#calendar2').fullCalendar( 'gotoDate', date );
                                                       // alert("Test");
                                                     }, 
												   // Convert the allDay from string to boolean
												   eventRender: function(event, element, view) 
													{
													  
														if (event.type =='nd'){
														  //element.draggable = false;
                                                        //  window.location.href=
                                                          }
														if (event.allDay === 'true') 
															{event.allDay = true;} 
														else 
															{event.allDay = false;}
                                                     /* 
                                                      element.append( "<span class='closeon'>X</span>" );
                                                        element.find(".closeon").click(function() {
                                                           $('#calendar').fullCalendar('removeEvents',event._id);
                                                        });      
                                                         */   
                                                            
												   },
												   selectable: true,
												   selectHelper: true,
												   select: function(start, end, allDay) 
												   { 
												     <?php
                                                    if($write==true)
                                                    {
                                                    ?>  
														var title = prompt('Event Title:');
														if (title) 
															{
															   var start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
															   var end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
																$.ajax({
																		url:"<?=SITE_ADMIN_URL;?>calendar/add_events",
																		data: 'title='+ title+'&start='+ start +'&end='+ end  ,
																		type: "POST",
																		success: function(json) 
																		{ }// alert(json);
																	});
																calendar.fullCalendar('renderEvent', { title: title, start: start, end: end, allDay: allDay },true );// make the event "stick"
															}
                                                     <?php
                                                     }
                                                     ?>       
														calendar.fullCalendar('unselect');
												   },
                                                    <?php
                                                    if($write==true)
                                                    {
                                                    ?>
												   editable: true,
                                                   <?php
                                                   }else
                                                   {
                                                   ?>
                                                    editable: false,
                                                   <?php
                                                   }
                                                   ?>
												   eventDrop: function(event, delta) 
														{
														  <?php
                                                    if($write==true)
                                                    {
                                                    ?>    
														   var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
														   var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
															$.ajax({
																	   url: "<?=SITE_ADMIN_URL;?>calendar/update_events",
																	   data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
																	   type: "POST",
																	   success: function(json) { //alert(json);
                                                                       }// alert(json);
																	});
                                                            <?php
                                                            }
                                                            ?>        
														},
													eventClick: function(event, delta) {

                                                          // var title = prompt('Event Title:',event.title);
                                                        /*
                                                           if (title) {
                                                          var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
                                                           if(!event.end)
                                                           event.end = event.start
                                                           var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
                                                           event.title = title;
                                                           $.ajax({
                                                           url:"<?=SITE_ADMIN_URL;?>calendar/update_events",
                                                           data: 'title='+ title+'&start='+ start +'&end='+ end +'&id='+ event.id,
                                                           type: "POST",
                                                           success: function(json) {
                                                           //alert(json);
                                                           }
                                                           });
                                                            calendar.fullCalendar('updateEvent', event);
                                                           }
                                                           */
                                                          <?php
                                                    if($write==true)
                                                    {
                                                    ?>    
                                                           if(event.type=="nd" && event.id !="")
                                                           {
                                                         window.location.href="<?php echo SITE_ADMIN_URL?>masterlist/edit/"+event.id  
                                                           }
                                                      <?php
                                                      }
                                                      ?>     
                                                           //alert("Test");
                                                           calendar.fullCalendar('unselect');
                                                        },    
                                                  eventResize: function(event) 
														{
														   <?php
                                                    if($write==true)
                                                    {
                                                    ?>    
														   var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
														   var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
														   $.ajax({
																	url: "<?=SITE_ADMIN_URL;?>calendar/update_events",
																	data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
																	type: "POST",
																	success: function(json) {}//alert("Updated Successfully");
																});
                                                           <?php
                                                           }
                                                           ?>        
														},
                                                   eventDragStart: function( event, jsEvent, ui, view ) { 
                                                                //    dragged = [ ui.helper[0], event ]; 
                                                         }     
  												});
                //*******************//
                    <?php 
                     if(!empty($date))
                     {
                    	if($date[0]!='' && $date[1]!='' && $date[2]!=''){
                    ?>
                        $('#calendar2').fullCalendar("gotoDate", <?php echo $date[0];?>, <?php echo ($date[1]-1);?>, <?php echo $date[2];?>);
                    <?php }
                    }
                       ?>
                    
                    $('.fc-button-agendaDay,.fc-button-prev,.fc-button-next,.fc-button-today').on('click', function(){
                    if($('.fc-button-agendaDay').hasClass('fc-state-active')){
                         var date1 = $('#calendar2').fullCalendar( 'getDate' );
                         var date = date1.getDate();
                         var month = date1.getMonth();
                    	
                    	 $.ajax({
                    	   url: "<?php echo $pasteventsurl;?>",
                    	   data: {'pastyear' : '1','date' : date,'month' : month } ,
                    	   type: "POST",
                    	   success: function(json) {
                    	      $('#pastyear').html(json);
                    	   }
                    	   });
                    }else{
                    	 $('#pastyear').html('');
                    }
                         return false;
                      });
                
                                                
            //****************//
                                 $('.fc-button-agendaDay,.fc-button-prev,.fc-button-next,.fc-button-today').on('click', function(){
                    if($('.fc-button-agendaDay').hasClass('fc-state-active')){
                         var date1 = $('#calendar2').fullCalendar( 'getDate' );
                         var date = date1.getDate();
                         var month = date1.getMonth();
                    	
                    	 $.ajax({
                    	   url: "<?php echo $pasteventsurl;?>",
                    	   data: {'pastyear' : '1','date' : date,'month' : month } ,
                    	   type: "POST",
                    	   success: function(json) {
                    	      $('#pastyear').html(json);
                    	   }
                    	   });
                    }else{
                    	 $('#pastyear').html('');
                    }
                         return false;
                      });
                    $('.fc-button-agendaWeek,.fc-button-month').on('click', function(){
                    $('#pastyear').html('');
                    });
                    
          //**************************//
        <?php
        if($write==true)
        {
        ?>  
         $('#calendar2').children('.fc-content').prepend('<div id="calendarTrash" style="float: right; padding-top: 5px; padding-right: 5px; padding-left: 5px;position: relative;bottom:10px;"><span class="ui-icon ui-icon-trash"></span></div>');
       <?php
       }
       ?>  
    //listens for drop event
                        $("#calendarTrash").droppable({ 
                            tolerance: 'pointer',
                            drop: function(event, ui) {
                                if ( dragged && ui.helper && ui.helper[0] === dragged[0]) {
                                    var event = dragged[1];
                                    var answer = confirm("Delete Event?")
                                    if (answer)
                                    {
                                       $.ajax({
                    			type: "POST",
                    			url: "<?=SITE_ADMIN_URL;?>calendar/delete_events",
                    
                    			data: "&id=" + event.id,
                    			 type: "POST",
                    			   success: function(json) {
                    			    	$('#calendar2').fullCalendar('removeEvents', event.id);
                    			   },
                    
                    			});
                    		
                                    }
                                }
                            }
                        }); 
              //**************************************//
              
                                 
                                                
 });

</script>     
             
    