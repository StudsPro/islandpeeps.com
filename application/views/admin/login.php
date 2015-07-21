<!DOCTYPE html>
<!--
 Product:        Social - Premium Responsive Admin Template
 Version:        2.1.3
 Copyright:      2015 cesarlab.com
 License:        http://themeforest.net/licenses
 Live Preview:   http://go.cesarlab.com/SocialAdminTemplate2
 Purchase:       http://go.cesarlab.com/PurchaseSocial2
-->
<html>
  <head>
    <meta charset="utf-8">
     <title><?=SITE_NAME;?> :: <?php echo $title ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=META_DESCRIPTION;?>">
	<meta name="keyword" content="<?=META_KEYWORDS;?>">
	
    <meta name="author" content="<?=SITE_NAME;?>">
    <link href="<?=ADMIN_THEEM_CSS;?>social.core.css" rel="stylesheet">
    <link href="<?=ADMIN_THEEM_CSS;?>social.admin.css" rel="stylesheet">
    <link href="<?=ADMIN_THEEM_CSS;?>font-awesome/font-awesome.css" rel="stylesheet">
    <!-- Current theme-->
    <link id="current-theme" href="<?=ADMIN_THEEM_CSS;?>themes/admin/facebook.css" rel="stylesheet">
    <link href="<?=ADMIN_THEEM_CSS;?>layouts/login1.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--[if lt IE 8]>
    <script src="<?=ADMIN_THEEM_JS;?>html5shiv/html5shiv.js"></script>
    <script src="<?=ADMIN_THEEM_JS;?>plugins/respond/respond.min.js"></script> 
    <![endif]-->
  </head>
  <body>
    <div class="container">
      
   
                    
      <!-- BEGIN SIGNIN SECTION-->
      <form role="form" class="form-signin form-horizontal" action="" method="post" name="submit_frm" id="submit_frm">
         <?php
        if($this->session->flashdata('mailsucess')) 
                     { ?>
        <div class="row">
          <div class="col-xs-12">
            <div class="alert alert-success"> <?php echo $this->session->flashdata('mailsucess');  ?></div>
          </div>
       </div>  
       <?php	}
                     ?>  
        <!-- //Notice .form-heading class-->
        <h2 class="form-heading text-center">Please sign in</h2>
        <input type="text" placeholder="Username" required="" autofocus="" class="form-control" name="username">
        <input type="password" placeholder="Password" required="" class="form-control" name="password" >
        <div class="row">
          <div class="col-xs-6">
            <label class="checkbox">
             <!-- <input type="checkbox" value="remember-me">Remember me-->
            </label>
          </div>
          <div class="col-xs-6">
		  	<input type="submit" class="btn btn-primary btn-block" value="Sign in">
          </div>
          
          
        </div>
         <div class="forget-password">
          <p class="text-center">Forgot password? <a href="<?php echo base_url().'admin/home/forgotpassword';?>" id="link-forgot">Click here to reset</a></p>
        </div>
        <!--<div class="forget-password">Forgot password?
          <a id="link-forgot" href="#"> Click here to reset</a>
        </div>
        <button id="btn-register-form" type="button" class="btn btn-success btn-block">Register</button>-->
      </form>
   
      <!-- END SIGNIN SECTION-->
      <!-- BEGIN SIGNUP SECTION-->
       
      <!-- END SIGNUP SECTION-->
      <!-- BEGIN FORGOT PASSWORD SECTION-->
       
      <!-- END FORGOT PASSWORD SECTION-->
      <!-- BEGIN FOOTER SECTION-->
      <footer><?=date("Y");?> &copy; <?=SITE_NAME;?></footer>
      <!-- END FOOTER SECTION-->
    </div>
    <!-- jQuery-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
      window.jQuery || document.write('<script src="<?=ADMIN_THEEM_JS;?>jquery/jquery.min.js"><\/script>')
    </script>
    <!-- Bootstrap JS-->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script>
      $.fn.modal || document.write('<script src="<?=ADMIN_THEEM_JS;?>plugins/bootstrap/bootstrap.min.js"><\/script>')
    </script>
    <script src="<?=ADMIN_THEEM_JS;?>layouts/login1.js"></script>
    <script>
      $(function() {
        Login.init()
      });
    </script>
  </body>
</html>