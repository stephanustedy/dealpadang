<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('isInteger')) {
	function isInteger($input){
	    return(ctype_digit(strval($input)));
	}
}