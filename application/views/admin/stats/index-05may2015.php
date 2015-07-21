<?php
$write=affilateright("stats","write");
$read=affilateright("stats","read");

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
<style>
  .new_col6 > div:nth-child(2n+1) {
  clear: both;
}
.span2{
    cursor: move;
}
  </style>
 <?php
    $userliststats=dragdropmenu('statslist');
    $rside_dashboard=array();
    //echo "<pre>";print_r($userdashboardmenus);exit;
 ?>    		
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
                <div class="panel-heading" >
                  <h3 class="panel-title col-md-11">Stats</h3>
               </div>
                </div>
			     <div class="panel-body">
                 <div class="col-md-12 new_col6 grid" id="dashboardsort_items "> 
                   <?php
                        
                         $statsnewsreturn_html='<div class="col-md-6 span2" id="statsnewsreturn">
                                  <div class="panel panel-warning  ">
                                    <div class="panel-heading ">
                                      <div class="panel-title">&nbsp;New vs Returning</div>
                                    </div>
                                    <div class="panel-body maxheight">
                                       <div id="pie-usertype1" class="plot" style="height:500px"></div>
                                    </div>
                                  </div>
                          </div>  ';
                        
                        $mlist_stats["statsnewsreturn"]=$statsnewsreturn_html;
                        
                        ?>
                    <?php
                        
                         $statsvistsonmap_html='<div class="col-md-6 span2" id="statsvistsonmap">
                                  <div class="panel panel-primary ">
                <div class="panel-heading">
                  <div class="panel-title">Visits on Map</div>
                </div>
                <div class="panel-body maxheight">
                 <div id="vmap-world" class="vmap" style="width: 450px; height: 450px;"></div>
                </div>
              </div>
      </div>';
                        
                        $mlist_stats["statsvistsonmap"]=$statsvistsonmap_html;
                        
                        ?>
                        <?php
                        
                         $statstopcounterys_html='<div class="col-md-6 span2" id="statstopcounterys">
                                  <div class="panel panel-warning  ">
                                        <div class="panel-heading ">
                                          <div class="panel-title">&nbsp;Top Countries(Visits)</div>
                                        </div>
                                        <div class="panel-body maxheight">
                                          	<div id="pie-country" style="height:500px" class="plot"></div>
                                        </div>
                                      </div>
                              </div>';
                        
                        $mlist_stats["statstopcounterys"]=$statstopcounterys_html;
                        
                        ?>
                      <?php
                        
                         $statstopcitys_html='<div class="col-md-6 span2" id="statstopcitys">
                                  <div class="panel panel-primary ">
                                <div class="panel-heading">
                                  <div class="panel-title">Top Cities(Visits)</div>
                                </div>
                                <div class="panel-body maxheight">
                                 <div class="plot" style="height:500px" id="pie-city"></div>
                                </div>
                              </div>
                      </div>';
                        
                        $mlist_stats["statstopcitys"]=$statstopcitys_html;
                        
                        ?>
                      
                         <?php
                        
                         $statsvistbybrowser_html='<div class="col-md-6 span2" id="statsvistbybrowser">
                                  <div class="panel panel-warning  ">
                                        <div class="panel-heading ">
                                          <div class="panel-title">&nbsp; Visits by Browser</div>
                                        </div>
                                        <div class="panel-body maxheight">
                                          		<div id="pie-browser" style="height:500px" class="plot"></div>
                                        </div>
                                      </div>
                              </div>';
                        
                        $mlist_stats["statsvistbybrowser"]=$statsvistbybrowser_html;
                        
                        ?>
                        <?php
                        
                         $statsvistbyos_html='<div class="col-md-6 span2" id="statsvistbyos">
                                  <div class="panel panel-primary ">
                                <div class="panel-heading">
                                  <div class="panel-title">Visits by Operating System</div>
                                </div>
                                <div class="panel-body maxheight">
                                  <div class="plot" style="height:500px" id="pie-os"></div>
                                </div>
                              </div>
                      </div>';
                        
                        $mlist_stats["statsvistbyos"]=$statsvistbyos_html;
                        
                        ?>
                        
                        <?php
                        
                         $statsvistbyscreenr_html='<div class="col-md-6 span2" id="statsvistbyscreenr">
                                  <div class="panel panel-warning  ">
                                        <div class="panel-heading ">
                                          <div class="panel-title">&nbsp; Visits by Screen Regulation</div>
                                        </div>
                                        <div class="panel-body maxheight">
                                          			<div id="pie-screen" style="height:500px" class="plot"></div>
                                        </div>
                                      </div>
                              </div> ';
                        
                        $mlist_stats["statsvistbyscreenr"]=$statsvistbyscreenr_html;
                        
                        ?>
                        
                         <?php
                        
                         $statsvistbyservicepro_html='<div class="col-md-6 span2" id="statsvistbyservicepro">
                                   <div class="panel panel-primary ">
                                <div class="panel-heading">
                                  <div class="panel-title"> Visits by Service provider</div>
                                </div>
                                <div class="panel-body maxheight">
                                   <div class="plot" style="height:500px" id="pie-isp"></div>
                                </div>
                              </div>
                      </div>';
                        
                        $mlist_stats["statsvistbyservicepro"]=$statsvistbyservicepro_html;
                        
                        ?>
                        <?php
                        
                         $statsreferralsoutracking_html='<div class="col-md-6 span2" id="statsreferralsoutracking">
                                   <div class="panel panel-warning  ">
                                        <div class="panel-heading ">
                                          <div class="panel-title">&nbsp; Referral source Tracking</div>
                                        </div>
                                        <div class="panel-body maxheight">
                                          			<div id="pie-chart" style="height:500px" class="plot"></div>
                                        </div>
                                      </div>
                              </div>';
                        
                        $mlist_stats["statsreferralsoutracking"]=$statsreferralsoutracking_html;
                        
                        ?>
                  <!--Block-->
                        <?php
                        
                         $statssocialnetworkref_html='<div class="col-md-6 span2" id="statssocialnetworkref">
                                    <div class="panel panel-primary ">
                                <div class="panel-heading">
                                  <div class="panel-title"> Social Network Referrals</div>
                                </div>
                                <div class="panel-body maxheight">
                                   <div class="plot" style="height:500px" id="pie-social"></div>
                                </div>
                              </div>
                      </div>';
                        
                        $mlist_stats["statssocialnetworkref"]=$statssocialnetworkref_html;
                        
                        ?>
                         <?php
                        
                         $statspagetracking_html='<div class="col-md-6 span2" id="statspagetracking">
                                    <div class="panel panel-warning  ">
                                        <div class="panel-heading ">
                                          <div class="panel-title">&nbsp; <i class="icon-bar-chart"></i> Page Tracking</div>
                                        </div>
                                        <div class="panel-body maxheight">
                                          		<div id="demo-plot" class="plot" style="height:500px"></div>
                                        </div>
                                      </div>
                              </div>';
                        
                        $mlist_stats["statspagetracking"]=$statspagetracking_html;
                        
                        ?>
                         <?php
                        
                         $statsdeviceinfo_html='<div class="col-md-6 span2" id="statsdeviceinfo">
                                    <div class="panel panel-primary ">
                                <div class="panel-heading">
                                  <div class="panel-title"> Device Info</div>
                                </div>
                                <div class="panel-body maxheight">
                                   <div id="pie-device" class="plot" style="height:500px"></div>
                                </div>
                              </div>
                      </div>';
                        
                        $mlist_stats["statsdeviceinfo"]=$statsdeviceinfo_html;
                        
                        ?> 
                        
                         <?php
                        
                         $statskeywords_html='<div class="col-md-6 span2" id="statskeywords">
                                    <div class="panel panel-warning  ">
                                        <div class="panel-heading ">
                                          <div class="panel-title">&nbsp; Keywords</div>
                                        </div>
                                        <div class="panel-body maxheight">
                                          		 <div class="plot" style="height:500px" id="donut-chart"></div>
                                        </div>
                                      </div>
                              </div>';
                        
                        $mlist_stats["statskeywords"]=$statskeywords_html;
                        
                        ?> 
                       <?php
                        
                         $statsmobilediveinfo_html='<div class="col-md-6 span2" id="statsmobilediveinfo">
                                    <div class="panel panel-primary ">
                                <div class="panel-heading">
                                  <div class="panel-title"> Mobile Device Info</div>
                                </div>
                                <div class="panel-body maxheight">
                                  <div id="pie-mobdiv" style="height:500px" class="plot"></div>
                                </div>
                              </div>
                      </div>';
                        
                        $mlist_stats["statsmobilediveinfo"]=$statsmobilediveinfo_html;
                        
                        ?> 
                          <?php
                       if($read==true)
                       {
                            if(isset($userliststats) && count($userliststats) > 0)
                             {
                               foreach($userliststats as $key => $value)
                               {
                                 $showmenuname=$value["menuname"];
                                 echo $mlist_stats[$showmenuname];
                               }
                             }else
                             {
                              
                                foreach($mlist_stats as $key => $mliststats)
                                             {
                                                echo $mliststats;
                                             }
                             }
                        }               
                       
                       ?>
                      
                
                   </div>
                 </div>  
              </div>
              
                
            </div>
            
            
          </div>
          
        </div>
     <?php
      if($read==true)
                       {
      include "gapi/gapi.php"; 
      }
    //  echo $userType; 
     // echo "Test<br>";
   //  echo $mobdiv;
   //   '{ label: "Apple iPhone [15]",data: 15 },{ label: "Apple iPad [4]",data: 4 }';
   //   exit;
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
 	<script type="text/javascript">
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
		
             	if(countryChart){
             	  	AmCharts.ready(function () {  
			var	countrypie = new AmCharts.AmPieChart();
				countrypie.dataProvider = pieDataCountry;
				countrypie.titleField = "label";
				countrypie.valueField = "data";
				countrypie.outlineColor = "#FFFFFF";
				countrypie.outlineAlpha = 0.8;
				countrypie.outlineThickness = 2;
				countrypie.labelRadius = -30;
				countrypie.labelText = "[[value]]";
				countrypie.startDuration = 0;
				// this makes the chart 3D
				countrypie.depth3D = 15;
				countrypie.angle = 30;
				countrypie.colors = "#76ba35,#00AFF0,#C72C95,#F8FF01,#FF6600,#04D215,#2A0CD0,#FF0F00,#B0DE09,#0D52D1,#0D5221,#76b035,#06AFF0,#C70C95,#58FF01,#B05209,#44D215,#2A0C95,#2F0F0F,#B05E09".split(",");
				
			var	countrylegend = new AmCharts.AmLegend();
				countrylegend.position = "bottom";
				countrylegend.borderAlpha = 0;
				countrylegend.horizontalGap = 10;
				countrylegend.switchType = "x"; // or v
				countrylegend.valueText = "";
				countrypie.addLegend(countrylegend);
				// WRITE
				countrypie.write("pie-country");
                
               }); 
			} 
            
            	if(cityChart){
             	  	AmCharts.ready(function () {  
			var	countrypie = new AmCharts.AmPieChart();
				countrypie.dataProvider = pieDataCity;
				countrypie.titleField = "label";
				countrypie.valueField = "data";
				countrypie.outlineColor = "#FFFFFF";
				countrypie.outlineAlpha = 0.8;
				countrypie.outlineThickness = 2;
				countrypie.labelRadius = -30;
				countrypie.labelText = "[[value]]";
				countrypie.startDuration = 0;
				// this makes the chart 3D
				countrypie.depth3D = 15;
				countrypie.angle = 30;
				countrypie.colors = "#76ba35,#00AFF0,#C72C95,#F8FF01,#FF6600,#04D215,#2A0CD0,#FF0F00,#B0DE09,#0D52D1,#0D5221,#76b035,#06AFF0,#C70C95,#58FF01,#B05209,#44D215,#2A0C95,#2F0F0F,#B05E09".split(",");
				
			var	countrylegend = new AmCharts.AmLegend();
				countrylegend.position = "bottom";
				countrylegend.borderAlpha = 0;
				countrylegend.horizontalGap = 10;
				countrylegend.switchType = "x"; // or v
				countrylegend.valueText = "";
				countrypie.addLegend(countrylegend);
				// WRITE
				countrypie.write("pie-city");
                
               }); 
			}
             	if(userTypeChart){
            	  AmCharts.ready(function () {   
			var	upie = new AmCharts.AmPieChart();
				upie.dataProvider = pieDataUserType1;
				upie.titleField = "label";
				upie.valueField = "data";
   	upie.outlineColor = "#FFFFFF";
				upie.outlineAlpha = 0.8;
				upie.outlineThickness = 2;
				upie.labelRadius = -30;
				upie.labelText = "[[value]]";
				upie.startDuration = 0;
				// this makes the chart 3D
				upie.depth3D = 15;
				upie.angle = 30;
				upie.colors = "#76ba35,#00AFF0,#C72C95,#F8FF01,#FF6600,#04D215,#2A0CD0,#FF0F00,#B0DE09,#0D52D1,#0D5221,#76b035,#06AFF0,#C70C95,#58FF01,#B05209,#44D215,#2A0C95,#2F0F0F,#B05E09".split(",");
				
			var	ulegend = new AmCharts.AmLegend();
				ulegend.position = "bottom";
				ulegend.borderAlpha = 0;
				ulegend.horizontalGap = 10;
				ulegend.switchType = "x"; // or v
				ulegend.valueText = "";
				upie.addLegend(ulegend);
				// WRITE
				upie.write("pie-usertype1");
                });
			}
            if(browsersChart){
                	AmCharts.ready(function () { 
				pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataBrowsers;
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
				pie.write("pie-browser");
                });
			}
        	
          	if(osChart){
          	   	AmCharts.ready(function () { 
				var ospie = new AmCharts.AmPieChart();
				ospie.dataProvider = pieDataOS;
				ospie.titleField = "label";
				ospie.valueField = "data";
				ospie.outlineColor = "#FFFFFF";
				ospie.outlineAlpha = 0.8;
				ospie.outlineThickness = 2;
				ospie.labelRadius = -30;
				ospie.labelText = "[[value]]";
				ospie.startDuration = 0;
				// this makes the chart 3D
				ospie.depth3D = 15;
				ospie.angle = 30;
				ospie.colors = "#76ba35,#00AFF0,#C72C95,#F8FF01,#FF6600,#04D215,#2A0CD0,#FF0F00,#B0DE09,#0D52D1,#0D5221,#76b035,#06AFF0,#C70C95,#58FF01,#B05209,#44D215,#2A0C95,#2F0F0F,#B05E09".split(",");
				
			var	oslegend = new AmCharts.AmLegend();
				oslegend.position = "bottom";
				oslegend.borderAlpha = 0;
				oslegend.horizontalGap = 10;
				oslegend.switchType = "x"; // or v
				oslegend.valueText = "";
				ospie.addLegend(oslegend);
				// WRITE
				ospie.write("pie-os");
                });
			}    
            
            	if(screenResolutionsChart){
            	   AmCharts.ready(function () { 
			var	screenRespie = new AmCharts.AmPieChart();
				screenRespie.dataProvider = pieDataScreenResolutions;
				screenRespie.titleField = "label";
				screenRespie.valueField = "data";
				screenRespie.outlineColor = "#FFFFFF";
				screenRespie.outlineAlpha = 0.8;
				screenRespie.outlineThickness = 2;
				screenRespie.labelRadius = -30;
				screenRespie.labelText = "[[value]]";
				screenRespie.startDuration = 0;
				// this makes the chart 3D
				screenRespie.depth3D = 15;
				screenRespie.angle = 30;
				screenRespie.colors = "#76ba35,#00AFF0,#C72C95,#F8FF01,#FF6600,#04D215,#2A0CD0,#FF0F00,#B0DE09,#0D52D1,#0D5221,#76b035,#06AFF0,#C70C95,#58FF01,#B05209,#44D215,#2A0C95,#2F0F0F,#B05E09".split(",");
				
			var	screenReslegend = new AmCharts.AmLegend();
				screenReslegend.position = "bottom";
				screenReslegend.borderAlpha = 0;
				screenReslegend.horizontalGap = 10;
				screenReslegend.switchType = "x"; // or v
				screenReslegend.valueText = "";
				screenRespie.addLegend(screenReslegend);
				// WRITE
				screenRespie.write("pie-screen");
                });
			}
            
            
            	if(networkLocationsChart){
            AmCharts.ready(function () {  	   
			var	networkLpie = new AmCharts.AmPieChart();
				networkLpie.dataProvider = pieDataNetworkLocations;
				networkLpie.titleField = "label";
				networkLpie.valueField = "data";
				networkLpie.outlineColor = "#FFFFFF";
				networkLpie.outlineAlpha = 0.8;
				networkLpie.outlineThickness = 2;
				networkLpie.labelRadius = -30;
				networkLpie.labelText = "[[value]]";
				networkLpie.startDuration = 0;
				// this makes the chart 3D
				networkLpie.depth3D = 15;
				networkLpie.angle = 30;
				networkLpie.colors = "#76ba35,#00AFF0,#C72C95,#F8FF01,#FF6600,#04D215,#2A0CD0,#FF0F00,#B0DE09,#0D52D1,#0D5221,#76b035,#06AFF0,#C70C95,#58FF01,#B05209,#44D215,#2A0C95,#2F0F0F,#B05E09".split(",");
				
			var	networkLlegend = new AmCharts.AmLegend();
				networkLlegend.position = "bottom";
				networkLlegend.borderAlpha = 0;
				networkLlegend.horizontalGap = 10;
				networkLlegend.switchType = "x"; // or v
				networkLlegend.valueText = "";
				networkLpie.addLegend(networkLlegend);
				// WRITE
				networkLpie.write("pie-isp");
                 }); 
			}
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
           
           	if(socialChart){
           	     AmCharts.ready(function () {  	    
				pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataSocial;
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
				pie.write("pie-social");
                });
			}
           	if(pageTrackChart){
			  AmCharts.ready(function () {  	   	
			var	chart = new AmCharts.AmSerialChart();
				chart.dataProvider = chartDataPageTrack;
				chart.validateData();
				chart.categoryField = "date";
				chart.marginTop = 15;
				chart.marginLeft = 15;
				chart.marginRight = 0;
				chart.marginBottom = 20;
				var catAxis = chart.categoryAxis;
				catAxis.labelRotation = 35;
				
				catAxis.axisColor = "#2d66bb";
				catAxis.gridColor = "#2d66bb";
				var valAxis = new AmCharts.ValueAxis();
				valAxis.position = "left";
				valAxis.axisColor = "#2d66bb";
			
				valAxis.gridAlpha = 1;
				valAxis.fillAlpha = 0.1;
				valAxis.dashLength = 3;
				chart.addValueAxis(valAxis);

				var graph = new AmCharts.AmGraph();
				graph.balloonText = "[[category]]: [[value]]";
				graph.valueField = "value1";
				graph.title = "Visits";
				graph.lineColor = "#00AFF0";
				graph.lineThickness = 1;
				graph.bullet = "square";
				graph.dashLength = 0;
				chart.addGraph(graph); 
				
				var graph2 = new AmCharts.AmGraph();
				graph2.balloonText = "[[category]]: [[value]]";
				graph2.valueField = "value2";
				graph2.title = "Page Views";
				graph2.lineColor = "#76ba35";
				graph2.lineThickness = 1;
				graph2.bullet = "square";
				graph2.dashLength = 0;
				chart.addGraph(graph2);
				
				// CURSOR
				var chartCursor = new AmCharts.ChartCursor();
				chartCursor.cursorPosition = "mouse";
				chart.addChartCursor(chartCursor);
				
				legend = new AmCharts.AmLegend();
				legend.position = "bottom";
				legend.borderAlpha = 0;
				legend.horizontalGap = 10;
				legend.switchType = "x"; // or v
				legend.valueText = "";
				chart.addLegend(legend);

				chart.write("demo-plot");
               }); 
			}
            
           	if(deviceChart){
           	  	  AmCharts.ready(function () {  	   	  
			var	pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataDevice;
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
				pie.colors = "#76ba35,#00AFF0,#C72C95,#F8FF01,#FF6600,#04D215,#2A0CD0,#FF0F00,#B0DE09,#0D52D1".split(",");
				
				legend = new AmCharts.AmLegend();
				legend.position = "bottom";
				legend.borderAlpha = 0;
				legend.horizontalGap = 10;
				legend.switchType = "x"; // or v
				legend.valueText = "";
				pie.addLegend(legend);
				// WRITE
				pie.write("pie-device");
                });
			} 
            if(keywordChart){
              	  AmCharts.ready(function () {  	    
				pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataKeyword;
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
				pie.write("donut-chart");
               }); 
			}
            	if(mobdivChart){
            	  AmCharts.ready(function () {   
				pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataMobileDevice;
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
				pie.write("pie-mobdiv");
                });
			}
            
           
       /* 
		AmCharts.ready(function () {  	
			if(userTypeChart){
				pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataUserType;
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
				pie.colors = "#76ba35,#00AFF0,#C72C95,#F8FF01,#FF6600,#04D215,#2A0CD0,#FF0F00,#B0DE09,#0D52D1".split(",");
				
				legend = new AmCharts.AmLegend();
				legend.position = "bottom";
				legend.borderAlpha = 0;
				legend.horizontalGap = 10;
				legend.switchType = "x"; // or v
				legend.valueText = "";
				pie.addLegend(legend);
				// WRITE
				pie.write("pie-usertype");
			}
			if(deviceChart){
				pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataDevice;
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
				pie.colors = "#76ba35,#00AFF0,#C72C95,#F8FF01,#FF6600,#04D215,#2A0CD0,#FF0F00,#B0DE09,#0D52D1".split(",");
				
				legend = new AmCharts.AmLegend();
				legend.position = "bottom";
				legend.borderAlpha = 0;
				legend.horizontalGap = 10;
				legend.switchType = "x"; // or v
				legend.valueText = "";
				pie.addLegend(legend);
				// WRITE
				pie.write("pie-device");
			}
			if(mobdivChart){
				pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataMobileDevice;
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
				pie.write("pie-mobdiv");
			}
			if(sourceChart){
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
			}
			if(keywordChart){
				pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataKeyword;
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
				pie.write("donut-chart");
			}
			if(socialChart){
				pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataSocial;
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
				pie.write("pie-social");
			}
			if(countryChart){
				pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataCountry;
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
				pie.write("pie-country");
			} 
			if(cityChart){
			var	pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataCity;
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
				
			var	legend = new AmCharts.AmLegend();
				legend.position = "bottom";
				legend.borderAlpha = 0;
				legend.horizontalGap = 10;
				legend.switchType = "x"; // or v
				legend.valueText = "";
				pie.addLegend(legend);
				// WRITE
				pie.write("pie-city");
			}
			if(osChart){
				pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataOS;
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
				pie.write("pie-os");
			}
			if(browsersChart){
				pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataBrowsers;
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
				pie.write("pie-browser");
			}
			if(networkLocationsChart){
				pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataNetworkLocations;
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
				pie.write("pie-isp");
			}
			if(screenResolutionsChart){
				pie = new AmCharts.AmPieChart();
				pie.dataProvider = pieDataScreenResolutions;
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
				pie.write("pie-screen");
			}
			if(pageTrackChart){
				
				chart = new AmCharts.AmSerialChart();
				chart.dataProvider = chartDataPageTrack;
				chart.validateData();
				chart.categoryField = "date";
				chart.marginTop = 15;
				chart.marginLeft = 15;
				chart.marginRight = 0;
				chart.marginBottom = 20;
				var catAxis = chart.categoryAxis;
				catAxis.labelRotation = 35;
				
				catAxis.axisColor = "#2d66bb";
				catAxis.gridColor = "#2d66bb";
				var valAxis = new AmCharts.ValueAxis();
				valAxis.position = "left";
				valAxis.axisColor = "#2d66bb";
			
				valAxis.gridAlpha = 1;
				valAxis.fillAlpha = 0.1;
				valAxis.dashLength = 3;
				chart.addValueAxis(valAxis);

				var graph = new AmCharts.AmGraph();
				graph.balloonText = "[[category]]: [[value]]";
				graph.valueField = "value1";
				graph.title = "Visits";
				graph.lineColor = "#00AFF0";
				graph.lineThickness = 1;
				graph.bullet = "square";
				graph.dashLength = 0;
				chart.addGraph(graph); 
				
				var graph2 = new AmCharts.AmGraph();
				graph2.balloonText = "[[category]]: [[value]]";
				graph2.valueField = "value2";
				graph2.title = "Page Views";
				graph2.lineColor = "#76ba35";
				graph2.lineThickness = 1;
				graph2.bullet = "square";
				graph2.dashLength = 0;
				chart.addGraph(graph2);
				
				// CURSOR
				var chartCursor = new AmCharts.ChartCursor();
				chartCursor.cursorPosition = "mouse";
				chart.addChartCursor(chartCursor);
				
				legend = new AmCharts.AmLegend();
				legend.position = "bottom";
				legend.borderAlpha = 0;
				legend.horizontalGap = 10;
				legend.switchType = "x"; // or v
				legend.valueText = "";
				chart.addLegend(legend);

				chart.write("demo-plot");
			}
		}); 
        */
	</script>   
    <script src="<?=ADMIN_THEEM_JS?>plugins/jquery.slimscroll/jquery.slimscroll.min.js"></script>           
    <script>
      $(function() {
        // Chat inbox
         $(".maxheight").slimScroll({
          height: '500px',
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
                    url:  '<?php echo base_url();?>admin/stats/dragdroplist',
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
    
	
	
  });
   </script>      