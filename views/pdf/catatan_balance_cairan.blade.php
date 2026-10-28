<?php
// $no_reg = '0000000'; 
// $nama = 'MR X'; 
// $registered = date("Y-m-d H:i:s");
// $alamat = 'KRESAN 01/06 WARU BAKI, SUKOHARJO'; 
define('DOC_REVISI', 'Revisi : 2');
define('DOC_TERBIT', 'Tanggal Terbit : 23 Juni 2022');
define('DOC_NOMER', 'FM/RM/11'); 
define('DOC_TITLE', 'CATATAN<br>BALANCE CAIRAN'); 
define('DOC_SUBJECT', 'Catatan Balance Cairan'); 
define('DOC_FILE', 'Catatan-Balance-Cairan.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 5, 2, 1, 6, 'L');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';
$pdf->AddPage('L');
$pdf->SetTitle('FM/RM/11 - '.$no_reg);
$pdf->SetSubject('CATATAN BALANCE CAIRAN');
$pdf->SetKeywords('RS Islam Klaten, CATATAN BALANCE CAIRAN');
$pdf->SetHTMLHeader('

');
$pdf->SetHTMLFooter('
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: 2</td><td width="" align="right">Tanggal Terbit : 23 Juni 2022</td></tr></tbody></table>
');
$pdf->SetFont('calibri', 13);
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
      font-size:14px;
    }
  
    .ln21 {
      line-height:21px;
    }
    
    .ln24 {
      line-height:24px;
    }
   
   
    .ln25 {
      line-height:25px;
      font-size :14px;
    }
    .ln26 {
      line-height:26px;
      font-size :14px;
    }
    .ln27 {
      line-height:27px;
    }
    .ln28 {
      line-height:28px;
    }
    .ln29 {
      line-height:29px;
    }
    .ln30 {
      line-height:30px;
      font-size:14px;
    }
    .ln33 {
      line-height:33px;
    }
    .ln50 {
      line-height:50px;
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
    .sc14 {
      font-size :14px;
    }
    .sc2 {
      font-size :13px;
    }
    .text2 {
     writing-mode: vertical-lr;
    }
    .custom-text {
      font-size :14px;
    }
    .bg-m {
      background-color:#559E55;
    }
    .bg-k {
      background-color:#FCD299;
    }

  </style>
'; 
$html .='<br>';
$print_tr = '';
$jml_row = 30;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= ''; 
}

if (!empty($tgl_lahir)) {
  $str_tgl_lahir = date("d-m-Y", strtotime($tgl_lahir)).($umur!=''?' ( '.$umur.' )':'');
  if (!empty($warning_sama)) {
    // if ($no_reg=='0620128') {

      $no_reg = '<table cellpadding="0" cellspacing="0" border="0" style="margin:0 -3px; padding-bottom:-2px; line-height:12px;"><tr><td width="76" style="background-color:#F7C815; border:1px solid #F7C000;">'.$no_reg.'</td><td> &nbsp; </td></tr></table>';
      $str_tgl_lahir = date("d-m-Y", strtotime($tgl_lahir));
      $str_tgl_lahir = '<table cellpadding="0" cellspacing="0" border="0" style="margin:0 -3px; padding-bottom:-2px; line-height:12px;"><tr><td width="76" style="background-color:#F7C815; border:1px solid #F7C000;">'.$str_tgl_lahir.'</td><td>'.($umur!=''?' ( '.$umur.' )':'').'</td></tr></table>';
    // }
  }
}
// $html .= '
//   <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
//     <tbody>
//       <tr>
//         <td align="left" width="300">RSU ISLAM KLATEN</td>
//         <td align="right" width="300" style="text-align:right;"> &nbsp;</td>
//         <td align="right"  style=""><b>FM/RM/11</b></td>
//       </tr>
//     </tbody>
//   </table>
//   <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
//     <tbody>
//       <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
//       <tr>
//         <td class="txr" rowspan="5" width="75" bgcolor="" style=""> </td>
//         <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:18px; line-height:18px; " ><b>CATATAN<br>BALANCE CAIRAN</b></td>
//         <td class="" rowspan="5" width="5"></td><td width="70">NO.RM</td><td width="10">:</td><td width="250">'.(!empty($nama)?$no_reg:'').'</td>
//       </tr>
//       <tr><td>NAMA</td><td>:</td><td>'.(!empty($nama)?$nama:'').'</td></tr>
//       <tr><td>NIK</td><td>:</td><td>'.(!empty($nik)?$nik:'').'</td></tr>
//       <tr><td>TGL LAHIR</td><td>:</td><td>'.((!empty($tgl_lahir) && $tgl_lahir != '') ? $str_tgl_lahir : '').'</td></tr>
//       <tr><td valign="top">ALAMAT <br />&nbsp; </td><td valign="top">:</td><td>'.(!empty($alamat)?$alamat:'<br /> &nbsp; ').'</td></tr>
//       <tr><td colspan="6" style="line-height:3px; border-bottom:1px solid black;"> &nbsp; </td></tr>
//     </tbody>
//   </table>
//   ';
$html .='<br>
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="">
      <td class="ln30"> BB : ________ Kg</td>
  </tr>
</table>
';
$html .='
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="bdl bdr bdt">
      <th class="bdr bg-burem" width="30px" rowspan="3" width="30px"> Jam </th>
      <th class="bdr bg-burem" rowspan="3" width="90px"> Kesadaran </th>
      <th class="bdr bg-burem" colspan="3" rowspan="2" width="100px"> GCS </th>
      <th class="bdr bg-burem" colspan="11" width="550px"> KESEIMBANGAN CAIRAN</th>
      <th class="bdr txc bg-burem" rowspan="3"> PENGOBATAN/<br>CATATAN KHUSUS</th>
      <th class="bdr bg-burem" rowspan="3" colspan="3" width="120px"> KESEIMBANGAN<br>CAIRAN/SHIF </th>
  </tr>
    <tr class="bdl bdr bdt bg-burem b">
      <td class="bdr txc" colspan="4"> MASUK </td>
      <td class="bdr txc" colspan="7"> KELUAR </td>
  </tr>
    <tr class="bdl bdr bdt bg-burem b">
      <td class="bdr txc"> E </td>
      <td class="bdr txc"> V </td>
      <td class="bdr txc"> M </td>
      <td class="bdr txc"> Infus </td>
      <td class="bdr txc"> Injeksi </td>
      <td class="bdr txc"> Oral </td>
      <td class="bdr txc"> Metab </td>
      <td class="bdr txc"> NGT </td>
      <td class="bdr txc"> Muntah </td>
      <td class="bdr txc"> Perdrh </td>
      <td class="bdr txc"> Urine </td>
      <td class="bdr txc"> Feces </td>
      <td class="bdr txc"> Drain </td>
      <td class="bdr txc"> IWL </td>
  </tr>
   <tr class="bdl bdr  bg-burem1">
      <td class="bdr ln19"> &nbsp; </td>
      <td class="bdr"> &nbsp;  </td>
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
      <td class="bdr custom-text bg-burem1" colspan="3" rowspan="5"> 
        <table border="0" cellpadding="0" cellspacing="0">
          <tr><td colspan="3">PAGI</td></tr>
          <tr><td width="30">Masuk</td><td width="5">:</td><td>_____ cc</td></tr>
          <tr><td>(+metab)</td><td>:</td><td>_____ </td></tr>
          <tr><td>Keluar</td><td>:</td><td>_____ </td></tr>
          <tr><td>IWL</td><td>:</td><td>_____ </td></tr>
        </table>
      </td>
  </tr>
    <tr class="bdl bdr bdt bg-burem1">
      <td class="bdr ln19"> 7:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
   <tr class="bdl bdr bdt bg-burem1">
      <td class="bdr ln19"> 8:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt bg-burem1">
      <td class="bdr ln19"> 9:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt bg-burem1">
      <td class="bdr ln19"> 10:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt">
      <td class="bdr ln19"> 11:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr custom-text" colspan="3" rowspan="6">
        <table border="0" cellpadding="0" cellspacing="0">
          <tr><td colspan="3">SIANG</td></tr>
          <tr><td width="30">Masuk</td><td width="5">:</td><td>_____ cc</td></tr>
          <tr><td>(+metab)</td><td>:</td><td>_____ </td></tr>
          <tr><td>Keluar</td><td>:</td><td>_____ </td></tr>
          <tr><td>IWL</td><td>:</td><td>_____ </td></tr>
        </table>
      </td>
  </tr>
  <tr class="bdl bdr bdt">
      <td class="bdr ln19"> 12:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt">
      <td class="bdr ln19"> 13:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt">
      <td class="bdr ln19"> 14:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt">
      <td class="bdr ln19"> 15:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt">
      <td class="bdr ln19"> 16:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt bg-burem1">
      <td class="bdr ln19"> 17:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr custom-text bg-burem1" colspan="3" rowspan="6">
        <table border="0" cellpadding="0" cellspacing="0">
          <tr><td colspan="3">MALAM</td></tr>
          <tr><td width="30">Masuk</td><td width="5">:</td><td>_____ cc</td></tr>
          <tr><td>(+metab)</td><td>:</td><td>_____ </td></tr>
          <tr><td>Keluar</td><td>:</td><td>_____ </td></tr>
          <tr><td>IWL</td><td>:</td><td>_____ </td></tr>
        </table>
      </td>
  </tr>
  <tr class="bdl bdr bdt bg-burem1">
      <td class="bdr ln19"> 18:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt bg-burem1">
      <td class="bdr ln19"> 19:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt bg-burem1">
      <td class="bdr ln19"> 20:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt bg-burem1">
      <td class="bdr ln19"> 21:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt bg-burem1">
      <td class="bdr ln19"> 22:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt">
      <td class="bdr ln19"> 23:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr custom-text" colspan="3" rowspan="6">
        <table border="0" cellpadding="0" cellspacing="0">
          <tr><td colspan="3">KOMULATIF</td></tr>
          <tr><td width="30">Masuk</td><td width="5">:</td><td>_____ cc</td></tr>
          <tr><td>(+metab)</td><td>:</td><td>_____ </td></tr>
          <tr><td>Keluar</td><td>:</td><td>_____ </td></tr>
          <tr><td>IWL</td><td>:</td><td>_____ </td></tr>
        </table>
      </td>
  </tr>
  <tr class="bdl bdr bdt">
      <td class="bdr ln19"> 24:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt">
      <td class="bdr ln19"> 01:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt">
      <td class="bdr ln19"> 02:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt">
      <td class="bdr ln19"> 03:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt">
      <td class="bdr ln19"> 04:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt bdb bg-burem1">
      <td class="bdr ln19"> 05:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr custom-text bg-burem1" rowspan="2" colspan="3" align="right"> cc/j &nbsp;</td>
  </tr>
  <tr class="bdl bdr bdb bg-burem1">
      <td class="bdr ln19"> 06:00 </td>
      <td class="bdr"> &nbsp;  </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-m"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr bg-k"> &nbsp; </td>
      <td class="bdr"> &nbsp; </td>
  </tr>
</table>
  ';

$html .='

';
// $html .= ' 
// <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
//   <tr class="bdl bdr bdt bdb">
//       <td class="bdr" text-rotate="90" width="5px" rowspan="7"> RISIKO RENDAH (RR) </td>
//       <td class="bdr"> 1 </td>
//       <td class="bdr" colspan="2" width="300px"> Orientasi Lingkungan </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//   </tr>
//     <tr class="bdl bdr bdt bdb">
//       <td class="bdr"> 2 </td>
//       <td class="bdr" colspan="2"> Pastikan Bel mudah dijangkau </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr" width="39px"> &nbsp; </td>
//   </tr>
//   <tr class="bdl bdr bdt bdb">
//       <td class="bdr"> 2 </td>
//       <td class="bdr" colspan="2"> Pastikan Bel mudah dijangkau </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//   </tr>
// </table>
// ';
$html .= ' 

';
// $html .= ' 

// ';
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