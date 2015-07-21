<div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-title"><?=$page_title;?></h3>
             <!-- <ul class="breadcrumb breadcrumb-arrows breadcrumb-default">
                <li><a href="<?=SITE_ADMIN_URL;?>"><i class="fa fa-home fa-lg"></i></a></li>
				 <li><a href="<?=SITE_ADMIN_URL;?>memelist">Me Me</a></li>
                <li><a href="#ignore"><?=$page_action;?></a></li>
               </ul> -->
               <?php echo $breadcrumds;?>
            </div>
          </div>
        </div>
<div class="container">
<?php 
					 if($this->session->flashdata('error')) 
                     { ?> <div class="alert alert-danger"> <?php echo $this->session->flashdata('error');  ?></div><?php	} 
					  //$success = $this->session->flashdata('item'); 
					  if($this->session->flashdata('sucess')) { ?>
					  <div class="alert alert-success"> <?php echo $this->session->flashdata('sucess')  ?></div>
					 <?php } ?>
	<div class="row">
		<div class="col-md-12">
			 <div class="panel panel-default">
			 	<!--<form id="advanced-form" class="form-horizontal"> -->
               
				
                    <div class="panel-heading">
                          <h3 class="panel-title"> <?php echo $id >0 ? "Edit" : "Add"; ?> Social Feed Settings</h3>
                        </div>
					 <?php
                            $getclass="class='form-control input-md'";
                          $hidden = array("id"=>$id);
                          $fromurl= $id >0 ? "admin/profile/socialfeeds/".$id : "admin/profile/socialfeeds";
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form' ,'id' => 'advanced-form');
                         echo form_open_multipart($fromurl, $attributes, $hidden);
                        ?>
                      
                  
                  
                  <script src="<?=ADMIN_THEEM_JS?>jquery-ui/jquery-ui.min.js"><\/script>
    <script>
      $(function() {
        UIElements.initjQueryUIExamples();
      });
    </script>
    
     <link href="<?=ADMIN_THEEM_CSS;?>socialfeed.css" rel="stylesheet">
  <div class="panel-body">  
 <div class="tabbable tabs-left" id="tabs">
              <div class="col-md-2">
                 <ul class="nav nav-tabs nav-tabs-default nav-tabs-advanced nav-stacked nav-tabs-orange">
                  <li class="active"><a href="#gen" data-toggle="tab"> General </a></li>
                  <li><a href="#twi" data-toggle="tab"> Twitter</a></li>
                  <li><a href="#rss" data-toggle="tab"> RSS</a></li>
                  <li><a href="#fbt" data-toggle="tab"> Facebook</a></li>
                  <li><a href="#goo" data-toggle="tab"> Google</a></li>
                  <li><a href="#ins" data-toggle="tab"> Instagram</a></li>
                  <li><a href="#dus" data-toggle="tab"> Delicious</a></li>
                  <li><a href="#vimo" data-toggle="tab"> Vimeo</a></li>
                  <li><a href="#yout" data-toggle="tab"> Youtube</a></li>
                  <li><a href="#pintr" data-toggle="tab"> Pinterest</a></li>
                  <li><a href="#filc" data-toggle="tab"> Flickr</a></li>
                  <li><a href="#drib" data-toggle="tab"> Dribbble</a></li>
                  <li><a href="#tumb" data-toggle="tab"> Tumblr</a></li>
                  <li><a href="#stun" data-toggle="tab"> Stumbleupon</a></li>
                  <li><a href="#lfm" data-toggle="tab"> Lastfm</a></li>
                  <li><a href="#devi" data-toggle="tab"> Deviantart</a></li>
                </ul>
              </div>  
             <div class="col-md-10" >   
                <div class="tab-content">
                  <div class="tab-pane active" id="gen">
                    <p><strong>General</strong></p>
                     <div class="form-group">
		      <label class="col-md-3 control-label">Limits</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="db_limits" id="db__limits" value="<?php echo $limits;?>"/>
		         
		      </div>
		   </div> 
	 	   <div class="form-group">
		      <label class="col-md-3 control-label">Days</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="db_days" id="db__days" value="<?php echo $days;?>"/>
		         
		      </div>
		   </div>  
	 	   <div class="form-group">
		      <label class="col-md-3 control-label">Max</label>
		      <div class="col-md-5">
			<select class='form-control input-md'  name="db_fmax">
			 <option value="days" <?php if($fmax=='days') echo 'selected';?>>Days</option> 
			 <option value="limit" <?php if($fmax=='limit') echo 'selected';?>>Limit</option>
			</select>
		         
		      </div>
		   </div>  
	 	   <div class="form-group">
		      <label class="col-md-3 control-label">Speed</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="db_speed" id="db__speed" value="<?php echo $speed;?>"/>
		         
		      </div>
		   </div>  
	 	   <div class="form-group">
		      <label class="col-md-3 control-label">Order by</label>
		      <div class="col-md-5">
	 		<select class='form-control input-md'  name="db_forder">
			 <option value="date" <?php if($forder=='date') echo 'selected';?>>Date</option> 
			 <option value="random" <?php if($forder=='random') echo 'selected';?>>Random</option>
			</select>                 
		      </div>
		   </div>  
	 	   <div class="form-group">
		      <label class="col-md-3 control-label">Filter</label>
		      <div class="col-md-5">
	 
			<select class='form-control input-md'  name="db_filter">
			 <option value="true" <?php if($filter=='true') echo 'selected';?>>True</option> 
			 <option value="false" <?php if($filter=='false') echo 'selected';?>>False</option>
			</select>  
		         
		      </div>
		   </div>  
	 	   <div class="form-group">
		      <label class="col-md-3 control-label">Rotate Direction</label>
		      <div class="col-md-5">
		 
			<select class='form-control input-md'  name="db_rotate_direction">
			 <option value="up" <?php if($rotate_direction=='up') echo 'selected';?>>Up</option> 
			 <option value="down" <?php if($rotate_direction=='down') echo 'selected';?>>Down</option>
			</select> 
		         
		      </div>
		   </div>  
	 	   <div class="form-group">
		      <label class="col-md-3 control-label">Rotate Delay</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="db_rotate_delay" id="db__rotate_delay" value="<?php echo $rotate_delay;?>"/>
		         
		      </div>
		   </div>  
                  </div>
