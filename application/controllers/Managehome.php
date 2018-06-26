<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nihal-IT Team
 *	date		: 1 October, 2016
 *	Bidyapith School Management System
 *	https://www.nihalit.com
 *	info@nihalit.com
 */

class Managehome extends CI_Controller
{
    private $running_year;
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
        $this->running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
		
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
        $this->load->model('dashboard_model');		
    }

    /**
     * ajax_home_menu_pages function
     * 
     * @return pageview
     */
    function ajax_home_menu_pages()
    {
        $niddle = explode('_',$_POST['pageName']);
        $upper = ucfirst($niddle[1]);
        $pageName = $niddle[0].$upper.'Page';
        $page_data['running_year'] = $this->running_year;
        $page_data['page_data'] = $this->db->get_where('linkinfo',array('track_name'=>'files'))->result_array();
        $page_data['page_name'] = $pageName;
        $this->load->view('backend/admin/home/'.$pageName, $page_data);
    }

    /* =========== START SOCIAL LINK SECTION ============ */
    /* 
    */

    /**
     * ===== SOCIAL LINK SECTION
     * ajax_update_social_link function
     * 
     * @return json
     */
    function ajax_update_social_link()
    {
        $check = check_array_value($_POST);
        if(!$check){
            $this->jsonMsgReturn(false,'Please Fill All Field Properly.');
        } else { 
            $implod = implode('+', $_POST);
            $this->dashboard_model->update_textinfo_table($implod, 'social_links');
            $this->jsonMsgReturn(true,'Edit Success.');
        }
    }

    /* 
    */
    /* =========== END SOCIAL LINK SECTION ============ */


    /* =========== START SLIDER SECTION ============ */
    /*
    */

    /**
     * ===== SLIDER SECTION
     * ajax_add_slider function
     * 
     * @return pageview
     */
    function ajax_add_slider()
    {
        $check = check_array_value($_POST);
        if($check == false && empty($_FILES['img']['name'])){
            $this->jsonMsgReturn(false,'Please Fill All Field Properly.');
        } else { 
            $implod = implode('+', $_POST);
            $img = mt_rand().'_slider_img';
            $this->upload->initialize(upload_file_slider(1000,2000,2000,$img));
            if ( ! $this->upload->do_upload('img')) {
                $error = array('error' => $this->upload->display_errors());
                $this->jsonMsgReturn(false,$error);
            } else {      
                $ext = explode('.',$_FILES['img']['name']);    
                //Image Resizing    

                $this->load->library('image_lib', resize_file(770,400));
                $this->image_lib->resize();
                $img_name = $this->upload->file_name;
                $this->dashboard_model->insert_imgTable($img_name,$implod,'slider');

                $htmlData = $this->load->view('backend/admin/ajax_elements/slider_table_holder' , '', true);
                $this->jsonMsgReturn(true,'Add Success.',$htmlData);
            }            
        }        
    }

    /**
     * ===== SLIDER SECTION
     * ajax_edit_slider function
     * 
     * @return json
     */
    function ajax_edit_slider()
    {
        $slider_id = $this->uri(3);  
        $page_data['slider_id']   = $slider_id;
        $htmlData = $this->load->view('backend/admin/ajax_elements/edit_slider_form_holder' , $page_data, true);
        $this->jsonMsgReturn(true,'Edit Mode.',$htmlData);
    }

    /**
     * ===== SLIDER SECTION
     * ajax_update_slider function
     * 
     * @return json
     */
    function ajax_update_slider()
    {
        if(!empty($_FILES['img']['name'])){
            $id = $_POST['id'];
            $img = mt_rand().'_slider_img';
            $this->upload->initialize(upload_file_slider(1000,2000,2000,$img));
            if ( ! $this->upload->do_upload('img')) {
               $error = array('error' => $this->upload->display_errors());
               $this->jsonMsgReturn(false,$error);
            } else {
               //Image Resizing            
                $this->load->library('image_lib', resize_file(770,400));  
                $this->image_lib->resize();              
            }
            unlink('assets/images/slider_image/'.$_POST['Preimg']);
            unset($_POST['Preimg']);
            unset($_POST['id']);
            $implod = implode('+', $_POST);
            $img_name = $this->upload->file_name;
            $this->dashboard_model->update_imgTable($id,$img_name,$implod,'slider');
            $status = 'Update With Image';
        } else {            
            $id = $_POST['id'];
            $img_name = $_POST['Preimg'];
            unset($_POST['Preimg']);
            unset($_POST['id']);
            unset($_POST['img']);
            $implod = implode('+', $_POST);
            $this->dashboard_model->update_imgTable($id,$img_name,$implod,'slider');
            $status = 'Update With Previous Image';
        }
        $htmlData['imageHolder'] = $this->load->view('backend/admin/ajax_elements/slider_table_holder' , '', true);
        $htmlData['addForm'] = $this->load->view('backend/admin/ajax_elements/add_slider_form_holder' , '', true);
        $this->jsonMsgReturn(true,$status,$htmlData);        
    }

    /**
     * ===== SLIDER SECTION
     * ajax_delete_slider function
     * 
     * @return json
     */
    function ajax_delete_slider()
    {
        $id = $this->uri(3);
        $id = explode('-',$id);
        $img_id = $id[0];
        $name = $id[1];
        unlink('assets/images/slider_image/'.$name);
        $this->dashboard_model->delete_imgTable_info($img_id);
        $this->jsonMsgReturn(true,'Delete Success');
    }

    /* 
    */
    /* =========== END SLIDER SECTION ============ */

    /* =========== START IMPORTANT NOTICE SECTION ============ */
    /* 
    */

    /**
     * ===== IMPORTANT NOTICE SECTION
     * ajax_add_important_notice function
     * 
     * @return json
     */
    function ajax_add_important_notice()
    {
        $check = check_array_value($_POST);
        if(!$check){
            $this->jsonMsgReturn(false,'Please Fill All Field Properly.');
        } else {
            $data['track_name'] = 'imnotice';
            $data['title'] = $_POST['title'];
            $data['description'] = $_POST['description'];
            $data['link'] = '';
            $this->db->insert('linkinfo',$data);

            $htmlData = $this->load->view('backend/admin/ajax_elements/important_notice_table_holder', '', true);
            $this->jsonMsgReturn(true,'Add Success.', $htmlData);
        }
    }

    /**
     * ===== IMPORTANT NOTICE SECTION
     * ajax_edit_important_notice function
     * 
     * @return json
     */
    function ajax_edit_important_notice()
    {
        $imNoticeId = $this->uri(3);
        $page_data['imNoticeId']   = $imNoticeId;
        $htmlData = $this->load->view('backend/admin/ajax_elements/edit_important_notice_form_holder' , $page_data, true);
        $this->jsonMsgReturn(true,'Edit Moad ON',$htmlData);
    }

    /**
     * ===== IMPORTANT NOTICE SECTION
     * ajax_update_important_notice function
     * 
     * @return json
     */
    function ajax_update_important_notice()
    {
        $check = check_array_value($_POST);
        if(!$check){
            $this->jsonMsgReturn(false,'Please Fill All Field Properly.');
        } else {
            $this->dashboard_model->update_linkinfo_table($_POST,'imnotice');

            $htmlData['noticeHolder'] = $this->load->view('backend/admin/ajax_elements/important_notice_table_holder', '', true);
            $htmlData['addForm'] = $this->load->view('backend/admin/ajax_elements/add_important_notice_form_holder', '', true);
            $this->jsonMsgReturn(true,'Update Success',$htmlData);
        }
    }

    /**
     * ===== IMPORTANT NOTICE SECTION
     * ajax_delete_important_notice function
     * 
     * @return json
     */
    function ajax_delete_important_notice()
    {
        $this->dashboard_model->delete_linkinfo_table($this->uri(3));
        $this->jsonMsgReturn(true,'Delete Success');
    } 

    /**
     * ===== IMPORTANT NOTICE SECTION
     * ajax_status_important_notice function
     * 
     * @return json
     */
    function ajax_status_important_notice()
    {
        $msg = '';
        $this->db->update('linkinfo',array('status'=>$this->uri(4)),array('id'=>$this->uri(3)));
        if($this->uri(4)==1):
            $msg = 'Important Notice Published';
        else:
            $msg = 'Important Notice Drafted';
        endif;
        $htmlData = $this->load->view('backend/admin/ajax_elements/important_notice_table_holder', '', true);
        $this->jsonMsgReturn(true,$msg,$htmlData);
    }

    /* 
    */
    /* =========== END IMPORTANT NOTICE SECTION ============ */

    /* =========== START REGULAR NOTICE SECTION ============ */
    /* 
    */

    /**
     * ===== REGULAR NOTICE SECTION
     * ajax_add_notice function
     * 
     * @return json
     */
    function ajax_add_notice()
    {
        $check = check_array_value($_POST,['file']);
        if(!$check){
            $this->jsonMsgReturn(false,'Please Fill All Field Properly.');
        } else {    
            $Insert_id = $this->dashboard_model->insert_linkinfo_table($_POST,'notice');
            if(!empty($_FILES['file']['name'])):
            $this->load->helper(array('form','url'));
            $config['upload_path'] = './assets/otherFiles/';
            $config['allowed_types'] = 'pdf';
            $config['file_name'] = $Insert_id.'_noticepdf';
            $config['max_size']    = 200;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());                
            } else {
                $this->upload->data();
                $msg = 'Inserted with PDF file';
            }
            else:
                $msg = 'Inserted without file';
            endif;
            $htmlData = $this->load->view('backend/admin/ajax_elements/notice_table_holder' , '', true);
            if(!empty($error)){
                $this->jsonMsgReturn(false,$error,$htmlData);
            } else {
                $this->jsonMsgReturn(true,$msg,$htmlData);
            }            
        }
    }

    /**
     * ===== REGULAR NOTICE SECTION
     * ajax_edit_notice function
     * 
     * @return json
     */
    function ajax_edit_notice()
    {
        $noticeID = $this->uri(3);
        $page_data['noticeID']   = $noticeID;
        $htmlData = $this->load->view('backend/admin/ajax_elements/edit_notice_form_holder' , $page_data, true);
        $this->jsonMsgReturn(true,'Edit Moad ON',$htmlData);
    }

    /**
     * ===== REGULAR NOTICE SECTION
     * ajax_update_notice function
     * 
     * @return json
     */
    function ajax_update_notice()
    {
        $check = check_array_value($_POST,['file']);
        if(!$check){
            $this->jsonMsgReturn(false,'Please Fill All Field Properly.');
        } else {
            $this->dashboard_model->update_linkinfo_table($_POST,'notice');
            if(!empty($_FILES['file']['name'])){
                if(file_exists('assets/otherFiles/'.$_POST['id'].'_noticepdf.pdf')==true){
                    unlink('assets/otherFiles/'.$_POST['id'].'_noticepdf.pdf');
                }
                $this->load->helper(array('form','url'));
                $config['upload_path'] = './assets/otherFiles/';
                $config['allowed_types'] = 'pdf';
                $config['file_name'] = $_POST['id'].'_noticepdf';
                $config['max_size']    = 3072;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('file')){
                    $error = array('error' => $this->upload->display_errors());                
                } else {
                    $this->upload->data();
                    $msg = 'Update with PDF file';
                }
            } else {
                $msg = 'Update without file';
            }

            $htmlData['noticeHolder'] = $this->load->view('backend/admin/ajax_elements/notice_table_holder', '', true);
            $htmlData['addForm'] = $this->load->view('backend/admin/ajax_elements/add_notice_form_holder', '', true);
            if(!empty($error)) {
                $this->jsonMsgReturn(false,$error,$htmlData);
            } else {
                $this->jsonMsgReturn(true,$msg,$htmlData);
            }
        }
    }

    /**
     * ===== REGULAR NOTICE SECTION
     * ajax_delete_notice function
     * 
     * @return json
     */
    function ajax_delete_notice()
    {
        $this->dashboard_model->delete_linkinfo_table($this->uri(3));
        $this->jsonMsgReturn(true,'Delete Success');
    }

    /* 
    */
    /* =========== END REGULAR NOTICE SECTION ============ */

    /* =========== START MANAGE PAGES SECTION ============ */
    /* 
    */

    /**
     * ===== MANAGE PAGES SECTION
     * getPageInfo function
     * 
     * @return json
     */
    function getPageInfo($value)
    {
        $names = $this->db->get_where('frontpages',array('track_name'=>$value))->row()->title;
        $mark = $this->db->get_where('frontpages',array('track_name'=>$value))->row()->description;
        $Response = array('name' => $names, 'mark' => $mark);
        echo json_encode($Response);
    }

    /**
     * ===== MANAGE PAGES SECTION
     * update_manage_pages function
     * 
     * @return redirect
     */
    function update_manage_pages()
    {
        $tname = $_POST['track_name'];
        unset($_POST['track_name']);
        $this->db->where('track_name',$tname);
        $this->db->update('frontpages',$_POST);
        $this->flashmsg('Updated');
        redirect(base('homemanage', 'manage_home'));
    }

    /**
     * ===== MANAGE PAGES SECTION
     * add_files function
     * 
     * @return redirect
     */
    function add_files()
    {
        if(!empty($_FILES['files']['name'])):
            $ext = end(explode(".", $_FILES['files']['name']));
            $name = str_replace(' ','-', $_POST['filetitle']).rand(99, 199);
            $this->load->helper(array('form','url'));
            $config['upload_path'] = './assets/otherFiles/';
            $config['allowed_types'] = '*';
            $config['file_name'] = $name;
            $config['max_size']    = 3072;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('files')) {
                $error = array('error' => $this->upload->display_errors());
                $this->flashmsg($error['error'],'error');
                redirect(base('homemanage', 'manage_home'));
            } else {
                $this->upload->data();
                $this->dashboard_model->insertFiles($_POST['filetitle'],$name.'.'.$ext);
                $this->flashmsg('Inserted with file');
                redirect(base('homemanage', 'manage_home'));
            }
        else:
            $this->flashmsg('Please insert file', 'errror');
            redirect(base('homemanage', 'manage_home'));
        endif;
    }

    /**
     * ===== MANAGE PAGES SECTION
     * delete_files function
     * 
     * @return redirect
     */
    function delete_files()
    {
        unlink('assets/otherFiles/'.$this->uri(4));
        $this->dashboard_model->delete_table_files($this->uri(3));
        $this->flashmsg('Deleted');
        redirect(base('homemanage', 'manage_home'));
    }

    /* 
    */
    /* =========== END MANAGE PAGES SECTION ============ */


    /* =========== START IMPORTANT LINK SECTION ============ */
    /* 
    */

    /**
     * ===== IMPORTANT LINK SECTION
     * ajax_add_important_link function
     * 
     * @return json
     */
    function ajax_add_important_link()
    {
        $check = check_array_value($_POST);
        if(!$check){
            $this->jsonMsgReturn(false,'Please Fill All Field Properly.');
        } else {
            $this->dashboard_model->insert_linkinfo_table($_POST,'link');

            $htmlData = $this->load->view('backend/admin/ajax_elements/important_link_table_holder', '', true);
            $this->jsonMsgReturn(true,'Link Created.',$htmlData);
        }
    }

    /**
     * ===== IMPORTANT LINK SECTION
     * ajax_edit_important_link function
     * 
     * @return json
     */
    function ajax_edit_important_link()
    {
        $imLink_id = $this->uri(3);
        $page_data['imLink_id']   = $imLink_id;
        $htmlData = $this->load->view('backend/admin/ajax_elements/edit_important_link_form_holder' , $page_data, true);
        $this->jsonMsgReturn(true,'Edit Moad ON',$htmlData);
    }

    /**
     * ===== IMPORTANT LINK SECTION
     * ajax_update_important_link function
     * 
     * @return json
     */
    function ajax_update_important_link()
    {
        $check = check_array_value($_POST);
        if(!$check){
            $this->jsonMsgReturn(false,'Please Fill All Field Properly.');
        } else {
            $this->dashboard_model->update_linkinfo_table($_POST,'link');

            $htmlData['imLinkTable'] = $this->load->view('backend/admin/ajax_elements/important_link_table_holder', '', true);
            $htmlData['addForm'] = $this->load->view('backend/admin/ajax_elements/add_important_link_form_holder', '', true);
            $this->jsonMsgReturn(true,'Update Success',$htmlData);
        }
    }

    /**
     * ===== IMPORTANT LINK SECTION
     * ajax_delete_link function
     * 
     * @return json
     */
    function ajax_delete_link()
    {
        $this->dashboard_model->delete_linkinfo_table($this->uri(3));
        $this->jsonMsgReturn(true,'Delete Success');
    }

    /* 
    */
    /* =========== END IMPORTANT LINK SECTION ============ */


    /* =========== START LOCATION PAGE SECTION ============ */
    /* 
    */

    /**
     * ===== LOCATION PAGE SECTION
     * ajax_delete_link function
     * 
     * @return json
     */
    function ajax_update_location()
    {
        $check = check_array_value($_POST);
        if(!$check){
            $this->jsonMsgReturn(false,'Please Fill All Field Properly.');
        } else {
            $this->dashboard_model->update_textinfo_table($_POST['code'], 'location');

            $htmlData = $this->load->view('backend/admin/ajax_elements/location_iframe_holder', '', true);
            $this->jsonMsgReturn(true,'Update Location',$htmlData);
        }
    }

    /* 
    */
    /* =========== END LOCATION PAGE SECTION ============ */


    /* =========== START PRESENT PAGE SECTION ============ */
    /* 
    */

    /**
     * ===== PRESENT PAGE SECTION
     * ajax_update_present_section function
     * 
     * @return json
     */
    function ajax_update_present_section()
    {
        if($_POST['status']=='on'){
            $status = 1;
            $msg = 'Website is now <b>Online</b>';
        }else{
            $status = 0;
            $msg = 'Website is now <b>Offline</b>';
        }
        $this->dashboard_model->update_textinfo_table($status, 'present');
        $this->jsonMsgReturn(true,$msg);
    }
    
    /* 
    */
    /* =========== END PRESENT PAGE SECTION ============ */


    /* =========== START GALLERY PAGE SECTION ============ */
    /* 
    */

    /**
     * ===== GALLERY PAGE SECTION
     * ajax_add_gallery function
     * 
     * @return json
     */
    function ajax_add_gallery()
    {
        $check = check_array_value($_POST);
        if($check == false && empty($_FILES['img']['name'])){
            $this->jsonMsgReturn(false,'Please Fill All Field Properly.');
        } else { 
            $implod = implode('+', $_POST);
            $img = mt_rand().'_gallery_img';
            $this->upload->initialize(upload_file_gallery(1000,2000,2000,$img));
            if ( ! $this->upload->do_upload('img')) {
                $error = array('error' => $this->upload->display_errors());
                $this->jsonMsgReturn(false,$error);
            } else {          
                //Image Resizing            
                $this->load->library('image_lib', resize_file(700,700));
                $this->image_lib->resize();

                $img_name = $this->upload->file_name;
                $this->dashboard_model->insert_imgTable($img_name,$implod,'gallery');

                $htmlData = $this->load->view('backend/admin/ajax_elements/gallery_table_holder' , '', true);
                $this->jsonMsgReturn(true,'Add Success.',$htmlData);
            }            
        }
    }

    /**
     * ===== GALLERY PAGE SECTION
     * ajax_edit_gallery function
     * 
     * @return json
     */
    function ajax_edit_gallery()
    {
        $gallery_id = $this->uri(3);  
        $page_data['gallery_id']   = $gallery_id; 
        $htmlData = $this->load->view('backend/admin/ajax_elements/edit_gallery_form_holder' , $page_data, true);
        $this->jsonMsgReturn(true,'Edit Mode.',$htmlData);
    }

    /**
     * ===== GALLERY PAGE SECTION
     * ajax_update_gallery function
     * 
     * @return json
     */
    function ajax_update_gallery()
    {
        if(!empty($_FILES['img']['name'])){
            $id = $_POST['id'];
            $img = mt_rand().'_gallery_img';
            $this->upload->initialize(upload_file_gallery(1000,2000,2000,$img));
            if ( ! $this->upload->do_upload('img')) {
               $error = array('error' => $this->upload->display_errors());
               $this->jsonMsgReturn(false,$error);
            } else {
               //Image Resizing            
                $this->load->library('image_lib', resize_file(700,700));   
                $this->image_lib->resize();           
            }
            unlink('assets/images/gallery_image/'.$_POST['Preimg']);
            unset($_POST['Preimg']);
            unset($_POST['id']);
            $implod = implode('+', $_POST);
            $img_name = $this->upload->file_name;
            $this->dashboard_model->update_imgTable($id,$img_name,$implod,'gallery');
            $status = 'Update With Image';
        } else {            
            $id = $_POST['id'];
            $img_name = $_POST['Preimg'];
            unset($_POST['Preimg']);
            unset($_POST['id']);
            unset($_POST['img']);
            $implod = implode('+', $_POST);
            $this->dashboard_model->update_imgTable($id,$img_name,$implod,'gallery');
            $status = 'Update With Previous Image';
        }        
        $htmlData['imageHolder'] = $this->load->view('backend/admin/ajax_elements/gallery_table_holder', '', true);
        $htmlData['addForm'] = $this->load->view('backend/admin/ajax_elements/add_gallery_form_holder', '', true);
        $this->jsonMsgReturn(true,$status,$htmlData);
    }

    /**
     * ===== GALLERY PAGE SECTION
     * ajax_delete_galleryImg function
     * 
     * @return json
     */
    function ajax_delete_galleryImg()
    {
        $id = $this->uri(3);
        $id = explode('-',$id);
        $img_id = $id[0];
        $name = $id[1];
        unlink('assets/images/gallery_image/'.$name);
        $this->dashboard_model->delete_imgTable_info($img_id);
        $this->jsonMsgReturn(true,'Delete Success',$name);
    }

    /* 
    */
    /* =========== END GALLERY PAGE SECTION ============ */
}