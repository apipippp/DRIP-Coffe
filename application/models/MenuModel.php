<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MenuModel extends CI_Model
{
    public function getAllMenu()
    {
        $this->db->order_by('category', 'ASC');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('menu_items');
        return $query->result_array();
    }

    public function getMenuByCategory($category)
    {
        $this->db->where('category', $category);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('menu_items');
        return $query->result_array();
    }

    public function getMenuItem($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('menu_items');
        return $query->row_array();
    }
}
?>