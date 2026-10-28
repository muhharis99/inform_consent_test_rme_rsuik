<?php
$waktu_wib = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
function change_jkel($val) {
  $result = '';
  switch ($val) {
    case 'L' : 
      $result = "LAKI-LAKI"; 
      break; 
    case 'P' : 
      $result = "PEREMPUAN"; 
      break; 
  }
  return $result; 
}
define('DOC_REVISI', 'Revisi : 0');
define('DOC_TERBIT', 'Tanggal Terbit : 15 April 2019');
define('DOC_NOMER', 'FM/RM/21.9.1'); 
define('DOC_FILE', 'PERMOHONAN-VAKSIN.pdf'); 
define('DOC_TITLE', 'PERMOHONAN VAKSIN'); 
define('DOC_SUBJECT', 'PERMOHONAN VAKSIN'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
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

    .row-tinggi td {
      line-height: 23px; 
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
  <tr>
      <td class="ln20 custom-text">&nbsp;Yang bertanda tangan di bawah ini :</td>
  </tr>
</table>
';

$html .='
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">

    <tr>
      <td class="ln20 custom-text">&nbsp; Nama </td>
      <td class="ln20 custom-text"> : </td>
      <td class="ln20 custom-text" colspan="3">'.(!empty($nama)?$nama:'__________________________________').'</td>
    </tr>

    <tr>
      <td class="ln20 custom-text">&nbsp; Tanggal Lahir / Umur </td>
      <td class="ln20 custom-text"> : </td>
      <td class="ln20 custom-text" colspan="3">'.((!empty($tgl_lahir) && $tgl_lahir!='') 
        ? date("d-m-Y", strtotime($tgl_lahir)).($umur!=''?' ('.$umur.')':'') 
        : '__________________________________').'</td>
    </tr>

    

    <!-- <tr>
      <td class="ln20 custom-text">&nbsp; Tempat, Tanggal Lahir </td>
      <td class="ln20 custom-text"> : </td>
      <td class="ln20 custom-text" colspan="3">__________________________________</td>
    </tr> -->

    <tr>
      <td class="ln20 custom-text">&nbsp; Jenis Kelamin </td>
      <td class="ln20 custom-text"> : </td>
      <td class="ln20 custom-text" colspan="3">'.(!empty($jenis_kel)?$jenis_kel:'__________________________________').'</td>
    </tr>

    <tr>
      <td class="ln20 custom-text">&nbsp; Pekerjaan </td>
      <td class="ln20 custom-text"> : </td>
      <td class="ln20 custom-text" colspan="3">'.(!empty($kerja)?$kerja:'__________________________________').'</td>
    </tr>

    <tr>
      <td class="ln20 custom-text">&nbsp; Alamat </td>
      <td class="ln20 custom-text"> : </td>
      <td class="ln20 custom-text" colspan="3">'.(!empty($alamat)?$alamat:'__________________________________').'</td>
    </tr>

    <tr>
      <td class="ln20 custom-text">&nbsp; Nomor Paspor </td>
      <td class="ln20 custom-text"> : </td>
      <td class="ln20 custom-text" colspan="3">__________________________________</td>
    </tr>

    <tr>
      <td class="ln20 custom-text">&nbsp; No. Telp / HP </td>
      <td class="ln20 custom-text"> : </td>
      <td class="ln20 custom-text" colspan="3">__________________________________</td>
    </tr>

    <tr>
      <td class="ln20 custom-text">&nbsp; Alamat Email </td>
      <td class="ln20 custom-text"> : </td>
      <td class="ln20 custom-text" colspan="3">__________________________________</td>
    </tr>

    <tr>
      <td class="ln20 custom-text">&nbsp; Negara Tujuan </td>
      <td class="ln20 custom-text"> : </td>
      <td class="ln20 custom-text" colspan="3">__________________________________</td>
    </tr>

    <tr>
      <td class="ln20 custom-text">&nbsp; Tanggal Berangkat </td>
      <td class="ln20 custom-text"> : </td>
      <td class="ln20 custom-text" colspan="3">__________________________________</td>
    </tr>

    <tr>
      <td class="ln20 custom-text">&nbsp; Jenis Vaksinasi </td>
      <td class="ln20 custom-text"> : </td>
      <td class="ln20 custom-text" colspan="3">__________________________________</td>
    </tr>

    <tr>
      <td class="ln20 custom-text">&nbsp; Nama Travel / Agen </td>
      <td class="ln20 custom-text"> : </td>
      <td class="ln20 custom-text" colspan="3">__________________________________</td>
    </tr>

    <tr>
      <td class="ln20 custom-text">&nbsp; Alamat Travel / Agen</td>
      <td class="ln20 custom-text"> : </td>
      <td class="ln20 custom-text" colspan="3">__________________________________</td>
    </tr>

    <tr>
      <td class="ln20 custom-text">&nbsp; Hasil Pemeriksaan PP Test </td>
      <td class="ln20 custom-text"> : </td>
      <td class="ln20 custom-text" colspan="3">__________________________________</td>
    </tr>
</table>
';

$html .= '<br>
<p class="custom-text" style="text-align: justify;">
Dengan ini memohon kepada Rumah Sakit Islam Klaten agar dapat memberikan vaksin ____________________<br>
kepada saya. Dengan ini saya menyatakan bahwa semua informasi yang berhubungan dengan vaksinasi ini telah<br>saya ketahui, 
termasuk efek sampingnya atau (Kejadian Ikutan Pasca Vaksinasi).
</p>
';

$html .= '
<p class="custom-text" style="text-align: justify;">
Demikian permohonan ini dibuat agar dapat dipergunakan sebagaimana mestinya.
</p>
';


$html .= '<br>
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr>
    <td></td>
    <td class="custom-text txc" width="320">
      &nbsp; Klaten: '.$waktu_wib->format('d-m-Y').' Jam: '.$waktu_wib->format('H:i').' WIB
    </td>
  </tr>
</table>
';




$html .= '<br>
<table border="0"  cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr>
  <td></td>
    <td class="custom-text txc" width="320">Pemohon <br><br><br>(____________________________) <br>Tanda tangan dan nama terang</td>
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