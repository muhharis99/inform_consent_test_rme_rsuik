<?php
define('DOC_REVISI', 'Revisi : 9');
define('DOC_TERBIT', 'Tanggal Terbit : 20 Agustus 2022');
define('DOC_NOMER', 'FM/RM/10.1.2'); 
define('DOC_TITLE', 'EVALUASI PERKEMBANGAN PASIEN'); 
define('DOC_SUBJECT', 'Evaluasi Perkembangan Pasien'); 
define('DOC_FILE', 'Evaluasi-Perkembangan-Pasien.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 8, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';

$html = '';
$html .= '
  <style type="text/css">
    .bg-burem {
      background-color: #9F9FA0;
      line-height:20px;
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
      line-height:20px;
    }
    .b td {
        font-weight:bold;
    }
    .bg-burem1 {
      background-color: rgb(245, 245, 245);
      line-height:20px;
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
  </style>
'; 
$html .='<br>';
$print_tr = '';
$jml_row_tidakan_mandiri = 36;
for($i=0; $i<$jml_row_tidakan_mandiri; $i++) {
  $tindakan_mandiri .= '
  <tr class="bdl bdr bdt bdb">
      <td class="bdr ln23"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      
    </tr>
 '; 
}

$html .= '
  <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; font-size:15px;">
  <tbody>
    <tr class="bdl bdr bdt b">
      <td class="bdr txc bg-burem" width="60px"> Tanggal </td>
      <td class="bdr txc bg-burem" width="60px"> NO DX </td>
      <td class="bdr txc bg-burem" width="500px"> EVALUASI </td>
      <td class="bdr txc bg-burem"> Nama </td>
    </tr>
   
    <tr class="bdl bdr">
      <td class="bdr ln23"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
    </tr>
    '.$tindakan_mandiri.'
    <tr class="bdl bdr bdb">
      <td class="bdr ln23"> &nbsp; </td>
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