<?php
class Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged_in'))
		{
			if(!$this->session->userdata('is_admin'))
			{ redirect('admin');}
		}
		
	}

	public function index()
	{
	$this->session->sess_destroy();
	 redirect('/');
	}
}
?>