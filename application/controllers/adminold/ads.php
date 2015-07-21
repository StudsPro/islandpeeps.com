<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ads extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;

    function __construct()
        {
            parent::__construct();
            if(!$this->session->userdata('logged_in')){redirect('/');}
            $this->load->model("ads_model");
            
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
           $this->breadcrumbs->push('<a href="#ignore">Modify/Listing Ads</a>', "&nbsp;" );
           
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Modify/Listing Ads ';
            $data['page_title']       = 'Modify/Listing Ads ';
			$data['page_action'] = 'Modify/Listing Ads';
            
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
                       $this->ads_model->deleterecords($selected);
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been deleted successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                 redirect('admin/ads');  
           }     
            
            
            
        //***********************************************************
         // $data['results'] = $this->ads_model->GetAllrecords($serachdata,$limit,$start);
          $data['results'] = $this->ads_model->GetAllrecords();
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
                     'label'   => "Ads Title",
                     'rules'   => 'required|callback_title_check'
                  )
               
            );
    if(affilateright("ads","write")==true)
       { 
        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		      
           $data["regions"]=$this->input->post("regions");
           $data["title"]=$this->input->post("title");
           $data["type"]=$this->input->post("type");
           $adsid=$this->ads_model->getmaxid("id","tbl_ads");
            //*******************************************************************
               
                if(!empty($_FILES["image"]['name']))
					{
				        $gettmp_tumbs_arr=array();
                        $imagecounter=1; 
					    $ext = explode(".",$_FILES["image"]['name']);
						$ext = strtolower($ext[1]);
						$uploadConst['upload_path']   = SITE_UPLOADPATH;
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp|mp4|bat|flv';
                        //$uploadConst['max_size'] = REGION_MAP;
						$uploadConst['file_name']     = 'ads-'.$adsid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload('image'))
							{
						      	$remap_error= $this->upload->display_errors(); 
                                $images_error["ads_error"]=$remap_error;
                             }
						 else
							{   
							   $config=array();
                               $image_data=array();
                               $image_data = $this->upload->data();
                              
                               $region_image_img_name= $image_data["orig_name"];
                               $region_ext_img_name= $image_data["file_ext"];
                               
                            }
                    }
            //******************************************************************** 
           
            
                    if(empty($images_error))
                    { 
                            $data["ads_image"]= $region_image_img_name;
                            $data["ads_imageext"]= $region_ext_img_name;
                            
                              
                            $this->ads_model->insert($data);
                            $this->session->set_flashdata('sucess', "Ads have been inserted sucessfully");
                			redirect('admin/ads');
                    }
            
		}
	     //*****************************  Validation **************************************    
         // add breadcrumbs
              $datas['sitetitle']       = 'Modify/Listing Ads >Add ';
            $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Ads ', "/admin/ads" ); 
           $this->breadcrumbs->push('<a href="#ignore">Add</a>', "/admin/ads/create" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
           $datas['id']       = 0;
           $datas['name']       = '';
           $datas['page_action']   = 'Add';
            $data['sitetitle']       = 'Modify/Listing Ads > Add';
           $datas['title'] = '';
    	   $datas['page_title']       = 'Modify/Listing Ads ';
           
           $datas['breadcrumds']       = $breadcrumds;
		   $datas['results']     = array();
        
           $datas['images_error']= $images_error;
          
           
           $regions_arr= $this->ads_model->GetAllRegion();
            $datas['regions_arr']=$regions_arr;
        
         if($this->input->post("title")){ $datas['title']= $this->input->post("title"); }else{ $datas['title']= ""; }
         if($this->input->post("type")){ $datas['type']= $this->input->post("type"); }else{ $datas['type']= ""; }
         if($this->input->post("regions")){ $datas['regions']= $this->input->post("regions"); }else{ $datas['regions']= ""; }
        
          $datas['flag']= ""; 
          $datas['image']= ""; 
           $datas['ext']="";
          
         $this->openView($datas,'add');
        }else
          {
             $this->session->set_flashdata('rightmsg', 'You have not write right to access');
			 	redirect('admin/dashboard');
          }    
    }
    
    
     function edit($id=0)
    {
          $images_error=array();
        $region_map_img_name="";
       $region_flag_img_name="";
       $region_image_img_name="";
       $region_coverimage_img_name="";
      //*******************************  Validation  ********************
      if($id !=7) // this id is working for background image , this is static id
      {
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
                     'label'   => "Ads Title",
                     'rules'   => 'required|callback_edittitle_check'
                  )
               
            );
     $checkvalidation=TRUE;
   }else{ 
    $config=array();
    $checkvalidation=FALSE;
   }
   
    if(affilateright("ads","write")==true)
       { 
        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == $checkvalidation && !empty($_POST))
		{
		  // echo "<pre>";
          // print_r($this->input->post());
          // print_r($_FILES);
           $data["regions"]=$this->input->post("regions");
           $data["title"]=$this->input->post("title");
           $data["type"]=$this->input->post("type");
           $data["video_name"]=$this->input->post("video_name");
           $data["id"]=$this->input->post("id");
                $adsid=$data["id"];
              //*******************************************************************
               
                  if(!empty($_FILES["image"]['name']))
					{
				        $gettmp_tumbs_arr=array();
                        $imagecounter=1; 
					    $ext = explode(".",$_FILES["image"]['name']);
						$ext = end($ext);
						$uploadConst['upload_path']   = SITE_UPLOADPATH;
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp|mp4|bat|flv';
                        //$uploadConst['max_size'] = REGION_MAP;
                         $uploadConst['overwrite'] = TRUE;
						$uploadConst['file_name']     = 'ads-'.$adsid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload('image'))
							{
						      	$remap_error= $this->upload->display_errors(); 
                                $images_error["ads_error"]=$remap_error;
                             }
						 else
							{   
							   $config=array();
                               $image_data=array();
                               $image_data = $this->upload->data();
                               $region_image_img_name= $image_data["orig_name"];
                               // $region_ext_img_name= $image_data["file_ext"];
                               
                                  if($adsid==7)  // this id work for background image
                                  {
                                      $gettmp_tumbs_arr[$adsid]=$image_data['full_path'];
                               
                              // echo "<pre>";
                              // print_r($gettmp_tumbs_arr);
                               //********************************* Resize ****************************
                                   foreach($gettmp_tumbs_arr as $key => $imageurl)
                                         {
                                            unset($config);
                                            $config = array( 
                                                    'image_library' => 'gd2',
                                                    'source_image' => $imageurl,
                                                    'new_image' => SITE_UPLOADPATH,
                                                    'maintain_ratio' => false,
                                                    'overwrite' => TRUE,
                                                    'file_name'     => 'ads-'.$key.".".$ext, 
                                                    'width' => 1500,
                                                    'height' => 450
                                                );
                                    
                                                
                                                $this->image_lib->initialize($config);
                                               
                                               // $this->image_lib->resize();
                                                if(!$this->image_lib->resize())
                                                {
                                                     $this->image_lib->display_errors();
                                                }
                                                unset($config);
                                                $this->image_lib->clear();
                                          }  
                                                   
                               //************************************************************************* 
                           }else
                           {  // gif|jpg|png|bmp
                             $checkimg=array("gif","jpeg","jpg","png","bmp");
                             
                            if(in_array($ext,$checkimg))
                            {
                                $gettmp_tumbs_arr[$peopleprofileid]=$image_data['full_path'];
                                 //********************************* Resize ****************************
                                   foreach($gettmp_tumbs_arr as $key => $imageurl)
                                         {
                                            unset($config);
                                            $config = array( 
                                                    'image_library' => 'gd2',
                                                    'source_image' => $imageurl,
                                                    'new_image' => SITE_UPLOADPATH,
                                                   'maintain_ratio' => false,
                                                    'overwrite' => TRUE,
                                                    'file_name'     => 'ads-'.$key.".".$ext,  
                                                    'width' => 800,
                                                    'height' => 520
                                                );
                                    
                                                
                                                $this->image_lib->initialize($config);
                                               
                                               // $this->image_lib->resize();
                                                if(!$this->image_lib->resize())
                                                {
                                                     $this->image_lib->display_errors();
                                                }
                                                unset($config);
                                                $this->image_lib->clear();
                                          
                                        /*************************************/
                                          unset($config);
                                            $config = array( 
                                                    'image_library' => 'gd2',
                                                    'source_image' => $imageurl,
                                                    'new_image' => SITE_UPLOADPATH.'thumbs/',
                                                  'maintain_ratio' => false,
                                                    'overwrite' => TRUE,
                                                    'file_name'     => 'ads-'.$key.".".$ext, 
                                                    'width' => 200,
                                                    'height' => 150
                                                );
                                    
                                                
                                                $this->image_lib->initialize($config);
                                               
                                               // $this->image_lib->resize();
                                                if(!$this->image_lib->resize())
                                                {
                                                     $this->image_lib->display_errors();
                                                }
                                                unset($config);
                                                $this->image_lib->clear();
                                        
                                       }  
                                                   
                               //*************************************************************************   
                            } 
                            
                           }
                               
                               
                               
                               
                            }
                    }
            //******************************************************************** 
            if(empty($images_error))
                    { 
                          
                            $data["ads_image"]= $region_image_img_name;  
                            // $data["ads_imageext"]= $region_ext_img_name;
                            $this->ads_model->update($data);
                            $this->session->set_flashdata('sucess', "Ads have been updated sucessfully");
                			redirect('admin/ads');
                    }
            
           
           
            
		}
	     //*****************************  Validation **************************************    
         // add breadcrumbs
            //$this->breadcrumbs->push('Home', '/admin/dashboard');
           $datas['sitetitle']       = 'Modify/Listing Ads >Add ';
           $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Ads ', "/admin/ads" ); 
           $this->breadcrumbs->push('<a href="#ignore">Edit</a>', "/admin/ads/edit" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
           $datas['id']       = $id;
       
           $datas['page_action']   = 'Edit';
           $datas['title'] = 'Modify/Listing Ads';
            $data['sitetitle']       = 'Modify/Listing Ads > Edit';
    	   $datas['page_title']       = 'Modify/Listing Ads';
           
          $datas['breadcrumds']       = $breadcrumds;
          $datas['images_error']= $images_error;
          
          
          $editdata=$this->ads_model->GetadsById($id);
           $regions_arr= $this->ads_model->GetAllRegion();
            $datas['regions_arr']=$regions_arr;
        
         if($this->input->post("title"))
         { $datas['title']= $this->input->post("title"); }
         elseif (!empty($editdata)) {
			$datas['title'] = $editdata[0]["title"];
		 } 
         else{ $datas['title']= ""; }
         
         if($this->input->post("regions"))
         { $datas['regions']= $this->input->post("regions"); }
         elseif (!empty($editdata)) {
		             $data_tmp=  explode(",",$editdata[0]["regions"]);
                 foreach($data_tmp as $key => $getid)
                 {    
                   $tmp_regions[$getid]=$getid;
                 }
               if(!empty($tmp_regions))
               {  
                 $datas['regions']=$tmp_regions;
                }else
                {
                  $datas['regions']="";  
                }     
		 }
         else{ $datas['regions']= ""; }
         
          if($this->input->post("type"))
         { $datas['type']= $this->input->post("type"); }
         elseif (!empty($editdata)) {
		      $datas['type']       =  $editdata[0]["type"];
		 }
         else{ $datas['type']= ""; }
         
        
         if (!empty($editdata)) {
		       $datas['image']= $editdata[0]["image"];
		 }
         else{ $datas['image']= ""; }
         
         $datas['ext']=$editdata[0]["filetype"];
      
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
		if ($this->ads_model->check_name($str) > 0)
		{
			$this->form_validation->set_message('name_check', 'The Ads name ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    public function editname_check($str)
	{
		if ($this->ads_model->editcheck_name($this->input->post("id"),$str) > 0)
		{
			$this->form_validation->set_message('editname_check', 'The Ads name ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

   public function title_check($str)
	{
		if ($this->ads_model->check_title($str) > 0)
		{
			$this->form_validation->set_message('title_check', 'The Ads title ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    public function edittitle_check($str)
	{
		if ($this->ads_model->editcheck_title($this->input->post("id"),$str) > 0)
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
		$this->load->view('admin/ads/'.$viewName,$xdata);
		$this->load->view('admin/footer');
	}
    
    public function deleteimage()
    {
       $strgetid=$this->input->post("strgetid"); 
       $editdata=$this->ads_model->GetadsById($strgetid);
       
       $success="Y";

            $getimagename=$editdata[0]["image"];
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
              $this->ads_model->updateimage($strgetid,"image");
            }else
            {
             $success="N";         
            }                    
        
        
         echo $success;
    }
    
    public function setbackgroundimage()
    {
          $editid=$this->input->post("editid");
          $this->ads_model->setbackgroundimage($editid); 
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
}
?>