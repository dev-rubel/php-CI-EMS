<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author 	: Joyonto Roy
 *	date		: 27 september, 2014
 *	Ekattor School Management System Pro
 *	http://codecanyon.net/user/Creativeitem
 *	support@creativeitem.com
 */

class Homemanage extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
		
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
                $this->load->model('dashboard_model');
		
    }
    
    function delete_files()
    {
        unlink('assets/otherFiles/'.$this->uri(4));
        $this->dashboard_model->delete_table_files($this->uri(3));
        $this->flashmsg('Deleted');
        redirect(base('homemanage', 'manage_pages'));
    }
    
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
        if (!$this->upload->do_upload('files'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->flashmsg($error['error'],'error');
            redirect(base('homemanage', 'manage_pages'));
        }
        else
        {
            $this->upload->data();
            $this->dashboard_model->insertFiles($_POST['filetitle'],$name.'.'.$ext);
            $this->flashmsg('Inserted with file');
            redirect(base('homemanage', 'manage_pages'));
        }
        else:
            $this->flashmsg('Please insert file', 'errror');
            redirect(base('homemanage', 'manage_pages'));
        endif;
    }
    
    function getPageInfo($value)
    {
        $names = $this->db->get_where('frontpages',array('track_name'=>$value))->row()->title;
        $mark = $this->db->get_where('frontpages',array('track_name'=>$value))->row()->description;
            $Response = array('name' => $names, 'mark' => $mark);
            echo json_encode($Response);
    }
    
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?homemanage/dashboard', 'refresh');
    }
    
    function change_logo()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'home/logoPage';
        $page_data['page_title'] = get_phrase('change_logo');
        $this->load->view('backend/index', $page_data);
    }
    
    function school_name()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'home/schoolNamePage';
        $page_data['page_title'] = get_phrase('school_name');
        $this->load->view('backend/index', $page_data);
    }
    
    function social_link()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'home/socialLinkPage';
        $page_data['page_title'] = get_phrase('social_links');
        $this->load->view('backend/index', $page_data);
    }
    
    function slider()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'home/sliderPage';
        $page_data['page_title'] = get_phrase('sliders');
        $this->load->view('backend/index', $page_data);
    }
    
    function important_notice()
	{
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'home/importantNoticePage';
        $page_data['page_title'] = get_phrase('important_notice');
        $this->load->view('backend/index', $page_data);
	}
    
    function notice()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'home/noticePage';
        $page_data['page_title'] = get_phrase('notice');
        $this->load->view('backend/index', $page_data);
    }

    function change_notice_status()
    {
        $this->db->update('linkinfo',array('status'=>$this->uri(4)),array('id'=>$this->uri(3)));
        if($this->uri(4)==1):
        $this->flashmsg('Notice Published');
        else:
        $this->flashmsg('Notice Drafted');
        endif;
        redirect(base('homemanage', 'notice'));
    }

    function change_imnotice_status()
    {
        $this->db->update('linkinfo',array('status'=>$this->uri(4)),array('id'=>$this->uri(3)));
        if($this->uri(4)==1):
        $this->flashmsg('Important Notice Published');
        else:
        $this->flashmsg('Important Notice Drafted');
        endif;
        redirect(base('homemanage', 'important_notice'));
    }
    
    function manage_pages()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_data'] = $this->db->get_where('linkinfo',array('track_name'=>'files'))->result_array();
        $page_data['page_name']  = 'home/managePages';
        $page_data['page_title'] = get_phrase('manage_pages');
        $this->load->view('backend/index', $page_data);
    }
    
    function important_link()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'home/importantLinkPage';
        $page_data['page_title'] = get_phrase('inportant_links');
        $this->load->view('backend/index', $page_data);
    }
    
    function location()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'home/locationPage';
        $page_data['page_title'] = get_phrase('location');
        $this->load->view('backend/index', $page_data);
    }
    
    function present()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'home/presentPage';
        $page_data['page_title'] = get_phrase('student_present_section');
        $this->load->view('backend/index', $page_data);
    }
    
    function gallery()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'home/galleryPage';
        $page_data['page_title'] = get_phrase('gallery_section');
        $this->load->view('backend/index', $page_data);
    }
    
    function admission_query()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'home/admission_query';
        $page_data['page_title'] = get_phrase('admission_query');
        $this->load->view('backend/index', $page_data);
    }
            
    function confirm_std()
    {
        $mobile = str_replace('%', '', $this->uri(4));
        $sms = $this->sms_infos();
        
        //send url
        $token = encryptor('encrypt', $this->uri(3));
        $url = 'http://freehtmltopdf.com/?convert='.base_url().'index.php?Home/check_token/'.$token;
        $shorten = $this->shorten($url);
        $msg = $sms['desc'].'+'.$shorten;
		//pd($msg);
		
        //call api function
        $smsId = $this->sms_api($sms['user'], $sms['pass'], $sms['title'], $msg, $mobile);
        if(is_numeric($smsId)==true){
            $smsToken = $smsId;
        }else{
            $smsToken = '';
        }
        $arr = array(
            'user_id' => $this->uri(3),
            'sms_token' => $smsToken,
            'date' => date('Y-m-d')
        );
        $this->db->insert('sms_token',$arr);
        
        //update status
        $this->db->where('id',$this->uri(3));
        $this->db->update('admit_std',array('status'=>1));
        $this->flashmsg('student_status_confirmd');
        redirect(base('Homemanage', 'admission_query'));
    }
    
    function pendding_std()
    {
        $this->db->where('id',$this->uri(3));
        $this->db->update('admit_std',array('status'=>0));
        $this->flashmsg('student_status_pendding');
        redirect(base('Homemanage', 'admission_query'));
    }
    
    function delete_admit_std()
    {
        unlink('assets/'.$this->uri(4));
        $this->db->where('id',$this->uri(3));
        $this->db->delete('admit_std');
        $this->flashmsg('student_deleted');
        redirect(base('Homemanage', 'admission_query'));
    }
    
    function sms_infos()
    {
        $data['user'] = $this->db->get_where('settings',array('type'=>'nihalit_sms_user'))->row()->description;
        $data['pass'] = $this->db->get_where('settings',array('type'=>'nihalit_sms_password'))->row()->description;
        
        $data['title'] = $this->db->get_where('settings',array('type'=>'sms_title'))->row()->description;
        $data['desc'] = $this->db->get_where('settings',array('type'=>'sms_description'))->row()->description;
        return $data;
    }
    
    function sms_api($user,$pass,$sender,$msg,$mobile)
    {
        $url = "http://api.zaman-it.com/api/sendsms/plain?user=$user&password=$pass&sender=$sender&SMSText=$msg&GSM=88$mobile";
        $mystring = $this->curl_url($url);
        return $mystring;
    }
    

    function long_sms_api($user,$pass,$sender,$msg,$mobile)
    {
        $url = "http://api.zaman-it.com/api/sendsms/plain?user=$user&password=$pass&sender=$sender&SMSText=$msg&GSM=88$mobile&type=longSMS";
        $mystring = $this->curl_url($url);
        return $mystring;
    }
	
	function sms_balance($user,$pass)
	{
		$url = "http://api.zaman-it.com/api/command?username=$user&password=$pass&cmd=Credits";
		$mystring = $this->get_data($url);
        return $mystring;
	}
    
    function get_data($url) 
    {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    function curl_url($url)
    {        
        $data = file_get_contents($url);
        if($data) {
            return true;
        }
        return true;
        
    }
    
    function update_admission_info()
    {
        $title = str_replace(' ', '+', $_POST['sms_title']);
        $this->db->where('type', 'sms_title');
        $this->db->update('settings',array('description'=>$title));
        
        $des = str_replace(' ', '+', $_POST['sms_description']);
        $this->db->where('type', 'sms_description');
        $this->db->update('settings',array('description'=>$des));
        
        $this->db->where('type', 'exam_date');
        $this->db->update('settings',array('description'=>$_POST['exam_date']));
        
        $this->db->where('type', 'exam_time');
        $this->db->update('settings',array('description'=>$_POST['exam_time']));

        $this->db->where('type', 'admission_session');
        $this->db->update('settings',array('description'=>$_POST['admission_session']));
                
        !empty($_POST['link_status'])?$_POST['link_status']=1:$_POST['link_status']=0;
        $this->db->where('type', 'link_status');
        $this->db->update('settings',array('description'=>$_POST['link_status']));
        
        $this->flashmsg('update_admission_setting');
        redirect(base('Homemanage', 'admission_query'));
    }
    
    //    MANAGE ADMISSION MARK
    
    function add_admission_result()
    {
        //pd($_POST);
        $session = $this->db->get_where('settings', 
                ['type'=>'admission_session'])
                    ->row()->description;
        $uniq_id = $this->db->get_where('admission_result',
                ['uniq_id'=>$_POST['uniq_id'], 'session' => $session])
                    ->row()->id;
        $id = $this->db->get_where('admit_std',
                ['uniq_id'=>$_POST['uniq_id'], 'session' => $session])
                    ->row()->id;
        $_POST['std_id'] = $id;
        $_POST['session'] = $session;
        if(!empty($uniq_id)):
            $this->db->update('admission_result',$_POST,['uniq_id'=>$uniq_id, 'session' => $session]);
            $this->flashmsg('Mark Updated');
            redirect(base('homemanage', 'admission_result'));
        else:
            $this->db->insert('admission_result',$_POST);
            $this->flashmsg('Mark Inserted');
            redirect(base('homemanage', 'admission_result'));
        endif;        
    }
    
    function getAdmitStdName($value)  //ajax response
    {
        $session = $this->db->get_where('settings', 
                        ['type'=>'admission_session'])
                                    ->row()->description;
        $namebn = $this->db->get_where('admit_std',
                        ['uniq_id'=>$value, 'status'=>'1', 'session' => $session])
                                    ->row()->namebn;
        $mark = $this->db->get_where('admission_result',
                        ['uniq_id'=>$value, 'session' => $session])
                                    ->row()->mark;
        $fnamebn = $this->db->get_where('admit_std',
                        ['uniq_id'=>$value, 'status'=>'1', 'session' => $session])
                                    ->row()->fnamebn;              
              
		if(empty($fnamebn)){
			$fname = '';
		}else{
			$fname = ' (পিতা: '.$fnamebn.')';
		}
		
        if(!empty($mark)){
            $stdMark = $mark;
        }else{
            $stdMark = '';
        }
		$Response = array('name' => $namebn.$fname, 'mark' => $stdMark);
		echo json_encode($Response);
        
    }
    
    function admission_result()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'home/admission_result';
        $page_data['page_title'] = get_phrase('admission_result');
        $this->load->view('backend/index', $page_data);
    }
    
    function getClassResult()
    {
        // pd($session);
        unset($_SESSION['flash_message']);
        unset($_SESSION['error']);
        !empty($_POST['group'])?$group=$_POST['group']:$group='';
        $session = $this->db->get_where('settings', 
            ['type'=>'admission_session'])
                    ->result_array();
        $session = $session[0]['description'];
        $this->db->select('*');
        $this->db->from('admit_std');
        $this->db->join('admission_result', 'admission_result.std_id = admit_std.id');
        $this->db->where('admit_std.class',$_POST['class']);
        $this->db->where('admit_std.group', $group);
        $this->db->where('admit_std.session', $session);
        $this->db->order_by('admission_result.mark','desc');
        $query = $this->db->get()->result_array();
        if(!empty($query)):
            $this->flashmsg('Found');
        else:
            $this->flashmsg('Not Found','error');
        endif;        
        $page_data['result']    = $query;
        $page_data['page_name']  = 'home/admission_result';
        $page_data['page_title'] = get_phrase('admission_result');
        $this->load->view('backend/index', $page_data);
    }

    public function transfer_admit_student()
    {
        $fee = $_POST['fee'];
        unset($_POST['fee']);
        
        $this->db->where('id',$_POST['student_id']);
        $data = $this->db->get('admit_std')->result_array();


        //pd($data[0]);
        //student table section
        $admint_student_id = $data[0]['id'];
        unset($data[0]['id']);
        unset($data[0]['student_id']);
        $stdInfo1 = array_slice($data[0], 0, 15);
        $studentInfo['jscinfo'] = $data[0]['jscinfo'];
        $studentInfo['birthday'] = $data[0]['date'];
        $studentInfo['mobile'] = $data[0]['mobile'];
        $studentInfo['sex'] = 'Male';
        $studentInfo['from_admit_std'] = 'Yes';
        $studentInfo['password'] = substr(md5(rand(0, 1000000)), 0, 7);
        $studentTable = array_merge($stdInfo1,$studentInfo);
        

        //pd($studentTable);
        $this->db->insert('student', $studentTable);
        $enrolInfo['student_id'] = $this->db->insert_id();
        $this->db->update('admit_std',array('student_id'=>$enrolInfo['student_id']),array('id'=>$admint_student_id));

        //student image rename and move to upload folder
        $ext = strtolower(pathinfo($data[0]['img'], PATHINFO_EXTENSION));
        copy('assets/'.$data[0]['img'], 'uploads/student_image/'.$enrolInfo['student_id'].'.'.$ext);


        //enroll table section
        unset($_POST['student_id']);
        $enrolInfo['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7); 
        $enrolInfo['date_added']     = strtotime(date("Y-m-d H:i:s"));
        $enrolInfo['year']           = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $enrolTable = array_merge($enrolInfo,$_POST);
        //pd($enrolTable);
        $this->db->insert('enroll', $enrolTable);


        //invoice table section
        $invoiceInfo['student_id']         = $enrolInfo['student_id'];
        $invoiceInfo['title']              = 'Admit Fee';
        $invoiceInfo['description']        = 'Admit Fee';
        $invoiceInfo['amount']             = $fee;
        $invoiceInfo['amount_paid']        = $fee;
        $invoiceInfo['due']                = '';
        $invoiceInfo['status']             = 'paid';
        $invoiceInfo['creation_timestamp'] = strtotime(date('m/d/Y'));
        $invoiceInfo['year']               = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
       
        $this->db->insert('invoice', $invoiceInfo);
        $invoice_id = $this->db->insert_id();

        //payment table section
        $paymentInfo['invoice_id']        =   $invoice_id;
        $paymentInfo['student_id']        =   $enrolInfo['student_id'];
        $paymentInfo['title']             =   'Admit Fee';
        $paymentInfo['description']       =   'Admit Fee';
        $paymentInfo['payment_type']      =   'income';
        $paymentInfo['method']            =   '1';
        $paymentInfo['amount']            =   $fee;
        $paymentInfo['timestamp']         =   strtotime(date('m/d/Y'));
        $paymentInfo['year']              =    $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $this->db->insert('payment' , $paymentInfo);
        
        $_SESSION['stdClass'] = $data[0]['class'];
        $_SESSION['stdGroup'] = notEmpty($data[0]['group']);
        redirect(base('homemanage', 'getClassResult'));
    }
	

    
    
    
            
            
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    function add_logo()
    {
        $img = mt_rand().'_logo_img';
        $this->upload->initialize(upload_file(500,1000,1000,$img));
        if ( ! $this->upload->do_upload('logo_img')) 
        {
           $error = array('error' => $this->upload->display_errors());
           $this->flashmsg($error['error'],'error');
           redirect(base('homemanage', 'change_logo'));
        }else 
        {          
           //Image Resizing            
            $this->load->library('image_lib', resize_file(130,130));
            if ( ! $this->image_lib->resize())
            {               
                set_flashmsg($this->image_lib->display_errors(), 'error');
                $this->flashmsg($this->image_lib->display_errors(),'error');
                redirect(base('homemanage', 'change_logo'));
            }
        }
        $img_name = $this->upload->file_name;
        unlink('assets/'.$_POST['preimg']);
        $this->dashboard_model->insert_logo_img($img_name,$_POST['title']);
        $this->flashmsg('logo_updated');
        redirect(base('homemanage', 'change_logo'));
    }
    
    function add_header_info()
    {
        $implod = implode('+', $_POST);
        $this->dashboard_model->update_textinfo_table($implod, 'header_title');
        $this->flashmsg('header_info_updated');
        redirect(base('homemanage', 'school_name'));
    }
    
    function add_social_link()
    {
        $implod = implode('+', $_POST);
        $this->dashboard_model->update_textinfo_table($implod, 'social_links');
        $this->flashmsg('links_updated');
        redirect(base('homemanage', 'social_link'));
    }
    
    function add_slider()
    {
        //pd($_POST);
        $implod = implode('+', $_POST);
        $img = mt_rand().'_slider_img';
        $this->upload->initialize(upload_file_slider(1000,2000,2000,$img));
        if ( ! $this->upload->do_upload('img')) 
        {
           $error = array('error' => $this->upload->display_errors());
           set_flashmsg($error['error'], 'error');
           redirect(base('homemanage', 'slider'));
        }else 
        {          
           //Image Resizing            
            $this->load->library('image_lib', resize_file(770,400));
            if ( ! $this->image_lib->resize())
            {               
                set_flashmsg($this->image_lib->display_errors(), 'error');
                redirect(base('homemanage', 'slider'));
            }
        }
        $img_name = $this->upload->file_name;
        $this->dashboard_model->insert_imgTable($img_name,$implod,'slider');
        $this->flashmsg('inserted');
        redirect(base('homemanage', 'slider'));
    }
    
    function update_slider()
    {
        //pd($_FILES);
        if(!empty($_FILES['img']['name'])){
            $id = $_POST['id'];
            $img = mt_rand().'_slider_img';
            $this->upload->initialize(upload_file_slider(1000,2000,2000,$img));
            if ( ! $this->upload->do_upload('img')) 
            {
               $error = array('error' => $this->upload->display_errors());
               $this->flashmsg($error['error'],'error');
               redirect(base('homemanage', 'slider'));
            }else 
            {          
               //Image Resizing            
                $this->load->library('image_lib', resize_file(770,400));
                if ( ! $this->image_lib->resize())
                {               
                    $this->flashmsg($this->image_lib->display_errors(),'error');
                    redirect(base('homemanage', 'slider'));
                }
            }
            unlink('assets/images/slider_image/'.$_POST['Preimg']);
            unset($_POST['Preimg']);
            unset($_POST['id']);
            $implod = implode('+', $_POST);
            $img_name = $this->upload->file_name;
            $this->dashboard_model->update_imgTable($id,$img_name,$implod,'slider');
            $this->flashmsg('Updated');
            redirect(base('homemanage', 'slider'));
        }else{
            
            $id = $_POST['id'];
            $img_name = $_POST['Preimg'];
            unset($_POST['Preimg']);
            unset($_POST['id']);
            unset($_POST['img']);
            $implod = implode('+', $_POST);
            $this->dashboard_model->update_imgTable($id,$img_name,$implod,'slider');
            $this->flashmsg('Updated without image');
            redirect(base('homemanage', 'slider'));
        }
    }
    
    function delete_slider()
    {
        $id = $this->uri(3);
        $name = $this->uri(4);
        unlink('assets/images/slider_image/'.$name);
        $this->dashboard_model->delete_imgTable_info($id);
        $this->flashmsg('Deleted');
        redirect(base('homemanage', 'slider'));
    }
    
    function add_notice()
    {
        $Insert_id = $this->dashboard_model->insert_linkinfo_table($_POST,'notice');
        if(!empty($_FILES['file']['name'])):
        $this->load->helper(array('form','url'));
        $config['upload_path'] = './assets/otherFiles/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = $Insert_id.'_noticepdf';
        $config['max_size']    = 200;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->flashmsg($error['error'],'error');
            redirect(base('homemanage', 'notice'));
        }
        else
        {
            $this->upload->data();
            $this->flashmsg('Inserted with PDF file');
            redirect(base('homemanage', 'notice'));
        }
        else:
            $this->flashmsg('Inserted without file');
            redirect(base('homemanage', 'notice'));
        endif;
        
    }
    
    function update_notice()
    {
        $this->dashboard_model->update_linkinfo_table($_POST,'notice');
        if(!empty($_FILES['file']['name'])):
        if(file_exists('assets/otherFiles/'.$_POST['id'].'_noticepdf.pdf')==true):
            unlink('assets/otherFiles/'.$_POST['id'].'_noticepdf.pdf');
        endif;        
        $this->load->helper(array('form','url'));
        $config['upload_path'] = './assets/otherFiles/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = $_POST['id'].'_noticepdf';
        $config['max_size']    = 3072;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->flashmsg($error['error'],'error');
            redirect(base('homemanage', 'notice'));
        }
        else
        {
            $this->upload->data();
            $this->flashmsg('Updated with PDF file');
            redirect(base('homemanage', 'notice'));
        }
        else:
            $this->flashmsg('Updated without file');
            redirect(base('homemanage', 'notice'));
        endif;
    }
    
    function delete_notice()
    {
        $this->dashboard_model->delete_linkinfo_table($this->uri(3));
        $this->flashmsg('Deleted');
        redirect(base('homemanage', 'notice'));
    }
    
    function add_important_notice()
	{
		$data['track_name'] = 'imnotice';
		$data['title'] = $_POST['title'];
		$data['description'] = $_POST['description'];
		$data['link'] = '';
		$this->db->insert('linkinfo',$data);
		$this->flashmsg('Insert important notice');
		redirect(base('homemanage', 'important_notice'));
	}
	
	function update_important_notice()
	{
		$this->dashboard_model->update_linkinfo_table($_POST,'imnotice');
		$this->flashmsg('Updated important notice');
		redirect(base('homemanage', 'important_notice'));		
	}
	
	function delete_important_notice()
	{
		$this->dashboard_model->delete_linkinfo_table($this->uri(3));
	$this->flashmsg('Deleted');
	redirect(base('homemanage', 'important_notice'));
	}
    
    
    function update_manage_pages()
    {
        $tname = $_POST['track_name'];
        unset($_POST['track_name']);
        $this->db->where('track_name',$tname);
        $this->db->update('frontpages',$_POST);
        $this->flashmsg('Updated');
        redirect(base('homemanage', 'manage_pages'));
    }
    
    function add_important_link()
    {
        $this->dashboard_model->insert_linkinfo_table($_POST,'link');
        $this->flashmsg('Inserted');
        redirect(base('homemanage', 'important_link'));
    }
    
    function update_link()
    {
        $this->dashboard_model->update_linkinfo_table($_POST,'link');
        $this->flashmsg('Updated');
        redirect(base('homemanage', 'important_link'));
    }
    
    function delete_link()
    {
        $this->dashboard_model->delete_linkinfo_table($this->uri(3));
        $this->flashmsg('Deleted');
        redirect(base('homemanage', 'important_link'));
    }
    
    function update_location()
    {
        $this->dashboard_model->update_textinfo_table($_POST['code'], 'location');
        $this->flashmsg('Updated');
        redirect(base('homemanage', 'location'));
    }
    
    function update_present_section()
    {
        if($_POST['status']=='on'){
            $status = 1;
        }else{
            $status = 0;
        }
        $this->dashboard_model->update_textinfo_table($status, 'present');
        $this->flashmsg('Updated');
        redirect(base('homemanage', 'present'));
    }
    
    function add_gallery()
    {
        //pd($_POST);
        $implod = implode('+', $_POST);
        $img = mt_rand().'_gallery_img';
        $this->upload->initialize(upload_file_gallery(1000,2000,2000,$img));
        if ( ! $this->upload->do_upload('img')) 
        {
           $error = array('error' => $this->upload->display_errors());
           $this->flashmsg($error['error'], 'error');
           redirect(base('homemanage', 'gallery'));
        }else 
        {                    
           //Image Resizing            
            $this->load->library('image_lib', resize_file(700,700));
            if ( ! $this->image_lib->resize())
            {               
                $this->flashmsg($this->image_lib->display_errors(), 'error');
                redirect(base('homemanage', 'gallery'));
            }
        }
        $img_name = $this->upload->file_name;
        $this->dashboard_model->insert_imgTable($img_name,$implod,'gallery');
        $this->flashmsg('Inserted');
        redirect(base('homemanage', 'gallery'));  
        
    }
    
     function update_galleryInfo()
    {
        if(!empty($_FILES['img']['name'])){
            $id = $_POST['id'];
            $img = mt_rand().'_gallery_img';
            $this->upload->initialize(upload_file_gallery(1000,2000,2000,$img));
            if ( ! $this->upload->do_upload('img')) 
            {
               $error = array('error' => $this->upload->display_errors());
               $this->flashmsg($error['error'], 'error');
               redirect(base('homemanage', 'gallery'));
            }else 
            {          
               //Image Resizing            
                $this->load->library('image_lib', resize_file(700,700));
                if ( ! $this->image_lib->resize())
                {               
                    $this->flashmsg($this->image_lib->display_errors(), 'error');
                    redirect(base('homemanage', 'gallery'));
                }
            }
            unlink('assets/images/gallery_image/'.$_POST['Preimg']);
            unset($_POST['Preimg']);
            unset($_POST['id']);
            $implod = implode('+', $_POST);
            $img_name = $this->upload->file_name;
            $this->dashboard_model->update_imgTable($id,$img_name,$implod,'gallery');
            $this->flashmsg('Updated');
            redirect(base('homemanage', 'gallery'));
        }else{
            
            $id = $_POST['id'];
            $img_name = $_POST['Preimg'];
            unset($_POST['Preimg']);
            unset($_POST['id']);
            unset($_POST['img']);
            $implod = implode('+', $_POST);
            $this->dashboard_model->update_imgTable($id,$img_name,$implod,'gallery');
            $this->flashmsg('update_without_image');
            redirect(base('homemanage', 'gallery'));
        }
    }
    
    function delete_galleryImg()
    {
        $id = $this->uri(3);
        $name = $this->uri(4);
        unlink('assets/images/gallery_image/'.$name);
        $this->dashboard_model->delete_imgTable_info($id);
        $this->flashmsg('Deleted');
        redirect(base('homemanage', 'gallery'));
    }
    
    function updateSiteStatus()
    {
    	//pd($_POST);
    	if(!empty($_POST)){
    		$this->db->where('type','webAppStatus');
    		$this->db->update('settings',array('description'=>1));
    		$this->flashmsg('Now Site On');
        	redirect(base('admin', 'system_settings'));
    	}else{
		$this->db->where('type','webAppStatus');
    		$this->db->update('settings',array('description'=>0));
    		$this->flashmsg('Now Site Off');
        	redirect(base('admin', 'system_settings'));
    	}
    
    }

    function update_site_color()
    {
        $this->db->where('title', 'main_color');
        $var = $this->db->update('frontpages', array('description' => $_POST['main_color']));

        $this->db->where('title', 'hover_color');
        $var = $this->db->update('frontpages', array('description' => $_POST['hover_color']));
        $this->flashmsg('Color Changed.');
        redirect(base('admin', 'system_settings'));
    }
	
 
    // ======== TRUNCATE TABLE SECTION
    

    function truncate_table_data()
    {
        $tableName = $this->input->post('truncate_table');
        if(empty($tableName)){
            $this->flashmsg('Please Select Table', 'error');
            redirect(base('admin', 'system_settings'));        
        }
        $this->db->truncate($tableName); 
        $tableName = ucwords(str_replace('_', ' ',$tableName));
        $this->flashmsg('Clean '.$tableName.' Table');
        redirect(base('admin', 'system_settings'));
    } 

    function cleanAdmitStdTable()
    {
        $this->db->truncate('admit_std'); 
        $this->flashmsg('Clean Admit Student Table');
        redirect(base('admin', 'system_settings'));
    }
    
    function cleanAdmitStdResultTable()
    {
        $this->db->truncate('admission_result'); 
        $this->flashmsg('Clean Admit Student Result Table');
        redirect(base('admin', 'system_settings'));
    }
    
    function cleanUrlTokenTable()
    {
        $this->db->truncate('admission_token'); 
        $this->flashmsg('Clean Url Token Table');
        redirect(base('admin', 'system_settings'));
    }
   
    
    
    //   ========= REUSEABLE FUNCTION
    function flashmsg($msg,$error = '')
    {
        if(!empty($error)):
            $this->session->set_flashdata('error' , get_phrase($msg));
        else:
            $this->session->set_flashdata('flash_message' , get_phrase($msg));
        endif;
    }
    
    function uri($uri)
    {
        $result = $this->uri->segment($uri);
        return $result;
    }
    
    function shorten($url)
    {
        $this->load->helper('bitlyurl');
        $params = array();
        $params['access_token'] = '84de1a5d29fb01105a4496292726a8b598b03328';
        $params['longUrl'] = $url;
        $params['domain'] = 'j.mp';
        $results = bitly_get('shorten', $params);
        return $results['data']['url'];
    }
}    