<?php
class User_model extends CI_Model {
    public function get_by_email($email) {
        $this->db->where('email', $email);
        return $this->db->get('users')->row_array();
    }
    
    public function create($data) {
        return $this->db->insert('users', $data);
    }
    
    public function get_all() {
        return $this->db->get('users')->result_array();
    }
}