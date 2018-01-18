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

    function getMetaInfo()
    {
        $schoolInfo = $this->db->get_where('settings', 
            ['type'=>'school_information'])
                    ->row()->description;
        $schoolInfo = explode('+',$schoolInfo);
        $data['schoolName'] = $schoolInfo[0];
        $data['location'] = $schoolInfo[1];
        $data['eiin'] = $schoolInfo[2];
        $data['schoolEmail'] = $schoolInfo[3];
        $data['schoolPhone'] = $schoolInfo[4];
        return $data;
    }

    function get_admit_std_info_join($data)
    {        
        $session = $data['session'];
        $this->db->select('*');
        $this->db->from('admit_std');
        //$this->db->join('admission_result', 'admission_result.std_id = admit_std.id');
        // $this->db->where('admit_std.class',$data['class']);
        // $this->db->where('admit_std.group', $data['group']);
        //$this->db->where('admit_std.session', $session);
        $this->db->where('session', $session);
        $this->db->where('status', 0);
        $this->db->or_where('status', 1);
        //$this->db->order_by('admission_result.mark','desc');
        $query = $this->db->get()->result_array();
        return $query;
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
        $session = $this->db->get_where('settings', 
            ['type'=>'admission_session'])
                    ->result_array();
        $data['session']  =  $session[0]['description'];
        $year = substr($data['session'], -2);
        $class = $data['class'];


        $this->db->like('uniq_id', $year, 'after');
        $this->db->where('session', $session[0]['description']);
        $exist = $this->db->get('admit_std')->result_array();
        if(!empty($exist)) {     
            $last = end($exist);
            $uniq_id = str_pad(substr($last['uniq_id'], -4)+1, 4, '0', STR_PAD_LEFT);
            $data['uniq_id'] = $year.$class.$uniq_id;
        } else {
            $uniq_id = str_pad(1, 4, '0', STR_PAD_LEFT);
            $data['uniq_id'] = $year.$class.$uniq_id;
        }


        $data['sex'] = $data['sex'] == 1?'male':'female';
        $this->db->insert('admit_std',$data);
        $id = $this->db->insert_id();
        
        $token['token'] = encryptor('encrypt', $id);
        $token['date'] = date('Y-m-d');
        $this->db->insert('admission_token',$token);
        return $token['token'];
    }
}

    