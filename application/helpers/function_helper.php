<?php
//use Stichoza\GoogleTranslate\TranslateClient;
function ci()
{
    $ci =& get_instance();
    return $ci;
}

function vd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function vde($data)
{
    vd($data);
    exit();
}

function pd($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die();
}

function pde($data)
{
    pd($data);
    exit();
}

function selected_value($id, $selectType, $selected)
{
    ci()->db->select('*');
    ci()->db->from('profile');
    ci()->db->where('id', $id);
    $query = ci()->db->get();
    $row = $query->row_array();
    $selectType = $row[$selectType];
    if ($selectType == $selected) {
        echo 'selected';
    } else {
        echo '';
    }
}

//ci()->db->where('profile_type', 'student');
function flashdata($name,$value)
{
    ci()->session->set_flashdata($name, $value);
}

function flashdata_get($name)
{
    if(isset($_SESSION[$name])){
        $value = ci()->session->flashdata('item');
        return $value;
    }else{
        return '';
    }
    
}

function set_flashmsg($data, $type)
{   
    $array = array('msg' => $data, 'type' => $type);
    //ci()->session->set_flashdata('massage', $array);
    $_SESSION['message'] = $array;
}

function flash_msg()
{
//    $info = ci()->session->flashdata('massage');
    if(isset($_SESSION['message'])){
        $array = $_SESSION['message'];
        $msg = $array['msg'];
        if($array['type'] == 'succ'){
            $body = "<div class='alert alert-success'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>Success!</strong> $msg.</div>";
        }else{
            $body = "<div class='alert alert-warning'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>Warning!</strong> $msg.</div>";
        }
        unset($_SESSION['message']);
        return $body;
    }
}

function e($data)
{
    echo $data;
    exit();
}

// ============= New ============ //

function base($con,$func,$key = '')
{
    $result = base_url().'index.php?'.$con.'/'.$func;
    return $result;    
}

function current_time()
{
    $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $current_time = $dt->format('Y-m-d H:i:s');
    return $current_time;
}

function selected($data1,$data2)
{
    if($data1==$data2){
        $result = 'selected="selected"';
    }else{
        $result = '';
    }
    return $result;
}

function checked($data1,$data2)
{
    if($data1==$data2){
        $result = 'checked="checked"';
    }else{
        $result = '';
    }
    return $result;
}

function checked2($data1,$data2)
{
    if(in_array($data1, $data2)){
        $result = 'checked="checked"';
    }else{
        $result = '';
    }
    return $result;
}

function ckd($data1,$data2)
{
    $neddle = strpos($data1, $data2);
    if($neddle !== false){
        $result = 'checked="checked"';
    }else{
        $result = '';
    }
    return $result;
}

function upload_file($s,$w,$h,$file_name,$logo='')
{
    $session = $this->db->get_where('settings', array('type' => 'admission_session'))->row()->description;
    $dir = 'assets/images/admission_student/'.$session;
    if (!is_dir($dir)){
        mkdir($dir, 0777, true);
    }            

    if(empty($logo)):
        $config['upload_path']   = './assets/images/admission_student/'.$session; 
    else:
        $config['upload_path']   = './assets/images'; 
    endif;
    $config['allowed_types'] = '*'; 
    $config['overwrite']     = TRUE;
    $config['max_size']      = $s; 
    $config['max_width']     = $w; 
    $config['max_height']    = $h;  
    $config['file_name']     = $file_name;
    return $config;
}

function upload_file_gallery($s,$w,$h,$file_name)
{
    $config['upload_path']   = './assets/images/gallery_image'; 
    $config['allowed_types'] = '*'; 
    $config['overwrite']     = TRUE;
    $config['max_size']      = $s; 
    $config['max_width']     = $w; 
    $config['max_height']    = $h;  
    $config['file_name']     = $file_name;
    return $config;
}

function upload_file_slider($s,$w,$h,$file_name)
{
    $config['upload_path']   = './assets/images/slider_image'; 
    $config['allowed_types'] = '*'; 
    $config['overwrite']     = TRUE;
    $config['max_size']      = $s; 
    $config['max_width']     = $w; 
    $config['max_height']    = $h;  
    $config['file_name']     = $file_name;
    return $config;
}

function resize_file($w,$h)
{
    $config['image_library']  = 'gd2';
    $config['source_image']   = ci()->upload->upload_path.ci()->upload->file_name;
    $config['maintain_ratio'] = TRUE;
    $config['width']          = $w;
    $config['height']         = $h;
    return $config;
}

function arrayUnique($ar1, $col1,$ar2, $col2)
{
    $r = array();
    foreach($ar1 as $key=>$list){
        foreach($ar2 as $k=>$list2){
            if($list[$col1]==$list2[$col2]){
                $r[] = $k;
            }
        }
    }
    return $r;
}

