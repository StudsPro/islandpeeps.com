<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Masterlist extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;

    function __construct()
        {
            parent::__construct();
            if(!$this->session->userdata('logged_in')){redirect('/');}
            $this->load->model("masterlist_model");
            
            $this->load->helper("file");
            $this->load->library('upload');
            $this->load->library('form_validation');
            $this->load->helper('general_helper');
            $this->load->library('image_lib');
            $this->load->library('pagination');
            $this->load->library('breadcrumbs');
        }
  function profiledetail($id=0)
    {      
           $datas['sitetitle']       = 'Modify/Listing masterlist >Add ';
           $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Profile ', "/admin/masterlist" ); 
           $this->breadcrumbs->push('<a href="#ignore">Edit</a>', "/admin/masterlist/edit" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
           $datas['id']       = $id;
       
           $datas['page_action']   = 'Profile Details';
           $datas['title'] = 'Modify/Listing Profile Detail';
            $data['sitetitle']       = 'Modify/Listing Profile > Detail';
    	   $datas['page_title']       = 'Modify/Listing Profile List';
           
          $datas['breadcrumds']       = $breadcrumds;
          
           $editdata=$this->masterlist_model->GetpeopleprofileById($id);
         
           $regions_arr= $this->masterlist_model->GetAllRegion();
            $datas['regions_arr']=$regions_arr;
             $Categorys_arr= $this->masterlist_model->GetAllCategory();
           $datas['categorys_arr']=$Categorys_arr; 
          $datas['result']=$editdata[0];
          
          
        $this->openView($datas,'detail');
    } 
   function index($getid="")
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
                       $this->masterlist_model->deleterecords($selected);
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been deleted successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                 redirect('admin/masterlist');  
           }     
            
             if($this->input->post("btn_avaible"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->masterlist_model->changeselectstatus($selected,'1');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been status(AVAILABLE) changed successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                 redirect('admin/masterlist');  
           }  
            
             if($this->input->post("btn_pending"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->masterlist_model->changeselectstatus($selected,'2');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been status(PENDING) changed successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                 redirect('admin/masterlist');  
           }  
           
            if($this->input->post("btn_ready"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->masterlist_model->changeselectstatus($selected,'3');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been status(READY) changed successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                 redirect('admin/masterlist');  
           }  
           
            if($this->input->post("btn_publish"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->masterlist_model->changeselectstatus($selected,'4');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been status(PUBLISH) changed successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                 redirect('admin/masterlist');  
           }  
        //***********************************************************
         $filter["fillter"]="";
         if($getid)
         {
            if($getid <>"title")
            {
             $filter["fillter"]= $getid;
             $data['fillter'] =$getid;
            } 
            else
            {
               $data['fillter'] =$getid;  
            }
         }else
         {
             $data['fillter'] ="";
         }
        
         // $data['results'] = $this->masterlist_model->GetAllrecords($serachdata,$limit,$start);
           $regions_arr= $this->masterlist_model->GetAllRegion();
           $data['regions_arr']=$regions_arr;
            $kinds_arr= $this->masterlist_model->Getkinds($filter);
           $data['kinds_arr']=$kinds_arr;
          $data['results'] = $this->masterlist_model->GetAllrecords($filter); 
		  $this->openView($data,'index');
	   }
   
    function downloadpdf($getid="")
    {
      require('fpdf/pdf.php');
      
       $filter["fillter"]="";
         if($getid)
         {
             $filter["fillter"]= $getid;
             $data['fillter'] =$getid;
         }else
         {
             $data['fillter'] ="";
             $filter["fillter"]="";
         }
      
     
         $pdf = new PDF();
           $pdf->mytitle('Master list');
      $results = $this->masterlist_model->GetAllrecords($filter); 
       $regions_arr= $this->masterlist_model->GetAllRegion();
	// Column headings
	$header = array('S.No', 'Profile Title', 'Date of Birth','Profession','User Kind', 'Region','Affiliate','Status');
	// Data loading
	$data = array();
	     $i=1;
	     $stas = array('1'=>'AVAILABLE','2'=>'PENDING','3' => 'READY','4'=> 'USED');
       
	   foreach($results as $key => $objRow)
        {
           
             $regions_arr;
                                              $strregion="";
                                              $tmpcounter=1;
                                             if(!empty($objRow['region_id']))
                                             {
                                                $tmp_arr=explode(",",$objRow['region_id']);
                                                $tmpcount=count($tmp_arr);
                                                if(!empty($tmp_arr))
                                                {
                                                   foreach($tmp_arr as $key => $value)
                                                   {  
                                                    if($tmpcounter < $tmpcount)
                                                    {
                                                        $str=",";
                                                    }else
                                                    {
                                                        $str=" ";
                                                    }
                                                     $strregion.=$regions_arr[$value].$str;
                                                     $tmpcounter++;
                                                    }  
                                                 } 
                                             }
                                             
          
            if(!empty($objRow["status"]))
            { $status=$objRow["status"];}
            else{ $status=""; } 
            
            if(!empty($objRow["title"]))
            { $title=$objRow["title"];}
            else{ $title="-"; }  
            
           if(!empty($objRow["kind"]))
            { $kind=$objRow["kind"];}
            else{ $kind="-"; }  
            
            if(!empty($objRow["username"]))
            { $username=stripslashes($objRow["username"]);}
            else{ $username="-"; } 
            
             if(!empty($objRow["dob"]))
            { $dob=$objRow["dob"];}
            else{ $dob="-"; } 
            
            if(!empty($objRow["category"]))
            { $category_s=$objRow["category"];}
            else{ $category_s="-"; } 
            
            $stasget=$stas[$status]? $stas[$status] : "";
            
		$data[] =  array($i,$title,$dob,$category_s,$kind,$strregion,$username,$stasget);
		$i++;
	     }
	 
  
     
	$pdf->SetFont('Arial','',10);
	$pdf->AddPage();

   //echo '<pre>';print_r($data);exit;
	$pdf->FancyTable($header,$data);
       ob_end_clean();
	// $pdf->Output();
	$pdf->Output('masterlist'.time().'.pdf', 'D');
   
    
   
     /*    
     $stas = array('1'=>'AVAILABLE','2'=>'PENDING','3' => 'READY','4'=> 'USED');
    	$header = array('S.No', 'Profile Title', 'User Kind', 'Region','Affiliate','Status');
	// Data loading
        $data[] =  array(1,"Title","Kind","Region,data","username",$stas[1]);
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);
        $pdf->FancyTable($header,$data);
        ob_end_clean();
        $pdf->Output('masterlist'.time().'.pdf', 'D');
            
            exit;   
        */
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
       if(affilateright("masterlist","write")==true)
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
             
           $masterlistid=$this->masterlist_model->getmaxid("id","tbl_profiles");
          
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
                      //  $uploadConst['min_width'] = '1200';
                      //   $uploadConst['min_height'] = '900';
						$uploadConst['file_name']     = 'peopleprofile-'.$masterlistid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload('image'))
							{
						      	$remap_error= $this->upload->display_errors(); 
                                $images_error["masterlist_error"]=$remap_error;
                             }
						 else
							{   
							   $config=array();
                               $image_data=array();
                               $image_data = $this->upload->data();
                              
                               $region_image_img_name= $image_data["orig_name"];
                               $region_ext_img_name= $image_data["file_ext"];
                               
                               $gettmp_tumbs_arr[$masterlistid]=$image_data['full_path'];
                               
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
                                                    'file_name'     => 'peopleprofile-'.$key.'.jpg', 
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
                    }else
                    {
                      $region_image_img_name="";  
                    }
            //******************************************************************** 
           
            
                    if(empty($images_error))
                    { 
                            $data["peopleprofile_image"]= $region_image_img_name;
                            $data["masterlist_imageext"]= $region_ext_img_name;
                            
                              
                            $this->masterlist_model->insert($data);
                            $this->session->set_flashdata('sucess', "Master list have been inserted sucessfully");
                			redirect('admin/masterlist');
                    }
            
		}
	     //*****************************  Validation **************************************    
         // add breadcrumbs
              $datas['sitetitle']       = 'Modify/Listing Profile >Add ';
            $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Profile ', "/admin/masterlist" ); 
           $this->breadcrumbs->push('<a href="#ignore">Add</a>', "/admin/masterlist/create" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
           $datas['id']       = 0;
           $datas['name']       = '';
           $datas['page_action']   = 'Add';
            $data['sitetitle']       = 'Modify/Listing masterlist > Add';
           $datas['title'] = '';
    	   $datas['page_title']       = 'Modify/Listing Profile ';
           
           $datas['breadcrumds']       = $breadcrumds;
		   $datas['results']     = array();
        
           $datas['images_error']= $images_error;
          
           
           $regions_arr= $this->masterlist_model->GetAllRegion();
           $datas['regions_arr']=$regions_arr;
            
           $Categorys_arr= $this->masterlist_model->GetAllCategory();
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
    
    function bulkprofile($id=0)
    {
      
      //*******************************  Validation  ********************
       $images_error=array();
       $region_image_img_name="";
       $region_ext_img_name="";
	$config = array(
               
                array(
                     'field'   => 'md_title[]',
                     'label'   => "Name",
                     'rules'   => 'required'
                  )
               
            );

        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		 
           
          
            
            //******************************************************************** 
                     $this->masterlist_model->bulkprofileinsert($this->input->post());
                            $this->session->set_flashdata('sucess', "Bulk profiles have been inserted sucessfully");
                			redirect('admin/masterlist');
             
		}
	     //*****************************  Validation **************************************    
         // add breadcrumbs
              $datas['sitetitle']       = 'Modify/Listing Profile >Bulk Profile ';
            $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Profile ', "/admin/masterlist" ); 
           $this->breadcrumbs->push('<a href="#ignore">Bulk Profile Add</a>', "/admin/masterlist/create" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
           $datas['id']       = 0;
           $datas['name']       = '';
           $datas['page_action']   = 'Add';
            $data['sitetitle']       = 'Modify/Listing masterlist > Bulk Profile Add';
           $datas['title'] = '';
    	   $datas['page_title']       = 'Modify/Listing Profile ';
           
           $datas['breadcrumds']       = $breadcrumds;
		   $datas['results']     = array();
        
           $datas['images_error']= $images_error;
          
           
           $regions_arr= $this->masterlist_model->GetAllRegion();
           $datas['regions_arr']=$regions_arr;
            
           $Categorys_arr= $this->masterlist_model->GetAllCategory();
           $datas['categorys_arr']=$Categorys_arr; 
            if($this->input->post("regions")){ $datas['regions']= $this->input->post("regions"); }else{ $datas['regions']= ""; }
          
         $this->openView($datas,'bulkprofile');
    }
    function addcategory($id=0)
    {
      
      //*******************************  Validation  ********************
       $images_error=array();
       $region_image_img_name="";
       $region_ext_img_name="";
	$config = array(
               
                array(
                     'field'   => 'category[]',
                     'label'   => "Category",
                     'rules'   => 'required'
                  )
               
            );

        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		  
		    //******************************************************************** 
                            $this->masterlist_model->categoryinsert($this->input->post());
                            $this->session->set_flashdata('sucess', "Category have been updated sucessfully");
                			redirect('admin/masterlist');
             
		}
	     //*****************************  Validation **************************************    
         // add breadcrumbs
              $datas['sitetitle']       = 'Modify/Listing Profile >Bulk Profile ';
            $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Profile ', "/admin/masterlist" ); 
           $this->breadcrumbs->push('<a href="#ignore">Add Category</a>', "/admin/masterlist/create" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
           $datas['id']       = 0;
           $datas['name']       = '';
           $datas['page_action']   = 'Add Category';
            $data['sitetitle']       = 'Modify/Listing masterlist > Add Category';
           $datas['title'] = '';
    	   $datas['page_title']       = 'Modify/Listing Profile ';
           
           $datas['breadcrumds']       = $breadcrumds;
		   $datas['results']     = array();
          $datas['maxid']= $this->masterlist_model->getmaxid("id","tbl_category");
           $datas['images_error']= $images_error;
         $Categorys_arr= $this->masterlist_model->GetAllCategoryids();
           $datas['categorys_arr']=$Categorys_arr; 
          
         $this->openView($datas,'addcategory');
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
 if(affilateright("masterlist","write")==true)
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
            
            
             $data["id"]=$this->input->post("id");
                $masterlistid=$this->input->post("id");
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
                        // $uploadConst['min_width'] = '1200';
                        // $uploadConst['min_height'] = '900';
                         $uploadConst['overwrite'] = TRUE;
						$uploadConst['file_name']     = 'peopleprofile-'.$masterlistid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload('image'))
							{
						      	$remap_error= $this->upload->display_errors(); 
                                $images_error["masterlist_error"]=$remap_error;
                             }
						 else
							{   
							   $config=array();
                               $image_data=array();
                               $image_data = $this->upload->data();
                              
                               $region_image_img_name= $image_data["orig_name"];
                                $region_ext_img_name= $image_data["file_ext"];
                                
                                 $gettmp_tumbs_arr[$masterlistid]=$image_data['full_path'];
                               
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
            if(empty($images_error))
                    { 
                          
                            $data["peopleprofile_image"]= $region_image_img_name;  
                            $this->masterlist_model->update($data);
                            $this->session->set_flashdata('sucess', "Master list have been updated sucessfully");
                			redirect('admin/masterlist');
                    }
            
           
           
            
		}
	     //*****************************  Validation **************************************    
         // add breadcrumbs
            //$this->breadcrumbs->push('Home', '/admin/dashboard');
           $datas['sitetitle']       = 'Modify/Listing masterlist >Add ';
           $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Profile ', "/admin/masterlist" ); 
           $this->breadcrumbs->push('<a href="#ignore">Edit</a>', "/admin/masterlist/edit" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
           $datas['id']       = $id;
       
           $datas['page_action']   = 'Edit';
           $datas['title'] = 'Modify/Listing masterlist';
            $data['sitetitle']       = 'Modify/Listing masterlist > Edit';
    	   $datas['page_title']       = 'Modify/Listing masterlist';
           
          $datas['breadcrumds']       = $breadcrumds;
          $datas['images_error']= $images_error;
          
          
          $editdata=$this->masterlist_model->GetpeopleprofileById($id);
           $regions_arr= $this->masterlist_model->GetAllRegion();
            $datas['regions_arr']=$regions_arr;
             $Categorys_arr= $this->masterlist_model->GetAllCategory();
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
		if ($this->masterlist_model->check_name($str) > 0)
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
		if ($this->masterlist_model->editcheck_name($this->input->post("id"),$str) > 0)
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
		if ($this->masterlist_model->check_title($str) > 0)
		{
			$this->form_validation->set_message('title_check', 'The masterlist title ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    public function edittitle_check($str)
	{
		if ($this->masterlist_model->editcheck_title($this->input->post("id"),$str) > 0)
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
		$this->load->view('admin/masterlist/'.$viewName,$xdata);
		$this->load->view('admin/footer');
	}
    
    public function deleteimage()
    {
       $strgetid=$this->input->post("strgetid"); 
       $editdata=$this->masterlist_model->GetpeopleprofileById($strgetid);
       
       $success="Y";

            $getimagename=$editdata[0]["image"];
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
              $this->masterlist_model->updateimage($strgetid,"image");
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
        
         $this->masterlist_model->changestatus($strgetid,$strstatus); 
          $this->session->set_flashdata('sucess', "Send to Admin Confirmation sucessfully");
       echo "Y";  
    }
    public function setbackgroundimage()
    {
          $editid=$this->input->post("editid");
          $this->masterlist_model->setbackgroundimage($editid); 
    } 
    
    
}
?>