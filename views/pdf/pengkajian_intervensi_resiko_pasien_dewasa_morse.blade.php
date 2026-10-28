<?php
define('DOC_REVISI', 'Revisi : 2');
define('DOC_TERBIT', 'Tanggal Terbit : 20 Agustus 2022');
define('DOC_NOMER', 'FM/RM/04.4'); 
define('DOC_TITLE', 'PENGKAJIAN DAN INTERVENSI<br>
RISIKO JATUH PASIEN DEWASA<br>
<i>MORSE</i>'); 
define('DOC_SUBJECT', 'Pengkajian dan Intervensi Resiko Jatuh Pasien Dewasa Morse'); 
define('DOC_FILE', 'Pengkajian-Dan-Intevensi-Resiko-Jatuh-Pasien-Dewasa-Morse.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 8, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';
/*
$pdf->SetTitle('FM/RM/04.4 - '.$no_reg);
$pdf->SetSubject('PENGKAJIAN DAN INTERVENSI RESIKO JATUH PASIEN DEWASA (MORSE)');
$pdf->SetKeywords('RS Islam Klaten, Morse');
$pdf->SetHTMLHeader('
  <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
    <tbody>
      <tr>
        <td align="left" width="300">RSU ISLAM KLATEN</td>
        <td align="right" width="300" style="text-align:right;"> <b>FM/RM/04.4</b></td>
        <td align="right"  style="">Hal {PAGENO}/ {nbpg}</td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
    <tbody>
      <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
      <tr>
        <td class="txr" rowspan="5" width="75" bgcolor="" style=""> </td>
        <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>PENGKAJIAN DAN INTERVENSI<br>RESIKO JATUH PASIEN DEWASA<br><i>(MORSE)</i></b></td>
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
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: '.DOC_REVISI.'</td><td width="" align="right">Tanggal Terbit : '.DOC_TERBIT.'</td></tr></tbody></table>
');
$pdf->SetFont('calibri', 13);
*/
$html = '';
$html .= '
  <style type="text/css">
    .bg-burem {
      background-color: #9F9FA0;
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
    . {
      line-height:23px;
      font-size:18px;
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
    .ln23 {
      line-height:23px;
    }
    .ln24 {
      line-height:24px;
    }
    .ln25 {
      line-height:25px;
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
      font-size="14px";
    }
    .lnx {
      line-height:29px;
    }
  </style>
'; 
// $html .='<br>';
$print_tr = '';
$jml_row = 30;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= ''; 
}
$html .= '
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="">
      <td>Pengkajian resiko jatuh dilakukan saat pasien masuk, ketika terjadi perubahan kondisi dan ketika tiba diruangan baru dan atau setelah pasien jatuh.</td>
  </tr>
</table>
';
$html .='
<table cellspacing="0" border="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="">
    <th class="bdt bdb bdl txc bg-burem " text-rotate="90" rowspan="14" width="25"> NILAI RISIKO JATUH </th>
    <th class="bdr bdt bdb bg-burem " colspan="2" colspan="3" rowspan="3"> FAKTOR RISIKO</th>
    <th class="bdr bdt bdb" width="38">Tgl </th>
    <th class="bdr bdt bdb "> &nbsp; </th>
    <th class="bdr bdt bdb "> &nbsp; </th>
    <th class="bdr bdt bdb "> &nbsp; </th>
    <th class="bdr bdt bdb "> &nbsp; </th>
    <th class="bdr bdt bdb "> &nbsp; </th>
    <th class="bdr bdt bdb "> &nbsp; </th>
    <th class="bdr bdt bdb "> &nbsp; </th>
    <th class="bdr bdt bdb "> &nbsp; </th>
    <th class="bdr bdt bdb "> &nbsp; </th>
  </tr>
  <tr class="">
    <th class="bdr bdb  txc"> Jam </th>
    <th class="bdr bdb "> &nbsp; </th>
    <th class="bdr bdb "> &nbsp; </th>
    <th class="bdr bdb "> &nbsp; </th>
    <th class="bdr bdb "> &nbsp; </th>
    <th class="bdr bdb "> &nbsp; </th>
    <th class="bdr bdb "> &nbsp; </th>
    <th class="bdr bdb "> &nbsp; </th>
    <th class="bdr bdb "> &nbsp; </th>
    <th class="bdr bdb "> &nbsp; </th>
  </tr>
  <tr class="">
    <th class="bdr bdb  txc"> SKOR </th>
    <th class="bdr bdb "> &nbsp; </th>
    <th class="bdr bdb "> &nbsp; </th>
    <th class="bdr bdb "> &nbsp; </th>
    <th class="bdr bdb "> &nbsp; </th>
    <th class="bdr bdb "> &nbsp; </th>
    <th class="bdr bdb "> &nbsp; </th>
    <th class="bdr bdb "> &nbsp; </th>
    <th class="bdr bdb "> &nbsp; </th>
    <th class="bdr bdb "> &nbsp; </th>
  </tr>
    <tr class="">
      <td class="bdr bdb bdl "  colspan="2">Riwayat Jatuh (Jatuh bukan karena kecalakaan)</td>
      <td class="bdr bdb "> Kurang dari 3 bulan</td>
      <td class="bdr bdb  txc"> 25 </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
  </tr>
    <tr class="">
      <td class="bdr bdb bdl " colspan="2">Kondisi Kesehatan</td>
      <td class="bdr bdb "> Lebih dari satu diagnosis penyakit</td>
      <td class="bdr bdb  txc"> 15 </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
  </tr>
    <tr class="">
      <td class="bdr bdb bdl " rowspan="3" colspan="2">Bantuan Ambulansi</td>
      <td class="bdr bdb "> Ditempat tidur/butuh bantuan perawat/memakai kursi roda</td>
      <td class="bdr bdb  txc"> 0 </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
  </tr>
    <tr class="">
      <td class="bdr bdb " >Kruk, Tongkat, Walker</td>
      <td class="bdr bdb  txc"> 15 </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
  </tr>
    <tr class="">
      <td class="bdr bdb " >Funiture: Dinding, Meja, Kursi, Almari</td>
      <td class="bdr bdb  txc"> 30 </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
  </tr>
    <tr class="">
      <td class="bdr bdb bdl " colspan="2">Obat-obatan intra vena</td>
      <td class="bdr bdb "> Obat Psikotropika, heparin, digoksin, atropin </td>
      <td class="bdr bdb  txc"> 20 </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
  </tr>
    <tr class="">
      <td class="bdr bdb bdl " rowspan="3" colspan="2">Gaya berjalan/berpindah</td>
      <td class="bdr bdb "> Normal/ditempat tidur/immobilisasi</td>
      <td class="bdr bdb  txc"> 0 </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
  </tr>
    <tr class="">
      <td class="bdr bdb " >Lemah</td>
      <td class="bdr bdb  txc"> 10 </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
  </tr>
    <tr class="">
      <td class="bdr bdb ">Kerusakan</td>
      <td class="bdr bdb  txc"> 20 </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
  </tr>
    <tr class="">
      <td class="bdr bdb bdl "rowspan="2" colspan="2">Status Mental</td>
      <td class="bdr bdb "> Orientasi dengan kemampuan sendiri </td>
      <td class="bdr bdb  txc"> 0 </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
  </tr>
    <tr class="">
      <td class="bdr bdb " >Lupa, Keterbatasan</td>
      <td class="bdr bdb  txc"> 15 </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
  </tr>
    <tr class="">
      <th class="bdr bdl bdb txc bg-burem1 lnx" colspan="5">TOTAL SKOR</th>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
      <td class="bdr bdb "> &nbsp; </td>
  </tr>
    <tr class="">
      <td class="bdr bdb bdl bg-burem1 " colspan="5"><b>RR: Risiko Rendah(0-24), RS: Risiko Sedang (25-50), RT: Risiko Tinggi (>51) (lingkari salah satu)</b></td>
      <td class="bdr bdb "><b>RR/<br>RS/<br>RT</b></td>
      <td class="bdr bdb "><b>RR/<br>RS/<br>RT</b></td>
      <td class="bdr bdb "><b>RR/<br>RS/<br>RT</b></td>
      <td class="bdr bdb "><b>RR/<br>RS/<br>RT</b></td>
      <td class="bdr bdb "><b>RR/<br>RS/<br>RT</b></td>
      <td class="bdr bdb "><b>RR/<br>RS/<br>RT</b></td>
      <td class="bdr bdb "><b>RR/<br>RS/<br>RT</b></td>
      <td class="bdr bdb "><b>RR/<br>RS/<br>RT</b></td>
      <td class="bdr bdb "><b>RR/<br>RS/<br>RT</b></td>
  </tr>
  <tr class="bdl bdr bdb">
    <th class="bdr bg-burem " colspan="4" rowspan="2">INTERVENSI PENCEGAHAN RISIKO JATUH (BERI TANDA <img src="'.IMG.'banner/blank_check.png" style="margin-top:2px;"height="" width="15px"/>)</th>
    <th class="bdr b bg-burem1"> Tgl </th>
    <th class="bdr "> &nbsp; </th>
    <th class="bdr "> &nbsp; </th>
    <th class="bdr "> &nbsp; </th>
    <th class="bdr "> &nbsp; </th>
    <th class="bdr "> &nbsp; </th>
    <th class="bdr "> &nbsp; </th>
    <th class="bdr "> &nbsp; </th>
    <th class="bdr "> &nbsp; </th>
    <th class="bdr "> &nbsp; </th>
  </tr>
  <tr class="bdl bdr bdt bdb">
    <th class="bdr b bg-burem1"> Jam </th>
    <th class="bdr "> &nbsp; </th>
    <th class="bdr "> &nbsp; </th>
    <th class="bdr "> &nbsp; </th>
    <th class="bdr "> &nbsp; </th>
    <th class="bdr "> &nbsp; </th>
    <th class="bdr "> &nbsp; </th>
    <th class="bdr "> &nbsp; </th>
    <th class="bdr "> &nbsp; </th>
    <th class="bdr "> &nbsp; </th>
  </tr>
  <tr class="bdl bdr ">
    <th class="bdr bg-burem " text-rotate="90" rowspan="7" width="25"> RISIKO RENDAH (RR) </th>
    <td class="bdr  txc" width="30">1</td>
    <td class="bdr " colspan="2"> Orientasi Lingkungan</td>
    <td class="bdr "> &nbsp; </td>
    <td class="bdr "> &nbsp; </td>
    <td class="bdr "> &nbsp; </td>
    <td class="bdr "> &nbsp; </td>
    <td class="bdr "> &nbsp; </td>
    <td class="bdr "> &nbsp; </td>
    <td class="bdr "> &nbsp; </td>
    <td class="bdr "> &nbsp; </td>
    <td class="bdr "> &nbsp; </td>
    <td class="bdr "> &nbsp; </td>
  </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr  txc">2</td>
      <td class="bdr " colspan="2">Pastikan Bel mudah dijangkau</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
  </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr  txc">3</td>
      <td class="bdr " colspan="2">Roda tempat tidur berada pada posisi terkunci</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
  </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr  txc">4</td>
      <td class="bdr " colspan="2">Posisikan tempat tidur pada posisi terendah</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
  </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr  txc">5</td>
      <td class="bdr "  colspan="2">Naikkan pagar pengaman tempat tidur</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
  </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr  txc">6</td>
      <td class="bdr "  colspan="2">Pastikan lampu tidur hidup saat malam hari</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
  </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr  txc">7</td>
      <td class="bdr " colspan="2">Berikan edukasi pasien <br />&nbsp; <br />&nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt ">
      <th class="bdr bg-burem " text-rotate="90" rowspan="3"> RISIKO SEDANG (RS) </th>
      <td class="bdr  txc">1</td>
      <td class="bdr " colspan="2"> Lakukan semua pedoman pencegahan jatuh resiko rendah </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
  </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr  txc">2</td>
      <td class="bdr " colspan="2">Berikan tanda segitiga warna kuning pada bed pasien, pintu atau RM pasien</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
  </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr  txc">3</td>
      <td class="bdr " colspan="2">Pasangkan gelang kuning pada pasien <br />&nbsp; <br />&nbsp; <br />&nbsp; <br />&nbsp;  </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt ">
      <th class="bdr bg-burem " text-rotate="90" rowspan="5"> RISIKO TINGGI (RT) </th>
      <td class="bdr  txc">1</td>
      <td class="bdr " colspan="2"> Lakukan semua pedoman pencegahan jatuh resiko rendah dan sedang </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
  </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr  txc">2</td>
      <td class="bdr " colspan="2">Kunjungi dan monitor pasien tiap 1 jam</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
  </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr  txc">3</td>
      <td class="bdr " colspan="2">Tempatkan pasien dikamar yang paling dekat dengan nurse station (bila mungkin)</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
  </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr  txc">4</td>
      <td class="bdr " colspan="2">Pastikan pasien menggunakan alat bantu jalan</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
  </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr  txc">5</td>
      <td class="bdr " colspan="2">Libatkan keluarga untuk mengawasi pasien <br />&nbsp; <br />&nbsp; <br />&nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
  </tr>
  <tr class="bdl bdr bdt bdb">
  <td class="bdr lnx " colspan="5">Nama dan Paraf yang melakukan pengkajian</td>
  <td class="bdr "> &nbsp; </td>
  <td class="bdr "> &nbsp; </td>
  <td class="bdr "> &nbsp; </td>
  <td class="bdr "> &nbsp; </td>
  <td class="bdr "> &nbsp; </td>
  <td class="bdr "> &nbsp; </td>
  <td class="bdr "> &nbsp; </td>
  <td class="bdr "> &nbsp; </td>
  <td class="bdr "> &nbsp; </td>
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

  $dir = FCPATH."assets/rme/pdf/$ip/";
  if(file_exists($dir)){
  }else{
      mkdir($dir,0777);
  }
  $file = $dir.DOC_FILE;
}
$pdf->Output($file, $pdf_type);
?>