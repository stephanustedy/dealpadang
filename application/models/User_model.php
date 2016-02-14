<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function create($data) {
        $this->db->insert('user', $data); 
        return $this->db->insert_id();
    }

    function update($data, $user_id) {
        if(!$user_id){
            return;
        }

        $update_data = array();

        if(isset($data['password'])) {
            $update_data['password'] = $data['password'];
        }

        if(isset($data['email'])) {
            $update_data['email'] = $data['email'];
        }

        if(isset($data['profile_picture'])) {
            $update_data['profile_picture'] = $data['profile_picture'];
        }

        $this->db->where('user_id', $user_id);
        $this->db->update('user', $update_data); 
    }

    function get_by_email($email) {
        $this->db->select('user_id, email, password, gender, birthdate, full_name');
        $this->db->from('user');
        $this->db->where('email', $email); 

        $query = $this->db->get();

        return $query->row();
    }

    function validate_activate($email, $activation_code) {
        $this->db->select('user_id');
        $this->db->from('user');
        $this->db->where('email', $email); 
        $this->db->where('password', $activation_code); 
        $this->db->where('status', USER_STATUS_PENDING); 

        $query = $this->db->get();

        return $query->row();
    }

    function activate($email) {
        $data = array(
                   'status' => USER_STATUS_ACTIVE
                );

        $this->db->where('email', $email);
        $this->db->update('user', $data); 
    }

    function validate_login($email, $password) {
        $this->load->helper('security');

        $password   = do_hash($password, 'md5');

        $this->db->select('user_id,email,password');
        $this->db->from('user');
        $this->db->where('email', $email); 
        $this->db->where('password', $password); 

        $query      = $this->db->get();

        return $query->row();
    }
    
    function check_user_id_from_fb_api($api_id) {
        $this->db->select('user_api_connector.user_id, email, password');
        $this->db->from('user_api_connector');
        $this->db->join('user', 'user_api_connector.user_id = user.user_id');
        $this->db->where('api_id', $api_id); 

        $query = $this->db->get();

        return $query->row();
    }

    function create_api_connector($data) {
        $this->db->insert('user_api_connector', $data); 
        return $this->db->insert_id();
    }

    function is_logged_in() {
        $logged_in = $this->session->userdata("logged_in");
        return $logged_in;
    }

    function login($user_id, $email, $password) {
        $session_data['user_id']    = $user_id;
        $session_data['email']      = $email;
        $session_data['check_pass'] = $password ? 'checked' : '';

        $this->session->set_userdata('logged_in', $session_data);
    }

    function is_valid_session() {
        $logged_in = $this->session->userdata("logged_in");

        if($logged_in && $logged_in['user_id'] && $logged_in['email'] && $logged_in['check_pass'] == 'checked') {
            return TRUE;
        }
        return FALSE;
    }

    function is_admin() {
        $sess = $this->session->userdata("logged_in");

        if($sess){
            $user_id = $sess['user_id'];

            $this->db->select('role_id');
            $this->db->from('user');
            $this->db->where('user_id', $user_id); 

            $query = $this->db->get()->row();
            
            if($query->role_id == USER_ROLE_ADMIN) {
                return TRUE;
            }
        }

        return FALSE;
    }

    function get_user() {
        $sess = $this->session->userdata("logged_in");

        $data = array();
        if($sess){
            $email  = $sess['email'];
            $rs     = $this->get_by_email($email);
            
            if($rs) {
                $data['user_id']    = $rs->user_id;
                $data['full_name']  = $rs->full_name;
                $data['birthday']   = $rs->birthdate;
                $data['gender']     = $rs->gender;
                $data['email']      = $rs->email;

                return $data;
            }
        }

        return $data;
    }


}
