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
   <style>
     .red{font-size:12px;color: red;padding: 5px;}
     body {
  color: #333333;
  font-family: "Open Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
  font-size: 14px;
  line-height: 17px;
}
   </style> 
  </head>
  <body>
    <div class="container">
    
      <!-- BEGIN SIGNUP SECTION-->
       
      <!-- END SIGNUP SECTION-->
     <!-- BEGIN FORGOT PASSWORD FORM -->
      <form class="form-forgots"  method="post" action="<?php echo base_url()."admin/home/forgotpassword";?>">
       <div class="row">
         <div class="col-sm-12">
          <h2 class="form-heading">Forgot password</h2>
	      <p>Enter your email address to reset your password</p>
            <?php echo form_error('forgotmail', '<div class="col-md-10 red text-center">', '</div>'); ?> 
         </div>   
         <!--<div class="input-prepend input-fullwidth">
          <span class="add-on"><i class="icon-envelope-alt"></i></span>
          <div class="input-wrapper">
            <input type="text" name="md_email" placeholder="Email"/>
          </div>
        </div>  -->
          <div class="col-sm-12">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-envelope"></i>
                          </span>
                          <input type="text" class="form-control" placeholder="Email address" name="forgotmail" id="form-input-email">
                        </div>
                      </div>
            </div>           
        <br />
        <div class="form-actions">
          <a href="<?php echo base_url()."admin"?>"><button class="btn btn-primary btn-back" type="button"><i class="icon-angle-left"></i> Back</button> </a>
         <input type="hidden"  class="btn btn-primary span6" name="form" value="forgetpassword" />
	         <input type="submit"  class="btn btn-success pull-right" name="Submit" value="Send" />
        </div>
        </div>
      </form>
       
      <!-- END FORGOT PASSWORD FORM -->
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