<?php
class Events extends CI_Model 
{
	public function __construct(){$this->load->database();}

	public function get_siteinfo()
    {
      $strSql = "SELECT dnotification FROM tbl_settings where id='1'";
      $query = $this->db->query($strSql);
      $RsCount=$query->result_array();
	  if(count($RsCount)>0)
         { return $RsCount[0]['dnotification']; }
      else
         {return "";}
    }
    
    public function get_todayevent()
    {
	      $rsRecord=0;
          $strSql = "
            SELECT id FROM tbl_events  where  '".date('Y-m-d')."' BETWEEN DATE(start) AND DATE(end)
            union
            SELECT id FROM tbl_profiles  where   DAY(dob) = DAY('".date('Y-m-d')."') and MONTH(dob) = MONTH('".date('Y-m-d')."')
            union
            SELECT id FROM tbl_profiles  where status='4' and  DATE(postdate)=DATE('".date('Y-m-d')."')
            union
            SELECT id FROM tbl_admin where dob!='0000-00-00' and DAY(dob) = DAY('".date('Y-m-d')."') and MONTH(dob) = MONTH('".date('Y-m-d')."')
          ";
          $sql = $this->db->query($strSql);
          $rsRecord=count($sql->result_array());
	      return $rsRecord;
    }
	
