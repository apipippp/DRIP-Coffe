<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderModel extends CI_Model
{
    public function createOrder($orderData)
    {
        $this->db->trans_start();

        // Insert order
        $data = [
            'user_id' => $orderData['user_id'] ?? null,
            'queue_number' => $orderData['queue'],
            'table_number' => $orderData['table'],
            'subtotal' => $orderData['subtotal'],
            'tax' => $orderData['tax'],
            'total' => $orderData['total'],
            'payment_method' => $orderData['payment'],
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('orders', $data);
        $orderId = $this->db->insert_id();

        // Insert order items
        foreach ($orderData['items'] as $item) {
            $itemData = [
                'order_id' => $orderId,
                'menu_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price']
            ];
            $this->db->insert('order_items', $itemData);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return $orderId;
    }

    public function getOrderHistory()
    {
        $userId = $this->session->userdata('user_id');
        
        $this->db->select("o.*, GROUP_CONCAT(CONCAT(m.name, ' x', oi.quantity) SEPARATOR ' · ') as items");
        $this->db->from('orders o');
        $this->db->join('order_items oi', 'o.id = oi.order_id', 'left');
        $this->db->join('menu_items m', 'oi.menu_id = m.id', 'left');
        
        if ($userId) {
            $this->db->where('o.user_id', $userId);
        } else {
            // Jika tidak login, ambil 0 data agar JS mengambil dari localStorage
            $this->db->where('1 = 0', null, false);
        }
        
        $this->db->group_by('o.id');
        $this->db->order_by('o.created_at', 'DESC');
        $this->db->limit(50);
        return $this->db->get()->result_array();
    }

    public function getActiveOrder()
    {
        $userId = $this->session->userdata('user_id');
        if ($userId) {
            $this->db->where('user_id', $userId);
        } else {
            return null;
        }
        $this->db->where_in('status', ['pending', 'processing', 'completed']);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('orders');
        return $query->row_array();
    }
}
?>
