<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function create($data) {
        $this->db->insert('merchant', $data); 
        return $this->db->insert_id();
    }

}
