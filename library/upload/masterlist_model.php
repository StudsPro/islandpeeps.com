<?php
class Masterlist_model  extends CI_Model 
{
  public function __construct()
	{
		$this->load->database();
		$this->load->helper('general_helper');
	}
 //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX Customer Module Start
  public function GetAllrecords($input)
	{
      $str ='';
     if($input['fillter']<>'')
     {
	  if($input['fillter']<>'title')
	  $str = ' and tbl_profiles.status='.$input['fillter'];
     }
	   $sql="SELECT tbl_profiles.*,tbl_admin.username FROM tbl_profiles
         left join tbl_admin  on tbl_profiles.admin_id=tbl_admin.id ";
       $sql.=" where 1=1 ".$str." order by title "; 
       // $sql = $this->db->query("SELECT * FROM tbl_profiles order by title limit $start, $limit");
       $query=$this->db->query($sql);
        return $query->result_array();
	}
    
   public function Getkinds($input)
   {
      $str ='';
     if($input['fillter']<>'')
     {
	  if($input['fillter']<>'title')
	  $str = ' and status='.$input['fillter'];
     }
    
      $sql = "SELECT count(*) as pcount,kind FROM tbl_profiles where 1=1 ".$str." GROUP BY kind ORDER BY  `kind` DESC ";
	    $query=$this->db->query($sql);
        return $query->result_array();
    
   }  
    public function getAllcount($searchdata)
    { 
        
        $sql="SELECT tbl_profiles.*,tbl_admin.username FROM tbl_profiles
         left join tbl_admin  on tbl_profiles.admin_id=tbl_admin.id 
        ";
      if(!empty($searchdata))
       {
         $sql.=" where  title like '".$searchdata["searchstr"]."%'";	
       } 
        
         $sql.=" order by title ";
         
        $query = $this->db->query($sql);
        $data=$query->result_array();
         
        return count($data); 
    }

