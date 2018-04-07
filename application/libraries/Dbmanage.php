<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dbmanage Library Class
 * 
 * Created By: Rubel
 * Create Date: 28-Mar-18 
 * Example Use
 * 
 * $this->load->library('dbmanage');
 * $this->dbmanage->createTable('id',['name-v','email-v','phone-i','address-t','status-i|0'],'table_name');
*/
class Dbmanage {

    private $ci;

    /**
     * __construct function
     * 
     * @return void
    */

    public function __construct()
    {
        $this->ci =   &get_instance();
        $this->ci->load->database();
    }

    /**
     * createTable function
     * 
     * @access public
     * @param $key
     * @param $filds
     * @param $table
     * @return void
    */

    public function createTable($key,$filds,$table) 
    {
        if ($this->ci->db->table_exists($table) == FALSE) {
            $this->ci->load->dbforge();
            $test = $this->tableFild($key,$filds);            
            $result = $this->ci->dbforge->create_table($table, TRUE);
            return $result;
        } else {
            return FALSE;
        }
        
    }

    /**
     * tableFild function
     * 
     * @access public
     * @param $key
     * @param $fildArray
     * @return void
    */

    public function tableFild($key,$fildArray) 
    {
        $filds[$key] = [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => TRUE
            ];
        foreach($fildArray as $k=>$each) {
            $fild = explode('-',$each);
            // TYPE CONVERT
            if(!empty($fild[1])) {
                $type = $this->getType($fild[0],$fild[1]);
            } else {
                $type = [
                    'type' => 'VARCHAR',
                    'constraint' => '256'
                ];
            }            
            $filds[$fild[0]] = $type;
        }
        $this->ci->dbforge->add_field($filds);
        $this->ci->dbforge->add_key($key, TRUE);
    }

    /**
     * getType function
     * 
     * @access public
     * @param $value
     * @param $type
     * @return array
    */

    public function getType($value,$type) 
    {        
        $ext = explode('|',$type);
        // IF DEFULT VALUE EXITS
        if(isset($ext[1])) {
            $defult = ['default' => $ext[1]];
        } else {
            $defult = [];
        }
        if($ext[0] == 'i') {
            $result = [
                'type' => 'INT',
                'constraint' => '11'                
            ];
            $result = array_merge($result,$defult);
        } elseif($ext[0] == 'v') {
            $result = [
                'type' => 'VARCHAR',
                'constraint' => '256'
            ];
            $result = array_merge($result,$defult);
        } elseif($ext[0] == 't') {
            $result = [
                'type' => 'TEXT'
            ];
            $result = array_merge($result,$defult);
        }

        return $result;
    }

    /**
     * createRow function
     * 
     * @access public
     * @param $colmun
     * @param $value
     * @param $table
     * @return void
    */

    public function createRow($colmun,$value,$table) 
    {
        $exist = $this->ci->db->get_where($table, [$colmun=>$value])->num_rows();
        if ($exist < 1) {
            $this->ci->db->insert($table,[$colmun=>$value]);          
        }
    }

}