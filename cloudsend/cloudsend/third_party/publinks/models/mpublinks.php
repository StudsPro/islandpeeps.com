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

class mPublinks extends CWX_Model {
    
    public function getLinks() {	
		$this->db->order_by('id','DESC');
		$_found = $this->db->get( 'publics' );
		
		if( $_found->num_rows() != 0 ) {
		    return $_found->result();
		} 
		
		return false;
    }
  
    public function getEntry( $_entry = NULL ) {
		if( $_entry != NULL && !empty( $_entry ) ) {
		    $_where = array(
			'publicUniqueID' => $_entry
		    );

		    $_found = $this->db->where( $_where )->get( 'publics' );

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
		    
		    $_query = 'SELECT df.*, f.fileName, f.fileUniqueID 
				FROM {TRANS}public2file df 
				LEFT JOIN {TRANS}files f 
				ON df.fileUniqueID = f.fileUniqueID 
				WHERE df.publicUniqueID = "'.$_entry.'"';

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
    
    public function updateEntry( $_entry = NULL, $_update = array() ) {
		if( !empty( $_entry ) && is_array( $_update ) ) {
		    
		    $_where = array(
			'publicUniqueID' => $_entry
		    );


		    $_return = $this->db->where( $_where )->update( 'publics', $_update );

		    return $_return;
		}
		
		return false;
    }  
    
    public function deleteEntry( $_entry ) {
		$_where = array(
		    'publicUniqueID' => $_entry
		);
		
		$_deleted = $this->db->where( $_where )->delete( 'publics' );
		
		if( $_deleted ) {
		    $_deleted = $this->db->where( $_where )->delete( 'public2file' );		    
		}
		
		return $_deleted;
    }
    
    public function setPublishedEntry( $_set, $_unique ) {
        $_where = array(
		    'publicUniqueID' => $_unique
		);

		$_update = array(
		    'published' => $_set  
		);
		
		$_updated = $this->db->where( $_where )->update( 'publics', $_update );

		return $_updated;
    }
    
}