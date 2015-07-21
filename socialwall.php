 <?php
//require_once( 'config/config.php' );
//$objRs = $objDatabase->fetchRows("SELECT * FROM tbl_socialfeeds  where id='1'");
$regOb = front_getsocialfeeds();
$twitter = json_decode($objRs->twitter);
$rss = json_decode($objRs->rss);
$facebook = json_decode($objRs->facebook);
$google = json_decode($objRs->google);
$instagram = json_decode($objRs->instagram);
$delicious = json_decode($objRs->delicious);
$vimeo = json_decode($objRs->vimeo);
$youtube = json_decode($objRs->youtube);
$pinterest = json_decode($objRs->pinterest);
$flickr = json_decode($objRs->flickr);
$dribbble = json_decode($objRs->dribbble);
$tumblr = json_decode($objRs->tumblr);
$stumbleupon = json_decode($objRs->stumbleupon);
$lastfm = json_decode($objRs->lastfm);
$deviantart = json_decode($objRs->deviantart);

//echo '<pre>';print_r($rss);exit;
 
?>
<html>
<head> 
<!-- <link rel="stylesheet" type="text/css" href="css/social-stream/dcsns_wall.css" media="all" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="js/social-stream/jquery.social.stream.wall.1.3.js"></script>
<script type="text/javascript" src="js/social-stream/jquery.social.stream.1.5.4.js"></script>
 -->

<link rel="stylesheet" type="text/css" href="social-stream-New/css/dcsns_wall.css" media="all" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="social-stream-New/js/jquery.social.stream.wall.1.5.js"></script>
<script type="text/javascript" src="social-stream-New/js/jquery.social.stream.1.5.7.js"></script>

<script type="text/javascript">
jQuery(document).ready(function($){
	$('#social-stream1').dcSocialStream({
		feeds: {
			twitter: {
				id: '<?php echo $twitter->twitterid;?>',
				thumb: true,
				out: '<?php echo implode(",",$twitter->out);?>',
				search: '<?php echo $twitter->search; ?>',
				retweets: <?php echo $twitter->retweets;?>,
				replies: <?php echo $twitter->replies;?>,
			},
			rss: {
				id: '<?php echo $rss->rssid;?>',
				out: '<?php echo implode(",",$rss->out);?>',
				text: '<?php echo $rss->text;?>',
			},
			stumbleupon: {
				id: '<?php echo $stumbleupon->stumbleuponid;?>',
				out: '<?php echo implode(",",$stumbleupon->out);?>',
				feed: '<?php echo implode(",",$stumbleupon->feed);?>',
			},
			facebook: {
				id: '<?php echo trim($facebook->fbid);?>',
				out: '<?php echo implode(",",$facebook->out);?>',
				text: '<?php  echo $facebook->text;?>',
				comments: '<?php echo $facebook->comments;?>',
				image_width: '<?php echo $facebook->image_width;?>',
			},
			google: {
				id: '<?php echo $google->googleid;?>',
				api_key: '<?php echo $google->apikey;?>',
				out : '<?php echo implode(",",$google->out);?>',
				shares : <?php echo $google->shares;?>
			},
			delicious: {
				id: '<?php echo $delicious->deliciousid;?>',
				out: '<?php echo implode(",",$delicious->out);?>',
			},
			vimeo: {
				id: '<?php echo $vimeo->vimeoid;?>',
				out: '<?php echo implode(",",$vimeo->out);?>',
				feed: '<?php echo implode(",",$vimeo->feed);?>',
			},
			youtube: {
				id: '<?php echo $youtube->youtubeid;?>',
				out: '<?php echo implode(",",$youtube->out);?>',
				feed: '<?php echo implode(",",$youtube->feed);?>',
			},
			pinterest: {
				id: '<?php echo $pinterest->pinterestid;?>',
				out: '<?php echo implode(",",$pinterest->out);?>',
			},
			flickr: {
				id: '<?php echo $flickr->flickrid;?>',
				out: '<?php echo implode(",",$flickr->out);?>',
			},
			lastfm: {
				id: '<?php echo $lastfm->lastfmid;?>',
				out: '<?php echo implode(",",$lastfm->out);?>',
				feed: '<?php echo implode(",",$lastfm->feed);?>',
			},
			dribbble: {
				id: '<?php echo $dribbble->dribbbleid;?>',
				out: '<?php echo implode(",",$dribbble->out);?>',
				feed: '<?php echo implode(",",$dribbble->feed);?>',
			},
			tumblr: {
				id: '<?php echo $tumblr->tumblrid;?>',
				thumb: 250,
				out: '<?php echo implode(",",$tumblr->out);?>',
			},
			deviantart: {
				id: '<?php echo $deviantart->deviantartid;?>',
				out: '<?php echo implode(",",$deviantart->out);?>',
			},
 
			instagram: {
				id: '<?php echo $instagram->instagramid;?>',
				accessToken: '<?php echo $instagram->accessToken;?>',
				redirectUrl: 'http://localhost/mani/islandpeeps',
				clientId: '<?php echo $instagram->clientId;?>',
				comments: '<?php echo $instagram->comments;?>',
				likes: '<?php echo $instagram->like;?>',
				out: '<?php echo implode(",",$instagram->out);?>',
			},
 
		},
		rotate: {
			direction: '<?php echo trim($objRs->rotate_direction);?>',
			delay: '<?php echo trim($objRs->rotate_direction);?>'
		},
		twitterId: '<?php echo trim($twitter->twitterid);?>',
		control: false,
		filter: <?php echo trim($objRs->filter);?>,
		wall: true,
		limit : <?php echo trim($objRs->limits);?>,
		days: <?php echo trim($objRs->days);?>,
		max: 'limit',
		order: '<?php echo trim($objRs->forder);?>',
		speed: <?php echo trim($objRs->speed);?>,
		height: '300',
	});/*HWD)$#k49eo*/ 
				 
});
</script>
<style>
#wall {padding: 10px 0 0;height:auto;}
</style>
</head>
<body>
<div id="wall">
	
<div id="social-stream1"></div>
<div class="clear"></div>

</div>
</body>
</html>
