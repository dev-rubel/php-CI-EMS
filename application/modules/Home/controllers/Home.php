<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//use Dompdf\Dompdf;
class Home extends MX_Controller {
     function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('home_model');
        
        
    }
    function index()
    {
       	$this->load_page('content', 'Home Page');
        
    }
    
    function detailsPage($data='')
    {
        $this->load_page('details', 'Details Info', $data);
    }
    
    function underConstraction()
    {
    	$this->load->view('underConstraction', '', true);
    }
    
    function noticeView()
    {
        $info = $this->home_model->get_noticeDetails($this->uri(3));
        $data['noticeId'] = $this->uri(3);
        $data['Dtitle'] = $info['title'];
        $data['Ddescription'] = $info['description'];
        $this->detailsPage($data);
    }
    
    function massageDetails()
    {
        $this->detailsPage();
    }
    
    function registration_online()
    {
        $this->load_page('registrationOnline','Registration Online');
    }
	
	function allNoticePage()
	{
		$this->load_page('allNotice','All Notice');
	}
    
    function confirmpage()
    {
        $this->load_page('confirmpage','Confirm Submission');
    }
    
    function test()
    {
        $data['std_info'] = $this->db->get_where('admit_std',array('id'=>43))->result_array();      
        $this->load->view('printform', $data);
//        
//        $this->load->library('mpdf');
//        $mpdf=new mPDF('','A4',14,'nikosh'); 
//        //$mpdf->SetHTMLHeader('<img style="margin-bottom: 30px;" src="https://1.bp.blogspot.com/-boQWvVPqHtQ/V_CmldvMVgI/AAAAAAAAAPY/y9cxS27EvPkSMhy6tycJoU70r7PeT8g1QCLcB/s1600/Capture3.JPG"/>');
////$mpdf->AddPage('', // L - landscape, P - portrait 
////        '', '', '', '',
////        5, // margin_left
////        5, // margin right
////       60, // margin top
////       30, // margin bottom
////        0, // margin header
////        0); // margin footer
//$data['std_info'] = $this->db->get_where('admit_std',array('id'=>45))->result_array();    
//$html = $this->load->view('printform',$data,true);
//    $mpdf->WriteHTML($html);
//    $mpdf->Output();
//    exit();
    }
	
	
	function meritlistPage()
	{
		$uri = $_SERVER['REQUEST_URI'];
		$url = array_slice(explode('/',$uri),-2,2);

		if(is_numeric(end($url))){
			$info['class'] = $url[1];
			$info['group'] = '';
		}else{
			$info['class'] = $url[0];
			$info['group'] = $url[1];
		}
		if(!empty($info['group'])){
			$fileName = 'class-'.$info['class'].'('.$info['group'].')'.'-meritlist.pdf';
		}else{
			$fileName = 'class-'.$info['class'].'-meritlist.pdf';
		}
		$this->load->library('m_pdf');
		$html = $this->load->view('meritlist', $info, true);
		
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($fileName,"D"); 
		exit;
	}
            
    function admit_student()
    {
    	$formEmail = $this->db->get_where('settings',array('type'=>'system_email'))->row()->description;
    	$info = $this->ciValidation();
        if($info=='0'):
    
        if($_POST['class']<9){
            unset($_POST['group']);
            unset($_POST['groups']);
            $_POST['jscinfo']='';
        }elseif($_POST['class']==9){
            unset($_POST['groups']);
            $_POST['jscinfo'] = implode(',', $_POST['jscinfo']);
        }else{
            $_POST['group'] = $_POST['groups'];
            unset($_POST['groups']);
            $_POST['jscinfo'] = implode(',', $_POST['jscinfo']);
        }

        //pd($_POST);
        if(!empty($_FILES['img']['name'])):
        $img = mt_rand().'_admitstd';
        $this->upload->initialize(upload_file(100,300,300,$img));
        if ( ! $this->upload->do_upload('img')) 
        {
           $error = array('error' => $this->upload->display_errors());
           set_flashmsg($error['error'], 'error');
           redirect(base('Home', 'registration_online'));
        } else {          
           //Image Resizing            
            $this->load->library('image_lib', resize_file(180,180));
            if ( ! $this->image_lib->resize())
            {               
                set_flashmsg($this->image_lib->display_errors(), 'error');
                redirect(base('Home', 'registration_online'));
            }
        }
        $img_name = $this->upload->file_name;
        $_POST['img'] = $img_name;
        endif;
        
        $_POST['date'] = date("Y-m-d", strtotime($_POST['date']));
        $token = $this->home_model->insert_admit_std_info($_POST);
        $url = base_url().'index.php?Home/check_token/'.$token;
        $shorten = $this->shorten($url);
        $this->session->set_flashdata('token_url',$url);
        
        if(!empty($_POST['email'])):
        $this->send_email($formEmail, $_POST['email'], 'Admission Download Form', "This link work only 30 days\n$shorten");
        endif;
        set_flashmsg('Your form successfully submitted and wating for approval. You will receive a confirmation sms within 24 hours.','succ');
        redirect(base('Home', 'confirmpage'));
        
        endif;
    
    }
	
	function contact_mail()
    {
	$toEmail = $this->db->get_where('settings',array('type'=>'system_email'))->row()->description;
	$this->load->library('email');
        $this->email->from($_POST['email'], $_POST['name']);
        $this->email->to($toEmail);
        $this->email->subject('Mail From School Website');
        $this->email->message($_POST['description']);
        $this->email->send();
	set_flashmsg('Your Message Has Been Successfully Sent.','succ');
        redirect(base('Home', ''));
    }
            
    function check_token()
    {
    	$id = encryptor('decrypt', $this->uri(3));
        $data['std_info'] = $this->db->get_where('admit_std',array('id'=>$id))->result_array();
        $name = $this->db->get_where('admit_std',array('id'=>$id))->row()->name;
        $fname = $this->db->get_where('admit_std',array('id'=>$id))->row()->fname;      
        $fileName = ucwords(strtolower(str_replace(' ','-', $name))).'('.ucwords(strtolower(str_replace(' ','-', $fname))).')'.'.pdf';
        $this->load->library('m_pdf');
        //pd($data);
	$html = $this->load->view('pdfPrint', $data, true);
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($fileName,"D"); 
	exit;
    }
            
    function confirm_submit()
    {
        $data['std_info'] = $this->db->get_where('admit_std',array('id'=>37))->result_array();
        $this->load->helper(array('dompdf', 'file'));
        // page info here, db calls, etc.     
        $html = $this->load->view('printform', $data, true);
        $data = pdf_create($html);
        write_file('name', $data);
    }


            
    function load_page($page, $title = '', $data2 = '')
    {
    $status = $this->db->get_where('settings',array('type'=>'webAppStatus'))->row()->description;
        if($status==0){
        	$this->load->view('underConstraction','');
        }else{
        $data2['title'] = $title;
        $data3['head'] = $this->home_model->get_headerInfo();
        $data3['header_img'] = $this->db->get_where('settings', array('type'=>'headerImg'))->row()->description;
        $data2['contentInfo'] = $this->home_model->get_contentInfo();
        $data4['footerInfo'] = $this->home_model->get_footerInfo();
        $data['header'] = $this->load->view('header', $data3, true);
        $data['footer'] = $this->load->view('footer', $data4, true);
        $data['content'] = $this->load->view($page, $data2, true);
        $this->load->view('home_master', $data);
        }
        
    }
    
    function uri($uri)
    {
        $result = $this->uri->segment($uri);
        return $result;
    }
    
    function send_email($form, $to, $sub, $msg)
    {
        $this->load->library('email');
        $this->email->from($form, 'HAH-SCHOOL');
        $this->email->to($to);
        $this->email->subject($sub);
        $this->email->message($msg);
        $this->email->send();
        return true;
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
    
    function ciValidation()
    {
    
    	$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
    	$config = array(
        array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
        ),
        array(
                'field' => 'namebn',
                'label' => 'BanglaName',
                'rules' => 'required'
        ),
        array(
                'field' => 'fname',
                'label' => 'FatherName',
                'rules' => 'required'
        ),
        array(
                'field' => 'fnamebn',
                'label' => 'FatherNameBangla',
                'rules' => 'required'
        ),
        array(
                'field' => 'mname',
                'label' => 'MotherName',
                'rules' => 'required'
        ),
        array(
                'field' => 'mnamebn',
                'label' => 'MotherNameBangla',
                'rules' => 'required'
        ),
        array(
                'field' => 'paadress',
                'label' => 'PermanentAddress',
                'rules' => 'required'
        ),
        array(
                'field' => 'praddress',
                'label' => 'PresentAddress',
                'rules' => 'required'
        ),
        array(
                'field' => 'preschoolname',
                'label' => 'PreviousSchoolName',
                'rules' => 'required'
        ),
        array(
                'field' => 'preschooladd',
                'label' => 'PreviousSchoolAddress',
                'rules' => 'required'
        ),
        array(
                'field' => 'date',
                'label' => 'DateOfBirth',
                'rules' => 'required'
        ),
        array(
                'field' => 'mobile',
                'label' => 'GuardianMobile',
                'rules' => 'numeric'
        )
	);
	
	$this->form_validation->set_rules($config);
	
	if ($this->form_validation->run() == FALSE)
        {
		$this->load_page('registrationOnline','Registration Online');
        }
        else
        {
		return '0';
        }
    }
    
}