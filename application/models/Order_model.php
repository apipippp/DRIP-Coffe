<?php
class Order_model extends CI_Model {
    public function get_all_orders() {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('orders')->result_array();
    }
    
    public function sum_revenue() {
        $this->db->select_sum('total');
        $this->db->where('status', 'completed');
        $result = $this->db->get('orders')->row();
        return (float)($result->total ?? 0);
    }
    
    public function count_all() {
        return $this->db->count_all('orders');
    }
    
    public function get_all_completed() {
        $this->db->where('status', 'completed');
        $this->db->order_by('updated_at', 'DESC');
        return $this->db->get('orders')->result_array();
    }

    public function get_daily_completed_revenue($start_date = null, $end_date = null) {
        $this->db->select('DATE(updated_at) as date, COUNT(id) as total_orders, SUM(total) as revenue');
        $this->db->where('status', 'completed');
        if ($start_date) $this->db->where('DATE(updated_at) >=', $start_date);
        if ($end_date) $this->db->where('DATE(updated_at) <=', $end_date);
        $this->db->group_by('DATE(updated_at)');
        $this->db->order_by('DATE(updated_at)', 'DESC');
        return $this->db->get('orders')->result_array();
    }

    public function get_completed_by_date($date) {
        $this->db->where('status', 'completed');
        $this->db->where('DATE(updated_at)', $date);
        $this->db->order_by('queue_number', 'ASC');
        $orders = $this->db->get('orders')->result_array();
        foreach ($orders as &$order) {
            $this->db->select('order_items.*, menu_items.name');
            $this->db->join('menu_items', 'menu_items.id = order_items.menu_id', 'left');
            $this->db->where('order_id', $order['id']);
            $order['items'] = $this->db->get('order_items')->result_array();
        }
        return $orders;
    }

    public function get_completed_revenue_by_date($date) {
        $this->db->select_sum('total');
        $this->db->where('status', 'completed');
        $this->db->where('DATE(updated_at)', $date);
        $result = $this->db->get('orders')->row_array();
        return (float)($result['total'] ?? 0);
    }

    public function get_all_pending() {
        $this->db->where('status', 'pending');
        $this->db->order_by('queue_number', 'ASC');
        return $this->db->get('orders')->result_array();
    }
    
    public function get_all_processing() {
        $this->db->where('status', 'processing');
        $this->db->order_by('queue_number', 'ASC');
        return $this->db->get('orders')->result_array();
    }
    
    public function get($id) {
        return $this->db->get_where('orders', ['id' => $id])->row_array();
    }
    
    public function get_with_items($id) {
        $order = $this->get($id);
        if ($order) {
            $this->db->select('order_items.*, menu_items.name');
            $this->db->join('menu_items', 'menu_items.id = order_items.menu_id', 'left');
            $this->db->where('order_id', $id);
            $order['items'] = $this->db->get('order_items')->result_array();
        }
        return $order;
    }
    
    public function update_status($id, $status) {
        $this->db->where('id', $id);
        return $this->db->update('orders', ['status' => $status]);
    }
}
?>
