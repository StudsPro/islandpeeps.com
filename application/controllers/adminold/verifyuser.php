<?php
class Verifyuser extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->model('curl');
		$this->load->model('users');
		$this->load->library('email');
       
	}

	public function index()
	{ 
		$data['title'] = 'Login:';
		$data['page']='login';
	    
        $this->form_validation->set_rules('username', 'Username', 'required');
	    $this->form_validation->set_rules('password', 'Password', 'required');
		
        $username   =  $this->input->post('username', TRUE);
		$password   =  $this->input->post('password', TRUE);
		
         if($this->form_validation->run() === FALSE)
        {
           redirect('admin');
        }
	     else
	    {
		    $checking_email = $this->users->admin_Login($username,$password,"ADMIN");
		    
            if(empty($checking_email))
		   {
		  	  $data['error'] = 'Wrong username or password';  
		     redirect('admin');
		   }
		    else
		   {	
			   $uid=$checking_email['id'];
			   $username=$checking_email['username'];
			  
			   $newdata = array(
				   'uid'	=> $uid,	
                   'username'  => $username,
                   'logged_in' => TRUE,
				   'is_admin' => TRUE,
               );
		       
               $this->session->set_userdata($newdata);
		
               redirect('admin/dashboard');
		    }
	     }
	  }
	
	public function emailvalidation($code)
	{
		$data['title'] = 'Login:';
		$data['page']='login';
		if(!empty($code))
		{
			if($this->users->emailvalidate($code))
			{
				$data['success'] = 'Account Activated . Try to login'; 
			}
			else
			{
		$data['error'] = 'Wrong Authentication'; 
		
			}
		}
		$this->load->view('admin/header', $data);	
		$this->load->view('admin/pages/login');
		$this->load->view('admin/footer');
	}
	
}
?>