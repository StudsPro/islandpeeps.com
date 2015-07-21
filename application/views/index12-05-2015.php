<?php

error_reporting(E_ALL);

//ob_start();

//$seconds_to_cache = 1209600;

//$ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";

//header("Expires: $ts");

//header("Pragma: cache");

//header("Cache-Control: max-age=$seconds_to_cache");

$Regions = getRegions(); 

//echo "<pre>"; print_r($Regions); exit;

$regiondata = '';$i=1;

$catcolor = array('#FF6600', '#FCD202', '#B0DE09', '#0D8ECF', '#2A0CD0', '#CD0D74', '#CC0000', '#00CC00', '#0000CC', '#DDDDDD', '#999999','#333333', '#990000');

$flagBGColor = array( '#4DCBF4','#FD6655','#F6FBA7','#9DF8FB','#F848E9','#E4AF79');

$disqusIdPrefix = "newid";

$disqusUrlPrefix = base_url();

//$disqusUrlPrefix = "http://www.techlect.com/";

$disqusTitlePrefix = "";

// FOR COUNTRY PROFILES

$disqusRegionIdPrefix = "rnewid";

$disqusRegionUrlPrefix = base_url();

//$disqusRegionUrlPrefix = "http://www.techlect.com/";

$disqusRegionTitlePrefix = "";

foreach($Regions as  $Region){

if($Region->longitude != '' && $Region->latitude !=''){

$category = frontcategory($Region->id);

$barcount='';$bardata='';$bardata1=array();$ci = 0;

				foreach($category as $categorydata){

				$bardata[]=array('group' => trim($categorydata->category),  'value' => trim($categorydata->count), 'color' => $catcolor[$ci] ); 

				$bardata1[]="'".$categorydata->category."'";

				$ci++;

				}

$barcount[]= '0';

$flagContent = (array)json_decode($Region->flag_desc);

$popContent = (array)json_decode($Region->population);

$piedata='';

//$groups = array_filter(explode("\r\n",$popContent['flag_shortdesc']));

$groups=array();

$g = 1;

foreach($groups as $group){

	if(trim($group) !='' && $g > 1){

	$groupdata = array_filter(explode("%", $group));

 	  $piedata[]=array('group' => trim($groupdata[1]),  'value' => trim($groupdata[0]) ); 

 	}$g++;

}

$bardata = json_encode($bardata); 

$piedata = json_encode($piedata); 

$description = utf8_encode(stripslashes(preg_replace( "/\r|\n/", "", $Region->description )));

//$regiondata.="{ type: 'Feature',geometry:{type: 'Point',coordinates: [".rtrim($Region->longitude,']').", ".rtrim($Region->latitude,']')."]},properties:{title: '".$Region->region_name."',description: '".addslashes($description)."',population : '".addslashes($popContent['population'])."',national_dish : '".addslashes($flagContent['national_dish'])."',capital : '".addslashes(html_entity_decode($popContent['capital'],ENT_QUOTES))."',url : '#".$objFunctions->removeUnsed(html_entity_decode($Region->region_name,ENT_QUOTES))."','marker-color': '#FD6654','marker-size': 'small','chartid' : 'pie".$i."','chartcount' :  ". $barcount.",'chartcategory' :  '". $bardata."','piedata' : '".$piedata."'}},";

if($Region->region_name == 'Kingdom of the Netherlands'){

//$regiondata.="{ type: 'Feature',geometry: {type: 'Point',coordinates: [-69.9811935424805,12.5160225676711]},properties: {title: '".$Region->region_name."',description: '".addslashes($description)."',population : '".addslashes($popContent['population'])."',national_dish : '".addslashes($flagContent['national_dish'])."',capital : '".addslashes($popContent['capital'])."',url : '#".$objFunctions->removeUnsed($Region->region_name)."','marker-color': '#FD6654','marker-size': 'small','chartid' : 'pie".$i."','chartcount' :  ". $barcount.",'chartcategory' :  '". $bardata."','piedata' : '".$piedata."'}},";

//$regiondata.="{ type: 'Feature',geometry: {type: 'Point',coordinates: [-69.0411007404327, 12.2179121771407]},properties: {title: '".$Region->region_name."',description: '".addslashes($description)."',population : '".addslashes($popContent['population'])."',national_dish : '".addslashes($flagContent['national_dish'])."',capital : '".addslashes($popContent['capital'])."',url : '#".$objFunctions->removeUnsed($Region->region_name)."' ,'marker-color': '#FD6654','marker-size': 'small','chartid' : 'pie".$i."','chartcount' :  ". $barcount.",'chartcategory' :  '". $bardata."','piedata' : '".$piedata."'}},";

//$regiondata.="{ type: 'Feature',geometry: {type: 'Point',coordinates: [-63.059358894825, 18.0360067826954]},properties: {title: '".$Region->region_name."',description: '".addslashes($description)."',population : '".addslashes($popContent['population'])."',national_dish : '".addslashes($flagContent['national_dish'])."',capital : '".addslashes($popContent['capital'])."',url : '#".$objFunctions->removeUnsed($Region->region_name)."' ,'marker-color': '#FD6654','marker-size': 'small','chartid' : 'pie".$i."','chartcount' :  '". $barcount."','chartcategory' :  '". $bardata."','piedata' : '".$piedata."'}},";

}else if($Region->region_name == 'French Caribbean Islands'){

//$regiondata.="{ type: 'Feature',geometry: {type: 'Point',coordinates: [-62.8256016969681,17.9062962145336]},properties: {title: '".$Region->region_name."',description: '".addslashes($description)."',population : '".addslashes($popContent['population'])."',national_dish : '".addslashes($flagContent['national_dish'])."',capital : '".addslashes($popContent['capital'])."',url : '#".$objFunctions->removeUnsed($Region->region_name)."' ,'marker-color': '#FD6654','marker-size': 'small','chartid' : 'pie".$i."','chartcount' :  ". $barcount.",'chartcategory' :  '". $bardata."','piedata' : '".$piedata."'}},";

//$regiondata.="{ type: 'Feature',geometry: {type: 'Point',coordinates: [-61.0181415081024,14.6443165974781]},properties: {title: '".$Region->region_name."',description: '".addslashes($description)."',population : '".addslashes($popContent['population'])."',national_dish : '".addslashes($flagContent['national_dish'])."',capital : '".addslashes($popContent['capital'])."',url : '#".$objFunctions->removeUnsed($Region->region_name)."' ,'marker-color': '#FD6654','marker-size': 'small','chartid' : 'pie".$i."','chartcount' :  ". $barcount.",'chartcategory' :  '". $bardata."','piedata' : '".$piedata."'}},";

//$regiondata.="{ type: 'Feature',geometry: {type: 'Point',coordinates: [-63.0153465270996, 18.0603538710252]},properties: {title: '".$Region->region_name."',description: '".addslashes($description)."',population : '".addslashes($popContent['population'])."',national_dish : '".addslashes($flagContent['national_dish'])."',capital : '".addslashes($popContent['capital'])."',url : '#".$objFunctions->removeUnsed($Region->region_name)."' ,'marker-color': '#FD6654','marker-size': 'small','chartid' : 'pie".$i."','chartcount' :  ". $barcount.",'chartcategory' :  '". $bardata."','piedata' : '".$piedata."'}},";

}$i++;

}}







$polls = front_getsocialpoll();



$regOb = front_getsocialfeeds();

$twitter = json_decode($regOb->twitter);

$rss = json_decode($regOb->rss);

$facebook = json_decode($regOb->facebook);

$google = json_decode($regOb->google);

$instagram = json_decode($regOb->instagram);

$delicious = json_decode($regOb->delicious);

$vimeo = json_decode($regOb->vimeo);

$youtube = json_decode($regOb->youtube);

$pinterest = json_decode($regOb->pinterest);

$flickr = json_decode($regOb->flickr);

$dribbble = json_decode($regOb->dribbble);

$tumblr = json_decode($regOb->tumblr);

$stumbleupon = json_decode($regOb->stumbleupon);

$lastfm = json_decode($regOb->lastfm);

$deviantart = json_decode($regOb->deviantart);

$socialLimit = $regOb->limits;

$socialDays = $regOb->days;

$socialSpeed = $regOb->speed;

$socialFolder = $regOb->forder;





?>

<?php  //$eventsurl = 'http://'.$_SERVER["HTTP_HOST"].ROOT_FOLDER.'/events.php';

 $eventsurl = base_url().'home/getdata';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Island Peeps..</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<link rel="shortcut icon" href="Island_Peeps_files/small_logo.png">

<meta name="viewport" content="width=device-width, initial-scale=0.5, maximum-scale=1">



<?php  include('safari.php');   ?>



<link href="<?php echo base_url() ?>library/Island_Peeps_files/d.css" rel="stylesheet" type="text/css"/>

<script type="text/JavaScript">var alert_type=1;function stripslashes(str){return (str + '').replace(/\\(.?)/g, function(s, n1) {switch (n1) {case '\\':return '\\';case '0':return '\u0000';case '':return '';default:return n1;}});}</script>



<link href="<?php echo base_url() ?>library/Island_Peeps_files/style.css" rel="stylesheet" type="text/css"/> 



<link href="<?php echo base_url() ?>library/css/style.css" rel="stylesheet" type="text/css" />



<link href="<?php echo base_url() ?>library/css/font-awesome.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url() ?>library/style.css" media="screen" rel="stylesheet">

<meta name="google-translate-customization" content="65767690a1227b85-d85bad67b2241c3e-g47e8572041164f9e-25">

<link class="include" rel="stylesheet" type="text/css" href="<?php echo base_url() ?>library/css/style_home_page.css" />

<link class="include" rel="stylesheet" type="text/css" href="<?php echo base_url() ?>library/css/jquery.jqplot.min.css" />

<link href='https://api.tiles.mapbox.com/mapbox.js/v1.6.4/mapbox.css' rel='stylesheet' />

<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>library/css/easy-responsive-tabs.css" />

<link rel="stylesheet" href="<?php echo base_url() ?>library/css/prettyPhoto.css" type="text/css" media="screen"/>

<link rel="stylesheet" href="<?php echo base_url() ?>library/css/videobackground.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>library/social-stream-New/css/dcsns_dark.css" media="all" />

<link rel="stylesheet" href="<?php echo base_url() ?>library/css/chosen.css">

<style>

.funfacts {color: #ce675b;font-size: 2em !important;font-weight: normal !important; display: block; }

.hoverfunfacts {color: #ce675b;  font-size: 20px;  font-weight: bold;  margin-bottom: -22px;}

.prodesc {font-size: 20px;margin-top: -20px;}

.getmargin{ margin-top: 20%;}

.search-ac{z-index: 9999999 !important;}



</style>

<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">

<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">

<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">

<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">

<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">

<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">

<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">

<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">

<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">

<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">

<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">

<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">

<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">

<link rel="manifest" href="favicon/manifest.json">

<meta name="msapplication-TileColor" content="#ffffff">

<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">

<meta name="theme-color" content="#ffffff">

</head>





<body style="opacity: 1; position: relative; background: rgb(255, 255, 255);">



<!-- Facebook script Start 1610365715853568-->

<script>window.fbAsyncInit = function() { FB.init({ appId: '1535169010054852',cookie:true,status:true,xfbml:true,version: 'v2.0'});  }</script>

<div id="fb-root"></div>

<script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));var fbSub = function (name,descripition_data,image_path,caption,url)

{FB.ui({method: "stream.publish",display: "iframe",user_message_prompt: "Publish This!",message: "I am so smart!  S M R T!",attachment: {name: name,caption: caption,description: descripition_data,href: url,media:[{"type":"image","src":image_path,"href":url}],},},function(response) {if (response && response.post_id){} else {}});}</script>

<!-- Facebook script End--> 

<img src="<?php echo base_url() ?>library/Island_Peeps_files/logo_new_2.png" alt="Island Pees" style="position:absolute; z-index:99999; padding:13px; top:10px; left:40px;" class="logo_bg lazy">

<div  id="showlang" class="" ></div>

<div id="main_cato" class="slider container">

<div class="video-wrapper" style="height:0px;"> 

<?php

//echo "Test1"; exit;

?>

<?php  

$banners=front_banner(3);



 $path_partsIntro = @pathinfo("library/upload/".$banners->background);

$sliderImgScreen1 = @pathinfo("library/upload/".$banners->image);?>

<div class="screen" id="screen-1" data-video="<?php echo base_url()."library/upload/".$path_partsIntro['filename'];?>">

