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

if( isset( $header ) && !empty( $header ) ) {
    $this->load->view('frontend/'.$header);   
} else {
    $this->load->view('frontend/header_boot');    
}

if( isset( $addnavi ) && $addnavi == true ) $this->load->view('frontend/navigation');

$this->load->view( $site );

$this->load->view('frontend/footer');