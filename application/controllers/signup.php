<?php
class Signup extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
		$this->load->model('users');
		$this->load->library('email');
        $this->load->library('session');
        	$this->load->model('mandrill');
        $this->load->library('form_validation');
	}
    
    public function index()
    {
        $data                                  = array();
        $postdata                              = array();
        $data["page"]                          = "Sign Up";
       
        //$selectvehicletype                     = $this->input->post('select_vehicle');
        $selectvehicletype                     = $_POST['select_vehicle'];
        $postdata["post"]["vehicle_id"]        = $selectvehicletype; 
        foreach($this->session->userdata["post"] as $key => $val)
        {
            $postdata["post"][$key] = $val;
        }
       
        $this->session->set_userdata($postdata);
        //echo"<pre>"; print_r($this->session->userdata); exit;
        $data   = array
                       (
                        "firstname"                => $this->input->post('firstname'),
                        "lastname"                 => $this->input->post('lastname'),
                        "email"                    => $this->input->post('email'),
                        "phonenumber"              => $this->input->post('phonenumber'),
                        "registerpassword"         => $this->input->post('registerpassword'),
                        "registerconfirmpassword"  => $this->input->post('registerconfirmpassword'),
                        "username"                 => $this->input->post('username'),
                        "password"                 => $this->input->post('password'),
                       );
                 
        $this->load->view('header');
        $this->load->view('pages/signup',$data);
        $this->load->view('footer');
    }
    
    public function validate()
    {
       $data   = array();
       $data   = array
                       (
                        "firstname"               => $this->input->post('firstname'),
                        "lastname"                => $this->input->post('lastname'),
                        "email"                   => $this->input->post('email'),
                        "phonenumber"             => $this->input->post('phonenumber'),
                        "registerpassword"        => $this->input->post('registerpassword'),
                        "registerconfirmpassword" => $this->input->post('registerconfirmpassword'),
                        "AccountType"             => "0",
                       );
           // echo"<pre>first";print_r($data);          
       $this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
       $this->form_validation->set_rules('lastname', 'lastname', 'trim|required');
       $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
       $this->form_validation->set_rules('phonenumber', 'phonenumber', 'trim|required');
       $this->form_validation->set_rules('registerpassword', 'registerpassword', 'trim|required|matches[registerconfirmpassword]');
       $this->form_validation->set_rules('registerconfirmpassword', 'registerconfirmpassword', 'trim|required');
       
       if ($this->form_validation->run() === FALSE)
	   {
	        
	      $this->load->view('header');
          $this->load->view('pages/signup',$data);
          $this->load->view('footer');
	   }
       else
       {
           $checking_email=$this->users->check_username($data['email']);
		 
		   if(!empty($checking_email))
		   {
				$data['error_register'] = 'Account already exist  with the email . Try to login !';  	   // Email Exist  
		        
                $this->load->view('header');
                $this->load->view('pages/signup',$data);
                $this->load->view('footer');
		   }
		   else
		   {
			  // insert into db   // For Email varification
			  $data['verificationCode'] = md5(uniqid(Hashed_Password, true));
			  // User Privilage (Admin/super user)
			  $data['UserRole'] = 'CUSTOMER';
              $data['EmailValidation'] = '1'; 
			  $getdetail        = $this->users->create_user_new($data);
              
			  if($getdetail != 0)
			  {
                 $this->session->set_userdata('user_id', $getdetail);                        
				 // insert success  send email to the user for activation 
				 $subject='Activate Your Account';
				 $html_body='<p>Dear ' .$data['firstname'] .'</p>';
				 $html_body.='<p>Thanks for your registration . <a href=\"'.base_url().'verifyuser/emailvalidation/'.$data['verificationCode'].'\">Please click to verify your email</a></p>';
			     //$html_body.='<p>Thanks <br> Limousinecars</p>';
				 $mail_sending=$this->mandrill->send_email($subject,$html_body,$data['CompanyEmail'],$data['CompanyName']);
								 
		         $data['success'] = 'Account created';  
		         
                  redirect('bookingdetails');
			  }
			  else
			  {
		          $data['error'] = 'Error in Account Create . Contact with Admin';  
		          
                  $this->load->view('header');
                  $this->load->view('pages/signup',$data);
                  $this->load->view('footer'); 
              }
		   }
        }
     }
    
}    
?>