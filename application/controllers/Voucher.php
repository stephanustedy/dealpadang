<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher extends CI_Controller {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->load->model("voucher_model");
	}

	function detail($id) {
		if($id) {
			$params = array();
			
			$args = array();
			$args['negative_id'] = $id;
			
			$params['voucher'] 		= $this->voucher_model->get_voucher($id);
			$params['other_voucher'] 	= $this->voucher_model->search($args);

			if($params){
				render("voucher/detail", $params, '');
				return;
			}			
		}

		return show_404();
	}
	
	function browse($identifier) {
		$category = $this->voucher_model->get_category_by_identifier($identifier);

		if($category) {
			$params = array();

			$params['category_id'] 	= $category['category_id'];
			$params['result'] 	= $this->voucher_model->search($params);
	
			render("voucher/search", $params, "");
			
			return;
		}
		
		return show_404();
	}

	function add() {
		must_authenticated(site_url('voucher/add'), USER_ROLE_ADMIN);
	
		$this->load->helper('form');
		$this->load->helper('security');
		$this->load->library('form_validation');

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

	function print_voucher() {
		must_authenticated(site_url('merchant/add'), USER_ROLE_USER);
		
		 if($this->input->server('REQUEST_METHOD') == "POST") {
			$id  			= $this->input->get('voucher_detail_id');
			$voucher_code  	= $this->input->get('voucher_code');
			

			$data['voucher'] = $this->voucher_model->print_voucher($id, $voucher_code);
			if($data['voucher']){
				$this->load->view('voucher/print', $data);
				return;
			}
		}
		show_404();
	}

	function search() {
		$keyword 	= $this->input->get('q');

		$params = array();

		$params['keyword'] 	= $keyword;
		$params['result'] 	= $this->voucher_model->search($params);

		render("voucher/search", $params, "");
	}

}