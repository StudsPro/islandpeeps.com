                    
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
								<a href="#">Price</a>
							</li>
							<li>
								<a href="#">One Way Price</a>
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
										<h4 class="widget-title lighter">Add Price Form</h4>

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
				<form role="form" name="PageFrom" action="<?php echo base_url()?>admin/price/add"  method="post" class="form-horizontal" id="validation-form">
				<?php } else { ?>
				<form role="form"  name="PageFrom" action="<?php echo base_url()?>admin/price/edit"  method="post" class="form-horizontal" id="validation-form"> 
				<?php } ?> 
						 
                		 <?php  if(isset($error)) { ?>
						<div class="alert alert-danger"> <?php echo $error  ?></div>
						 <?php } ?>
						<?php if(isset($success)) { ?>
						<div class="alert alert-success"> <?php echo $success  ?></div>
						<?php } ?>
						<input type="hidden" id="id" name="id" value="<?php echo $id ?>" />
						
						<?php if($this->uri->segment(2) == 'addoneway') { $PackageType = 1; $showsoruce='';} else {  $PackageType = 2; $showsoruce=1;}?>
						 <input type="hidden" id="PackageType" name="PackageType" value="<?php echo $PackageType ?>" /> 
							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Source">Source</label>
									<div class="col-xs-12 col-sm-9">
										<select id="Source" name="Source" class="select2" data-placeholder="Source Dropdown">
											<option value="">&nbsp;</option>
													 <?php    if(!empty($Source))
    	     										   { 
													   foreach($Source as $key => $val)
    	        									   { ?>
											             <option value="<?php echo $Source[$key]['country_id'];?>" <?php
                                                         if(isset($Source1)) 
                                                          {
                                                                if($Source[$key]['country_id'] == $Source1) 
                                                                 {
                                                                    echo'selected="selected"';
                                                                 
                                                                 }
                                                            
                                                          }
                                                          
                                                         
                                                         ?>><?php echo $Source[$key]['country_code']; ?></option>
											<?php      } 
											} ?>								
										</select>
									</div>
							</div>
								<div class="space-2"></div>
                                <?php
                               if(!isset($showsoruce) && $showsoruce!=1)
                                {?>
                                  <div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Destination">Destination</label>
									<div class="col-xs-12 col-sm-9">
										<select id="Destination" name="Destination" class="select2" data-placeholder="Destination Dropdown">
											<option value="">&nbsp;</option>
													 <?php    if(!empty($ServiceList))
    	     										   { 
													   foreach($Destination as $key => $val)
    	        									   { ?>
											<option value="<?php echo $Destination[$key]['country_id'];?>" 
                                            <?php 
                                               if(isset($Destination1))
                                                  {if($Destination[$key]['country_id'] == $Destination1) 
                                                      { echo'selected="selected"';}
                                                  }
                                                 ?>>
                                            
                                            <?php echo $Destination[$key]['country_code']; ?></option>
											<?php  } 
											} ?>								
										</select>
									</div>
							</div>
								<div class="space-2"></div>	
                                 <?php 
                                }
                                
                                ?>
												
									<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="ServiceList">Service List</label>
									<div class="col-xs-12 col-sm-9">
								<select id="ServiceList" name="ServiceList" class="select2" data-placeholder="Service Type Dropdown">
											<option value="">&nbsp;</option>
													 <?php    if(!empty($ServiceList))
    	     										   { 
													   foreach($ServiceList as $key => $val)
    	        									   { ?>
	<option value="<?php echo $ServiceList[$key]['service_id'];?>" <?php if(isset($ServiceList1)){if( $ServiceList[$key]['service_id'] == $ServiceList1) { echo'selected="selected"';} }?>><?php echo $ServiceList[$key]['service_type']; ?></option>
											<?php  } 
											} ?>								
										</select>
									</div>
							</div>
								<div class="space-2"></div>
								<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="VehicleList">Vehicle List</label>
									<div class="col-xs-12 col-sm-9">
										<select id="VehicleList" name="VehicleList" class="select2" data-placeholder="Vehcile Dropdown">
											<option value="">&nbsp;</option>
													 <?php    if(!empty($VehicleList))
    	     										   { 
													   foreach($VehicleList as $key => $val)
    	        									   { 
													   ?>
											<option value="<?php echo $VehicleList[$key]['vehicle_id'];?>" <?php  if(isset($VehicleList1)){if( $VehicleList[$key]['vehicle_id'] == $VehicleList1) { echo'selected="selected"';}}?>><?php echo $VehicleList[$key]['vehicle_name']; ?></option>
											<?php  } 
											} ?>								
										</select>
									</div>
							</div>
								<div class="space-2"></div>
							
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Price">Price</label>
												
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
				<input type="text" id="name" name="Price"  placeholder="Enter Price" class="col-xs-12 col-sm-6" value="<?php if(isset($Cost)){echo $Cost;}  ?>" />
																	</div>
																</div>
															</div>

															<div class="space-2"></div>
															
														<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Surcharged">Surcharged</label>
														<div class="col-xs-12 col-sm-9">
														<div class="radio">
														<label class="small_padding_left">
			<input  type="radio" class="ace" id="Fixed" name="Surcharged" value="Fixed" <?php if(isset($Surcharged))  {if($Surcharged=='Fixed') {echo'checked="checked"';}} ?>/>
															<span class="lbl">Fixed</span>
														</label>
														<label>
			<input  type="radio" class="ace" id="Perctange" name="Surcharged" value="Percentage" <?php  if(isset($Surcharged)){if($Surcharged=='Percentage') {echo'checked="checked"';}} ?>/>
															<span class="lbl">Percentage</span>
														</label>
															</div>
														</div>
													</div>
												<div class="clear"></div>
												<div class="give_bottom_margin"></div>

															<div class="form-group">
				<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="SurchargedPrice">Surcharged Price:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
			<input type="text" name="SurchargedPrice" id="name" class="col-xs-12 col-sm-6" placeholder="Enter Surcharged"  value="<?php if(isset($SurchargedPrice)){echo $SurchargedPrice;} ?>" />
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
			
			
			$(".select2").css('width','368px').select2({allowClear:true})
				.on('change', function(){
					$(this).closest('form').validate().element($(this));
				}); 
				
				
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
						Source: {
							required: true
						},
                        Destination: {
							required: true
						},
					    ServiceList: {
							required: true
						},
                        VehicleList: {
							required: true
						},
						Price: {
							required: true
						},
						Surcharged: {
							required: true
						},
						SurchargedPrice: {
							required: true
						}
					},
			
					messages: {
					   Source : "Please Select Source",
					   Destination : "Please Select Destination",	
					   ServiceList : "Please Select Service Type",
					   VehicleList : "Please Select Vehicle ",
					   Price : "Please Enter A Price ",
		  	           Surcharged: "Please Select One Option",
						SurchargedPrice: "Please Enter Surchaged Amount."
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
				
				$(document).one('ajaxloadstart.page', function(e) {
					//in ajax mode, remove remaining elements before leaving page
					$('[class*=select2]').remove();
				});
			})
		</script>
