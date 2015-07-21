<?php
class Stats_model  extends CI_Model 
{
  public function __construct()
	{
		$this->load->database();
		$this->load->helper('general_helper');
	}
 //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX Customer Module Start
 public function add_events($input)
 {
    	$title = $input['title'];
	$start = $input['start'];
	$end = $input['end'];
   
	if($title <> '' && $start <> '' && $end <> ''){
 	$sql = "INSERT INTO tbl_events (title, start, end) VALUES ('".$title."', '".$start."', '".$end."')";
	   $this->db->query($sql);
     }  
    
 }
  public function Getcategory()
	{
	  $result=array();
	   $sql="SELECT * FROM tbl_category";
       
        $sql.=" order by category "; 
       
       $query=$this->db->query($sql);
       $data=$query->result_array();
          
          if(!empty($data))
          {
            foreach($data as $key => $detail)
             {
              $id=trim($detail["category"]);   
              $result[$id]=trim($detail["category"]);  
                
             }
          }
          
       return $result;  
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
}
?>