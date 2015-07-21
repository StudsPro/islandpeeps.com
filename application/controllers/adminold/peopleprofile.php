<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Peopleprofile extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;

    function __construct()
        {
            parent::__construct();
            if(!$this->session->userdata('logged_in')){redirect('/');}
            $this->load->model("peopleprofile_model");
            
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
                       $this->peopleprofile_model->deleterecords($selected);
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been deleted successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                 redirect('admin/peopleprofile');  
           }     
            
             if($this->input->post("btn_avaible"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->peopleprofile_model->changeselectstatus($selected,'1');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been status(AVAILABLE) changed successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                 redirect('admin/peopleprofile');  
           }  
            
             if($this->input->post("btn_pending"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->peopleprofile_model->changeselectstatus($selected,'2');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been status(PENDING) changed successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                 redirect('admin/peopleprofile');  
           }  
           
            if($this->input->post("btn_ready"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->peopleprofile_model->changeselectstatus($selected,'3');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been status(READY) changed successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                 redirect('admin/peopleprofile');  
           }  
           
            if($this->input->post("btn_publish"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->peopleprofile_model->changeselectstatus($selected,'4');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been status(PUBLISH) changed successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                 redirect('admin/peopleprofile');  
           }  
        //***********************************************************
         // $data['results'] = $this->peopleprofile_model->GetAllrecords($serachdata,$limit,$start);
           $regions_arr= $this->peopleprofile_model->GetAllRegion();
            $data['regions_arr']=$regions_arr;
          $data['results'] = $this->peopleprofile_model->GetAllrecords();
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
                     'field'   => 'name',
                     'label'   => "Name",
                     'rules'   => 'required|callback_name_check'
                  ) ,
               array(
                     'field'   => 'kind',
                     'label'   => "User Kind",
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'category',
                     'label'   => "Category",
                     'rules'   => 'required'
                  )
                  ,
               array(
                     'field'   => 'tags',
                     'label'   => "Tags",
                     'rules'   => 'required'
                  )
               
            );
         $gettmp_tumbs_arr=array();   
    if(affilateright("peopleprofile","write")==true)
       { 
        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		      
            $data["regions"]=$this->input->post("regions");
            $data["name"]=$this->input->post("name");
            $data["kind"]=$this->input->post("kind");
            $data["kind"]=$this->input->post("kind");
            $data["category"]=$this->input->post("category");
            $data["month"]=$this->input->post("month");
            $data["day"]=$this->input->post("day");
            $data["year"]=$this->input->post("year");
            $data["video"]=$this->input->post("video");
            $data["profiledetail"]=$this->input->post("profiledetail");
            $data["tags"]=$this->input->post("tags");
            $data["facebook"]=$this->input->post("facebook");
            $data["facebookfunpage"]=$this->input->post("facebookfunpage");
            $data["twitter"]=$this->input->post("twitter");
            $data["twitterfunpage"]=$this->input->post("twitterfunpage");
            $data["status"]=$this->input->post("status");
            $data["shortdesc"]=$this->input->post("shortdesc"); 
             $data["twittershortdesc"]=$this->input->post("twittershortdesc"); 
             
           $peopleprofileid=$this->peopleprofile_model->getmaxid("id","tbl_profiles");
          
            //*******************************************************************
               
                if(!empty($_FILES["image"]['name']))
					{
				        $gettmp_tumbs_arr=array();
                        $imagecounter=1; 
					    $ext = explode(".",$_FILES["image"]['name']);
						$ext = end($ext);
						$uploadConst['upload_path']   = SITE_UPLOADPATH;
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
                        //$uploadConst['max_size'] = REGION_MAP;
                       // $uploadConst['min_width'] = '1400';
                       // $uploadConst['min_height'] = '900';
						$uploadConst['file_name']     = 'peopleprofile-'.$peopleprofileid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload('image'))
							{
						     echo 	$remap_error= $this->upload->display_errors(); 
                                $images_error["peopleprofile_error"]=$remap_error;
                             }
						 else
							{   
							   $config=array();
                               $image_data=array();
                               $image_data = $this->upload->data();
                              
                               $region_image_img_name= $image_data["orig_name"];
                               $region_ext_img_name= $image_data["file_ext"];
                               
                                $gettmp_tumbs_arr[$peopleprofileid]=$image_data['full_path'];
                               
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
                                                    'file_name'     => 'peopleprofile-'.$key.".".$ext, 
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
                                                    'file_name'     => 'peopleprofile-'.$key.".".$ext, 
                                                    'width' => 300,
                                                    'height' => 250
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
            //******************************************************************** 
                 // echo "Test"; exit;
            
                    if(empty($images_error))
                    { 
                            $data["peopleprofile_image"]= $region_image_img_name;
                            $data["peopleprofile_imageext"]= $region_ext_img_name;
                            
                              
                            $this->peopleprofile_model->insert($data);
                            $this->session->set_flashdata('sucess', "People profile have been inserted sucessfully");
                			redirect('admin/peopleprofile');
                    }
                    
                   
            
		}
	     //*****************************  Validation **************************************    
         // add breadcrumbs
              $datas['sitetitle']       = 'Modify/Listing Profile >Add ';
            $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Profile ', "/admin/peopleprofile" ); 
           $this->breadcrumbs->push('<a href="#ignore">Add</a>', "/admin/peopleprofile/create" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
           $datas['id']       = 0;
           $datas['name']       = '';
           $datas['page_action']   = 'Add';
            $data['sitetitle']       = 'Modify/Listing peopleprofile > Add';
           $datas['title'] = '';
    	   $datas['page_title']       = 'Modify/Listing Profile ';
           
           $datas['breadcrumds']       = $breadcrumds;
		   $datas['results']     = array();
        
           $datas['images_error']= $images_error;
          
           
           $regions_arr= $this->peopleprofile_model->GetAllRegion();
           $datas['regions_arr']=$regions_arr;
            
           $Categorys_arr= $this->peopleprofile_model->GetAllCategory();
           $datas['categorys_arr']=$Categorys_arr; 
            
        
         if($this->input->post("name")){ $datas['name']= $this->input->post("name"); }else{ $datas['name']= ""; }
         if($this->input->post("kind")){ $datas['kind']= $this->input->post("kind"); }else{ $datas['kind']= ""; }
         if($this->input->post("category")){ $datas['category']= $this->input->post("category"); }else{ $datas['category']= ""; }
         if($this->input->post("regions")){ $datas['regions']= $this->input->post("regions"); }else{ $datas['regions']= ""; }
         
          if($this->input->post("month")){ $datas['month']= $this->input->post("month"); }else{ $datas['month']= ""; }
          if($this->input->post("year")){ $datas['year']= $this->input->post("year"); }else{ $datas['year']= ""; }
          if($this->input->post("day")){ $datas['day']= $this->input->post("day"); }else{ $datas['day']= ""; }
          if($this->input->post("video")){ $datas['video']= $this->input->post("video"); }else{ $datas['video']= ""; }
          
          if($this->input->post("profiledetail")){ $datas['profiledetail']= $this->input->post("profiledetail"); }else{ $datas['profiledetail']= ""; }
          if($this->input->post("tags")){ $datas['tags']= $this->input->post("tags"); }else{ $datas['tags']= ""; }
          
          if($this->input->post("facebookfunpage")){ $datas['facebookfunpage']= $this->input->post("facebookfunpage"); }else{ $datas['facebookfunpage']= ""; }
          if($this->input->post("facebook")){ $datas['facebook']= $this->input->post("facebook"); }else{ $datas['facebook']= ""; }
          if($this->input->post("twitterfunpage")){ $datas['twitterfunpage']= $this->input->post("twitterfunpage"); }else{ $datas['twitterfunpage']= ""; }
          if($this->input->post("twitter")){ $datas['twitter']= $this->input->post("twitter"); }else{ $datas['twitter']= ""; }
           if($this->input->post("status")){ $datas['status']= $this->input->post("status"); }else{ $datas['status']= "1"; }
           if($this->input->post("shortdesc")){ $datas['shortdesc']= $this->input->post("shortdesc"); }else{ $datas['shortdesc']= ""; } 
          if($this->input->post("twittershortdesc")){ $datas['twittershortdesc']= $this->input->post("twittershortdesc"); }else{ $datas['twittershortdesc']= ""; }   
          
         
          $datas['admin_id']= "0"; 
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
$config = array(
                array(
                     'field'   => 'regions[]',
                     'label'   => "Regions ",
                     'rules'   => 'required'
                  ),
                array(
                     'field'   => 'name',
                     'label'   => "Name",
                     'rules'   => 'required|callback_editname_check'
                  ) ,
               array(
                     'field'   => 'kind',
                     'label'   => "User Kind",
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'category',
                     'label'   => "Category",
                     'rules'   => 'required'
                  )
                  ,
               array(
                     'field'   => 'tags',
                     'label'   => "Tags",
                     'rules'   => 'required'
                  )
               
            );
   if(affilateright("peopleprofile","write")==true)
       { 
        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		  // echo "<pre>";
          // print_r($this->input->post());
          // print_r($_FILES);
            $data["regions"]=$this->input->post("regions");
            $data["name"]=$this->input->post("name");
            $data["kind"]=$this->input->post("kind");
            $data["kind"]=$this->input->post("kind");
            $data["category"]=$this->input->post("category");
            $data["month"]=$this->input->post("month");
            $data["day"]=$this->input->post("day");
            $data["year"]=$this->input->post("year");
            $data["video"]=$this->input->post("video");
            $data["profiledetail"]=$this->input->post("profiledetail");
            $data["tags"]=$this->input->post("tags");
            $data["facebook"]=$this->input->post("facebook");
            $data["facebookfunpage"]=$this->input->post("facebookfunpage");
            $data["twitter"]=$this->input->post("twitter");
            $data["twitterfunpage"]=$this->input->post("twitterfunpage");
            $data["status"]=$this->input->post("status");
            $data["rejectreason"]=$this->input->post("rejectreason");
            
            $data["shortdesc"]=$this->input->post("shortdesc");
            $data["twittershortdesc"]=$this->input->post("twittershortdesc");
            
             
             $data["id"]=$this->input->post("id");
                $peopleprofileid=$this->input->post("id");
              //*******************************************************************
               
                  if(!empty($_FILES["image"]['name']))
					{
				        $gettmp_tumbs_arr=array();
                        $imagecounter=1; 
					    $ext = explode(".",$_FILES["image"]['name']);
						$ext = strtolower($ext[1]);
						$uploadConst['upload_path']   = SITE_UPLOADPATH;
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
                        //$uploadConst['max_size'] = REGION_MAP;
                        // $uploadConst['max_width'] = '1200';
                        // $uploadConst['max_height'] = '900';
                        // $uploadConst['min_width'] = '1400';
                        // $uploadConst['min_height'] = '900';
                         $uploadConst['overwrite'] = TRUE;
						$uploadConst['file_name']     = 'peopleprofile-'.$peopleprofileid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload('image'))
							{
						      	$remap_error= $this->upload->display_errors(); 
                                $images_error["peopleprofile_error"]=$remap_error;
                             }
						 else
							{   
							   $config=array();
                               $image_data=array();
                               $image_data = $this->upload->data();
                              
                               $region_image_img_name= $image_data["orig_name"];
                                $region_ext_img_name= $image_data["file_ext"];
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
                                                    'file_name'     => 'peopleprofile-'.$key.".".$ext, 
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
                                                    'file_name'     => 'peopleprofile-'.$key.".".$ext, 
                                                    'width' => 300,
                                                    'height' => 250
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
            //******************************************************************** 
            if(empty($images_error))
                    { 
                          
                            $data["peopleprofile_image"]= $region_image_img_name;  
                            $this->peopleprofile_model->update($data);
                            $this->session->set_flashdata('sucess', "People profile have been updated sucessfully");
                			redirect('admin/peopleprofile');
                    }
            
           
           
            
		}
	     //*****************************  Validation **************************************    
         // add breadcrumbs
            //$this->breadcrumbs->push('Home', '/admin/dashboard');
           $datas['sitetitle']       = 'Modify/Listing peopleprofile >Add ';
           $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Profile ', "/admin/peopleprofile" ); 
           $this->breadcrumbs->push('<a href="#ignore">Edit</a>', "/admin/peopleprofile/edit" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
           $datas['id']       = $id;
       
           $datas['page_action']   = 'Edit';
           $datas['title'] = 'Modify/Listing peopleprofile';
            $data['sitetitle']       = 'Modify/Listing peopleprofile > Edit';
    	   $datas['page_title']       = 'Modify/Listing peopleprofile';
           
          $datas['breadcrumds']       = $breadcrumds;
          $datas['images_error']= $images_error;
          
          
          $editdata=$this->peopleprofile_model->GetpeopleprofileById($id);
           $regions_arr= $this->peopleprofile_model->GetAllRegion();
            $datas['regions_arr']=$regions_arr;
             $Categorys_arr= $this->peopleprofile_model->GetAllCategory();
           $datas['categorys_arr']=$Categorys_arr; 
            
           
           	$datas['admin_id'] = $editdata[0]["admin_id"];
            
         if($this->input->post("name"))
         { $datas['name']= $this->input->post("name"); }
         elseif (!empty($editdata)) {
			$datas['name'] = $editdata[0]["title"];
		 } 
         else{ $datas['name']= ""; }
         
         if($this->input->post("regions"))
         { $datas['regions']= $this->input->post("regions"); }
         elseif (!empty($editdata)) {
		             $data_tmp=  explode(",",$editdata[0]["region_id"]);
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
         
          if($this->input->post("category"))
         { $datas['category']= $this->input->post("category"); }
         elseif (!empty($editdata)) {
		      $datas['category']       =  $editdata[0]["category"];
		 }
         else{ $datas['category']= ""; }
         
          if($this->input->post("kind"))
         { $datas['kind']= $this->input->post("kind"); }
         elseif (!empty($editdata)) {
		      $datas['kind']       =  $editdata[0]["kind"];
		 }
         else{ $datas['kind']= ""; }
         
            if($this->input->post("shortdesc"))
         { $datas['shortdesc']= $this->input->post("shortdesc"); }
         elseif (!empty($editdata)) {
		      $datas['shortdesc']       =  $editdata[0]["shortdesc"];
		 }
         else{ $datas['shortdesc']= ""; }
         
          if($this->input->post("twittershortdesc"))
         { $datas['twittershortdesc']= $this->input->post("twittershortdesc"); }
         elseif (!empty($editdata)) {
		      $datas['twittershortdesc'] =  $editdata[0]["twittershortdesc"];
		 }
         else{ $datas['twittershortdesc']= ""; }
           
         
        
         if (!empty($editdata)) {
		       $datas['image']= $editdata[0]["image"];
		 }
         else{ $datas['image']= ""; }
         
         
          list($year,$month,$day)=explode("-",$editdata[0]["dob"]);
           
           if($this->input->post("year"))
         { $datas['year']= $this->input->post("year"); }
         elseif (!empty($editdata)) {
		      $datas['year']       =  $year;
		 }
         else{ $datas['year']= ""; }
         
         if($this->input->post("month")){ $datas['month']= $this->input->post("month"); }
         elseif (!empty($editdata)) {$datas['month']       =  $month;}
         else{ $datas['month']= ""; }
         
         if($this->input->post("day")){ $datas['day']= $this->input->post("day"); }
         elseif (!empty($editdata)) {$datas['day']       =  $day;}
         else{ $datas['day']= ""; }
           
          if($this->input->post("video")){ $datas['video']= $this->input->post("video"); }
          elseif (!empty($editdata)) {$datas['video']       =  $editdata[0]["video"];}
          else{ $datas['video']= ""; }  
           
          if($this->input->post("profiledetail")){ $datas['profiledetail']= $this->input->post("profiledetail"); }
          elseif (!empty($editdata)) {$datas['profiledetail']       =  $editdata[0]["description"];}
          else{ $datas['profiledetail']= ""; }  
          
          if($this->input->post("tags")){ $datas['tags']= $this->input->post("tags"); }
          elseif (!empty($editdata)) {$datas['tags']       =  $editdata[0]["tags"];}
          else{ $datas['tags']= ""; }  
          
          if($this->input->post("facebook")){ $datas['facebook']= $this->input->post("facebook"); }
          elseif (!empty($editdata)) {$datas['facebook']       =  $editdata[0]["facebook"];}
          else{ $datas['facebook']= ""; }  
          
          if($this->input->post("facebookfunpage")){ $datas['facebookfunpage']= $this->input->post("facebookfunpage"); }
          elseif (!empty($editdata)) {$datas['facebookfunpage']       =  $editdata[0]["facebookfanpage"];}
          else{ $datas['facebookfunpage']= ""; }   
          
           if($this->input->post("twitter")){ $datas['twitter']= $this->input->post("twitter"); }
          elseif (!empty($editdata)) {$datas['twitter']       =  $editdata[0]["twitter"];}
          else{ $datas['twitter']= ""; }   
          
          
           if($this->input->post("twitterfunpage")){ $datas['twitterfunpage']= $this->input->post("twitterfunpage"); }
          elseif (!empty($editdata)) {$datas['twitterfunpage']       =  $editdata[0]["twitterfanpage"];}
          else{ $datas['twitterfunpage']= ""; }   
          
           if($this->input->post("status")){ $datas['status']= $this->input->post("status"); }
          elseif (!empty($editdata)) {$datas['status']       =  $editdata[0]["status"];}
          else{ $datas['status']= ""; }   
      
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
		if ($this->peopleprofile_model->check_name($str) > 0)
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
		if ($this->peopleprofile_model->editcheck_name($this->input->post("id"),$str) > 0)
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
		if ($this->peopleprofile_model->check_title($str) > 0)
		{
			$this->form_validation->set_message('title_check', 'The peopleprofile title ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    public function edittitle_check($str)
	{
		if ($this->peopleprofile_model->editcheck_title($this->input->post("id"),$str) > 0)
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
		$this->load->view('admin/peopleprofile/'.$viewName,$xdata);
		$this->load->view('admin/footer');
	}
    
    public function deleteimage()
    {
       $strgetid=$this->input->post("strgetid"); 
       $editdata=$this->peopleprofile_model->GetpeopleprofileById($strgetid);
       
       $success="Y";

            $getimagename=$editdata[0]["image"];
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
              $this->peopleprofile_model->updateimage($strgetid,"image");
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
        
         $this->peopleprofile_model->changestatus($strgetid,$strstatus); 
          $this->session->set_flashdata('sucess', "Send to Admin Confirmation sucessfully");
       echo "Y";  
    }
    public function setbackgroundimage()
    {
          $editid=$this->input->post("editid");
          $this->peopleprofile_model->setbackgroundimage($editid); 
    }  
}
?>