 public function GetpeopleprofileById($id)
	{
	   $query = $this->db->query("SELECT * FROM tbl_profiles where id=".$id);
	   return $query->result_array();
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
 //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX Customer Module End 
 
  public function check_name($name)
	{
    	$query = $this->db->get_where('tbl_profiles', array('title' => $name));
    
    	 $data=$query->row_array();
        
         return count($data);
	}
    public function editcheck_name($id,$name)
	{
	      return   $this->db
		  ->where('title',$name) 
		  ->where('id <>',$id)  
		  ->count_all_results('tbl_profiles');
	}
     public function check_title($name)
	{
    	$query = $this->db->get_where('tbl_profiles', array('title' => $name));
    
    	 $data=$query->row_array();
        
         return count($data);
	}
    public function editcheck_title($id,$name)
	{
	      return   $this->db
		  ->where('title',$name) 
		  ->where('id <>',$id)  
		  ->count_all_results('tbl_profiles');
	}
    
     public function GetAllRegion()
	{
	  $result=array();
	   $sql="SELECT * FROM tbl_regions";
        $sql.=" where status='1' "; 
        $sql.=" order by region_name "; 
       
       $query=$this->db->query($sql);
       $data=$query->result_array();
          
          if(!empty($data))
          {
            foreach($data as $key => $detail)
             {
              $id=$detail["id"];   
              $result[$id]=$detail["region_name"];  
                
             }
          }
          
       return $result;  
	}
    
     public function GetAllCategory()
	{
	  $result=array();
	   $sql="SELECT * FROM tbl_category ";
       $sql.=" order by category "; 
       
       $query=$this->db->query($sql);
       $data=$query->result_array();
          
          if(!empty($data))
          {
            foreach($data as $key => $detail)
             {
              $id=$detail["id"];   
              $result[$id]=$detail["category"];  
                
             }
          }
          
       return $result;  
	}
     public function insert($input)
    {
       
        
              $regions="";  
              if(!empty($input["regions"]))
              {
                 $regions=implode(",",$input["regions"]);
              } 
            if(!empty($input["month"]) && !empty($input["year"]) && !empty($input["day"]) )  
              {
                $dob=$input["year"]."-".$input["month"]."-".$input["day"];
                $lmsg = trim($input["name"]).' - pepole Profile birth date Added';
			    $this->db->query("INSERT into  tbl_notificationlog (data, date) VALUES ('".$lmsg."', '".date('Y-m-d h:i:s')."') "); 
                
              }else
              {
                $dob="0000-00-00";
              }
              
          $data = array('title' => $input["name"],
                           'region_id' => $regions, 
                           'dob' => $dob,
                           'image' => $input["peopleprofile_image"],
                           'kind' => $input["kind"],
                            'category' => $input["category"],
                            'description' => addslashes($input["profiledetail"]),
                            'video' => htmlentities($input["video"]),
                            'tags' => $input["tags"],
                            'facebook' =>  htmlentities($input["facebook"]),
                            'facebookfanpage' =>  htmlentities($input["facebookfunpage"]),
                            'twitter' =>  htmlentities($input["twitter"]),
                            'twitterfanpage' =>  htmlentities($input["twitterfunpage"]),
                            'status' => $input["status"],
                            'admin_id' => $this->session->userdata('adminid'),
                            'createdate' => date('Y-m-d h:i:s'),
                            'postdate' => date('Y-m-d h:i:s')
                        );
             $this->db->insert('tbl_profiles', $data); 
             
              $logmsg = trim($input["name"]).' profile has been added by '. $this->session->userdata('username');
			  $this->db->query("INSERT into  tbl_notificationlog (data, date) VALUES ('".$logmsg."', '".date('Y-m-d h:i:s')."') ");  
             
             
            
              $insertid= $this->db->insert_id();
     return $insertid;   
    }
    	public function addaffiliatelog($strlog)
	{
	    	$strSql = "INSERT INTO tbl_affiliateslog  (`admin_id`,`log_msg`,`date`) VALUES ('".$this->session->userdata('adminid')."', '".$strlog."', '".date('Y-m-d H:i:s')."');";
	  	 $this->db->query($strSql);
		return;
	}
     public function update($input)
    {
            $regions="";  
              if(!empty($input["regions"]))
              {
                 $regions=implode(",",$input["regions"]);
              } 
            if(!empty($input["month"]) && !empty($input["year"]) && !empty($input["day"]) )  
              {
                $dob=$input["year"]."-".$input["month"]."-".$input["day"];
              }else
              {
                $dob="0000-00-00";
              }
              
          $data = array('title' => $input["name"],
                           'region_id' => $regions, 
                           'dob' => $dob,
                           'kind' => $input["kind"],
                            'category' => $input["category"],
                            'description' => addslashes($input["profiledetail"]),
                            'video' => htmlentities($input["video"]),
                            'tags' => $input["tags"],
                            'facebook' =>  htmlentities($input["facebook"]),
                            'facebookfanpage' =>  htmlentities($input["facebookfunpage"]),
                            'twitter' =>  htmlentities($input["twitter"]),
                            'twitterfanpage' =>  htmlentities($input["twitterfunpage"]),
                            'status' => $input["status"],
                            'admin_id' => $this->session->userdata('adminid'),
                            'modifydate' => date('Y-m-d h:i:s')
                        );
                       
                 if(!empty($input["peopleprofile_image"]))
                 {         
                    $data['image'] = $input["peopleprofile_image"]; 
                  
                    
                     $editdata=$this->GetpeopleprofileById($input["id"]);
                     
                     if($input['peopleprofile_image'] !=$editdata[0]["image"])
                     {
                         if(!empty($editdata[0]["image"]) && file_exists(SITE_UPLOADPATH.$editdata[0]["image"]) )
                            { 
                               unlink(SITE_UPLOADPATH.$editdata[0]["image"]);
                            }
                     }
                 }
                 
               if(!empty($input["rejectreason"]))
                 {    
                   $data['rejectreason'] = addslashes($input["rejectreason"]); 
                 }
            $this->db->where('id', $input["id"]);
            $this->db->update('tbl_profiles', $data);
            
              	$logmsg = $input["name"].' profile has been edited';
			 	$this->addaffiliatelog($logmsg);
               	if($editdata[0]["status"]!='4' && $input["status"] == '4'){
					$lmsg = $editdata[0]["title"].' has been published by '.$this->session->userdata('username');
				    $this->db->query("INSERT into  tbl_notificationlog (data, date) VALUES ('".$lmsg."', '".date('Y-m-d h:i:s')."') ");
					
		     	}
 
				if($editdata[0]["dob"]=='0000-00-00' && isset($dob)  && (!empty($input["month"]) && !empty($input["year"]) && !empty($input["day"])))	{
                   $lmsg = $editdata[0]["title"].' - pepole Profile birth date Added ';
				   $this->db->query("INSERT into  tbl_notificationlog (data, date) VALUES ('".$lmsg."', '".date('Y-m-d h:i:s')."') ");
		         }
                
                
            
     return true;     
    } 
    
    public function updateimage($id,$fieldname)
    {
      $data=array($fieldname=>"");  
        $this->db->where('id', $id);
            $this->db->update('tbl_profiles', $data);
     return true;     
    }   
    
    public function getmaxid($id,$tablename)
  {
     return $this->db->query("select if(count($id)=0,1,max($id)+1 ) as maxid from $tablename ")->row()->maxid;
    
  } 
  public function setbackgroundimage($id)
   {
    
     $this->db->query("update tbl_profiles set setbackground='0' ");
     
     $this->db->query("update tbl_profiles set setbackground='1' where id='".$id."'");
     
     
   } 
   
   public function deleterecords($ids)
   {
      foreach($ids as $key => $value)
      {
            $editdata=$this->GetpeopleprofileById($value);
            $getimagename=$editdata[0]["image"];
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
              
            }
            
           $this->db->query("delete from tbl_profiles where id='".$value."'");                      
      }   
    
   }
   
