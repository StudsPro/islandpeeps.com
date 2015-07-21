<style>
  .new_col6 > div:nth-child(2n+1) {
  clear: both;
}
.span2{
    cursor: move;
}
  </style>
 <?php
    $usermasterliststats=dragdropmenu('masterliststats');
    $rside_dashboard=array();
    //echo "<pre>";print_r($userdashboardmenus);exit;
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
         <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading" >
                  <h3 class="panel-title col-md-11">Master List Stats</h3>
               </div>
                </div>
			     <div class="panel-body">
                  <div class="row grid">
                      <?php
                         $kindgetclass="class='form-control input-md' id='category' "; 
                         $mlistcategory_html='<div class="row span2" id="mlistcategory">
                              	<div class="col-md-12">
                                          <div class="panel panel-default  ">
                                            <div class="panel-heading ">
                                              <div class="panel-title">&nbsp;Category</div>
                                            </div>
                                            <div class="panel-body maxheight">
                                               <div class="col-md-4">
                              '.form_dropdown('category', $categories, $category,$kindgetclass).'
                               </div>
                                              <div class="col-md-12">
                                                <div id="pie-cat" class="plot" style="height:300px"></div>
                                               </div> 
                                              
                                               
                                            </div>
                                          </div>
                                  </div>  
                       </div> ';
                        
                        $mlist_stats["mlistcategory"]=$mlistcategory_html;
                        
                        ?>
                    
                    
                      <?php
                        
                         $mlistsinger_html='<div class="row span2" id="mlistsinger">
                              	<div class="col-md-12">
                                          <div class="panel panel-primary  ">
                                            <div class="panel-heading ">
                                              <div class="panel-title">&nbsp;Singer</div>
                                            </div>
                                            <div class="panel-body maxheight">
                                               <div class="col-md-12">
                                                <div id="pie-singer" class="plot" style="height:300px"></div>
                                               </div> 
                                              
                                               
                                            </div>
                                          </div>
                                  </div>  
                       </div>';
                        
                        $mlist_stats["mlistsinger"]=$mlistsinger_html;
                        
                        ?>
                       
                       <?php
                        
                         $mlistathletes_html='<div class="row span2" id="mlistathletes">
                              	<div class="col-md-12">
                                          <div class="panel panel-primary  ">
                                            <div class="panel-heading ">
                                              <div class="panel-title">&nbsp;Athletes</div>
                                            </div>
                                            <div class="panel-body maxheight">
                                               <div class="col-md-12">
                                                <div id="pie-athletes" class="plot" style="height:300px"></div>
                                               </div> 
                                              
                                               
                                            </div>
                                          </div>
                                  </div>  
                       </div>';
                        
                        $mlist_stats["mlistathletes"]=$mlistathletes_html;
                        
                        ?>
                        <?php
                        
                         $mlistactors_html='<div class="row span2" id="mlistactors">
                              	<div class="col-md-12">
                                          <div class="panel panel-primary  ">
                                            <div class="panel-heading ">
                                              <div class="panel-title">&nbsp;Actors</div>
                                            </div>
                                            <div class="panel-body maxheight">
                                               <div class="col-md-12">
                                                <div id="pie-actors" class="plot" style="height:300px"></div>
                                               </div> 
                                              
                                               
                                            </div>
                                          </div>
                                  </div>  
                       </div> ';
                        
                        $mlist_stats["mlistactors"]=$mlistactors_html;
                        
                        ?>
                        
                        <?php
                        
                         $politicians_html='<div class="row span2" id="mlistpoliticians">
                              	<div class="col-md-12">
                                          <div class="panel panel-primary  ">
                                            <div class="panel-heading ">
                                              <div class="panel-title">&nbsp;Politicians</div>
                                            </div>
                                            <div class="panel-body maxheight">
                                               <div class="col-md-12">
                                                <div id="pie-politicians" class="plot" style="height:300px"></div>
                                               </div> 
                                              
                                               
                                            </div>
                                          </div>
                                  </div>  
                       </div> ';
                        
                        $mlist_stats["mlistpoliticians"]=$politicians_html;
                        
                        ?>
                        <?php
                        
                         $gangsters_html='<div class="row span2" id="mlistgangsters">
                              	<div class="col-md-12">
                                          <div class="panel panel-primary  ">
                                            <div class="panel-heading ">
                                              <div class="panel-title">&nbsp;Gangsters</div>
                                            </div>
                                            <div class="panel-body maxheight">
                                               <div class="col-md-12">
                                                <div id="pie-gangsters" class="plot" style="height:300px"></div>
                                               </div> 
                                              
                                               
                                            </div>
                                          </div>
                                  </div>  
                       </div> ';
                        
                        $mlist_stats["mlistgangsters"]=$gangsters_html;
                        
                        ?>
                         <?php
                        
                         $authors_html='<div class="row span2" id="mlistauthors">
                              	<div class="col-md-12">
                                          <div class="panel panel-primary  ">
                                            <div class="panel-heading ">
                                              <div class="panel-title">&nbsp;Authors</div>
                                            </div>
                                            <div class="panel-body maxheight">
                                               <div class="col-md-12">
                                                <div id="pie-authors" class="plot" style="height:300px"></div>
                                               </div> 
                                              
                                               
                                            </div>
                                          </div>
                                  </div>  
                       </div> ';
                        
                        $mlist_stats["mlistauthors"]=$authors_html;
                        
                        ?>
                        
                         <?php
                        
                         $profilepercountry_html='<div class="row span2" id="mlistprofilepercountry">
                              	<div class="col-md-12">
                                          <div class="panel panel-primary  ">
                                            <div class="panel-heading ">
                                              <div class="panel-title">&nbsp;Profiles Per Country</div>
                                            </div>
                                            <div class="panel-body propercmaxheight">
                                               <div class="col-md-12">
                                                <div id="pie-properc" class="plot" style="height:600px"></div>
                                               </div> 
                                              
                                               
                                            </div>
                                          </div>
                                  </div>  
                       </div> ';
                        
                        $mlist_stats["mlistprofilepercountry"]=$profilepercountry_html;
                        
                        ?>
                        
                        <?php
                        
                         $profilebyaffiliate_html='<div class="row span2" id="mlistprofilebyaffiliate">
                              	<div class="col-md-12">
                                          <div class="panel panel-primary  ">
                                            <div class="panel-heading ">
                                              <div class="panel-title">&nbsp;Profile upload by Affiliate</div>
                                            </div>
                                            <div class="panel-body maxheight">
                                               <div class="col-md-12">
                                                <div id="pie-profilebyadmin" class="plot" style="height:300px"></div>
                                               </div> 
                                              
                                               
                                            </div>
                                          </div>
                                  </div>  
                       </div> ';
                        
                        $mlist_stats["mlistprofilebyaffiliate"]=$profilebyaffiliate_html;
                        
                        ?>
                         
                       <?php
                        
                         $masterlistprofile_html='<div class="row span2" id="mlistmasterlistprofile">
                              	<div class="col-md-12">
                                          <div class="panel panel-primary  ">
                                            <div class="panel-heading ">
                                              <div class="panel-title">&nbsp;Master List Profiles</div>
                                            </div>
                                            <div class="panel-body maxheight">
                                               <div class="col-md-12">
                                                <div id="pie-masterlists" class="plot" style="height:300px"></div>
                                               </div> 
                                              
                                               
                                            </div>
                                          </div>
                                  </div>  
                       </div>';
                        
                        $mlist_stats["mlistmasterlistprofile"]=$masterlistprofile_html;
                        
                        ?>  
                        
                        <?php
                        
                         $mlistprofilestatus_html='<div class="row span2" id="mlistprofilestatus">
                              	<div class="col-md-12">
                                          <div class="panel panel-primary  ">
                                            <div class="panel-heading ">
                                              <div class="panel-title">&nbsp;Profile Status</div>
                                            </div>
                                            <div class="panel-body maxheight">
                                               <div class="col-md-12">
                                                <div id="pie-profilestatus" class="plot" style="height:300px"></div>
                                               </div> 
                                              
                                               
                                            </div>
                                          </div>
                                  </div>  
                       </div> ';
                        
                        $mlist_stats["mlistprofilestatus"]=$mlistprofilestatus_html;
                        
                        ?>  
                       <?php
                        
                         $mlistbirthbymonth_html='<div class="row span2" id="mlistbirthbymonth">
                              	<div class="col-md-12">
                                          <div class="panel panel-primary  ">
                                            <div class="panel-heading ">
                                              <div class="panel-title">&nbsp;Birth By Month</div>
                                            </div>
                                            <div class="panel-body maxheight">
                                               <div class="col-md-12">
                                                <div id="pie-profilebob" class="plot" style="height:300px"></div>
                                               </div> 
                                              
                                               
                                            </div>
                                          </div>
                                  </div>  
                       </div> ';
                        
                        $mlist_stats["mlistbirthbymonth"]=$mlistbirthbymonth_html;
                        
                        ?>  
                       <?php
                       
                            if(isset($usermasterliststats) && count($usermasterliststats) > 0)
                             {
                               foreach($usermasterliststats as $key => $value)
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
                                       
                       
                       ?>
                        
                    </div>   
                         
                  </div>  
              </div>
              
                
            </div>
            
           </div>  
        
      
			 <!--main content -->
   
   <script src="<?php echo ADMIN_THEEM_JS;?>plugins/jquery.jqvmap/jquery.vmap.min.js"></script>
    <script src="<?php echo ADMIN_THEEM_JS;?>plugins/jquery.jqvmap/maps/jquery.vmap.world.js"></script>
  	    
    <script src="<?=ADMIN_THEEM_JS?>amcharts/raphael.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>amcharts/amcharts.js"></script>
 	<script type="text/javascript">
    
    $('#category').on('change', function() {
 // alert( this.value ); // or $(this).val()
  
    window.location.href="<?php echo base_url();?>admin/mliststats/index/"+this.value;
});
    
		var catChart = '<?= $cat ? 'yes' : ''?>';
		var pieDatacate = [<?= rtrim($cat,',')?>];
       
       	var SingerChart = '<?= $Singer ? 'yes' : ''?>';
		var pieDataSinger = [<?= rtrim($Singer,',')?>];
        
       	var AthletesChart = '<?= $Athletes ? 'yes' : ''?>';
		var pieDataAthletes = [<?= rtrim($Athletes,',')?>];
        
        var ActorsChart = '<?= $Actors ? 'yes' : ''?>';
		var pieDataActors = [<?= rtrim($Actors,',')?>];
        
         var PoliticiansChart = '<?= $Politicians ? 'yes' : ''?>';
		var pieDataPoliticians = [<?= rtrim($Politicians,',')?>];
        
         var GangstersChart = '<?= $Gangsters ? 'yes' : ''?>';
		var pieDataGangsters = [<?= rtrim($Gangsters,',')?>];
        
         var AuthorsChart = '<?= $Authors ? 'yes' : ''?>';
		var pieDataAuthors = [<?= rtrim($Authors,',')?>];
           
          var propercChart = '<?= $profilepercountry ? 'yes' : ''?>';
         var pieDataproperc = [<?= rtrim($profilepercountry,',')?>];  
           
            var profilebyadminChart = '<?= $profilebyadmin ? 'yes' : ''?>';
         var pieDataprofilebyadmin = [<?= rtrim($profilebyadmin,',')?>];  
            var masterlistsadminChart = '<?= $masterlists ? 'yes' : ''?>';
         var pieDatamasterlists = [<?= rtrim($masterlists,',')?>];  
           
            var profilestatusadminChart = '<?= $profilestatus ? 'yes' : ''?>';
         var pieDataprofilestatus = [<?= rtrim($profilestatus,',')?>];  
           
            var profilebobadminChart = '<?= $profilebob ? 'yes' : ''?>';
         var pieDataprofilebob = [<?= rtrim($profilebob,',')?>]; 
           
            if(profilebobadminChart){
            	  AmCharts.ready(function () {   
			var	upie = new AmCharts.AmPieChart();
				upie.dataProvider = pieDataprofilebob;
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
				upie.write("pie-profilebob");
                });
			}
           
           if(profilestatusadminChart){
            	  AmCharts.ready(function () {   
			var	upie = new AmCharts.AmPieChart();
				upie.dataProvider = pieDataprofilestatus;
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
				upie.write("pie-profilestatus");
                });
			}
           
             if(masterlistsadminChart){
            	  AmCharts.ready(function () {   
			var	upie = new AmCharts.AmPieChart();
				upie.dataProvider = pieDatamasterlists;
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
				upie.write("pie-masterlists");
                });
			}
           
           if(profilebyadminChart){
            	  AmCharts.ready(function () {   
			var	upie = new AmCharts.AmPieChart();
				upie.dataProvider = pieDataprofilebyadmin;
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
				upie.write("pie-profilebyadmin");
                });
			}
           
           if(propercChart){
            /*
            	  AmCharts.ready(function () {   
			var	upie = new AmCharts.AmPieChart();
				upie.dataProvider = pieDataproperc;
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
				upie.angle = 40;
				upie.colors = "#76ba35,#00AFF0,#C72C95,#F8FF01,#FF6600,#04D215,#2A0CD0,#FF0F00,#B0DE09,#0D52D1,#0D5221,#76b035,#06AFF0,#C70C95,#58FF01,#B05209,#44D215,#2A0C95,#2F0F0F,#B05E09".split(",");
				
			var	ulegend = new AmCharts.AmLegend();
				ulegend.position = "bottom";
				ulegend.borderAlpha = 0;
				ulegend.horizontalGap = 10;
				ulegend.switchType = "x"; // or v
				ulegend.valueText = "";
				upie.addLegend(ulegend);
				// WRITE
				upie.write("pie-properc");
                });
                
                */
                
                    
               json = pieDataproperc;
//			AmCharts.ready(function() {
    // SERIAL CHART
chart = new AmCharts.AmSerialChart();
chart.dataProvider = json;chart.categoryField = "country";chart.marginRight = 0;chart.marginTop = 0; 
//chart.autoMarginOffset = 0;
// the following two lines makes chart 3D
chart.depth3D = 20;chart.angle = 30;
// AXES // category
var categoryAxis = chart.categoryAxis;categoryAxis.labelRotation = 90;categoryAxis.gridPosition = "start";
categoryAxis.inside = true;categoryAxis.gridCount = json.length;categoryAxis.autoGridCount = false;
// value
var valueAxis = new AmCharts.ValueAxis();valueAxis.title = "Result";chart.addValueAxis(valueAxis);
// GRAPH            
var graph = new AmCharts.AmGraph();graph.valueField = "visits";
graph.colorField = "color";
graph.balloonText = "[[category]]: [[value]]";graph.type = "column";graph.lineAlpha = 0;graph.fillAlphas = 1;
chart.addGraph(graph);
// WRITE
chart.write("pie-properc");     
                    
                
			}
           
           if(AuthorsChart){
            	  AmCharts.ready(function () {   
			var	upie = new AmCharts.AmPieChart();
				upie.dataProvider = pieDataAuthors;
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
				upie.write("pie-authors");
                });
			}
           if(GangstersChart){
            	  AmCharts.ready(function () {   
			var	upie = new AmCharts.AmPieChart();
				upie.dataProvider = pieDataGangsters;
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
				upie.write("pie-gangsters");
                });
			}
             	if(catChart){
            	  AmCharts.ready(function () {   
			var	upie = new AmCharts.AmPieChart();
				upie.dataProvider = pieDatacate;
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
				upie.write("pie-cat");
                });
			}
            
            	if(SingerChart){
            	  AmCharts.ready(function () {   
			var	upie = new AmCharts.AmPieChart();
				upie.dataProvider = pieDataSinger;
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
				upie.write("pie-singer");
                });
			}
            
            if(AthletesChart){
            	  AmCharts.ready(function () {   
			var	upie = new AmCharts.AmPieChart();
				upie.dataProvider = pieDataAthletes;
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
				upie.write("pie-athletes");
                });
			}
           if(ActorsChart){
            	  AmCharts.ready(function () {   
			var	upie = new AmCharts.AmPieChart();
				upie.dataProvider = pieDataActors;
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
				upie.write("pie-actors");
                });
			}
             if(PoliticiansChart){
            	  AmCharts.ready(function () {   
			var	upie = new AmCharts.AmPieChart();
				upie.dataProvider = pieDataPoliticians;
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
				upie.write("pie-politicians");
                });
			}
	</script>   
    <script src="<?=ADMIN_THEEM_JS?>plugins/jquery.slimscroll/jquery.slimscroll.min.js"></script>           
    <script>
      $(function() {
        // Chat inbox
         $(".maxheight").slimScroll({
          height: '350px',
        });
         $(".propercmaxheight").slimScroll({
          height: '600px',
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
                    url:  '<?php echo base_url();?>admin/mliststats/dragdroplist',
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