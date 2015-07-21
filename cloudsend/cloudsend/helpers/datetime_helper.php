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

if(!function_exists('timezone_select')) {
	
	function timezone_select($selected = '', $class = '', $name = 'timezone', $id = 'timezone') {
		# Output option list, HTML.
		$opt = '<select name="'.$name.'" id="'.$id.'"';
		if(!empty($class)) $opt .= ' class="'.$class.'"';
		$opt .= '>'."\n";
		
		$regions = array('Africa', 'America', 'Antarctica', 'Arctic', 'Asia', 'Atlantic', 'Australia', 'Europe', 'Indian', 'Pacific');
		$tzs = timezone_identifiers_list();
		$optgroup = '';
		sort($tzs);
		foreach ($tzs as $tz) {
		    $z = explode('/', $tz, 2);
		    # timezone_identifiers_list() returns a number of
		    # backwards-compatibility entries. This filters them out of the 
		    # list presented to the user.
		    if (count($z) != 2 || !in_array($z[0], $regions)) continue;
		    if ($optgroup != $z[0]) {
		        if ($optgroup !== '') $opt .= '</optgroup>';
		        $optgroup = $z[0];
		        $opt .= "\n\t".'<optgroup label="' . htmlentities($z[0]) . '">'."\n";
		    }
		    $opt .= "\t\t".'<option value="' . htmlentities($tz) . '" label="' . htmlentities(str_replace('_', ' ', $z[1])) . '"';
		    if(isset($selected) && !empty($selected) && $selected != NULL) {
		    	if(htmlentities($tz) == $selected) $opt .= ' selected="selected" ';
		    }
		    $opt .= '>' . htmlentities(str_replace('_', ' ', $tz)) . '</option>'."\n";
		}
		if ($optgroup !== '') $opt .= "\t\t".'</optgroup>'."\n".'</select>';
		
		echo $opt;
	}
	
}


if( !function_exists('cvTZ') ) {
    
    function cvTZ( $timestamp = 0, $timezone = NULL, $dateformat = NULL ) {
        if( $timestamp != 0 ) {
            if( $timezone == NULL ) {
                $_ci =& get_instance();
                $timezone = $_ci->session->userdata('timeZone');
            }
	    
	    date_default_timezone_set( $timezone );
            
            if( $dateformat == NULL ) {
                $_ci =& get_instance();
                $dateformat = $_ci->session->userdata('timeFormat');
            }
            
            $date = new DateTime("@".$timestamp);  // will snap to UTC because of the "@timezone" syntax
            $date->setTimezone(new DateTimeZone( $timezone ));  
            $_return = $date->format( $dateformat );
            return $_return;
        } else {
            return false;
        }
    }
    
}
