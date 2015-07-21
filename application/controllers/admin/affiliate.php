<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Affiliate extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;

    function __construct()
        {
            parent::__construct();
            if(!$this->session->userdata('logged_in')){redirect('/admin');}
            $this->load->model("affiliate_model");
            $this->load->model("affilateright_model");
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
           $this->breadcrumbs->push('<a href="#ignore">Modify/Listing Affiliate</a>', "&nbsp;" );
           
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Modify/Listing Affiliate ';
            $data['page_title']       = 'Modify/Listing Affiliate ';
			$data['page_action'] = 'Modify/Listing Affiliate';
            
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
                       $this->affiliate_model->deleterecords($selected);
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been deleted successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                 redirect('admin/affiliate');  
           }     
            
            
            
        //***********************************************************
         // $data['results'] = $this->affiliate_model->GetAllrecords($serachdata,$limit,$start);
          $data['results'] = $this->affiliate_model->GetAllrecords();
		  $this->openView($data,'index');
	   }

   
    
    function create($id=0)
    {
      
      //*******************************  Validation  ********************
       //  username  userpass  email siteemail siteemailpass
	$config = array(
                array(
                     'field'   => 'username',
                     'label'   => "Username ",
                     'rules'   => 'required|callback_name_check'
                  ),
                array(
                     'field'   => 'userpass',
                     'label'   => "Password ",
                     'rules'   => 'required'
                  ) ,
               array(
                     'field'   => 'email',
                     'label'   => "Email",
                     'rules'   => 'required|callback_email_check'
                  )
                  ,
               array(
                     'field'   => 'siteemail',
                     'label'   => "Site Email",
                     'rules'   => 'required'
                  )
                  ,
               array(
                     'field'   => 'siteemailpass',
                     'label'   => "Site Password",
                     'rules'   => 'required'
                  )
               
            );
    if(affilateright("affilate","write")==true)
       { 
        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		  
         
		   // //  username  userpass  email siteemail siteemailpass   
           $data["username"]=$this->input->post("username");
           $data["userpass"]=$this->input->post("userpass");
           $data["email"]=$this->input->post("email");
           $data["siteemail"]=$this->input->post("siteemail");
           $data["siteemailpass"]=$this->input->post("siteemailpass");
           $data["type"]=$this->input->post("type");
           $data["affilaterights"]=$this->input->post("affilaterights");
           
           $this->affiliate_model->insert($data);
           $this->session->set_flashdata('sucess', "Affiliate have been inserted sucessfully");
           redirect('admin/affiliate');
       }
	     //*****************************  Validation **************************************    
         // add breadcrumbs
              $datas['sitetitle']       = 'Modify/Listing affiliate >Add ';
            $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing affiliate ', "/admin/affiliate" ); 
           $this->breadcrumbs->push('<a href="#ignore">Add</a>', "/admin/affiliate/create" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
           $datas['id']       = 0;
           $datas['page_action']   = 'Add';
            $data['sitetitle']       = 'Modify/Listing Sffiliate > Add';
           $datas['title'] = '';
    	   $datas['page_title']       = 'Modify/Listing Affiliate ';
           
           $datas['breadcrumds']       = $breadcrumds;
		   $datas['results']     = array();
          // //  username  userpass  email siteemail siteemailpass   
          
          
         if($this->input->post("username")){ $datas['username']= $this->input->post("username"); }else{ $datas['username']= ""; }
         if($this->input->post("userpass")){ $datas['userpass']= $this->input->post("userpass"); }else{ $datas['userpass']= ""; }
         if($this->input->post("email")){ $datas['email']= $this->input->post("email"); }else{ $datas['email']= ""; }
         if($this->input->post("siteemail")){ $datas['siteemail']= $this->input->post("siteemail"); }else{ $datas['siteemail']= array(0=>""); }
         if($this->input->post("siteemailpass")){ $datas['siteemailpass']= $this->input->post("siteemailpass"); }else{ $datas['siteemailpass']= array(0=>""); }
         if($this->input->post("type")){ $datas['type']= $this->input->post("type"); }else{ $datas['type']= ""; } 
           $datas['resultsmodules'] = $this->affilateright_model->GetAllmodules();
          $datas['resultsaffilate'] =array();
          
          
          
         $this->openView($datas,'add');
       }else
          {
             $this->session->set_flashdata('rightmsg', 'You have not write right to access');
			 	redirect('admin/dashboard');
          }  
    }
    
    
     function edit($id=0)
    {
        //*******************************  Validation  ********************
	$config = array(
                array(
                     'field'   => 'username',
                     'label'   => "Username ",
                     'rules'   => 'required|callback_editname_check'
                  ),
                array(
                     'field'   => 'userpass',
                     'label'   => "Password ",
                     'rules'   => 'required'
                  ) ,
               array(
                     'field'   => 'email',
                     'label'   => "Email",
                     'rules'   => 'required|callback_editemail_check'
                  )
                  ,
               array(
                     'field'   => 'siteemail',
                     'label'   => "Site Email",
                     'rules'   => 'required'
                  )
                  ,
               array(
                     'field'   => 'siteemailpass',
                     'label'   => "Site Password",
                     'rules'   => 'required'
                  )
               
            );
   if(affilateright("affilate","write")==true)
       { 
        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		  // echo "<pre>";
          // print_r($this->input->post());
          // print_r($_FILES);
            $data["username"]=$this->input->post("username");
           $data["userpass"]=$this->input->post("userpass");
           $data["email"]=$this->input->post("email");
           $data["siteemail"]=$this->input->post("siteemail");
           $data["siteemailpass"]=$this->input->post("siteemailpass");
           $data["type"]=$this->input->post("type");
           $data["id"]=$this->input->post("id");
            $data["affilaterights"]=$this->input->post("affilaterights");   
                            $this->affiliate_model->update($data);
                            $this->session->set_flashdata('sucess', "affiliate have been updated sucessfully");
                			redirect('admin/affiliate');
         }
	     //*****************************  Validation **************************************    
         // add breadcrumbs
            //$this->breadcrumbs->push('Home', '/admin/dashboard');
           $datas['sitetitle']       = 'Modify/Listing Affiliate >Add ';
           $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Affiliate ', "/admin/affiliate" ); 
           $this->breadcrumbs->push('<a href="#ignore">Edit</a>', "/admin/affiliate/edit" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
           $datas['id']       = $id;
       
           $datas['page_action']   = 'Edit';
           $datas['title'] = 'Modify/Listing Affiliate';
            $data['sitetitle']       = 'Modify/Listing Affiliate > Edit';
    	   $datas['page_title']       = 'Modify/Listing Affiliate';
           
          $datas['breadcrumds']       = $breadcrumds;
         
          
          
          $editdata=$this->affiliate_model->GetaffiliateById($id);
       
         if($this->input->post("type")){ $datas['type']= $this->input->post("type"); }
         elseif (!empty($editdata)) {$datas['type']       =  $editdata[0]["superadmin"];}
         else{ $datas['type']= ""; }
         
          if($this->input->post("username")){ $datas['username']= $this->input->post("username"); }
           elseif (!empty($editdata)) {$datas['username']       =  $editdata[0]["username"];}
          else{ $datas['username']= ""; }
          
         if($this->input->post("userpass")){ $datas['userpass']= $this->input->post("userpass"); }
          elseif (!empty($editdata)) {$datas['userpass']       =  "";//$editdata[0]["password"];
          }
         else{ $datas['userpass']= ""; }
         
         if($this->input->post("email")){ $datas['email']= $this->input->post("email"); }
          elseif (!empty($editdata)) {$datas['email']       =  $editdata[0]["email"];}
         else{ $datas['email']= ""; }
         
         if($this->input->post("siteemail")){ $datas['siteemail']= $this->input->post("siteemail"); }
          elseif (!empty($editdata)) {$datas['siteemail']       =  explode(",",$editdata[0]["semail"]);}
         else{ $datas['siteemail']= ""; }
         
         if($this->input->post("siteemailpass")){ $datas['siteemailpass']= $this->input->post("siteemailpass"); }
          elseif (!empty($editdata)) {$datas['siteemailpass']       = explode("-|-",$editdata[0]["spassword"]);; //$editdata[0]["spassword"];
          }
         else{ $datas['siteemailpass']= ""; }
        
          $datas['resultsmodules'] = $this->affilateright_model->GetAllmodules();
          $datas['resultsaffilate'] = $this->affilateright_model->Getaffilatemodules($id);
         
       	 $datas['results']     = array();
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
		if ($this->affiliate_model->check_name($str) > 0)
		{
			$this->form_validation->set_message('name_check', 'The affiliate name ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    public function editname_check($str)
	{
		if ($this->affiliate_model->editcheck_name($this->input->post("id"),$str) > 0)
		{
			$this->form_validation->set_message('editname_check', 'The affiliate name ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

   public function email_check($str)
	{
		if ($this->affiliate_model->check_email($str) > 0)
		{
			$this->form_validation->set_message('email_check', 'The affiliate email ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    public function editemail_check($str)
	{
		if ($this->affiliate_model->editcheck_email($this->input->post("id"),$str) > 0)
		{
			$this->form_validation->set_message('editemail_check', 'The affiliate email ('.$str.') already exists.');
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
		$this->load->view('admin/affiliate/'.$viewName,$xdata);
		$this->load->view('admin/footer');
	}
    
    public function deleteimage()
    {
       $strgetid=$this->input->post("strgetid"); 
       $editdata=$this->affiliate_model->GetaffiliateById($strgetid);
       
       $success="Y";

            $getimagename=$editdata[0]["image"];
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
              $this->affiliate_model->updateimage($strgetid,"image");
            }else
            {
             $success="N";         
            }                    
        
        
         echo $success;
    }
    
    public function setbackgroundimage()
    {
          $editid=$this->input->post("editid");
          $this->affiliate_model->setbackgroundimage($editid); 
    }  
}
?>