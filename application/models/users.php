<?php
class Users extends CI_Model {

	public function __construct()
	{
		  $this->load->database();
          
	}
	public function admin_Login($username,$password)
	{
	   // $usertype =1 = admin
     //  echo "select id from tbl_admin where username='".$username."' and password='".md5($password)."' and superadmin ='1'"; exit;  and superadmin ='1'
	    $query = $this->db->query("select id from tbl_admin where username='".$username."' and password='".md5($password)."' ");
		$RsCount=count($query->row_array());
	    if($RsCount>0)
	   		{
	   			$rslt=$query->row_array();
	           	return $this->getAdminDetail($rslt['id']);
	       	} 
	       else 
           	{return false;}
	}
	
	public function getAdminDetail($id)
    	{
			$query = $this->db->query("select * from tbl_admin where id='".$id."'");
    	    return $query->row_array();
    	}
      	public function getsettingsDetail($id)
    	{
			$query = $this->db->query("select * from tbl_settings where id='".$id."'");
    	    return $query->row_array();
    	}  
        
        	public function getsocialfeedsDetail($id)
    	{
			$query = $this->db->query("select * from tbl_socialfeeds where id='".$id."'");
    	    return $query->row_array();
    	}
    
    public function admin_getprofile()
    	{
    	   $query = $this->db->query("SELECT A.*,B.username FROM tbl_profiles A LEFT JOIN tbl_admin B on A.admin_id = B.id where 1=1  order by A.`createdate` DESC LIMIT 0 , 20");
           return $query->result_array();
    	}
    public function admin_getaffiliatelog()
        {
            $query = $this->db->query("SELECT A.*,B.username FROM tbl_affiliateslog A LEFT JOIN tbl_admin B on A.admin_id = B.id where 1=1  order by A.`date` DESC LIMIT 0 , 40");
            return $query->result_array();    
        }
    public function admin_getchatmsg()
        {
            $strSql = "select C.* from (SELECT A.*,B.username,B.image FROM tbl_chatmsg A LEFT JOIN tbl_admin B on A.admin_id = B.id where 1=1  order by A.`date` DESC LIMIT 0 , 15) C order by C.date ";
            
            $query = $this->db->query($strSql);
            return $query->result_array();    
        }
    
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX	
	   public function check_email($name)
	{
    	$query = $this->db->get_where('tbl_admin', array('email' => $name));
    
    	 $data=$query->row_array();
        
         return count($data);
	}
       public function editcheck_name($name)
	{
    	$query = $this->db->get_where('tbl_admin', array('username' => $name));
    
    	 $data=$query->row_array();
        
         return count($data);
	}
   
    public function checkpassword($id,$name)
	{
	      return   $this->db
		  ->where('password',md5($name)) 
		  ->where('id',$id)  
		  ->count_all_results('tbl_admin');
	}
    
