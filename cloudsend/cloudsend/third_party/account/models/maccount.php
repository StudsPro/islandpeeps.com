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

class mAccount extends CWX_Model {
    
    public function validateLogin() {
	
	$_query = 'SELECT * FROM {TRANS}user 
		    WHERE emailAddress = "'.$this->input->post( 'inputEmail' ).'" 
		    AND password = "'.md5( $this->input->post( 'inputPassword') ).'" 
		    AND level <= "2" 
		    AND published = "1" 
		    AND ( expire = 0 OR expire > "'.time().'" )'; 
//	echo $_query;exit;
	$_found = $this->db->query( $_query );
 

	if( $_found->num_rows() == 1 ) {
	    return $_found->row();
	} else {
	    return false;
	}
    }
    
}