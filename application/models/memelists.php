<?php
class Memelists extends CI_Model 
{
  public function __construct()
	{
		$this->load->database();
		$this->load->helper('general_helper');
	}
 //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX Customer Module Start
  public function GetAllMeme()
	{
		$sql = $this->db->query("SELECT * FROM tbl_meme");
        return $sql->result_array();
	}
    
 public function changeMemeStatus()
 {
 	foreach($_POST['delete'] as $key => $value)
		{
			if($_POST['status']=="-1")
				{$sqlstr="delete from tbl_meme where id=".$value;}
			else
				{$sqlstr="update tbl_meme set status='".$_POST['status']."' where id=".$value;}
			$this->db->query($sqlstr);
		}
 }
 public function GetMemeById($id)
	{
	   $query = $this->db->query("SELECT id, title, memefile, status FROM tbl_meme where id=".$id);
	   return $query->result_array();
	}
    
  public function addeditMeme($Data,$id)
	{
		$memefilename="";
	   $query = $this->db->query("select title from tbl_meme where id!=".$id." and title='".$Data['title']."'");
	   $RsCount=$query->result_array();
     
	   if(count($RsCount)==0)
       		{
			   
			  if($_FILES['db_memefile']['name']<>"")
						{
						   $val=$_FILES['db_memefile'];
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
						 if($id>0)
						 	{$memefilename="memefile='".$val['name']."',";}
						 else
						 	{$memefilename=$val['name'];}
						}	
					 
				if($id==0)//Insert
					{
					   $sqlstr="Insert into tbl_meme ( title, memefile, status) values('".StriptStr($Data['title'])."','".StriptStr($memefilename)."','1')";
                      
                       }
				else
					{$sqlstr="update tbl_meme set  title='".StriptStr($Data['title'])."', ".$memefilename." status='".$Data['status']."' where id=".$id;}
                    
                    $this->db->query($sqlstr);
                        return $id;
			}
		else
			{return 0;}
	}
public function deleteMeme($id)
    {$this->db->query("delete from tbl_meme where id=".$id);}
	
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
 
  public function deleterecords($ids)
   {
      foreach($ids as $key => $value)
      {
        
          $editdata=$this->GetMemeById($value);
            $getimagename=$editdata[0]["memefile"];
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
              
            }
        
        
            $this->deleteMeme($value);               
      }   
    
   }
   
    public function changestatus($ids,$status)
   {
      foreach($ids as $key => $value)
      {
            	$sqlstr="update tbl_meme set status='".$status."' where id=".$value;
			$this->db->query($sqlstr);      
      }   
    
   }  
}
?>