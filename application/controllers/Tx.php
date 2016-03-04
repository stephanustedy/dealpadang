<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tx extends CI_Controller {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
	}

	public function order_confirmation() {
		must_authenticated(site_url('tx/order_confirmation') . "?id=" . $this->input->get('id'), USER_ROLE_USER);
		
		$this->load->helper('security');		
		$voucher_id 	= xss_clean($this->input->get('id'));

		if($voucher_id && isInteger($voucher_id)) {
			$this->load->model('voucher_model');

	        $args['voucher'] 	= $this->voucher_model->get_voucher($voucher_id);

			render('order/confirmation', $args, '');
			return;
		}

		redirect (base_url() . 'home', 'refresh');
	}

	public function order_detail() {
		$this->load->helper('security');

		$order_id 	= xss_clean($this->input->get('id'));
		
		must_authenticated(site_url('tx/order_detail') . "?id=" . $order_id 	, USER_ROLE_USER);


		if($order_id && isInteger($order_id)) {
			$this->load->model('tx_model');
			$this->load->model('voucher_model');

	        $args['order'] 	= $this->tx_model->get_order($order_id);

			render('order/detail', $args, '');
			return;
		}

		redirect (base_url() . 'home', 'refresh');
	}

	public function checkout() {
		must_authenticated('' , USER_ROLE_USER);
		
		$this->load->helper('security');

		$this->load->model('voucher_model');
		$this->load->model('tx_model');

		$voucher_detail_ids = xss_clean($this->input->post('voucher_detail_id'));
		$quantities			= xss_clean($this->input->post('quantity'));
		$voucher_id 		= xss_clean($this->input->post('voucher_id'));
		

		if(!$voucher_id) {
			redirect (base_url() . 'home', 'refresh');
		}

		$is_valid 			= TRUE;
		$check_quantity 	= 0;
		$err_message 		= '';
		
		foreach($quantities as $qty) {
			$check_quantity += $qty;
		}

		if($check_quantity == 0){
			$is_valid 		= FALSE;
			$err_message 	= "Input Quantity";
		}

		foreach($voucher_detail_ids as $k => $v) {
			if(!$voucher_detail_ids[$k] || !$quantities[$k]) {
				$is_valid = FALSE;
				$err_message 	= "Data Invalid";
				break;
			}

			$detail = $this->voucher_model->get_voucher_detail($voucher_detail_ids[$k]);
				
			if($detail['stock'] < $quantities[$k]) {
				$err_message = $detail['merchant_name'] . ' - ' . $detail['address'] . ' - Stock is ' . $detail['stock'];
				$is_valid = FALSE;
				break;
			}
		}

		if($is_valid) {
			$order = array();

			$order['user_id'] 		= $this->user_model->user_id();
			$order['total_price'] 	= 0;
			foreach($voucher_detail_ids as $k => $v) {
				$detail = $this->voucher_model->get_voucher_detail($voucher_detail_ids[$k]);
				
				$order['total_price'] = $order['total_price'] + ($detail['price'] * $quantities[$k]);
			}

			$order['status'] 	= ORDER_STATUS_WAITING_PAYMENT;

			$order_id = $this->tx_model->create_order($order);

			if($order_id) {
				foreach($voucher_detail_ids as $k => $v) {
					$order_detail = array();

					$detail = $this->voucher_model->get_voucher_detail($voucher_detail_ids[$k]);

					$order_detail['order_id'] 			= $order_id;
					$order_detail['voucher_id'] 		= $detail['voucher_id'];
					$order_detail['quantity'] 			= $quantities[$k];
					$order_detail['price'] 				= $detail['price'];
					$order_detail['voucher_detail_id'] 	= $voucher_detail_ids[$k];
					
					$this->tx_model->create_order_detail($order_detail);
				}
			}
			
			redirect (site_url('tx/order_detail') . '?id=' . $order_id, 'refresh');
		} else {
			$this->session->set_flashdata("error", $err_message);
			redirect (site_url('tx/order_confirmation') . '?id=' . $voucher_id, 'refresh');
		}

	}

	function payment_confirmation() {
		must_authenticated('' , USER_ROLE_USER);
		if($this->input->server('REQUEST_METHOD') == "POST") {
			$this->load->helper('security');
			$this->load->model('tx_model');
			$this->load->library('form_validation');

			$order_id = xss_clean($this->input->post('order_id'));
			if($this->tx_model->is_valid_order_id($order_id)) {
				$this->form_validation->set_rules('bank_account', 'Bank Account', 'required|max_length[100]');
				$this->form_validation->set_rules('payment_date', 'Payment Date', 'required');
				$this->form_validation->set_rules('sender_account_name', 'Nama Pemilik Rekening', 'required');
				$this->form_validation->set_rules('nominal_transfer', 'Nominal Transfer', 'required|is_natural_no_zero');

				if ($this->form_validation->run() == TRUE) {
					$user_id 				= $this->user_model->user_id();
					$bank_account 			= xss_clean($this->input->post('bank_account'));
					$payment_date 			= xss_clean($this->input->post('payment_date'));
					$sender_account_name 	= xss_clean($this->input->post('sender_account_name'));
					$nominal_transfer 		= xss_clean($this->input->post('nominal_transfer'));

					$data = array();

					$data['order_id'] 				= $order_id;
					$data['user_id'] 				= $user_id;
					$data['bank_account'] 			= $bank_account;
					$data['sender_account_name'] 	= $sender_account_name;
					$data['nominal_transfer'] 		= $nominal_transfer;
					$data['payment_date'] 			= $payment_date;
					$data['status'] 				= PAYMENT_STATUS_WAITING_VERIFICATION;

					$this->tx_model->create_payment($data);

					redirect (site_url('tx/payment_success') , 'refresh');
				} else {
					$this->session->set_flashdata("error_payment", validation_errors());
					redirect (site('tx/order_detail') . '?id=' . $order_id, 'refresh');
				}

			}
		}
		redirect (base_url() . 'home' , 'refresh');
	}

	function payment_success() {
		render('order/payment_success', '', '');
	}
}