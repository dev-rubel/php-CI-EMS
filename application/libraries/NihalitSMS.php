<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NihalitSMS Library Class
 * 
 * Created By: Rubel
 * Create Date: 28-Mar-18 
*/
class NihalitSMS {

    private $ci;
    private $user;
    private $pass;
    private $sender;

    /**
     * __construct function
     * 
     * @return void
    */

    public function __construct()
    {
        $this->ci =   &get_instance();
        $this->user = $this->ci->db->get_where('settings',array('type'=>'nihalit_sms_user'))->row()->description;
        $this->pass = $this->ci->db->get_where('settings',array('type'=>'nihalit_sms_password'))->row()->description;
        $this->sender = $this->ci->db->get_where('settings',['type'=>'system_title_english'])->row()->description;
        $this->sender = urlencode($this->sender);
    }

    /**
     * sms_user_info function
     * 
     * @access public
     * @return array
    */

    public function sms_user_info() 
    {
        $data['user'] = $this->ci->db->get_where('settings',array('type'=>'nihalit_sms_user'))->row()->description;
        $data['pass'] = $this->ci->db->get_where('settings',array('type'=>'nihalit_sms_password'))->row()->description;
        $data['sender'] = $this->ci->db->get_where('settings',['type'=>'system_title_english'])->row()->description;
        return $data;
    }

    /**
     * sms_api function
     * 
     * @access public
     * @param $msg
     * @param $mobile
     * @return void
    */

    public function sms_api($msg,$mobile)
    {
        $msg = urlencode($msg);
        $url = "http://api.zaman-it.com/api/sendsms/plain?user=$this->user&password=$this->pass&sender=$this->sender&SMSText=$msg&GSM=88$mobile";
        $mystring = $this->curl_url($url);
        return $mystring;
    }

    /**
     * long_sms_api function
     * 
     * @access public
     * @param $msg
     * @param $mobile
     * @return void
    */
    
    public function long_sms_api($msg,$mobile)
    {
        $msg = urlencode($msg);
        $url = "http://api.zaman-it.com/api/sendsms/plain?user=$this->user&password=$this->pass&sender=$this->sender&SMSText=$msg&GSM=88$mobile&type=longSMS";
        $mystring = $this->curl_url($url);
        return $mystring;
    }

    /**
     * unicode_long_sms_api function
     * 
     * @access public
     * @param $msg
     * @param $mobile
     * @return void
    */    

    public function unicode_long_sms_api($msg,$mobile)
    {
        $msg = urlencode($msg);
        $url = "http://api.zaman-it.com/api/sendsms/plain?user=$this->user&password=$this->pass&sender=$this->sender&SMSText=$msg&GSM=88$mobile&datacoding=8&type=longSMS";
        $mystring = $this->curl_url($url);
        return $mystring;
    }

    /**
     * sms_balance function
     * 
     * @access public
     * @return void
    */   

    public function sms_balance()
    {
        $url = "http://api.zaman-it.com/api/command?username=$this->user&password=$this->pass&cmd=Credits";
        $mystring = $this->get_data($url);
        return $mystring;
    }

    /**
     * curl_url function
     * 
     * @access public
     * @param $url
     * @return boolean
    */

    function curl_url($url)
    {       
        $data = file_get_contents($url);
        if($data) {
            return true;
        }
        return true;
    }

    /**
     * get_data function
     * 
     * @access public
     * @param $url
     * @return array
    */

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


}