<?php ob_start(); header('Content-Type: text/html; charset=utf-8');
$_GET['id']=$id;
$_GET['sno']=$sno;
$disqusIdPrefix = "newid";
$disqusUrlPrefix = BASE_URL;
$disqusTitlePrefix = ""; 
// FOR REGION PROFILES
$disqusRegionIdPrefix = "rnewid";
$disqusRegionUrlPrefix = BASE_URL;
$disqusRegionTitlePrefix = "";
$flagBGColor = array('#4DCBF4','#FD6655','#F6FBA7','#9DF8FB','#F848E9','#E4AF79','#4DCBF4','#FD6655','#F6FBA7','#9DF8FB','#F848E9','#E4AF79','#4DCBF4','#FD6655','#F6FBA7','#9DF8FB','#F848E9','#E4AF79','#4DCBF4','#FD6655','#F6FBA7','#9DF8FB','#F848E9','#E4AF79','#4DCBF4','#FD6655','#F6FBA7','#9DF8FB','#F848E9','#E4AF79','#4DCBF4','#FD6655','#F6FBA7','#9DF8FB','#F848E9','#E4AF79','#4DCBF4','#FD6655','#F6FBA7','#9DF8FB','#F848E9','#E4AF79');
$i=0;
if(isset($_GET['id']) && $_GET['id']!=''){
$rowRegions =    get_Regions_with_in_status_asc($_GET['id']);//  $objDatabase->dbQuery("Select * FROM ".TBL_REGIONS." where status='1' and id='".$_GET['id']."'  order by region_name asc ");
$intAlternate=0;
$flagCounter = ($_GET['sno']-1);
$COAbgColor = $flagBGColor[$flagCounter];
foreach($rowRegions as $regionObject)
{
$intAlternate++; ?>
<?php
if(($_GET['sno']%2)==0){
//$bigAd = $objDatabase->fetchRows("Select * FROM ".TBL_ADS." where type='1' and FIND_IN_SET (".$regionObject->id.", regions) order by rand() limit 1");
$bigAd = get_Ads_with_in_status_limit($regionObject->id);

if($bigAd<>''){
$pathInfo = pathinfo($bigAd->image);
?>
<div class="TopVideoContainer">
<video class="StretchtoFit" loop autoplay>
<source src="<?php echo BASE_URL.'upload/'.$pathInfo['filename'].'.mp4';?>" type="video/mp4" />
</video>
</div>
<?php }}else{
$adBackground = get_adsById(7);// $objFunctions->iFind(TBL_ADS, 'image', array('id'=>7));
$imgData = base64_encode(file_get_contents(BASE_URL.'upload/'.$adBackground->image));
$src= BASE_URL.'upload/'.$adBackground->image;

$smalladRs = get_ads_rand_with_type($regionObject->id);// $objDatabase->dbQuery("Select * FROM ".TBL_ADS." where type='2' and id<>7 and FIND_IN_SET (".$regionObject->id.", regions) order by rand() limit 5");

if(count($smalladRs)>0){?>
<div class="cd-scrolling-bg cd-color-3">
<div class="cd-container">
<div class="islandParallax" id="home-<?php echo $_GET['sno'];?>" style="background: url(<?php echo $src;?>) 50% 0 fixed no-repeat;">
<ul class="gallery clearfix">	 
<?php 
foreach($smalladRs as $objAdRow){
   ?>
<li class="span_2"><a href="<?php echo SITE_MEDIA.$objAdRow->image;?>" rel="prettyPhoto[gallery2]" title="<?php echo $objAdRow->title;?>"><img src="<?php echo BASE_URL;?>show-thumbpj.php?src=<?php echo SITE_MEDIA.$objAdRow->image;?>&w=200&h=150" width="200" height="150" class="lazy" alt="" /><div class="zoomtext"><i class="icon-search icon-2x" style="display: block;"></i><span>Zoom</span></div></a></li>
<?php }	?>
</ul>
</div> <!--class-islandParallax-->
</div> <!-- cd-container -->
</div>  <!-- cd-scrolling-bg -->
<?php }} if($intAlternate > '1'){?>
<div id="<?php echo removeUnsed($regionObject->region_name);?>" class="row header gradient clearfix category reg_part">
</div>
<?php }else{?>
<div id="<?php echo removeUnsed($regionObject->region_name);?>" class="row header gradient clearfix category reg_part">
<?php 
$clsSpan8 ='style="float:right"';
$clsSpan4 ='style="float:left; padding-left:4%;"';
if(($_GET['sno'])%2==0){
$clsSpan8 ='style="float:left"';
$clsSpan4 ='style="float:right; padding-right:4%;"';
} 
$flagContent = (array)json_decode($regionObject->flag_desc);
$popContent = (array)json_decode($regionObject->population);
?>
<div class="cta_fe fitvid col span_8" <?php echo $clsSpan8;?>>
<div class="video_wr">
<div class="island_image" <?php echo $clsSpan4;?>>
<img src="<?php echo BASE_URL;?>show-thumbpj.php?src=upload/<?php echo $regionObject->image;?>&w=490&h=300" border="0" class="lazy">
</div>
<div class="my_flag thumbs" <?php echo $clsSpan8;?>> <a class="ptv" title="" href="javascript: void(0);"  data-title="" data-postid="">
<img class="post-img lazy" alt="" src="<?php echo BASE_URL;?>show-thumbpj.php?src=upload/<?php echo $regionObject->flag;?>&w=300&h=180">
<span class="ctr_detail">
<?php if($flagContent['motto']<>'') echo 'Motto: '.stripslashes(html_entity_decode($flagContent['motto'], ENT_QUOTES)).' <br />';?>
<?php if($flagContent['anthem']<>'') echo 'Anthem: '.stripslashes(html_entity_decode($flagContent['anthem'], ENT_QUOTES)).' <br />';?>
<?php if($flagContent['national_dish']<>'') echo 'National Dish: '.stripslashes(html_entity_decode($flagContent['national_dish'], ENT_QUOTES));?> </span></a> 
<ul class="statGrid clearfix">
<li class="twist">
<div class="statItem">
<div class="statInfo" style="background:<?php echo $COAbgColor; ?>">
<h3>
<?php if($popContent['capital']<>'') echo 'Capital: '.stripslashes(html_entity_decode($popContent['capital'], ENT_QUOTES)).'<br />';?>
<?php if($popContent['language']<>'') echo 'Language: '.stripslashes(html_entity_decode($popContent['language'], ENT_QUOTES)).'<br />';?>
<?php if($popContent['language']<>'') echo 'Population: '.stripslashes(html_entity_decode($popContent['population'], ENT_QUOTES));?> </h3>
<p><?php echo nl2br($popContent['flag_shortdesc']);?></p> 
</div>
<div class="coloredcircle st_ap stat-1">
<div class="logoimage" style="background:url('<?php echo BASE_URL;?>show-thumbpj.php?src=upload/<?php echo  $regionObject->cover_image;?>&w=200&h=200') center no-repeat;background-size:contain;">
</div> 
</div>
</div>
</li>
</ul>
</div>
</div>
</div>
<div class="category-intro col span_4"  <?php echo $clsSpan4;?>>
<h2 class="heading"><?php echo stripslashes(html_entity_decode($regionObject->region_name, ENT_QUOTES));?></h2>
<h3 class="sm_head"><?php echo stripslashes(html_entity_decode($regionObject->region_title, ENT_QUOTES));?></h3>
<?php 
$descriptiontext = utf8_encode(stripslashes($regionObject->description));
$fbdes = $regionObject->description;
//$de = utf8_decode($regionObject->description);
$de = mb_detect_encoding($regionObject->description, "UTF-8,ISO-8859-1");
$de = iconv($de, "UTF-8", $regionObject->description);
?>
<div class="body" ><?php echo stripslashes($de);?></div>
<section id="container">
<div id="menu-wrap">
<div class="menu-item">
<span id="active" class="icon fa fa-facebook"></span>
<a id="hover" class="text" href="javascript:void(0);" onclick="fbSub('<?php echo htmlentities(stripslashes($regionObject->region_name),ENT_QUOTES);?>','<?php echo stripslashes(htmlentities($de,ENT_QUOTES));?>','<?php echo SITE_GETUPLOADPATH.$regionObject->image; ?>','','<?php echo BASE_URL."#".removeUnsed($regionObject->region_name);?>');"><i class="fa fa-facebook"></i></a>
</div>
<div class="menu-item">
<span id="active" class="icon fa fa-twitter"></span>
<?php $len = strlen(BASE_URL.'#'.removeUnsed($regionObject->region_name));$len = 140 - ($len+1);?>
<a id="hover" class="text" target="_blank" href="http://twitter.com/share?text=<?php echo substr(stripslashes($de),0,$len).'....';?>&amp;hashtags=<?php echo "island_peeps"; ?>&amp;url=<?php echo urlencode(BASE_URL.'#'.removeUnsed($regionObject->region_name));?>"><i class="fa fa-twitter"></i></a>
</div><!-- Menu Item -->
<div class="menu-item">
<span id="active" class="icon fa fa-pinterest-square"></span>
<a id="hover" class="text" target="_blank" href="http://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(BASE_URL.'#'.removeUnsed($regionObject->region_name));?>&media=<?php echo SITE_GETUPLOADPATH.$regionObject->image; ?>&description=<?php echo stripslashes($de);?>"><i class="fa fa-pinterest-square"></i></a>
</div><!-- Menu Item -->
<div class="menu-item">
<span id="active" class="icon fa fa-tumblr"></span>
<a id="hover" class="text" target="_blank" href="http://www.tumblr.com/share/photo?source=<?php echo SITE_GETUPLOADPATH.$regionObject->image; ?>&caption=<?php echo stripslashes($de);?>&click_thru=<?php echo urlencode(BASE_URL.'#'.removeUnsed($regionObject->region_name));?>"><i class="fa fa-tumblr"></i></a>
</div><!-- Menu Item -->
</div><!-- Menu Wrap -->
<div class="disqus-btn">
<button onclick="reset('<?php echo $disqusRegionIdPrefix.$regionObject->id?>', '<?php echo $disqusRegionUrlPrefix."#!".removeUnsed($regionObject->region_name);?>', '<?php echo $disqusRegionTitlePrefix.htmlentities(stripslashes($regionObject->region_name));?>', 'region_<?php echo $regionObject->id;?>');">&nbsp;</button>

<?php /*<a href="javascript:void(0)" onclick="reset('<?php echo $disqusRegionIdPrefix.$regionObject->id?>', '<?php echo $disqusRegionUrlPrefix."#".removeUnsed($regionObject->region_name);?>', '<?php echo $disqusRegionTitlePrefix.htmlentities(stripslashes($regionObject->region_name));?>', 'region_<?php echo $regionObject->id;?>');"><img src="<?php echo BASE_URL;?>show-thumbpj.php?src=images/disqus-btn.png&w=99&h3=32" class="lazy"/></a> */ ?>
</div>
<div class="clear"></div>
</section>
<div id="region_<?php echo $regionObject->id;?>">
</div>
</div>
</div>
<div style="width:100%; float:left;" class="gray-bar"> </div>
<?php
$resProfiles = get_profiles_status_not_kind($regionObject->id);//$objDatabase->dbQuery("SELECT * from ".TBL_PROFILES." where FIND_IN_SET (".$regionObject->id.", region_id) and status='4' and kind != 'Me Me'");
$arrProfiles_arr = get_profiles_status_with_nolimit($regionObject->id);// $objDatabase->fetchRows("SELECT * from ".TBL_PROFILES." where  FIND_IN_SET (".$regionObject->id.", region_id) and status='4'");
$regionName =  stripslashes(html_entity_decode($regionObject->region_name, ENT_QUOTES));
$iprofileCount=0; 
if(!empty($arrProfiles_arr)){
    
  foreach($arrProfiles_arr as $arrProfiles) 
  { 
$iprofileCount++;
$youtubeURl = $arrProfiles->video;
parse_str( parse_url( $youtubeURl, PHP_URL_QUERY ), $my_array_of_vars );
$youtubeCode = $my_array_of_vars['v'];   
$profileImage =  $arrProfiles->image; ?>
<div id="<?php echo removeUnsed($regionName);?>-profile"  data-category="primary-<?php echo removeUnsed($regionName);?>" class="category <?php echo removeUnsed($regionName);?> container ah_lin">
<div class="row header gradient clearfix">
<div class="cta_fe fitvid col span_8">
<div class="video_wr regionsection" id="<?php echo removeUnsed($regionName);?>-player">
<?php if($profileImage=='' && $youtubeCode<>'') {?>
<iframe frameborder="0" src="http://www.youtube.com/embed/<?php echo $youtubeCode;?>?enablejsapi=1&amp;showinfo=0&amp;theme=light&amp;rel=0&amp;modestbranding=1&amp;autohide=1&amp;color=white" allowfullscreen="" type="text/html" ></iframe>
<?php } else { $IDstring = str_replace(' ', '', stripslashes($arrProfiles->title));	?>
<img src="<?php echo BASE_URL;?>show-thumbpj.php?src=upload/<?php echo $profileImage;?>&w=800&h=520" class="lazy">
<?php } ?>
</div>
</div>
<div class="category-intro col span_4">
<h2 class="heading"><?php echo $regionName;?></h2>
<h3 class="fp_head" id="innerheading-<?php echo removeUnsed($regionName);?>"><?php echo stripslashes(html_entity_decode($arrProfiles->title, ENT_QUOTES));?></h3>
<?php //$profileDescText = stripslashes(utf8_encode($arrProfiles->description));
$SocialprofileDescText = $arrProfiles->description;
$de = mb_detect_encoding($arrProfiles->description, "UTF-8,ISO-8859-1");
$profileDescText = iconv($de, "UTF-8", $arrProfiles->description);
?>
<div class="body"  style="padding-right:4%;"  id="innerbody-<?php echo removeUnsed($regionName);?>"><?php echo stripslashes($profileDescText);?></div>
<section id="container">
<div id="menu-wrap">
<div class="menu-item">
<span class="icon fa fa-facebook" id="active"></span>
<a href="javascript:void(0);" onclick="fbSub('<?php echo htmlentities(stripslashes($arrProfiles->title));?>','<?php echo htmlentities($SocialprofileDescText,ENT_QUOTES);?>','<?php echo SITE_GETUPLOADPATH.$arrProfiles->image; ?>','<?php echo htmlentities(stripslashes($regionName));?>','<?php echo BASE_URL."#".removeUnsed($regionName);?>');" class="text share_fb" id="hover" hidefocus="true" style="outline: medium none;"><i class="fa fa-facebook"></i></a>
</div>
<div class="menu-item">
<span class="icon fa fa-twitter" id="active"></span>
<?php
$len = strlen(BASE_URL.'#'.removeUnsed($regionName));
$len = 140 - ($len+1);
?>
<a class="text share_t" href="http://twitter.com/share?text=<?php echo urlencode(substr(htmlentities(stripslashes($SocialprofileDescText),ENT_QUOTES),0,$len)); ?>&amp;hashtags=<?php echo "island_peeps"; ?>&amp;url=<?php echo urlencode(BASE_URL.'#'.removeUnsed($regionName));?>" target="_blank" id="hover" hidefocus="true" style="outline: medium none;"><i class="fa fa-twitter"></i></a>
</div>
<div class="menu-item">
<span class="icon fa fa-pinterest-square" id="active"></span>
<a id="hover" class="text share_pinte" target="_blank" href="http://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(BASE_URL."#".removeUnsed($regionName));?>&media=<?php echo SITE_GETUPLOADPATH.$arrProfiles->image; ?>&description=<?php echo urlencode(stripslashes(html_entity_decode(htmlentities($SocialprofileDescText,ENT_QUOTES),ENT_QUOTES)));?>"><i class="fa fa-pinterest-square"></i></a>
</div> 
<div class="menu-item">
<span class="icon fa fa-tumblr" id="active"></span>
<a target="_blank" class="text share_tumblr" id="hover" href="http://www.tumblr.com/share/photo?source=<?php echo SITE_GETUPLOADPATH.$arrProfiles->image; ?>&caption=<?php echo urlencode(stripslashes(html_entity_decode($SocialprofileDescText,ENT_QUOTES)));?>&click_thru=<?php echo urlencode(BASE_URL."#".removeUnsed($regionName));?>" hidefocus="true" style="outline: medium none;"><i class="fa fa-tumblr"></i></a>
</div> 
</div>
<div class="disqus-btn">
<button onclick="reset('<?php echo $disqusIdPrefix.$arrProfiles->id;?>', '<?php echo $disqusUrlPrefix."#!".removeUnsed($regionName)."-profile".$arrProfiles->id;?>', '<?php echo $disqusTitlePrefix.htmlentities(stripslashes($arrProfiles->title));?>', 'persone_<?php echo $arrProfiles->id;?>');">&nbsp;</button>

<?php /*<a class="disqusBox" href="javascript:void(0)" onclick="reset('<?php echo $disqusIdPrefix.$arrProfiles->id?>', '<?php echo $disqusUrlPrefix."#".removeUnsed($regionName)."-profile";?>', '<?php echo $disqusTitlePrefix.htmlentities(stripslashes($arrProfiles->title));?>', 'persone_<?php echo $arrProfiles->id;?>');"><img src="<?php echo BASE_URL;?>show-thumbpj.php?src=images/disqus-btn.png&w=99&h=32" class="lazy"/></a> */ ?>
</div>
<div class="clear"></div> 
</section>
<div id="persone_<?php echo $arrProfiles->id;?>"></div>
</div>
</div>
</div>
<?php $regimg = '<li> <img class="sm_image lazy" src="/upload/'.$regionObject->ragion_map.'"><p>'.stripslashes($regionName).'</p></li>'; ?>
<div class="row thumbs1 clearfix">
<?php 
foreach($resProfiles as $profileRow)
{
$youtubeURl = $profileRow->video;
if(!empty($youtubeURl))
{
parse_str( parse_url( $youtubeURl, PHP_URL_QUERY ), $my_array_of_vars );
$youtubeCode = $my_array_of_vars['v'];
}else
{
  $youtubeCode="1iBm60uJXvs";  
}  
$profileImage =  $profileRow->image;
?>
<div class="col span_3">
<?php if($profileImage=='' && $youtubeCode<>'') {?>
<a data-postid="<?php echo removeUnsed($regionName);?>" data-youtubeid="<?php echo $youtubeCode;?>" data-title="<?php echo stripslashes(html_entity_decode($profileRow->title, ENT_QUOTES));?>" data-proid="<?php echo $profileRow->id;?>" data-prourl="<?php echo str_replace(' ', '', stripslashes(html_entity_decode($profileRow->title, ENT_QUOTES)));?>" data-body="<?php echo stripslashes(html_entity_decode($profileRow->description, ENT_QUOTES));?>" href="javascript: void(0);" title="<?php echo stripslashes(html_entity_decode($profileRow->title, ENT_QUOTES));?>" class="post-thumb-video <?php echo removeUnsed($regionName);?> videoclick"><img src="http://i.ytimg.com/vi/<?php echo $youtubeCode;?>/0.jpg" alt="<?php echo $profileRow->title;?>"  class="post-img lazy"></a>
<?php } else {?>
<a data-postid="<?php echo removeUnsed($regionName);?>" href="javascript: void(0);" data-title="<?php echo stripslashes(htmlentities($profileRow->title,ENT_QUOTES));?>" data-proid="<?php echo $profileRow->id;?>" data-prourl="<?php echo str_replace(' ', '', stripslashes(html_entity_decode($profileRow->title, ENT_QUOTES)));?>" data-body="<?php echo stripslashes(htmlentities($profileRow->description, ENT_QUOTES));?>" data-image="<?php echo 'show-thumb.php?file='.base_url().'library/upload/'.$profileImage;?>&w=800&h=800" title="<?php echo stripslashes(html_entity_decode($profileRow->title, ENT_QUOTES));?>"  class="post-thumb-video <?php echo removeUnsed($regionName);?> imageclick recimg"><?php if(!empty($profileImage)){?><img src="<?php echo BASE_URL;?>show-thumbpj.php?src=<?php echo base_url().'library/upload/'.$profileImage;?>&w=300&h=250" class="post-img lazy"><?php }else{?><img src="<?php echo BASE_URL;?>show-thumbpj.php?src=<?php echo base_url().'images/blankImg.jpg';?>&w=300&h=250" width="100%" class="post-img lazy"><?php }?>
<div class="shwrg">
<ul class="photo_place_icon">
<?php echo $regimg;?>
</ul>
<h1 class="photo_name_white"><?php echo stripslashes(html_entity_decode($profileRow->title, ENT_QUOTES));?></h1>
</div>
</a>
<?php  } ?>
</div>
<?php } ?>
</div>
</div>
<?php 
  }
}  // end arrprofiles

} ?>
<?php $i++; }}?>
<script>
$('.recimg').mouseenter(function() {$(this).find('.shwrg').show();}).mouseleave(function() {$(this).find('.shwrg').hide();});
</script>
<script type="text/javascript" charset="utf-8">
$("area[rel^='prettyPhoto']").prettyPhoto({deeplinking: false,overlay_gallery: false,social_tools: false,'theme': 'light_square'});
$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square'});
$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
</script>
<script type="text/javascript">
	//.parallax(xPosition, speedFactor, outerHeight) options://xPosition - Horizontal position of the element//inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling//outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
$('#home-<?php echo $_GET['sno'];?>').parallax("50%", 0.1);
</script>