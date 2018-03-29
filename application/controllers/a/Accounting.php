<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/*  
 *  @author     : Md. Rubel
 */
class Accounting extends CI_Controller
{    

    protected $systemTitleName;
    private $running_year;
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        
        $this->systemTitleName = $this->db->get_where('settings' , array('type' =>'system_title_english'))->row()->description;
        $this->running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
       /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
    }


    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }

    public function accounting_menu() 
    {
        $page_data['page_name']  = 'menus/accounting_menu';
        $page_data['page_title'] = get_phrase('accounting');
        $this->load->view('backend/index', $page_data);
    }

    public function ajax_accounting_menu_pages() 
    {
        $pageName = $_POST['pageName'];
        if($pageName == 'student_payment') {
            $this->db->select('description');
            $this->db->where('type','tution_fee_sms_status');
            $this->db->or_where('type','tution_fee_sms_details');
            $page_data['tution_fee_setting'] = $this->db->get('settings')->result_array();
            $page_data['income_category'] = $this->db->get('income_category')->result_array();

        } elseif($pageName == 'income') {
            $page_data['invoices'] = $this->db->get('invoice')->result_array();

        } elseif($pageName == 'daily_expense') { 
            $page_data['expense_category'] = $this->db->get('expense_category')->result_array();
            
        } elseif($pageName == 'manage_bank_ac') { 
            $page_data['accounts'] = $this->db->get('bank_account')->result_array();
        } elseif($pageName == 'bank_transaction') {
            $page_data['bank_accounts'] = $this->db->get('bank_account')->result_array();
            $this->db->order_by('tran_id', 'DESC');
            $page_data['bank_transactions'] = $this->db->get('bank_transaction')->result_array();
        } elseif($pageName == 'monthly_balance_sheet'){            
            $page_data['year']   = date('Y'); 
        }
        $page_data['running_year'] = $this->running_year;
        $page_data['page_name'] = $pageName;
        $this->load->view('backend/admin/accounting/'.$pageName, $page_data);
    }


    public function add_student_income()
    {   
        $arrayCount = count($_POST);

        for($i = 0; $i < $arrayCount; $i += 6){

            $result = array_slice($_POST, $i, 6);
            foreach($result as $param => $each_re){                
                $key = explode('_', $param);
                if($key[1] == 'month'){
                    $data['month'] = implode(',', $each_re);
                }else{
                    $data[$key[1]] = $each_re[0];   
                }                 
            }

            $f_data[$key[0]] = $data;

        }

        foreach($f_data as $k=>$each_f){
            
            $income_info = $this->db->get_where('student_fees', array('student_id'=>$k))->result_array();
            if(!empty($income_info)){

                $this->db->where('student_id', $k);
                $this->db->update('student_fees', $each_f);
            }else{
                $id = array('student_id' => $k);
                $insert_data = array_merge($id, $each_f);

                $this->db->insert('student_fees', $insert_data);
            }
        }
        
    }

    function daily_expense()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['expense_category'] = $this->db->get('expense_category')->result_array();
        $this->loadView('accounting/daily_expense', 'daily_expense', $page_data);
    }

    function add_daily_expense()
    {
        // Move to admin controller reason to ajax problem
        $result = $this->input->post(null);
        $select_month = array_keys(array_slice($result, 0, 1));
        $month_string = explode('_', $select_month[0]);
        $month_name = date('m', $month_string[1]);

        if(isset($_SESSION['working_month'])){
            unset($_SESSION['working_month']);
            $_SESSION['working_month'] = $month_name;
        }else{
            $_SESSION['working_month'] = $month_name;
        }

        foreach($result as $k=>$each){
            $index               = explode('_', $k);
            $data['expense_category_id'] = $index[0];
            $data['date']                = $index[1];
            $data['amount']              = $each[0];

            $exist = $this->db->get_where('daily_expense', array('expense_category_id' => $data['expense_category_id'], 'date' => $data['date']))->result_array();

            if(!empty($exist)){
                $daily_expense_id = $exist[0]['daily_expense_id'];
                $this->db->where('daily_expense_id', $daily_expense_id);
                $this->db->update('daily_expense', $data);
            }else{
                $this->db->insert('daily_expense', $data);
            }   
        }

        $this->session->set_flashdata('flash_message' , get_phrase('data_save_successfully'));
        redirect(base_url() . 'index.php?a/accounting/daily_expense', 'refresh');
    }

    function monthly_expense_sheet()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['running_year'] = $this->running_year;
        $this->loadView('accounting/expense_balance_sheet', 'monthly_expense_sheet', $page_data);
    }

    function monthly_balance_sheet()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
            
        $page_data['year']   = date('Y'); 
        $this->loadView('accounting/total_income_expense_sheet', 'monthly_balance_sheet');
    }
    
    /******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $student_code = $this->input->post('student_code');
            $student_id = $this->db->get_where('student', array('student_code' => $student_code))->row()->student_id;
            
            if(!$student_id){
                $this->flashmsg('No Student Found', 'error');
                redirect(base_url().'index.php?a/accounting/student_payment', 'refresh');
                $student_id = '';
            }
            if(!empty($_POST['months'])){
                $monthsValue = implode(',', $this->input->post('months'));
            }else{
                $monthsValue = '';
            }

            // SAVE DATE IN SESSION FOR REUSE THIS DATE FOR NEXT ENTRY
            $this->session->set_userdata('sessionSaveDate', $this->input->post('date'));
            // END THIS

            $data['student_id']         = $student_id;
            $data['class_id']           = $this->db->get_where('enroll',array('student_id' => $student_id))->row()->class_id;
            $data['acc_code']           = $this->input->post('student_code');
            $data['months']             = $monthsValue;
            $data['fee_name']           = implode(',', $this->input->post('fee_name'));
            $data['fee_amount']         = implode(',', $this->input->post('fee_amount'));
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['amount_paid']        = $this->input->post('amount_paid');
            $data['due']                = $data['amount'] - $data['amount_paid'];
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            $data['year']               = $this->running_year;

            $this->db->insert('invoice', $data);
            $invoice_id = $this->db->insert_id();

            $data2['invoice_id']        =   $invoice_id;
            $data2['student_id']        =   $student_id;
            $data2['title']             =   'student income';
            $data2['description']       =   $this->input->post('description');
            $data2['payment_type']      =   'income';
            $data2['method']            =   $this->input->post('method');
            $data2['amount']            =   $this->input->post('amount_paid');
            $data2['timestamp']         =   strtotime($this->input->post('date'));
            $data2['year']              =   $this->running_year;

            $this->db->insert('payment' , $data2);

            $tution_sms_status = $this->db->get_where('settings',['type'=>'tution_fee_sms_status'])->row()->description;
            
            // TUTION FEE SMS SECTION
            // IF TUTION FEE SMS SETTING STATUS ON
            if($tution_sms_status == 1){
                $this->load->library('nihalitsms'); 
               
                $msg = $this->db->get_where('settings',['type'=>'tution_fee_sms_details'])->row()->description;
                $mobile = $this->db->get_where('student', array('student_id' => $student_id))->row()->mobile;              

                $this->nihalitsms->long_sms_api($msg,$mobile);
            }
            // END TUTION FEE SMS SECTION

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?a/accounting/student_payment', 'refresh');
        }

        if ($param1 == 'create_mass_invoice') {
            foreach ($this->input->post('student_id') as $id) {

                $data['student_id']         = $id;
                $data['title']              = $this->input->post('title');
                $data['description']        = $this->input->post('description');
                $data['amount']             = $this->input->post('amount');
                $data['amount_paid']        = $this->input->post('amount_paid');
                $data['due']                = $data['amount'] - $data['amount_paid'];
                $data['status']             = $this->input->post('status');
                $data['creation_timestamp'] = strtotime($this->input->post('date'));
                $data['year']               = $this->running_year;
                
                $this->db->insert('invoice', $data);
                $invoice_id = $this->db->insert_id();

                $data2['invoice_id']        =   $invoice_id;
                $data2['student_id']        =   $id;
                $data2['title']             =   $this->input->post('title');
                $data2['description']       =   $this->input->post('description');
                $data2['payment_type']      =  'income';
                $data2['method']            =   $this->input->post('method');
                $data2['amount']            =   $this->input->post('amount_paid');
                $data2['timestamp']         =   strtotime($this->input->post('date'));
                $data2['year']              =   $this->running_year;

                $this->db->insert('payment' , $data2);
            }
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?a/accounting/student_payment', 'refresh');
        }

        if ($param1 == 'do_update') {
            $invoice_id = $this->uri->segment(5); 
            $student_code                   = $this->input->post('student_code');
            $student_id                 = $this->db->get_where('student', array('student_code' => $student_code))->row()->student_id;
            if(!$student_id){
                $this->flashmsg('No Student Found', 'error');
                redirect(base_url() . 'index.php?a/accounting/edit_student_payment/'.$invoice_id, 'refresh');
                $student_id = '';
            }            
            
            $data['student_id']         = $student_id;
            $data['class_id']           = $this->db->get_where('enroll',array('student_id' => $student_id))->row()->class_id;
            $data['acc_code']           = $student_code;
            $data['months']             = implode(',', $this->input->post('months'));
            $data['fee_name']           = implode(',', $this->input->post('fee_name'));
            $data['fee_amount']         = implode(',', $this->input->post('fee_amount'));
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['amount_paid']        = $this->input->post('amount_paid');
            $data['due']                = $data['amount'] - $data['amount_paid'];
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            $data['year']               = $this->running_year;

            $this->db->where('invoice_id', $invoice_id);
            $this->db->update('invoice', $data);

            $data2['description']       =   $this->input->post('description');
            $data2['method']            =   $this->input->post('method');
            $data2['amount']            =   $this->input->post('amount_paid');
            $data2['timestamp']         =   strtotime($this->input->post('date'));
            $data2['year']              =   $this->running_year;

            $this->db->where('invoice_id', $invoice_id);
            $this->db->update('payment' , $data2);

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?a/accounting/income', 'refresh');
        }
        if ($param1 == 'take_payment') {
            $data['invoice_id']   =   $this->input->post('invoice_id');
            $data['student_id']   =   $this->input->post('student_id');
            $data['title']        =   $this->input->post('title');
            $data['description']  =   $this->input->post('description');
            $data['payment_type'] =   'income';
            $data['method']       =   $this->input->post('method');
            $data['amount']       =   $this->input->post('amount');
            $data['timestamp']    =   strtotime($this->input->post('timestamp'));
            $data['year']         =   $this->running_year;
            $this->db->insert('payment' , $data);

            $status['status']   =   $this->input->post('status');
            $this->db->where('invoice_id' , $param2);
            $this->db->update('invoice' , array('status' => $status['status']));

            $data2['amount_paid']   =   $this->input->post('amount');
            $data2['status']        =   $this->input->post('status');
            $this->db->where('invoice_id' , $param2);
            $this->db->set('amount_paid', 'amount_paid + ' . $data2['amount_paid'], FALSE);
            $this->db->set('due', 'due - ' . $data2['amount_paid'], FALSE);
            $this->db->update('invoice');

            $this->session->set_flashdata('flash_message' , get_phrase('payment_successfull'));
            redirect(base_url() . 'index.php?a/accounting/income/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');

            $this->db->where('invoice_id', $param2);
            $this->db->delete('payment');
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?a/accounting/income', 'refresh');
        }

        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array(); 
        $this->loadView('accounting/invoice', 'manage_invoice/payment', $page_data);
    }

    function ajax_create_invoice()
    {
        // Move to admin controller reason to ajax problem
    }

    function edit_student_payment()
    {
        $invoice_id = $this->uri->segment(4);
        $page_data['income_category'] = $this->db->get('income_category')->result_array();
        $page_data['invoice_info'] = $this->db->get_where('invoice', array('invoice_id'=>$invoice_id))->result_array();
        $page_data['student_code'] = $this->db->get_where('student', array('student_id'=>$page_data['invoice_info'][0]['student_id']))->row()->student_code;
        $this->loadView('accounting/edit_student_payment', 'edit_invoice/edit', $page_data);
    }


    /**********ACCOUNTING********************/
    function income($param1 = '' , $param2 = '')
    {
       if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->loadView('accounting/income', 'student_payments', $page_data);
    }

    function income_category($param1 = '' , $param2 = '')
    {        
        // Move to admin controller reason to ajax problem
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']   =   strtolower(str_replace(' ', '_', $this->input->post('name')));
            $this->db->insert('income_category' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?a/accounting/income_category');
        }
        if ($param1 == 'edit') {
            $data['name']   =   strtolower(str_replace(' ', '_', $this->input->post('name')));
            $this->db->where('income_category_id' , $param2);
            $this->db->update('income_category' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?a/accounting/income_category');
        }
        if ($param1 == 'delete') {
            $this->db->where('income_category_id' , $param2);
            $this->db->delete('income_category');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?a/accounting/income_category');
        }

        $this->loadView('accounting/income_category', 'income_category');
    }

    function student_payment($param1 = '' , $param2 = '' , $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        $this->db->select('description');
        $this->db->where('type','tution_fee_sms_status');
        $this->db->or_where('type','tution_fee_sms_details');
        $page_data['tution_fee_setting'] = $this->db->get('settings')->result_array();
        $page_data['income_category'] = $this->db->get('income_category')->result_array();
        $this->loadView('accounting/student_payment', 'create_student_payment', $page_data);
    }

    function expense($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['title']               =   $this->input->post('title');
            $data['expense_category_id'] =   $this->input->post('expense_category_id');
            $data['description']         =   $this->input->post('description');
            $data['payment_type']        =   'expense';
            if($_POST['teacher_id']):
            $data['student_id']         =   $this->input->post('teacher_id');
            endif;
            $data['method']              =   $this->input->post('method');
            $data['amount']              =   $this->input->post('amount');
            $data['timestamp']           =   strtotime($this->input->post('timestamp'));
            $data['year']                =   $this->running_year;
            $this->db->insert('payment' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?a/accounting/expense', 'refresh');
        }

        if ($param1 == 'edit') {
            $data['title']               =   $this->input->post('title');
            $data['expense_category_id'] =   $this->input->post('expense_category_id');
            $data['description']         =   $this->input->post('description');
            $data['payment_type']        =   'expense';
            if($_POST['teacher_id']):
            $data['student_id']         =   $this->input->post('teacher_id');
            endif;
            $data['method']              =   $this->input->post('method');
            $data['amount']              =   $this->input->post('amount');
            $data['timestamp']           =   strtotime($this->input->post('timestamp'));
            $data['year']                =   $this->running_year;
            $this->db->where('payment_id' , $param2);
            $this->db->update('payment' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?a/accounting/expense', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('payment_id' , $param2);
            $this->db->delete('payment');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?a/accounting/expense', 'refresh');
        }
        $this->loadView('accounting/expense', 'expenses');
    }

    function expense_category($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']   =   $this->input->post('name');
            $this->db->insert('expense_category' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?a/accounting/expense_category');
        }
        if ($param1 == 'edit') {
            $data['name']   =   $this->input->post('name');
            $this->db->where('expense_category_id' , $param2);
            $this->db->update('expense_category' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?a/accounting/expense_category');
        }
        if ($param1 == 'delete') {
            $this->db->where('expense_category_id' , $param2);
            $this->db->delete('expense_category');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?a/accounting/expense_category');
        }

        $this->loadView('accounting/expense_category', 'expense_category');
    }

    function total_balance_sheet()
    {
        $this->loadView('accounting/total_balance_sheet', 'total_balance_sheet');
    }

    function account_balence_sheet()
    {
        $this->loadView('accounting/account_balence_sheet', 'account_balence_sheet');
    }
    

    function category_balence_sheet()
    {
        $this->loadView('accounting/category_balence_sheet', 'category_balence_sheet');
    }



    function income_date_search_result()
    {
        if(isset($_SESSION['fromdate'])){
            unset($_SESSION['fromdate']);
            unset($_SESSION['todate']);
        }
        $_SESSION['fromdate'] = $_POST['fromdate'];
        $_SESSION['todate'] = $_POST['todate'];
        $page_title = 'Income Search Result | '.$_POST['fromdate'].' TO '.$_POST['todate'];
        $this->loadView('accounting/income_date_search_result', $page_title);
    }

    function expense_date_search_result()
    {
        $this->db->where('payment_type' , 'expense');
        $this->db->where('timestamp >=', strtotime($_POST['fromdate']));
        $this->db->where('timestamp <=', strtotime($_POST['todate']));
        $this->db->order_by('timestamp' , 'desc');
        $page_data['expenses'] = $this->db->get('payment')->result_array();
        $page_title = 'Expense Search Result | '.$_POST['fromdate'].' TO '.$_POST['todate'];
        $this->loadView('accounting/expense_date_search_result', $page_title, $page_data);
    }

    // ======== BANK ACCOUNT SECTION ========== //

    function manage_bank_ac()
    {
        $page_data['accounts'] = $this->db->get('bank_account')->result_array();
        $this->loadView('accounting/manage_bank_ac', 'manage_bank_account', $page_data);
    }

    function add_bank_account()
    {
        $data = $this->input->post();
        $this->db->insert('bank_account', $data);
        $this->flashmsg('Account Successfully Added');
        redirect(base('a/accounting', 'manage_bank_ac'));
    }

    function update_bank_account()
    {
        $id = $this->uri->segment(4);
        $data = $this->input->post();
        $this->db->where('acc_id', $id);
        $this->db->update('bank_account', $data);
        $this->flashmsg('Account Updated');
        redirect(base('a/accounting', 'manage_bank_ac'));
    }

    function delete_bank_account()
    {
        $id = $this->uri->segment(4);        
        $this->db->where('acc_id', $id);
        $this->db->delete('bank_account');
        $this->flashmsg('Account Deleted');
        redirect(base('a/accounting', 'manage_bank_ac'));
    }

    function bank_transaction()
    {
        $page_data['bank_accounts'] = $this->db->get('bank_account')->result_array();
        $this->db->order_by('tran_id', 'DESC');
        $page_data['bank_transactions'] = $this->db->get('bank_transaction')->result_array();
        $this->loadView('accounting/bank_transaction', 'bank_transaction', $page_data);
    }

    function add_bank_transaction()
    {
        // Move to admin controller reason to ajax problem
        $_POST['tran_date'] = strtotime($_POST['tran_date']);
        $this->db->insert('bank_transaction', $_POST);
        $this->flashmsg('Transaction Added');
        redirect(base('a/accounting', 'bank_transaction'));
    }

    function transaction_search_date_wise()
    {
        $formDate = $this->input->post('fromDate');
        $todate   = $this->input->post('toDate');
        $acc_id   = $this->input->post('acc_id');
        $page_data['bank_accounts'] = $this->db->get('bank_account')->result_array();

        if(!empty($acc_id)){
            $this->db->where('acc_id' , $acc_id);    
        }
        $this->db->where('tran_date >=', strtotime($formDate));
        $this->db->where('tran_date <=', strtotime($todate));
        $page_data['bank_transactions'] = $this->db->get('bank_transaction')->result_array();        

        $page_data['fromDate'] = $formDate;
        $page_data['toDate']   = $todate;
        $this->load->view('backend/admin/accounting/transaction_search_date_wise', $page_data);        
    }

    function grab_account_info($id)
    {
        // LAST WITHDROW
        $this->db->order_by('tran_id', 'DESC');
        $this->db->limit(1);
        $this->db->where('acc_id', $id);
        $this->db->where('tran_status', 2);
        $lastWithdrow = $this->db->get('bank_transaction')->result_array();

        // CASH IN QUERY
        $this->db->select_sum('tran_amount');
        $this->db->where('acc_id', $id);
        $this->db->where('tran_status', 1);
        $cashIn = $this->db->get('bank_transaction')->result_array();

        // CASH OUT QUERY
        $this->db->select_sum('tran_amount');
        $this->db->where('acc_id', $id);
        $this->db->where('tran_status', 2);
        $cashOut = $this->db->get('bank_transaction')->result_array();

        // AVAILABLE BALANCE
        $data = array();
        $data['last_withdrow'] = intval($lastWithdrow[0]['tran_amount']); // STRING TO INT CONVERT
        $data['account_balance'] = $cashIn[0]['tran_amount'] - $cashOut[0]['tran_amount'];

        echo json_encode($data);
    }

    function delete_acc_transaction()
    {
        $tran_id = $this->uri->segment(4);
        $this->db->where('tran_id', $tran_id);
        $this->db->delete('bank_transaction');

        $this->flashmsg('Successfully Delete');
        redirect(base('a/accounting', 'bank_transaction'));
    }

    function tution_fee_sms_setting()
    {
        // Move to admin controller reason to ajax problem
        $data = $this->input->post();
        $data['tution_fee_sms_status'] = $data['tution_fee_sms_status']==''?0:1;
        $this->db->update('settings',
            ['description'=>$data['tution_fee_sms_status']],
            ['type'=>'tution_fee_sms_status']);
        $this->db->update('settings',
            ['description'=>$data['tution_fee_sms_details']],
            ['type'=>'tution_fee_sms_details']);
        $this->flashmsg('Tution Fee SMS Setting Updated');
        redirect(base('a/accounting', 'student_payment'));
    }

    function search_pendding_fee()
    {
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['group_id'] = $this->input->post('group_id');
        $data['shift_id'] = $this->input->post('shift_id');
        $page_data['enroll'] = $this->db->get_where('enroll',$data)->result_array();
        if(!empty($page_data['enroll'])) {
            foreach($page_data['enroll'] as $k => $each) {
                $payments = $this->db->get_where('invoice',
                                ['student_id'=>$each['student_id'], 'year'=>$this->running_year])->result_array();
                if(!empty($payments)) {
                    foreach($payments as $k2 => $each2) {
                        $months = explode(',',$each2['months']);
                        foreach($months as $k3 => $each3) {
                            $page_data['students'][$each['student_id']]['months'][] = $each3;
                        }                        
                        $page_data['students'][$each['student_id']]['amount'] += $each2['amount'];
                        $page_data['students'][$each['student_id']]['amount_paid'] += $each2['amount_paid'];
                        $page_data['students'][$each['student_id']]['due'] += $each2['due'];
                    }
                } else {
                        $page_data['students'][$each['student_id']]['months'] = false;
                        $page_data['students'][$each['student_id']]['amount'] = 0;
                        $page_data['students'][$each['student_id']]['amount_paid'] = 0;
                        $page_data['students'][$each['student_id']]['due'] = 0;
                }
            }

            $page_data['running_year'] = $this->running_year;
            $html = $this->load->view('backend/admin/accounting/tution_pendding_table', $page_data, true);
            return $this->jsonMsgReturn(true,'Success.', $html);
        } else {
            return $this->jsonMsgReturn(false,'No Student Found.');
        }        
    }

    function send_unpaid_sms()
    {
        $post = $this->input->post('mobile');        
        $status = $this->db->get_where('settings',['type'=>'pendding_fee_sms_status'])->row()->description;
        if($status == 'on') {
            $this->load->library('nihalitsms');
            $desc = $this->db->get_where('settings',['type'=>'pendding_fee_sms_details'])->row()->description;
            foreach($post as $k=>$each) {
                $this->nihalitsms->long_sms_api($desc,$each);
            }
        $this->session->set_flashdata('flash_message' , get_phrase('SMS Send Success'));
        redirect(base('a/accounting','accounting_menu'));
        } else {
            $this->session->set_flashdata('flash_message' , get_phrase('SMS status disabled'));
            redirect(base('a/accounting','accounting_menu'));
        }
        
    }


    // AJAX RESPONSE FUNCTION LIST //

    function getStudentAccHistory()
    {
        $year = $this->running_year;
        $student_code = $this->uri->segment(4);
        $page_data['student_payment'] = $this->db->get_where('invoice',['acc_code'=>$student_code,'year'=>$year])->result_array();
        if(empty($page_data['student_payment'])){
            $page_data['student_payment'] = [];
        }
        
        $this->load->view('backend/admin/accounting/student_account_history', $page_data);
    }

    function getStudentAccMonthCheckbox()
    {
        $year = $this->running_year;
        $student_code = $this->uri->segment(4);
        $page_data['student_name'] = $this->db->get_where('student',['student_code'=>$student_code])->row()->student_id;
        if(!empty($page_data['student_name'])) {
            $page_data['student_payment'] = $this->db->get_where('invoice',['acc_code'=>$student_code,'year'=>$year])->result_array();
            if(empty($page_data['student_payment'])){
                $page_data['student_payment'] = [];
            } else {
                foreach($page_data['student_payment'] as $k=>$each) {
                    $months = explode(',',$each['months']);
                    foreach($months as $k2=>$each2) {
                        if(!empty($each2)) {
                            $page_data['months'][] = $each2;
                        }                        
                    }                    
                }
            }        
            $this->load->view('backend/admin/accounting/account_months_checkbox', $page_data);
        }        
    }

    function getAccStdInfo($value)  //ajax response
    {
        $name = $this->db->get_where('student',array('student_code'=>$value))->row()->name;
        $stdId = $this->db->get_where('student',array('student_code'=>$value))->row()->student_id;
        $classId = $this->db->get_where('enroll',array('student_id'=>$stdId))->row()->class_id;
        $roll = $this->db->get_where('enroll',array('student_id'=>$stdId))->row()->roll;
        $className = $this->db->get_where('class',array('class_id'=>$classId))->row()->name;
              
        if ($stdId) {
            $Response = array('name' => 'Name: '.$name.' * Roll: '.$roll.' * Class: '.$className);
            echo json_encode($Response);
        }else{
            $Response = array('name' => 'কোন ছাত্র খুজে পাওয়া যায় নি।');
            echo json_encode($Response);
        }
        
    }

    public function ajax_list_two()
    {
        $base_url = base_url(); 
        $this->load->model('income_model','income');
        $list = $this->income->get_datatables_datewise();

        //print_r($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $invoice) {
            $std_name = $this->db->get_where('student', array('student_id'=>$invoice->student_id))->row()->name;
            $student_info = $this->db->get_where('enroll', array('student_id'=>$invoice->student_id))->row();
            if(!empty($student_info)){
                $class_name = ' Class: '.$this->db->get_where('class',array('class_id'=>$student_info->class_id))->row()->name;
                $std_info = ' Roll: '.$student_info->roll;
                $std_info .= ' Section: '.$this->db->get_where('section',array('section_id'=>$student_info->section_id))->row()->name;
                $std_info .= ' Shift: '.$this->db->get_where('shift',array('shift_id'=>$student_info->shift_id))->row()->name;
            }else{
                $std_info   = $invoice->description;
                $class_name = '';
            }
            //$group_id = $student_info->group_id;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $std_name;
            $row[] = $std_info;
            $row[] = $invoice->amount;
            $row[] = date('d/m/Y', $invoice->creation_timestamp);
             if($_SESSION['name']=='NihalIT'){
                $delete_permission = '<a href="'.$base_url.'index.php?a/accounting/invoice/delete/'.$invoice->invoice_id.'" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure?\')"><i class="entypo-trash"></i>Delete</a>';
            }else{
                $delete_permission = '';
            }
            $row[] = '
            <a href="#" class="btn btn-xs btn-info" onclick=\'showAjaxModal("'.$base_url.'index.php?modal/popup/modal_view_invoice/'.$invoice->invoice_id.'")\'><i class="entypo-eye"></i>View Invoice</a>
            <a href="'.$base_url.'index.php?a/accounting/edit_student_payment/'.$invoice->invoice_id.'" class="btn btn-xs btn-primary" target="_blank"><i class="entypo-pencil"></i>Edit</a>
            '.$delete_permission;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->income->count_all(),
            "recordsFiltered" => $this->income->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list()
    {
        $base_url = base_url();
        $this->load->model('income_model','income');
        $list = $this->income->get_datatables();

        //print_r($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $invoice) {
            $std_name = $this->db->get_where('student', array('student_id'=>$invoice->student_id))->row()->name;
            $student_info = $this->db->get_where('enroll', array('student_id'=>$invoice->student_id))->row();
            
            if(!empty($student_info)){
                $class_name = ' Class: '.$this->db->get_where('class',array('class_id'=>$student_info->class_id))->row()->name;
                $std_info = ' Roll: '.$student_info->roll;
                $std_info .= ' Section: '.$this->db->get_where('section',array('section_id'=>$student_info->section_id))->row()->name;
                $std_info .= ' Shift: '.$this->db->get_where('shift',array('shift_id'=>$student_info->shift_id))->row()->name;
            }else{
                $std_info   = $invoice->description;
                $class_name = '';
            }
            
            //$group_id = $student_info->group_id;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $std_name;
            $row[] = $std_info;
            $row[] = $class_name;
            $row[] = $invoice->amount;
            $row[] = date('d/m/Y', $invoice->creation_timestamp);
            if($_SESSION['name']=='NihalIT'){
                $delete_permission = '<a href="'.$base_url.'index.php?a/accounting/invoice/delete/'.$invoice->invoice_id.'" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure?\')"><i class="entypo-trash"></i>Delete</a>';
            }else{
                $delete_permission = '';
            }
            $row[] = '
            <a href="#" class="btn btn-xs btn-info" onclick=\'showAjaxModal("'.$base_url.'index.php?modal/popup/modal_view_invoice/'.$invoice->invoice_id.'")\'><i class="entypo-eye"></i>View Invoice</a>
            <a href="'.$base_url.'index.php?a/accounting/edit_student_payment/'.$invoice->invoice_id.'" class="btn btn-xs btn-primary" target="_blank"><i class="entypo-pencil"></i>Edit</a>
            '.$delete_permission;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->income->count_all(),
                        "recordsFiltered" => $this->income->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    
     //   ========= REUSEABLE FUNCTION
     //   
     
    function loadView($page_name, $page_title, $page_data = '')
    {
        $page_data['page_name']  = $page_name;
        $page_data['page_title'] = get_phrase($page_title);
        $this->load->view('backend/index', $page_data);
    }

    function jsonMsgReturn($type, $msg, $html='')
    {
        echo json_encode(['type'=>$type,'msg'=>$msg,'html'=>$html]);
    }

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
    
}    