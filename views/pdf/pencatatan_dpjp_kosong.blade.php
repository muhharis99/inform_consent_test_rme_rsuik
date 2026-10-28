<?php
define('DOC_REVISI', 'Revisi : 2');
define('DOC_TERBIT', 'Tanggal Terbit : 1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/06.2.1'); 
define('DOC_TITLE', 'PENCATATAN DPJP'); 
define('DOC_SUBJECT', 'Pencatatan DPJP'); 
define('DOC_FILE', 'Pencatatan-DPJP.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 8, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';

$html = '';
$html .= '
  <style type="text/css">
    .bg-burem {
      background-color: #bebebe;
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
    }
    .bg-white {
      background-color: #ffffff;
    }
    table {
      width:100%;
      font-size:14px;
      page-break-inside: avoid;
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
      line-height:26.5px;
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
      font-size:15px;
    }
  </style>
';  
$html .='<br>';
$print_tr = '';
// $jml_row = $ranap['nama_dpjputama']??''!='' ? 25 : 30;
// $jml_row = !empty($ranap->nama_dpjputama)&&$ranap->nama_dpjputama!=""?25:35;
$jml_row = 30;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= '
    <tr class="bdl bdr bdt">
      <td class="bdr ln30 custom-text"> &nbsp; </td>
      <td class="bdr custom-text">';
      // if ($i==0 && $ranap['nm_dr_ri1']??''!='') $print_tr.=$ranap['nm_dr_ri1']??'';  
  $print_tr .= ' </td>
      <td class="bdr custom-text">';
      // if ($i==0 && $ranap['tgl_ri']??''!='') $print_tr.=date("d/m/Y", strtotime($ranap['tgl_ri']));  
  $print_tr .= ' &nbsp; </td>
      
      <td class="bdr custom-text"> &nbsp; </td>
      <td class="bdr custom-text"> &nbsp; </td>
      <td class="bdr custom-text"> &nbsp; </td>

      <td class="bdr custom-text"> &nbsp; </td>
    </tr>'; 
}
$html .= '
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tbody>
    <tr class="bdl bdr bdt">
      <th class="bdr ln30 bg-burem custom-text" width="100px" hight="200px" rowspan="2">Diagnosa</th>
      <th class="bdr ln30 bg-burem custom-text" colspan="3">DPJP UTAMA</th>
      <th class="bdr ln30 bg-burem custom-text" colspan="3">DPJP</th>
    </tr>
 
    <tr class="bdl bdr bdt">
      <td class="bdr txc ln30 b bg-burem custom-text" width="200">Nama</td>
      <td class="bdr txc ln30 b bg-burem custom-text" widdth="80">Tgl Mulai</td>
      <td class="bdr txc ln30 b bg-burem custom-text" widdth="80">Tgl Akhir</td>
      
      <td class="bdr txc ln30 b bg-burem custom-text" width="200">Nama</td>
      <td class="bdr txc ln30 b bg-burem custom-text" widdth="80">Tgl Mulai</td>
      <td class="bdr txc ln30 b bg-burem custom-text" widdth="80">Tgl Akhir</td>

    </tr>
    '.$print_tr.'
    <tr class="bdl bdr bdt bdb">
      <td class="bdr ln30"> &nbsp; </td>
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

// $html .='<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
// <tbody>
//   <tr class="">
//     <td class="" width="100px" hight="200px">Revisi: 1</td>
//     <td class="" colspan="2"> &nbsp; </td>
//     <td class="" colspan="3">Tanggal terbit : '.date('d-m-Y').'</td>
//   </tr>
// </tbody>
// </table>';

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