	public function event_getfullprofile($svalue)
	{
		
				$color = array('#FF0F00','#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#CD0D74','#754DEB','#DDDDDD','#999999','#5C2A32','#70E5DB','#F7A6AB','#999FBB','#199A9F','#FF6666','#62C185','#BAFFE1','#FF0F00','#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215');
				if(trim($svalue) !='')
					{
	 					$strSql1 = "SELECT id,title,image,description,region_id FROM `tbl_profiles` WHERE (`title` LIKE '%".stripslashes($svalue)."%' OR 
						`tags` LIKE '%".stripslashes($svalue)."%' OR `category` LIKE '%".stripslashes($svalue)."%' OR 
						`kind` LIKE '%".stripslashes($svalue)."%') AND status='4'";
						$sql = $this->db->query($strSql1);
						$ArrRs=$sql->result_array();
						$rcnt =array();
						if(count($ArrRs)>0)
						{
								$data ='';
								$countryArr = array();
								foreach($ArrRs as $key=> $profile)
								{
									if($profile['title'] !='')
										{
											$strSql = "SELECT id,region_name FROM ".TBL_REGIONS."  where id IN(".$profile['region_id'].") ORDER BY region_title";
											$sql2 = $this->db->query($strSql);
											$ArrRs2 = $sql2->result_array();
											if(count($ArrRs2)>0)
											{
												$txtOption = '';
												foreach($ArrRs2 as $key2 => $objRow){
													$regionNameArr = $objRow['region_name'];
													if (array_key_exists($regionNameArr,$countryArr))
														{
															$countryArr[$regionNameArr][] = array('id'=>$profile['id'],'title'=>$profile['title'],'image'=>$profile['image'],
															'description'=>$profile['description'],'region_id'=>$objRow['id']);
														}
													else
														{
															$countryArr[$regionNameArr][] = array('id'=>$profile['id'],'title'=>$profile['title'],'image'=>$profile['image'],
															'description'=>$profile['description'],'region_id'=>$objRow['id']);
														}
													/*----- chart data ------- */
													 if (array_key_exists($objRow->region_name,$rcnt))
														{$rcnt[$objRow['region_name']] = $rcnt[$objRow['region_name']]+1;}
													 else
														{$rcnt[$objRow['region_name']] = 1;}/*----- chart data END------- */
												}
											}
										} // if close
								}
								ksort($countryArr);
								ksort($rcnt);
								$data.= '<div id="parentVerticalTab" style="overflow:auto;">
								<ul class="resp-tabs-list hor_1">';
								$counrtyDataList = '<div class="resp-tabs-container hor_1">';
								$counter = 1;
								foreach($countryArr as $Ckey=>$Cval) {
										$data.= '<li>'.$Ckey.'</li>';
										$display = '';
										if($counter == 1){$display = 'block';}
										$counrtyDataList.= '<div>';
										foreach($Cval as $dkey=>$dval)
											{
												//$counrtyDataList.= '<a href="javascript:void(0)">'.stripslashes($dval['title']).'</a><br/>';
												$counrtyDataList.= '<a data-postid="'.removeUnsed($Ckey).'" data-proid="'.$dval['id'].'" data-regionid="'.$dval['region_id'].'" href="javascript: void(0);" data-title="'.stripslashes(html_entity_decode($dval['title'], ENT_QUOTES)).'" data-body="'.stripslashes(htmlentities($dval['description'], ENT_QUOTES)).'" data-image="show-thumb.php?file=upload/'.$dval['image'].'&w=800&h=800" title="'.stripslashes(html_entity_decode($dval['title'], ENT_QUOTES)).'" class="span_3 post-thumb-video '.removeUnsed($Ckey).'_'.$dval['id'].' searchResultClick" data-selector="'.removeUnsed($Ckey).'_'.$dval['id'].'"><img class="lazy" src="'.BASE_URL.'show-thumbpj.php?src='.BASE_URL.'upload/'.$dval['image'].'&w=80&h=80&zc=1" width="80" height="100"/>'.stripslashes($dval['title']).'</a>';
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
								if($data !='')
									{
										$data1[]=$chartGraphData;
										$data1[]=$finalData;
										$data1[]=count($chartGraphData);
									}
								return $data1;
						}
					}
			return "0";
	}
	
	public function event_getprofile($svalue)
	{
		$data ='0';
		$strSql = "SELECT title,image,description,region_id FROM `tbl_profiles` WHERE (`title` LIKE '%".stripslashes($svalue)."%' OR 
										`tags` LIKE '%".stripslashes($svalue)."%' OR `category` LIKE '%".stripslashes($svalue)."%' OR 
										`kind` LIKE '%".stripslashes($svalue)."%') AND status='4'";
		 $sql = $this->db->query($strSql);
		 $ArrRs=$sql->result_array();
		 if(count($ArrRs)>0)
		 {
		 	$data="";
			foreach($ArrRs as $key=> $profile)
			{
				
		 	$strSql2="Select distinct region_name FROM tbl_regions where region_name!='' and status=1 and id in (".$profile['region_id'].")";
			$sql2 = $this->db->query($strSql2);
		 	$ArrRs2=$sql2->result_array();
			if(count($ArrRs2)>0)
				{
					$regOb = $ArrRs2[0];
					$regionName = $regOb['region_name'];
					if($profile['title'] !='')
					{
						$data.=' <li><a data-postid="'. removeUnsed($regionName).'" href="#'.$removeUnsed($regionName).'-profile" data-title="'.utf8_encode(stripslashes($profile['title'])).'" data-body="'.utf8_encode(stripslashes($profile['description'])).'" data-image="show-thumb.php?file=upload/'.$profile['image'].'&w=500&h=500" title="'. utf8_encode(stripslashes($profile['title'])).'"  class="post-thumb-video '. $removeUnsed($regionName).' imageclick recimg"><img src="show-thumb.php?file=upload/'.$profile['image'].'&w=50&h=50" width="50" height="50" />&nbsp;'.utf8_encode(stripslashes($profile['title'])).'</a></li>';
					
					}
				}
		 
			}
		 }
		 return $data;
	}
	
