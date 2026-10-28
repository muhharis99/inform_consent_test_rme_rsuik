<?php
define('DOC_REVISI', 'Revisi : 2');
define('DOC_TERBIT', 'Tanggal Terbit : 20 Agustus 2022');
define('DOC_NOMER', 'FM/RM/04.3'); 
define('DOC_TITLE', 'PENGKAJIAN DAN INTERVENSI<br>RISIKO JATUH PASIEN ANAK<br><i>(HUPMPTY DUMPTY)</i>'); 
define('DOC_SUBJECT', 'Pengkajian dan Intervensi Risiko Jatuh Pasien Anak Humpty Dumpty'); 
define('DOC_FILE', 'Pengkajian-Dan-Intevensi-Resiko-Jatuh-Pasien-Anak-Humpty-Dumpty.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 33, 10, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';
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
    }
    .ln23 {
      line-height:23px;
    }
    .ln26 {
      line-height:26px;
      font-size :20px;
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

    .sc14 {
      font-size :14px;
    }
    .sc13 {
      font-size :13px;
    }
    .lnx {
      line-height:29px;
    }
  </style>
'; 
$html .='';
$print_tr = '';
$jml_row = 30;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= ''; 
}
$html .='<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tbody>
  <tr>
    <td class="ln18">Pengkajian resiko jatuh dilakukan saat pasien masuk, ketika terjadi perubahan kondisi dan ketika tiba diruangan baru dan atau setelah pasien jatuh</td>
  </tr>
</tbody>
</table>';

