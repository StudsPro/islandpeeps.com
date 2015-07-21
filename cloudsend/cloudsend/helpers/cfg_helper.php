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


 if( !function_exists('cfg')) {
		
    function cfg( $line, $sprintf = '' ) {
		$CI =& get_instance();
				
		if(empty($sprintf)) {
		    $return = $CI->config->item( $line ); 
		} else {
		    $content = $CI->config->item( $line );
		    $return = vsprintf( $content, $sprintf );
		}
				
		if(empty($return)) $return = $line;
				
		return $return;
    }
		
 }
?>