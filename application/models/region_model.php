<?php
class Region_model  extends CI_Model 
{
  public function __construct()
	{
		$this->load->database();
		$this->load->helper('general_helper');
	}
 //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX Customer Module Start
  public function GetAllRegion()
	{
		
	   $sql="SELECT * FROM tbl_regions";
       $sql.=" order by region_name "; 
       // $sql = $this->db->query("SELECT * FROM tbl_regions order by region_name limit $start, $limit");
       $query=$this->db->query($sql);
        return $query->result_array();
	}
    public function getAllcount($searchdata)
    { 
        
        $sql="SELECT * FROM tbl_regions";
       
     
       
       if(!empty($searchdata))
       {
         $sql.=" where  region_name like '".$searchdata["searchstr"]."%'";	
       } 
        
         $sql.=" order by region_name ";
         
        $query = $this->db->query($sql);
        $data=$query->result_array();
         
        return count($data); 
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
	   $query = $this->db->query("SELECT id, region_name,region_titlebanner, region_title, independenceday, description, flag, flag_desc, population, image, cover_image, longitude, latitude, ragion_map, status,twittershortdesc FROM tbl_regions where id=".$id);
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
 
  public function check_name($name)
	{
    	$query = $this->db->get_where('tbl_regions', array('region_name' => $name));
    
    	 $data=$query->row_array();
        
         return count($data);
	}
    public function editcheck_name($id,$name)
	{
	      return   $this->db
		  ->where('region_name',$name) 
		  ->where('id <>',$id)  
		  ->count_all_results('tbl_regions');
	}
     public function check_title($name)
	{
    	$query = $this->db->get_where('tbl_regions', array('region_title' => $name));
    
    	 $data=$query->row_array();
        
         return count($data);
	}
    public function editcheck_title($id,$name)
	{
	      return   $this->db
		  ->where('region_title',$name) 
		  ->where('id <>',$id)  
		  ->count_all_results('tbl_regions');
	}
    
    public function uploadregionimage($regionid,$input)
  {
        $mainimageerror=array();
       //**********************  Upload Photos ********************
                      if(!empty($input["ragion_map"]))
					{
				        $gettmp_tumbs_arr=array();
                        $imagecounter=1; 
					   foreach($input["ragion_map"]["name"] as $key => $detail)
                       {
                        $ext = explode(".",$input["ragion_map"]['name'][$key]);
						$ext = strtolower($ext[1]);
						$uploadConst['upload_path']   = UPLOAD_ROOT_PATH.'college/';
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp';
                        $uploadConst['max_size'] = '1000';
						$uploadConst['file_name']     = 'regionimage-'.$regionid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        
                        $_FILES['mainimages']['name']       = $input["ragion_map"]['name'][$key];
                        $_FILES['mainimages']['type']       = $input["ragion_map"]['type'][$key];
                        $_FILES['mainimages']['tmp_name']   = $input["ragion_map"]['tmp_name'][$key];
                        $_FILES['mainimages']['error']      = $input["ragion_map"]['error'][$key];
                        $_FILES['mainimages']['size']       = $input["ragion_map"]['size'][$key];

                        
						if (!$this->upload->do_upload('mainimages'))
							{
						      	$mainimageerror[] = $this->upload->display_errors(); 
                            }
						 else
							{   
							 unset($_FILES['mainimages']);
                             
							   $config=array();
                               $image_data=array();
                               $image_data = $this->upload->data();
                               
                               $gettmp_tumbs_arr[$key]=$image_data['full_path'];
                               $this->db->where('id', $regionid);
                               $this->db->update('tbl_regions', array("ragion_map"=>$uploadConst['file_name']));
                           }
                            $photos_arr[]=$uploadConst['file_name'];
                        }    
                       //****************  cretae tuhmbs  *********************/
                        /*
                         $this->load->library('image_lib');
                         $imagecounter=1; 
                         foreach($gettmp_tumbs_arr as $key => $imageurl)
                         {
                            unset($config);
                            $config = array( 
                                    'image_library' => 'gd2',
                                    'source_image' => $imageurl,
                                    'new_image' => UPLOAD_ROOT_PATH.'college/thumbs',
                                    'maintain_ratio' => false,
                                    'file_name'     => 'col-mainimage-'.$collegeid.'-'.$imagecounter.'.jpg', 
                                    'width' => 98,
                                    'height' => 130
                                );
                    
                                
                                $this->image_lib->initialize($config);
                               
                               // $this->image_lib->resize();
                                if(!$this->image_lib->resize())
                                {
                                     $this->image_lib->display_errors();
                                }
                                unset($config);
                                $this->image_lib->clear();
                            
                        
                          $imagecounter++;
                       }  */  
					} 
             //************************************************************
       return $mainimageerror;
  }
     public function insert($input)
    {
              // echo "<pre>";print_r($input);exit;
             $data = array('region_name' => $input["name"],
                            'region_titlebanner' => $input["banner"],
                           'region_title' => $input["title"], 
                           'independenceday' => $input["independenceday"],
                           'description' => $input["description"], 
                           'flag' => $input["ragion_flag"], 
                           'flag_desc' => $input["flag_desc"], 
                           'population' => $input["population"],
                           'image' => $input["ragion_image"],  
                           'cover_image' => $input["ragion_coverimage"],  
                           'longitude' => $input["longitude"],  
                           'latitude' => $input["latitude"],  
                           'ragion_map' =>  $input["ragion_map"],
                           'twittershortdesc' =>  $input["twittershortdesc"]
                           
                          );
             $this->db->insert('tbl_regions', $data); 
             
            
              $insertid= $this->db->insert_id();
     return $insertid;   
    }
    
     public function update($input)
    {
            $data = array('region_name' => $input["name"],
                            'region_titlebanner' => $input["banner"],
                           'region_title' => $input["title"], 
                           'independenceday' => $input["independenceday"],
                           'description' => $input["description"], 
                           'flag_desc' => $input["flag_desc"], 
                           'population' => $input["population"],
                           'longitude' => $input["longitude"],  
                           'latitude' => $input["latitude"],  
                           'status' =>  $input["status"],
                           'twittershortdesc' =>  $input["twittershortdesc"]
                          );
                 if(!empty($input["ragion_flag"]))
                 {         
                   $data['flag'] = $input["ragion_flag"]; 
                 }
                  if(!empty($input["ragion_image"]))
                 {              
                   $data['image'] = $input["ragion_image"]; 
                  }
                  if(!empty($input["ragion_map"]))
                 {      
                   $data['ragion_map'] = $input["ragion_map"]; 
                  }
                   if(!empty($input["ragion_coverimage"]))
                 {     
                   $data['cover_image'] = $input["ragion_coverimage"];  
                  }       
                          
            $this->db->where('id', $input["id"]);
            $this->db->update('tbl_regions', $data);
     return true;     
    } 
    
    public function updateimage($id,$fieldname)
    {
      $data=array($fieldname=>"");  
        $this->db->where('id', $id);
            $this->db->update('tbl_regions', $data);
     return true;     
    }   
    
    public function getmaxid($id,$tablename)
  {
     return $this->db->query("select if(count($id)=0,1,max($id)+1 ) as maxid from $tablename ")->row()->maxid;
    
  } 
}
?>