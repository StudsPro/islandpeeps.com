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

class mRequest extends CWX_Model {
    
    public function getUploadByUUID( $_entry = NULL ) {
	if( $_entry != NULL && !empty( $_entry ) ) {
	    $_where = array(
		'uploadUUID' => $_entry,
		'published' => '1'
	    );

	    $_found = $this->db->where( $_where )->get( 'uploads' );

	    if( $_found->num_rows() == 1 ) {
		return $_found->row();
	    } else {
		return false;
	    }
	} else {
	    return false;
	}
    }    

}