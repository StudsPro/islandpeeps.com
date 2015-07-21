<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * CloudSend
 *
 * @package    CloudSend
 * @author     codingking.co
 * @copyright  Copyright (c) 2013 codingking.co - all rights reserved
 * @license    Commercial
 * @link       http://www.codingking.co/
 * 
 * 
 * This source file is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
 * or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.
 */
?>
<div class="container" id="logs">
    <div class="row" id="logsOverview">
	<div class="span12">
	    <div class="page-header">
		<h3><?php echo __('log_head_overview') ?></h3>
	    </div>
	    <blockquote>
		<p><?php echo __('log_desc_overview') ?></p>
	    </blockquote>
	    <br />
	<?php if( $entries != false ): ?>
    	    <form class="form-horizontal" id="logForm">
		<fieldset>
	    
		    <table class="table table-striped table-condensed" id="logTable">
			<colgroup>
			    <col style="width:6%" />
			    <col style="width:12%" />
			    <col style="width:72%" />
			    <col style="width:15%" />
			</colgroup>			
			<thead>
			    <tr>
				<th><center><input type="checkbox" class="checkall" /></center></th>
				<th><?php echo __('log_lsttit_time') ?></th>
				<th><?php echo __('log_lsttit_file') ?></th>
				<th><?php echo __('log_lsttit_size') ?></th>
			    </tr>
			</thead>
			<tbody>
			    <?php foreach( $entries AS $entry ): ?>
			    <?php
				switch( $entry->logType ) {
				    case 'info':
					$typeClass = 'info';
					break;
				    case 'error':
					$typeClass = 'important';
					break;
				    case 'down':
					$typeClass = 'success';
					break;
				    default:
					$typeClass = 'info';
					break;
				}
			    ?>
			    <tr>
				<td><center><input type="checkbox" name="oneentry[]" value="<?php echo $entry->logUniqueID ?>" class="oneentry" /></center></td>
				<td><?php echo cvTZ( $entry->logTime ) ?></td>
                                <td><span class="label label-<?php echo $typeClass ?>"><?php echo strtoupper( $entry->logType ) ?></span> <?php echo $entry->logMessage ?></td>
				<td><?php if( $entry->logSize != NULL ): echo roundsize( $entry->logSize ); else: echo __('log_msg_na'); endif; ?></td>
			    </tr>
			    <?php endforeach; ?>
			</tbody>
		    </table>
		    
		    <div class="markcontrols" style="margin-top:30px;">
			<div class="control-group">
			    <label class="control-label" for="doAction" style="text-align:left;width:65px;"><?php echo __('log_lbl_selected') ?></label>
			    <div class="controls" style="margin-left:80px;">
				<select name="doAction" id="doAction" disabled="disabled">
				    <option value="none"><?php echo __('log_sel_pleasechoose') ?></option>
				    <option value="delete"><?php echo __('log_sel_delete') ?></option>
				</select>
			    </div>
			</div>
		    </div>
		</fieldset>
	    </form>
	<?php else: ?>
	    <div class="alert">
		<?php echo __('log_msg_noentriesinsystem') ?>
	    </div>
	<?php endif; ?>
	</div>
	
    </div>    
</div>	    
<div class="modal hide" id="deleteEntries">
    <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h3><?php echo __('log_head_delete') ?></h3>
    </div>
    <div class="modal-body">
	<div class="alert alert-error hidden"></div>			    
	<p><?php echo __('log_desc_delete') ?></p>
    </div>
    <div class="modal-footer">
	<span class="mod-left hidden"></span>
	<a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('log_btn_cancel') ?></a>
	<a href="#" class="btn btn-danger" id="deleteLogs"><?php echo __('log_btn_delete') ?></a>
    </div>
</div>		    

<script src="<?php echo base_url() ?>assets/scripts/libs/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {    
    $('.checkall').click(function () {
        $(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
    });
    
    var oTable = $('#logTable').dataTable({
	"bFilter": false,"bInfo": false,
	"bLengthChange": false,
	"oLanguage" : {
	    "sProcessing":   "<?php echo __('datatbl_sProcessing') ?>",
	    "sLengthMenu":   "<?php echo __('datatbl_sLengthMenu') ?>",
	    "sZeroRecords":  "<?php echo __('datatbl_sZeroRecords') ?>",
	    "sInfo":         "<?php echo __('datatbl_sInfo') ?>",
	    "sInfoEmpty":    "<?php echo __('datatbl_sInfoEmpty') ?>",
	    "sInfoFiltered": "<?php echo __('datatbl_sInfoFiltered') ?>",
	    "sInfoPostFix":  "<?php echo __('datatbl_sInfoPostFix') ?>",
	    "sSearch":       "<?php echo __('datatbl_sSearch') ?>",
	    "oPaginate": {
		"sFirst":    "<?php echo __('datatbl_sFirst') ?>",
		"sPrevious": "<?php echo __('datatbl_sPrevious') ?>",
		"sNext":     "<?php echo __('datatbl_sNext') ?>",
		"sLast":     "<?php echo __('datatbl_sLast') ?>"
	    }
	}
    }); 
    
    $('.oneentry,.checkall').click(function() {
	setMarked();
    });
        
    function setMarked() {
	if( $('.oneentry:checked').length ) {
	    $('#doAction').removeAttr('disabled');
	} else {
	    $('#doAction').removeAttr('disabled').attr('disabled','disabled').val('none');
	}	
    }
    

    $('#doAction').change(function(e) {
	e.preventDefault();
	var val = $(this).val();
	if( val == 'delete' ) {
	    $('#deleteEntries').modal('show');
	}
	$(this).val('none');
    });
        
    $('#deleteLogs').click(function(e) {
	e.preventDefault();
	var data = $('#logForm').serialize();
	
	$.getJSON( '<?php echo site_url( 'admin/log/delentries' ) ?>', data, function( info ) {
	    if( info.type == 'success' ) {
		$('.oneentry').each(function() {
		    if( $(this).is(':checked') ) {
			var row = $(this).closest("tr").get(0);
			oTable.fnDeleteRow(oTable.fnGetPosition(row));
		    }
		});	
		setMarked();
	    }
	    infoWindow( 'deleteEntries', info );
	} );
    });
    
    function infoWindow( id, info ) {
	$('#'+id).modal('hide');
	$('#infoWindow .modal-header h3').html('').html( info.type );
	$('#infoWindow .modal-body p').html('').html( info.message );
	$('#infoWindow').modal('show');   
    }
    
    setMarked();
});  
</script>