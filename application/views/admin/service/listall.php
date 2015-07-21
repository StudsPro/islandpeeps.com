                    
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
							<li class="active">Add Service</li>
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
							<h1 class="only_float_left">
								List Of All Service
								<small>
								<!--	<i class="ace-icon fa fa-angle-double-right"></i>
									overview &amp; stats -->
								</small>
							</h1>
							<a href="<?php echo base_url()?>admin/service"><button class="btn btn-info only_float_right">Add Service</button></a>
							<div class="clear"></div>
						</div><!-- /.page-header -->
					
																		
					 <?php 
					
					 if(isset($error)) { ?>
					<div class="alert alert-danger"> <?php echo $error  ?></div>
					 <?php	} ?>
					  <?php
					  //$success = $this->session->flashdata('item'); 
					  if($this->session->flashdata('item')) { ?>
					  <div class="alert alert-success"> <?php echo $this->session->flashdata('item')  ?></div>
					 <?php } ?>
					
					<div class="col-xs-12">
										
										<div class="table-header">
											Latest <?php echo $title; ?>
										</div>

										<!-- <div class="table-responsive"> -->

										<!-- <div class="dataTables_borderWrap"> -->
										<div>
											<table id="sample-table-2" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">
															<label class="position-relative">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</th>
														<th>Service Type</th>
														<th>
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															Action
														</th>
																											</tr>
												</thead>

												<tbody>
												 <?php 
               										 
           										 	 if(!empty($results))
    	     										   {
    		  										      foreach($results as $key => $val)
    	        									   {
    		          									
														?>
													<tr>
														<td class="center">
															<label class="position-relative">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</td>

														<td><?php echo $results[$key]['service_type']; ?></td>
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
																<a class="green" href="<?php echo base_url()."admin/service/edit12/".$results[$key]['service_id'];?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

																<a class="red" href="<?php echo base_url()."admin/service/delete/".$results[$key]['service_id'];?>">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
															</div>
														</td>
													</tr>

													  <?php        
            										        	} 
	       													}	
		 												 ?>	 
												</tbody>
											</table>
										</div>
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
		
		<script src="<?php echo base_url()?>js/jquery.dataTables.js"></script>
		<script src="<?php echo base_url()?>js/jquery.dataTables.bootstrap.js"></script>
		
		
		<script type="text/javascript">
			jQuery(function($) {
				var oTable1 = 
				$('#sample-table-2')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.dataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, 
					  { "bSortable": false }
					],
					"aaSorting": [],
			
					//,
					//"sScrollY": "200px",
					//"bPaginate": false,
			
					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
			    } );
				/**
				var tableTools = new $.fn.dataTable.TableTools( oTable1, {
					"sSwfPath": "../../copy_csv_xls_pdf.swf",
			        "buttons": [
			            "copy",
			            "csv",
			            "xls",
						"pdf",
			            "print"
			        ]
			    } );
			    $( tableTools.fnContainer() ).insertBefore('#sample-table-2');
				*/
				
				
				//oTable1.fnAdjustColumnSizing();
			
			
				$(document).on('click', 'th input:checkbox' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
				});
			
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			})
		</script>
