<?php
class Imailbox_model  extends CI_Model 
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
    $sql = "SELECT A.*,B.username FROM tbl_mailbox A LEFT JOIN tbl_admin B on A.sadmin_id = B.id where A.radmin_id='".$this->session->userdata('adminid')."' and idelete='0'  order by A.date DESC";
	 
       $query=$this->db->query($sql);
        return $query->result_array();
	}
   public function admin_mailsent()
   {

	   $str ='';
    $sql = "SELECT A.*,B.username FROM tbl_mailbox A LEFT JOIN tbl_admin B on A.radmin_id = B.id where A.sadmin_id='".$this->session->userdata('adminid')."' and sdelete='0'  order by A.date DESC";
	 
       $query=$this->db->query($sql);
        return $query->result_array();
   } // End Function
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
	   $query = $this->db->query("SELECT * FROM tbl_suggestion where id=".$id);
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
     
    	
    
   
    
    public function getmaxid($id,$tablename)
  {
     return $this->db->query("select if(count($id)=0,1,max($id)+1 ) as maxid from $tablename ")->row()->maxid;
    
  } 
   
   
   public function deleterecords($ids)
   {
      foreach($ids as $key => $value)
      {
                      
          $this->db->query("delete from tbl_mailbox where id='".$value."'");                      
      }   
    
   }
  
	  public function check_mailexist($id)
	{
    	$query = $this->db->get_where('tbl_mailbox', array('id' => $id));
    
    	 $data=$query->row_array();
        
         return $data;
	}
	public function viewmail($id)
	{
		 $maildata=$this->check_mailexist($id);
		
		if(count($maildata)>0)
		{
		   
		   if($maildata["pid"]<>0)
		   {
			$id = $maildata["pid"];
		  }
			   $strSql = "SELECT A.*,B.username as runame,B.email as remail,C.username as suname,C.email as semail FROM tbl_mailbox A LEFT JOIN tbl_admin B on A.radmin_id = B.id LEFT JOIN tbl_admin C on A.sadmin_id = C.id where (A.sadmin_id='".$this->session->userdata('adminid')."' OR A.radmin_id='".$this->session->userdata('adminid')."') and A.id='".$id."'";  
			   $query =  $this->db->query($strSql);
		   	
	$strSql1 = "UPDATE tbl_mailbox  SET status='1' WHERE radmin_id='".$this->session->userdata('adminid')."' and id='".$maildata["id"]."'";
		
		 $this->db->query($strSql1);
		   	
		 	
		   	
		   	
			return $query->result_array();
		}
		
		
	}
	
	public function viewmail_data($id)
	{
		 $maildata=$this->check_mailexist($id);
		
		if(count($maildata)>0)
		{
		  $strSql2 = "SELECT A.*,B.username as suname FROM tbl_mailbox A LEFT JOIN tbl_admin B on A.sadmin_id = B.id  WHERE pid='".$maildata["id"]."' ";
		$query=$this->db->query($strSql2);
		   	
		   	
			return $query->result_array();
		
		}
	}
	
	public function savereply($input)
	{
	
			$strQuery ="SELECT email,username from tbl_admin where id='".$this->session->userdata('adminid')."'";
    		$suser = $this->db->query($strQuery);
            $mainadmin=$suser->result_array();  
		$strQuery ="SELECT email,username from tbl_admin where id='".$input['md_radmin_id']."'";
    		$ruser = $this->db->query($strQuery);
		  $subadmin=$ruser->result_array();
		  
	  	
			
			    
		  $data = array('pid' => $input['md_pid'], 
                           'radmin_id' => $input['md_radmin_id'],
                            'message' => htmlentities($input['db_message']),
                            'subject' =>addslashes($input['md_subject']),
                            'sadmin_id' => $this->session->userdata('adminid'),
                            'date' => date('Y-m-d h:i:s')
                        );
             $this->db->insert('tbl_mailbox', $data); 
         $message=$input['db_message'];
         $subject=$input['md_subject'];
      send_email($subject,$message,$subadmin[0]["email"],$subadmin[0]["username"],$mainadmin[0]["email"],$mainadmin[0]["username"]);
	
		
		
	}
	public function saveforward($input)
    {
    
	   	$strQuery ="SELECT email,username from tbl_admin where id='".$this->session->userdata('adminid')."'";
    		$suser = $this->db->query($strQuery);
            $mainadmin=$suser->result_array();  
		$strQuery ="SELECT email,username from tbl_admin where id='".$input['md_radmin_id']."'";
    		$ruser = $this->db->query($strQuery);
		  $subadmin=$ruser->result_array();
		  
	  	
			
			    
		  $data = array('pid' => $input['md_fid'], 
                           'radmin_id' => $input['md_radmin_id'],
                            'message' => htmlentities($input['db_message']),
                            'subject' =>addslashes($input['md_subject']),
                            'sadmin_id' => $this->session->userdata('adminid'),
                            'date' => date('Y-m-d h:i:s')
                        );
             $this->db->insert('tbl_mailbox', $data); 
         $message=$input['db_message'];
         $subject=$input['md_subject'];
      send_email($subject,$message,$subadmin[0]["email"],$subadmin[0]["username"],$mainadmin[0]["email"],$mainadmin[0]["username"]);
	
			
		
	}
	
	
		public function savecompose($input)
    {
      
	   	$strQuery ="SELECT email,username from tbl_admin where id='".$this->session->userdata('adminid')."'";
    		$suser = $this->db->query($strQuery);
            $mainadmin=$suser->result_array();  
		$strQuery ="SELECT email,username from tbl_admin where id='".$input['md_radmin_id']."'";
    		$ruser = $this->db->query($strQuery);
		  $subadmin=$ruser->result_array();
		  
	  	
			
			    
		  $data = array('pid' => '0', 
                           'radmin_id' => $input['md_radmin_id'],
                            'message' => htmlentities($input['db_message']),
                            'subject' =>addslashes($input['md_subject']),
                            'sadmin_id' => $this->session->userdata('adminid'),
                            'date' => date('Y-m-d h:i:s')
                        );
             $this->db->insert('tbl_mailbox', $data); 
         $message=$input['db_message'];
         $subject=$input['md_subject'];
      send_email($subject,$message,$subadmin[0]["email"],$subadmin[0]["username"],$mainadmin[0]["email"],$mainadmin[0]["username"]);
	
			
		
	}
	
	public function get_adminamails()
		{
			$str = '';	
			if($this->session->userdata('adminid')<>'1'){
			//$str = "and id!='".$_SESSION['adminid']."' ";
			}
			
		 	   $strSql = "SELECT id,email,username FROM tbl_admin  where 1=1 ".$str." ORDER BY username";
					$objRs = $this->db->query($strSql);
								
				//	$txtOption = '<option value="">Select</option>';
				$txtOption = ""	;			
					foreach($objRs->result() as $objRow)	
					{
					  
						$txtOption .= '<option value="'.$objRow->id.'" >'.$objRow->username.'</option>';
						
					}
					return  $txtOption;
		}
}
?>