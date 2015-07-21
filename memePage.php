<div class="category clf container ah_lin" style="padding-bottom:5%;" data-category="secondary-camp-life">
  <h2 style="margin-top:5%; margin-left:5%; float:left;" class="heading">Me Me</h2>
  <div class="row thumbs1 clearfix">
    <?php 
//$rowRecentAdded = $objDatabase->dbQuery("Select * FROM ".TBL_PROFILES." where status='4' AND kind LIKE 'Me Me' order by postdate desc limit 12");
       $rowRecentAdded = get_profiles_status_with_kind();
       //echo "<pre>"; print_r($rowRecentAdded); echo "</pre>"; exit;
       
foreach($rowRecentAdded as $profileRow)
  {
	  $youtubeCode='';
     if(isset($profileRow->video) && $profileRow->video!='')
      {
         $youtubeURl = $profileRow->video;
         parse_str( parse_url( $youtubeURl, PHP_URL_QUERY ), $my_array_of_vars );
         $youtubeCode = $my_array_of_vars['v'];  /*  yFHjS6vuFI0 */
      } 
    
   
	$profileImage =  $profileRow->image;
	//$regOb = $objDatabase->fetchRows("Select * FROM ".TBL_REGIONS." where status=1 and id in (".$profileRow->region_id.")");
	$regOb = get_Regions_with_in_status($profileRow->region_id);
    
    $regionName = $regOb->region_name;
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
      <a id="meme<?php echo $profileRow->id?>" data-postid="<?php echo removeUnsed($regionName);?>" data-youtubeid="<?php echo $youtubeCode;?>" data-title="<?php echo htmlentities(stripslashes($profileRow->title));?>" data-body="<?php echo stripslashes($profileRow->description);?>" href="#<?php echo removeUnsed($regionName);?>-profile" title="<?php echo $profileRow->title;?>" class="post-thumb-video <?php echo removeUnsed($regionName);?>1 videoclick"><img src="http://i.ytimg.com/vi/<?php echo $youtubeCode;?>/0.jpg" alt="<?php echo $profileRow->title;?>" class="post-img"></a>
      <?php } else { ?>
      <a id="meme<?php echo $profileRow->id?>" data-postid="<?php echo removeUnsed($regionName);?>" href="#<?php echo removeUnsed($regionName);?>-profile" data-title="<?php echo htmlentities(stripslashes(htmlentities($profileRow->title)));?>" data-body="<?php echo stripslashes($profileRow->description);?>" data-image="show-thumb.php?file=<?php echo base_url().'library/upload/'.$profileImage;?>&w=800&h=800" title="<?php echo stripslashes($profileRow->title);?>"  class="post-thumb-video <?php echo removeUnsed($regionName);?> imageclick recimg">
     <!--<img src="<?php echo BASE_URL;?>show-thumbpj.php?src=<?php echo base_url().'library/upload/'.$profileImage;?>&w=300&h=250" width="100%" class="post-img">-->
      <img src="<?php echo base_url().'library/upload/'.$profileImage;?>" width="100%" class="post-img">
	<div class="shwrg">
        <ul class="photo_place_icon">
        <?php echo $regimg;?>
        </ul>
		<h1 class="photo_name_white"><?php echo stripslashes($profileRow->title);?></h1>
		</div>
	</a>
      <?php } ?>

	
    </div>
    <?php
   } 
  ?>
	</div>
  <div style="width:100%; float:left; margin-top:5%;" class="gray-bar"> </div>
</div>