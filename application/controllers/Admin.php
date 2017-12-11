<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/*  
 *  @author     : Md. Rubel
 *  Anauv
 */
class Admin extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        
       /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        // if ($this->session->userdata('admin_login') != 1)
        //     redirect(base_url() . 'index.php?login', 'refresh');
    }


    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');        
    }

    
    // Fetch Data To Server

    public function getStdClassInfo()
    {
        $classInfo = $this->db->get('class')->result_array();
        echo json_encode($classInfo);
    }

    public function getStdGroupInfo()
    {
        $groupInfo = $this->db->get('group')->result_array();
        echo json_encode($groupInfo);
    }

    public function getStdSectionInfo()
    {
        $sectionInfo = $this->db->get('section')->result_array();
        echo json_encode($sectionInfo);
    }

    public function getStdShiftInfo()
    {
        $shiftInfo = $this->db->get('shift')->result_array();
        echo json_encode($shiftInfo);
    }

    public function getStdStudentInfo()
    {
        $studentInfo = $this->db->get('student')->result_array();
        echo json_encode($studentInfo);
    }

    public function getStdEnrollInfo()
    {
        $enrollInfo = $this->db->get('enroll')->result_array();
        echo json_encode($enrollInfo);
    }

    public function getInfo()
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $allStudent = $this->db->get('enroll')->result_array();
        $currentStrDate = strtotime(date('Y-m-d'));
        // echo json_encode($arr);
        foreach ($_POST as $key => $value) {
            $localServerInfo[] = current(explode('@', $value));
        }
        // echo $currentStrDate;
        // die();
        // echo '<pre>';
        // print_r($_POST);
        // $lastIn = explode('@', $_POST[2]);

        // print_r(date('H:i:s', $lastIn[1]));
        // echo 'hello world';
        // echo '</pre>';


        foreach ($allStudent as $singlestd) {
            $attStdId = $this->db->get_where('attendance', array('student_id' => $singlestd['student_id'], 'timestamp' => $currentStrDate))->row()->student_id;
            if(is_numeric($attStdId)){
                // update status
                $updateKey = array_search($attStdId, $localServerInfo);
                if(is_numeric($updateKey)){
                    $updateStatus = end(explode('@', $_POST[$updateKey])); 
                    if($updateStatus==2){
                        $where = array('student_id' => $attStdId, 'timestamp' => $currentStrDate);
                        $this->db->where($where);
                        $this->db->update('attendance', array('status' =>  1));
                    }else{
                        $where = array('student_id' => $attStdId, 'timestamp' => $currentStrDate);
                        $this->db->where($where);
                        $this->db->update('attendance', array('status' =>  3));
                    }
                }
                
            }else{
                $key = array_search($singlestd['student_id'], $localServerInfo);
                if(is_numeric($key)){
                    $status = end(explode('@', $_POST[$key])); 
                    if($status==2){
                        //$timestamp = array_slice(explode('@', $_POST[$key]), 1, 1); // select intime
                        // Present
                        $attn_data['timestamp']  = $currentStrDate;
                        $attn_data['year']       = $running_year;
                        $attn_data['class_id']   = $singlestd['class_id'];
                        $attn_data['section_id'] = $singlestd['section_id'];
                        $attn_data['group_id']   = $singlestd['group_id'];
                        $attn_data['shift_id']   = $singlestd['shift_id'];
                        $attn_data['student_id'] = $singlestd['student_id'];
                        $attn_data['status']     = 1;
                        $this->db->insert('attendance' , $attn_data); 
                    }else{
                        // Escaped And Absent
                        $attn_data['timestamp']  = $currentStrDate;
                        $attn_data['year']       = $running_year;
                        $attn_data['class_id']   = $singlestd['class_id'];
                        $attn_data['section_id'] = $singlestd['section_id'];
                        $attn_data['group_id']   = $singlestd['group_id'];
                        $attn_data['shift_id']   = $singlestd['shift_id'];
                        $attn_data['student_id'] = $singlestd['student_id'];
                        $attn_data['status']     = 3;
                        $this->db->insert('attendance' , $attn_data);
                    }

                }else{
                    // Absent
                    $attn_data['timestamp']  = $currentStrDate;
                    $attn_data['year']       = $running_year;
                    $attn_data['class_id']   = $singlestd['class_id'];
                    $attn_data['section_id'] = $singlestd['section_id'];
                    $attn_data['group_id']   = $singlestd['group_id'];
                    $attn_data['shift_id']   = $singlestd['shift_id'];
                    $attn_data['student_id'] = $singlestd['student_id'];
                    $attn_data['status']     = 2;
                    $this->db->insert('attendance' , $attn_data);
                }
            }
            
        }
        // print_r($present);
        // echo "<br>";
        // print_r($absent);
        // die();
        echo 'ok';
    }

    // End Fetch Data To Server

    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $data = $this->sms_infos();
        $page_data['sms_info'] = $this->sms_balance($data['user'],$data['pass']);
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
    /****MANAGE STUDENTS CLASSWISE*****/
    function student_add() 
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
            
        $page_data['page_name']  = 'student_add';
        $page_data['page_title'] = get_phrase('add_student');
        $this->load->view('backend/index', $page_data);
    }
    
    function student_bulk_add($param1 = '')
    {
            if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if($param1 == 'add_bulk_student') {

            $names     = $this->input->post('name');
            $rolls     = $this->input->post('roll');
            $emails    = $this->input->post('email');
            $passwords = $this->input->post('password');
            $phones    = $this->input->post('phone');
            $addresses = $this->input->post('address');
            $genders   = $this->input->post('sex');

            $student_entries = sizeof($names);
            for($i = 0; $i < $student_entries; $i++) {
                $data['name']     =   $names[$i];
                $data['email']    =   $emails[$i];
                $data['password'] =   sha1($passwords[$i]);
                $data['phone']    =   $phones[$i];
                $data['address']  =   $addresses[$i];
                $data['sex']      =   $genders[$i];

                //validate here, if the row(name, email, password) is empty or not
                if($data['name'] == '' || $data['email'] == '' || $data['password'] == '')
                    continue;

                $this->db->insert('student' , $data);
                $student_id = $this->db->insert_id();

                $data2['enroll_code']   =   substr(md5(rand(0, 1000000)), 0, 7);
                $data2['student_id']    =   $student_id;
                $data2['class_id']      =   $this->input->post('class_id');
                if($this->input->post('section_id') != '') {
                    $data2['section_id']    =   $this->input->post('section_id');
                }
                $data2['roll']          =   $rolls[$i];
                $data2['date_added']    =   strtotime(date("Y-m-d H:i:s"));
                $data2['year']          =   $this->db->get_where('settings' , array(
                                                'type' => 'running_year'
                                            ))->row()->description;

                $this->db->insert('enroll' , $data2);

            }
            $this->session->set_flashdata('flash_message' , get_phrase('students_added'));
            redirect(base_url() . 'index.php?admin/student_information/' . $this->input->post('class_id') , 'refresh');
        }           

        $page_data['page_name']  = 'student_bulk_add';
        $page_data['page_title'] = get_phrase('add_bulk_student');
        $this->load->view('backend/index', $page_data);
    }

    function get_sections($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/student_bulk_add_sections' , $page_data);
    }
    
    function student_information($class_id = '', $group_id = '')
    {
        
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if(!empty($group_id)):
            $gname = ' || Group - ';
            $gname .= ucfirst($this->db->get_where('group', array('group_id'=>$group_id))->row()->name);
        endif;
            
        $page_data['page_name']     = 'student_information';
        $page_data['page_title']    = get_phrase('student_information'). " - ".get_phrase('class')." : ".
                                            $this->crud_model->get_class_name($class_id).$gname;
        $page_data['class_id']  = $class_id;
        $page_data['group_id']  = $group_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_marksheet($student_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
        $page_data['page_name']  =   'student_marksheet';
        $page_data['page_title'] =   get_phrase('marksheet_for') . ' ' . $student_name . ' (' . get_phrase('class') . ' ' . $class_name . ')';
        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_marksheet_print_view($student_id , $exam_id) {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/admin/student_marksheet_print_view', $page_data);
    }
    
    function student($param1 = '', $param2 = '', $param3 = '')
    {        
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $running_year = $this->db->get_where('settings' , array(
            'type' => 'running_year'
        ))->row()->description;
        if ($param1 == 'create') {
            
            // CREATE STUDENT ACCOUNT UNIQUE CODE
            $cname = $this->db->get_where('class', array('class_id'=>$_POST['class_id']))->row()->name_numeric;
            $gname = $this->db->get_where('group', array('group_id'=>$_POST['group_id']))->row()->name;
            $sname = $this->db->get_where('section', array('section_id'=>$_POST['section_id']))->row()->name;
            $shname = $this->db->get_where('shift', array('shift_id'=>$_POST['shift_id']))->row()->name;
            
            if($cname == 9 || $cname == 10){

                $acc_code = strtolower($shname[0].$cname.$sname[0].$_POST['roll'].$gname[0]);

            }elseif($cname > 0 && $cname < 9){

                $acc_code = strtolower($shname[0].$cname.$sname[0].$_POST['roll']);

            }else{
                $class_name = $this->db->get_where('class', array('class_id'=>$_POST['class_id']))->row()->name;
                $acc_code = strtolower($shname[0].$class_name[0].$_POST['roll']);

            }
            
            // END CREATE STUDENT ACCOUNT UNIQUE CODE
            
            
            $table1Value1 = array_slice($_POST, 0, 21);
            $table1Value2 = array('acc_code' => $acc_code, 'siblinginfo'=>implode('|', $_POST['siblinginfo']), 'jscpecinfo'=>implode(',', $_POST['jscpecinfo']));
            $table1Value3 = array_merge($table1Value1,$table1Value2);           
            //pd($table1Value3);

            //pd($table2Value1);
            $this->db->insert('student', $table1Value3);
            $student_id = $this->db->insert_id();


            $table2Value1 = array_slice($_POST, 22, 5);
            $data2['student_id']     = $student_id;
            $data2['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);            
            $data2['book_no']        = $_POST['book_no'];            
            $data2['date_added']     = strtotime(date("Y-m-d H:i:s"));
            $data2['year']           = $running_year;
            $table2Value2 = array_merge($data2,$table2Value1);


            $this->db->insert('enroll', $table2Value2);

            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            if(!empty($data['email'])):
            $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            endif;
            redirect(base_url() . 'index.php?admin/student_add/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $std_info = $this->db->get_where('enroll', array('student_id'=> $param2))->row();
            if($std_info->group_id == 0 || empty($std_info->group_id)){
                $group_id = '';
            }   
            // UPDATE ACCOUNT CODE (DELETE LETTER THIS SECTION)  
            // DELETE THIS SECTION ALRADY ACC CODE UPDATE FOR ALL STUDENT

            $cname = $this->db->get_where('class', array('class_id'=>$std_info->class_id))->row()->name_numeric;
            $gname = $this->db->get_where('group', array('group_id'=>$std_info->group_id))->row()->name;
            $sname = $this->db->get_where('section', array('section_id'=>$std_info->section_id))->row()->name;
            $shname = $this->db->get_where('shift', array('shift_id'=>$std_info->shift_id))->row()->name;
            
            if($cname == 9 || $cname == 10){

                $update_acc = strtolower($shname[0].$cname.$sname[0].$std_info->roll.$gname[0]);

            }elseif($cname > 0 && $cname < 9){

                $update_acc = strtolower($shname[0].$cname.$sname[0].$std_info->roll);

            }else{
                $class_name = $this->db->get_where('class', array('class_id'=>$std_info->class_id))->row()->name;
                $update_acc = strtolower($shname[0].$class_name[0].$std_info->roll);

            }
            // 'acc_code'=>$update_acc, 
            // END UPDATE ACCOUNT CODE SECTION

            $table1Value1 = array_slice($_POST, 0, 22);
            $table1Value2 = array('siblinginfo'=>implode('|', $_POST['siblinginfo']), 'jscpecinfo'=>implode(',', $_POST['jscpecinfo']));
            $table1Value3 = array_merge($table1Value1,$table1Value2);  

            //pd(array('Account Code' => $update_acc));
            $this->db->where('student_id', $param2);
            $this->db->update('student', $table1Value3);

            // UPDATE ACCOUNT CODE (DELETE LETTER THIS SECTION)  
            $book_no = array('book_no' => $_POST['book_no']) ;
            $this->db->where('student_id', $param2);
            $this->db->update('enroll', $book_no);
            // END UPDATE ACCOUNT CODE SECTION


            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param2 . '.jpg');
            $this->crud_model->clear_cache();
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/student_information/'.$param3.'/'.$group_id, 'refresh');
        }
        
        if ($param1 == 'delete') {
            // STUDENT TABLE
            $this->db->where('student_id', $param2);
            $this->db->delete('student');

            // ENROLL TABLE
            $this->db->where('student_id', $param2);
            $this->db->delete('enroll');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/student_information/' . $param1, 'refresh');
        }
    }

    function auto_acc_code()
    {
        $all_student = $this->db->get('enroll')->result_array();

        //pd($all_student);

        $count = 0;
        foreach($all_student as $each){
            // UPDATE ACCOUNT CODE (DELETE LETTER THIS SECTION)  
            
            $cname = $this->db->get_where('class', array('class_id'=>$each['class_id']))->row()->name_numeric;
            $gname = $this->db->get_where('group', array('group_id'=>$each['group_id']))->row()->name;
            $sname = $this->db->get_where('section', array('section_id'=>$each['section_id']))->row()->name;
            $shname = $this->db->get_where('shift', array('shift_id'=>$each['shift_id']))->row()->name;
            
            if($cname == 9 || $cname == 10){

                $update_acc = strtolower($shname[0].$cname.$sname[0].$each['roll'].$gname[0]);

            }elseif($cname > 0 && $cname < 9){

                $update_acc = strtolower($shname[0].$cname.$sname[0].$each['roll']);
                //$arr[] = $update_acc;

            }else{
                $class_name = $this->db->get_where('class', array('class_id'=>$each['class_id']))->row()->name;
                $update_acc = strtolower($shname[0].$class_name[0].$each['roll']);
            }

            $data = array('acc_code' => $update_acc);

            $this->db->where('student_id', $each['student_id']);
            $this->db->update('student', $data);

            // END UPDATE ACCOUNT CODE SECTION
            $count++;
        }

        echo $count;
        //pd($arr);
    }

    function auto_shift_update()
    {
        $all_student = $this->db->get('enroll')->result_array();

        $count = 0;
        foreach($all_student as $each){
            $section_name = $this->db->get_where('section', array('section_id'=>$each['section_id']))->row()->name;

            if($section_name == 'Boys'){
                    $shift_id = 2;
                }elseif($section_name == 'Girls'){
                    $shift_id = 1;
                    $count++;
                }else{
                    $shift_id = '';
                }

           
                $data = array('shift_id' => $shift_id);

                $this->db->where('student_id', $each['student_id']);
                $this->db->update('enroll', $data);

                
            }
        echo $count;
    }

    function auto_update_shift()
    {
        $id = array(13, 14);
        $this->db->where_in('class_id', $id);
        $result = $this->db->get('enroll')->result_array();
        $shift_id = array('shift_id' => 1);
        $count = 0;

        foreach($result as $each){
            $this->db->where('student_id', $each['student_id']);
            $this->db->update('enroll', $shift_id);
            $count++;
        }

        echo $count;
    }

    function auto_add_class_invoice()
    {
        $enroll_student  = $this->db->get('enroll')->result_array();
        $invoice_student = $this->db->get('invoice')->result_array();

        foreach($enroll_student as $each_en){
            foreach ($invoice_student as $each_in) {
                if($each_en['student_id'] == $each_in['student_id']){

                    $this->db->where('student_id', $each_in['student_id']);
                    $count[] = $this->db->update('invoice', array('class_id' => $each_en['class_id']));
                }
            }
        }
    }

    // STUDENT PROMOTION
    function student_promotion($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        if($param1 == 'promote') {
            $running_year  =   $this->input->post('running_year');  
            $from_class_id =   $this->input->post('promotion_from_class_id'); 
            $students_of_promotion_class =   $this->db->get_where('enroll' , array(
                'class_id' => $from_class_id , 'year' => $running_year
            ))->result_array();
            foreach($students_of_promotion_class as $row) {
                $enroll_data['enroll_code']     =   substr(md5(rand(0, 1000000)), 0, 7);
                $enroll_data['student_id']      =   $row['student_id'];
                $enroll_data['class_id']        =   $this->input->post('promotion_status_'.$row['student_id']);
                $enroll_data['year']            =   $this->input->post('promotion_year');
                $enroll_data['date_added']      =   strtotime(date("Y-m-d H:i:s"));
                $this->db->insert('enroll' , $enroll_data);
            } 
            $this->session->set_flashdata('flash_message' , get_phrase('new_enrollment_successfull'));
            redirect(base_url() . 'index.php?admin/student_promotion' , 'refresh');
        }

        $page_data['page_title']    = get_phrase('student_promotion');
        $page_data['page_name']  = 'student_promotion';
        $this->load->view('backend/index', $page_data);
    }

    function set_new_promotion_std_info()
    {
        if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
        $page_data['class_id']   = $this->uri->segment(3);
        $page_data['student_id']   = $this->uri->segment(4);
        $page_data['page_name']  = 'set_new_promotion_std_info';
        $page_data['page_title'] = get_phrase('set_new_student_information');
        $this->load->view('backend/index', $page_data);
    }

    function update_new_promotion_std_info() 
    {        
        $student_id   = $this->uri->segment(3);
        $info = $this->input->post();
        $this->db->where('student_id', $student_id);
        $this->db->update('enroll', $info);
        $this->session->set_flashdata('flash_message' , get_phrase('new_enrollment_successfull'));
        redirect(base_url() . 'index.php?admin/student_information/'.$info['class_id'] , 'refresh');
    }

    function get_student_roll($classID)
    {        
        $current_year = $this->db->get_where('settings',array('type'=>'running_year'))->row()->description;
        if(!empty($_POST['groupid'])){
            $whereArr = array(
                'class_id' => $_POST['classid'],
                'group_id' => $_POST['groupid'],
                'section_id' => $_POST['sectionid'],
                'shift_id' => $_POST['shiftid'],
                'year' => $current_year
                );

            $this->db->where($whereArr);
            $result = $this->db->get('enroll')->result_array();
            $databaseRoll = array_column($result,'roll');
            $oneTohundred = range(1,100);
            foreach($oneTohundred as $k=>$list){
                foreach($databaseRoll as $list2){
                    if($list==$list2){
                        unset($oneTohundred[$k]);
                    }
                }
            }
            echo json_encode($oneTohundred);
        }else{
            $whereArr = array(
                'class_id' => $_POST['classid'],
                'section_id' => $_POST['sectionid'],
                'shift_id' => $_POST['shiftid'],
                'year' => $current_year
                );

            $this->db->where($whereArr);
            $result = $this->db->get('enroll')->result_array();
            $databaseRoll = array_column($result,'roll');
            $oneTohundred = range(1,100);
            foreach($oneTohundred as $k=>$list){
                foreach($databaseRoll as $list2){
                    if($list==$list2){
                        unset($oneTohundred[$k]);
                    }
                }
            }
            echo json_encode($oneTohundred);
        }

    }

    function get_class_group($class_id)
    {
        $groups = $this->db->get_where('group' , array('class_id' => $class_id))->result_array();
        $class_numeric = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name_numeric;
        if(!empty($groups)){
            echo '<option value="">Select Group</option>';
            foreach ($groups as $row) {
            echo '<option value="' . $row['group_id'] . '">' . ucwords($row['name']) . '</option>';
            }
        }elseif($class_numeric==6){
            echo true;
        }else{
            echo null;
        }
        
    }

    function get_class_section($class_id)
    {
        $sections = $this->db->get_where('section' , array(
            'class_id' => $class_id
        ))->result_array();
        if(!empty($sections)){
            echo '<option value="">Select Section</option>';
            foreach ($sections as $row) {
                echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
            }
        }else{
            echo null;
        }
    }

    function get_students_to_promote($class_id_from , $class_id_to , $running_year , $promotion_year)
    {
        $page_data['class_id_from']     =   $class_id_from;
        $page_data['class_id_to']       =   $class_id_to;
        $page_data['running_year']      =   $running_year;
        $page_data['promotion_year']    =   $promotion_year;
        $this->load->view('backend/admin/student_promotion_selector' , $page_data);
    }

    function total_student_page()
    {
        $all_std_count = $this->db->count_all_results('enroll'); 
        $page_data['page_title']    = 'Total Students: ('.$all_std_count.')';
        $page_data['page_name']  = 'total_student_page';
        $this->load->view('backend/index', $page_data);
    }


     /****MANAGE PARENTS CLASSWISE*****/
    function parent($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']                   = $this->input->post('name');
            $data['email']                  = $this->input->post('email');
            $data['password']               = sha1($this->input->post('password'));
            $data['phone']                  = $this->input->post('phone');
            $data['address']                = $this->input->post('address');
            $data['profession']             = $this->input->post('profession');
            $this->db->insert('parent', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            $this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/parent/', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['name']                   = $this->input->post('name');
            $data['email']                  = $this->input->post('email');
            $data['phone']                  = $this->input->post('phone');
            $data['address']                = $this->input->post('address');
            $data['profession']             = $this->input->post('profession');
            $this->db->where('parent_id' , $param2);
            $this->db->update('parent' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/parent/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('parent_id' , $param2);
            $this->db->delete('parent');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/parent/', 'refresh');
        }
        $page_data['page_title']    = get_phrase('all_parents');
        $page_data['page_name']  = 'parent';
        $this->load->view('backend/index', $page_data);
    }
    
    
    /****MANAGE TEACHERS*****/
    function teacher($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']        = $this->input->post('name');
            $data['birthday']    = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            $data['password']    = sha1($this->input->post('password'));
            $this->db->insert('teacher', $data);
            $teacher_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            //$this->email_model->account_opening_email('teacher', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['birthday']    = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            
            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        } else if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('teacher', array(
                'teacher_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('teacher_id', $param2);
            $this->db->delete('teacher');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = get_phrase('manage_teacher');
        $this->load->view('backend/index', $page_data);
    }
    
    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            if(!empty($_POST['join_subject_code'])){
                unset($_POST['subject_code']);
                $_POST['subject_code'] = $_POST['join_subject_code'];
                unset($_POST['join_subject_code']);
            }
            if(!empty($_POST['group_subject_name'])){
                $_POST['group_id'] = $_POST['group_subject_name'];
                unset($_POST['group_subject_name']);
            }
            //pd($_POST);
            $this->db->insert('subject', $_POST);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/subject/'.$_POST['class_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            $this->db->where('subject_id', $param2);
            $this->db->update('subject', $_POST);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/subject/'.$_POST['class_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('subject', array(
                'subject_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('subject_id', $param2);
            $this->db->delete('subject');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/subject/'.$param3, 'refresh');
        }
        $className = $this->db->get_where('class' , array('class_id' => $param1))->row()->name;
        $page_data['class_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $param1))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('manage_subject'.' (Class: '.$className.')');
        $this->load->view('backend/index', $page_data);
    }

    function get_join_subject_info($class_id)
    {
        $subjectInfo = $this->db->get_where('subject', array('class_id'=>$class_id,'subject_category'=>'main'))->result_array();
        echo json_encode($subjectInfo);
    }

    function get_group_subject_info($class_id)
    {
        $groupInfo = $this->db->get_where('group', array('class_id'=>$class_id))->result_array();
        echo json_encode($groupInfo);
    }
    
    /****MANAGE CLASSES*****/
    function classes($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']         = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');
            $data['teacher_id']   = $this->input->post('teacher_id');
            $this->db->insert('class', $data);
            $class_id = $this->db->insert_id();
            //create a section by default
            $data2['class_id']  =   $class_id;
            $data2['name']      =   'A';
            $this->db->insert('section' , $data2);

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']         = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');
            $data['teacher_id']   = $this->input->post('teacher_id');
            
            $this->db->where('class_id', $param2);
            $this->db->update('class', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class', array(
                'class_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('class_id', $param2);
            $this->db->delete('class');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        }
        $page_data['classes']    = $this->db->get('class')->result_array();
        $page_data['page_name']  = 'class';
        $page_data['page_title'] = get_phrase('manage_class');
        $this->load->view('backend/index', $page_data);
    }
     function get_subject($class_id) 
    {
        $subject = $this->db->get_where('subject' , array(
            'class_id' => $class_id
        ))->result_array();
        foreach ($subject as $row) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }
    
    /****MANAGE SHIFTS*****/
    function shifts($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']         = $this->input->post('name');
            $this->db->insert('shift', $data);
            $shift_id = $this->db->insert_id();

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/shifts/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']         = $this->input->post('name');
            
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
    
    
    
    


    /****MANAGE GROUPS*****/
    function groups($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            //pd($_POST);
            $data['name']         = strtolower(str_replace(' ', '-', $this->input->post('name')));
            $data['class_id']         = $this->input->post('class_id');
            $this->db->insert('group', $data);
            $group_id = $this->db->insert_id();

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/groups/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']         = strtolower(str_replace(' ', '-', $this->input->post('name')));
            $data['class_id']         = $this->input->post('class_id');
            
            $this->db->where('group_id', $param2);
            $this->db->update('group', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/groups/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('group', array(
                'group_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('group_id', $param2);
            $this->db->delete('group');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/groups/', 'refresh');
        }
        $page_data['groups']    = $this->db->get('group')->result_array();
        $page_data['classes']    = $this->db->get('class')->result_array();
        $page_data['page_name']  = 'group';
        $page_data['page_title'] = get_phrase('manage_group');
        $this->load->view('backend/index', $page_data);
    }
    
    
    
    // ACADEMIC SYLLABUS
    function academic_syllabus($class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        // detect the first class
        if ($class_id == '')
            $class_id           =   $this->db->get('class')->first_row()->class_id;

        $page_data['page_name']  = 'academic_syllabus';
        $page_data['page_title'] = get_phrase('academic_syllabus');
        $page_data['class_id']   = $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function upload_academic_syllabus()
    {
        $data['academic_syllabus_code'] =   substr(md5(rand(0, 1000000)), 0, 7);
        $data['title']                  =   $this->input->post('title');
        $data['description']            =   $this->input->post('description');
        $data['class_id']               =   $this->input->post('class_id');
        $data['subject_id']             =   $this->input->post('subject_id');
        $data['uploader_type']          =   $this->session->userdata('login_type');
        $data['uploader_id']            =   $this->session->userdata('login_user_id');
        $data['year']                   =   $this->db->get_where('settings',array('type'=>'running_year'))->row()->description;
        $data['timestamp']              =   strtotime(date("Y-m-d H:i:s"));
        //uploading file using codeigniter upload library
        $files = $_FILES['file_name'];
        $this->load->library('upload');
        $config['upload_path']   =  'uploads/syllabus/';
        $config['allowed_types'] =  '*';
        $_FILES['file_name']['name']     = $files['name'];
        $_FILES['file_name']['type']     = $files['type'];
        $_FILES['file_name']['tmp_name'] = $files['tmp_name'];
        $_FILES['file_name']['size']     = $files['size'];
        $this->upload->initialize($config);
        $this->upload->do_upload('file_name');

        $data['file_name'] = $_FILES['file_name']['name'];

        $this->db->insert('academic_syllabus', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('syllabus_uploaded'));
        redirect(base_url() . 'index.php?admin/academic_syllabus/' . $data['class_id'] , 'refresh');

    }

    function download_academic_syllabus($academic_syllabus_code)
    {
        $file_name = $this->db->get_where('academic_syllabus', array(
            'academic_syllabus_code' => $academic_syllabus_code
        ))->row()->file_name;
        $this->load->helper('download');
        $data = file_get_contents("uploads/syllabus/" . $file_name);
        $name = $file_name;

        force_download($name, $data);
    }

    /****MANAGE SECTIONS*****/
    function section($class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        // detect the first class
        if ($class_id == '')
            $class_id           =   $this->db->get('class')->first_row()->class_id;

        $page_data['page_name']  = 'section';
        $page_data['page_title'] = get_phrase('manage_sections');
        $page_data['class_id']   = $class_id;
        $this->load->view('backend/index', $page_data);    
    }

    function sections($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']       =   $this->input->post('name');
            $data['nick_name']  =   $this->input->post('nick_name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['teacher_id'] =   $this->input->post('teacher_id');
            $this->db->insert('section' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/section/' . $data['class_id'] , 'refresh');
        }

        if ($param1 == 'edit') {
            $data['name']       =   $this->input->post('name');
            $data['nick_name']  =   $this->input->post('nick_name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['teacher_id'] =   $this->input->post('teacher_id');
            $this->db->where('section_id' , $param2);
            $this->db->update('section' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/section/' . $data['class_id'] , 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('section_id' , $param2);
            $this->db->delete('section');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/section' , 'refresh');
        }
    }

    function get_class_subject($class_id)
    {
        $subjects = $this->db->get_where('subject' , array(
            'class_id' => $class_id
        ))->result_array();
        foreach ($subjects as $row) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function get_class_students($class_id)
    {
        $students = $this->db->get_where('enroll' , array(
            'class_id' => $class_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->result_array();
        foreach ($students as $row) {
            $name = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
            echo '<option value="' . $row['student_id'] . '">' . $name . '</option>';
        }
    }

    function get_class_students_mass($class_id)
    {
        $students = $this->db->get_where('enroll' , array(
            'class_id' => $class_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->result_array();
        echo '<div class="form-group">
                <label class="col-sm-3 control-label">' . get_phrase('students') . '</label>
                <div class="col-sm-9">';
        foreach ($students as $row) {
             $name = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
            echo '<div class="checkbox">
                    <label><input type="checkbox" class="check" name="student_id[]" value="' . $row['student_id'] . '">' . $name .'</label>
                </div>';
        }
        echo '<br><button type="button" class="btn btn-default" onClick="select()">'.get_phrase('select_all').'</button>';
        echo '<button style="margin-left: 5px;" type="button" class="btn btn-default" onClick="unselect()"> '.get_phrase('select_none').' </button>';
        echo '</div></div>';
    }



    /****MANAGE EXAMS*****/
    function exam($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']    = $this->input->post('name');
            $data['date']    = $this->input->post('date');
            $data['comment'] = $this->input->post('comment');
            $data['year']    = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->insert('exam', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        if ($param1 == 'edit' && $param2 == 'do_update') {
            $data['name']    = $this->input->post('name');
            $data['date']    = $this->input->post('date');
            $data['comment'] = $this->input->post('comment');
            $data['year']    = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            
            $this->db->where('exam_id', $param3);
            $this->db->update('exam', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('exam', array(
                'exam_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('exam_id', $param2);
            $this->db->delete('exam');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        $page_data['exams']      = $this->db->get('exam')->result_array();
        $page_data['page_name']  = 'exam';
        $page_data['page_title'] = get_phrase('manage_exam');
        $this->load->view('backend/index', $page_data);
    }

    /****** SEND EXAM MARKS VIA SMS ********/
    function exam_marks_sms($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_sms') {

            $exam_id    =   $this->input->post('exam_id');
            $class_id   =   $this->input->post('class_id');
            $receiver   =   $this->input->post('receiver');

            // get all the students of the selected class
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $class_id,
                    'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
            ))->result_array();
            // get the marks of the student for selected exam
            foreach ($students as $row) {
                if ($receiver == 'student')
                    $receiver_phone = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->phone;
                if ($receiver == 'parent') {
                    $parent_id =  $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                    if($parent_id != '') {
                        $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->phone;
                    }
                }
                

                $this->db->where('exam_id' , $exam_id);
                $this->db->where('student_id' , $row['student_id']);
                $marks = $this->db->get_where('mark' , array('year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description))->result_array();
                $message = '';
                foreach ($marks as $row2) {
                    $subject       = $this->db->get_where('subject' , array('subject_id' => $row2['subject_id']))->row()->name;
                    $mark_obtained = $row2['mark_obtained'];  
                    $message      .= $row2['student_id'] . $subject . ' : ' . $mark_obtained . ' , ';
                    
                }
                // send sms
                $this->sms_model->send_sms( $message , $receiver_phone );
            }
            $this->session->set_flashdata('flash_message' , get_phrase('message_sent'));
            redirect(base_url() . 'index.php?admin/exam_marks_sms' , 'refresh');
        }
                
        $page_data['page_name']  = 'exam_marks_sms';
        $page_data['page_title'] = get_phrase('send_marks_by_sms');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE EXAM MARKS*****/
    function marks2($exam_id = '', $class_id = '', $subject_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['class_id']   = $this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0) {
                redirect(base_url() . 'index.php?admin/marks2/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'index.php?admin/marks2/', 'refresh');
            }
        }
        if ($this->input->post('operation') == 'update') {
            $students = $this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
            foreach($students as $row) {
                $data['mark_obtained'] = $this->input->post('mark_obtained_' . $row['student_id']);
                $data['comment']       = $this->input->post('comment_' . $row['student_id']);
                
                $this->db->where('mark_id', $this->input->post('mark_id_' . $row['student_id']));
                $this->db->update('mark', array('mark_obtained' => $data['mark_obtained'] , 'comment' => $data['comment']));
            }
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/marks2/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        $page_data['subject_id'] = $subject_id;
        
        $page_data['page_info'] = 'Exam marks';
        
        $page_data['page_name']  = 'marks2';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_manage()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  =   'marks_manage';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_manage_view($exam_id = '' , $class_id = '' , $section_id = '' , $subject_id = '', $group_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['exam_id']    =   $exam_id;
        $page_data['class_id']   =   $class_id;
        $page_data['group_id']   =   $group_id;
        $page_data['subject_id'] =   $subject_id;
        $page_data['section_id'] =   $section_id;
        $page_data['page_name']  =   'marks_manage_view';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_selector()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $data['exam_id']    = $this->input->post('exam_id');
        $data['class_id']   = $this->input->post('class_id');
        if(!empty($_POST['group_id'])){
            $data['group_id'] = $this->input->post('group_id');
        }else{
            $data['group_id'] = '';
        }
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['year']       = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
        $query = $this->db->get_where('mark' , array(
                    'exam_id' => $data['exam_id'],
                        'class_id' => $data['class_id'],
                            'group_id' => $data['group_id'],
                                'section_id' => $data['section_id'],
                                    'subject_id' => $data['subject_id'],
                                        'year' => $data['year']
                ));
        if($query->num_rows() < 1) {
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']
            ))->result_array();
            foreach($students as $row) {
                $data['student_id'] = $row['student_id'];
                $this->db->insert('mark' , $data);
            }
        }
        redirect(base_url() . 'index.php?admin/marks_manage_view/' . $data['exam_id'] . '/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['subject_id']. '/' . $data['group_id'] , 'refresh');
        
    }

    function marks_update($exam_id = '' , $class_id = '' , $section_id = '' , $subject_id = '',$group_id = '')
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $marks_of_students = $this->db->get_where('mark' , array(
            'exam_id' => $exam_id,
                'class_id' => $class_id,
                    'group_id' => $group_id,
                        'section_id' => $section_id,
                            'year' => $running_year,
                                'subject_id' => $subject_id
        ))->result_array();
        foreach($marks_of_students as $row) {
            $obtained_marks = $this->input->post('marks_obtained_'.$row['mark_id']);
            $comment = $this->input->post('comment_'.$row['mark_id']);
            $this->db->where('mark_id' , $row['mark_id']);
            $this->db->update('mark' , array('mark_obtained' => $obtained_marks , 'comment' => $comment));
        }
        $this->session->set_flashdata('flash_message' , get_phrase('marks_updated'));
        redirect(base_url().'index.php?admin/marks_manage_view/'.$exam_id.'/'.$class_id.'/'.$section_id.'/'.$subject_id.'/'.$group_id , 'refresh');
    }

    function marks_get_subject($class_id)
    {
        $page_data['class_id'] = $class_id;
        $page_data['groups'] = $this->db->get_where('group', array('class_id'=>$class_id))->result_array();
        $this->load->view('backend/admin/marks_get_subject' , $page_data); 
    }

    function marks_get_group_subject($group_id)
    {
        $class_id = $this->db->get_where('group', array('group_id'=>$group_id))->row()->class_id;
        $group_subject = $this->db->get_where('subject', array('class_id'=>$class_id, 'group_id'=>$group_id))->result_array();
        if(count($group_subject) > 0){
            echo json_encode($group_subject);    
        }else{
            echo false;
        }
        
    }

    // TABULATION SHEET
    function tabulation_sheet($class_id = '' , $exam_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['class_id']   = $this->input->post('class_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
                redirect(base_url() . 'index.php?admin/tabulation_sheet/' . $page_data['class_id'] . '/' . $page_data['exam_id'] , 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose class and exam');
                redirect(base_url() . 'index.php?admin/tabulation_sheet/', 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        
        $page_data['page_info'] = 'Exam marks';
        
        $page_data['page_name']  = 'tabulation_sheet';
        $page_data['page_title'] = get_phrase('tabulation_sheet');
        $this->load->view('backend/index', $page_data);
    
    }

    function tabulation_sheet_print_view($class_id , $exam_id) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['class_id'] = $class_id;
        $page_data['exam_id']  = $exam_id;
        $this->load->view('backend/admin/tabulation_sheet_print_view' , $page_data);
    }
    
    
    /****MANAGE GRADES*****/
    function grade($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']        = $this->input->post('name');
            $data['grade_point'] = $this->input->post('grade_point');
            $data['mark_from']   = $this->input->post('mark_from');
            $data['mark_upto']   = $this->input->post('mark_upto');
            $data['comment']     = $this->input->post('comment');
            $this->db->insert('grade', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['grade_point'] = $this->input->post('grade_point');
            $data['mark_from']   = $this->input->post('mark_from');
            $data['mark_upto']   = $this->input->post('mark_upto');
            $data['comment']     = $this->input->post('comment');
            
            $this->db->where('grade_id', $param2);
            $this->db->update('grade', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('grade', array(
                'grade_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('grade_id', $param2);
            $this->db->delete('grade');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        }
        $page_data['grades']     = $this->db->get('grade')->result_array();
        $page_data['page_name']  = 'grade';
        $page_data['page_title'] = get_phrase('manage_grade');
        $this->load->view('backend/index', $page_data);
    }
    
    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['class_id']       = $this->input->post('class_id');
            $data['shift_id']       = $this->input->post('shift_id');
            if($this->input->post('section_id') != '') {
                $data['section_id'] = $this->input->post('section_id');
            }
            if($this->input->post('group_id') != '') {
                $data['group_id'] = $this->input->post('group_id');
            }
            $data['subject_id']     = $this->input->post('subject_id');
            $data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end_min']   = $this->input->post('time_end_min');
            $data['day']            = $this->input->post('day');
            $data['year']           = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->insert('class_routine', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/class_routine_add/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['class_id']       = $this->input->post('class_id');
            if($this->input->post('section_id') != '') {
                $data['section_id'] = $this->input->post('section_id');
            }
            $data['subject_id']     = $this->input->post('subject_id');
            $data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end_min']   = $this->input->post('time_end_min');
            $data['day']            = $this->input->post('day');
            $data['year']           = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            
            $this->db->where('class_routine_id', $param2);
            $this->db->update('class_routine', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/class_routine_view/' . $data['class_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class_routine', array(
                'class_routine_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $class_id = $this->db->get_where('class_routine' , array('class_routine_id' => $param2))->row()->class_id;
            $this->db->where('class_routine_id', $param2);
            $this->db->delete('class_routine');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/class_routine_view/' . $class_id, 'refresh');
        }
        
    }

    function class_routine_add()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'class_routine_add';
        $page_data['page_title'] = get_phrase('add_class_routine');
        $this->load->view('backend/index', $page_data);
    }

    function class_routine_view($class_id, $section_group, $shift_id, $group_or_not='')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if(!empty($group_or_not)){
            $page_data['group_id'] = $section_group;
        }else{
            $page_data['section_id'] = $section_group;
        }

        $page_data['page_name']  = 'class_routine_view';
        $page_data['class_id']  =   $class_id;
        $page_data['shift_id']  =   $shift_id;
        $className = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
        $page_data['page_title'] = get_phrase('class_routine_:_'.$className);
        $this->load->view('backend/index', $page_data);
    }

    function class_routine_print_view($class_id , $section_id, $shift_id, $group_id='')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['class_id']   =   $class_id;
        $page_data['section_id'] =   $section_id;
        $page_data['shift_id']   =   $shift_id;
        if(!empty($group_id)){
            $page_data['group_id']   =   $group_id;
        }
        $this->load->view('backend/admin/class_routine_print_view' , $page_data);
    }

    function get_class_section_subject($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/class_routine_section_subject_selector' , $page_data);
    }

    function section_subject_edit($class_id , $class_routine_id)
    {
        $page_data['class_id']          =   $class_id;
        $page_data['class_routine_id']  =   $class_routine_id;
        $this->load->view('backend/admin/class_routine_section_subject_edit' , $page_data);
    }

    //********** MANAGE ATTENDANCE **********//
    function manage_attendance()
    {
        if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');

        $page_data['page_name']  =  'manage_attendance';
        $page_data['page_title'] =  get_phrase('manage_attendance_of_class');
        $this->load->view('backend/index', $page_data);
    }

    function manage_attendance_view($class_id = '' , $shift_id = '' , $section_id = '' , $timestamp = '',$group_id = '')
    {
        if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');
        $class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
        if(!empty($group_id)):
        $group_name = ' | Group: '.ucwords($this->db->get_where('group' , array('group_id' => $group_id))->row()->name);
        endif;
        $shiftName = ' | Shift: '.ucwords($this->db->get_where('shift' , array('shift_id' => $shift_id))->row()->name);
        $page_data['class_id']  = $class_id;
        $page_data['shift_id']  = $shift_id;
        $page_data['group_id']  = $group_id;
        $page_data['timestamp'] = $timestamp;
        $page_data['page_name'] = 'manage_attendance_view';
        $section_name = ' | Section: '.$this->db->get_where('section' , array('section_id' => $section_id))->row()->name;
        $page_data['section_id'] = $section_id;
        $page_data['page_title'] = get_phrase('manage_attendance_of').' Class: '.$class_name.' '.$section_name.$group_name.$shiftName;
        $this->load->view('backend/index', $page_data);
    }
    
    function get_section($class_id) {
          $page_data['class_id'] = $class_id; 
          $this->load->view('backend/admin/manage_attendance_section_holder' , $page_data);
    }

    function get_group($class_id)
    {
        $groupInfo = $this->db->get_where('group',array('class_id'=>$class_id))->result_array();
        if(!empty($groupInfo)){
            $page_data['group_info'] = $groupInfo; 
            $this->load->view('backend/admin/manage_attendance_group_holder' , $page_data);
        }else{
            return false;
        }
        
    }

    function attendance_selector()
    {
        $className = $this->db->get_where('group', array('class_id'=>$_POST['class_id']))->row()->name;
        if(!empty($className)):
            !empty($_POST['group_id'])?$group_id=$_POST['group_id']:$group_id='';
        else:
            $group_id = '';
        endif;
        // pd($_POST);
        $data['class_id']   = $this->input->post('class_id');
        $data['shift_id']   = $this->input->post('shift_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['year']       = $this->input->post('year');
        $data['timestamp']  = strtotime($this->input->post('timestamp'));        
        
        $query = $this->db->get_where('attendance' ,array(
            'class_id'=>$data['class_id'],
                'shift_id'=>$data['shift_id'],
                    'group_id'=>$group_id,
                        'section_id'=>$data['section_id'],
                            'year'=>$data['year'],
                                'timestamp'=>$data['timestamp']
        ));

        // pd($data);
        if($query->num_rows() < 1) {
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $data['class_id'],'shift_id'=>$data['shift_id'], 'group_id'=>$group_id,'section_id' => $data['section_id'], 'year'=>$data['year']))->result_array();

        //   pd($students);
            foreach($students as $row) {
                $attn_data['class_id']   = $data['class_id'];
                $attn_data['shift_id']   = $data['shift_id'];
                $attn_data['group_id']   = $group_id;
                $attn_data['year']       = $data['year'];
                $attn_data['timestamp']  = $data['timestamp'];
                $attn_data['section_id'] = $data['section_id'];
                $attn_data['student_id'] = $row['student_id'];
                $this->db->insert('attendance' , $attn_data);  
            }            
        }
        redirect(base_url().'index.php?admin/manage_attendance_view/'.$data['class_id'].'/'.$data['shift_id'].'/'.$data['section_id'].'/'.$data['timestamp'].'/'.$group_id,'refresh');
    }

    function attendance_update($class_id = '' , $shift_id = '', $section_id = '' , $timestamp = '', $group_id = '')
    {        
        if(!empty($group_id)):
            $group_id = $group_id;
        else:
            $group_id = '';
        endif;
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
        $attendance_of_students = $this->db->get_where('attendance' , array(
            'class_id'=>$class_id,'shift_id'=>$shift_id,'section_id'=>$section_id,'group_id'=>$group_id,'year'=>$running_year,'timestamp'=>$timestamp
        ))->result_array();
        foreach($attendance_of_students as $row) {
            $attendance_status = $this->input->post('status_'.$row['attendance_id']);
            $this->db->where('attendance_id' , $row['attendance_id']);
            $this->db->update('attendance' , array('status' => $attendance_status));

            if ($attendance_status == 2) {

                if ($active_sms_service != '' || $active_sms_service != 'disabled') {
                    $student_name   = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
                    $parent_id      = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                    $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                    $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
                    $this->sms_model->send_sms($message,$receiver_phone);
                }
            }
        }
        $this->session->set_flashdata('flash_message' , get_phrase('attendance_updated'));
        redirect(base_url().'index.php?admin/manage_attendance_view/'.$class_id.'/'.$shift_id.'/'.$section_id.'/'.$timestamp.'/'.$group_id , 'refresh');
    }
    
    /****** DAILY ATTENDANCE *****************/
    function manage_attendance2($date='',$month='',$year='',$class_id='' , $section_id = '' , $session = '')
    {
        if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');

        $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        
        if($_POST)
        {
            // Loop all the students of $class_id
            $this->db->where('class_id' , $class_id);
            if($section_id != '') {
                $this->db->where('section_id' , $section_id);
            }
            //$session = base64_decode( urldecode( $session ) );
            $this->db->where('year' , $session);
            $students = $this->db->get('enroll')->result_array();
            foreach ($students as $row)
            {
                $attendance_status  =   $this->input->post('status_' . $row['student_id']);

                $this->db->where('student_id' , $row['student_id']);
                $this->db->where('date' , $date);
                $this->db->where('year' , $year);
                $this->db->where('class_id' , $row['class_id']);
                if($row['section_id'] != '' && $row['section_id'] != 0) {
                    $this->db->where('section_id' , $row['section_id']);
                }
                $this->db->where('session' , $session);

                $this->db->update('attendance' , array('status' => $attendance_status));

                if ($attendance_status == 2) {

                    if ($active_sms_service != '' || $active_sms_service != 'disabled') {
                        $student_name   = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
                        $parent_id      = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                        $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                        $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
                        $this->sms_model->send_sms($message,$receiver_phone);
                    }
                }

            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/manage_attendance/'.$date.'/'.$month.'/'.$year.'/'.$class_id.'/'.$section_id.'/'.$session , 'refresh');
        }
        $page_data['date']       =  $date;
        $page_data['month']      =  $month;
        $page_data['year']       =  $year;
        $page_data['class_id']   =  $class_id;
        $page_data['section_id'] =  $section_id;
        $page_data['session']    =  $session;
        
        $page_data['page_name']  =  'manage_attendance';
        $page_data['page_title'] =  get_phrase('manage_daily_attendance');
        $this->load->view('backend/index', $page_data);
    }
    function attendance_selector2()
    {
        //$session = $this->input->post('session');
        //$encoded_session = urlencode( base64_encode( $session ) );
        redirect(base_url() . 'index.php?admin/manage_attendance/'.$this->input->post('date').'/'.
                    $this->input->post('month').'/'.
                        $this->input->post('year').'/'.
                            $this->input->post('class_id').'/'.
                                $this->input->post('section_id').'/'.
                                    $this->input->post('session') , 'refresh');
    }
        ///////ATTENDANCE REPORT /////
     function attendance_report() {
         $page_data['month']        = date('m');
         $page_data['page_name']    = 'attendance_report';
         $page_data['page_title']   = get_phrase('attendance_report');
         $this->load->view('backend/index',$page_data);
     }
     function attendance_report_view($class_id = '' ,$shift_id = '' , $section_id = '', $month = '', $group_id = '') {
         if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');
        $class_name = $this->db->get_where('class' , array(
            'class_id' => $class_id
        ))->row()->name;
        $page_data['class_id'] = $class_id;
        $page_data['shift_id'] = $shift_id;
        $page_data['group_id'] = $group_id;
        $page_data['month']    = $month;
        $page_data['page_name'] = 'attendance_report_view';
        $section_name = $this->db->get_where('section' , array(
            'section_id' => $section_id
        ))->row()->name;
        $shift_name = $this->db->get_where('shift' , array(
            'shift_id' => $shift_id
        ))->row()->name;
        $page_data['section_id'] = $section_id;
        $page_data['page_title'] = get_phrase('attendance_report_of_class') . ' ' . $class_name . ' : ' . get_phrase('section') . ' ' . $section_name. ' : ' . get_phrase('shift') . ' ' . $shift_name;
        $this->load->view('backend/index', $page_data);
     }
     function attendance_report_print_view($class_id ='' ,$shift_id ='' , $section_id = '' , $month = '', $group_id = '') {
          if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['class_id'] = $class_id;
        $page_data['shift_id'] = $shift_id;
        $page_data['section_id']  = $section_id;
        $page_data['month'] = $month;
        $page_data['group_id'] = $group_id;
        $this->load->view('backend/admin/attendance_report_print_view' , $page_data);
    }
     
    function attendance_report_selector()
    {
        $className = $this->db->get_where('group', array('class_id'=>$_POST['class_id']))->row()->name;
        if(!empty($className)):
            !empty($_POST['group_id'])?$group_id=$_POST['group_id']:$group_id=NULL;
        else:
            $group_id = NULL;
        endif;
        $data['class_id']   = $this->input->post('class_id');
        $data['shift_id']   = $this->input->post('shift_id');
        $data['year']       = $this->input->post('year');
        $data['month']  = $this->input->post('month');
        $data['section_id'] = $this->input->post('section_id');
        redirect(base_url().'index.php?admin/attendance_report_view/'.$data['class_id'].'/'.$data['shift_id'].'/'.$data['section_id'].'/'.$data['month'].'/'.$group_id,'refresh');
    }
    
    


    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']        = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['price']       = $this->input->post('price');
            $data['author']      = $this->input->post('author');
            $data['class_id']    = $this->input->post('class_id');
            //$data['status']      = $this->input->post('status');
            $this->db->insert('book', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['price']       = $this->input->post('price');
            $data['author']      = $this->input->post('author');
            $data['class_id']    = $this->input->post('class_id');
            //$data['status']      = $this->input->post('status');
            
            $this->db->where('book_id', $param2);
            $this->db->update('book', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('book', array(
                'book_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('book_id', $param2);
            $this->db->delete('book');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        }
        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'book';
        $page_data['page_title'] = get_phrase('manage_library_books');
        $this->load->view('backend/index', $page_data);
        
    }
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function transport($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['route_name']        = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            $data['description']       = $this->input->post('description');
            $data['route_fare']        = $this->input->post('route_fare');
            $this->db->insert('transport', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/transport', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['route_name']        = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            $data['description']       = $this->input->post('description');
            $data['route_fare']        = $this->input->post('route_fare');
            
            $this->db->where('transport_id', $param2);
            $this->db->update('transport', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/transport', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('transport', array(
                'transport_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('transport_id', $param2);
            $this->db->delete('transport');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/transport', 'refresh');
        }
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('backend/index', $page_data);
        
    }
    /**********MANAGE DORMITORY / HOSTELS / ROOMS ********************/
    function dormitory($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']           = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            $data['description']    = $this->input->post('description');
            $this->db->insert('dormitory', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']           = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            $data['description']    = $this->input->post('description');
            
            $this->db->where('dormitory_id', $param2);
            $this->db->update('dormitory', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('dormitory', array(
                'dormitory_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('dormitory_id', $param2);
            $this->db->delete('dormitory');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        }
        $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
        $page_data['page_name']   = 'dormitory';
        $page_data['page_title']  = get_phrase('manage_dormitory');
        $this->load->view('backend/index', $page_data);
        
    }
    
    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);

            $check_sms_send = $this->input->post('check_sms');

            if ($check_sms_send == 1) {
                // sms sending configurations

                $parents  = $this->db->get('parent')->result_array();
                $students = $this->db->get('student')->result_array();
                $teachers = $this->db->get('teacher')->result_array();
                $date     = $this->input->post('create_timestamp');
                $message  = $data['notice_title'] . ' ';
                $message .= get_phrase('on') . ' ' . $date;
                foreach($parents as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($students as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($teachers as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);

            $check_sms_send = $this->input->post('check_sms');

            if ($check_sms_send == 1) {
                // sms sending configurations

                $parents  = $this->db->get('parent')->result_array();
                $students = $this->db->get('student')->result_array();
                $teachers = $this->db->get('teacher')->result_array();
                $date     = $this->input->post('create_timestamp');
                $message  = $data['notice_title'] . ' ';
                $message .= get_phrase('on') . ' ' . $date;
                foreach($parents as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($students as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($teachers as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }
        if ($param1 == 'mark_as_archive') {
            $this->db->where('notice_id' , $param2);
            $this->db->update('noticeboard' , array('status' => 0));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }

        if ($param1 == 'remove_from_archived') {
            $this->db->where('notice_id' , $param2);
            $this->db->update('noticeboard' , array('status' => 1));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $this->load->view('backend/index', $page_data);
    }
    function reload_noticeboard() {
        $this->load->view('backend/admin/noticeboard');
    }
    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?admin/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?admin/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }


    
    /*****SITE/SYSTEM SETTINGS*********/
    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        
        if ($param1 == 'do_update') {
			 
            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_title');
            $this->db->where('type' , 'system_title');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('address');
            $this->db->where('type' , 'address');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('phone');
            $this->db->where('type' , 'phone');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('paypal_email');
            // $data['description'] = $data['description']!=''?$data['description']:'';
            $this->db->where('type' , 'paypal_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('currency');
            $this->db->where('type' , 'currency');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_email');
            $this->db->where('type' , 'system_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('language');
            $this->db->where('type' , 'language');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('text_align');
            $this->db->where('type' , 'text_align');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('running_year');
            $this->db->where('type' , 'running_year');
            $this->db->update('settings' , $data);
			
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated')); 
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'change_skin') {
            $data['description'] = $param2;
            $this->db->where('type' , 'skin_colour');
            $this->db->update('settings' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('theme_selected')); 
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh'); 
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function get_session_changer()
    {
        $this->load->view('backend/admin/change_session');
    }

    function change_session()
    {
        $data['description'] = $this->input->post('running_year');
        $this->db->where('type' , 'running_year');
        $this->db->update('settings' , $data);
        $this->session->set_flashdata('flash_message' , get_phrase('session_changed')); 
        redirect(base_url() . 'index.php?admin/dashboard/', 'refresh'); 
    }
	
	/***** UPDATE PRODUCT *****/
	
	function update( $task = '', $purchase_code = '' ) {
        
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
            
        // Create update directory.
        $dir    = 'update';
        if ( !is_dir($dir) )
            mkdir($dir, 0777, true);
        
        $zipped_file_name   = $_FILES["file_name"]["name"];
        $path               = 'update/' . $zipped_file_name;
        
        move_uploaded_file($_FILES["file_name"]["tmp_name"], $path);
        
        // Unzip uploaded update file and remove zip file.
        $zip = new ZipArchive;
        $res = $zip->open($path);
        if ($res === TRUE) {
            $zip->extractTo('update');
            $zip->close();
            unlink($path);
        }
        
        $unzipped_file_name = substr($zipped_file_name, 0, -4);
        $str                = file_get_contents('./update/' . $unzipped_file_name . '/update_config.json');
        $json               = json_decode($str, true);
        

			
		// Run php modifications
		require './update/' . $unzipped_file_name . '/update_script.php';
        
        // Create new directories.
        if(!empty($json['directory'])) {
            foreach($json['directory'] as $directory) {
                if ( !is_dir( $directory['name']) )
                    mkdir( $directory['name'], 0777, true );
            }
        }
        
        // Create/Replace new files.
        if(!empty($json['files'])) {
            foreach($json['files'] as $file)
                copy($file['root_directory'], $file['update_directory']);
        }
        
        $this->session->set_flashdata('flash_message' , get_phrase('product_updated_successfully'));
        redirect(base_url() . 'index.php?admin/system_settings');
    }

    /*****SMS SETTINGS*********/
    function sms_settings($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        $page_data['user'] = $this->db->get_where('settings', array('type'=>'nihalit_sms_user'))
            ->row()
            ->description;            
        $page_data['pass'] = $this->db->get_where('settings', array('type'=>'nihalit_sms_password'))
            ->row()
            ->description;
        $page_data['page_name']  = 'sms_settings';
        $page_data['page_title'] = get_phrase('sms_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    function save_sms_setting()
    {
        $data['description'] = $_POST['sms_user'];
        $this->db->where('type','nihalit_sms_user');
        $this->db->update('settings',$data);
        
        $data1['description'] = $_POST['sms_password'];
        $this->db->where('type','nihalit_sms_password');
        $this->db->update('settings',$data1);
        $this->flashmsg('information_updated');
        redirect(base('admin', 'sms_settings'));
    }

    function send_custom_sms($sender = '',$msg = '', $mobile = '', $arg = false)
    {
        $user = $this->db->get_where('settings', array('type'=>'nihalit_sms_user'))
            ->row()
            ->description;            
        $pass = $this->db->get_where('settings', array('type'=>'nihalit_sms_password'))
            ->row()
            ->description;          
      

        $sender = urlencode(!empty($sender)?$sender:$_POST['sms_title']);
        $msg    = urlencode(!empty($msg)?$msg:$_POST['sms_description']);
        $mobile = !empty($mobile)?$mobile:$_POST['sms_number'];
        if($arg == true){
            $msg = str_replace('2C', '0A', $msg);    
        }
        

        // echo $pass;
        // echo '<br>';
        // echo $user;
        // echo '<br>';
        // echo $sender;
        // echo '<br>';
        // print_r($msg);
        // echo '<br>';
        // // var_dump($_POST['sms_description']);
        // echo '<br>';
        // echo $mobile;
        // echo '<br>';
        // print_r($arg);

        // die();

        if($_POST['sms_lng']=='bangla') {
            $this->unicode_long_sms_api($user,$pass,$sender,$msg,$mobile);            
        }
        if($_POST['sms_lng']=='english' || $arg == true) {
            $this->long_sms_api($user,$pass,$sender,$msg,$mobile);
        }

        if($arg == false) {
            $this->flashmsg('SMS Send');
            redirect(base('admin', 'sms_settings'));            
        } else {
            return true;
        }
        
    }


    /*****LANGUAGE SETTINGS*********/
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'edit_phrase') {
			$page_data['edit_profile'] 	= $param2;	
		}
		if ($param1 == 'update_phrase') {
			$language	=	$param2;
			$total_phrase	=	$this->input->post('total_phrase');
			for($i = 1 ; $i < $total_phrase ; $i++)
			{
				//$data[$language]	=	$this->input->post('phrase').$i;
				$this->db->where('phrase_id' , $i);
				$this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
			}
			redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/'.$language, 'refresh');
		}
		if ($param1 == 'do_update') {
			$language        = $this->input->post('language');
			$data[$language] = $this->input->post('phrase');
			$this->db->where('phrase_id', $param2);
			$this->db->update('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_phrase') {
			$data['phrase'] = $this->input->post('phrase');
			$this->db->insert('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_language') {
			$language = $this->input->post('language');
			$this->load->dbforge();
			$fields = array(
				$language => array(
					'type' => 'LONGTEXT'
				)
			);
			$this->dbforge->add_column('language', $fields);
			
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'delete_language') {
			$language = $param2;
			$this->load->dbforge();
			$this->dbforge->drop_column('language', $language);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		$page_data['page_name']        = 'manage_language';
		$page_data['page_title']       = get_phrase('manage_language');
		//$page_data['language_phrases'] = $this->db->get('language')->result_array();
		$this->load->view('backend/index', $page_data);	
    }
    
    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }
        
        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            
            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'add_account') {
            $data['name']     = $this->input->post('name');
            $data['email']    = $this->input->post('email');
            $data['password'] = sha1($this->input->post('password'));
            $data['level']    = 1;
            
            $this->db->insert('admin', $data);
            $admin_id = $this->db->insert_id;
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $admin_id . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('new_account_added'));
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = sha1($this->input->post('password'));
            $data['new_password']         = sha1($this->input->post('new_password'));
            $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));
            
            $current_password = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('admin_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('admin', array(
            'admin_id' => $this->session->userdata('admin_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    // VIEW QUESTION PAPERS
    function question_paper($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        $data['page_name']  = 'question_paper';
        $data['page_title'] = get_phrase('question_paper');
        $this->load->view('backend/index', $data);
    }

     // MANAGE PARENTS CLASSWISE
    function librarian($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        if ($param1 == 'create') {
            $data['name']       = $this->input->post('name');
            $data['email']      = $this->input->post('email');
            $data['password']   = sha1($this->input->post('password'));

            $this->db->insert('librarian', $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            $this->email_model->account_opening_email('librarian', $data['email'], $this->input->post('password')); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/librarian/', 'refresh');
        }

        if ($param1 == 'edit') {
            $data['name']   = $this->input->post('name');
            $data['email']  = $this->input->post('email');

            $this->db->where('librarian_id' , $param2);
            $this->db->update('librarian' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/librarian/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('librarian_id' , $param2);
            $this->db->delete('librarian');
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/librarian/', 'refresh');
        }

        $page_data['page_title']    = get_phrase('all_librarians');
        $page_data['page_name']     = 'librarian';
        $this->load->view('backend/index', $page_data);
    }
    
    // SMS API FUNCTION AND API INFO    
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
        $mystring = $this->get_data($url);
        return $mystring;
    }

    function long_sms_api($user,$pass,$sender,$msg,$mobile)
    {
        $url = "http://api.zaman-it.com/api/sendsms/plain?user=$user&password=$pass&sender=$sender&SMSText=$msg&GSM=88$mobile&type=longSMS";
        $mystring = $this->curl_url($url);
        return $mystring;
    }

    function unicode_long_sms_api($user,$pass,$sender,$msg,$mobile)
    {
        $url = "http://api.zaman-it.com/api/v3/sendsms/plain?user=$user&password=$pass&sender=$sender&text=$msg&GSM=88$mobile&datacoding=8&type=longSMS";
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


    // ======= DATABASE SECTION ======== //
    function database_structure()
    {
        $page_data['page_title']    = get_phrase('database_structure');
        $page_data['page_name']     = 'database_structure';
        $this->load->view('backend/index', $page_data);
    } 

    function get_database_table($table_name)
    {   
        $fields['table_name'] = $table_name;
        $fields['table_field'] = $this->db->field_data($table_name);

        $this->db->order_by($fields['table_field'][0]->name, 'DESC');
        $fields['table_data'] = $this->db->get($table_name)->result_array();
        
        $this->load->view('backend/admin/get_database_table', $fields);
    }

    function delete_database_entitie()
    {
        $table_name = $this->uri->segment(3);
        $column_name = $this->uri->segment(4);
        $entitie_id = $this->uri->segment(5);
        
        $this->db->where($column_name, $entitie_id);
        $this->db->delete($table_name);

        $this->flashmsg('Delete '.$table_name.' Entities');
        redirect(base('admin', 'database_structure'));
    }

    function add_data_to_database()
    {
        $table_name = $this->uri->segment(3);
        $data = $this->input->post();

        $this->db->insert($table_name, $data);
        $this->flashmsg('Data Inserted In '.$table_name.' Table');
        redirect(base('admin', 'database_structure'));
    }

    function edit_data_to_database()
    {
        $table_name = $this->uri->segment(3);
        $column_name = $this->uri->segment(4);
        $entitie_id = $this->uri->segment(5);
        $data = $this->input->post();
        
        $this->db->where($column_name, $entitie_id);
        $this->db->update($table_name, $data);

        $this->flashmsg('Data Updated In '.$table_name.' Table');
        redirect(base('admin', 'database_structure'));
    }

    // Excel file to sms
    // 
    function send_result_sms()
    {
        $page_data['csv_result'] = $this->db->get('csv_exam_results')->result_array();
        $page_data['page_title']    = get_phrase('Send Result');
        $page_data['page_name']     = 'send_result_sms';
        $this->load->view('backend/index', $page_data);
    }

    function send_result_csv()
    {
        $exam_type = $_POST['exam_type'];
        $file = $_FILES["csv_file"]["tmp_name"];

        // ========= Load excel library & fetch data
        $this->load->library('excel_reader');
        $this->excel_reader->read($file);
        $worksheet = $this->excel_reader->sheets[0];        

        $firstRow = $worksheet['cells'][1]; // Seperate Column Header
        unset($worksheet['cells'][1]);



        
        if(!empty(current($worksheet['cells'])) && count(current($worksheet['cells'])) > 12) {
            
            $data = [
                'csv_id' => current($worksheet['cells'])[2],
                'exam_date' => strtotime(current($worksheet['cells'])[1]),
            ];    
            // ========== Check if data already exist
            $dataExist = $this->db->get_where('csv_exam_results', $data)->result_array();
            
            if(empty($dataExist)) {

                // ========== Filter data to excelsheet
                foreach($worksheet['cells'] as $key1=>$each1) {
                if (count($each1) == 13){
                    foreach($firstRow as $key2=>$each2) {                    
                        $margedArray[$each2] = $worksheet['cells'][$key1][$key2];
                        $margedArray2[$key2] = $worksheet['cells'][$key1][$key2];
                        }
                        $margeFinalForSms[] = $margedArray;    
                        $margeFinalForDatabase[] = $margedArray2;    
                    }      
                }




                // ========= Prepare string to send sms
                foreach($margeFinalForSms as $key1=>$each1) {  
                    $subjects = [];
                    foreach($firstRow as $key2=>$each2) {

                        // Date And ID
                        if($key2 == 1 || $key2 == 2) {                    
                            $smsString .= $each2.': '.$each1[$each2].',';               
                        }
                        // Name
                        if($key2 == 3) {                    
                            $smsString .= $each2.': '.$each1[$each2].',';               
                        }
                        // Obtain Mark
                        if($key2 == 4 || $key2 == 7 || $key2 == 10) {                                   
                            $selectSubject = explode(' ', $each2);
                            $smsString .= $selectSubject[0].': '.$each1[$each2]; 
                            $subjects[] = $each2; // Store subject for save data to database
                        }
                        // Height Mark
                        if($key2 == 5 || $key2 == 8 || $key2 == 11) {  
                            $smsString .= '-H:'.$each1[$each2].' ';   
                        }
                        // Total Mark
                        if($key2 == 6 || $key2 == 9 || $key2 == 12) {                            
                            
                            if($key2 == 12) {
                                $smsString .= '('.$each1[$each2].'),Biggan Academy'; 
                            } else {
                                $smsString .= '('.$each1[$each2].'),';  
                            }
                        }
                    }
                    
                    $smsFinalString[$each1['Phone']] = $smsString;             
                    // Send SMS
                    $this->send_custom_sms('Biggan Academy',$smsString, $each1['Phone'], true);   
                    $smsString = '';
                }

                // echo '<pre>';
                // print_r($subjects);
                // die();

                // ======== Store Data to Database
                foreach ($margeFinalForDatabase as $k1 => $each1) {
                    $data = [];
                    foreach ($subjects as $k2 => $each2) {
                        $data['exam_date'] = strtotime($each1[1]);
                        $data['upload_date'] = strtotime(date('d-m-Y'));
                        $data['subjects'] = current(explode(' ', $each2));
                        $data['csv_id'] = $each1[2];
                        $data['name'] = $each1[3];
                        if($k2 == 0) {
                            $data['marks'] = $each1[4].'|'.$each1[5].'|'.$each1[6];
                        } elseif($k2 == 1) {
                            $data['marks'] = $each1[7].'|'.$each1[8].'|'.$each1[9];
                        } else {
                            $data['marks'] = $each1[10].'|'.$each1[11].'|'.$each1[12];
                        }                
                        $data['exam_type'] = $exam_type;
                        $data['phone'] = $each1[13];
                        $ForDatabase[] = $data;
                        // Store data to database
                        $this->db->insert('csv_exam_results', $data);
                    }
                }

                // echo '<pre>';
                // print_r($smsFinalString);
                // echo '<br>';
                // print_r($ForDatabase);
                // die();

                $this->flashmsg('SMS Send');
                redirect(base('admin', 'send_result_sms'));

            } else {
                $this->flashmsg('Result already send.','error');
                redirect(base('admin', 'send_result_sms')); 
            }

        } else {
            $this->flashmsg('Please upload valid file.','error');
            redirect(base('admin', 'send_result_sms')); 
        }
        
        

        

        // ============= CSV file reader laibrary 
        // $this->load->library('CSVReader');
        // $csvData = $this->csvreader->parse_file($file); //path to csv file
        // echo '<pre>';
        // print_r($csvData);

    }

    function export_student_info_excel($extra = [])
    {
        // pd($extra);
        $this->load->library('excel');
        if(!empty($extra)){
            $class_id     = $extra['class_id'];    
        }else{
            $class_id     = $this->uri->segment(3);
        }        
        $running_year = $this->uri->segment(4);

        $className = $this->db->get_where('class',['class_id'=>$class_id])->result_array();
        $className = $className[0]['name'];
        
        // SET CUSTOM COLUMN WIDTH -- START
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth("20");
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth("20");
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth("20");
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth("25");
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth("25");
        // SET CUSTOM COLUMN WIDTH -- END

        $this->excel->setActiveSheetIndex(0); // SELECT PAGE        
        $this->excel->getActiveSheet()->setTitle('Class '.$className); // PAGE TITLE        
        $this->excel->getActiveSheet()->freezePane('A2'); // FREEZE TOP ROW
        // SET TOP ROW VALUE -- START
        $this->excel->getActiveSheet()->setCellValue('A1', 'ID');               
        $this->excel->getActiveSheet()->setCellValue('B1', 'Name');    
        $this->excel->getActiveSheet()->setCellValue('C1', 'Roll');    
        $this->excel->getActiveSheet()->setCellValue('D1', 'Section');  
        $this->excel->getActiveSheet()->setCellValue('E1', 'Group');   
        $this->excel->getActiveSheet()->setCellValue('F1', 'Shift');   
        $this->excel->getActiveSheet()->setCellValue('G1', 'Father Name');               
        $this->excel->getActiveSheet()->setCellValue('H1', 'Mobile');          
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
        $this->excel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray['styleTwo']);
        // SET CUSTOM STYLE -- END

        if(!empty($extra)){
            $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $extra['year'] = $running_year;
            $studentInfo = $this->db->get_where('enroll' , $extra)->result_array();    
        }else{
            $studentInfo = $this->db->get_where('enroll' , 
            ['class_id' => $class_id, 'year'=> $running_year])->result_array();
        }          
        
        foreach($studentInfo as $key=>$each) {
            $std_id = $each['student_id'];
            $sft_id = $each['shift_id'];
            $sec_id = $each['section_id'];
            if(!empty($sec_id)){
                $sec_info = $this->db->get_where('section',['section_id'=>$sec_id])->result_array();
                $sec_info = $sec_info[0]['name'];
            }else {$sec_info = '';}  

            $grp_id = $each['group_id'];
            if(!empty($grp_id)){
                $grp_info = $this->db->get_where('group',['group_id'=>$grp_id])->result_array();
                $grp_info = $grp_info[0]['name'];
            }else {$grp_info = '';}

            $sft_info = $this->db->get_where('shift',['shift_id'=>$sft_id])->result_array();
            $sft_info = $sft_info[0]['name'];
            $std_info = $this->db->get_where('student',['student_id'=>$std_id])->result_array();
            
            
            $key = $key+2;
            $this->excel->getActiveSheet()->getStyle("A$key:H$key")
            ->getAlignment()->setWrapText(true); 

            $this->excel->getActiveSheet()->setCellValue('A'.$key, $std_id);
            $this->excel->getActiveSheet()->setCellValue('B'.$key, $std_info[0]['name']);            
            $this->excel->getActiveSheet()->setCellValue('C'.$key, $each['roll']); 
            $this->excel->getActiveSheet()->setCellValue('D'.$key, $sec_info); 
            $this->excel->getActiveSheet()->setCellValue('E'.$key, $grp_info); 
            $this->excel->getActiveSheet()->setCellValue('F'.$key, $sft_info); 
            $this->excel->getActiveSheet()->setCellValue('G'.$key, $std_info[0]['fname']); 
            $this->excel->getActiveSheet()->setCellValue('H'.$key, $std_info[0]['mobile']); 
        }

        if(!empty($extra)){
            $grp_info = !empty($grp_info)?'_Group-'.$grp_info:'';
            $filename= 'Class-'.$className.'_Shift-'.$sft_info.$grp_info.'_Section-'.$sec_info.'-All-Students.xls';   
        }else{
            $filename= 'Class-'.$className.'-All-Students.xls';
        }
        
        // SET HEADER -- START
        header('Content-Type: application/vnd.ms-excel'); // EXCEL FORMAT (CURRENT EXCEL 2007-2013) 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); // SET FILE NAME
        header('Cache-Control: max-age=0');
        // SET HEADER -- END
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); // EXCEL FORMAT (CURRENT EXCEL 2007-2013) 
        $objWriter->save('php://output'); // FOURCE DOWNLOAD
        
    }

    function create_excel()
    {
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Class 6');
        $this->excel->getActiveSheet()->freezePane('A2');
        $this->excel->getActiveSheet()->setCellValue('A1', 'Class 6 students');               
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

        //$this->excel->setActiveSheetIndex(1);
        $newSheet = $this->excel->createSheet(1);
        $newSheet->setTitle('Class 7');
        $newSheet->freezePane('A2');
        $newSheet->setCellValue('A1', 'Class 7 students');               
        $newSheet->getStyle('A1')->getFont()->setBold(true);
        
        $filename='just_some_random_name.xlsx';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        header('Cache-Control: max-age=0');
                    
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
        $objWriter->save('php://output');
    }

    function download_excel()
    {
        $page_data['page_title']    = get_phrase('download_excel');
        $page_data['page_name']     = 'download_excel_std_info';
        $this->load->view('backend/index', $page_data);
    }

    function download_excel_formet()
    {
        $form_info = $this->input->post();
        $type = $form_info['download'];
        array_splice($form_info, -1);
        if($type = 'student_information') {
            $this->export_student_info_excel($form_info);
        } else {
            echo 'This section was on going development.';
        }
        // $info = $this->db->get_where('enroll', $form_info)->result_array();       
    }

    // FILE DERECTORY 
    // 
    function directory()
    {
        $this->load->helper('directory');
        $page_data['map'] = directory_map('/home2/mralam/public_html/anauv.edu.bd');

        $page_data['page_title']    = get_phrase('directory');
        $page_data['page_name']     = 'get_directory_stracture';
        $this->load->view('backend/index', $page_data);
    }

    function delete_file()
    {
        $get_v = array_keys($_GET);
        $arr = explode('/', $get_v[0]);
        $f_arr = array_slice($arr, 2);
        $path = implode('/', $f_arr);
        $f_path = str_replace('_', '.', $path);

        if(unlink('./'.$f_path)) {
             $this->flashmsg('Successfully Deleted.');
             redirect(base('admin', 'directory'));
        }else{
             $this->flashmsg('Error Delete File.', 'error');
             redirect(base('admin', 'directory'));
        }
    }

    // DB BACKUP
    
    function db_backup()
    {
        $this->load->dbutil();
        $prefs = array(     
                'format'      => 'zip',             
                'filename'    => 'my_db_backup.sql'
              );
        $backup =& $this->dbutil->backup($prefs); 
        $db_name = 'backup-on-'. date("d-m-Y-H-i-s") .'.zip';
        $save = './uploads/db/'.$db_name;
        $this->load->helper('file');
        write_file($save, $backup); 
        $this->load->helper('download');
        force_download($db_name, $backup);
    }

    function code_edit()
    {
        $this->load->view('backend/admin/code_edit');
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


    function curl_url($url)
    {
        // // create a new cURL resource
        // $ch = curl_init();

        // // set URL and other appropriate options
        // curl_setopt($ch, CURLOPT_URL, "$url");
        // curl_setopt($ch, CURLOPT_HEADER, 0);

        // // grab URL and pass it to the browser
        // curl_exec($ch);

        // // close cURL resource, and free up system resources
        // curl_close($ch);
        $data = file_get_contents($url);
        if($data) {
            return true;
        }
        return true;
        
    }

}
















