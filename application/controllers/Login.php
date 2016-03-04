<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function  __construct() {
	        parent::__construct();

		if($this->user_model->is_logged_in()) {
			if($this->user_model->is_valid_session()){
				redirect (base_url() . 'home', 'refresh');
			} else {
				redirect (base_url() . 'register/set_password_email', 'refresh');
			}
		}
    	}

	public function index() {
		$this->load->helper('form');
		$this->load->helper('security');
		$this->load->library('form_validation');
		
		$this->load->library('facebook');
		
		$data['refback'] = $this->input->get("refback");

		if ($this->facebook->logged_in() && $this->facebook->user()) {
			$this->do_fb_login();
		} else {
			$data['login_url'] 		= $this->facebook->login_url();
		}

		if($this->input->server('REQUEST_METHOD') == "POST") {
			$data['error_login'] = $this->do_login();
		}

		render('login', $data, '');

	}

	private function do_login() {
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[50]');
		$this->form_validation->set_rules("password","Password",'required|max_length[100]');

		$email 			= xss_clean($this->input->post('email'));
		$password 		= xss_clean($this->input->post('password'));
		$refback 		= xss_clean($this->input->post('refback'));
		
		if ($this->form_validation->run() == TRUE) {

			$user = $this->user_model->validate_login($email, $password);			
			if($user){
				$this->user_model->login($user->user_id, $user->email, $user->password);

				if($refback) {
					redirect ($refback, 'refresh');
				} else {
					redirect (site_url('home'), 'refresh');
				}
				return;
			} else {
				return 'Email or Password Incorrect';
			}
		} else {
			return validation_errors();
		}
	}

	private function do_fb_login() {
		$fb_object 	= $this->facebook->user();
		$fb_api_id 	= $fb_object['data']['id'];

		$check_user = $this->user_model->check_user_id_from_fb_api($fb_api_id);
		if($check_user) {
			$this->user_model->login($check_user->user_id, $check_user->email, $check_user->password);
			if($check_user->user_id && $check_user->email && $check_user->password){
				redirect (site_url('home'), 'refresh');
			} else {
				redirect (site_url('register/set_password_email'), 'refresh');
			}
			return;
		} else {
			$is_user_exist = $this->user_model->get_by_email($fb_object['data']['email']);

			if($is_user_exist) {
				$user_api_data['api_id'] 	= $fb_object['data']['id'];
				$user_api_data['user_id'] 	= $is_user_exist->user_id;
				$user_api_data['api_type'] 	= USER_API_TYPE_FACEBOOK;

				$this->user_model->create_api_connector($user_api_data);
				$this->user_model->login($is_user_exist->user_id, $is_user_exist->email, $is_user_exist->password);
			} else{
				//register user data
				$user_data['full_name'] = $fb_object['data']['name'];
				$user_data['gender'] 	= $fb_object['data']['gender'];
				$user_data['email'] 	= $fb_object['data']['email'];
				$user_data['status'] 	= USER_STATUS_PENDING;
				$user_data['role_id'] 	= USER_ROLE_USER;


				$user_id = $this->user_model->create($user_data);

				$user_api_data['api_id'] 	= $fb_object['data']['id'];
				$user_api_data['user_id'] 	= $user_id;
				$user_api_data['api_type'] 	= USER_API_TYPE_FACEBOOK;
				$this->user_model->create_api_connector($user_api_data);

				$this->user_model->login($user_id, $fb_object['data']['email'], '');

				redirect (base_url() . 'register/set_password_email', 'refresh');
			}
			return;
		}
	}

}