   public function randoPass() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
    }
    
    
    public function sendpass($stremail)
    {
            $strQuery ='SELECT  username,email,id from tbl_admin where email=\'%s\'';
            $objRecords = $this->db->query(sprintf($strQuery,$stremail));
 
            $objRecord =$objRecords->row_array();
        $randpassword=$this->randoPass();
        $strSql ='SELECT * FROM tbl_mailtemplates  where id=%d'; 
		$objRecord1 =  $this->db->query(sprintf($strSql,'2'));
       
        $messagearr = $objRecord1->row_array(); 
            $message=$messagearr["temp_content"];
            $message = str_replace("[#name]",$objRecord["username"],$message);
	    	$message = str_replace("[#newpassword]",$randpassword,$message);
             //***************************** Send MAil************************
        /*
               //$config['mailtype'] = 'html';
              // $config['newline']  = "\r\n";
              $email_config = Array(
                         'mailtype'  => 'html',
                        'newline'   => "\r\n"
                    );
               
               $this->load->library('email',$email_config);
           //  $message=html_entity_decode($message);
          //   $this->email->clear();
            //$this->email->from($messagearr["from_mail"], "Anil");
             $this->email->from($messagearr["from_mail"], $messagearr["title"]);
            $this->email->to($objRecord["email"]);
            //$this->email->to("thelastgraliator@gmail.com");
          //  $this->email->cc('another@another-example.com');
          //  $this->email->bcc('them@their-example.com');
            
            $this->email->subject($messagearr["subject"]);
            $this->email->message($message);
            
            $this->email->send();
            */ 
             // $messagearr["from_mail"]
            //define('EmailFrom' , $messagearr["from_mail"]);
          //  define('EmailFromName' , $messagearr["title"]);
          //  define('Mandrill_API_Key' , 'jVCdekJXJMkr_i7bWMwTWg');
         //   define('Mandrill_Message_URL' , 'https://mandrillapp.com/api/1.0/messages/send.json');
  
           $this->send_email($messagearr["subject"],$message,$objRecord["email"],$objRecord["username"],$messagearr["from_mail"],$messagearr["title"]);
             
             
	    //$objFunctions->mosMail('', $objRecord1->from_mail, $objRecord->email, $objRecord1->subject, $message, $mode=1, '', '', NULL, NULL, NULL );
        $sql = "UPDATE  ".TBL_ADMIN." SET password ='".md5($randpassword)."' WHERE id='".$objRecord["id"]."'";
        
    }
    
   
  public function send_email($subject,$html_body,$to_email,$to_name,$frommail,$fromname)
 {
   
        
        $args = array(
    'key' => 'jVCdekJXJMkr_i7bWMwTWg',
    'message' => array(
        "html" => $html_body,
        "text" => null,
        "from_email" => $frommail,
        "from_name" => $fromname,
        "subject" => $subject,
        "to" => array(array("email" => $to_email)),
        "track_opens" => true,
        "track_clicks" => true,
        "auto_text" => true
    )  
);

        
        $curl = curl_init('https://mandrillapp.com/api/1.0/messages/send.json');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($args));
         $response = curl_exec($curl);
        curl_close($curl);

  return $result;
 }
   public function admin_setprepage($data)
  {
 
     if($this->session->userdata('adminid') <> ''){

     if(isset($_POST['perpage']))	 		{
          $strSql	= "Update  tbl_admin set masterlistperpage='".$data['perpageval']."' where id = '".$this->session->userdata('adminid')."' ";  
     }elseif(isset($_POST['autohide'])){
	  $strSql	= "Update  tbl_admin set autohide='".$data['setdata']."' where id = '".$this->session->userdata('adminid')."' ";  
     }elseif(isset($_POST['dividers'])){
	  $strSql	= "Update  tbl_admin set dividers='".$data['setdata']."' where id = '".$this->session->userdata('adminid')."' ";  
     }elseif(isset($_POST['changnotifilog'])){
	  $strSql	= "Update  tbl_notificationlog set adminids=CONCAT(adminids,',".$this->session->userdata('adminid')."') where id IN (".$data['dataids'].") "; 
     }
    

	 $this->db->query($strSql);
 	}

  } 
  
    public function admin_viewtask()
   {

	  
      if($this->session->userdata('adminid') <> ''): // condition i.e page for the edit content

	 
         $str = 'where admin_id='.$this->session->userdata('adminid');

  	   $strSql = "SELECT A.*,B.username FROM tbl_task A LEFT JOIN tbl_admin B on A.sadmin_id = B.id ".$str." order by A.id DESC";
	   $objRecord = $this->db->query($strSql);
	   
       return $objRecord->result_array();
	  endif;	  
   } // End Function 
   
    public function admin_givetask()
   {

	  
      if($this->session->userdata('adminid') <> ''): // condition i.e page for the edit content

	 
         $str = 'where admin_id='.$this->session->userdata('adminid');
    
        $strSql = "SELECT A.*,B.username FROM tbl_task A LEFT JOIN tbl_admin B on A.admin_id = B.id ".$str." order by A.id DESC";
        $objRecord = $this->db->query($strSql);
	   
       return $objRecord->result_array();
	  endif;	  
   } // End Function 
   
    public function changeselectstatus($ids,$status)
   {
      foreach($ids as $key => $value)
      {
          $this->db->query("update tbl_task set status='".$status."' where id='".$value."'");                      
      }   
    
   }
   
   public function deleteselect($ids)
   {
      foreach($ids as $key => $value)
      {
         if($this->session->userdata('adminid')==1)
         {
          $this->db->query("delete from tbl_task   where id='".$value."'");
         }else
         {
           $this->db->query("delete from tbl_task   where id='".$value."'  and sadmin_id='".$this->session->userdata('adminid')."' " );
         }                       
      }   
    
   }
   
    public function GetAllaffilates()
	{
	  $result=array();
	   $sql="SELECT * FROM tbl_admin ";
       $sql.=" order by username "; 
       
       $query=$this->db->query($sql);
       $data=$query->result_array();
          
          if(!empty($data))
          {
            foreach($data as $key => $detail)
             {
              $id=$detail["id"];   
              $result[$id]=$detail["username"];  
                
             }
          }
          
       return $result;  
	}
    
    public function admin_savetask($input)
   {
      
       $data = array('sadmin_id' => $this->session->userdata('adminid'),
                            'admin_id' => $input["radmin_id"],
                         'task' => addslashes($input["task"]),    
                            'date' => date('Y-m-d h:i:s')
                        );
             $this->db->insert('tbl_task', $data); 
   } 
   
   public function addchat($input)
   {
     $data = array('admin_id' => $this->session->userdata('adminid'),
                         'message' => addslashes($input["md_message"]),    
                            'date' => date('Y-m-d h:i:s')
                        );
             $this->db->insert('tbl_chatmsg', $data);
    
   }
   public function deletechat($id)
   {
      $this->db->query("delete from tbl_chatmsg where id='".$id."'");
   }
   
   public function  chnagetheme($input)
   {
       
            $this->db->query("update tbl_admin set theme='".$input["theme"]."'  where id='".$this->session->userdata('adminid')."'");
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
               if(!empty($input["month"]) && !empty($input["year"]) && !empty($input["day"]) )  
              {
                $dob=$input["year"]."-".$input["month"]."-".$input["day"];
              }else
              {
                $dob="0000-00-00";
              }
              
              
              $data = array('username' => $input["username"],
                            'email' => $input["email"],
                           'semail' => $semail,
                           'spassword' => $spass,
                           'dob' => $dob,
                            'facebook' => $input["facebook"],
                            'twitter' => $input["twitter"],
                            'instagram' => $input["instagram"],
                            'tumblr' => $input["tumblr"],
                            'flashmsg' => addslashes($input["flashmsg"])
                          );
          
             
                 if(!empty($input["adminprofile_image"]))
                 {         
                    $data['image'] = $input["adminprofile_image"]; 
                  
                    
                     $editdata=$this->getAdminDetail($input["id"]);
                     
                     if($input['adminprofile_image'] !=$editdata["image"])
                     {
                         if(!empty($editdata["image"]) && file_exists(SITE_UPLOADPATH.$editdata["image"]) )
                            {
                              unlink(SITE_UPLOADPATH.$editdata["image"]);
                            }
                     }
                 }
             
            $this->db->where('id', $input["id"]);
            $this->db->update('tbl_admin', $data);
     return true;     
    } 
    
    public function updateimage($id,$fieldname)
    {
      $data=array($fieldname=>"");  
        $this->db->where('id', $id);
            $this->db->update('tbl_admin', $data);
     return true;     
    } 
     public function sitesettingupdateimage($id,$fieldname)
    {
      $data=array($fieldname=>"");  
        $this->db->where('id', $id);
            $this->db->update('tbl_settings', $data);
     return true;     
    } 
    
     public function passwordupdate($input)
    {
      $data=array("password"=>md5($input["userpass"]));  
        $this->db->where('id', $input["id"]);
            $this->db->update('tbl_admin', $data);
     return true;     
    } 
    
     public function socialfeedupdate($input,$id)
    { 
      
        $this->db->where('id', $id);
            $this->db->update('tbl_socialfeeds', $input);  
       return true;     
    }  
    
    public function sitesettingsupdate($input,$id)
    { 
       
       if(!empty($input["adminprofile_image"]))
                 {         
                    $input['sitelogo'] = $input["adminprofile_image"]; 
                  
                    
                     $editdata=$this->getsettingsDetail($id);
                     
                     if($input['adminprofile_image'] !=$editdata["sitelogo"])
                     {
                         if(!empty($editdata["sitelogo"]) && file_exists(SITE_UPLOADPATH.$editdata["sitelogo"]) )
                            {
                              unlink(SITE_UPLOADPATH.$editdata["sitelogo"]);
                            }
                     }
                 }
                
       unset($input["adminprofile_image"]);
        $this->db->where('id', $id);
            $this->db->update('tbl_settings', $input);  
       return true;     
    }  
    
    public function GetAllRegion()
	{
	  $result=array();
	   $sql="SELECT * FROM tbl_regions";
        $sql.=" where status='1' "; 
        $sql.=" order by region_name "; 
       
       $query=$this->db->query($sql);
          return   $query->result();
            
	}
    
    public function changenoticestatus($id)
    {
         $strSql	= "Update  tbl_notelog set status='1' where admin_id = '".$this->session->userdata('adminid')."' and id ='".$id."' "; 
         $this->db->query($strSql);
    }
    
}
?>