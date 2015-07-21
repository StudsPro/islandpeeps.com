<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Affilateright extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;

    function __construct()
        {
            parent::__construct();
            if(!$this->session->userdata('logged_in')){redirect('/');}
            $this->load->model("affilateright_model");
            
            $this->load->helper("file");
            $this->load->library('upload');
            $this->load->library('form_validation');
            $this->load->helper('general_helper');
            $this->load->library('image_lib');
            $this->load->library('pagination');
            $this->load->library('breadcrumbs');
        }

   function index($affilateid=0)
	   { 
	   		
		
			  // add breadcrumbs
         //  $this->breadcrumbs->push('Home', '/admin/dashboard');
          $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Permissions', "/admin/affilateright" );
          // $this->breadcrumbs->push('<a href="#ignore">Permissions</a>', "&nbsp;" );
           
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Permissions';
            $data['page_title']       = 'Permissions';
			$data['page_action'] = 'Permissions';
            
            //******************************************************
             if(!empty($_POST))
             {
                
                
                $this->affilateright_model->saveright($this->input->post(),$affilateid);
                
                
             }  
                 
        //***********************************************************
         if($affilateid >0)
         {
          $data['results'] = $this->affilateright_model->GetAllmodules();
          $data['resultsaffilate'] = $this->affilateright_model->Getaffilatemodules($affilateid);
          
         } 
          $data['affilates'] = $this->affilateright_model->GetAllaffilates($affilateid);
          $data['affilateid'] =$affilateid;
          
		  $this->openView($data,'index');
	   }
    	private function openView($xdata,$viewName)
    	{
    	
    		$this->load->view('admin/header', $xdata);
    		$this->load->view('admin/affilateright/'.$viewName,$xdata);
    		$this->load->view('admin/footer');
    	}
}
?>