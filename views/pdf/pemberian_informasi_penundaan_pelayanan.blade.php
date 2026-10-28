<?php
define('DOC_REVISI', 'Revisi : 1');
define('DOC_TERBIT', 'Tanggal Terbit : 1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/26'); 
define('DOC_TITLE', 'PEMBERIAN INFORMASI PENUNDAAN PELAYANAN'); 
define('DOC_SUBJECT', 'Pemberian Informasi Penundaan Pelayanan'); 
define('DOC_FILE', 'Pemberian-Informasi-Penundaan-Pelayanan.pdf'); 
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
       border-left: 1px solid #505050;
    }
    .bdr {
       border-right: 1px solid #505050;
    }
    .bdt {
       border-top: 1px solid #505050;
    }
    .bdb {
       border-bottom: 1px solid #505050;
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
$html .= '

<table class="size-custom " cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr>
      <td width="190px">Tanggal </td>
      <td width="10">:</td>
      <td>___/___/______ &nbsp; &nbsp; &nbsp; Jam : ___:___ WIB </td>
      <td colspan="3">&nbsp; </td>
    </tr>
    <tr>
      <td>Pemberi Informasi</td>
      <td>: </td>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td>Penerima Informasi **)</td>
      <td>: </td>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td>Hubungan dengan pasien</td>
      <td>: </td>
      <td colspan="4">diri sendiri / orang tua kandung / anak kandung / suami / istri / wali *)</td>
    </tr>
    <tr>
      <td colspan="6" style="font-size:8px;"> &nbsp; &nbsp; </td>
    </tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tbody>
    <tr class="bg-burem">
      <th class="txc" colspan="2" width="200"> &nbsp; JENIS INFORMASI</th>
      <th class="txc" style="border-left:3px solid white; padding-left:3px;"> ISI INFORMASI</th>
      <th class="txc" width="110" style="border-left:3px solid white; padding-left:3px;"> TANDA( <img src="'.IMG.'banner/blank_check.png" style="margin-top:2px;" width="8" height=""/> )/<br>TANDA TANGAN</th>
    </tr>
    <tr>
      <td colspan="4" class="ln8">
        &nbsp; 
      </td>
    </tr>
    <tr class="">
      <td class="bdb ">1. Jenis pelayanan yang ditunda</td>
      <td class="bdb">: </td>
      <td class="bdb ln33">&nbsp;</td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
    </tr>
    <tr>
      <td colspan="4" class="ln8">
        &nbsp; 
      </td>
    </tr>
    <tr class="">
      <td class="bdb">2. Alasan penundaan pelayanan</td>
      <td class="bdb">: </td>
      <td class="bdb ln33">&nbsp;</td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
    </tr>
    <tr>
      <td colspan="4" class="ln8">
        &nbsp; 
      </td>
    </tr>
    <tr class="">
      <td class="bdb">3. Alternatif yang tersedia</td>
      <td class="bdb">: </td>
      <td class="bdb ln33">&nbsp;</td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
    </tr>
</tbody>
</table>


<table class="size-custom" cellspacing="0" cellpadding="0" width="100%">
    <tr class="">
      <td class="" width="500">Dengan ini menyatakan bahwa saya telah menerangkan hal-hal diatas secara benar dan jujur dan memberikan kesempatan untuk bertanya dan/atau berdiskusi.</td>
      <td class=" txc">Pemberi Informasi<br /><br />________________________<br /></td>
    </tr>
    <tr class="">
      <td class="bdt bdb">Dengan ini menyatakan bahwa saya telah menerima informasi sebagaimana di atas yang saya beri  tanda (<img src="'.IMG.'banner/blank_check.png" style="margin-top:2px;" width="8" height=""/>) / paraf di kolom kanannya, dan telah memahaminya.</td>
      <td class="bdt bdb txc">Penerima Informasi<br /><br />________________________<br /></td>
    </tr>
</table>
<br />
<br />
<br />
<br />
<br />
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tbody>
  <tr>
      <td class="b" width="30" colspan="2">Keterangan :</td>
  </tr>
  <tr>
      <td class="txr" width="30">*)</td>
      <td class="">Coret yang tidak perlu.</td>
  </tr>
  <tr>
      <td class="txr" width="30">**)</td>
      <td class="">Bila pasien tidak kompeten atau tidak dapat menerima informasi, maka penerima informasi adalah wali atau keluarga terderkat.</td>
  </tr>
  </tbody>
</table>
'; 

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