<?php 

$twitter = json_decode($twitter);

$rss = json_decode($rss);
$facebook = json_decode($facebook);
$google = json_decode($google);
$instagram = json_decode($instagram);
$delicious = json_decode($delicious);
$vimeo = json_decode($vimeo);
$youtube = json_decode($youtube);
$pinterest = json_decode($pinterest);
$flickr = json_decode($flickr);
$dribbble = json_decode($dribbble);
$tumblr = json_decode($tumblr);
$stumbleupon = json_decode($stumbleupon);
$lastfm = json_decode($lastfm);
$deviantart = json_decode($deviantart);
 
 

?>
                  <div class="tab-pane" id="twi">
                    <p><strong>Twitter</strong></p>
                   	   <div class="form-group">
			      <label class="col-md-3 control-label">Twitter ID</label>
			      <div class="col-md-5">
				<input type="text" class="form-control input-md" name="twitter[twitterid]" id="db__twitter" value="<?php echo $twitter->twitterid;?>"/>
				 
			      </div>
			   </div>  

         <div class="form-group">
            <label class="col-md-3 control-label">Stream item output</label>  
            <div class="col-md-5">
        <label class="checkbox">
         <input type="checkbox"   name="twitter[out][]" <?php if(!empty($twitter->out)){ if(in_array('intro',$twitter->out)) { echo 'checked';} }?> id="db__tout" value="intro"/>intro
              
              </label>
       
        <label class="checkbox">
        <input type="checkbox"   name="twitter[out][]" <?php if(!empty($twitter->out)){ if(in_array('thumb',$twitter->out)) { echo 'checked';} }?> id="db__tout" value="thumb"/>thumb
              
              </label>
        <label class="checkbox">
        <input type="checkbox"   name="twitter[out][]" <?php if(!empty($twitter->out)){ if(in_array('text',$twitter->out)) { echo 'checked';} }?> id="db__tout" value="text"/>text
              
              </label>
        <label class="checkbox">
        <input type="checkbox"   name="twitter[out][]" <?php if(!empty($twitter->out)){ if(in_array('share',$twitter->out)) { echo 'checked';} }?> id="db__tout" value="share"/>share
              
              </label>
    
            </div>
         </div>  


		 	   <div class="form-group">
			      <label class="col-md-3 control-label">Show Retweets</label>
			      <div class="col-md-5">
		 
				<select class='form-control input-md'  name="twitter[retweets]">
				 <option value="true" <?php if($twitter->retweets=='true') echo 'selected';?>>True</option> 
				 <option value="false" <?php if($twitter->retweets=='false') echo 'selected';?>>False</option>
				</select>  
				 
			      </div>
			   </div> 
		 	   <div class="form-group">
			      <label class="col-md-3 control-label">Show Replies</label>
			      <div class="col-md-5">
		 
				<select class='form-control input-md'  name="twitter[replies]">
				 <option value="true" <?php if($twitter->replies =='true') echo 'selected';?>>True</option> 
				 <option value="false" <?php if($twitter->replies =='false') echo 'selected';?>>False</option>
				</select>  
				 
			      </div>
			   </div> 

			   
                  </div>
                  <div class="tab-pane" id="rss">
                    <p><strong>RSS </strong></p>
                   <div class="form-group">
		      <label class="col-md-3 control-label">RSS URL</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="rss[rssid]" id="db__rss" value="<?php echo $rss->rssid;?>"/>
		        </div> 
		      </div>

 			   <div class="form-group">
			      <label class="col-md-3 control-label">Stream item output</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="rss[out][]" <?php if(in_array('intro',$rss->out)) { echo 'checked';}?> id="db__tout" value="intro"/>intro
						  
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="rss[out][]" <?php if(in_array('title',$rss->out)) { echo 'checked';}?> id="db__tout" value="title"/>title
						  
			        </label>
				
				<label class="checkbox">
				<input type="checkbox"   name="rss[out][]" <?php if(in_array('text',$rss->out)) { echo 'checked';}?> id="db__tout" value="text"/>text
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="rss[out][]" <?php if(in_array('share',$rss->out)) { echo 'checked';}?> id="db__tout" value="share"/>share
						  
			        </label>
		
			      </div>
			   </div>  

		 	   <div class="form-group">
			      <label class="col-md-3 control-label">Show text</label>
			      <div class="col-md-5">
		 
				<select class='form-control input-md'  name="rss[text]">
				 <option value="content" <?php if($rss->text=='content') echo 'selected';?>>content</option> 
				 <option value="contentSnippet" <?php if($rss->text=='contentSnippet') echo 'selected';?>>contentSnippet</option>
				</select>  
				 
			      </div>
			   </div> 

		   </div>  
                  <div class="tab-pane" id="fbt">
                    <p><strong>Facebook</strong></p>
		   <div class="form-group">
		      <label class="col-md-3 control-label">Facebook</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="facebook[fbid]" id="db__facebook" value="<?php echo $facebook->fbid;?>"/>
		         
		      </div>
		   </div>  

 			   <div class="form-group">
			      <label class="col-md-3 control-label">Stream item output</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="facebook[out][]" <?php if(in_array('intro',$facebook->out)) { echo 'checked';}?> id="db__tout" value="intro"/>intro
						  
			        </label>
              <label class="checkbox">
         <input type="checkbox"   name="facebook[out][]" <?php if(in_array('thumb',$facebook->out)) { echo 'checked';}?> id="db__tout" value="thumb"/>thumb
              
              </label>
				<label class="checkbox">
				 <input type="checkbox"   name="facebook[out][]" <?php if(in_array('title',$facebook->out)) { echo 'checked';}?> id="db__tout" value="title"/>title
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="facebook[out][]" <?php if(in_array('user',$facebook->out)) { echo 'checked';}?> id="db__tout" value="user"/>user
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="facebook[out][]" <?php if(in_array('text',$facebook->out)) { echo 'checked';}?> id="db__tout" value="text"/>text
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="facebook[out][]" <?php if(in_array('share',$facebook->out)) { echo 'checked';}?> id="db__tout" value="share"/>share
						  
			        </label>
		
			      </div>
			   </div>  
 			<div class="form-group">
			    <label class="col-md-3 control-label">Show text</label>
			   <div class="col-md-5">
		 
		           <select class='form-control input-md'  name="facebook[text]">
			 <option value="content" <?php if($facebook->text=='content') echo 'selected';?>>content</option> 
			 <option value="contentSnippet" <?php if($facebook->text=='contentSnippet') echo 'selected';?>>contentSnippet</option>
				</select>  
				 
			      </div>
			   </div> 
                  <div class="form-group">
		      <label class="col-md-3 control-label">Comments <br/>(maximum number of comments to display for facebook page.maximum value = 25 )</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="facebook[comments]" id="db_comments" value="<?php echo $facebook->comments;?>"/>
		         
		      </div>
		   </div> 

          <div class="form-group">
          <label class="col-md-3 control-label">Image Width</label>
          <div class="col-md-5">
          <select class='form-control input-md'  name="facebook[image_width]">
               <option value="3" <?php if($facebook->image_width =='3') echo 'selected';?>>600</option> 
               <option value="4" <?php if($facebook->image_width =='4') echo 'selected';?>>480</option>
               <option value="5" <?php if($facebook->image_width =='5') echo 'selected';?>>320</option>
               <option value="6" <?php if($facebook->image_width =='6') echo 'selected';?>>180</option>
            </select> 
             
          </div>
       </div>  




                  </div>
                  <div class="tab-pane" id="goo">
                    <p><strong>Google</strong></p>
                     <div class="form-group">
		      <label class="col-md-3 control-label">Google</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="google[googleid]" id="db__google" value="<?php echo $google->googleid;?>"/>
		         
		      </div>
		   </div>  
                         <div class="form-group">
			      <label class="col-md-3 control-label">Stream item output</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="google[out][]" <?php if(in_array('intro',$google->out)) { echo 'checked';}?> id="db__tout" value="intro"/>intro
						  
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="google[out][]" <?php if(in_array('title',$google->out)) { echo 'checked';}?> id="db__tout" value="title"/>title
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="google[out][]" <?php if(in_array('thumb',$google->out)) { echo 'checked';}?> id="db__tout" value="thumb"/>thumb
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="google[out][]" <?php if(in_array('text',$google->out)) { echo 'checked';}?> id="db__tout" value="text"/>text
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="google[out][]" <?php if(in_array('share',$google->out)) { echo 'checked';}?> id="db__tout" value="share"/>share
						  
			        </label>
		
			      </div>
			   </div>

		     <div class="form-group">
		      <label class="col-md-3 control-label">Google API key</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="google[apikey]" id="db__apikey" value="<?php echo $google->apikey;?>"/>
		         
		      </div>

		   </div>  
 			<div class="form-group">
			      <label class="col-md-3 control-label">Show Shares</label>
			      <div class="col-md-5">
		 
				<select class='form-control input-md'  name="google[shares]">
				 <option value="true" <?php if($google->shares=='true') echo 'selected';?>>True</option> 
				 <option value="false" <?php if($google->shares=='false') echo 'selected';?>>False</option>
				</select>  
				 
			      </div>
			   </div> 
                  </div>
                  <div class="tab-pane" id="ins">
                    <p><strong>Instagram</strong></p>
                     <div class="form-group">
		      <label class="col-md-3 control-label">Instagram ID</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="instagram[instagramid]" id="db__instagram" value="<?php echo $instagram->instagramid;?>"/>
		         
		      </div>
		   </div>  
                         <div class="form-group">
			      <label class="col-md-3 control-label">Stream item output</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="instagram[out][]" <?php if(in_array('intro',$instagram->out)) { echo 'checked';}?> id="db__tout" value="intro"/>intro
						  
			        </label>
				
				<label class="checkbox">
				<input type="checkbox"   name="instagram[out][]" <?php if(in_array('thumb',$instagram->out)) { echo 'checked';}?> id="db__tout" value="thumb"/>thumb
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="instagram[out][]" <?php if(in_array('meta',$instagram->out)) { echo 'checked';}?> id="db__tout" value="meta"/>meta
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="instagram[out][]" <?php if(in_array('user',$instagram->out)) { echo 'checked';}?> id="db__tout" value="user"/>user
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="instagram[out][]" <?php if(in_array('text',$instagram->out)) { echo 'checked';}?> id="db__tout" value="text"/>text
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="instagram[out][]" <?php if(in_array('share',$instagram->out)) { echo 'checked';}?> id="db__tout" value="share"/>share
						  
			        </label>
		
			      </div>
			   </div>

		     <div class="form-group">
		      <label class="col-md-3 control-label">Access Token</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="instagram[accessToken]" id="db__accessToken" value="<?php echo $instagram->accessToken;?>"/>
		         
		      </div>

		   </div>  
 		 <div class="form-group">
		      <label class="col-md-3 control-label">Client ID</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="instagram[clientId]" id="db__clientId" value="<?php echo $instagram->clientId;?>"/>
		         
		      </div>

		   </div> 
		 <div class="form-group">
		      <label class="col-md-3 control-label">Comments <br/>(maximum number of comments to display)</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="instagram[comments]" id="db__comments" value="<?php echo $instagram->comments;?>"/>
		         
		      </div>
		   </div>  

 		<div class="form-group">
		      <label class="col-md-3 control-label">Like  <br/>(maximum number of Like to display)</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="instagram[like]" id="db__like" value="<?php echo $instagram->like;?>"/>
		         
		      </div>

		   </div> 	 
                  </div>
                  <div class="tab-pane" id="dus">
                    <p><strong>Delicious</strong></p>
                     <div class="form-group">
		      <label class="col-md-3 control-label">Delicious</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="delicious[deliciousid]" id="db__delicious" value="<?php echo $delicious->deliciousid;?>"/>
		         
		      </div>
		   </div>  
                         <div class="form-group">
			      <label class="col-md-3 control-label">Stream item output</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="delicious[out][]" <?php if(in_array('intro',$delicious->out)) { echo 'checked';}?> id="db__tout" value="intro"/>intro
						  
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="delicious[out][]" <?php if(in_array('title',$delicious->out)) { echo 'checked';}?> id="db__tout" value="title"/>title
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="delicious[out][]" <?php if(in_array('thumb',$delicious->out)) { echo 'checked';}?> id="db__tout" value="thumb"/>thumb
				</label>
				<label class="checkbox">
				<input type="checkbox"   name="delicious[out][]" <?php if(in_array('user',$delicious->out)) { echo 'checked';}?> id="db__tout" value="user"/>user
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="delicious[out][]" <?php if(in_array('text',$delicious->out)) { echo 'checked';}?> id="db__tout" value="text"/>text
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="delicious[out][]" <?php if(in_array('share',$delicious->out)) { echo 'checked';}?> id="db__tout" value="share"/>share
						  
			        </label>
		
			      </div>
			   </div>

                  </div>
                  <div class="tab-pane" id="vimo">
                    <p><strong>Vimeo</strong></p>
                     <div class="form-group">
		      <label class="col-md-3 control-label">Vimeo</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="vimeo[vimeoid]" id="db__vimeo" value="<?php echo $vimeo->vimeoid;?>"/>
		         
		      </div>
		   </div>  
		     <div class="form-group">
			      <label class="col-md-3 control-label">Feed item</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="vimeo[feed][]" <?php if(in_array('likes',$vimeo->feed)) { echo 'checked';}?> id="db__feed" value="likes"/>likes 	 
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="vimeo[feed][]" <?php if(in_array('videos',$vimeo->feed)) { echo 'checked';}?> id="db__feed" value="videos"/>videos
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="vimeo[feed][]" <?php if(in_array('appears_in',$vimeo->feed)) { echo 'checked';}?> id="db__feed" value="appears_in"/>Appeared In
				</label>
				<label class="checkbox">
				<input type="checkbox"   name="vimeo[feed][]" <?php if(in_array('all_videos',$vimeo->feed)) { echo 'checked';}?> id="db__feed" value="all_videos"/>all videos
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="vimeo[feed][]" <?php if(in_array('albums',$vimeo->feed)) { echo 'checked';}?> id="db__feed" value="albums"/>albums
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="vimeo[feed][]" <?php if(in_array('channels',$vimeo->feed)) { echo 'checked';}?> id="db__feed" value="channels"/>channels
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="vimeo[feed][]" <?php if(in_array('groups',$vimeo->feed)) { echo 'checked';}?> id="db__feed" value="groups"/>groups
						  
			        </label>
		
			      </div>
			   </div>
			 <div class="form-group">
			      <label class="col-md-3 control-label">Stream item output</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="vimeo[out][]" <?php if(in_array('intro',$vimeo->out)) { echo 'checked';}?> id="db__tout" value="intro"/>intro
						  
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="vimeo[out][]" <?php if(in_array('title',$vimeo->out)) { echo 'checked';}?> id="db__tout" value="title"/>title
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="vimeo[out][]" <?php if(in_array('thumb',$vimeo->out)) { echo 'checked';}?> id="db__tout" value="thumb"/>thumb
				</label>
				<label class="checkbox">
				<input type="checkbox"   name="vimeo[out][]" <?php if(in_array('user',$vimeo->out)) { echo 'checked';}?> id="db__tout" value="user"/>user
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="vimeo[out][]" <?php if(in_array('text',$vimeo->out)) { echo 'checked';}?> id="db__tout" value="text"/>text
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="vimeo[out][]" <?php if(in_array('share',$vimeo->out)) { echo 'checked';}?> id="db__tout" value="share"/>share
						  
			        </label>
		
			      </div>
			   </div>

                  </div>
                  <div class="tab-pane" id="yout">
                    <p><strong>Youtube</strong></p>
                     <div class="form-group">
		      <label class="col-md-3 control-label">Youtube</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="youtube[youtubeid]" id="db__youtube" value="<?php echo $youtube->youtubeid;?>"/>
		         
		      </div>
		   </div>  
                    <div class="form-group">
			      <label class="col-md-3 control-label">Feed item</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="youtube[feed][]" <?php if(in_array('uploads',$youtube->feed)) { echo 'checked';}?> id="db__feed" value="uploads"/> Uploads 	 
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="youtube[feed][]" <?php if(in_array('favorites',$youtube->feed)) { echo 'checked';}?> id="db__feed" value="favorites"/> Favorites
						  
			        </label>
		 
				<label class="checkbox">
				<input type="checkbox"   name="youtube[feed][]" <?php if(in_array('newsubscriptionvideos',$youtube->feed)) { echo 'checked';}?> id="db__feed" value="newsubscriptionvideos"/>New subscription videos
						  
			        </label>
				 
		
			      </div>
			   </div>
			 <div class="form-group">
			      <label class="col-md-3 control-label">Stream item output</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="youtube[out][]" <?php if(in_array('intro',$youtube->out)) { echo 'checked';}?> id="db__tout" value="intro"/>intro
						  
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="youtube[out][]" <?php if(in_array('title',$youtube->out)) { echo 'checked';}?> id="db__tout" value="title"/>title
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="youtube[out][]" <?php if(in_array('thumb',$youtube->out)) { echo 'checked';}?> id="db__tout" value="thumb"/>thumb
				</label>
				<label class="checkbox">
				<input type="checkbox"   name="youtube[out][]" <?php if(in_array('text',$youtube->out)) { echo 'checked';}?> id="db__tout" value="text"/>text
				</label>
        <label class="checkbox">
        <input type="checkbox"   name="youtube[out][]" <?php if(in_array('user',$youtube->out)) { echo 'checked';}?> id="db__tout" value="user"/>user
        </label>

				<label class="checkbox">
				<input type="checkbox"   name="youtube[out][]" <?php if(in_array('share',$youtube->out)) { echo 'checked';}?> id="db__tout" value="share"/>share
						  
			        </label>
		
			      </div>
			   </div>
                </div>
                  <div class="tab-pane" id="pintr">
                    <p><strong>Pinterest</strong></p>
                     <div class="form-group">
		       <label class="col-md-3 control-label">Pinterest</label>
		       <div class="col-md-5">
			 <input type="text" class="form-control input-md" name="pinterest[pinterestid]" id="db__pinterest" value="<?php echo $pinterest->pinterestid;?>"/>
		         
		       </div>
		     </div>  
			 <div class="form-group">
			      <label class="col-md-3 control-label">Stream item output</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="pinterest[out][]" <?php if(in_array('intro',$pinterest->out)) { echo 'checked';}?> id="db__tout" value="intro"/>intro
						  
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="pinterest[out][]" <?php if(in_array('title',$pinterest->out)) { echo 'checked';}?> id="db__tout" value="title"/>title
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="pinterest[out][]" <?php if(in_array('thumb',$pinterest->out)) { echo 'checked';}?> id="db__tout" value="thumb"/>thumb
				</label>
				<label class="checkbox">
				<input type="checkbox"   name="pinterest[out][]" <?php if(in_array('user',$pinterest->out)) { echo 'checked';}?> id="db__tout" value="user"/>user
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="pinterest[out][]" <?php if(in_array('text',$pinterest->out)) { echo 'checked';}?> id="db__tout" value="text"/>text
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="pinterest[out][]" <?php if(in_array('share',$pinterest->out)) { echo 'checked';}?> id="db__tout" value="share"/>share
						  
			        </label>
		
			      </div>
			   </div>


                  </div>
                  <div class="tab-pane" id="filc">
                    <p><strong>Flickr</strong></p>
                     <div class="form-group">
		      <label class="col-md-3 control-label">Flickr</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="flickr[flickrid]" id="db__flickr" value="<?php echo $flickr->flickrid;?>"/>
		         
		      </div>
		   </div> 
			 <div class="form-group">
			      <label class="col-md-3 control-label">Stream item output</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="flickr[out][]" <?php if(in_array('intro',$flickr->out)) { echo 'checked';}?> id="db__tout" value="intro"/>intro
						  
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="flickr[out][]" <?php if(in_array('title',$flickr->out)) { echo 'checked';}?> id="db__tout" value="title"/>title
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="flickr[out][]" <?php if(in_array('thumb',$flickr->out)) { echo 'checked';}?> id="db__tout" value="thumb"/>thumb
				</label>
			
				<label class="checkbox">
				<input type="checkbox"   name="flickr[out][]" <?php if(in_array('text',$flickr->out)) { echo 'checked';}?> id="db__tout" value="text"/>text
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="flickr[out][]" <?php if(in_array('share',$flickr->out)) { echo 'checked';}?> id="db__tout" value="share"/>share
						  
			        </label>
		
			      </div>
			   </div>
 
                  </div>
                  <div class="tab-pane" id="drib">
                    <p><strong>Dribbble</strong></p>
                     <div class="form-group">
		      <label class="col-md-3 control-label">Dribbble</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="dribbble[dribbbleid]" id="db__dribbble" value="<?php echo $dribbble->dribbbleid;?>"/>
		         
		      </div>
		   </div> 
			 <div class="form-group">
			      <label class="col-md-3 control-label">Stream item output</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="dribbble[out][]" <?php if(in_array('intro',$dribbble->out)) { echo 'checked';}?> id="db__tout" value="intro"/>intro
						  
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="dribbble[out][]" <?php if(in_array('title',$dribbble->out)) { echo 'checked';}?> id="db__tout" value="title"/>title
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="dribbble[out][]"  <?php if(in_array('thumb',$dribbble->out)) { echo 'checked';}?> id="db__tout" value="thumb"/>thumb
				</label>
				<label class="checkbox">
				<input type="checkbox"   name="dribbble[out][]" <?php if(in_array('user',$dribbble->out)) { echo 'checked';}?>  id="db__tout" value="user"/>user
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="dribbble[out][]" <?php if(in_array('text',$dribbble->out)) { echo 'checked';}?>  id="db__tout" value="text"/>text
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="dribbble[out][]"  <?php if(in_array('share',$dribbble->out)) { echo 'checked';}?> id="db__tout" value="share"/>share
						  
			        </label>
		
			      </div>
			   </div>
                       <div class="form-group">
			      <label class="col-md-3 control-label">Feed item</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="dribbble[feed][]"  <?php if(in_array('shots',$dribbble->feed)) { echo 'checked';}?> id="db__feed" value="shots"/> Shots 	 
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="dribbble[feed][]"  <?php if(in_array('likes',$dribbble->feed)) { echo 'checked';}?> id="db__feed" value="likes"/> Likes
						  
			        </label>
		
		
			      </div>
			   </div>

                  </div>
                  <div class="tab-pane" id="tumb">
                    <p><strong>Tumblr</strong></p>
                     <div class="form-group">
		      <label class="col-md-3 control-label">Tumblr</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="tumblr[tumblrid]" id="db__tumblr" value="<?php echo $tumblr->tumblrid;?>"/>
		         
		      </div>
		   </div>  
			 <div class="form-group">
			      <label class="col-md-3 control-label">Stream item output</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="tumblr[out][]" <?php if(in_array('intro',$tumblr->out)) { echo 'checked';}?> id="db__tout" value="intro"/>intro
						  
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="tumblr[out][]" <?php if(in_array('title',$tumblr->out)) { echo 'checked';}?> id="db__tout" value="title"/>title
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="tumblr[out][]" <?php if(in_array('user',$tumblr->out)) { echo 'checked';}?> id="db__tout" value="user"/>user
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="tumblr[out][]" <?php if(in_array('text',$tumblr->out)) { echo 'checked';}?> id="db__tout" value="text"/>text
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="tumblr[out][]" <?php if(in_array('share',$tumblr->out)) { echo 'checked';}?> id="db__tout" value="share"/>share
						  
			        </label>
		
			      </div>
			   </div>

                  </div>
                  <div class="tab-pane" id="stun">
                    <p><strong>Stumbleupon</strong></p>
                    <div class="form-group">
		      <label class="col-md-3 control-label">Stumbleupon</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="stumbleupon[stumbleuponid]" id="db__stumbleupon" value="<?php echo $stumbleupon->stumbleuponid;?>"/>
		         
		      </div>
		   </div> 
		  <div class="form-group">
			      <label class="col-md-3 control-label">Stream item output</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="stumbleupon[out][]" <?php if(in_array('intro',$stumbleupon->out)) { echo 'checked';}?> id="db__tout" value="intro"/>intro
						  
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="stumbleupon[out][]" <?php if(in_array('title',$stumbleupon->out)) { echo 'checked';}?> id="db__tout" value="title"/>title
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="stumbleupon[out][]" <?php if(in_array('thumb',$stumbleupon->out)) { echo 'checked';}?> id="db__tout" value="thumb"/>thumb
				</label>
				<label class="checkbox">
				<input type="checkbox"   name="stumbleupon[out][]" <?php if(in_array('user',$stumbleupon->out)) { echo 'checked';}?> id="db__tout" value="user"/>user
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="stumbleupon[out][]" <?php if(in_array('text',$stumbleupon->out)) { echo 'checked';}?> id="db__tout" value="text"/>text
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="stumbleupon[out][]" <?php if(in_array('share',$stumbleupon->out)) { echo 'checked';}?> id="db__tout" value="share"/>share
						  
			        </label>
		
			      </div>
			   </div>
                       <div class="form-group">
			      <label class="col-md-3 control-label">Feed item</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="stumbleupon[feed][]" <?php if(in_array('favorites',$stumbleupon->feed)) { echo 'checked';}?> id="db__feed" value="favorites"/> Favorites 	 
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="stumbleupon[feed][]" <?php if(in_array('reviews',$stumbleupon->feed)) { echo 'checked';}?> id="db__feed" value="reviews"/> Reviews
						  
			        </label>
		
		
			      </div>
			   </div>
                  </div>
                  <div class="tab-pane" id="lfm">
                    <p><strong>Lastfm</strong></p>
                    <div class="form-group">
		      <label class="col-md-3 control-label">Lastfm</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="lastfm[lastfmid]" id="db__lastfm" value="<?php echo $lastfm->lastfmid;?>"/>
		         
		      </div>
		   </div>  
			<div class="form-group">
			      <label class="col-md-3 control-label">Stream item output</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="lastfm[out][]" <?php if(in_array('intro',$lastfm->out)) { echo 'checked';}?> id="db__tout" value="intro"/>intro
						  
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="lastfm[out][]" <?php if(in_array('title',$lastfm->out)) { echo 'checked';}?> id="db__tout" value="title"/>title
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="lastfm[out][]" <?php if(in_array('thumb',$lastfm->out)) { echo 'checked';}?> id="db__tout" value="thumb"/>thumb
				</label>
				<label class="checkbox">
				<input type="checkbox"   name="lastfm[out][]" <?php if(in_array('user',$lastfm->out)) { echo 'checked';}?> id="db__tout" value="user"/>user
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="lastfm[out][]" <?php if(in_array('text',$lastfm->out)) { echo 'checked';}?> id="db__tout" value="text"/>text
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="lastfm[out][]" <?php if(in_array('share',$lastfm->out)) { echo 'checked';}?> id="db__tout" value="share"/>share
						  
			        </label>
		
			      </div>
			   </div>
                       <div class="form-group">
			      <label class="col-md-3 control-label">Feed item</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="lastfm[feed][]" <?php if(in_array('recenttracks',$lastfm->feed)) { echo 'checked';}?> id="db__feed" value="recenttracks"/> Recent tracks 	 
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="lastfm[feed][]"  <?php if(in_array('lovedtracks',$lastfm->feed)) { echo 'checked';}?> id="db__feed" value="lovedtracks"/> Loved tracks
						  
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="lastfm[feed][]" <?php if(in_array('replytracker',$lastfm->feed)) { echo 'checked';}?> id="db__feed" value="replytracker"/> Reply tracks
						  
			        </label>		
		
			      </div>
			   </div>
                  
                  </div>
                  <div class="tab-pane" id="devi">
                    <p><strong>Deviantart</strong></p> 
		   <div class="form-group">
		      <label class="col-md-3 control-label">Deviantart</label>
		      <div class="col-md-5">
			<input type="text" class="form-control input-md" name="deviantart[deviantartid]" id="db__deviantart" value="<?php echo $deviantart->deviantartid;?>"/>
		         
		      </div>
		   </div>  
			<div class="form-group">
			      <label class="col-md-3 control-label">Stream item output</label>	 
			      <div class="col-md-5">
				<label class="checkbox">
				 <input type="checkbox"   name="deviantart[out][]" <?php if(in_array('intro',$deviantart->out)) { echo 'checked';}?> id="db__tout" value="intro"/>intro
						  
			        </label>
				<label class="checkbox">
				 <input type="checkbox"   name="deviantart[out][]" <?php if(in_array('title',$deviantart->out)) { echo 'checked';}?> id="db__tout" value="title"/>title
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="deviantart[out][]" <?php if(in_array('thumb',$deviantart->out)) { echo 'checked';}?> id="db__tout" value="thumb"/>thumb
				</label>
				<label class="checkbox">
				<input type="checkbox"   name="deviantart[out][]" <?php if(in_array('user',$deviantart->out)) { echo 'checked';}?> id="db__tout" value="user"/>user
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="deviantart[out][]" <?php if(in_array('text',$deviantart->out)) { echo 'checked';}?> id="db__tout" value="text"/>text
						  
			        </label>
				<label class="checkbox">
				<input type="checkbox"   name="deviantart[out][]" <?php if(in_array('share',$deviantart->out)) { echo 'checked';}?> id="db__tout" value="share"/>share
						  
			        </label>
		
			      </div>
			   </div>
                  </div>


                </div>
                
                
               </div> 
              </div> <!-- /tabbable -->
            </div>
	   
          
          <div class="panel-footer">
						<div class="form-group">
						  <div class="col-sm-offset-3 col-sm-9">
							<button type="button" class="btn btn-primary" id="savefrm">Save</button>
						  </div>
						</div>
                  </div>

	<input type="hidden" name="task" value="savesocialfeed" />
        <input type="hidden" name="id" value="<?php echo $id;?>" />
       


			<?php echo form_close();?>
			 </div>
		</div>
	</div>
</div>		
</div>
 <script>
 function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( $email ) ) {
    return false;
  } else {
    return true;
  }
}
 	function check_trim(getstrid)
	{
	  if(!$.trim($('#'+getstrid).val()).length) {
                return false;
            }else
			{
				 return true;
			}
	}
  // username  userpass  email siteemail siteemailpass
  	
	$('#savefrm').bind('click',function(){
        $("#advanced-form").submit();
    });    
 </script>