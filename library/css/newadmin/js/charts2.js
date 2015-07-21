/**
 * Product:        Social - Premium Responsive Admin Template
 * Version:        v1.5.1
 * Copyright:      2013 CesarLab.com
 * License:        http://themeforest.net/licenses
 * Live Preview:   http://go.cesarlab.com/SocialAdminTemplate
 * Purchase:       http://go.cesarlab.com/PurchaseSocial
 *
*/

var Charts;

Charts = (function($) {
  "use strict";
  /**/

  var  handleBarChart,handleDonutPieChart, init;
  init = function() {
  
    handleBarChart();
    handleDonutPieChart();
  };
  
 handleBarChart = function() {

 	var income = databar1;
	var data = [
		{
		    data: income,
		    color: '#409628',
		    label:'Income',
		    bars: {show: true, align:'center', barWidth:0.3}
		}    
	    ];
 
	var options = {
	    xaxis: { ticks:databar11}
	};
	   $.plot($("#bar1"), data, options);

	var income = databar2;
	var data = [
		{
		    data: income,
		    color: '#CB4B4B',
		    label:'Income',
		    bars: {show: true, align:'center', barWidth:0.3}
		}    
	    ];
 
	var options = {
	    xaxis: { ticks:databar21}
	};

	   $.plot($("#bar2"), data, options);

 	var income = databar3;
	var data = [
		{
		    data: income,
		    color: '#EDC240',
		    label:'Income',
		    bars: {show: true, align:'center', barWidth:0.3}
		}    
	    ];
 
	var options = {
	    xaxis: { ticks:databar31}
	};

	   $.plot($("#bar3"), data, options);
  };
 handleDonutPieChart = function() {
 
 
  if(datapie){
    $.plot($("#donut"), datapie, {
      series: {
        pie: {
          innerRadius: 0.3,
          show: true,
	 label: {
            show: false,
 
            }
        },legend: {show: true}
      }
    });
  }
  if(datapie1){
    $.plot($("#donut1"), datapie1, {
      series: {
        pie: {
          innerRadius: 0.3,
          show: true,
	 label: {
            show: true,
 
            }
        },legend: {show: true}
      }
    });
  }
  if(datapie2){
    $.plot($("#donut2"), datapie2, {
      series: {
        pie: {
          innerRadius: 0.3,
          show: true,
	 label: {
            show: true,
 
            }
        },legend: {show: true}
      }
    });
  }
  if(datapie3){
    $.plot($("#donut4"), datapie3, {
      series: {
        pie: {
          innerRadius: 0.3,
          show: true,
	 label: {
            show: true,
 
            }
        },legend: {show: true}
      }
    });
  }  
  if(datapie4){
    $.plot($("#donut5"), datapie4, {
      series: {
        pie: {
          innerRadius: 0.3,
          show: true,
	 label: {
            show: true,
 
            }
        },legend: {show: true}
      }
    });
  }  
if(datapie5){
    $.plot($("#donut6"), datapie5, {
      series: {
        pie: {
          innerRadius: 0.3,
          show: true,
	 label: {
            show: false,
 
            }
        },legend: {show: true}
      }
    });
  }  
  };

  return {
    init: init
  };
})(jQuery);
