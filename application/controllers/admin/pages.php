<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;

    function __construct()
        {
            parent::__construct();
            if(!$this->session->userdata('logged_in')){redirect('/admin');}
            $this->load->model("pages_model");
            
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
	   	   $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('<a href="#ignore">Modify Pages </a>', "&nbsp;" );
           
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Modify Pages  ';
            $data['page_titles']       = 'Modify Pages  ';
			$data['page_action'] = 'Modify Pages ';
            
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
                       $this->pages_model->deleterecords($selected);
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been deleted successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                 redirect('admin/pages');  
           }     
            
            
            if($this->input->post("btn_Publish"))
             { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                     $this->pages_model->changestatus($selected,'1');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been publish successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for publish..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for publish..");
                   }
                 redirect('admin/pages');  
             }  
           
              if($this->input->post("btn_UnPublish"))
             { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                     $this->pages_model->changestatus($selected,'0');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been unpublish successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for unpublish..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for unpublish..");
                   }
                 redirect('admin/pages');  
             }  
            
        //***********************************************************
         // $data['results'] = $this->pages_model->GetAllrecords($serachdata,$limit,$start);
          $data['results'] = $this->pages_model->GetAllrecords();
		  $this->openView($data,'index');  
            
            
	   }

    function add()
    {
       $data['page_action']   = 'Add';
       $data['id']   = 0;
        if(affilateright("about","write")==true)
       {
           $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
            $this->breadcrumbs->push('Modify Pages', "/admin/pages" );
           $this->breadcrumbs->push('<a href="#ignore">Add </a>', "&nbsp;" );
           
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Modify Pages  ';
            $data['page_titles']       = 'Modify Pages  ';
			$data['page_action'] = 'Modify Pages ';
        
         	$config = array(
                array(
                     'field'   => 'page_title',
                     'label'   => "PAge Title",
                     'rules'   => 'required|callback_title_check'
                  )
               
            );

        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		        $data=$_POST;
				$UserId      = $this->pages_model->addeditPage($data,0);
                	$this->session->set_flashdata('sucess', 'Page Added Successfully');
					redirect('admin/pages');
        }  
        
           if($this->input->post("title")){ $data['title']= $this->input->post("title"); }else{ $data['title']= ""; }
           if($this->input->post("detailed_description")){ $data['detailed_description']= $this->input->post("detailed_description"); }else{ $data['detailed_description']= ""; }
       /*
       if($this->input->post() == '')
       		{$this->openView($data,'add');} 
	   else
			{
				$data=$_POST;
				$UserId      = $this->pages_model->addeditPage($data,0);
				if($UserId=="ins")
				{
				   
                   	$this->session->set_flashdata('sucess', 'Page Added Successfully');
					redirect('admin/pages');
				}
				else
				{
					$data['results']     = $_POST;
					$this->session->set_flashdata('item', 'Enter Unique Page synonums');
					$this->openView($data,'add');
				}
			}
            
           */ 
           
         	$this->openView($data,'add');  
          }else
          {
             $this->session->set_flashdata('rightmsg', 'You have not write right to access');
			 	redirect('admin/dashboard');
          }      
    }
    
     public function title_check($str)
	{
		if ($this->pages_model->check_title($str) > 0)
		{
			$this->form_validation->set_message('title_check', 'The page title ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    public function edittitle_check($str)
	{
		if ($this->pages_model->editcheck_title($this->input->post("id"),$str) > 0)
		{
			$this->form_validation->set_message('edittitle_check', 'The page title ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	function edit($id)
    {
       $data['page_action']   = 'Edit';
	  $page_id=$id;
      $data['id']   = $id;
       if(affilateright("about","write")==true)
       {
        $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
            $this->breadcrumbs->push('Modify Pages', "/admin/pages" );
           $this->breadcrumbs->push('<a href="#ignore">Edit </a>', "&nbsp;" );
           
            $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Modify Pages  ';
            $data['page_titles']       = 'Modify Pages  ';
			$data['page_action'] = 'Modify Pages ';
        
         	$config = array(
                array(
                     'field'   => 'page_title',
                     'label'   => "PAge Title",
                     'rules'   => 'required|callback_title_check'
                  )
               
            );
           
           $config = array(
                 array(
                     'field'   => 'page_title',
                     'label'   => "Page Title",
                     'rules'   => 'required|callback_edittitle_check'
                  )
               
            );


        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		        $data=$_POST;
				$ret      = $this->pages_model->addeditPage($data,$page_id);
   	            $this->session->set_flashdata('success', 'Page Edited Successfully');
			 	redirect('admin/pages');
        }  
      /*
       if($this->input->post() == '')
       		{
				$RsData=$this->page->GetPageById($page_id);
                if(count($RsData)>0)  {$data['results']=$RsData[0];}
				$this->openView($data,'add');
			} 
	   else
			{
				$data=$_POST;
				$ret      = $this->page->addeditPage($data,$page_id);
				if($ret>0)
				{
				    $data['vendor_id']=$page_id;
					$this->session->set_flashdata('item', 'Page Edited Successfully');
					redirect('admin/pages');
				}
				else
				{
					$data['results'] = $_POST;
					$this->session->set_flashdata('item', 'Enter Unique Page synonums');
					$this->openView($data,'add');
				}
			}
            
           */ 
          	   $RsData=$this->pages_model->GetPageById($page_id);
                if(count($RsData)>0)  {$data['results']=$RsData[0];}
				$this->openView($data,'add'); 
                
          }else
          {
             $this->session->set_flashdata('rightmsg', 'You have not write right to access');
			 	redirect('admin/dashboard');
          }      
    }

    public function delete()
	{
		$page_id=$_GET['id'];
        $ret      = $this->page->deletePage($page_id);
		$this->session->set_flashdata('item', 'Page Deleted Successfully');
		redirect('admin/pages');
	}

	private function openView($xdata,$viewName)
	{
		$xdata['title'] = 'Custom Page';
		$xdata['page_title']       = 'Page';
		$this->load->view('admin/header', $xdata);
		$this->load->view('admin/pages/'.$viewName,$xdata);
		$this->load->view('admin/footer');
	}
}
?>