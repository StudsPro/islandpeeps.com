<?php
class Emailtemplate_model  extends CI_Model 
{
  public function __construct()
	{
		$this->load->database();
		$this->load->helper('general_helper');
	}
 //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX Customer Module Start
  public function GetAllrecords()
	{

	   $sql="SELECT * FROM tbl_mailtemplates";
       $sql.=" order by title "; 
       // $sql = $this->db->query("SELECT * FROM tbl_mailtemplates order by title limit $start, $limit");
       $query=$this->db->query($sql);
        return $query->result_array();
	}
    public function getAllcount($searchdata)
    { 
        
        $sql="SELECT * FROM tbl_mailtemplates";
      if(!empty($searchdata))
       {
         $sql.=" where  title like '".$searchdata["searchstr"]."%'";	
       } 
        
         $sql.=" order by title ";
         
        $query = $this->db->query($sql);
        $data=$query->result_array();
         
        return count($data); 
    }

 public function GetById($id)
	{
	   $query = $this->db->query("SELECT * FROM tbl_mailtemplates where id=".$id);
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
    	$query = $this->db->get_where('tbl_mailtemplates', array('subject' => $name));
    
    	 $data=$query->row_array();
        
         return count($data);
	}
    public function editcheck_name($id,$name)
	{
	      return   $this->db
		  ->where('subject',$name) 
		  ->where('id <>',$id)  
		  ->count_all_results('tbl_mailtemplates');
	}
     public function check_title($name)
	{
    	$query = $this->db->get_where('tbl_mailtemplates', array('title' => $name));
    
    	 $data=$query->row_array();
        
         return count($data);
	}
    public function editcheck_title($id,$name)
	{
	      return   $this->db
		  ->where('title',$name) 
		  ->where('id <>',$id)  
		  ->count_all_results('tbl_mailtemplates');
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
     public function insert($input)
    {
              $regions="";  
              if(!empty($input["regions"]))
              {
                 $regions=implode(",",$input["regions"]);
              } 
               
                $arrvideo_value=array(".mp4",".flv",".bat"); 
                             if(in_array($input["ads_imageext"],$arrvideo_value))
                             { 
                                 $this->mpeg2Mp4(SITE_UPLOADPATH.$input["ads_image"],$input["ads_image"]);   
                             } 
               
             $data = array('title' => $input["title"],
                           'type' => $input["type"], 
                           'regions' => $regions,
                           'image' => $input["ads_image"],
                           'filetype' => $input["ads_imageext"]
                            
                          );
             $this->db->insert('tbl_mailtemplates', $data); 
             
            
              $insertid= $this->db->insert_id();
     return $insertid;   
    }
    
     public function update($input)
    {
          
             $data = array('title' => $input["title"],
                           'from_mail' => $input["from_mail"], 
                           'subject' => $input["subject"], 
                           'temp_content' => addslashes($input["temp_content"])  
                          );
                
            $this->db->where('id', $input["id"]);
            $this->db->update('tbl_mailtemplates', $data);
     return true;     
    } 
    
    public function updateimage($id,$fieldname)
    {
      $data=array($fieldname=>"");  
        $this->db->where('id', $id);
            $this->db->update('tbl_mailtemplates', $data);
     return true;     
    }   
    
    public function getmaxid($id,$tablename)
  {
     return $this->db->query("select if(count($id)=0,1,max($id)+1 ) as maxid from $tablename ")->row()->maxid;
    
  } 
  public function setbackgroundimage($id)
   {
    
     $this->db->query("update tbl_mailtemplates set setbackground='0' ");
     
     $this->db->query("update tbl_mailtemplates set setbackground='1' where id='".$id."'");
     
     
   } 
   
   public function deleterecords($ids)
   {
      foreach($ids as $key => $value)
      {
            $editdata=$this->GetadsById($value);
            $getimagename=$editdata[0]["image"];
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
              
            }
            
           $this->db->query("delete from tbl_mailtemplates where id='".$value."'");                      
      }   
    
   } 
}
?>