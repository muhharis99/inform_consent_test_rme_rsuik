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
define('DOC_NOMER', 'FM/RM/21.9.3'); 
define('DOC_FILE', 'DAFTAR-TILIK-PENAPISAN-KONTRAINDIKASI-UNTUK-VAKSINASI-DEWASA.pdf'); 
define('DOC_TITLE', 'DAFTAR TILIK PENAPISAN<br>KONTRAINDIKASI UNTUK<br>VAKSINASI DEWASA'); 
define('DOC_SUBJECT', 'DAFTAR TILIK PENAPISAN KONTRAINDIKASI UNTUK VAKSINASI DEWASA'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
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

    .row-tinggi td {
      line-height: 23px; 
    }

  </style>
'; 
// $html .='<br>';
$print_tr = '';
$jml_row_spasi = 37;
for($i=0; $i<$jml_row_spasi; $i++) {
  $spasi .= '&nbsp;'; 
}


$html .= '
<table border="0" class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="bg-burem row-tinggi">
    <th class="txc" width="30"> &nbsp; No</th>
    <th class="txc" width="300"> Pernyataan</th>
    <th class="txc" width="50"> Ya</th>
    <th class="txc" width="50"> Tidak</th>
    <th class="txc" width="50"> Tidak Tahu</th>
    <th class="txc" width="100"> Keterangan</th>
  </tr>

  <tr class="bg-burem1 row-tinggi">
    <td style="border-left:3px solid white; padding-left:3px;">1.</td>
    <td>Apakah anda sedang sakit hari ini</td>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
  </tr>

  <tr class="row-tinggi">
    <td>2.</td>
    <td>Apakah anda memiliki alergi terhadap obat-obatan, makanan,<br>komponen vaksin atau lateks?</td>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
  </tr>

  <tr class="bg-burem1 row-tinggi">
    <td>3.</td>
    <td>Apakah anda pernah mengalami reaksi alergi berat setelah menerima vaksinasi?</td>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
  </tr>

  <tr class="row-tinggi">
    <td>4.</td>
    <td>Apakah anda memiliki penyakit kronis terkait jantung, paru-paru,<br>asma, ginjal, penyakit metabolik (diabetes), anemia atau penyakit<br> kelainan darah?</td>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
  </tr>

  <tr class="bg-burem1 row-tinggi">
    <td>5.</td>
    <td>Apakah anda menderita kanker, leukemia, HIV/AIDS atau<br>gangguan sistem daya tahan tubuh?</td>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
  </tr>

  <tr class="row-tinggi">
    <td>6.</td>
    <td>Dalam 3 bulan terakhir, apakah anda mendapatkan pengobatan<br>yang melemahkan daya tahan tubuh, seperti kortison,<br>prednisone, steroid lainnya atau obat anti kanker, atau dalam<br>terapi radiasi?</td>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
  </tr>

  <tr class="bg-burem1 row-tinggi">
    <td>7.</td>
    <td>Apakah anda pernah mengalami kejang atau gangguan sistem<br>syaraf lainnya?</td>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
  </tr>

  <tr class="row-tinggi">
    <td>8.</td>
    <td>Apakah anda menerima transfusi darah atau produk darah, atau<br>mendapat terapi imun (gammaglobulin, atau obat antiviral)<br>dalam satu tahun terakhir?</td>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
  </tr>

  <tr class="bg-burem1 row-tinggi">
    <td>9.</td>
    <td>Apakah anda sedang hamil atau berencana untuk hamil dalam 1<br>bulan ke depan?</td>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
  </tr>

  <tr class="row-tinggi">
    <td>10.</td>
    <td>Apakah anda mendapatkan vaksinasi dalam 4 minggu terakhir?</td>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
  </tr>

  <tr class="bg-burem1 row-tinggi">
    <td>11.</td>
    <td>Apakah anda membawa kartu vaksinasi?</td>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
  </tr>
</table>
';

$html .= ' <br>

<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr>
    <td></td>
    <td class="custom-text txc" width="320">
      &nbsp; Klaten: '.$waktu_wib->format('d-m-Y').' Jam: '.$waktu_wib->format('H:i').' WIB
    </td>
  </tr>
</table>
<br>
<table class="" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;" border="0">
    <tr class="">
      <td class=" " align="center">Perawat Pendamping</td>
      <td class="" align="center">Dokter Verifikator</td>
    </tr>
    <tr class="">
      <td class="" align="center" style="f"><br /><br />(________________________)<br />Tanda tangan & Nama Terang</td>
      <td class="" align="center" style="f"><br /><br />(________________________)<br />Tanda tangan & Nama Terang</td>
    </tr>
    <tr class="">
      <td class="" align="left" colspan="2"><b>Keterangan : </b><br />*) berikan tanda √ sesuai dengan jawaban<br /><br /></td>
    </tr>
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