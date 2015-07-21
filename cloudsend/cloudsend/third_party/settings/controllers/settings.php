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

class Settings extends CWX_Controller {
    
    public function __construct() {
	parent::__construct();
	
	if( $this->session->userdata['level'] != '1' ) {
	    redirect( 'dashboard/access' );
	}
	
	$this->parts = array( 'general', 'email', 'templates', 'thumbnails', 'downloads' );
    }
	
    public function index( $_errortype = false, $_errormsg = '' ) {
	$this->load->helper(array('form','directory')); // UPDATE: v 1.2
	
	$_part = $this->input->get('part');

	if( !isset( $_part ) OR empty( $_part ) OR $_part == 'index' ) {
	    $_part = 'general';
	} 
	
	if( !in_array( $_part, $this->parts ) ) {
	    show_404();
	    exit;
	}
	
	$errortype = isset($_GET['errortype']) ? $_GET['errortype'] : ( ( $_errortype != false ) ? $_errortype : false );
	$errormsg = isset($_GET['errormsg']) ? urldecode( $_GET['errormsg'] ) : ( ( $_errortype != false ) ? urldecode( $_errormsg ) : '' );
	
	$_data = array(
	    'errortype' => $errortype,
	    'errormsg' => $errormsg,
	    'title' => __('set_title_settings'),
	    'site' => 'settings/index',
	    'section' => $_part,
	    'parts' => $this->parts,
	    'settings' => $this->mSettings->loadSettings( $_part )
	);
    
	$this->load->view( 'master', $_data );
    
    }
    
    public function verify() {
	$this->load->library('form_validation');
	$_section = $this->input->post('section');
	
	if( $_section == 'general' ) {
	    $_function = 'index';
	} else {
	    $_function = $_section;
	}
	
	if( isset( $_section ) && in_array( $_section, $this->parts ) ) {
	    $_old_settings = $this->mSettings->loadSettings( $_section );
	    
	    $config = array();
	    foreach( $_old_settings AS $_old ) {
		if( $_old->configNeeded == '1' ) {
		    $config[] = array( 'field' => 'inputSetting['.$_old->configVar.']', 'label' => __('set_lbl_'.strtolower( $_old->configVar) ), 'rules' => 'trim|required' );
		}
	    }
	    
	    $this->form_validation->set_rules( $config );
	    
	    if( $this->form_validation->run( $this ) == FALSE ) {
		$errortype = 'error';
		$errormsg = validation_errors( ' ','<br />' );
		$this->$_function( $errortype, $errormsg );
	    } else {
		$_postVars = $this->input->post( NULL, TRUE );
		
		$_updates = $this->mSettings->updateSettings( $_postVars );

		if( $_updates ) {
		    $this->mGlobal->log( array( 'type' => "info", 'message' => "User '{$this->session->userdata['companyName']}' changed settings in area '{$_function}'.", 'size' => NULL ) );
		    $errortype = 'success';
		    $errormsg = __('set_msg_editsuccess');
		    redirect( 'admin/settings?part='.$_function.'&errortype='.$errortype.'&errormsg='.urlencode( $errormsg ) );
		} else {
		    $errortype = 'error';
		    $errormsg = __('set_msg_editerror');
		    $this->$_function( $errortype, $errormsg );		    
		}
	    }
	}
    }
        
}