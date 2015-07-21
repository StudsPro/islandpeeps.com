<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

 class Events extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;
   
    function __construct()
   {				
	  parent::__construct();
      
		$this->load->helper('general_helper');
		$this->load->model('users');
		$this->load->model('events');
		$this->load->library('email');
   }

   function ajax()
   {    
      $_REQUEST['event'] = 'getprofile';
      $_REQUEST['value']="a";
   		if($_REQUEST['event'] == 'getprofile')
			{
				if(trim($_REQUEST['value'])!="")
					{$data =$this->events->event_getprofile($_REQUEST['value']);}
				else
					{$data =0;}		
				echo $data ;exit;

			} 
		else if($_REQUEST['event'] == 'getfullprofile')
			{
				if(trim($_REQUEST['value'])!="")
					{
						$data =$this->events->event_getfullprofile($_REQUEST['value']);
						if($data!="0"){echo json_encode($data);exit;}
					}
				echo "0";exit;
			}
		else
			{
 				$data =$this->events->event_calander_for_admin();
			}
		exit;
   }
}  
?>