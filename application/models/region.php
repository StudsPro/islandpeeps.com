<?php
class region extends CI_Model 
{
  public function __construct()
	{
		$this->load->database();
		$this->load->helper('general_helper');
	}
 //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX Customer Module Start
  public function GetAllRegion()
	{
		//SELECT id, region_name, region_title, independenceday, description, flag, flag_desc, population, image, cover_image, longitude, latitude, ragion_map, status FROM tbl_regions WHERE 1
		$sql = $this->db->query("SELECT * FROM tbl_regions");
        return $sql->result_array();
	}
    
 public function changeRegionStatus()
 {
 	foreach($_POST['delete'] as $key => $value)
		{
			if($_POST['status']=="-1")
				{$sqlstr="delete from tbl_regions where id=".$value;}
			else
				{$sqlstr="update tbl_regions set status='".$_POST['status']."' where id=".$value;}
			$this->db->query($sqlstr);
		}
 }
 public function GetRegionById($id)
	{
	   $query = $this->db->query("SELECT id, region_name, region_title, independenceday, description, flag, flag_desc, population, image, cover_image, longitude, latitude, ragion_map, status FROM tbl_regions where id=".$id);
	   return $query->result_array();
	}
    
  public function addeditRegion($Data,$id)
	{
		$ragion_map="";
		$flag="";
	   $query = $this->db->query("select region_name from tbl_regions where id!=".$id." and region_name='".$Data['region_name']."'");
	   $RsCount=$query->result_array();
	   if(count($RsCount)==0)
       		{
			  
			  if($_FILES['db_flag']['name']<>"")
				{
				   $val=$_FILES['db_flag'];
				   $strDirectory = SITE_UPLOADPATH;
				   @chmod($strDirectory,0777);
				   $val['name'] = mktime().removeSpace($val['name']);
				   move_uploaded_file($val['tmp_name'],$strDirectory.$val['name']);
				   @chmod(	$strDirectory.$val['name'], 0644);		  
				   $FileNameArray = pathinfo('upload/'.$val['name']);
				  if($FileNameArray['extension']=='mp4' || 	$FileNameArray['extension']=='mov' || $FileNameArray['extension']=='dat')			  
				   $this->mpeg2Mp4('upload/'.$val['name'], $FileNameArray['filename']);
					if($arrSize[0]<>'')
				 	{ 
						foreach($arrSize as $tmpSize)
						{
							$thName= str_replace(":","_",$tmpSize);
							$tmpArr=explode(':',$tmpSize);
							$strFileName= $strDirectory.$thName.$val['name'];
						} 
					}
				 if($id>0)
					{$flag="flag='".$val['name']."',";}
				 else
					{$flag=$val['name'];}
				}

			  if($_FILES['db_ragion_map']['name']<>"")
				{
				   $val=$_FILES['db_ragion_map'];
				   $strDirectory = SITE_UPLOADPATH;
				   @chmod($strDirectory,0777);
				   $val['name'] = mktime().removeSpace($val['name']);
				   move_uploaded_file($val['tmp_name'],$strDirectory.$val['name']);
				   @chmod(	$strDirectory.$val['name'], 0644);		  
				   $FileNameArray = pathinfo('upload/'.$val['name']);
				  if($FileNameArray['extension']=='mp4' || 	$FileNameArray['extension']=='mov' || $FileNameArray['extension']=='dat')			  
				   $this->mpeg2Mp4('upload/'.$val['name'], $FileNameArray['filename']);
				if($arrSize[0]<>'')
				 { 
					foreach($arrSize as $tmpSize)
					{
						$thName= str_replace(":","_",$tmpSize);
						$tmpArr=explode(':',$tmpSize);
						$strFileName= $strDirectory.$thName.$val['name'];
						//$this->objThumb->create_thumbnail($strDirectory.$val['name'], $strFileName,$tmpArr[0],$tmpArr[1]);
					} 
				 }
				 if($id>0)//db_ragion_map
					{$ragion_map="ragion_map='".$val['name']."',";}
				 else
					{$ragion_map=$val['name'];}
				}	
					 
				if($id==0)//Insert
					{
					$sqlstr="Insert into tbl_regions (region_name, region_title, independenceday, description, flag, flag_desc, population, image, cover_image, longitude, latitude, ragion_map, status) values('".StriptStr($Data['region_name'])."','".StriptStr($Data['region_title'])."',
					'".StriptStr($Data['independenceday'])."','".StriptStr($Data['description'])."','".StriptStr($flag)."','".StriptStr($Data['flag_desc'])."','".StriptStr($Data['population'])."','".StriptStr($Data['image'])."','".StriptStr($Data['cover_image'])."','".StriptStr($Data['longitude'])."','".StriptStr($Data['latitude'])."','".$ragion_map."','1')";
					}
				else
					{$sqlstr="update tbl_regions set  
					region_name='".StriptStr($Data['region_title'])."', 
					region_title='".StriptStr($Data['region_title'])."', 
					independenceday='".StriptStr($Data['region_title'])."', 
					description='".StriptStr($Data['region_title'])."', 
					".$flag." flag_desc='".StriptStr($Data['region_title'])."', 
					population='".StriptStr($Data['region_title'])."', 
					image='".StriptStr($Data['region_title'])."', 
					cover_image='".StriptStr($Data['region_title'])."', 
					longitude='".StriptStr($Data['region_title'])."', 
					latitude='".StriptStr($Data['region_title'])."', 
					".$ragion_map." status='".$Data['status']."' where id=".$id;}
                    
                    $this->db->query($sqlstr);
                        return "ins";
			}
		else
			{return 0;}
	}
public function deleteRegion($id)
    {$this->db->query("delete from tbl_regions where id=".$id);}
	
private function mpeg2Mp4($video_file, $convertName)
		{
			$ffmpegPath = "/usr/local/bin/ffmpeg";
			$flvtool2Path = "/usr/local/bin/flvtool2";
			
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
 //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX Customer Module End 
}
?>