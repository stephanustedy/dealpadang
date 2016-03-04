<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('render')) {
	function render($view, $data, $args) {
		$CI = &get_instance();
		$html = $CI->load->view($view, $data, TRUE);
		
		$CI->load->model('user_model');
		
		$params = array();
		
		if($CI->user_model->is_logged_in()){
			$params['logout_url'] = site_url('logout');
		} else {
			$params['login_url'] = site_url('login');
		}
		
		$params['content'] 	= $html;
		$params['args'] 	= $args;

		$CI->load->view("html", $params);
	}
}