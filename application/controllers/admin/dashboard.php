<?php
class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
         if(!$this->session->userdata('logged_in')){redirect('/admin');}
		$this->load->helper('general_helper');
		$this->load->model('users');
		$this->load->model('events');
		is_admin_log_in();
         $this->load->library('breadcrumbs');
	}

	public function index()
	{
	   
           $homeicon=htmlentities('<i class="fa fa-home color_black"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('<a href="#ignore">Dashboard</a>', "&nbsp;" );
           /*<span class="icon-angle-right"></span>*/
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
		$data['title'] = 'User Dashboard';
		$data['page_title'] = 'User Dashboard';
        $data['sitetitle']       = 'User Dashboard';
    	 
        
		//$data['today_events'] = $this->events->get_todayevent();
        
        $data['get_siteinfo'] = $this->events->get_siteinfo();
        $data['admin_getprofile'] = $this->users->admin_getprofile();
        $data['admin_getaffiliatelog'] = $this->users->admin_getaffiliatelog();
        $data['admin_getchatmsg'] = $this->users->admin_getchatmsg();
        
       
        $color = array('#FF0F00','#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215','#0D8ECF','#0D52D1','#2A0CD0',
        '#8A0CCF','#CD0D74','#754DEB','#DDDDDD','#999999','#5C2A32','#70E5DB','#F7A6AB','#999FBB','#199A9F','#FF6666','#62C185',
        '#BAFFE1','#FF0F00','#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215',
        '#FF0F00','#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215','#0D8ECF','#0D52D1','#2A0CD0',
        '#8A0CCF','#CD0D74','#754DEB','#DDDDDD','#999999','#5C2A32','#70E5DB','#F7A6AB','#999FBB','#199A9F','#FF6666','#62C185',
        '#BAFFE1','#FF0F00','#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215'
        );
		$i=0;
        $data['profilepercountry']="";
        $Regions = $this->users->GetAllRegion();
         foreach($Regions as $Region )
		{
			//echo "while 2-";
			$profiles_per_country = $this->db->query("SELECT count(id) as count,region_id FROM tbl_profiles where FIND_IN_SET('".$Region->id."',region_id)  ORDER BY count");
		    $pro_per_arr=$profiles_per_country->result();
            $data['profilepercountry'].= '{  country: "'.$Region->region_name.'",visits: '.$pro_per_arr[0]->count.',color: "'.$color[$i].'" },';
            $i++;
       }    
        
		/* get_adminnotification
        $emailCountArr=CountUnreadMail();
		$EmailCount=0;
		if(is_array($emailCountArr)){if(count($emailCountArr)>0){$EmailCount=$emailCountArr['count'];}}
		$data['EmailCount'] = $EmailCount;
        */
		 
		$this->OpenView('index',$data);
	}
	
 
	function OpenView($ViewPage,$viewData)
	{
		$this->load->view('admin/header', $viewData);
		$this->load->view('admin/dashboard/'.$ViewPage,$viewData);
		$this->load->view('admin/footer');
	}
    
    function tdash(){
        $homeicon=htmlentities('<i class="fa fa-home color_black"></i>');
        $this->breadcrumbs->push($homeicon, '/admin/dashboard');
        $this->breadcrumbs->push('<a href="#ignore">Dashboard</a>', "&nbsp;" );
        /*<span class="icon-angle-right"></span>*/
       $breadcrumds=$this->breadcrumbs->show();
        $data['breadcrumds']       = $breadcrumds;
		$data['title']             = 'Dashboard';
		$data['page_title']        = 'Dashboard';
        $data['sitetitle']         = 'Dashboard';
        
        $data['get_siteinfo'] = $this->events->get_siteinfo();
        $data['admin_getprofile'] = $this->users->admin_getprofile();
        $data['admin_getaffiliatelog'] = $this->users->admin_getaffiliatelog();
        $data['admin_getchatmsg'] = $this->users->admin_getchatmsg();
    	 
       	$this->load->view('admin/tempheader',$data);
	    $this->load->view('admin/dashboard/slider',$data);
       	$this->load->view('admin/tempfooter');
    
    }
    
    public function admin_setprepage()
    {
       
        $this->users->admin_setprepage($this->input->post());
    }
    public function chnagetheme()
    {
      $this->users->chnagetheme($this->input->post());  
    }
    public function task()
	{
	   
           $homeicon=htmlentities('<i class="fa fa-home color_black"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('<a href="#ignore">Dashboard</a>', "&nbsp;" );
           /*<span class="icon-angle-right"></span>*/
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
		$data['title']      = 'Task';
		$data['page_title'] = 'Task';
        $data['sitetitle']  = 'Task';
    	 
       
         if($this->input->post("btn_ready"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->users->changeselectstatus($selected,'2');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been status(In progress) changed successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                 redirect('admin/dashboard/task');  
           }  
       
           if($this->input->post("btn_complete"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->users->changeselectstatus($selected,'3');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been status(Completed) changed successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                 redirect('admin/dashboard/task');  
           }  
       
           if($this->input->post("btn_close"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->users->changeselectstatus($selected,'4');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been status(Closed) changed successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                 redirect('admin/dashboard/task');  
           }  
           
            if($this->input->post("btn_delete"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->users->deleteselect($selected);
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been status(Deleted) changed successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                 redirect('admin/dashboard/task');  
           }  
           
	
        
        $data['get_siteinfo'] = $this->events->get_siteinfo();
        $data['admin_getprofile'] = $this->users->admin_getprofile();
        $data['admin_getaffiliatelog'] = $this->users->admin_getaffiliatelog();
        $data['admin_getchatmsg'] = $this->users->admin_getchatmsg();
      
        $data['results'] =$this->users->admin_viewtask();
        
        
        $this->OpenView('task',$data);
	}
    public function givetask()
	{
	   
           $homeicon=htmlentities('<i class="fa fa-home color_black"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('<a href="#ignore">Dashboard</a>', "&nbsp;" );
           $this->breadcrumbs->push('<a href="#ignore">Created Task</a>', "&nbsp;" );
           /*<span class="icon-angle-right"></span>*/
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
		$data['title']      = 'Created Task';
		$data['page_title'] = 'Created Task';
        $data['sitetitle']  = 'Created Task';
    	 
       
         if($this->input->post("btn_ready"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->users->changeselectstatus($selected,'2');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been status(In progress) changed successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                 redirect('admin/dashboard/givetask');  
           }  
       
           if($this->input->post("btn_complete"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->users->changeselectstatus($selected,'3');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been status(Completed) changed successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                 redirect('admin/dashboard/givetask');  
           }  
       
           if($this->input->post("btn_close"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->users->changeselectstatus($selected,'4');
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been status(Closed) changed successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for status change..");
                   }
                 redirect('admin/dashboard/givetask');  
           }  
           
            if($this->input->post("btn_delete"))
            { 
                if($this->input->post("selected"))
                {
                   $selected=$this->input->post("selected");
                   if(!empty($selected))
                   {
                       $this->users->deleteselect($selected);
                     $this->session->set_flashdata('sucess', " ".count($selected)." records have been status(Deleted) changed successfully."); 
                   }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                   	
                }else
                   { 
                     $this->session->set_flashdata('error', "Select at least one record for delete..");
                   }
                 redirect('admin/dashboard/givetask');  
           }  
           
        $data['get_siteinfo'] = $this->events->get_siteinfo();
        $data['admin_getprofile'] = $this->users->admin_getprofile();
        $data['admin_getaffiliatelog'] = $this->users->admin_getaffiliatelog();
        $data['admin_getchatmsg'] = $this->users->admin_getchatmsg();
      
        $data['results'] =$this->users->admin_viewtask();
        
        
        $this->OpenView('givetask',$data);
	}
     public function addtask()
	{
	   
           $homeicon=htmlentities('<i class="fa fa-home color_black"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('<a href="#ignore">Dashboard</a>', "&nbsp;" );
            $this->breadcrumbs->push('<a href="#ignore">Add task</a>', "/admin/dashboard/create" );
           /*<span class="icon-angle-right"></span>*/
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
    		$data['title']      = 'Add Task';
    		$data['page_title'] = 'Add Task';
            $data['sitetitle']  = 'Add Task';
            $data['id']  = '0';
             
             	$config = array(
                array(
                     'field'   => 'radmin_id',
                     'label'   => "Affilate ",
                     'rules'   => 'required|trim'
                  ),
                array(
                     'field'   => 'task',
                     'label'   => "Task ",
                     'rules'   => 'required|trim'
                  )
               
            );

        $this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == TRUE)
		{
          $this->users->admin_savetask($this->input->post());
          
          $this->session->set_flashdata('sucess', "Task have been created sucessfully");
           redirect('admin/dashboard/task');
          
        }     
             
         if($this->input->post("task")){ $data['task']= $this->input->post("task"); }else{ $data['task']= ""; }
         if($this->input->post("radmin_id")){ $data['radmin_id']= $this->input->post("radmin_id"); }else{ $data['radmin_id']= ""; }
           
         $data['affilates'] =$this->users->GetAllaffilates();  
           
        $this->OpenView('addtask',$data);
    }    
    
     public function cloud()
	{
	   
           $homeicon=htmlentities('<i class="fa fa-home color_black"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('<a href="#ignore">Dashboard</a>', "&nbsp;" );
            $this->breadcrumbs->push('<a href="#ignore">Cloud</a>', "/admin/dashboard/cloud" );
           /*<span class="icon-angle-right"></span>*/
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
    		$data['title']      = 'Cloud';
    		$data['page_title'] = 'Cloud';
            $data['sitetitle']  = 'Cloud';
            $data['id']  = '0';
             
          	 
        $this->OpenView('cloud',$data);
    }
    
    public function addchat()
    {
       
        $this->users->addchat($this->input->post());
        redirect('admin/dashboard');
    }
    
    public function deletechat()
    {
         $deteleid=$this->input->post("strgetid");
        $this->users->deletechat($deteleid);
        echo $deteleid;
    } 
    
    public function dragleftmenu()
    {
        
        //tbl_dragdrop
        $_POST["leftmenunames"];
        
       if(!empty($_POST["leftmenunames"]))
       {
        $orderno=1;
        foreach($_POST["leftmenunames"] as $key => $menuname)
        {
          $checkorder="select * from tbl_dragdrop where menuname='".$menuname."' and  userid='".$this->session->userdata('adminid')."'";
          $result_db= $this->db->query($checkorder);
           
            $checkdataexist=$result_db->result_array();
            if(empty($checkdataexist))
            {
               
                $this->db->query("insert into tbl_dragdrop (menuname,orderno,userid,section) values ('".$menuname."','".$orderno."','".$this->session->userdata('adminid')."','leftsection')");
            }else
            {
               // echo "update  tbl_dragdrop set orderno='".$orderno."' where menuname='".$menuname."'and userid='".$this->session->userdata('adminid')."' and section='leftsection'";
               $this->db->query("update  tbl_dragdrop set orderno='".$orderno."' where menuname='".$menuname."'and userid='".$this->session->userdata('adminid')."' and section='leftsection'"); 
                
            }
                
                
            $orderno++;    
        } 
       } 
      
    }
    
     public function dragdashboradmenu()
    {
        
        //tbl_dragdrop
        $_POST["leftmenunames"];
        
       if(!empty($_POST["leftmenunames"]))
       {
        $orderno=1;
        foreach($_POST["leftmenunames"] as $key => $menuname)
        {
          $checkorder="select * from tbl_dragdrop where menuname='".$menuname."' and  userid='".$this->session->userdata('adminid')."'";
          $result_db= $this->db->query($checkorder);
           
            $checkdataexist=$result_db->result_array();
            if(empty($checkdataexist))
            {
               
                $this->db->query("insert into tbl_dragdrop (menuname,orderno,userid,section) values ('".$menuname."','".$orderno."','".$this->session->userdata('adminid')."','dashboardsection')");
            }else
            {
               // echo "update  tbl_dragdrop set orderno='".$orderno."' where menuname='".$menuname."'and userid='".$this->session->userdata('adminid')."' and section='leftsection'";
               $this->db->query("update  tbl_dragdrop set orderno='".$orderno."' where menuname='".$menuname."'and userid='".$this->session->userdata('adminid')."' and section='dashboardsection'"); 
                
            }
                
                
            $orderno++;    
        } 
       } 
      
    }
}
?>