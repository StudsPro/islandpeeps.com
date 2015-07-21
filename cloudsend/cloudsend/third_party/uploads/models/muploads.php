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

class mUploads extends CWX_Model {
    
    public function latestImportID() {
	$_query = 'SELECT DISTINCT fileImportID 
		    FROM {TRANS}files 
		    ORDER BY fileImportID DESC 
		    LIMIT 1';
	
	$_found = $this->db->query( $_query );
	
	if( $_found->num_rows() == 1 ) {
	    return $_found->row();
	}
	
	return false;
    }
    
    public function latestFiles( $latestID = NULL ) {
	
	if( isset( $latestID ) && !empty( $latestID) && $latestID != false ) {
	    $_where['fileImportID'] = $latestID;
	    
	    $_found = $this->db->where( $_where )->order_by( 'fileName', 'ASC' )->get( 'files' );
	    
	    if( $_found->num_rows() != 0 ) {
		return $_found->result();
	    }
	}
	
	return false;
    }
    
    public function getImports() {
	
	$_query = 'SELECT DISTINCT( f.fileImportID ) AS fileID, f.fileTime, f.fileUploadBy, f.uploadRequest, u.companyName, u.userUniqueID  
		    FROM {TRANS}files f 
		    LEFT JOIN {TRANS}user u 
		    ON f.fileUploadBy = u.userUniqueID 
		    GROUP BY f.fileImportID 
		    ORDER BY fileTime DESC';
	
	$_found = $this->db->query( $_query );
	
	if( $_found->num_rows() != 0 ) {
	    return $_found->result();
	}
	
	return false;
    } 
}