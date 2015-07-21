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

class mSettings extends CWX_Model {
    
    public function loadSettings( $_area = NULL ) {
	if( !empty( $_area ) ) {
	    $_where = array(
		'configSection' => $_area
	    );
	    
	    $_found = $this->db->where( $_where )->order_by( 'ordering', 'ASC' )->get( 'config' );
	    
	    if( $_found->num_rows() != 0 ) {
		return $_found->result();
	    }
	}
	
	return false;
    }
    
    public function updateSettings( $_updates = array() ) {
	if( is_array( $_updates ) && count( $_updates ) != 0 ) {
	    $_section = $_updates['section'];
	    $_return = true;
	    
	    foreach( $_updates['inputSetting'] AS $_key => $_value ) {
		$_where = array(
		    'configSection' => trim( $_section ),
		    'configVar' => trim( $_key )
		);
		
		if( $_key == 'GOOGLE_ANALYTICS' ) {
		    $_value = preg_replace( '/\[removed\]/', '<script>', $_value, 1);
		    $_value = preg_replace( '/\[removed\]/', '</script>', $_value, 1);
		    $_set = array(
			'configVal' => trim( $_value )
		    );
		} else {
		    $_set = array(
			'configVal' => trim( $_value )
		    );		    
		}
		
		$_updater = $this->db->where( $_where )->update( 'config', $_set );
		
		if( !$_updater ) $_return = false;
	    } 
	    
	    return $_return;
	}
	
	return false;
    }
    
}