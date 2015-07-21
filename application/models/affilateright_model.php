<?php
class Affilateright_model  extends CI_Model 
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
       // $sql = $this->db->query("SELECT * FROM tbl_ads order by title limit $start, $limit");
       $query=$this->db->query($sql);
        return $query->result_array();
	}
    public function GetAllmodules()
	{

	   $sql="SELECT * FROM tbl_modules";
       $sql.=" order by title "; 
       // $sql = $this->db->query("SELECT * FROM tbl_ads order by title limit $start, $limit");
       $query=$this->db->query($sql);
        return $query->result_array();
	}
    public function Getaffilatemodules($affilateid)
	{
        $results_arr=array();
	   $sql="SELECT * FROM tbl_modulesrights where affilateid='".$affilateid."'";
       $query=$this->db->query($sql);
        $results= $query->result_array();
       foreach($results as $key => $value)
       {
        $modulename=$value["modulesname"];
        $results_arr[$modulename]=$value["rights"];
       } 
      return $results_arr;  
	}  
    
    
     public function GetAllaffilates()
	{
	  $result=array();
	   $sql="SELECT * FROM tbl_admin";
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
     public function saveright($input,$id)
    {
       if(!empty($input["affilaterights"]))     
        {       
            //tbl_modulesrights
            
            $this->db->query("delete from tbl_modulesrights where affilateid='".$id."'");
          foreach($input["affilaterights"] as $modulename => $getrights)
          {  
             $rights=implode(",",$getrights);
             $data = array('modulesname' => $modulename,
                           'rights' => $rights, 
                           'affilateid' => $id
                         );
             $this->db->insert('tbl_modulesrights', $data); 
             
            
              $insertid= $this->db->insert_id();
           }    
         }      
     return true;   
    }
    
     public function update($input)
    {
        
       
          if($input["id"]==7)
          {
             if(!empty($input["ads_image"]))
                 {         
                    $data['image'] = $input["ads_image"]; 
                 }   
          }else
          {
            $regions="";  
              if(!empty($input["regions"]))
              {
                 $regions=implode(",",$input["regions"]);
              } 
               
             $data = array('title' => $input["title"],
                           'type' => $input["type"], 
                           'regions' => $regions
                          );
                 if(!empty($input["ads_image"]))
                 {         
                    $data['image'] = $input["ads_image"]; 
                     $editdata=$this->GetadsById($input["id"]);
                     
                     if(!empty($editdata[0]["image"]) && $data['filetype'] !=$editdata[0]["filetype"])
                     {
                         if(!empty($editdata[0]["image"]) && file_exists(SITE_UPLOADPATH.$editdata[0]["image"]) )
                            {
                              unlink(SITE_UPLOADPATH.$editdata[0]["image"]);
                              
                              $this->db->query("update tbl_ads set filetype='' where id='".$input["id"]."' ");
                            }
                     }
                     
                            $arrvideo_value=array(".mp4",".flv",".bat"); 
                             if(in_array($data['filetype'],$arrvideo_value))
                             { 
                                 $this->mpeg2Mp4(SITE_UPLOADPATH.$data['image'],$data['image']);   
                             } 
                     
                 }
            if(isset($input["video_name"]))
          {
            $data["image"]=$input["video_name"];
          }
          
        }  
                 
            $this->db->where('id', $input["id"]);
            $this->db->update('tbl_ads', $data);
     return true;     
    } 
    
    public function updateimage($id,$fieldname)
    {
      $data=array($fieldname=>"");  
        $this->db->where('id', $id);
            $this->db->update('tbl_ads', $data);
     return true;     
    }   
    
    public function getmaxid($id,$tablename)
  {
     return $this->db->query("select if(count($id)=0,1,max($id)+1 ) as maxid from $tablename ")->row()->maxid;
    
  } 
  public function setbackgroundimage($id)
   {
    
     $this->db->query("update tbl_ads set setbackground='0' ");
     
     $this->db->query("update tbl_ads set setbackground='1' where id='".$id."'");
     
     
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
            
           $this->db->query("delete from tbl_ads where id='".$value."'");                      
      }   
    
   } 
}
?>