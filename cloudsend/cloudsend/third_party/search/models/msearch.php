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

class mSearch extends CWX_Model {
    
    public function search( $_query ) {
	
	$_query = 'SELECT * 
		    FROM {TRANS}files 
		    WHERE LOWER(fileName) LIKE \'%'.strtolower( $_query ).'%\' 
		    OR LOWER(fileDescription) LIKE \'%'.strtolower( $_query ).'%\' 
		    OR LOWER(fileTags) LIKE \'%'.strtolower( $_query ).'%\'';
	
	$_results = $this->db->query( $_query );
	
	if( $_results->num_rows() != 0 ) {
	    return $_results->result();
	}
	
	return false;
	
    }
    
}