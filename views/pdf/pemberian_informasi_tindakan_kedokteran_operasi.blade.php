<?php
define('DOC_REVISI', 'Revisi : 6');
define('DOC_TERBIT', 'Tanggal Terbit : 1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/21'); 
define('DOC_FILE', 'Pemberian-Informasi-Tindakan-Kedokteran-Operasi.pdf'); 
define('DOC_TITLE', 'PEMBERIAN INFORMASI TINDAKAN KEDOKTERAN/OPERASI'); 
define('DOC_SUBJECT', 'Pemberian Informasi Tindakan Kedokteran/Operasi'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php'; 
$html = '';



// define('DOC_REVISI', 'Revisi : 6');
// define('DOC_TERBIT', 'Tanggal Terbit : 01 Agustus 2022');
// define('DOC_NOMER', 'FM/RM/21'); 
// define('DOC_FILE', 'Pemberian-Informasi-Tindakan-Kedokteran-Operasi.pdf'); 
// require_once dirname(__FILE__) . '/mpdf/mpdf.php';
// $pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
// $pdf->SetTitle(DOC_NOMER.' - '.$no_reg);
// $pdf->SetSubject('PEMBERIAN INFORMASI TINDAKAN KEDOKTERAN/OPERASI');
// $pdf->SetKeywords('RS Islam Klaten, PEMBERIAN INFORMASI TINDAKAN KEDOKTERAN/OPERASI');
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
//         <td class="txr" rowspan="5" width="75" bgcolor="" style=""> </td>
//         <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>PEMBERIAN INFORMASI TINDAKAN<br>KEDOKTERAN/OPERASI *)</b></td>
//         <td class="" rowspan="5" width="5"></td><td width="70">NO.RM</td><td width="10">:</td><td width="250">'.(!empty($no_reg)?$no_reg:'').'</td>
//       </tr>
//       <tr><td>NAMA</td><td>:</td><td>'.(!empty($nama)?$nama:'').'</td></tr>
//       <tr><td>NIK</td><td>:</td><td>'.(!empty($nik)?$nik:'').'</td></tr>
//       <tr><td>TGL LAHIR</td><td>:</td><td>'.((!empty($tgl_lahir) && $tgl_lahir != '') ? date("d-m-Y", strtotime($tgl_lahir)).($umur!=''?' ( '.$umur.' )':'') : '').'</td></tr>
//       <tr><td valign="top">ALAMAT <br />&nbsp; </td><td valign="top">:</td><td>'.(!empty($alamat)?substr($alamat, 0, 65):'<br /> &nbsp; ').'</td></tr>
//       <tr><td colspan="6" style="line-height:3px; border-bottom:1px solid black;"> &nbsp; </td></tr>
//     </tbody>
//   </table>
// ');
// $pdf->SetHTMLFooter('
//   <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">'.DOC_REVISI.'</td><td width="" align="right">'.DOC_TERBIT.'</td></tr></tbody></table>
// ');
// $pdf->SetFont('calibri', 13);
// $html = '';
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
  .bdl {
     border-left: 1px solid black;
  }
  .bdr {
     border-right: 1px solid black;
  }
  .bdt {
     border-top: 1px solid black;
  }
  .bdb {
     border-bottom: 1px solid black;
  }
  .tableinzero table tr td {
    padding:0px;
  }
  .p0 {
    padding:0px;
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
  .ln24 {
    line-height:24px;
  }
  .ln25 {
    line-height:20px;
  }
  .ln26 {
    line-height:26px;
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
  .size-custom {
    font-size :14px;
  }
  .size-custom2 {
    font-size :16px;
  }
  table {
      overflow: wrap;
  }
  .checked {
    margin-right:20px;
    background-image:url(\''.IMG.'banner/square_check.png\'); background-image-resize:2; background-repeat:no-repeat; background-size:100px 100px; background-position:top left;
  }

  </style>
'; 
$html .='';
$jml_row = 10;
for($i=0; $i<$jml_row; $i++) {
  $br_sticker.= '<br>'; 
}
$html .= '
<table cellspacing="0" cellpadding="0" width="100%" class="bg0" style="border-collapse: collapse;">
  <!--
  <tr class="">
    <td class="" width="180">Tanggal </td>
    <td class="" width="10">: </td>
    <td class="" width="200"></td>
    <td class="" width="70">Pukul </td>
    <td class="" width="10">:</td>
    <td class=""></td>
  </tr>
  -->
  <tr class="">
    <td class="" width="180"> Dokter pelaksana </td>
    <td class="" width="10">:</td>
    <td class="" colspan="4"> </td>
  </tr>
  <tr class="">
    <td class=""> Pemberi Informasi </td>
    <td class="">:</td>
    <td class="" colspan="4"> </td>
  </tr>
  <tr class="">
    <td class=""> Penerima Informasi**) </td>
    <td class="">: </td>
    <td class="" colspan="4"> </td>
  </tr>
  <tr class="">
    <td class=""> Hubungan dengan Pasien </td>
    <td class="">: </td>
    <td class="" colspan="4">diri sendiri / orang tua kandung / anak kandung / suami / istri / wali *) </td>
  </tr>
  <tr><td colspan="6" style="font-size:8px;"> &nbsp; </td></tr>
</table>
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="">
      <th class=" bg-burem" colspan="3" style="border-left:3px solid white; padding-left:3px;"> JENIS INFORMASI </th>
      <th class=" bg-burem" style="border-left:3px solid white; padding-left:3px;"> ISI INFORMASI </th>
      <th class=" bg-burem" width="100px" style="border-left:3px solid white; padding-left:3px;"> TANDA (<img src="'.IMG.'banner/blank_check.png" style="margin-top:2px;" width="8" height=""/>) / TANDA TANGAN</th>
  </tr>
  <tr class="">
      <td class="bdb  txr" width="25"> 1. </td>
      <td class="bdb " width="200">Diagnosis kerja / Diagnosis <br />banding <br />&nbsp; </td>
      <td class="bdb " width="10">: </td>
      <td class="bdb "> </td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
    <tr class="">
      <td class="bdb  txr"> 2. </td> 
      <td class="bdb ">Dasar diagnosis <br />&nbsp; <br />&nbsp; </td>
      <td class="bdb ">: </td>
      <td class="bdb "> </td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
    <tr class="">
      <td class="bdb  txr"> 3. </td>
      <td class="bdb ">Tindakan Kedokteran <br />&nbsp; <br />&nbsp; </td>
      <td class="bdb ">: </td>
      <td class="bdb "> </td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
    <tr class="">
      <td class="bdb  txr"> 4. </td>
      <td class="bdb ">Tujuan Tindakan <br />&nbsp; <br />&nbsp; </td>
      <td class="bdb ">: </td>
      <td class="bdb "> </td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
  <tr class="">
      <td class="bdb txr"> 5. </td>
      <td class="bdb">Tata Cara <br />&nbsp; <br />&nbsp; </td>
      <td class="bdb ">: </td>
      <td class="bdb "> </td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
  <tr class="">
      <td class="bdb txr"> 6. </td>
      <td class="bdb">Keuntungan <br />&nbsp; <br />&nbsp; </td>
      <td class="bdb ">: </td>
      <td class="bdb "> </td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
  <tr class="">
      <td class="bdb txr"> 7. </td>
      <td class="bdb">Resiko  <br />&nbsp; <br />&nbsp; </td>
      <td class="bdb ">: </td>
      <td class="bdb "> </td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
  <tr class="">
      <td class="bdb txr"> 8. </td>
      <td class="bdb">Komplikasi <br />&nbsp; </td>
      <td class="bdb ">: </td>
      <td class="bdb "> </td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
  <tr class="">
      <td class="bdb txr"> 9. </td>
      <td class="bdb">Prognosis <br />&nbsp; <br />&nbsp; </td>
      <td class="bdb ">: </td>
      <td class="bdb "> </td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
    <tr class="">
      <td class="bdb txr"> 10. </td>
      <td class="bdb">Penggunaan darah dan<br>produk darah  <br />&nbsp; </td>
      <td class="bdb ">: </td>
      <td class="bdb "> </td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
    <tr class="">
      <td class="bdb txr"> 11. </td>
      <td class="bdb">Alternatif  <br />&nbsp; <br />&nbsp; </td>
      <td class="bdb ">: </td>
      <td class="bdb "> </td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
    <tr class="">
      <td class="bdb txr"> 12. </td>
      <td class="bdb">Lain - lain  <br />&nbsp; <br />&nbsp; </td>
      <td class="bdb ">: </td>
      <td class="bdb "> </td>
      <td class="bdb "> </td>
  </tr>
</table>

<table class="size-custom" cellspacing="0" cellpadding="0" width="100%">
    <tr class="">
      <td class="bdt" width="500">Dengan ini menyatakan bahwa saya telah menerangkan hal-hal di atas secara benar dan jujur dan memberikan kesempatan untuk bertanya dan berdiskusi</td>
      <td class="bdt txc">Pemberi Informasi<br /><br />________________________<br />Tanda tangan & Nama Terang</td>
    </tr>
    <tr class="">
      <td class="bdt bdb">Dengan ini menyatakan bahwa saya telah menerima informasi sebagaimana diatas yang saya beri tanda tangan (<img src="'.IMG.'banner/blank_check.png" style="margin-top:2px;" width="8" height=""/>) / paraf di kolom kanannya, dan telah memahaminya</td>
      <td class="bdt bdb txc">Penerima Informasi<br /><br />________________________<br />Tanda tangan & Nama Terang</td>
    </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; font-size:12px;">

  <tr class="">
    <td colspan="2" class="b">Keterangan : </td>
  </tr>
  <tr class="">
    <td width="25" class="txr ">*) </td>
    <td class="">Coret yang tidak perlu</td>
  </tr>
  <tr>
    <td class="txr" >**)</td>
    <td >Bila pasien tidak kompeten atau tidak mau menerima informasi, maka penerima informasi adalah wakil, keluarga inti atau keluarga yang tercantum dalam general consent</td>
  </tr>
  <tr>
    <td class=""></td>
    <td class=""></td>
</tr>
</table>
  ';
$html .='

  ';
$html .='

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


$file = DOC_FILE;
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
  $file = $dir.DOC_FILE;
}
$pdf->Output($file, $pdf_type);
?>