<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class People extends CI_Controller {
	public function  __construct() {
	        parent::__construct();
	}

    public function profile() {
    	must_authenticated(site_url('people/profile'), USER_ROLE_USER);
    
    	$this->load->library('form_validation');

    	$user = $this->user_model->get_user();

    	$this->load->view('people/profile', $user);
    }

    public function upload_profpic() {
    	must_authenticated(site_url('people/profile'), USER_ROLE_USER);
    
    	$user 	= $this->user_model->get_user();

    	$config = array(
			'upload_path' => FCPATH . "images/user",
			'allowed_types' => "jpg|png|jpeg",
			'overwrite' => FALSE,
			"encrypt_name" => TRUE
		);

		$this->load->library('upload', $config);

		if($this->upload->do_upload('userfile')) {
			$data = array('upload_data' => $this->upload->data());

			$update_data["profile_picture"] = $data["upload_data"]["file_name"];
			$this->user_model->update($update_data, $user["user_id"]);

			$this->session->set_flashdata("error", "Success!");

			redirect (base_url() . 'people/profile', 'refresh');
		} else {
			$this->session->set_flashdata("error", $this->upload->display_errors());
		}

    	redirect (base_url() . 'people/profile', 'refresh');
    }

}