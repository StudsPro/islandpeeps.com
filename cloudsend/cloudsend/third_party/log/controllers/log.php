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

class Log extends CWX_Controller {
    
    public function index() {
	$errortype = isset($_GET['errortype']) ? $_GET['errortype'] : false;
	$errormsg = isset($_GET['errormsg']) ? urldecode( $_GET['errormsg'] ) : '';
	
        $_data = array(
	    'errortype' => $errortype,
	    'errormsg' => $errormsg,
	    'title' => __('log_title_log'),
	    'site' => 'log/index',
	    'entries' => $this->mLog->getLog()
	);
    
	$this->load->view( 'master', $_data );	
	
    }
    
    public function delentries() {
	$_return = array();
	
	if( $this->input->is_ajax_request() ) {
	    $_all_get = $this->input->get(NULL, TRUE);
	    	    
	    if( count( $_all_get['oneentry'] ) != 0 ) {
		$_error = false;

		for( $i = 0; $i < count( $_all_get['oneentry'] ); $i++ ) {
		    $_delete = $this->mLog->deleteLog( $_all_get['oneentry'][$i] );
		    if( !$_delete ) {
			$_error = true;
		    } 
		}
		
		if( $_error ) {
		    $_return = array(
			'type' => 'error',
			'message' => __('log_msg_deleteproblems')
		    );
		} else {
		    $_return = array(
			'type' => 'success',
			'message' => __('log_msg_deletesuccess')
		    );		   
		}
		
	    } else {
		$_return = array(
		    'type' => 'error',
		    'message' => __('log_msg_requesterror')
		);		
	    }
	} else {
	    $_return = array(
		'type' => 'error',
		'message' => __('log_msg_noajaxrequest')
	    );
	}
	
	$this->output
		->set_content_type( 'application/json' )
		->set_output( json_encode( $_return ) );
	
    }
    
}