<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet"/>
<link rel="stylesheet" href="<?php echo base_url() ?>library/css/datepic.css" rel="stylesheet"/>
<link rel="stylesheet" href="<?php echo base_url() ?>library/css/screen.css" rel="stylesheet"/>
<div class="slider">
  <div class="container custom-container"> 
     <div class="slider-inner">
	   <div class="col-md-4 col-xs-12 col-sm-12 ">
	      <div class="row one-way">
          <h2 id="nav-tabs">BOOK YOUR RIDE NOW</h2>
           <ul role="tablist" class="nav  tab col-md-12" id="myTab">
             <li class="col-md-6 active col-xs-6 col-sm-6" role="presentation" id="oneway"><a aria-expanded="false" aria-controls="home" data-toggle="tab" role="tab" id="home-tab" href="#home">One way</a></li>
             <li role="presentation" class="col-md-6 col-xs-6 col-sm-6" id="hourly"><a aria-controls="profile" data-toggle="tab" id="profile-tab" role="tab" href="#profile" aria-expanded="true">Hourly</a></li>
    	   </ul>
          <form class="form-inline" role="form" action="<?php echo base_url()?>selectvehicle" method="post" id="validation-form" >
             <input type="hidden" name="source_id" id="source_id" />
             <input type="hidden" name="destination_id" id="destination_id" />
             
             <input type="hidden" name="dropCity" id="DropCity_id" />
             <input type="hidden" name="pickCity" id="PickCity_id" />
             
             <input type="hidden" name="servicetype" id="servicetype"/>   
    	     <div class="tab-content tab-home col-md-12" id="myTabContent">
               <div aria-labelledby="home-tab" id="home" class="tab-pane fade active in my_home_div" role="tabpanel">   
                 <div class="container-fluid custom_form custom_new_home">
                   <div class="form-group col-xs-12 pad-0 pad-1">
                     <div class="input-group col-xs-12 ">
                       <label class="pull-left" for="pickupLoc1">Pick-Up Location</label>
                       <input type="text" class="form-control custom-input locationG unipick1" id="pickupLoc1" placeholder="Enter Address or Airport Code" name="pickup1"/>
                     </div>
                   </div>
                  <div class="form-group col-xs-12 pad-0 pad-1">
                    <div class="input-group col-xs-12">
                      <label class="pull-left" for="dropkup1">Drop-Off location</label>
                      <input type="text" class="form-control custom-input locationG unidrop1" id="dropupLoc1" placeholder="Enter Address or Airport Code" name="dropkup1"/>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-sm-12  col-xs-12 pad-0 pad-1">
                    <div class="text-left"><label class="" >Date</label></div>
                      <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 pad-0 text-left timing timing123">
                         <div  class="input-group date-input">
                            <input type="text" class="form-control custom-input custom-date" id="datetimepicker1" placeholder="11/24/2014" name="date1" autocomplete="off" />
                            <span class="input-group-addon date-background my_new_input_span" id="datepick1event" >
                                <span class="glyphicon-calendar glyphicon"></span>
                            </span>
                          </div>
                          <div class="input-group time hor-margin custom-time-hour" id="onehour">
                              <input type="text" class="form-control custom-time" placeholder="5PM"  name="time1" id="input_timehor_one" autocomplete="off"/>
                              <span class="input-group-addon glyphicon glyphicon-time glyphicon  date-background my_new_input_span1" ></span>
                              <ul class="time_hours" id="oneuni_hour">
                            <?php for($i=1;$i<=12;$i++) {?>
                              <li data-index=<?php echo $i;?> class=""><?php echo$i;?>AM</li>
                            <?php }
                                  for($i=1;$i<=12;$i++)
                            {?>
                              <li data-index=<?php echo $i;?> class=""><?php echo$i;?>PM</li>
                            <?php } ?>
                            </ul>
                        </div>
                  	    <div class="input-group  time custom-time-hour" id="hourly_hor">
                          <input type="text" class="form-control custom-time" placeholder="15" name="hours1" id="input_timemin_one" autocomplete="off"/>
                          <span class="input-group-addon glyphicon glyphicon-time glyphicon date-background my_new_input_span1" ></span>
                          <ul class="time_hours minutes" id="houruni_hour">
                            <li data-index="00" class="hover selected">00</li>
                            <li data-index="15" class="">15</li>
                            <li data-index="30" class="">30</li>
                            <li data-index="45">45</li>
                          </ul>
                         </div>
			           </div>
    	             </div>
                   </div>
                 </div>
             	 <div aria-labelledby="profile-tab" id="profile" class="tab-pane fade  my_home_div" role="tabpanel">
                   <div class="container-fluid custom_form">
                      <div class="form-group col-xs-12 pad-0 pad-1 ">
                         <div class="input-group col-xs-12 ">
                           <label class="pull-left" for="exampleInputEmail2">Pick-Up Location</label>
                           <input type="text" class="form-control custom-input locationG unipick2" id="pickupLoc2" placeholder="Enter Address or Airport Code" name="pickup2"/>  
                         </div>
                      </div>
                    
                      <div class="form-group col-xs-12 pad-0 pad-1">
                         <div class="input-group col-xs-12">
                            <label class="pull-left" >Number Of Hours</label>
                          
                         <!--   <input type="text" class="form-control custom-input locationG unidrop2" id="dropupLoc1" placeholder="Enter Address or Airport Code" name="dropup2"/> -->
                            <div class="col-lg-9 col-md-11 col-sm-11 col-xs-11 input-group pull-left hourly_length">
                               <input type="hidden" id="hourlyInhours" name="hourly_hours"/>
                                <input type="text"  class="form-control custom-input nonedisplay">
                                <span class="hour_text">Select Trip Length</span>
                                <span class="glyphicon glyphicon-arrow-down pull-right custom_arrowDown"></span>
                                    <ul class="getHourly_hours">
                                        <?php 
                                        for($i=2;$i<=14;$i++)
                                        { ?>
                                            <li data-index="<?php echo $i;?>hours" class=""><?php echo $i;?> Hours</li>
                                        <?php }
                                        ?>
                                        
                                    </ul>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 pad-0 pad-1 ask text-center">
                                <a class="btn ask show-popover" data-trigger="click" title="" data-content="Since you are booking by the hour, your driver can take you wherever you want - you're in charge. However the price may change depending upon your route." data-placement="top" data-toggle="tooltip"  data-original-title="About by the Hour Pricing">
                                <span class="glyphicon glyphicon-question-sign"></span></a>
                            </div> 
                         </div>
                     </div>
                    
                     <div class="form-group col-lg-12 col-md-12 col-sm-12  col-xs-12 pad-0">
                         <div class="text-left">
                            <label class="" >Date</label>
                         </div>
                         <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 pad-0 text-left timing timing123">
        				     <div class="input-group date-input">
                               <input type="text" class="form-control custom-input custom-date" id="datetimepicker2" placeholder="11/24/2014" name="date2" autocomplete="off"/>
        					  <span class="input-group-addon date-background my_new_input_span" id="datepick1event" >
                                        <span class="glyphicon-calendar glyphicon"></span>
                                    </span>
                             </div>
        					 <div class="input-group time hor-margin custom-time-hour" id="hourlyhour">
                                <input type="text" class="form-control custom-time" placeholder="5PM" name="time2" id="input_timehor_hourly" autocomplete="off"/>
                                <span class="input-group-addon glyphicon glyphicon-time glyphicon  date-background my_new_input_span1" ></span>
                                <ul class="time_hours" id="hourlyuni_hour">
                                  <?php
                                  for($i=1;$i<=12;$i++)
                                  {?>
                                     <li data-index=<?php echo $i;?> class=""><?php echo$i;?>AM</li>
                                 <?php }
                                  ?>
                                  
                                </ul>
                             </div>
                             <div class="input-group  time custom-time-hour" id="hourly_minutes">
                                 <input type="text" class="form-control custom-time" placeholder="15" name="hours2" id="input_timemin_hourly" autocomplete="off"/>
                                 <span class="input-group-addon glyphicon glyphicon-time glyphicon date-background my_new_input_span1" ></span>
                                  <ul class="time_hours minutes" id="hourlyuni_mint">
                                     <li data-index="00" class="hover selected">00</li>
                                     <li data-index="15" class="">15</li>
                                     <li data-index="30" class="">30</li>
                                     <li data-index="45">45</li>
                                  </ul>
                             </div>
	 	                 </div>
                     </div>
				 
           </div>
          
           </div>
           <input type="submit" id="next" data-last="Finish" onclick="validation()" name="sub_one"  class="btn btn-warning col-md-12 col-xs-12 voffset3 submit"value="NEXT STEP : SELECT VEHICLE"/>
            </form>
             
	</div>
    	</div>
		  </div>
	
	
	   
	
 <div class="col-md-8 pull-right custom-slider col-xs-12 col-sm-12 verti-mar1">
   <div class="slider-outer">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
     
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"><div class="first_li"><span></span></div> <div class="second_li"></div></li>
       
        <li data-target="#myCarousel" data-slide-to="1"><div class="first_li"><span></span></div> <div class="second_li"></div></li>
   
        <li data-target="#myCarousel" data-slide-to="2"><div class="first_li"><span></span></div> <div class="second_li"></div></li>
    
        <li data-target="#myCarousel" data-slide-to="3"><div class="first_li"><span></span></div> <div class="second_li"></div></li>
      
        <li data-target="#myCarousel" data-slide-to="4"><div class="first_li"><span></span></div></li>
        
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="<?php echo base_url() ?>library/image/slider.png" alt="First slide"/>
          
        </div>
         <div class="item">
          <img src="<?php echo base_url() ?>library/image/slider-new3.png" alt="First slide"/>
          
        </div>
     
       <div class="item">
          <img src="<?php echo base_url() ?>library/image/slider-new1.png" alt="First slide"/>
          
        </div>
          <div class="item">
          <img src="<?php echo base_url() ?>library/image/slider-new3.png" alt="First slide"/>
          
        </div>
          <div class="item">
          <img src="<?php echo base_url() ?>library/image/slider-new4.png" alt="First slide"/>
          
        </div>
        
        
       
      </div>
      <!---<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>--->
    </div>
		</div>
        
		</div>
	
	</div>
