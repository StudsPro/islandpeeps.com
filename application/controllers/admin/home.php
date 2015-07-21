<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

 class Home extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;
   
    function __construct()
   {				
	  parent::__construct();
      
      $this->load->helper('general_helper');
	  $this->load->model('users');
      $this->load->library('form_validation');
   }

   function index($page = 'login')
   {    
   		if($this->session->userdata('logged_in'))
			{
				if($this->session->userdata('is_admin'))
					{redirect(base_url()."admin/dashboard");}
			}
			
	  $data['title'] = ucfirst($page); // Capitalize the first letter
             $data['title'] = 'Sign in';
             $data['sitetitle']       = 'Sign in';
    	     $data['page_title']       = 'Sign in';
	 if($this->input->post() == "")
	 {
	 	$this->load->view('admin/login', $data);	
	 }
	 else
	 {
	 	
	 	$this->form_validation->set_rules('username', 'Username', 'required');
	    $this->form_validation->set_rules('password', 'Password', 'required');
		
        $username   =  $this->input->post('username', TRUE);
		$password   =  $this->input->post('password', TRUE);
		if($this->form_validation->run() === FALSE)
		{
			$this->session->set_flashdata('error', 'Enter username and password');
			$this->load->view('admin/login', $data);	
		}
		else
		{
			
			$checking_email = $this->users->admin_Login($username,$password,"ADMIN");
			
			
			if(empty($checking_email))
			   {
				 $this->session->set_flashdata('error', 'Wrong username or password');
				 $this->load->view('admin/login', $data);	
			   }
			else
				{
				   $uid=$checking_email['id'];
				   $username=$checking_email['username'];
				   $newdata = array('uid'=> $uid,'username' => $username,'logged_in' => TRUE,'is_admin' => TRUE,
                   'sadmin'=>$checking_email['superadmin'],'adminid'=>$uid);
				   $this->session->set_userdata($newdata);
				   redirect('admin/dashboard');
				}  
		}
	 }
     
    }
   
         function logout()
        {
            $user_data = $this->session->all_userdata();
            
                foreach ($user_data as $key => $value) {
                    if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                        $this->session->unset_userdata($key);
                    }
                }
            $this->session->sess_destroy();
            redirect('admin');
        }
     
      function forgotpassword()
        {
             
         $this->form_validation->set_rules('forgotmail', 'Email', 'required|callback_email_check');
	     $config = array(
                array(
                     'field'   => 'forgotmail',
                     'label'   => "Email ",
                     'rules'   => 'required|callback_email_check'
                  )
           );
		
        
	
		  $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		    $forgotmail   =  $this->input->post('forgotmail');
			$this->users->sendpass($forgotmail);
            $this->session->set_flashdata('mailsucess', "Password has been sent to your email address,check your email");
            redirect("admin");
		}
             
             
             $datas['title'] = 'Forgot Password';
             $data['sitetitle']       = 'Forgot Password';
    	     $datas['page_title']       = 'Forgot Password';
             
             
             $this->load->view('admin/forgot', $datas);	
        }
        
         public function email_check($str)
        	{
        		if ($this->users->check_email($str) == 0)
        		{
        			$this->form_validation->set_message('email_check', '('.$str.') does not exists.');
        			return FALSE;
        		}
        		else
        		{
        			return TRUE;
        		}
        	}   
}  
?>