<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;

    function __construct()
        {
            parent::__construct();
            if(!$this->session->userdata('logged_in')){redirect('/admin');}
            
			$this->load->model("banners");
            
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
           $this->breadcrumbs->push('<a href="#ignore">Modify/Listing Banners  </a>', "&nbsp;" );
           
            $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Modify/Listing Banners';
            $data['page_titles']       = 'Modify/Listing Banners';
			$data['page_action'] = 'Modify/Listing Banners  ';
            
            //******************************************************
            $data['results'] = $this->banners->GetAllBanner();
			$this->openView($data,'index');
	   }

    function add()
    {
       $data['page_action']   = 'Add';
       $data['id']   = 0;
	     $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Banners', "/admin/banner" );
           $this->breadcrumbs->push('<a href="#ignore">Add  </a>', "&nbsp;" );
           
            $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Modify/Listing Banners';
            $data['page_titles']       = 'Modify/Listing Banners';
			$data['page_action'] = 'Modify/Listing Banners  ';
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

	function edit($id)
    {
       $data['page_action']   = 'Edit';
	   $id=$id;
       $data['id']   = $id;
        if(affilateright("banner","write")==true)
       {
          $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Banners', "/admin/banner" );
           $this->breadcrumbs->push('<a href="#ignore">Edit  </a>', "&nbsp;" );
           
            $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Modify/Listing Banners';
            $data['page_titles']       = 'Modify/Listing Banners';
			$data['page_action'] = 'Modify/Listing Banners  ';
       
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
					$this->session->set_flashdata('sucess', 'Banner Edited Successfully');
					redirect('admin/banner');
                    
				}
				else
				{
					$data['results'] = $_POST;
					$this->session->set_flashdata('sucess', 'Enter Unique Banner title');
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
        $ret      = $this->banners->deleteBanner($id);
		$this->session->set_flashdata('item', 'Banner Deleted Successfully');
		redirect('admin/banner');
	}
    public function del_video()
    {
       
       $deletedata=$_POST["deletedata"];
        $success="Y";
       if(!empty($deletedata))
       {
        foreach($deletedata as $key => $getimagename)
        {    
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
              
            }else
            {
             $success="N";         
            }                    
        }
       }
        
    }
	private function openView($xdata,$viewName)
	{
		$xdata['title'] = 'Manage Banner';
		$xdata['page_title']       = 'Banner';
		$this->load->view('admin/header', $xdata);
		$this->load->view('admin/banner/'.$viewName,$xdata);
		$this->load->view('admin/footer');
	}
    
    public function deleteimage()
    {
       $strgetid=$this->input->post("strgetid"); 
       $strflag=$this->input->post("strflag"); 
       $editdata=$this->banners->GetBannerById($strgetid);
      // backgroundimg dbimage
       switch($strflag)
       {
        case  "backgroundimg" : 
          $flag="background_img";
        break;
        case  "dbimage" : 
          $flag="image";
        break;
        
       }
       
       
       
       
       $success="Y";
   
            $getimagename=$editdata[0][$flag];
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
              $this->banners->updateimage($strgetid,$flag);
            }else
            {
             $success="N";         
            }                    
        
        
         echo $success;
    }
    
}
?>