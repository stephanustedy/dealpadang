<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function create($data) {
        $this->db->insert('voucher', $data); 
        return $this->db->insert_id();
    }

    function create_image($data) {
        $this->db->insert('voucher_image', $data); 
        return $this->db->insert_id();
    }

    function create_address($data) {
        $this->db->insert('voucher_address', $data); 
        return $this->db->insert_id();
    }

}
