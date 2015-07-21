<?php

/**
 * @author Prashant
 * @copyright 2015
 */

if($_POST)
{
   
    $strDirectory="upload/";
    $imagepath="imagepath/";
     $FileNameArray = pathinfo('upload/'.$_FILES["video"]['name']);
    move_uploaded_file($_FILES["video"]['tmp_name'],$strDirectory.$_FILES["video"]['name']);
      if($FileNameArray['extension']=='mp4' || 	$FileNameArray['extension']=='mov' || $FileNameArray['extension']=='dat')		  
			       mpeg2Mp4('upload/'.$_FILES["video"]['name'], $FileNameArray['filename']);
                   
       echo "<pre>";
    print_r($_FILES); exit;             
}

  function mpeg2Mp4($video_file, $convertName)
		{
			$ffmpegPath = "../usr/local/bin/ffmpeg";
			$flvtool2Path = "../usr/local/bin/flvtool2";
			
			$videoWebFile = "upload/".$convertName.".webm"; 
			$videoThumbFile = "upload/".$convertName.".jpg"; 
			$videoMp4File = "upload/".$convertName.".mp4"; 
			$videoFlv = "upload/".$convertName.".swf"; 
			
			if(!file_exists($videoMp4File))
			{
			  exec("$ffmpegPath -i $video_file -sameq -ar 22050  $videoMp4File");
			} 
			
			 exec("$ffmpegPath -i $video_file -an -r 4 -y -s 1024x768 $videoThumbFile");
			
			return $convertName;
		}	
echo $ffmpeg = exec('locate ffmpeg'); // or better yet:
$ffmpeg = trim(shell_exec('type -P ffmpeg'));
//echo phpinfo();


echo "<pre>";
   print_r($_SERVER);
   
   $path = '/usr';
   
   if(is_dir($path))
   {
     echo "Dir Exist is";
     $files1 = scandir($path);
        print_r($files1);
     unset($files1[0]);
     unset($files1[1]);
        
     foreach($files1 as $key => $value)
     {
       echo "************************".$value."**********************<br>"; 
       $files2 = scandir($path."/".$value);
        print_r($files2);
       echo "<br>"; 
        
     }   
        
   }else
   {
     echo "Not Exist";
   }
/*
$command = 'ffmpeg -version';
$path = '/usr/local/bin/ffmpeg';

exec($command, $path, $returncode);
echo $returncode;
if ($returncode == 127)
{
	echo 'ffmpeg is NOT available';
//	die();
}
else
{
	echo 'ffmpeg is available';
} */
?>

<form action="index.php" method="post" enctype="multipart/form-data">
<input type="file" name="video">
<input type="submit" name="submit" value="SUBMIT">
</form>