<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function index() {
		$this->load->helper('form');
		$this->load->helper('security');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[50]|callback_unique_email');
		$this->form_validation->set_rules('full_name', 'Full Name', 'required|max_length[100]');
		$this->form_validation->set_rules('birthdate', 'Birthdate', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules("password","Password",'required|matches[c_password]|max_length[100]');
		$this->form_validation->set_rules("c_password","Confirm Password",'required');

		$email 			= xss_clean($this->input->post('email'));
		$password 		= xss_clean($this->input->post('password'));
		$c_password 	= xss_clean($this->input->post('c_password'));
		$full_name 		= xss_clean($this->input->post('full_name'));
		$birthdate		= xss_clean($this->input->post('birthdate'));
		$gender 		= xss_clean($this->input->post('gender'));

		

		if ($this->form_validation->run() == TRUE ) {
			$password 			= do_hash($password, 'md5');
			$activation_code 	= $this->generate_activation_code($email);

			$data = array(
			   'email' 				=> $email,
			   'password' 			=> $password,
			   'full_name' 			=> $full_name,
			   'birthdate'			=> $birthdate,
			   'gender'				=> $gender,
			   'status'				=> USER_STATUS_PENDING,
			   'activation_code' 	=> $activation_code,
			   'role_id'			=> USER_ROLE_USER
			);

			$this->user->create($data);
			$this->send_activation_email($email, $activation_code);
			$this->load->view('register/success_register');

			return;
		}

		$this->load->view('register/index');
	}

	function unique_email($email) {
		$query = $this->user->get_by_email($email);
		if ($query) {
			$this->form_validation->set_message('unique_email','Email not available');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function send_activation_email($email, $activation_code) {
		$config = array();

        $config['protocol'] = "smtp";
		// does not have to be gmail
		$config['smtp_host'] = 'ssl://smtp.gmail.com'; 
		$config['smtp_port'] = '465';
		$config['smtp_user'] = 'dealpadang@gmail.com';
		$config['smtp_pass'] = 'dealpadang123';
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";

		$this->load->library('email', $config);
		$this->email->initialize($config);
		$this->email->from('dealpadang@gmail.com', 'Deal Padang');
		$this->email->to($email); 

		$this->email->subject("Activation - Deal Padang");
		$this->email->message("Welcome to dealpadang.<br/>To activate your account click <a href='". site_url('/register/activate?code=' . $activation_code . '&email=' . $email) ."'>this</a>");


	    $this->email->send();
	}

	public function activate() {
		$this->load->helper('security');

		$activation_code 	= xss_clean($this->input->get('code'));
		$email 				= xss_clean($this->input->get('email'));

		if($activation_code != "" && $email != "") {
			$query = $this->user->validate_activate($email, $activation_code);

			if ($query) {
				$this->user->activate($email);
				$this->load->view('register/activation_success');
				return;
			}
		}
		
		$this->load->view('register/activation_failed');
	}

	private function generate_activation_code($email) {
        $registration_date = gmdate('Y-m-d H:i:s', time());
        $activation_code = sha1($registration_date.':'.$email);

        return $activation_code;
	}

	public function set_password_email() {
		if(!$this->user->is_logged_in()) {
			redirect (base_url() . 'login', 'refresh');
		}

		if($this->user->is_valid_session()) {
			redirect (base_url() . 'home', 'refresh');
		}

		$this->load->helper('form');
		$this->load->helper('security');
		$this->load->library('form_validation');

		
		$this->form_validation->set_rules("password","Password",'required|matches[c_password]|max_length[100]');
		$this->form_validation->set_rules("c_password","Confirm Password",'required');

		$logged_in 		= $this->user->is_logged_in();

		if(!$logged_in['email']){
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[50]|callback_unique_email');
			$email 	= xss_clean($this->input->post('email'));
		}

		$password 		= xss_clean($this->input->post('password'));

		if ($this->form_validation->run() == TRUE ) {
			$password 			= do_hash($password, 'md5');

			$data['password']	= $password;
			
			$email = isset($email) ? $email : $logged_in['email'];

			$this->user->update($data, $logged_in['user_id']);
			$this->user->login($logged_in['user_id'], $email, $password);

			redirect (base_url() . 'home', 'refresh');
			return;
		}

		$data['email'] = isset($logged_in['email']) ? $logged_in['email'] : '';

		$this->load->view('register/set_password_email_prompt', $data);
	}

}
