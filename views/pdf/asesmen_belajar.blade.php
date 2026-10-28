<?php
define('DOC_REVISI', '1');
define('DOC_TERBIT', '1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/16.1'); 
define('DOC_TITLE', 'PENGKAJIAN KEBUTUHAN <br />EDUKASI PASIEN DAN <br />HAMBATAN PELAYANAN'); 
define('DOC_FILE', 'Pengkajian-Kebutuhan-Edukasi-Pasien-dan-Hambatan-Pelayanan.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';
$pdf->SetTitle(DOC_NOMER.' - '.$no_reg);
$pdf->SetSubject('Asesmen Kemampuan dan Kemauan Belajar');
$pdf->SetKeywords('RSU Islam Klaten, Asesmen Belajar');
// $pdf->SetHTMLHeader('
//   <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
//     <tbody>
//       <tr>
//         <td align="left" width="300">RSU ISLAM KLATEN</td>
//         <td align="right" width="300" style="text-align:right;"> <b>'.DOC_NOMER.'</b></td>
//         <td align="right"  style="">Hal {PAGENO}/ {nbpg}</td>
//       </tr>
//     </tbody>
//   </table>
//   <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
//     <tbody>
//       <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
//       <tr>
//         <td class="txr" rowspan="5" width="75" bgcolor="" style=""> </td>
//         <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>PENGKAJIAN KEBUTUHAN <br />EDUKASI PASIEN DAN <br />HAMBATAN PELAYANAN</b></td>
//         <td class="" rowspan="5" width="5"></td><td width="70">NO.RM</td><td width="10">:</td><td width="250">'.(!empty($no_reg)?$no_reg:'').'</td>
//       </tr>
//       <tr><td>NAMA</td><td>:</td><td>'.(!empty($nama)?$nama:'').'</td></tr>
//       <tr><td>NIK</td><td>:</td><td>'.(!empty($nik)?$nik:'').'</td></tr>
//       <tr><td>TGL LAHIR</td><td>:</td><td>'.((!empty($tgl_lahir) && $tgl_lahir != '') ? date("d-m-Y", strtotime($tgl_lahir)): '').'</td></tr>
//       <tr><td valign="top">ALAMAT</td><td valign="top">:</td><td>'.(!empty($alamat)?$alamat:' <br /> &nbsp; ').'</td></tr>
//       <tr><td colspan="6" style="line-height:3px; border-bottom:1px solid black;"> &nbsp; </td></tr>
//     </tbody>
//   </table>
// ');
$pdf->SetHTMLFooter('
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: 1</td><td width="" align="right">Tanggal Terbit : 1 Agustus 2022</td></tr></tbody></table>
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
    .ln5 {
      line-height:5px;
    }
    .ln23 {
      line-height:23px;
    }
    .lnx {
      line-height:15px;
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
    .bdlw {
      border-left: 5px solid white;
    }
  </style>
'; 
$html .= '
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
  <tbody>
    <tr class="b">
      <td colspan="10" class="txl"> PENGKAJIAN</td>
      <td colspan="2" class="txl bdlw"> TINDAK LANJUT</td>
    </tr>

    <tr class="">
      <td width="" class="ln5" colspan="12"> &nbsp; </td>
    </tr>

    <tr class="bg-burem b">
      <td width="20px"> A.</td>
      <td colspan="9">Kemampuan membaca dan tingkat pendidikan</td>
      <td width="" class="bdlw"> &nbsp; </td>
      <td width=""> &nbsp; </td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">Kemampuan membaca</td>
      <td width="2px">:</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td> Tidak buta huruf</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Buta huruf</td>
      <td width="10" class="bdlw"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="" class="">Edukasi sesuai kondisi pasien</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4" width="10px">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="2px"> </td>
      <td width="" colspan="3">SD/SMP/SMA/Diploma/Sarjana/Pasca Sarjana *)</td>
      <td width="" class="bdlw"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="" class="">Pendampingan keluarga/wali</td>
    </tr>
    <tr>
      <td colspan="10"><br /> </td>
    </tr>
    <tr class="bg-burem b">
      <td width="20px"> B.</td>
      <td colspan="9">Bahasa</td>
      <td width="" class="bdlw"> &nbsp; </td>
      <td width=""> &nbsp; </td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">Bahasa sehari-hari</td>
      <td width="2px">:</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="150px"> Indonesia</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Jawa</td>
      <td width="" class="bdlw"><img src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="">Edukasi dengan Bahasa yg dipahami pasien</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="150px">Inggris</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="150">Lainnya :_______</td>
      <td width="" class="bdlw"><img src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="">Penerjemah bahasa</td><br><br>
    </tr>
    <tr class="bg-burem b">
      <td width="20px"> C.</td>
      <td colspan="9">Hambatan emosional dan motivasi</td>
      <td width="" class="bdlw"> &nbsp; </td>
      <td width=""> &nbsp; </td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">Menerima kondisi sakit</td>
      <td width="2px">:</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="150px">Tidak</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Ya</td>
      <td width="" class="bdlw"><img src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="">Pendampingan keluarga/wali</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">Memiliki motivasi sembuh</td>
      <td width="2px">:</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="150px">Tidak</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Ya</td>
      <td width="" class="bdlw"><img src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="">Motivasi/dukungan keluarga</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">Takut lingkungan RS</td>
      <td width="2px">:</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="150px">Tidak</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Ya</td>
      <td width="" class="bdlw"><img src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="">Pendampingan rohaniawan</td><br><br>
    </tr>
    <tr class="bg-burem b">
      <td width="20px"> D.</td>
      <td colspan="9">Keterbatasan fisik dan kognitif</td>
      <td width="" class="bdlw"> &nbsp; </td>
      <td width=""> &nbsp; </td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">Usia lanjut > 65 th</td>
      <td width="2px">:</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="150px">Tidak</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Ya</td>
      <td width="" class="bdlw"><img src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="">Bantuan mobilisasi</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="150px">Tidak</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Ya, sebutkan :</td>
      <td width="" class="bdlw"><img src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="">Pendampingan keluarga/wali</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="150px">&nbsp;</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Gangguan pendengaran</td>
      <td width="" class="bdlw"><img src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="">Asesmen resiko jatuh</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4" width="150">Pasien dengan cacat fisik</td>
      <td width="2px">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="150px">&nbsp;</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Gangguan bicara</td>
      <td width="">&nbsp;</td>
      <td width="">&nbsp;</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="150px">&nbsp;</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Gangguan penglihatan</td>
      <td width="" class="bdlw">&nbsp;</td>
      <td width="">&nbsp;</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="150px">&nbsp;</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Lainnya : ______</td>
      <td width="" class="bdlw">&nbsp;</td>
      <td width="">&nbsp;</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4" width="150">Pasien dengan alat bantu</td>
      <td width="2px">:</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="150px">Tidak</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Ya, sebutkan :</td>
      <td width="" class="bdlw">&nbsp;</td>
      <td width="">&nbsp;</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="150px">&nbsp;</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Kursi roda</td>
      <td width="" class="bdlw">&nbsp;</td>
      <td width="">&nbsp;</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="150px">&nbsp;</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Kruk</td>
      <td width="" class="bdlw">&nbsp;</td>
      <td width="">&nbsp;</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="150px">&nbsp;</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Brankard</td>
      <td width="" class="bdlw">&nbsp;</td>
      <td width="">&nbsp;</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="2px">&nbsp;</td>
      <td width="150px">&nbsp;</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Lainnya : ______</td>
      <td width="" class="bdlw">&nbsp;</td>
      <td width="">&nbsp;</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">Penurunan kesadaran</td>
      <td width="2px">:</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="150px">Tidak</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Ya</td>
      <td width="" class="bdlw">&nbsp;</td>
      <td width="">&nbsp;</td><br><br>
    </tr>
    </tr>
    <tr class="bg-burem b">
      <td width="20px"> E.</td>
      <td colspan="9">Ketersediaan pasien untuk menerima informasi</td>
      <td width="" class="bdlw"> &nbsp; </td>
      <td width=""> &nbsp; </td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">Pasien kooperatif untuk menerima informasi</td>
      <td width="2px">:</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="150px">Tidak</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Ya</td>
      <td width="" class="bdlw"><img src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="">Edukasi sesuai kondisi pasien/keluarga</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4">Keluarga/wali kooperatif untuk menerima informasi</td>
      <td width="2px">:</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width="150px">Tidak</td>
      <td width="2px"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /></td>
      <td width=""> Ya</td>
      <td width="" class="bdlw">&nbsp;</td>
      <td width="">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="10"><br /> </td>
    </tr>
    <tr class="bg-burem b">
      <td width="20px"> F.</td>
      <td colspan="9">Keyakinan dan nilai-nilai pasien dan keluarga yang perlu diperhatikan</td>
      <td width="" class="bdlw"> &nbsp; </td>
      <td width=""> &nbsp; </td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4" colspan="9"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /> Tidak ada</td>
      <td width="">&nbsp;</td>
      <td width="200px">Komunikasi dengan PPA terkait :</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4" colspan="9"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /> Tidak memakan suatu janis makanan, misal daging sapi, ikan
        bersisik, dll</td>
      <td width="" class="bdlw"><img src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /> </td>
      <td width="200px">DPJP</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4" colspan="9"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /> Menolak dilayani petugas yang tidak sesuai jenis kelamin</td>
      <td width="" class="bdlw"><img src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /> </td>
      <td width="200px">Perawat</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4" colspan="9"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /> Menolak diberikan imunisasi pada anaknya</td>
      <td width="" class="bdlw"><img src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /> </td>
      <td width="200px">Ahli Gizi</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4" colspan="9"><img
          src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /> Lainnya : ______</td>
      <td width="" class="bdlw"><img src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /> </td>
      <td width="200px">Farmasi</td>
    </tr>
    <tr>
      <td width="20"> &nbsp;</td>
      <td colspan="4" colspan="9">&nbsp;</td>
      <td width="" class="bdlw"><img src="'.IMG.'banner/'.(($belajar->keyakinan == '0')?'square14_check':'square14_uncheck').'.png"
          width="12" height="" /> </td>
      <td width="200px">Lainnya : ______</td>
    </tr>
  </tbody>
</table>
'; 

$html .= '
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td class="txc" >
              Klaten , '.(!empty($belajar->registered)?date('d-m-Y', strtotime($belajar->registered)):'___/___/_______ ').' Jam : '.(!empty($belajar->registered)?date('H:i:s', strtotime($belajar->registered)):'___/___ ').' WIB
            </td>
        </tr>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td width="300" class="txc" style="background-image:url(\''.IMG.'ttd/'.$dpjp_id.'.jpg\'); display:none; background-repeat:no-repeat; background-size:100px; background-position:center;height:110px;">
                Pasien/Keluarga
                <br />
                <!--'.(!empty($dpjp_id)?'<img height="50" width="75" src="'.IMG.'ttd/'.$dpjp_id.'.jpg" alt="">':'').'-->
                <br />
                <br />
                <br />
                '.(!empty($belajar->pasien_keluarga)?'  '.$belajar->pasien_keluarga.'  ':'  __________________________________ <br />Tanda tangan & Nama terang').'
            </td>
            <td width="72"></td>
            <td width="300" class="txc" style="background-image:url(\''.IMG.'ttd/'.$perawat_id.'.jpg\'); display:none; background-repeat:no-repeat; background-size:25% 25%; background-position:center;height:110px;">
                Petugas
                <br />
                <!--'.($ttd=='1'?'<img height="50" width="75" src="'.IMG.'ttd/'.$perawat_id.'.jpg" alt="">':'<br /><br />').'-->
                <br />
                <br />
                <br />
                '.(!empty($belajar->nama_petugas)?' '.$belajar->nama_petugas.' ':' __________________________________ <br />Tanda tangan & Nama terang').'
            </td>
        </tr>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td colspan="3" style="font-size:11px;">Catatan: 
            <br />- Beri tanda checklist ( <img src="'.IMG.'banner/blank_check.png" style="margin-top:2px;" width="12" height=""/> ) pada kotak ( <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/>) yang dipilih/sesuai
            <br />- Coret yang tidak perlu
            </td>
        </tr>
    </tbody>
  </table>'; 
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