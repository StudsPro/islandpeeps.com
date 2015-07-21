<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Imailboxs extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;

    function __construct()
        {
            parent::__construct();
            if(!$this->session->userdata('logged_in')){redirect('/admin');}
            $this->load->model("imailbox_model");
            
            $this->load->helper("file");
            $this->load->library('upload');
            $this->load->library('form_validation');
            $this->load->helper('general_helper');
            $this->load->library('image_lib');
            $this->load->library('pagination');
            $this->load->library('breadcrumbs');
        }
 function viewmail($getid="")
	   { 
	   		
	
			  // add breadcrumbs
         //  $this->breadcrumbs->push('Home', '/admin/dashboard');
          $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('<a href="#ignore">Modify/Listing Profiles</a>', "&nbsp;" );
           
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Modify/Listing Profiles ';
            $data['page_title']       = 'Modify/Listing Profiles ';
			$data['page_action'] = 'Modify/Listing Profiles';
            
            //******************************************************
             $serachdata=array();
           
           //***********************************************************
         
        
        $data['viewmails'] = $this->imailbox_model->viewmail($getid); 
        
         $data['viewmails_data'] = $this->imailbox_model->viewmail_data($getid); 
         $data['adminuser_data'] = $this->imailbox_model->get_adminamails(); 
                
        
		  $this->openView($data,'viewmail');
	   }
	   function forward()
	   {
		  $this->imailbox_model->saveforward($this->input->post());
	   	  $this->session->set_flashdata('sucess', "Email have been forward successfully.");
                  
                 redirect('admin/imailboxs');  
	}
	  function compose()
	   {
		  $this->imailbox_model->savecompose($this->input->post());
	   	  $this->session->set_flashdata('sucess', "Email have been send successfully.");
                  
                 redirect('admin/imailboxs');  
	}
	  
	 
	   function reply()
	   {
	   	 $this->imailbox_model->savereply($this->input->post());
	   	 $this->session->set_flashdata('sucess', "Email have been send successfully.");
                  
                 redirect('admin/imailboxs');  
		  
	}
	   function adminsendmails($getid="")
	   { 
	   		
	
			  // add breadcrumbs
         //  $this->breadcrumbs->push('Home', '/admin/dashboard');
          $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('<a href="#ignore">Modify/Listing Profiles</a>', "&nbsp;" );
           
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Modify/Listing Profiles ';
            $data['page_title']       = 'Modify/Listing Profiles ';
			$data['page_action'] = 'Modify/Listing Profiles';
            
            //******************************************************
             $serachdata=array();
           
           if($this->input->post("btn_delete"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                  
                   if(!empty($selected))
                   {
                       $this->imailbox_model->deleterecords($selected);
                     $this->session->set_flashdata('sucess', " ".count($selected)." emails have been deleted successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                 redirect('admin/imailboxs/adminsendmails');  
           }     
          
            
        //***********************************************************
         $filter["fillter"]="";
         if($getid)
         {
             $filter["fillter"]= $getid;
             $data['fillter'] =$getid;
         }else
         {
             $data['fillter'] ="";
         }
        
         // $data['results'] = $this->imailbox_model->GetAllrecords($serachdata,$limit,$start);
           $data['adminuser_data'] = $this->imailbox_model->get_adminamails(); 
          $data['results'] = $this->imailbox_model->admin_mailsent($filter); 
		  $this->openView($data,'sendmail');
	   }
   function index($getid="")
	   { 
	   		
	
			  // add breadcrumbs
         //  $this->breadcrumbs->push('Home', '/admin/dashboard');
          $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('<a href="#ignore">Modify/Listing Profiles</a>', "&nbsp;" );
           
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Modify/Listing Profiles ';
            $data['page_title']       = 'Modify/Listing Profiles ';
			$data['page_action'] = 'Modify/Listing Profiles';
            
            //******************************************************
             $serachdata=array();
           
           if($this->input->post("btn_delete"))
            { 
            	
            	
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->imailbox_model->deleterecords($selected);
                     $this->session->set_flashdata('sucess', " ".count($selected)." emails have been deleted successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                 redirect('admin/imailboxs');  
           }     
            
            
            
              
           
            
           
           
        //***********************************************************
         $filter["fillter"]="";
         if($getid)
         {
             $filter["fillter"]= $getid;
             $data['fillter'] =$getid;
         }else
         {
             $data['fillter'] ="";
         }
        
         // $data['results'] = $this->imailbox_model->GetAllrecords($serachdata,$limit,$start);
          
            $data['adminuser_data'] = $this->imailbox_model->get_adminamails(); 
          $data['results'] = $this->imailbox_model->GetAllrecords($filter); 
		  $this->openView($data,'index');
	   }

    public function name_check($str)
	{
		if ($this->imailbox_model->check_name($str) > 0)
		{
			$this->form_validation->set_message('name_check', 'The people profile name ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    public function editname_check($str)
	{
		if ($this->imailbox_model->editcheck_name($this->input->post("id"),$str) > 0)
		{
			$this->form_validation->set_message('editname_check', 'The people profile name ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

   public function title_check($str)
	{
		if ($this->imailbox_model->check_title($str) > 0)
		{
			$this->form_validation->set_message('title_check', 'The imailbox title ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    public function edittitle_check($str)
	{
		if ($this->imailbox_model->editcheck_title($this->input->post("id"),$str) > 0)
		{
			$this->form_validation->set_message('edittitle_check', 'The Ad title ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
  
	private function openView($xdata,$viewName)
	{
	
		$this->load->view('admin/header', $xdata);
		$this->load->view('admin/imailbox/'.$viewName,$xdata);
		$this->load->view('admin/footer');
	}
    
    public function deleteimage()
    {
       $strgetid=$this->input->post("strgetid"); 
       $editdata=$this->imailbox_model->GetpeopleprofileById($strgetid);
       
       $success="Y";

            $getimagename=$editdata[0]["image"];
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
              $this->imailbox_model->updateimage($strgetid,"image");
            }else
            {
             $success="N";         
            }                    
        
        
         echo $success;
    }
    
   public function changestatus() 
    {
        $strgetid=$this->input->post("strgetid"); 
        $strstatus=$this->input->post("strgetstatus");
        
         $this->imailbox_model->changestatus($strgetid,$strstatus); 
          $this->session->set_flashdata('sucess', "Send to Admin Confirmation sucessfully");
       echo "Y";  
    }
    public function setbackgroundimage()
    {
          $editid=$this->input->post("editid");
          $this->imailbox_model->setbackgroundimage($editid); 
    }  
}
?>