   public function changeselectstatus($ids,$status)
   {
      foreach($ids as $key => $value)
      {
          $this->db->query("update tbl_profiles set status='".$status."' where id='".$value."'");                      
      }   
    
   }
   public function bulkprofileinsert($input)
   {
      
       
      if(!empty($input["md_title"]))
      {
        foreach($input["md_title"] as  $key => $value)
        {
           $regions="";  
              if(!empty($input["md_regions"][$key]))
              {
                 $regions=implode(",",$input["md_regions"][$key]);
              } 
            if(!empty($input["month"][$key]) && !empty($input["year"][$key]) && !empty($input["day"][$key]) )  
              {
                $dob=$input["year"][$key]."-".$input["month"][$key]."-".$input["day"][$key];
                $lmsg = trim($value).' - pepole Profile birth date Added';
			    $this->db->query("INSERT into  tbl_notificationlog (data, date) VALUES ('".$lmsg."', '".date('Y-m-d h:i:s')."') "); 
                
              }else
              {
                $dob="0000-00-00";
              }
             echo "<pre>";
             print_r($_FILES); 
              //************************ Image Upload **************************
                    if(!empty($_FILES["db_image"]["name"][$key]))
					{
					      $gettmp_tumbs_arr=array();
					 
                         $peopleprofile_image="";
                         $peopleprofileid=$this->getmaxid("id","tbl_profiles");
						$ext = explode(".",$_FILES["db_image"]['name'][$key]);
						$ext = strtolower($ext[1]);
					echo	$uploadConst['upload_path']   = SITE_UPLOADPATH;
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp';
                        //$uploadConst['max_size'] = REGION_MAP;
                         //$uploadConst['min_width'] = '1200';
                         //$uploadConst['min_height'] = '900';
						$uploadConst['file_name']     = 'peopleprofile-'.$peopleprofileid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        
                        $_FILES['images']['name']= $_FILES["db_image"]['name'][$key];
                        $_FILES['images']['type']= $_FILES["db_image"]['type'][$key];
                        $_FILES['images']['tmp_name']= $_FILES["db_image"]['tmp_name'][$key];
                        $_FILES['images']['error']= $_FILES["db_image"]['error'][$key];
                        $_FILES['images']['size']= $_FILES["db_image"]['size'][$key];
                      	if (!$this->upload->do_upload('images'))
							{  echo  $error = $this->upload->display_errors(); exit;  }
						 else{unset($_FILES['images']);
                             
							   $config=array();$image_data=array();
                               $image_data = $this->upload->data();
                               
                              }
                              echo  $peopleprofile_image=$uploadConst['file_name'];
                            
                                echo "Test"; exit;
                        }   
               //*****************************************************
                  if(!empty($peopleprofile_image))
                  {
                     $data["image"]=$peopleprofile_image;
                  }
                  
          $data = array('title' => $value,
                           'region_id' => $regions, 
                           'dob' => $dob,
                            'kind' => $input["md_kind"][$key],
                            'description' => addslashes($input["db_description"][$key]),
                            'status' => $input["md_status"][$key],
                            'admin_id' => $this->session->userdata('adminid'),
                            'createdate' => date('Y-m-d h:i:s'),
                            'postdate' => date('Y-m-d h:i:s')
                        );
             $this->db->insert('tbl_profiles', $data); 
             
              $logmsg = trim($value).' profile has been added by '. $this->session->userdata('username');
			  $this->db->query("INSERT into  tbl_notificationlog (data, date) VALUES ('".$logmsg."', '".date('Y-m-d h:i:s')."') "); 
      
        }
      
      }
      
      echo "Test"; exit;
   }
   public function changestatus($id,$status)
   {
            $editdata=$this->GetpeopleprofileById($id);
            $title=$editdata[0]["title"];
            $admin_id=$editdata[0]["admin_id"];  
      	    $lmsg = $title.' has been changed to pending by '.$this->session->userdata('username');
			$strSqln = "INSERT into tbl_notelog (admin_id, message, status) VALUES ('".$admin_id."', '".$lmsg."', '0') ";
            
             $this->db->query("update tbl_profiles set status='".$status."' where id='".$id."'");
   } 
   
   public function categoryinsert($input)
   {
     
     if(!empty($input))
      {
         foreach($input["category"] as $key => $value)
         {
            $value=trim($value);
           if(!empty($value))
           {
          if($this->check_caetgory($key) >0)
             {
               
                 $this->db->query("update tbl_category set category='".$value."' where  id='".$key."'");
             }else
             {
               
                
                 $this->db->query("insert into tbl_category (category) values ('".$value."')");
             }
           } 
         }
      }
     
   } 
   
    public function check_caetgory($name)
	{
    	$query = $this->db->get_where('tbl_category', array('id' => $name));
    
    	 $data=$query->row_array();
        
         return count($data);
	}
}
?>