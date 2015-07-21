<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;

    function __construct()
        {
            parent::__construct();
            if(!$this->session->userdata('logged_in')){redirect('/');}
            $this->load->model("calendar_model");
            
            $this->load->helper("file");
            $this->load->library('upload');
            $this->load->library('form_validation');
            $this->load->helper('general_helper');
            $this->load->library('image_lib');
            $this->load->library('pagination');
            $this->load->library('breadcrumbs');
        }

   function index($id="")
	   { 
	   		
		
			  // add breadcrumbs
         //  $this->breadcrumbs->push('Home', '/admin/dashboard');
          $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('<a href="#ignore">Calendar</a>', "&nbsp;" );
           
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Calendar ';
            $data['page_title']       = 'Calendar';
			$data['page_action'] = 'Calendar';
            
           	$data['dobcount'] = $this->calendar_model->dob_count();
            
           
               
         
		  $this->openView($data,'index');
	   }
     function getdata($id="")
    {
         $serachdata=array();
         
             
             if($this->input->get('g'))
             {
               $serachdata["g"] =$this->input->get('g');
               $serachdata["event"] ="";
               $serachdata["pastyear"] =""; 
             }
             
              if(isset($_REQUEST['event']))
             {
               $serachdata["event"] =$_REQUEST['event'];
               $serachdata["value"] =$_REQUEST['value'];
               $serachdata["g"] ="";
               $serachdata["pastyear"] =""; 
               
               
             }
             
              if($this->input->get('pastyear'))
             {
               $serachdata["pastyear"] =$this->input->get('pastyear');
               $serachdata["g"] ="";
               $serachdata["event"] =""; 
             }
             $g=$this->input->get('g');
             $event=$_REQUEST['event'];//$this->input->get('event');
             $pastyear=$this->input->get('pastyear');
             
             if(empty($g) &&  empty($event) && empty($pastyear))
             {
                 $serachdata["pastyear"] ="";
               $serachdata["g"] ="";
               $serachdata["event"] ="";  
             }
          //***********************************************************
        
          $data['results'] = $this->calendar_model->GetAllrecords($serachdata); 
          
        
        
    }
    function go($id="")
    {
         $serachdata=array();
             $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('<a href="#ignore">Calendar</a>', "&nbsp;" );
           
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Calendar ';
            $data['page_title']       = 'Calendar';
			$data['page_action'] = 'Calendar';
             
             if($this->input->get('g'))
             {
               $serachdata["g"] =$this->input->get('g');
               $serachdata["event"] ="";
               $serachdata["pastyear"] =""; 
             }
             
              if($this->input->get('event'))
             {
               $serachdata["event"] =$this->input->get('event');
               $serachdata["g"] ="";
               $serachdata["pastyear"] =""; 
             }
             
              if($this->input->get('pastyear'))
             {
               $serachdata["pastyear"] =$this->input->get('pastyear');
               $serachdata["g"] ="";
               $serachdata["event"] =""; 
             }
             $g=$this->input->get('g');
             $event=$this->input->get('event');
             $pastyear=$this->input->get('pastyear');
             
             if(empty($g) &&  empty($event) && empty($pastyear))
             {
                 $serachdata["pastyear"] ="";
               $serachdata["g"] ="";
               $serachdata["event"] ="";  
             }
          //***********************************************************
        
          $data['results'] = $this->calendar_model->GetAllrecords($serachdata); 
          
        $this->openView($data,'index');
        
    }
    
     function add_events()
  {
  
       
      $this->calendar_model->add_events($_POST);   
 	 
  }
   function update_events()
  {
     $this->calendar_model->update_events($_POST);  

  }
   function delete_events()
  {
 
	$id = $_POST['id'];
	
	if($id <> ''){
 	 
      $this->calendar_model->delete_events($id);   
       
 	} 
  } 
    
      
  	private function openView($xdata,$viewName)
	{
	
		$this->load->view('admin/header', $xdata);
		$this->load->view('admin/calendar/'.$viewName,$xdata);
		$this->load->view('admin/footer');
	}
    
    public function setbackgroundimage()
    {
          $editid=$this->input->post("editid");
          $this->affiliate_model->setbackgroundimage($editid); 
    }  
}
?>