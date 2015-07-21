                    
			<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li>
								<a href="#">Service</a>
							</li>
							<li class="active"><?php echo $title ?></li>
						</ul><!-- /.breadcrumb -->


						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						<!-- #section:settings.box -->
						<!-- /.ace-settings-container -->

						<!-- /section:settings.box -->
						<div class="page-header">
							<h1>
								<?php echo $title ?>
								<small>
								<!--	<i class="ace-icon fa fa-angle-double-right"></i>
									overview &amp; stats -->
								</small>
							</h1>
						</div><!-- /.page-header -->
					
					<div class="widget-box login_box">
									<div class="widget-header widget-header-blue widget-header-flat">
										<h4 class="widget-title lighter">Service Form</h4>

									</div>

									<div class="widget-body">
										<div class="widget-main">
											<!-- #section:plugins/fuelux.wizard -->
											<div id="fuelux-wizard-container">
												<div>
													<!-- /section:plugins/fuelux.wizard.steps -->
												</div>

												<hr />

												<!-- #section:plugins/fuelux.wizard.container -->
												<div class="step-content pos-rel">
													<div class="step-pane active" data-step="1">
														<h3 class="lighter block green"></h3>
               		<?php  if($id == '') { ?>
				<form role="form" name="PageFrom" action="<?php echo base_url()?>admin/service/add"  method="post" class="form-horizontal" id="validation-form">
														<?php } else {  ?>
				 <form role="form"  name="PageFrom" action="<?php echo base_url()?>admin/service/edit"  method="post" class="form-horizontal" id="validation-form"> 
														<?php } ?> 
				
                		 <?php  if(isset($error)) { ?>
						<div class="alert alert-danger"> <?php echo $error  ?></div>
						 <?php } ?>
						<?php if(isset($success)) { ?>
						<div class="alert alert-success"> <?php echo $success  ?></div>
						<?php } ?>
										<input type="hidden" id="id" name="id" value="<?php echo $id ?>" />
														<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="ServiceType">Serive Type</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
				<input type="text" id="name" name="ServiceType"  placeholder="Enter Type" class="col-xs-12 col-sm-6" value="<?php  if(isset($ServiceType)){echo $ServiceType;} ?>" />
																	</div>
																</div>
															</div>

															<div class="space-2"></div>
																							
														</form>
													</div>
								
												</div>

												<!-- /section:plugins/fuelux.wizard.container -->
											</div>

											<hr />
											<div class="wizard-actions">
												<!-- #section:plugins/fuelux.wizard.buttons -->
												<button class="btn btn-success btn-next" id="SubmitNext" data-last="Finish">
												Submit
													<i class="ace-icon fa fa-arrow-right icon-on-right"></i>												</button>

												<!-- /section:plugins/fuelux.wizard.buttons -->
											</div>

											<!-- /section:plugins/fuelux.wizard -->
										</div><!-- /.widget-main -->
									</div><!-- /.widget-body -->
								</div>
					
					
					</div>	<!--page content -->
				</div> <!--main content inner -->
			</div> <!--main content -->
				
<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url()?>js/jquery.js'>"+"<"+"/script>");
</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo base_url()?>js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url()?>js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url()?>js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->
		
		<script type="text/javascript">
			jQuery(function($) {
			
		    $("#SubmitNext").click(function(){
              if(!$('#validation-form').valid()) {e.preventDefault(); }  
             else { $('#validation-form').submit();} 
              })
			  
  				$.mask.definitions['~']='[+-]';
				$('#phone').mask('(999) 999-9999');
			
				jQuery.validator.addMethod("phone", function (value, element) {
					return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
				}, "Enter a valid phone number.");
			
				$('#validation-form').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					ignore: "",
					rules: {
					    ServiceType: {
							required: true
						}
					},
			
					messages: {
					   ServiceType : "Please Enter Service Type",
					  
					},
			
			
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
			
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
						$(e).remove();
					},
			
					errorPlacement: function (error, element) {
						if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
							var controls = element.closest('div[class*="col-"]');
							if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
							else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
						}
						else if(element.is('.select2')) {
							error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
						}
						else if(element.is('.chosen-select')) {
							error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
						}
						else error.insertAfter(element.parent());
					},
			
					submitHandler: function (form) {
					   form.submit();
					},
					invalidHandler: function (form) {
					}
				});
			})
		</script>
