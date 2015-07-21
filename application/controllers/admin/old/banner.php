<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;

    function __construct()
        {
            parent::__construct();
            if(!$this->session->userdata('logged_in')){redirect('/');}
            
			$this->load->model("banners");
            
            $this->load->helper("file");
            $this->load->library('upload');
            $this->load->library('form_validation');
            $this->load->helper('general_helper');
            $this->load->library('image_lib');
        }

   function index()
	   { 
			$data['page_action'] = 'Listing';
			$data['results'] = $this->banners->GetAllBanner();
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
				$data2=$_POST;
				$UserId      = $this->banners->addeditBanner($data2,0);
				if($UserId=="ins")
				{
                   	$this->session->set_flashdata('item', 'Banner Added Successfully');
					redirect('admin/banner');
				}
				else
				{
					$data['results']     = $_POST;
					$this->session->set_flashdata('item', 'Enter Unique Banner');
					$this->openView($data,'add');
				}
			}
    }

	function edit()
    {
       $data['page_action']   = 'Edit';
	   $id=$_GET['id'];
       $data['id']   = $_GET['id'];
       if($this->input->post() == '')
       		{
				$RsData=$this->banners->GetBannerById($id);
                if(count($RsData)>0)  {$data['results']=$RsData[0];}
				$this->openView($data,'add');
			} 
	   else
			{
				$data=$_POST;
				$ret      = $this->banners->addeditBanner($data,$id);
				if($ret>0)
				{
					$this->session->set_flashdata('item', 'Banner Edited Successfully');
					redirect('admin/banner');
				}
				else
				{
					$data['results'] = $_POST;
					$this->session->set_flashdata('item', 'Enter Unique Banner title');
					$this->openView($data,'add');
				}
			}
    }

    public function delete()
	{
		$id=$_GET['id'];
        $ret      = $this->banners->deleteBanner($id);
		$this->session->set_flashdata('item', 'Banner Deleted Successfully');
		redirect('admin/banner');
	}

	private function openView($xdata,$viewName)
	{
		$xdata['title'] = 'Manage Banner';
		$xdata['page_title']       = 'Banner';
		$this->load->view('admin/header', $xdata);
		$this->load->view('admin/banner/'.$viewName,$xdata);
		$this->load->view('admin/footer');
	}
}
?>