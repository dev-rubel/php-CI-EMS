<?php
class Dashboard_model extends CI_Model
{
    function insert_logo_img($img,$title)
    {
        $arr = array(
            'info' => $title,
            'img_name' => $img
        );
        $this->db->where('id',1);
        $this->db->update('images',$arr);
        return true;
    }
    
    function get_logo_info()
    {
        $this->db->where('id',1);
        $result = $this->db->get('images')->result_array();
        return oneDim($result);
    }
    
    function update_textinfo_table($data,$col)
    {
        $this->db->where('id',1);
        $this->db->update('taxtinfo',array($col => $data));
        return true;
    }
    
    function insert_imgTable($name,$info, $tname)
    {
        $arr = array(
            'track_name' => $tname,
            'info' => $info,
            'img_name' => $name
        );
        $this->db->insert('images', $arr);
        return true;
    }
    
    function get_textInfoTable_info($col)
    {
        $this->db->select($col);
        $this->db->where('id', 1);
        $result = $this->db->get('taxtinfo')->result_array();
        return oneDim($result);
    }
    
    function get_imgTable_info($tname)
    {
        $this->db->where('track_name', $tname);
        $result = $this->db->get('images')->result_array();
        return $result;        
    }
    
    function insert_linkinfo_table($data,$tname)
    {
        $arr = array(
            'track_name' => $tname,
            'title' => $data['title'],
            'description' => $data['description'],
            'link' => $data['title_link'],
        );
        $this->db->insert('linkinfo', $arr);
        $iId = $this->db->insert_id();
        return $iId;
    }
    
    function get_linkinfoTable_info($tname)
    {
        $this->db->where('track_name', $tname);
        $result = $this->db->get('linkinfo')->result_array();
        return $result;   
    }
    
    function update_imgTable($id,$name,$info,$tname)
    {
        $arr = array(
            'track_name' => $tname,
            'info' => $info,
            'img_name' => $name
        );
        $this->db->where('id',$id);
        $this->db->update('images', $arr);
        return true;
    }
    
    function delete_imgTable_info($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('images');
        return true;
    }
    
    function update_linkinfo_table($data,$tname)
    {
        $arr = array(
            'track_name' => $tname,
            'title' => $data['title'],
            'description' => $data['description'],
            'link' => $data['title_link']
        );
        $this->db->where('id', $data['id']);
        $this->db->update('linkinfo', $arr);
        return true;
    }
    
    function delete_linkinfo_table($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('linkinfo');
        return true;
    }
    
    function get_schoolInfo()
    {
        $this->db->select('header_title');
        $result = $this->db->get('taxtinfo')->result_array();
        return oneDim($result);
    }
    
    function insertFiles($title, $filename)
    {
        $arr = array(
            'track_name' => 'files',
            'title' => $title,
            'description' => '',
            'link' => $filename
        );
        
        $this->db->insert('linkinfo', $arr);
        
        return true;
    }
    
    function delete_table_files($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('linkinfo');
        return true;
    }
}