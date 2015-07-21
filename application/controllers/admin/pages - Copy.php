<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;

    function __construct()
        {
            parent::__construct();
            if(!$this->session->userdata('logged_in')){redirect('/');}
            $this->load->model("page");
            
            $this->load->helper("file");
            $this->load->library('upload');
            $this->load->library('form_validation');
            $this->load->helper('general_helper');
            $this->load->library('image_lib');
        }

   function index()
	   { 
	   		
			if(isset($_POST['delete']))
			{
				$this->page->changePageStatus();
				redirect('admin/pages');
			}
			
			$data['page_action'] = 'Listing';
			$data['results'] = $this->page->GetAllPage();
			 
			$this->openView($data,'index');
	   }

    function add()
    {
       $data['page_action']   = 'Add';
       $data['id']   = 0;
       if($this->input->post() == '')
       		{$this->openView($data,'add');} 
	   else
			{
				$data=$_POST;
				$UserId      = $this->page->addeditPage($data,0);
				if($UserId=="ins")
				{
				   
                   	$this->session->set_flashdata('item', 'Page Added Successfully');
					redirect('admin/pages');
				}
				else
				{
					$data['results']     = $_POST;
					$this->session->set_flashdata('item', 'Enter Unique Page synonums');
					$this->openView($data,'add');
				}
			}
    }

	function edit()
    {
       $data['page_action']   = 'Edit';
	  $page_id=$_GET['id'];
      $data['id']   = $_GET['id'];
       
      
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