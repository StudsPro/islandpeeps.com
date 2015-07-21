<div class="clearfix"></div>  
   <div class="footer pad-bottom">
     <div class="container custom-container pad-1"> 
      <div class="footer-inner">
     
     <div class="col-lg-2 col-sm-4 pad-0 col-md-2 f1 ">
      <div class="col-md-12 col-xs-6 col-sm-12 col-lg-12 pad-0 f1-1 h3Cls">
           <h3 id="1"  onclick="getId('1')">Customer Support <span id="customer_span1" class="hidden-lg hidden-md hidden-sm  glyphicon  glyphicon-plus"></span></h3> 
        <ul id="get_ul1" class="nav">
            <li><a href="<?php echo base_url();?>">Contact Us</a></li>
           <li><a href="<?php echo base_url();?>">FAQs </a></li>
           <li><a href="<?php echo base_url();?>">Wait Time Policy</a></li>
           <li><a href="<?php echo base_url();?>">Tolls</a> </li>
           <li><a href="<?php echo base_url();?>">Privacy Policy</a></li>
           <li><a href="<?php echo base_url();?>site-map">Site Map</a></li>
        </ul>
       
      </div>
      </div> 
      
      <div class="col-lg-7 col-md-8 pad-0 f2">                   
       <div class="col-md-3 col-xs-6  col-sm-4 col-lg-3 pad-0 f2-1 h3Cls">
        <h3 id="2"  onclick="getId('2')">Product and Services <span id="customer_span2" class="hidden-lg hidden-md hidden-sm glyphicon  glyphicon-plus"></span></h3>
        <ul id="get_ul2" class="nav">
           <li><a href="<?php echo base_url();?>">Point to Point Car Services</a></li>
           <li><a href="<?php echo base_url();?>">Airport Transportation </a></li>
           <li><a href="<?php echo base_url();?>">Hourly Car Service</a></li>
           <li><a href="<?php echo base_url();?>">Coporate Limo Service</a></li>
           <li><a href="<?php echo base_url();?>">Best in Class Operations</a></li>
           <li><a href="<?php echo base_url();?>">On Time Reliability</a></li>
           <li><a href="<?php echo base_url();?>">Worldwide Service</a></li>
		           
        </ul>
      </div>
      
       <div class="col-md-3 col-xs-6 col-sm-4 col-lg-3 pad-0 f2-2 h3Cls">
       <h3 id="3" onclick="getId('3')" >Know More about Us <span id="customer_span3" class="hidden-lg hidden-md hidden-sm glyphicon  glyphicon-plus"></span></h3>
         <ul id="get_ul3" class="nav">
           <li><a href="<?php echo base_url();?>">Why LimoCars</a></li>
           <li><a href="<?php echo base_url();?>">Our History</a></li>
		   <li><a href="<?php echo base_url();?>">LimoCars Difference</a></li>
		   <li><a href="<?php echo base_url();?>">Car Service Fleet</a></li>
		   <li><a href="<?php echo base_url();?>">Limo Service Rates</a></li>
		   <li><a href="<?php echo base_url();?>">Management Team</a></li>
		   <li><a href="<?php echo base_url();?>">Careers</a></li>
		   <li><a href="<?php echo base_url();?>">Press</a></li>
		   <li><a href="<?php echo base_url();?>">Blog</a></li>
        </ul>
      </div>
      
       <div class="col-md-3 col-xs-6 col-sm-4 col-lg-3 pad-0 f2-3 h3Cls">
        <h3 id="4"  onclick="getId('4')">GREEN INITIATIVE <span id="customer_span4" class="hidden-lg hidden-md hidden-sm glyphicon  glyphicon-plus"></span></h3>
        <ul id="get_ul4" class="nav">
             <li><a href="<?php echo base_url();?>">Our Commitment</a></li>
         </ul>
      </div>
      
       <div class="col-md-3 col-xs-6 col-sm-4 col-lg-3 pad-0 f2-4 h3Cls">
        <h3 id="5" onclick="getId('5')">Partner Us <span id="customer_span5" class="hidden-lg hidden-md hidden-sm glyphicon  glyphicon-plus"></span></h3>
         <ul id="get_ul5" class="nav">
           <li><a href="<?php echo base_url();?>">Partners</a></li>
           <li><a href="<?php echo base_url();?>">Affiliates</a></li>
        </ul>
      </div>
      </div>
      
       <div class="col-lg-3 col-md-2 pad-0 col-sm-4 col-xs-12 pad-1 f3">                  
                  
      <div class="col-md-12 pull-right copy-right col-xs-12 col-sm-12 col-lg-9 pad-0 pull-right">
        <div class="text-left">
          <p><strong>&copy; 2014 @Limocars.SG</strong></p>
          <div class="pad-2">
            <p>Limousine, Car and Bus Services in Singapore</p>
            <p>All rights reserved. </p>
         </div>  
        </div>
        
      </div>
     
     </div> 
      </div>
     
     </div>
   
   </div>   
    </div>  
  <script>
 //$(window).resize(function() {getId(id)});
 function getId(id){
  if($(window).width()<= 480)
     {
	   $("#customer_span"+id).toggleClass("glyphicon-minus");
	   $("#get_ul"+id).slideToggle("normal");
	 }
 }  

			
 
  
  </script>

    
  </body>
</html>
