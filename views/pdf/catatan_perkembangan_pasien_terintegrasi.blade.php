<?php

define('DOC_REVISI', 'Revisi : 4');
define('DOC_TERBIT', 'Tanggal Terbit : 1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/06.2'); 
define('DOC_TITLE', 'CATATAN PERKEMBANGAN PASIEN TERINTEGRASI'); 
define('DOC_SUBJECT', 'Catatan Perkembangan Pasien Terintegrasi'); 
define('DOC_FILE', 'Catatan-Perkembangan-Pasien-Terintegrasi.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 8, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';
/*
define('DOC_REVISI', '4');
define('DOC_TERBIT', '1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/06.2'); 
define('DOC_FILE', 'Catatan-Perkembangan-Pasien-Terintegrasi.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 14, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
$pdf->SetTitle(DOC_NOMER.' - '.$no_reg);
$pdf->SetSubject('Catatan Perkembangan Pasien Terintegrasi');
$pdf->SetKeywords('RS Islam Klaten, Catatan Perkembangan Pasien Terintegrasi');
$pdf->SetHTMLHeader('
  <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
    <tbody>
      <tr>
        <td align="left" width="300">RSU ISLAM KLATEN</td>
        <td align="right" width="300" style="text-align:right;"> <b>'.DOC_NOMER.'</b></td>
        <td align="right"  style="">Hal {PAGENO}/ {nbpg}</td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
    <tbody>
      <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
      <tr>
        <td class="txr" rowspan="5" width="75" bgcolor="" style=""> </td>
        <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>CATATAN PERKEMBANGAN PASIEN TERINTEGRASI</b></td>
        <td class="" rowspan="5" width="5"></td><td width="70">NO.RM</td><td width="10">:</td><td width="250">'.(!empty($nama)?$no_reg:'').'</td>
      </tr>
      <tr><td>NAMA</td><td>:</td><td>'.(!empty($nama)?$nama:'').'</td></tr>
      <tr><td>NIK</td><td>:</td><td>'.(!empty($nik)?$nik:'').'</td></tr>
      <tr><td>TGL LAHIR</td><td>:</td><td>'.((!empty($tgl_lahir) && $tgl_lahir != '') ? date("d-m-Y", strtotime($tgl_lahir)).($umur!=''?' ( '.$umur.' )':'') : '').'</td></tr>
      <tr><td valign="top">ALAMAT <br />&nbsp; </td><td valign="top">:</td><td>'.(!empty($alamat)?$alamat:'<br /> &nbsp; ').'</td></tr>
      <tr><td colspan="6" style="line-height:3px; border-bottom:1px solid black;"> &nbsp; </td></tr>
    </tbody>
  </table>
');
$pdf->SetHTMLFooter('
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: 5</td><td width="" align="right">Tanggal Terbit : 1 Agustus 2022</td></tr></tbody></table>
');
$pdf->shrink_tables_to_fit=0;
$pdf->SetFont('calibri', 13);
*/
$html = '';
$html .= '
  <style type="text/css">
    .bg-burem {
      background-color: #bebebe;
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
    .ln1 {
      line-height:1px;
    }
    .ln2 {
      line-height:2px;
    }
    .ln3 {
      line-height:9px;
    }
    .ln4 {
      line-height:4px;
    }
    .ln5 {
      line-height:5px;
    }
    .ln6 {
      line-height:6px;
    }
    .ln7 {
      line-height:7px;
    }
    .ln8 {
      line-height:8px;
    }
    .ln9 {
      line-height:9px;
    }
    .ln10 {
      line-height:10px;
    }
    .ln11 {
      line-height:11px;
    }
    .ln12 {
      line-height:12px;
    }
    .ln13 {
      line-height:13px;
    }
    .ln14 {
      line-height:14px;
    }
    .ln15 {
      line-height:15px;
    }
    .ln16 {
      line-height:16px;
    }
    .ln17 {
      line-height:17px;
    }
    .ln18 {
      line-height:18px;
    }
    .ln19 {
      line-height:19px;
    }
    .ln20 {
      line-height:20px;
    }
    .ln21 {
      line-height:21px;
    }
    .ln22 {
      line-height:22px;
    }
    .ln23 {
      line-height:23px;
    }
    .ln30 {
      line-height:30px;
    }
    .ln33 {
      line-height:33px;
    }
    .ln50 {
      line-height:50px;
    } 
    .ln60 {
      line-height:60px;
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
    .vac {
      vertical-align:middle;
    }
    .custom-text {
      font-size:14px;
    }
  </style>
'; 
$html .='<br>';
$print_tr = '';
$jml_row = 26;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= '<br>
    '; 
}
$html .= '
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; font-size:12px;">
  <tbody>
    <tr class="bdl bdr bdt">
      <td class="bdr b custom-text bg-burem" width="50" align="center">TANGGAL <br />& JAM</td>
      <td class="bdr txc custom-text bg-burem" width="80"><b>PPA</b><br>(Profesional Pemberi Asuhan)</td>
      <td class="bdr txc custom-text bg-burem" width="280"><b>HASIL ASESMEN PASIEN DAN PEMBERIAN PELAYANAN</b><br>(Tulis dengan format SOAP / ADIME, disertai Sasaran)</td>
      <td class="bdr txc custom-text bg-burem"><b>INSTRUKSI PPA TERMASUK PASCA BEDAH</b><br>(Instruksi ditulis dengan rinci dan jelas. Tulis Nama, beri Paraf pada akhir catatan)</th>
      <td class="bdr txc custom-text bg-burem" width="120"><b>REVIEW & VERIFIKASI DPJP</b><br>(Tulis Nama, beri Paraf, Tgl, Jam) DPJP harus membaca / mereview seluruh rencana asuhan.</td>
    </tr>
    <tr class="bdl bdr bdb">
      <td class="bdr ln30">'.$print_tr.'</td>
      <td class="bdr">&nbsp;</td>
      <td class="bdr">&nbsp;</td>
      <td class="bdr">&nbsp;</th>
      <td class="bdr">&nbsp;</td>
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

$file = DOC_FILE;
if($pdf_type == 'F') {
  $ip = getenv('HTTP_CLIENT_IP')?:
  getenv('HTTP_X_FORWARDED_FOR')?:
  getenv('HTTP_X_FORWARDED')?:
  getenv('HTTP_FORWARDED_FOR')?:
  getenv('HTTP_FORWARDED')?:
  getenv('REMOTE_ADDR');
  
  if($ip == '::1') $ip = '127.0.0.1';
  if($ipclient != '') { $ip = $ipclient; }

  $dir = FCPATH."assets/rme/pdf/$ip/";
  if(file_exists($dir)){
  }else{
      mkdir($dir,0777);
  }
  $file = $dir.DOC_FILE;
  $pdf->Output($file, $pdf_type);
  
  if (!empty($lp_print)) {
    if ($printer != "") {
      $cmd = "lp $file -d $printer";
      shell_exec($cmd);
    }
    $data=array(
      "status" => true, 
      "pdf" => $file, 
      "printer" => $printer
    );
    echo json_encode($data); 
  }  else {
    $data=array(
      "status" => true, 
      "pdf" => $file
    );
    echo json_encode($data); 
  }
} else {
  $pdf->Output($file, $pdf_type);
}
?>