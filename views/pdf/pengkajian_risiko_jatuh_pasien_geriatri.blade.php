<?php
define('DOC_REVISI', 'Revisi : 5');
define('DOC_TERBIT', 'Tanggal Terbit : 23 Juni 2022');
define('DOC_NOMER', 'FM/RM/04.6'); 
define('DOC_FILE', 'Pengkajian-Resiko-Jatuh-Pasien-Geriatri.pdf'); 
define('DOC_TITLE', 'PENGKAJIAN RESIKO JATUH<br>PASIEN GERIATRI <i>(Ontario Modified Stratify - Sidney Score)</i>'); 
define('DOC_SUBJECT', 'Pengkajian Resiko Jatuh Pasien Geriatri'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 6, 5, 6, 'P');
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
    .bg-rendah {
      background-color: #ffd34d;
    }
    .bg-sedang {
      background-color: #57ff6d;
    }
    .bg-tinggi {
      background-color: #eb444c;
    }
    .p-3 {
     padding:3px;
    }
  </style>
'; 
$print_tr = '';
$jml_row = 30;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= ''; 
}
$html .='<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tbody>
  <tr>
    <td class="ln13 p-3">Pengkajian resiko jatuh dilakukan saat pasien masuk, ketika terjadi perubahan kondisi dan ketika tiba diruangan baru dan atau setelah pasien jatuh</td>
  </tr>