<img class="big-image lazy" src="<?php echo base_url()."library/upload/".$sliderImgScreen1['basename'];?>" width="100%" style="margin-right:20px;" border="0" align="left">

<div>

<div class="span_4 col clearfix"> &nbsp; </div>

<div class="span_4 col clearfix  spn_4_wd">

<div class="body tex_wid ">

<h2 class="main_head"><?php echo stripslashes(html_entity_decode($banners->title, ENT_QUOTES));?></h2><br />

<?php if($banners->image<>''){?>

<!--<img src="</?php echo base_url()."library/upload/".$banners->image;?>" width="200" style="margin-right:20px;" border="0" align="left" class="lazy"> -->

<?php } ?>

<?php echo stripslashes(html_entity_decode($banners->description, ENT_QUOTES));?></div>

</div>

</div>

</div><!-- SCREEN 1 END -->  

<?php 

$banners6=front_banner(6);

$path_partsIntro2 = @pathinfo("library/upload/".$banners6->background);

$sliderImgScreen2 = @pathinfo("library/upload/".$banners6->image);?>

<div class="screen" id="screen-2" data-video="<?php echo base_url()."library/upload/".$path_partsIntro2['filename'];?>"> 

<img class="big-image lazy" src="<?php echo  base_url()."library/upload/".$sliderImgScreen2['basename'];?>" width="100%" style="margin-right:20px;" border="0" align="left">

<div>

<div class="span_1 col clearfix " style="margin-right:9%;"> </div>

<div class="span_4 col clearfix blcc_txt" style="margin-right:3%; ">

<ul class="abt_lik left_secc body">

<?php $arrAbout = front_about();

 $iSelect=0;

foreach($arrAbout as $rowAbout)

{

if($iSelect==0)

$sel='selected';

else

$sel=''; 

$iSelect++;

//$linkUsFormText = '';

if($rowAbout->id == 3){$linkUsFormText = $rowAbout->detailed_description;}

if(($rowAbout->id<>4) && ($rowAbout->id<>6) && ($rowAbout->id<>3)){?>

<li class="about-link <?php echo $sel;?>" id="link-<?php echo removeUnsed($rowAbout->page_title);?>"><?php echo $rowAbout->page_title;?></li>

<?php }} ?>

</ul>

</div>

<div class="span_3 abt_link formmmm col clearfix pd_left  cont_blk" style="margin-right:3%;">

<?php $iSelect=0;

//$arrAbout = $objFunctions->iFindAll(TBL_PAGES, array('status'=>'1'));

//$linkUsFormText=''; 

foreach($arrAbout as $rowAbout){

   

//if($rowAbout->id == 3){   $linkUsFormText = $rowAbout->detailed_description; }    

if($iSelect==0){$selC='selected"';$selStyle='style="display:block"';}

else{$selC='';$selStyle='';}

$iSelect++;

if($rowAbout->id<>4 && $iSelect !=2){ ?>

<div class="about-section <?php echo $selC;?>" <?php echo $selStyle?> id="section-<?php echo removeUnsed($rowAbout->page_title);?>">

<div class="body main-desc"><?php echo stripslashes(html_entity_decode($rowAbout->detailed_description, ENT_QUOTES));?></div>

</div>

<?php }else{

    // old code showed  suggestion form 

    ?>



<?php }} 



?>

</div>

</div>

</div><!-- SCREEN 2 END --> 

<!--SCREEN 3 MAP START -->

<!--<div class="screen map" id="screen-3" style="background-color:#40a4df; margin-top:0px;">

<div> <a  class="gotopage scroll-link my-button btt red">Click island to go to page &#9654;</a>

<div class="span_12 col map_top_imm" style="top:5%; width:100%;  padding-bottom:20%;">

<div id='map'></div>

<button class='button icon sun reset' id="mapreset">Reset</button>

<div id='info' class=""></div>

</div>

</div>

</div> -->



<?php 

$banners6=front_banner(6);

$path_partsIntro2 = @pathinfo("library/upload/".$banners6->background);

$sliderImgScreen2 = @pathinfo("library/upload/".$banners6->image);?>

<div class="screen" id="screen-3" data-video="<?php echo base_url()."library/upload/".$path_partsIntro2['filename'];?>"> 

<img class="big-image lazy" src="<?php echo  base_url()."library/upload/".$sliderImgScreen2['basename'];?>" width="100%" style="margin-right:20px;" border="0" align="left">



<div style="margin-top:4%;">

<div class="span_1 col clearfix " style="margin-right:9%;">&nbsp; </div>

<div class="span_4 col clearfix blcc_txt" style="margin-right:3%; ">

<ul class="abt_lik left_secc body">

<?php //$arrAbout = front_about();

 $iSelect=0;

foreach($arrAbout as $rowAbout)

{

if($iSelect==0)

$sel='selected';

else

$sel=''; 

$iSelect++;

//$linkUsFormText = '';

if($rowAbout->id == 3){

    $linkUsFormText = $rowAbout->detailed_description;

?>

<li class="about-link <?php echo $sel;?>" id="link-<?php echo removeUnsed($rowAbout->page_title);?>"><?php echo $rowAbout->page_title;?></li>

<?php }



} ?>

</ul>

</div>

<div class="span_3 abt_link formmmm col clearfix pd_left  cont_blk" style="margin-right:3%;">

<?php $iSelect=0;

//$arrAbout = $objFunctions->iFindAll(TBL_PAGES, array('status'=>'1'));

//$linkUsFormText=''; 

foreach($arrAbout as $rowAbout){

   

//if($rowAbout->id == 3){   $linkUsFormText = $rowAbout->detailed_description; }    

if($iSelect==0){$selC='selected"';$selStyle='style="display:block"';}

else{$selC='';$selStyle='';}

$iSelect++;

if($rowAbout->id==3){ ?>

<div class="about-section abt_link" id="section-suggestion">

<div class="body" style="padding:0px;">

<div class="col-sm-12 "> 

<!-- Contact form -->

<div class="add-comment styled boxed " id="addcomments">

<div class="comment-form" style="padding:20px !important;">

<form  method="post" id="commentForm" name="commentForm" >

<div class="fact_cont smm_tex"> <span style="text-align:center" id="resdiv"></span>

<?php 

//echo $linkUsFormText;

if(isset($linkUsFormText)){ echo stripslashes(html_entity_decode($linkUsFormText, ENT_QUOTES));}else{?>

<p class="pinktext">Submit facts</p>

<p>PLEASE ONLY SUBMIT weird, funny, or interting facts! about anything...</p>

<p>must be real! Thanks:)</p>

<?php }?>

</div>

<div class="form-inner">

<div class="field_text_2 lightPlaceholder">

<input type="text" name="md_title" id="md_title" placeholder="Profile name" />

</div>

<div class="field_text_2 lightPlaceholder">

<label class="dob">Date of Birth</label>

<div class="clear"></div>

<div class="field_text_6 lightPlaceholder" style="margin-right:4px;">

<select  name="year" class="safari_only_sele_boxx sele_boxx">

<!-- To Select Day -->

<option value="">Year</option>

<?php for($y=1800;$y<=(date('Y')-1);$y++){?>

<option value="<?php echo $y;?>" <?php if(isset($dob[0])== $y) echo 'selected';?>><?php echo $y;?> </option>

<?php }?></select>

</div>

<div class="field_text_6 lightPlaceholder" style="margin-right:4px;">

<select name="day" class="sele_boxx"><!-- To Select Day -->

<option value="">Day</option>

<?php for($d=1;$d<=31;$d++){?>

<option value="<?php echo $d;?>" <?php if(isset($dob[2])== $d) echo 'selected';?>><?php echo $d;?></option>

<?php }?></select>

</div>

<div class="field_text_6 lightPlaceholder">

<select name="month" class="sele_boxx"><!-- To Select Day -->

<option value="">Month</option>

<?php $mon = array('Jan','Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec');?>

<?php for($m=1;$m<=12;$m++){?>

<option value="<?php echo $m;?>" <?php if(isset($dob[1])== $m) echo 'selected';?>><?php echo $mon[$m-1];?></option>

<?php }?></select>

</div>

</div>

<div class="field_text_3 lightPlaceholder peoplepro">

<select name="md_kind" id="md_kind" class="sele_boxx" placeholder="" >

<option value="">--Select--</option>

<option value="People profile" >People profile</option>

<option value="Fun facts" >Fun facts</option>

<option value="Me Me" >Me Me</option>

</select>

</div>

<div class="field_text_3 lightPlaceholder">

<select name="md_regions[]" id="md_region_id" multiple="multiple" class="sele_boxx" placeholder="Location" >

<?php echo dropdownRegions($objRs->region_id);?>

</select>

</div>

<div class="field_text_2 lightPlaceholder"> Add profile image

<input type="file" class="span6" name="db_image"  id="m__image"/>

</div>

<div class="field_text field_textarea" style="margin-bottom:6px !important;">

<textarea name="md_description" id="m__description" placeholder="Description"></textarea>

</div>

<div class="field_text_3 lightPlaceholder">

<input name="db_gname" type="text" placeholder="Name">

</div>

<div class="field_text_3 lightPlaceholder">

<input type="text" name="db_email"  value="" placeholder="Email" />

</div>

<div class="acce_tex">

<p style="text-align:left;">

<input id="atc" type="checkbox" value="" class="cckk">

I accept terms & conditions</p>

<p style="text-align:right; margin-top:-35px; margin-bottom:0px;margin-right: 8px;">

<input type="image" src="images/send.png" alt="" class="send_sm_bt"/>

</p>

</div>

</div>

</form>

</div>

</div><!--/ Contact form -->

</div>

</div>

</div>

<?php }} 



?>

</div>

</div>

</div>

<!-- SCREEN 3 MAP END -->

<div class="screen map" id="screen-4" style="background-color:#40a4df; margin-top:0px;">

<div> <a  class="gotopage scroll-link my-button btt red">Click island to go to page &#9654;</a>

<div class="span_12 col map_top_imm" style="top:0%; width:100%;  padding-bottom:20%;">

<div id='map'></div>

<button class='button icon sun reset' id="mapreset">Reset</button>

<div id='info' class=""></div>

</div>

</div>

</div>



<?php 

$banners1=front_banner(1);

$path_partsIntro3 = @pathinfo("library/upload/".$banners1->background);

$sliderImgScreen3 = @pathinfo("library/upload/".$banners1->image);?>



<div class="screen" id="screen-5" data-video="<?php echo base_url()."library/upload/".$path_partsIntro3['filename'];?>"> 

<img class="big-image lazy" src="<?php echo base_url()."library/upload/".$sliderImgScreen3['basename'];?>" width="100%" style="margin-right:20px;" border="0" align="left">

<div>

<div class="span_4 col"> &nbsp; </div>

<div class="span_4 col  spn_4_wd">

<div class="body tex_wid">

<h2 class="main_head"><?php echo stripslashes(html_entity_decode($banners1->title, ENT_QUOTES));?></h2>

<p>

<?php if($banners1->image<>''){?>

<img class="flg lazy" src="<?php echo base_url()."library/upload/".$banners1->image;?>" width="200" height="120" style="margin-right:20px;" border="0" align="left">

<?php } ?>

<?php echo stripslashes(html_entity_decode($banners1->description, ENT_QUOTES));?></p>

<a href="#haiti" class="scr_sl btt ylo">Explore <?php echo stripslashes(html_entity_decode($banners1->title));?> &#9654;</a> </div>

</div>

</div>

</div>



<!-- SCREEN 4 END -->

<?php 

$banners2=front_banner(2);

$path_partsIntro4 = @pathinfo("library/upload/".$banners2->background);

$sliderImgScreen4 = @pathinfo("library/upload/".$banners2->image);?>

<div class="screen" id="screen-6" data-video="<?php echo base_url()."library/upload/".$path_partsIntro4['filename'];?>"> 

<img class="big-image lazy" src="<?php echo base_url()."library/upload/".$sliderImgScreen4['basename'];?>" width="100%" style="margin-right:20px;" border="0" align="left">

<div>

<div class="span_4 col"> &nbsp; </div>

<div class="span_4 col  spn_4_wd">

<div class="body tex_wid">

<h2 class="main_head"><?php echo stripslashes(html_entity_decode($banners2->title, ENT_QUOTES));?></h2>

<p>

<?php if($banners2->image<>''){?>

<img class="flg lazy" src="<?php echo base_url()."library/upload/".$banners2->image;?>" width="200" height="120" style="margin-right:20px;" border="0" align="left">

<?php } ?>

<?php echo stripslashes(html_entity_decode($banners2->description, ENT_QUOTES));?> </p>

