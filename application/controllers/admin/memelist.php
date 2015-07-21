<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Memelist extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;

    function __construct()
        {
            parent::__construct();
            if(!$this->session->userdata('logged_in')){redirect('/admin');}
            $this->load->model("memelists");
            
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
           $this->breadcrumbs->push('<a href="#ignore">Me Me Page  </a>', "&nbsp;" );
           
            $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       =   'Me Me Page List';
            $data['page_titles']       = 'Me Me Page List';
			$data['page_action'] = 'Me Me Page List  ';
            
             if($this->input->post("btn_delete"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->memelists->deleterecords($selected);
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been deleted successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                 redirect('admin/memelist');  
           }     
            
            
            if($this->input->post("btn_Publish"))
             { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                     $this->memelists->changestatus($selected,'1');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been publish successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for me me page..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for me me page..");
                   }
                 redirect('admin/memelist');  
             }  
           
              if($this->input->post("btn_UnPublish"))
             { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                     $this->memelists->changestatus($selected,'0');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been unpublish successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for me me page..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for me me page..");
                   }
                 redirect('admin/memelist');  
             }  
            
            
			if(isset($_POST['delete']))
			{
				$this->memelists->changeMemeStatus();
				redirect('admin/memelist');
			}
			
			$data['page_action'] = 'Listing';
			$data['results'] = $this->memelists->GetAllMeme();
			 
			$this->openView($data,'index');
	   }

    function add()
    {
       $data['page_action']   = 'Add';
       $data['id']   = 0;
       if(affilateright("memlist","write")==true)
       { 
         $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Me Me Page', "/admin/memelist" );
           $this->breadcrumbs->push('<a href="#ignore">Add  </a>', "&nbsp;" );
           
            $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Me Me Page';
            $data['page_titles']       = 'Me Me Page';
			$data['page_action'] = 'Me Me Page';
            
            
       if($this->input->post() == '')
       		{$this->openView($data,'add');} 
	   else
			{
				$data=$_POST;
				$UserId      = $this->memelists->addeditMeme($data,0);
				if($UserId=="ins")
				{
				   
                   	$this->session->set_flashdata('item', 'Banners Added Successfully');
					redirect('admin/memelist');
				}
				else
				{
					$data['results']     = $_POST;
					$this->session->set_flashdata('item', 'Enter Unique Banners title');
					$this->openView($data,'add');
				}
			}
        }else
          {
             $this->session->set_flashdata('rightmsg', 'You have not write right to access');
			 	redirect('admin/dashboard');
          }       
    }

	function edit($id)
    {
       $data['page_action']   = 'Edit';
	  $id=$id;
      $data['id']   = $id;
      if(affilateright("memlist","write")==true)
       {  
        $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Me Me Page', "/admin/memelist" );
           $this->breadcrumbs->push('<a href="#ignore">Edit  </a>', "&nbsp;" );
           
            $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Me Me Page';
            $data['page_titles']       = 'Me Me Page';
			$data['page_action'] = 'Me Me Page';
      
       if($this->input->post() == '')
       		{
				$RsData=$this->memelists->GetMemeById($id);
                if(count($RsData)>0)  {$data['results']=$RsData[0];}
				$this->openView($data,'add');
			} 
	   else
			{
				$data=$_POST;
				$ret      = $this->memelists->addeditMeme($data,$id);
				if($ret>0)
				{
				    $data['vendor_id']=$id;
					$this->session->set_flashdata('item', 'Banners Edited Successfully');
					redirect('admin/memelist');
				}
				else
				{
					$data['results'] = $_POST;
					$this->session->set_flashdata('item', 'Enter Unique Banners title');
					$this->openView($data,'add');
				}
			}
         }else
          {
             $this->session->set_flashdata('rightmsg', 'You have not write right to access');
			 	redirect('admin/dashboard');
          }    
    }

    public function delete()
	{
		$id=$_GET['id'];
        $ret      = $this->memelists->deleteMeme($id);
		$this->session->set_flashdata('item', 'Banners Deleted Successfully');
		redirect('admin/memelist');
	}

	private function openView($xdata,$viewName)
	{
		$xdata['title'] = 'Listing Banners';
		$xdata['page_title']       = 'Listing Banners';
		$this->load->view('admin/header', $xdata);
		$this->load->view('admin/memelist/'.$viewName,$xdata);
		$this->load->view('admin/footer');
	}
}
?>