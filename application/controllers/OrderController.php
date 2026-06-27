<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel', 'orderModel');
        $this->load->model('QueueModel', 'queueModel');
    }

    public function create()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $queue = $this->queueModel->getCurrentQueue();

        $orderData = [
            'user_id' => $this->session->userdata('user_id'),
            'queue' => $queue,
            'table' => $data['table'],
            'subtotal' => $data['subtotal'],
            'tax' => $data['tax'],
            'total' => $data['total'],
            'payment' => $data['payment'],
            'items' => $data['items']
        ];

        $orderId = $this->orderModel->createOrder($orderData);

        if ($orderId) {
            $this->session->set_userdata('current_order', [
                'id' => $orderId,
                'queue' => $queue,
                'items' => $data['items']
            ]);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => true, 'id' => $orderId, 'queue' => $queue]));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false]));
        }
    }

    public function getHistory()
    {
        $history = $this->orderModel->getOrderHistory();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($history));
    }

    public function getActive()
    {
        $active = $this->orderModel->getActiveOrder();
        if (!$active) {
            $sessionOrder = $this->session->userdata('current_order');
            if ($sessionOrder && isset($sessionOrder['id'])) {
                $this->db->where('id', $sessionOrder['id']);
                $active = $this->db->get('orders')->row_array();
            }
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($active));
    }
}
?>