<a href="#jamaica" class="scr_sl btt or ">Explore <?php echo html_entity_decode($banners2->title, ENT_QUOTES);?> &#9654;</a> </div>

</div>

</div>

</div><!-- SCREEN 5 END -->

<?php 

$banners4=front_banner(4);

$path_partsIntro5 = @pathinfo("library/upload/".$banners4->background);

$sliderImgScreen5 = @pathinfo("library/upload/".$banners4->image);?>



<div class="screen" id="screen-7"  data-video="<?php echo base_url()."library/upload/".$path_partsIntro5['filename'];?>"> 

<img class="big-image lazy" src="<?php echo base_url()."library/upload/".$sliderImgScreen5['basename']; ?>" width="100%" style="margin-right:20px;" border="0" align="left">

<div>

<div class="span_4 col"> &nbsp; </div>

<div class="span_4 col  spn_4_wd">

<div class="body tex_wid">

<h2 class="main_head"><?php echo stripslashes(html_entity_decode($banners4->title, ENT_QUOTES));?></h2>

<p>

<?php if($banners4->image<>''){?>

<img class="flg" src="<?php echo base_url()."library/upload/".$banners4->image;?>" width="200" height="120" style="margin-right:20px;" border="0" align="left">

<?php } ?>

<?php echo stripslashes(html_entity_decode($banners4->description, ENT_QUOTES));?></p>

<a href="#puertorico" class="scr_sl btt lv ">Explore <?php echo stripslashes(html_entity_decode($banners4->title, ENT_QUOTES));?> &#9654;</a> </div>

</div>

</div>

</div><!-- SCREEN 6 END -->

<?php 

$banners5=front_banner(5);

$path_partsIntro6 = @pathinfo("library/upload/".$banners5->background);

$sliderImgScreen6 = @pathinfo("library/upload/".$banners5->image);?>

<div class="screen" id="screen-8" data-video="<?php echo base_url()."library/upload/".$path_partsIntro6['filename'];?>"> 

<img class="big-image lazy" src="<?php echo base_url()."library/upload/".$sliderImgScreen6['basename'];?>" width="100%" style="margin-right:20px;" border="0" align="left">

<div>

<div class="span_4 col"> &nbsp; </div>

<div class="span_4 col  spn_4_wd">

<div class="body tex_wid">

<h2 class="main_head"><?php echo stripslashes(html_entity_decode($banners5->title, ENT_QUOTES));?></h2>

<p>

<?php if($banners5->image<>''){?>

<img class="flg lazy" src="<?php echo base_url()."library/upload/".$banners5->image;?>" width="200" height="120" style="margin-right:20px;" border="0" align="left">

<?php } ?>

<?php echo stripslashes(html_entity_decode($banners5->description, ENT_QUOTES));?></p>

<a href="#trinidadandtobago" class="scr_sl btt ylo">Explore <?php echo stripslashes(html_entity_decode($banners5->title, ENT_QUOTES));?> &#9654;</a> </div>

</div>

</div>

</div><!-- SCREEN 7 END --> 

<!-- SCREEN 8 START -->

<?php

$banners8=front_banner(8);



 $sliderImgScreen8 = pathinfo("library/upload/".$banners8->image);?>

<div class="screen" id="screen-9"> 

<img class="big-image lazy" src="<?php echo base_url()."library/upload/".$sliderImgScreen8['basename'];?>" width="100%" style="margin-right:20px;" border="0" align="left">

<div>

<div>

<div class="col span_12" style="margin-bottom:20px; margin-top:20px; margin-left:0px;z-index:1000;">

<div style="margin:0 auto">

<section class="sear_cont">

<form class="search" onSubmit="Search()">

<input type="search" name="q" id="search" placeholder="Search..." autocomplete="off">

<input type="hidden" id="outfocus">

<ul class="search-ac"><li><a>No profile found</a></li></ul>

</form>

<a href="#" style="margin:0px; padding:0px; display:inline;"><img src="<?php base_url()?>library/Island_Peeps_files/search.png" class="icon_ser lazy" onClick="Search()"></a> </section>

<?php if($polls->dapoll == '1'){ // IN WALL MODE

$dispaly = "none"; ?>

<!-- search result-->

<?php } ?>

</div>

</div><!-- code --> 

</div>

</div><!--code end -->

<?php

if($polls->dapoll != '1'){ // IN POLL MODE

$dispaly = "block";?>

<div style="width:100%;display:block;position:absolute;">

<div class="col span_8 stats sts_plu" style="margin-left:0px; margin-top: 85px; margin-right:0px;"> 

<!-- search result-->

<div id="hideDiv" class="sear_detail_list" style="padding:0;display:none; overflow:hidden; margin-left:0px !important;height:95%;"> </div>

<!--End search result-->

<div  style="margin-right:0px; text-align:center; border-radius:10px;">

<p id="os_set_2152436" class="questionsPollsDiv" style="width:350px;display:inline-block; margin-right: 65px; vertical-align:top; text-align:center" align="center"></p>

<p id="os_set_2152445" class="questionsPollsDiv" style="width:350px;display:inline-block; vertical-align:top; text-align:center" align="center"></p>

</div>

</div>

<!-- col span_8 stats sts_plu ENDS -->

<div class="col span_3 span3-res" style="top:4%">

<div class="scoialfeed" >

<div id="social-stream" class="tewww twt_im" style="display:<?php echo $dispaly;?>"></div>

</div>

</div>

<!-- single window social feeds ends --> 

</div>

<!-- span_12 ends -->

<?php }else{ $dispaly = "none";?>

<div class="col span_12 stats" style="margin-left:2%;margin-right:0px;margin-top:0px; position: absolute; !important;height:50%;">

<iframe id='iframe' style="position:relative; top:17%; left:0px; bottom:0px; right:0px; width:100%; height:150%; border:none; margin:0; padding:0; overflow:hidden;z-index:0;" ></iframe>

<div id="searchResultHolder" style="width:100%;display:none;position:absolute;">

<div class="col span_8 stats sts_plu" style="margin-left:0px; margin-top: 85px; margin-right:0px;"> 

<!-- search result-->

<div id="hideDiv" class="sear_detail_list" style="padding:0;display:none; overflow:hidden; margin-left:0px !important;height:95%;"> </div>

<!--End search result-->

</div>

<!-- col span_8 stats sts_plu ENDS -->

<div class="col span_3 span3-res" style="top:4%">

<div class="scoialfeed" >

<div id="social-stream" class="tewww twt_im" style="display:<?php echo $dispaly;?>"  ></div>

</div>

</div>

<!-- single window social feeds ends --> 

</div>

<!-- span_12 ends -->

</div>

<?php }?>

</div><!-- SCREEN 8 END --> 

</div><!-- VIDEO-WRAPPER END --> 

<!-- NAVIGATION AND MENU SECTION START -->

<nav id="previous-btn" class="screen-btn"> <a href="#" class="previous-icon screen-icon"></a> </nav>

<nav id="next-btn" class="screen-btn"> <a href="#" class="next-icon screen-icon"></a> </nav>

<nav id="screen-menu" class="menu">

<ul role="navigation">

<li class="menu-tab selected"> <a role="tab" class="intro menu-logo" href="#"></a> </li>

<li class="menu-tab"> <a role="tab" class="about menu-link">About</a> </li>

<li class="menu-tab"> <a role="tab" class="suggestion menu-link">Suggestion</a> </li>

<li class="menu-tab"> <a role="tab" class="map menu-link">Map</a> </li>

<li class="menu-tab"> <a role="tab" class="ats menu-link" href="#haiti">The Arts</a> </li>

<li class="menu-tab"> <a role="tab" class="cps menu-link" href="#jamaica">Camp Services</a> </li>

<li class="menu-tab"> <a role="tab" class="perspectives menu-link" href="#puertorico">Perspectives</a> </li>

<li class="menu-tab"> <a role="tab" class="profiles menu-link" href="#trinidadandtobago">Profiles</a> </li>

<li class="menu-tab"> <a role="tab" class="diaspora menu-link" href="#diaspora">Diaspora</a> </li>

</ul>

</nav>

<!-- NAVIGATION AND MENU SECTION END --> 

</div>

<!-- MAIN_CATO END --> 

<!-- ANOTHER MENU START -->

<nav id="top-menu" class="menu" >

<ul role="navigation">

<li class="menu-tab"> <a role="tab" class="intro menu-logo2 menu-logo scr_sl gotop" href="#main_cato"></a> </li>

<li class="menu-tab"> <a role="tab" class="clf menu-link scroll-link1" href="#dominicanrepublic">Camp Life</a> </li>

<li class="menu-tab"> <a role="tab" class="ats menu-link scroll-link1" href="#haiti">The Arts</a> </li>

<li class="menu-tab"> <a role="tab" class="cps menu-link scroll-link1" href="#jamaica">Camp Services</a> </li>

<li class="menu-tab"> <a role="tab" class="perspectives menu-link scroll-link1" href="#puertorico">Perspectives</a> </li>

<li class="menu-tab"> <a role="tab" class="profiles menu-link scroll-link1" href="#trinidadandtobago">Profiles</a> </li>

<li class="menu-tab"> <a role="tab" class="diaspora menu-link scr_sl statsLink" href="#diaspora">Diaspora</a> </li>

<li class="menu-button"> <a role="tab" href="#memegallery" id="memeb" class="cta ir donate menu-link scr_sl">Donate</a> </li>

</ul>

</nav>

<!-- ANOTHER MENU END --> 

<!--#################### RECENTLY ADDED SECTION START ############################ -->

<div class="category clf container ah_lin" style="padding-bottom:5%;" data-category="primary-camp-life">

<h2 style="margin-top:5%; margin-right:5%; float:right;" class="heading">Recently Added</h2>

<div class="row thumbs1 clearfix">

<?php 

   $rowRecentAdded= get_prfiles_status();



//$rowRecentAdded = $objDatabase->dbQuery("Select * FROM ".TBL_PROFILES." where status='4' order by postdate desc limit 12");

foreach($rowRecentAdded as $profileRow)

{

$youtubeURl = $profileRow->video;

if(!empty($youtubeURl))

{

  

parse_str( parse_url( $youtubeURl, PHP_URL_QUERY ), $my_array_of_vars );

$youtubeCode = $my_array_of_vars['v'];

}else

{

  $youtubeCode ="1iBm60uJXvs";

}  

$profileImage =  $profileRow->image;

//$regOb = $objDatabase->fetchRows("Select * FROM ".TBL_REGIONS." where status=1 and id in (".$profileRow->region_id.")");

 $regOb =  get_Regions_with_in($profileRow->region_id);

$regionName = $regOb[0]->region_name;

//$rowRecentreg = $objDatabase->dbQuery("Select * FROM ".TBL_REGIONS." where status=1 and id in (".$profileRow->region_id.") limit 6");

  $rowRecentreg = get_Regions_with_in_limit($profileRow->region_id);



$regimg = '';

if(!empty($rowRecentreg))

{

foreach($rowRecentreg as $profileregRow){

$regimg.='<li> <img src="'.base_url().'library/upload/'.$profileregRow["ragion_map"].'"  class="sm_image lazy"><p>'.ucfirst($profileregRow["region_name"]).'</p> </li>';

 }

}

?>

<div class="col span_3" style="position: relative;">

<?php if($profileImage=='' && $youtubeCode<>'') {?>

<a id="rec<?php echo $profileRow->id?>" data-profileid="<?php echo $profileRow->id?>" data-postid="<?php echo removeUnsed($regionName);?>" data-youtubeid="<?php echo $youtubeCode;?>" data-title="<?php echo stripslashes(html_entity_decode($profileRow->title, ENT_QUOTES));?>" data-body="<?php echo stripslashes(html_entity_decode($profileRow->twittershortdesc, ENT_QUOTES));?>" href="#<?php echo removeUnsed($regionName);?>-profile" title="<?php echo $profileRow->title;?>" class="post-thumb-video <?php echo removeUnsed($regionName);?>1 videoclick"><img src="http://i.ytimg.com/vi/<?php echo $youtubeCode;?>/0.jpg" alt="<?php echo $profileRow->title;?>" class="post-img lazy"></a>

<?php } else { 

  // recentllyAddedClick  

    ?>

<a id="rec<?php echo $profileRow->id?>" data-profileid="<?php echo $profileRow->id?>" data-kind="<?php echo removeUnsed($profileRow->kind);?>" data-postid="<?php echo removeUnsed($regionName);?>" href="#<?php echo removeUnsed($regionName);?>-profile" data-title="<?php echo stripslashes(html_entity_decode($profileRow->title, ENT_QUOTES));?>" data-proid="<?php echo $profileRow->id;?>" data-body="<?php echo stripslashes(html_entity_decode($profileRow->twittershortdesc, ENT_QUOTES));?>" data-image="<?php  echo base_url().'library/upload/'.$profileImage;?>" title="<?php echo html_entity_decode($profileRow->title, ENT_QUOTES);?>"  class="post-thumb-video <?php echo removeUnsed($regionName);?>  recimg" data-selector="<?php echo removeUnsed($regionName).'_'.$profileRow->id; ?>"><?php if(!empty($profileImage)){?><img src="<?php echo base_url().'library/upload/'.$profileImage;?>" width="100%" class="post-img lazy"><?php }else{?><img src="<?php echo base_url().'library/images/blankImg.jpg';?>" width="100%" class="post-img lazy"><?php }?>

<div class="shwrg">

<ul class="photo_place_icon">

<?php echo $regimg;?>

</ul>

<?php

if($profileRow->kind=="Fun facts")

{

?>

 <h1 class="photo_name_white hoverfunfacts">-<?php echo html_entity_decode($profileRow->kind, ENT_QUOTES);?>-</h1>

<?php

}

?>

<h1 class="photo_name_white"><?php echo html_entity_decode($profileRow->title, ENT_QUOTES);?></h1>



<h1 class="photo_name_white prodesc"><?php echo html_entity_decode(stripslashes($profileRow->shortdesc), ENT_QUOTES);?></h1>



</div>

</a>

<?php } ?>

</div>

<?php }?>

