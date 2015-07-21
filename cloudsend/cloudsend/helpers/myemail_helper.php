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


 if( !function_exists('emailconfig') ) {
     
     function emailconfig() {
	// set email configuration
	$CI =& get_instance();
	 
	$emailcfg['charset'] = 'utf-8';
	$emailcfg['useragent'] = 'codingking.co CloudSend';
	$emailcfg['wordwrap'] = TRUE;
	$emailcfg['mailtype'] = 'html';	 
	
	$_protocol = $CI->mGlobal->getConfig('EMAIL_PROTOCOL')->configVal;
	$_protocol = trim( $_protocol );
	
	$emailcfg['protocol'] = $_protocol;
	
	if( $_protocol == 'smtp' ) {
	    $emailcfg['smtp_host'] = $CI->mGlobal->getConfig('EMAIL_HOST')->configVal;
	    $emailcfg['smtp_user'] = $CI->mGlobal->getConfig('EMAIL_USER')->configVal;
	    $emailcfg['smtp_pass'] = $CI->mGlobal->getConfig('EMAIL_PASS')->configVal;
	    $emailcfg['smtp_port'] = $CI->mGlobal->getConfig('EMAIL_PORT')->configVal;
	} else if( $_protocol == 'sendmail' ) {
	    $emailcfg['mailpath']  = $CI->mGlobal->getConfig('SENDMAIL_PATH')->configVal;
	}
	
	return $emailcfg;
     }
     
 }

?>
