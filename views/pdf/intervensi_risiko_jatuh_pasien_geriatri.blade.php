<?php
// $no_reg = '0000000'; 
// $nama = 'MR X'; 
// $registered = date("Y-m-d H:i:s");
// $alamat = 'KRESAN 01/06 WARU BAKI, SUKOHARJO'; 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 33, 15, 5, 6, 'P');
$pdf->SetTitle('FM/RM/04.5 - '.$no_reg);
$pdf->SetSubject('Intervensi Resiko jatuh Pasien Geriatri');
$pdf->SetKeywords('RS Islam Klaten, Intervensi Resiko jatuh Pasien Geriatri');
$pdf->SetHTMLHeader('
  <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
    <tbody>
      <tr>
        <td align="left" width="300">RSU ISLAM KLATEN</td>
        <td align="right" width="300" style="text-align:right;"> <b>FM/RM/04.6</b></td>
        <td align="right"  style="">Hal {PAGENO}/ {nbpg}</td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
    <tbody>
      <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
      <tr>
        <td class="txr" rowspan="5" width="75" bgcolor="" style=""> </td>
        <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>INTERVENSI RESIKO <br>JATUH PASIEN GERIATRI</b></td>
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
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: 5</td><td width="" align="right">Tanggal Terbit : 2 Agustus 2022</td></tr></tbody></table>
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
      line-height:25px;
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
      font-size:15px;
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
       border-left: 0.5px solid black;
    }
    .bdr {
       border-right: 0.5px solid black;
    }
    .bdt {
       border-top: 0.5px solid black;
    }
    .bdb {
       border-bottom: 0.5px solid black;
    }
    .tableinzero table tr td {
      padding:0px;
    }
    .p0 {
      padding:0px;
    }
    .custom-text {
      font-size:14px;
    }
  </style>
'; 
$html .='<br>';
$print_tr = '';
$jml_row = 30;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= ''; 
}
$html .= '
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="bdl bdr bdt">
      <th class="bdr txc ln30 custom-text bg-burem" colspan="8"> INTERVENSI RESIKO JATUH PASIEN GERIATRI </th>
    </tr>
  <tr class="bdl bdr bdt">
    <th class="bdr ln30 custom-text bg-burem" rowspan="2" width="100px"> Derajat Risiko</th>
    <th class="bdr ln30 custom-text bg-burem" colspan="2" rowspan="2"> Intervensi pencegahan risiko jatuh, beri tanda centang ( <img src="'.IMG.'banner/blank_check.png" style="margin-top:2px;" width="8" height=""/> )</th>
    <th class="bdr ln30 custom-text bg-burem" colspan="5" width="15px"> Tanggal / Jam</th>
  </tr>
  <tr class="">
  <td class="bdr bdb ln30 custom-text"> &nbsp; </td>
  <td class="bdr bdb ln30 custom-text"> &nbsp; </td>
  <td class="bdr bdb ln30 custom-text"> &nbsp; </td>
  <td class="bdr bdb ln30 custom-text"> &nbsp; </td>
  <td class="bdr bdb ln30 custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr ">
<th class="bdr ln30 custom-text" rowspan="6"> Risiko Rendah<br>(RR)</th>
<td class="bdr ln30 custom-text" width="20px">1</td>
<td class="bdr ln30 custom-text" width="350px"> Orientasi lingkungan </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr ln30 custom-text">2</td>
<td class="bdr ln30 custom-text" width="350px"> Pastikan bel mudah dijangkau </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr ln30 custom-text">3</td>
<td class="bdr ln30 custom-text" width="350px"> Roda tempat tidur berada pada posisi terunci </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr ln30 custom-text">4</td>
<td class="bdr ln30 custom-text" width="350px"> Posisi tempat tidur pada posisi terendah </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr ln30 custom-text">5</td>
<td class="bdr ln30 custom-text" width="350px"> Naikkan pagar pengaman tempat tidur </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr ln30 custom-text">6</td>
<td class="bdr ln30 custom-text" width="350px"> Pastikan lampu tidur hidup saat malam hari </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr ln30 custom-text" colspan="8">&nbsp;</td>
</tr>
<tr class="bdl bdr bdt">
<th class="bdr ln30 custom-text" rowspan="3">Risiko Sedang<br>(RS)</s>
<td class="bdr ln30 custom-text" width="20px">1</td>
<td class="bdr ln30 custom-text"> Lakukan semua pedoman pencegahan jatuh risiko rendah</td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr ln30 custom-text" width="20px">2</td>
<td class="bdr ln30 custom-text"> Beri tanda segitiga warna kuning pada bed pasien atau papan nama pasien</td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr ln30 custom-text" width="20px">3</td>
<td class="bdr ln30 custom-text"> Pasangkan gelang kuning pada pasien</td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr ln30 custom-text" colspan="8">&nbsp;</td>
</tr>
<tr class="bdl bdr bdt">
<th class="bdr ln30 custom-text" rowspan="5"> Risiko Tinggi<br>(RT)</th>
<td class="bdr ln30 custom-text" width="20px">1</td>
<td class="bdr ln30 custom-text"> Lakukan semua pedoman pencegaha jatuh risiko rendah dan sedang</td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr ln30 custom-text" width="20px">2</td>
<td class="bdr ln30 custom-text"> Kunjungi dan monitor pasien setiap jam</td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr ln30 custom-text" width="20px">3</td>
<td class="bdr ln30 custom-text"> Tempatkan pasien di kamar yang paling dekat dengan <i>nurse station</i> (bila mungkin)</td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr ln30 custom-text" width="20px">4</td>
<td class="bdr ln30 custom-text"> Pastikan pasien di kamar menggunakan alat bantu jalan</td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr ln30 custom-text" width="20px">5</td>
<td class="bdr ln30 custom-text"> Libatkan keluarga untuk mengawasi pasien</td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt bdb bg-burem1">
<th class="bdr ln30 custom-text" colspan="3"> Nama dan paraf melakukan intervensi pencegahan risiko jatuh</th>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
<td class="bdr ln30 custom-text"> &nbsp; </td>
</tr>
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