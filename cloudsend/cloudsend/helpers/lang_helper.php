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

if( !function_exists('__')) {
		
	function __( $line, $sprintf = '', $language = NULL ) {
		$CI =& get_instance();			
		if( empty( $language ) ) $language = $CI->mGlobal->getConfig('SYSTEM_LANGUAGE')->configVal;
		$CI->lang->load($language,$language);
			
		if(empty($sprintf)) {
			$return = $CI->lang->line( $line ); 
		} else {
			$content = $CI->lang->line( $line );
			$return = vsprintf( $content, $sprintf );
		}
			
		if(empty($return)) {
			$std_language = APPPATH.'language/'.trim($language).'/'.$language.'_lang.php';

			if(file_exists($std_language)) {
				require $std_language;
				
				if(array_key_exists($line ,$lang)) {
					if(empty($sprintf)) {
						$return = $lang[$line];
					} else {
						$return = vsprintf( $lang[$line], $sprintf );
					}
				} else {
					$return = $line;
				}
			} else {
				$return = $line;
			}
		}
		
		return $return;
	
	}
		
}
?>