</tbody>
</table>';
$html .='
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="">
      <th class="bdt bdr bdb bdl lns custom-text bg-burem" width="25" rowspan="3"> NO </th>
      <th class="bdt bdr bdb lns custom-text bg-burem" colspan="2" rowspan="3" width="150px"> FAKTOR RESIKO </th>
      <th class="bdt bdr bdb lns custom-text bg-burem" width="50px" rowspan="3"> YA </th>
      <th class="bdt bdr bdb lns custom-text bg-burem" width="50px" rowspan="3"> TIDAK </th>
      <th class="bdt bdr bdb lns custom-text bg-burem"> TANGGAL </th>
      <th class="bdt bdr bdb lns custom-text bg0"> </th>
      <th class="bdt bdr bdb lns custom-text bg0"> </th>
      <th class="bdt bdr bdb lns custom-text bg0"> </th>
      <th class="bdt bdr bdb lns custom-text bg0"> </th>
      <th class="bdt bdr bdb lns custom-text bg0"> </th>
    </tr>
    <tr>
      <th class="bdr bdb lns custom-text bg-burem"> JAM </th>
      <td class="bdr bdb lns custom-text" width="30px"> &nbsp; </td>
      <td class="bdr bdb lns custom-text" width="30px"> &nbsp; </td>
      <td class="bdr bdb lns custom-text" width="30px"> &nbsp; </td>
      <td class="bdr bdb lns custom-text" width="30px"> &nbsp; </td>
      <td class="bdr bdb lns custom-text" width="30px"> &nbsp; </td>
    </tr>
    <tr>
      <th class="bdr bdb lns custom-text bg-burem"> KETERANGAN </th>
      <td class="bdb lns custom-text"> &nbsp; </td>
      <td class="bdb lns custom-text"> &nbsp; </td>
      <td class="bdb lns custom-text"> &nbsp; </td>
      <td class="bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="bdl bdr ">
      <td class="bdr lns custom-text txc" rowspan="2"> 1 </td>
      <td class="bdr lns custom-text" rowspan="2" width="20px"><b>Riwayat<br>Jatuh</b></td>
      <td class="bdr lns custom-text">Pasien masuk karena jatuh </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr ln12 p-3 custom-text" rowspan="2" >salah satu jawaban ya = 6</td>
      <td class="bdr lns custom-text" rowspan="2"> &nbsp; </td>
      <td class="bdr lns custom-text" rowspan="2"> &nbsp; </td>
      <td class="bdr lns custom-text" rowspan="2"> &nbsp; </td>
      <td class="bdr lns custom-text" rowspan="2"> &nbsp; </td>
      <td class="bdr lns custom-text" rowspan="2"> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lns custom-text">Pasien pernah jatuh < 2 bulan </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lns custom-text txc" rowspan="3"> 2 </td>
      <td class="bdr lns custom-text" rowspan="3"><b>Status<br>Mental</b></td>
      <td class="bdr ln12 p-3 custom-text">Pasien dellirium ( tidak dapat membuat keputusan, pola pikir tidak terorganisir,  gangguan daya ingat ) </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr ln12 p-3 custom-text" rowspan="3"> salah satu jawaban ya = 14 </td>
      <td class="bdr lns custom-text" rowspan="3"> &nbsp; </td>
      <td class="bdr lns custom-text" rowspan="3"> &nbsp; </td>
      <td class="bdr lns custom-text" rowspan="3"> &nbsp; </td>
      <td class="bdr lns custom-text" rowspan="3"> &nbsp; </td>
      <td class="bdr lns" rowspan="3"> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr ln12 p-3">Pasien disorientasi ( tidak bisa menyebutkan waktu, tempat, orang ) </td>
      <td class="bdr lns"> &nbsp; </td>
      <td class="bdr lns"> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr ln12 p-3 custom-text">Pasien agitasi ( ketakutan, cemas, dan gelisah ) </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lns txc" rowspan="3"> 3 </td>
      <td class="bdr lns" rowspan="3"><b>Penglihatan</b></td>
      <td class="bdr lns">Pasien memakai kaca mata</td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text" rowspan="3">Salah satu jawaban ya = 1</td>
      <td class="bdr lns custom-text" rowspan="3"> &nbsp; </td>
      <td class="bdr lns custom-text" rowspan="3"> &nbsp; </td>
      <td class="bdr lns custom-text" rowspan="3"> &nbsp; </td>
      <td class="bdr lns custom-text" rowspan="3"> &nbsp; </td>
      <td class="bdr lns custom-text" rowspan="3"> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lns custom-text">Pasien mengeluh penglihatan buram</td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr ln12 p-3">Pasien katarak / glaukoma / de generasi macula / (umur > 60 th) </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lns custom-text txc"> 4 </td>
      <td class="bdr lns custom-text"><b>Kebiasaan berkemih</b></td>
      <td class="bdr ln12 p-3 custom-text">Ada perubahan perilaku berkemih (frekuensi,urgensi,inkontensia, nokturia) </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text">&nbsp; Ya = 2</td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lns custom-text txc" rowspan="4"> 5 </td>
      <td class="bdr lns custom-text" rowspan="4"><b>Transfer<br>dari TT ke<br>kursi &<br>ke TT</b></td>
      <td class="bdr lns custom-text"> Mandiri ( boleh dengan alat bantu jalan ) </td>
      <td class="bdr lns txc custom-text" colspan="2"> 0 </td>
      <td class="bdr lns custom-text" rowspan="8"> jumlahkan nilai transfer & mobilitas. Jika nilai total 0-3 maka score = 0 jumlahkan nilai total 4-6 maka score = 7</td>
      <td class="bdr lns custom-text" rowspan="8"> &nbsp; </td>
      <td class="bdr lns custom-text" rowspan="8"> &nbsp; </td>
      <td class="bdr lns custom-text" rowspan="8"> &nbsp; </td>
      <td class="bdr lns custom-text" rowspan="8"> &nbsp; </td>
      <td class="bdr lns custom-text" rowspan="8"> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr ln12 p-3 custom-text">Perlu sedikit bantuan ( 1 orang dalam pengawasan ) </td>
      
      <td class="bdr lns txc custom-text" colspan="2"> 1 </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lns custom-text">Butuh bantuan ( 2 orang ) </td>
      <td class="bdr lns txc custom-text" colspan="2"> 2 </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr ln12 p-3 custom-text">Tidak dapat duduk dengan seimbang (bantuan total) </td>
      <td class="bdr lns txc custom-text" colspan="2"> 3 </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lns custom-text txc" rowspan="4"> 6 </td>
      <td class="bdr lns custom-text" rowspan="4"><b>Mobilitas</b></td>
      <td class="bdr lns custom-text"> Mandiri ( boleh dengan alat bantu jalan )  </td>
      <td class="bdr lns txc custom-text" colspan="2"> 0 </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr ln12 p-3 custom-text"> Berjalan dengan bantuan 1 orang (verbal/fisik)  </td>
      <td class="bdr lns txc custom-text" colspan="2"> 1 </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lns custom-text"> Menggunakan kursi roda  </td>
      <td class="bdr lns txc custom-text" colspan="2"> 2 </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lns custom-text"> Imobilisasi  </td>
      <td class="bdr lns txc custom-text" colspan="2"> 3 </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lns" colspan="6"><b> TOTAL SCORE</b></td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
      <td class="bdr lns custom-text"> &nbsp; </td>
    </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="bdl bdr bdt bdb">
    <td class="bdr lns custom-text2"><b>Keterangan score :</b></td>
    <td class="lns custom-text2 bg-rendah"> 0 - 5 : resiko rendah </td>
    <td class="lns custom-text2 bg-sedang"> 6 - 16 : resiko sedang </td>
    <td class="lns custom-text2 bg-tinggi"> 17 - 30 : resiko tinggi </td>
  </tr>
  <tr>
    <td colspan="4" class="ln5">&nbsp; </td>
  </tr>
</table>
';
$html .= '
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="">
    <th class="bdt bdb bdl lns custom-text bg-burem" rowspan="2" width="20">  </th>
    <th class="bdt bdr bdb lns custom-text bg-burem" colspan="2" rowspan="2"> Intervensi pencegahan risiko jatuh, beri tanda centang ( <img src="'.IMG.'banner/blank_check.png" style="margin-top:2px;" width="8" height=""/> )</th>
    <th class="bdt bdr bdb lns custom-text bg-burem" width="60"> Tanggal </th>
    <th class="bdt bdr bdb lns custom-text" width="30px"> &nbsp; </th>
    <th class="bdt bdr bdb lns custom-text" width="30px"> &nbsp; </th>
    <th class="bdt bdr bdb lns custom-text" width="30px"> &nbsp; </th>
    <th class="bdt bdr bdb lns custom-text" width="30px"> &nbsp; </th>
    <th class="bdt bdr bdb lns custom-text" width="30px"> &nbsp; </th>
  </tr>
  <tr class="">
    <th class="bdt bdr bdb lns custom-text bg-burem"> Jam </th>
    <th class="bdr bdb lns custom-text"> &nbsp; </th>
    <th class="bdr bdb lns custom-text"> &nbsp; </th>
    <th class="bdr bdb lns custom-text"> &nbsp; </th>
    <th class="bdr bdb lns custom-text"> &nbsp; </th>
    <th class="bdr bdb lns custom-text"> &nbsp; </th>
  </tr>