function gpaAgrade($data)
{
    if($data >= 80){
        $grade = 'A+';
        $point = 5;
    }elseif($data >= 70){
        $grade = 'A';
        $point = 4;
    }elseif($data >= 60){
        $grade = 'A-';
        $point = 3.5;
    }elseif($data >= 50){
        $grade = 'B';
        $point = 3;
    }elseif($data >= 40){
        $grade = 'C';
        $point = 2;
    }elseif($data >= 33){
        $grade = 'D';
        $point = 1;
    }else{
        $grade = 'F';
        $point = 0;
    }
    return array('grade'=> $grade, 'point'=>$point);
}

function bubbleSort(array $array) 
{
    $array_size = count($array);
    for($i = 0; $i < $array_size; $i ++) {
        for($j = 0; $j < $array_size; $j ++) {
            if ($array[$i] < $array[$j]) {
                $tem = $array[$i];
                $array[$i] = $array[$j];
                $array[$j] = $tem;
            }
        }
    }
    return $array;
}

function return_month($data)
{
    $array = explode('_', $data);
    foreach ($array as $list){
        $mounth[] = numberTomonth($list);
    }
    $string = implode(',', $mounth);
    return $string;
}

function numberTomonth($data)
{
    switch ($data) {
    case 1:
        return 'January';
    case 2:
       return 'February';
    case 3:
       return 'March';
    case 4:
        return 'April';
    case 5:
        return 'May';
    case 6:
        return 'June';
    case 7:
        return 'July';
    case 8:
        return 'August';
    case 9:
        return 'September';
    case 10:
        return 'October';
    case 11:
        return 'November';
    case 12:
        return 'December';
    }
}

function search_value($name,$array)
{
    $key = array_key_exists($name, $array);
    if($key){
        return $array[$name];
    }else{
        return '';
    }
}

function month_check($array, $find)
{
    $key = array_search($find, $array);
    if ($key!==false) {
        return 'checked="checked"';
    }else{
        return '';
    }
}

function validator($data,$data1='',$data2='')
{
    if($data=='user'){
        return 'data-validation="custom" data-validation-regexp="^([A-Za-z. ]+)$"';
    }elseif('address'){
        return 'data-validation="custom" data-validation-regexp="^([A-Za-z0-9-/:,. ]+)$"';
    }elseif ($data=='email') {
        return 'data-validation="email"';
    }elseif($data=='pass'){
        return 'data-validation="length" data-validation-length="min5"';
    }elseif ($data=='req') {
        return 'data-validation="required"';
    }elseif ($data=='check') {
        return 'data-validation="checkbox_group" data-validation-qty="min1"';
    }elseif ($data=='rng') {
        return 'data-validation="number" data-validation-allowing="range[1;100]"';
    }elseif ($data=='num') {
        return 'data-validation="custom" data-validation-regexp="^([0-9]+)$"';
    }elseif ($data=='file') {
        return 'data-validation="dimension mime" data-validation-allowing="jpg, png" data-validation-dimension="max'.$data1.'x'.$data2.'"';
        //max=width*height
    }else{
        return '';
    } 
}


function encryptor($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    //pls set your unique hashing key
    $secret_key = 'october';
    $secret_iv = 'october123';
    // hash
    $key = hash('sha256', $secret_key);
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    //do the encyption given text/string/number
    if( $action == 'encrypt' ) {
        $outputs = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($outputs);
    }
    else if( $action == 'decrypt' ){
    	//decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

function oneDim($result)
{
    if(!empty($result)){
        $conditions = call_user_func_array('array_merge', $result); // remove 0 index->create single dimentional array
    }else{
        $conditions = '';
    }
    return $conditions;
}

function notEmpty($result)
{
    if(!empty($result)){
        return $result;
    }else{
        return '';
    }
}

function lng($msg)
{
    //$tr = new TranslateClient('en', $_SESSION['lng']);
    //return $tr->translate($msg);
    return $msg;
}

function iset($data)
{
    if(isset($data) || !empty($data)){
        echo $data;
    }else{
        echo '';
    }
}

function lnguag($msg)
{
    //$tr = new TranslateClient('en', 'bn');
    //return $tr->translate($msg);
    return $msg;
}

function clean($string) {
   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z\-]/', '', $string); // Removes special chars.
}

//in_array() does not work on multidimensional arrays.
function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}

// BD MONEY FORMATER //

function bd_money($data)
{
    setlocale(LC_MONETARY, 'bn_BD');
    $result = money_format('%.0n', $data);
    return $result;
}