</div>
 </div>
 
 <div class="clearfix"></div> 

	
    <div class="container custom-container"> 
       <div class="content custom-container">
         <h3 class="text-center voffset4">Singapore's Service is Trusted By</h3>       
         <div class="col-md-12 pad-0 col-xs-12 col-sm-12 text-center">
        
          <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 client pad-0">
                      
                 <span>
                   <img src="<?php echo base_url() ?>library/image/expedia.png">
                 </span>
                 
                 <span>
                   <img src="<?php echo base_url() ?>library/image/jelblue.png">
                 </span>
                 
                 <span>
                   <img src="<?php echo base_url() ?>library/image/leader_club.png">
                 </span>
                 
                 <span>
                   <img src="<?php echo base_url() ?>library/image/ihg.png">
                 </span>
              
                 <span>
                   <img src="<?php echo base_url() ?>library/image/royal.png">
                 </span>
                 
                 <span>
                   <img src="<?php echo base_url() ?>library/image/norwegian.png">
                 </span>
                 
                  <span>
                   <img src="<?php echo base_url() ?>library/image/united.png">
                 </span>
               

          
          </div>
          
          </div>
        </div>
     </div>  
     
    <div class="container-outer voffset2">  
    <div class="container custom-container">   
       <div class="grid">
        <h3>SINGAPORE'S PREMIUM LIMOUSINE SERVICE</h3>
     
      <div class="voffset4 row main-content">
      
        <div class="col-md-4 pull-left col-xs-12 col-sm-4 col-lg-3">
        <img src="<?php echo base_url() ?>library/image/car-product.png"/>
        </div>
        
        <div class="col-md-8 pull-right col-xs-12 col-sm-8 voffset2 col-lg-9">
          <p class="text-left">We offer all-round transport solutions that can be customised to suit any occasion and event.
