<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mliststats extends CI_Controller   
{   
    var $session_member_id;
	var $session_member_name;

    function __construct()
        {
            parent::__construct();
            if(!$this->session->userdata('logged_in')){redirect('/admin');}
            $this->load->model("stats_model");
            
            $this->load->helper("file");
            $this->load->library('upload');
            $this->load->library('form_validation');
            $this->load->helper('general_helper');
            $this->load->library('image_lib');
            $this->load->library('pagination');
            $this->load->library('breadcrumbs');
        }

   function index($catid="")
	   {
	       
         
           
        
	        $this->load->model("masterlist_model"); 
	        $filter["fillter"]="";
           $kinds_arr= $this->masterlist_model->Getkinds($filter);
           $data['masterlists']="";  
           $kindsarr=$this->config->item("kinds_ids");
                  
                  
                        $intI=0;
                      foreach($kindsarr as $key => $value)
                            			  {
                             			   if(isset($kinds_arr[$key]["kind"]))
                                           {
                            			 
                            			    $data['masterlists'].='{  label: "'.$kinds_arr[$key]["kind"].'['.$kinds_arr[$key]["pcount"].']",data: '.$kinds_arr[$key]["pcount"].' },';
                                           
                                           }else
                                           {
                                              $data['masterlists'].='{  label: "'.$value.'[0]",data: 0 },';
                                            
                                           }
                                        
                                         $intI++;
                            			  }  
                        
                // echo $data['masterlists']; exit;       
              //************************************** Suggestion   *************************************           
                    
           $suggestionkinds_arr= $this->masterlist_model->Getsuggestionkinds();
           $data['suggestionkinds']="";
               $intI=0;
                      foreach($kindsarr as $key => $value)
                            			  {
                             			   if(isset($suggestionkinds_arr[$key]["kind"]))
                                           {
                            			 
                            			    $data['suggestionkinds'].='{  label: "'.$suggestionkinds_arr[$key]["kind"].'['.$suggestionkinds_arr[$key]["pcount"].']",data: '.$suggestionkinds_arr[$key]["pcount"].' },';
                                           
                                           }else
                                           {
                                              $data['suggestionkinds'].='{  label: "'.$value.'[0]",data: 0 },';
                                            
                                           }
                                        
                                         $intI++;
                            			  }  
           
           
              //****************************************************************************
	   	 $catid=htmlentities($catid);
		$rtag =array();
		$tags = $this->db->query("SELECT trim(tags) as tags FROM tbl_profiles WHERE tags!=''");
		
        $categoys_arr= $this->stats_model->Getcategory();
        
        foreach($tags->result() as $tag)
		{
			//echo "while 1-";
			$rtags = explode(",",$tag->tags);
			$rtag = array_merge($rtag,$rtags);
	    }
		$rtags = array_filter(array_unique($rtag));
	 
		$Regions = $this->stats_model->GetAllRegion();

		$data['Singer'] = '';
		$data['Athletes']= '';
		$data['Athletes1']= '';
		$data['Actors']= '';
		$data['Politicians']= '';
		$data['Politicians1']= '';
		$data['Gangsters']= '';
		$data['Authors']= '';
		$data['Authors1']= '';
		$data['tags']= '';
		$data['gtags']= '';
		$data['cat']='';
        $data['profilepercountry']='';
        $data['profilebyadmin']='';
        $data['profilestatus']='';
        $data['profilebob']='';
        $data['suggestionpercountry']='';
        $data['suggestiontopemail']='';
		$i=0;
		$j=0;
		$k=0;
		$catdata= $this->db->query("SELECT DISTINCT category  FROM tbl_profiles  where 1=1 ORDER BY category");
	    //echo "test1";echo '</pre>';print_r($catdata);
	    if(empty($catid))
	    {

			//$cat= $this->db->query("SELECT DISTINCT category  FROM tbl_profiles  where 1=1 ORDER BY category")->result();
            $cat= $this->db->query("SELECT DISTINCT category  FROM tbl_category  where 1=1 ORDER BY category")->result();
		    $catid = $cat[0]->category; 
            
		}
		else
		{
			$catid = urldecode($catid);
		}
       
      // 5f4dcc3b5aa765d61d8327deb882cf99
      // ca61ac2f09986aeb4867f90cda0d3720
      //
        /***************************************/
        $color = array('#FF0F00','#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215','#0D8ECF','#0D52D1','#2A0CD0',
        '#8A0CCF','#CD0D74','#754DEB','#DDDDDD','#999999','#5C2A32','#70E5DB','#F7A6AB','#999FBB','#199A9F','#FF6666','#62C185',
        '#BAFFE1','#FF0F00','#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215',
        '#FF0F00','#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215','#0D8ECF','#0D52D1','#2A0CD0',
        '#8A0CCF','#CD0D74','#754DEB','#DDDDDD','#999999','#5C2A32','#70E5DB','#F7A6AB','#999FBB','#199A9F','#FF6666','#62C185',
        '#BAFFE1','#FF0F00','#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215'
        );
        
        //********************************** Suggestion Email count
          $suggestioncounts =$this->db->query("SELECT count(id) as ecount,email FROM `tbl_suggestion` WHERE removed='Y' group by email order by ecount desc  limit 0,10");
            foreach($suggestioncounts->result() as $suggestioncount)
           {
              $data['suggestiontopemail'].= '{  label: "'.$suggestioncount->email.'",data: '.$suggestioncount->ecount.',color: "'.$color[$k].'" },';
              $k++;
           }
        //***************************************************
          $months = array(
                           '01'=> 'January',
                           '02'=> 'February',
                           '03'=> 'March',
                           '04'=> 'April',
                           '05'=> 'May',
                            '06'=>'June',
                           '07'=> 'July ',
                           '08'=> 'August',
                           '09'=> 'September',
                           '10'=> 'October',
                           '11'=> 'November',
                           '12'=> 'December'
                    );
         $currentyear=date("Y");
         $k=0;
         foreach($months as  $montid => $monthname)
         {
            $profilebithdays =$this->db->query("SELECT count(id) as count FROM `tbl_profiles` WHERE  month(dob)='".$montid."' ORDER BY `id` ASC  ");
            foreach($profilebithdays->result() as $profilebithday)
           {
              $data['profilebob'].= '{  label: "'.$monthname.'",data: '.$profilebithday->count.',color: "'.$color[$k].'" },';
              $k++;
           }
         }
        
        //********************************
           $kind_arr=array('1'=>"Available",'2'=>"Pending",'3'=>"Ready",'4'=>"Used");
           $profilesstatuses =$this->db->query("SELECT count(id)as count,status FROM `tbl_profiles`  group by `status` ORDER BY status ASC");
            foreach($profilesstatuses->result() as $profilesstatus)
           {
              $data['profilestatus'].= '{  label: "'.$kind_arr[$profilesstatus->status].'['.$profilesstatus->count.']",data: '.$profilesstatus->count.' },';
           } 
           
            $data['profilestatus']; 
        //**********************************
        $profilesadmin =$this->db->query("SELECT id,username FROM tbl_admin ORDER BY username ");
        $j=0;
       foreach($profilesadmin->result() as $admindetails)
       {
       $profiles_by_admin = $this->db->query("SELECT count(id) as count,region_id FROM tbl_profiles where admin_id='".$admindetails->id."' ORDER BY count ");
	   $pro_byadmin_arr=$profiles_by_admin->result();
        $data['profilebyadmin'].= '{  label: "'.$admindetails->username.'",data: '.$pro_byadmin_arr[0]->count.',color: "'.$color[$j].'" },';
         $j++;
       }
       
        
		$i=0;
        foreach($Regions as $Region )
		{
			//echo "while 2-";
			$profiles_per_country = $this->db->query("SELECT count(id) as count,region_id FROM tbl_profiles where FIND_IN_SET('".$Region->id."',region_id)  ORDER BY count");
		    $pro_per_arr=$profiles_per_country->result();
            $data['profilepercountry'].= '{  country: "'.$Region->region_name.'",visits: '.$pro_per_arr[0]->count.',color: "'.$color[$i].'" },';
            
            
            $suggestions_per_country = $this->db->query("SELECT count(id) as count,region_id FROM tbl_suggestion where FIND_IN_SET('".$Region->id."',region_id)  ORDER BY count");
		    $suggestion_per_arr=$suggestions_per_country->result();
            $data['suggestionpercountry'].= '{  country: "'.$Region->region_name.'",visits: '.$suggestion_per_arr[0]->count.',color: "'.$color[$i].'" },';
            
            
            
            $i++;
            
            $category = $this->db->query("SELECT count(category) as count,category, category FROM tbl_profiles where FIND_IN_SET('".$Region->id."',region_id)  GROUP BY category ORDER BY count");
			foreach($category->result() as $categorydata)
			{
				if($categorydata->category == 'Singer')
				{
					$data['Singer'].= '{  label: "'.$Region->region_name.'",data: '.$categorydata->count.',color: "'.$color[$i].'" },';
				}
				if($categorydata->category =='Athletes')
				{
				//	$data['Athletes'].= '['.$i.','.$categorydata->count.'],';
				//	$data['Athletes1'].= "[".$i.",'".$Region->region_name."'],"; $i++;
                    
                    $data['Athletes'].= '{  label: "'.$Region->region_name.'",data: '.$categorydata->count.',color: "'.$color[$i].'" },';
				}
				if($categorydata->category =='Actors')
				{
					$data['Actors'].= '{  label: "'.$Region->region_name.'",data: '.$categorydata->count.',color: "'.$color[$i].'" },';
				}
				if($categorydata->category =='Politicians')
				{
					//$data['Politicians'].= '['.$i.','.$categorydata->count.'],';
				///	$data['Politicians1'].= "[".$i.",'".$Region->region_name."'],"; $i++;
                    
                    $data['Politicians'].= '{  label: "'.$Region->region_name.'",data: '.$categorydata->count.',color: "'.$color[$i].'" },'; 
                    
				}
				if($categorydata->category =='Gangsters')
				{
					$data['Gangsters'].= '{  label: "'.$Region->region_name.'",data: '.$categorydata->count.',color: "'.$color[$i].'" },';
				}
				if($categorydata->category =='Authors')
				{
				//	$data['Authors'].= '['.$i.','.$categorydata->count.'],';
					//$data['Authors1'].= "[".$i.",'".$Region->region_name."'],"; $i++;
                    	$data['Authors'].= '{  label: "'.$Region->region_name.'",data: '.$categorydata->count.',color: "'.$color[$i].'" },';
				} 

			}
         
			$catcount = $this->db->query("SELECT count(id) as count FROM tbl_profiles where FIND_IN_SET('".$Region->id."',region_id) and category = '".trim($catid)."'")->result();
 
			if($catcount[0]->count > 0)
			{
				$data['cat'].= '{ label: "'.$Region->region_name.'",data: '.$catcount[0]->count.',color: "'.$color[$i].'" },';
			}
		}	

  /*foreach($rtags as $rtag)
  {
   //echo "forech first";
//   $sql="SELECT count(id) as count FROM tbl_profiles where FIND_IN_SET('".$rtag."',tags)";
//   echo $sql;

   $tagcount = $this->objDatabase->fetchRows("SELECT count(id) as count FROM tbl_profiles where FIND_IN_SET('".$rtag."',tags)");
  echo $tagcount->count."<BR>";

  if($tagcount->count > 0)
    {ECHO 	"<BR>";
     ECHO $data['gtags'].= '{label: "'.$rtag.'['.$tagcount->count.']",data: '.$tagcount->count.' },';
    }

  }*/


		if(!isset($_GET['rid']))
		{
			//echo "ssssssecond-Last";
			$frid = $this->db->query("SELECT * FROM tbl_regions  where 1=1 ORDER BY region_title")->result();
			//echo $frid->id;
			$_GET['rid'] = $frid[0]->id;
		}

		//echo "----last----------------";
//parent :: admin_masterstats($catdata);  
		foreach($rtags as $rtag)
		{
		 	//echo "forech two";
			$tagcount = $this->db->query("SELECT count(id) as count FROM tbl_profiles where FIND_IN_SET('".addslashes($rtag)."',tags) and FIND_IN_SET('".$_GET['rid']."',region_id)")->result();
			/*$tagcount = $this->objDatabase->fetchRows("SELECT count(id) as count FROM tbl_profiles where FIND_IN_SET('tags',".$rtag.") and FIND_IN_SET('region_id',".$_GET['rid'].")");*/
			//echo "in Foreach";echo '<pre/>';print_r($tagcount);
			if($tagcount[0]->count > 0)
			{
			   $data['tags'].= '{ label: "'.$rtag.'['.$tagcount[0]->count.']",data: '.$tagcount[0]->count.' },';
			   
			  //echo $data['tags']."<br>";
			}
			//echo "test2";
		}
	 		//echo "test2";
	 
        
         $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('<a href="#ignore">Master List Stats</a>', "&nbsp;" );
           
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Master List Stats ';
            $data['page_title']       = 'Master List Stats';
			$data['page_action'] = 'Master List Stats';
            $data['category'] ="";   
            $data['categories'] =$categoys_arr;
             $data['category'] =$catid;
            
            
		  $this->openView($data,'catstats');
	   }
     function getdata($id="")
    {
         $serachdata=array();
         
             
             if($this->input->get('g'))
             {
               $serachdata["g"] =$this->input->get('g');
               $serachdata["event"] ="";
               $serachdata["pastyear"] =""; 
             }
             
              if($this->input->get('event'))
             {
               $serachdata["event"] =$this->input->get('event');
               $serachdata["g"] ="";
               $serachdata["pastyear"] =""; 
             }
             
              if($this->input->get('pastyear'))
             {
               $serachdata["pastyear"] =$this->input->get('pastyear');
               $serachdata["g"] ="";
               $serachdata["event"] =""; 
             }
          //***********************************************************
        
          $data['results'] = $this->calendar_model->GetAllrecords($serachdata); 
          
        
        
    }
         
  	private function openView($xdata,$viewName)
	{
	
	$this->load->view('admin/header', $xdata);
		$this->load->view('admin/stats/'.$viewName,$xdata);
	    $this->load->view('admin/footer');
	}
    
    public function setbackgroundimage()
    {
          $editid=$this->input->post("editid");
          $this->affiliate_model->setbackgroundimage($editid); 
    }  
      public function piescreen()
    {
          $data["pieDataScreenResolutions"]=$this->input->post("getdata");
         
         $this->load->view('admin/stats/screenregulation', $data);
    } 
    
  public function masterstats($catid="")
{
	  $catid=htmlentities($catid);
		$rtag =array();
		$tags = $this->db->query("SELECT trim(tags) as tags FROM tbl_profiles WHERE tags!=''");
		
        $categoys_arr= $this->stats_model->Getcategory();
        
        foreach($tags->result() as $tag)
		{
			//echo "while 1-";
			$rtags = explode(",",$tag->tags);
			$rtag = array_merge($rtag,$rtags);
	    }
		$rtags = array_filter(array_unique($rtag));
	 
		$Regions = $this->stats_model->GetAllRegion();

		$data['Singer'] = '';
		$data['Athletes']= '';
		$data['Athletes1']= '';
		$data['Actors']= '';
		$data['Politicians']= '';
		$data['Politicians1']= '';
		$data['Gangsters']= '';
		$data['Authors']= '';
		$data['Authors1']= '';
		$data['tags']= '';
		$data['gtags']= '';
		$data['cat']='';
		$i=0;
		$j=0;
		$k=0;
		$catdata= $this->db->query("SELECT DISTINCT category  FROM tbl_profiles  where 1=1 ORDER BY category");
	    //echo "test1";echo '</pre>';print_r($catdata);
	    if(!isset($catid))
	    {

			$cat= $this->db->query("SELECT DISTINCT category  FROM tbl_profiles  where 1=1 ORDER BY category")->result();
		    $catid = $cat->category; 
		}
		else
		{
			$catid = urldecode($catid);
		}

		foreach($Regions as $Region )
		{
			//echo "while 2-";
			//$category = $this->objDatabase->dbQuery("SELECT count(category) as count,category, category FROM tbl_profiles where FIND_IN_SET('2',region_id)  GROUP BY category ORDER BY count");
			$category = $this->db->query("SELECT count(category) as count,category, category FROM tbl_profiles where FIND_IN_SET('".$Region->id."',region_id)  GROUP BY category ORDER BY count");
			foreach($category->result() as $categorydata)
			{
				if($categorydata->category == 'Singer')
				{
					$data['Singer'].= '{  label: "'.$Region->region_name.'['.$categorydata->count.']",data: '.$categorydata->count.' },';
				}
				if($categorydata->category =='Athletes')
				{
				//	$data['Athletes'].= '['.$i.','.$categorydata->count.'],';
				//	$data['Athletes1'].= "[".$i.",'".$Region->region_name."'],"; $i++;
                    
                    $data['Athletes'].= '{  label: "'.$Region->region_name.'['.$categorydata->count.']",data: '.$categorydata->count.' },';
				}
				if($categorydata->category =='Actors')
				{
					$data['Actors'].= '{  label: "'.$Region->region_name.'['.$categorydata->count.']",data: '.$categorydata->count.' },';
				}
				if($categorydata->category =='Politicians')
				{
					//$data['Politicians'].= '['.$i.','.$categorydata->count.'],';
				///	$data['Politicians1'].= "[".$i.",'".$Region->region_name."'],"; $i++;
                    
                    $data['Politicians'].= '{  label: "'.$Region->region_name.'['.$categorydata->count.']",data: '.$categorydata->count.' },'; 
                    
				}
				if($categorydata->category =='Gangsters')
				{
					$data['Gangsters'].= '{  label: "'.$Region->region_name.'['.$categorydata->count.']",data: '.$categorydata->count.' },';
				}
				if($categorydata->category =='Authors')
				{
				//	$data['Authors'].= '['.$i.','.$categorydata->count.'],';
					//$data['Authors1'].= "[".$i.",'".$Region->region_name."'],"; $i++;
                    	$data['Authors'].= '{  label: "'.$Region->region_name.'['.$categorydata->count.']",data: '.$categorydata->count.' },';
				} 

			}
         
			$catcount = $this->db->query("SELECT count(id) as count FROM tbl_profiles where FIND_IN_SET('".$Region->id."',region_id) and category = '".trim($catid)."'")->result();
 
			if($catcount[0]->count > 0)
			{
				$data['cat'].= '{ label: "'.$Region->region_name.'['.$catcount[0]->count.']",data: '.$catcount[0]->count.' },';
			}
		}	

  /*foreach($rtags as $rtag)
  {
   //echo "forech first";
//   $sql="SELECT count(id) as count FROM tbl_profiles where FIND_IN_SET('".$rtag."',tags)";
//   echo $sql;

   $tagcount = $this->objDatabase->fetchRows("SELECT count(id) as count FROM tbl_profiles where FIND_IN_SET('".$rtag."',tags)");
  echo $tagcount->count."<BR>";

  if($tagcount->count > 0)
    {ECHO 	"<BR>";
     ECHO $data['gtags'].= '{label: "'.$rtag.'['.$tagcount->count.']",data: '.$tagcount->count.' },';
    }

  }*/


		if(!isset($_GET['rid']))
		{
			//echo "ssssssecond-Last";
			$frid = $this->db->query("SELECT * FROM tbl_regions  where 1=1 ORDER BY region_title")->result();
			//echo $frid->id;
			$_GET['rid'] = $frid[0]->id;
		}

		//echo "----last----------------";
//parent :: admin_masterstats($catdata);  
		foreach($rtags as $rtag)
		{
		 	//echo "forech two";
			$tagcount = $this->db->query("SELECT count(id) as count FROM tbl_profiles where FIND_IN_SET('".addslashes($rtag)."',tags) and FIND_IN_SET('".$_GET['rid']."',region_id)")->result();
			/*$tagcount = $this->objDatabase->fetchRows("SELECT count(id) as count FROM tbl_profiles where FIND_IN_SET('tags',".$rtag.") and FIND_IN_SET('region_id',".$_GET['rid'].")");*/
			//echo "in Foreach";echo '<pre/>';print_r($tagcount);
			if($tagcount[0]->count > 0)
			{
			   $data['tags'].= '{ label: "'.$rtag.'['.$tagcount[0]->count.']",data: '.$tagcount[0]->count.' },';
			   
			  //echo $data['tags']."<br>";
			}
			//echo "test2";
		}
	 		//echo "test2";
	 
        
         $homeicon=htmlentities('<i class="fa fa-home fa-lg"></i>');
           $this->breadcrumbs->push($homeicon, '/admin/dashboard');
           $this->breadcrumbs->push('Dashboard', "/admin/dashboard" );
           $this->breadcrumbs->push('<a href="#ignore">Master List Stats</a>', "&nbsp;" );
           
           $breadcrumds=$this->breadcrumbs->show();
            $data['breadcrumds']       = $breadcrumds;
            $data['sitetitle']       = 'Master List Stats ';
            $data['page_title']       = 'Master List Stats';
			$data['page_action'] = 'Master List Stats';
            $data['category'] ="";   
            $data['categories'] =$categoys_arr;
            
            
            
		  $this->openView($data,'catstats');
  
 } // End Function   
 
      public function dragdroplist()
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
               
                $this->db->query("insert into tbl_dragdrop (menuname,orderno,userid,section) values ('".$menuname."','".$orderno."','".$this->session->userdata('adminid')."','masterliststats')");
            }else
            {
               // echo "update  tbl_dragdrop set orderno='".$orderno."' where menuname='".$menuname."'and userid='".$this->session->userdata('adminid')."' and section='leftsection'";
               $this->db->query("update  tbl_dragdrop set orderno='".$orderno."' where menuname='".$menuname."'and userid='".$this->session->userdata('adminid')."' and section='masterliststats'"); 
                
            }
                
                
            $orderno++;    
        } 
       } 
      
    }
    
}
?>