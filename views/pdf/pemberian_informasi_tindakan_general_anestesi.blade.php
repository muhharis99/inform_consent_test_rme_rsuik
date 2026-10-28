<?php
define('DOC_REVISI', 'Revisi : 1');
define('DOC_TERBIT', 'Tanggal Terbit : 1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/21.1.1'); 
define('DOC_TITLE', 'PEMBERIAN INFORMASI <br />TINDAKAN GENERAL ANESTESI'); 
define('DOC_SUBJECT', 'Pemberian Informasi Tindakan General Anestesi'); 
define('DOC_FILE', 'Pemberian-Informasi-Tindakan-General-Anestesi.pdf'); 
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
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="bg-burem">
    <th class="" colspan="3" style="border-left:3px solid white; padding-left:3px;"> JENIS INFORMASI </th>
    <th class="" style="border-left:3px solid white; padding-left:3px;"> ISI INFORMASI </th>
    <th class="" width="100px" style="border-left:3px solid white; padding-left:3px;"> TANDA (<img src="'.IMG.'banner/blank_check.png" style="margin-top:2px;" width="8" height=""/>) / TANDA TANGAN</th>
  </tr>
  <tr class="">
    <td class="bdb txr" width="25"> 1. </td>
    <td class="bdb" width="140">Diagnosis kerja/<br>Diagnosis banding <br />&nbsp; </td>
    <td class="bdb" width="5"> : </td>
    <td class="bdb"> &nbsp; </td>
    <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
  <tr class="">
    <td class="bdb txr"> 2. </td>
    <td class="bdb">Dasar diagnosis <br />&nbsp; </td>
    <td class="bdb"> : </td>
    <td class="bdb"> &nbsp; </td>
    <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
  <tr class="">
    <td class="bdb txr"> 3. </td>
    <td class="bdb">Tindakan Kedokteran <br />&nbsp; </td>
    <td class="bdb"> : </td>
    <td class="bdb"> &nbsp; </td>
    <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
  <tr class="">
    <td class="bdb txr" rowspan="2"> 4. </td>
    <td class="bdb" rowspan="2">Tujuan Tindakan</td>
    <td class="bdb" rowspan="2">:</td>
    <td class="">Memfasilitasi jalannya operasi agar dapat terlaksana dengan baik</td>
    <td class=" txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
    <tr class="">
    <td class="bdb">Menghilangkan nyeri, membuat relaksasi otot, membuat pasien tidak sadar</td>
    <td class="bdb"> </td>
  </tr>

  <tr class="">
    <td class="bdb txr"  rowspan="2"> 5. </td>
    <td class="bdb" rowspan="2">Tata Cara</td>
    <td class="bdb" rowspan="2">:</td>
    <td class="">Obat bius yang diberikan bisa berupa obat bius yang disuntikkan ke dalam pembuluh darah ataupun gas anestesi</td>
    <td class=" txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
  <tr class="">
    <td class="bdb">Lama kerja obat disesuaikan dengan lama operasi</td>
    <td class="bdb"> &nbsp; </td>
  </tr>
  <tr class="">
    <td class="bdb txr" > 6. </td>
    <td class="bdb">Keuntungan </td>
    <td class="bdb">:</td>
    <td class="bdb">Pasien sudah tidak sadar, tidak merasakan nyeri, menjadi relaksasi, teknik dan lama pembiusan disesuaikan dengan lama operasi</td>
    <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
  <tr class="">
    <td class="bdb txr" rowspan="3"> 7. </td>
    <td class="bdb" rowspan="3">Risiko </td>
    <td class="bdb" rowspan="3">:</td>
    <td class="">Obat bius yang diberikan dapat memiliki efek ke seluruh tubuh, berpengaruh terhadap kehamilan jika dalam keadaan hamil </td>
    <td class=" txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" />  </td>
  </tr>
  <tr class="">
    <td class="">Pasca operasi pasien harus sadar penuh sebelum bisa diberi minum</td>
    <td class=""> &nbsp; </td>
  </tr>
  <tr class="">
    <td class="bdb">Pada proses pemasangan alat bantu napas, mungkin dapat mengakibatkan terjadinya luka pada bibir, lidah, gusi atau lepasnya gigi yang goyah</td>
    <td class="bdb"> &nbsp; </td>
  </tr>

  <tr class="">
      <td class="bdb txr" rowspan="6"> 8. </td>
      <td class="bdb" rowspan="6">Komplikasi </td>
      <td class="bdb" rowspan="6">:</td>
      <td class="">Mual / muntah, menggigil, pusing, sakit tenggorokan, aspirasi</td>
      <td class=" txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
  <tr class="">
      <td class="">Masuknya isi lambung ke jalan napas / paru</td>
      <td class=""> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="">Alergi / hipersensitif terhadap obat anestesi</td>
      <td class=""> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="">Dapat menyebabkan henti jantung</td>
      <td class=""> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="">Kecacatan </td>
      <td class=""> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="bdb">Kematian</td>
      <td class="bdb"> &nbsp; </td>
  </tr>

  <tr class="">
      <td class="bdb txr"> 9. </td>
      <td class="bdb">Prognosis<br />&nbsp; </td>
      <td class="bdb">:</td>
      <td class="bdb">Tergantung klasifikasi ASA ( sesuai penilaian pra anestesi ) </td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
    <tr class="">
      <td class="bdb txr"> 10. </td>
      <td class="bdb">Analgesi pasca anestesi<br />&nbsp; </td>
      <td class="bdb">: </td>
      <td class="bdb">Mengurangi rasa nyeri dengan pemberian injeksi obat analgetik baik tunggal atau kombinasi</td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
    <tr class="">
      <td class="bdb txr"> 11. </td>
      <td class="bdb">Alternatif <br />&nbsp; </td>
      <td class="bdb">:</td>
      <td class="bdb"> &nbsp; </td>
      <td class="bdb txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /> </td>
  </tr>
    <tr class="">
      <td class="txr" > 12. </td>
      <td class="">Lain - lain <br />&nbsp;</td>
      <td class="">:</td>
      <td class=""> &nbsp; </td>
      <td class=""> &nbsp; </td>
  </tr>
</table>

<table class="size-custom" cellspacing="0" cellpadding="0" width="100%">
    <tr class="">
      <td class="bdt" width="500">Dengan ini menyatakan bahwa saya telah menerangkan hal-hal di atas secara benar dan jujur dan memberikan kesempatan untuk bertanya dan berdiskusi.</td>
      <td class="bdt txc">Pemberi Informasi<br /><br />________________________<br />Tanda tangan & Nama Terang</td>
    </tr>
    <tr class="">
      <td class="bdt bdb">Dengan ini menyatakan bahwa saya telah menerima informasi sebagaimana diatas yang saya beri tanda tangan (<img src="'.IMG.'banner/blank_check.png" style="margin-top:2px;" width="8" height=""/>) / paraf di kolom kanannya, dan telah memahaminya.</td>
      <td class="bdt bdb txc">Penerima Informasi<br /><br />________________________<br />Tanda tangan & Nama Terang</td>
    </tr>
</table>
<br />
<br />
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
//'.((!empty($ranap)) ? $ranap['pjawab'] : '


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