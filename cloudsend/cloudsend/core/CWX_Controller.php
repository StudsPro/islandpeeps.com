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

/* load the MX_Controller class */
require APPPATH."third_party/MX/Controller.php";

class CWX_Controller extends MX_Controller {
	
    public $_thisclass;

    public function CWX_Controller() {	
    	$_uri_string = uri_string();
    	$_uri_string = strtolower( $_uri_string );

    	if( $_uri_string != 'admin/folder' AND $_uri_string != 'admin/folder/' AND 
    		$_uri_string != 'admin/folder/index' AND $_uri_string != 'admin/folder/index#' ) $this->session->unset_userdata( 'folderUniqueID' );
		$this->logdata = (object)$this->session->all_userdata();
		
		$thisclass = $this->router->class;

		$this->_thisclass = $thisclass;

		if( strtolower($this->_thisclass) != 'account' && strtolower($this->_thisclass) != 'publiclib' && strtolower($this->_thisclass) != 'frontend' && strtolower( $this->_thisclass ) != 'request' ) {
		    $this->session->unset_userdata('fileByRequest');
		    $_userUnique = $this->session->userdata('userUnique');
		    
		    if(!isset($this->logdata->is_logged_in) OR (bool)$this->logdata->is_logged_in != true ) {
				date_default_timezone_set( 'America/Los_Angeles' );
				redirect('admin/account/login');
		    } else {
				if( !isset( $_userUnique ) OR empty( $_userUnique ) ) redirect( 'admin/account/logout' );
				$_timeZone = $this->logdata->timeZone;
				date_default_timezone_set( $_timeZone );
		    }
		}

		$thismodel = 'm'.ucfirst($thisclass);

		if(file_exists(APPPATH."models/".strtolower($thismodel).EXT)) {
		    $this->load->model($thismodel);
		} else if(file_exists(APPPATH."third_party/".$thisclass."/models/".strtolower($thismodel).EXT)) {
		    $this->load->model($thismodel);
		}
    }

}