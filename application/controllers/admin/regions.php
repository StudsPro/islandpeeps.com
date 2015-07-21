<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Regions extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;

    function __construct()
        {
            parent::__construct();
            if(!$this->session->userdata('logged_in')){redirect('/admin');}
            $this->load->model("region_model");
            
            $this->load->helper("file");
            $this->load->library('upload');
            $this->load->library('form_validation');
            $this->load->helper('general_helper');
            $this->load->library('image_lib');
            $this->load->library('pagination');
            $this->load->library('breadcrumbs');
        }

   function index($offset=0,$searchstr="")
	   { 
	   		
			if(isset($_POST['delete']))
			{
				$this->region_model->changeRegionStatus();
				redirect('admin/regions');
			}
			  // add breadcrumbs
         //  $this->breadcrumbs->push('Home', '/admin/dashboard');
           $this->breadcrumbs->push('<i class="fa fa-home fa-lg"></i>', '/admin/dashboard');
          // $this->breadcrumbs->push('Country List', "/admin/regions" );
           $this->breadcrumbs->push('<a href="#ignore">Country(s) List</a>', "&nbsp;" );
           
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Country(s) ';
            $data['page_title']       = 'Country(s) List';
			$data['page_action'] = 'Country(s)';
            //******************************************************
          $data['results'] = $this->region_model->GetAllRegion();
		  $this->openView($data,'index');
	   }

   
    
    function create($id=0)
    {
      
      //*******************************  Validation  ********************
       $images_error=array();
       $region_map_img_name="";
       $region_flag_img_name="";
       $region_image_img_name="";
       $region_coverimage_img_name="";
	$config = array(
               array(
                     'field'   => 'name',
                     'label'   => "Country name",
                     'rules'   => 'required|callback_name_check'
                  ),
                array(
                     'field'   => 'title',
                     'label'   => "Country title",
                     'rules'   => 'required|callback_title_check'
                  )   
            );
   if(affilateright("regions","write")==true)
       {  
        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		  // echo "<pre>";
          // print_r($this->input->post());
          // print_r($_FILES);
           $motto=addslashes($this->input->post("motto"));
           $anthem=addslashes($this->input->post("anthem"));
           $national_dish=addslashes($this->input->post("national_dish"));
           
           $flag_desc_arr=array("motto"=>$motto,
                                "anthem"=>$anthem,
                                "national_dish"=>$national_dish);
           $flag_desc=json_encode($flag_desc_arr, JSON_FORCE_OBJECT);
           
            $capital=addslashes($this->input->post("capital"));
            $language=addslashes($this->input->post("language"));
            $population=addslashes($this->input->post("population"));
            $shortdesc=addslashes($this->input->post("shortdesc"));
            
           $population_arr=array("capital"=>$capital,
                                "language"=>$language,
                                "population"=>$population,
                                "flag_shortdesc"=>$shortdesc);
           $population=json_encode($population_arr, JSON_FORCE_OBJECT); 
           
           
           $data["name"]=$this->input->post("name");
           $data["title"]=$this->input->post("title");
           $data["banner"]=$this->input->post("banner");
           $data["independenceday"]=$this->input->post("year")."-".$this->input->post("month")."-".$this->input->post("day");
           $data["description"]=addslashes($this->input->post("content"));	
           $data["flag_desc"]=$flag_desc;
           $data["population"]=$population;
           $data["longitude"]=addslashes($this->input->post("longitude"));		
           $data["latitude"]=addslashes($this->input->post("latitude"));
           	 $data["status"]=$this->input->post("status");
            $data["twittershortdesc"]=$this->input->post("twittershortdesc");  
             
            $regionid=$this->region_model->getmaxid("id","tbl_regions");
            //*******************************************************************
               
                if(!empty($_FILES["ragion_map"]['name']))
					{
				        $gettmp_tumbs_arr=array();
                        $imagecounter=1; 
					    $ext = explode(".",$_FILES["ragion_map"]['name']);
						$ext = end($ext);
						$uploadConst['upload_path']   = SITE_UPLOADPATH;
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp';
                        $uploadConst['max_size'] = REGION_MAP;
						$uploadConst['file_name']     = 'regionimap-'.$regionid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload('ragion_map'))
							{
						      	$remap_error= $this->upload->display_errors(); 
                                $images_error["remap_error"]=$remap_error;
                             }
						 else
							{   
							   $config=array();
                               $image_data=array();
                               $image_data = $this->upload->data();
                               $region_map_img_name= $image_data["orig_name"];
                            }
                    }
            //******************************************************************** 
              //*******************************************************************
               
                if(!empty($_FILES["flag"]['name']))
					{
				        $gettmp_tumbs_arr=array();
                        $imagecounter=1; 
					    $ext = explode(".",$_FILES["flag"]['name']);
						$ext = end($ext);
						$uploadConst['upload_path']   = SITE_UPLOADPATH;
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
                        $uploadConst['max_size'] = REGION_FLAG;
                        
                       
						$uploadConst['file_name']     = 'regionflag-'.$regionid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload('flag'))
							{
						      	$remap_error= $this->upload->display_errors(); 
                                $images_error["flag_error"]=$remap_error;
                             }
						 else
							{   
							   $config=array();
                               $image_data=array();
                               $image_data = $this->upload->data();
                               $region_flag_img_name= $image_data["orig_name"];
                               
                                 $gettmp_tumbs_arr=array();
                                 $gettmp_tumbs_arr[$regionid]=$image_data['full_path'];
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
                                                    'file_name'     => 'regionflag-'.$key.'.jpg', 
                                                    'width' => 300,
                                                    'height' => 180
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
                               
                               
                            }
                         }   
                    }
            //******************************************************************** 
            //*******************************************************************
               
                if(!empty($_FILES["image"]['name']))
					{
				        $gettmp_tumbs_arr=array();
                        $imagecounter=1; 
					    $ext = explode(".",$_FILES["image"]['name']);
						$ext = end($ext);
						$uploadConst['upload_path']   = SITE_UPLOADPATH;
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
                        $uploadConst['max_size'] = REGION_IMAGE;
						$uploadConst['file_name']     = 'regionimage-'.$regionid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload('image'))
							{
						      	$remap_error= $this->upload->display_errors(); 
                                $images_error["image_error"]=$remap_error;
                             }
						 else
							{   
							   $config=array();
                               $image_data=array();
                               $image_data = $this->upload->data();
                               $region_image_img_name= $image_data["orig_name"];
                               
                               $gettmp_tumbs_arr=array();
                                 $gettmp_tumbs_arr[$regionid]=$image_data['full_path'];
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
                                                    'file_name'     => 'regionimage-'.$key.'.jpg', 
                                                    'width' => 490,
                                                    'height' => 300
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
                            }
                            }
                    }
            //******************************************************************** 
            
              //*******************************************************************
               
                if(!empty($_FILES["cover_image"]['name']))
					{
				        $gettmp_tumbs_arr=array();
                        $imagecounter=1; 
					    $ext = explode(".",$_FILES["cover_image"]['name']);
						$ext = end($ext);
						$uploadConst['upload_path']   = SITE_UPLOADPATH;
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
                        $uploadConst['max_size'] = REGION_COVERIMAGE;
						$uploadConst['file_name']     = 'regioncoverimage-'.$regionid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload('cover_image'))
							{
						      	$remap_error= $this->upload->display_errors(); 
                                $images_error["coverimage_error"]=$remap_error;
                             }
						 else
							{   
							   $config=array();
                               $image_data=array();
                               $image_data = $this->upload->data();
                               $region_coverimage_img_name= $image_data["orig_name"];
                               
                                $gettmp_tumbs_arr=array();
                                 $gettmp_tumbs_arr[$regionid]=$image_data['full_path'];
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
                                                    'file_name'     => 'regioncoverimage-'.$key.'.jpg', 
                                                    'width' => 200,
                                                    'height' => 200
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
                               
                            }
                            }
                    }
            //******************************************************************** 
            
                    if(empty($images_error))
                    { 
                            $data["ragion_map"]= $region_map_img_name;
                            $data["ragion_flag"]= $region_flag_img_name;
                            $data["ragion_image"]= $region_image_img_name;  
                            $data["ragion_coverimage"]= $region_coverimage_img_name; 
                            
                            $this->region_model->insert($data);
                            $this->session->set_flashdata('sucess', "Country have been inserted sucessfully");
                			redirect('admin/regions');
                    }
            
		}
	     //*****************************  Validation **************************************    
         // add breadcrumbs
           // $this->breadcrumbs->push('Home', '/admin/dashboard');
           $this->breadcrumbs->push('<i class="fa fa-home fa-lg"></i>', '/admin/dashboard');
           $this->breadcrumbs->push('Country List', "/admin/regions" ); 
           $this->breadcrumbs->push('<a href="#ignore">Add</a>', "/admin/regions/create" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
           $datas['id']       = 0;
           $datas['name']       = '';
           $datas['page_action']   = 'Add';
           $datas['title'] = '';
    	   $datas['page_title']       = 'Country(s)';
            $datas['sitetitle']       = 'Country(s) ';
            $datas['page_title']       = 'Country(s) List';
			$datas['page_action'] = 'Country(s)';
           $datas['breadcrumds']       = $breadcrumds;
		   $datas['results']     = array();
        
           $datas['images_error']= $images_error;
          
           
         if($this->input->post("name")){ $datas['name']= $this->input->post("name"); }else{ $datas['name']= ""; }
         if($this->input->post("motto")){ $datas['motto']= $this->input->post("motto"); }else{ $datas['motto']= ""; }
         if($this->input->post("anthem")){ $datas['anthem']= $this->input->post("anthem"); }else{ $datas['anthem']= ""; }
         if($this->input->post("national_dish")){ $datas['national_dish']= $this->input->post("national_dish"); }else{ $datas['national_dish']= ""; }
         if($this->input->post("capital")){ $datas['capital']= $this->input->post("capital"); }else{ $datas['capital']= ""; }
         if($this->input->post("language")){ $datas['language']= $this->input->post("language"); }else{ $datas['language']= ""; }
         if($this->input->post("population")){ $datas['population']= $this->input->post("population"); }else{ $datas['population']= ""; }
         if($this->input->post("shortdesc")){ $datas['shortdesc']= $this->input->post("shortdesc"); }else{ $datas['shortdesc']= ""; }
         if($this->input->post("title")){ $datas['title']= $this->input->post("title"); }else{ $datas['title']= ""; }
         if($this->input->post("content")){ $datas['content']= $this->input->post("content"); }else{ $datas['content']= ""; }
         if($this->input->post("longitude")){ $datas['longitude']= $this->input->post("longitude"); }else{ $datas['longitude']= ""; }
         if($this->input->post("latitude")){ $datas['latitude']= $this->input->post("latitude"); }else{ $datas['latitude']= ""; }
         if($this->input->post("year")){ $datas['year']= $this->input->post("year"); }else{ $datas['year']= ""; }
         if($this->input->post("month")){ $datas['month']= $this->input->post("month"); }else{ $datas['month']= ""; }
         if($this->input->post("day")){ $datas['day']= $this->input->post("day"); }else{ $datas['day']= ""; }
         if($this->input->post("twittershortdesc")){ $datas['twittershortdesc']= $this->input->post("twittershortdesc"); }else{ $datas['twittershortdesc']= ""; }
         
            if($this->input->post("status"))
         { $datas['status']= $this->input->post("status"); }
            else{ $datas['status']= "1"; }
          $datas['coverimage']= "";
          $datas['flag']= ""; 
          $datas['image']= ""; 
          $datas['ragion_map']= ""; 
          
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
                     'field'   => 'name',
                     'label'   => "Country name",
                     'rules'   => 'required|callback_editname_check'
                  ),
                array(
                     'field'   => 'title',
                     'label'   => "Country title",
                     'rules'   => 'required|callback_edittitle_check'
                  )   
            );
    if(affilateright("regions","write")==true)
       {  
        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		  // echo "<pre>";
          // print_r($this->input->post());
          // print_r($_FILES);
           $motto=addslashes($this->input->post("motto"));
           $anthem=addslashes($this->input->post("anthem"));
           $national_dish=addslashes($this->input->post("national_dish"));
           
           $flag_desc_arr=array("motto"=>$motto,
                                "anthem"=>$anthem,
                                "national_dish"=>$national_dish);
           $flag_desc=json_encode($flag_desc_arr, JSON_FORCE_OBJECT);
           
            $capital=addslashes($this->input->post("capital"));
            $language=addslashes($this->input->post("language"));
            $population=addslashes($this->input->post("population"));
            $shortdesc=addslashes($this->input->post("shortdesc"));
            
           $population_arr=array("capital"=>$capital,
                                "language"=>$language,
                                "population"=>$population,
                                "flag_shortdesc"=>$shortdesc);
           $population=json_encode($population_arr, JSON_FORCE_OBJECT); 
           
            $data["id"]=$this->input->post("id");
           $data["name"]=$this->input->post("name");
           $data["banner"]=$this->input->post("banner");
           $data["title"]=$this->input->post("title");
           $data["independenceday"]=$this->input->post("year")."-".$this->input->post("month")."-".$this->input->post("day");
           $data["description"]=addslashes($this->input->post("content"));	
           $data["flag_desc"]=$flag_desc;
           $data["population"]=$population;
           $data["longitude"]=addslashes($this->input->post("longitude"));		
           $data["latitude"]=addslashes($this->input->post("latitude"));
           $data["status"]=$this->input->post("status");
           $data["twittershortdesc"]=$this->input->post("twittershortdesc");     
               
                $regionid=$data["id"];
              //*******************************************************************
               
                if(!empty($_FILES["ragion_map"]['name']))
					{
				        $gettmp_tumbs_arr=array();
                        $imagecounter=1; 
					    $ext = explode(".",$_FILES["ragion_map"]['name']);
							$ext = end($ext);
						$uploadConst['upload_path']   = SITE_UPLOADPATH;
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp';
                        $uploadConst['max_size'] = REGION_MAP;
                        $uploadConst['overwrite'] = TRUE;
						$uploadConst['file_name']     = 'regionimap-'.$regionid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload('ragion_map'))
							{
						      	$remap_error= $this->upload->display_errors(); 
                                $images_error["remap_error"]=$remap_error;
                             }
						 else
							{   
							   $config=array();
                               $image_data=array();
                               $image_data = $this->upload->data();
                               $region_map_img_name= $image_data["orig_name"];
                            }
                    }
            //******************************************************************** 
              //*******************************************************************
               
                if(!empty($_FILES["flag"]['name']))
					{
				        $gettmp_tumbs_arr=array();
                        $imagecounter=1; 
					    $ext = explode(".",$_FILES["flag"]['name']);
						
                        $ext = end($ext);
						$uploadConst['upload_path']   = SITE_UPLOADPATH;
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp';
                        $uploadConst['max_size'] = REGION_FLAG;
                        $uploadConst['overwrite'] = TRUE;
						$uploadConst['file_name']     = 'regionflag-'.$regionid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload('flag'))
							{
						      	$remap_error= $this->upload->display_errors(); 
                                $images_error["flag_error"]=$remap_error;
                             }
						 else
							{   
							   $config=array();
                               $image_data=array();
                               $image_data = $this->upload->data();
                               $region_flag_img_name= $image_data["orig_name"];
                               
                               $gettmp_tumbs_arr=array();
                                 $gettmp_tumbs_arr[$regionid]=$image_data['full_path'];
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
                                                    'file_name'     => 'regionflag-'.$key.".".$ext, 
                                                    'width' => 300,
                                                    'height' => 180
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
                               
                             }
                            }
                    }
            //******************************************************************** 
            //*******************************************************************
               
                if(!empty($_FILES["image"]['name']))
					{
				        $gettmp_tumbs_arr=array();
                        $imagecounter=1; 
					    $ext = explode(".",$_FILES["image"]['name']);
							$ext = end($ext);
						$uploadConst['upload_path']   = SITE_UPLOADPATH;
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp';
                        $uploadConst['max_size'] = REGION_IMAGE;
                        $uploadConst['overwrite'] = TRUE;
						$uploadConst['file_name']     = 'regionimage-'.$regionid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload('image'))
							{
						      	$remap_error= $this->upload->display_errors(); 
                                $images_error["image_error"]=$remap_error;
                             }
						 else
							{   
							   $config=array();
                               $image_data=array();
                               $image_data = $this->upload->data();
                               $region_image_img_name= $image_data["orig_name"];
                               
                                $gettmp_tumbs_arr=array();
                                 $gettmp_tumbs_arr[$regionid]=$image_data['full_path'];
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
                                                    'file_name'     => 'regionimage-'.$key.".".$ext, 
                                                    'width' => 490,
                                                    'height' => 300
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
                            }
                            }
                    }
            //******************************************************************** 
            
              //*******************************************************************
               
                if(!empty($_FILES["cover_image"]['name']))
					{
				        $gettmp_tumbs_arr=array();
                        $imagecounter=1; 
					    $ext = explode(".",$_FILES["cover_image"]['name']);
						$ext = end($ext);
                       
						$uploadConst['upload_path']   = SITE_UPLOADPATH;
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp';
                        $uploadConst['max_size'] = REGION_COVERIMAGE;
                        $uploadConst['overwrite'] = TRUE;
						$uploadConst['file_name']     = 'regioncoverimage-'.$regionid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload('cover_image'))
							{
						      	$remap_error= $this->upload->display_errors(); 
                                $images_error["coverimage_error"]=$remap_error;
                             }
						 else
							{   
							   $config=array();
                               $image_data=array();
                               $image_data = $this->upload->data();
                               $region_coverimage_img_name= $image_data["orig_name"];
                               
                               $gettmp_tumbs_arr=array();
                                 $gettmp_tumbs_arr[$regionid]=$image_data['full_path'];
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
                                                    'file_name'     => 'regioncoverimage-'.$key.".".$ext, 
                                                    'width' => 200,
                                                    'height' => 200
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
                               
                               
                            }
                        }    
                    }
            //******************************************************************** 
          
                if(empty($images_error))
                    { 
                            $data["ragion_map"]= $region_map_img_name;
                            $data["ragion_flag"]= $region_flag_img_name;
                            $data["ragion_image"]= $region_image_img_name;  
                            $data["ragion_coverimage"]= $region_coverimage_img_name; 
                            
                            $this->region_model->update($data);
                            $this->session->set_flashdata('sucess', "Country have been updated sucessfully");
                			redirect('admin/regions');
                    }
            
           
           
            
		}
	     //*****************************  Validation **************************************    
         // add breadcrumbs
           // $this->breadcrumbs->push('Home', '/admin/dashboard');
           $this->breadcrumbs->push('<i class="fa fa-home fa-lg"></i>', '/admin/dashboard');
           $this->breadcrumbs->push('Country List', "/admin/regions" ); 
           $this->breadcrumbs->push('<a href="#ignore">Edit</a>', "/admin/regions/edit" );
           $breadcrumds=$this->breadcrumbs->show();
        
	        $datas['sitetitle']       = 'Country(s) ';
            $datas['page_title']       = 'Country(s) List';
			$datas['page_action'] = 'Country(s)';
      //   admin_lists
           $datas['id']       = $id;
       
           $datas['page_action']   = 'Edit';
           $datas['title'] = 'Country(s)';
    	   $datas['page_title']       = 'Country(s)';
           
          $datas['breadcrumds']       = $breadcrumds;
          $datas['images_error']= $images_error;
          
          
          $editdata=$this->region_model->GetRegionById($id);
         
          $flag_desc=json_decode($editdata[0]["flag_desc"]);
          $population=json_decode($editdata[0]["population"]);
          
          list($year,$month,$day)=explode("-",$editdata[0]["independenceday"]);
        
        if($this->input->post("name"))
         { $datas['name']= $this->input->post("name"); }
         elseif (!empty($editdata)) {
			$datas['name'] = $editdata[0]["region_name"];
		 } 
         else{ $datas['name']= ""; }
         /*for banner */
          if($this->input->post("banner"))
         { $datas['banner']= $this->input->post("banner"); }
         elseif (!empty($editdata)) {
			$datas['banner'] = $editdata[0]["region_titlebanner"];
		 } 
         else{ $datas['banner']= ""; }
         
         /* close ing for banner */
         if($this->input->post("twittershortdesc"))
         { $datas['twittershortdesc']= $this->input->post("twittershortdesc"); }
         elseif (!empty($editdata)) {
			$datas['twittershortdesc'] = $editdata[0]["twittershortdesc"];
		 } 
         else{ $datas['twittershortdesc']= ""; }
         
         
         
          if($this->input->post("title"))
         { $datas['title']= $this->input->post("title"); }
         elseif (!empty($editdata)) {
			$datas['title'] = $editdata[0]["region_title"];
		 } 
         else{ $datas['title']= ""; }
         
         if($this->input->post("motto"))
         { $datas['motto']= $this->input->post("motto"); }
         elseif (!empty($editdata)) {
		  $datas['motto']       = $flag_desc->motto;
		 }
         else{ $datas['motto']= ""; }
         
          if($this->input->post("anthem"))
         { $datas['anthem']= $this->input->post("anthem"); }
         elseif (!empty($editdata)) {
		  $datas['anthem']       = $flag_desc->anthem;
		 }
         else{ $datas['anthem']= ""; }
         
           if($this->input->post("national_dish"))
         { $datas['national_dish']= $this->input->post("national_dish"); }
         elseif (!empty($editdata)) {
		  $datas['national_dish']       = $flag_desc->national_dish;
		 }
         else{ $datas['national_dish']= ""; }
         
         
          if($this->input->post("capital"))
         { $datas['capital']= $this->input->post("capital"); }
         elseif (!empty($editdata) && !empty($population)) {
		   $datas['capital']       =  $population->capital;
		 }
         else{ $datas['capital']= ""; }
         
          if($this->input->post("language"))
         { $datas['language']= $this->input->post("language"); }
         elseif (!empty($editdata) && !empty($population) ) {
		     $datas['language']       = $population->language;
		 }
         else{ $datas['language']= ""; }
         
         if($this->input->post("population"))
         { $datas['population']= $this->input->post("population"); }
         elseif (!empty($editdata) && !empty($population) ) {
		      $datas['population']       =  $population->population;
		 }
         else{ $datas['population']= ""; }
         
         if($this->input->post("shortdesc"))
         { $datas['shortdesc']= $this->input->post("shortdesc"); }
         elseif (!empty($editdata) && !empty($population) ) {
		      $datas['shortdesc']       =  $population->flag_shortdesc;
		 }
         else{ $datas['shortdesc']= ""; }
         
         
         
          if($this->input->post("year"))
         { $datas['year']= $this->input->post("year"); }
         elseif (!empty($editdata)) {
		      $datas['year']       =  $year;
		 }
         else{ $datas['year']= ""; }
         
         if($this->input->post("month"))
         { $datas['month']= $this->input->post("month"); }
         elseif (!empty($editdata)) {
		      $datas['month']       =  $month;
		 }
         else{ $datas['month']= ""; }
         
         if($this->input->post("day"))
         { $datas['day']= $this->input->post("day"); }
         elseif (!empty($editdata)) {
		      $datas['day']       =  $day;
		 }
         else{ $datas['day']= ""; }
         
         if($this->input->post("content"))
         { $datas['content']= $this->input->post("content"); }
         elseif (!empty($editdata)) {
		      $datas['content']       =  $editdata[0]["description"];
		 }
         else{ $datas['content']= ""; }
         
            if($this->input->post("longitude"))
         { $datas['longitude']= $this->input->post("longitude"); }
         elseif (!empty($editdata)) {
		      $datas['longitude']       =  $editdata[0]["longitude"];
		 }
         else{ $datas['longitude']= ""; }
         
           if($this->input->post("status"))
         { $datas['status']= $this->input->post("status"); }
         elseif (!empty($editdata)) {
		      $datas['status']       =  $editdata[0]["status"];
		 }
         else{ $datas['status']= "1"; }
         
         
         
           if($this->input->post("latitude"))
         { $datas['latitude']= $this->input->post("latitude"); }
         elseif (!empty($editdata)) {
		      $datas['latitude']       =  $editdata[0]["latitude"];
		 }
         else{ $datas['latitude']= ""; }
         
         if (!empty($editdata)) {
		      $datas['coverimage']       =  $editdata[0]["cover_image"];
		 }
         else{ $datas['coverimage']= ""; }
         
         if (!empty($editdata)) {
		      $datas['flag']       =  $editdata[0]["flag"];
		 }
         else{ $datas['flag']= ""; }
         
          if (!empty($editdata)) {
		      $datas['image']       =  $editdata[0]["image"];
		 }
         else{ $datas['image']= ""; }
         
         if (!empty($editdata)) {
            $datas['ragion_map'] = $editdata[0]["ragion_map"];
		   }
            else{ $datas['ragion_map']= ""; }
         
      
       	 $datas['results']     = array();
		 $this->openView($datas,'add');
        }else
          {
             $this->session->set_flashdata('rightmsg', 'You have not write right to access');
			 	redirect('admin/dashboard');
          }   
    }
    
     
     
     public function name_check($str)
	{
		if ($this->region_model->check_name($str) > 0)
		{
			$this->form_validation->set_message('name_check', 'The country name ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    public function editname_check($str)
	{
		if ($this->region_model->editcheck_name($this->input->post("id"),$str) > 0)
		{
			$this->form_validation->set_message('editname_check', 'The country name ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

   public function title_check($str)
	{
		if ($this->region_model->check_title($str) > 0)
		{
			$this->form_validation->set_message('title_check', 'The country title ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    public function edittitle_check($str)
	{
		if ($this->region_model->editcheck_title($this->input->post("id"),$str) > 0)
		{
			$this->form_validation->set_message('editname_check', 'The country title ('.$str.') already exists.');
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
		$this->load->view('admin/region/'.$viewName,$xdata);
		$this->load->view('admin/footer');
	}
    
    public function deleteimage()
    {
      
        
       $strflag=$this->input->post("strflag"); 
       $strgetid=$this->input->post("strgetid"); 
       $editdata=$this->region_model->GetRegionById($strgetid);
       
       $success="Y";
       
       switch($strflag)   
       {
         case "raggionmapimg":
         $getimagename=$editdata[0]["ragion_map"];
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
              $this->region_model->updateimage($strgetid,"ragion_map");
            }else
            {
             $success="N";         
            }                    
                                
         break;
          case "raggionflagimg":
              $getimagename=$editdata[0]["flag"];
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
              $this->region_model->updateimage($strgetid,"flag");
            }else
            {
             $success="N";         
            }   
         break;
          case "raggionimageimg":
            $getimagename=$editdata[0]["image"];
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
              $this->region_model->updateimage($strgetid,"image");
              
            }else
            {
             $success="N";         
            }   
         break;
          case "raggioncoverimg":
             $getimagename=$editdata[0]["cover_image"];
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
             $this->region_model->updateimage($strgetid,"cover_image");
              
            }else
            {
             $success="N";         
            }   
         break;
        
       }
        echo $success;
    }
}
?>