$html .= '
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tbody>
    <tr class="bdl bdr bdt bg-burem">
      <th class=" txc  " rowspan="26" text-rotate="90" width="20">FAKTOR RISIKO</th>
      <th class="bdr txc  " colspan="2" rowspan="3">FAKTOR RISIKO</th>
      <th class="bdr bg0" width="40" style="line-height:28px;"> Tgl </th>
      <td class="bdr txc bg0"> &nbsp; </td>
      <td class="bdr txc bg0"> &nbsp; </td>
      <td class="bdr txc bg0" > &nbsp; </td>
      <td class="bdr txc bg0" > &nbsp; </td>
      <td class="bdr txc bg0" > &nbsp; </td>
      <td class="bdr txc bg0" > &nbsp; </td>
      <td class="bdr txc bg0"> &nbsp; </td>
      <td class="bdr txc bg0"> &nbsp; </td>
      <td class="bdr txc bg0" > &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt bg-burem">
      <th class="bdr bg0" style="line-height:28px;"> Jam </th>
      <td class="bdr txc bg0"> &nbsp; </td>
      <td class="bdr txc bg0"> &nbsp; </td>
      <td class="bdr txc bg0"> &nbsp; </td>
      <td class="bdr txc bg0"> &nbsp; </td>
      <td class="bdr txc bg0"> &nbsp; </td>
      <td class="bdr txc bg0"> &nbsp; </td>
      <td class="bdr txc bg0"> &nbsp; </td>
      <td class="bdr txc bg0"> &nbsp; </td>
      <td class="bdr txc bg0"> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt bg-burem">
      <th class="bdr bg0"> SKOR </th>
      <td class="txc bg0"> &nbsp; </td>
      <td class="txc bg0"> &nbsp; </td>
      <td class="txc bg0"> &nbsp; </td>
      <td class="txc bg0"> &nbsp; </td>
      <td class="txc bg0"> &nbsp; </td>
      <td class="txc bg0"> &nbsp; </td>
      <td class="txc bg0"> &nbsp; </td>
      <td class="txc bg0"> &nbsp; </td>
      <td class="bdr txc bg0"> &nbsp; </td>
    </tr>
    <tr class="">
      <td class="bdr bdl bdt txc " rowspan="4" width="80" > USIA</td>
      <td class="bdr bdt lnx" width="275" >&nbsp;1 bulan-3 tahun</td>
      <td class="bdr bdt lnx txc ">4</td>
      <td class="bdr bdt  "> &nbsp; </td>
      <td class="bdr bdt  "> &nbsp; </td>
      <td class="bdr bdt  "> &nbsp; </td>
      <td class="bdr bdt  "> &nbsp; </td>
      <td class="bdr bdt  "> &nbsp; </td>
      <td class="bdr bdt  "> &nbsp; </td>
      <td class="bdr bdt  "> &nbsp; </td>
      <td class="bdr bdt  "> &nbsp; </td>
      <td class="bdr bdt  "> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lnx ">&nbsp;4-7 tahun</td>
      <td class="bdr lnx txc ">3</td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lnx ">&nbsp;8-12 tahun</td>
      <td class="bdr lnx txc ">2</td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lnx ">&nbsp;13-14 tahun</td>
      <td class="bdr lnx txc ">1</td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
    </tr>
    <tr class="">
      <td class="bdr bdt bdl txc " rowspan="2">JENIS KELAMIN</td>
      <td class="bdr bdt lnx ">&nbsp;LAKI-LAKI</td>
      <td class="bdr bdt lnx txc ">2</td>
      <td class="bdr bdt "> &nbsp; </td>
      <td class="bdr bdt  "> &nbsp; </td>
      <td class="bdr bdt "> &nbsp; </td>
      <td class="bdr bdt "> &nbsp; </td>
      <td class="bdr bdt "> &nbsp; </td>
      <td class="bdr bdt "> &nbsp; </td>
      <td class="bdr bdt "> &nbsp; </td>
      <td class="bdr bdt "> &nbsp; </td>
      <td class="bdr bdt "> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lnx ">&nbsp;PEREMPUAN</td>
      <td class="bdr lnx txc ">1</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr bdl txc " rowspan="4">DIAGNOSIS</td>
      <td class="bdr lnx ">&nbsp;Diagnosis neurologi dan atau gelisah</td>
      <td class="bdr lnx txc ">4</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr " >Perubahan oksigenasi (diagnosis respiratorik, dehisrasi, anemia, anoreksia,sinkop, pusing, dll)</td>
      <td class="bdr txc ">3</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lnx ">Gangguan perilaku/psikiatri</td>
      <td class="bdr lnx txc ">2</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
    </tr>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lnx ">Diagnosis lain</td>
      <td class="bdr lnx txc ">1</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
    </tr>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr bdl txc " rowspan="3">GANGGUAN KOGNITIF</td>
      <td class="bdr ">Tidak sadar akan keterbatasannya (contoh: umur < 5 th, gangguan mental, DLL)</td>
      <td class="bdr txc ">3</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
    </tr>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lnx ">Lupa akan keterbatasannya</td>
      <td class="bdr lnx txc ">2</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
    </tr>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lnx ">Orientasi/sadar penuh</td>
      <td class="bdr lnx txc ">1</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
    </tr>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr bdl txc " rowspan="4"> FAKTOR LINGKUNGAN</td>
      <td class="bdr ">Riwayat jatuh < 3 th atau saat bayi/anak usia todler diletakkan di bed dewasa</td>
      <td class="bdr txc ">4</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
    </tr>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr ">Pasien menggunakan alat bantu atau bayi/anak usia todler dalam box</td>
      <td class="bdr txc ">3</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
    </tr>
    </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr lnx">Pasien di tempat tidur saat perawatan</td>
      <td class="bdr lnx txc ">2</td>
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
    </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr ">Pasien dapat melakukan aktivitas diluar ruang rawat</td>
      <td class="bdr txc ">1</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
    </tr>
    </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr bdl txc " rowspan="3">RESPON TERHADAP<br>PEMBEDAHAN/<br />SEDASI/<br />ANESTESI</td>
      <td class="bdr lnx ">Dalam 24 jam</td>
      <td class="bdr lnx txc ">3</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
    </tr>
    </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr lnx ">Dalam 48 jam</td>
      <td class="bdr lnx txc ">2</td>
      <td class="bdr "></td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr ">> 48 jam/tidak menjalani pembedahan/sedasi/anestesi</td>
      <td class="bdr txc ">1</td>
      <td class="bdr "></td>
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
      <td class="bdr bdl txc " rowspan="3">PENGGUNAAN MEDIKAMENTOSA</td>
      <td class="bdr ">Penggunaan multiple : sedative, obat hipnotis, barbitutas, fenoatiazin, antidepresan, pencahar, diuretik, narkose</td>
      <td class="bdr txc ">3</td>
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
      <td class="bdr lnx ">&nbsp;Menggunakan salah satu obat-obatan diatas</td>
      <td class="bdr lnx txc ">2</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr lnx ">&nbsp;Menggunakan obat lain</td>
      <td class="bdr lnx txc ">1</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt ">
      <td class="b lnx " colspan="3">TOTAL SKOR (7-11 = RESIKO RENDAH; 12-23 = RESIKO TINGGI)</td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
      <td class="bdr  "> &nbsp; </td>
      <td class="bdr "> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr " colspan="4">&nbsp;Lingkari skor jatuh setelah penilaian</td>
      <td class="bdr ">RR/<br>RT</td>
      <td class="bdr ">RR/<br>RT</td>
      <td class="bdr ">RR/<br>RT</td>
      <td class="bdr ">RR/<br>RT</td>
      <td class="bdr ">RR/<br>RT</td>
      <td class="bdr ">RR/<br>RT</td>
      <td class="bdr ">RR/<br>RT</td>
      <td class="bdr ">RR/<br>RT</td>
      <td class="bdr ">RR/<br>RT</td>
    </tr>
    <tr class="bdl bdr bdt bdb">
      <td class="bdr lnx " colspan="4">Nama dan paraf yang melakukan pengkajian</td>
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
  </tbody>
