<?php
// echo phpinfo(); die();
define('DOC_REVISI', 'Revisi : 4');
define('DOC_TERBIT', 'Tanggal Terbit : 1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/03.1'); 
define('DOC_FILE', 'Perencanaan-Pulang-Discharce-Planning.pdf'); 
define('DOC_TITLE', 'PERENCANAAN PULANG (DISCHARGE PLANNING)'); 
define('DOC_SUBJECT', 'Perencanaan Pulang (Discharce Planning)'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';
$html = '';

$html .= '
  <style type="text/css">
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
    .bg-burem {
      background-color: #9F9FA0;
      line-height:20px;
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
      line-height:15px;
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
      border-left: 1px solid white;
    }
  </style>
'; 
$html .= '
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tbody>
    <tr>
      <td class="" width="100px">Tgl. Masuk RS</td>
      <td class="" width="2px">:</td>
      <td class="" width="100px">____________________</td>
      <td class="" width="100px"></td>
      <td class="" width="100px">Dokter Pengirim</td>
      <td class="" width="2px">:</td>
      <td class="" width="100px">____________________</td>
    </tr>
<tr>
    <td class="">Tgl. Keluar RS</td>
    <td class="">:</td>
    <td class="">____________________</td>
    <td class=""></td>
    <td class="">Dokter yang merawat</td>
    <td class="">:</td>
    <td class="">____________________</td>
  </tr>
  <tr>
    <td class=""> &nbsp; </td>
    <td class=""> &nbsp; </td>
    <td class=""> &nbsp; </td>
    <td class=""> &nbsp; </td>
    <td class="">No. Telp/HP pasien</td>
    <td class="">:</td>
    <td class="">____________________</td>
  </tr>
  <tr>
  <td class=""> &nbsp; </td>
  <td class=""> &nbsp; </td>
  <td class=""> &nbsp; </td>
  <td class=""> &nbsp; </td>
  <td class="">&nbsp;</td>
  <td class=""> &nbsp; </td>
  <td class=""> &nbsp; </td>
</tr>
</tbody>
</table>
'; 
$html .= '
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tbody>
    <tr>
      <td class="bg-burem" width="22px"><b>A. </b></td>
      <td class="bg-burem" colspan="6"> <b>SAAT MASUK RUMAH SAKIT</b></td>
    </tr>
    <tr>
    <td class="" width="2px"> &nbsp; </td>
    <td class="" width="350px">Alasan masuk rumah sakit</td>
    <td class="" width="2px">:</td>
    <td class="" colspan="4">________________________________________</td>
  </tr>
  <tr>
  <td class="" width="2px"> &nbsp; </td>
  <td class="">Diagnosa Medis</td>
  <td class="" width="2px">:</td>
  <td class="" colspan="4">________________________________________</td>
</tr>
<tr>
<td class="" width="2px"> &nbsp; </td>
<td class="">Estimasi/Rencana tanggal pemulangan pasien</td>
<td class="" width="2px">:</td>
<td class="" colspan="4">________________________________________</td>
</tr>
<tr>
<td class="" width="2px"> &nbsp; </td>
<td class="">&nbsp;</td>
<td class="" width="2px">&nbsp;</td>
<td class="" colspan="4">&nbsp;</td>
</tr>
</tbody>
</table>
'; 
$html .= '
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tbody>
    <tr>
      <td class=" bg-burem" width="22px"><b>B. </b></td>
      <td class=" bg-burem" colspan="6"> <b>KRITERIA DISCHARGE PLANNING</b></td>
    </tr>
<tr>
<td class="" width="2px"> &nbsp; </td>
<td class="" width="450px">1.&nbsp;&nbsp;Bayi Prematur</td>
<td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
<td class="" width="2px">Ya</td>
<td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
<td class="" width="2px">Tidak</td>
</tr>
<tr>
<td class="" width="2px"> &nbsp; </td>
<td class="" width="350px">2.&nbsp;&nbsp;Usia lebih dari 65 tahun&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(score pengkajian awal: ___ akhir: ____)</td>
<td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
<td class="" width="2px">Ya</td>
<td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
<td class="" width="2px">Tidak</td>
</tr>
<tr>
<td class="" width="2px"> &nbsp; </td>
<td class="" width="450px">3.&nbsp;&nbsp;Percobaan bunuh diri</td>
<td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
<td class="" width="2px">Ya</td>
<td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
<td class="" width="2px">Tidak</td>
</tr>
<tr>
<td class="" width="2px"> &nbsp; </td>
<td class="" width="450px">4.&nbsp;&nbsp;Korban dan kasus kriminal</td>
<td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
<td class="" width="2px">Ya</td>
<td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
<td class="" width="2px">Tidak</td>
</tr>
<tr>
<td class="" width="2px"> &nbsp; </td>
<td class="" width="450px">5.&nbsp;&nbsp;Keterbatasan mobilitas/gangguan melakukan aktivitas sehari-hari</td>
<td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
<td class="" width="2px">Ya</td>
<td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
<td class="" width="2px">Tidak</td>
</tr>
<tr>
<td class="" width="2px"> &nbsp; </td>
<td class="" width="450px">6.&nbsp;&nbsp;Perawatan dan pengobatan lanjutan</td>
<td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
<td class="" width="2px">Ya</td>
<td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
<td class="" width="2px">Tidak</td>
</tr>
<tr>
<td class="" width="2px"> &nbsp; </td>
<td class="" width="450px">7.&nbsp;&nbsp;Kebutuhan pengetahuan ibadah dirumah</td>
<td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
<td class="" width="2px">Ya</td>
<td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
<td class="" width="2px">Tidak</td>
</tr>
<tr>
<td class="" width="2px"> &nbsp; </td>
<td class="" width="450px">8.&nbsp;&nbsp;Kebutuhan pelayanan pemeriksaan penunjang setelah keluar RS</td>
<td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
<td class="" width="2px">Ya</td>
<td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
<td class="" width="2px">Tidak</td>
</tr>
<tr>
<td class="" width="2px"> &nbsp; </td>
<td class="" width="450px">&nbsp;</td>
<td class="" width="2px">&nbsp;</td>
<td class="" width="2px">&nbsp;</td>
<td class="" width="2px"> &nbsp;</td>
<td class="" width="2px">&nbsp;</td>
</tr>
</tbody>
</table>
'; 
$html .='
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tbody>
    <tr>
      <td class=" bg-burem" width="23px"><b>C. </b></td>
      <td class=" bg-burem" colspan="6"> <b>PERENCANAAN PULANG</b></td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="22px"><b> 1. </b></td>
    <td class="" width="200px"><b>Kebutuhan pendampingan</b></td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">Tidak Perlu</td>
    <td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="200px">Pendampingan fungsional</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class=""> &nbsp;  </td>
    <td class="">Selama dirumah</td>
    <td class=""><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="160px">Pendampingan aktivitas harian</td>
    <td class=""> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="">Pendampingan diet</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class=""> &nbsp;  </td>
    <td class="">Nama Pendamping:________</td>
    <td class=""><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="20px">Pendampingan penggunaan peralatan medis</td>
    <td class=""> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="">Pendampingan psiko/sosio/spiritual</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class=""> <b>2. </b> </td>
    <td class=""><b>Ketersediaan pendamping</b></td>
    <td class=""><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="">Pendampingan minum/penggunaan obat</td>
    <td class=""><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="">Tidak Perlu</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"> &nbsp;</td>
    <td class="" width="200px">&nbsp;</td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">Tidak ada, koordinasi dengan Dinas Sosial/terkait</td>
    <td class="" width="2px"> </td>
    <td class="" width="200px"></td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="">&nbsp;</td>
    <td class="">Nama Pendamping:________</td>
    <td class=""><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="260px">Ada keluarga/wali</td>
    <td class=""></td>
    <td class=""></td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"><b> 3. </b></td>
    <td class="" width="200px"><b>Aktivitas harian</b></td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">Mandi/personal higyene</td>
    <td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="200px">Penyiapan obat</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px">&nbsp;</td>
    <td class="" width="200px"><b>yang perlu pendampingan</b></td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">BAB</td>
    <td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="200px">Penyiapan diet</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"></td>
    <td class="" width="200px">Laflet ADL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Ya &nbsp;<img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak</td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">BAK</td>
    <td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="200px">Lainnya:________</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"></td>
    <td class="" width="200px">Laflet Geriatri : <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Ya &nbsp;<img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak</td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">Mobilitas</td>
    <td class="" width="2px"> </td>
    <td class="" width="200px"></td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"><b> 4. </b></td>
    <td class="" width="200px"><b>Edukasi peralatan medis</b></td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">DC</td>
    <td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="200px">SNDL</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"></td>
    <td class="" width="200px">Laflet peralatan medis</td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">NGT</td>
    <td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="200px">Trakheostomi</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"></td>
    <td class="" width="200px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Ya <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak</td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">Stoma</td>
    <td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="200px">Oksigen</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"></td>
    <td class="" width="200px"></td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">Lainnya:________</td>
    <td class="" width="2px"> </td>
    <td class="" width="200px"></td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"><b> 5. </b></td>
    <td class="" width="200px"><b>Edukasi penggunaan obat</b></td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">Tata cara minum obat oral</td>
    <td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="200px">Tata cara pemberian insulin</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"> &nbsp; </td>
    <td class="" width="200px">No. Leaflet:________ </td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">Tata cara penggunaan alat terapi <i>inhaler</i></td>
    <td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="200px">Lainnya:________ </td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"><b> 6. </b></td>
    <td class="" width="200px"><b>Edukasi fungsional</b></td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">Penggunaan crutch/kursi roda/bed</td>
    <td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="200px">Tahapan latihan fisik</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"></td>
    <td class="" width="200px">Laflet edukasi fungsional</td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">Pencegahan dekubilitus (pasien tirah baring)</td>
    <td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="200px">Fisioterapi rutin</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"></td>
    <td class="" width="200px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Ya <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak</td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">Pencegahan pasien jatuh</td>
    <td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="200px">Lainnya:________</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"></td>
    <td class="" width="200px"></td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">Pembatasan aktivitas: ________</td>
    <td class="" width="2px"></td>
    <td class="" width="200px"></td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"><b> 7. </b></td>
    <td class="" width="200px"><b>Edukasi diet</b></td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">Diet TKTP</td>
    <td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="200px">Diet DM</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"></td>
    <td class="" width="200px">No Leaflet:________ </td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">Diet Rendah Garan</td>
    <td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="200px">Lainnya :________</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"><b> 8. </b></td>
    <td class="" width="200px"><b>Edukasi psiko/sosio/spiritual</b></td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px">Perlu pendampingan psikologi/kerohanianan</td>
    <td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="200px">Tata cara thaharah & solat (khusus pasien muslim)</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"></td>
    <td class="" width="200px">No Leaflet:________ </td>
    <td class="" width="2px"></td>
    <td class="" width="100px"></td>
    <td class="" width="2px"></td>
    <td class="" width="200px"></td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"><b> 9. </b></td>
    <td class="" width="200px"><b>Kebutuhan pengobatan/</b></td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px" colspan="3">Pemeriksaan penunjang yang perlu dilakukan:__________</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px">&nbsp;</td>
    <td class="" width="200px"><b>perawatan lanjutan & lainnya</b></td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px" colspan="3">Anjuran rawat luka: ___________</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px">&nbsp;</td>
    <td class="" width="200px">No Leaflet:________</td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px" colspan="3">Anjuran home care/home visit</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px">&nbsp;</td>
    <td class="" width="200px"></td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px" colspan="3">Cara mengatasi nyeri</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px">&nbsp;</td>
    <td class="" width="200px"></td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="" width="100px" colspan="3">Persiapan keamanan lingkungan/fasilitas di rumah</td>
    </tr>
</tbody>
</table>
';
$html .='<br><br><br><br>
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tbody>
    <tr>
      <td class=" bg-burem" width="2px"><b>D. </b></td>
      <td class=" bg-burem" colspan="7"> <b>SAAT KELUAR RUMAH SAKIT</b></td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="100px"><b>1. Kebutuhan transportasi</b></td>
    <td class="" width="2px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> </td>
    <td class="" width="100px">Ambulance</td>
    <td class="" width="2px"> <img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
    <td class="">Kendaraan pribadi</td>
    <td class="" width="2px"> </td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class=""> &nbsp;  </td>
    <td class=""></td>
    <td class=""></td>
    <td class=""></td>
    <td class=""></td>
    <td class=""></td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="200px"><b>2. Faskes terdekat</b></td>
    <td class="" colspan="6">_____________________________________________________________________</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="2px"></td>
    <td class="" width="200px" colspan="6">Apabila terjadi kondisi kegawatan segera dibawa ke fasilitas kesehatanterdekat / IGD</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="200px" colspan="7">Pasien dengan rencana pemulangan kompleks (memenuhi minimal 1 kriteria MPP dan 1 kriteria discharge planning) perencanaan pemulangan dilakukan bersama dengan MPP</td>
    </tr>
    <tr>
    <td class=""> &nbsp; </td>
    <td class="" width="200px"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Ya, koordinasi denga MPP</td>
    <td class="" colspan="5"><img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak</td>
    </tr>
</tbody>
</table>
';
$html .= '<br>
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tbody>
    <tr>
    <td class="" width="17px"> &nbsp; </td>
    <td class="" width="350px">&nbsp;</td>
    <td class="" width="2px">&nbsp;</td>
    <td class="" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Klaten, ___/___/______ &nbsp; Pukul ___:___ WIB</td>
  </tr>
  <tr>
  <td class="" width="17px"> &nbsp; </td>
  <td class="" width="350px">&nbsp;</td>
  <td class="" width="2px">&nbsp;</td>
  <td class="" colspan="4">&nbsp;</td>
</tr>
  <tr>
  <td class="" width="17px"> &nbsp; </td>
  <td class=" txc" width="350px">Pasien/keluarga<br><br><br>____________________________<br>Tanda tangan & Nama Terang</td>
  <td class="" width="2px">&nbsp;</td>
  <td class=" txc" colspan="4">Perawat<br><br><br>____________________________<br>Tanda tangan & Nama Terang</td>
</tr>
</tbody>
</table>
'; 
$pdf->WriteHTML($html);


$file = "asesmen_belajar.pdf";
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
  $file = $dir."soap_gd.pdf";
}
$pdf->Output($file, $pdf_type);
?>