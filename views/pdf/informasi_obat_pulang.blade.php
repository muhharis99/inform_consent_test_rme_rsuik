<?php
// $no_reg = '0000000'; 
// $nama = 'MR X'; 
// $registered = date("Y-m-d H:i:s");
// $alamat = 'KRESAN 01/06 WARU BAKI, SUKOHARJO'; 
define('DOC_NOMER', 'FORM/FAR/17'); 
define('DOC_TITLE', 'FORM EDUKASI OBAT PULANG'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 15, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm_logo.php';
$pdf->SetTitle(''.$no_reg);
$pdf->SetSubject('Informasi Edukasi Obat Pulang');
$pdf->SetKeywords('RS Islam Klaten, Informasi Obat Pulang');
// $pdf->SetHTMLHeader('
//   <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
//     <tbody>
//       <tr>
//         <td align="left" width="300">RSU ISLAM KLATEN</td>
//         <td align="right" width="300" style="text-align:right;"> </td>
//         <td align="right"  style="">Hal {PAGENO}/ {nbpg}</td>
//       </tr>
//     </tbody>
//   </table>
//   <br>
//   <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
//     <tbody>
//       <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
//       <tr>
//         <td class="txr" rowspan="5" width="75" bgcolor="" style=""><img width="10%" src="http://192.168.0.16/serverx/assets/public/img/banner/logo_rsu.png"></td>
//         <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>FORM INFORMASI OBAT PULANG</b></td>
//         <td class="" rowspan="5" width="5"></td><td width="70">NO.RM</td><td width="10">:</td><td width="250">'.(!empty($nama)?$no_reg:'').'</td>
//       </tr>
//       <tr><td>NAMA</td><td>:</td><td>'.(!empty($nama)?$nama:'').'</td></tr>
//       <tr><td>NIK</td><td>:</td><td>'.(!empty($nik)?$nik:'').'</td></tr>
//       <tr><td>TGL LAHIR</td><td>:</td><td>'.((!empty($tgl_lahir) && $tgl_lahir != '') ? date("d-m-Y", strtotime($tgl_lahir)).($umur!=''?' ( '.$umur.' )':'') : '').'</td></tr>
//       <tr><td valign="top">ALAMAT <br />&nbsp; </td><td valign="top">:</td><td>'.(!empty($alamat)?$alamat:'<br /> &nbsp; ').'</td></tr>
//       <tr><td colspan="6" style="line-height:3px; border-bottom:1px solid black;"> &nbsp; </td></tr>
//     </tbody>
//   </table>
// ');
$pdf->SetHTMLFooter('
  <table style="font-size:12px;"><tbody><tr><td width="350">Revisi: 5</td><td width="" align="right">Tanggal Terbit : 23 Juni 2022</td></tr></tbody></table>
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
      font-size:12px;
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
    .title td {
      line-height:20px;
      font-weight:bold;
    }
    .bdl {
       border-left: 0.5px solid grey;
    }
    .bdr {
       border-right: 0.5px solid grey;
    }
    .bdt {
       border-top: 0.5px solid grey;
    }
    .bdb {
       border-bottom: 0.5px solid grey;
    }
    .tableinzero table tr td {
      padding:0px;
    }
    .p0 {
      padding:0px;
    }
    .custom-text {
      font-size :14px;
    }
  </style>
'; 
$html .='<br>';

$jml_td = 15;
for($i=0; $i<$jml_td; $i++) {
  $print_td .= '<td width=""> &nbsp; </td>'; 
}

$jml_row = 7;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= '<tr class="bdl bdr bdb">
  <td class="bdr ln30 custom-text">&nbsp;</td>
  <td class="bdr ln30 custom-text">&nbsp;</td>
  <td class="bdr ln30 custom-text">&nbsp;</td>
  <td class="bdr ln30 custom-text">&nbsp;</td>
  <td class="bdr ln30 custom-text">&nbsp;</td>
  <td class="bdr ln30 custom-text">&nbsp;</td>
  <td class="bdr ln30 custom-text">&nbsp;</td>
  <td class="bdr ln30 txc custom-text"> .... sebelum/sesudah/saat makan</td>
  <td class="bdr ln30 custom-text">&nbsp;</td>
</tr>'; 
}

$null = 40;
for($i=0; $i<$null; $i++) {
  $print_null .= '&nbsp;'; 
}
$html .= '
<table style="font-size:12px;" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
  <tbody>
    <tr class="bdl bdr bdt">
      <th class="bdr ln23 bg-burem custom-text">NO</th>
      <th class="bdr bg-burem custom-text custom-text" width="90px">NAMA OBAT</th>
      <th class="bdr bg-burem custom-text" width="120px">ATURAN PAKAI</th>
      <th class="bdr bg-burem custom-text">Pagi</th>
      <th class="bdr ln30 bg-burem custom-text">Siang</th>
      <th class="bdr bg-burem custom-text">Sore</th>
      <th class="bdr bg-burem custom-text">Malam</th>
      <th class="bdr bg-burem custom-text">WAKTU PEMAKAIAN</th>
      <th class="bdr bg-burem custom-text" width="100px">Instruksi Khusus</th>
    </tr>
    '.$print_tr.'
    
</tr>
  </tbody>
</table>
  ';

  $html .= '<br>
  <table border="0" style="font-size:12px;" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
    <tbody>
        <tr>
            <td> &nbsp; </td>
            <td colspan="15"> &nbsp; </td>
            <td class="ln30 txl custom-text">'.$print_null.'Klaten, _______</td>
        </tr>
        <tr>
            <td width="300" class="txl custom-text">PETUGAS FARMASI YG MENYERAHKAN</td>
            <td colspan="15"> &nbsp; </td>
            <td width="300" class="txl custom-text">'.$print_null.'YANG MENERIMA</td>
        </tr>
        <tr>
            <td width="300" class="txl" style="background-image:url(\''.IMG.'ttds/'.$no_reg.'.jpgx\'); display:none; background-repeat:no-repeat; background-size:100px; background-position:left;height:110px;">
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                '.(!empty($akad)?($akad->pihak_kedua_nama!=''?$akad->pihak_kedua_nama:'(_____________________________)'):'(_____________________________)').'
            </td>
            '.$print_td.'
            <td width="300" class="txl" style="background-image:url(\''.IMG.'ttds/'.$no_reg.'.jpg\'); display:none; background-repeat:no-repeat; background-size:25% 25%; background-position:left;height:110px;">
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />'.$print_null.'
                '.(!empty($akad)?($akad->pihak_pertama_nama!=''?$akad->pihak_pertama_nama:'(_____________________________)'):'(_____________________________)').'
            </td>
        </tr>
        <tr>
            <td> FORM/FAR/17 </td>
            <td colspan="15"> &nbsp; </td>
            <td>'.$print_null.'Tgl terbit : 1 Juli 2022 </td>
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