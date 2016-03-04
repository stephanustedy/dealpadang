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
                            'voucher_condition, start_date, end_date, display_normal_price, display_price');
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
            $data['discount']         = (($voucher->display_normal_price-$voucher->display_price)/$voucher->display_normal_price)*100;
            $data['sold']           	= $this->get_item_sold($data['voucher_id']);
            $data['display_price_fmt']        = rupiah_format($voucher->display_price);
            $data['display_normal_price_fmt'] = rupiah_format($voucher->display_normal_price);


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

    function print_voucher($id, $voucher_code) {
        $this->db->select('invoice_ref_num, merchant_name, voucher_code, type, address, voucher.voucher_condition, ' .
                        'voucher.description, voucher.info, voucher.highlight, voucher.title, user.full_name, voucher.expired_date');
        $this->db->from('voucher_code');
        $this->db->join('user', 'user.user_id = voucher_code.user_id');
        $this->db->join('voucher_detail', 'voucher_detail.voucher_detail_id = voucher_code.voucher_detail_id');
        $this->db->join('voucher', 'voucher_detail.voucher_id = voucher.voucher_id');
        $this->db->join('merchant', 'voucher_detail.merchant_id = merchant.merchant_id');
        $this->db->join('order_header', 'voucher_code.order_id = order_header.order_id');
        $this->db->where('voucher_code.voucher_detail_id', $id);
        $this->db->where('voucher_code.voucher_code', $voucher_code);
        $this->db->where('voucher_code.user_id', $this->user_model->user_id());

        $row = $this->db->get()->row();

        if($row){
            $rs = array();

            $rs['invoice_ref_num'] = $row->invoice_ref_num;
            $rs['merchant_name'] = $row->merchant_name;
            $rs['voucher_code'] = $row->voucher_code;
            $rs['type'] = $row->type;
            $rs['address'] = $row->address;
            $rs['condition'] = $row->voucher_condition;
            $rs['description'] = $row->description;
            $rs['highlight'] = $row->highlight;
            $rs['info'] = $row->info;
            $rs['title'] = $row->title;
            $rs['full_name'] = $row->full_name;
            $rs['expired_date'] = $row->expired_date;

            return $rs;
        }
        
        return;
    }

    function get_primary_picture($voucher_id) {
        $this->db->select('image_url');

        $this->db->from('voucher_image');
        $this->db->where('status', IMAGE_STATUS_PRIMARY);
        $this->db->where('voucher_id', $voucher_id);

        $query  = $this->db->get();
        $row    = $query->row();

        if($row) {
            return base_url('images/voucher/' . $row->image_url);
        }

        return "";
    }

    function get_item_sold($voucher_id) {
        $this->db->from('order_header');
        $this->db->join('order_detail', 'order_header.order_id = order_detail.order_id');
        $this->db->where('order_detail.voucher_id', $voucher_id);
        $this->db->where('order_header.status', ORDER_STATUS_FINISH);

        return $this->db->count_all_results();
    }
    
    function get_category_by_identifier($identifier) {
	$this->db->select('category_id, category_name, identifier');
       	$this->db->from('category');
       	$this->db->where('identifier', $identifier);
       	
       	$row = $this->db->get()->row();
       	
       	if($row){
       		$category = array();
       		
       		$category['category_id'] 	= $row->category_id;
       		$category['identifier']		= $row->identifier;
       		$category['category_name'] 	= $row->category_name;
       		
       		return $category;
       	}
       	
       	return;
    }

    function search($args) {
        $keyword        = isset($args['keyword']) ? $args['keyword'] : '';
        $negative_id    = isset($args['negative_id']) ? $args['negative_id'] : '';
        $sort           = isset($args['sort']) ? $args['sort'] : 0;
        $category_id 	= isset($args['category_id']) ? $args['category_id'] : 0;

        $this->db->select('voucher_id, title, display_price, display_normal_price');
        $this->db->from('voucher');
        $this->db->where('status', VOUCHER_STATUS_PUBLISHED);
        $this->db->where('start_date <= ', date('Y-m-d'));
        $this->db->where('end_date >= ', date('Y-m-d'));
        
        if($keyword){
            $this->db->like('title', $keyword);
        }

        if($negative_id) {
            $this->db->where_not_in('voucher_id', $negative_id);
        }
        
        if($category_id) {
	    $this->db->where('category_id', $category_id);
        }
        
        switch ($sort) {
	    case VOUCHER_SORT_NEWEST:
	        $this->db->order_by("create_time", "desc"); 
	        break;
	}

        $rs = $this->db->get()->result();

        $results = array();

        foreach($rs as $k => $row) {
            $result = array();

            $result['voucher_id']       = $row->voucher_id;
            $result['title']            = $row->title;
            $result['price_fmt']        = rupiah_format($row->display_price);
            $result['normal_price_fmt'] = rupiah_format($row->display_normal_price);
            $result['price']            = $row->display_price;
            $result['normal_price']     = $row->display_normal_price;
            $result['discount']         = (($result['normal_price']-$result['price'])/$result['normal_price'])*100;
            $result['image_url']        = $this->get_primary_picture($result['voucher_id']);
            $result['sold']             = $this->get_item_sold($result['voucher_id']);

            array_push($results, $result);
        }

        return $results;
    }
}