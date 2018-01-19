<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//use Dompdf\Dompdf;
class Home extends MX_Controller {

    protected $systemTitleName;
     function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('home_model');
        $this->systemTitleName = $this->db->get_where('settings' , array('type' =>'system_title_english'))->row()->description;
        
        
    }
    function index()
    {
        /* DYNAMIC SITE COLOR IN CSS FILE */
        $mainColor = $this->db->get_where('frontpages',['title'=>'main_color'])->row()->description;
        $hoverColor = $this->db->get_where('frontpages',['title'=>'hover_color'])->row()->description;
        $exists = file_exists('assets/siteColor.txt');        
        write_file('assets/siteColor.txt', $mainColor.'|'.$hoverColor);        
        
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
    
    function download_online_addmission_student_info()
    {
        $data['session'] = $this->db->get_where('settings', array('type' => 'admission_session'))->row()->description;
        // DOWNLOAD SPACIFIC CLASS INFORMATION
            // $uri = $_SERVER['REQUEST_URI'];
            // $url = array_slice(explode('/',$uri),-2,2);

            // if(is_numeric(end($url))){
            //     $data['class'] = $url[1];
            //     $class_id = $url[1];
            //     $data['group'] = '';
            //     $className = $this->db->get_where('class',
            //         ['class_id'=>$class_id])->row()->name;
            // } else {
            //     $data['class'] = $url[0];
            //     $data['group'] = $url[1];
            //     $class_id = $url[0];
            //     $group_id = $url[1];  
            //     $className = $this->db->get_where('class',
            //         ['class_id'=>$class_id])->row()->name;
            //     $groupName = $this->db->get_where('group',
            //         ['group_id'=>$group_id])->row()->name;          
            // }
        // DOWNLOAD SPACIFIC CLASS INFORMATION -- END

        $result = $this->home_model->get_admit_std_info_join($data);
        // pd($result);        

        $this->load->library('excel');
        // SET CUSTOM COLUMN WIDTH -- START
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth("20");
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth("18");
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth("18");
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth("25");
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth("23");
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth("11");
        // SET CUSTOM COLUMN WIDTH -- END

        $this->excel->setActiveSheetIndex(0); // SELECT PAGE        
        $this->excel->getActiveSheet()->setTitle($data['session'].' Applied Students'); // PAGE TITLE        
        $this->excel->getActiveSheet()->freezePane('A2'); // FREEZE TOP ROW
        // SET TOP ROW VALUE -- START
        $this->excel->getActiveSheet()->setCellValue('A1', 'ID');               
        $this->excel->getActiveSheet()->setCellValue('B1', 'Name');    
        $this->excel->getActiveSheet()->setCellValue('C1', 'Father Name');    
        $this->excel->getActiveSheet()->setCellValue('D1', 'Mother Name');  
        $this->excel->getActiveSheet()->setCellValue('E1', 'Address');   
        $this->excel->getActiveSheet()->setCellValue('F1', 'Previous School');   
        $this->excel->getActiveSheet()->setCellValue('G1', 'D.O.B');             
        // SET TOW ROW VALUE -- END

        // SET CUSTOM STYLE -- START
        $styleArray = [
            'styleOne' => [
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    ]
                ]
            ],
            'styleTwo' => [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                ]
            ]
        ];        
        $this->excel->getDefaultStyle()->applyFromArray($styleArray['styleOne']);
        $this->excel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray['styleTwo']);
        // SET CUSTOM STYLE -- END

        foreach($result as $key=>$each){
            $key = $key+2;
            $this->excel->getActiveSheet()->getStyle("A$key:G$key")
            ->getAlignment()->setWrapText(true); 

            $this->excel->getActiveSheet()->setCellValue('A'.$key, $each['uniq_id']);
            $this->excel->getActiveSheet()->setCellValue('B'.$key, $each['name']);        
            $this->excel->getActiveSheet()->setCellValue('C'.$key, $each['fname']); 
            $this->excel->getActiveSheet()->setCellValue('D'.$key, $each['mname']); 
            $this->excel->getActiveSheet()->setCellValue('E'.$key, $each['paadress']); 
            $this->excel->getActiveSheet()->setCellValue('F'.$key, $each['preschoolname']); 
            $this->excel->getActiveSheet()->setCellValue('G'.$key, $each['date']); 
        }
        
        $filename= 'All Applied Students ('.$data['session'].').xls';
        // SET HEADER -- START
        header('Content-Type: application/vnd.ms-excel'); // EXCEL FORMAT (CURRENT EXCEL 2000-2003) 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); // SET FILE NAME
        header('Cache-Control: max-age=0');
        // SET HEADER -- END
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); // EXCEL FORMAT (CURRENT EXCEL 2000-2003) 
        $objWriter->save('php://output'); // FOURCE DOWNLOAD

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
        
        $token = $this->home_model->insert_admit_std_info($_POST);
        $url = base_url().'index.php?Home/check_token/'.$token;
        
        $shorten = $this->googleShorten($url);
        
        $this->session->set_flashdata('token_url',$url);
        
        if(!empty($_POST['email'])):
        $this->send_email($formEmail, $_POST['email'], 'Admission Download Form', "This link work only 30 days\n$shorten");
        endif;
        set_flashmsg('Your form successfully submitted and wating for approval. You will receive a confirmation sms within 24 hours.','succ');
        redirect(base('Home', 'confirmpage'));
        
        endif;
    
    }

    function update_admit_student()
    {
        $id = $_POST['id'];
        $this->db->where('id', $id);
        $this->db->update('admit_std', $_POST);

        if(!empty($_FILES['img']['name'])):
            $img = $_FILES['img'];
            
            $this->upload->initialize(upload_file(100,300,300,$img));
            if ($this->upload->do_upload('img')) {        
                //Image Resizing            
                $this->load->library('image_lib', resize_file(180,180));
            }
        endif;
        
        redirect(base('homemanage','admission_query'));    

    }
	
	function contact_mail()
    {
        $this->load->helper(array('form', 'url'));        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == FALSE) {
            set_flashmsg(validation_errors(),'error');
            redirect(base('Home', ''));
        }
        
        $toEmail = $this->db->get_where('settings',array('type'=>'system_email'))->row()->description;
        $this->load->library('email');
        $this->email->from($_POST['email'], $_POST['name']);
        $this->email->to($toEmail);
        $this->email->subject($this->systemTitleName);
        $this->email->message($_POST['description']);
        $this->email->send();
        set_flashmsg('Your Message Has Been Successfully Sent.','succ');
        redirect(base('Home', ''));
    }
            
    function check_token()
    {
        $id = encryptor('decrypt', $this->uri(3));
        $data['std_info'] = $this->db->get_where('admit_std',array('id'=>$id))->result_array();
        if(empty($data['std_info'])){
            pd('Invalid Token ID !!');
        }
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

    function download_blank_form()
    {
        $this->load->library('m_pdf');
        $html = $this->load->view('pdfSamplePrint', '', true);
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output('Blank-Form.pdf',"D"); 
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
        $status = explode('|', $status);
        if($status[0]==0){
            $data['date'] = $status[1];
        	$this->load->view('underConstraction',$data);
        }else{
        $data2['title'] = $title;
        $data['meta'] = $this->home_model->getMetaInfo(); 
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
        $this->email->from($form, $this->systemTitleName);
        $this->email->to($to);
        $this->email->subject($sub);
        $this->email->message($msg);
        $this->email->send();
        return true;
    }

    public function googleShorten($url) 
    {
        $this->load->library('google_url_api');
        $this->google_url_api->enable_debug(FALSE);
        $short_url = $this->google_url_api->shorten($url);
        return $short_url->id;
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