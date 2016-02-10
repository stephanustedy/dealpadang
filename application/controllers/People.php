<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class People extends CI_Controller {
	public function  __construct()
    {
        parent::__construct();

    	if($this->user->is_logged_in()) {
    		if(!$this->user->is_valid_session()){
	    		redirect (base_url() . 'register/set_password_email', 'refresh');
	    	}
	    } else {
	    	redirect (base_url() . 'login', 'refresh');
	    }
    }

    public function profile() {
    	$this->load->library('form_validation');

    	$user = $this->user->get_user();

    	$this->load->view('people/profile', $user);
    }

    public function upload_profpic() {
    	$user 	= $this->user->get_user();

    	$config = array(
			'upload_path' => APPPATH . "images/user",
			'allowed_types' => "jpg|png|jpeg",
			'overwrite' => TRUE,
			'max_size' => "2048000", 
			'max_height' => "768",
			'max_width' => "1024",
			"encrypt_name" => TRUE
		);

		$this->load->library('upload', $config);

		if($this->upload->do_upload('userfile')) {
			$data = array('upload_data' => $this->upload->data());

			$update_data["profile_picture"] = $data["upload_data"]["file_name"];
			$this->user->update($update_data, $user["user_id"]);

			$this->session->set_flashdata("error", "Success!");

			redirect (base_url() . 'people/profile', 'refresh');
		} else {
			$this->session->set_flashdata("error", $this->upload->display_errors());
		}

    	redirect (base_url() . 'people/profile', 'refresh');
    }

}
