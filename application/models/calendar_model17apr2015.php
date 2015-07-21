<?php
class Calendar_model  extends CI_Model 
{
  public function __construct()
	{
		$this->load->database();
		$this->load->helper('general_helper');
	}
 //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX Customer Module Start
 public function add_events($input)
 {
    	$title = $input['title'];
	$start = $input['start'];
	$end = $input['end'];
   
	if($title <> '' && $start <> '' && $end <> ''){
 	$sql = "INSERT INTO tbl_events (title, start, end) VALUES ('".$title."', '".$start."', '".$end."')";
	   $this->db->query($sql);
     }  
    
 }
 public function dob_count()
 {
    
            $profilebithdays =$this->db->query("SELECT count(id) as count FROM `tbl_profiles` WHERE dob !='0000-00-00' and dob <>'' ORDER BY `id` ASC  ");
            $profilebithday=$profilebithdays->result(); 
          
    return $profilebithday[0]->count;  
 }
 public function update_events($input)
 {
     
     	$id = $input['id'];
	$title = $input['title'];
	$start = $input['start'];
	$end = $input['end'];
	if($id <> '' && $title <> '' && $start <> '' && $end <> ''){
 	 $sql = "UPDATE  tbl_events SET title ='".$title."' , start = '".$start."', end ='".$end."' WHERE id='".$id."'";
	    $this->db->query($sql);
 	 }
    
 }
 
