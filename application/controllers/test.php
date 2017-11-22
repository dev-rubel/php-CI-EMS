<?php
function shifts($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']         = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');
            $data['teacher_id']   = $this->input->post('teacher_id');
            $this->db->insert('shift', $data);
            $shift_id = $this->db->insert_id();
            //create a section by default
            $data2['shift_id']  =   $shift_id;
            $data2['name']      =   'A';
            $this->db->insert('section' , $data2);

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/shifts/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']         = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');
            $data['teacher_id']   = $this->input->post('teacher_id');
            
            $this->db->where('shift_id', $param2);
            $this->db->update('shift', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/shifts/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('shift', array(
                'shift_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('shift_id', $param2);
            $this->db->delete('shift');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/shifts/', 'refresh');
        }
        $page_data['shifts']    = $this->db->get('shift')->result_array();
        $page_data['page_name']  = 'shift';
        $page_data['page_title'] = get_phrase('manage_shift');
        $this->load->view('backend/index', $page_data);
    }
