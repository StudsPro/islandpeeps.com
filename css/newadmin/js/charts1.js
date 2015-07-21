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

  var  handleDonutPieChart, init;
  init = function() {
  
    handleDonutPieChart();
   
  };
  
  /*Donut & Pie Chart*/

  handleDonutPieChart = function() {
 $.plot($("#pie-chart"), datapie, {
      series: {
        pie: {
          show: true,
           
        }
      } 
    });


 if(chartp==true){
    $.plot($("#donut-chart"), datagk, {
      series: {
        pie: {
          innerRadius: 0.5,
          show: true
        }
      }
    });
 
    $.plot($("#pie-usertype"), dataut, {
      series: {
        pie: {
          show: true,
          radius: 1,
          label: {
            show: true,
            radius: 3 / 4,
            formatter: function(label, series) {
              return "<div style=\"font-size:8pt;text-align:center;padding:2px;color:white;\">" + label + "<br/>" + Math.round(series.percent) + "%</div>";
            },
            background: {
              opacity: 0.5,
              color: "#000"
            }
          }
        }
      },
      legend: {
        show: false
      }
    });
 
  $.plot($("#pie-social"), socialtr, {
 series: {
         pie: {
             show: true,
             label: {
                 show: true,
                 formatter: function(label,point){
                     return(point.percent.toFixed(2) + '%');
                     
                 }
             }
        }
    },        
    legend: {show: true}
    });
 
  $.plot($("#pie-mobd"), mobdiv, {
 series: {
         pie: {
	     innerRadius: 0.5,
             show: true,
             label: {
                 show: true,
                 formatter: function(label,point){
                     return(point.percent.toFixed(2) + '%');
                     
                 }
             }
        }
    },        
    legend: {show: true}
    });
}
};
   
  return {
    init: init
  };
})(jQuery);
