<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
use Dompdf\Dompdf;
function pdf_create($html, $filename='', $stream=TRUE) 
{

    $dompdf = new Dompdf();
    $dompdf->load_html($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename);
    } else {
        return $dompdf->output();
    }
}
?>