<?php
// $no_reg = '0000000'; 
// $nama = 'MR X'; 
// $registered = date("Y-m-d H:i:s");
// $alamat = 'KRESAN 01/06 WARU BAKI, SUKOHARJO'; 


define('DOC_REVISI', '');
define('DOC_TERBIT', '');
define('DOC_NOMER', ''); 
define('DOC_FILE', 'Pemesanan-prosthesa-gigi.pdf'); 
define('DOC_TITLE', 'BUKTI PEMESANAN PROSTHESA GIGI'); 
define('DOC_SUBJECT', 'Pemesanan Prosthesa'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
// $pdf = new mPDF('', [210, 148.5], 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';
$html = '';

// define('DOC_REVISI', '7');
// define('DOC_TERBIT', '1 Agustus 2022');
// define('DOC_NOMER', 'FM/RM/22'); 
// require_once dirname(__FILE__) . '/mpdf/mpdf.php';
// $pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
// $pdf->SetTitle('FM/RM/22 - '.$no_reg);
// $pdf->SetSubject('Formulir Pendaftaran Pasien Baru');
// $pdf->SetKeywords('RS Islam Klaten, Formulir Pendaftaran Pasien Baru');
// $pdf->SetHTMLHeader('
//   <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
//     <tbody>
//       <tr>
//         <td align="left" width="300">RSU ISLAM KLATEN</td>
//         <td align="right" width="300" style="text-align:right;"> <b>'.DOC_NOMER.'</b></td>
//         <td align="right"  style="">Hal {PAGENO}/ {nbpg}</td>
//       </tr>
//     </tbody>
//   </table>
//   <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
//     <tbody>
//       <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
//       <tr>
//         <td class="txr" rowspan="5" width="75" bgcolor="" style=""></td>
//         <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>PERSETUJUAN TINDAKAN <br />KEDOKTERAN</b></td>
//         <td class="" rowspan="5" width="5"></td><td width="70">NO.RM</td><td width="10">:</td><td width="250">'.(!empty($no_reg)?$no_reg:'').'</td>
//       </tr>
//       <tr><td>NAMA</td><td>:</td><td>'.(!empty($nama)?$nama:'').'</td></tr>
//       <tr><td>NIK</td><td>:</td><td>'.(!empty($nik)?$nik:'').'</td></tr>
//       <tr><td>TGL LAHIR</td><td>:</td><td>'.((!empty($tgl_lahir) && $tgl_lahir != '') ? date("d-m-Y", strtotime($tgl_lahir)).($umur!=''?' ( '.$umur.' )':'') : '').'</td></tr>
//       <tr><td valign="top">ALAMAT <br />&nbsp;</td><td valign="top">:</td><td>'.(!empty($alamat)?$alamat:'<br /> &nbsp; ').'</td></tr>
//       <tr><td colspan="6" style="line-height:3px; border-bottom:1px solid black;"> &nbsp; </td></tr>
//     </tbody>
//   </table>

// ');
// $pdf->SetHTMLFooter('
//   <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: '.DOC_REVISI.'</td><td align="right">Tanggal Terbit : '.DOC_TERBIT.'</td></tr></tbody></table>
// ');
// $pdf->SetFont('calibri', 13);
// $html = '';
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
      font-size:14px;
    }
    .ln23 {
      line-height:23px;
    }
    .ln24 {
      line-height:24px;
    }
    .ln25 {
      line-height:20px;
    }
    .ln30 {
      line-height:30px;
      font-size:14px;
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
      font-size:14px;
    }

  </style>
'; 
// $html .='<br>';
// $print_tr = '';
$jml_row_spasi = 20;
for($i=0; $i<$jml_row_spasi; $i++) {
  $spasi .= '&nbsp;'; 
}

$html .= '<br>
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="">
      <td class="ln20 custom-text">&nbsp;Yang bertanda tangan di bawah ini :</td>
  </tr>
</table>
';


$html .='
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="">
      <td class="ln20 custom-text" width="190px">&nbsp; No. RM </td>
      <td class="ln20 custom-text" width="2px"> : </td>
      <td class="ln20 custom-text" colspan="3"> '.(!empty($nama)?$no_reg:'__________________________________').' </td>
  </tr>
    <tr class="">
      <td class="ln20 custom-text">&nbsp; Nama </td>
      <td class="ln20 custom-text" width="2px"> : </td>
      <td class="ln20 custom-text" colspan="3"> '.(!empty($nama)?$nama:'__________________________________').' </td>
  </tr>
  <tr class="">
      <td class="ln20 custom-text">&nbsp; NIK </td>
      <td class="ln20 custom-text" width="2px"> : </td>
      <td class="ln20 custom-text" colspan="3"> '.(!empty($nik)?$nik:'__________________________________').' </td>
  </tr>
  <tr class="">
      <td class="ln20 custom-text">&nbsp; Tanggal Lahir / Umur </td>
      <td class="ln20 custom-text" width="2px"> : </td>
      <td class="ln20 custom-text" colspan="2" colspan="3"> '.((!empty($tgl_lahir) && $tgl_lahir != '') ? date("d-m-Y", strtotime($tgl_lahir)).($umur!=''?' ( '.$umur.' )':'') : '__________________________________').' </td>
  </tr>
  <tr class="">
      <td class="ln20 custom-text">&nbsp; Alamat </td>
      <td class="ln20 custom-text" width="2px"> : </td>
      <td class="ln20 custom-text" colspan="2" colspan="3"> '.(!empty($alamat)?$alamat:'__________________________________').'</td>
  </tr>
</table>
';
$html .= '<br>
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="">
      <td class="ln20 custom-text">&nbsp;Dengan ini menyatakan Pemesanan <b>Prosthesa Gigi</b></td>
  </tr>
  <tr class="">
      <td class="ln20 custom-text">&nbsp;Dengan melakukan pembayaran awal sejumlah Rp  ____________________________ </td>
  </tr>
  <tr class="">
      <td class="ln20 custom-text">&nbsp;Total biaya yang diperkirakan sebesar Rp ____________________________ </td>
  </tr>
  <tr class="">
      <td class="ln20 custom-text">&nbsp;<b>DP minimal 30%</b></td>
  </tr>
</table>
';
$html .= '<br>
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="">
    <td>&nbsp; </td>
    <td class="custom-text txc" width="320">&nbsp; Klaten: '.($tgl_masuk!=''?(date('d-m-Y', strtotime($tgl_masuk)).''):'___/___/______ Pukul : ___:___ WIB ').' </td>
  </tr>
</table>
';
$html .= ' 
<table cellspacing="0" border="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="">
    <td class="txc ln20 custom-text"> Pasien / Pemesan <br><br><br>____________________________ <br>Tanda tangan dan nama terang</td>
    <td class="txc ln20 custom-text"> Perawat Poli Gigi <br><br><br>____________________________ <br>Tanda tangan dan nama terang</td>
  </tr>
</table>
';

$html .='

';
$html .='

';
$html .='

';
$html .='

';
$html .='

';
$html .='

';
$html .='

';
$html .='

';
$html .='

';
$html .='

';
$html .='
';
$html .='
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