<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function index() {
		$this->load->helper('form');
		$this->load->helper('security');
		$this->load->library('form_validation');

                $data = array();
	 	//$this->send_activation_email('stephanus.tedy@gmail.com', 'aj1j314j');
		if($this->input->server('REQUEST_METHOD') == "POST") {
			$data['error_register'] = $this->do_register();
		}

		render('login', $data, '');
	}

	private function do_register() {
		$this->form_validation->set_rules('email_regis', 'Email', 'required|valid_email|max_length[50]|callback_unique_email');
		$this->form_validation->set_rules('full_name', 'Full Name', 'required|max_length[100]');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|is_natural');
		$this->form_validation->set_rules("password","Password",'required|matches[c_password]|max_length[100]');
		$this->form_validation->set_rules("c_password","Confirm Password",'required');

		$email 			= xss_clean($this->input->post('email_regis'));
		$password 		= xss_clean($this->input->post('password'));
		$c_password 	        = xss_clean($this->input->post('c_password'));
		$full_name 		= xss_clean($this->input->post('full_name'));
		$phone_number		= xss_clean($this->input->post('phone_number'));

		if ($this->form_validation->run() == TRUE ) {
			$password 			= do_hash($password, 'md5');
			$activation_code 	= $this->generate_activation_code($email);

			$data = array(
			   'email' 			=> $email,
			   'password' 			=> $password,
			   'full_name' 			=> $full_name,
			   'phone_number'		=> $phone_number,
			   'status'			=> USER_STATUS_PENDING,
			   'activation_code' 		=> $activation_code,
			   'role_id'			=> USER_ROLE_USER
			);

			$this->user_model->create($data);
			$this->send_activation_email($email, $activation_code);

			render('register/success_register', '', '');

			return;
		} else {
			return validation_errors();
		}
	}

	function unique_email($email) {
		$query = $this->user_model->get_by_email($email);
		if ($query) {
			$this->form_validation->set_message('unique_email','Email not available');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function send_activation_email($email, $activation_code) {
		$this->load->library('email');
                $this->email->set_newline("\r\n");

		$this->email->from('noreply@padangdeal.com', 'Deal Padang');
		$this->email->to($email); 

		$this->email->subject("Activation - Deal Padang");
		$this->email->message("Registration success!<br/>Activate your account <a href='". site_url('register/activate') . "?code=". $activation_code ."&email=" . $email."'>here</a>.");

	    $this->email->send();
	}

	public function activate() {
		$this->load->helper('security');

		$activation_code 	= xss_clean($this->input->get('code'));
		$email 				= xss_clean($this->input->get('email'));

		if($activation_code != "" && $email != "") {
			$query = $this->user_model->validate_activate($email, $activation_code);

			if ($query) {
				$this->user_model->activate($email);
				render('register/activation_success', '', '');
				return;
			}
		}
		
		render('register/activation_failed', '', '');
	}

	private function generate_activation_code($email) {
        $registration_date = gmdate('Y-m-d H:i:s', time());
        $activation_code = sha1($registration_date.':'.$email);

        return $activation_code;
	}

	public function set_password_email() {
		if(!$this->user_model->is_logged_in()) {
			redirect (base_url() . 'login', 'refresh');
		}

		if($this->user_model->is_valid_session()) {
			redirect (base_url() . 'home', 'refresh');
		}

		$this->load->helper('form');
		$this->load->helper('security');
		$this->load->library('form_validation');

		$logged_in 		= $this->user_model->is_logged_in();
		
		if($this->input->server('REQUEST_METHOD') == "POST") {
			$this->do_set_password_email($logged_in);
		}

		$data['email'] = isset($logged_in['email']) ? $logged_in['email'] : '';

		render('register/set_password_email_prompt', $data, '');
	}

	private function do_set_password_email($logged_in) {
		$this->form_validation->set_rules("password","Password",'required|matches[c_password]|max_length[100]');
		$this->form_validation->set_rules("c_password","Confirm Password",'required');
		

		if(!$logged_in['email']){
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[50]|callback_unique_email');
			$email 	= xss_clean($this->input->post('email'));
		}

		$password 		= xss_clean($this->input->post('password'));

		if ($this->form_validation->run() == TRUE ) {
			$password 			= do_hash($password, 'md5');

			$data['password']	= $password;
			
			$email = isset($email) ? $email : $logged_in['email'];

			$this->user_model->update($data, $logged_in['user_id']);
			$this->user_model->login($logged_in['user_id'], $email, $password);

			redirect (base_url() . 'home', 'refresh');
			return;
		}
	}

}