</div>

<div style="width:100%; float:left; margin-top:5%;" class="gray-bar"> </div>

</div>

<!--#################### RECENTLY ADDED SECTION END ############################## --> 

<!--################### COUNTRY AND PROFILE SECTION START ######################### -->

<?php //$rowRegions = $objDatabase->dbQuery("Select * FROM ".TBL_REGIONS." where status='1'  order by region_name asc ");



  $rowRegions =  getRegions_status();

$intAlternate=0;

foreach($rowRegions as $regionObject){

$intAlternate++; ?>

<?php 

//$bigAd = $objDatabase->fetchRows("Select * FROM ".TBL_ADS." where type='1' and FIND_IN_SET (".$regionObject->id.", regions) order by rand() limit 1");

 $bigAd = get_ads($regionObject->id);

if(!empty($bigAd)){

        $ext = substr($bigAd->image, strrpos($bigAd->image, '.') + 1);

        if($ext=="mp4"){?>

        <?php }else

        {?>

        <?php }

        }else{

                $adBackground = get_ads(7);//$objFunctions->iFind(TBL_ADS, 'image', array('id'=>7));

                $imgData = base64_encode(file_get_contents(base_url().'library/upload/'.$adBackground->image));

                $src= base_url().'library/upload/'.$adBackground->image;



?>

<?php

//$smalladRs = $objDatabase->fetchRows("Select * FROM ".TBL_ADS." where type='2' and id<>7 and FIND_IN_SET (".$regionObject->id.", regions) order by rand() limit 1");

  $smalladRs = get_ads_with_type($regionObject->id);

if($smalladRs<>''){?>

<?php }}?>

<?php if($intAlternate > '1'){?>

<div data-id="<?php echo $regionObject->id?>" data-cnt="<?php echo $intAlternate;?>" id="<?php echo removeUnsed($regionObject->region_name);?>" class="row aftrlod header gradient clearfix category reg_part">

<p style="text-align:center;"><img src="images/loading.gif" alt="loading..."><br>

<?php echo stripslashes(html_entity_decode($regionObject->region_name, ENT_QUOTES));?></p>

</div>

<?php }else{?>

<div id="<?php echo removeUnsed($regionObject->region_name);?>" class="row header gradient clearfix category reg_part">

<?php 

$firstDisqusId = $disqusRegionIdPrefix.$regionObject->id;

$firstDisqusUrl = $disqusRegionUrlPrefix.'#!'.removeUnsed($regionObject->region_name);

$clsSpan8 ='style="float:right"';

$clsSpan4 ='style="float:left; padding-left:4%;"';

if($intAlternate%2==0){

$clsSpan8 ='style="float:left"';

$clsSpan4 ='style="float:right"';}

$flagContent = (array)json_decode(html_entity_decode($regionObject->flag_desc, ENT_QUOTES,'UTF-8'));

$popContent = (array)json_decode(html_entity_decode($regionObject->population, ENT_QUOTES,'UTF-8'));

?>

<div class="cta_fe fitvid col span_8" <?php echo $clsSpan8;?>>

<div class="video_wr">

<div class="island_image conn_im" <?php echo $clsSpan4;?>> <img src="<?php echo base_url().'library/upload/'.$regionObject->image;?>" width="100%" border="0" class="lazy"> </div>

<div class="my_flag thumbs" <?php echo $clsSpan8;?>> <a class="ptv" title="" href="javascript: void(0);"  data-title="" data-postid=""> <img class="lazy post-img" alt="" src="<?php echo base_url().'library/upload/'.$regionObject->flag;?>" style="width:100%"> <span class="ctr_detail">

<?php if($flagContent['motto']<>'') echo 'Motto: '.stripslashes(html_entity_decode($flagContent['motto'], ENT_QUOTES)).' <br />';?>

<?php if($flagContent['anthem']<>'') echo 'Anthem: '.stripslashes(html_entity_decode($flagContent['anthem'], ENT_QUOTES)).' <br />';?>

<?php if($flagContent['national_dish']<>'') echo 'National Dish: '.stripslashes(html_entity_decode($flagContent['national_dish'], ENT_QUOTES));?>

</span></a>

<?php $COAbgColor = current($flagBGColor);?>

<ul class="statGrid clearfix">

<li class="twist">

<div class="statItem">

<div class="statInfo" style=" background:<?php echo $COAbgColor?>;">

<h3>

<?php if($popContent['capital']<>'') echo 'Capital: '.$popContent['capital'].'<br />';?>

<?php if($popContent['language']<>'') echo 'Language: '.$popContent['language'].'<br />';?>

<?php if($popContent['population']<>'') echo 'Population: '.$popContent['population'];?>

</h3>

<p><?php echo nl2br($popContent['flag_shortdesc']);?></p>

</div>

<div class="coloredcircle st_ap stat-1">

<div class="logoimage" style="background:url('<?php echo  base_url().'library/upload/'.$regionObject->cover_image;?>') center no-repeat;background-size:200px 200px;"> </div>

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

<?php $de = mb_detect_encoding($regionObject->description, "UTF-8,ISO-8859-1");

$de = iconv($de, "UTF-8", $regionObject->description);?>

<div class="body"><?php echo stripslashes($de);?></div>

<section id="container">

<div id="menu-wrap">

<div class="menu-item"> <span id="active" class="icon fa fa-facebook"></span>

<a id="hover" class="text share_fb"  href="javascript:void(0);" onclick="fbSub('<?php echo htmlentities(stripslashes($regionObject->region_name));?>','<?php echo htmlentities(stripslashes($regionObject->description));?>','<?php echo SITE_GETUPLOADPATH.$regionObject->image; ?>','','<?php echo BASE_URL."#".removeUnsed($regionObject->region_name);?>');"><i class="fa fa-facebook"></i></a>

</div>

<?php

$len = strlen(BASE_URL.'#'.removeUnsed($regionObject->region_name));

$len = 140 - ($len+1);

?>

<div class="menu-item"> <span id="active" class="icon fa fa-twitter"></span> <a id="hover" class="text" target="_blank" href="http://twitter.com/share?text=<?php echo urlencode(substr(stripslashes($de),0,$len));?>&amp;url=<?php echo urlencode(BASE_URL.'#'.removeUnsed($regionObject->region_name));?>&hashtags=<?php echo "island_peeps";?>"><i class="fa fa-twitter"></i></a> </div>

<!-- Menu Item -->

<div class="menu-item"> <span id="active" class="icon fa fa-pinterest-square"></span> <a id="hover" class="text share_pinte" target="_blank" href="http://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(BASE_URL.'#'.removeUnsed($regionObject->region_name));?>&media=<?php echo SITE_GETUPLOADPATH.$regionObject->image; ?>&description=<?php echo urlencode(substr(stripslashes($regionObject->description),0,200));?>"><i class="fa fa-pinterest-square"></i></a> </div>

<!-- Menu Item -->

<div class="menu-item"> <span id="active" class="icon fa fa-tumblr"></span> <a id="hover" class="text share_tumblr" target="_blank" href="http://www.tumblr.com/share/photo?source=<?php echo SITE_GETUPLOADPATH.$regionObject->image; ?>&caption=<?php echo urlencode(stripslashes($regionObject->description)); ?>&click_thru=<?php echo urlencode(BASE_URL.'#'.removeUnsed($regionObject->region_name));?>"><i class="fa fa-tumblr"></i></a></div>

<!-- Menu Item --> 

</div>

<!-- Menu Wrap --> 

<div class="disqus-btn">

<button onclick="reset('<?php echo $disqusRegionIdPrefix.$regionObject->id?>', '<?php echo $disqusRegionUrlPrefix."#!".removeUnsed($regionObject->region_name);?>', '<?php echo $disqusRegionTitlePrefix.htmlentities(stripslashes($regionObject->region_name));?>', 'region_<?php echo $regionObject->id;?>');"></button>



<?php /*<a href="javascript:void(0)" onclick="reset('<?php echo $disqusRegionIdPrefix.$regionObject->id?>', '<?php echo $disqusRegionUrlPrefix."#!".$objFunctions->removeUnsed($regionObject->region_name);?>', '<?php echo $disqusRegionTitlePrefix.htmlentities(stripslashes($regionObject->region_name));?>', 'region_<?php echo $regionObject->id;?>');"><img src="<?php echo BASE_URL;?>show-thumbpj.php?src=images/disqus-btn.png&w=99&h=32" class="lazy"/></a> */ ?>

</div>

<div class="clear"></div>

</section>

<div id="region_<?php echo $regionObject->id;?>"><div id="disqus_thread"></div></div>

</div>

</div>

<div style="width:100%; float:left;" class="ah_lin"> </div>

<?php 

  // text/css

  // application/x-css

//$resProfiles = $objDatabase->dbQuery("SELECT * from ".TBL_PROFILES." where FIND_IN_SET (".$regionObject->id.", region_id) and status='4' and kind != 'Me Me'");

  $resProfiles =  get_profiles_status_not_kind($regionObject->id);

//$arrProfiles = $objDatabase->fetchRows("SELECT * from ".TBL_PROFILES." where  FIND_IN_SET (".$regionObject->id.", region_id) and status='4'");

  $arrProfiles =   get_profiles_status_with($regionObject->id);

$regionName =  $regionObject->region_name;

$iprofileCount=0; 

if(!empty($arrProfiles)){

$iprofileCount++;

$youtubeURl = $arrProfiles->video;

parse_str( parse_url( $youtubeURl, PHP_URL_QUERY ), $my_array_of_vars );

if(!empty($my_array_of_vars))

{

$youtubeCode = $my_array_of_vars['v'];   

}else

{

    $youtubeCode ='';

}

$profileImage =  $arrProfiles->image;?>

<div id="<?php echo removeUnsed($regionName);?>-profile"  data-category="primary-<?php echo removeUnsed($regionName);?>" class="category <?php echo removeUnsed($regionName);?> container ah_lin">

<div class="row header gradient clearfix">

<div class="cta_fe fitvid col span_8">

<div class="video_wr regionsection" id="<?php echo removeUnsed($regionName);?>-player">

<?php if($profileImage=='' && $youtubeCode<>'') {?>

<iframe frameborder="0" src="http://www.youtube.com/embed/<?php echo $youtubeCode;?>?enablejsapi=1&amp;showinfo=0&amp;theme=light&amp;rel=0&amp;modestbranding=1&amp;autohide=1&amp;color=white" allowfullscreen="" type="text/html" ></iframe>

<?php } else { $IDstring = str_replace(' ', '', stripslashes($arrProfiles->title));?>

<img class="lazy" src="<?php echo base_url().'library/upload/'.$profileImage;?>" width="90%" id="<?php echo $IDstring;?>">

<?php } ?>

</div>

</div>

<div class="category-intro col span_4">

<h2 class="heading"><?php echo $regionName;?></h2>

<?php

if($arrProfiles->kind=="Fun facts")

{

?>

<h4 class="heading funfacts">-<?php echo $arrProfiles->kind;?>-</h4> 

<?php

}

?>

<h3 class="fp_head" id="innerheading-<?php echo removeUnsed($regionName);?>"><?php echo stripslashes(html_entity_decode($arrProfiles->title, ENT_QUOTES));?></h3>

<?php 

if(!empty($arrProfiles->twittershortdesc))

{

$desNew = mb_detect_encoding($arrProfiles->twittershortdesc, "UTF-8,ISO-8859-1");

$desNew = iconv($desNew, "UTF-8", $arrProfiles->twittershortdesc);

}else

{

 $desNew ="";   

}

?>

<div class="body"  id="innerbody-<?php echo removeUnsed($regionName);?>"><?php echo stripslashes($desNew);?></div>

<section id="container">

<div id="menu-wrap">

<div class="menu-item"> <span class="icon fa fa-facebook" id="active"></span>

<a href="javascript:void(0);" onclick="fbSub('<?php echo htmlentities(stripslashes($arrProfiles->title));?>','<?php  if(!empty($desNew)){ echo (htmlentities($arrProfiles->description));}else{ echo "";}?>','<?php echo SITE_GETUPLOADPATH.$profileImage;?>','<?php echo htmlentities(stripslashes($regionName));?>','<?php echo BASE_URL."#".removeUnsed($regionName);?>');" class="text" id="hover" hidefocus="true" style="outline: medium none;"><i class="fa fa-facebook"></i></a>

</div>

<?php

$len = strlen(BASE_URL.'#'.removeUnsed($regionName));

$len = 140 - ($len+1);

?>

<div class="menu-item"> <span class="icon fa fa-twitter" id="active"></span> <a href="http://twitter.com/share?text=<?php if(!empty($arrProfiles->twittershortdesc))

{echo urlencode(substr(stripslashes($desNew),0,$len)); }else { echo ""; }?>&amp;url=<?php echo urlencode(BASE_URL."#".removeUnsed($regionName));?>&hashtags=<?php echo "island_peeps";?>" target="_blank" class="text" id="hover" hidefocus="true" style="outline: medium none;"><i class="fa fa-twitter"></i></a> </div>

<div class="menu-item"> <span class="icon fa fa-pinterest-square" id="active"></span> <a href="http://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(BASE_URL."#".removeUnsed($regionName).'-profile');?>&description=<?php echo urlencode(stripslashes($arrProfiles->description));?>&media=<?php echo SITE_GETUPLOADPATH.$profileImage;?>" target="_blank" class="text" id="hover" hidefocus="true" style="outline: medium none;"><i class="fa fa-pinterest-square"></i></a> </div>          

<div class="menu-item"> <span class="icon fa fa-tumblr" id="active"></span> <a href="http://www.tumblr.com/share/photo?source=<?php echo SITE_GETUPLOADPATH.$profileImage;?>&caption=<?php echo stripslashes(htmlentities($arrProfiles->description));?>&click_thru=<?php echo urlencode(BASE_URL."#".removeUnsed($regionName).'-profile');?>" target="_blank" class="text" id="hover" hidefocus="true" style="outline: medium none;"><i class="fa fa-tumblr"></i></a> </div>

</div>

<div class="disqus-btn">

<button onclick="reset('<?php echo $disqusIdPrefix.$arrProfiles->id;?>', '<?php echo $disqusUrlPrefix."#!".removeUnsed($regionName)."-profile".$arrProfiles->id;?>', '<?php echo $disqusTitlePrefix.htmlentities(stripslashes($arrProfiles->title));?>', 'persone_<?php echo $arrProfiles->id;?>');"></button>



<?php /*<a href="javascript:void(0)" onclick="reset('<?php echo $disqusIdPrefix.$arrProfiles->id?>', '<?php echo $disqusUrlPrefix."#!".$objFunctions->removeUnsed($regionName)."-profile";?>', '<?php echo $disqusTitlePrefix.htmlentities(stripslashes($arrProfiles->title));?>', 'persone_<?php echo $arrProfiles->id;?>');"><img src="<?php echo BASE_URL;?>show-thumbpj.php?src=images/disqus-btn.png&w=99&h=32" class="lazy"/></a> */ ?>

</div>

<div class="clear"></div>

</section>

<div id="persone_<?php echo $arrProfiles->id;?>"></div>

</div>

</div>

</div>

<?php $regimg = '<li> <img class="sm_image lazy" src="'.base_url().'library/upload/'.$regionObject->ragion_map.'"><p>'.ucfirst($regionName).'</p></li>';?>

<div class="row thumbs1 clearfix">

<?php 

foreach($resProfiles as $profileRow){

$youtubeURl = $profileRow->video;

parse_str( parse_url( $youtubeURl, PHP_URL_QUERY ), $my_array_of_vars );

if(!empty($my_array_of_vars))

{

$youtubeCode = $my_array_of_vars['v'];  

}else

{

    $youtubeCode='';

}

$profileImage =  $profileRow->image;?>

<div class="col span_3">

<?php if($profileImage=='' && $youtubeCode<>'') {?>

<a data-postid="<?php echo removeUnsed($regionName);?>" data-youtubeid="<?php echo $youtubeCode;?>" data-title="<?php echo stripslashes(html_entity_decode($profileRow->title, ENT_QUOTES));?>" data-proid="<?php echo $profileRow->id;?>" data-prourl="<?php echo str_replace(' ', '', stripslashes(html_entity_decode($profileRow->title, ENT_QUOTES)));?>" data-disqus-identifier="disqussion-<?php echo $profileRow->id;?>" data-body="<?php echo stripslashes(html_entity_decode($profileRow->description, ENT_QUOTES));?>" href="javascript: void(0);" title="<?php echo stripslashes(html_entity_decode($profileRow->title, ENT_QUOTES));?>" class="post-thumb-video <?php echo removeUnsed($regionName);?> videoclick"><img src="http://i.ytimg.com/vi/<?php echo $youtubeCode;?>/0.jpg" alt="<?php echo $profileRow->title;?>"  class="post-img"></a>

<?php } else {?>

<a data-kind="<?php echo removeUnsed($profileRow->kind);?>" data-postid="<?php echo removeUnsed($regionName);?>" href="javascript: void(0);" data-title="<?php echo stripslashes(html_entity_decode($profileRow->title, ENT_QUOTES));?>" data-disqus-identifier="disqussion-<?php echo $profileRow->id;?>" data-proid="<?php echo $profileRow->id;?>" data-prourl="<?php echo str_replace(' ', '', stripslashes(html_entity_decode($profileRow->title, ENT_QUOTES)));?>" data-body="<?php echo stripslashes(html_entity_decode($profileRow->description, ENT_QUOTES));?>" data-image="<?php echo base_url().'library/upload/'.$profileImage;?>" title="<?php echo stripslashes(html_entity_decode($profileRow->title, ENT_QUOTES));?>"  class="post-thumb-video <?php echo removeUnsed($regionName);?> imageclick recimg"><img src="<?php echo  base_url().'library/upload/'.$profileImage;?>" width="100%" class="lazy post-img">

<div class="shwrg">

<ul class="photo_place_icon">

<?php echo $regimg;?>

</ul>

<?php

if($profileRow->kind=="Fun facts")

{

?>

 <h1 class="photo_name_white hoverfunfacts"><?php echo html_entity_decode($profileRow->kind, ENT_QUOTES);?></h1>

<?php

}

?>

<h1 class="photo_name_white"><?php echo html_entity_decode($profileRow->title, ENT_QUOTES);?></h1>

<h1 class="photo_name_white prodesc"><?php echo html_entity_decode(stripslashes($profileRow->shortdesc), ENT_QUOTES);?></h1>

</div></a>

<?php  } ?>

</div>

<?php }?>

</div>

</div>

<?php }?><?php } ?><?php } ?>

