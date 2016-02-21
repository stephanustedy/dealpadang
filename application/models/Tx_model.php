<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tx_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function create_order($data) {
        $this->db->insert('order_header', $data); 
        $order_id = $this->db->insert_id();

        $update_data['invoice_ref_num'] = generate_invoice($order_id);

        $this->db->where('order_id', $order_id);
        $this->db->update('order_header', $update_data); 

        return $order_id;
    }

    function create_order_detail($data) {
        $this->db->insert('order_detail', $data); 
        return $this->db->insert_id();
    }

    function create_payment($data) {
        $this->db->insert('payment', $data); 
        return $this->db->insert_id();
    }

    function get_order($order_id) {
        $this->db->select('order_id, order_header.user_id, full_name, order_header.status, total_price, invoice_ref_num');
        $this->db->from('order_header');
        $this->db->join('user', 'order_header.user_id = user.user_id');
        $this->db->where('order_id', $order_id);

        $row = $this->db->get()->row();

        if($row){
            $data = array();


            $order = array();
            $order['order_id']          = $row->order_id;
            $order['user_id']           = $row->user_id;
            $order['status']            = $row->status;
            $order['total_price']       = $row->total_price;
            $order['invoice_ref_num']   = $row->invoice_ref_num;
            $order['user_name']         = $row->full_name;
            $order['order_detail']      = $this->get_order_detail($order_id);

            return $order;
        }


        return;
    }

    function get_order_detail($order_id) {
        $this->db->select('voucher.title, merchant.merchant_name, merchant.address, quantity, voucher_detail.price, voucher_detail.type');
        $this->db->from('order_header');
        $this->db->join('order_detail', 'order_header.order_id = order_detail.order_id');
        $this->db->join('voucher_detail', 'voucher_detail.voucher_detail_id = order_detail.voucher_detail_id');
        $this->db->join('voucher', 'voucher_detail.voucher_id = voucher.voucher_id');
        $this->db->join('merchant', 'merchant.merchant_id = voucher_detail.merchant_id');
        $this->db->where('order_header.order_id', $order_id);

        $row = $this->db->get()->result();

        $order_details = array();

        foreach($row as $k => $v) {
            $order_detail['title']          = $v->title;
            $order_detail['merchant_name']  = $v->merchant_name;
            $order_detail['address']        = $v->address;
            $order_detail['quantity']       = $v->quantity;
            $order_detail['price']          = $v->price;
            $order_detail['type']           = $v->type;

            array_push($order_details, $order_detail);
        }

        return $order_details;
    }

    function is_valid_order_id($order_id) {
        $this->db->select('order_id');
        $this->db->from('order_header');
        $this->db->where('order_header.order_id', $order_id);

        $row = $this->db->get()->row();

        if($row) {
            return TRUE;
        }

        return FALSE;
    }

}