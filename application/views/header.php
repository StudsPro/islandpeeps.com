<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
  	<base href="<?php echo base_url(); ?>"/>
    <link rel="icon" href="favicon.ico"/>
  	<title>
      <?php
      
       if(isset($this->uri->segments[1]))
      {
      
        $page = $this->uri->segments[1];
        echo ucfirst($page);
      } 
       else
      { 
      ?>
    :: LIMO CAR ::
      <?php
      }
      ?>
    </title>

    <link rel="stylesheet" href="<?php echo base_url() ?>library/css/bootstrap.min.css" rel="stylesheet"/>

	<link rel="stylesheet" href="<?php echo base_url() ?>library/css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="<?php echo base_url() ?>library/css/font-awesome/font-awesome.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="<?php echo base_url() ?>library/css/style.css" rel="stylesheet"/>
    

    <script src="<?php echo base_url() ?>library/js/jquery.js"></script>
	<script src="<?php echo base_url() ?>library/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>library/js/jquery.validate.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script> 
    <script src="<?php echo base_url() ?>library/js/popover.js"></script>

  </head>

  <body>
 <nav class="navbar navbar-default custom-navbar"  role="navigation">
        <div class="container custom-container custom-nav-menu">
          <div class="navbar-header navigation-bar">
            <div class="logo">
            <a class="" href="#"><img src="<?php echo base_url() ?>library/image/logo.png"/></a>
	      </div>	
	     <div class="mobile-logo display-off"><img src="<?php echo base_url() ?>library/image/phone-logo.png"/><span>+65 6735 0735</span></div>
	    <div class="navigate-bar">
		 <div class="mobile-logo display-in"><img src="<?php echo base_url() ?>library/image/phone-logo.png"/><span>+65 6735 0735</span></div>
		    <button type="button" id="menu-tab" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
		</div>
              
          </div>
		  
		  
          <div id="navbar" class="navbar-collapse collapse navbar-right custom-nav pull-right pad-0">
            <ul id="menu-tab_ul" class="nav navbar-nav pull-right">
              <li class="active"><a href="<?php echo base_url()?>">HOME</a></li>
              <li class="dropdown ">
                <a href="<?php echo base_url()?>aboutus" class="dropdown-toggle"  data-hover="dropdown" data-toggle="dropdown" role="button" aria-expanded="false">ABOUT US<span class="caret"></span></a>
                <ul class="dropdown-menu dropdown-menu-left custom-ul" role="menu">
                  <li><a href="<?php echo base_url();?>client-profile.php">Client Profile</a></li>
                  <li><a href="#">Testimonials</a></li>
       
                 </ul>
              </li>
              
              <li class=" "><a href="<?php echo base_url();?>limousine">LIMOUSINE</a><li>
			  
			  <li class=""><a href="<?php echo base_url();?>bus">BUS</a></li>
			  
			  <li class=""><a href="<?php echo base_url();?>minibus">MINIBUS</a></li>
			  <li class=""><a href="<?php echo base_url();?>airport">AIRPORT TRANSFER</a></li>
			  <li class=""><a href="<?php echo base_url();?>attraction">ATTRACTIONS</a></li>
			  <li class=""><a href="<?php echo base_url();?>business">BUSNIESS</a></li>
              <li class=""><a href="<?php echo base_url();?>chaufferservices">CHAUFFEUR SERVICES</a></li>
           </ul>
           
          </div>
          <?php if($this->session->userdata('logged_in')){?>
          <div class="userSlogout" id="UserProfile">
                    <span class="COMname">
                    <?php 
                        $CompanyName=$this->session->userdata('CompanyName');
                        if(isset($CompanyName))
                        {
                            echo $this->session->userdata('CompanyName');
                        }
                    ?>
                    
                    </span>
                <span><i class="fa fa-caret-down pull-right head_CustomArrow"></i> </span>
                <div class="profile_info">
                    <p class="text-left">View Change Profile</p>
                    <p class="text-left">Order History</p>
                    <p class="text-left">
                        <a href="<?php echo base_url();?>logout"><!--<i class="fa fa-power-off"></i>-->Logout</a>
                    </p>
                </div>
          </div>
          <?php  }?>
        </div>
      </nav>
	<div class="clearfix"></div> 
 <script type="text/javascript">
 
 
 $(document).ready(function()
			{
		       $("#menu-tab").click( function(){
				$("#menu-tab_ul").slideToggle("normal");
				});
                
                
              $(".booking_btn").click(function(){
                window.location = '<?php echo base_url() ?>selectvehicle';
              });           
              $('#UserProfile').click(function(){
               //alert("jdfkj");
               //$(this).css("border-radius","0");
               $(this).toggleClass("togggleBorder");
               $('.profile_info').slideToggle("normal");
              }) 
		});
        </script> 	
	<?php  //exit; ?>