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

class MY_Form_validation extends CI_Form_validation {
    
    // fix by http://aizuddinmanap.blogspot.de/2010/07/form-validation-callbacks-in-hmvc-in.html
    public function run($module = '', $group = '') {
	(is_object($module)) AND $this->CI =& $module;
	return parent::run($group);
    }
    
    public function alpha_point( $str ) {
		return ( ! preg_match("/^([-a-z0-9._-])+$/i", $str)) ? FALSE : TRUE;
    }
}
/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */

