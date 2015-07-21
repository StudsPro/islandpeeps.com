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

class Publinks extends CWX_Controller {
        
    public function index() {
		redirect( 'admin/publinks/all_entries' );
    }
    
    public function all_entries() {
		$this->load->model('user/mUser');
		
		$errortype = isset($_GET['errortype']) ? $_GET['errortype'] : false;
		$errormsg = isset($_GET['errormsg']) ? urldecode( $_GET['errormsg'] ) : '';
					
		$_data = array(
		    'errortype' => $errortype,
		    'errormsg' => $errormsg,
		    'site' => 'publinks/all_entries',
		    'title' => __('pub_title_publiclinks'),
		    'items' => $this->mPublinks->getLinks()
		);
	    
		$this->load->view( 'master', $_data );	
    }
   
    
    public function edit_entry( $errortype = false, $errormsg = '', $_edit_user = NULL ) {
		$this->load->model('user/mUser');
		$this->load->helper( array( 'form' ) );

		$_entry = $this->input->get('entry');
        
        if( preg_match( "/^(pub_)[a-z0-9]{14}.[a-z0-9]{8}/", $_entry ) ) {
		
            $_data = array(
                'errortype' => $errortype,
                'errormsg' => $errormsg,
                'site' => 'publinks/edit_entry',
                'title' => __('pub_title_editpublink'),
                'details' => $this->mPublinks->getEntry( $_entry ),
                'files' => $this->mPublinks->getEntryFiles( $_entry )
            );

            $this->load->view( 'master', $_data );
	
        } else {
            redirect('admin/publinks/all_entries?errortype=error&errormsg='.urlencode( __('pub_msg_argumenterror') ));
        }
    }
    
    public function delete_entry() {
		$_entry = $this->input->get( 'entry' );
		
		if( isset( $_entry ) && !empty( $_entry ) ) {
		    if( $this->mPublinks->deleteEntry( $_entry ) ) {	
			$this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' has removed public link '{$_entry}'.", 'size' => NULL ) );
			redirect('admin/publinks/all_entries?errortype=success&errormsg='.urlencode( __('pub_msg_entryremovesuccess') ));		
		    } else {
			$this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried to remove public link '{$_entry}' but a database error occured.", 'size' => NULL ) );
			redirect('admin/publinks/all_entries?errortype=error&errormsg='.urlencode( __('pub_msg_dberrror') ));
		    }
		} else {
		    $this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried to remove public link '{$_entry}' but a parameter error occured.", 'size' => NULL ) );
		    redirect('admin/publinks/all_entries?errortype=error&errormsg='.urlencode( __('pub_msg_argumenterror') ));
		}	
    }    

        
    public function published_entry() {
		$_is = $this->input->get( 'is' );
		$_entry = $this->input->get( 'entry' );
		
		if( isset( $_is ) && isset( $_entry ) && !empty( $_entry ) ) {
		    if( $_is == '1' ) {
			$_set = '0';
		    } else {
			$_set = '1';
		    }
		    	    
		    if( $this->mPublinks->setPublishedEntry( $_set, $_entry ) ) {
			$this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' has changed the publish state of link '{$_entry}' to '{$_set}'.", 'size' => NULL ) );
			redirect( 'admin/publinks/all_entries?errortype=success&errormsg='.urlencode( __('pub_msg_statuschangesuccess') ) );
		    } else {
			$this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried to change publish state of link '{$_entry}' to '{$_set}' but a database error occured.", 'size' => NULL ) );
			redirect( 'admin/publinks/all_entries?errortype=error&errormsg='.urlencode( __('pub_msg_statuschangeerror') ) );
		    }
		} else {
		    $this->mGlobal->log( array( 'type' => "error", 'message' => "User '{$this->session->userdata['companyName']}' tried to change publish state of link '{$_entry}' to '{$_set}' but parameter error occured.", 'size' => NULL ) );
		    redirect( 'admin/publinks/all_entries?errortype=error&errormsg='.urlencode( __('pub_msg_erroroccured') ) );
		}
    }
  
}