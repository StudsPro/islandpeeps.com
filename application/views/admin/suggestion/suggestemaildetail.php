<?php
$write=affilateright("suggestion","write");
$read=affilateright("suggestion","read");

?>
<div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-title"><?=$page_title;?></h3>
              <!--<ul class="breadcrumb breadcrumb-arrows breadcrumb-default">
                <li><a href="<?=SITE_ADMIN_URL;?>"><i class="fa fa-home fa-lg"></i></a></li>
                <li><a href="#ignore">Country(s) Listing  </a></li>
               </ul> -->
               
                <?php echo $breadcrumds;?>
            </div>
          </div>
        </div>
		
 <div class="container">
           <?php 
					 if($this->session->flashdata('error')) 
                     { ?> <div class="alert alert-danger"> <?php echo $this->session->flashdata('error');  ?></div><?php	} 
					  //$success = $this->session->flashdata('item'); 
					  if($this->session->flashdata('sucess')) { ?>
					  <div class="alert alert-success"> <?php echo $this->session->flashdata('sucess')  ?></div>
					 <?php } ?>
					
           
           
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                  
                 <div class="panel-heading">    
                  <div class="col-md-9"><b>Suggested Profiles </b></div>
                  <div class="col-md-3 text-right">
                  </div>
                 </div> 
            <div class="panel-body">
             <table id="newtable" class="table table-striped table-bordered dataTable no-footer">
                    <thead>
                      <tr>
                       	<th width="10%" data-type="numeric" data-sort-initial="true">S.No</th>
                        <th width="15%">Profile Title</th>
                        <th width="10%">User Kind</th>
                        <th width="20%">Region</th>
                        <th width="10%">User Name</th>
                        <th width="5%">Email</th>  
                     </tr>
                    </thead>
                    <tbody>
                      <?php
                       $i=0;
                       if(!empty($emails))
                       {
                        
                        
                      ?>
                     <?php
                        foreach($emails as $key => $objRow)
                        {
                            $i++;
                       ?>
                                       <tr>
                                    		<td><?php echo $i;?></td>
											<td><?php 
                                            $de = mb_detect_encoding($objRow['title'], "UTF-8,ISO-8859-1");
			                                 $de = iconv($de, "UTF-8", $objRow['title']);
		                                      echo  stripslashes(html_entity_decode($de, ENT_QUOTES));
                                            
                                            ?></td>
                                             <?php $colrk = array('People profile'=>'success','Fun facts'=>'info','Me Me' => 'danger');?>
	    <td><button class="label btn-mini btn-<?php echo $colrk[$objRow["kind"]];?>" type="button"><?php echo $objRow["kind"];?></button></td>
                                            <td>
                                            
                                            <?php 
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
                                             echo $strregion;
                                            
                                            ?>
                                            
                                            </td>
                                            <td><?php echo $objRow['gname'];?></td>
                                            <td>
                                            <?php echo $objRow['email'];?>
                                            </td>
                                 </tr>
                      <?php
                              }
                         }
                      ?> 
                    </tbody>
                    </table></div> 
                  </div> 
            </div>
          </div>
        </div>
			 <!--main content   -->
              <?php 
   
   $admininfo=get_admininfo(); 
    $perpage=($admininfo["masterlistperpage"]) ? $admininfo["masterlistperpage"] :'50';
   ?>  
   
   
  
    
 <script>
  function downloadpdf()
 {
    window.location.href='<?=SITE_ADMIN_URL;?>/suggestion/downloadpdf';
    
 }
 $(function() { 
       // Tables.initDynamicTables();
   $("#newtable").dataTable({
      "sDom": "<'row' <'col-xs-5'l><'col-xs-4'f>r>t<'row'<'col-xs-6'i><'col-xs-3'p> >",
      "aaSorting": [[2, "desc"]],
      "pageLength": 5,
       stateSave:true,
	   "stateDuration": 60 * 60 * 24,
        "iDisplayLength": <?php echo $perpage;?>,
        "bPaginate": true,
        responsive: true
      
    });
    
    $( "#fillter" ).change(function() {

    window.location.href='<?php echo base_url()."admin/suggestion/index/"?>'+this.value;
});
  
      });
    </script>				
 