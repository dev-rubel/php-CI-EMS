<?php

class Home_model extends CI_Model{
    
    function get_headerInfo()
    {
        $data['logo'] = oneDim($this->db->get_where('images',array('id'=>1))->result_array());
        $data['textInfo'] = oneDim($this->db->get_where('taxtinfo',array('id'=>1))->result_array());
        $data['imnoticeInfo'] = $this->db->get_where('linkinfo',array('track_name'=>'imnotice','status'=>1))->result_array();
        $data['colors'] = $this->db->get_where('frontpages', array('track_name' => 'colors'))->result_array();
        return $data;
    }
    
    function get_contentInfo()
    {
        $data['sliderInfo'] = $this->db->get_where('images',array('track_name'=>'slider'))->result_array();
        $data['galleryInfo'] = $this->db->get_where('images',array('track_name'=>'gallery'))->result_array();
        $data['noticeInfo'] = $this->db->get_where('linkinfo',array('track_name'=>'notice','status'=>1))->result_array();
        $data['linkInfo'] = $this->db->get_where('linkinfo',array('track_name'=>'link'))->result_array();
        $data['textInfo'] = oneDim($this->db->get_where('taxtinfo',array('id'=>1))->result_array());
        return $data;
    }
    
    function get_footerInfo()
    {
        $data['textInfo'] = oneDim($this->db->get_where('taxtinfo',array('id'=>1))->result_array());
        return $data;
    }
    
    function get_noticeDetails($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->get('linkinfo')->result_array();
        return oneDim($result);
    }
    
    function get_msgDetails($id)
    {
        $this->db->select($id);
        $result = $this->db->get('taxtinfo')->result_array();
        return oneDim($result);
    }
    
    function insert_admit_std_info($data)
    {
        //pd($data);
        $this->db->insert('admit_std',$data);
        $id = $this->db->insert_id();
        
        $token['token'] = encryptor('encrypt', $id);
        $token['date'] = date('Y-m-d');
        $this->db->insert('admission_token',$token);
        return $token['token'];
    }
}

    