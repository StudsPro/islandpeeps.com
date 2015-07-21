<?php
class Pages_model extends CI_Model 
{
  public function __construct()
	{
		$this->load->database();
		$this->load->helper('general_helper');
	}
 //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX Customer Module Start
  public function GetAllPage()
	{
		$sql = $this->db->query("SELECT * FROM tbl_pages");
        return $sql->result_array();
	}
    
 public function changePageStatus()
 {
 	foreach($_POST['delete'] as $key => $value)
		{
			if($_POST['status']=="-1")
				{$sqlstr="delete from tbl_pages where id=".$value;}
			else
				{$sqlstr="update tbl_pages set status='".$_POST['status']."' where id=".$value;}
			$this->db->query($sqlstr);
		}
 }
 public function GetPageById($page_id)
	{
	   $query = $this->db->query("SELECT id, menu_icon, page_title, detailed_description, status, video,page_synonums FROM tbl_pages where id=".$page_id);
	   return $query->result_array();
	}
    
  private function createpagesynonums($page_id,$stPage)
  {
        $page_synonums=urlencode($stPage);
         
        $query = $this->db->query("select page_synonums from tbl_pages where id!=".$page_id." and page_synonums='".$page_synonums."'");
	   $RsCount=$query->result_array();
	   if(count($RsCount)>0)
           {
                $stPage=$stPage."_1";
                $strPath=$this->createpagesynonums($page_id,$stPage);
                return $strPath;
           }
       else
            {return $page_synonums;}
  }
   public function check_title($name)
	{
    	$query = $this->db->get_where('tbl_pages', array('page_title' => $name));
    
    	 $data=$query->row_array();
        
         return count($data);
	}
    public function editcheck_title($id,$name)
	{
	      return   $this->db
		  ->where('page_title',$name) 
		  ->where('id <>',$id)  
		  ->count_all_results('tbl_pages');
	}
  public function addeditPage($Data,$page_id)
	{
	   
	   $page_synonums=$Data['page_title'];
       $page_synonums=$this->createpagesynonums($page_id,$page_synonums);
        
	   $query = $this->db->query("select page_synonums from tbl_pages where id!=".$page_id." and page_synonums='".$page_synonums."'");
	   $RsCount=$query->result_array();
	   if(count($RsCount)==0)
       		{
			    
				if($page_id==0)//Insert
					{//id, menu_icon, page_title, detailed_description, status, video,page_synonums
					   $sqlstr="Insert into tbl_pages (page_synonums, page_title, detailed_description, status)
						values('".$page_synonums."','".StriptStr($Data['page_title'])."','".StriptStr($Data['detailed_description'])."','1')";
					}
				else
					{
						$sqlstr="update tbl_pages set page_synonums='".$page_synonums."',page_title='".StriptStr($Data['page_title'])."',
                        detailed_description='".StriptStr($Data['detailed_description'])."', status='".$Data['status']."' where id=".$page_id;
					}
                    
                    $this->db->query($sqlstr);
                        return "ins";
			}
		else
			{return 0;}
	}
public function deletePage($page_id)
    {$this->db->query("delete from tbl_pages where id=".$page_id);}
 //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX Customer Module End 
 
     public function GetAllrecords()
	{

	   $sql="SELECT * FROM tbl_pages";
       $sql.=" order by page_title "; 
       // $sql = $this->db->query("SELECT * FROM tbl_ads order by title limit $start, $limit");
       $query=$this->db->query($sql);
        return $query->result_array();
	}
    public function getAllcount($searchdata)
    { 
        
        $sql="SELECT * FROM tbl_pages";
      if(!empty($searchdata))
       {
         $sql.=" where  page_title like '".$searchdata["searchstr"]."%'";	
       } 
        
         $sql.=" order by page_title ";
         
        $query = $this->db->query($sql);
        $data=$query->result_array();
         
        return count($data); 
    }

 public function GetadsById($id)
	{
	   $query = $this->db->query("SELECT * FROM tbl_pages where id=".$id);
	   return $query->result_array();
	}
 
   public function deleterecords($ids)
   {
      foreach($ids as $key => $value)
      {
            $this->deletePage($value);               
      }   
    
   }
   
    public function changestatus($ids,$status)
   {
      foreach($ids as $key => $value)
      {
            	$sqlstr="update tbl_pages set status='".$status."' where id=".$value;
			$this->db->query($sqlstr);      
      }   
    
   }  
}
?>