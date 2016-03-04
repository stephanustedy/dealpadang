<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant extends CI_Controller {
    public function add() {
    	must_authenticated(site_url('merchant/add'), USER_ROLE_ADMIN);
    	
    	$this->load->helper('form');
	$this->load->helper('security');
	$this->load->library('form_validation');

	if($this->input->server('REQUEST_METHOD') == "POST") {
		$this->do_add_merchant();
	}

    	render('merchant/add', '', '');
    }

    public function do_add_merchant() {
    	$this->load->model('merchant_model');

		$this->form_validation->set_rules('merchant_name', 'Merchant Name', 'required|max_length[50]');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|is_natural');
		$this->form_validation->set_rules('city', 'City', 'required|max_length[50]');
		$this->form_validation->set_rules('address', 'Address', 'required|max_length[500]');

		$merchant_name 		= xss_clean($this->input->post('merchant_name'));
		$phone_number 		= xss_clean($this->input->post('phone_number'));
		$city 				= xss_clean($this->input->post('city'));
		$address 			= xss_clean($this->input->post('address'));

		if ($this->form_validation->run() == TRUE ) {
			$data = array(
			   'merchant_name' 	=> $merchant_name,
			   'phone_number' 	=> $phone_number,
			   'city' 			=> $city,
			   'address'		=> $address
			);

			$this->merchant_model->create($data);

			render('include/success', '', '');

			return;
		}
    }

}