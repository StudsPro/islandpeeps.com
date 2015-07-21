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
                        
                    <?php
                     if($this->session->userdata('sadmin') == '1')
                     {
                        
                       
                     ?>
                      <div class="btn-group master-btn">
                        <button data-toggle="dropdown" class="btn dropdown-toggle" ><i class="fa fa-cog"></i></button>
                        <ul class="dropdown-menu pull-right">
                        <!--   <li><a href="javascript:void(0)">Print</a></li> -->
                          <li><a href="javascript:void(0);" onclick="downloadpdf();">Save as PDF</a></li>
                          
                        <?php
                         if(!empty($suggestionemails))
                        {
                             $filename="suggection_".$this->session->userdata('sadmin').".txt"; 
                        ?> 
                          <li class="divider"></li>
                         <li><a href="<?=SITE_ADMIN_URL;?>suggestion/downloadtxt/<?php echo $filename; ?>">Export to CSV</a></li>
                        <?php
                        }
                        ?>
                        </ul>
                    
                    </div>
                    <?php
                    }
                    ?>
                    
                  </div>
                 </div> 
            <div class="panel-body">
            <table id="newtable"  class="table table-striped table-bordered dataTable no-footer dt-responsive" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                       	<th width="10%" data-type="numeric" data-sort-initial="true">S.No</th>
                        <th width="15%">Email</th>
                        <th width="10%">Count</th>
                      
                     </tr>
                    </thead>
                    <tbody>
                      <?php
                       $i=0;
                       if(!empty($suggestionemails))
                       {
                        $csv="";
                        $totalmail=count($suggestionemails);
                        $counter=1;
                         foreach($suggestionemails as $getmailid => $getdetails)
                         {
                            $i++;
                          if($counter < $totalmail)
                          {
                            $str=",";
                          }else{
                            $str="";
                          }  
                           $csv.= $getmailid.$str; //Append data to csv
                      ?>
                                   <tr>
                                    		<td><?php echo $i;?></td>
										    <td><?php echo $getmailid ;?></td>
                                            <td>
                                            
                                           <a href="<?=SITE_ADMIN_URL;?>suggestion/suggestemaildetail/<?=$getdetails[0]["id"];?>">
                                            <?php   echo count($getdetails);?>
                                            </a>  
                                            </td>
                                 </tr>
                      <?php
                         $counter++;
                         }
                        
                         $csv_handler = fopen ($filename,'w');
                        fwrite ($csv_handler,$csv);
                        fclose ($csv_handler);
                      }
                      ?> 
                    </tbody>
                    </table> 
                  
              
                 </div> 
                       
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
    window.location.href='<?=SITE_ADMIN_URL;?>suggestion/downloadpdf';
    
 }
 $(document).ready(function() {
       // Tables.initDynamicTables();
    $("#newtable").DataTable({
      "sDom": "<'row' <'col-xs-7'l><'col-xs-4'f>r>t<'row'<'col-xs-4'i><'col-xs-6'p> >",
      "aaSorting": [[2, "desc"]],
      "pageLength": 5,
       stateSave:true,
	   "stateDuration": 60 * 60 * 24,
        "iDisplayLength": <?php echo $perpage;?>,
        //"bPaginate": true,
        "bLengthChange": true, 
        responsive: true,
        	"language": {
			"lengthMenu": "_MENU_ <span class='hidden-xs'>records per page </span>"
	   } 
    });
    
    $( "#fillter" ).change(function() {

    window.location.href='<?php echo base_url()."admin/suggestion/index/"?>'+this.value;
});
  
      });
    </script>				
 