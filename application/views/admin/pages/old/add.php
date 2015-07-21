<div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-title"><?=$page_action;?> <?=$page_title;?></h3>
              <ul class="breadcrumb breadcrumb-arrows breadcrumb-default">
                <li><a href="<?=SITE_ADMIN_URL;?>"><i class="fa fa-home fa-lg"></i></a></li>
				 <li><a href="<?=SITE_ADMIN_URL;?>pages">Modify Pages</a></li>
                <li><a href="#ignore"><?=$page_action;?></a></li>
               </ul>
            </div>
          </div>
        </div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			 <div class="panel panel-default">
			 	<form id="advanced-form" class="form-horizontal">
					<div class="panel-body">
						<fieldset>
							<div class="form-group">
								<label for="title" class="col-md-2 control-label">Page Title</label>
								<div class="col-md-10">
								  <input id="page_title" name="page_title" type="text" placeholder="page title" class="form-control input-md" 
								  value="<?php if(isset($results['page_title']))
								  				{echo $results['page_title'];}?>">
								</div>
						  	</div>
							<div class="form-group">
								<label for="title" class="col-md-2 control-label">Content</label>
								<div class="col-md-10">
									<?php
									if($id==4)
										{
										?>
										<textarea    name="detailed_description" class="form-control input-md">
										<?php if(isset($results['detailed_description'])){echo html_entity_decode($results['detailed_description']);}?>
										</textarea>
										
										 
										<?php
										}
										  else
										{
										?>
								
										<textarea  id="ckeditor" name="detailed_description" class="form-control input-md">
										<?php if(isset($results['detailed_description'])){echo html_entity_decode($results['detailed_description']);}?>
										</textarea>
										<?php			 
										 }		
										?>
								</div>
						  	</div>
						</fieldset>
					</div>
					<div class="panel-footer">
						<div class="form-group">
						  <div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-primary">Submit</button>
						  </div>
						</div>
                  </div>
				</form>
			 </div>
		</div>
	</div>
</div>		

<script src="<?=ADMIN_THEEM_JS?>plugins/wysihtml5/wysihtml5-0.3.0.min.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/ckeditor/ckeditor.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/marked/marked.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/to-markdown/to-markdown.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>plugins/bootstrap-markdown/bootstrap-markdown.js"></script>
    <script src="<?=ADMIN_THEEM_JS?>demo/ui-elements.js"></script>
    <script>
      $(function() {
        UIElements.initWYSIWYGEditors();
        var isRTL = $("html").attr("dir") === "rtl" ? "rtl" : "ltr";
        CKEDITOR.replace('ckeditor', {
          contentsLangDirection: isRTL
        });
      });
    </script>
