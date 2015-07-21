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
 
class csFolder {
    
    var $_folder = array();

    public function __construct() {
    	log_message('debug', "Folder View Class Initialized");
    }
      
    public function getSelect( $parent = 0, $level = 1, $active = NULL, $id = 'inputParent', $class = '', $size = '10' ) {		
        return csFolder::_generateLIST( $parent, $level, $active, $id, $class, $size );
    }  
    

    private function _generateArray( $parent = 0, $level = 1 ) {
		$_entries = csFolder::_getDBEntries( $parent );
		
		if( $_entries != false ) {
		    $_count = 0;
		    foreach( $_entries AS $row ) {
				if( $row->count > 0 ) {
				    $this->_folder[] = array(
						'folderLevel' => $level,
						'folderUniqueID' => $row->folderUniqueID,
						'folderTitle' => $row->folderTitle,
				    );		
				    csFolder::_generateArray( $row->folderUniqueID, $level + 1 );
				} else {
				    $this->_folder[] = array(
						'folderLevel' => $level,
						'folderUniqueID' => $row->folderUniqueID,
						'folderTitle' => $row->folderTitle,
				    );		
				}
		    }
		}
    }

    
    private function _generateLIST( $parent = 0, $level = 1, $active = NULL, $id = 'inputParent', $class = '', $size = '' ) {	
		$this->_generateArray( $parent, $level );
		$_select_box = '';

		if( isset( $active ) && !empty( $active ) && $active != NULL ) {
			$_selected = $active;
		} else {
			$_selected = false;
		}

                $_select_box .= '<select name="'.$id.'" id="'.$id.'"'.( ( !empty( $class ) ) ? ' class="'.$class.'"' : '' );
                if( isset( $size ) && !empty( $size ) ) $_select_box .= ' size="10"';
                $_select_box .= '>'."\n";
                $_select_box .= '<option value="0"'.( ( !$_selected ) ? ' selected="selected"' : '' ).'>'.__('folder_lbl_noparent').'</option>'."\n";
		if( count( $this->_folder ) != 0 ):
			for( $i = 0; $i < count( $this->_folder ); $i++ ):
				$_spacer = ( $this->_folder[$i]['folderLevel'] != 1 ) ? str_repeat( "&nbsp;", $this->_folder[$i]['folderLevel']*2 ) : '';
				$_select_box .= '<option value="'.$this->_folder[$i]['folderUniqueID'].'"'.( ( $_selected != false && $_selected == $this->_folder[$i]['folderUniqueID'] ) ? ' selected="selected"' : '' ).'>'.$_spacer.$this->_folder[$i]['folderTitle'].'</option>'."\n";
			endfor;
		endif;
                $_select_box .= '</select>'."\n";

		return $_select_box;
    }
   
    
    /*
     * return db entries
     */
    private function _getDBEntries( $parent = NULL ) {
		$CI =& get_instance();
		
		$_query = 'SELECT folder.folderUniqueID, folder.folderTitle, deriv1.count 
			    FROM {TRANS}folders folder  
			    LEFT OUTER JOIN (
					SELECT folderParent, COUNT(*) AS count 
					FROM {TRANS}folders 
					GROUP BY folderParent
			    ) deriv1 
			    ON folder.folderUniqueID = deriv1.folderParent ';
		if( isset( $parent ) && !empty( $parent ) ) {
			$_query .= 'WHERE folder.folderParent = "'. $parent .'" ';
		} else {
			$_query .= 'WHERE folder.folderParent IS NULL ';
		}
			$_query .= 'ORDER BY folder.folderTitle DESC';

		$_found = $CI->db->query( $_query );

		if( $_found->num_rows() != 0 ) {
		    return $_found->result();
		} else {
		    return false;
		}
    }
}