<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

 class profile extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;
   
    function __construct()
   {				
	  parent::__construct();
      
       $this->load->helper("file");
            $this->load->library('upload');
            $this->load->library('form_validation');
            $this->load->helper('general_helper');
            $this->load->library('image_lib');
            $this->load->library('pagination');
            $this->load->library('breadcrumbs');
	  $this->load->model('users');
   }

   function index($page = 'login')
   {  
   	
   }
   
         
         public function editname_check($str)
	{
		if ($this->users->editcheck_name($this->input->post("id"),$str) > 0)
		{
			$this->form_validation->set_message('editname_check', 'The profile name ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
     public function email_check($str)
	{
		if ($this->users->check_email($str) > 0)
		{
			$this->form_validation->set_message('email_check', 'The profile email ('.$str.') already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    
    public function oldpass_check($str)
	{
		if ($this->users->checkpassword($this->input->post("id"),$str) == 0)
		{
			$this->form_validation->set_message('oldpass_check', 'The profile old password ('.$str.') not exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    
     function sitesettings()
    {
       $images_error=array();
       $region_map_img_name="";
       $region_flag_img_name="";
       $region_image_img_name="";
       $region_coverimage_img_name="";
        
        	$config = array(
                array(
                     'field'   => 'sitename',
                     'label'   => "Site Name ",
                     'rules'   => 'required|trim'
                  ),
              array(
                     'field'   => 'adminemail',
                     'label'   => "Admin Email",
                     'rules'   => 'required|trim'
                  )
                 ,
              array(
                     'field'   => 'suggestionbox_email',
                     'label'   => "Suggestion box email",
                     'rules'   => 'required|trim'
                  )
               
            );

        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		   
          // print_r($_FILES);
            $data["sitename"]=$this->input->post("sitename");
           $data["adminemail"]=$this->input->post("adminemail");
           $data["suggestionbox_email"]=$this->input->post("suggestionbox_email");
           $data["metatitle"]=$this->input->post("metatitle");
           $data["metatag"]=$this->input->post("metatag");
          
            $data["metadescription"]=$this->input->post("metadescription");
            $data["dnotification"]=$this->input->post("dnotification");
            $data["cnotification"]=$this->input->post("cnotification");
              
            $data["mnotification"]=$this->input->post("mnotification");
            $data["helpcontent"]=addslashes($this->input->post("helpcontent"));
            
                $masterlistid=$this->input->post("id");
              
                
              //*******************************************************************
               
                  if(!empty($_FILES["image"]['name']))
					{
				        $gettmp_tumbs_arr=array();
                        $imagecounter=1; 
					    $ext = explode(".",$_FILES["image"]['name']);
						$ext = strtolower($ext[1]);
						$uploadConst['upload_path']   = SITE_UPLOADPATH;
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp';
                        //$uploadConst['max_size'] = REGION_MAP;
                        // $uploadConst['max_width'] = '1200';
                        // $uploadConst['max_height'] = '900';
                        // $uploadConst['min_width'] = '1200';
                        // $uploadConst['min_height'] = '900';
                         $uploadConst['overwrite'] = TRUE;
						$uploadConst['file_name']     = 'sitesttings-'.$masterlistid.".".$ext; 
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
                            }
                    }
            //******************************************************************** 
            if(empty($images_error))
                    { 
                          
                            $data["adminprofile_image"]= $region_image_img_name;  
                          
                            $this->users->sitesettingsupdate($data,$masterlistid);
                            $this->session->set_flashdata('sucess', "Settings have been updated sucessfully");
                			redirect('admin/profile/sitesettings');
                    }
         }
	     //*****************************  Validation **************************************    
         // add breadcrumbs
            //$this->breadcrumbs->push('Home', '/admin/dashboard');
           $datas['sitetitle']       = 'Modify/Listing Profile >Settings ';
           $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Profile ', "/admin/affiliate" ); 
           $this->breadcrumbs->push('<a href="#ignore">Edit Settings</a>', "/admin/affiliate/edit" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
         
       
           $datas['page_action']   = 'Edit';
           $datas['title'] = 'Modify/Listing Profile';
            $data['sitetitle']       = 'Modify/Listing Profile > Settings';
    	   $datas['page_title']       = 'Modify/Listing Profile';
           
          $datas['breadcrumds']       = $breadcrumds;
         
          
          
          $id=1; 
          $editdata=$this->users->getsettingsDetail($id);
           $datas['id']       = $id;
           
         //  echo "<pre>";
          // print_r($editdata);
          // exit;
         if($this->input->post("sitename")){ $datas['sitename']= $this->input->post("sitename"); }
         elseif (!empty($editdata)) {$datas['sitename']       =  $editdata["sitename"];}
         else{ $datas['sitename']= ""; }
         
          if($this->input->post("sitelogo")){ $datas['sitelogo']= $this->input->post("sitelogo"); }
           elseif (!empty($editdata)) {$datas['sitelogo']       =  $editdata["sitelogo"];}
          else{ $datas['sitelogo']= ""; }
          
         if($this->input->post("adminemail")){ $datas['adminemail']= $this->input->post("adminemail"); }
          elseif (!empty($editdata)) {$datas['adminemail']       =  $editdata["adminemail"];
          }
         else{ $datas['adminemail']= ""; }
         
         if($this->input->post("suggestionbox_email")){ $datas['suggestionbox_email']= $this->input->post("suggestionbox_email"); }
          elseif (!empty($editdata)) {$datas['suggestionbox_email']       =  $editdata["suggestionbox_email"];}
         else{ $datas['suggestionbox_email']= ""; }
         
         if($this->input->post("metatitle")){ $datas['metatitle']= $this->input->post("metatitle"); }
          elseif (!empty($editdata)) {$datas['metatitle']       =  $editdata["metatitle"]; }
         else{ $datas['metatitle']= ""; }
         
         if($this->input->post("metatag")){ $datas['metatag']= $this->input->post("metatag"); }
          elseif (!empty($editdata)) {$datas['metatag']       = $editdata["metatag"]; //$editdata[0]["spassword"];
          }
         else{ $datas['metatag']= ""; }
        
           if($this->input->post("metadescription")){ $datas['metadescription']= $this->input->post("metadescription"); }
          elseif (!empty($editdata)) {$datas['metadescription']       =  $editdata["metadescription"];}
         else{ $datas['metadescription']= ""; }
         
           if($this->input->post("helpcontent")){ $datas['helpcontent']= $this->input->post("helpcontent"); }
          elseif (!empty($editdata)) {$datas['helpcontent']       =  stripslashes($editdata["helpcontent"]);}
         else{ $datas['helpcontent']= ""; }
         
          if($this->input->post("dnotification")){ $datas['dnotification']= $this->input->post("dnotification"); }
          elseif (!empty($editdata)) {$datas['dnotification']       =  $editdata["dnotification"];}
         else{ $datas['dnotification']= ""; }
         
          if($this->input->post("cnotification")){ $datas['cnotification']= $this->input->post("cnotification"); }
          elseif (!empty($editdata)) {$datas['cnotification']       =  $editdata["cnotification"];}
         else{ $datas['cnotification']= ""; }
         
           if($this->input->post("mnotification")){ $datas['mnotification']= $this->input->post("mnotification"); }
          elseif (!empty($editdata)) {$datas['mnotification']       =  $editdata["mnotification"];}
         else{ $datas['mnotification']= ""; }
      
         
       	 $datas['results']     = array();
		 $this->openView($datas,'settings');
    
    }
    
     function sitehelp()
    {
            //$this->breadcrumbs->push('Home', '/admin/dashboard');
           $datas['sitetitle']       = 'Modify/Listing Profile >Settings ';
           $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Profile ', "/admin/affiliate" ); 
           $this->breadcrumbs->push('<a href="#ignore">Edit Settings</a>', "/admin/affiliate/edit" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
         
       
           $datas['page_action']   = 'Edit';
           $datas['title'] = 'Modify/Listing Profile';
            $data['sitetitle']       = 'Modify/Listing Profile > Settings';
    	   $datas['page_title']       = 'Modify/Listing Profile';
           
          $datas['breadcrumds']       = $breadcrumds;
         
          
          
          $id=1; 
          $editdata=$this->users->getsettingsDetail($id);
         $datas['id']       = $id;
         
         
           if($this->input->post("helpcontent")){ $datas['helpcontent']= $this->input->post("helpcontent"); }
           elseif (!empty($editdata)) {$datas['helpcontent']       =  stripslashes($editdata["helpcontent"]);}
          else{ $datas['helpcontent']= ""; }
         
      
         
       	 $datas['results']     = array();
		 $this->openView($datas,'sitehelp');
    
    }
    
    
    
    function myprofile()
    {
       $images_error=array();
       $region_map_img_name="";
       $region_flag_img_name="";
       $region_image_img_name="";
       $region_coverimage_img_name="";
        
        	$config = array(
                array(
                     'field'   => 'username',
                     'label'   => "Username ",
                     'rules'   => 'required|callback_editname_check'
                  ),
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

        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		   
          // print_r($_FILES);
            $data["username"]=$this->input->post("username");
           $data["userpass"]=$this->input->post("userpass");
           $data["email"]=$this->input->post("email");
           $data["siteemail"]=$this->input->post("siteemail");
           $data["siteemailpass"]=$this->input->post("siteemailpass");
          
            $data["month"]=$this->input->post("month");
            $data["day"]=$this->input->post("day");
            $data["year"]=$this->input->post("year");
              
            $data["facebook"]=$this->input->post("facebook");
            $data["twitter"]=$this->input->post("twitter");
            $data["instagram"]=$this->input->post("instagram");
            $data["tumblr"]=$this->input->post("tumblr");
            $data["flashmsg"]=$this->input->post("flashmsg");  
          
           $data["id"]=$this->input->post("id");
              
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
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp';
                        //$uploadConst['max_size'] = REGION_MAP;
                        // $uploadConst['max_width'] = '1200';
                        // $uploadConst['max_height'] = '900';
                        // $uploadConst['min_width'] = '1200';
                        // $uploadConst['min_height'] = '900';
                         $uploadConst['overwrite'] = TRUE;
						$uploadConst['file_name']     = 'adminprofile-'.$masterlistid.".".$ext; 
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
                            }
                    }
            //******************************************************************** 
            if(empty($images_error))
                    { 
                          
                            $data["adminprofile_image"]= $region_image_img_name;  
                          
                            $this->users->update($data);
                            $this->session->set_flashdata('sucess', "Profile have been updated sucessfully");
                			redirect('admin/profile/myprofile');
                    }
         }
	     //*****************************  Validation **************************************    
         // add breadcrumbs
            //$this->breadcrumbs->push('Home', '/admin/dashboard');
           $datas['sitetitle']       = 'Modify/Listing Profile >Add ';
           $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Profile ', "/admin/affiliate" ); 
           $this->breadcrumbs->push('<a href="#ignore">Edit</a>', "/admin/affiliate/edit" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
         
       
           $datas['page_action']   = 'Edit';
           $datas['title'] = 'Modify/Listing Profile';
            $data['sitetitle']       = 'Modify/Listing Profile > Edit';
    	   $datas['page_title']       = 'Modify/Listing Profile';
           
          $datas['breadcrumds']       = $breadcrumds;
         
          
          
          $id=$this->session->userdata('adminid'); 
         $editdata=$this->users->getAdminDetail($id);
           $datas['id']       = $id;
           
           
         if($this->input->post("type")){ $datas['type']= $this->input->post("type"); }
         elseif (!empty($editdata)) {$datas['type']       =  $editdata["superadmin"];}
         else{ $datas['type']= ""; }
         
          if($this->input->post("username")){ $datas['username']= $this->input->post("username"); }
           elseif (!empty($editdata)) {$datas['username']       =  $editdata["username"];}
          else{ $datas['username']= ""; }
          
         if($this->input->post("userpass")){ $datas['userpass']= $this->input->post("userpass"); }
          elseif (!empty($editdata)) {$datas['userpass']       =  "";//$editdata[0]["password"];
          }
         else{ $datas['userpass']= ""; }
         
         if($this->input->post("email")){ $datas['email']= $this->input->post("email"); }
          elseif (!empty($editdata)) {$datas['email']       =  $editdata["email"];}
         else{ $datas['email']= ""; }
         
         if($this->input->post("siteemail")){ $datas['siteemail']= $this->input->post("siteemail"); }
          elseif (!empty($editdata)) {$datas['siteemail']       =  explode(",",$editdata["semail"]);}
         else{ $datas['siteemail']= ""; }
         
         if($this->input->post("siteemailpass")){ $datas['siteemailpass']= $this->input->post("siteemailpass"); }
          elseif (!empty($editdata)) {$datas['siteemailpass']       = explode("-|-",$editdata["spassword"]);; //$editdata[0]["spassword"];
          }
         else{ $datas['siteemailpass']= ""; }
        
           if($this->input->post("image")){ $datas['image']= $this->input->post("image"); }
          elseif (!empty($editdata)) {$datas['image']       =  $editdata["image"];}
         else{ $datas['image']= ""; }
         
           if($this->input->post("flashmsg")){ $datas['flashmsg']= $this->input->post("flashmsg"); }
          elseif (!empty($editdata)) {$datas['flashmsg']       =  $editdata["flashmsg"];}
         else{ $datas['flashmsg']= ""; }
         
          if($this->input->post("tumblr")){ $datas['tumblr']= $this->input->post("tumblr"); }
          elseif (!empty($editdata)) {$datas['tumblr']       =  $editdata["tumblr"];}
         else{ $datas['tumblr']= ""; }
         
          if($this->input->post("instagram")){ $datas['instagram']= $this->input->post("instagram"); }
          elseif (!empty($editdata)) {$datas['instagram']       =  $editdata["instagram"];}
         else{ $datas['instagram']= ""; }
         
           if($this->input->post("twitter")){ $datas['twitter']= $this->input->post("twitter"); }
          elseif (!empty($editdata)) {$datas['twitter']       =  $editdata["twitter"];}
         else{ $datas['twitter']= ""; }
         
          if($this->input->post("facebook")){ $datas['facebook']= $this->input->post("facebook"); }
          elseif (!empty($editdata)) {$datas['facebook']       =  $editdata["facebook"];}
         else{ $datas['facebook']= ""; }
               
         
         
         
          list($year,$month,$day)=explode("-",$editdata["dob"]);
           
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
         
         
         
       	 $datas['results']     = array();
		 $this->openView($datas,'add');
    
    }    
    
    function socialfeeds()
    {
      
		if (!empty($_POST))
		{
		   
          // print_r($_FILES);
           
            $data['limits'] =  $_POST['db_limits'];
            $data['days'] =  $_POST['db_days'];
            $data['fmax'] =  $_POST['db_fmax'];
            $data['speed'] =  $_POST['db_speed'];
            $data['forder'] =  $_POST['db_forder'];
            $data['filter'] =  $_POST['db_filter'];
            $data['rotate_direction'] =  $_POST['db_rotate_direction'];
            $data['rotate_delay'] =  $_POST['db_rotate_delay'];
           
           
            $data['twitter'] =  json_encode($_POST['twitter']);
            $data['rss'] = json_encode($_POST['rss']);
            $data['facebook'] = json_encode($_POST['facebook']); 
            $data['google'] = json_encode($_POST['google']);
            $data['instagram'] = json_encode($_POST['instagram']);
            $data['delicious'] = json_encode($_POST['delicious']);
            $data['vimeo'] = json_encode($_POST['vimeo']);
            $data['youtube'] = json_encode($_POST['youtube']);
            $data['pinterest'] = json_encode($_POST['pinterest']);
            $data['flickr'] = json_encode($_POST['flickr']);
            $data['dribbble'] = json_encode($_POST['dribbble']);
            $data['tumblr'] = json_encode($_POST['tumblr']);
            $data['stumbleupon'] = json_encode($_POST['stumbleupon']);
            $data['lastfm'] = json_encode($_POST['lastfm']);
            $data['deviantart'] = json_encode($_POST['deviantart']);
           
           
           
           
          
                          
                $this->users->socialfeedupdate($data,$_POST['id']);
                $this->session->set_flashdata('sucess', "Social feeds have been updated sucessfully");
    			redirect('admin/profile/socialfeeds');
         
         }
	     //*****************************  Validation **************************************    
         // add breadcrumbs
            //$this->breadcrumbs->push('Home', '/admin/dashboard');
           $datas['sitetitle']       = 'Modify/Listing Profile >Social Feed ';
           $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Profile ', "/admin/affiliate" ); 
           $this->breadcrumbs->push('<a href="#ignore">Social Feed </a>', "/admin/affiliate/edit" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
         
       
           $datas['page_action']   = 'Social Feed ';
           $datas['title'] = 'Modify/Listing Profile';
            $data['sitetitle']       = 'Modify/Listing Profile > Social Feed ';
    	   $datas['page_title']       = 'Modify/Listing Profile';
           
          $datas['breadcrumds']       = $breadcrumds;
         
          
          
          $id=1; 
          $editdata=$this->users->getsocialfeedsDetail($id);
          $datas['id']       = $id;
          
            $datas['twitter']       = $editdata["twitter"];
            $datas['rss']       = $editdata["rss"];
            $datas['stumbleupon']       = $editdata["stumbleupon"];
            $datas['facebook']       = $editdata["facebook"];
            $datas['google']       = $editdata["google"];
            $datas['instagram']       = $editdata["instagram"];
            $datas['delicious']       = $editdata["delicious"];
            $datas['vimeo']       = $editdata["vimeo"];
            $datas['youtube']       = $editdata["youtube"];
            $datas['pinterest']       = $editdata["pinterest"];
            $datas['flickr']       = $editdata["flickr"];
            $datas['lastfm']       = $editdata["lastfm"];
            $datas['dribbble']       = $editdata["dribbble"];
            $datas['deviantart']       = $editdata["deviantart"];
            $datas['tumblr']       = $editdata["tumblr"];
            $datas['limits']       = $editdata["limits"];
            $datas['days']       = $editdata["days"];
            $datas['fmax']       = $editdata["fmax"];
            $datas['speed']       = $editdata["speed"];
            $datas['forder']       = $editdata["forder"];
            $datas['filter']       = $editdata["filter"];
            $datas['rotate_direction']       = $editdata["rotate_direction"];
            $datas['rotate_delay']       = $editdata["rotate_delay"];
            
           
           
         $datas['results']     = array();
		 $this->openView($datas,'socialfeeds');
    
    }
    
    
     function changepassword()
    {
       $images_error=array();
       $region_map_img_name="";
       $region_flag_img_name="";
       $region_image_img_name="";
       $region_coverimage_img_name="";
        
        	$config = array(
                array(
                     'field'   => 'olduserpass',
                     'label'   => "Old Password ",
                     'rules'   => 'required|trim|callback_oldpass_check'
                  ),
              array(
                     'field'   => 'newuserpass',
                     'label'   => "New Password",
                     'rules'   => 'required|trim'
                  )
                  ,
               array(
                     'field'   => 'confirmuserpass',
                     'label'   => "Confirm Password",
                     'rules'   => 'required|trim'
                  )
                 
               
            );

        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
		   
          // print_r($_FILES);
          
         
            $data["userpass"]=$this->input->post("confirmuserpass");
            $data["id"]=$this->input->post("id");
             $masterlistid=$this->input->post("id");
                          
                $this->users->passwordupdate($data);
                $this->session->set_flashdata('sucess', "Password have been updated sucessfully");
    			redirect('admin/profile/myprofile');
         
         }
	     //*****************************  Validation **************************************    
         // add breadcrumbs
            //$this->breadcrumbs->push('Home', '/admin/dashboard');
           $datas['sitetitle']       = 'Modify/Listing Profile >Password ';
           $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('Modify/Listing Profile ', "/admin/affiliate" ); 
           $this->breadcrumbs->push('<a href="#ignore">Edit Password</a>', "/admin/affiliate/edit" );
           $breadcrumds=$this->breadcrumbs->show();
        
	    
      //   admin_lists
         
       
           $datas['page_action']   = 'Edit Password';
           $datas['title'] = 'Modify/Listing Profile';
            $data['sitetitle']       = 'Modify/Listing Profile > Chnage Password';
    	   $datas['page_title']       = 'Modify/Listing Profile';
           
          $datas['breadcrumds']       = $breadcrumds;
         
          
          
          $id=$this->session->userdata('adminid'); 
          $editdata=$this->users->getAdminDetail($id);
           $datas['id']       = $id;
         $datas['results']     = array();
		 $this->openView($datas,'chnagepass');
    
    }  
    
    
    private function openView($xdata,$viewName)
	{
	
		$this->load->view('admin/header', $xdata);
		$this->load->view('admin/profile/'.$viewName,$xdata);
		$this->load->view('admin/footer');
	}
    
      public function deleteimage()
    {
       $strgetid=$this->input->post("strgetid"); 
       $editdata=$this->users->getAdminDetail($strgetid);
       
       $success="Y";

            $getimagename=$editdata["image"];
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
              $this->users->updateimage($strgetid,"image");
            }else
            {
             $success="N";         
            }                    
        
        
         echo $success;
    }
    public function deletesitelogoimage()
    {
       $strgetid=$this->input->post("strgetid"); 
       $editdata=$this->users->getsettingsDetail($strgetid);
       
       $success="Y";

            $getimagename=$editdata["sitelogo"];
            if(!empty($getimagename) && file_exists(SITE_UPLOADPATH.$getimagename) )
            {
              unlink(SITE_UPLOADPATH.$getimagename);
              $this->users->sitesettingupdateimage($strgetid,"sitelogo");
            }else
            {
             $success="N";         
            }                    
        
        
         echo $success;
    }
    
    function notice($id)
    {
        if($this->session->userdata('adminid'))
        {
         $this->users->changenoticestatus($id);
        } 
    }     
}  
?>