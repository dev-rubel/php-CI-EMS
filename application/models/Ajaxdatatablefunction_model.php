<?php

class Ajaxdatatablefunction_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * stationary_category secton
     * @table = stationary_category     * 
    */

    public function get_stationary_category_name($stationary_category_id) 
    {
        $this->db->where('stationary_category_id',$stationary_category_id);
        $result = $this->db->get('stationary_category')->row()->name;
        return ucwords(str_replace('_', ' ', $result));
    }

    public function get_stationary_category_status($item_status) 
    {
        if($item_status == 1) {
            return 'IN';
        } else {
            return 'OUT';
        }
    }
    
    public function get_item_transaction_date($item_transaction_date) 
    {
        return date('d-m-Y',$item_transaction_date);
    }

    /**
     * stationary_items section
     * @table = stationary_items
    */
}


