<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('render')) {
	function render($view, $data, $args) {
		$CI = &get_instance();
		$html = $CI->load->view($view, $data, TRUE);

		$params = array();

		$params['content'] 	= $html;
		$params['args'] 	= $args;

		$CI->load->view("html", $params);
	}
}