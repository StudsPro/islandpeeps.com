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

class mDashboard extends CWX_Model {
    
    public function latestFiles() {
	$_query = 'SELECT * 
		    FROM {TRANS}files
		    WHERE ( fileByCustomer = "1" OR uploadRequest IS NOT NULL )
		    ORDER BY id DESC 
		    LIMIT 5';

	$_found = $this->db->query( $_query );

	if( $_found->num_rows() != 0 ) {
	    return $_found->result();
	}
	
	return false;
    }
    
    public function regUsers( $bar = false ) {
        $_query = 'SELECT COUNT(*) AS total FROM {TRANS}user';
        if( $bar ) $_query .= ' GROUP BY date_created ORDER BY date_created ASC LIMIT 10';
        
        $_found = $this->db->query( $_query );
        
        if( $_found->num_rows() != 0 ) {
            
            if( $bar == false ) {
                return $_found->row();
            } else {
                $_return = array();
                foreach( $_found->result_array() AS $k => $v ) {
                    $_return[] = $v['total'];
                }
                return $_return;
            }
        }
        
        return false;
    }
    
    public function regTotalFiles( $bar = false ) {
        $_query = 'SELECT COUNT(*) AS total FROM {TRANS}files';
        if( $bar ) $_query .= ' GROUP BY fileTime ORDER BY fileTime ASC LIMIT 10';
        
        $_found = $this->db->query( $_query );
        
        if( $_found->num_rows() != 0 ) {
            
            if( $bar == false ) {
                return $_found->row();
            } else {
                $_return = array();
                foreach( $_found->result_array() AS $k => $v ) {
                    $_return[] = $v['total'];
                }
                return $_return;
            }
        }
        
        return false;
    }    
    
    public function regTotalFileSize( $bar = false ) {
        $_query = 'SELECT SUM(fileSize) AS total FROM {TRANS}files';
        if( $bar ) $_query .= ' GROUP BY fileTime ORDER BY fileTime ASC LIMIT 10';
        
        $_found = $this->db->query( $_query );
        
        if( $_found->num_rows() != 0 ) {
            
            if( $bar == false ) {
                return $_found->row();
            } else {
                $_return = array();
                foreach( $_found->result_array() AS $k => $v ) {
                    $_return[] = $v['total'];
                }
                return $_return;
            }
        }
        
        return false;
    }
    
    public function downTotalFileSize( $bar = false ) {
        $_query = 'SELECT SUM(logSize) AS total FROM {TRANS}logs WHERE logType = "down"';
        if( $bar ) $_query .= ' GROUP BY logTime ORDER BY logTime ASC LIMIT 10';
        
        $_found = $this->db->query( $_query );
        
        if( $_found->num_rows() != 0 ) {
            
            if( $bar == false ) {
                return $_found->row();
            } else {
                $_return = array();
                foreach( $_found->result_array() AS $k => $v ) {
                    $_return[] = $v['total'];
                }
                return $_return;
            }
        }
        
        return false;
    }
}