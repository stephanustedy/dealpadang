<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index() {
		$this->load->model('voucher_model');
		
		$params = array();
		$params['sort'] = VOUCHER_SORT_NEWEST;
		
		$data['vouchers'] = $this->voucher_model->search($params);
		
		render('home/home', $data, '');
	}
}