<!--################### COUNTRY AND PROFILE SECTION END ########################### -->

<div class="" id="memegallery"><?php include("memePage.php");?></div>

<!-- END MEMEGALLERY DIV HERE-->

<footer class="clearfix"> <img src="<?php echo base_url().'library/'?>Island_Peeps_files/logo_footer.png" width="300" height="118" class="footer-logo lazy" alt=""> <small>©2014 Island Peeps. All rights reserved </small> </footer>

<?php 



if($polls->dapoll != '1'){ ?>

<script>//(function () {var opst = document.createElement('script');var os_host = document.location.protocol == "https:" ? "https:" : "http:";opst.type = 'text/javascript';opst.async = true;opst.src = os_host + '//' + 'www.opinionstage.com/sets/2152436/embed.js';(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(opst);}());

(function () {var opst = document.createElement('script');var os_host = document.location.protocol == "https:" ? "https:" : "http:";opst.type = 'text/javascript';opst.async = true;opst.src = os_host + '//' + 'www.opinionstage.com/sets/2152445/embed.js';(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(opst);}());

</script>

<?php }?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<!--############################ Discuss Comment Script Start ################################### -->

<script type="text/javascript">

function moveDisqusDiv(personeId){

$( "#disqus_thread" ).remove();

document.getElementById(personeId).innerHTML = "<div id='disqus_thread'></div>";

return true;

}

/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */

var disqus_shortname = 'islandpeeps2015'; //

var disqus_identifier = '<?php echo $firstDisqusId;?>';

var disqus_url = '<?php echo $firstDisqusUrl;?>';

var disqus_config = function () {

this.language = "en";

};

/* * * DON'T EDIT BELOW THIS LINE * * */

(function() {

var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;

dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';

(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);

})();





/* * * Disqus Reset Function * * */

var reset = function (newIdentifier, newUrl, newTitle, personeId) {

if(moveDisqusDiv(personeId)){

DISQUS.reset({

config: function () 

	{

		this.page.identifier = newIdentifier;

		this.page.url = newUrl;

		this.page.title = newTitle;

		this.language = 'en';

	},

	reload: true

});

} // if close

};

</script>

<!-- Discuss Comment Script End -->

<script src="<?php echo base_url().'library/';?>js/jquery.lazyload.js"></script>

<script type="text/javascript">$(function() {$("img.lazy").lazyload();});</script>

<!-- PARALLAX EFFECT & BG VIDEOS SCRIPT -- START -->

<script src="<?php echo base_url().'library/';?>js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>

<script src="<?php echo base_url().'library/';?>js/videobackground-new.js"></script>

<script type="text/javascript" src="<?php echo base_url().'library/';?>js/js-parallax/jquery.parallax-1.1.3.js"></script>

<script type="text/javascript" src="<?php echo base_url().'library/';?>js/js-parallax/jquery.localscroll-1.2.7-min.js"></script>

<script type="text/javascript" src="<?php echo base_url().'library/';?>js/js-parallax/jquery.scrollTo-1.4.2-min.js"></script>

<script type="text/javascript">

function isFullyVisible(elem){var docViewTop = $(window).scrollTop();var docViewBottom = docViewTop + $(window).height();var elemTop = $(elem).offset().top;var elemBottom = elemTop + $(elem).height();return ( (elemBottom >= docViewTop) && (elemTop <= docViewBottom) );}

$(window).scroll(function() {$('.StretchtoFit').each(function(){

if(isFullyVisible(this)) {this.play();} else {this.pause();}});

});

$(window).scroll(function() {

$('.vjs-tech').each(function() {

if(isFullyVisible(this)) {this.play();} else {this.pause();}

});

});

$('.StretchtoFit').on('play', function () {

$('video').not($(this).get(0)).each(function () {

$(this).get(0).pause();

});

});

</script>

<!-- PARALLAX EFFECT & BG VIDEOS SCRIPT -- END -->

<script src="<?php echo SITE_JSURL;?>validation.js"></script>

<script src="<?php echo base_url().'library/';?>js/easyResponsiveTabs.js"></script>

<!--Plug-in Initialisation-->

<script type="text/javascript">

$(document).ready(function() { //Vertical Tab

$('#parentVerticalTab').easyResponsiveTabs({type: 'vertical', //Types: default, vertical, accordion

width: 'auto', //auto or any width like 600px

fit: true, // 100% fit in a container

closed: 'accordion', // Start closed if in accordion view

tabidentify: 'hor_1' // The tab groups identifie

});

});

</script>

<!-- Script Polls COntions Start -->

<?php 

$polls->dapoll=0;



if($polls->dapoll != '1'){?>

<script src="<?php echo base_url().'library/';?>social-stream-New/js/jquery.social.stream.1.5.7.js"></script>

<script type="text/javascript">

$(document).ready(function(){

var resulth = Math.round(screen.height - ( $("#screen-menu").height() + $("#top-menu").height() + (( 17 / 100) * screen.height) ));

$('#social-stream').dcSocialStream({

feeds: {

	twitter: {id: '<?php echo $twitter->twitterid;?>',thumb: true,retweets: <?php echo $twitter->retweets;?>,replies: <?php echo $twitter->replies;?>,},

	rss: {id: '<?php echo $rss->rssid;?>',out: '<?php echo implode(",",$rss->out);?>',text: '<?php  $rss->text;?>',},

	stumbleupon: {id: '<?php echo $stumbleupon->stumbleuponid;?>',out: '<?php echo implode(",",$stumbleupon->out);?>',feed: '<?php echo implode(",",$stumbleupon->feed);?>',},

	facebook: {id: '<?php echo trim($facebook->fbid);?>',out: '<?php echo implode(",",$facebook->out);?>',text: '<?php  $facebook->text;?>',comments: '<?php echo $facebook->comments;?>',},

	google: {id: '<?php echo $google->googleid;?>',api_key: '<?php echo $google->apikey;?>',out : '<?php echo implode(",",$google->out);?>',shares : <?php echo $google->shares;?>},

	delicious: {id: '<?php echo $delicious->deliciousid;?>',out: '<?php echo implode(",",$delicious->out);?>',},

	vimeo: {id: '<?php echo $vimeo->vimeoid;?>',out: '<?php echo implode(",",$vimeo->out);?>',feed: '<?php echo implode(",",$vimeo->feed);?>',},

	youtube: {id: '<?php echo $youtube->youtubeid;?>',out: '<?php echo implode(",",$youtube->out);?>',feed: '<?php echo implode(",",$youtube->feed);?>',},

	pinterest: {id: '<?php echo $pinterest->pinterestid;?>',out: '<?php echo implode(",",$pinterest->out);?>',},

	flickr: {id: '<?php echo $flickr->flickrid;?>',out: '<?php echo implode(",",$flickr->out);?>',},

	lastfm: {id: '<?php echo $lastfm->lastfmid;?>',out: '<?php echo implode(",",$lastfm->out);?>',feed: '<?php echo implode(",",$lastfm->feed);?>',},

	dribbble: {id: '<?php echo $dribbble->dribbbleid;?>',out: '<?php echo implode(",",$dribbble->out);?>',feed: '<?php echo implode(",",$dribbble->feed);?>',},

	tumblr: {id: '<?php echo $tumblr->tumblrid;?>',thumb: 250,out: '<?php echo implode(",",$tumblr->out);?>',},

	deviantart: {id: '<?php echo $deviantart->deviantartid;?>',out: '<?php echo implode(",",$deviantart->out);?>',},

	instagram: {id: '<?php echo $instagram->instagramid;?>',accessToken: '<?php echo $instagram->accessToken;?>',redirectUrl: 'http://islandpeeps.com',clientId: '<?php echo $instagram->clientId;?>',comments: '<?php echo $instagram->comments;?>',likes: '<?php echo $instagram->like;?>'},

	},

twitterId: 'Island_Peeps',

height: resulth,

limit : <?php echo trim($socialLimit);?>,

days: <?php echo trim($socialDays);?>,

max: 'limit',

order: '<?php echo trim($socialFolder);?>',

speed: <?php echo trim($socialSpeed);?>,

iconPath: 'images/dcsns-dark/',

imagePath: 'images/dcsns-dark-1/'

});

});

</script> <?php } ?> <!-- Script Polls Conditions End -->

<!-- Way Points Js Include Script -->

<script src="<?php echo base_url().'library/';?>js/waypoints.js"></script>

<script>

function ChangeUrl(url) {

    if (typeof (history.pushState) != "undefined") {

      

       history.pushState('', url, url);

    // window.history.replaceState('', '', "/bar.html");

     //location.hash = "parameter1=DEF&parameter2=XYZ";

    } else {

        alert("Browser does not support HTML5.");

    }

}



function getUrlVars(){

    /*

var vars = [];

vars = window.location.href.split('#');



if(vars.length == 2 && vars[1]!='main_cato'){

var regid = '#'+vars[1];

$('html,body').animate({scrollTop: $(regid).offset().top},'fast');



showregion(regid);

} 

  */

  

  var vars = '<?php echo $sulg;?>';



//if(vars !="" && vars !='main_cato'){

var regid = '#'+vars;

showregion_tmp(regid);

$('html,body').animate({scrollTop: $(regid).offset().top},100);

  

}

function showregion_tmp(regionid){

var rid = $(regionid).attr('data-id');

var rcnt = $(regionid).attr('data-cnt');

//alert(rid);

if( !( rid === undefined ) ) {

    

    //alert(regionid);

     $( regionid ).addClass("getmargin");

$( regionid ).load( "<?php echo base_url();?>home/getregions?id="+rid+"&sno="+rcnt, function() {});

/*

  $.ajax({

                    

                   // dataType: 'JSON',

                   // type: 'POST',

                    cache: false,

                    url:  "<?php echo base_url();?>home/getregions?id="+rid+"&sno="+rcnt,

                    success: function(data){

                    $(regionid).html(data);		 

                     return false;

                    }

                    });     



   */





}

}





$( window ).load(function() {

  // Run code

  getUrlVars();

});







</script>

<script type="text/javascript">

function showprofile(str)

{

    alert(str);

}

$(document).ready(function () { //setTimeout(function(){

 var time = 1000;

function showregion(regionid,getprofileid){

var rid = $(regionid).attr('data-id');

var rcnt = $(regionid).attr('data-cnt');
 getprofileid = typeof getprofileid !== 'undefined' ? getprofileid : '0';
//alert(rid);

//alert(regionid);

if( !( rid === undefined ) ) {

    

    

 

$( regionid ).load( "<?php echo base_url();?>home/getregions?id="+rid+"&sno="+rcnt+"&profileid="+getprofileid, function() {});

}

}

function showregionForSearch(regionid,selector,getprofileid){ //alert("Testing");

var rid = $(regionid).attr('data-id');

var rcnt = $(regionid).attr('data-cnt');

var getregion = $(regionid).attr('data-postid');
getprofileid = typeof getprofileid !== 'undefined' ? getprofileid : '0';

$( regionid ).load( "<?php echo base_url();?>home/getregions?id="+rid+"&sno="+rcnt+"&profileid="+getprofileid,function(responseTxt,statusTxt,xhr){

/*

if(statusTxt=="success"){

  // alert(selector);

moveToSearchedProfile(selector);

}

if(statusTxt=="error")

{

console.log("Error: "+xhr.status+": "+xhr.statusText);

}  */

});

ChangeUrl(getregion); 

moveToSearchedProfile(selector);

}



$('#memeb').click(function() { 

$.waypoints('disable');

setTimeout(function(){

$.waypoints('enable');

}, 500);

});

$('.statsLink').click(function(){$('html,body').animate({scrollTop: $('#screen-9').offset().top},'fast'); 

$( "#screen-menu .diaspora" ).trigger( "click" );

});

$('.gotop').click(function() { 

return false;

});

$('.scroll-link1').click(function() { 

var loadid = $(this).attr('href');



showregion(loadid);

$.waypoints('disable');

setTimeout(function(){

$.waypoints('enable');

}, 500);

});

/* --- search result click ------*/

$(".searchResultClick").live("click",function(){

var loadid = $(this).attr('data-postid'); //data-postid

var selector = $(this).attr('data-selector');

var getpro = $(this).attr('data-proid');



if(loadid != 'anguilla'){

showregionForSearch('#'+loadid,'.'+selector,getpro);    //  OLD CODE

// change



}else{  

    moveToSearchedProfile('.'+selector);

 

// change



}





$.waypoints('disable');

setTimeout(function(){

$.waypoints('enable');

}, 500);





}); /*--- search result click ------*/

/*--------- recentlly added -------*/

$(".recentllyAddedClick").click(function(){

var loadid = $(this).attr('data-postid'); //data-postid

var selector = $(this).attr('data-selector');

var getpro = $(this).attr('data-proid');

if(loadid != 'anguilla'){

showregionForSearch('#'+loadid,'.'+selector,getpro);

}else{  moveToSearchedProfile('.'+selector);}

$.waypoints('disable');

setTimeout(function(){

$.waypoints('enable');

}, 500);

});









/*-------- recentlly added*/

$("body").on("click",".recimg",function(){

var data = $(this).attr('href');

var sthis = this;

var arr = data.split('-');

var getprofile=$(this).attr('data-profileid');

//alert($(this).attr('data-profileid'));

//alert(arr); data-profileid

//$('html,body').animate({scrollTop: $(arr[0]).offset().top},'fast'); 

//alert("Test");

showregion(arr[0],getprofile);



$.waypoints('disable');

setTimeout(function(){

//$.waypoints('enable');

//alert(sthis);

movetoprofile(sthis);



}, 1500);

return false;

});

$.fn.waypoint.defaults = {context: window,continuous: false,enabled: false,horizontal: false,offset: 0,triggerOnce: true}



//$(window).load(function() {

$('.aftrlod').each(function() {

$( "#"+this.id ).waypoint(function(direction) {

var getdivid ="#"+this.id;

//alert(divid);

var divid =this.id;

//alert(divid);

 //var urlvars = '<?php echo $sulg;?>';

 

//if(divid ===urlvars)

//{

ChangeUrl(divid);

//}

//window.location.href =window.location.href+this.id;



// $("body").removeClass("getmargin");

//alert("change url");

showregion(getdivid);

}, { triggerOnce: true,offset: '80%'

}).waypoint(function(direction) {

if (direction === 'up') { var divid ="#"+this.id; 

var getdivid =this.id;

ChangeUrl(getdivid);



showregion(divid);

}

}, {offset: '0%'

});

});



setTimeout(function(){

$.waypoints('enable');

}, 1500);	

//}); 

});

/* 

$(window).load(function() {

    var urlvars = '<?php echo $sulg;?>';

if(urlvars !="")

{ alert(urlvars);

ChangeUrl(urlvars);

}

});

*/



$(document).ready(function(){ 

intervalInstance =  setInterval( function(){

$('#info .info.map_details_con ul.datali font').each(function(){ 

$(this).contents().unwrap();

});

}, 1);

/*---- for search result only -------*/

intervalInstance =  setInterval( function(){

$('#chartBoxDiv font').each(function(){ 

$(this).contents().unwrap();

});

}, 0.5);

});

</script> <!-- Way Points Script End -->

<!-- Extra Js Files Include -->

<script src="<?php echo base_url().'library/';?>Island_Peeps_files/combined.js"></script>

<script id="www-widgetapi-script" src="<?php echo base_url().'library/';?>Island_Peeps_files/www-widgetapi-vflMcN_Rn.js" async></script>

<script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script src="<?php echo base_url().'library/';?>js/chosen.jquery.min.js" type="text/javascript"></script>

<script src="<?php echo base_url().'library/';?>magicsuggest.js"></script>

<script src="<?php echo base_url().'library/';?>js/libs/modernizr.min.js"></script>

<script src="<?php echo base_url().'library/';?>js/libs/bootstrap.min.js"></script>

<script src="<?php echo base_url().'library/';?>js/general.js"></script>

<!--<script type="text/javascript" src="js/jquery.powerful-placeholder.min.js"></script> -->

<!-- Am Script Start -->

<script src="<?php echo base_url().'library/';?>js/amcharts/amcharts.js" type="text/javascript"></script>

<script src="<?php echo base_url().'library/';?>js/amcharts/pie.js" type="text/javascript"></script>

<script src="<?php echo base_url().'library/';?>js/amcharts/serial.js" type="text/javascript"></script>

<script type="text/javascript">

function drawpie1(data){data = $.parseJSON(data);var chart;var legend;var chartData = data;

// PIE CHART

chart = new AmCharts.AmPieChart();

chart.addTitle('ETHNIC DISTRIBUTION',11,'#fff',0.8,false);

chart.dataProvider = chartData;

chart.titleField = "group";

chart.valueField = "value";

chart.outlineColor = "";

chart.outlineAlpha = 0.8;

chart.outlineThickness = 2;

// this makes the chart 3D

chart.depth3D = 10;chart.angle = 30;chart.labelText = "";

chart.balloonText = "[[title]]: [[value]]% ";

legend = new AmCharts.AmLegend();

legend.markerType = "circle";

legend.markerSize = "0";

legend.fontSize = "10";

legend.valueText = "";

legend.useMarkerColorForLabels = true;

chart.addLegend(legend);

// WRITE

chart.write("chart3");

/*});*/ }

function drawline1(data){

var chart;data = $.parseJSON(data);var chartData = data;

// SERIAL CHART

var  chart = new AmCharts.AmSerialChart();

chart.addTitle('PROFILE CATEGORIES',11,'#fff',0.8,false);

chart.dataProvider = chartData;

chart.categoryField = "group";

chart.startDuration = 1;

chart.autoMarginOffset = 2;

// the following two lines makes chart 3D

chart.depth3D = 20;chart.angle = 30;

// AXES

// category

var categoryAxis = chart.categoryAxis;categoryAxis.labelRotation = 90;categoryAxis.fontSize = "10";categoryAxis.gridThickness = 0;categoryAxis.gridPosition = "start";categoryAxis.color = "#fff";categoryAxis.axisAlpha = 0;categoryAxis.autoGridCount  = false;categoryAxis.gridCount = chartData.length;

// value

var valueAxis = new AmCharts.ValueAxis();valueAxis.title = "";valueAxis.dashLength = 5;valueAxis.fontSize = 9;valueAxis.color = "#fff";valueAxis.axisAlpha = 0;chart.addValueAxis(valueAxis);

// GRAPH

var graph = new AmCharts.AmGraph();graph.valueField = "value";graph.colorField = "color";graph.balloonText = "<span style='font-size:14px'>[[group]]: <b>[[value]]</b></span>";graph.type = "column";graph.lineAlpha = 0;graph.fillAlphas = 1; chart.addGraph(graph);

// CURSOR

var chartCursor = new AmCharts.ChartCursor();chartCursor.cursorAlpha = 0;chartCursor.zoomable = false;chartCursor.categoryBalloonEnabled = false;chart.addChartCursor(chartCursor);

//   chart.creditsPosition = "top-right";

var balloon = chart.balloon;

// set properties

balloon.borderAlpha = 0;

// WRITE

chart.write("chart2");

}

</script><!-- Am Script End -->

<!--<script type="text/javascript" src="retina.js"></script> --><!--<script src="js/nicEdit.js"></script> -->

<script src='<?php echo base_url() ?>library/js/mapbox.js'></script>



<script class="include" type="text/javascript" src="<?php echo base_url() ?>library/js/jquery.jqplot.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>library/js/jqplot.canvasTextRenderer.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>library/js/jqplot.canvasAxisTickRenderer.min.js"></script>

<script class="include" type="text/javascript" src="<?php echo base_url() ?>library/js/jqplot.barRenderer.min.js"></script>

<script class="include" type="text/javascript" src="<?php echo base_url() ?>library/js/jqplot.categoryAxisRenderer.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>library/js/jqplot.pieRenderer.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>library/js/jqplot.donutRenderer.min.js"></script>

<!-- End of Extra Js -->

<!-- Translate Script Start -->

<script> 

function googleTranslateElementInit(lang) {

new google.translate.TranslateElement({pageLanguage: lang,includedLanguages : 'en,es'}, 'showlang');

$('.goog-logo-link').css('display', 'none');

$('.goog-te-gadget').css('font-size', '0');

$(".goog-te-combo").attr('id','languge_stop');

}

googleTranslateElementInit();

</script>

<!-- Translate Script End -->

<!-- Script Ajax Start -->

<script type="text/javascript">

$(document).ready(function() {var searchTest = '';$('#contact-name').chosen({ width: "100%" });$('#commentForm .link-reset').click(function(e){$("#contact-name").trigger("chosen:updated");});

$flag = 0;

$('#search').keypress(function(e){

var searchTextInt = trim($(this).val());

var keyPress = e.which;

if(keyPress != 13){st(searchTextInt);$(".search-ac").hide();}

});

});

function st(searchVal){

if((searchVal.length > 2)){

if($flag == 0){$flag = 1;

$.ajax({url: "<?php echo $eventsurl;?>",data: {'event':'getprofile','value':searchVal},type: "POST",success: function(json){var searchTest = $('#search').val();

if(json !='' && json != 0){

var data  = JSON.parse(json); 

var dataf = data[0]; 

$flag = 0;

}else{

$flag = 0;

var dataf = '<li><a>No profile found</a></li>';  	

}	

$('.search-ac').html(dataf);

$(".search-ac").show();

var p = e.which;

//alert(p);

if(p==13){$flag = 0;$(".search-ac").hide();}

}

});

}

} // if close 

}

</script>

<!-- Script Ajax End -->

<!-- Custom Script Start -->

<script>

$(document).ready(function(){

$('.recimg').mouseenter(function() {

$(this).find('.shwrg').show();

})

.mouseleave(function() {

$(this).find('.shwrg').hide();

});

});

/*$(document).ready(function() {

if($("[placeholder]").size() > 0) {$.Placeholder.init();}

});*/

</script>

<script type="text/javascript" id="myscript" >

$(document).ready(function() {		

$( "#search" ).focusout(function(e) {

$(".search-ac").hide();

});

});

function Search(){

$(".search-ac").css('display','none');

var data = $('#search').val();



if(data!=''){

$(".search-ac").hide();

$('#hideDiv').html('<p style="text-align:center;"><img src="<?php echo base_url();?>images/progress.gif" height="24" width="24" alt="loading..."/></p>');

$(".search-ac").css('display','none');

$("#hideDiv").show();

$.ajax({url: "<?php echo $eventsurl;?>",data: {'event':'getfullprofile','value':data} ,type: "POST",success: function(json) {  if(json !='' && json != 0){

var data  = JSON.parse(json); 

var JsonData= JSON.stringify(data[0]);

var dataf = data[1];

var resultCount = data[2]; 

}else{ var dataf = '<div class="sear_details" style="text-align:center;"><a>No profile found</a></div>';}

$('#hideDiv').html('<p>'+resultCount+' Result Found</p><img src="<?php echo base_url();?>library/Island_Peeps_files/close_popup.jpg" id="clsdiv" alt="close" style="float:right;display:block;cursor: pointer; width: 1.5%;"><div class="span_12" style="height:100%;" id="searchResultShowBox"><div class="span_12" id="chartBoxDiv" style="height:40%;float: left;"></div><div class="span_12" style="float: left;" id="countryVTab">'+dataf+'</div></div>');

<?php if($polls->dapoll != '1'){ ?>

$('.questionsPollsDiv').css('display','none');

<?php }else{ ?>

$('#iframe').css('display','none');

$('#searchResultHolder').css('display','block');

$('#social-stream').css('display','block');

$(".search-ac").css('display','none');

<?php }?>

drawscrline(JsonData);

var minHeight = $('#countryVTab ul').outerHeight( true );

$('.resp-tab-content').css('height',minHeight+'px');

$("#hideDiv").show();

$(".search-ac").css('display','none');

}

});

loadAllRegion();

}

}

$(document).ready(function(){	

$("body").on("click",".imagesclick",function(){

var imgurl = $(this).attr("data-image");

$("#sinnerheading").html($(this).attr('data-title'));

$("#sinnerbody").html($(this).attr('data-body'));

var url ='<img src="'+imgurl+'" border="0" class="lazy">';

$("#splayer").html(url);  

$("#hideDiv").show();  

// $('html,body').animate({scrollTop: $('#'+postid+'-profile').offset().top},'fast'); 

});		 

$("body").on("click","#clsdiv",function(){

<?php if($polls->dapoll != '1'){ ?>

$('.questionsPollsDiv').css('display','inline-block');

<?php } else{

?>

$('#iframe').css('display','block');

$('#searchResultHolder').css('display','none');

$('#social-stream').css('display','none');

<?php }?>

$("#hideDiv").hide(); 

});

$(".search").submit(function (event) {return false;});

//$("#iframe").attr("src", 'socialwall.php');

});

</script>

<script class="code" type="text/javascript">

function drawscrline(catdata){

json = JSON.parse(catdata);

//			AmCharts.ready(function() {

    // SERIAL CHART

chart = new AmCharts.AmSerialChart();

chart.dataProvider = json;chart.categoryField = "country";chart.marginRight = 0;chart.marginTop = 0; 

//chart.autoMarginOffset = 0;

// the following two lines makes chart 3D

chart.depth3D = 20;chart.angle = 30;

// AXES // category

var categoryAxis = chart.categoryAxis;categoryAxis.labelRotation = 90;categoryAxis.gridPosition = "start";categoryAxis.inside = true;categoryAxis.gridCount = json.length;categoryAxis.autoGridCount = false;

// value

var valueAxis = new AmCharts.ValueAxis();valueAxis.title = "Result";chart.addValueAxis(valueAxis);

// GRAPH            

var graph = new AmCharts.AmGraph();graph.valueField = "visits";graph.colorField = "color";graph.balloonText = "[[category]]: [[value]]";graph.type = "column";graph.lineAlpha = 0;graph.fillAlphas = 1;chart.addGraph(graph);

// WRITE

chart.write("chartBoxDiv");

//});

$(".search-ac").css('display','none');

}	

</script>

<script>

var info = document.getElementById('info');

var map = L.mapbox.map('map', 'derrickstuds.imab7m7e').setView([15, -74], 5);

makemap(map);

function makemap(map){

var myLayer = L.mapbox.featureLayer().addTo(map);

var geoJson = [{type: 'Feature',

geometry: {type: 'Point',coordinates: [-77.387695,15.284185 ]},

properties: {title: 'Bermuda','change' : '7','lat' : '32.307800','long': '-64.750500',"icon": {"iconUrl": "<?php echo SITE_IMAGEURL;?>bermuda.png","iconSize": [63, 42],"iconAnchor": [50, 50],"popupAnchor": [0, -55],"className": "dot",}

}

},{

type: 'Feature',

geometry: {type: 'Point',coordinates: [-77.629394,12.033948 ]},

properties: {title: 'Hawaii','change' : '7','lat' : '19.896766','long': '-155.582782',"icon": {"iconUrl": "<?php echo SITE_IMAGEURL;?>hawaii.png","iconSize": [63, 42],"iconAnchor": [50, 50],"popupAnchor": [0, -55],"className": "dot",}}},<?php echo $regiondata;?>];

myLayer.setGeoJSON(geoJson);

// Set a custom icon on each marker based on feature properties.

myLayer.on('layeradd', function(e) {

var marker = e.layer,feature = marker.feature;marker.setIcon(L.icon(feature.properties.icon));});

myLayer.on('mouseover', function(e) {

//e.layer.openPopup();

e.layer.closePopup();

var feature = e.layer.feature;

if(feature.properties.change){}else{

var content = '<div class="info map_details_con"><ul class="deta_map"><li><strong>Name : <span style="color:#206BEF;">' + feature.properties.title + '<span></strong><li><li><strong>Capital</strong> : ' + stripslashes(feature.properties.capital) + '</li><li><strong>Population</strong> : ' + feature.properties.population + '</li><li><strong>National Dish</strong> : ' + feature.properties.national_dish + '</li><li>' + feature.properties.description + '</li></ul><ul class="deta_map datali"></span><li id="chart2" style="width:100%; height:190px;"></li><li id="chart3" style="height:190px; width:100%;"></li> </ul></div>';

info.innerHTML = content;

//drawbar(feature.properties.chartid ,feature.properties.chartcount ,feature.properties.chartcategory);

drawline1(feature.properties.chartcategory);

if(feature.properties.piedata){

drawpie1(feature.properties.piedata);

//drawpie(feature.properties.piedata);

}}

});

myLayer.on('click', function(e) { 

e.layer.closePopup();e.layer.unbindPopup();var feature = e.layer.feature;

if(feature.properties.change){

window.map.remove();//<<Here comes the magic!

window.map = L.mapbox.map('map', 'derrickstuds.imab7m7e').setView([feature.properties.lat , feature.properties.long], 7);

makemap(window.map);

return false;   

}

$('html, body').animate({scrollTop: $(e.layer.feature.properties.url).offset().top}, 2000);});

myLayer.on('mouseout', function(e) {// e.layer.closePopup();

});

// Clear the tooltip when map is clicked.

map.on('move', empty);

map.on('click', empty);

// Trigger empty contents when the script

// has loaded on the page.

empty();

var geojson = { type: 'LineString', coordinates: [] };var geojson1 = { type: 'LineString', coordinates: [] };var start = [-77.387695,15.284185 ];var momentum = [1.2637195,1.7023615];var start1 =  [-77.629394,12.033948 ];var momentum1 = [7.7953388,0.7862818];

for (var i = 0; i < 11; i++) {

geojson.coordinates.push(start.slice());

geojson1.coordinates.push(start1.slice());

start[0] += momentum[0];

start[1] += momentum[1];

start1[0] -= momentum1[0];

start1[1] += momentum1[1];

}

// Add this generated geojson object to the map.

L.geoJson(geojson).addTo(map);L.geoJson(geojson1).addTo(map);

// Create a counter with a value of 0.

var j = 0;

// Create a marker and add it to the map.

var marker = L.marker([0, 0], {icon: L.mapbox.marker.icon({'marker-color': '#f86767'})}).addTo(map);

var marker2 = L.marker([0, 0], {icon: L.mapbox.marker.icon({'marker-color': '#f86767'})}).addTo(map);

setInterval(function() {j = 0;tick();}, 2000);

function tick() {

// Set the marker to be at the same point as one

// of the segments or the line.

marker.setLatLng(L.latLng(

geojson.coordinates[j][1],

geojson.coordinates[j][0]));

marker2.setLatLng(L.latLng(

geojson1.coordinates[j][1],

geojson1.coordinates[j][0]));

if (++j < geojson.coordinates.length) setTimeout(tick, 100);}

}

function empty() {info.innerHTML = '';}

$(document).on('click','#mapreset',function(e){

window.map.remove();

window.map = L.mapbox.map('map', 'derrickstuds.imab7m7e').setView([15, -74], 5);

makemap(window.map);

return false;

});

</script>

<script>

function moveToSearchedProfile(dataid){

var regionid = $(dataid).attr("data-regionid");

var profile_title = $(dataid).attr('data-title');

var imgurl = $(dataid).attr("data-image");

var postid = $(dataid).attr("data-postid");

var proid = $(dataid).attr("data-proid");

var des = $(dataid).attr('data-body');

/* DISQUS START*/

$("#"+postid+"-profile div[id^='persone_']").remove(); 

$( "#"+postid+"-profile section" ).after( $( "<div id='persone_"+proid+"'></div>" ) );

var identifier = '<?php echo $disqusIdPrefix;?>'+proid;

var disqusUrl = '<?php echo $disqusUrlPrefix.'#!';?>'+postid+'-profile'+proid;

var disqusTitle = '<?php echo $disqusTitlePrefix;?>'+profile_title;

var disqusDivId = 'persone_'+proid;

var onclickAttrVal = "reset('"+identifier+"','"+disqusUrl+"','"+disqusTitle+"','"+disqusDivId+"');";

$( "#"+postid+"-profile section button" ).attr("onclick",onclickAttrVal);

/* DISQUS END*/

/* FACEBOOK START */

var fbimgname = imgurl.substring(imgurl.lastIndexOf("upload/")+7,imgurl.lastIndexOf("&w"));

var fbimag = '<?php echo SITE_GETUPLOADPATH;?>'+fbimgname;

var fburl = '<?php echo BASE_URL;?>#'+postid;

var FBonclickAttrVal = "fbSub('"+profile_title+"','"+des+"','"+fbimag+"','','"+fburl+"');";

$( "#"+postid+"-profile section a.share_fb" ).attr("onclick",FBonclickAttrVal);

/*FACEBOOK END*/

/* TUMBLR START */

var tumblrimg='<?php echo SITE_GETUPLOADPATH;?>'+fbimgname;

var tumblrurl='<?php echo BASE_URL; ?>#'+postid;

desT = des.replace("&", "&amp;");

var tumblrAttrVal="http://www.tumblr.com/share/photo?source="+ tumblrimg+"&caption="+desT+"&click_thru="+tumblrurl ;   

$("#"+postid+"-profile section a.share_tumblr").attr("href",tumblrAttrVal);

/* TUMBLR END */

$("#innerheading-"+postid).html(profile_title);

$("#innerbody-"+postid).html($(dataid).attr('data-body'));

var url ='<img src="'+imgurl+'" border="0" class="lazy">';

$("#"+postid+"-player").html(url);

/* PINTEREST START*/

var pinterestimg='<?php echo SITE_GETUPLOADPATH;?>'+fbimgname;

var pinteresturl= '<?php echo urlencode(BASE_URL.'#'); ?>'+postid;

var pinterestAttrVal="http://www.pinterest.com/pin/create/button/?url="+ pinteresturl +"&media=" + pinterestimg + "&description="+ des; 

$("#"+postid+"-profile section a.share_pinte").attr("href",pinterestAttrVal); 

/* PINTEREST END */

/* twitter search START*/

var t_url= '<?php echo urlencode(BASE_URL.'#'); ?>'+postid;

desT = des.replace("&", "&amp;");

var res=desT.substr(0,128);

var t_taghash="island_peeps";

var t_AttrVal="https://twitter.com/intent/tweet?text="+res+"&hashtags="+t_taghash+"&url="+t_url;

$("#"+postid+"-profile section a.share_t").attr("href",t_AttrVal); 

/* twitter search END */



setTimeout(function(){

$('html,body').animate({scrollTop: $('#'+postid+'-profile').offset().top},'slow');

},1000);

return false;

}

$("body").on("click",".imageclick",function(){movetoprofile(this);});

function movetoprofile(dataid){

  // alert("movetoprofile");

var profile_title = $(dataid).attr('data-title');

var imgurl = $(dataid).attr("data-image");

var postid = $(dataid).attr("data-postid");

var getkind = $(dataid).attr("data-kind");

var proid = $(dataid).attr("data-proid");

//alert(proid);

var des = $(dataid).attr('data-body');

$("#"+postid+"-profile div[id^='persone_']").remove(); 

$( "#"+postid+"-profile section" ).after( $( "<div id='persone_"+proid+"'></div>" ) );

var identifier = '<?php echo $disqusIdPrefix;?>'+proid;

var disqusUrl = '<?php echo $disqusUrlPrefix.'#!';?>'+postid+'-profile'+proid;

var disqusTitle = '<?php echo $disqusTitlePrefix;?>'+profile_title;

var disqusDivId = 'persone_'+proid;

var onclickAttrVal = "reset('"+identifier+"','"+disqusUrl+"','"+disqusTitle+"','"+disqusDivId+"');";

$( "#"+postid+"-profile section button" ).attr("onclick",onclickAttrVal);

/* DISQUS END */

$("#innerheading-"+postid).html(profile_title);

$("#innerbody-"+postid).html($(dataid).attr('data-body'));

//alert(getkind);

if(getkind=="funfacts")

{

 //var showfunfacts='<h4 class="heading funfacts">-Fun facts-</h4>';

// $("#innerheading-"+postid).before(showfunfacts);

 

}

var url ='<img src="'+imgurl+'" border="0" class="lazy">';

$("#"+postid+"-player").html(url);





$('html,body').animate({scrollTop: $('#'+postid+'-player').offset().top-150},'slow');

/* FACEBOOK START */

var fbimgname = imgurl.substring(imgurl.lastIndexOf("upload/")+7,imgurl.lastIndexOf("&w"));

var fbimag = '<?php echo SITE_GETUPLOADPATH;?>'+fbimgname;

var fburl = '<?php echo BASE_URL;?>#'+postid;

var FBonclickAttrVal = "fbSub('"+profile_title+"','"+des+"','"+fbimag+"','','"+fburl+"');";

$( "#"+postid+"-profile section a.share_fb" ).attr("onclick",FBonclickAttrVal);

/*FACEBOOK END*/

/* PINTEREST START*/

var desNew = des.replace(/'/g, "\\'");

var pinterestimg='<?php echo SITE_GETUPLOADPATH;?>'+fbimgname;

var pinteresturl='<?php echo urlencode(BASE_URL.'#'); ?>'+postid;

var pinterestAttrVal="http://www.pinterest.com/pin/create/button/?url="+ pinteresturl +"&media=" + pinterestimg + "&description="+ desNew; 

$("#"+postid+"-profile section a.share_pinte").attr("href",pinterestAttrVal); 

/* PINTEREST END */

/* TUMBLR START */

var tumblrimg='<?php echo SITE_GETUPLOADPATH;?>'+fbimgname;

var tumblrurl='<?php echo BASE_URL; ?>#'+postid;

desT = des.replace("&", "&amp;");

var tumblrAttrVal="http://www.tumblr.com/share/photo?source="+ tumblrimg +"&caption="+ desT +"&click_thru="+tumblrurl;   

$("#"+postid+"-profile section a.share_tumblr").attr("href",tumblrAttrVal);

/* TUMBLR END */ 

//Twitter share script

var t_url='<?php echo urlencode(BASE_URL.'#'); ?>'+postid;

desT = des.replace("&amp;", "and");

desT = desT.replace("&#039;", "\'");

var res=desT.substr(0,128);

var t_taghash="island_peeps";

var t_AttrVal="https://twitter.com/intent/tweet?text="+res+"&hashtags="+t_taghash+"&url="+t_url;   

$("#"+postid+"-profile section a.share_t").attr("href",t_AttrVal);

// end Twitter share script

ChangeUrl(postid); // change

$.waypoints('enable');  // change

}

$(document).ready(function(){	

$("#commentForm").on("submit", function(e){

e.preventDefault();

var result = validateFrm(this);

if($("#atc").prop('checked') != true && result){

 $('#resdiv').html('<p style="color:red">Accept our terms & conditions</p>');

return false;

}

if(result){

$('#resdiv').html('<p><img src="images/progress.gif" height="24" width="24" alt="loading..."/></p>');

var formData = new FormData($(this)[0]);

$.ajax({url : '<?php echo base_url().'home/getprofile'?>',type: "POST",data : formData,async: false,cache: false,contentType: false,processData: false,success:function(data, textStatus, jqXHR){var data = JSON.parse(data);

//alert(data);

if(data[0]=='1')

var ptag='<p style="color:green">'+data[1]+'</p>';

else

var ptag='<p style="color:red">'+data[1]+'</p>';

$('#resdiv').html(ptag);

$('#commentForm')[0].reset(); 

}

});

}

return false;

});

});

$(document).ready(function(){

$("[rel^='prettyPhoto']").prettyPhoto({deeplinking: false,overlay_gallery: false,social_tools: false,'theme': 'light_square'});

$("div.reg_part").unveil(300);

});

</script>

<!-- Custom Script End -->

<!-- ################### PAGE JAVASCRIPT END ######################### -->

<script>

$(function() {

// Use Modernizr to detect for touch devices, 

// which don't support autoplay and may have less bandwidth, 

// so just give them the poster images instead

var screenIndex = 1,numScreens = $('.screen').length,isTransitioning = true,transitionDur = 1000,BV,videoPlayer=true,isTouch = Modernizr.touch,$bigImage = $('.big-image'),$window = $(window);if (!isTouch) {

// initialize BigVideo

BV = new $.BigVideo({forceAutoplay:isTouch});BV.init();showVideo();BV.getPlayer().addEvent('loadeddata', function() {onVideoLoaded();});

// adjust image positioning so it lines up with video

$bigImage.css('position','relative').imagesLoaded(adjustImagePositioning);

// and on window resize

$window.on('resize', adjustImagePositioning);

}

// Next button click goes to next div

$('#next-btn').on('click', function(e) {e.preventDefault();if (!isTransitioning) {next();}});

function showVideo() {BV.show($('#screen-'+screenIndex).attr('data-video'),{ambient:true});}

function next() {isTransitioning = true;

// update video index, reset image opacity if starting over

if (screenIndex === numScreens) {$bigImage.css('opacity',1);screenIndex = 1;} else {screenIndex++;}

if (!isTouch) {$('#big-video-wrap').transit({'left':'-100%'},transitionDur)}

(Modernizr.csstransitions)?

$('.video-wrapper').transit({'left':'-'+(100*(screenIndex-1))+'%'},transitionDur,onTransitionComplete):onTransitionComplete();

}

function onVideoLoaded() {$('#screen-'+screenIndex).find('.big-image').transit({'opacity':0},500)}

function onTransitionComplete() {isTransitioning = false;

if (!isTouch) {$('#big-video-wrap').css('left',0);showVideo();}

}

function adjustImagePositioning() {

$bigImage.each(function(){

var $img = $(this),img = new Image();img.src = $img.attr('src');

var windowWidth = $window.width(),windowHeight = $window.height(),

r_w = windowHeight / windowWidth,

i_w = img.width,

i_h = img.height,

r_i = i_h / i_w,

new_w, new_h, new_left, new_top;

if( r_w > r_i ) {new_h   = windowHeight;

new_w   = windowHeight / r_i;

}else {

new_h   = windowWidth * r_i;

new_w   = windowWidth;

}

$img.css({width   : new_w,

height  : new_h,

left    : ( windowWidth - new_w ) / 2,

top     : ( windowHeight - new_h ) / 2

})

});

}

});

</script>

<!-- ################### VIDEO SLIDER JAVASCRIPT END ######################### -->

</body></html>