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
class mGlobal extends CWX_Model {
    
    public function getConfig( $_var = NULL ) {
	
	if( isset( $_var ) && !empty( $_var ) ) {
	    $_where = array(
		'configVar' => $_var
	    );
	}
	
	$_found = $this->db->where( $_where )->get( 'config', 1 );

	if( $_found->num_rows() == 1 ) {
	    return $_found->row();
	}
	
	return false;
	
    }
    
    public function log( $_data = array() ) {
	if( isset( $_data ) && is_array( $_data ) && count( $_data ) >= 3 ) {
	    
	    $_ip = NULL;
	    if ( isset($_SERVER["REMOTE_ADDR"]) )    {
		$_ip = $_SERVER["REMOTE_ADDR"];
	    } else if ( isset($_SERVER["HTTP_X_FORWARDED_FOR"]) )    {
		$_ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	    } else if ( isset($_SERVER["HTTP_CLIENT_IP"]) )    {
		$_ip = $_SERVER["HTTP_CLIENT_IP"];
	    } 	    
	    
	    $_browser = $_SERVER['HTTP_USER_AGENT'];
	    
	    $_insert = array(
		'id' => NULL,
		'logUniqueID' => uniqid( 'log_', true ),
		'logType' => $_data['type'],
		'logMessage' => $_data['message'],
		'logTime' => time(),
		'logIP' => $_ip,
		'logBrowser' => $_browser,
		'logSize' => $_data['size']
	    );
	    
	    if( isset( $_data['data'] ) && !empty( $_data['data'] ) ) {
		$_insert['logDataID'] = $_data['data'];
	    } else {
		$_insert['logDataID'] = (isset($this->session->userdata['userUnique'])) ? $this->session->userdata['userUnique'] : NULL;
	    }
	    
	    $_inserted = $this->db->insert( 'logs', $_insert );

	    return $_inserted;
	}
	
	return false;
    }
    
}