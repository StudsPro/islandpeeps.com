<?php
class Affiliate_model  extends CI_Model 
{
  public function __construct()
	{
		$this->load->database();
		$this->load->helper('general_helper');
	}
 //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX Customer Module Start
  public function GetAllrecords()
	{

	   $sql="SELECT * FROM tbl_admin";
       $sql.=" order by username "; 
       // $sql = $this->db->query("SELECT * FROM tbl_admin order by username limit $start, $limit");
       $query=$this->db->query($sql);
        return $query->result_array();
	}
    public function getAllcount($searchdata)
    { 
        
        $sql="SELECT * FROM tbl_admin";
      if(!empty($searchdata))
       {
         $sql.=" where  username like '".$searchdata["searchstr"]."%'";	
       } 
        
         $sql.=" order by username ";
         
        $query = $this->db->query($sql);
        $data=$query->result_array();
         
        return count($data); 
    }

 public function GetaffiliateById($id)
	{
	   $query = $this->db->query("SELECT * FROM tbl_admin where id=".$id);
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
    	$query = $this->db->get_where('tbl_admin', array('username' => $name));
    
    	 $data=$query->row_array();
        
         return count($data);
	}
    public function editcheck_name($id,$name)
	{
	      return   $this->db
		  ->where('username',$name) 
		  ->where('id <>',$id)  
		  ->count_all_results('tbl_admin');
	}
     public function check_email($name)
	{
    	$query = $this->db->get_where('tbl_admin', array('email' => $name));
    
    	 $data=$query->row_array();
        
         return count($data);
	}
    public function editcheck_email($id,$name)
	{
	      return   $this->db
		  ->where('email',$name) 
		  ->where('id <>',$id)  
		  ->count_all_results('tbl_admin');
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
       
              $semail="";  
              if(!empty($input["siteemail"]))
              {
                 $semail=implode(",",$input["siteemail"]);
              } 
              
              $spass="";  
              if(!empty($input["siteemailpass"]))
              {
                 $spass=implode("-|-",$input["siteemailpass"]);
              } 
              
           $data = array('username' => $input["username"],
                           'password' => md5($input["userpass"]), 
                           'email' => $input["email"],
                           'semail' => $semail,
                           'spassword' => $spass,
                           'superadmin' => $input["type"]
                            
                          );
             $this->db->insert('tbl_admin', $data); 
             
            
              $insertid= $this->db->insert_id();
              
              if(!empty($input["affilaterights"]))     
        {       
            //tbl_modulesrights
            
         //   $this->db->query("delete from tbl_modulesrights where affilateid='".$id."'");
          foreach($input["affilaterights"] as $modulename => $getrights)
          {  
             $rights=implode(",",$getrights);
             $data = array('modulesname' => $modulename,
                           'rights' => $rights, 
                           'affilateid' => $insertid
                         );
             $this->db->insert('tbl_modulesrights', $data); 
            }    
         }      
              
              
              
              
              
     return $insertid;   
    }
    
     public function update($input)
    {
            $semail="";  
              if(!empty($input["siteemail"]))
              {
                 $semail=implode(",",$input["siteemail"]);
              } 
              
              $spass="";  
              if(!empty($input["siteemailpass"]))
              {
                 $spass=implode("-|-",$input["siteemailpass"]);
              } 
              $data = array('username' => $input["username"],
                           'password' => md5($input["userpass"]), 
                           'email' => $input["email"],
                           'semail' => $semail,
                           'spassword' => $spass,
                           'superadmin' => $input["type"]
                            
                          );
          
                 
            $this->db->where('id', $input["id"]);
            $this->db->update('tbl_admin', $data);
            
             if(!empty($input["affilaterights"]))     
        {       
            //tbl_modulesrights
            
            $this->db->query("delete from tbl_modulesrights where affilateid='".$input["id"]."'");
          foreach($input["affilaterights"] as $modulename => $getrights)
          {  
             $rights=implode(",",$getrights);
             $data = array('modulesname' => $modulename,
                           'rights' => $rights, 
                           'affilateid' => $input["id"]
                         );
             $this->db->insert('tbl_modulesrights', $data); 
            }    
         } 
            
            
            
     return true;     
    } 
    
    public function updateimage($id,$fieldname)
    {
      $data=array($fieldname=>"");  
        $this->db->where('id', $id);
            $this->db->update('tbl_admin', $data);
     return true;     
    }   
    
    public function getmaxid($id,$tablename)
  {
     return $this->db->query("select if(count($id)=0,1,max($id)+1 ) as maxid from $tablename ")->row()->maxid;
    
  } 
  public function setbackgroundimage($id)
   {
    
     $this->db->query("update tbl_admin set setbackground='0' ");
     
     $this->db->query("update tbl_admin set setbackground='1' where id='".$id."'");
     
     
   } 
   
   public function deleterecords($ids)
   {
      foreach($ids as $key => $value)
      {
          $this->db->query("delete from tbl_admin where id='".$value."'");  
          $this->db->query("delete from tbl_modulesrights where affilateid='".$value."'");                    
      }   
    
   } 
}
?>