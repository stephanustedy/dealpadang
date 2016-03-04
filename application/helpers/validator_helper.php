<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('isInteger')) {
	function isInteger($input){
	    return(ctype_digit(strval($input)));
	}
}

if ( ! function_exists('must_authenticated')) {
	function must_authenticated($refback, $role){
		if(!$role) {
			redirect(site_url('login'), 'refresh');
		}
		
		$CI = &get_instance();
		
		$CI->load->model('user_model');
		
		switch($role) {
			case USER_ROLE_USER:
				if(!$CI->user_model->is_logged_in()) {
					redirect(site_url('login') . "?refback=" . urlencode($refback) , 'location');
				} else if(!$CI->user_model->is_valid_session()) {
					redirect(site_url('register/set_password_email'), 'refresh');				
				}
				break;
			case USER_ROLE_ADMIN:
				if(!$CI->user_model->is_logged_in()) {
					redirect(site_url('login') . "?refback=" . urlencode($refback) , 'location');
				}else if(!$CI->user_model->is_admin()){
					redirect(site_url(''), 'refresh');
				}
				break;
		}
		return;

	}
}