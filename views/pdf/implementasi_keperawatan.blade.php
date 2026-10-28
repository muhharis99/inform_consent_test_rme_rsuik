<?php
define('DOC_REVISI', 'Revisi : 6');
define('DOC_TERBIT', 'Tanggal Terbit : 1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/10.1.1'); 
define('DOC_TITLE', 'IMPLEMENTASI KEPERAWATAN'); 
define('DOC_SUBJECT', 'Implementasi Keperawatan'); 
define('DOC_FILE', 'Implementasi-Keperawatan.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';

$html = '';
$html .= '
  <style type="text/css">
    .bg-burem {
      background-color: #9F9FA0;
   
    }
    .bg0 {
      background-color: #FFFFFF;
    }
    .bg1 {
      background-color: #ECECEC;
    }
    .bg2 {
      background-color: #BEBEBE;
    }
    .bg3 {
      background-color: #9F9FA0;
    }
    .bg4 {
      background-color: #F8B14F;
    }
    .bg5 {
      background-color: #FAD59E;
    }
    .bg-burem td {
 
    }
    .b td {
        font-weight:bold;
    }
    .bg-burem1 {
      background-color: rgb(245, 245, 245);
    }
    .bg-white {
      background-color: #ffffff;
    }
    table {
      width:100%;
      font-size:14px;
    }
    .txr {
      text-align:right;
    }
    .txl {
      text-align:left;
    }
    .txj {
      text-align:justify;
    }
    .txc {
      text-align:center;
    }
    td {
      text-align:left;
      vertical-align:top;
      padding:0 3px 0 3px;
    }
    .b {
      font-weight:bold;
    }
    .ln5 {
      line-height:5px;
    }
    .ln23 {
      line-height:23px;
    }
    .ln14 {
      line-height:14px;
    }
    .ln15 {
      line-height:15px;
    }
    .ln30 {
    }
    .title td {
      line-height:20px;
      font-weight:bold;
    }
    .bdl {
       border-left: 0.5px solid #505050;
    }
    .bdr {
       border-right: 0.5px solid #505050;
    }
    .bdt {
       border-top: 0.5px solid #505050;
    }
    .bdb {
       border-bottom: 0.5px solid #505050;
    }
    .tableinzero table tr td {
      padding:0px;
    }
    .p0 {
      padding:0px;
    }
    .custom-text {
    }
  </style>
'; 
$html .='<br>';
$print_tr = '';
$jml_row_tidakan_mandiri = 40;
for($i=0; $i<$jml_row_tidakan_mandiri; $i++) {
  $tindakan_mandiri .= '
  <tr class="bdl bdr bdt">
      <td class="bdr b ln30"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
    </tr>
 '; 
}
$jml_row_tidakan_kolaborasi = 7;
for($i=0; $i<$jml_row_tidakan_kolaborasi; $i++) {
  $tindakan_kolaborasi .= '
  <tr class="bdl bdr bdt">
      <td class="bdr b ln30"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>

      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
    
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
   
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
     
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
    </tr>
 '; 
}

$html .= '
  <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; ">
  <tbody>
    <tr class="bdl bdr bdt">
    <td class="bdr txc ln30 b custom-text bg-burem" width="200"> TANGGAL </td>
      <td class="bdr txc ln30 b bg-burem" width="" colspan="3"> &nbsp; </td>
      <td class="bdr txc ln30 b bg-burem" width="" colspan="3"> &nbsp; </td>
      <td class="bdr txc ln30 b bg-burem" width="" colspan="3"> &nbsp; </td>
      <td class="bdr txc ln30 b bg-burem" width="" colspan="3"> &nbsp; </td>
      <td class="bdr txc ln30 b bg-burem" width="" colspan="3"> &nbsp; </td>
      <td class="bdr txc ln30 b bg-burem" width="" colspan="3"> &nbsp; </td>
    </tr>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr txc ln30 b custom-text bg-burem"> SHIFT </td>
      <td class="bdr txc ln30 custom-text bg-burem" width="5">P</td>
      <td class="bdr txc ln30 custom-text bg-burem" width="5">S</td>
      <td class="bdr txc ln30 custom-text bg-burem" width="5">M</td>
      
      <td class="bdr txc ln30 custom-text bg-burem" width="5">P</td>
      <td class="bdr txc ln30 custom-text bg-burem" width="5">S</td>
      <td class="bdr txc ln30 custom-text bg-burem" width="5">M</td>
      
      <td class="bdr txc ln30 custom-text bg-burem" width="5">P</td>
      <td class="bdr txc ln30 custom-text bg-burem" width="5">S</td>
      <td class="bdr txc ln30 custom-text bg-burem" width="5">M</td>
      
      <td class="bdr txc ln30 custom-text bg-burem" width="5">P</td>
      <td class="bdr txc ln30 custom-text bg-burem" width="5">S</td>
      <td class="bdr txc ln30 custom-text bg-burem" width="5">M</td>

      <td class="bdr txc ln30 custom-text bg-burem" width="5">P</td>
      <td class="bdr txc ln30 custom-text bg-burem" width="5">S</td>
      <td class="bdr txc ln30 custom-text bg-burem" width="5">M</td>
       
      <td class="bdr txc ln30 custom-text bg-burem" width="5">P</td>
      <td class="bdr txc ln30 custom-text bg-burem" width="5">S</td>
      <td class="bdr txc ln30 custom-text bg-burem" width="5">M</td>
    </tr> 

    <tr class="bdl bdr bdt">
      <td class="bdr b ln30 custom-text bg-burem">&nbsp; Tindakan Mandiri: </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
    </tr>
    '.$tindakan_mandiri.'

    <tr class="bdl bdr bdt">
      <td class="bdr b ln30 custom-text bg-burem">&nbsp; Tindakan Kolaborasi: </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
      <td class="bdr bg-burem"> &nbsp; </td>
    </tr>

    '.$tindakan_kolaborasi.'

    <tr class="bdl bdr bdt">
      <td class="bdr ln30 custom-text bg-burem">&nbsp; Nama </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
    </tr>

    <tr class="bdl bdr bdt bdb">
      <td class="bdr ln30 custom-text bg-burem">&nbsp; Paraf </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
    </tr>
  </tbody>
</table>

  ';

$pdf->WriteHTML($html);


$file = "soap_inap_resume_20220618.pdf";
if($pdf_type == 'F') {
  $ip = getenv('HTTP_CLIENT_IP')?:
  getenv('HTTP_X_FORWARDED_FOR')?:
  getenv('HTTP_X_FORWARDED')?:
  getenv('HTTP_FORWARDED_FOR')?:
  getenv('HTTP_FORWARDED')?:
  getenv('REMOTE_ADDR');
  
  if($ip == '::1') $ip = '127.0.0.1';

  $dir = FCPATH."assets/rme/pdf/$ip/";
  if(file_exists($dir)){
  }else{
      mkdir($dir,0777);
  }
  $file = $dir."soap_inap_resume_20220618.pdf";
}
$pdf->Output($file, $pdf_type);
?>