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

class Search extends CWX_Controller {
    
    public function index() {
	$_query = $this->input->post('query');
	$_redirect = $this->input->post('redirect');

	if( isset( $_query ) && !empty( $_query ) ) {
	    $_return = $this->mSearch->search( $_query );
	    
	    if( $_return != false ) {
		$this->load->model( array('user/mUser') );
		
		$_data = array(
		    'title' => __('srch_title_results'),
		    'site' => 'search/results',
		    'search' => $_query,
		    'files' => $_return,
		    'users' => $this->mUser->getAllStdUser()
		);

		$this->load->view( 'master', $_data );	
	    } else {
		redirect( 'admin/files/index?errortype=error&errormsg='.urlencode(__('srch_msg_noresults')) );
	    }
	} else {
	    redirect( $_redirect );
	}
    }
    
    public function typeahead() {
	$_query = $this->input->post('query');
	
	if( isset( $_query ) && !empty( $_query ) ) {
	    $_return = $this->mSearch->search( $_query );
	  
	    if( $_return != false ) {
		$_result = array();
		
		foreach( $_return AS $_entry ) {
		    $_result[] = $_entry->fileName;
		}

		if( count( $_result ) != 0 ) {
		    $this->output
			    ->set_content_type( 'application/json' )
			    ->set_output( json_encode( $_result ) );
		}
	    } 
	} 
	
    }
    
}