<tr class="bdl bdr ">
  <th class="bdr lns custom-text" text-rotate="90" width="30" rowspan="7" style="font-size:12px;"> Risiko Rendah (RR)</th>
  <td class="bdr lns custom-text" width="20">1</td>
  <td class="bdr lns custom-text" colspan="2" width=""> Orientasi lingkungan </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
  <td class="bdr lns custom-text">2</td>
  <td class="bdr lns custom-text" colspan="2"> Pastikan bel mudah dijangkau </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
  <td class="bdr lns custom-text">3</td>
  <td class="bdr lns custom-text" colspan="2"> Roda tempat tidur berada pada posisi terkunci </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
  <td class="bdr lns custom-text">4</td>
  <td class="bdr lns custom-text" colspan="2"> Posisikan tempat tidur pada posisi terendah </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
  <td class="bdr lns custom-text">5</td>
  <td class="bdr lns custom-text" colspan="2"> Naikkan pagar pengaman tempat tidur </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
  <td class="bdr lns custom-text">6</td>
  <td class="bdr lns custom-text" colspan="2"> Pastikan lampu tidur hidup saat malam hari </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
  <td class="bdr lns custom-text">7</td>
  <td class="bdr lns custom-text" colspan="2"> Berikan edukasi pasien </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
  <td class="bdr lns custom-text"> &nbsp; </td>
</tr>

<tr class="">
<td class="bdt bdr bdb bdl lns custom-text" colspan="9">&nbsp;</td>
</tr>
<tr class="bdl bdr bdt">
<th class="bdr lns custom-text" text-rotate="90" rowspan="3" style="font-size:12px;">&nbsp;Risiko Sedang (RS)&nbsp;</s>
<td class="bdr lns custom-text">1</td>
<td class="bdr ln12 p-3 custom-text" colspan="2"> Lakukan semua pedoman pencegahan jatuh risiko rendah</td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr lns custom-text">2</td>
<td class="bdr ln12 p-3 custom-text" colspan="2"> Beri tanda segitiga warna kuning pada bed pasien, pintu
atau RM pasien</td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr lns custom-text">3</td>
<td class="bdr ln12 p-3 custom-text" colspan="2"> Pasangkan gelang kuning pada pasien <br /><br /><br /><br /><br /></td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr lns custom-text" colspan="9">&nbsp;</td>
</tr>
<tr class="bdl bdr bdt">
<th class="bdr lns custom-text" text-rotate="90" rowspan="5" style="font-size:12px;"> Risiko Tinggi (RT)</th>
<td class="bdr lns custom-text">1</td>
<td class="bdr ln12 p-3 custom-text" colspan="2"> Lakukan semua pedoman pencegahan jatuh risiko rendah dan sedang</td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr lns custom-text">2</td>
<td class="bdr lns custom-text" colspan="2"> Kunjungi dan monitor pasien setiap jam</td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr lns custom-text">3</td>
<td class="bdr ln12 p-3 custom-text" colspan="2"> Tempatkan pasien di kamar yang paling dekat dengan <i>nurse station</i> (bila mungkin)</td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr lns custom-text">4</td>
<td class="bdr lns custom-text" colspan="2"> Pastikan pasien di kamar menggunakan alat bantu jalan</td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt">
<td class="bdr lns custom-text">5</td>
<td class="bdr lns custom-text" colspan="2"> Libatkan keluarga untuk mengawasi pasien</td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
<td class="bdr lns custom-text"> &nbsp; </td>
</tr>
<tr class="bdl bdr bdt bdb bg-burem">
<td class="bdr ln15 custom-text b" colspan="4"> Nama dan paraf melakukan intervensi pencegahan risiko jatuh</td>
<td class="bdr lns bg0"> &nbsp; </td>
<td class="bdr lns bg0"> &nbsp; </td>
<td class="bdr lns bg0"> &nbsp; </td>
<td class="bdr lns bg0"> &nbsp; </td>
<td class="bdr lns bg0"> &nbsp; </td>
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
  $pdf->Output($file, $pdf_type);
  if (!empty($lp_print)) {
    $cmd = "lp $file -d $printer";
    shell_exec($cmd);
    $data=array(
      "status" => true, 
      "pdf" => $file, 
      "printer" => $printer
    );
    echo json_encode($data); die();
  }  
} else {
  $pdf->Output($file, $pdf_type);
}
?>