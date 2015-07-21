<?php
class Banners extends CI_Model 
{
  public function __construct()
	{
		$this->load->database();
		$this->load->helper('general_helper');
	}
 //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX Customer Module Start
  public function GetAllBanner()
	{
		$sql = $this->db->query("SELECT * FROM tbl_banner order by title asc");
        return $sql->result_array();
	}
    
 
 public function GetBannerById($id)
	{
	   $query = $this->db->query("SELECT id, title, description, sort_order, image, background, status,background_img FROM tbl_banner where id=".$id);
	   return $query->result_array();
	}
 public function updateimage($id,$fieldname)
    {
      $data=array($fieldname=>"");  
        $this->db->where('id', $id);
            $this->db->update('tbl_banner', $data);
     return true;     
    }
 public function addeditBanner($Data,$id)
	{
	
		if($id==0)
		{
			$fields ='title';
			$_POST['md_title'] = htmlentities($_POST['md_title'],ENT_QUOTES);
			$_POST['md_description'] = htmlentities($_POST['md_description'],ENT_QUOTES);
			if($_FILES['db_background']['name']<>'')
			{
				  $fileName = removeUnsed($_FILES['db_background']['name']);
				  move_uploaded_file($_FILES['db_background']['tmp_name'], UPLOAD_ROOT_PATH.$fileName);
				  $FileNameArray = pathinfo('upload/'.$fileName);
				  
				  mpeg2flv('upload/'.$fileName, $FileNameArray['filename']);
				  $_POST['db_background']= $fileName;
				  $fields .=', background';
				  //$fieldValues .=",'".htmlspecialchars($_POST['db_background'],ENT_QUOTES)."'";
				  $_POST['db_background'] = htmlentities($_POST['db_background'],ENT_QUOTES);
			}
		}
		else
		{
			if(isset($_POST['video_name'])) {$_POST['db_background'] = $_POST['video_name'];}
		}
		
	   $query = $this->db->query("select title from tbl_banner where id!=".$id." and title='".$Data['md_title']."'");
	   $RsCount=$query->result_array();
	   if(count($RsCount)==0)
       		{
				if($id==0)//Insert
					{
					   $this->insertFormContent();
					}
				else
					{ 
						$this->updateFormContent($id);
					}
                   
                        return $id;
			}
		else
			{return 0;}
	}
public function deleteBanner($id)
    {$this->db->query("delete from tbl_banner where id=".$id);}
	
private function insertFormContent()
		{
			$tmpTableName="tbl_banner";

			$arrKey = array();
			$arrValue = array();
			$arrTblFields = array();
			$strMessage = '';			
			
			$arrTblFields=array('id', 'title', 'description', 'sort_order', 'image', 'background', 'status');
			
			foreach($_POST as $key => $value)
			{
				if((substr($key, 0, 3) == 'db_' || substr($key, 0, 3) == 'md_') && in_array(substr($key, 3),$arrTblFields) )
				{				
				   if( substr($key, 0, 3) == 'md_')
				   {
				    	if(trim($value)=="")
				        $strMessage= '<li>Required fields can not be left blank</li>';
				   }				
					$strKeyTmp = substr($key, 3);
					$arrKey[] = $strKeyTmp;
					$arrValue[] = "'".trim($value)."'";
				}
			}
			//print_r($arrValue);
			foreach($_FILES as $key=>$val) // Loop for the images/files
			{ 				
				if($val['name']<>"")
 				{
				   $strDirectory = SITE_UPLOADPATH;
				   @chmod($strDirectory,0777);
				   $val['name'] = mktime().$this->removeSpace($val['name']);				   
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
   				  	if((stripos($key, "db_")!==false || stripos($key, "md_")!==false)  && in_array(substr($key, 3),$arrTblFields) )
	 				{
						 $arrKey[]=substr($key,3);
						 $arrValue[] ="'".$val['name']."'";
	 			    } 
  		        }				
			}				
			foreach($arrKey as $val) {$Keyarr[]="`".$val."`";}			
			$strKey = implode(', ', $arrKey);
			//echo "<br>";
			$strValue = implode(', ', $arrValue);
			//	echo "<br>";die;
			if( $strMessage=='')
			{
				$strQuery = "INSERT INTO ".$tmpTableName." (".$strKey.") VALUES (".$strValue.")";
				$this->db->query($sqlstr);
				return 1;
			}	
			else
			{return 0;}
			//die($strQuery);
			//exit;		
		}
		
private function updateFormContent($tmpId='')
		{
		   $tmpTableName="tbl_banner";
		   $primaryId= 'id';
		
			$arrQueryValue = array();
			$arrTblFields = array();
			$strMessage = '';
			
			 
			$arrTblFields=array('id', 'title', 'description', 'sort_order', 'image', 'background', 'status', 'background_img');
			  
			//echo "<pre/>"; print_r($_POST);
			foreach($_POST as $key => $value)
			{
			  if($value<>'' || 1==1)
			  {      
				if((substr($key, 0, 3) == 'db_' || substr($key, 0, 3) == 'md_') && in_array(substr($key, 3),$arrTblFields) )
				{
				  	if( substr($key, 0, 3) == 'md_'){if(trim($value)==""){$strMessage.= '<li>'.sprintf("please Enter",substr($key, 3))."</li>";}}
				  	$strDBKey =  substr($key, 3);
					if($strDBKey == 'password' ) 
						{if($value<>'') {$arrQueryValue[] = $strDBKey." = '".trim($value)."'";}}		
					else 
						{$arrQueryValue[] = $strDBKey." = '".addslashes(trim($value))."'";}
				}
			  }	
			}

		    foreach($_FILES as $key=>$val)
			{
			  //echo $val['name'];
 				if($val['name']<>"")
 				{
			
				  // $strDirectory= $_POST['db_'.substr($key,3)];
                   $strDirectory="";
				   if($strDirectory=="") {$strDirectory = SITE_UPLOADPATH;}
				   @chmod($strDirectory,0777);
				   $val['name'] = mktime().$this->removeSpace($val['name']);
				   $val['tmp_name'];
  				   move_uploaded_file($val['tmp_name'],$strDirectory.$val['name']);
				   @chmod(	$strDirectory.$val['name'], 0644);		  
				     
				  //$arrSize= explode(',', $_POST[substr($key,3).'_thumb_size']);
				  $arrSize[0]="";
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
					//echo $strFileName; die();
				  }
			  }	   
				  
				   
   				  if((stripos($key, "db_")!==false || stripos($key, "md_")!==false) && in_array(substr($key, 3),$arrTblFields) )
	 				{
	  				         $arrQueryValue[]="".substr($key,3)."='".addslashes($val['name'])."'";
							
		        	} 
  		        }	  
			}	
		
		//die();
			$strQueryValue = implode(', ', $arrQueryValue);
			//echo "<pre/>"; print_r($arrQueryValue);
			//echo "<br>";
			if( $strMessage=='')
			{
		       $strQuery = "UPDATE ".$tmpTableName." SET ".$strQueryValue." WHERE id = '".$tmpId."'"; 
			   $this->db->query($strQuery);
			   return 1;
			}	
		    else
			{
			   return 0;
			}	 
		
		
		}
        
        	public function removeSpace($text)
		{
		   $code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','/','*','+','~','`','=');
		
		  $code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','');
		
		  $text = str_replace($code_entities_match, $code_entities_replace, $text); 
		  return $text;
		}
        
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
}
?>