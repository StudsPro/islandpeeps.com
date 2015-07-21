<?php
    function StriptStr($text)
    {
        if(trim($text)!="") {$text=str_replace("'","''",$text);}
        return $text;
    }
    
function TrimStr($text,$chars)
    {
        if(trim($text)!="")
        {
            if(strlen($text)>$chars)
            {
                $text = substr($text,0,$chars);
                $text = $text."...";
            }    
        }
        return $text;
    }
    function getMaxId($table,$pid)
    {
        $ci=& get_instance();
        $ci->load->database(); 
        $sql = "SELECT MAX(".$pid.") AS myId FROM ".$table.""; 
        $query = $ci->db->query($sql);  
        $rows = $query->result_array();
        
        foreach($rows as $list)
        {$id = $list['myId'];}      
        
        if($id==0)
       {
         $id = 1;
       } 
        else
       {
         $id = $id+1;
       }  
       
       return $id;
    }
    
   
    function curl_post_to_another_domain( $arrValues = array(), $strAnotherDomainPage = '', $strReturnValueFormat = 'array' ) {
		//$strReturnValueFormat = 'object'
		if( !extension_loaded( "curl" )) {
			echo( '<font color=\'red\'>cURL extension is not loaded in PHP.ini file.</font>' );
			exit();	    
		} 
		
		//extract( $arrValues ); -> extract the values from array to individual variables
		//display($arrValues);	
		$arrFields = array();
		if( 0 < sizeof( $arrValues )) {
			foreach( $arrValues as $strIndex => $strValue ) {
				$arrFields[$strIndex] = urlencode( $strValue );
			}
		}
		
		$strFieldsString = '';
		if( 0 < sizeof( $arrFields )) {
			foreach( $arrFields as $strKey => $strValue ) { $strFieldsString .= $strKey .'=' . $strValue . '&'; }
			$strFieldsString = rtrim( $strFieldsString, '&' );
		}
			
		//display($strFieldsString);
		//open connection
		$ch = curl_init();
		
		$arrResult = array();
		if( $ch ) {
			//set the url, number of POST vars, POST data
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch, CURLOPT_URL, $strAnotherDomainPage );//'http://domain.com/get-post.php';			
			if( 0 < count( $arrFields )) {
				curl_setopt( $ch, CURLOPT_POST, count( $arrFields ));
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $strFieldsString );
			}
			
			/*
			display( $strAnotherDomainPage );
			display( count( $arrFields ));
			display( $strFieldsString );
			*/
			
			//execute post
			if( false === ( $arrResult = curl_exec( $ch ))) {
				 echo '<font color=\'red\'>Curl error: ' . curl_error($ch) . '</font>';	
				 exit();		
			}		
			
			//display( $arrResult );
			
			//close connection
			curl_close($ch);
		} else {
			echo( '<font color=\'red\'>Error in curl initialization.</font>' );
			exit();
		}
	
		if( 'object' == $strReturnValueFormat ) {
			return json_decode( $arrResult );
		} else {
			return json_decode( $arrResult, true );
		}
	}  
     function setSeoCompUrlStr($sStr)   
     {
      	$sSeoUrl = '';
      	$sStr = trim($sStr);
		if($sStr != '')
		  {
			$sStr= trim(preg_replace('/&amp;/',' and ', $sStr));
			$sStr= trim(preg_replace('/&/',' and ', $sStr));
			$sStr= trim(preg_replace('/\s\s+/',' ', $sStr));
			$sStr= strtolower($sStr);  
			$sStr= strtolower(str_replace("&amp;","and",$sStr)); 
			$sStr= str_replace("&#039;","",$sStr);
			$sStr= str_replace("&nbsp;","-",$sStr);
			$sStr = preg_replace('/[\s-]+/', '-', $sStr);
		  }
      	return $sStr;
     }
     
    function msgDisplay($type,$msgs)
    {
       if($type=="ins" || $type=="upd")
       		{$msg ='<div class="alert alert-success">';} 
       if($type=="del")
       		{$msg='<div class="alert alert-warning">';}  
	   if($type=="error")
       		{$msg = '<div class="alert alert-danger">';}
       echo $msg.'<button class="close" aria-hidden="true" data-dismiss="alert" type="button">�</button>'.$msgs.'</div>';
    } 
    
    function checkadmin($username)
    {
        $ci=& get_instance();
        $ci->load->database(); 
        $query = $ci->db->query("SELECT * FROM tbl_admin WHERE username='".$username."' AND superadmin='1'");
        if($query->num_rows() == 0)
        	{return false;}
        else
        	{return true;} 
    }
    
    function getImgAttr($sAttributeName, $sImgTag)  
  {
      $aAttrArray = array();
      
      $result = "";
      preg_match_all('/('.$sAttributeName.')=("[^"]*")/i',$sImgTag, $aAttrArray);
      if( count($aAttrArray[0]) == 0)
     {
        $result = "Image atribute not found";
     }
      else
     {
        $result = $aAttrArray[0][0];
     }
     
      return $result;
   
  } 
  
    function setImgAttr($sAttributeName, $sAttrValue, $sImgTag)
  {
    $newAttr = $sAttributeName."=\"".$sAttrValue."\"";
    $sImgAttr = getImgAttr($sAttributeName, $sImgTag) ;
    $sImgTag = str_replace($sImgAttr,$newAttr,$sImgTag);
    return $sImgTag;
  }
    
    function pr($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
	function getLastUriSeg($dataspacfic)
    {
        $arr =Array();
        $arr = explode("/",$dataspacfic);
        $last_segment = end($arr);
        return $last_segment;
    }
	function is_admin_log_in()
	{
		$ci=& get_instance();
		if(!$ci->session->userdata('logged_in'))
			{redirect(base_url());}
		else
			{
				if(!$ci->session->userdata('is_admin'))
					{redirect(base_url());}
				else
					{return true;}
			}
			
	}

function get_todayevent_general()
    {
          $ci=& get_instance();
            $ci->load->database();  
	      $rsRecord=0;
          $strSql = "
            SELECT id FROM tbl_events  where  '".date('Y-m-d')."' BETWEEN DATE(start) AND DATE(end)
            union
            SELECT id FROM tbl_profiles  where   DAY(dob) = DAY('".date('Y-m-d')."') and MONTH(dob) = MONTH('".date('Y-m-d')."')
            union
            SELECT id FROM tbl_profiles  where status='4' and  DATE(postdate)=DATE('".date('Y-m-d')."')
            union
            SELECT id FROM tbl_admin where dob!='0000-00-00' and DAY(dob) = DAY('".date('Y-m-d')."') and MONTH(dob) = MONTH('".date('Y-m-d')."')
          ";
          $sql = $ci->db->query($strSql);
          $rsRecord=count($sql->result_array());
	      return $rsRecord;
    }
    
   function get_todayevent()
{
	 $ci=& get_instance();
            $ci->load->database();  
	 $strSql = "SELECT count(*) as todayevents FROM tbl_events  where  '".date('Y-m-d')."' BETWEEN DATE(start) AND DATE(end)";
      $sql1 = $ci->db->query($strSql);
      $todayevents1=count($sql1->result_array());       

	  $strSql1 = "SELECT count(*) as todayevents FROM tbl_profiles  where   DAY(dob) = DAY('".date('Y-m-d')."') and MONTH(dob) = MONTH('".date('Y-m-d')."') ";
		 $sql2 = $ci->db->query($strSql1);
      $todayevents2=count($sql2->result_array());       

	   $strSql2 = "SELECT count(*) as todayevents FROM tbl_profiles  where status='4' and  DATE(postdate)=DATE('".date('Y-m-d')."') ";
 		
         $sql3 = $ci->db->query($strSql2);
      $todayevents3=count($sql3->result_array());       

        
 $strSql3= "SELECT count(*) as todayevents FROM tbl_admin where dob!='0000-00-00' and DAY(dob) = DAY('".date('Y-m-d')."') and MONTH(dob) = MONTH('".date('Y-m-d')."') ORDER BY id"; 
 $sql4 = $ci->db->query($strSql3);
      $todayevents4=count($sql4->result_array());       

 
 			 return ($todayevents1 + $todayevents2 + $todayevents3  + $todayevents4  );
			 
}  
       function get_adminnotification()
            {
            	 $ci=& get_instance();
                        $ci->load->database();  
               
            	$strSql = "SELECT * FROM `tbl_notificationlog` WHERE ! FIND_IN_SET( '".$ci->session->userdata('adminid')."', `adminids` ) ORDER BY ID DESC";
             			$objRs = $ci->db->query($strSql);
             
            			return  $objRs->result_array();
            }  
          function get_afftask()
          {
	          $ci=& get_instance();
                        $ci->load->database();  
               
   
	       $strSql = "SELECT * FROM tbl_task  where admin_id ='".$ci->session->userdata('adminid')."' and status IN ('1','2') ORDER BY ID DESC";
 			$objRs = $ci->db->query($strSql);
             
            			return  $objRs->result_array();
            }   
            
            function get_comptask()
        {
        	  $ci=& get_instance();
                        $ci->load->database();  
               
          	 $strSql = "SELECT * FROM tbl_task  where status = '3' and sadmin_id ='".$ci->session->userdata('adminid')."' ORDER BY ID DESC";
        	  		$objRs = $ci->db->query($strSql);
             
            			return  $objRs->result_array();
        }
            
           function get_readyprofile()
{  $ci=& get_instance();
                        $ci->load->database();  
               
	 
	   $strSql = "SELECT title,id  FROM  tbl_profiles where status='3'"; 
			$objRs = $ci->db->query($strSql);
             
            			return  $objRs->result_array();
	  
}
    function get_notelog()
{
	 $ci=& get_instance();
                        $ci->load->database();  
               
	  $strSql = "SELECT *  FROM  tbl_notelog  where admin_id='".$ci->session->userdata('adminid')."' and status='0'"; 
		$objRs = $ci->db->query($strSql);
             
            			return  $objRs->result_array();
			 
}
 function get_rejectprofile()
{  $ci=& get_instance();
                        $ci->load->database();  
               
	 
	    $strSql = "SELECT title,id,rejectreason  FROM tbl_profiles  where status='2' and admin_id='".$ci->session->userdata('adminid')."' and rejectreason!=''";  
				$objRs = $ci->db->query($strSql);
             
            			return  $objRs->result_array();
	  
}  
  
   function admin_getprofile()
   {
    $ci=& get_instance();
                        $ci->load->database();  
     
 	    	$strSql = "SELECT A.*,B.username FROM tbl_profiles A LEFT JOIN tbl_admin B on A.admin_id = B.id where 1=1  order by A.`createdate` DESC LIMIT 0 , 20";
	  	$objRs = $ci->db->query($strSql);
             
            			return  $objRs->result_array();	 

   } // End Function
            
function get_user_semail_list()
    {
          $ci=& get_instance();
            $ci->load->database(); 
             $uid=$ci->session->userdata('uid'); 
	      $rsRecord=0;
          $strSql = "SELECT semail FROM tbl_admin where  id='".$uid."'";
          $query = $ci->db->query($strSql);
          $rsArr=$query->result_array();
           if(count($rsArr) > 0)
           {
            return $rsArr[0]['semail'];
           }
           else
	       {return "";}
    }
        
function CountUnreadMail() 
{
    if($_SERVER['HTTP_HOST']!="devil")
    {/*
    $host="{".$_SERVER['SERVER_NAME'].":143/notls}";
    $ci=& get_instance();
    $ci->load->database();
    
    $uid=$ci->session->userdata('uid');
     
    $query = $ci->db->query("SELECT * FROM tbl_admin WHERE id='".$uid."'");
    $rsArr=$query->result_array();
    if(count($rsArr) > 0)
    	{
    	   
    	   if(trim($rsArr[0]['semail'])!="")
    	   $seamils = explode(',',$rsArr[0]['semail']);  
           $spasswords = explode('-|-',$rsArr[0]['spassword']);
           $count = 0;
           $maildata['maildata'] =array();
           for($i=0;$i<count($seamils);$i++)
            {
                $user=$seamils[$i];
                $pass=$spasswords[$i];
                $mbox = imap_open($host, $user, $pass);
                if ($mbox) 
                {
                    $headers = imap_headers($mbox);
                    foreach ($headers as $mail) 
                    {
                        $flags = substr($mail, 0, 4);
                        $isunr = (strpos($flags, "U") !== false);
                        if ($isunr)
                        $count++;
                    }
                }
                $emails = imap_search($mbox,'UNSEEN');
                
                foreach($emails as $email_number)
                {
            	  $overview = imap_fetch_overview($mbox,$email_number,0);
                  $overview1['from'] = $overview[0]->from;
                  $overview1['date'] = $overview[0]->date;
                  $overview1['subject'] = $overview[0]->subject;
                  $overview1['eid'] = $i;
                  $maildata['maildata'][]=$overview1;    
                }
            }
            $data = array_merge(array('count'=> $count),$maildata);
            imap_close($mbox);
            return $data;
        }
    else
        {return 0;}
  */}  
  
  function removeUnsed($urlString)
		{
		   $arrSearch = array("!", "@", "#", "$", "%", "^", "&", "*", "(", ")", ":", "?",",","<",">","/", "~","`", "'"," ",'"',"=",".");
		   $arrReplace = array("-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-", "-","-","-","-");
		   $cleanURL = str_replace($arrSearch, $arrReplace, $urlString);
		   
		   $arrSe = array("--", "---", "----", "-----");
		   $arrRe = array("-", "-", "-", "-");
		   $cleanURL = str_replace($arrSe, $arrRe, $cleanURL);
		   $cleanURL = str_replace("-", "", $cleanURL);
		   
		   return strtolower($cleanURL);
		}
		
  function mpeg2flv($video_file, $convertName)
{
	$ffmpegPath = "/usr/local/bin/ffmpeg";
	$flvtool2Path = "/usr/local/bin/flvtool2";
	
	$videoWebFile = "upload/".$convertName.".webm"; 
	$videoThumbFile = "upload/".$convertName.".jpg"; 
	$videoMp4File = "upload/".$convertName.".mp4"; 
	$videoFlv = "upload/".$convertName.".swf"; 
	
	if(!file_exists($videoMp4File) || filesize($videoMp4File)==0)
	{
	 //exec("$ffmpegPath -i $video_file -sameq -ar 22050  $videoMp4File");
	  exec("$ffmpegPath -i $video_file -b 1500k -vcodec libx264 -vpre slow -vpre baseline -g 30 $videoMp4File");
	  if(filesize($videoMp4File)==0)
	  {
	    exec("$ffmpegPath -i $video_file -vcodec copy -acodec copy $videoMp4File");
	  }
	} 
	
	if(!file_exists($videoWebFile))
	{ 
	   exec("$ffmpegPath -i $video_file  -b 1500k -vcodec libvpx -acodec libvorbis -ab 160000 -f webm -g 30 $videoWebFile");
    }	
	
	//exec("$ffmpegPath -i $video_file -sameq -ar 22050  $videoFlv");*/
	
     unlink($videoThumbFile);
	 exec("$ffmpegPath -i $video_file -an -r 4 -y -s 1024x768 $videoThumbFile");
	
	return $convertName;
}

/**
* Function to create video thumbnail using ffmpeg
*/
function create_movie_thumb($src_file, $convertName)
{
$ffmpegPath = "/usr/bin/ffmpeg";

$imgName = $convertName.".jpg";
$dest_file = SITE_ABSPATH."upload/video/".$imgName;

//exec("$ffmpegPath -i $src_file -an -ss 00:00:03 -t 00:00:01 -r 1 -y -s 128\D7100 $dest_file");
exec("$ffmpegPath -i $src_file -an -r 10 -y -s 1366x768 $dest_file");
return $imgName;
}
}

function removeSpace($text)
		{
		   $code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','/','*','+','~','`','=');
		
		  $code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','');
		
		  $text = str_replace($code_entities_match, $code_entities_replace, $text); 
		  return $text;
		}
		
function removeAmpersandCharacter($text)
		{
		   $code_entities_match = array('&');
		
		  $code_entities_replace = array('and');
		
		  $text = str_replace($code_entities_match, $code_entities_replace, $text); 
		  return $text;
		}
        
        
?>