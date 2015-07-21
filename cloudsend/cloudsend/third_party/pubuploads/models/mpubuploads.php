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

class mPubuploads extends CWX_Model {
    
    public function getUploads() {
	$this->db->select('r.*, u.companyName'); 
	$this->db->from('uploads AS r'); 
	$this->db->join('user AS u', 'r.userUniqueID = u.userUniqueID', 'left'); 
	$_found = $this->db->get();

	
	if( $_found->num_rows() != 0 ) {
	    return $_found->result();
	}
	
	return false;
    }
    
    public function getUpload( $_entry = NULL ) {
	if( $_entry != NULL && !empty( $_entry ) ) {
	    $_where = array(
		'uploadUniqueID ' => $_entry
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
    
    public function getUploadByUUID( $_entry = NULL ) {
	if( $_entry != NULL && !empty( $_entry ) ) {
	    $_where = array(
		'uploadUUID' => $_entry
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
    
    public function createUpload( $_insert = array() ) {
	if( isset( $_insert ) && is_array( $_insert ) && count( $_insert ) != 0 ) {
	    $_standards = array(
		'id' => NULL,
		'uploadUniqueID' => uniqid( 'upl_', true ),
		'userUniqueID' => $this->session->userdata('userUnique'),
		'published' => '1'
	    );
	    
	    $_insert = array_merge( $_insert, $_standards );
	    
	    $_inserted = $this->db->insert( 'uploads', $_insert );
	    
	    return $_inserted;
	} 
	
	return false;
    }

    public function editUpload( $_entry = NULL, $_description = NULL, $_folder = NULL ) {
	if( isset( $_entry ) && !empty( $_entry ) && isset( $_description ) && isset( $_folder ) ) {
	    $_where = array(
		'uploadUniqueID' => $_entry
	    );
	    
	    $_udpate = array(
		'uploadMessage' => $_description,
                'defaultFolderID' => $_folder
	    );
	    	    
	    $_updated = $this->db->where( $_where )->update( 'uploads', $_udpate );
	    
	    return $_updated;
	} 
	
	return false;
    }    
    
    public function setPublishedEntry( $_set, $_unique ) {
        $_where = array(
	    'uploadUniqueID ' => $_unique
	);

	$_update = array(
	    'published' => $_set  
	);
	
	$_updated = $this->db->where( $_where )->update( 'uploads', $_update );

	return $_updated;
	
    }
    
    public function deleteEntry( $_entry ) {
	$_where = array(
	    'uploadUniqueID' => $_entry
	);
	
	$_deleted = $this->db->where( $_where )->delete( 'uploads' );
	
	return $_deleted;
    }
    
}