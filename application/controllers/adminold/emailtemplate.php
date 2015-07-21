<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Emailtemplate extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;

    function __construct()
        {
            parent::__construct();
            if(!$this->session->userdata('logged_in')){redirect('/');}
            $this->load->model("emailtemplate_model");
            
            $this->load->helper("file");
            $this->load->library('upload');
            $this->load->library('form_validation');
            $this->load->helper('general_helper');
            $this->load->library('image_lib');
            $this->load->library('pagination');
            $this->load->library('breadcrumbs');
        }

   function index()
	   { 
	   		
		
			  // add breadcrumbs
         //  $this->breadcrumbs->push('Home', '/admin/dashboard');
          $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('<a href="#ignore">Modify/Listing Email template</a>', "&nbsp;" );
           
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Modify/Listing Email template ';
            $data['page_title']       = 'Modify/Listing Email template ';
			$data['page_action'] = 'Modify/Listing Email template';
            
            //******************************************************
             $serachdata=array();
            if($this->input->post("searchdata"))
            {
               $searchstr=$this->input->post("searchdata");
               $serachdata["searchstr"]=$searchstr;
            }
            
            
           if($this->input->post("btn_delete"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                     $this->emailtemplate_model->deleterecords($selected);
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been deleted successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                 redirect('admin/emailtemplate');  
           }     
            
            
            
        //***********************************************************
         // $data['results'] = $this->emailtemplate_model->GetAllrecords($serachdata,$limit,$start);
          $data['results'] = $this->emailtemplate_model->GetAllrecords();
		  $this->openView($data,'index');
	   }

   
    
    function create($id=0)
    {
      
      //*******************************  Validation  ********************
       $images_error=array();
       $region_image_img_name="";
       $region_ext_img_name="";
	$config = array(
                array(
                     'field'   => 'regions[]',
                     'label'   => "Regions ",
                     'rules'   => 'required'
                  ),
                array(
                     'field'   => 'type',
                     'label'   => "Ad Size ",
                     'rules'   => 'required'
                  ) ,
               array(
                     'field'   => 'title',
                     'label'   => "emailtemplate Title",
                     'rules'   => 'required'
                  )
               
            );
              //|callback_title_check
        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		      
           $data["regions"]=$this->input->post("regions");
           $data["title"]=$this->input->post("title");
           $data["type"]=$this->input->post("type");
           
                              
            $this->emailtemplate_model->insert($data);
            $this->session->set_flashdata('sucess', "Email template have been inserted sucessfully");
			redirect('admin/emailtemplate');
            
		}
	     //*****************************  Validation **************************************    
         // add breadcrumbs
              $datas['sitetitle']       = 'Modify/Listing Email template >Add ';
            $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Email template ', "/admin/emailtemplate" ); 
           $this->breadcrumbs->push('<a href="#ignore">Add</a>', "/admin/emailtemplate/create" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
           $datas['id']       = 0;
           $datas['name']       = '';
           $datas['page_action']   = 'Add';
            $data['sitetitle']       = 'Modify/Listing Email template > Add';
           $datas['title'] = '';
    	   $datas['page_title']       = 'Modify/Listing Email template ';
           
           $datas['breadcrumds']       = $breadcrumds;
		   $datas['results']     = array();
        
           $datas['images_error']= $images_error;
          
           
           $regions_arr= $this->emailtemplate_model->GetAllRegion();
            $datas['regions_arr']=$regions_arr;
        
         if($this->input->post("title")){ $datas['title']= $this->input->post("title"); }else{ $datas['title']= ""; }
         if($this->input->post("type")){ $datas['type']= $this->input->post("type"); }else{ $datas['type']= ""; }
         if($this->input->post("regions")){ $datas['regions']= $this->input->post("regions"); }else{ $datas['regions']= ""; }
        
          $datas['flag']= ""; 
          $datas['image']= ""; 
           $datas['ext']="";
          
         $this->openView($datas,'add');
    }
    
    
     function edit($id=0)
    {
          $images_error=array();
        $region_map_img_name="";
       $region_flag_img_name="";
       $region_image_img_name="";
       $region_coverimage_img_name="";
      //*******************************  Validation  ********************
	$config = array(
                array(
                     'field'   => 'title',
                     'label'   => "Email title ",
                     'rules'   => 'required|callback_edittitle_check'
                  ),
                array(
                     'field'   => 'from_mail',
                     'label'   => "From Mail",
                     'rules'   => 'required'
                  ) ,
               array(
                     'field'   => 'subject',
                     'label'   => "Email Subject",
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'temp_content',
                     'label'   => "Email Content",
                     'rules'   => 'required'
                  )
               
            );
// |callback_editname_check
  if(affilateright("emailtemplate","write")==true)
       {
        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		  // echo "<pre>";
          // print_r($this->input->post());
          // exit;
          // print_r($_FILES);
           $data["title"]=$this->input->post("title");
           $data["from_mail"]=$this->input->post("from_mail");
           $data["subject"]=$this->input->post("subject");
           $data["temp_content"]=$this->input->post("temp_content");
           $data["id"]=$this->input->post("id");
            //******************************************************************** 
                $this->emailtemplate_model->update($data);
                $this->session->set_flashdata('sucess', "emailtemplate have been updated sucessfully");
    			redirect('admin/emailtemplate');
            
		}
	     //*****************************  Validation **************************************    
         // add breadcrumbs
            //$this->breadcrumbs->push('Home', '/admin/dashboard');
           $datas['sitetitle']       = 'Modify/Listing Email template >Add ';
           $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Email template ', "/admin/emailtemplate" ); 
           $this->breadcrumbs->push('<a href="#ignore">Edit</a>', "/admin/emailtemplate/edit" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
           $datas['id']       = $id;
       
           $datas['page_action']   = 'Edit';
           $datas['title'] = 'Modify/Listing Email template';
           $data['sitetitle']       = 'Modify/Listing Email template > Edit';
    	   $datas['page_title']       = 'Modify/Listing Email template';
           
          $datas['breadcrumds']       = $breadcrumds;
          $datas['images_error']= $images_error;
          
          
          $editdata=$this->emailtemplate_model->GetById($id);
           
        
         if($this->input->post("title"))
         { $datas['title']= $this->input->post("title"); }
         elseif (!empty($editdata)) {
			$datas['title'] = $editdata[0]["title"];
		 } 
         else{ $datas['title']= ""; }
         
          if($this->input->post("from_mail"))
         { $datas['from_mail']= $this->input->post("from_mail"); }
         elseif (!empty($editdata)) {
			$datas['from_mail'] = $editdata[0]["from_mail"];
		 } 
         else{ $datas['from_mail']= ""; }
         
          if($this->input->post("subject"))
         { $datas['subject']= $this->input->post("subject"); }
         elseif (!empty($editdata)) {
			$datas['subject'] = $editdata[0]["subject"];
		 } 
         else{ $datas['subject']= ""; }
         
          if($this->input->post("temp_content"))
         { $datas['temp_content']= $this->input->post("temp_content"); }
         elseif (!empty($editdata)) {
			$datas['temp_content'] = $editdata[0]["temp_content"];
		 } 
         else{ $datas['temp_content']= ""; }
         
         
         
        
		 $this->openView($datas,'add');
         }else
          {
             $this->session->set_flashdata('rightmsg', 'You have not write right to access');
			 	redirect('admin/dashboard');
          }   
    }
    
     public function ragion_map_check($str)
	{
	   
       if(!empty($_FILES["ragion_map"]["name"]))
       {
         
          
        
        
       }
    }   
     
     public function name_check($str)
	{
		if ($this->emailtemplate_model->check_name($str) > 0)
		{
			$this->form_validation->set_message('name_check', 'The emailtemplate subject ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    public function editname_check($str)
	{
		if ($this->emailtemplate_model->editcheck_name($this->input->post("id"),$str) > 0)
		{
			$this->form_validation->set_message('editname_check', 'The emailtemplate subject ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

   public function title_check($str)
	{
		if ($this->emailtemplate_model->check_title($str) > 0)
		{
			$this->form_validation->set_message('title_check', 'The emailtemplate title ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    public function edittitle_check($str)
	{
		if ($this->emailtemplate_model->editcheck_title($this->input->post("id"),$str) > 0)
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
		$this->load->view('admin/emailtemplate/'.$viewName,$xdata);
		$this->load->view('admin/footer');
	}
    
    public function deleteimage()
    {
       $strgetid=$this->input->post("strgetid"); 
       $editdata=$this->emailtemplate_model->GetById($strgetid);
       
       $success="Y";

            $getimagename=$editdata[0]["image"];
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
              $this->emailtemplate_model->updateimage($strgetid,"image");
            }else
            {
             $success="N";         
            }                    
        
        
         echo $success;
    }
    
    public function setbackgroundimage()
    {
          $editid=$this->input->post("editid");
          $this->emailtemplate_model->setbackgroundimage($editid); 
    }  
}
?>