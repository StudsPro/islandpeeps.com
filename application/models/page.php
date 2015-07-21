<?php
class Page extends CI_Model 
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
}
?>