<?php
define('DOC_REVISI', 'Revisi : 5');
define('DOC_TERBIT', 'Tanggal Terbit : 1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/10.2'); 
define('DOC_TITLE', 'CATATAN OBSERVASI VITAL SIGN'); 
define('DOC_SUBJECT', 'Catatan Observasi Vital Sign'); 
define('DOC_FILE', 'catatan-observasi-vital-sign.pdf'); 
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
    .size-custom12 {
      font-size:12px;
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
    .sz1 {
			font-size: 3;
		}
    .custom-text {
      font-size:14px;
    }
    .lns td {
      line-height:29px;
    }
  </style>
'; 

$html .= '
<table class="" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <thead>
    <tr class="bg-burem b">
      <td class="bdt bdr bdb bdl txc" colspan="2">Waktu</td>
      <td class="bdt bdr bdb txc" colspan="6">Observasi khusus untuk tanda vital, Saturasi O2, Penggunaan O2</td>
      <td class="bdt bdr bdb ln10 txc" rowspan="3" width="180">Tanda Tangan <br />& <br />Nama Terang Petugas</td>
    </tr>
    <tr class="bg-burem b">
      <td class="bdr bdb bdl txc " rowspan="2" style="vertical-align:middle;" width="80">Tgl/bln/thn</td>
      <td class="bdr bdb txc" rowspan="2" style="vertical-align:middle;" width="40">Pukul</td>
      <td class="bdr bdb txc">TD</td>
      <td class="bdr bdb txc">N</td>
      <td class="bdr bdb txc">S</td>
      <td class="bdr bdb txc">R</td>
      <td class="bdr bdb txc">SpO2</td>
      <td class="bdr bdb txc">O2</td>
    </tr>
    <tr class="bg-burem">
      <td class="bdr bdb txc">mmHg</td>
      <td class="bdr bdb txc">x/mnt</td>
      <td class="bdr bdb txc">°C</td>
      <td class="bdr bdb txc">x/mnt</td>
      <td class="bdr bdb txc">%</td>
      <td class="bdr bdb txc">l/mnt</td>
    </tr>
  </thead>
  <tbody>';
for ($i=0; $i<30; $i++) {
  $html.='
    <tr class="lns">
      <td class="bdr bdb bdl"> &nbsp; </td>
      <td class="bdr bdb"></td>
      <td class="bdr bdb"></td>
      <td class="bdr bdb"></td>
      <td class="bdr bdb"></td>
      <td class="bdr bdb"></td>
      <td class="bdr bdb"></td>
      <td class="bdr bdb"></td>
      <td class="bdr bdb"></td>
    </tr>
  '; 
}
  $html.='
  </tbody>
</table>
  ';

$pdf->WriteHTML($html);


$file = "Catatan-Observasi-Khusus-Intevensi-Dan-Pengkajian-Ulang-Nyeri.pdf";
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
  $file = $dir."Catatan-Observasi-Khusus-Intevensi-Dan-Pengkajian-Ulang-Nyeri.pdf";
}
$pdf->Output($file, $pdf_type);
?>