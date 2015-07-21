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


class breadcrumb {

	private $_divider 		= ' &nbsp;&#8250;&nbsp; ';
	private $_breadcrumbs	= '';
	
	public function __construct() {		
		log_message('debug', "Breadcrumb Class Initialized");
	}

	function output( $parent = NULL ) {
		if( $parent != false ) $parent = $parent->folderUniqueID;
		$this->_generate( $parent );

		return '<ul class="breadcrumb"><li><a href="#" class="changefolder" data-folder-id="root">'.__('folder_lbl_root').'</a> <span class="divider">'.$this->_divider.'</span></li>'.$this->_breadcrumbs.'</ul>';
	}

	private function _generate( $parent = NULL ) {
		if( isset( $parent ) AND !empty( $parent ) AND $parent != false ) {
			$_entry = $this->_getDBEntries( $parent );

			$this->_breadcrumbs = '<li><a href="#" class="changefolder" data-folder-id="'.$_entry->folderUniqueID.'">'.$_entry->folderTitle.'</a> <span class="divider">'.$this->_divider.'</span></li>'.$this->_breadcrumbs;

			if( isset( $_entry->folderParent ) AND !empty( $_entry->folderParent ) ) {
				$this->_generate( $_entry->folderParent );
			}
		}
	}

    private function _getDBEntries( $parent = NULL ) {
		$CI =& get_instance();
		
		if( isset( $parent ) AND !empty( $parent ) ) {
			$_query = "SELECT * FROM {TRANS}folders WHERE folderUniqueID = '{$parent}'";

			$_found = $CI->db->query( $_query );

			if( $_found->num_rows() == 1 ) {
			    return $_found->row();
			} else {
			    return false;
			}

		} 

		return false;
    }
}
// END Breadcrumb Class
