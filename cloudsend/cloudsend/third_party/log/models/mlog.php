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

class mLog extends CWX_Model {
    
    public function getLog() {
	$_found = $this->db->order_by('logTime','DESC')->get('logs');
	
	if( $_found->num_rows() != 0 ) {
	    return $_found->result();
	}
	
	return false;
    }
    
    public function deleteLog( $_entry = NULL ) {
	if( isset( $_entry ) && !empty( $_entry ) ) {
	    $_where = array(
		'logUniqueID' => $_entry
	    );
	    
	    $_deleted = $this->db->where( $_where )->delete( 'logs' );
	    
	    return $_deleted;
	}
	
	return false;
    }
}