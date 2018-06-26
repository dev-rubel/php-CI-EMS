<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nihal-IT Team
 *	date		: 1 October, 2016
 *	Bidyapith School Management System
 *	https://www.nihalit.com
 *	info@nihalit.com
 */

class Studentmenu extends CI_Controller
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
    }

    /**
     * ajax_home_menu_pages function
     * 
     * @return pageview
     */
    



    /* 
    */
    /* =========== END GALLERY PAGE SECTION ============ */
}