	public function event_calander_for_admin()
	{
		$pastryear = date('Y-m-d',strtotime("-12 month", strtotime(date('Y-m-d'))));
		
		if($_GET['g'] =='full')
			{
				 
				$strSql = "SELECT * FROM tbl_events where DATE(end) >= DATE('".date('Y-m-d')."') ORDER BY id"; 
				$sql = $this->db->query($strSql);
          		$objRecord=$sql->result_array();
				$postevents=array();
				
				$strSql4 = "SELECT * FROM tbl_events where DATE(end) < DATE('".date('Y-m-d')."') and DATE(end) > DATE('".date($pastryear)."') ORDER BY id";  
				$sql = $this->db->query($strSql4);
				$objRecord4=$sql->result_array();
				foreach($objRecord4 as $key => $postevent)
					{
						if($postevent['end'] !='0000-00-00')
							{
								$postevents[] = array(
														'id'    => $postevent['id'],
														'title' => $postevent['title'],
														'start' => $postevent,
														'end' => $postevent['end'],
														'type' => 'nd',
														'backgroundColor' => '#F0F1F6 !important',
														'className' => 'pastevent'
													);
							}
					}

				$cnt =count($objRecord);
				for($i=0;$i<$cnt;$i++)
					{
						$objRecord[$i]->backgroundColor = '#BBE2AE !important';
						$objRecord[$i]->className = 'evtday';
					}
					
				 
				$sql = $this->db->query("SELECT title,postdate,dob FROM tbl_profiles where 1=1 ORDER BY id");
				$objRecord1=$sql->result_array();
				$birthday=array();
				$posdate=array();
				foreach($objRecord1 as $key=> $dob)
					{
						if($dob['dob'] !='0000-00-00')
							{
								$date = explode('-',$dob['dob']);
								$yearBegin = date("Y")-1;
								$yearEnd = $yearBegin + 2; // edit for your needs
								$years = range($yearBegin, $yearEnd, 1);
								foreach($years as $year){
															$birthday[] = array(
																'id'    => '',
																'title' => 'Birthday of '. utf8_encode(stripslashes($dob['title'])),
																'start' => $year . "-" . $date[1] . "-" . $date[2],
																'end' => $year . "-" . $date[1] . "-" . $date[2],
																'type' => 'nd',                    
																	'backgroundColor' => '#EBBBA8 !important',
																'className' => 'pbday',
																);
														}
							}
						if($dob['postdate'] !='0000-00-00' && $dob['status']=='4')
							{
								$posdate[] = array(
									'id'    => '',
									'title' => utf8_encode(stripslashes($dob['title'])).' profile published',
									'start' => date('Y-m-d H:i:s',strtotime($dob['postdate']) + 60*60*2),
									'end' => date('Y-m-d H:i:s',strtotime($dob['postdate']) + 60*60*2),
									'type' => 'nd',
									'backgroundColor' => '#3B5998 !important',
									'className' => 'pday'
								);
							}
					}
				$sql = $this->db->query("SELECT username,dob FROM tbl_admin where dob!='0000-00-00' ORDER BY id");
				$objRecord2=$sql->result_array();
				$abirthday=array();
				foreach($objRecord2 as $key=> $dob)
					{
						if($dob['dob'] !='0000-00-00')
							{
								$date = explode('-',$dob['dob']);
								$yearBegin = date("Y")-1;
								$yearEnd = $yearBegin + 2; // edit for your needs
								$years = range($yearBegin, $yearEnd, 1);
								foreach($years as $year)
									{
										$abirthday[] = array(
											'id'    => '',
											'title' => 'Birthday of '.$dob['username'],
											'start' => $year . "-" . $date[1] . "-" . $date[2],
											'end' => $year . "-" . $date[1] . "-" . $date[2],
											'type' => 'nd',                    
												'backgroundColor' => '#C2DFF2 !important',
											'className' => 'abday'	
										);
									}
							}
					}
				
				$sql = $this->db->query("SELECT region_name,independenceday FROM tbl_regions where independenceday!='0000-00-00' ORDER BY id");
				$objRecord5=$sql->result_array();
				$independencedayd=array();
				foreach($objRecord5 as $key=> $independenceday)
					{
						$date = explode('-',$independenceday['independenceday']);
						$yearBegin = date("Y")-1;
						$yearEnd = $yearBegin + 2; // edit for your needs
						$years = range($yearBegin, $yearEnd, 1);
						foreach($years as $year)
							{
								$independencedayd[] = array(
															'id'    => '',
															'title' => 'Independence day of '.$independenceday['region_name'],
															'start' => date('Y-m-d H:i:s',strtotime($year . "-" . $date[1] . "-" . $date[2]) + 60*60*4),
															'end' => date('Y-m-d H:i:s',strtotime($year . "-" . $date[1] . "-" . $date[2]) + 60*60*4),
															'type' => 'nd','backgroundColor' => '#F3FDAE !important','className' => 'inday'	
														);
							}
					}
				$data = array_merge($objRecord,$birthday,$posdate,$abirthday,$postevents,$independencedayd);
			}
		elseif($_GET['g'] =='pastyear' && $_POST['pastyear'] == 1)
			{
				$postevents=array(); 
				$sql = $this->db->query("SELECT * FROM tbl_events where DAY(start) = '".$_POST['date']."' and MONTH(start) = '".($_POST['month']+1)."' 
				and YEAR(start) <  '".date('Y')."'  and YEAR(start) > '".(date('Y')-6)."' and YEAR(start) > '".(date("Y")-1)."'  ORDER BY id");
				$objRecord4=$sql->result_array();
				foreach($objRecord4 as $key=> $postevent)
					{if($postevent['end'] !='0000-00-00'){$postevents[date('Y-m-d',strtotime($postevent['start']))][] = array('title' => $postevent['title']);}}
					
				$sql = $this->db->query("SELECT * FROM tbl_profiles where  DAY(dob) = '".$_POST['date']."' and MONTH(dob) = '".($_POST['month']+1)."' ORDER BY id");
				$objRecord1=$sql->result_array();
				$birthday=array();
				$posdate=array();
				foreach($objRecord1 as $key=> $dob) {
						if($dob['dob'] !='0000-00-00')
							{
								$date = explode('-',$dob['dob']);
								$yearEnd = (date("Y") -1);
								$yearBegin = $yearEnd - 4; // edit for your needs
								$years = range($yearBegin, $yearEnd, 1);
						 
								foreach($years as $year)
								{
									if($year >= '2014')
									{$birthday[$year . "-" . $date[1] . "-" . $date[2]][] = array('title' => 'Birthday of '.utf8_encode(stripslashes($dob['title'])),)
									;}
								}
							}
					}
					
				$strSqlp = "SELECT * FROM tbl_profiles where   DAY(postdate) =  '".$_POST['date']."'  and MONTH(postdate) =  '".($_POST['month']+1)."'
				 and YEAR(postdate) < '".date('Y')."' and YEAR(postdate) > '".(date('Y')-6)."' and YEAR(postdate) > '".(date("Y")-1)."' ORDER BY id";
				$sql = $this->db->query($strSqlp);
				$objRecordp=$sql->result_array();
				foreach($objRecordp as $key=> $dob)
					{
						if($dob['postdate'] !='0000-00-00' && $dob->status=='4')
							{$posdate[date('Y-m-d',strtotime($dob['postdate']))][] = array('title' => utf8_encode(stripslashes($dob['title'])).' profile published');}
					}
					
				$strSql2= "SELECT username,dob FROM tbl_admin where DAY(dob) = DAY('".$_POST['date']."') and MONTH(dob) = MONTH('".($_POST['month']+1)."') ORDER BY id"; 
				$sql = $this->db->query($strSql2);
				$objRecord2=$sql->result_array();
				$abirthday=array();
				foreach($objRecord2 as $key=> $dob) {
						if($dob['dob'] !='0000-00-00')
							{
								$date = explode('-',$dob['dob']);
								$yearEnd = (date("Y")-1);
								$yearBegin = $yearEnd - 4; // edit for your needs
								$years = range($yearBegin, $yearEnd, 1);
								foreach($years as $year)
									{if($year >= date("Y")) {$abirthday[$year."-".$date[1]."-".$date[2]][] = array('title' => 'Birthday of '.$dob['username']);}}
							}
					}
				
				$strSql5= "SELECT region_name,independenceday FROM tbl_regions where DAY(independenceday) = DAY('".$_POST['date']."') 
				and MONTH(independenceday) = MONTH('".($_POST['month']+1)."') ORDER BY id"; 
				$sql = $this->db->query($strSql5);
				$objRecord5=$sql->result_array();
				$independencedayd=array();
				foreach($objRecord5 as $key=> $independenceday)
					{
						if($independenceday['independenceday'] !='0000-00-00')
							{
								$date = explode('-',$independenceday['independenceday']);
								$yearEnd = (date("Y") -1);
								$yearBegin = $yearEnd - 4; // edit for your needs
								$years = range($yearBegin, $yearEnd, 1);
								foreach($years as $year)
									{ if($year >= '2014')
										{ $independencedayd[$year . "-" . $date[1] . "-" . $date[2]][] = array(
											'title' => 'Independence day of '.$independenceday['region_name']);
										}
									}
							}
					}
				$data =array();
				for($i=1;$i<=5;$i++)
				{
					$year = (date('Y')-$i); 
					if($year >= date('Y'))
					{
						$date = date('Y-m-d',strtotime($year.'-'.($_POST['month']+1).'-'.$_POST['date'])); 
						$data[$year][]='';
						if(array_key_exists($date,$postevents)){foreach($postevents[$date] as $title){$data[$year][]=$title['title'];}}
						if(array_key_exists($date,$birthday)){foreach($birthday[$date] as $title){$data[$year][]=$title['title'];}}
						if(array_key_exists($date,$posdate)){foreach($posdate[$date] as $title){$data[$year][]=$title['title'];}}
						if(array_key_exists($date,$abirthday)){ foreach($abirthday[$date] as $title){ $data[$year][]=$title['title'];}}
						if(array_key_exists($date,$independencedayd)){foreach($independencedayd[$date] as $title){$data[$year][]=$title['title'];}}
					}
				}
				echo '<div class="row-fluid"><span class="span"></span>';
				$cht=1;
				foreach($data as $datakey=>$datavar)
					{
						?>
						<div class="span11">
							<div class="social-box">
								<div class="header"><h4><?php echo  $datakey;?></h4></div>
								<div class="body">
								<?php if(count($datavar) > 1){for($i=1;$i<count($datavar);$i++){?><p class="muted"><?php echo $datavar[$i]; ?>.</p>
								<?php } }
								else{ ?><p class="text-error">No events.</p><?php } ?></div>
							</div>
						</div>
				<?php
					} echo '</div>';
			}
		else
			{
				$events=array();
				$strSql4 = "SELECT count( * ) as count  ,start  FROM tbl_events where DATE(end) >= DATE('".date('Y-m-d')."') GROUP BY `start` ORDER BY id";  
				$sql = $this->db->query($strSql4);
				$objRecord4=$sql->result_array();
				foreach($objRecord4 as $key=> $postevent)
					{
						if($postevent['start'] !='0000-00-00')
							{
								$events[] = array(
													'title' => 'Event-'.$postevent['count'],
													'start' => $postevent['start'],
													'end' => $postevent['start'],
													'type' => 'nd',
													'backgroundColor' => '#BBE2AE !important',
													'className' => 'evtday',
													'url' =>  SITE_ADMIN_URL.'setting/calendar/go/'.strtotime($postevent['start'])
												);
							}
					}
				
				$strSql = "SELECT count(*) as count,postdate,status FROM tbl_profiles where 1=1 and postdate!='0000-00-00' and status='4' 
				GROUP BY `postdate` ORDER BY id";
				$sql = $this->db->query($strSql);
				$objRecord=$sql->result_array();
				$posdate=array();
				foreach($objRecord as $key=> $ppd)
					{
						if($ppd['postdate'] !='0000-00-00' && $ppd['status']=='4')
						{
							$posdate[] = array(
												'id'    => '',
												'title' => 'profile published-'.$ppd['count'],
												'start' => $ppd['postdate'],
												'end' => $ppd['postdate'],
												'type' => 'nd',
												'backgroundColor' => '#3B5998 !important',
												'className' => 'pday',
												'url' =>  SITE_ADMIN_URL.'setting/calendar/go/'.strtotime($postevent['postdate'])
											);
						}
					}
				$strSql1 = "SELECT count(*) as count,dob,CONCAT('0000','-',MONTH(dob),'-',DAY(dob)) as dob1 FROM tbl_profiles where 1=1 and dob!='0000-00-00' 
				GROUP BY `dob1` ORDER BY id";
				$sql = $this->db->query($strSql1);
				$objRecord1=$sql->result_array();
				$birthday=array();
				foreach($objRecord1 as $key=> $dob)
					{
						if($dob['dob'] !='0000-00-00')
							{
								$date = explode('-',$dob['dob']);
								$yearBegin = date("Y") - 1;
								$yearEnd = $yearBegin + 2; // edit for your needs
								$years = range($yearBegin, $yearEnd, 1);
								foreach($years as $year)
									{$pbirthday[$year . "-" . $date[1] . "-" . $date[2]] = array('date'=>$year."-".$date[1]."-".$date[2],'countpb' =>$dob['count']);}
							}
					}
					
				$strSql2= "SELECT count(*) as count,dob,CONCAT('0000','-',MONTH(dob),'-',DAY(dob)) as dob1 FROM tbl_admin where dob!='0000-00-00' 
				GROUP BY `dob1` ORDER BY id"; 
				$sql = $this->db->query($strSql2);
				$objRecord2=$sql->result_array();
				foreach($objRecord2 as $key=> $dob)
					{
						if($dob['dob'] !='0000-00-00')
							{
								$date = explode('-',$dob['dob']);
								$yearBegin = date("Y") - 1;
								$yearEnd = $yearBegin + 2; // edit for your needs
								$years = range($yearBegin, $yearEnd, 1);
								foreach($years as $year)
									{$abirthday[$year."-".$date[1]."-".$date[2]] =array('date'=>$year."-".$date[1]."-".$date[2],'countab' =>$dob['count']);}
							}
					}
				
				foreach($pbirthday as $key=>$value)
					{
						if(array_key_exists($key,$abirthday))
							{
								$birthday[] = array(
														'id'    => '',
														'title' => 'Birthday-'.($value['countpb'] + $abirthday[$key]['countab']),
														'start' => $key,
														'end' => $key,
														'type' => 'nd',
														'backgroundColor' => '#C2DFF2 !important',
														'className' => 'abday',
														'url' =>  SITE_ADMIN_URL.'setting/calendar/go/'.strtotime($key)
													);
								unset($abirthday[$key]);
							}
						else
							{
								$birthday[] = array(
														'id'    => '',
														'title' => 'Birthday-'.($value['countpb']),
														'start' => $key,
														'end' => $key,
														'type' => 'nd',
														'backgroundColor' => '#C2DFF2 !important',
														'className' => 'abday',
														'url' =>  SITE_ADMIN_URL.'setting/calendar/go/'.strtotime($key)
													);
							}
				}
				foreach($abirthday as $key=>$value)
					{
						$birthday[] = array(
												'id'    => '',
												'title' => 'Birthday-'.($value['countab']),
												'start' => $key,
												'end' => $key,
												'type' => 'nd',
												'backgroundColor' => '#C2DFF2 !important',
												'className' => 'abday',
												'url' =>  SITE_ADMIN_URL.'setting/calendar/go/'.strtotime($key)
											);
						unset($abirthday[$key]);
					}
				$strSql5= "SELECT count(*) as count,independenceday FROM tbl_regions where independenceday!='0000-00-00' GROUP BY independenceday ORDER BY id"; 
				$sql = $this->db->query($strSql5);
				$objRecord5=$sql->result_array();
				
				$independencedayd=array();
				foreach($objRecord5 as $key=>$independenceday)
					{
						if($independenceday['independenceday'] !='0000-00-00')
							{
								$date = explode('-',$independenceday['independenceday']);
								$yearBegin = date("Y") - 1;
								$yearEnd = $yearBegin + 2; // edit for your needs
								$years = range($yearBegin, $yearEnd, 1);
								foreach($years as $year)
									{
										$independencedayd[] = array(
																	'id'    => '',
																	'title' => 'Independence - '.$independenceday['count'],
																	'start' => $year . "-" . $date[1] . "-" . $date[2],
																	'end' => $year . "-" . $date[1] . "-" . $date[2],
																	'type' => 'nd',                    
																		'backgroundColor' => '#F3FDAE !important',
																	'className' => 'inday',
																	'url' =>  SITE_ADMIN_URL.'setting/calendar/go/'.strtotime($year."-".$date[1]."-".$date[2])
																);
									}
							}
					}
				$data = array_merge($birthday,$posdate,$events,$independencedayd);
			} 
		echo json_encode($data);
	}
    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
}
?>