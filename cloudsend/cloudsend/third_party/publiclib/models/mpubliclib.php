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

class mPubliclib extends CWX_Model {
    
    public function getEntry( $_entry = NULL ) {
		if( $_entry != NULL && !empty( $_entry ) ) {
		    
		    $_query = 'SELECT * 
				FROM {TRANS}publics 
				WHERE publicUUID = "'.$_entry.'" 
				AND ( 
				    publicLimit IS NULL 
				    OR publicLimit = 0 
				    OR publicLimit >= '.time().' 
				) 
				AND published = "1"';
		    
		    $_found = $this->db->query( $_query );
		    
		    if( $_found->num_rows() == 1 ) {
			return $_found->row();
		    } else {
			return false;
		    }
		} else {
		    return false;
		}
    }
    
    public function getEntryFiles( $_entry = NULL ) {
		if( $_entry != NULL && !empty( $_entry ) ) {
		    
		    $_query = 'SELECT df.*, f.fileName, f.fileUniqueID, f.fileDescription, f.fileNewName, f.fileSize 
				FROM {TRANS}public2file df 
				LEFT JOIN {TRANS}files f 
				ON df.fileUniqueID = f.fileUniqueID 
				WHERE df.publicUniqueID = "'.$_entry.'" 
				AND ( 
				    df.allowedCount IS NULL 
				    OR  df.downloadCount IS NULL 
				    OR  df.allowedCount = 0 
				    OR  df.downloadCount <= df.allowedCount 
				)';

		    $_found = $this->db->query( $_query );

		    if( $_found->num_rows() != 0 ) {
				return $_found->result();
		    } else {
				return false;
		    }
		} else {
		    return false;
		}
    }

    public function getEntryFilesDownload( $_entry = NULL, $_public = NULL ) {
		if( $_entry != NULL && !empty( $_entry ) && $_public != NULL && !empty( $_public ) ) {
		    
		    $_query = 'SELECT df.*, f.fileName, f.fileUniqueID, f.fileDescription, f.fileNewName, f.fileSize 
				FROM {TRANS}public2file df 
				LEFT JOIN {TRANS}files f 
				ON df.fileUniqueID = f.fileUniqueID 
				WHERE df.fileUniqueID = "'.$_entry.'" 
				AND df.publicUniqueID = "'.$_public.'" 
				AND ( 
				    df.allowedCount IS NULL 
				    OR  df.downloadCount IS NULL 
				    OR  df.allowedCount = 0 
				    OR  df.downloadCount < df.allowedCount 
				)';

		    $_found = $this->db->query( $_query );

		    if( $_found->num_rows() == 1 ) {
				return $_found->row();
		    } else {
				return false;
		    }
		} else {
		    return false;
		}
    }

    
    public function fileDetails( $_file = NULL ) {
		if( $_file != NULL && !empty( $_file ) ) {
		    
		    $_where = array(
			'fileUniqueID' => $_file
		    );
		    
		    $_found = $this->db->where( $_where )->get( 'files' );
		    
		    if( $_found->num_rows() == 1 ) {
			return $_found->row();
		    }
		    
		} else {
		    return false;
		}
    }
    
    public function verifyPassword() {
		$_where = array(
		    'publicUUID' => $this->input->post('linkid'),
		    'publicPassword' => md5( $this->input->post('inputPassword') )
		);
		
		$_found = $this->db->where( $_where )->get( 'publics' );
		
		if( $_found->num_rows() == 1 ) {
		    return true;
		}
		
		return false;
    }
    
    public function updateFileCount( $_file = NULL, $_table = 'files', $_field = 'fileCounter' ) {
		if( isset( $_file ) && !empty( $_file ) ) {
		    
		    $_query = 'UPDATE {TRANS}'.$_table.'  
				SET '.$_field.' = '.$_field.'+1 
				WHERE fileUniqueID = "'.$_file.'"';
		    
		    $_updated = $this->db->query( $_query );
		    
		    return $_updated;
		    
		}
		
		return false;
    }
    
}