</table><br>
  ';
$spasinya= '';
$jml_row = 3;
for($i=0; $i<$jml_row; $i++) {
  $spasinya .= '&nbsp;'; 
}
$html .='
<br /> &nbsp;
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="bdl bdr bdt bg-burem">
      <td class="bdr txc ln15 " align="center" rowspan="2" colspan="4">&nbsp;<br><b>INTERVENSI PENCEGAHAN PASIEN JATUH</b><br>Beri tanda ( <img src="'.IMG.'banner/blank_check.png" style="margin-top:2px;" width="15" height=""/> ) pada tindakan yang dilakukan<br>&nbsp;</td>
      <th class="bdr bg0" width="30" >Tgl</th>
        <td class="bdr bg0" width="30" > &nbsp; </td>
        <td class="bdr bg0" width="30" > &nbsp; </td>
        <td class="bdr bg0" width="30"> &nbsp; </td>
        <td class="bdr bg0" width="30"> &nbsp; </td>
        <td class="bdr bg0" width="30"> &nbsp; </td>
        <td class="bdr bg0" width="30"> &nbsp; </td>
        <td class="bdr bg0" width="30"> &nbsp; </td>
        <td class="bdr bg0" width="30"> &nbsp; </td>
        <td class="bdr bg0" width="30" > &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt bg-burem">
    <th class="bdr bg0" > Jam</th>
      <td class="bdr bg0" > &nbsp; </td>
      <td class="bdr bg0" > &nbsp; </td>
      <td class="bdr bg0" > &nbsp; </td>
      <td class="bdr bg0" > &nbsp; </td>
      <td class="bdr bg0" > &nbsp; </td>
      <td class="bdr bg0" > &nbsp; </td>
      <td class="bdr bg0" > &nbsp; </td>
      <td class="bdr bg0" > &nbsp; </td>
      <td class="bdr bg0" > &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt ">
      <td class="bdr lnx " colspan="4">&nbsp;Resiko Tinggi intervensi setiap 4 jam</td>
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
    <td class=" lnx " width="2px">1.</td>
      <td class="bdr lnx " colspan="3">Saran kepada pasien / keluarga untuk meminta bantuan</td>
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
    <td class=" lnx "> 2.</td>
      <td class="bdr lnx " colspan="3">Tempatkan bel panggilan dalam jangkauan tangan (bila tersedia)</td>
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
    <td class=" ">3.</td>
      <td class="bdr lnx " colspan="3">Tempatkan benda-benda milik pasien di dekat pasien</td>
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
    <td class="lnx  "> 4.</td>
      <td class="bdr lnx " colspan="3">Pastikan tempat tidur dalam posisi rendah dan roda terkunci</td>
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
    <td class="lnx ">5.</td>
      <td class="bdr lnx " colspan="3">Pastikan pakaian pasien diatas mata kaki</td>
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
    <td class="lnx  "> 6. </td>
      <td class="bdr lnx " colspan="3">Bantu pasien saat transfer/ambulansi</td>
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
    <td class="lnx  "> 7. </td>
      <td class="bdr lnx " colspan="3">Pasang pengaman sistem tempat tidur </td>
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
    <td class=" lnx ">8. </td>
      <td class="bdr lnx " colspan="3">Pastikan pasien terpasang gelang kuning</td>
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
    <td class="lnx  "> 9. </td>
      <td class="bdr " colspan="3">Pastikan tanda pasien risiko jatuh terpasang di tempat tidur pasien/kamar pasien</td>
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
    <td class="lnx  ">10. </td>
      <td class="bdr lnx " colspan="3">Pasang restrain bila perlu</td>
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
    <td class="lnx  "> 11. </td>
      <td class="bdr " colspan="3">Monitor kebutuhan toileting pasien secara kontinyu dan berikan bantuan segera bila diperlukan</td>
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
    <td class="lnx  "> 12.</td>
      <td class="bdr lnx " colspan="3">Beritahukan efek dari obat / anestesi kepada pasien / keluarga</td>
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
    <td class="lnx  "> 13. </td>
      <td class="bdr " colspan="3">Beritahukan orientasi ruangan sekitar kepada pasien/penunggu pasien</td>
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
      <td class="bdr lnx  bg-burem" colspan="14"><b>&nbsp;Resiko Rendah : dinilai ulang tiap 2 hari jika tidak ada perubahan kondisi</b></td>
    </tr>
    <tr class="bdl bdr bdt ">
    <td class="lnx  "> 1.</td>
      <td class="bdr lnx " colspan="3"> Orientasikan pasien dan keluarga tentang kamar pasien</td>
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
    <td class="lnx  "> 2.</td>
      <td class="bdr " colspan="3"> Dekatkan bell ke pasien dan ajarkan cara penggunaanya (bila tersedia)</td>
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
    <td class=" lnx "> 3. </td>
      <td class="bdr " colspan="3"> Anjurkan pasien menggunakan sandal saat turun, anjurkan pasien menggunakan pakaian yang tidak menimbulkan cidera</td>
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
    <td class=" lnx ">4. </td>
      <td class="bdr lnx " colspan="3">Kaji kebutuhan eliminasi pasien</td>
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
    <tr class="bdl bdr bdt bb">
    <td class="lnx  "> 5.</td>
      <td class="bdr lnx " colspan="3">Hindarkan barang-barang yang berbahaya di dekat pasien</td>
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
    <td class="lnx  "> 6.</td>
      <td class="bdr lnx " colspan="3"> Ajaklah keluarga/penunggu pasien untuk ikut mencegah risiko jatuh</td>
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
    <td class="lnx  "> 7. </td>
      <td class="bdr lnx " colspan="3"> Usahakan penerangan cukup pada pagi dan siang hari</td>
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
    <td class="lnx  "> 8.</td>
      <td class="bdr lnx " colspan="3"> Dokumentasikan tindakan perawat dan tindakan lanjut</td>
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
      <td class="bdr lnx b" colspan="4">Nama dan paraf yang melakukan intervensi pencegahan risiko jatuh</td>
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