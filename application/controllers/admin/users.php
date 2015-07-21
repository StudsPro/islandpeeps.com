<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

 class profile extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;
   
    function __construct()
   {				
	  parent::__construct();
      
      $this->load->helper('general_helper');
	  $this->load->model('users');
   }

   function index($page = 'login')
   {  
   	
   }
   
         function logout()
        {
            $user_data = $this->session->all_userdata();
            echo "<pre>";
            print_r($user_data);
            exit;
                foreach ($user_data as $key => $value) {
                    if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                        $this->session->unset_userdata($key);
                    }
                }
            $this->session->sess_destroy();
            redirect('default_controller');
        }
        
    function myprofile()
    {
        
       $id=$this->session->userdata('adminid'); 
        $editdata=$this->users->getAdminDetail($id);
        
        echo "<pre>";
        print_r($editdata);
        exit;
    }    
}  
?>