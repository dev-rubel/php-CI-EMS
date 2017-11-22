<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
include_once APPPATH.'/third_party/mpdf/mpdf.php';
 
class M_pdf {
 
    public $pdf;
 
    public function __construct()
    {
        $this->pdf = new mPDF('','A4',14,'nikosh');
    }
}
