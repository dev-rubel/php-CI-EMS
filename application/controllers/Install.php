<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *	@author 	: Nihal-IT Team
 *	date		: 1 October, 2016
 *	Bidyapith School Management System
 *	https://www.nihalit.com
 *	info@nihalit.com
 */

class Install extends CI_Controller
{
    
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        $this->load->view('backend/install');
    }
    
    
    
}