 public function delete_events($id)
 {
     $sql = "DELETE from  tbl_events WHERE id='".$id."'"; 
	    $this->db->query($sql);
 }
 	function removeUnsed($urlString)
		{
		   $arrSearch = array("!", "@", "#", "$", "%", "^", "&", "*", "(", ")", ":", "?",",","<",">","/", "~","`", "'"," ",'"',"=",".");
		   $arrReplace = array("-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-", "-","-","-","-");
		   $cleanURL = str_replace($arrSearch, $arrReplace, $urlString);
		   
		   $arrSe = array("--", "---", "----", "-----");
		   $arrRe = array("-", "-", "-", "-");
		   $cleanURL = str_replace($arrSe, $arrRe, $cleanURL);
		   $cleanURL = str_replace("-", "", $cleanURL);
		   
		   return strtolower($cleanURL);
		}
  public function GetAllrecords($input)
	{
          
if($input['event'] == 'getprofile' && isset($input['event'])){
 
if(trim($input['value']) !=''){
   $strSql1 = "SELECT title,image,description,region_id FROM `tbl_profiles` WHERE (`title` LIKE '%".stripslashes($input['value'])."%' OR `tags` LIKE '%".stripslashes($input['value'])."%' OR `category` LIKE '%".stripslashes($input['value'])."%' OR `kind` LIKE '%".stripslashes($input['value'])."%') AND status='4'";
$objRecord = $this->db->query($strSql1);
 
if($objRecord->num_rows > 0){
$data ='';
foreach($objRecord->result() as $profile)
{
 
	$regOb = $this->db->query("Select * FROM tbl_regions where status=1 and id in (".$profile->region_id.")");
	$regionName_arr = $regOb->result();
    $regionName = $regionName_arr->region_name;

	if($profile->title !=''){
		$data.=' <li><a data-postid="'. $this->removeUnsed($regionName).'" href="#'.$this->removeUnsed($regionName).'-profile" data-title="'.utf8_encode(stripslashes($profile->title)).'" data-body="'.utf8_encode(stripslashes($profile->description)).'" data-image="show-thumb.php?file=upload/'.$profile->image.'&w=500&h=500" title="'. utf8_encode(stripslashes($profile->title)).'"  class="post-thumb-video '. $this->removeUnsed($regionName).' imageclick recimg"><img src="show-thumb.php?file=upload/'.$profile->image.'&w=50&h=50" width="50" height="50" />&nbsp;'.utf8_encode(stripslashes($profile->title)).'</a></li>';
	}
	

}
	if($data ==''){
	 echo 0;exit;
	}
	else
	$data1[]=$data;

		echo json_encode($data1);exit;

	}else{
	 echo 0;exit;
	}

	}else{
	 echo 0;exit;
	} 


} else if($input['event'] == 'getfullprofile'){
	
	$color = array('#FF0F00','#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#CD0D74','#754DEB','#DDDDDD','#999999','#5C2A32','#70E5DB','#F7A6AB','#999FBB','#199A9F','#FF6666','#62C185','#BAFFE1','#FF0F00','#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215');
	
	if(trim($input['value']) !=''){
	 	$strSql1 = "SELECT id,title,image,description,region_id FROM `tbl_profiles` WHERE (`title` LIKE '%".stripslashes($input['value'])."%' OR `tags` LIKE '%".stripslashes($input['value'])."%' OR `category` LIKE '%".stripslashes($input['value'])."%' OR `kind` LIKE '%".stripslashes($input['value'])."%') AND status='4'";
	    $objRecord = $this->db->query($strSql1);
		$rcnt =array();
		if($objRecord->num_rows > 0){
			$data ='';
			$countryArr = array();
		foreach($objRecord->result() as $profile)
        {
				$regOb = $this->db->query("Select id,region_name FROM tbl_regions where status=1 and id in (".$profile->region_id.")");
		      	$regionName_arr = $regOb->result();
                $regionName = $regionName_arr->region_name;
				
				if($profile->title !=''){
					$strSql = "SELECT id,region_name FROM tbl_regions  where id IN(".$profile->region_id.") ORDER BY region_title";
					$objRs = $this->db->query($strSql);
					$txtOption = '';
					foreach($objRs->result() as $objRow)	
					{
						$regionNameArr = $objRow->region_name;
						if (array_key_exists($regionNameArr,$countryArr))
				  		{
				  			$countryArr[$regionNameArr][] = array('id'=>$profile->id,'title'=>$profile->title,'image'=>$profile->image,'description'=>$profile->description,'region_id'=>$objRow->id);
				  		}
				   		else
				  		{
				  			$countryArr[$regionNameArr][] = array('id'=>$profile->id,'title'=>$profile->title,'image'=>$profile->image,'description'=>$profile->description,'region_id'=>$objRow->id);
				  		}
						/*----- chart data ------- */
						 if (array_key_exists($objRow->region_name,$rcnt))
						  {
							$rcnt[$objRow->region_name] = $rcnt[$objRow->region_name]+1;
						  }
						   else
						  {
							$rcnt[$objRow->region_name] = 1;
						  }
						  
						/*----- chart data END------- */
					} // while close
				} // if close
			} // while close
			ksort($countryArr);
			ksort($rcnt);
			$data.= '<div id="parentVerticalTab" style="overflow:auto;">
            <ul class="resp-tabs-list hor_1">';
			$counrtyDataList = '<div class="resp-tabs-container hor_1">';
			$counter = 1;
			foreach($countryArr as $Ckey=>$Cval)
			{
				$data.= '<li>'.$Ckey.'</li>';
				$display = '';
				if($counter == 1){$display = 'block';}
				$counrtyDataList.= '<div>';
				foreach($Cval as $dkey=>$dval)
				{
					//$counrtyDataList.= '<a href="javascript:void(0)">'.stripslashes($dval['title']).'</a><br/>';
					$counrtyDataList.= '<a data-postid="'.$this->removeUnsed($Ckey).'" data-proid="'.$dval['id'].'" data-regionid="'.$dval['region_id'].'" href="javascript: void(0);" data-title="'.stripslashes(html_entity_decode($dval['title'], ENT_QUOTES)).'" data-body="'.stripslashes(htmlentities($dval['description'], ENT_QUOTES)).'" data-image="show-thumb.php?file=upload/'.$dval['image'].'&w=800&h=800" title="'.stripslashes(html_entity_decode($dval['title'], ENT_QUOTES)).'" class="span_3 post-thumb-video '.$this->removeUnsed($Ckey).'_'.$dval['id'].' searchResultClick" data-selector="'.$this->removeUnsed($Ckey).'_'.$dval['id'].'"><img class="lazy" src="'.BASE_URL.'show-thumbpj.php?src='.BASE_URL.'upload/'.$dval['image'].'&w=80&h=80&zc=1" width="80" height="100"/>'.stripslashes($dval['title']).'</a>';
				}
			$counrtyDataList.= '</div>';
			$counter++;
			}
			$data.= '</ul>';
			$Jscript = '</div></div><script type="text/javascript">
        $(\'#parentVerticalTab\').easyResponsiveTabs({type: \'vertical\',width: \'auto\',fit: true,closed: \'false\',tabidentify: \'hor_1\'
        });
		$(function() {
    $("img.lazy").lazyload();
});
/*--- search result click ------*/
</script>';
			$finalData = $data.$counrtyDataList.$Jscript;
			//echo '<pre>'; print_r($countryArr); echo '</pre>';
			$colorcount = 0;
			foreach($rcnt as $keys=>$values)
			{
			  $chartGraphData[] = array('country'=>$keys,'visits'=>$values,'color'=>$color[$colorcount]);
			  $colorcount++;  
	       	}
			if($data ==''){ echo 0;exit;}
			else{
				$data1[]=$chartGraphData;
				$data1[]=$finalData;
				$data1[]=count($chartGraphData);
			}
			echo json_encode($data1);exit;
	
		}else{
		 echo 0;exit;
		}
	
	}else{
		echo 0;exit;
	}
	
}else{



 $pastryear = date('Y-m-d',strtotime("-12 month", strtotime(date('Y-m-d'))));
 $sesionid= $this->session->userdata('adminid');
if(isset($sesionid)){


if($input['g'] =='full'){
$objRecord=array();
$strSql = "SELECT * FROM tbl_events where DATE(end) >= DATE('".date('Y-m-d')."') ORDER BY id"; 
$objRecord_arr = $this->db->query($strSql);
if(!$objRecord){
	$objRecord=array();
}
$postevents=array();

  $strSql4 = "SELECT * FROM tbl_events where DATE(end) < DATE('".date('Y-m-d')."') and DATE(end) > DATE('".date($pastryear)."') ORDER BY id";  
$objRecord4 = $this->db->query($strSql4);

foreach( $objRecord4->result() as $postevent){

	if($postevent->end !='0000-00-00'){

		$postevents[] = array(
		    'id'    => $postevent->id,
		    'title' => $postevent->title,
		    'start' => $postevent->start,
		    'end' => $postevent->end,
		    'type' => 'nd',
		    'backgroundColor' => '#F0F1F6 !important',
		    'className' => 'pastevent'
		);
	}
	

}
 
 $cnt =count($objRecord_arr->result());
if($cnt>0)
{ 
  
  $objRecord= $objRecord_arr->result();
foreach($objRecord_arr->result() as $key => $value){
$objRecord[$key]->backgroundColor = '#BBE2AE !important';
$objRecord[$key]->className = 'evtday';
}
}else
{
 $objRecord=array(); 
}
 
 $strSql1 = "SELECT * FROM tbl_profiles where 1=1 ORDER BY id";
$objRecord1 = $this->db->query($strSql1);
 

$birthday=array();
$posdate=array();
foreach($objRecord1->result() as $dob){

	if($dob->dob !='0000-00-00'){
        $date = explode('-',$dob->dob);
 
	$yearBegin = date("Y")-1;
	    $yearEnd = $yearBegin + 2; // edit for your needs
	    $years = range($yearBegin, $yearEnd, 1);
 
	    foreach($years as $year){
		$birthday[] = array(
		    'id'    => '',
		    'title' => 'Birthday of '. utf8_encode(stripslashes($dob->title)),
		    'start' => $year . "-" . $date[1] . "-" . $date[2],
		    'end' => $year . "-" . $date[1] . "-" . $date[2],
		    'type' => 'nd',                    
	    	    'backgroundColor' => '#EBBBA8 !important',
		    'className' => 'pbday',
		);
	    }

	}
	if($dob->postdate !='0000-00-00' && $dob->status=='4'){

		$posdate[] = array(
		    'id'    => '',
		    'title' => utf8_encode(stripslashes($dob->title)).' profile published',
		    'start' => date('Y-m-d H:i:s',strtotime($dob->postdate) + 60*60*2),
		    'end' => date('Y-m-d H:i:s',strtotime($dob->postdate) + 60*60*2),
		    'type' => 'nd',
		    'backgroundColor' => '#3B5998 !important',
		    'className' => 'pday'
		);
	}
	

}



 
$strSql2= "SELECT username,dob FROM tbl_admin where dob!='0000-00-00' ORDER BY id"; 
$objRecord2= $this->db->query($strSql2);
 

$abirthday=array();
 
foreach($objRecord2->result() as $dob){

	if($dob->dob !='0000-00-00'){
        $date = explode('-',$dob->dob);
 
	$yearBegin = date("Y")-1;
	    $yearEnd = $yearBegin + 2; // edit for your needs
	    $years = range($yearBegin, $yearEnd, 1);
 
	    foreach($years as $year){
		$abirthday[] = array(
		    'id'    => '',
		    'title' => 'Birthday of '.$dob->username,
		    'start' => $year . "-" . $date[1] . "-" . $date[2],
		    'end' => $year . "-" . $date[1] . "-" . $date[2],
		    'type' => 'nd',                    
	    	    'backgroundColor' => '#C2DFF2 !important',
		    'className' => 'abday'	
		);
	    }

	}
 

}

  $strSql5= "SELECT region_name,independenceday FROM tbl_regions where independenceday!='0000-00-00' ORDER BY id"; 
$objRecord5= $this->db->query($strSql5);
 

$independencedayd=array();
 
foreach($objRecord5->result() as $independenceday){

	if($independenceday->independenceday !='0000-00-00'){
        $date = explode('-',$independenceday->independenceday);
 
	$yearBegin = date("Y")-1;
	    $yearEnd = $yearBegin + 2; // edit for your needs
	    $years = range($yearBegin, $yearEnd, 1);
 
	    foreach($years as $year){
		$independencedayd[] = array(
		    'id'    => '',
		    'title' => 'Independence day of '.$independenceday->region_name,
		    'start' => date('Y-m-d H:i:s',strtotime($year . "-" . $date[1] . "-" . $date[2]) + 60*60*4),
		    'end' => date('Y-m-d H:i:s',strtotime($year . "-" . $date[1] . "-" . $date[2]) + 60*60*4),
		    'type' => 'nd',                    
	    	    'backgroundColor' => '#F3FDAE !important',
		    'className' => 'inday'	
		);
	    }

	}
 

}
       /*
            if(is_array($objRecord))
            {
              echo "objRecord";
            }
            if(is_array($birthday))
            {
              echo "birthday";
            }
            if(is_array($posdate))
            {
              echo "posdate";
            }
            if(is_array($abirthday))
            {
              echo "abirthday";
            }
            if(is_array($postevents))
            {
              echo "postevents";
            }
            if(is_array($independencedayd))
            {
              echo "independencedayd";
            }
                   */
$data = array_merge($objRecord,$birthday,$posdate,$abirthday,$postevents,$independencedayd);
 
 
}
elseif($input['g'] =='pastyear' ){
//&& $input['pastyear'] == 1

$postevents=array();

  $strSql4 = "SELECT * FROM tbl_events where DAY(start) = '".$_POST['date']."' and MONTH(start) = '".($_POST['month']+1)."' and YEAR(start) <  '".date('Y')."'  and YEAR(start) > '".(date('Y')-6)."' and YEAR(start) > '2013'  ORDER BY id";  
  $objRecord4 = $this->db->query($strSql4);

foreach($objRecord4->result() as $postevent){
 
	if($postevent->end !='0000-00-00'){

		$postevents[date('Y-m-d',strtotime($postevent->start))][] = array(
		    'title' => $postevent->title
 
		);
	}
	

}
 
$strSql1 = "SELECT * FROM tbl_profiles where  DAY(dob) = '".$_POST['date']."' and MONTH(dob) = '".($_POST['month']+1)."' ORDER BY id";
$objRecord1 = $this->db->query($strSql1);
 

$birthday=array();
$posdate=array();
foreach($objRecord1->result() as $dob){

	if($dob->dob !='0000-00-00'){
        $date = explode('-',$dob->dob);
 
	$yearEnd = (date("Y") -1);
	    $yearBegin = $yearEnd - 4; // edit for your needs
	    $years = range($yearBegin, $yearEnd, 1);
 
	    foreach($years as $year){
		if($year >= '2014'){
		$birthday[$year . "-" . $date[1] . "-" . $date[2]][] = array(	 
		    'title' => 'Birthday of '.utf8_encode(stripslashes($dob->title)),
		);
		}
	    }

	}
 
	

}
 $strSqlp = "SELECT * FROM tbl_profiles where   DAY(postdate) =  '".$_POST['date']."'  and MONTH(postdate) =  '".($_POST['month']+1)."' and YEAR(postdate) < '".date('Y')."' and YEAR(postdate) > '".(date('Y')-6)."' and YEAR(postdate) > '2013' ORDER BY id";
$objRecordp = $this->db->query($strSqlp);
foreach($objRecordp->result() as $dob){

 
	if($dob->postdate !='0000-00-00' && $dob->status=='4'){

		$posdate[date('Y-m-d',strtotime($dob->postdate))][] = array(

		    'title' => utf8_encode(stripslashes($dob->title)).' profile published',
		  
		);
	}
	

}

  $strSql2= "SELECT username,dob FROM tbl_admin where DAY(dob) = DAY('".$_POST['date']."') and MONTH(dob) = MONTH('".($_POST['month']+1)."')  ORDER BY id"; 
$objRecord2= $this->db->query($strSql2);
 

$abirthday=array();
 
foreach($objRecord2->result() as $dob){

	if($dob->dob !='0000-00-00'){
        $date = explode('-',$dob->dob);
 
	$yearEnd = (date("Y")-1);
	    $yearBegin = $yearEnd - 4; // edit for your needs
	    $years = range($yearBegin, $yearEnd, 1);
 
	    foreach($years as $year){
		if($year >= '2014'){
		$abirthday[$year . "-" . $date[1] . "-" . $date[2]][] = array(
 
		    'title' => 'Birthday of '.$dob->username,
		   
		);
		}
	    }

	}
 

}

  $strSql5= "SELECT region_name,independenceday FROM tbl_regions where DAY(independenceday) = DAY('".$_POST['date']."') and MONTH(independenceday) = MONTH('".($_POST['month']+1)."') ORDER BY id"; 
$objRecord5= $this->db->query($strSql5);
 

$independencedayd=array();
 
foreach($objRecord5->result() as $independenceday){

	if($independenceday->independenceday !='0000-00-00'){
        $date = explode('-',$independenceday->independenceday);
 
	$yearEnd = (date("Y") -1);
	    $yearBegin = $yearEnd - 4; // edit for your needs
	    $years = range($yearBegin, $yearEnd, 1);
 
	    foreach($years as $year){
		if($year >= '2014'){
		$independencedayd[$year . "-" . $date[1] . "-" . $date[2]][] = array(
		
		    'title' => 'Independence day of '.$independenceday->region_name,
	
		);
		}
	    }

	}
 

}
$data =array();
for($i=1;$i<=5;$i++){
 
	$year = (date('Y')-$i); 
	if($year >= '2014'){
	  $date = date('Y-m-d',strtotime($year.'-'.($_POST['month']+1).'-'.$_POST['date'])); 
  	$data[$year][]='';
	if(array_key_exists($date,$postevents)){
 
	  foreach($postevents[$date] as $title){
           $data[$year][]=$title['title'];
	  }
        }
	if(array_key_exists($date,$birthday)){
	  foreach($birthday[$date] as $title){
          $data[$year][]=$title['title'];
	  }
        }
	if(array_key_exists($date,$posdate)){
	  foreach($posdate[$date] as $title){
          $data[$year][]=$title['title'];
	  }
        }
	if(array_key_exists($date,$abirthday)){
	  foreach($abirthday[$date] as $title){
          $data[$year][]=$title['title'];
	  }
        }
	if(array_key_exists($date,$independencedayd)){
	  foreach($independencedayd[$date] as $title){
          $data[$year][]=$title['title'];
	  }
        }
       }

}
 
 echo '<div class="row-fluid">
<span class="span"></span>';

$cht=1;
foreach($data as $datakey=>$datavar){


?>
    <div class="co-md-12">
 
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><?php echo  $datakey;?></h4>
            </div>
            <div class="panel-body">
		<?php if(count($datavar) > 1){
		        for($i=1;$i<count($datavar);$i++){	
                ?>
                <p class="muted"><?php echo $datavar[$i]; ?>.</p>
           
		<?php } }else{ ?>
		<p class="text-error">No events.</p>
		<?php } ?>
            </div>
        </div>
 
    </div>




<?php
} echo '</div>';exit;



}else{

 
 
$events=array();
  $strSql4 = "SELECT count( * ) as count  ,start  FROM tbl_events where DATE(end) >= DATE('".date('Y-m-d')."') GROUP BY `start` ORDER BY id";  
$objRecord4 = $this->db->query($strSql4);

foreach($objRecord4->result() as $postevent){
 
	if($postevent->start !='0000-00-00'){

		$events[] = array(
		    'title' => 'Event-'.$postevent->count,
		    'start' => $postevent->start,
		    'end' => $postevent->start,
		    'type' => 'nd',
		    'backgroundColor' => '#BBE2AE !important',
		    'className' => 'evtday',
		    'url' =>  SITE_ADMIN_URL.'calendar?go='.strtotime($postevent->start)
		);
	}
	

}




$strSql = "SELECT count(*) as count,postdate,status FROM tbl_profiles where 1=1 and postdate!='0000-00-00' and status='4' GROUP BY `postdate` ORDER BY id";
$objRecord = $this->db->query($strSql);
 
$posdate=array();
foreach($objRecord->result() as $ppd){
if($ppd->postdate !='0000-00-00' && $ppd->status=='4'){
 
		$posdate[] = array(
		    'id'    => '',
		    'title' => 'profile published-'.$ppd->count,
		    'start' => $ppd->postdate,
		    'end' => $ppd->postdate,
		    'type' => 'nd',
		    'backgroundColor' => '#3B5998 !important',
		    'className' => 'pday',
		    'url' =>  SITE_ADMIN_URL.'calendar?go='.strtotime($ppd->postdate)
		);
}
}
 

$strSql1 = "SELECT count(*) as count,dob,CONCAT('0000','-',MONTH(dob),'-',DAY(dob)) as dob1 FROM tbl_profiles where 1=1 and dob!='0000-00-00' GROUP BY `dob1` ORDER BY id";
$objRecord1 = $this->db->query($strSql1);
 

$birthday=array();

foreach($objRecord1->result() as $dob ){

	if($dob->dob !='0000-00-00'){
        $date = explode('-',$dob->dob);
 
	$yearBegin = date("Y") - 1;
	    $yearEnd = $yearBegin + 2; // edit for your needs
	    $years = range($yearBegin, $yearEnd, 1);
 
	    foreach($years as $year){
		$pbirthday[$year . "-" . $date[1] . "-" . $date[2]] = array('date' => $year . "-" . $date[1] . "-" . $date[2],'countpb' =>$dob->count);
	    }

	}

}




  $strSql2= "SELECT count(*) as count,dob,CONCAT('0000','-',MONTH(dob),'-',DAY(dob)) as dob1 FROM tbl_admin where dob!='0000-00-00' GROUP BY `dob1` ORDER BY id"; 
$objRecord2= $this->db->query($strSql2);
foreach($objRecord2->result() as $dob){

	if($dob->dob !='0000-00-00'){
        $date = explode('-',$dob->dob);
 
	$yearBegin = date("Y") - 1;
	    $yearEnd = $yearBegin + 2; // edit for your needs
	    $years = range($yearBegin, $yearEnd, 1);
 
	    foreach($years as $year){
		$abirthday[$year . "-" . $date[1] . "-" . $date[2]] = array('date' => $year . "-" . $date[1] . "-" . $date[2],'countab' =>$dob->count);
	    }

	}
 

}

foreach($pbirthday as $key=>$value){

	if(array_key_exists($key,$abirthday)){
		
		$birthday[] = array(
		    'id'    => '',
		    'title' => 'Birthday-'.($value['countpb'] + $abirthday[$key]['countab']),
		    'start' => $key,
		    'end' => $key,
		    'type' => 'nd',
		    'backgroundColor' => '#C2DFF2 !important',
		    'className' => 'abday',
		    'url' =>  SITE_ADMIN_URL.'calendar?go='.strtotime($key)
		);
		unset($abirthday[$key]);
        }else{
		$birthday[] = array(
		    'id'    => '',
		    'title' => 'Birthday-'.($value['countpb']),
		    'start' => $key,
		    'end' => $key,
		    'type' => 'nd',
		    'backgroundColor' => '#C2DFF2 !important',
		    'className' => 'abday',
		    'url' =>  SITE_ADMIN_URL.'calendar?go='.strtotime($key)
		);
        }

}
foreach($abirthday as $key=>$value){

 	$birthday[] = array(
		    'id'    => '',
		    'title' => 'Birthday-'.($value['countab']),
		    'start' => $key,
		    'end' => $key,
		    'type' => 'nd',
		    'backgroundColor' => '#C2DFF2 !important',
		    'className' => 'abday',
		    'url' =>  SITE_ADMIN_URL.'calendar?go='.strtotime($key)
		);
		unset($abirthday[$key]);
        }


  $strSql5= "SELECT count(*) as count,independenceday FROM tbl_regions where independenceday!='0000-00-00' GROUP BY independenceday ORDER BY id"; 
$objRecord5= $this->db->query($strSql5);
 

$independencedayd=array();
 
foreach($objRecord5->result() as $independenceday){

	if($independenceday->independenceday !='0000-00-00'){
        $date = explode('-',$independenceday->independenceday);
 
	$yearBegin = date("Y") - 1;
	    $yearEnd = $yearBegin + 2; // edit for your needs
	    $years = range($yearBegin, $yearEnd, 1);
 
	    foreach($years as $year){
		$independencedayd[] = array(
		    'id'    => '',
		    'title' => 'Independence - '.$independenceday->count,
		    'start' => $year . "-" . $date[1] . "-" . $date[2],
		    'end' => $year . "-" . $date[1] . "-" . $date[2],
		    'type' => 'nd',                    
	    	    'backgroundColor' => '#F3FDAE !important',
		    'className' => 'inday',
		    'url' =>  SITE_ADMIN_URL.'calendar?go='.strtotime($year . "-" . $date[1] . "-" . $date[2])
		);
	    }

	}
 

}
$data = array_merge($birthday,$posdate,$events,$independencedayd);
} 

  
 	 echo json_encode($data);
}
}

	  
	}
    public function getAllcount($searchdata)
    { 
        
        $sql="SELECT * FROM tbl_admin";
      if(!empty($searchdata))
       {
         $sql.=" where  username like '".$searchdata["searchstr"]."%'";	
       } 
        
         $sql.=" order by username ";
         
        $query = $this->db->query($sql);
        $data=$query->result_array();
         
        return count($data); 
    }

 public function GetaffiliateById($id)
	{
	   $query = $this->db->query("SELECT * FROM tbl_admin where id=".$id);
	   return $query->result_array();
	}

	
     public function insert($input)
    {
              $semail="";  
              if(!empty($input["siteemail"]))
              {
                 $semail=implode(",",$input["siteemail"]);
              } 
              
              $spass="";  
              if(!empty($input["siteemailpass"]))
              {
                 $spass=implode("-|-",$input["siteemailpass"]);
              } 
              
           $data = array('username' => $input["username"],
                           'password' => md5($input["userpass"]), 
                           'email' => $input["email"],
                           'semail' => $semail,
                           'spassword' => $spass,
                           'superadmin' => $input["type"]
                            
                          );
             $this->db->insert('tbl_admin', $data); 
             
            
              $insertid= $this->db->insert_id();
     return $insertid;   
    }
    
     public function update($input)
    {
            $semail="";  
              if(!empty($input["siteemail"]))
              {
                 $semail=implode(",",$input["siteemail"]);
              } 
              
              $spass="";  
              if(!empty($input["siteemailpass"]))
              {
                 $spass=implode("-|-",$input["siteemailpass"]);
              } 
              $data = array('username' => $input["username"],
                           'password' => md5($input["userpass"]), 
                           'email' => $input["email"],
                           'semail' => $semail,
                           'spassword' => $spass,
                           'superadmin' => $input["type"]
                            
                          );
          
                 
            $this->db->where('id', $input["id"]);
            $this->db->update('tbl_admin', $data);
     return true;     
    } 
    
    public function updateimage($id,$fieldname)
    {
      $data=array($fieldname=>"");  
        $this->db->where('id', $id);
            $this->db->update('tbl_admin', $data);
     return true;     
    }   
    
    public function getmaxid($id,$tablename)
  {
     return $this->db->query("select if(count($id)=0,1,max($id)+1 ) as maxid from $tablename ")->row()->maxid;
    
  } 
   public function deleterecords($ids)
   {
      foreach($ids as $key => $value)
      {
          $this->db->query("delete from tbl_admin where id='".$value."'");                      
      }   
    
   } 
}
?>