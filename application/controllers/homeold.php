<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

        public function __construct()
        {	 
           

			parent::__construct();
          	$this->load->helper('url');
            $this->load->helper('download');
            $this->load->helper("file");
            $this->load->library('upload');
            $this->load->library('form_validation');
            $this->load->helper('general_helper');
            $this->load->library('image_lib');
            $this->load->library('session'); 
        }
    
    	public function index($slug="")
    	{
    	  
    	    $data = array();
             
            $segment_1 = $this->uri->segment(1);
          // echo "<Pre>"; print_r($segment_1);exit;
           
           $this->home($segment_1);
	        /* switch ($segment_1) 
           {
		      case null:
		      case false:
		      case ''                    : $this->home();
		                                   break;

              case 'home'                : $this->home();
		                                   break;
        	}  
            */
            
            
    	}
        
        public function home($slug="")
        {  
            $data=array();  
           $data["page"]="Home"; 
           $data["sulg"]=$slug; 
           $this->load->view('index',$data);
           //$this->load->view('pages/home',$data);
          //$this->load->view('footer');
        }
         function getdata($id="")
    {
         $serachdata=array();
        
          $this->load->model("calendar_model");
             
             if($this->input->get('g'))
             {
               $serachdata["g"] =$this->input->get('g');
               $serachdata["event"] ="";
               $serachdata["pastyear"] =""; 
             }
             
              if(isset($_REQUEST['event']))
             {
               $serachdata["event"] =$_REQUEST['event'];
               $serachdata["value"] =$_REQUEST['value'];
               $serachdata["g"] ="";
               $serachdata["pastyear"] =""; 
               
               
             }
             
              if($this->input->get('pastyear'))
             {
               $serachdata["pastyear"] =$this->input->get('pastyear');
               $serachdata["g"] ="";
               $serachdata["event"] =""; 
             }
             $g=$this->input->get('g');
             if(isset($_REQUEST['event']))
             {
               $event=$_REQUEST['event'];//$this->input->get('event');   
             }else
             {
                $event="";
             }
             $pastyear=$this->input->get('pastyear');
             
             if(empty($g) &&  empty($event) && empty($pastyear))
             {
                 $serachdata["pastyear"] ="";
               $serachdata["g"] ="";
               $serachdata["event"] ="";  
             }
          //***********************************************************
        
          $data['results'] = $this->calendar_model->GetAllrecords($serachdata); 
          
        
        
    }
        public function getregions()
        {  
            $data=array();  
           $data["page"]="Home";
           $data["id"]=$_REQUEST["id"];
           $data["sno"]=$_REQUEST["sno"]; 
           $this->load->view('region',$data);
           //$this->load->view('pages/home',$data);
          //$this->load->view('footer');
        } 
        
      function getprofile() 
      {
           $intId = '1';
           $region_image_img_name="";
        if( $_POST['md_title'] !=''){
            $_POST['md_region_id'] =   implode(",", $_POST['md_regions']);
            
            		//  $strSql ='SELECT * FROM tbl_profiles where  title =\'' .$objDatabase->con->real_escape_string(trim($_POST['md_title'])).'\' and region_id = \''.trim($_POST['md_region_id']).'\'  '; 
            		//	$namecheck_rs = $this->db->query($strSql); 
                     //   $namecheck=$namecheck_rs->result_array();
                      $namecheck=  $this->db
                		  ->where('title',trim($_POST['md_title'])) 
                		  ->where('region_id',trim($_POST['md_region_id']))  
                		  ->count_all_results('tbl_profiles'); 
                        
            $dataint=0;
            
            		if($namecheck){
            		   $datamsg= 'Profile Name already exists';
            		   $dataint=0;	
            		}
            		else{
            			$_POST['db_dob'] = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
            			unset($_POST['year']); unset($_POST['month']); unset($_POST['day']);
             		//	$intId= $objDatabase->insertForm('tbl_suggestion'); 
                         $maxid=getMaxId("tbl_suggestion","id");
                         $data = array('gname' => $_POST['db_gname'],
                           'email' => $_POST['db_email'], 
                           'title' => $_POST['md_title'],
                           'dob' => $_POST['db_dob'],
                            'image' => '',
                            'region_id' =>$_POST['md_region_id'],
                            'kind' => trim($_POST['md_kind']),
                            'description' => addslashes($_POST['md_description']),
                            
                        );
            $this->db->insert('tbl_suggestion', $data); 
                        
                        
                        
                        
                         if(!empty($_FILES["db_image"]['name']))
					{
				        $gettmp_tumbs_arr=array();
                        $imagecounter=1; 
					    $ext = explode(".",$_FILES["db_image"]['name']);
						$ext = strtolower($ext[1]);
						$uploadConst['upload_path']   = SITE_UPLOADPATH;
						$uploadConst['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
                        //$uploadConst['max_size'] = REGION_MAP;
                      //  $uploadConst['min_width'] = '1200';
                      //   $uploadConst['min_height'] = '900';
						$uploadConst['file_name']     = 'suggestionprofile-'.$maxid.".".$ext; 
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload('db_image'))
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
                       $this->db->query("update tbl_suggestion set image='".$region_image_img_name."' where id='".$maxid."' ");  
                       
                          
                    }else
                    {
                      $region_image_img_name="";  
                    } 
                        
                        
            			if($intId){
            			    	$datamsg= 'Thank you! Your submission has been received and is awaiting approval';
            			        $dataint=1;
             
            			if( $_POST['db_email'] !=''){
                          
                          //*****************************************
                          
                             $strSql ='SELECT * FROM tbl_mailtemplates  where id=%d'; 
                        		$objRecord1 =  $this->db->query(sprintf($strSql,'1'));
                               
                            $messagearr = $objRecord1->row_array(); 
                            $message=$messagearr["temp_content"];
                           	$name = ($_POST['db_gname']!='') ? $_POST['db_gname'] : 'User';
                           	$message = str_replace("[#name]",$name,$message);
            				$message = str_replace("[#profilename]",trim($_POST['md_title']),$message);
             				$message = str_replace("[#kind]",$_POST['md_kind'],$message);
            				$message = str_replace("[#description]",$_POST['md_description'],$message);
                             //*****************  Send to Add User **********************   
                              send_email($messagearr["subject"],$message,$_POST['db_email'],$_POST['md_title'],$messagearr["from_mail"],$messagearr["title"]);
                          
                          
                          //*******************************************************
                                	}
            
            
            	
            			}else{
            			   $datamsg= 'Sorry, your request not sent try later';
            			   $dataint=0;	
            			}
                            }
            	
             }else{
            	 $datamsg= 'Sorry, your request not sent try later';
            	 $dataint=0;	
            }
            
            $data = array($dataint,$datamsg);
            
           // echo "<pre>";
           // print_r($_POST);
          //  print_r($_FILES);
          //  exit;
            echo json_encode($data);
        
        
        
        
      }
	
}