Whether it's a simple airport transfer you require, an impressive wedding day convoy to celebrate the most important and memorable day of your life, or an extensive suite of luxury limousines for a weeklong corporate event across the island that will seal a million-dollar deal. Limocars can deliver all this and more.
</p>

<p>We gurantee you an unmatched level of <strong>customer service, luxurious comfort & reliability.</strong></p>
        </div>
        
        </div>
       </div>
       </div>
 <script>
     /*For oneway hourtimefiled*/
           $('#oneuni_hour li').click(function(){
                var time_li=$(this).attr('data-index')+'AM';
                $('#input_timehor_one').val(time_li);
                //$('#oneuni_hour').attr('display','none');
            });
            $("#onehour").click(function(){
                 $('#oneuni_hour').toggle();  
            });       
     /*close all oneway houer'sFileds event'*/
     /*For oneway minutestimefiled*/
        $('#houruni_hour li').click(function(){
        var time_li=$(this).attr('data-index');
        $('#input_timemin_one').val(time_li);
        //$('#houruni_hour').attr('display','none');
     });
     /* for hourly Time filed*/
             $("#hourly_hor").click(function(){ 
                 $('#houruni_hour').toggle();  
             });            
     /*close all oneway houer'sFileds event'*/
       
     /*Event in hourly*/            
     /*For hoursTimeFileds*/
           $('#hourlyuni_hour li').click(function(){
                    var time_li=$(this).attr('data-index')+'AM';
                    $('#input_timehor_hourly').val(time_li);
                    
           });
     /*close*/
     /*get hours in hpourly file*/
         $(".hourly_length").click(function(){ 
                 $('.getHourly_hours').toggle(); 
                // $('.getHourly_hours').removeClass('powerdisnone'); 
             });
     /*close*/
     /*Event in hourly*/       
     /*For hoursTimeFileds*/
         $("#hourlyhour").click(function(){ 
               $('#hourlyuni_hour').toggle();  
               });
               $('#hourlyuni_hour li').click(function(){
                      var time_li=$(this).attr('data-index')+'AM';
                      $('#input_timehor_hourly').val(time_li);
                      //$('#hourlyuni_hour').hide();
                });
                
                /*For MINutesTimeFileds*/
                    $("#hourly_minutes").click(function(){ 
                         $('#hourlyuni_mint').toggle();  
                     });
                    $('#hourlyuni_mint li').click(function(){
                        var time_li=$(this).attr('data-index');
                        $('#input_timemin_hourly').val(time_li);
                        //$('#hourlyuni_mint').hide();
                    });
               
   
   $('.locationG').autocomplete({
    
    
                    source: "<?php echo base_url()?>getGplacedata",
                    autoFocus: true,
                    minLength: 2,
                    focus: function (event, ui) {
                        $(".ui-helper-hidden-accessible").hide();
                        event.preventDefault();
                    },
                    select: function(event,ui){			
                           var country = ui.item.country;
                            var city = ui.item.city;
                           
                            /* dropupLoc1,pickupLoc1,pickupLoc2,dropupLoc2*/
                            var soucrId= $(this).attr('id');
                            //alert(soucrId);
                            varcurrtTab=$('#myTabContent div.active').attr('id');
/*#############   ---------------- logic for servicr type---------------   ##############*/
                                if(varcurrtTab=='home')
                                {
                                    $("#servicetype").val('1');
                                }
                                else
                                {
                                    $("#servicetype").val('2');
                                }
/*#############   ---------------- loic for servicr type---------------   ##############*/
/*#############   ---------------- loic for country---------------   ##############*/    
                            if(soucrId=='pickupLoc1')
                            {
                                $("#source_id").val(country);
                                $('#PickCity_id').val(city);
                            }
                           else if(soucrId=='pickupLoc2')
                           {
                              $("#source_id").val(country)
                              $('#PickCity_id').val(city);
                           }
                            else
                            {
                              $("#destination_id").val(country)
                              $('#DropCity_id').val(city);  
                            }   
                    			if(country != '') {
                    			    
                                    //$("#source").val((country)
                    				//location.href = '/invoice.php?customercode=' + code;
                    			}
                                if(city != '') {
                    			    // alert(city);
                    				//location.href = '/invoice.php?customercode=' + code;
                    			}
                                
                    		},
                            
                                    // optional
                    		html: true, 
                    		// optional (if other layers overlap the autocomplete list)
                    		open: function(event, ui) {
                    			$(".ui-autocomplete").css("z-index", 1000);
                            if(jQuery(this).parents("#home").length >0)
                            {
                                 var sx=jQuery("#home").width();
                            }else{
                            
                                 var sx=jQuery("#profile").width();
                            //alert("skdfghjsg");
                            }
                            jQuery(".ui-autocomplete").css("width",sx);
                                                     
                    		}
                });          
    $('#datetimepicker1').datepicker({minDate: 0 });
    $('#datetimepicker2').datepicker({minDate: 0 });
 
  $(document).ready(function () {
            
             var jsChk=$('span.hour_text').text();
                  $("#next").click(function() {   
                     if(jsChk=='Select Trip Length')
                     {
                        $('.hourly_length').css("border","1px solid red");
                     }
                  }); 
                  $( ".getHourly_hours li" ).click(function() {
                      $('.hourly_length').css("border","none");
                  });/*$('#hourlyInhours').val(jsChk);*/ 
                  $('.timing123 input').focus(function(){
                    $(this).attr('readonly','readonly');
                  });
                  
                  $('#hourly').click(function(){
                      var counterCount=1;
                      CurrtActiveTab=$('#myTabContent div.active').attr('id');
                      if(CurrtActiveTab=="home" && counterCount<1)
                      {
                            $('.hourly_length').css("border","none");
                      }
                      counterCount=counterCount+1;
                  });     
                  
                 
      /* $("#next").click(function(e) {
                    CurrtActiveTab=$('#myTabContent div.active').attr('id');
                    if(CurrtActiveTab=='profile')
                    {
                        var jsChk=$('span.hour_text').text();
                        if(jsChk=='Select Trip Length')
                        {
                            e.preventDefault();
                            $('.locationG,#datetimepicker2,#input_timehor_hourly,#input_timemin_hourly,.hourly_length').css("border","1px solid red");
                        }
                        $( ".getHourly_hours li" ).click(function() {
                            $('.hourly_length').css("border","none");
                        }); 
                      }     
                });*/  
        $('#validation-form').validate({
               errorClass: "has-warning",
               errorElement:"div",
					rules: {
        					    pickup1   : {required : true},
                                dropkup1  : {required : true}, 
                                pickup2   : {required : true},
                                dropup2   : {required : true},
                                date1     : {required : true}, 
                                date2     : {required : true},
                                time1     : {required : true},
                                time2     : {required: true},
                                hours1    : {required: true},
                                hours2    : {required: true},
                                hourly_hours:{required: true,min:1}
					       },
                    messages: {
            					   pickup1   : "Enter Pick Up Location ",
                                   dropkup1  : "Enter Drop Up Location ",
                                   pickup2   : "Enter Pick Up Location",
                                   dropup2   : "Enter Drop Up Location ",
                                   date1     : "Enter Date",
                                   date2     : "Enter Date",
                                   time1     : "Enter hrs.",
                                   time2     : "Enter hrs.",
                                   hours1    : "Enter Min.",
                                   hours2    : "Enter Min."
					           },
                highlight: function(element, errorClass) {
                    $(element).addClass('erroralertBorder');
                    
                }                               
                              

			});
            
            
                
              $(".show-popover").popover();
              var timesx=$(".custom-time-hour").width();
                             //alert(timesx);
               $(".time_hours").css("width",timesx);
              var houlr_hours=$('#pickupLoc1').width();
                houlr_hours=houlr_hours*(10/12);
                //alert(houlr_hours);             
               $(".getHourly_hours").css("width",houlr_hours); 
               
              $('.getHourly_hours li').click(function(){
                      var hourly_val=$(this).attr('data-index');
                      $('.hour_text').text(hourly_val);
                      $('#hourlyInhours').val(hourly_val);
                });
        });
   </script>
   