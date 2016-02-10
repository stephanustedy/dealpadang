<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	public function index() {
		$this->load->library('facebook');

		$this->facebook->destroy_session();
		$this->session->sess_destroy();

		redirect (base_url() . 'login', 'refresh');
	}
}
