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

    function get_voucher($id) {
        $this->db->select('voucher_id, title, description, info, highlight,' . 
                            'voucher_condition, start_date, end_date');
        $this->db->from('voucher');
        $this->db->where('voucher.voucher_id', $id);

        $voucher = $this->db->get()->row();

        if($voucher){
            $data = array();

            $data['voucher_id']         = $voucher->voucher_id;
            $data['title']              = $voucher->title;
            $data['description']        = $voucher->description;
            $data['info']               = $voucher->info;
            $data['highlight']          = $voucher->highlight;
            $data['voucher_condition']  = $voucher->voucher_condition;
            $data['start_date']         = $voucher->start_date;
            $data['end_date']           = $voucher->end_date;


            $data['details']            = $this->get_all_voucher_detail($id);
            $data['images']             = $this->get_voucher_images($id);

            return $data;
        }

        return;
    }

    //get list voucher detail by voucher id
    function get_all_voucher_detail($id) {
        $this->db->select('voucher_detail_id, merchant.merchant_id, merchant_name, city, address, phone_number, stock, price, normal_price, type, voucher_id');
        $this->db->from('voucher_detail');
        $this->db->join('merchant', 'voucher_detail.merchant_id = merchant.merchant_id');
        $this->db->where('voucher_detail.voucher_id', $id);

        $rs = $this->db->get()->result();

        $details = array();
        foreach ($rs as $row){
            $detail['voucher_detail_id']      = $row->voucher_detail_id;
            $detail['voucher_id']             = $row->voucher_id;
            $detail['merchant_id']            = $row->merchant_id;
            $detail['merchant_name']          = $row->merchant_name;
            $detail['city']                   = $row->city;
            $detail['address']                = $row->address;
            $detail['phone_number']           = $row->phone_number;
            $detail['stock']                  = $row->stock;
            $detail['price']                  = $row->price;
            $detail['normal_price']           = $row->normal_price;
            $detail['type']                   = $row->type;

            $detail['price_fmt']              = rupiah_format($row->price);
            $detail['normal_price_fmt']       = rupiah_format($row->normal_price);

            array_push($details, $detail);
        }

        return $details;
    }

    //get voucher detail by voucher detail id
    function get_voucher_detail($id) {
        $this->db->select('voucher_detail_id, merchant.merchant_id, merchant_name, city, address, phone_number, stock, price, normal_price, type, voucher_id');
        $this->db->from('voucher_detail');
        $this->db->join('merchant', 'voucher_detail.merchant_id = merchant.merchant_id');
        $this->db->where('voucher_detail_id', $id);

        $row = $this->db->get()->row();

        $detail = array();
        if($row){
            $detail['voucher_detail_id']      = $row->voucher_detail_id;
            $detail['voucher_id']             = $row->voucher_id;
            $detail['merchant_id']            = $row->merchant_id;
            $detail['merchant_name']          = $row->merchant_name;
            $detail['city']                   = $row->city;
            $detail['address']                = $row->address;
            $detail['phone_number']           = $row->phone_number;
            $detail['stock']                  = $row->stock;
            $detail['type']                  = $row->type;

            $detail['price']                  = $row->price;
            $detail['normal_price']           = $row->normal_price;

            $detail['price_fmt']              = rupiah_format($row->price);
            $detail['normal_price_fmt']       = rupiah_format($row->normal_price);
        }

        return $detail;
    }

    function get_voucher_images($id) {
        $this->db->select('image_url');
        $this->db->from('voucher_image');
        $this->db->where('voucher_id', $id);

        $rs = $this->db->get()->result();

        $images = array();
        foreach ($rs as $row){
            $image['image_url']    = $row->image_url;

            array_push($images, $image);
        }

        return $images;
    }

    function generate_voucher_code($voucher_detail_id) {
        $this->load->helper($string);

        $code = '';
        while(true) {
            $code = random_string('alnum',8);

            $this->db->select('voucher_code_id');
            $this->db->from('voucher_code');
            $this->db->where('voucher_detail_id', $voucher_detail_id);
            $this->db->where('expired_date >= ', 'NOW()');

            $check = $this->db->get()->row();

            if(!$check) {
                break;
            }
        }

        $data = array();

        $data['voucher_detail_id']  = $voucher_detail_id;
        $data['user_id']            = $this->user_model->user_id();
        $data['voucher_code']       = $code;


        $this->db->insert('voucher_code', $data); 
        return $this->db->insert_id();
    }


}

