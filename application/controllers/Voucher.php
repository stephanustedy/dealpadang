<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher extends CI_Controller {
	function detail($id) {
		if($id) {
			$this->load->model("voucher_model");

			$data = $this->voucher_model->get_voucher($id);
			if($data){
				render("voucher/detail", $data, '');
				return;
			}			
		}

		return show_404();
	}

	function add() {
		$this->load->helper('form');
		$this->load->helper('security');
		$this->load->library('form_validation');

		$this->load->model('voucher_model');

		if($this->input->server('REQUEST_METHOD') == "POST") {
			if($this->validate()) {
				$this->validate_create_voucher();
			}
		}
		
		render("voucher/add", '', '');
	}

	private function validate_create_voucher() {
		$this->form_validation->set_rules('title', 'Title', 'required|max_length[100]');
		$this->form_validation->set_rules('stock', 'Stock', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('price', 'Price', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('normal_price', 'Normal Price', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('start_date', 'Start Date', 'required'); 
		$this->form_validation->set_rules('end_date', 'End Date', 'required'); 

		$this->form_validation->set_rules('condition', 'Condition', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('highlight', 'Highlight', 'required');
		$this->form_validation->set_rules('info', 'Info', 'required');


		return $this->form_validation->run();
	}

	private function create_voucher() {
		$title 			= xss_clean($this->input->post('title'));
		$stock 			= xss_clean($this->input->post('stock'));
		$price 			= xss_clean($this->input->post('price'));
		$normal_price 	= xss_clean($this->input->post('normal_price'));
		$start_date 	= xss_clean($this->input->post('start_date'));
		$end_date		= xss_clean($this->input->post('end_date'));
		$info 			= xss_clean($this->input->post('info'));
		$highlight 		= xss_clean($this->input->post('highlight'));
		$condition 		= xss_clean($this->input->post('condition'));
		$description 	= xss_clean($this->input->post('description'));

		$data = array(
		   'title' 				=> $title,
		   'start_date'			=> $start_date,
		   'end_date'			=> $end_date,
		   'voucher_condition'	=> $condition,
		   'description' 		=> $description,
		   'info' 				=> $info,
		   'highlight' 			=> $highlight,
		   'status'				=> VOUCHER_STATUS_UNPUBLISHED
		);

		$voucher_id = $this->voucher_model->create($data);

		// $this->create_voucher_addresses($voucher_id);
		// $this->upload_voucher_images($voucher_id);

		return;
	}

	private function upload_voucher_images($voucher_id) {
		if($voucher_id){
		    $this->load->library('upload');

		    $config = array(
					'upload_path' => FCPATH . "images/voucher",
					'allowed_types' => "jpg|png|jpeg",
					'overwrite' => FALSE,
					"encrypt_name" => TRUE
				);

		    $files = $_FILES;
		    $cpt = count($_FILES['voucher_image']['name']);
		    for($i=0; $i<$cpt; $i++) {           
		        $_FILES['userfile']['name']		= $files['voucher_image']['name'][$i];
		        $_FILES['userfile']['type']		= $files['voucher_image']['type'][$i];
		        $_FILES['userfile']['tmp_name']	= $files['voucher_image']['tmp_name'][$i];
		        $_FILES['userfile']['error']	= $files['voucher_image']['error'][$i];
		        $_FILES['userfile']['size']		= $files['voucher_image']['size'][$i];    

		        $this->upload->initialize($config);

		        if($this->upload->do_upload()){
		        	$upload_data = array('upload_data' => $this->upload->data());
			        $data = array();

			        $data["voucher_id"] = $voucher_id;
			        $data["image_url"] 	= $upload_data["upload_data"]["file_name"];
			        $data["status"] 	= IMAGE_STATUS_ACTIVE;

		        	$this->voucher_model->create_image($data);

		        	$this->session->set_flashdata("error", "Success!");
		        } else {
		        	$this->session->set_flashdata("error", $this->upload->display_errors());
		        	break;
		        }
		    }

		} else {
			$this->session->set_flashdata("error", "Data not valid");
		}
	}

}






