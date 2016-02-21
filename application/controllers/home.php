<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index() {
		if(!$this->user_model->is_logged_in() || !$this->user_model->is_valid_session()) {
			render('home/non_login', '', '');
		} else {
			render('home/after_login', '', '');
		}
	}
}
