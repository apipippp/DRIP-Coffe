<?php
class Transaction_model extends CI_Model {
    public function create($data) {
        return $this->db->insert('transactions', $data);
    }
    
    public function get_all() {
        $this->db->select('transactions.*, users.name as kasir_name, orders.table_number');
        $this->db->join('users', 'users.id = transactions.kasir_id', 'left');
        $this->db->join('orders', 'orders.id = transactions.order_id');
        return $this->db->get('transactions')->result_array();
    }
    
    public function get_summary($start_date, $end_date) {
        $this->db->select_sum('total');
        $this->db->where('status', 'paid');
        $this->db->where('created_at >=', $start_date);
        $this->db->where('created_at <=', $end_date);
        return $this->db->get('transactions')->row_array();
    }
    
    public function get_daily_summary($date) {
        // Untuk chart
        $this->db->select('HOUR(created_at) as hour, SUM(total) as total');
        $this->db->where('status', 'paid');
        $this->db->where('DATE(created_at)', $date);
        $this->db->group_by('HOUR(created_at)');
        return $this->db->get('transactions')->result_array();
    }
}